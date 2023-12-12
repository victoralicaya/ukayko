<?php
/**
 * Module Template
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: torvista 2022 Feb 18 Modified in v1.5.8-alpha $
 */
?>
<?php require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_MAIN_PRODUCT_IMAGE)); ?> 
<div id="productMainImage" class="centeredContent prodinfo-image back">
<?php /*========================================== LIGHTBOX ==================================*/ ?>
<div class="back product-main-image__item">
<?php // bof Zen Lightbox 2008-12-15 aclarke ?>
<?php
if (ZEN_LIGHTBOX_STATUS == 'true') {
  if (ZEN_LIGHTBOX_GALLERY_MODE == 'true' && ZEN_LIGHTBOX_GALLERY_MAIN_IMAGE == 'true') {
    $rel = 'lightbox-g';
  } else {
    $rel = 'lightbox';
  }
?>

<script language="javascript"><!--
document.write('<?php echo '<a rel='.$rel.' href="' . zen_lightbox($products_image_large, addslashes($products_name), MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '">' . zen_image($products_image_large, addslashes($products_name), MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '</a>'; ?>');
//--></script>
<?php } else { ?>
<?php // eof Zen Lightbox 2008-12-15 aclarke ?>
<script language="javascript"><!--
document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id'], 'SSL') . '\\\')">' . zen_image(addslashes($products_image_large), addslashes($products_name), MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '</a>'; ?>');
//--></script>
<?php // bof Zen Lightbox 2008-12-15 aclarke ?>
<?php } ?>
<?php // eof Zen Lightbox 2008-12-15 aclarke ?>
<noscript>
<?php
  echo '<a href="' . zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']) . '" target="_blank">' . zen_image($products_image_medium, $products_name, MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT) . '<br /><span class="imgLink">' . TEXT_CLICK_TO_ENLARGE . '</span></a>';
?>
</noscript>
<?php /*==========================================EOF LIGHTBOX ==================================*/ ?>
</div>
</div>