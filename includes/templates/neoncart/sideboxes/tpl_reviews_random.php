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
  $review_box_counter = 0;
    global $wt_pimgldr;
    //lazyload Class
	$lazyClass = (!empty($wt_pimgldr)) ? $wt_pimgldr['class'] : '';
	$nums_reviews = $random_review_sidebox_product->RecordCount();
	if($nums_reviews > 0){
	$content .= '<div class="tt-aside tt-carousel-products arrow-location-03" data-item="2" data-item-lg="2" data-item-md="2" data-item-sm="2" data-slider-vertical="true">';
	while (!$random_review_sidebox_product->EOF) {
		$review_box_counter++;
		$products_lst = $random_review_sidebox_product;
		/*BOF changed by WT Tech. -------------------*/
		//set cPath
		$cPath = zen_get_generated_category_path_rev($products_lst->fields['master_categories_id']);
		//set Infopagelink
		$zen_get_info_page = wt_get_info_page($products_lst);
		/*EOF changed by WT Tech. -------------------*/
		$products_price = zen_get_products_display_price($products_lst->fields['products_id']);
		$content.='<div class="item">
					<div class="supermarket_product_small">
					<div class="item_image">
						<a href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_lst->fields['products_id']) . '">
						' . wt_image( DIR_WS_IMAGES . $products_lst->fields['products_image'], $products_lst->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'class="' . $lazyClass . '"', 'product' ) . '
						</a>
					</div>
					<div class="item_content">
						<a href="' . zen_href_link($zen_get_info_page, 'cPath=' . $cPath . '&products_id=' . $products_lst->fields['products_id']) . '"><h6 class="item_title">'.$products_lst->fields['products_name'].'</h6></a>
						<div class="item_price">'. $products_price .'</div>
						'. wt_neoncart_product_reviews($products_lst->fields['products_id'], $zen_get_info_page) .'
					</div>
				</div>
			</div>';
		$random_review_sidebox_product->MoveNextRandom();
	}
  $content .= '</div>';
}
