<?php
#WT_NEONCART_TEMPLATE_BASE#
?>
<?php /************************** font settings start *****************************************/ ?>
<?php
$font_latin_charset_extended = get_wt_neoncart_options( 'font_latin_charset_extended' );
$font_custom_charset = get_wt_neoncart_options( 'font_custom_charset' );
$container_width = get_wt_neoncart_options( 'container_width', '1200px' );
$theme_color = get_wt_neoncart_options( 'theme_color', '#cc1414' );
$theme_second_color = get_wt_neoncart_options( 'theme_second_color', '#003d82' );
$new_lbl_color = get_wt_neoncart_options( 'new_lbl_color', '#cc1414' );
$sale_lbl_color = get_wt_neoncart_options( 'sale_lbl_color', '#0062bd' );
$font_sizes = ":ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900"; 
$charSubset = '';
if ( $font_latin_charset_extended ) { $charSubset .= ',latin-ext'; }
if ( !empty( $font_custom_charset ) ) { $charSubset .= ','.$font_custom_charset; }
$charSubset .= '&display=swap';
$head_font_family = array();
if ( !empty( $general_font_family ) ) {
	$head_font_family[] = $general_font_family . $font_sizes;
}
if ( !empty( $heading_font_family ) && !in_array( $heading_font_family, array( $general_font_family ) ) ) {
	$head_font_family[] = $heading_font_family . $font_sizes;
}
if ( !empty( $ban_heading_font_family ) && !in_array( $ban_heading_font_family, array( $general_font_family, $heading_font_family ) ) ) {
	$head_font_family[] = $ban_heading_font_family . $font_sizes;
}
if ( !empty( $head_font_family ) ) { ?>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=<?php echo str_replace( ' ', '+', implode( '&family=', $head_font_family ) ) . $charSubset;  ?>" crossorigin />
<?php } ?>
<?php
// Set Root Variables
$root_css = wt_output_css( array( ':root' => array(
	'--container-width' => $container_width,
	'--theme-color' => $theme_color,
	'--theme-scolor' => $theme_second_color,
	'--new-lblcolor' => $new_lbl_color,
	'--sale-lblcolor' => $sale_lbl_color,
	'--gfont-family' => $general_font_family,
	'--hfont-family' => $heading_font_family,
	'--bhfont-family' => $ban_heading_font_family,
) ) );
if( !empty( $root_css  ) ){ echo '<style>' . $root_css . '</style>'; }
?>
<?php /************************** font settings end *****************************************/ ?>