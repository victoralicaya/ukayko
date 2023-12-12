<?php
/**
 * Page Template
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: John Thompson 2022 Jul 30 Modified in v1.5.8-alpha2 $
 */
?>
<div class="centerColumn" id="reviewsInfoDefault">
<div class="tt-product-single-info pl-0">
<div class="row">
<?php
  if (!empty($products_image)) {
   	/**
     * require the image display code
     */
?>
<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 reviews-info-productmain-image">
<div id="reviewsInfoDefaultProductImage" class="centeredContent back"><?php require($template->get_template_dir('/tpl_modules_main_product_image.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_main_product_image.php'); ?></div>
</div>
<?php
        }
?>
<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 reviews-list">

<h1 id="reviewsInfoDefaultHeading" class="tt-title mt-0"><?php echo $products_name . $products_model; ?></h1>

<h2 id="reviewsInfoDefaultPrice" class="tt-price"><?php echo $products_price; ?></h2>

<div id="reviewsInfoDefaultMainContent" class="content">
  <span class="reviews_default">
    <?php //echo zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $review_info->fields['reviews_rating'] . '.png', sprintf(TEXT_OF_5_STARS, $review_info->fields['reviews_rating'])), sprintf(TEXT_OF_5_STARS, $review_info->fields['reviews_rating']); ?>
    <?php echo zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $review_info->fields['reviews_rating'] . '.png', sprintf(TEXT_OF_5_STARS, $review_info->fields['reviews_rating'])) .'<span class="reviews_text">'. sprintf(TEXT_OF_5_STARS, $review_info->fields['reviews_rating']).'</span>'; ?>
  </span>
  <?php echo zen_break_string(nl2br(zen_output_string_protected(stripslashes($review_info->fields['reviews_text']))), 60, '-<br />'); ?>
</div>
<div id="reviewsInfoDefaultDate" class="bold mt-2"><?php echo sprintf(TEXT_REVIEW_DATE_ADDED, zen_date_short($review_info->fields['date_added'])); ?>&nbsp;<?php echo sprintf(TEXT_REVIEW_BY, zen_output_string_protected($review_info->fields['customers_name'])); ?></div>

<div class="forward mt-3">
  <div class="buttonsRow">
    <div class="buttonRow">
      <?php
        // more info in place of buy now
        if (zen_has_product_attributes($review_info->fields['products_id'] )) {
          //   $link = '<p>' . '<a href="' . zen_href_link(zen_get_info_page($review_info->fields['products_id']), 'products_id=' . $review->fields['products_id'] ) . '" title="' . $review->fields['products_id']) . '">' . MORE_INFO_TEXT . '</a>' . '</p>';
          $link = '';
        } else {
          $link= '<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action', 'reviews_id')) . 'action=buy_now') . '">' . zen_image_button(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT) . '</a>';
        }

        $the_button = $link;
        $products_link = '';
        echo zen_get_buy_now_button($review_info->fields['products_id'], $the_button, $products_link) . '<br />' . zen_get_products_quantity_min_units_display($review_info->fields['products_id']);
      ?>
    </div>
    <div id="reviewsInfoDefaultProductPageLink" class="buttonRow"><?php echo '<a href="' . zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array('reviews_id'))) . '">' . zen_image_button(BUTTON_IMAGE_GOTO_PROD_DETAILS , BUTTON_GOTO_PROD_DETAILS_ALT) . '</a>'; ?></div>
    <?php if ($reviews_counter > 1) { ?>
    <div id="reviewsInfoDefaultReviewsListingLink" class="buttonRow"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS, zen_get_all_get_params(array('reviews_id'))) . '">' . zen_image_button(BUTTON_IMAGE_MORE_REVIEWS , BUTTON_MORE_REVIEWS_ALT) . '</a>'; ?></div>
    <?php } ?>
    <div class="buttonRow"><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, zen_get_all_get_params(array('reviews_id'))) . '">' . zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) . '</a>'; ?></div>
  </div>
</div>
</div>

</div>
</div>
</div>