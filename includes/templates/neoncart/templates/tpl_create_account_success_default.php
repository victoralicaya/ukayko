<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=create-account_success.
 * Displays confirmation that a new account has been created.
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 25 Modified in v1.5.8-alpha $
 */
?>
<div class="centerColumn" id="createAcctSuccess">
    <h1 id="createAcctSuccessHeading" class="tt-title noborder text-left"><?php echo HEADING_TITLE; ?></h1>
    <div id="createAcctSuccessMainContent" class="content alert alert-info"><?php echo TEXT_ACCOUNT_CREATED; ?></div>
    <div class="tt-card-box tt-card-bg">
      <h4 class="pb-3"><?php echo PRIMARY_ADDRESS_TITLE; ?></h4>
      <?php
      /**
       * Used to loop thru and display address book entries
       */
        foreach ($addressArray as $addresses) {
      ?>
      <h5 class="addressBookDefaultName pb-1"><?php echo zen_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']); ?></h5>
      <address><?php echo zen_address_format($addresses['format_id'], $addresses['address'], true, ' ', '<br />'); ?></address>
      <div class="buttonRow forward"><?php echo '<a class="btn btn-sm" href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $addresses['address_book_id'], 'SSL') . '">' . BUTTON_EDIT_SMALL_ALT . '</a> <a class="btn btn-sm" href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $addresses['address_book_id'], 'SSL') . '">' . BUTTON_DELETE_ALT . '</a>'; ?></div>
      <br class="clearBoth">
      <?php
        }
      ?>
    </div>
    <div class="buttonRow forward"><?php echo '<a href="' . $origin_href . '">' . zen_image_button(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT) . '</a>'; ?></div>
</div>
