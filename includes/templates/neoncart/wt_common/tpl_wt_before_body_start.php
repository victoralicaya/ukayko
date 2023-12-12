<?php
#WT_NEONCART_TEMPLATE_BASE#

global $wt_gl_config;
if (!isset($flag_disable_left)) {
    $flag_disable_left = false;
}
if (!isset($flag_disable_right)) {
$flag_disable_right = false;
}
require( $template->get_template_dir( 'tpl_wt_template_settings.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common'). '/tpl_wt_template_settings.php' );

/*if ( file_exists( $template->get_template_dir( 'tpl_wt_demo_config_settings.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common' ). '/tpl_wt_demo_config_settings.php' ) ) {
	require( $template->get_template_dir( 'tpl_wt_demo_config_settings.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common' ) . '/tpl_wt_demo_config_settings.php' );
}*/

$page_layout = '';
if ( $this_is_home_page ) {
	$page_layout = $homepage_page_layout;
} else if ( $current_page_base == 'index' && !empty( $_GET['cPath'] ) && $category_depth == 'nested' ) {
	$page_layout = $cat_page_layout;
} else if ( ( $current_page_base == 'index' && !empty( $_GET['cPath'] ) && $category_depth == 'products' ) || ( $current_page_base == 'index' && !empty( $_GET['manufacturers_id'] ) ) || in_array( $current_page_base, array( 'specials', 'featured_products', 'products_new', 'products_all', 'advanced_search_result', 'advanced_search', 'product_reviews_write', 'reviews', 'product_reviews', 'product_reviews_info' ) ) ) {
	$page_layout = $prodlist_page_layout;
} else if ( $current_page_base == 'product_info' ) {
	$page_layout = $prodinfo_page_layout;
} else if ( in_array( $current_page_base , array( 'create_account', 'compare', 'shopping_cart', 'contact_us','down_for_maintenance', 'login','page_not_found','logoff' ) ) ){
	$page_layout = '1column';
} else if ( in_array( $current_page_base , array('create_account_success','account','account_history','account_history_info','account_edit','address_book','address_book_process','account_password','account_newsletters','account_notifications','checkout_shipping_address','checkout_payment','checkout_shipping','checkout_payment_address','checkout_confirmation','checkout_success','time_out','wishlist','wishlist_email','wishlist_find','wishlists','wishlist_edit','wishlist_move','news_archive','more_news','testimonials_manager','display_all_testimonials','testimonials_add','password_forgotten','manufacturers_all','gv_faq','gv_redeem','discount_coupon','gv_send') ) ) {
	$page_layout = '2columns-right';
} else {
	$page_layout = $general_page_layout;
}

if ( $flag_disable_left == false && $flag_disable_right == false ) {
	if ( $page_layout == '2columns-left' ) {
		$flag_disable_left = false;
		$flag_disable_right = true;
	} else if ($page_layout == '2columns-right' ) {
		$flag_disable_left = true;
		$flag_disable_right = false;
	} else if ( $page_layout == '3columns' ) {
		$flag_disable_left = false;
		$flag_disable_right = false;
	} else if ( $page_layout == '1column' ) {
		$flag_disable_left = true;
		$flag_disable_right = true;
	}
}
$is_checkout_page = false;
$ck_right_cols_class = $ck_main_cols_class = '';
if(in_array($current_page_base ,array('checkout_shipping_address','checkout_payment','checkout_shipping','checkout_payment_address','checkout_confirmation'))){
	$is_checkout_page = true;
	$ck_right_cols_class = 'col-md-4 mt-2 mt-md-5';
	$ck_main_cols_class = 'col-md-8';
}
