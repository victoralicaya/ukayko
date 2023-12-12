<?php
/**
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Scott C Wilson 2023 Mar 12 Modified in v1.5.8a $
 */
?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <body>
    <div class="container-fluid">
      <div class="row">
          <table id="categories-products-table" class="table table-striped">
            <?php

            //$products_split = new splitPageResults($_GET['page'], $max_results, $products_query_raw, $products_query_numrows);
            //$products = $db->Execute($products_query_raw);
// Split Page
          if (!$accountHasListing){
            ?>
            <div class="centerColumn" id="noListingDefault">
              <div class="alert alert-info"><?php echo TEXT_NO_LISTINGS; ?></div>
            </div>
          <?php }
          else{
            foreach ($myListings as $product) {
              ?>
              <tr class="product-listing-row" data-pid="<?php echo $product['products_id']; ?>">
                <td class="text-right"><?php echo $product['products_id']; ?></td>
                <td class="dataTableButtonCell">
                    <a href="<?php echo zen_href_link(FILENAME_LISTING, 'cPath=' . $cPath . '&product_type=' . $product['products_type'] . '&pID=' . $product['products_id'] . '&action=new_product'); ?>" title="" style="text-decoration: none">
                        <?php echo $product['products_name']; ?>
                    </a>
                </td>
                <td class="hidden-sm hidden-xs"><?php echo zen_image(zen_get_products_image($product['products_id']),'', IMAGE_SHOPPING_CART_WIDTH, IMAGE_SHOPPING_CART_HEIGHT); ?></td>
                <td class="hidden-sm hidden-xs"><?php echo $product['products_model']; ?></td>
                <td class="text-right hidden-sm hidden-xs"><?php echo zen_get_products_display_price($product['products_id']); ?></td>
<?php
              $extra_data = false;
              $zco_notifier->notify('NOTIFY_ADMIN_PROD_LISTING_DATA_B4_QTY', $product, $extra_data);
              if (is_array($extra_data)) {
                  foreach ($extra_data as $data_info) {
                      $align = (isset($data_info['align'])) ? (' text-' . $data_info['align']) : '';
?>
                <td class="hidden-sm hidden-xs<?php echo $align; ?>"><?php echo $data_info['text']; ?></td>
<?php
                  }
              }
?>
                <td class="text-right hidden-sm hidden-xs"><?php echo $product['products_quantity']; ?></td>
<?php
              $extra_data = false;
              $zco_notifier->notify('NOTIFY_ADMIN_PROD_LISTING_DATA_AFTER_QTY', $product, $extra_data);
              if (is_array($extra_data)) {
                  foreach ($extra_data as $data_info) {
                      $align = (isset($data_info['align'])) ? (' text-' . $data_info['align']) : '';
?>
                <td class="hidden-sm hidden-xs<?php echo $align; ?>"><?php echo $data_info['text']; ?></td>
<?php
                  }
              }
?>
                <td class="text-right text-nowrap dataTableButtonCell">
                  <?php
                  $additional_icons = '';
                  $zco_notifier->notify('NOTIFY_ADMIN_PROD_LISTING_ADD_ICON', $product, $additional_icons);
                  echo $additional_icons;
                  ?>
                  <?php if (zen_get_product_is_linked($product['products_id']) === 'true') { ?>
                    <i class="fa fa-square fa-lg txt-linked" aria-hidden="true" title="<?php echo IMAGE_ICON_LINKED; ?>"></i>
                  <?php } else { ?>
                    <i class="fa fa-square fa-lg txt-transparent"></i> <!-- blank icon to preserve vertical alignment with additional icons -->
                    <?php
                  }
                  echo zen_draw_form('setflag_products' . $product['products_id'], FILENAME_CATEGORY_PRODUCT_LISTING, 'action=setflag&pID=' . $product['products_id'] . '&cPath=' . $cPath . (isset($_GET['page']) ? '&page=' . $_GET['page'] : ''));
                  if ($product['products_status'] === '1') {
                    ?>
                    <i class="fa fa-square fa-lg txt-status-on" title="" role="button"></i>
                    <?php echo zen_draw_hidden_field('flag', '0'); ?>
                  <?php } else { ?>
                    <i class="fa fa-square fa-lg txt-status-off" title="" role="button"></i>
                    <?php echo zen_draw_hidden_field('flag', '1'); ?>
                  <?php } ?>
                  <?php echo '</form>'; ?>
                </td>
              </tr>
            <?php } }?>
          </table>
        </div>
      </div>
  </body>
</html>
