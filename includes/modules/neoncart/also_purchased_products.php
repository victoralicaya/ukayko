<?php
/**
 * also_purchased_products.php
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 25 Modified in v1.5.8-alpha $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

//Bof wt custom ---
global $product_style, $wt_display_style, $zco_notifier, $zcDate;
$wt_display_style = ( !empty( $wt_display_style ) ) ? $wt_display_style : 'slider';
$max_display_products = ( isset( $max_products ) ) ? $max_products : MAX_DISPLAY_NEW_PRODUCTS;
$max_display_columns = ( isset( $show_rows ) ) ? $show_rows : SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS;
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

if (isset($_GET['products_id']) && SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS > 0 && MIN_DISPLAY_ALSO_PURCHASED > 0) {
	$sql_also_purchase_products="SELECT p.products_id, p.products_image, p.products_quantity, p.product_is_call, p.products_date_available, p.products_date_added, max(o.date_purchased) as date_purchased, p.master_categories_id, p.products_type, p.products_model
                     FROM " . TABLE_ORDERS_PRODUCTS . " opa, " . TABLE_ORDERS_PRODUCTS . " opb, "
                            . TABLE_ORDERS . " o, " . TABLE_PRODUCTS . " p
                     WHERE opa.products_id = '%s'
                     AND opa.orders_id = opb.orders_id
                     AND opb.products_id != '%s'
                     AND opb.products_id = p.products_id
                     AND opb.orders_id = o.orders_id
                     AND p.products_status = 1
                     GROUP BY p.products_id, p.products_image
                     ORDER BY date_purchased desc, p.products_id
					LIMIT ".((int)MAX_DISPLAY_ALSO_PURCHASED);

$also_purchased_products = $db->Execute(sprintf($sql_also_purchase_products, (int)$_GET['products_id'], (int)$_GET['products_id']));

  $num_products_ordered = $also_purchased_products->RecordCount();

  $row = 0;
  $col = 0;
  $list_box_contents = [];
  $title = '';

  // show only when 1 or more and equal to or greater than minimum set in admin
  if ($num_products_ordered >= MIN_DISPLAY_ALSO_PURCHASED && $num_products_ordered > 0) {
    if ($num_products_ordered < SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS) {
      $col_width = floor(100/$num_products_ordered);
    } else {
      $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS);
    }

    while (!$also_purchased_products->EOF) {
			
			$products_obj = $also_purchased_products;
		
			if (!isset($productsInCategory[$products_obj->fields['products_id']])) $productsInCategory[$products_obj->fields['products_id']] = zen_get_generated_category_path_rev($products_obj->fields['master_categories_id']);
		
			$cPath = $productsInCategory[$products_obj->fields['products_id']];
			$products_obj->fields['cPath'] = $cPath;
					
			//set Infopagelink
			$zen_get_info_page = wt_get_info_page($products_obj);
			$products_obj->fields['zen_get_info_page'] = $zen_get_info_page;
			
			$products_name = zen_get_products_name($products_obj->fields['products_id']);
		
			$product_content = get_wt_neoncart_product_content($products_obj, $wt_display_style, array("image_width"=>IMAGE_PRODUCT_NEW_WIDTH, "image_height"=>IMAGE_PRODUCT_NEW_HEIGHT));
			
			$product_content['buy_now'] = zen_get_buy_now_button($products_obj->fields['products_id'],'<a class="tt-btn-addtocart thumbprod-button-bg btn-opt btn" href="' . zen_href_link(zen_get_info_page($products_obj->fields['products_id']), 'cPath=' . $productsInCategory[$products_obj->fields['products_id']] . '&products_id=' . $products_obj->fields['products_id'], 'SSL') . '"><span class="qck-text"></span> '.TITLE_VIEW_PRODUCT.'</a>');
			if ( $products_obj->fields['products_quantity'] <= 0 && $products_obj->fields['products_type'] != 3 && SHOW_PRODUCTS_SOLD_OUT_IMAGE == '1' ) {
				$product_content['buy_now'] = '<button class="normal_button button btn button_sold_out">'.WT_BADGE_SOLD_OUT.'</button>';
			}

			$products_price = $product_content['products_price'];
			
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
      if ($col > (SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS - 1)) {
        $col = 0;
        $row ++;
      }
      $also_purchased_products->MoveNext();
    }
  }
  if ($also_purchased_products->RecordCount() > 0 && $also_purchased_products->RecordCount() >= MIN_DISPLAY_ALSO_PURCHASED) {
    $title = '<h2 class="tt-title centerBoxHeading">' . TEXT_ALSO_PURCHASED_PRODUCTS . '</h2>';
	$title_position = 'left';
    $zc_show_also_purchased = true;
  }
}
