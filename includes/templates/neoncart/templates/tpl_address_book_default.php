<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=adress_book.
 * Allows customer to manage entries in their address book
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 25 Modified in v1.5.8-alpha $
 */
?>
<div class="centerColumn" id="addressBookDefault">
    <h1 id="addressBookDefaultHeading" class="tt-title noborder"><?php echo HEADING_TITLE; ?></h1>
    <?php if ($messageStack->size('addressbook') > 0) echo $messageStack->output('addressbook'); ?> 
    <div class="tt-card-box">
      <div class="row primary-address-instructions">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 primary-address">
          <h4 id="addressBookDefaultPrimary" class="tt-title"><?php echo PRIMARY_ADDRESS_TITLE; ?></h4>
          <address class="back"><?php echo zen_address_label($_SESSION['customer_id'], $_SESSION['customer_default_address_id'], true, ' ', '<br />'); ?></address>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 address-instructions">
          <div class="alert alert-info instructions">
            <div class="instructions"><?php echo PRIMARY_ADDRESS_DESCRIPTION; ?></div>
          </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <h4 class="tt-title"><?php echo ADDRESS_BOOK_TITLE; ?></h4>
          <div class="alert alert-info forward"><?php echo sprintf(TEXT_MAXIMUM_ENTRIES, MAX_ADDRESS_BOOK_ENTRIES); ?></div>
        </div>
      </div>
    </div>
    <?php
    /**
     * Used to loop thru and display address book entries
     */
      foreach ($addressArray as $addresses) {
    ?>
    <div class="tt-card-box">
      <h4 class="tt-title"><?php echo zen_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']); ?><?php if ($addresses['address_book_id'] == $_SESSION['customer_default_address_id']) echo '&nbsp;' . PRIMARY_ADDRESS ; ?></h4>
      <address><?php echo zen_address_format($addresses['format_id'], $addresses['address'], true, ' ', '<br />'); ?></address>
      <div class="buttonRow forward"><?php echo '<a class="btn btn-sm" href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $addresses['address_book_id'], 'SSL') . '">' . BUTTON_EDIT_SMALL_ALT . '</a> <a class="btn btn-sm" href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $addresses['address_book_id'], 'SSL') . '">' . BUTTON_DELETE_SMALL_ALT . '</a>'; ?></div>
    </div>
    <?php
      }
    ?>
<div class="buttonsRow">
<?php
  if (count($addressArray) < MAX_ADDRESS_BOOK_ENTRIES) {
?>
   <div class="buttonRow forward"><?php echo '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_ADD_ADDRESS, BUTTON_ADD_ADDRESS_ALT) . '</a>'; ?></div>
<?php
  }
?>
<div class="buttonRow back"><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
</div>
<br class="clearBoth" />
</div>
