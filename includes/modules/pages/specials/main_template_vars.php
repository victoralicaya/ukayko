<?php
/**
 * Specials
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 25 Modified in v1.5.8-alpha $
 */

//Bof wt custom ---
global $product_style, $wt_display_style, $zco_notifier, $zcDate;
$wt_display_style = ( !empty( $wt_display_style ) ) ? $wt_display_style : 'grid';
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

if (MAX_DISPLAY_SPECIAL_PRODUCTS > 0 ) {
  $specials_query_raw = "SELECT p.products_id, p.products_image, pd.products_name, p.master_categories_id, p.manufacturers_id, p.products_quantity, p.product_is_call, p.products_date_available, p.products_date_added, p.products_model, p.products_type
                         FROM (" . TABLE_PRODUCTS . " p
                         LEFT JOIN " . TABLE_SPECIALS . " s on p.products_id = s.products_id
                         LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                         WHERE p.products_id = s.products_id and p.products_id = pd.products_id and p.products_status = '1'
                         AND s.status = 1
                         AND pd.language_id = :languagesID
                         ORDER BY s.specials_date_added DESC";

  $specials_query_raw = $db->bindVars($specials_query_raw, ':languagesID', $_SESSION['languages_id'], 'integer');

  $count_key = '*';
  $zco_notifier->notify('NOTIFY_SPECIALS_MAIN_TEMPLATE_VARS_SQL_STRING', array(), $specials_query_raw, $count_key);

  $specials_split = new splitPageResults($specials_query_raw, MAX_DISPLAY_SPECIAL_PRODUCTS, $count_key);
  $specials = $db->Execute($specials_split->sql_query);
  $row = 0;
  $col = 0;
  $list_box_contents = array();
  $title = '';

  $num_products_count = $specials->RecordCount();
  if ($num_products_count) {
    if ($num_products_count < SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS || SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS==0 ) {
      $col_width = floor(100/$num_products_count);
    } else {
      $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS);
    }

    $list_box_contents = array();
    while (!$specials->EOF) {
	  
	    $products_obj = $specials;

		if (!isset($productsInCategory[$products_obj->fields['products_id']])) $productsInCategory[$products_obj->fields['products_id']] = zen_get_generated_category_path_rev($products_obj->fields['master_categories_id']);
	
		$cPath = $productsInCategory[$products_obj->fields['products_id']];
		$products_obj->fields['cPath'] = $cPath;
				
		//set Infopagelink
		$zen_get_info_page = wt_get_info_page($products_obj);
		$products_obj->fields['zen_get_info_page'] = $zen_get_info_page;
	  	
		$products_name = $products_obj->fields['products_name'];
	
		$product_content = get_wt_neoncart_product_content($products_obj, $wt_display_style, array("image_width"=>IMAGE_PRODUCT_NEW_WIDTH, "image_height"=>IMAGE_PRODUCT_NEW_HEIGHT));
		
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
				'products_type' => 'specials_products',
				'products_count' => $num_products_count,
				'params' => array ( 
					'class' => array_merge( $product_content['products_class'], array( 'supermarket_product_small centerBoxContentsCatProducts', $product_class ) ),
				),
				'text' => 
					( ( empty( $show_product_image ) || ( empty( $products_obj->fields['products_image'] ) && PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0 ) ) ? '' : '
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
					</div>'
				);
			} else {
				$list_box_contents[$row][$col] = array(
				'products_type' => 'specials_products',
				'products_count' => $num_products_count,
				'params' => array ( 
					'class' => array_merge( $product_content['products_class'], array( 'centerBoxContentsCatProducts', $product_class ) ),
				),
				'text' => 
					'<div class="supermarket_product_item product-item">
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
      if ($col > (SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS - 1)) {
        $col = 0;
        $row ++;
      }
      $specials->MoveNext();
    }
    
    $zco_notifier->notify('NOTIFY_SPECIALS_MAIN_TEMPLATE_VARS_END', array(), $list_box_contents);
    
    require($template->get_template_dir('tpl_specials_default.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_specials_default.php');
  }
}
