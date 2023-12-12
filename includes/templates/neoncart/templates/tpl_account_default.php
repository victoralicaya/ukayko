<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account.
 * Displays previous orders and options to change various Customer Account settings
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: lat9 2022 May 26 Modified in v1.5.8-alpha $
 */
?>

<div class="centerColumn" id="accountDefault">
  <h1 id="accountDefaultHeading" class="tt-title noborder text-left"><?php echo HEADING_TITLE; ?></h1>
  <?php if ($messageStack->size('account') > 0) echo $messageStack->output('account'); ?>
  <?php
    if (zen_count_customer_orders() > 0) {
  ?>
  <p class="forward">
    <?php echo '<a class="button btn btn-border btn-sm" href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">' . OVERVIEW_SHOW_ALL_ORDERS . '</a>'; ?>
  </p>
  <div class="tt-card-box">
    <h4 id="previous-orders" class="tt-title"><?php echo OVERVIEW_PREVIOUS_ORDERS; ?></h4>
    <div class="table-responsive">
      <table id="prevOrders" class="table table-bordered">
          <tr class="tableHeading">
          <th scope="col"><?php echo TABLE_HEADING_DATE; ?></th>
          <th scope="col"><?php echo TABLE_HEADING_ORDER_NUMBER; ?></th>
          <th scope="col"><?php echo TABLE_HEADING_SHIPPED_TO; ?></th>
          <th scope="col"><?php echo TABLE_HEADING_STATUS; ?></th>
          <th scope="col"><?php echo TABLE_HEADING_TOTAL; ?></th>
          <th scope="col" class="alignCenter"><?php echo TABLE_HEADING_VIEW; ?></th>
        </tr>
      <?php
        foreach($ordersArray as $orders) {
      ?>
        <tr>
          <td class="accountOrderDate"><?php echo zen_date_short($orders['date_purchased']); ?></td>
          <td class="accountOrderId"><?php echo TEXT_NUMBER_SYMBOL . $orders['orders_id']; ?></td>
          <td class="accountAddress"><address><?php echo zen_output_string_protected($orders['order_name']) . '<br />' . $orders['order_country']; ?></address></td>
          <td class="accountOrderStatus"><?php echo $orders['orders_status_name']; ?></td>
          <td class="accountOrderTotal alignRight"><?php echo $orders['order_total']; ?></td>
          <td class="accountOrderViewButton alignCenter"><?php echo '<a class="btn btn-sm" href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $orders['orders_id'], 'SSL') . '"> ' . BUTTON_VIEW_SMALL_ALT . '</a>'; ?></td>
        </tr>

      <?php
        }
      ?>
      </table>
    </div>
  </div>
  <?php
    }
  ?>
  <div id="accountLinksWrapper" class="back">
    <div class="tt-card-box tt-card-bg">
      <h4 class="tt-title"><?php echo MY_ACCOUNT_TITLE; ?></h4>
      <ul id="myAccountGen" class="tt-list-dot">
        <li><?php echo ' <a href="' . zen_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL') . '">' . MY_ACCOUNT_INFORMATION . '</a>'; ?></li>
        <li><?php echo ' <a href="' . zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . MY_ACCOUNT_ADDRESS_BOOK . '</a>'; ?></li>
        <li><?php echo ' <a href="' . zen_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL') . '">' . MY_ACCOUNT_PASSWORD . '</a>'; ?></li>
        <li><?php echo ' <a href="' . zen_href_link(FILENAME_MY_LISTINGS, '', 'SSL') . '">' . MY_LISTINGS . '</a>'; ?></li>
      </ul>
    </div>

    <?php
      if ((int)ACCOUNT_NEWSLETTER_STATUS > 0 or CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS !='0') {
    ?>
    <div class="tt-card-box tt-card-bg">
      <h4 class="tt-title"><?php echo EMAIL_NOTIFICATIONS_TITLE; ?></h4>
      <ul id="myAccountNotify" class="tt-list-dot">
        <?php
          if ((int)ACCOUNT_NEWSLETTER_STATUS > 0) {
        ?>
        <li><?php echo ' <a href="' . zen_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL') . '">' . EMAIL_NOTIFICATIONS_NEWSLETTERS . '</a>'; ?></li>
        <?php } //endif newsletter unsubscribe ?>
        <?php
          if (CUSTOMERS_PRODUCTS_NOTIFICATION_STATUS == '1') {
        ?>
        <li><?php echo ' <a href="' . zen_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL') . '">' . EMAIL_NOTIFICATIONS_PRODUCTS . '</a>'; ?></li>
        <?php } //endif product notification ?>
      </ul>
    </div>
    <?php } // endif don't show unsubscribe or notification ?>
  </div>
  <?php
  // only show when there is a GV balance
    if ($customer_has_gv_balance ) {
  ?>
  <div id="sendSpendWrapper">
    <?php require($template->get_template_dir('tpl_modules_send_or_spend.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_send_or_spend.php'); ?>
  </div>
  <?php
    }
  ?>
  <br class="clearBoth">
</div>
