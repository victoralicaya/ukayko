<?php
/**
 * Side Box Template
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 25 Modified in v1.5.8-alpha $
*/
$content = "";
$featured_box_counter = 0;
$nums_products = $random_featured_product->RecordCount();
if($nums_products > 0){
	$content .= '<div class="tt-aside tt-carousel-products arrow-location-03" data-item="2" data-item-lg="2" data-item-md="2" data-item-sm="2" data-slider-vertical="true">';
	while (!$random_featured_product->EOF) {
		$featured_box_counter++;
		$content.= get_wt_neoncart_sidebox_products_content($random_featured_product);
		$random_featured_product->MoveNextRandom();
	}
	$content .= '</div>' . "\n";
}
