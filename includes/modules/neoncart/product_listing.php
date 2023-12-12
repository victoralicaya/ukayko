<?php
/**
 * product_listing module for v1.5.7/1.5.8
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: torvista 2022 Aug 03 Modified in v1.5.8-alpha2 $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$row = 0;
$col = 0;
$list_box_contents = [];
$title = '';
$show_top_submit_button = false;
$show_bottom_submit_button = false;
$error_categories = false;

//Bof wt custom ---
global $product_style, $wt_display_style;
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

// BOF Number of Items Per Page
if(isset($_POST['max_display']) || isset($_GET['max_display'])) {
	$_SESSION['product_listing_max_display'] = (int)$_REQUEST['max_display'];
} elseif (!isset($_SESSION['product_listing_max_display'])) {
	$_SESSION['product_listing_max_display'] = (int)MAX_DISPLAY_PRODUCTS_LISTING;
}
// EOF Number of Items Per Page

// Column Layout Support originally added for Zen Cart v 1.1.4 by Eric Stamper - 02/14/2004
// Upgraded to be compatible with Zen-cart v 1.2.0d by Rajeev Tandon - Aug 3, 2004
// Column Layout Support (Grid Layout) upgraded for v1.3.0 compatibility DrByte 04/04/2006
// Column Layout Support (Grid Layout) upgraded for v1.5.0 compatibility and changed to customer control asarfraz July 26 2012
// Modified for admin control of customer option by Glenn Herbert (gjh42) 2012-09-20   test 20120929 grid sorter
//
if (!defined('PRODUCT_LISTING_LAYOUT_STYLE')) define('PRODUCT_LISTING_LAYOUT_STYLE',(isset($_GET['view']) ? $_GET['view'] : 'rows'));
if (!defined('PRODUCT_LISTING_COLUMNS_PER_ROW')) define('PRODUCT_LISTING_COLUMNS_PER_ROW',3);
if (!defined('PRODUCT_LISTING_GRID_SORT')) define('PRODUCT_LISTING_GRID_SORT',0);
$product_listing_layout_style = isset($_GET['view'])? $_GET['view']: PRODUCT_LISTING_LAYOUT_STYLE;
$row = 0;
$col = 0;
$list_box_contents = array();
$title = '';

// $max_results = ($product_listing_layout_style=='columns' && PRODUCT_LISTING_COLUMNS_PER_ROW>0) ? (PRODUCT_LISTING_COLUMNS_PER_ROW * (int)(MAX_DISPLAY_PRODUCTS_LISTING/PRODUCT_LISTING_COLUMNS_PER_ROW)) : MAX_DISPLAY_PRODUCTS_LISTING;

//$max_results = (PRODUCT_LISTING_LAYOUT_STYLE=='columns' && PRODUCT_LISTING_COLUMNS_PER_ROW>0) ? (PRODUCT_LISTING_COLUMNS_PER_ROW * (int)($_SESSION['product_listing_max_display']/PRODUCT_LISTING_COLUMNS_PER_ROW)) : $_SESSION['product_listing_max_display'];

$show_submit = zen_run_normal();

/*$columns_per_row = defined('PRODUCT_LISTING_COLUMNS_PER_ROW') ? PRODUCT_LISTING_COLUMNS_PER_ROW : 1;
$product_listing_layout_style = (int)$columns_per_row > 1 ? 'columns' : 'table';
if (empty($columns_per_row)) $product_listing_layout_style = 'fluid';
if ($columns_per_row === 'fluid') $product_listing_layout_style = 'fluid';*/

$columns_per_row = defined('PRODUCT_LISTING_COLUMNS_PER_ROW') ? PRODUCT_LISTING_COLUMNS_PER_ROW : 1;
$max_results = (int)MAX_DISPLAY_PRODUCTS_LISTING;
if ($product_listing_layout_style === 'columns' && $columns_per_row > 1) {
    $max_results = ($columns_per_row * (int)($max_results / $columns_per_row));
}
if ($max_results < 1) $max_results = 1;

$listing_split = new splitPageResults($listing_sql, $max_results, 'p.products_id', 'page');
$zco_notifier->notify('NOTIFY_MODULE_PRODUCT_LISTING_RESULTCOUNT', $listing_split->number_of_rows);

// counter for how many items on the page can use add-to-cart, so we can decide what kinds of submit-buttons to offer in the template
$how_many = 0;

// Begin Row Layout Header
if ($product_listing_layout_style == 'rows' or PRODUCT_LISTING_GRID_SORT) {		// For Column Layout (Grid Layout) add on module

// Begin Row Headings
$list_box_contents[0] = ['params' => 'class="productListing-rowheading"'];

$zc_col_count_description = 0;
for ($col = 0, $n = count($column_list); $col < $n; $col++) {
	$lc_align = '';
	$lc_text = '';
	switch ($column_list[$col]) {
    case 'PRODUCT_LIST_MODEL':
    $lc_text = TABLE_HEADING_MODEL;
    $lc_align = '';
    $zc_col_count_description++;
    break;
    case 'PRODUCT_LIST_NAME':
    $lc_text = TABLE_HEADING_PRODUCTS;
    $lc_align = '';
    $zc_col_count_description++;
    break;
    case 'PRODUCT_LIST_MANUFACTURER':
    $lc_text = TABLE_HEADING_MANUFACTURER;
    $lc_align = '';
    $zc_col_count_description++;
    break;
    case 'PRODUCT_LIST_PRICE':
    $lc_text = TABLE_HEADING_PRICE;
    $lc_align = 'right' . (PRODUCTS_LIST_PRICE_WIDTH > 0 ? '" width="' . PRODUCTS_LIST_PRICE_WIDTH : '');
    $zc_col_count_description++;
    break;
    case 'PRODUCT_LIST_QUANTITY':
    $lc_text = TABLE_HEADING_QUANTITY;
    $lc_align = 'right';
    $zc_col_count_description++;
    break;
    case 'PRODUCT_LIST_WEIGHT':
    $lc_text = TABLE_HEADING_WEIGHT;
    $lc_align = 'right';
    $zc_col_count_description++;
    break;
    case 'PRODUCT_LIST_IMAGE':
	$lc_text = '&nbsp;';
	//$lc_text = TABLE_HEADING_IMAGE;   //-Uncomment this line if you want the "Products Image" header title
    $zc_col_count_description++;
    break;
	default:
    break;
  }

  	// Add clickable "sort" links to column headings
  	if ($column_list[$col] !== 'PRODUCT_LIST_IMAGE') {
		$lc_text = zen_create_sort_heading(isset($_GET['sort']) ? $_GET['sort'] : '', $col + 1, $lc_text);
	}
}


    $grid_sort = $list_box_contents[0];
	if ($product_listing_layout_style == 'rows') {
		$list_box_contents = array();
		$list_box_contents[0] = array('text' => '');
	}
	if ($product_listing_layout_style == 'columns') {
       $list_box_contents = array();
	}
	$listing_asc_des = wt_neoncart_create_sort_heading_asc_des( $_GET['sort'] , '', '' );
	$gridlist_tab = '';
	if ( defined('PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER') && PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER == '1' ) {
		$gridlist_tab = wt_neoncart_gridlist( FILENAME_DEFAULT );
	}

} // End Row Layout Header used in Column Layout (Grid Layout) add on module

/////////////  HEADER ROW ABOVE /////////////////////////////////////////////////
$num_products_count = $listing_split->number_of_rows;
$rows = 0;
$column = 0;
$extra_row = 0;
$skip_sort = false;
if ($num_products_count > 0) {
	// if in fixed-columns mode, calculate column width
    if ($product_listing_layout_style === 'columns') {
        $calc_value = $columns_per_row;
        if ($num_products_count < $columns_per_row || $columns_per_row == 0) {
            $calc_value = $num_products_count;
        }
        $col_width = floor(100 / $calc_value) - 0.5;
    }
	
	// Used for Column Layout (Grid Layout) add on module
  
	$listing = $db->Execute($listing_split->sql_query);
	// Retrieve all records into an array to allow for sorting and insertion of additional data if needed
    $records = [];
	while (!$listing->EOF) {
		$category_id = !empty($listing->fields['categories_id']) ? $listing->fields['categories_id'] : $listing->fields['master_categories_id'];
        $parent_category_name = trim(zen_get_categories_parent_name($category_id));
        $category_name = trim(zen_get_category_name($category_id, (int)$_SESSION['languages_id']));
        $records[] = array_merge($listing->fields,
            [
                'parent_category_name' => (!empty($parent_category_name)) ? $parent_category_name : $category_name,
                'category_name' => $category_name,
//                'products_name' => $listing->fields['products_name'],
//                'master_categories_id' => $listing->fields['master_categories_id'],
//                'products_sort_order' => $listing->fields['products_sort_order'],
            ]);
        $listing->MoveNext();
    }

    if (!empty($_GET['keyword'])) $skip_sort = true;
    // add additional criteria for sort exclusions here if needed

    // SORT ACCORDING TO SPECIAL NEEDS
    if (empty($skip_sort)) {
        // add custom array_multisort code here if needed; otherwise the sort is based on the db query, whose sort order is influenced by index_filters and $_GET parameters
    }
    foreach ($records as $record) {
        if ($product_listing_layout_style === 'table') {
            $rows++;
            // handle even/odd striping if not set already with CSS
            $list_box_contents[$rows] = ['params' => 'class="productListing-' . ((($rows - $extra_row) % 2 == 0) ? 'even' : 'odd') . '"'];
        }
		//        if ($product_listing_layout_style !== 'table') {
		//            // insert breaks when the category changes
		//            if (empty($_GET['manufacturers_id']) || !in_array($current_page_base, ['advanced_search_result'])) {
		//                if (!isset($listing_prev_cat)) $listing_prev_cat = '';
		//                $listing_current_cat = $record['category_name'];
		//                if ($listing_current_cat !== $listing_prev_cat) {
		//                    $listing_prev_cat = $listing_current_cat;
		//
		//                    // category divider
		//                    if ($product_listing_layout_style == 'columns') $column = 0;
		//                    $rows++;
		//                    $list_box_contents[$rows][] = [
		//                        'params' => 'class="h3 categoryHeader row row-cols-1 text-left"',
		//                        'text' => $listing_current_cat,
		//                    ];
		//                    $column = 0;
		//                    $rows++;
		//                }
		//            }
		//        }

        // set css classes for "row" wrapper, to allow for fluid grouping of cells based on viewport
        // these defaults are based on Bootstrap4, but can be customized to suit your own framework
		if ($product_listing_layout_style === 'fluid') {
			$grid_cards_classes = 'row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3';
			// this array is intentionally in reverse order, with largest index first
			$grid_classes_matrix = [
				'10' => 'row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-5',
				'8' => 'row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4',
				'6' => 'row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3',
			];
			// determine classes to use based on number of grid-columns used by "center" column
			if (isset($center_column_width)) {
				foreach ($grid_classes_matrix as $width => $classes) {
					if ($center_column_width >= $width) {
						$grid_cards_classes = $classes;
						break;
					}
				}
			}
			$list_box_contents[$rows]['params'] = 'class="row ' . $grid_cards_classes . ' text-center"';
		}
		$product_etc_info='';
		if ($product_listing_layout_style == 'rows') { // Used in Column Layout (Grid Layout) Add on module
			$rows++;
			if ((($rows-$extra_row)/2) == floor(($rows-$extra_row)/2)) {
				$list_box_contents[$rows] = array('params' => 'class="item even"');
			} else {
				$list_box_contents[$rows] = array('params' => 'class="item odd"');
			}
			$cur_row = sizeof($list_box_contents) - 1;
		}
		// End of Conditional execution - only for row (regular style layout)
		
		$linkCpath = $record['master_categories_id'];
        if (!empty($_GET['cPath'])) $linkCpath = $_GET['cPath'];
        if (!empty($_GET['manufacturers_id']) && !empty($_GET['filter_id'])) $linkCpath = $_GET['filter_id'];

		$product_contents = []; // Used For Column Layout (Grid Layout) Add on module
		$products_name = $record['products_name'];
		$products_description_full = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($record['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION); //To Display Product Desc 
		$products_description_list = ltrim(substr($products_description_full, 0, 250) . ''); //Trims and Limits the desc
		
		/*BOF changed by WT Tech. -------------------*/
		
		//set cPath
		$cPath = ( ( !empty( $_GET['manufacturers_id'] ) &&  !empty( $_GET['filter_id'] ) ) ?  zen_get_generated_category_path_rev( $_GET['filter_id'] ) : ( !empty( $_GET['cPath'] ) ? zen_get_generated_category_path_rev( $_GET['cPath'] ) : zen_get_generated_category_path_rev( $record['master_categories_id'] ) ) );
		$record['cPath'] = $cPath;
		
		$products_obj = $record;
		if (!isset($productsInCategory[$products_obj['products_id']])) $productsInCategory[$products_obj['products_id']] = zen_get_generated_category_path_rev($products_obj['master_categories_id']);
		$products_obj['cPath'] = $cPath;
		
		//set Infopagelink
		$zen_get_info_page = wt_get_info_page($record);
		$record['zen_get_info_page'] = $zen_get_info_page;
		
		$wt_display_style = 'grid';
		$product_content = get_wt_neoncart_product_content( $record, $wt_display_style );
		
		/*EOF changed by WT Tech. -------------------*/
		$moreinfo = '<a class="more_info_text" href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $record['products_id'], 'SSL') . '">'.MORE_INFO_TEXT.'</a>';
		//for($col=0, $n=sizeof($column_list); $col<$n; $col++) {
		for ($col = 0, $n = count($column_list); $col < $n; $col++) {
			$lc_align = '';
            $lc_text = '';

            $href = zen_href_link(zen_get_info_page($record['products_id']), 'cPath=' . zen_get_generated_category_path_rev($linkCpath) . '&products_id=' . $record['products_id']);
            $listing_product_name = (isset($record['products_name'])) ? $record['products_name'] : '';
            $listing_description = '';
            if ((int)PRODUCT_LIST_DESCRIPTION > 0) {
                $listing_description = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($record['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION);
                $lc_text .= '<div class="listingDescription">' . $listing_description . '</div>';
            }
            $listing_model = (isset($record['products_model'])) ? $record['products_model'] : '';
            $listing_mfg_name = (isset($record['manufacturers_name'])) ? $record['manufacturers_name'] : '';
            $listing_quantity = (isset($record['products_quantity'])) ? $record['products_quantity'] : 0;
            $listing_weight = (isset($record['products_weight'])) ? $record['products_weight'] : 0;
            $listing_mfg_link = zen_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . (int)$record['manufacturers_id']);
            $listing_price = zen_get_products_display_price($record['products_id']);
            //$more_info_button = '<a class="moreinfoLink list-more" href="' . $href . '" title="' . $record['products_id'] . '">' . MORE_INFO_TEXT . '</a>';
			$more_info_button = '<a class="button btn addtocart_btn thumbprod-button-bg btn-opt btn" href="' . $href . '" title="' . $record['products_id'] . '" '.wtExtraBtnLink($listing).'><i class="far fa-list"></i><span class="qck-text hidden">' . TITLE_SELECT_OPTIONS . '</span></a>';
            $buy_now_link = zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $record['products_id']);
            $buy_now_button = '<a class="" href="' . $buy_now_link . '">' . zen_image_button(BUTTON_IMAGE_BUY_NOW, BUTTON_BUY_NOW_ALT, 'class="listingBuyNowButton"') . '</a>';
            $listing_qty_input_form = zen_draw_form('cart_quantity', zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=add_product&products_id=' . $record['products_id']), 'post', 'enctype="multipart/form-data"')
                . '<input class="" type="text" name="cart_quantity" value="' . (zen_get_buy_now_qty($record['products_id'])) . '" maxlength="6" size="4" aria-label="' . ARIA_QTY_ADD_TO_CART . '">'
                . '<br>'
                . zen_draw_hidden_field('products_id', $record['products_id'])
                . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT)
                . '</form>';

            $lc_button = '';

			if (zen_requires_attribute_selection($record['products_id']) || PRODUCT_LIST_PRICE_BUY_NOW == '0') {
                // more info in place of buy now
                $lc_button = $more_info_button;
            } else {
                if (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART != 0) {
                    if (
                        // not a hide qty box product
                        $record['products_qty_box_status'] != 0 &&
                        // product type can be added to cart
                        zen_get_products_allow_add_to_cart($record['products_id']) != 'N'
                        &&
                        // product is not call for price
                        $record['product_is_call'] == 0
                        &&
                        // product is in stock or customers may add it to cart anyway
                        ($listing_quantity > 0 || SHOW_PRODUCTS_SOLD_OUT_IMAGE == 0)
                    ) {
                        $how_many++;
                    }
                    // hide quantity box
                    if ($record['products_qty_box_status'] == 0) {
                        $lc_button = '';
                        $lc_button .= $buy_now_button;
                    } else {
                        $lc_button = '';
                        $lc_button .= TEXT_PRODUCT_LISTING_MULTIPLE_ADD_TO_CART;
                        $lc_button .= '<input class="" type="text" name="products_id[' . $record['products_id'] . ']" value="0" size="4" aria-label="' . ARIA_QTY_ADD_TO_CART . '">';
                    }
                } else {
                    // qty box with add to cart button
                    if (PRODUCT_LIST_PRICE_BUY_NOW == '2' && $record['products_qty_box_status'] != 0) {
                        $lc_button = '';
                        $lc_button .= $listing_qty_input_form;
                    } else {
                        $lc_button = '';
                        $lc_button .= $buy_now_button;
                    }
                }
            }
            $zco_notifier->notify('NOTIFY_MODULES_PRODUCT_LISTING_PRODUCTS_BUTTON', [], $record, $lc_button);

			switch ($column_list[$col]) {
				case 'PRODUCT_LIST_MODEL':
					$lc_align = '';
					if( !empty( $listing->fields['products_model'] ) ) {
						$product_etc_info.= '<div class="product-model">'.TABLE_HEADING_MODEL.' : '.$listing->fields['products_model']."</div>";
					}
		
					break;
				case 'PRODUCT_LIST_NAME':
					$lc_align = '';
					$lc_text = '<h3 class="itemTitle">
						<a href="' . zen_href_link(zen_get_info_page($listing->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($linkCpath) . '&products_id=' . $listing->fields['products_id']) . '">' . $listing->fields['products_name'] . '</a>
						</h3>
						<div class="listingDescription">' . zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($listing->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION) . '</div>';
					break;
				case 'PRODUCT_LIST_MANUFACTURER':
					$lc_align = '';
					if($listing->fields['manufacturers_name']!=''){
						$product_etc_info .= '<div class="product-menufacture">'.TABLE_HEADING_MANUFACTURER.' : '.'<span><a href="' . zen_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing->fields['manufacturers_id'], 'SSL') . '">' . $listing->fields['manufacturers_name'] . '</a></span></div>';}
						//$lst_lc_text = '<div class="product-menufacture"><a href="' . zen_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing->fields['manufacturers_id']) . '">' . $listing->fields['manufacturers_name'] . '</a></div>';
					break;
				case 'PRODUCT_LIST_PRICE':
					$lc_price = $product_content['products_price'];
					$lc_buy_now='';
					$lc_align = 'right';
					//$lc_buy_now =  $lc_price;
					$lst_lc_text =  $lc_price;
					// more info in place of buy now
					$lc_button = '';
		
					if ($product_content['zen_has_product_attributes'] or PRODUCT_LIST_PRICE_BUY_NOW == '0') {
						$lc_button = '<a class="button addtocart_btn thumbprod-button-bg btn-opt btn" title="'. TITLE_SELECT_OPTIONS .'" href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $listing->fields['products_id']) . '" '.wtExtraBtnLink($listing).'><i class="far fa-list"></i></a>';
					}else {
						if (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART != 0) {
							if (
							// not a hide qty box product
							$listing->fields['products_qty_box_status'] != 0 &&
							// product type can be added to cart
							$product_content['zen_get_products_allow_add_to_cart'] != 'N'
							&&
							// product is not call for price
							$listing->fields['product_is_call'] == 0
							&&
							// product is in stock or customers may add it to cart anyway
							($listing->fields['products_quantity'] > 0 || SHOW_PRODUCTS_SOLD_OUT_IMAGE == 0) ) {
								$how_many++;
							}
							// hide quantity box
							if ($listing->fields['products_qty_box_status'] == 0) {
								$lc_button = '<a class="button addtocart_btn thumbprod-button-bg" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing->fields['products_id']) . '" '.wtExtraBtnLink($listing).'>' . zen_image_button(BUTTON_IMAGE_BUY_NOW, BUTTON_BUY_NOW_ALT, 'class="listingBuyNowButton"') . '</a>';
							} else {
								$lc_button = '<div class="prod-qty-bx"><div class="inner-qty-box"><span class="qty-lbl">'.TEXT_PRODUCT_LISTING_MULTIPLE_ADD_TO_CART . "</span><span class='qty_txt'><input type=\"text\" name=\"products_id[" . $listing->fields['products_id'] . "]\" value=\"0\" size=\"1\" /></span>".'</div></div>';
							}
						}else{
							// qty box with add to cart button

							if (PRODUCT_LIST_PRICE_BUY_NOW == '2' && $listing->fields['products_qty_box_status'] != 0) {
								$lc_button= zen_draw_form('cart_quantity', zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=add_product&products_id=' . $listing->fields['products_id']), 'post', 'enctype="multipart/form-data"') . '<div class="prod-qty-bx"><div class="inner-qty-box"><span class="qty-lbl">'.TEXT_PRODUCT_LISTING_MULTIPLE_ADD_TO_CART .'</span><span class="qty_txt"><input type="text" name="cart_quantity" value="' . (zen_get_buy_now_qty($listing->fields['products_id'])) . '" maxlength="6" size="4" /></span></div></div>' . zen_draw_hidden_field('products_id', $listing->fields['products_id']) . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT, '', ' btn btn-cart') . '</form>';
							} else {
								$lc_button = '<a class="button btn addtocart_btn thumbprod-button-bg" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing->fields['products_id']) . '" '.wtExtraBtnLink($listing).'><i class="fal fa-shopping-basket"></i><span class="qck-text d-none">'.TITLE_ADD_TO_CART.'</span></a>';							}
						}
					}
					
					
					$the_button = $lc_button;
					if($listing->fields['product_is_call'] != '1'){
						$products_link = '<a href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $listing->fields['products_id']) . '">' . MORE_INFO_TEXT . '</a>';
					}
					//if not out of stock
					if($listing->fields['products_quantity'] > 0 || SHOW_PRODUCTS_SOLD_OUT_IMAGE == 0){
						if(($product_content['zen_get_products_allow_add_to_cart'] != 'N') && $listing->fields['product_is_call'] == '1'){ 
							$lc_buy_now.='<a class="btn-callforprice btn" href="' . zen_href_link(FILENAME_CONTACT_US, '', 'SSL') . '"><span class="icon icon-call"></span>' . TEXT_CALL_FOR_PRICE . '</a>';
						}else{
							$minmaxqty=zen_get_products_quantity_min_units_display($listing->fields['products_id']);
							$lc_buy_now .=  zen_get_buy_now_button($listing->fields['products_id'], $the_button, $products_link) .(($minmaxqty)? '<span class="min-max-qty">'.$minmaxqty.'</span>' : '');
						}
					}
					$lc_buy_now .= (wt_get_show_product_switch($listing->fields['products_id'], 'ALWAYS_FREE_SHIPPING_IMAGE_SWITCH') ? (zen_get_product_is_always_free_shipping($listing->fields['products_id']) ? TEXT_PRODUCT_FREE_SHIPPING_ICON  : '') : '');
					break;
				case 'PRODUCT_LIST_QUANTITY':
					$lc_align = 'right';
					if($listing->fields['products_quantity']!=''){
					$product_etc_info .= '<div class="product-qty">'.TABLE_HEADING_QUANTITY.' : '.$listing->fields['products_quantity']."</div>";}
					//$lst_lc_text = '<div class="product-qty">'.$listing->fields['products_quantity']."</div>";
					break;
				case 'PRODUCT_LIST_WEIGHT':
					$lc_align = 'right';
					if($listing->fields['products_weight']!=''){
					$product_etc_info .= '<div class="product-weight">'.TABLE_HEADING_WEIGHT.' : '.$listing->fields['products_weight'].'</div>';}
					//$lst_lc_text = '<div class="product-weight">'.$listing->fields['products_weight'].'</div>';
					break;
				case 'PRODUCT_LIST_IMAGE':
					$lc_align = 'center';
					if ($listing->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) {
						$lc_text = '';
						$lst_lc_text = '';
					}else {
						if (isset($_GET['manufacturers_id'])) {
							$product_img_link=   zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $listing->fields['products_id'], 'SSL');
							$product_img = zen_image(DIR_WS_IMAGES . $listing->fields['products_image'], $products_name, IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT);
						}else {
							$product_img = zen_image(DIR_WS_IMAGES . $listing->fields['products_image'], $products_name, IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT);
					  }
					}
					break;
			}
			$product_contents[] = $lc_text; // Used For Column Layout (Grid Layout) Option
		}
		
		
		$display_prod_list_price = get_wt_neoncart_options( 'display_prod_list_price', 1 );
		$display_prod_list_addtocart = get_wt_neoncart_options( 'display_prod_list_addtocart', 1 );
		
		$products_price = ( $display_prod_list_price ) ? $lc_price : '';
		$products_description = $products_description_list.$moreinfo;
		$product_content['buy_now'] = ( $lc_buy_now && $display_prod_list_addtocart == 1 ) ? $lc_buy_now : '';

		$show_addtocart_qty_box = ( PRODUCT_LISTING_MULTIPLE_ADD_TO_CART !=0 || (PRODUCT_LIST_PRICE_BUY_NOW == '2' && $listing->fields['products_qty_box_status'] != 0) ) ? true : false;
		
		if ( $product_listing_layout_style == 'rows' ) {
			$list_box_contents[$rows][$column] = array(
				'products_type' => 'product_listing',
				'products_count' => $num_products_count,
				'params' => array ( 
					'class' => $product_content['products_class'],
				),
				'text' => '<div class="carparts_product_listlayout product-item products-item-list btn-icon-text" data-bg-color="#f0eeee">
								'. ( ( empty( $show_product_image ) || ( empty( $products_obj['products_image'] ) && PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0 ) ) ? '' : '
									<div class="item_image">
										'. $product_content['products_image'] .'
										' . ( ( !empty( $show_product_labels ) ?  '<ul class="product_label ul_li_block clearfix">'. $product_content['products_label'] .'</ul>' : '' ) ) . '
									</div>
								' ) . '
								<div class="item_content">
									' . ( ( !empty( $show_product_name ) ) ? '<h3 class="item_title"><a href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_obj['products_id'], 'SSL') . '">' . $products_name . '</a></h3>' : '' ) . '
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
			$lst_lc_text = '';
			$lc_text = '';
		}
		
		if ( $product_listing_layout_style == 'columns' ) {
		
			$list_box_contents[$rows][$column] = array(
				'products_type' => 'product_listing',
				'products_count' => $num_products_count,
				'params' => array ( 
					'class' => $product_content['products_class'],
				),
				'text' => 
					'<div class="product-item '. wt_get_products_class() .'">
						'. ( ( empty( $show_product_image ) || ( empty( $products_obj['products_image'] ) && PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0 ) ) ? '' : '
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
							' . ( ( !empty( $show_product_name ) ) ? '<h3 class="item_title"><a href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_obj['products_id'], 'SSL') . '">' . $products_name . '</a></h3>' : '' ) . '
							' . ( ( !empty( $show_product_reviews ) ) ? $product_content['products_review'] : '' ) . '
							' . ( ( !empty( $show_product_price ) ) ? '<div class="item_price">'. $products_price .'</div>' : '' ) . '
							' . ( $show_addtocart_qty_box == true && ( ( $buy_now = $product_content['buy_now'] ) ) ? 
								'<div class="product_action_bot_btns">' . $buy_now .'</div>'
							: '' ) . '
						</div>
					</div>'
				);
				
			$column ++;
			
			if ($column >= PRODUCT_LISTING_COLUMNS_PER_ROW) {
				$column = 0;
				$rows ++;
			}
			$lc_text='';
			$product_etc_info='';
			$product_price_box='';
		}
		// End of Code fragment for Column Layout (Grid Layout) option in add on module
	}
	$error_categories = false;
} else {

	$list_box_contents = array();
	$list_box_contents[0][] = array(
				'products_type' => 'product_listing',
				'products_count' => $num_products_count,
				'params' => array ( 
					'class' => '',
				),
				'text' => '<div class="empty-category">
								<div class="alert alert-danger">
									<div class="empty-category-text"><span>SORRY</span>, '.TEXT_NO_PRODUCTS.'</div>
									<div class="empty-category-icon"><i class="icon-sad-face"></i></div>
								</div>
							</div>'
				);

  $error_categories = true;
}

if (($how_many > 0 && $show_submit == true && $num_products_count > 0) && (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART == 1 || PRODUCT_LISTING_MULTIPLE_ADD_TO_CART == 3)) {
    $show_top_submit_button = true;
}
if (($how_many > 0 && $show_submit == true && $num_products_count > 0) && (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART >= 2)) {
    $show_bottom_submit_button = true;
}

$zco_notifier->notify('NOTIFY_PRODUCT_LISTING_END', $current_page_base, $list_box_contents, $listing_split, $show_top_submit_button, $show_bottom_submit_button, $show_submit, $how_many);

if ($how_many > 0 && PRODUCT_LISTING_MULTIPLE_ADD_TO_CART != 0 && $show_submit == true && $num_products_count > 0) {
    // bof: multiple products
    echo zen_draw_form('multiple_products_cart_quantity', zen_href_link(FILENAME_DEFAULT, zen_get_all_get_params(array('action')) . 'action=multiple_products_add_product', $request_type), 'post', 'enctype="multipart/form-data"');
}

