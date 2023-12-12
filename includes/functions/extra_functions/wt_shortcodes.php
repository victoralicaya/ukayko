<?php 
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$wt_is_home = false;
function wt_neoncart_home_shortcode($homepage_html){
	global $template, $current_page_base, $db;
	$wt_is_home = true;
	require_once(DIR_FS_CATALOG . 'wt_includes/shortcodes.php');
	add_shortcode('wtsm_slideshow', 'wtsm_slideshow_shortcode');
	add_shortcode('main_page_text', 'define_main_page_shortcode');
	add_shortcode('main_page_categories', 'define_main_page_categories_shortcode');
	add_shortcode('categories', 'categories_shortcode');
	add_shortcode('products', 'products_shortcode');
	add_shortcode('testimonials', 'wt_testimonials_shortcode');
	add_shortcode('brands', 'wt_brands_shortcode');
	add_shortcode('brands_slider', 'wt_brands_slider_shortcode');
	add_shortcode('news_slider', 'wt_news_slider_shortcode');
	add_shortcode('sidebar_megamenu', 'wt_sidebar_megamenu_shortcode');
	add_shortcode('newsletter', 'wt_newsletter_cont_shortcode');
	add_shortcode('instagram', 'wt_instagram_feeds_shortcode');
	add_shortcode('wtwbm_slider', 'wt_template_banner_manager_shortcode');
	add_shortcode('googlemap_iframe', 'wt_googlemap_iframe_shortcode');
	$homepage_html = do_shortcode( $homepage_html );
	return $homepage_html;
}
global $product_slider_ar;

$product_slider_ar = array(
	'new_products' => 'tpl_modules_whats_new',
	'featured_products' => 'tpl_modules_featured_products',
	'best_sellers' => 'tpl_modules_best_sellers_reloaded',
	'upcoming_products' => 'tpl_modules_upcoming_products',
	'special_products' => 'tpl_modules_specials_default',
	'custom_products' => 'tpl_modules_custom_products',
	'category_products' => 'tpl_modules_category_products',
	'wt_dailydeals' => 'tpl_modules_wt_dailydeals_default',
	'wt_dailydeals_upcoming' => 'tpl_modules_wt_dailydeals_upcoming',
	'top_rated_products' => 'tpl_modules_top_rated_products',
	'tab_products' => 'tpl_modules_tab_products',
);

// WTSM Slideshow
function wtsm_slideshow_shortcode( $atts, $content ){
	global $template, $db, $current_page_base;
	$mod_html = '';
	if ( !empty( $atts ) ) {
		$wtsm_id = isset( $atts['id'] ) ? $atts['id'] : '';
		$slider_title = isset( $atts['title'] ) ? $atts['title'] : '';
		$params = isset( $atts['params'] ) ? $atts['params'] : '';
		$dots_positions = isset( $atts['dots_positions'] ) ? $atts['dots_positions'] : 'hor';
	}
	if ( $params ) {
		$params = str_replace(array('data-slick="{', '}"'), array("data-slick='{", "}'"), $params);
	}
	ob_start();
	include( $template->get_template_dir( 'tpl_wt_slideshow_manager.php', DIR_WS_TEMPLATE, $current_page_base, 'wtsm_templates' ) . '/tpl_wt_slideshow_manager.php' );
	$mod_html.= ob_get_contents();
	ob_end_clean();
	
	return $mod_html;
}


// Define main page text
function define_main_page_shortcode( $atts, $content ){
	global $template, $db, $current_page_base;
	$mod_html = '';
	if (DEFINE_MAIN_PAGE_STATUS >= 1 and DEFINE_MAIN_PAGE_STATUS <= 2) {
		$mod_html_file_path = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_MAIN_PAGE, 'false');
		if ( file_exists ( $mod_html_file_path ) ) {
			$mod_html .= html_entity_decode(file_get_contents($mod_html_file_path));
		}
	}
	
	return $mod_html;
}

// Main page display categories
function define_main_page_categories_shortcode( $atts, $content ){
	global $template, $db, $current_page_base, $zco_notifier;
	//require( $template->get_template_dir( 'tpl_wt_template_settings.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common') . '/tpl_wt_template_settings.php' );
	$mod_html = '';
	if (PRODUCT_LIST_CATEGORY_ROW_STATUS != 0) {
		/**
		 * require the code to display the sub-categories-grid, if any exist
		 */
		ob_start();
		require($template->get_template_dir('tpl_modules_category_row.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_category_row.php');
		$mod_html.= ob_get_contents();
		ob_end_clean();
	}
	
	return $mod_html;
}

// categories
function categories_shortcode( $atts, $content ){
	global $product_slider_ar, $template, $db, $current_page_base, $wt_display_style, $zco_notifier;
	if ( !empty( $atts ) ){
		$wt_content_type = 'categories';
		$type = isset( $atts['type'] ) ? $atts['type'] : '';
		$wt_display_style = isset( $atts['style'] ) ? $atts['style'] : 'slider';
		$slider_vertical = false;
		if ( in_array($wt_display_style, array('slider', 'tab_slider', 'single_item_slider', 'micro_promo_slider', 'single_big_slider', 'single_big_slider_box') ) ) {
			$wt_display_style = 'slider';
		} else if((in_array($wt_display_style, array('micro_list')))){
			$wt_display_style = 'list';
		} else if ( ( in_array( $wt_display_style, array( 'micro_slider', 'micro_ver_slider') ) ) ) {
			$wt_display_style = 'micro_slider';
		} else if ( ( in_array( $wt_display_style, array( 'micro_grid') ) ) ) {
			$wt_display_style = 'micro_grid';
		} else if ( ( in_array( $wt_display_style, array( 'micro_small_grid') ) ) ) {
			$wt_display_style = 'micro_small_grid';
		}
		
		if ( ( in_array( $wt_display_style, array( 'micro_ver_slider' ) ) ) ) {
			$slider_vertical = true;
		}

		$slider_title = isset( $atts['title'] ) ? $atts['title'] : '';
		$products_label = isset( $atts['products_label'] ) ? $atts['products_label'] : '';
		$title_position = isset( $atts['title_position'] ) ? $atts['title_position'] : '';
		$ids = isset( $atts['ids'] ) ? $atts['ids'] : '';
		$max_categories = isset( $atts['max_categories'] ) ? $atts['max_categories'] : '';
		$show_count_products = isset( $atts['show_count_products'] ) ? $atts['show_count_products'] : '';
		$show_xxl_columns = isset( $atts['show_xxl_columns'] ) ? $atts['show_xxl_columns'] : '';
		$show_xl_columns = isset( $atts['show_xl_columns'] ) ? $atts['show_xl_columns'] : '';
		$show_lg_columns = isset( $atts['show_lg_columns'] ) ? $atts['show_lg_columns'] : '';
		$show_md_columns = isset( $atts['show_md_columns'] ) ? $atts['show_md_columns'] : '';
		$show_sm_columns = isset( $atts['show_sm_columns'] ) ? $atts['show_sm_columns'] : '';
		$show_xs_columns = isset( $atts['show_xs_columns'] ) ? $atts['show_xs_columns'] : '';
		$show_rows = isset( $atts['show_rows'] ) ? $atts['show_rows'] : '1';
		$product_class = isset( $atts['product_class'] ) ? $atts['product_class'] : '';
		$arrows_class = isset( $atts['arrows_class'] ) ? $atts['arrows_class'] : 'arrow-location-right-top';
		ob_start();
		require( DIR_WS_MODULES . zen_get_module_directory('categories.php') );
		$mod_html = ob_get_contents();
		ob_end_clean();
	}
	return $mod_html;
}

// Slider shortcodes
function products_shortcode( $atts, $content ){
	global $product_slider_ar, $template, $db, $current_page_base, $wt_display_style, $zco_notifier;
	if ( !empty( $atts ) ){
		$wt_content_type = 'products';
		$type = isset( $atts['type'] ) ? $atts['type'] : '';
		$wt_display_style = isset( $atts['style'] ) ? $atts['style'] : 'slider';
		$slider_vertical = false;
		if ( in_array($wt_display_style, array('slider', 'tab_slider', 'single_item_slider', 'micro_promo_slider', 'single_big_slider', 'single_big_slider_box') ) ) {
			$wt_display_style = 'slider';
		} else if((in_array($wt_display_style, array('micro_list')))){
			$wt_display_style = 'list';
		} else if ( ( in_array( $wt_display_style, array( 'micro_slider', 'micro_ver_slider') ) ) ) {
			$wt_display_style = 'micro_slider';
		} else if ( ( in_array( $wt_display_style, array( 'micro_grid') ) ) ) {
			$wt_display_style = 'micro_grid';
		} else if ( ( in_array( $wt_display_style, array( 'micro_small_grid' ) ) ) ) {
			$wt_display_style = 'micro_small_grid';
		} else if ( ( in_array( $wt_display_style, array( 'micro_small_slider', 'micro_small_ver_slider' ) ) ) ) {
			$wt_display_style = 'micro_small_slider';
		}
		
		if ( ( in_array( $wt_display_style, array( 'micro_ver_slider' ) ) ) ) {
			$slider_vertical = true;
		}

		$slider_title = isset( $atts['title'] ) ? $atts['title'] : '';
		$title_position = isset( $atts['title_position'] ) ? $atts['title_position'] : '';
		$category = isset( $atts['category'] ) ? $atts['category'] : '';
		$products_list = isset( $atts['products'] ) ? $atts['products'] : '';
		$max_products = isset( $atts['max_products'] ) ? $atts['max_products'] : '';
		$show_xxl_columns = isset( $atts['show_xxl_columns'] ) ? $atts['show_xxl_columns'] : '';
		$show_xl_columns = isset( $atts['show_xl_columns'] ) ? $atts['show_xl_columns'] : '';
		$show_lg_columns = isset( $atts['show_lg_columns'] ) ? $atts['show_lg_columns'] : '';
		$show_md_columns = isset( $atts['show_md_columns'] ) ? $atts['show_md_columns'] : '';
		$show_sm_columns = isset( $atts['show_sm_columns'] ) ? $atts['show_sm_columns'] : '';
		$show_xs_columns = isset( $atts['show_xs_columns'] ) ? $atts['show_xs_columns'] : '';
		$show_rows = isset( $atts['show_rows'] ) ? $atts['show_rows'] : '1';
		$product_class = isset( $atts['product_class'] ) ? $atts['product_class'] : '';
		$arrows_class = isset( $atts['arrows_class'] ) ? $atts['arrows_class'] : 'arrow-location-right-top';
		if ( array_key_exists( $type, $product_slider_ar ) ){
			ob_start();
			include( $template->get_template_dir( $product_slider_ar[$type].'.php', DIR_WS_TEMPLATE, $current_page_base, 'templates' ) . '/' . $product_slider_ar[$type].'.php' );
			$mod_html = ob_get_contents();
			ob_end_clean();
		}
	}
	return $mod_html;
}

// Testimonials Manager
function wt_testimonials_shortcode( $atts, $content ){
	global $product_slider_ar, $template, $db, $current_page_base, $wt_display_style;
	if ( !empty( $atts ) ) {
		$wt_content_type = 'testimonials';
		$wt_display_style = isset( $atts['style'] ) ? $atts['style'] : 'slider';
		$slider_title = isset( $atts['title'] ) ? $atts['title'] : '';
		$title_position = isset( $atts['title_position'] ) ? $atts['title_position'] : '';
		$max_testimonials = isset( $atts['max_testimonials'] ) ? $atts['max_testimonials'] : '';
		$show_xxl_columns = isset( $atts['show_xxl_columns'] ) ? $atts['show_xxl_columns'] : '';
		$show_xl_columns = isset( $atts['show_xl_columns'] ) ? $atts['show_xl_columns'] : '';
		$show_lg_columns = isset( $atts['show_lg_columns'] ) ? $atts['show_lg_columns'] : '';
		$show_md_columns = isset( $atts['show_md_columns'] ) ? $atts['show_md_columns'] : '';
		$show_sm_columns = isset( $atts['show_sm_columns'] ) ? $atts['show_sm_columns'] : '';
		$show_xs_columns = isset( $atts['show_xs_columns'] ) ? $atts['show_xs_columns'] : '';
		$arrows_class = isset( $atts['arrows_class'] ) ? $atts['arrows_class'] : 'arrow-location-right-top';
	}
	ob_start();
	include( $template->get_template_dir( 'tpl_wt_testimonials.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common'). '/tpl_wt_testimonials.php' );
	$mod_html = ob_get_contents();
	ob_end_clean();
	
	return $mod_html;
}

// Brands
function wt_brands_shortcode( $atts, $content ){
	global $product_slider_ar, $template, $db, $current_page_base, $wt_display_style;
	if ( !empty( $atts ) ) {
		$wt_content_type = 'brands';
		$wt_display_style = isset( $atts['style'] ) ? $atts['style'] : 'slider';
		$slider_title = isset( $atts['title'] ) ? $atts['title'] : '';
		$title_position = isset( $atts['title_position'] ) ? $atts['title_position'] : '';
		$max_brands = isset( $atts['max_brands'] ) ? $atts['max_brands'] : '';
		$show_xxl_columns = isset( $atts['show_xxl_columns'] ) ? $atts['show_xxl_columns'] : '';
		$show_xl_columns = isset( $atts['show_xl_columns'] ) ? $atts['show_xl_columns'] : '';
		$show_lg_columns = isset( $atts['show_lg_columns'] ) ? $atts['show_lg_columns'] : '';
		$show_md_columns = isset( $atts['show_md_columns'] ) ? $atts['show_md_columns'] : '';
		$show_sm_columns = isset( $atts['show_sm_columns'] ) ? $atts['show_sm_columns'] : '';
		$show_xs_columns = isset( $atts['show_xs_columns'] ) ? $atts['show_xs_columns'] : '';
		$arrows_class = isset( $atts['arrows_class'] ) ? $atts['arrows_class'] : 'arrow-location-right-top';
	}
	ob_start();
	include( $template->get_template_dir( 'tpl_wt_brands.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common' ). '/tpl_wt_brands.php' );
	$mod_html = ob_get_contents();
	ob_end_clean();
	
	return $mod_html;
}

// Brands Slider
function wt_brands_slider_shortcode( $atts, $content ) {
	
	global $template, $db, $current_page_base;
	if ( !empty( $atts ) ) {
		$wt_content_type = 'brands';
		$slider_title = isset( $atts['title'] ) ? $atts['title'] : '';
		$title_position = isset( $atts['title_position'] ) ? $atts['title_position'] : '';
		$wt_display_style = isset( $atts['style'] ) ? $atts['style'] : 'slider';
		$arrows_style = isset( $atts['arrows_style'] ) ? $atts['arrows_style'] : '';
		$max_brands = isset( $atts['max_brands'] ) ? $atts['max_brands'] : '';
		$show_xxl_columns = isset( $atts['show_xxl_columns'] ) ? $atts['show_xxl_columns'] : '';
		$show_xl_columns = isset( $atts['show_xl_columns'] ) ? $atts['show_xl_columns'] : '';
		$show_lg_columns = isset( $atts['show_lg_columns'] ) ? $atts['show_lg_columns'] : '';
		$show_md_columns = isset( $atts['show_md_columns'] ) ? $atts['show_md_columns'] : '';
		$show_sm_columns = isset( $atts['show_sm_columns'] ) ? $atts['show_sm_columns'] : '';
		$show_xs_columns = isset( $atts['show_xs_columns'] ) ? $atts['show_xs_columns'] : '';
	}
	ob_start();
	include( $template->get_template_dir( 'tpl_wt_brands.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common' ). '/tpl_wt_brands.php' );
	$mod_html = ob_get_contents();
	ob_end_clean();
	
	return $mod_html;
}

// NewsBox Manager
function wt_news_slider_shortcode( $atts, $content ) {
	
	global $template, $db, $current_page_base;
	if ( !empty( $atts ) ) {
		$wt_content_type = 'news';
		$slider_title = isset( $atts['title'] ) ? $atts['title'] : '';
		$title_position = isset( $atts['title_position'] ) ? $atts['title_position'] : '';
		$wt_display_style = isset( $atts['style'] ) ? $atts['style'] : 'slider';
		$arrows_style = isset( $atts['arrows_style'] ) ? $atts['arrows_style'] : '';
		$max_news = isset( $atts['max_news'] ) ? $atts['max_news'] : '';
		$show_xxl_columns = isset( $atts['show_xxl_columns'] ) ? $atts['show_xxl_columns'] : '';
		$show_xl_columns = isset( $atts['show_xl_columns'] ) ? $atts['show_xl_columns'] : '';
		$show_lg_columns = isset( $atts['show_lg_columns'] ) ? $atts['show_lg_columns'] : '3';
		$show_md_columns = isset( $atts['show_md_columns'] ) ? $atts['show_md_columns'] : '2';
		$show_sm_columns = isset( $atts['show_sm_columns'] ) ? $atts['show_sm_columns'] : '2';
		$show_xs_columns = isset( $atts['show_xs_columns'] ) ? $atts['show_xs_columns'] : '1';
	}
	ob_start();
	include( $template->get_template_dir( 'tpl_modules_news_box_format.php',DIR_WS_TEMPLATE, $current_page_base, 'templates'). '/tpl_modules_news_box_format.php' );
	$mod_html = ob_get_contents();
	ob_end_clean();
	
	return $mod_html;
}

// Sidebar Megamenu
function wt_sidebar_megamenu_shortcode( $atts, $content ){
	global $product_slider_ar, $template, $db, $current_page_base, $zco_notifier, $sniffer;
	ob_start();
	include( $template->get_template_dir('tpl_sidebar_menu.php', DIR_WS_TEMPLATE, $current_page_base,'common/objects'). '/tpl_sidebar_menu.php' );
	$mod_html = ob_get_contents();
	ob_end_clean();
	
	return $mod_html;
}

//Newsletter content
function wt_newsletter_cont_shortcode( $atts, $content ){
	global $product_slider_ar, $template, $db, $current_page_base;
	$mod_html = htmlspecialchars_decode(stripslashes(get_wt_neoncart_options('newsletter_details')));
	
	return $mod_html;
}

// Instagram Feeds
function wt_instagram_feeds_shortcode( $atts, $content ){
	global $product_slider_ar, $template, $db, $current_page_base;
	ob_start();
	include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_INSTAGRAM_FEED, 'false');
	$mod_html = ob_get_contents();
	ob_end_clean();
	return $mod_html;
}

// Banner Manager slider
function wt_template_banner_manager_shortcode($atts, $content) {
	global $product_slider_ar, $template, $db, $current_page_base;
	if(!empty($atts)){
		$wtwbm_id = isset( $atts['id'] ) ? $atts['id'] : '';
		$slider_title = isset( $atts['title'] ) ? $atts['title'] : '';
		$title_position = isset( $atts['title_position'] ) ? $atts['title_position'] : '';
		$wt_display_style = isset( $atts['style'] ) ? $atts['style'] : 'slider';
		$type = isset( $atts['type'] ) ? $atts['type'] : '';
		$max_brands = isset( $atts['max_brands'] ) ? $atts['max_brands'] : '';
		$show_xxl_columns = isset( $atts['show_xxl_columns'] ) ? $atts['show_xxl_columns'] : '';
		$show_xl_columns = isset( $atts['show_xl_columns'] ) ? $atts['show_xl_columns'] : '';
		$show_lg_columns = isset( $atts['show_lg_columns'] ) ? $atts['show_lg_columns'] : '';
		$show_md_columns = isset( $atts['show_md_columns'] ) ? $atts['show_md_columns'] : '';
		$show_sm_columns = isset( $atts['show_sm_columns'] ) ? $atts['show_sm_columns'] : '';
		$show_xs_columns = isset( $atts['show_xs_columns'] ) ? $atts['show_xs_columns'] : '';
	}
	ob_start();
	include( $template->get_template_dir( 'tpl_wt_template_banner_manager.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common' ). '/tpl_wt_template_banner_manager.php' );
	$mod_html = ob_get_contents();
	ob_end_clean();
	
	return $mod_html;
}

// Googlemap Iframe
function wt_googlemap_iframe_shortcode($atts, $content){
	$store_map = htmlspecialchars_decode(stripslashes(get_wt_neoncart_options('google_map')));
	if($store_map){
		$mod_html = $store_map;
	}
	return $mod_html;
}