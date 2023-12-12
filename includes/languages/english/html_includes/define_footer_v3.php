<footer class="footer_section ecommerce_footer bg_black text-white mt_50 clearfix">
	<div class="footer_widget_area sec_ptb_100 clearfix">
		<div class="container">
			<div class="row justify-content-lg-between">

				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<div class="footer_widget footer_about">
						<div class="brand_logo mb_15">
							<a class="footer-logo" href="<?php echo zen_href_link(FILENAME_DEFAULT); ?>"><?php echo wt_image( $uploads_path.$footer_logo, '', '176', '', ' class="lazyload" ' ); ?></a>
						</div>
						<?php if( !empty( $store_description ) ) { ?>
						<p class="mb_50"><?php echo $store_description; ?></p>
						<?php } ?>
						<div class="payment_methods">
							<?php echo ($payment_image) ?  wt_image( $uploads_path.$payment_image, '', '', '', ' class="lazyload" ' ) : ''; ?>
						</div>
					</div>
				</div>

				<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
					<div class="footer_widget footer_useful_links clearfix">
						<h3 class="footer_widget_title text-white">Find it Fast</h3>
						<ul class="ul_li_block">
							<li>
								<?php echo $store_address; ?>
							</li>
							<li>Phone: <?php echo $store_contact; ?></li>
							<li>E-Mail: <a href="mailto:<?php echo $store_email; ?>"><?php echo $store_email; ?></a></li>
						</ul>
					</div>
				</div>

				<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
					<div class="footer_widget footer_useful_links clearfix">
						<h3 class="footer_widget_title text-white">Information</h3>
						<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_INFORMATION_LINKS, 'false'); ?>
					</div>
				</div>

				<div class="col-lg-2 col-md-4 col-sm-6 col-xs-12">
					<div class="footer_widget footer_useful_links clearfix">
						<h3 class="footer_widget_title text-white">Discover</h3>
						<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_CATEGORIES_LINKS, 'false'); ?>
					</div>
				</div>

				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
					<div class="footer_widget footer_useful_links clearfix">
						<h3 class="footer_widget_title text-white">Customer Care</h3>
						<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_ACCOUNT_LINKS, 'false'); ?>
					</div>
				</div>

			</div>
		</div>
	</div>

	<div class="footer_bottom text-center d-flex align-items-center clearfix">
		<div class="container">
			<p class="copyright_text mb-0"><?php echo $store_copyright; ?></p>
		</div>
	</div>
</footer>
<div class="backtotop" data-bg-color="#000000">
	<a href="#" class="scroll">
		<i class="far fa-arrow-up"></i>
	</a>
</div>