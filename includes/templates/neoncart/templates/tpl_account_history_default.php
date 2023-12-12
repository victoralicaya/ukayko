<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_history.
 * Displays all customers previous orders
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: lat9 2022 Jul 23 Modified in v1.5.8-alpha2 $
 */
?>
<div class="centerColumn" id="accountHistoryDefault">
  <h1 id="accountHistoryDefaultHeading" class="tt-title noborder text-left"><?php echo HEADING_TITLE; ?></h1>
  <?php
if (!empty($accountHistory)) {
      foreach ($accountHistory as $history) {
  ?>
  <div class="tt-card-box">
      <h4 class="tt-title"><?php echo TEXT_ORDER_NUMBER . $history['orders_id']; ?></h4>
      <div class="notice forward"><?php echo '<strong>' . TEXT_ORDER_STATUS . '</strong> ' . $history['orders_status_name']; ?></div>
      <div class="content back"><?php echo '<strong>' . TEXT_ORDER_DATE . '</strong> ' . zen_date_long($history['date_purchased']) . '<br /><strong>' . $history['order_type'] . '</strong> ' . zen_output_string_protected($history['order_name']); ?></div>
      <div class="content"><?php echo '<strong>' . TEXT_ORDER_PRODUCTS . '</strong> ' . $history['product_count'] . '<br /><strong>' . TEXT_ORDER_COST . '</strong> ' . strip_tags($history['order_total']); ?></div>
      <br class="clearBoth" />
      <div class="content forward"><?php echo '<a class="btn btn-sm" href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'order_id=' . $history['orders_id'], 'SSL') . '">' . BUTTON_VIEW_SMALL_ALT . '</a>'; ?></div>
  </div>
  <?php
      }
  ?>
  <?php
    if (($history_split->number_of_rows == $max_display_page_links)) {
  ?>
  <div class="tt-pagination tt-pagination-left pagi-bot">
    <div class="navSplitPagesLinks forward"><?php echo TEXT_RESULT_PAGE . $history_split->display_links($max_display_page_links, zen_get_all_get_params(['page', 'info', 'x', 'y', 'main_page']), $paginateAsUL); ?></div>
    <div class="navSplitPagesResult"><?php echo $history_split->display_count(TEXT_DISPLAY_NUMBER_OF_ORDERS); ?></div>
  </div>
  <?php } ?>
  <?php
    } else {
  ?>
  <div class="centerColumn" id="noAcctHistoryDefault">
    <div class="alert alert-info"><?php echo TEXT_NO_PURCHASES; ?></div>
  </div>
  <?php
    }
  ?>
  <div class="buttonRow forward">
    <?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
  </div>
</div>