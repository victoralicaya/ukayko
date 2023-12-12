<?php
require( dirname( __FILE__ ) . '/class-php-hook.php' );

/** @var WT_Hook[] $wt_filter */
global $wt_filter, $wt_actions, $wt_current_filter;

if ( $wt_filter ) {
	$wt_filter = WT_Hook::build_preinitialized_hooks( $wt_filter );
} else {
	$wt_filter = array();
}

if ( ! isset( $wt_actions ) )
	$wt_actions = array();

if ( ! isset( $wt_current_filter ) )
	$wt_current_filter = array();

function add_filter( $tag, $function_to_add, $priority = 10, $accepted_args = 1 ) {
	global $wt_filter;
	if ( ! isset( $wt_filter[ $tag ] ) ) {
		$wt_filter[ $tag ] = new WT_Hook();
	}
	$wt_filter[ $tag ]->add_filter( $tag, $function_to_add, $priority, $accepted_args );
	return true;
}

function has_filter($tag, $function_to_check = false) {
	global $wt_filter;

	if ( ! isset( $wt_filter[ $tag ] ) ) {
		return false;
	}

	return $wt_filter[ $tag ]->has_filter( $tag, $function_to_check );
}

function apply_filters( $tag, $value ) {
	global $wt_filter, $wt_current_filter;

	$args = array();

	// Do 'all' actions first.
	if ( isset($wt_filter['all']) ) {
		$wt_current_filter[] = $tag;
		$args = func_get_args();
		_wt_call_all_hook($args);
	}

	if ( !isset($wt_filter[$tag]) ) {
		if ( isset($wt_filter['all']) )
			array_pop($wt_current_filter);
		return $value;
	}

	if ( !isset($wt_filter['all']) )
		$wt_current_filter[] = $tag;

	if ( empty($args) )
		$args = func_get_args();

	// don't pass the tag name to WT_Hook
	array_shift( $args );

	$filtered = $wt_filter[ $tag ]->apply_filters( $value, $args );

	array_pop( $wt_current_filter );

	return $filtered;
}
function _wt_call_all_hook($args) {
	global $wt_filter;

	$wt_filter['all']->do_all_hook( $args );
}

function _wt_filter_build_unique_id($tag, $function, $priority) {
	global $wt_filter;
	static $filter_id_count = 0;

	if ( is_string($function) )
		return $function;

	if ( is_object($function) ) {
		// Closures are currently implemented as objects
		$function = array( $function, '' );
	} else {
		$function = (array) $function;
	}

	if (is_object($function[0]) ) {
		// Object Class Calling
		if ( function_exists('spl_object_hash') ) {
			return spl_object_hash($function[0]) . $function[1];
		} else {
			$obj_idx = get_class($function[0]).$function[1];
			if ( !isset($function[0]->wt_filter_id) ) {
				if ( false === $priority )
					return false;
				$obj_idx .= isset($wt_filter[$tag][$priority]) ? count((array)$wt_filter[$tag][$priority]) : $filter_id_count;
				$function[0]->wt_filter_id = $filter_id_count;
				++$filter_id_count;
			} else {
				$obj_idx .= $function[0]->wt_filter_id;
			}

			return $obj_idx;
		}
	} elseif ( is_string( $function[0] ) ) {
		// Static Calling
		return $function[0] . '::' . $function[1];
	}
}
$shortcode_tags = array();
function add_shortcode($tag, $func) {
	global $shortcode_tags;

	if ( '' == trim( $tag ) ) {
		$message = __( 'Invalid shortcode name: Empty name given.' );
		_doing_it_wrong( __FUNCTION__, $message, '4.4.0' );
		return;
	}

	if ( 0 !== preg_match( '@[<>&/\[\]\x00-\x20=]@', $tag ) ) {
		/* translators: 1: shortcode name, 2: space separated list of reserved characters */
		$message = sprintf( __( 'Invalid shortcode name: %1$s. Do not use spaces or reserved characters: %2$s' ), $tag, '& / < > [ ] =' );
		_doing_it_wrong( __FUNCTION__, $message, '4.4.0' );
		return;
	}

	$shortcode_tags[ $tag ] = $func;
}

function remove_shortcode($tag) {
	global $shortcode_tags;

	unset($shortcode_tags[$tag]);
}

function remove_all_shortcodes() {
	global $shortcode_tags;

	$shortcode_tags = array();
}

function shortcode_exists( $tag ) {
	global $shortcode_tags;
	return array_key_exists( $tag, $shortcode_tags );
}

function has_shortcode( $content, $tag ) {
	if ( false === strpos( $content, '[' ) ) {
		return false;
	}

	if ( shortcode_exists( $tag ) ) {
		preg_match_all( '/' . get_shortcode_regex() . '/', $content, $matches, PREG_SET_ORDER );
		if ( empty( $matches ) )
			return false;

		foreach ( $matches as $shortcode ) {
			if ( $tag === $shortcode[2] ) {
				return true;
			} elseif ( ! empty( $shortcode[5] ) && has_shortcode( $shortcode[5], $tag ) ) {
				return true;
			}
		}
	}
	return false;
}

function do_shortcode( $content, $ignore_html = false ) {
	global $shortcode_tags;

	if ( false === strpos( $content, '[' ) ) {
		return $content;
	}

	if (empty($shortcode_tags) || !is_array($shortcode_tags))
		return $content;

	// Find all registered tag names in $content.
	preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
	$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );

	if ( empty( $tagnames ) ) {
		return $content;
	}

	$content = do_shortcodes_in_html_tags( $content, $ignore_html, $tagnames );

	$pattern = get_shortcode_regex( $tagnames );
	$content = preg_replace_callback( "/$pattern/", 'do_shortcode_tag', $content );

	// Always restore square braces so we don't break things like <!--[if IE ]>
	$content = unescape_invalid_shortcodes( $content );

	return $content;
}

function get_shortcode_regex( $tagnames = null ) {
	global $shortcode_tags;

	if ( empty( $tagnames ) ) {
		$tagnames = array_keys( $shortcode_tags );
	}
	$tagregexp = join( '|', array_map('preg_quote', $tagnames) );

	// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
	// Also, see shortcode_unautop() and shortcode.js.
	return
		  '\\['                              // Opening bracket
		. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
		. "($tagregexp)"                     // 2: Shortcode name
		. '(?![\\w-])'                       // Not followed by word character or hyphen
		. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
		.     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
		.     '(?:'
		.         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
		.         '[^\\]\\/]*'               // Not a closing bracket or forward slash
		.     ')*?'
		. ')'
		. '(?:'
		.     '(\\/)'                        // 4: Self closing tag ...
		.     '\\]'                          // ... and closing bracket
		. '|'
		.     '\\]'                          // Closing bracket
		.     '(?:'
		.         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
		.             '[^\\[]*+'             // Not an opening bracket
		.             '(?:'
		.                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
		.                 '[^\\[]*+'         // Not an opening bracket
		.             ')*+'
		.         ')'
		.         '\\[\\/\\2\\]'             // Closing shortcode tag
		.     ')?'
		. ')'
		. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
}

function do_shortcode_tag( $m ) {
	global $shortcode_tags;

	// allow [[foo]] syntax for escaping a tag
	if ( $m[1] == '[' && $m[6] == ']' ) {
		return substr($m[0], 1, -1);
	}

	$tag = $m[2];
	$attr = shortcode_parse_atts( $m[3] );

	if ( ! is_callable( $shortcode_tags[ $tag ] ) ) {
		/* translators: %s: shortcode tag */
		$message = sprintf( __( 'Attempting to parse a shortcode without a valid callback: %s' ), $tag );
		_doing_it_wrong( __FUNCTION__, $message, '4.3.0' );
		return $m[0];
	}

	$return = apply_filters( 'pre_do_shortcode_tag', false, $tag, $attr, $m );
	if ( false !== $return ) {
		return $return;
	}

	$content = isset( $m[5] ) ? $m[5] : null;

	$output = $m[1] . call_user_func( $shortcode_tags[ $tag ], $attr, $content, $tag ) . $m[6];
	return apply_filters( 'do_shortcode_tag', $output, $tag, $attr, $m );
}

function do_shortcodes_in_html_tags( $content, $ignore_html, $tagnames ) {
	// Normalize entities in unfiltered HTML before adding placeholders.
	$trans = array( '&#91;' => '&#091;', '&#93;' => '&#093;' );
	$content = strtr( $content, $trans );
	$trans = array( '[' => '&#91;', ']' => '&#93;' );

	$pattern = get_shortcode_regex( $tagnames );
	$textarr = wp_html_split( $content );

	foreach ( $textarr as &$element ) {
		if ( '' == $element || '<' !== $element[0] ) {
			continue;
		}

		$noopen = false === strpos( $element, '[' );
		$noclose = false === strpos( $element, ']' );
		if ( $noopen || $noclose ) {
			// This element does not contain shortcodes.
			if ( $noopen xor $noclose ) {
				// Need to encode stray [ or ] chars.
				$element = strtr( $element, $trans );
			}
			continue;
		}

		if ( $ignore_html || '<!--' === substr( $element, 0, 4 ) || '<![CDATA[' === substr( $element, 0, 9 ) ) {
			// Encode all [ and ] chars.
			$element = strtr( $element, $trans );
			continue;
		}

		$attributes = wp_kses_attr_parse( $element );
		if ( false === $attributes ) {
			// Some plugins are doing things like [name] <[email]>.
			if ( 1 === preg_match( '%^<\s*\[\[?[^\[\]]+\]%', $element ) ) {
				$element = preg_replace_callback( "/$pattern/", 'do_shortcode_tag', $element );
			}

			// Looks like we found some crazy unfiltered HTML.  Skipping it for sanity.
			$element = strtr( $element, $trans );
			continue;
		}

		// Get element name
		$front = array_shift( $attributes );
		$back = array_pop( $attributes );
		$matches = array();
		preg_match('%[a-zA-Z0-9]+%', $front, $matches);
		$elname = $matches[0];

		// Look for shortcodes in each attribute separately.
		foreach ( $attributes as &$attr ) {
			$open = strpos( $attr, '[' );
			$close = strpos( $attr, ']' );
			if ( false === $open || false === $close ) {
				continue; // Go to next attribute.  Square braces will be escaped at end of loop.
			}
			$double = strpos( $attr, '"' );
			$single = strpos( $attr, "'" );
			if ( ( false === $single || $open < $single ) && ( false === $double || $open < $double ) ) {
				// $attr like '[shortcode]' or 'name = [shortcode]' implies unfiltered_html.
				// In this specific situation we assume KSES did not run because the input
				// was written by an administrator, so we should avoid changing the output
				// and we do not need to run KSES here.
				$attr = preg_replace_callback( "/$pattern/", 'do_shortcode_tag', $attr );
			} else {
				// $attr like 'name = "[shortcode]"' or "name = '[shortcode]'"
				// We do not know if $content was unfiltered. Assume KSES ran before shortcodes.
				$count = 0;
				$new_attr = preg_replace_callback( "/$pattern/", 'do_shortcode_tag', $attr, -1, $count );
				if ( $count > 0 ) {
					// Sanitize the shortcode output using KSES.
					$new_attr = wp_kses_one_attr( $new_attr, $elname );
					if ( '' !== trim( $new_attr ) ) {
						// The shortcode is safe to use now.
						$attr = $new_attr;
					}
				}
			}
		}
		$element = $front . implode( '', $attributes ) . $back;

		// Now encode any remaining [ or ] chars.
		$element = strtr( $element, $trans );
	}

	$content = implode( '', $textarr );

	return $content;
}

function unescape_invalid_shortcodes( $content ) {
        // Clean up entire string, avoids re-parsing HTML.
        $trans = array( '&#91;' => '[', '&#93;' => ']' );
        $content = strtr( $content, $trans );

        return $content;
}

/**
 * Retrieve the shortcode attributes regex.
 *
 * @since 4.4.0
 *
 * @return string The shortcode attribute regular expression
 */
function get_shortcode_atts_regex() {
	return '/([\w-]+)\s*=\s*"([^"]*)"(?:\s|$)|([\w-]+)\s*=\s*\'([^\']*)\'(?:\s|$)|([\w-]+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
}

function shortcode_parse_atts($text) {
	$atts = array();
	$pattern = get_shortcode_atts_regex();
	$text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text);
	if ( preg_match_all($pattern, $text, $match, PREG_SET_ORDER) ) {
		foreach ($match as $m) {
			if (!empty($m[1]))
				$atts[strtolower($m[1])] = stripcslashes($m[2]);
			elseif (!empty($m[3]))
				$atts[strtolower($m[3])] = stripcslashes($m[4]);
			elseif (!empty($m[5]))
				$atts[strtolower($m[5])] = stripcslashes($m[6]);
			elseif (isset($m[7]) && strlen($m[7]))
				$atts[] = stripcslashes($m[7]);
			elseif (isset($m[8]))
				$atts[] = stripcslashes($m[8]);
		}

		// Reject any unclosed HTML elements
		foreach( $atts as &$value ) {
			if ( false !== strpos( $value, '<' ) ) {
				if ( 1 !== preg_match( '/^[^<]*+(?:<[^>]*+>[^<]*+)*+$/', $value ) ) {
					$value = '';
				}
			}
		}
	} else {
		$atts = ltrim($text);
	}
	return $atts;
}

function shortcode_atts( $pairs, $atts, $shortcode = '' ) {
	$atts = (array)$atts;
	$out = array();
	foreach ($pairs as $name => $default) {
		if ( array_key_exists($name, $atts) )
			$out[$name] = $atts[$name];
		else
			$out[$name] = $default;
	}
	
	if ( $shortcode ) {
		$out = apply_filters( "shortcode_atts_{$shortcode}", $out, $pairs, $atts, $shortcode );
	}

	return $out;
}

function strip_shortcodes( $content ) {
	global $shortcode_tags;

	if ( false === strpos( $content, '[' ) ) {
		return $content;
	}

	if (empty($shortcode_tags) || !is_array($shortcode_tags))
		return $content;

	// Find all registered tag names in $content.
	preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );

	$tags_to_remove = array_keys( $shortcode_tags );

	$tags_to_remove = apply_filters( 'strip_shortcodes_tagnames', $tags_to_remove, $content );

	$tagnames = array_intersect( $tags_to_remove, $matches[1] );

	if ( empty( $tagnames ) ) {
		return $content;
	}

	$content = do_shortcodes_in_html_tags( $content, true, $tagnames );

	$pattern = get_shortcode_regex( $tagnames );
	$content = preg_replace_callback( "/$pattern/", 'strip_shortcode_tag', $content );

	// Always restore square braces so we don't break things like <!--[if IE ]>
	$content = unescape_invalid_shortcodes( $content );

	return $content;
}

function strip_shortcode_tag( $m ) {
	// allow [[foo]] syntax for escaping a tag
	if ( $m[1] == '[' && $m[6] == ']' ) {
		return substr($m[0], 1, -1);
	}

	return $m[1] . $m[6];
}
/**formatting**/
function wp_html_split( $input ) {
	return preg_split( get_html_split_regex(), $input, -1, PREG_SPLIT_DELIM_CAPTURE );
}
function get_html_split_regex() {
	static $regex;

	if ( ! isset( $regex ) ) {
		$comments =
			  '!'           // Start of comment, after the <.
			. '(?:'         // Unroll the loop: Consume everything until --> is found.
			.     '-(?!->)' // Dash not followed by end of comment.
			.     '[^\-]*+' // Consume non-dashes.
			. ')*+'         // Loop possessively.
			. '(?:-->)?';   // End of comment. If not found, match all input.

		$cdata =
			  '!\[CDATA\['  // Start of comment, after the <.
			. '[^\]]*+'     // Consume non-].
			. '(?:'         // Unroll the loop: Consume everything until ]]> is found.
			.     '](?!]>)' // One ] not followed by end of comment.
			.     '[^\]]*+' // Consume non-].
			. ')*+'         // Loop possessively.
			. '(?:]]>)?';   // End of comment. If not found, match all input.

		$escaped =
			  '(?='           // Is the element escaped?
			.    '!--'
			. '|'
			.    '!\[CDATA\['
			. ')'
			. '(?(?=!-)'      // If yes, which type?
			.     $comments
			. '|'
			.     $cdata
			. ')';

		$regex =
			  '/('              // Capture the entire match.
			.     '<'           // Find start of element.
			.     '(?'          // Conditional expression follows.
			.         $escaped  // Find end of escaped element.
			.     '|'           // ... else ...
			.         '[^>]*>?' // Find end of normal element.
			.     ')'
			. ')/';
	}

	return $regex;
}
function _wp_specialchars( $string, $quote_style = ENT_NOQUOTES, $charset = false, $double_encode = false ) {
	$string = (string) $string;

	if ( 0 === strlen( $string ) )
		return '';

	// Don't bother if there are no specialchars - saves some processing
	if ( ! preg_match( '/[&<>"\']/', $string ) )
		return $string;

	// Account for the previous behaviour of the function when the $quote_style is not an accepted value
	if ( empty( $quote_style ) )
		$quote_style = ENT_NOQUOTES;
	elseif ( ! in_array( $quote_style, array( 0, 2, 3, 'single', 'double' ), true ) )
		$quote_style = ENT_QUOTES;

	// Store the site charset as a static to avoid multiple calls to wp_load_alloptions()
	if ( ! $charset ) {
		static $_charset = null;
		if ( ! isset( $_charset ) ) {
			$alloptions = wp_load_alloptions();
			$_charset = isset( $alloptions['blog_charset'] ) ? $alloptions['blog_charset'] : '';
		}
		$charset = $_charset;
	}

	if ( in_array( $charset, array( 'utf8', 'utf-8', 'UTF8' ) ) )
		$charset = 'UTF-8';

	$_quote_style = $quote_style;

	if ( $quote_style === 'double' ) {
		$quote_style = ENT_COMPAT;
		$_quote_style = ENT_COMPAT;
	} elseif ( $quote_style === 'single' ) {
		$quote_style = ENT_NOQUOTES;
	}

	if ( ! $double_encode ) {
		// Guarantee every &entity; is valid, convert &garbage; into &amp;garbage;
		// This is required for PHP < 5.4.0 because ENT_HTML401 flag is unavailable.
		//$string = wp_kses_normalize_entities( $string );
	}

	$string = @htmlspecialchars( $string, $quote_style, $charset, $double_encode );

	// Back-compat.
	if ( 'single' === $_quote_style )
		$string = str_replace( "'", '&#039;', $string );

	return $string;
}
function wp_check_invalid_utf8( $string, $strip = false ) {
	$string = (string) $string;

	if ( 0 === strlen( $string ) ) {
		return '';
	}

	// Store the site charset as a static to avoid multiple calls to get_option()
	static $is_utf8 = null;
	if ( ! isset( $is_utf8 ) ) {
		$is_utf8 = in_array( get_option( 'blog_charset' ), array( 'utf8', 'utf-8', 'UTF8', 'UTF-8' ) );
	}
	if ( ! $is_utf8 ) {
		return $string;
	}

	// Check for support for utf8 in the installed PCRE library once and store the result in a static
	static $utf8_pcre = null;
	if ( ! isset( $utf8_pcre ) ) {
		$utf8_pcre = @preg_match( '/^./u', 'a' );
	}
	// We can't demand utf8 in the PCRE installation, so just return the string in those cases
	if ( !$utf8_pcre ) {
		return $string;
	}

	// preg_match fails when it encounters invalid UTF8 in $string
	if ( 1 === @preg_match( '/^./us', $string ) ) {
		return $string;
	}

	// Attempt to strip the bad chars if requested (not recommended)
	if ( $strip && function_exists( 'iconv' ) ) {
		return iconv( 'utf-8', 'utf-8', $string );
	}

	return '';
}
?>