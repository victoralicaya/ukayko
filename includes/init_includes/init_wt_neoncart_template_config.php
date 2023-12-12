<?php
#WT_NEONCART_TEMPLATE_BASE#
if (!defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}

global $wt_menu, $wt_pimgldr, $template, $product_style, $current_page_base, $uploads_path, $homepage_version, $theme_layout_mode;

$wt_pimgldr = array();
if ( get_wt_neoncart_options( 'product_img_loader' ) ) {
	$wt_pimgldr['src'] = 'images/loader.svg';
	$wt_pimgldr['class'] = 'lazyload';
}

$uploads_path = DIR_WS_IMAGES . $template_dir . '/uploads/';

$homepage_version = get_wt_neoncart_options( 'homepage_version', 'homepage_v1' );
$theme_color = get_wt_neoncart_options( 'theme_color', '#2879fe' );
$theme_second_color = get_wt_neoncart_options( 'theme_second_color', '#2267d8' );
$general_font_family = get_wt_neoncart_options( 'general_font_family', 'Open Sans' );
$heading_font_family = get_wt_neoncart_options( 'heading_font_family', 'Oswald' );
$ban_heading_font_family = get_wt_neoncart_options( 'ban_heading_font_family', 'Poppins' );
$container_width = get_wt_neoncart_options( 'container_width', '1200px' );