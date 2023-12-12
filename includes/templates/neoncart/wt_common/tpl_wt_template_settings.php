<?php
#WT_NEONCART_TEMPLATE_BASE#

global $uploads_path, $homepage_version;

$class_name = '';

/* ------------------------------------------------------ Home Page ----------------------------------------------------- */

$body_classes = array();
$body_classes[] = str_replace( 'homepage_',' hm-',$homepage_version);
$body_classes[] = ( get_wt_neoncart_options( 'rtl_mode' ) == 1) ? ' rtl' : '';
$body_classes[] = ( $this_is_home_page ) ? ' home-page is-dropdn-click has-slider' : ' in-page';
$body_classes[] = (in_array($homepage_version, array( 'homepage_v11' ))) ? ' fullwidth fullpage-layout' : '';
if( in_array( $homepage_version, array( 'homepage_v3' ) ) ) {
	$body_classes[] = 'home_fashion_minimal';
} else if( in_array( $homepage_version, array( 'homepage_v3' ) ) ) {
	$body_classes[] = 'home_classic_ecommerce';
} else {
	$body_classes[] = 'home_supermarket';
}

$homepage_page_layout = (get_wt_neoncart_options( 'homepage_page_layout' )) ? get_wt_neoncart_options( 'homepage_page_layout' ) : '1column';

/* ------------------------------------------------------ Main Page Wrapper ----------------------------------------------------- */
$main_page_wrap_attr = array();
$main_page_wrap_attr['id'] = ( $this_is_home_page ) ? 'tt-bodyContent' : 'tt-pageContent';
$main_page_wrap_attr['class'] = array( 'body-content' );
if ( !in_array( $homepage_version, array( 'homepage_v1' ) ) ) {
	//$main_page_wrap_attr['class'][] = 'mt-4';
}

$page_wrap_attr = array();
$page_wrap_attr['id'] = ( $this_is_home_page ) ? 'tt-pageContent' : 'center-page-content';
$page_wrap_attr['class'] = array( 'content-indent', 'page-main' );
if ( $current_page_base == 'product_info' ) {
	
} else {
	$page_wrap_attr['class'][] = 'form-default';
}

/* ------------------------------------------------------ General Settings ----------------------------------------------------- */

$general_page_layout = get_wt_neoncart_options( 'general_page_layout', '2columns-right' );

$menutype = get_wt_neoncart_options( 'menu_type', 'simple' );
$services_content = (get_wt_neoncart_options( 'services_content' )!='' ) ? get_wt_neoncart_options( 'services_content' ) : '';

$header_template = get_wt_neoncart_options( 'header_style', 'tpl_header_v1' ); 

$flag_is_grid = $flag_products_grid_layouts = true;
if(((isset($_GET['view'])) && ($_GET['view']=='rows' )) || (PRODUCT_LISTING_LAYOUT_STYLE=='rows' && (!isset($_GET['view'])))){
	$flag_is_grid = false;
}

$header_store_contact = get_wt_neoncart_options( 'header_store_contact' );
$header_store_email = get_wt_neoncart_options( 'header_store_email' );
$header_store_time = get_wt_neoncart_options( 'header_store_time' );


$file_logo = get_wt_neoncart_options( 'file_logo', 'logo.png' );
$file_favicon = get_wt_neoncart_options( 'file_favicon' );
$footer_logo = get_wt_neoncart_options( 'footer_logo' );
$footer_layout = get_wt_neoncart_options( 'footer_layout', 'footer_v1' );

$minicart_style = (get_wt_neoncart_options( 'minicart_style' )) ? get_wt_neoncart_options( 'minicart_style' ) : 'flyout';
$payment_image = get_wt_neoncart_options( 'payment_image' );

/* ------------------------------------------------------ TopBar ----------------------------------------------------- */
$display_promo_topbar = get_wt_neoncart_options( 'display_promo_topbar' );
$promo_topbar_content = htmlspecialchars_decode( stripslashes( get_wt_neoncart_options( 'promo_topbar_content', '', $_SESSION['languages_id']) ) );

/* ------------------------------------------------------ Header ----------------------------------------------------- */
$shipping_content = htmlspecialchars_decode( stripslashes( get_wt_neoncart_options( 'topbar_shipping_content', '', $_SESSION['languages_id'] ) ) );

/* ------------------------------------------------------ Instagram ----------------------------------------------------- */

$display_instagramfeed = (get_wt_neoncart_options( 'display_instagramfeed' )!='' ) ? get_wt_neoncart_options( 'display_instagramfeed' ) : 1 ;
$instafeed_user_id = (get_wt_neoncart_options( 'instafeed_user_id' )!='' ) ? get_wt_neoncart_options( 'instafeed_user_id' ) : '' ;
$instafeed_client_id = (get_wt_neoncart_options( 'instafeed_client_id' )!='' ) ? get_wt_neoncart_options( 'instafeed_client_id' ) : '' ;
$instafeed_access_token = (get_wt_neoncart_options( 'instafeed_access_token' )!='' ) ? get_wt_neoncart_options( 'instafeed_access_token' ) : '' ;
$instafeed_content =  htmlspecialchars_decode( stripslashes( get_wt_neoncart_options( 'instafeed_content' ) ) );

/* ------------------------------------------------------ Compare ----------------------------------------------------- */
if ( COMPARE_VALUE_COUNT > 0 ) {
	define( 'COMPARE_MODULE_ENABLED', true);
} else {
	define( 'COMPARE_MODULE_ENABLED', false);
}

/* ------------------------------------------------------ Social Links ----------------------------------------------------- */

$facebook_link = get_wt_neoncart_options( 'facebook_link' );
$twitter_link = get_wt_neoncart_options( 'twitter_link' );
$pinterest_link = get_wt_neoncart_options( 'pinterest_link' );
$instagram_link = get_wt_neoncart_options( 'instagram_link' );

/* ------------------------------------------------------ Categories ----------------------------------------------------- */

$cat_page_layout = get_wt_neoncart_options( 'cat_page_layout', '2columns-left' );
$cat_grid_style = get_wt_neoncart_options( 'cat_grid_style', 2 );

if ( ( $current_page_base == 'index' && ( isset( $_GET['cPath'] ) && $_GET['cPath'] != '' ) && $category_depth == 'nested' ) ) {
	$show_rows = 1;
	$catslide_col_xxl = get_wt_neoncart_options( 'catslide_col_xxl', 3 );
	$catslide_col_xl = get_wt_neoncart_options( 'catslide_col_xl', 3 );
	$catslide_col_lg = get_wt_neoncart_options( 'catslide_col_lg', 3 );
	$catslide_col_md = get_wt_neoncart_options( 'catslide_col_md', 3 );
	$catslide_col_sm = get_wt_neoncart_options( 'catslide_col_sm', 2 );
	$catslide_col_xs = get_wt_neoncart_options( 'catslide_col_xs', 3 );

	$show_xxl_columns = ( $catslide_col_xxl ) ? $catslide_col_xxl : '';
	$show_xl_columns = ( $catslide_col_xl ) ? $catslide_col_xl : '';
	$show_lg_columns = ( $catslide_col_lg ) ? $catslide_col_lg : '';
	$show_md_columns = ( $catslide_col_md ) ? $catslide_col_md : '';
	$show_sm_columns = ( $catslide_col_sm ) ? $catslide_col_sm : '';
	$show_xs_columns = ( $catslide_col_xs ) ? $catslide_col_xs : '';
}
/* ------------------------------------------------------ Product List ----------------------------------------------------- */

$prodlist_page_layout = get_wt_neoncart_options( 'prodlist_page_layout', '2columns-left' );

$prodgrid_col_xxl = get_wt_neoncart_options( 'prodgrid_col_xxl', 4 );
$prodgrid_col_xl = get_wt_neoncart_options( 'prodgrid_col_xl', 4 );
$prodgrid_col_lg = get_wt_neoncart_options( 'prodgrid_col_lg', 4 );
$prodgrid_col_md = get_wt_neoncart_options( 'prodgrid_col_md', 3 );
$prodgrid_col_sm = get_wt_neoncart_options( 'prodgrid_col_sm', 2 );
$prodgrid_col_xs = get_wt_neoncart_options( 'prodgrid_col_xs', 2 );

if ( ( $current_page_base == 'index' && ( isset( $_GET['cPath'] ) && $_GET['cPath'] != '' ) && $category_depth == 'products' ) || ( $current_page_base == 'index' and ( !empty( $_GET['manufacturers_id'] ) ) ) || in_array($current_page_base, array( 'specials', 'featured_products', 'products_new', 'products_all', 'search_result' ) ) ) {
	$show_rows = 1;
	$show_xxl_columns = ( $catslide_col_xxl ) ? $catslide_col_xxl : '';
	$show_xl_columns = ( $catslide_col_xl ) ? $catslide_col_xl : '';
	$show_lg_columns = ( $prodgrid_col_lg ) ? $prodgrid_col_lg : '';
	$show_md_columns = ( $prodgrid_col_md ) ? $prodgrid_col_md : '';
	$show_sm_columns = ( $prodgrid_col_sm ) ? $prodgrid_col_sm : '';
	$show_xs_columns = ( $prodgrid_col_xs ) ? $prodgrid_col_xs : '';
}

/* ------------------------------------------------------ General Product Slider ----------------------------------------------------- */

if ( in_array($current_page_base, array( 'shopping_cart' ) ) ) {
	$show_rows = 1;
	$prodgrid_col_xxl = get_wt_neoncart_options( 'prod_slider_col_xxl', 4 );
	$prodgrid_col_xl = get_wt_neoncart_options( 'prod_slider_col_xl', 4 );
	$prodgrid_col_lg = get_wt_neoncart_options( 'prod_slider_col_lg', 4 );
	$prodgrid_col_md = get_wt_neoncart_options( 'prod_slider_col_md', 3 );
	$prodgrid_col_sm = get_wt_neoncart_options( 'prod_slider_col_sm', 2 );
	$prodgrid_col_xs = get_wt_neoncart_options( 'prod_slider_col_xs', 2 );
	
	$show_xxl_columns = ( $catslide_col_xxl ) ? $catslide_col_xxl : '';
	$show_xl_columns = ( $catslide_col_xl ) ? $catslide_col_xl : '';
	$show_lg_columns = ( $prodgrid_col_lg ) ? $prodgrid_col_lg : '';
	$show_md_columns = ( $prodgrid_col_md ) ? $prodgrid_col_md : '';
	$show_sm_columns = ( $prodgrid_col_sm ) ? $prodgrid_col_sm : '';
	$show_xs_columns = ( $prodgrid_col_xs ) ? $prodgrid_col_xs : '';

}

/* ------------------------------------------------------ Product Info ----------------------------------------------------- */

$prod_info_img_class = $prod_info_content_class = '';
$prodinfo_page_layout = get_wt_neoncart_options( 'prodinfo_page_layout', '2columns-right' );
$display_prod_short_desc = get_wt_neoncart_options( 'display_prod_short_desc', 1 );
$prod_img_layout = get_wt_neoncart_options( 'prod_img_layout', 'medium' );
if ( $prod_img_layout == 'medium' ) {
	$prod_info_img_class = 'col-md-4 col-sm-6 col-12 ';
	$prod_info_content_class = 'col-md-8 col-sm-6 col-12';
} else if ( $prod_img_layout == 'small' ) {
	$prod_info_img_class = 'col-md-3 col-sm-6 col-12 ';
	$prod_info_content_class = 'col-md-9 col-sm-6 col-12';
} else {
	$prod_info_img_class = 'col-sm-6 col-12';
	$prod_info_content_class = 'col-sm-6 col-12';
}

$prodinfo_image_effects = 'default';
if ( $current_page_base == 'product_info' ) {
	$prodinfo_image_effects = get_wt_neoncart_options( 'prodinfo_image_effects', 'default' );
	$prod_info_img_class .= ' img-efct-' . $prodinfo_image_effects;
	$elevatezoom_style = get_wt_neoncart_options( 'elevatezoom_style', 'default' );
	$prodinfo_col_xxl =($prodinfo_col_xxl = get_wt_neoncart_options( 'prodinfo_col_xxl' ))? $prodinfo_col_xxl : 4;
	$prodinfo_col_xl =($prodinfo_col_xl = get_wt_neoncart_options( 'prodinfo_col_xl' ))? $prodinfo_col_xl : 4;
	$prodinfo_col_lg =($prodinfo_col_lg = get_wt_neoncart_options( 'prodinfo_col_lg' ))? $prodinfo_col_lg : 4;
	$prodinfo_col_md =($prodinfo_col_md = get_wt_neoncart_options( 'prodinfo_col_md' ))? $prodinfo_col_md : 3;
	$prodinfo_col_sm =($prodinfo_col_sm = get_wt_neoncart_options( 'prodinfo_col_sm' ))? $prodinfo_col_sm : 2;
	$prodinfo_col_xs =($prodinfo_col_xs = get_wt_neoncart_options( 'prodinfo_col_xs' ))? $prodinfo_col_xs : 2;
	$show_lg_columns = ($prodinfo_col_lg) ? $prodinfo_col_lg : '';
	$show_md_columns = ($prodinfo_col_md) ? $prodinfo_col_md : '';
	$show_sm_columns = ($prodinfo_col_sm) ? $prodinfo_col_sm : '';
	$show_xs_columns = ($prodinfo_col_xs) ? $prodinfo_col_xs : '';
}

/* ------------------------------------------------------ Contact ----------------------------------------------------- */

$store_address =  htmlspecialchars_decode( stripslashes( get_wt_neoncart_options( 'store_address', '', $_SESSION['languages_id'] ) ) );
$store_description = htmlspecialchars_decode( stripslashes( get_wt_neoncart_options( 'store_description', '', $_SESSION['languages_id'] ) ) );
$store_contact = get_wt_neoncart_options( 'store_contact' );
$store_email = get_wt_neoncart_options( 'store_email' );
$store_copyright = htmlspecialchars_decode( stripslashes( get_wt_neoncart_options( 'store_copyright' ) ) );
$store_fax = get_wt_neoncart_options( 'store_fax' );
$store_skype = get_wt_neoncart_options( 'store_skype' );
$store_time = get_wt_neoncart_options( 'store_time' );
$store_timings = get_wt_neoncart_options( 'store_timings' );
$store_map = htmlspecialchars_decode( stripslashes( get_wt_neoncart_options( 'google_map' ) ) );
$newsletter_details = htmlspecialchars_decode( stripslashes( get_wt_neoncart_options( 'newsletter_details' ) ) );

//page loader
$page_loader = get_wt_neoncart_options( 'page_loader', 'default' );
$page_loader_custom = get_wt_neoncart_options( 'page_loader_custom' );

// Newsletter Popup
$display_newsletter_popup = get_wt_neoncart_options( 'display_newsletter_popup', 1);
$newsletter_image = get_wt_neoncart_options( 'newsletter_logo', 'newsletter-logo.png' );