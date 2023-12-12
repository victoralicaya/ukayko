<footer class="footer_section supermarket_footer clearfix">
	<div class="footer_widget_area sec_ptb_100 bg_white clearfix" style="display:none;">
		<div class="container">
			<div class="row justify-content-lg-between" style="display:none;">

				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<div class="footer_widget footer_useful_links clearfix">
						<h3 class="footer_widget_title">Buyer Central</h3>
						<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_CATEGORIES_LINKS, 'false'); ?>
					</div>
				</div>

				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<div class="footer_widget bestrated_products">
						<h3 class="footer_widget_title">Best Rated Products</h3>
						<?php echo products_shortcode( array('type' => 'top_rated_products', 'style'=> 'micro_small_grid', 'max_products' => 2, 'show_xxl_columns'=> 1, 'show_xl_columns'=> 1, 'show_lg_columns'=> 1, 'show_md_columns' => 1, 'show_sm_columns' => 1, 'show_xs_columns' => 1, 'title' => 'none', 'show_product_image' => false, 'show_product_buttons' => false), '' ); ?>
					</div>
				</div>

				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<div class="footer_widget footer_useful_links clearfix">
						<h3 class="footer_widget_title">Information</h3>
						<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_INFORMATION_LINKS, 'false'); ?>
					</div>
				</div>

				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<div class="footer_widget supermarket_footer_contact">
						<h3 class="footer_widget_title">Contact info</h3>
						<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_CONTACT_US, 'false'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer_middle sec_ptb_50 text-white clearfix" data-bg-color="#23292d" style="display:none;">
		<div class="container">
			<div class="row align-items-center justify-content-center">
				<div class="col-lg-5 col-md-7 col-sm-9 col-xs-12" style="display:none;">
					<div class="form_item mb-0">
						<?php echo $newsletter_details; ?>
					</div>
				</div>

				<div class="col-lg-3 col-md-7 col-sm-9 col-xs-12" style="display:none;">
					<div class="footer_electronic_hotline mb_30">
						<i class="fal fa-headset"></i>
						<h4 class="text-white">GOT QUESTION? CALL US 24/7!</h4>
						<span>801 017 197</span>
					</div>
				</div>

				<div class="col-lg-4 col-md-7 col-sm-9 col-xs-12">
					<ul class="circle_social_links ul_li_right clearfix">
					<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_SOCIAL_LINKS, 'false'); ?>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="footer_bottom clearfix" data-bg-color="#e8e8e8;">
		<div class="container">
			<div class="row justify-content-lg-between">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<p class="copyright_text mb-0"><?php echo $store_copyright; ?></p>
				</div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<ul class="circle_social_links ul_li_right clearfix">
					<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_SOCIAL_LINKS, 'false'); ?>
					</ul>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" style="display:none;">
					<div class="payment_methods float-lg-right float-md-right">
						<?php echo ($payment_image) ?  wt_image( $uploads_path.$payment_image, '', '', '', ' class="lazyload" ' ) : ''; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
