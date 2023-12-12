<?php
#WT_NEONCART_TEMPLATE_BASE#

//Bof wt custom ---
global $product_style, $wt_display_style, $zco_notifier, $zcDate;
$wt_display_style = ( !empty( $wt_display_style ) ) ? $wt_display_style : 'slider';
$max_display_products = ( isset( $max_products ) ) ? $max_products : MAX_DISPLAY_NEW_PRODUCTS;
$max_display_columns = ( isset( $show_rows ) ) ? $show_rows : 1;
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

$relatedProducts = $db->Execute( "SELECT products_related FROM " . TABLE_PRODUCTS . " WHERE  products_id = '" . (int)$_GET['products_id'] ."'", 1 );
$products_related_where = '';
$num_products_count = $relatedProducts->RecordCount();
if ( $num_products_count > 0 AND !empty( $relatedProducts->fields['products_related'] ) ) {
	
	$related_string = explode('|', $relatedProducts->fields['products_related']);
	foreach ( $related_string as $keyword ) { $products_related_where .= "OR p.products_related REGEXP '" . $keyword . "' "; }
	$products_related_where = " AND (" . substr( $products_related_where, 2 ) . ") ";

	//Build query string to find related products
	$related_sql = "select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id, p.products_quantity, p.products_weight, p.products_priced_by_attribute, p.product_is_free, p.products_qty_box_status, p.products_quantity_order_max, p.products_discount_type, p.products_discount_type_from, p.products_sort_order, p.products_price_sorter, p.products_quantity, p.product_is_call, p.products_type, p.master_categories_id
		from   " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
		where  p.products_status = '1' " . $products_related_where . " and p.products_id != '" . (int)$_GET['products_id'] . "' and    pd.products_id = p.products_id and    pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";

	//Run Query and check for related products
	$related_products = $db->Execute( $related_sql, $max_display_products );
	
	$zc_show_related_products = false;
	
	$row = 0;
	$col = 0;
	$productsInCategory = array();
	$list_box_contents = array();
	$title = '';
	
	if ( $related_products->RecordCount() > 0 ) { ?>
		<div class="holder centerBoxWrapper" id="relatedProducts">

		<?php while (!$related_products->EOF) {
		
			$products_obj = $related_products;
					
			if (!isset($productsInCategory[$products_obj->fields['products_id']])) $productsInCategory[$products_obj->fields['products_id']] = zen_get_generated_category_path_rev($products_obj->fields['master_categories_id']);
			
			$cPath = $productsInCategory[$products_obj->fields['products_id']];
			$products_obj->fields['cPath'] = $cPath;
					
			//set Infopagelink
			$zen_get_info_page = wt_get_info_page($products_obj);
			$products_obj->fields['zen_get_info_page'] = $zen_get_info_page;
			
			$products_name = $products_obj->fields['products_name'];
		
			$product_content = get_wt_neoncart_product_content( $products_obj, '', array( "image_width" => IMAGE_PRODUCT_NEW_WIDTH, "image_height" => IMAGE_PRODUCT_NEW_HEIGHT ) );
			
			$products_price = $product_content['products_price'];
			/* $product_content['buy_now'] = zen_get_buy_now_button($products_obj->fields['products_id'],'<a class="tt-btn-addtocart thumbprod-button-bg btn-opt btn" href="' . zen_href_link(zen_get_info_page($products_obj->fields['products_id']), 'cPath=' . $productsInCategory[$products_obj->fields['products_id']] . '&products_id=' . $products_obj->fields['products_id'], 'SSL') . '"><span class="qck-text"></span> '.TITLE_VIEW_PRODUCT.'</a>');
			if ( $products_obj->fields['products_quantity'] <= 0 && $products_obj->fields['products_type'] != 3 && SHOW_PRODUCTS_SOLD_OUT_IMAGE == '1' ) {
				$product_content['buy_now'] = '<button class="normal_button button btn button_sold_out">'.WT_BADGE_SOLD_OUT.'</button>';
			} */
						
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
				$row ++;
			}
			$related_products->MoveNext();
		}
		
		$title = '<h2 class="tt-title centerBoxHeading">' . sprintf(BOX_HEADING_RELATED_PRODUCTS, $zcDate->output('%B')) . '</h2>';
		$zc_show_related_products = true;
		
		require( $template->get_template_dir('tpl_wt_display_styles.php', DIR_WS_TEMPLATE, $current_page_base,'wt_common'). '/tpl_wt_display_styles.php' );
	} ?>
	</div>
<?php }