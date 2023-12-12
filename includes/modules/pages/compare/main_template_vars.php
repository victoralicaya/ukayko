<?php
/**
 * Specials
 *
 * @package page
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: main_template_vars.php 2011-01-28 5:23:52MT brit (docreativedesign.com) $
 */


if ( !empty( $_GET['add'] ) ) {
	$comp_value_count = ( !empty( $_SESSION['compare'] ) ) ? count($_SESSION['compare']) : 0;
	if ( $comp_value_count < COMPARE_VALUE_COUNT ) {
		$cid = $_GET['add'];
		$compare_array[] = $cid;
		foreach ((array)$_SESSION['compare'] as $c) {
			if ($c != $cid) {
				$compare_array[] = $c;
			}
		}
		$_SESSION['compare'] = array_unique(array_filter($compare_array));
	}
} else if ( !empty( $_GET['remove'] ) ) {
	$cid = $_GET['remove'];
	$removed_compare_array = array();
	if ( !empty( $_SESSION['compare'] ) ) {
		foreach ( $_SESSION['compare'] as $rValue ) {
			if ( $rValue != $cid ) {
				$removed_compare_array[] = $rValue;
			}
		}
		$_SESSION['compare'] = array_unique(array_filter($removed_compare_array));
	}
}

if (!empty($_SESSION['compare'])) {
    $compare_info = array();
    $result       = array();
    $comp         = 1;

    // loop session for products
    foreach ($_SESSION['compare'] as $value) {
        if (!empty($value)) {
            $products_compare_query = "SELECT p.products_id, p.products_image, pd.products_name,
                                              p.master_categories_id, pd.products_description, p.products_price,
                                              p.products_model, p.products_weight, p.products_quantity, p.manufacturers_id
                                       FROM " . TABLE_PRODUCTS . " p
                                       LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd
                                       ON p.products_id = pd.products_id
                                       WHERE p.products_status = '1'
                                       AND p.products_id='".$value."'
                                       AND pd.language_id='".(int)$_SESSION['languages_id']."'";

            $products_compare = $db->Execute($products_compare_query);
            $products_name = '<h4 class="item_title"><a href="' . zen_href_link(zen_get_info_page($products_compare->fields['products_id']), 'cPath=' . (zen_get_generated_category_path_rev($products_compare->fields['master_categories_id'])) . '&products_id=' . $products_compare->fields['products_id'], 'SSL') . '">'.$products_compare->fields['products_name'].'</a></h4>';
            $products_image = '<a href="' . zen_href_link( zen_get_info_page( $products_compare->fields['products_id']), 'cPath=' . (zen_get_generated_category_path_rev($products_compare->fields['master_categories_id'])) . '&products_id=' . $products_compare->fields['products_id'], 'SSL') . '">' . wt_image(DIR_WS_IMAGES . $products_compare->fields['products_image'], $products_compare->fields['products_name'], IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT, 'class="listingProductImage"') . '</a>';
            $products_description = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($products_compare->fields['products_id'], $_SESSION['languages_id']))), COMPARE_DESCRIPTION);
            $products_model = $products_compare->fields['products_model'];
            $producst_weight = $products_compare->fields['products_weight'];
            $products_quantity = $products_compare->fields['products_quantity'];
            $products_price = ((zen_has_product_attributes_values($products_compare->fields['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . zen_get_products_display_price($products_compare->fields['products_id']);
            $products_manufacturer = '';
            if($products_compare->fields['manufacturers_id'] > 0) {
                $products_manufacturer = $db->Execute(
                    "SELECT manufacturers_name FROM " . TABLE_MANUFACTURERS . "
                    WHERE manufacturers_id='".$products_compare->fields['manufacturers_id']."'"
                );
                $products_manufacturer = $products_manufacturer->fields['manufacturers_name'];
            }
            $products_id = $products_compare->fields['products_id'];
			$products_remove = '<a href="'. zen_href_link(FILENAME_COMPARE, '&remove=' . $products_compare->fields['products_id'], 'SSL') .'" alt="remove" title="Remove" data-toggle="tooltip" class="compare_remove">'.'<i class="fal fa-trash-alt"></i></a>';
			$addtocart = zen_get_buy_now_button( $products_compare->fields['products_id'],'<a class="addtocart_btn btn" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products_compare->fields['products_id'], 'SSL') . '"><i class="fal fa-shopping-basket mr-2"></i>&nbsp;<span class="qck-text">'.COMPARE_BUTTON_ADD_TO_CART.'</span></a>');
      
            $compare_info = array($products_name, $products_image, $products_description, $products_model, $producst_weight, $products_quantity, $products_price, $products_manufacturer, $products_remove, $addtocart);
			
            $new_comp_result = array('pro'.$comp => $compare_info);

            $result = array_merge($result, $new_comp_result);

        } else {
            echo '<div>Value was empty, something went wrong with the array</div>';
        }
        $comp++;
    }
}

require($template->get_template_dir('tpl_compare_default.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_compare_default.php');
?>