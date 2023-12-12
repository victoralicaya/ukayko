<?php

$define = [
	'WT_QUICK_VIEW_TEXT' => 'Quick View',

	'TEXT_PRODUCT_NOT_FOUND' => 'Sorry, the product was not found.',
	'TEXT_CURRENT_REVIEWS' => 'Current Reviews:',
	'TEXT_MORE_INFORMATION' => 'For more information, please visit this product\'s <a href="%s" target="_blank">webpage</a>.',
	'TEXT_DATE_ADDED' => 'This product was added to our catalog on %s.',
	'TEXT_DATE_AVAILABLE' => 'This product will be in stock on %s.',
	'TEXT_ALSO_PURCHASED_PRODUCTS' => 'Customers also purchased',
	'TEXT_PRODUCT_OPTIONS' => 'Please Choose: ',
	'TEXT_PRODUCT_MANUFACTURER' => 'Manufactured by: ',
	'TEXT_PRODUCT_WEIGHT' => 'Shipping Weight: ',
    'TEXT_PRODUCT_QUANTITY' => 'In Stock: ',
	'TEXT_ADD_YOUR_REVIEW' => 'Add Your Review',
	'TEXT_QUICK_OVERVIEW' => 'Quick Overview',
	'TEXT_ADDITIONAL_INFORMATION' => 'Additional Information',
	'TEXT_PRODUCT_DESCRIPTION' => 'Description',
	'TEXT_PRODUCT_REVIEWS' => 'Reviews',
    'TEXT_PRODUCT_COMMENTS' => 'Comments',

	'PREV_NEXT_PRODUCT' => 'Product ',
	'PREV_NEXT_FROM' => ' from ',
	'IMAGE_BUTTON_PREVIOUS' => 'Previous Item',
	'IMAGE_BUTTON_NEXT' => 'Next Item',
	'IMAGE_BUTTON_RETURN_TO_PRODUCT_LIST' => 'Back to Product List',

    'TEXT_ATTRIBUTES_PRICE_WAS' => ' [was: ',
	'TEXT_ATTRIBUTE_IS_FREE' => ' now is: Free]',
	'TEXT_ONETIME_CHARGE_SYMBOL' => ' *',
	'TEXT_ONETIME_CHARGE_DESCRIPTION' => ' One time charges may apply',
	'TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK' => 'Quantity Discounts Available',

	'ATTRIBUTES_PRICE_DELIMITER_PREFIX' => ' ( ',
	'ATTRIBUTES_PRICE_DELIMITER_SUFFIX' => ' )',
	'ATTRIBUTES_WEIGHT_DELIMITER_PREFIX' => ' (',
	'ATTRIBUTES_WEIGHT_DELIMITER_SUFFIX' => ') ',
	
	'TEXT_OF_5_STARS' => '%s of 5 Stars',
	'DG_CUSTOMER_REVIEWS_TITLE' => 'Customer Reviews:',
	'TEXT_PRODUCT_AVAILABILITY' => 'Availability: ',
	'TEXT_PRODUCT_UNITS_IN_STOCK' => 'Units in Stock: ',

];

$define['ATTRIBUTES_QTY_PRICE_SYMBOL'] = zen_image(DIR_WS_TEMPLATE_ICONS . 'icon_status_green.gif', $define['TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK'], 10, 10) . '&nbsp;';

return $define;