<?php
/**
 * tpl_modules_checkout_address_book.php
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Scott C Wilson 2022 Jan 19 Modified in v1.5.8-alpha $
 */
?>
<?php
/**
 * get address book details
 */
  require(DIR_WS_MODULES . zen_get_module_directory('checkout_address_book.php'));
?>
	<div class="row address-entries">
    <?php
      foreach ($addresses as $address) {
        $selected = ($address['address_book_id'] == $_SESSION['sendto']);
        if ($current_page_base === FILENAME_CHECKOUT_PAYMENT_ADDRESS) {
           $selected = ($address['address_book_id'] == $_SESSION['billto']); 
        } 
    ?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <div <?php echo ($selected) ? 'id="defaultSelected" class="moduleRowSelected"' : 'class="moduleRow"'; ?>>
            <?php echo zen_draw_radio_field('address', $address['address_book_id'], $selected, 'id="name-' . $address['address_book_id'] . '"'); ?>
            <label for="name-<?php echo $address['address_book_id']; ?>">
              <?php echo zen_output_string_protected($address['firstname'] . ' ' . $address['lastname']); ?>
            </label>
            <br class="clearBoth" />
            <address><?php echo zen_address_format(zen_get_address_format_id($address['country_id']), $address['address'], true, ' ', '<br>'); ?></address>
		      </div> 
        </div> <!--end of divs in while loop -->
    <?php
      }
    ?>
	</div>