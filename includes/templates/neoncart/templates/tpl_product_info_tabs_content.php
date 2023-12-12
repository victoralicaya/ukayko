<div class="tt-tab-wrapper">
	<ul class="nav ul_li_center text-uppercase" role="tablist">
		<li class="nav-item"><a class="nav-link show active" data-bs-toggle="pill" data-bs-target="#description_tab" role="tab"><?php echo TEXT_PRODUCT_DESCRIPTION; ?></a></li>
		<?php if ( $flag_show_product_info_reviews == 1 ) { ?>
		<li class="nav-item"><a class="nav-link" data-bs-toggle="pill" data-bs-target="#reviews_tab" role="tab"><?php echo (TEXT_PRODUCT_REVIEWS. " (".$reviews->fields['count'].")"); ?></a></li>
		<?php } ?>
	</ul>
	<div class="tab-content">
		<?php if ($products_description != '') { ?>
		<div id="description_tab" class="tab-pane active">
			<div id="productDescription" class="productGeneral biggerText"><?php echo stripslashes($products_description); ?></div>
			<!--bof Product URL -->
			<?php
			  if (zen_not_null($products_url)) {
				if ($flag_show_product_info_url == 1) {
			?>
				<p id="productInfoLink" class="productGeneral centeredContent"><?php echo sprintf(TEXT_MORE_INFORMATION, zen_href_link(FILENAME_REDIRECT, 'action=product&products_id=' . zen_output_string_protected($_GET['products_id']), 'NONSSL', true, false)); ?></p>
			<?php
				} // $flag_show_product_info_url
			  }
			?>
		</div>
		<?php } ?>
		<?php if ( $flag_show_product_info_reviews ) { ?>
		<div id="reviews_tab" class="tab-pane fade">
			<div class="reviews-list-wrapper">
				<?php // if more than 0 reviews, then show reviews button; otherwise, show the "write review" button ?>
				<?php if ($reviews->fields['count'] > 0 ) { ?>
					<?php require($template->get_template_dir('tpl_dgReview.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_dgReview.php');?>
				<?php } else { ?>
					<?php echo TEXT_NO_REVIEWS; ?></br>
					<div id="productReviewLink" class="buttonRow back mt-2"><?php echo '<a class="btn btn-sm" href="' . zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, zen_get_all_get_params(array())) . '">' . BUTTON_WRITE_REVIEW_ALT . '</a>'; ?></div>
				<?php
				  } ?>
			</div>
		</div>
		<?php } ?>
	</div>
</div>