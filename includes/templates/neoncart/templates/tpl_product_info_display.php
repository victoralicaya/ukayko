<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=product_info.
 * Displays details of a typical product
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Steve 2021 Jun 14 Modified in v1.5.8-alpha $
 */

//require(DIR_WS_MODULES . '/debug_blocks/product_info_prices.php');
?>
<div class="centerColumn product-info details_section shop_details pb-0 clearfix" id="productGeneral">

	<!--bof Form start-->
	<?php echo zen_draw_form('cart_quantity', zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array('action')) . 'action=add_product', $request_type), 'post', 'enctype="multipart/form-data" id="addToCartForm"') . "\n"; ?>
	<!--eof Form start-->

	<?php if ($messageStack->size('product_info') > 0) echo $messageStack->output('product_info'); ?>

	<!--bof Category Icon -->
	<?php if ($module_show_categories != 0) { ?>
	<?php
	/**
	 * display the category icons
	 */
	//require($template->get_template_dir('/tpl_modules_category_icon_display.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_category_icon_display.php'); ?>
	<?php } ?>
	<!--eof Category Icon -->

	<!--bof Prev/Next top position -->
	<?php if (PRODUCT_INFO_PREVIOUS_NEXT == 1 or PRODUCT_INFO_PREVIOUS_NEXT == 3) { ?>
	<?php
	/**
	 * display the product previous/next helper
	 */
	require($template->get_template_dir('/tpl_products_next_previous.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_products_next_previous.php'); ?>
	<?php } ?>
	<!--eof Prev/Next top position-->
	<div id="prod-info-top" class="container-fluid-mobile <?php echo ( $elevatezoom_style == 'pro' ) ? 'container-mobile-airSticky' : ''; ?>">
		<div class="row mb_100 justify-content-lg-between  <?php echo ( $elevatezoom_style == 'pro' ) ? 'airSticky_stop-block' : ''; ?>">
			<div id="pinfo-left" class="<?php echo $prod_info_img_class; ?> group">
				<!--bof Main Product Image -->
				<?php if (!empty($products_image)) { ?>
				<?php require($template->get_template_dir('/tpl_modules_additional_images.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_additional_images.php'); ?>
				<?php } ?>
				<div class="tt-mobile-product-layout col-12 visible-xs mb-3">
					<div class="tt-mobile-product-slider arrow-location-center slick-animated-show-js">
						<div><?php echo wt_image(addslashes($products_image_large), addslashes($products_name), MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT, 'data-zoom-image="' . addslashes($products_image_large) . '"'); ?></div>
						<?php
						if ( is_array( $list_box_contents ) > 0 ) {
							for ( $row = 0; $row < sizeof( $list_box_contents ); $row++ ) {
								for ( $col = 0; $col < sizeof( $list_box_contents[$row] ); $col++ ) {
									if ( isset( $list_box_contents[$row][$col]['text']['large'] ) ) {
										echo '<div ' . wt_stringify_atts( $list_box_contents[$row][$col]['params'] ) . '>' . $list_box_contents[$row][$col]['text']['large'] .  '</div>';
									}
								}
							}
						}
						?>
					</div>
				</div>
			</div>
			<div id="pinfo-right" class="<?php echo $prod_info_content_class; ?> group grids">
				<div class="pinfo-single-inner <?php echo ( $elevatezoom_style == 'pro' && sizeof( $list_box_contents ) > 0 ) ? 'airSticky airSticky_relative' : ''; ?>">
					<div class="tt-product-single-info">
						<h1 id="productName" class="item_title mb_15 productGeneral"><?php echo $products_name; ?></h1>
						<div class="item_price mb_15 d-flex align-items-center">
							<span id="productPrices" class="productGeneral new-price">
								<?php
								// base price
								  if ($show_onetime_charges_description == 'true') {
									$one_time = '<span >' . TEXT_ONETIME_CHARGE_SYMBOL . TEXT_ONETIME_CHARGE_DESCRIPTION . '</span><br />';
								  } else {
									$one_time = '';
								  }
								  echo $one_time . ((zen_has_product_attributes_values((int)$_GET['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . zen_get_products_display_price((int)$_GET['products_id']);
								?>
							</span>
						</div>
						<?php if ( SHOW_PRODUCT_INFO_REVIEWS_COUNT == 1 ) { ?>
						<div class="rating_review_wrap d-flex align-items-center gap-2 clearfix product-info-review mb_15">
							<?php 
							if ( $flag_show_product_info_reviews_count == 1 ) {
								echo wt_neoncart_product_reviews( $_GET['products_id'], wt_get_info_page( $product_info ) );
							} 
							?>
							<a href="<?php echo  zen_href_link(FILENAME_PRODUCT_REVIEWS, zen_get_all_get_params(), 'SSL'); ?>" title="<?php echo BUTTON_REVIEWS_ALT; ?>" class="product-page-gotocomments-js">(<?php  echo $reviews->fields['count']. '&nbsp;&nbsp;'.TEXT_PRODUCT_REVIEWS; ?>)</a>
							<a class="add-review-lnk" href="<?php echo zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, zen_get_all_get_params(array('reviews_id')), 'SSL'); ?>"><?php echo TEXT_ADD_YOUR_REVIEW; ?></a>
						</div>
						<?php } ?>
						<?php if ( !empty( $products_description ) && $display_prod_short_desc == 1 ) { ?>
						<div class="tt-wrapper short-description mb-3">
							<?php 
							// strip tags to avoid breaking any html
							$short_desc_string = strip_tags($products_description);
							if ( strlen($short_desc_string) > 300 ) {
								$short_desc_string = substr($short_desc_string, 0, 300);
								$short_desc_string = substr($short_desc_string, 0, strrpos($short_desc_string, ' ')).'...'; 
							}
							echo $short_desc_string;
							?>
						</div>
						<?php }  ?>
						<div class="tt-add-info">
							<!--bof Product details list  -->
							<?php if ( (($flag_show_product_info_model == 1 and $products_model != '') or ($flag_show_product_info_quantity == 1) ) ) { ?>
							<ul id="productDetailsList" class="modern_product_info ul_li_block mb-3 text-uppercase">
								<?php echo (($flag_show_product_info_model == 1 and $products_model !='') ? '<li>' . '<span>' . TEXT_PRODUCT_MODEL . '</span>' . $products_model . '</li>' : '') . "\n"; ?>
								<?php echo (($flag_show_product_info_quantity == 1) ? '<li>' . '<span>' . TEXT_PRODUCT_QUANTITY . '</span>' . $products_quantity . '</li>'  : '') . "\n"; ?>
							</ul>
							<?php
							  }
							?>
							<!--eof Product details list -->
						</div>	

						<!--bof free ship icon  -->
						<?php if(zen_get_product_is_always_free_shipping($products_id_current) && $flag_show_product_info_free_shipping) { ?>
							<div id="freeShippingIcon"><?php echo TEXT_PRODUCT_FREE_SHIPPING_ICON; ?></div>
						<?php } ?>
						<!--eof free ship icon  -->
						<div id="cart-box" class="tt-wrapper grids">
							<!--bof Attributes Module -->
							<?php
							  if ($pr_attr->fields['total'] > 0) {
							?>
							<?php
							/**
							 * display the product attributes
							 */
							  require($template->get_template_dir('/tpl_modules_attributes.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_attributes.php'); ?>
							<?php
							  }
							?>
							<!--eof Attributes Module -->

							<!--bof Quantity Discounts table -->
							<?php
							  if ($products_discount_type != 0) { ?>
							<?php
							/**
							 * display the products quantity discount
							 */
							 require($template->get_template_dir('/tpl_modules_products_quantity_discounts.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_products_quantity_discounts.php'); ?>
							<?php
							  }
							?>
							<!--eof Quantity Discounts table -->
							<div class="tt-wrapper">
								<!--bof Add to Cart Box -->
								<?php
								if (CUSTOMERS_APPROVAL == 3 and TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM == '') {
								// do nothing
								} else {
								?>
								<?php
								$info_extra_links = '';
								if ( UN_DB_MODULE_WISHLISTS_ENABLED == 'true' ) {
									$info_extra_links .= '<li><a class="button-wishlist" title="'.UN_TEXT_ADD_WISHLIST.'" href="' . zen_href_link(UN_FILENAME_WISHLIST, 'products_id=' . $_GET['products_id'] . '&action=wishlist_add_product', 'SSL') . '"><span><i class="far fa-heart"></i></span>' . UN_TEXT_ADD_WISHLIST . '</a></li>';
								}
								$compare_data = get_wt_neoncart_compare( (int)$_GET['products_id'], 'product_info' );
								if ( !empty( $compare_data ) ) {
									$info_extra_links .= '<li><a class="button-compare ' . $compare_data['classes'] . '" '. $compare_data['params'] .'><span><i class="far fa-random"></i></span>' . TITLE_ADD_TO_COMPARE . '</a></li>';
								}
								if ( $flag_show_ask_a_question ) {
									//bof Ask a Question
									$info_extra_links .= '<li><a class="button-ask" href="' . zen_href_link(FILENAME_ASK_A_QUESTION, 'pid=' . $_GET['products_id'], 'SSL') . '"><span><i class="far fa-question-circle"></i></span>' . BUTTON_ASK_A_QUESTION_ALT . '</a></li>';
									//eof Ask a Question
								}
								$display_qty = (($flag_show_product_info_in_cart_qty == 1 and $_SESSION['cart']->in_cart($_GET['products_id'])) ? '<p class="col-item mb-3 qty-in-cart">' . PRODUCTS_ORDER_QTY_TEXT_IN_CART . $_SESSION['cart']->get_quantity($_GET['products_id']) . '</p>' : '');
								if ($products_qty_box_status == 0 or $products_quantity_order_max== 1) {
								  // hide the quantity box and default to 1
								  $the_button = '<input type="hidden" name="cart_quantity" value="1" />' . zen_draw_hidden_field('products_id', (int)$_GET['products_id']) . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT, '', 'btn-lg');
								  $display_button = zen_get_buy_now_button($_GET['products_id'], $the_button);
								} else if( $products_quantity <= 0 && SHOW_PRODUCTS_SOLD_OUT_IMAGE == '1' ) {
									$display_button = '<a href="javascript:void(0);" class="normal_button button btn button_sold_out">'.WT_BADGE_SOLD_OUT.'</a>';
									//$display_button = zen_get_buy_now_button($_GET['products_id'], $the_button);
								} else {
								  // show the quantity box
								  $the_button = '
									<li class="col-item">
										<div class="d-none">
											<span class="qty-text">' . PRODUCTS_ORDER_QTY_TEXT . '</span>
										</div>
										<div class="quantity_input">
											<span class="minus-btn"><i class="fal fa-minus"></i></span>
											<input type="text" name="cart_quantity" value="' . $products_get_buy_now_qty . '" maxlength="6" size="4" aria-label="' . ARIA_QTY_ADD_TO_CART . '">
											<span class="plus-btn"><i class="fal fa-plus"></i></span>
										</div>
										<div class="max-qty mt-2">' . zen_get_products_quantity_min_units_display((int)$_GET['products_id']) . '</div>
									</li>
									<li class="col-item">
									' . zen_draw_hidden_field('products_id', (int)$_GET['products_id']) . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT, '', 'btn-lg custom_btn') .
									'</li>';
									$display_button = zen_get_buy_now_button($_GET['products_id'], $the_button);
								}
								//$display_button = zen_get_buy_now_button($_GET['products_id'], $the_button);
								?>
								<?php if ($display_qty != '' or $display_button != '') { ?>
									<div id="cartAdd">
										<?php echo $display_qty; ?>	
										<div class="btns_group_1 ul_li mb_30 clearfix gap-2">
											<?php echo $display_button;?>
										</div>
									</div>
								<?php   } // display qty and button ?>
								<?php } // CUSTOMERS_APPROVAL == 3 ?>
								<!--eof Add to Cart Box-->
							</div>
							<?php if ( !empty( $info_extra_links ) ) { ?>
							<div class="tt-wrapper shop_details_content">
								<ul class="btns_group_2 ul_li clearfix mb-4">
									<?php echo $info_extra_links; ?>
								</ul>
							</div>
							<?php } ?>
							<div class="tt-wrapper">
								<div class="tt-add-info">
									<?php if ( ( ($flag_show_product_info_weight == 1 and $products_weight !=0) or ($flag_show_product_info_manufacturer == 1 and !empty($manufacturers_name))) ) { ?>
									<ul id="productDetailsList" class="product_info ul_li_block clearfix">
										<?php echo (($flag_show_product_info_weight == 1 and $products_weight !=0) ? '<li>' . '<strong>' . TEXT_PRODUCT_WEIGHT . '</strong>' .  $products_weight . TEXT_PRODUCT_WEIGHT_UNIT . '</li>'  : '') . "\n"; ?>
										<?php echo (($flag_show_product_info_manufacturer == 1 and !empty($manufacturers_name)) ? '<li>' . '<strong>' . TEXT_PRODUCT_MANUFACTURER . '</strong>' . $manufacturers_name .  '</li>' : '') . "\n"; ?>
										<!--bof Product date added/available-->
										<?php
										if ($products_date_available > date('Y-m-d H:i:s')) {
											if ($flag_show_product_info_date_available == 1) {
										?>
										<li><span id="productDateAvailable" class="productGeneral centeredContent"><?php echo sprintf(TEXT_DATE_AVAILABLE, zen_date_long($products_date_available)); ?></span></li>
										<?php
											}
										} else {
											if ($flag_show_product_info_date_added == 1) {
										?>
										<li><span id="productDateAdded" class="productGeneral centeredContent"><?php echo sprintf(TEXT_DATE_ADDED, zen_date_long($products_date_added)); ?></span></li>
										<?php
											} // $flag_show_product_info_date_added
										}
										?>
										<!--eof Product date added/available -->
									</ul>
									<?php
									}
									?>
								</div>
							</div>
							<div class="tt-wrapper">
								<!--bof Product URL -->
								<?php
							  if (!empty($products_url)) {
									if ($flag_show_product_info_url == 1) {
								?>
									<p id="productInfoLink" class="productGeneral centeredContent"><?php echo sprintf(TEXT_MORE_INFORMATION, zen_href_link(FILENAME_REDIRECT, 'action=product&products_id=' . zen_output_string_protected($_GET['products_id']), 'NONSSL', true, false)); ?></p>
								<?php
									} // $flag_show_product_info_url
								}
								?>
								<!--eof Product URL -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="details_description_tab">
		<?php require( $template->get_template_dir('/tpl_product_info_tabs_content.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_product_info_tabs_content.php' ); ?>
	</div>
	<!--bof Prev/Next bottom position -->
	<?php if (PRODUCT_INFO_PREVIOUS_NEXT == 2 or PRODUCT_INFO_PREVIOUS_NEXT == 3) { ?>
	<?php
	/**
	 * display the product previous/next helper
	 */
	require($template->get_template_dir('/tpl_products_next_previous.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_products_next_previous.php'); ?>
	<?php } ?>
	<!--eof Prev/Next bottom position -->

	<!--bof also purchased products module-->
	<?php require($template->get_template_dir('tpl_modules_also_purchased_products.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_also_purchased_products.php');?>
	<!--eof also purchased products module-->

	<?php require($template->get_template_dir('tpl_wt_modules_related_products.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_wt_modules_related_products.php');?>

	<!--bof Form close-->
	</form>
	<!--bof Form close-->
</div>