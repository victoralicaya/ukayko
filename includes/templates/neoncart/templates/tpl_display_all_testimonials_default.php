<?php
/**
 * Testimonials Manager
 *
 * @package Template System
 * @copyright 2007 Clyde Jones
  * @copyright Portions Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Testimonials_Manager.php v1.5.4
 */
 
?>
<div class="centerColumn" id="testimonialDefault">
	<h1 class="tt-title no-border text-left"><?php echo HEADING_TITLE; ?></h1>
	<?php
		if (($testimonials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
	?>
	<div class="tt-pagination tt-pagination-left pagi-top">
		<div id="productsListingTopNumber" class="navSplitPagesResult back">
			<?php echo $testimonials_split->display_count(TEXT_DISPLAY_NUMBER_OF_TESTIMONIALS_MANAGER_ITEMS); ?>
		</div>
		<div id="productsListingListingTopLinks" class="navSplitPagesLinks forward filters-row__pagination">
			<ul class="pagination"><?php echo TEXT_RESULT_PAGE . ' ' . $testimonials_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page')), $paginateAsUL); ?></ul>
		</div>
	</div>
	<?php
		} // split page
	?>
	<div class="row product-listing tt-product-listing row-view listing-view tt-col-one">
	<?php
			//echo $testimonials_split->sql_query;
			$testimonials = $db->Execute($testimonials_split->sql_query);
			while (!$testimonials->EOF) {
				$date_published = $testimonials->fields['date_added'];
				$testimonial_info = '';
				if ( (!empty($testimonials->fields['testimonials_city'])) and (!empty($testimonials->fields['testimonials_country'])) ) {
				$testimonial_info .= NAME_SEPARATOR . $testimonials->fields['testimonials_city'] . CITY_STATE_SEPARATOR . $testimonials->fields['testimonials_country'];
				}
				if ( (!empty($testimonials->fields['testimonials_city'])) and (empty($testimonials->fields['testimonials_country'])) ) {
				$testimonial_info .= NAME_SEPARATOR . $testimonials->fields['testimonials_city'];
				}
				if ( (empty($testimonials->fields['testimonials_city'])) and (!empty($testimonials->fields['testimonials_country'])) ) {
				$testimonial_info .= NAME_SEPARATOR . $testimonials->fields['testimonials_country'];
				}
				if (!empty($testimonials->fields['testimonials_company'])) {
				$testimonial_info .= NAME_SEPARATOR . $testimonials->fields['testimonials_company'];
				}
	?>
	<div class="tt-col-item">
		<div class="tt-product product-parent row">
			<?php
				if (($testimonials->fields['testimonials_image']) != ('')) {
					$testimonials_image = zen_image(DIR_WS_IMAGES . $testimonials->fields['testimonials_image'], $testimonials->fields['testimonials_title'], TESTIMONIAL_IMAGE_WIDTH, TESTIMONIAL_IMAGE_HEIGHT);
				}
				else {
					$testimonials_image = zen_image(DIR_WS_IMAGES . 'no_picture.gif', $testimonials->fields['testimonials_title'], TESTIMONIAL_IMAGE_WIDTH, TESTIMONIAL_IMAGE_HEIGHT);
				}
			?>
			<div class="tt-image-box col-md-3 col-sm-4 col-lg-3 testimonialImage">
				<?php if (($testimonials->fields['testimonials_url']) == ('http://') or ($testimonials->fields['testimonials_url']) == ('')) {
					echo $testimonials_image;
				} else {
					echo '<a href="' . $testimonials->fields['testimonials_url'] . '" target="_blank">' . $testimonials_image . '</a>';
				}
				?>
			</div>
			<div class="tt-description pt-0 col-md-9 col-sm-8 col-lg-9 product-review-default">
				<h2 class="tt-title"><a href="<?php echo zen_href_link(FILENAME_TESTIMONIALS_MANAGER, 'testimonials_id=' . $testimonials->fields['testimonials_id'], 'SSL');?>"><?php echo $testimonials->fields['testimonials_title'];?></a></h2>
				<div>
					<p><?php echo nl2br($testimonials->fields['testimonials_html_text']); ?></p>
				</div>
				<a href="<?php echo zen_href_link(FILENAME_TESTIMONIALS_MANAGER, 'testimonials_id=' . $testimonials->fields['testimonials_id'], 'SSL');?>" class="btn btn-sm mt-3 mb-3"><?php echo TEXT_READ_MORE; ?></a>
				<div class="tt-meta">
					<div class="tt-autor">
						<?php echo TESTIMONIALS_BY; ?><b><?php echo $testimonials->fields['testimonials_name']; ?></b>
						<?php echo $testimonial_info; ?> 
						<?php if (DISPLAY_TESTIMONIALS_DATE_PUBLISHED == 'true') { echo 'on '.zen_date_long($date_published); } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
			$testimonials->MoveNext();
		}
	?>
	</div>
	<?php
		if (($testimonials_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
	?>
	<div class="tt-pagination tt-pagination-left pagi-bot">
	  <div id="allProductsListingBottomNumber" class="navSplitPagesResult back"><?php echo $testimonials_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_ALL); ?></div>
	  <div id="allProductsListingBottomLinks" class="navSplitPagesLinks forward"><?php echo TEXT_RESULT_PAGE . $testimonials_split->display_links($max_display_page_links, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page')), $paginateAsUL); ?></div>
	</div>
	<?php
		} // split page
	?>
	<div class="testimonial-links buttonsRow">
		<div class="buttonRow back">
			<?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?>
		</div>
		<div class="buttonRow forward">
      <a href="<?php echo zen_href_link(FILENAME_TESTIMONIALS_ADD, '', 'SSL'); ?>">
        <?php echo zen_image_button(BUTTON_IMAGE_TESTIMONIALS, BUTTON_TESTIMONIALS_ADD_ALT); ?>
      </a>
		</div>
	</div>
</div>
