<?php
$content = "";
$content .= '<ul id="cat-toggle" class="category-nav cat-toggle">';
if(function_exists('wt_neoncart_menu')){
	$content .= wt_neoncart_menu('mmenu');	
}

if (SHOW_CATEGORIES_BOX_SPECIALS == 'true' or SHOW_CATEGORIES_BOX_PRODUCTS_ALL == 'true'){
	$content .= '';  // insert a blank line/box in the menu
	if (SHOW_CATEGORIES_BOX_SPECIALS == 'true') {
	  $content .= '<li><a href="' . zen_href_link(FILENAME_SPECIALS) . '">' . CATEGORIES_BOX_HEADING_SPECIALS . '</a></li>';
	}
	if (SHOW_CATEGORIES_BOX_PRODUCTS_NEW == 'true') {
	  $content .= '<li><a href="' . zen_href_link(FILENAME_PRODUCTS_NEW) . '">' . CATEGORIES_BOX_HEADING_WHATS_NEW . '</a></li>';
	}
	if (SHOW_CATEGORIES_BOX_FEATURED_PRODUCTS == 'true') {
	  $show_this = $db->Execute("select products_id from " . TABLE_FEATURED . " where status= 1 limit 1");
	  if ($show_this->RecordCount() > 0) {
		$content .= '<li><a href="' . zen_href_link(FILENAME_FEATURED_PRODUCTS) . '">' . CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS . '</a></li>';
	  }
	}
	if (SHOW_CATEGORIES_BOX_PRODUCTS_ALL == 'true') {
	  $content .= '<li><a href="' . zen_href_link(FILENAME_PRODUCTS_ALL) . '">' . CATEGORIES_BOX_HEADING_PRODUCTS_ALL . '</a></li>';
	}
}
$content .= '</ul>';
// May want to add ............onfocus="this.blur()"...... to each A HREF to get rid of the dotted-box around links when they're clicked.
// just parse the $content string and insert it into each A HREF tag
