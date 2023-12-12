<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=document_general_info.
 * Displays template according to "document-general" product-type needs
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: torvista 2022 Aug 03 Modified in v1.5.8-alpha2 $
 */
?>
<div class="centerColumn product-shop" id="docGeneralDisplay">

<?php echo zen_draw_form('cart_quantity', zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array('action')) . 'action=add_product', $request_type), 'post', 'enctype="multipart/form-data" id="addToCartForm"') . "\n"; ?>
<?php if ($messageStack->size('product_info') > 0) echo $messageStack->output('product_info'); ?>
<?php if ($module_show_categories != 0) {
		//require($template->get_template_dir('/tpl_modules_category_icon_display.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_category_icon_display.php');
	} ?>
<!--bof Prev/Next top position -->
<?php if (PRODUCT_INFO_PREVIOUS_NEXT == 1 or PRODUCT_INFO_PREVIOUS_NEXT == 3) { ?>
<?php
require($template->get_template_dir('/tpl_products_next_previous.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_products_next_previous.php'); ?>
<?php } ?>
<!--eof Prev/Next top position-->
	<div id="prod-info-top">
		<div class="sigle-product row">
			<div class="product-img-box <?php echo $prod_info_img_class; ?>">
				<div id="pinfo-left" class="group">
					<?php  if (!empty($products_image)) {
							//require($template->get_template_dir('/tpl_modules_main_product_image.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_main_product_image.php');
							require($template->get_template_dir('tpl_modules_additional_images.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_additional_images.php'); 
						}
					?>
				</div>
			</div>
			<div class="product-info-main <?php echo $prod_info_content_class; ?>">
				<div id="pinfo-right" class="product-info group grids">
					<?php if($flag_show_product_info_model == 1 || $flag_show_product_info_quantity == 1) { ?>
							<div class="wrapper">
								<ul class="extra-info">
								<?php if($flag_show_product_info_model == 1 and $products_model !='') { ?>
								<li>
									<?php echo '<span class="lbl">'.TEXT_PRODUCT_MODEL . '</span><span class="val">'.$products_model.'</span>'; ?>
								</li>
								<?php } ?>
								<?php if ($flag_show_product_info_quantity == 1) { ?>
								<li class="availability">
									<?php echo '<span class="lbl">'.TEXT_PRODUCT_AVAILABILITY.'</span>'.(($products_quantity>0 ) ? '<span class="val in-stock">'.TEXT_PRODUCT_QUANTITY.'</span>'  : '<span class=" val out-of-stock">'.TITLE_OUT_OF_STOCK.'</span>'); ?>
								</li>
								<?php } ?>
								</ul>
							</div>
							<?php } ?>
					<h2 id="productName" class="docGeneral"><?php echo $products_name; ?></h2>
					<div class="product-price">
						<h2 id="productPrices" class="docGeneral">
						<?php
						// base price
						  if ($show_onetime_charges_description == 'true') {
							$one_time = '<span >' . TEXT_ONETIME_CHARGE_SYMBOL . TEXT_ONETIME_CHARGE_DESCRIPTION . '</span><br />';
						  } else {
							$one_time = '';
						  }
						  echo $one_time . ((zen_has_product_attributes_values((int)$_GET['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . zen_get_products_display_price((int)$_GET['products_id']);
						?>
						</h2>
					</div>
					<!--eof Product Price block -->
					<?php if(SHOW_PRODUCT_INFO_REVIEWS_COUNT==1){ ?>
						<div class="product-info-review">
							<?php 
								if ($reviews->fields['count'] > 0 ) { 
									if ($flag_show_product_info_reviews_count == 1) {
										echo wt_neoncart_product_reviews( $_GET['products_id'], wt_get_info_page( $product_info ) );
									} 
								} ?>
							<a href="<?php echo  zen_href_link(FILENAME_PRODUCT_REVIEWS, zen_get_all_get_params(), 'SSL'); ?>" title="<?php echo BUTTON_REVIEWS_ALT; ?>">
								<?php  echo TEXT_CURRENT_REVIEWS ." ". $reviews->fields['count']; ?>
							</a>
							<a class="add-review-lnk" href="<?php echo zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, zen_get_all_get_params(array('reviews_id')), 'SSL'); ?>"><?php echo TEXT_ADD_YOUR_REVIEW; ?></a>
						</div>
					<?php } ?>
					<span class="pu-devider"></span>
					<?php if ( (($flag_show_product_info_weight == 1 and $products_weight !=0) or ($flag_show_product_info_quantity == 1) or ($flag_show_product_info_manufacturer == 1 and !empty($manufacturers_name))) ) { ?>
					<ul id="productDetailsList" class="extra-info extra-info-full">
					  <?php echo (($flag_show_product_info_weight == 1 and $products_weight !=0) ? '<li><span class="lbl">' . TEXT_PRODUCT_WEIGHT .'</span><span class="val">' .  $products_weight . TEXT_PRODUCT_WEIGHT_UNIT . '</span></li>'  : '') . "\n"; ?>
					  <?php echo (($flag_show_product_info_quantity == 1) ? '<li><span class="lbl">' .TEXT_PRODUCT_UNITS_IN_STOCK . '</span><span class="val">&nbsp;' . $products_quantity . '</span></li>'  : '') . "\n"; ?>
					  <?php echo (($flag_show_product_info_manufacturer == 1 and !empty($manufacturers_name)) ? '<li><span class="lbl">' . TEXT_PRODUCT_MANUFACTURER .'</span><span class="val">' . $manufacturers_name . '</span></li>' : '') . "\n"; ?>
					  <!--bof Product date added/available-->
					<?php
						if ($products_date_available > date('Y-m-d H:i:s')) {
							if ($flag_show_product_info_date_available == 1) {?>
								<li id="productDateAvailable" class="docGeneral product-date-availability"><?php echo sprintf(TEXT_DATE_AVAILABLE, '<strong>' . zen_date_long($products_date_available) . '</strong>'); ?></li>
							<?php }
						} else {
							if ($flag_show_product_info_date_added == 1) { ?>
								<li id="productDateAdded" class="docGeneral product-date-availability"><?php echo sprintf(TEXT_DATE_ADDED,  '<strong>' . zen_date_long($products_date_added)  . '</strong>' ); ?></li>
							<?php } // $flag_show_product_info_date_added
						}
					?>
					<!--eof Product date added/available -->
					</ul>
					<?php
					  }
					?>
					<?php
					if ($flag_show_ask_a_question) {
					?>
					<!-- bof Ask a Question --> 
					<br />
					<span id="productQuestions" class="biggerText">
					<b><?php echo '<a href="' . zen_href_link(FILENAME_ASK_A_QUESTION, 'pid=' . $_GET['products_id'], 'SSL') . '">' . ASK_A_QUESTION . '</a>'; ?></b>
					</span>
					<br class="clearBoth">
					<!-- eof Ask a Question -->
					<?php
					}
					?>
					<?php if($products_description!='' && $display_prod_short_desc==1){  ?>
					<div class="short-description mt-30">
						<?php 
						// strip tags to avoid breaking any html
						$short_desc_string = strip_tags($products_description);
						if (strlen($short_desc_string) > 300) {
							$short_desc_string = substr($short_desc_string, 0, 300);
							$short_desc_string = substr($short_desc_string, 0, strrpos($short_desc_string, ' ')).'...'; 
						}
						echo $short_desc_string;
						?>
					</div>
					<?php }  ?>
					
					<?php if(zen_get_product_is_always_free_shipping($products_id_current) && $flag_show_product_info_free_shipping) { ?>
					<div id="freeShippingIcon"><?php echo TEXT_PRODUCT_FREE_SHIPPING_ICON; ?></div>
					<?php } ?>
					
					<div id="cart-box" class="grids">
						<!--bof Attributes Module -->
						<?php
						  if ($pr_attr->fields['total'] > 0) {
						?>
						<?php
						/**
						 * display the product atributes
						 */
						  require($template->get_template_dir('/tpl_modules_attributes.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_attributes.php'); ?>
						<?php
						  }
						?>
						<!--eof Attributes Module -->

						<!--bof Add to Cart Box -->
						<?php
						if (CUSTOMERS_APPROVAL == 3 and TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM == '') {
						  // do nothing
						} else {
						?>
						<div class="cart-wrapper">
						<?php
							$display_qty = (($flag_show_product_info_in_cart_qty == 1 and $_SESSION['cart']->in_cart($_GET['products_id'])) ? '<p>' . PRODUCTS_ORDER_QTY_TEXT_IN_CART . $_SESSION['cart']->get_quantity($_GET['products_id']) . '</p>' : '');
							$wishlist_link = $compare_link = '';
							if (UN_DB_MODULE_WISHLISTS_ENABLED == 'true' ) { $wishlist_link= '<li><a class="button btn" title="'.UN_TEXT_ADD_WISHLIST.'" href="' . zen_href_link(UN_FILENAME_WISHLIST, 'products_id=' . $_GET['products_id'] . '&action=wishlist_add_product', 'SSL') . '"><span class="icon"><i class="icon material-icons">favorite</i></span><span class="text">'.UN_TEXT_ADD_WISHLIST.'</span></a></li>';}
							if(COMPARE_VALUE_COUNT > 0){
								$compare_link='<li><a class="button btn" title="'.TITLE_ADD_TO_COMPARE.'" href="javascript: compareNew(this, '.$_GET['products_id'].', \'add\')"><span class="icon"><i class="material-icons icon">sort</i></span><span class="text">'.TITLE_ADD_TO_COMPARE.'</span></a></li>';
							}
							if ($products_qty_box_status == 0 or $products_quantity_order_max== 1) {
							  // hide the quantity box and default to 1
							  $the_button = '<input type="hidden" name="cart_quantity" value="1" />' . zen_draw_hidden_field('products_id', (int)$_GET['products_id']) . zen_image_submit(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT);
							} else {
							// show the quantity box
							$the_button = '
							<div class="max-qty">' . zen_get_products_quantity_min_units_display((int)$_GET['products_id']) . '</div>
							<div class="crt-rw">  
								<div class="qty-input-wra">
									<span class="qty-text">' . PRODUCTS_QTY_TEXT . '</span>
									<div class="qty-wra spplus-minus">
										<span class="spplus-minus sp-minus"><i class="material-icons">remove</i></span>
										<span class="qty-input cart-box">
											<input type="text" name="cart_quantity" value="' . (zen_get_buy_now_qty($_GET['products_id'])) . '" maxlength="6" size="4" />' . zen_draw_hidden_field('products_id', (int)$_GET['products_id']).'
										</span>
										<span class="sp-plus"><i class="material-icons">add</i></span>
									</div>
								</div>'. 
								'<div class="cart-btn">
									<button class="submit_button button btn  button2"><i class="material-icons">shopping_cart</i><span class="text">'.BUTTON_IN_CART_ALT.'</span></button>
								</div>
								<div class="product-extra-link">'.(($wishlist_link!='' || $compare_link!='')? '<ul class="product-link">'.$wishlist_link.$compare_link.'</ul>' : '').'</div>
							</div>
							';
							}
							$display_button = zen_get_buy_now_button($_GET['products_id'], $the_button);
							
						?>
						<?php if ($display_qty != '' or $display_button != '') { ?>
							<div id="cartAdd" class="cart-add">
								<?php echo $display_qty; ?>	
								<div class="addtocart-bx">
									<?php echo $display_button; ?>
								</div>
							</div>
						<?php   } // display qty and button ?>
						<?php } // CUSTOMERS_APPROVAL == 3 ?>
						<!--eof Add to Cart Box-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="products-detalis-area product-tabs <?php echo $prod_tab_style_class; ?> toggle-content tabs ptb-50 col-sm-12">
		<dl id="collateral-tabs" class="tab-content collateral-tabs">
			<dt class="tab-container"><a href="javascrpt:void(0);" data-toggle="tab"><?php echo TEXT_PRODUCT_DESCRIPTION; ?></a></dt>
			<dd class="tab tab-pane active in" id="Description">
				<div class="tab-description">
					<div id="productDescription" class="docGeneral biggerText"><p class="text"><?php echo stripslashes($products_description); ?></p></div>
					<!--bof Product URL -->
					<?php
					  if (!empty($products_url)) {
						if ($flag_show_product_info_url == 1) {
					?>
						<p id="productInfoLink" class="docGeneral centeredContent"><?php echo sprintf(TEXT_MORE_INFORMATION, zen_href_link(FILENAME_REDIRECT, 'action=product&products_id=' . zen_output_string_protected($_GET['products_id']), 'NONSSL', true, false)); ?></p>
					<?php
						} // $flag_show_product_info_url
					  }
					?>
					<!--eof Product URL -->
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
				</div>
			</dd>
			<?php if ($flag_show_product_info_reviews == 1) { ?>
			<dt class="tab-container"><a href="javascrpt:void(0);" data-toggle="tab"><?php echo TEXT_PRODUCT_REVIEWS; ?>&nbsp;<?php echo "(".$reviews->fields['count'].")"; ?></a></dt>
			<dd class="tab tab-pane fade " id="Reviews">
					<div class="reviews-list-wrapper">
						<?php // if more than 0 reviews, then show reviews button; otherwise, show the "write review" button ?>
						<?php if ($reviews->fields['count'] > 0 ) { ?>
							<?php require($template->get_template_dir('tpl_dgReview.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_dgReview.php');?>
						<?php } else { ?>
							<div id="productReviewLink" class="buttonRow back"><?php echo TEXT_NO_REVIEWS; ?> <br/><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, zen_get_all_get_params(array()), 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) . '</a>'; ?>
							</div>
						<?php
						  } ?>
					</div>
			</dd>
			<?php }	?>
		</dl>
		<!-- tab-area-end -->
	</div>
	<!--bof also purchased products module-->
	<?php require($template->get_template_dir('tpl_modules_also_purchased_products.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_also_purchased_products.php');?>
	<!--eof also purchased products module-->
	<!--bof Prev/Next bottom position -->
    <?php if (PRODUCT_INFO_PREVIOUS_NEXT == 2 or PRODUCT_INFO_PREVIOUS_NEXT == 3) { ?>
    <?php
    /**
     * display the product previous/next helper
     */
     require($template->get_template_dir('/tpl_products_next_previous.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_products_next_previous.php'); ?>
    <?php } ?>
    <!--eof Prev/Next bottom position -->
<!--bof Form close-->
</form>
<!--bof Form close-->
</div>