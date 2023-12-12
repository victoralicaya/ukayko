<?php 
#WT_NEONCART_TEMPLATE_BASE#

$ajxcart_shopping_cart_status = true;
if( $ajxcart_shopping_cart_status == true ) {
	require( $template->get_template_dir('tpl_wt_ajax_shopping_cart.php',DIR_WS_TEMPLATE, $current_page_base, 'sideboxes'). '/tpl_wt_ajax_shopping_cart.php' );
	$title =  BOX_HEADING_SHOPPING_CART;
	$title_link = false;
	$title_link = FILENAME_SHOPPING_CART;
	$column_box_default='tpl_box_header.php';
	
	require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
}