<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=shopping_cart.
 * Displays shopping-cart contents
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: lat9 2022 Aug 11 Modified in v1.5.8-alpha2 $
 */
?>
<div class="centerColumn shopcart-cont cart-pg" id="shoppingCartDefault">
  <?php
    if ($flagHasCartContents) {
  ?>
  <h1 id="cartDefaultHeading" class="tt-title noborder"><?php echo HEADING_TITLE; ?></h1>
  <?php if ($messageStack->size('shopping_cart') > 0) echo $messageStack->output('shopping_cart'); ?>
  <?php echo zen_draw_form('cart_quantity', zen_href_link(FILENAME_SHOPPING_CART, 'action=update_product', $request_type), 'post', 'id="shoppingCartForm" class="tt-shopcart-table-02"'); ?>
  <div id="cartInstructionsDisplay" class="tt-card-box tt-card-bg mb-4">
    <?php
      if ($_SESSION['cart']->count_contents() > 0) {
    ?>
      <div class="forward"><?php echo TEXT_CART_HELP; ?></div>
    <?php
      }
    ?>
    <?php
    /**
     * require the html_define for the shopping_cart page
     */
    require($define_page);
    ?>
  </div>

  <?php if (!empty($totalsDisplay)) { ?>
    <div class="cartTotalsDisplay important alert alert-info mb-3"><?php echo $totalsDisplay; ?></div>
  <?php } ?>

  <?php  if ($flagAnyOutOfStock) { ?>
    <?php if (STOCK_ALLOW_CHECKOUT == 'true') {  ?>
      <div class="messageStackError alert alert-danger"><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></div>
    <?php } else { ?>
      <div class="messageStackError alert alert-danger"><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?></div>
    <?php } //endif STOCK_ALLOW_CHECKOUT ?>
  <?php  } //endif flagAnyOutOfStock ?>
  <div class="table-responsive cart_table">
    <table id="cartContentsDisplay" class="table">
		<thead>
      <tr class="tableHeading">
        <th scope="col" id="scProductsHeading" colspan="2"><?php echo TABLE_HEADING_PRODUCTS; ?></th>
        <th scope="col" id="scUnitHeading"><?php echo TABLE_HEADING_PRICE; ?></th>
        <th scope="col" id="scQuantityHeading"><?php echo TABLE_HEADING_QUANTITY; ?></th>
        <th scope="col" id="scUpdateQuantity" class="text-center"><?php echo TABLE_HEADING_UPDATE; ?></th>
        <th scope="col" id="scTotalHeading" class="text-end"><?php echo TABLE_HEADING_TOTAL; ?></th>
      </tr>
	  </thead>
      <!-- Loop through all products /-->
      <?php
        foreach ($productArray as $product) {
      ?>
      <tr class="<?php echo $product['rowClass']; ?>">
        <td class="cartProductDisplay item_image" valign="middle" padding="0">
		 <div class="cart_product">
          <a href="<?php echo $product['linkProductsName']; ?>">
            <span class="cartImage tt-product-img back"><?php echo $product['productsImage']; ?></span>
          </a>
          <?php
            if ($product['buttonDelete']) {
          ?>
          <a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART, 'action=remove_product&product_id=' . $product['id']); ?>" class="remove_btn d-flex justify-content-center align-items-center"><i class="fal fa-times"></i></a>
          <?php
            }
          ?>
		 </div>
        </td>
        <td class="cartProductDisplay">
			<div class="item_content">
			  <h5 class="item_title mb-1">
				<a href="<?php echo $product['linkProductsName']; ?>"><span class="cartProdTitle"><?php echo $product['productsName'] . ( ( $product['flagStockCheck'] ) ? '<span class="alert bold">' . $product['flagStockCheck'] . '</span>' : '' ); ?></span></a>
			  </h5>
			  <br class="clearBoth" />
			  <?php
				echo $product['attributeHiddenField'];
				if (isset($product['attributes']) && is_array($product['attributes'])) {
				  echo '<div class="cartAttribsList">';
				  echo '<ul class="tt-list-description tt-list-dot">';
				  foreach ($product['attributes'] as $option => $value) {
			  ?>
			  <li>
				  <?php
				  echo $value['products_options_name'] . TEXT_OPTION_DIVIDER . nl2br($value['products_options_values_name']);
				  ?>
			  </li>
			  <?php
				}
				echo '</ul>';
				echo '</div>';
			  }
			  ?>
			</div>
        </td>
        <td class="cartUnitDisplay"><div class="item_price"><?php echo $product['productsPriceEach']; ?></div></td>
        <td class="cartQuantity">  
          <?php
            if ($product['flagShowFixedQuantity']) {
              echo $product['showFixedQuantityAmount'] . ( ( $product['flagStockCheck'] ) ?  '<br /><span class="alert bold">' . $product['flagStockCheck'] . '</span><br /><br />' : '' ) . $product['showMinUnits'];
            } else {
				echo '<div class="quantity_input">
					<span class="minus-btn">–</span>
					' . $product['quantityField'] . '
					<span class="plus-btn">+</span>
				</div>' . ( ( $product['flagStockCheck'] ) ?  '<br /><span class="alert bold">' . $product['flagStockCheck'] . '</span><br /><br />' : '' ) . $product['showMinUnits'];
            }
          ?>
        </td>
        <td class="cartQuantityUpdate text-center">
          <?php
            if ($product['buttonUpdate'] == '') {
              echo '' ;
            } else {
              echo $product['buttonUpdate'];
            }
          ?>
        </td>
        <td class="cartTotalDisplay"><div class="item_price subtotal text-end"><?php echo $product['productsPrice']; ?></div></td>
      </tr>
      <?php
        } // end foreach ($productArray as $product)
      ?>
      <!-- Finished loop through all products /-->
    </table>
  </div>
  <div id="cartSubTotal" class="card-total text-uppercase d-flex justify-content-end cart_pricing_table">
	<ul class="ul_li_block clearfix">
		<li class="fs-5"><span><?php echo SUB_TITLE_SUB_TOTAL; ?></span>&nbsp;<span class="item_price"><?php echo $cartShowTotal; ?></span></li>
	</ul>
  </div>
	<div class="tt-shopcart-btn d-flex flex-sm-row flex-column">
		<div class="col-left col d-flex">
			<div class="buttonRow back"><a class="btn btn-border" href="<?php echo zen_back_link(true); ?>"><i class="icon-e-19"></i><?php echo BUTTON_CONTINUE_SHOPPING_ALT; ?></a></div>
		</div>
		<div class="col-right d-flex wt-center-cont justify-content-end col gap-2 flex-sm-row flex-column">
		<?php
		// show update cart button
		  if (SHOW_SHOPPING_CART_UPDATE == 2 or SHOW_SHOPPING_CART_UPDATE == 3) {
		?>
		  <div class="buttonRow back mr-2 mb-2"><?php echo zen_image_submit(ICON_IMAGE_UPDATE, BUTTON_UPDATE_ALT,'', 'btn btn-border'); ?></div>
		<?php
		  } else { // don't show update button below cart
		?>
		<?php
		  } // show update button
		?>
		<!--eof shopping cart buttons-->
	  	<div class="buttonRow forward mb-2"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_CHECKOUT, BUTTON_PROCEED_TO_CHECKOUT_ALT, '', '') . '</a>'; ?></div>
		</div>
	</div>

</form>

<br class="clearBoth" />
<?php
    if (SHOW_SHIPPING_ESTIMATOR_BUTTON == '1') {
?>

<div class="buttonRow back"><?php echo '<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_SHIPPING_ESTIMATOR) . '\')">' .
 zen_image_button(BUTTON_IMAGE_SHIPPING_ESTIMATOR, BUTTON_SHIPPING_ESTIMATOR_ALT) . '</a>'; ?></div>
<?php
    }
?>

<!-- ** BEGIN PAYPAL EXPRESS CHECKOUT ** -->
<?php  // the tpl_ec_button template only displays EC option if cart contents >0 and value >0
if (defined('MODULE_PAYMENT_PAYPALWPP_STATUS') && MODULE_PAYMENT_PAYPALWPP_STATUS == 'True') {
  include(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/paypal/tpl_ec_button.php');
}
?>
<!-- ** END PAYPAL EXPRESS CHECKOUT ** -->
<div class="tt-shopcart-col">
<?php
      if (SHOW_SHIPPING_ESTIMATOR_BUTTON == '2') {
/**
 * load the shipping estimator code if needed
 */
?>
      <?php require(DIR_WS_MODULES . zen_get_module_directory('shipping_estimator.php')); ?>

<?php
      }
      // -----
    // Enable extra content to be included, via additional header_php_*.php files present
    // in /includes/modules/pages/shopping_cart.
    //
    if (!empty($extra_content_shopping_cart) && is_array($extra_content_shopping_cart)) {
      foreach ($extra_content_shopping_cart as $extra_content) {
          require $extra_content;
      }
  }
?>
</div>
<?php
  } else {
?>
<div class="tt-empty-cart pt-2">
	<span class="tt-icon icon-f-39"></span>
	<h1 id="cartEmptyText"  class="tt-title"><?php echo TEXT_CART_EMPTY; ?></h1>
	<a href="<?php echo zen_href_link(FILENAME_DEFAULT, '', 'SSL'); ?>" class="btn"><?php echo BUTTON_CONTINUE_SHOPPING_ALT; ?></a>
</div>
<?php
  // -----
    // Enable extra content to be included, via additional header_php_*.php files present
    // in /includes/modules/pages/shopping_cart.
    //
    if (!empty($extra_content_shopping_cart) && is_array($extra_content_shopping_cart)) {
      foreach ($extra_content_shopping_cart as $extra_content) {
          require $extra_content;
      }
  }

$show_display_shopping_cart_empty = $db->Execute(SQL_SHOW_SHOPPING_CART_EMPTY);

while (!$show_display_shopping_cart_empty->EOF) {
?>

<?php
  if ($show_display_shopping_cart_empty->fields['configuration_key'] == 'SHOW_SHOPPING_CART_EMPTY_FEATURED_PRODUCTS') { ?>
<?php
/**
 * display the Featured Products Center Box
 */
?>
<?php require($template->get_template_dir('tpl_modules_featured_products.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_featured_products.php'); ?>
<?php } ?>

<?php
  if ($show_display_shopping_cart_empty->fields['configuration_key'] == 'SHOW_SHOPPING_CART_EMPTY_SPECIALS_PRODUCTS') { ?>
<?php
/**
 * display the Special Products Center Box
 */
?>
<?php require($template->get_template_dir('tpl_modules_specials_default.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_specials_default.php'); ?>
<?php } ?>

<?php
  if ($show_display_shopping_cart_empty->fields['configuration_key'] == 'SHOW_SHOPPING_CART_EMPTY_NEW_PRODUCTS') { ?>
<?php
/**
 * display the New Products Center Box
 */
?>
<?php require($template->get_template_dir('tpl_modules_whats_new.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_whats_new.php'); ?>
<?php } ?>

<?php
  if ($show_display_shopping_cart_empty->fields['configuration_key'] == 'SHOW_SHOPPING_CART_EMPTY_UPCOMING') {
    include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_UPCOMING_PRODUCTS));
  }
?>
<?php
  $show_display_shopping_cart_empty->MoveNext();
} // !EOF
?>
<?php
  }
?>
</div>
