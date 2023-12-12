<?php
/**
 * Module Template
 *
 * Loaded automatically by index.php?main_page=products_all.
 * Displays listing of All Products
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: torvista 2022 Aug 03 Modified in v1.5.8-alpha2 $
 */
?>

<?php
$list_box_contents = array();
$rows = 0;
$column = 0;
$title = '';

//Bof wt custom ---
global $product_style, $wt_display_style;
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

  //$group_id = zen_get_configuration_key_value('PRODUCT_ALL_LIST_GROUP_ID');
$num_products_count = $products_all_split->number_of_rows;
if( $num_products_count > 0 ) {
  
	$products_all = $db->Execute($products_all_split->sql_query);
	while (!$products_all->EOF) {

		$products_name = $products_all->fields['products_name'];
		
		/*BOF changed by WT Tech. -------------------*/
		
		//set cPath
		$cPath = zen_get_generated_category_path_rev($products_all->fields['master_categories_id']);
		$products_all->fields['cPath'] = $cPath;
		
		//set Infopagelink
		$zen_get_info_page = wt_get_info_page($products_all);
		$products_all->fields['zen_get_info_page'] = $zen_get_info_page;
		
		$wt_display_style = 'list';
		$product_content = get_wt_neoncart_product_content($products_all, $wt_display_style, array("image_width"=>IMAGE_PRODUCT_ALL_LISTING_WIDTH, "image_height"=>IMAGE_PRODUCT_ALL_LISTING_HEIGHT));
		
		/*EOF changed by WT Tech. -------------------*/
	
		$moreinfo = '<a class="more_info_text" href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_all->fields['products_id'], 'SSL') . '">'.MORE_INFO_TEXT.'</a>';

		$display_products_image = '';
		if (PRODUCT_ALL_LIST_IMAGE != '0') {
				if ($products_all->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) {
					$display_products_image = str_repeat('', substr(PRODUCT_ALL_LIST_IMAGE, 3, 1));
				} else {
					$display_products_image = zen_image(DIR_WS_IMAGES . $products_all->fields['products_image'], $products_name, IMAGE_PRODUCT_ALL_LISTING_WIDTH, IMAGE_PRODUCT_ALL_LISTING_HEIGHT) . str_repeat('', substr(PRODUCT_ALL_LIST_IMAGE, 3, 1));
				}
		}
		
		$display_products_name = '';
		if (PRODUCT_ALL_LIST_NAME != '0') {
			$display_products_name = '<a href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_all->fields['products_id'], 'SSL') . '">' . $products_name . '</a>' . str_repeat('', substr(PRODUCT_ALL_LIST_NAME, 3, 1));
		}
		
		if (PRODUCT_ALL_LIST_MODEL != '0' and zen_get_show_product_switch($products_all->fields['products_id'], 'model')) {
			$display_products_model = TEXT_PRODUCT_MODEL . $products_all->fields['products_model'] . str_repeat('<br class="clearBoth" />', substr(PRODUCT_ALL_LIST_MODEL, 3, 1));
		  } else {
			$display_products_model = '';
		  }
		
		$display_products_weight = '';
		if (PRODUCT_ALL_LIST_WEIGHT != '0' and wt_get_show_product_switch($products_all->fields['products_id'], 'weight')) {
			$display_products_weight = TEXT_PRODUCTS_WEIGHT . $products_all->fields['products_weight'] . TEXT_SHIPPING_WEIGHT . str_repeat('', substr(PRODUCT_ALL_LIST_WEIGHT, 3, 1));
		}

		$display_products_quantity = '';
		if (PRODUCT_ALL_LIST_QUANTITY != '0' and wt_get_show_product_switch($products_all->fields['products_id'], 'quantity')) {
			if ($products_all->fields['products_quantity'] <= 0) {
				$display_products_quantity = TEXT_OUT_OF_STOCK . str_repeat('', substr(PRODUCT_ALL_LIST_QUANTITY, 3, 1));
			} else {
				$display_products_quantity = TEXT_PRODUCTS_QUANTITY . $products_all->fields['products_quantity'] . str_repeat('', substr(PRODUCT_ALL_LIST_QUANTITY, 3, 1));
			}
		}

		$display_products_date_added = '';
		if (PRODUCT_ALL_LIST_DATE_ADDED != '0' and wt_get_show_product_switch($products_all->fields['products_id'], 'date_added')) {
			$display_products_date_added = sprintf(TEXT_DATE_ADDED, zen_date_long($products_all->fields['products_date_added'])) . str_repeat('', substr(PRODUCT_ALL_LIST_DATE_ADDED, 3, 1));
		}
		
		$display_products_manufacturers_name = '';
		if (PRODUCT_ALL_LIST_MANUFACTURER != '0' and wt_get_show_product_switch($products_all->fields['products_id'], 'manufacturer')) {
			$display_products_manufacturers_name = ($products_all->fields['manufacturers_name'] != '' ? TEXT_MANUFACTURER . ' ' . $products_all->fields['manufacturers_name'] . str_repeat('', substr(PRODUCT_ALL_LIST_MANUFACTURER, 3, 1)) : '');
		}

		$display_products_price = '';
		if ((PRODUCT_ALL_LIST_PRICE != '0' and $product_content['zen_get_products_allow_add_to_cart'] == 'Y') and zen_check_show_prices() == true) {
			$products_price = $product_content['products_price'];
			$display_products_price = $products_price . str_repeat('', substr(PRODUCT_ALL_LIST_PRICE, 3, 1)) . (wt_get_show_product_switch($products_all->fields['products_id'], 'ALWAYS_FREE_SHIPPING_IMAGE_SWITCH') ? (zen_get_product_is_always_free_shipping($products_all->fields['products_id']) ? TEXT_PRODUCT_FREE_SHIPPING_ICON : '') : '');
		}
		$display_products_button='';
		// more info in place of buy now
		if (PRODUCT_ALL_BUY_NOW != '0' and $product_content['zen_get_products_allow_add_to_cart'] == 'Y') {
			if ($product_content['zen_has_product_attributes']) {
				$link = '<a class="button btn tt-btn-addtocart thumbprod-button-bg btn-opt btn" href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_all->fields['products_id']) . '" '.wtExtraBtnLink($products_all).'><i class="far fa-list"></i><span class="qck-text d-none">'.TITLE_SELECT_OPTIONS.'</span></a>';
			} else {
				if (PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART > 0 && $products_all->fields['products_qty_box_status'] != 0) {
				//            $how_many++;
					$link = '<div class="prod-qty-bx"><div class="inner-qty-box"><span class="qty-lbl">'.TEXT_PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART . "</span><span class='qty_txt'><input type=\"text\" name=\"products_id[" . $products_all->fields['products_id'] . "]\" value=\"0\" size=\"1\" /></span>".'</div></div>';
				} else {
					$link = '<a class="button btn tt-btn-addtocart thumbprod-button-bg" href="' . zen_href_link(FILENAME_PRODUCTS_ALL, zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products_all->fields['products_id']) . '" '.wtExtraBtnLink($products_all).' '.wtExtraBtnLink($products_all).'><i class="fal fa-shopping-basket"></i><span class="qck-text d-none">'.TITLE_ADD_TO_CART.'</span></a>';
				}
			}
			$the_button = $link;
			if($products_all->fields['product_is_call'] != '1'){
				$products_link = '<a class="button" href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_all->fields['products_id']) . '">' . MORE_INFO_TEXT . '</a>';
			}
			//if not out of stock
			if($products_all->fields['products_quantity'] > 0 || SHOW_PRODUCTS_SOLD_OUT_IMAGE == 0){
				if(($product_content['zen_get_products_allow_add_to_cart'] != 'N') && $products_all->fields['product_is_call'] == '1'){
					$display_products_button ='<a class="btn-callforprice btn button" href="' . zen_href_link(FILENAME_CONTACT_US, '', 'SSL') . '">' . TEXT_CALL_FOR_PRICE . '</a>';
				}else{
					$minmaxqty=zen_get_products_quantity_min_units_display($products_all->fields['products_id']);
					$display_products_button =  zen_get_buy_now_button($products_all->fields['products_id'], $the_button, $products_link) .(($minmaxqty)? '<span class="min-max-qty">'.$minmaxqty.'</span>' : ''). str_repeat('<br />', substr(PRODUCT_ALL_BUY_NOW, 3, 1));;
				}
			}
		
		} else {
			$link = '<a class="list-more button" href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_all->fields['products_id']) . '">' . MORE_INFO_TEXT . '</a>';
			$the_button = $link;
			$products_link = '<a class="list-more button" href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_all->fields['products_id']) . '">' . MORE_INFO_TEXT . '</a>';
		
			if($products_all->fields['products_quantity'] > 0 || SHOW_PRODUCTS_SOLD_OUT_IMAGE == 0){
				if(($product_content['zen_get_products_allow_add_to_cart'] != 'N') && $products_all->fields['product_is_call'] == '1'){
					$display_products_button ='<a class="button btn-callforprice btn" href="' . zen_href_link(FILENAME_CONTACT_US, '', 'SSL') . '"><span class="icon icon-call"></span>' . TEXT_CALL_FOR_PRICE . '</a>';
				}else{
					$minmaxqty=zen_get_products_quantity_min_units_display($products_all->fields['products_id']);
					$display_products_button =  zen_get_buy_now_button($products_all->fields['products_id'], $the_button, $products_link) .(($minmaxqty)? '<span class="min-max-qty">'.$minmaxqty.'</span>' : ''). str_repeat('<br />', substr(PRODUCT_ALL_BUY_NOW, 3, 1));;
				}
			}
		}
			
		$display_products_description = '';
		if (PRODUCT_ALL_LIST_DESCRIPTION > '0') {

			$display_products_description = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($products_all->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_ALL_LIST_DESCRIPTION);
		}
		
		
		
		$products_obj = $products_all;
		
		$products_price = $display_products_price;
		$products_description = $display_products_description;
		$product_content['buy_now'] = $display_products_button;
		
		$show_addtocart_qty_box = ( PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART !=0 || (PRODUCT_ALL_BUY_NOW == '2' && $products_obj->fields['products_qty_box_status'] != 0) ) ? true : false;
		
		if ( !$flag_is_grid ) {
		
			$list_box_contents[$rows][$column] = array(
				'products_type' => 'product_all_listing',
				'products_count' => $num_products_count,
				'params' => array ( 
					'class' => $product_content['products_class'],
				),
				'text' => '<div class="carparts_product_listlayout product-item products-item-list btn-icon-text" data-bg-color="#f0eeee">
								'. ( ( empty( $show_product_image ) || ( empty( $products_obj->fields['products_image'] ) && PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0 ) ) ? '' : '
									<div class="item_image">
										'. $product_content['products_image'] .'
										' . ( ( !empty( $show_product_labels ) ?  '<ul class="product_label ul_li_block clearfix">'. $product_content['products_label'] .'</ul>' : '' ) ) . '
									</div>
								' ) . '
								<div class="item_content">
									' . ( ( !empty( $show_product_name ) ) ? '<h3 class="item_title"><a href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_obj->fields['products_id'], 'SSL') . '">' . $products_name . '</a></h3>' : '' ) . '
									' . ( !empty( $products_description ) ? '<p class="description mb-0 hidden-xs hidden-sm">' . $products_description . '</p>' : ''  ) . '
									<div class="action_btns_wrap">
										' . ( ( !empty( $show_product_price ) ) ? '<div class="item_price">'. $products_price .'</div>' : '' ) . '
										' . ( ( !empty( $show_product_buttons ) ) ? 
											'<ul class="product_action_btns ul_li_center clearfix">
												' . ( $show_addtocart_qty_box == false && ( ( $buy_now = $product_content['buy_now'] ) ) ? '<li>' . $buy_now . '</li>' : '' ) . '
												' . ( ( $product_content['product_quickview'] ) ? '<li>' . $product_content['product_quickview'] . '</li>' : '' ) . '
												' . ( ( $wishlist_link = $product_content['wishlist_link'] ) ? '<li><a href="'.$wishlist_link.'" class="tt-btn-wishlist" title="'. UN_TEXT_ADD_WISHLIST .'"><i class="far fa-heart"></i></a></li>' : '' ) . '
												' . ( ( $compare_link = $product_content['compare_link'] ) ? '<li><a class="tt-btn-compare ' . $compare_link['classes'] . '" '. $compare_link['params'] .' title="'. TEXT_ADD_TO_COMPARE .'"><i class="far fa-random"></i></a></li>' : '' ) . '
											</ul>' : '' ) . '
									</div>
									' . ( $show_addtocart_qty_box == true && ( ( $buy_now = $product_content['buy_now'] ) ) ? 
										'<div class="product_action_bot_btns">' . $buy_now .'</div>'
									: '' ) . '
								</div>
							</div>
				
					'
				);
				
			} else {
		
			$list_box_contents[$rows][$column] = array(
				'products_type' => 'product_all_listing',
				'products_count' => $num_products_count,
				'params' => array ( 
					'class' => $product_content['products_class'],
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
								' . ( $show_addtocart_qty_box == false && ( ( $buy_now = $product_content['buy_now'] ) ) ? '<li>' . $buy_now . '</li>' : '' ) . '
								' . ( ( $compare_link = $product_content['compare_link'] ) ? '<li><a class="tt-btn-compare ' . $compare_link['classes'] . '" '. $compare_link['params'] .' title="'. TEXT_ADD_TO_COMPARE .'"><i class="far fa-random"></i></a></li>' : '' ) . '
							</ul>' : '' ) . '
							' . ( ( !empty( $show_product_labels ) ?  '<ul class="product_label ul_li_block clearfix">'. $product_content['products_label'] .'</ul>' : '' ) ) . '
						</div>
						' ) . '
						<div class="item_content">
							' . ( ( !empty( $show_product_name ) ) ? '<h3 class="item_title"><a href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_obj->fields['products_id'], 'SSL') . '">' . $products_name . '</a></h3>' : '' ) . '
							' . ( ( !empty( $show_product_reviews ) ) ? $product_content['products_review'] : '' ) . '
							' . ( ( !empty( $show_product_price ) ) ? '<div class="item_price">'. $products_price .'</div>' : '' ) . '
							' . ( $show_addtocart_qty_box == true && ( ( $buy_now = $product_content['buy_now'] ) ) ? 
								'<div class="product_action_bot_btns">' . $buy_now .'</div>'
							: '' ) . '
						</div>
					</div>'
				);
			}
			$column ++;
			
			if ( $column >= PRODUCT_LISTING_COLUMNS_PER_ROW) {
				$column = 0;
				$rows ++;
			}
			$products_all->MoveNext();
    	}
	} else { ?>
	<div class="row">
		<div class="col-lg-12">
			<div class="alert alert-info"><?php echo TEXT_NO_ALL_PRODUCTS; ?></div>
		</div>
	</div>
<?php  } ?>
