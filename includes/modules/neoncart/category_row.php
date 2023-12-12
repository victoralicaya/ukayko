<?php
/**
 * index category_row.php
 *
 * Prepares the content for displaying a category's sub-category listing in grid format.  
 * Once the data is prepared, it calls the standard tpl_list_box_content template for display.
 *
 * @package page
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: category_row.php 4084 2006-08-06 23:59:36Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$title = '';
if ( !is_object( $categories ) ) {
  $categories_query = "SELECT c.categories_id, cd.categories_name, c.categories_image, c.parent_id
                         FROM   " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                         WHERE      c.parent_id = :parentID
                         AND        c.categories_id = cd.categories_id
                         AND        cd.language_id = :languagesID
                         AND        c.categories_status= '1'
                         ORDER BY   sort_order, cd.categories_name";

    $categories_query = $db->bindVars($categories_query, ':parentID', $current_category_id, 'integer');
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
              'class' => array( 'text-center', 'categoryListBoxContents' ),
          ),
          'text' =>
			'<div class="item_image">
				<a href="' . zen_href_link(FILENAME_DEFAULT, $cPath_new) . '">
				' . wt_image(DIR_WS_IMAGES . $categories->fields['categories_image'], $categories->fields['categories_name'], SUBCATEGORY_IMAGE_WIDTH, SUBCATEGORY_IMAGE_HEIGHT, 'class="cat-img"') . '
				</a>
			</div>
			<div class="item_content">
				<a href="' . zen_href_link(FILENAME_DEFAULT, $cPath_new) . '">
				<h5 class="item_title">' . $categories->fields['categories_name'] . '</h5>
				'. ( ( !empty( $count_products ) && $nums_count_products = zen_products_in_category_count( $categories->fields['categories_id'] ) ) ? sprintf( WT_CATEGORY_COUNT_PRODUCTS_TEXT, zen_products_in_category_count( $categories->fields['categories_id'] ) ) : '' ) .'</a>
			</div>'
          );
		  
			if( !empty( $cat_grid_style ) && $cat_grid_style == 1 ) {
				$list_box_contents[$row][$col]['params']['class'][] = 'ss_new_srrivals cat-style1';
			} else {
				$list_box_contents[$row][$col]['params']['class'][] = 'supermarket_deals_item';
			}
		  
		  
    $col ++;
    if ($col > (MAX_DISPLAY_CATEGORIES_PER_ROW -1)) {
      $col = 0;
      $row ++;
    }
    $categories->MoveNext();
  }
}
