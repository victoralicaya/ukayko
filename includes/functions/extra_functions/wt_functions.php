<?php
#WT_NEONCART_TEMPLATE_BASE#

if ( ! function_exists( 'wt_boolean' ) ) {

	function wt_boolean( $val ) {
		return ( $val == false || $val == 'false' ) ? false : true;
	}
}

if ( ! function_exists( 'wt_stringify_atts' ) ) {

	function wt_stringify_atts( $attributes ) {

		if ( !empty( $attributes ) && is_array( $attributes ) ) { 
			$atts = array();
			
			foreach ( $attributes as $name => $value ) {
				if ( is_array( $value ) ) {
					$atts[] = $name . '="' . wt_stringify_classes( $value ) . '"';
				} else {
					$atts[] = $name . '="' . ( $value ) . '"';
				}
			}

			return implode( ' ', $atts );
		}
		return;
	}
}

if ( ! function_exists( 'wt_stringify_classes' ) ) {

	function wt_stringify_classes( $classes ) {
		
		if ( is_array($classes) ) {
			$classes = array_unique( $classes );
			$classes = ( trim( implode( ' ', $classes ) ) );
		}

		return $classes;
	}

}

if ( ! function_exists( 'wt_image' ) ) {

	function wt_image( $src, $alt = '', $width = '', $height = '', $parameters = '', $class = '' ) {
	
		global $template_dir, $zco_notifier, $wt_pimgldr;
		
		$place_src = 'images/loader.svg';
		/*if ( $place_type == 'product' ){
			$place_src = 'images/product-placeholder.png';
		} else if($place_type == 'news') {
			$place_src = 'images/blog/blog-placeholder.png';
		} else if($place_type == 'furniture-slider') {
			$place_src = 'images/furn-slide-placeholder.png';
		}*/

		// soft clean the alt tag
		$alt = zen_clean_html($alt);

		// use old method on template images
		if (strstr($src, 'includes/templates') || strstr($src, 'includes/languages') || PROPORTIONAL_IMAGES_STATUS == '0') {
		  return zen_image_OLD($src, $alt, $width, $height, $parameters);
		}

	//auto replace with defined missing image
		if ($src == DIR_WS_IMAGES and PRODUCTS_IMAGE_NO_IMAGE_STATUS == '1') {
		  $src = DIR_WS_IMAGES . PRODUCTS_IMAGE_NO_IMAGE;
		}

		if ( (empty($src) || ($src == DIR_WS_IMAGES)) && IMAGE_REQUIRED == 'false') {
		  return false;
		}

		// if not in current template switch to template_default
		if (!file_exists($src)) {
		  $src = str_replace(DIR_WS_TEMPLATES . $template_dir, DIR_WS_TEMPLATES . 'template_default', $src);
		}

		// hook for handle_image() function such as Image Handler etc
		if (function_exists('handle_image')) {
		  $newimg = handle_image($src, $alt, $width, $height, $parameters);
		  list($src, $alt, $width, $height, $parameters) = $newimg;
		  $zco_notifier->notify('NOTIFY_HANDLE_IMAGE', array($newimg));
		}

		$zco_notifier->notify('NOTIFY_OPTIMIZE_IMAGE', $template_dir, $src, $alt, $width, $height, $parameters);

		// Convert width/height to int for proper validation.
		// intval() used to support compatibility with plugins like image-handler
		$width = empty($width) ? $width : (int)$width;
		$height = empty($height) ? $height : (int)$height;

		// alt is added to the img tag even if it is null to prevent browsers from outputting
		// the image filename as default
		
		if ( !empty( $wt_pimgldr ) ) {
			$image = '<img src="' . $place_src . '" data-src="' . zen_output_string($src) . '" alt="' . zen_output_string($alt) . '"';
		} else {
			$image = '<img src="' . zen_output_string($src) . '" alt="' . zen_output_string($alt) . '"';
		}

		if (!empty($alt)) {
		  $image .= ' title="' . zen_output_string($alt) . '"';
		}

		if (CONFIG_CALCULATE_IMAGE_SIZE == 'true' && (empty($width) || empty($height))) {
		  if ($image_size = @getimagesize($src)) {
			if (empty($width) && !empty($height)) {
			  $ratio = $height / $image_size[1];
			  $width = $image_size[0] * $ratio;
			} elseif (!empty($width) && empty($height)) {
			  $ratio = $width / $image_size[0];
			  $height = $image_size[1] * $ratio;
			} elseif (empty($width) && empty($height)) {
			  $width = $image_size[0];
			  $height = $image_size[1];
			}
		  } elseif (IMAGE_REQUIRED == 'false') {
			return false;
		  }
		}
		

		if (!empty($width) && !empty($height) && file_exists($src)) {
		// proportional images
			  $image_size = @getimagesize($src);
			  // fix division by zero error
			  $ratio = ($image_size[0] != 0 ? $width / $image_size[0] : 1);
			  if ($image_size[1]*$ratio > $height) {
				$ratio = $height / $image_size[1];
				$width = $image_size[0] * $ratio;
			  } else {
				$height = $image_size[1] * $ratio;
			  }
		// only use proportional image when image is larger than proportional size
			  if ($image_size[0] < $width and $image_size[1] < $height) {
				$image .= ' width="' . $image_size[0] . '" height="' . (int)$image_size[1] . '"';
			  } else {
				$image .= ' width="' . round($width) . '" height="' . round($height) . '"';
			  }
			} else {
			   // override on missing image to allow for proportional and required/not required
			  if (IMAGE_REQUIRED == 'false') {
				return false;
			  } else if (substr($src, 0, 4) != 'http') {
				$image .= ' width="' . (int)SMALL_IMAGE_WIDTH . '" height="' . (int)SMALL_IMAGE_HEIGHT . '"';
			  }
			}

			// inject rollover class if one is defined. NOTE: This could end up with 2 "class" elements if $parameters contains "class" already.
			if (defined('IMAGE_ROLLOVER_CLASS') && IMAGE_ROLLOVER_CLASS != '') {
			  $parameters .= (!empty($parameters) ? ' ' : '') . 'class="rollover"';
			}
			// add $parameters to the tag output
			if (!empty($parameters)) $image .= ' ' . $parameters;

			$image .= '>';

		return $image;
	}
}

if ( ! function_exists( 'wt_cols_class' ) ) {
	
	function wt_cols_class( $d, $num ) {
		if ( empty( $num ) ) { return ; }
		$numcol = 12/$num;
		$class = '';
		if ( in_array( $num, array(1,2,3,4,6) ) ) {
			$class = 'col-' . $d . '-' . $numcol;
		} else if ( $num == 8 ) {
			$class='col-' . $d . '-pu-8';
		} else if ( $num == 7 ) {
			$class='col-' . $d . '-pu-7';
		} else if ( $num == 5 ) {
			$class='col-' . $d . '-pu-5';
		}
		$class = str_replace('xs-', '', $class);
		
		return $class;
	}
}

/**
 * Parse CSS
 */
if ( ! function_exists( 'wt_output_css' ) ) {

	/**
	 * Parse CSS
	 *
	 * Recursive function that generates from a a multidimensional array of CSS rules, a valid CSS string.
	 *
	 * @param array $rules
     *   An array of CSS rules in the form of:
	 *   array('selector'=>array('property' => 'value')). Also supports selector
	 *   nesting, e.g.,
	 *   array('selector' => array('selector'=>array('property' => 'value'))).
	 */
	function wt_output_css( $output_ar = array(), $min_width = '',  $max_width = '') {
		$css_output = $media_output = '';
		$indent = 0;
		$prefix = str_repeat('', $indent);
		if ( !empty( $output_ar ) ) {
			foreach ($output_ar as $key => $value) {
				if ( is_array( $value ) ) {
					$selector = $key;
					$properties = array_filter( $value, 'strlen' );
					if ( !empty( $properties ) ) {
						$css_output .= $prefix . "$selector {";
						$css_output .= $prefix . wt_output_css($properties);
						$css_output .= $prefix . "}";
					}
				} else {
					$property = $key;
					if ( $property != '' ) {
						$css_output .= $prefix . "$property: $value;";
					}
				}
			}

			if ( $css_output != '' && ( $min_width != '' || $max_width != '' ) ) {
				$media_output .= '@media';
				$media_output .= ( $min_width != '' ) ? '(min-width:' . $min_width . 'px)' : '';
				$media_output .= ( $min_width != '' && $max_width != '') ? ' and ' : '';
				$media_output .= ( $max_width != '' ) ? '(max-width:' . $max_width . 'px)' : '';
				$media_output .= '{' . $css_output . '}';
			} else {
				$media_output = $css_output;
			}
	
		}
	
		return $media_output;
	}
}

if ( !function_exists( 'wt_opt_chk_def_val' ) ) {
	
	function wt_opt_chk_def_val( $val = '', $def_val = '' ) {
		
		if ( $val != '' && $val == $def_val ) {
			return true;
		}
		return false;
	}
}