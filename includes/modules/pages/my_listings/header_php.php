<?php
/**
 * Header code file for the My Listings page
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: lat9 2022 Jul 23 Modified in v1.5.8-alpha2 $
 */
// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_MY_LISTINGS');


if (!zen_is_logged_in() && !zen_in_guest_checkout()) {
    $_SESSION['navigation']->set_snapshot();
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}

require DIR_WS_MODULES . zen_get_module_directory('require_languages.php');
$breadcrumb->add(NAVBAR_TITLE_1, zen_href_link(FILENAME_MY_LISTINGS, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2);

$listings_split = [];
$customer = new Customer;
$myListings = $customer->getMyListings(MAX_DISPLAY_PRODUCTS_LISTING, $listings_split);
$accountHasListing = !empty($myListings);

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_MY_LISTINGS');
