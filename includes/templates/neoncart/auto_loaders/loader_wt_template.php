<?php
#WT_NEONCART_TEMPLATE_BASE#
global $wt_menu, $wt_pimgldr, $template, $product_style, $current_page_base, $uploads_path, $homepage_version, $theme_layout_mode;

$current_page = $_GET['main_page'];
$loader_this_is_home_page = ($current_page=='index' && (!isset($_GET['cPath']) || $_GET['cPath'] == '') && (!isset($_GET['manufacturers_id']) || $_GET['manufacturers_id'] == '') && (!isset($_GET['typefilter']) || $_GET['typefilter'] == '') );
$t_array = array();
$t_array = array(
	'conditions' => array('pages' => array('*')),
	'css_files' => array(
		'bootstrap.min.css' => 100,
		'fontawesome.css' => 200,
		'animate.css' => 300,
		'slick.css' => 500,
		'slick-theme.css' => 600,
		'magnific-popup.css' => 700,
		'main_style.css' => 900,
		'wt_styles.css' => 1000,
		'user_custom_styles.css' => 1110,
	),
	'jscript_files' => array(
		'bootstrap.bundle.min.js' => 120,
		'slick.min.js' => 120,
		'isotope.pkgd.min.js' => 120,
		'imagesloaded.pkgd.min.js' => 120,
		'parallaxie.js' => 120,
		'wow.min.js' => 120,
		'jquery.magnific-popup.min.js' => 120,
		'bundle.js' => 1000,
		'wt_instantSearch.js' => 2140,
		'wt_scripts.js' => 2500,
	),
);

// RTL
if ( get_wt_neoncart_options( 'rtl_mode' ) )  {
	$t_array['css_files']['rtl.css'] = 1001;
}

if ( $current_page == 'product_info' ) {
	$prodinfo_image_effects = get_wt_neoncart_options( 'prodinfo_image_effects', 2 );
	if ( $prodinfo_image_effects == 'elevatezoom' ) {
		$t_array['jscript_files']['jquery.elevatezoom.js'] = 1000;
	} else if ( $prodinfo_image_effects == 'fotorama' ) {
		$t_array['css_files']['fotorama.css'] = -999;
		$t_array['jscript_files']['fotorama.js'] = 2120;
	} else if ( $prodinfo_image_effects == 'lightbox' ) {
		$t_array['css_files']['slimbox2/css/slimbox2.css'] = -999;
		$t_array['jscript_files']['slimbox2/js/slimbox2.js'] = 2120;
	}
}

// Product lazyload
if(!empty($wt_pimgldr)){
	$t_array['jscript_files']['jquery.lazy.min.js'] = 2150;
}

$loaders[] = $t_array;