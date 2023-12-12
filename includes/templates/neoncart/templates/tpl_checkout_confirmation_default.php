<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_confirmation.
 * Displays final checkout details, cart, payment and shipping info details.
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: lat9 2022 Jul 01 Modified in v1.5.8-alpha $
 */
?>
<div class="centerColumn" id="checkoutConfirmDefault">
  <h1 id="checkoutConfirmDefaultHeading" class="tt-title mb-4"><?php echo HEADING_TITLE; ?></h1>
  <?php if ($messageStack->size('redemptions') > 0) echo $messageStack->output('redemptions'); ?>
  <?php if ($messageStack->size('checkout_confirmation') > 0) echo $messageStack->output('checkout_confirmation'); ?>
  <?php if ($messageStack->size('checkout') > 0) echo $messageStack->output('checkout'); ?>

  <div class="tt-card-box">
    <div class="row address-content mb-4">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 billing-address-content">
        <h4 id="checkoutConfirmDefaultBillingAddress" class="tt-title"><?php echo HEADING_BILLING_ADDRESS; ?></h4>
        <address><?php echo zen_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br>'); ?></address>
        <?php if (!$flagDisablePaymentAddressChange) { ?>
          <div class="buttonRow forward"><?php echo '<a class="btn btn-sm" href="' . zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '">' . BUTTON_EDIT_SMALL_ALT . '</a>'; ?></div>
        <?php } ?>
    	</div>
      <?php
        if ($_SESSION['sendto'] != false) {
      ?>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 shipping-content">
        <div id="checkoutShipto" class="forward">
          <h4 id="checkoutConfirmDefaultShippingAddress" class="tt-title"><?php echo HEADING_DELIVERY_ADDRESS; ?></h4>
          <address><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br>'); ?></address>
          <div class="buttonRow forward"><?php echo '<a class="btn btn-sm" href="' . $editShippingButtonLink . '">' . BUTTON_EDIT_SMALL_ALT . '</a>'; ?></div>
        </div>
      </div>
      <?php } ?>		
    </div>
    <div class="row address-content">
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 payment-address-content">
        
        <h4 id="checkoutConfirmDefaultPayment" class="tt-title"><?php echo HEADING_PAYMENT_METHOD; ?></h4>
        <span id="checkoutConfirmDefaultPaymentTitle" class="span-style"><?php echo $payment_title; ?></span>
        <?php
          if ($credit_covers === false && is_array($payment_modules->modules)) {
            if ($confirmation = $payment_modules->confirmation()) {
        ?>
        <div class="important"><?php echo $confirmation['title']; ?></div>
        <?php
          }
        ?>
        <div class="important">
          <?php
            for ($i=0, $n=sizeof($confirmation['fields']); $i<$n; $i++) {
          ?>
          <div class="back"><?php echo $confirmation['fields'][$i]['title']; ?></div>
          <div ><?php echo $confirmation['fields'][$i]['field']; ?></div>
          <?php
            }
          ?>
        </div>
        <?php
          }
        ?>
        <br class="clearBoth" />
      </div>
      <?php
        if ($order->info['shipping_method']) {
      ?>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 shipping-content">
        <h4 id="checkoutConfirmDefaultShipment" class="tt-title"><?php echo HEADING_SHIPPING_METHOD; ?></h4>
        <span id="checkoutConfirmDefaultShipmentTitle" class="span-style"><?php echo $order->info['shipping_method']; ?></span>
      </div>
      <?php
          }
      ?>
    </div>
  </div>

  <div class="tt-card-box">
    <h4 id="checkoutConfirmDefaultHeadingComments" class="tt-title"><?php echo HEADING_ORDER_COMMENTS; ?></h4>
    <div><?php echo (empty($order->info['comments']) ? NO_COMMENTS_TEXT : nl2br(zen_output_string_protected($order->info['comments'])) . zen_draw_hidden_field('comments', $order->info['comments'])); ?></div>
    <br class="clearBoth" />
    <div class="buttonRow forward"><?php echo  '<a class="btn btn-sm" href="' . zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL') . '">' . BUTTON_EDIT_SMALL_ALT . '</a>'; ?></div>
  </div>

  <div class="tt-card-box">
    <h4 id="checkoutConfirmDefaultHeadingCart" class="tt-title"><?php echo HEADING_PRODUCTS; ?></h4>
    <?php if ($flagAnyOutOfStock) { ?>
      <?php if (STOCK_ALLOW_CHECKOUT == 'true') {  ?>
        <div class="messageStackError alert alert-danger"><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></div>
      <?php    } else { ?>
        <div class="messageStackError alert alert-danger"><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?></div>
      <?php    } //endif STOCK_ALLOW_CHECKOUT ?>
    <?php  } //endif flagAnyOutOfStock ?>

    <div class="table-responsive">
      <table id="cartContentsDisplay" class="table">
        <tr class="cartTableHeading">
          <th scope="col" id="ccQuantityHeading"><?php echo TABLE_HEADING_QUANTITY; ?></th>
          <th scope="col" id="ccProductsHeading"><?php echo TABLE_HEADING_PRODUCTS; ?></th>
          <?php
            // If there are tax groups, display the tax columns for price breakdown
            if (sizeof($order->info['tax_groups']) > 1) {
          ?>
          <th scope="col" id="ccTaxHeading"><?php echo HEADING_TAX; ?></th>
          <?php
            }
          ?>
          <th scope="col" id="ccTotalHeading"><?php echo TABLE_HEADING_TOTAL; ?></th>
        </tr>
        <?php // now loop thru all products to display quantity and price ?>
        <?php for ($i=0, $n=sizeof($order->products); $i<$n; $i++) { ?>
        <tr class="<?php echo $order->products[$i]['rowClass']; ?>">
          <td  class="cartQuantity"><?php echo $order->products[$i]['qty']; ?>&nbsp;x</td>
          <td class="cartProductDisplay"><?php echo $order->products[$i]['name']; ?>
            <?php  if (!empty($stock_check[$i])) echo $stock_check[$i]; ?>
            <?php // if there are attributes, loop thru them and display one per line
              if (isset($order->products[$i]['attributes']) && sizeof($order->products[$i]['attributes']) > 0 ) {
              echo '<ul class="cartAttribsList">';
                for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
            ?>
            <li>
                <?php
                echo $order->products[$i]['attributes'][$j]['option'] . ': ' . nl2br(zen_output_string_protected($order->products[$i]['attributes'][$j]['value']));
                ?>
            </li>
            <?php
                  } // end loop
                  echo '</ul>';
                } // endif attribute-info
            ?>
          </td>

          <?php // display tax info if exists ?>
          <?php if (sizeof($order->info['tax_groups']) > 1)  { ?>
          <td class="cartTotalDisplay"><?php echo zen_display_tax_value($order->products[$i]['tax']); ?>%</td>
          <?php }  // endif tax info display  ?>
          <td class="cartTotalDisplay">
            <?php echo $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']);
              if ($order->products[$i]['onetime_charges'] != 0 ) echo '<br> ' . $currencies->display_price($order->products[$i]['onetime_charges'], $order->products[$i]['tax'], 1);
            ?>
          </td>
        </tr>
        <?php  }  // end for loopthru all products ?>
      </table>
    </div>
	  <div class="buttonRow forward mt-3"><?php echo '<a class="btn btn-sm" href="' . zen_href_link(FILENAME_SHOPPING_CART, '', 'SSL') . '">' . BUTTON_EDIT_SMALL_ALT . '</a>'; ?></div>
  </div>

  <?php
    if (MODULE_ORDER_TOTAL_INSTALLED) {
      $order_totals = $order_total_modules->process();
  ?>
		<div class="text-end">
			<div class="shopping-cart-table__product-price unit-price">
        <div id="orderTotals"><?php $order_total_modules->output(); ?></div>
			</div>
		</div>
  <?php
    }
  ?>

<?php
  echo zen_draw_form('checkout_confirmation', $form_action_url, 'post', 'id="checkout_confirmation" onsubmit="submitonce();"');

  if ($credit_covers === false && is_array($payment_modules->modules)) {
    echo $payment_modules->process_button();
  }
?>
    <div class="row checkout-shipping-button border-top pt-3">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-7 mb-2 mb-lg-0">
        	<div class="buttonRow back"><?php echo TITLE_CONTINUE_CHECKOUT_PROCEDURE . '<br>' . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-5 text-end">
        	<div class="buttonRow forward">
<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_CONFIRM_ORDER, BUTTON_CONFIRM_ORDER_ALT, 'name="btn_submit" id="btn_submit"') ;?></div>
            </div>
		</div>
   	</div>
</form>


</div>
