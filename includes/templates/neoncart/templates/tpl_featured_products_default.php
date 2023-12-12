<?php
/**
 * Page Template - Featured Products listing
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 29 Modified in v1.5.8-alpha $
 */
?>
<div class="centerColumn products-in-listing" id="featuredDefault">

<h1 class="tt-title" id="featuredDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
  <?php
    /********************************** GRID LIST VIEW ***************************************/
    if ( defined( 'PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER' ) && PRODUCT_LISTING_LAYOUT_STYLE_CUSTOMER == '1' ) {
        $gridlist_tab = wt_neoncart_gridlist( FILENAME_PRODUCTS_ALL );
    }
    /**********************************EOF GRID LIST VIEW ***************************************/
  ?>
  <?php
    /**
     * require code to display the list-display-order dropdown
     */
    require($template->get_template_dir('/tpl_modules_listing_display_order.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_listing_display_order.php');
  ?>

  <?php
    if (PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART > 0 and $show_submit == true and $featured_products_split->number_of_rows > 0) {
      if ($show_top_submit_button == true or $show_bottom_submit_button == true) {
        echo zen_draw_form('multiple_products_cart_quantity', zen_href_link(FILENAME_FEATURED_PRODUCTS, zen_get_all_get_params(array('action')) . 'action=multiple_products_add_product'), 'post', 'enctype="multipart/form-data"');
      }
    }
  ?>
  <?php
    $openGroupWrapperDiv = false;
    if (($featured_products_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
      $openGroupWrapperDiv = true;
  ?>
  <div class="tt-pagination tt-pagination-left pagi-top mt-3">
    <div id="featuredProductsListingTopNumber" class="navSplitPagesResult back"><?php echo $featured_products_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_FEATURED_PRODUCTS); ?>
    </div>
    <div id="featuredProductsListingTopLinks" class="navSplitPagesLinks forward"><?php echo TEXT_RESULT_PAGE . $featured_products_split->display_links($max_display_page_links, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page')), $paginateAsUL); ?></div>
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


<?php
/**
 * display the featured products
 */
require($template->get_template_dir('/tpl_modules_products_featured_listing.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_products_featured_listing.php'); ?>

<?php require( $template->get_template_dir( 'tpl_wt_display_styles.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common'). '/tpl_wt_display_styles.php' ); ?>

  <?php
    if ($show_bottom_submit_button == false && PREV_NEXT_BAR_LOCATION == '1') {
      // nothing
    } else {
      echo '<div class="tt-pagination tt-pagination-left pagi-bot mt-4">';
    }
  ?>
  <?php
    if (($featured_products_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
  ?>
    <div id="featuredProductsListingBottomNumber" class="navSplitPagesResult back">
      <?php echo $featured_products_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_FEATURED_PRODUCTS); ?>
    </div>
    <div id="featuredProductsListingBottomLinks" class="navSplitPagesLinks forward">
      <?php echo TEXT_RESULT_PAGE . $featured_products_split->display_links($max_display_page_links, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page')), $paginateAsUL); ?>
    </div>
  <?php
    }
  ?>

  <?php
    if ($show_bottom_submit_button == true) {
    // only show button when there is something to submit
  ?>
    <div class="buttonRow forward">
      <?php echo zen_image_submit(BUTTON_IMAGE_ADD_PRODUCTS_TO_CART, BUTTON_ADD_PRODUCTS_TO_CART_ALT, 'id="submit2" name="submit1"'); ?>
    </div>
  <?php
    } // end show bottom button
  ?>
  <?php
  if ($show_bottom_submit_button == false && PREV_NEXT_BAR_LOCATION == '1') {
    // nothing
  } else {
    echo '</div>';
  }
  ?>
  <?php
    // only end form if form is created
    if ($show_top_submit_button == true or $show_bottom_submit_button == true) {
  ?>
  </form>
  <?php } // end if form is made ?>
</div>