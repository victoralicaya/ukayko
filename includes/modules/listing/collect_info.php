<?php
/**
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Steve 2023 Jan 20 Modified in v1.5.8a $
 */
require (DIR_WS_CLASSES.'object_info.php');

$parameters = [
  'products_name' => '',
  'products_description' => '',
  'products_url' => '',
  'products_id' => '',
  'products_quantity' => '0',
  'products_model' => '',
  'products_image' => '',
  'products_price' => '0.0000',
  'products_virtual' => DEFAULT_PRODUCT_PRODUCTS_VIRTUAL,
  'products_weight' => '0',
  'products_date_added' => '',
  'products_last_modified' => '',
  'products_date_available' => '',
  'products_status' => '1',
  'products_tax_class_id' => DEFAULT_PRODUCT_TAX_CLASS_ID,
  'manufacturers_id' => '',
  'products_quantity_order_min' => '1',
  'products_quantity_order_units' => '1',
  'products_priced_by_attribute' => '0',
  'product_is_free' => '0',
  'product_is_call' => '0',
  'products_quantity_mixed' => '1',
  'product_is_always_free_shipping' => DEFAULT_PRODUCT_PRODUCTS_IS_ALWAYS_FREE_SHIPPING,
  'products_qty_box_status' => PRODUCTS_QTY_BOX_STATUS,
  'products_quantity_order_max' => '0',
  'products_sort_order' => '0',
  'products_discount_type' => '0',
  'products_discount_type_from' => '0',
  'products_price_sorter' => '0',
  'master_categories_id' => '',
];

$languages = zen_get_languages();
$pInfo = new objectInfo($parameters);

if (isset($_GET['pID']) && empty($_POST)) {
  $product = $db->Execute("SELECT pd.products_name, pd.products_description, pd.products_url,
                                  p.*,
                                  p.products_date_available
                           FROM " . TABLE_PRODUCTS . " p,
                                " . TABLE_PRODUCTS_DESCRIPTION . " pd
                           WHERE p.products_id = " . (int)$_GET['pID'] . "
                           AND p.products_id = pd.products_id
                           AND pd.language_id = " . (int)$_SESSION['languages_id']);

  $pInfo->updateObjectInfo($product->fields);
  $pInfo->product_type = $pInfo->products_type;
} elseif (!empty($_POST)) {
  $pInfo->updateObjectInfo($_POST);
  if (isset($_GET['pID'])) {
     $pInfo->products_id = (int)$_GET['pID'];
  }
  if (isset($pInfo->cPath)) {
      $pInfo->master_categories_id = $pInfo->cPath;
  }
  $products_name = $_POST['products_name'] ?? '';
  $products_description = $_POST['products_description'] ?? '';
  $products_url = $_POST['products_url'] ?? '';
}

$category_lookup = $db->Execute("SELECT *
                                 FROM " . TABLE_CATEGORIES . " c,
                                      " . TABLE_CATEGORIES_DESCRIPTION . " cd
                                 WHERE c.categories_id = " . (int)$current_category_id . "
                                 AND c.categories_id = cd.categories_id
                                 AND cd.language_id = " . (int)$_SESSION['languages_id']);
if (!$category_lookup->EOF) {
  $cInfo = new objectInfo($category_lookup->fields);
} else {
  $cInfo = new objectInfo([]);
}

// set to out of stock if categories_status is off and new product or existing products_status is off
if (zen_get_categories_status($current_category_id) == 0 && $pInfo->products_status != 1) {
  $pInfo->products_status = 0;
}
?>
<div class="container-fluid">
    <?php
    echo zen_draw_form('new_product', FILENAME_LISTING, 'cPath=' . $current_category_id . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '') . '&action=new_product_preview' . (isset($_GET['page']) ? '&page=' . $_GET['page'] : '') . ( (isset($_GET['search']) && !empty($_GET['search'])) ? '&search=' . $_GET['search'] : '') . ( (isset($_POST['search']) && !empty($_POST['search']) && empty($_GET['search'])) ? '&search=' . $_POST['search'] : ''), 'post', 'enctype="multipart/form-data" class="form-horizontal"');
    if (isset($product_type)) {
      echo zen_draw_hidden_field('product_type', $product_type);
    }
    ?>
    <div class="floatButton text-right">
      <button type="submit" class="btn btn-primary"><?php echo IMAGE_PREVIEW; ?></button>&nbsp;&nbsp;<a href="<?php echo zen_href_link(FILENAME_CATEGORY_PRODUCT_LISTING, 'cPath=' . $current_category_id . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '') . (isset($_GET['page']) ? '&page=' . $_GET['page'] : '') . ( (isset($_GET['search']) && !empty($_GET['search'])) ? '&search=' . $_GET['search'] : '') . ( (isset($_POST['search']) && !empty($_POST['search']) && empty($_GET['search'])) ? '&search=' . $_POST['search'] : '')); ?>" class="btn btn-default" role="button"><?php echo IMAGE_CANCEL; ?></a>
    </div>
  <div class="form-group">
      <?php
// show when product is linked
      if (isset($_GET['pID']) && zen_get_product_is_linked($_GET['pID']) == 'true' && (int)$_GET['pID'] > 0) {
        ?>
        <?php echo zen_draw_label(TEXT_MASTER_CATEGORIES_ID, 'master_category', 'class="col-sm-3 control-label"'); ?>
      <div class="col-sm-9 col-md-6">
        <div class="input-group">
          <span class="input-group-addon">
              <?php
              echo zen_image(DIR_WS_IMAGES . 'icon_yellow_on.gif', IMAGE_ICON_LINKED) . '&nbsp;&nbsp;';
              ?>
          </span>
          <?php
          echo zen_draw_pull_down_menu('master_category', zen_get_master_categories_pulldown($_GET['pID']), $pInfo->master_categories_id, 'class="form-control" id="master_category"');
          ?>
        </div>
      </div>
    <?php } ?>
  </div>

  <?php
// hidden fields not changeable on products page
  echo zen_draw_hidden_field('master_categories_id', $pInfo->master_categories_id);
  echo zen_draw_hidden_field('products_discount_type', $pInfo->products_discount_type);
  echo zen_draw_hidden_field('products_discount_type_from', $pInfo->products_discount_type_from);
  echo zen_draw_hidden_field('products_price_sorter', $pInfo->products_price_sorter);
  ?>
  <div class="form-group">
      <p class="col-sm-3 control-label"><?php echo TEXT_PRODUCTS_STATUS; ?></p>
    <div class="col-sm-9 col-md-6">
      <label class="radio-inline"><?php echo zen_draw_radio_field('products_status', '1', ($pInfo->products_status == 1)) . TEXT_PRODUCT_AVAILABLE; ?></label>
      <label class="radio-inline"><?php echo zen_draw_radio_field('products_status', '0', ($pInfo->products_status == 0)) . TEXT_PRODUCT_NOT_AVAILABLE; ?></label>
    </div>
  </div>
  <div class="form-group">
      <?php echo zen_draw_label(TEXT_PRODUCTS_MANUFACTURER, 'manufacturers_id', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php //echo zen_draw_pull_down_menu('manufacturers_id', $manufacturers_array, $pInfo->manufacturers_id, 'class="form-control" id="manufacturers_id"'); ?>
    </div>
  </div>
  <div class="form-group">
      <p class="col-sm-3 control-label"><?php echo TEXT_PRODUCTS_NAME; ?></p>
    <div class="col-sm-9 col-md-6">
        <?php
        for ($i = 0, $n = count($languages); $i < $n; $i++) {
          ?>
        <div class="input-group">
          <!--<span class="input-group-addon">
              <?php //echo zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
          </span>-->
          <?php echo zen_draw_input_field('products_name[' . $languages[$i]['id'] . ']', htmlspecialchars(isset($products_name[$languages[$i]['id']]) ? stripslashes($products_name[$languages[$i]['id']]) : zen_get_products_name($pInfo->products_id, $languages[$i]['id']), ENT_COMPAT, CHARSET, TRUE), zen_set_field_length(TABLE_PRODUCTS_DESCRIPTION, 'products_name') . ' class="form-control"'); ?>
        </div>
        <br>
        <?php
      }
      ?>
    </div>
  </div>
<?php
    // -----
    // Give an observer the chance to supply some additional product-related inputs.  Each
    // entry in the $extra_product_inputs returned contains:
    //
    // array(
    //    'label' => array(
    //        'text' => 'The label text',   (required)
    //        'field_name' => 'The name of the field associated with the label', (required)
    //        'addl_class' => {Any additional class to be applied to the label} (optional)
    //        'parms' => {Any additional parameters for the label, e.g. 'style="font-weight: 700;"} (optional)
    //    ),
    //    'input' => 'The HTML to be inserted' (required)
    // )
    //
    // Note: The product's type can be found in the 'product_type' element of the passed $pInfo object.
    //
    $extra_product_inputs = [];
    $zco_notifier->notify('NOTIFY_ADMIN_PRODUCT_COLLECT_INFO_EXTRA_INPUTS', $pInfo, $extra_product_inputs);
    if (!empty($extra_product_inputs)) {
        foreach ($extra_product_inputs as $extra_input) {
            $addl_class = (isset($extra_input['label']['addl_class'])) ? (' ' . $extra_input['label']['addl_class']) : '';
            $parms = (isset($extra_input['label']['parms'])) ? (' ' . $extra_input['label']['parms']) : '';
?>
            <div class="form-group">
                <?php echo zen_draw_label($extra_input['label']['text'], $extra_input['label']['field_name'], 'class="col-sm-3 control-label' . $addl_class . '"' . $parms); ?>
                <div class="col-sm-9 col-md-6"><?php echo $extra_input['input']; ?></div>
            </div>
<?php
        }
    }
?>

  <div class="well" style="color: #31708f;background-color: #d9edf7;border-color: #bce8f1;padding: 10px 10px 0 0;">
    <div class="form-group">
        <?php echo zen_draw_label(TEXT_PRODUCTS_PRICE_NET, 'products_price', 'class="col-sm-3 control-label"'); ?>
      <div class="col-sm-9 col-md-6">
          <?php echo zen_draw_input_field('products_price', $pInfo->products_price, 'onkeyup="updateGross()" class="form-control" id="products_price" inputmode="decimal"'); ?>
      </div>
    </div>
  </div>

  <div class="form-group">
      <p class="col-sm-3 control-label"><?php echo TEXT_PRODUCTS_DESCRIPTION; ?></p>
    <div class="col-sm-9 col-md-6">
        <?php
        for ($i = 0, $n = count($languages); $i < $n; $i++) {
          ?>
        <div class="input-group">
          <!--<span class="input-group-addon">
              <?php //echo zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
          </span>-->
          <?php echo zen_draw_textarea_field('products_description[' . $languages[$i]['id'] . ']', 'soft', '100', '30', htmlspecialchars((isset($products_description[$languages[$i]['id']])) ? stripslashes($products_description[$languages[$i]['id']]) : zen_get_products_description($pInfo->products_id, $languages[$i]['id']), ENT_COMPAT, CHARSET, TRUE), 'class="editorHook form-control"'); ?>
        </div>
        <br>
        <?php
      }
      ?>
    </div>
  </div>
  <div class="form-group">
      <?php echo zen_draw_label(TEXT_PRODUCTS_QUANTITY, 'products_quantity', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_input_field('products_quantity', $pInfo->products_quantity, 'class="form-control" id="products_quantity" inputmode="decimal"'); ?>
    </div>
  </div>
    <hr>
    <h2><?php echo TEXT_PRODUCTS_IMAGE; ?></h2>
    <?php
    if (!empty($pInfo->products_image)) { ?>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9 col-md-6">
                <?php echo zen_info_image($pInfo->products_image, (is_array($pInfo->products_name) ? $pInfo->products_name[$_SESSION['languages_id']] : $pInfo->products_name)); ?>
                <br>
                <?php echo $pInfo->products_image; ?>
            </div>
        </div>
    <?php }
    ?>
    <div class="form-group">
        <?php echo zen_draw_label(TEXT_EDIT_PRODUCTS_IMAGE, 'products_image', 'class="col-sm-3 control-label"'); ?>
        <div class="col-sm-9 col-md-9 col-lg-6">
            <?php echo zen_draw_file_field('products_image', '', 'class="form-control" id="products_image"'); ?>
            <?php echo zen_draw_hidden_field('products_previous_image', $pInfo->products_image); ?>
        </div>
    </div>
    <?php
    $dir_info = zen_build_subdirectories_array(DIR_WS_IMAGES);
    $default_directory = substr($pInfo->products_image, 0, strpos($pInfo->products_image, '/') + 1);
    ?>
    <hr>
  <div class="form-group">
      <?php echo zen_draw_label(TEXT_PRODUCTS_WEIGHT, 'products_weight', 'class="col-sm-3 control-label"'); ?>
    <div class="col-sm-9 col-md-6">
        <?php echo zen_draw_input_field('products_weight', $pInfo->products_weight, 'class="form-control" id="products_weight" inputmode="decimal"'); ?>
    </div>
  </div>
  <?php echo '</form>'; ?>
</div>
