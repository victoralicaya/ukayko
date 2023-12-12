<?php
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

//Bof wt custom ---
global $product_style, $wt_display_style, $zco_notifier, $zcDate;
$wt_display_style = ( !empty( $wt_display_style ) ) ? $wt_display_style : 'slider';
$max_display_products = ( isset( $max_products ) ) ? $max_products : MAX_DISPLAY_SEARCH_RESULTS_FEATURED;
$max_display_columns = ( isset( $show_rows ) ) ? $show_rows : SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS;
$show_product_image = isset( $atts['show_product_image'] ) ? wt_boolean( $atts['show_product_image'] ) : true;
$show_product_name = isset( $atts['show_product_name'] ) ? wt_boolean( $atts['show_product_name'] ) : true;
$show_product_reviews = isset( $atts['show_product_reviews'] ) ? wt_boolean( $atts['show_product_reviews'] ) : true;
$show_product_price = isset( $atts['show_product_price'] ) ? wt_boolean( $atts['show_product_price'] ) : true;
$show_product_labels = isset( $atts['show_product_labels'] ) ? wt_boolean( $atts['show_product_labels'] ) : true;
$show_product_buttons = isset( $atts['show_product_buttons'] ) ? wt_boolean( $atts['show_product_buttons'] ) : true;
$cat_produtcs_filter = isset( $atts['cat_produtcs_filter'] ) ? wt_boolean( $atts['cat_produtcs_filter'] ) : false;
$product_class = isset( $atts['product_class'] ) ? $atts['product_class'] : '';
$manufacturers_id = ( isset( $manufacturers_id ) ) ? $manufacturers_id : 0;
$category_list = ( !empty( $category ) ) ? implode( "_", explode(",", $category ) ) : '';
//Eof wt custom ---


// initialize vars
$categories_products_id_list = '';
$cp_index_query = '';
$display_limit = '';
	
	//if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
		
	//$list_of_products = substr($list_of_products, 0, -2); // remove trailing comma
    $cp_index_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id, p.products_quantity, p.product_is_call, p.products_date_available, p.products_date_added, p.products_type, p.products_model
                             from (" . TABLE_PRODUCTS . " p
                             left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id
                             left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                             where p.products_id = pd.products_id
                             and p.products_status = '1'
                             and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                             and p.products_id in (" . $list_of_products . ")";
							 
	//}
							 
if ($cp_index_query != '') $cp_index = $db->ExecuteRandomMulti($cp_index_query, $max_display_products);

$row = 0;
$col = 0;
$list_box_contents = array();
$title = '';

$num_products_count = ($cp_index_query == '') ? 0 : $cp_index->RecordCount();

// show only when 1 or more
if ($num_products_count > 0) {
	if ($num_products_count < SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS || SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS == 0 ) {
		$col_width = floor(100/$num_products_count);
	} else {
		$col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS);
	}

	$list_box_contents = array();
	while (!$cp_index->EOF) {
		
		$products_obj = $cp_index;
		
		if (!isset($productsInCategory[$products_obj->fields['products_id']])) $productsInCategory[$products_obj->fields['products_id']] = zen_get_generated_category_path_rev($products_obj->fields['master_categories_id']);
		
		$cPath = $productsInCategory[$products_obj->fields['products_id']];
		$products_obj->fields['cPath'] = $cPath;
				
		//set Infopagelink
		$zen_get_info_page = wt_get_info_page($products_obj);
		$products_obj->fields['zen_get_info_page'] = $zen_get_info_page;
	
		$products_name = $products_obj->fields['products_name'];
		
		$wt_etc_ar = array();
		if ( in_array( $wt_display_style, array( 'single_big_product' ) ) ) {
			$wt_etc_ar = array( 'image_width' => 451, 'image_height' => 564 );
		}
		
		$product_content = get_wt_neoncart_product_content( $products_obj, $wt_display_style, $wt_etc_ar );
		
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
			
			if( !empty( $cat_produtcs_filter ) ) {
				$list_box_contents[$row][$col]['params']['data-category'] = 
			}
		}

		$col ++;
		if ($col > ($max_display_columns - 1)) {
			$col = 0;
			$row ++;
		}
		$cp_index->MoveNextRandom();
	}

	if ($cp_index->RecordCount() > 0) {
		$title = '<h2 class="tt-title centerBoxHeading">' . sprintf('Custom Products', $zcDate->output('%B')) . '</h2>';
		$zc_show_custom_products = true;
	}
}
?>