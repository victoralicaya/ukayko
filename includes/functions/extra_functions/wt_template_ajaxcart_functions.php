<?php
#WT_NEONCART_TEMPLATE_BASE#

function wtAjaxMinicart(){
	global $db, $currencies, $zco_notifier;
	$zco_notifier->notify('NOTIFIER_START_WT_AJXMINICART');
	$content  = "";
	$content .= '<div class="tt-dropdown-menu">
				<h5 class="title_text position-absolute pt-3 top-0 px-4"><i class="far fa-bars me-2"></i> '.HEADING_YOUR_CART.'</h5>';
		$products = $_SESSION['cart']->get_products();
		if ( $_SESSION['cart']->count_contents() > 0 ) {
			$content .= '<ul class="cart_items_list ul_li_block mb_30 clearfix">';
			for ($i=0, $n=sizeof($products); $i<$n; $i++) {
				
				$attributeHiddenField = "";
				$attrArray2 = false;
				$productsName = $products[$i]['name'];
				// Push all attributes information in an array
				if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
					if (PRODUCTS_OPTIONS_SORT_ORDER=='0') {
						$options_order_by= ' ORDER BY LPAD(popt.products_options_sort_order,11,"0")';
					}else {
						$options_order_by= ' ORDER BY popt.products_options_name';
					}
					foreach ($products[$i]['attributes'] as $option => $value) {
						$attributes = "SELECT popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix
									 FROM " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
									 WHERE pa.products_id = :productsID
									 AND pa.options_id = :optionsID
									 AND pa.options_id = popt.products_options_id
									 AND pa.options_values_id = :optionsValuesID
									 AND pa.options_values_id = poval.products_options_values_id
									 AND popt.language_id = :languageID
									 AND poval.language_id = :languageID " . $options_order_by;

						$attributes = $db->bindVars($attributes, ':productsID', $products[$i]['id'], 'integer');
						$attributes = $db->bindVars($attributes, ':optionsID', $option, 'integer');
						$attributes = $db->bindVars($attributes, ':optionsValuesID', $value, 'integer');
						$attributes = $db->bindVars($attributes, ':languageID', $_SESSION['languages_id'], 'integer');
						$attributes_values = $db->Execute($attributes);
						//clr 030714 determine if attribute is a text attribute and assign to $attr_value temporarily
						if ($value == PRODUCTS_OPTIONS_VALUES_TEXT_ID) {
							$attributeHiddenField .= zen_draw_hidden_field('id[' . $products[$i]['id'] . '][' . TEXT_PREFIX . $option . ']',  $products[$i]['attributes_values'][$option]);
							$attr_value = $products[$i]['attributes_values'][$option];
						}else {
							$attributeHiddenField .= zen_draw_hidden_field('id[' . $products[$i]['id'] . '][' . $option . ']', $value);	
							$attr_value = $attributes_values->fields['products_options_values_name'];
						}

						$attrArray2[$option]['products_options_name'] = $attributes_values->fields['products_options_name'];
						$attrArray2[$option]['options_values_id'] = $value;
						$attrArray2[$option]['products_options_values_name'] = zen_output_string_protected($attr_value) ;
						$attrArray2[$option]['options_values_price'] = $attributes_values->fields['options_values_price'];
						$attrArray2[$option]['price_prefix'] = $attributes_values->fields['price_prefix'];
					}
				} //end foreach [attributes]
			$content .=	'<li class="item">
								<div class="item_image">
									'. zen_get_products_image($products[$i]['id'], SMALL_IMAGE_WIDTH,SMALL_IMAGE_HEIGHT) .'
								</div>
								<div class="item_content">
									<h4 class="item_title">'. $products[$i]['name'] .'</h4>';
									if (isset($attrArray2) && is_array($attrArray2)) {
										reset($attrArray2);
										$content.='<ul class="ul_li_block clearfix">';
											foreach ($attrArray2 as $option => $value2) {
												$content.='<li class="small mb-0 px-0"><strong>'.$value2['products_options_name'].':</strong> '.nl2br($value2['products_options_values_name']).'</li>';
											}
										$content.='</ul>';
									}
			$content .=	'<div class="item_price"><small>'. $products[$i]['quantity'] .'&nbsp;X&nbsp;</small>'. ( $currencies->display_price($products[$i]['final_price'], zen_get_tax_rate($products[$i]['tax_class_id']), 1) . ($products[$i]['onetime_charges'] != 0 ? $currencies->display_price($products[$i]['onetime_charges'], zen_get_tax_rate($products[$i]['tax_class_id']), 1) : '') ) .'</div>
								</div>
								<a class="remove_btn cartRemoveItemDisplay" href="'.zen_href_link(FILENAME_SHOPPING_CART, 'action=remove_product&product_id=' . $products[$i]['id'], 'SSL').'" title="'.WT_CART_TEXT_DELETE.'"><i class="fal fa-trash-alt"></i></a>
						</li>';
			}
			$content .= '</ul>';
			$content .= '<ul class="total_price ul_li_block mb_30 clearfix">
							<li class="border-top-0">
								<span>'. WT_CART_SUBTOTAL .'</span>
								<span>'. $currencies->format($_SESSION['cart']->show_total()) .'</span>
							</li>
						</ul>';
			$content .= '<ul class="btns_group ul_li_block clearfix">
							<li>
								<a href="'. zen_href_link(FILENAME_SHOPPING_CART, '', 'SSL') .'" class="btn_round">'. WT_CART_VIEW_CART .'</a>
							</li>
							<li>
								<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '" class="btn_round">' . BUTTON_PROCEED_TO_CHECKOUT_ALT . '</a>
							</li>
						</ul>';
		} else {
			$content .= '<ul class="info_list ul_li_center"><li><div class="tt-cart-empty d-flex align-items-center flex-column w-100 gap-3 mt-5">
								<i class="fal fa-shopping-bag fa-10x opacity-25"></i>
								<p>'.WT_CART_EMPTY.'</p>
							</div></li></ul>';
		}
		$content .= '
			</div>
			';
	$zco_notifier->notify('NOTIFIER_END_WT_AJXMINICART', array('content' => $content), $content);
	return $content;
}