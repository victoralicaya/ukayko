<?php
/**
 * Module Template
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 29 Modified in v1.5.8-alpha $
 */
 include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_PRODUCT_LISTING));
?>
<div class="centerColumn products-in-listing" id="productListing">
  <?php
    $openGroupWrapperDiv = false;
    if (($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
      $openGroupWrapperDiv = true;
  ?>
  <div class="tt-pagination tt-pagination-left pagi-top mt-3">
    <div id="productsListingTopNumber" class="navSplitPagesResult back"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?>
    </div>
    <div id="productsListingListingTopLinks" class="navSplitPagesLinks forward"><?php echo TEXT_RESULT_PAGE . $listing_split->display_links($max_display_page_links, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page')), $paginateAsUL); ?></div>
  <?php
    }
  ?>
  <?php
    if ($show_top_submit_button == true) {
  // only show when there is something to submit
  ?>
  <div class="buttonRow forward text-end">
    <?php echo zen_image_submit(BUTTON_IMAGE_ADD_PRODUCTS_TO_CART, BUTTON_ADD_PRODUCTS_TO_CART_ALT, 'id="submit1" name="submit1"'); ?>
  </div>
  <?php
    } // top submit button
  ?>
  <?php
  if ($openGroupWrapperDiv) {
    echo '</div>';
  }
  ?>

<?php require( $template->get_template_dir( 'tpl_wt_display_styles.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common'). '/tpl_wt_display_styles.php' ); ?>


<?php
if ($show_bottom_submit_button == false && PREV_NEXT_BAR_LOCATION == '1') {
  // nothing
} else {
  echo '<div class="tt-pagination tt-pagination-left pagi-bot mt-4">';
}
?>

<?php
  if (($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
  <div id="productsListingBottomNumber" class="navSplitPagesResult back"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></div>
  <div id="productsListingBottomLinks" class="navSplitPagesLinks forward"><?php echo TEXT_RESULT_PAGE . $listing_split->display_links($max_display_page_links, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page')), $paginateAsUL); ?></div>
<?php
  }
?>

<?php
  if ($show_bottom_submit_button == true) {
// only show when there is something to submit
?>
  <div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_ADD_PRODUCTS_TO_CART, BUTTON_ADD_PRODUCTS_TO_CART_ALT, 'id="submit2" name="submit1"'); ?></div>

<?php
  }  // bottom submit button
?>
<?php
if ($show_bottom_submit_button == false && PREV_NEXT_BAR_LOCATION == '1') {
  // nothing
} else {
  echo '</div>';
}
?>
</div>

<?php
// if ($show_top_submit_button == true || $show_bottom_submit_button == true || (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART != 0 && $show_submit == true && $listing_split->number_of_rows > 0)) {
  if ($show_top_submit_button == true or $show_bottom_submit_button == true) {
?>
</form>
<?php } ?>
