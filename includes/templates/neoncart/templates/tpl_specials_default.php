<?php
/**
 * Page Template
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 25 Modified in v1.5.8-alpha $
 */
?>
<div class="centerColumn" id="specialsListing">
<div class="page-title">
	<h1 class="tt-title" id="specialsListingHeading"><?php echo HEADING_TITLE ?></h1>
</div>

<br class="clearBoth">

<?php
  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<div class="tt-pagination tt-pagination-left">
  <div id="specialsListingTopNumber" class="navSplitPagesResult back"><?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_ALL); ?></div>
  <div id="specialsListingTopLinks" class="navSplitPagesLinks forward"><?php echo TEXT_RESULT_PAGE . $specials_split->display_links($max_display_page_links, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page')), $paginateAsUL); ?></div>
</div>
<?php
  }
?>
<br class="clearBoth">

<!-- bof: specials -->
<?php require( $template->get_template_dir( 'tpl_wt_display_styles.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common'). '/tpl_wt_display_styles.php' ); ?>
<!-- eof: specials -->

<?php
  if (($specials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<div class="tt-pagination tt-pagination-left pagi-bot">
  <div id="specialsListingBottomNumber" class="navSplitPagesResult back"><?php echo $specials_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_ALL); ?></div>
  <div id="specialsListingBottomLinks" class="navSplitPagesLinks forward"><?php echo TEXT_RESULT_PAGE . $specials_split->display_links($max_display_page_links, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page')), $paginateAsUL); ?></div>
</div>
<?php
  }
?>
<br class="clearBoth">

<div class="buttonRow back"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
</div>