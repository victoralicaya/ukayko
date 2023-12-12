<?php
/**
 * Module Template:
 * Loaded by product-type template to display additional product images.
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2021 Jun 14 Modified in v1.5.8-alpha $
 */

?>
<?php
require(DIR_WS_MODULES . zen_get_module_directory('additional_images.php'));
?>
<?php /* elevate-zoom-start */ ?>
<?php if ( $prodinfo_image_effects == 'elevatezoom' ) {
	
$wrap_attr = array();

/* --------------------- Elevate Zoom Default and Vertical ------------------------------------------*/
if ( $elevatezoom_style == 'pro' ) {
?>
<?php 
	if ( zen_not_null($products_image) ) {
		require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_MAIN_PRODUCT_IMAGE));
	} ?>
	<div class="tt-product-single-img">
		<div>
			<?php if ( $num_images > 0 ) { ?>
			<button type="button" class="tt-btn-zomm tt-top-right"><i class="fal fa-search-plus"></i></button>
			<?php } ?>
			<?php echo zen_image(addslashes($products_image_large), addslashes($products_name), MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT, 'data-zoom-image="' . addslashes(DIR_WS_IMAGES.$products_image) . '" class="zoom-product"'); ?>
		</div>
	</div>
	<?php if ( $num_images > 0 ) { ?>
	<div class="product-images-static hidden-xs">
		<ul  data-scrollzoom="false">
			<?php
			if ( is_array( $list_box_contents ) > 0 ) {
				for ( $row = 0; $row < sizeof( $list_box_contents ); $row++ ) {
					for ( $col = 0; $col < sizeof( $list_box_contents[$row] ); $col++ ) {
						if ( isset( $list_box_contents[$row][$col]['text']['thumb'] ) ) {
							echo '<li ' . wt_stringify_atts( $list_box_contents[$row][$col]['params'] ) . '>' . $list_box_contents[$row][$col]['text']['thumb'] .  '</li>';
						}
					}
				}
			}
			?>
		</ul>
	</div>
	<?php
	} } else if ( $elevatezoom_style == 'trend' ) {
	?>
	<?php 
	if ( zen_not_null($products_image) ) {
		require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_MAIN_PRODUCT_IMAGE));
	} ?>
	<div class="tt-product-single-img">
		<div>
			<?php if ( $num_images > 0 ) { ?>
			<button type="button" class="tt-btn-zomm tt-top-right"><i class="fal fa-search-plus"></i></button>
			<?php } ?>
			<?php echo zen_image(addslashes($products_image_large), addslashes($products_name), MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT, 'data-zoom-image="' . addslashes(DIR_WS_IMAGES.$products_image) . '" class="zoom-product"'); ?>
		</div>
	</div>
	<?php if ( $num_images > 0 ) { ?>
	<div class="product-images-col" data-scrollzoom="false">
		<?php
		if ( is_array( $list_box_contents ) > 0 ) {
			for ( $row = 0; $row < sizeof( $list_box_contents ); $row++ ) {
				for ( $col = 0; $col < sizeof( $list_box_contents[$row] ); $col++ ) {
					if ( isset( $list_box_contents[$row][$col]['text']['thumb'] ) ) {
						echo '<div class="item" ' . wt_stringify_atts( $list_box_contents[$row][$col]['params'] ) . '>' . $list_box_contents[$row][$col]['text']['thumb'] .  '</div>';
					}
				}
			}
		}
		?>
	</div>
	<?php
	} } else { 

	$wrap_attr['id'] = 'smallGallery';
	$wrap_attr['class'] = array( 'slick-animated-show-js' );
	if ( $elevatezoom_style == 'classic-ver' ) {
		$wrap_attr['class'][] = 'tt-slick-button-vertical';
	} else {
		$wrap_attr['class'][] = 'arrow-location-02';
	}
	?>
	<div class="prodinfo-image <?php echo ( $elevatezoom_style == 'classic-ver' ) ? 'tt-product-vertical-layout' : ''; ?> hidden-xs" >
		<?php 
		if ( zen_not_null($products_image) ) {
			require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_MAIN_PRODUCT_IMAGE));
		} ?>
		<div class="tt-product-single-img">
			<div>
				<?php if ( $num_images > 0 ) { ?>
				<button type="button" class="tt-btn-zomm tt-top-right"><i class="fal fa-search-plus"></i></button>
				<?php } ?>
				<?php echo zen_image(addslashes($products_image_large), addslashes($products_name), MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT, 'data-zoom-image="' . addslashes(DIR_WS_IMAGES.$products_image) . '" class="zoom-product"'); ?>
			</div>
		</div>
		<?php if ( $num_images > 0 ) { ?>
		<div class="<?php echo ( $elevatezoom_style == 'classic-ver' ) ? 'tt-product-single-carousel-vertical' : 'product-images-carousel'; ?>">
			<ul <?php echo wt_stringify_atts( $wrap_attr ); ?>>
				<?php
				if ( is_array( $list_box_contents ) > 0 ) {
					for ( $row = 0; $row < sizeof( $list_box_contents ); $row++ ) {
						for ( $col = 0; $col < sizeof( $list_box_contents[$row] ); $col++ ) {
							if ( isset( $list_box_contents[$row][$col]['text']['thumb'] ) ) {
								echo '<li ' . wt_stringify_atts( $list_box_contents[$row][$col]['params'] ) . '>' . $list_box_contents[$row][$col]['text']['thumb'] .  '</li>';
							}
						}
					}
				}
				?>
			</ul>
		</div>
		<?php } ?>
	</div>
	<?php } ?>
	<?php /* --------------------- Elevate Zoom Pro ------------------------------------------*/ ?>

	<?php /* elevate-zoom-end */ ?>
	<?php } else if ( $prodinfo_image_effects == 'fotorama' ) { ?>
	<?php /* fotorama-zoom-start */ ?>
	<div class="fotorama" data-nav="thumbs" data-gallery-role="gallery" data-allowfullscreen="true" data-width="100%"  data-thumbwidth="200" data-thumbheight="100" data-thumbmargin="10">
	<?php
	if (zen_not_null($products_image) && $num_images == 0 ) {  
		require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_MAIN_PRODUCT_IMAGE));
		?>
		<a class="back product-main-image__item">
			<?php echo wt_image(addslashes($products_image_large), addslashes($products_name), MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT, 'lazyload'); ?>
		</a>
	<?php
	}
	if ($flag_show_product_info_additional_images != 0 && $num_images > 0) { ?>
		
		<?php 
		for($row=0;$row<sizeof($list_box_contents);$row++)
		{
			$params = "";
			for($col=0;$col<sizeof($list_box_contents[$row]);$col++){
				$r_params = "";
				if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
				if (isset($list_box_contents[$row][$col]['text']['large'])){ 
					echo '<a' . $r_params . '>' . $list_box_contents[$row][$col]['text']['large'] .  '</a>';
				}
			}
		}
		?>
	<?php } ?>
	</div>
	<?php /* fotorama-zoom-end */ ?>
	<?php } else if ( $prodinfo_image_effects == 'lightbox' ) { ?>
	<?php /* lightbox-start */ ?>
	<div class="prodinfo-image">
		<div class="product-main-image">
		<?php
			require($template->get_template_dir('/tpl_modules_main_product_image.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_main_product_image.php');
		?>
		</div>
		<?php if($num_images > 0){ ?>
		<div class="product-previews-wrapper">
			<div id="productAdditionalImages" class="lightbox-additional-imgs-carousel">
				<ul>
				<?php 
					for($row=0;$row<sizeof($list_box_contents);$row++){
						$params = "";
						for($col=1;$col<sizeof($list_box_contents[$row]);$col++){
							$r_params = "";
							if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
							if (isset($list_box_contents[$row][$col]['text']['thumb'])){ 
								echo '<li '.$r_params.'>'. $list_box_contents[$row][$col]['text']['thumb'] . '</li>';
							}
						}
					}
				?>
				</ul>
			</div>
		</div>
		<?php } ?>
	</div>
	<?php /* lightbox-end */ ?>
	<?php } else { 
	if (zen_not_null($products_image)) {  ?>
	<div class="product-main-image">
		<?php
		require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_MAIN_PRODUCT_IMAGE));
		echo wt_image(addslashes($products_image_large), addslashes($products_name), MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT,'');
		?>
	</div>
	<?php } ?>
	<?php
		require(DIR_WS_MODULES . zen_get_module_directory('additional_images.php'));
		if ($flag_show_product_info_additional_images != 0 && $num_images > 0) {
		?>
		<div id="productAdditionalImages" class="zencart-default-view">
			<ul>
		<?php 
					for($row=0;$row<sizeof($list_box_contents);$row++){
						$params = "";
						for($col=1;$col<sizeof($list_box_contents[$row]);$col++){
							$r_params = "";
							if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
							if (isset($list_box_contents[$row][$col]['text']['thumb'])){ 
								echo '<li '.$r_params.'>'. $list_box_contents[$row][$col]['text']['thumb'] . '</li>';
							}
						}
					}
				?>
			</ul>
		</div>
	<?php  } ?>
<?php } ?>