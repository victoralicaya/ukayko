<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_payment_address.
 * Allows customer to change the billing address.
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 25 Modified in v1.5.8-alpha $
 */
?>
<div class="centerColumn" id="checkoutPayAddressDefault">
     <h1 id="checkoutPayAddressDefaultHeading" class="tt-title noborder text-left"><?php echo HEADING_TITLE; ?></h1>
     <?php if ($messageStack->size('checkout_address') > 0) echo $messageStack->output('checkout_address'); ?>
     <div class="tt-card-box">
          <h4 id="checkoutPayAddressDefaultAddress" class="tt-title"><?php echo TITLE_PAYMENT_ADDRESS; ?></h4>
          <div class="instructions group">
               <address class="back"><?php echo zen_address_label($_SESSION['customer_id'], $_SESSION['billto'], true, ' ', '<br>'); ?></address>
          </div>
          <div class="alert alert-info">
               <?php echo TEXT_SELECTED_PAYMENT_DESTINATION; ?>
          </div>
     </div>
     <?php
          if ($addresses_count < MAX_ADDRESS_BOOK_ENTRIES) {
               echo zen_draw_form('checkout_address', zen_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL'), 'post', 'class="group"'); 
               /**
                * require template to collect address details
               */
               require($template->get_template_dir('tpl_modules_checkout_new_address.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_checkout_new_address.php');
     ?>
          </form>

     <?php
     }
     if ($addresses_count > 1) {
     ?>
     <?php echo zen_draw_form('checkout_address_book', zen_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL'), 'post', 'class="group"'); ?>
     <div class="tt-card-box">
          <h4 class="tt-title"><?php echo TABLE_HEADING_NEW_PAYMENT_ADDRESS; ?></h4>
          <?php
               require($template->get_template_dir('tpl_modules_checkout_address_book.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_checkout_address_book.php');
          ?>
          <div class="buttonRow forward text-end"><?php echo zen_draw_hidden_field('action', 'submit') . zen_image_submit(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT); ?></div>
     </div>
     </form>
     <?php
          }
     ?>
     <br class="clearBoth">
     <!--<div class="buttonRow back"><?php //echo TITLE_CONTINUE_CHECKOUT_PROCEDURE . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></div>-->
     <div class="buttonRow back text-end"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
</div>
