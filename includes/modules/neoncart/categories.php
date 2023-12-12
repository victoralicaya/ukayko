<?php
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

//Bof wt custom ---
global $product_style, $wt_display_style;
if ( empty( $wt_display_style ) ) {
	$wt_display_style = 'slider';
}

$max_display_categories = 6;
if ( isset( $max_categoris ) ) {
	$max_display_categories = $max_display_categories;
}

$max_display_columns = SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS;
if ( isset( $show_rows ) ) {
	$max_display_columns = $show_rows;
}

$categories_list_ar = array();
if ( !empty( $ids ) ) {
	$categories_list_ar = explode(",", $ids);
	$categories_list_ar = array_filter($categories_list_ar);
}

$count_products = false;
if ( !empty( $show_count_products ) ) {
	$count_products = true;
}



//Eof wt custom ---

$title = '';
if ( empty( $categories ) ) {
	$categories_query = "SELECT c.categories_id, cd.categories_name, c.categories_image, c.parent_id
						 FROM   " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
						 WHERE      c.parent_id = :parentID
						 AND        c.categories_id = cd.categories_id
						 AND        cd.language_id = :languagesID
						 AND        c.categories_status= '1'
						 :filterCategories
						 ORDER BY   sort_order, cd.categories_name";
						 
	$categories_query = $db->bindVars($categories_query, ':filterCategories', ( ( !empty( $categories_list_ar ) ) ? 'AND c.categories_id in ('. implode( ',', $categories_list_ar ) .') ' : '' ), 'noquotestring');
	$categories_query = $db->bindVars($categories_query, ':parentID', ( !empty( $current_category_id ) ? $current_category_id : 0 ), 'integer');
	$categories_query = $db->bindVars($categories_query, ':languagesID', $_SESSION['languages_id'], 'integer');
	$categories = $db->Execute($categories_query);
}
$num_categories = $categories->RecordCount();

$row = 0;
$col = 0;
$list_box_contents = array();
if ($num_categories > 0) {
  if ($num_categories < MAX_DISPLAY_CATEGORIES_PER_ROW || MAX_DISPLAY_CATEGORIES_PER_ROW == 0) {
    $col_width = floor(100/$num_categories);
  } else {
    $col_width = floor(100/MAX_DISPLAY_CATEGORIES_PER_ROW);
  }
  while (!$categories->EOF) {
    if (!$categories->fields['categories_image']) $categories->fields['categories_image'] = 'pixel_trans.gif';
    $cPath_new = zen_get_path($categories->fields['categories_id']);

    // strip out 0_ from top level cats
    $cPath_new = str_replace('=0_', '=', $cPath_new);

    //    $categories->fields['products_name'] = zen_get_products_name($categories->fields['products_id']);
	$list_box_contents[$row][$col] = array(
          'products_type' => 'category_row',
          'params' => array ( 
              'class' => array( 'supermarket_deals_item', 'categoryListBoxContents' ),
          ),
          'text' =>
			'<div class="supermarket_deals_item text-center">
				<div class="item_image">
					<a href="' . zen_href_link(FILENAME_DEFAULT, $cPath_new) . '">
					' . wt_image(DIR_WS_IMAGES . $categories->fields['categories_image'], $categories->fields['categories_name'], SUBCATEGORY_IMAGE_WIDTH, SUBCATEGORY_IMAGE_HEIGHT, 'class="cat-img"') . '
					</a>
				</div>
				<div class="item_content">
					<a href="' . zen_href_link(FILENAME_DEFAULT, $cPath_new) . '">
						<h4 class="item_title">' . $categories->fields['categories_name'] . '</h4>
						'. ( ( !empty( $count_products ) && $nums_count_products = zen_products_in_category_count( $categories->fields['categories_id'] ) ) ? sprintf( WT_CATEGORY_COUNT_PRODUCTS_TEXT, zen_products_in_category_count( $categories->fields['categories_id'] ) ) : '' ) .'
					</a>
				</div>
			</div>'
          );
    $col ++;
    if ($col > (MAX_DISPLAY_CATEGORIES_PER_ROW -1)) {
      $col = 0;
      $row ++;
    }
    $categories->MoveNext();
  }
}

require( $template->get_template_dir( 'tpl_wt_display_styles.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common'). '/tpl_wt_display_styles.php' );
