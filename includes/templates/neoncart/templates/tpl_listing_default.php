<?php
/**
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 24 Modified in v1.5.8-alpha $
 */

$action = (isset($_GET['action']) ? $_GET['action'] : '');

if (!empty($action)) {
  switch ($action) {

    case 'insert_product_meta_tags':
    case 'update_product_meta_tags':
      if (file_exists(DIR_WS_MODULES . '/update_product_meta_tags.php')) {
        require(DIR_WS_MODULES . '/update_product_meta_tags.php');
      } else {
        require(DIR_WS_MODULES . 'update_product_meta_tags.php');
      }
      break;
    case 'insert_product':
    case 'update_product':
      if (file_exists(DIR_WS_MODULES . '/update_product.php')) {
        require(DIR_WS_MODULES . '/update_product.php');
      } else {
        require(DIR_WS_MODULES . 'update_product.php');
      }
      break;
    case 'new_product_preview':
      if (!isset($_POST['master_categories_id'])
          || ((isset($_POST['products_model']) ? $_POST['products_model'] : '') . (isset($_POST['products_url']) ? implode('', $_POST['products_url']) : '') . (isset($_POST['products_name']) ? implode('', $_POST['products_name']) : '') . (isset($_POST['products_description']) ? implode('', $_POST['products_description']) : '') == '')
      ) {
          $messageStack->add(ERROR_NO_DATA_TO_SAVE, 'error');
          $action = 'new_product';
          break;
      }
      if (file_exists(DIR_WS_MODULES . '/new_product_preview.php')) {
        require(DIR_WS_MODULES . '/new_product_preview.php');
      } else {
        require(DIR_WS_MODULES . 'new_product_preview.php');
      }
      break;
    case 'new_product_preview_meta_tags':
      if (!isset($_POST['products_price_sorter']) || !isset($_POST['products_model'])) {
          $messageStack->add(ERROR_NO_DATA_TO_SAVE, 'error');
          $action = 'new_product_meta_tags';
      }
      break;
  }
}

?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
  </head>
  <body>
    <?php
    if ($action == 'new_product_meta_tags') {
      require(DIR_WS_MODULES . 'listing/collect_info_metatags.php');
    } elseif ($action == 'new_product') {
      require(DIR_WS_MODULES . 'listing/collect_info.php');
    } elseif ($action == 'new_product_preview_meta_tags') {
      require(DIR_WS_MODULES . 'listing/preview_info_meta_tags.php');
    } elseif ($action == 'new_product_preview') {
      require(DIR_WS_MODULES . 'listing/preview_info.php');
    }
    ?>

    <!-- script for datepicker -->
    <script>
      $(function () {
        $('input[name="products_date_available"]').datepicker();
      })
    </script>

  </body>
</html>
