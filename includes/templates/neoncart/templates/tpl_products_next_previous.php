<?php
/**
 * Page Template
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Jul 10 Modified in v1.5.8-alpha $
 */
?>
<?php if (SHOW_PREVIOUS_NEXT_STATUS == 1 && $products_found_count > 1) { ?>
<?php
$prev_next_data_ar = $prev_next_data = array();
$prev_next_data_ar[] = ($next_item) ? $next_item : '';
$prev_next_data_ar[] = ($previous) ? $previous : '';
global $db;
if(!empty($prev_next_data_ar)){
	$sql = "select p.products_id, p.products_image, pd.products_name from " . TABLE_PRODUCTS . " p LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '".$_SESSION['languages_id']."'  where p.products_id in (" . implode(',',$prev_next_data_ar) . ")";
	$prev_nex_res = $db->Execute($sql);
	while (!$prev_nex_res->EOF) {
        $prev_next_data[$prev_nex_res->fields['products_id']] = array('products_name' => $prev_nex_res->fields['products_name'], 'products_image' => $prev_nex_res->fields['products_image']);
        $prev_nex_res->MoveNext();
      }
}
//return zen_image(DIR_WS_IMAGES . $look_up->fields['products_image'], zen_get_products_name($product_id), $width, $height);
?>
<div class="navNextPrevWrapper centeredContent">
<a class="navNextPrevList prd-block-prevnext-arrow js-prd-block-next" href="<?php echo zen_href_link(zen_get_info_page($next_item), "cPath=$cPath&products_id=$next_item"); ?>"><i class="icon-angle-right"></i></a>
<?php if (SHOW_PREVIOUS_NEXT_IMAGES >= 1 || (SHOW_PREVIOUS_NEXT_IMAGES == 2)) { ?>
<div class="prd-next">
	<div class="prd-next-img"><?php echo zen_image(DIR_WS_IMAGES . $prev_next_data[$next_item]['products_image'], $prev_next_data[$next_item]['products_name'], PREVIOUS_NEXT_IMAGE_WIDTH, PREVIOUS_NEXT_IMAGE_HEIGHT); ?></div>
	<div class="prd-next-info">
		<h2 class="prd-next-title"><?php echo $prev_next_data[$next_item]['products_name']; ?></h2>
		<div class="prd-prevnext-price">
			<div class="prd-price"><?php echo zen_get_products_display_price($next_item); ?></div>
		</div>
	</div>
</div>
<?php } ?>
<a class="navNextPrevList prd-block-prevnext-arrow js-prd-block-prev" href="<?php echo zen_href_link(zen_get_info_page($previous), "cPath=$cPath&products_id=$previous"); ?>"><i class="icon-angle-left"></i></a>
<?php if (SHOW_PREVIOUS_NEXT_IMAGES >= 1 || (SHOW_PREVIOUS_NEXT_IMAGES == 2)) { ?>
<div class="prd-prev">
	<div class="prd-prev-img"><?php echo zen_image(DIR_WS_IMAGES . $prev_next_data[$previous]['products_image'], $prev_next_data[$previous]['products_name'], PREVIOUS_NEXT_IMAGE_WIDTH, PREVIOUS_NEXT_IMAGE_HEIGHT); ?></div>
	<div class="prd-prev-info">
		<h2 class="prd-prev-title"><?php echo $prev_next_data[$previous]['products_name']; ?></h2>
		<div class="prd-prevnext-price">
			<div class="prd-price"><?php echo zen_get_products_display_price($previous); ?></div>
		</div>
	</div>
</div>
<?php } ?>
</div>
<?php } ?>