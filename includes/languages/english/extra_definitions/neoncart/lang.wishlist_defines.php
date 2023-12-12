<?php
// control multiple wishlist functionality
$define = [
	'UN_HEADER_TITLE_WISHLIST' => 'Wish List',

	'UN_BOX_HEADING_WISHLIST' => 'Wish List',
	'UN_BUTTON_IMAGE_WISHLIST_ADD' => 'wishlist_add.gif',
	'UN_BUTTON_WISHLIST_ADD_ALT' => 'Add to Wish List',
	'UN_BOX_WISHLIST_ADD_TEXT' => 'Click to add this product to your Wish List.',
	'UN_BOX_WISHLIST_LOGIN_TEXT' => '<p><a href="' . zen_href_link(FILENAME_LOGIN, '', 'NONSSL') . '">Log In</a> to be able to add this product to your Wish List.</p>',

	'UN_TEXT_SORT' => 'Sort',
	'UN_TEXT_SHOW' => 'Show',
	'UN_TEXT_VIEW' => 'View',
	'UN_TEXT_ALL_CATEGORIES' => 'All Categories',

	'UN_TEXT_ADD_WISHLIST' => 'Add to Wishlist',
	'UN_TEXT_REMOVE_WISHLIST' => 'Remove from Wishlist',
	'UN_BUTTON_IMAGE_SAVE' => BUTTON_IMAGE_UPDATE,
	'UN_BUTTON_SAVE_ALT' => BUTTON_UPDATE_ALT,
	'UN_TEXT_EMAIL_WISHLIST' => 'Tell a Friend',
	'UN_TEXT_FIND_WISHLIST' => 'Find a Friend\'s Wish List',
	'UN_TEXT_NEW_WISHLIST' => 'Create a new Wish List',
	'UN_TEXT_MANAGE_WISHLISTS' => 'Manage my Wish Lists',
	'UN_TEXT_WISHLIST_MOVE' => 'Move items between Wish Lists',
	'SUCCESS_ADDED_TO_WISHLIST_PRODUCT' => 'Successfully added Product to the Wish List ...',

	'UN_TEXT_PRIORITY' => 'Priority',
	'UN_TEXT_DATE_ADDED' => 'Date Added',
	'UN_TEXT_QUANTITY' => 'Quantity',
	'UN_TEXT_COMMENT' => 'Comment',
	
	'UN_TEXT_PRIORITY_0' => '0 - Don\'t buy this for me',
	'UN_TEXT_PRIORITY_1' => '1 - I\'m thinking about it',
	'UN_TEXT_PRIORITY_2' => '2 - Like to have',
	'UN_TEXT_PRIORITY_3' => '3 - Love to have',
	'UN_TEXT_PRIORITY_4' => '4 - Must have',

	'UN_TEXT_NO_PRODUCTS' => 'No products currently in list.',
	'UN_TEXT_COMPACT' => 'Compact',
	'UN_TEXT_EXTENDED' => 'Extended',

	'UN_LABEL_DELIMITER' => ': ',
	'UN_TEXT_REMOVE' => 'Remove',
	'UN_EMAIL_SEPARATOR' => "-------------------------------------------------------------------------------\n",
	'UN_TEXT_DATE_AVAILABLE' => 'Date Available: %s',
	'UN_TEXT_FORM_FIELD_REQUIRED' => '*',

	'UN_TABLE_HEADING_PRODUCTS' => 'Name',
	'UN_TABLE_HEADING_PRICE' => 'Price',
	'UN_TABLE_HEADING_BUY_NOW' => 'Cart',
	'UN_TABLE_HEADING_QUANTITY' => 'Qty',
	'UN_TABLE_HEADING_WISHLIST' => 'Wishlist',
	'UN_TABLE_HEADING_SELECT' => 'Select',

	'UN_ERROR_GET_ID' => 'Error getting default wishlist id.',
	'UN_ERROR_GET_CUSTDATA' => 'Error getting customer data.',
	'UN_ERROR_GET_PERMISSION' => 'You do not have permission.',
	'UN_ERROR_GET_WISHLIST' => 'Error getting wishlist.',
	'UN_ERROR_GET_WISHLIST_ID' => 'Error getting wishlist: id not set.',
	'UN_ERROR_FIND_WISHLIST' => 'Error finding wishlists.',
	'UN_ERROR_IS_PRIVATE' => 'Error determining if wishlist is private.',
	'UN_ERROR_MAKE_DEFAULT' => 'Error setting default.',
	'UN_ERROR_MAKE_DEFAULT_ZERO' => 'Error zeroing default.',
	'UN_ERROR_MAKE_PUBLIC' => 'Error making wishlist public.',
	'UN_ERROR_MAKE_PRIVATE' => 'Error making wishlist private.',
	'UN_ERROR_CREATE_DEFAULT' => 'Error creating default wishlist.',
	'UN_ERROR_IN_WISHLIST' => 'Error determining if product in wishlist.',
	'UN_ERROR_CREATE_WISHLIST' => 'Error creating wishlist.',
	'UN_ERROR_ADD_WISHLIST' => 'Error adding wishlist item.',
	'UN_ERROR_EDIT_WISHLIST' => 'Error editing wishlist item.',
	'UN_ERROR_ADD_PRODUCT_WISHLIST' => 'Error adding product to wishlist.',
	'UN_ERROR_DELETE_DEFAULT_WISHLIST' => 'Error deleting default wishlist.',
	'UN_ERROR_DELETE_WISHLIST' => 'Error deleting wishlist.',
	'UN_ERROR_DELETE_PRODUCT_WISHLIST' => 'Error deleting product from wishlist.',

];
if(UN_DB_MODULE_WISHLISTS_ENABLED == 'true'){
	$define['UN_MODULE_WISHLISTS_ENABLED'] = true;
} else {
	$define['UN_MODULE_WISHLISTS_ENABLED'] = false;
}
if(UN_DB_ALLOW_MULTIPLE_WISHLISTS == 'true'){
	$define['UN_ALLOW_MULTIPLE_WISHLISTS'] =  true;
} else {
	$define['UN_ALLOW_MULTIPLE_WISHLISTS'] = false;}
if(UN_DB_DISPLAY_CATEGORY_FILTER == 'true'){
	$define['UN_DISPLAY_CATEGORY_FILTER'] = true;
} else {
	$define['UN_DISPLAY_CATEGORY_FILTER'] = false;
}
if(UN_DB_ALLOW_MULTIPLE_PRODUCTS_CART_COMPACT == 'true'){
	$define['UN_ALLOW_MULTIPLE_PRODUCTS_CART_COMPACT'] = true;
} else {
	$define['UN_ALLOW_MULTIPLE_PRODUCTS_CART_COMPACT'] = false;
}
return $define;