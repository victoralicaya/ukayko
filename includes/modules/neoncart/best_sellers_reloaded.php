<?php
/**
 * Best Sellers Reloaded v1.1
 *
 * best_sellers_reloaded module - prepares content for display
 *
 * @package modules
 * @author Alex Clarke (aclarke@ansellandclarke.co.uk)
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: best_sellers_reloaded.php 2007-07-22 aclarke $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

//Bof wt custom ---
global $product_style, $wt_display_style, $zco_notifier, $zcDate;
$wt_display_style = ( !empty( $wt_display_style ) ) ? $wt_display_style : 'slider';
$max_display_products = ( isset( $max_products ) ) ? $max_products : MAX_DISPLAY_SEARCH_RESULTS_BEST_SELLERS;
$max_display_columns = ( isset( $show_rows ) ) ? $show_rows : SHOW_PRODUCT_INFO_COLUMNS_BEST_SELLERS;
$show_product_image = isset( $atts['show_product_image'] ) ? wt_boolean( $atts['show_product_image'] ) : true;
$show_product_name = isset( $atts['show_product_name'] ) ? wt_boolean( $atts['show_product_name'] ) : true;
$show_product_reviews = isset( $atts['show_product_reviews'] ) ? wt_boolean( $atts['show_product_reviews'] ) : true;
$show_product_price = isset( $atts['show_product_price'] ) ? wt_boolean( $atts['show_product_price'] ) : true;
$show_product_labels = isset( $atts['show_product_labels'] ) ? wt_boolean( $atts['show_product_labels'] ) : true;
$show_product_buttons = isset( $atts['show_product_buttons'] ) ? wt_boolean( $atts['show_product_buttons'] ) : true;
$product_class = isset( $atts['product_class'] ) ? $atts['product_class'] : '';
$manufacturers_id = ( isset( $manufacturers_id ) ) ? $manufacturers_id : 0;
$category_list = ( !empty( $category ) ) ? implode( "_", explode(",", $category ) ) : '';
//Eof wt custom ---

$zc_show_best_sellers = (((int)SHOW_PRODUCT_INFO_MAIN_BEST_SELLERS) > 0);
if ($zc_show_best_sellers) {
	$max_display_best_sellers = $max_display_products;
  
	$from_clause = " FROM "  . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd";
	$where_clause = " WHERE p.products_status = '1' AND p.products_ordered > 0 AND p.products_id = pd.products_id AND pd.language_id = " . (int)$_SESSION['languages_id'];
	$limit_clause = ($max_display_best_sellers <= 0) ? '' : " LIMIT $max_display_best_sellers";
  
	if (BEST_SELLERS_RELOADED_SHOW_OUT_OF_STOCK == 'false') {
		$where_clause .= ' AND p.products_quantity > 0';
	}
	
	if (isset ($current_category_id) && $current_category_id > 0) {
		$from_clause .= ", " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c";
		$where_clause .= " AND p.products_id = p2c.products_id AND p2c.categories_id = c.categories_id AND " . (int)$current_category_id . " IN (c.categories_id, c.parent_id)";
	}
	
	$best_sellers_reloaded_query = "SELECT DISTINCT p.products_id, p.products_type, pd.products_name, p.products_image, p.master_categories_id, p.products_quantity, p.product_is_call, p.products_date_available, p.products_date_added, p.products_model, p.products_ordered$from_clause$where_clause ORDER BY p.products_ordered desc, pd.products_name$limit_clause";
	$best_sellers_reloaded = $db->Execute ($best_sellers_reloaded_query);
	$num_products_count = $best_sellers_reloaded->RecordCount();
	
	$list_box_contents = array();
	$title = '';
	$row = 0;
	$col = 0;
	
	if ($num_products_count > 0) {
		$best_sellers_columns = $max_display_columns;
		if ($num_products_count < $best_sellers_columns || $best_sellers_columns == 0) {
			$col_width = floor (100 / $num_products_count);
		} else {
			$col_width = floor (100 / $best_sellers_columns);
		  
		}

		while (!$best_sellers_reloaded->EOF) {
			
			$products_obj = $best_sellers_reloaded;
					  
			if (!isset($productsInCategory[$products_obj->fields['products_id']])) $productsInCategory[$products_obj->fields['products_id']] = zen_get_generated_category_path_rev($products_obj->fields['master_categories_id']);
		
			$cPath = $productsInCategory[$products_obj->fields['products_id']];
			$products_obj->fields['cPath'] = $cPath;
				
			//set Infopagelink
			$zen_get_info_page = wt_get_info_page($products_obj);
			$products_obj->fields['zen_get_info_page'] = $zen_get_info_page;
	  			
			$products_name = $products_obj->fields['products_name'];
	
			$product_content = get_wt_neoncart_product_content($products_obj, $wt_display_style, array("image_width"=>IMAGE_BEST_SELLERS_LISTING_WIDTH, "image_height"=>IMAGE_BEST_SELLERS_LISTING_HEIGHT));
		
		$products_price = $product_content['products_price'];
		
		if ( $max_display_columns > 1 ) {
			$list_box_contents[$row]['row_class'] = 'tt-items';
		}
		
		if ( in_array( $wt_display_style, array( 'micro_grid', 'micro_slider', 'micro_ver_slider' ) ) ) {
			
			$list_box_contents[$row][$col] = array(
			'products_type' => 'category_products',
			'products_count' => $num_products_count,
			'params' => array ( 
				'class' => array_merge( $product_content['products_class'], array( 'centerBoxContentsCatProducts', $product_class ) ),
			),
			'text' => 
				'<div class="supermarket_product_listlayout products-item-list">
				'. ( ( empty( $show_product_image ) || ( empty( $products_obj->fields['products_image'] ) && PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0 ) ) ? '' : '
				<div class="item_image">
					<div class="item">
					'. $product_content['products_image'] .'
					</div>
				</div>
				' ) . '
				<div class="item_content">
					' . ( ( !empty( $show_product_reviews ) ) ? $product_content['products_review'] : '' ) . '
					' . ( ( !empty( $show_product_name ) ) ? '<h3 class="item_title"><a href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_obj->fields['products_id'], 'SSL') . '">' . $products_name . '</a></h3>' : '' ) . '
					' . ( ( !empty( $show_product_price ) ) ? '<div class="item_price mb-3">'. $products_price .'</div>' : '' ) . '
					' . ( ( !empty( $show_product_buttons ) ) ? 
					'<ul class="product_action_btns ul_li clearfix">
						<li>' . ( ( $buy_now = $product_content['buy_now'] ) ? $buy_now : '' ) . '</li>
						<li>' . ( ( $product_content['product_quickview'] ) ? $product_content['product_quickview'] : '' ) . '</li>
					</ul>' : '' ) . '
				</div>
			</div>'
			);
		} else if ( in_array( $wt_display_style, array( 'micro_small_grid', 'micro_small_slider', 'micro_small_ver_slider' ) ) ) {
			
			$list_box_contents[$row][$col] = array(
			'products_type' => 'category_products',
			'products_count' => $num_products_count,
			'params' => array ( 
				'class' => array_merge( $product_content['products_class'], array( 'centerBoxContentsCatProducts', $product_class ) ),
			),
			'text' => 
				'<div class="supermarket_product_small '. wt_get_products_class() .'">
					'. ( ( empty( $show_product_image ) || ( empty( $products_obj->fields['products_image'] ) && PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0 ) ) ? '' : '
					<div class="item_image">
						' . $product_content['products_image'] .'
						' . ( ( !empty( $show_product_labels ) ?  '<ul class="product_label ul_li_block clearfix">'. $product_content['products_label'] .'</ul>' : '' ) ) . '
					</div>
					' ) . '
					<div class="item_content">
						' . ( ( !empty( $show_product_name ) ) ? '<h3 class="item_title"><a href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_obj->fields['products_id'], 'SSL') . '">' . $products_name . '</a></h3>' : '' ) . '
						' . ( ( !empty( $show_product_price ) ) ? '<div class="item_price">'. $products_price .'</div>' : '' ) . '
						' . ( ( !empty( $show_product_reviews ) ) ? $product_content['products_review'] : '' ) . '
						' . ( ( !empty( $show_product_buttons ) ) ? 
						'<ul class="product_action_btns ul_li clearfix mt-2">
							<li>' . ( ( $buy_now = $product_content['buy_now'] ) ? $buy_now : '' ) . '</li>
							<li>' . ( ( $product_content['product_quickview'] ) ? $product_content['product_quickview'] : '' ) . '</li>
						</ul>' : '' ) . '
					</div>
				</div>'
			);
		} else {
			$list_box_contents[$row][$col] = array(
			'products_type' => 'category_products',
			'products_count' => $num_products_count,
			'params' => array ( 
				'class' => array_merge( $product_content['products_class'], array( 'centerBoxContentsCatProducts', $product_class ) ),
			),
			'text' => 
				'<div class="product-item '. wt_get_products_class() .'">
					'. ( ( empty( $show_product_image ) || ( empty( $products_obj->fields['products_image'] ) && PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0 ) ) ? '' : '
					<div class="item_image">
						'. $product_content['products_image'] .'
						' . ( ( !empty( $show_product_buttons ) ) ? 
						'<ul class="product_action_btns ul_li_center clearfix">
							' . ( ( $product_content['product_quickview'] ) ? '<li>' . $product_content['product_quickview'] . '</li>' : '' ) . '
							' . ( ( $wishlist_link = $product_content['wishlist_link'] ) ? '<li><a href="'.$wishlist_link.'" class="tt-btn-wishlist" title="'. UN_TEXT_ADD_WISHLIST .'"><i class="far fa-heart"></i></a></li>' : '' ) . '
							' . ( ( $buy_now = $product_content['buy_now'] ) ? '<li>' . $buy_now . '</li>' : '' ) . '
							' . ( ( $compare_link = $product_content['compare_link'] ) ? '<li><a class="tt-btn-compare ' . $compare_link['classes'] . '" '. $compare_link['params'] .' title="'. TEXT_ADD_TO_COMPARE .'"><i class="far fa-random"></i></a></li>' : '' ) . '
						</ul>' : '' ) . '
						' . ( ( !empty( $show_product_labels ) ?  '<ul class="product_label ul_li_block clearfix">'. $product_content['products_label'] .'</ul>' : '' ) ) . '
					</div>
					' ) . '
					<div class="item_content">
						' . ( ( !empty( $show_product_name ) ) ? '<h3 class="item_title"><a href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_obj->fields['products_id'], 'SSL') . '">' . $products_name . '</a></h3>' : '' ) . '
						' . ( ( !empty( $show_product_reviews ) ) ? $product_content['products_review'] : '' ) . '
						' . ( ( !empty( $show_product_price ) ) ? '<div class="item_price">'. $products_price .'</div>' : '' ) . '
					</div>
				</div>'
			);
		}

		$col ++;
		if ($col > ($max_display_columns - 1)) {
				$col = 0;
				$row++;
			}
			$best_sellers_reloaded->MoveNext ();
		}

		if ($num_products_count) {
			if (isset ($new_products_category_id) && $new_products_category_id != 0) {
				$category_title = zen_get_categories_name ((int)$new_products_category_id);
				$title = '<h2 class="tt-title centerBoxHeading">' . TABLE_HEADING_BEST_SELLERS . ($category_title != '' ? ' - ' . $category_title : '') . '</h2>';
			} else {
				$title = '<h2 class="tt-title centerBoxHeading">' . TABLE_HEADING_BEST_SELLERS . '</h2>';
			}
			$zc_show_best_sellers = true;
		}
	}
}