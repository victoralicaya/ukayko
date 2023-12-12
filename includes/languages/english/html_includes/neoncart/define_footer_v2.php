<footer class="footer_section carparts_footer text-white clearfix mt-5">
	<div class="footer_widget_area sec_ptb_100 clearfix" data-bg-color="#131313">
		<div class="container">
			<div class="row justify-content-lg-between">

				<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
					<div class="footer_widget footer_about">
						<div class="brand_logo mb_30">
							<a class="footer-logo" href="<?php echo zen_href_link(FILENAME_DEFAULT); ?>"><?php echo wt_image( $uploads_path.$footer_logo, '', '176', '', ' class="lazyload" ' ); ?></a>
						</div>
						<?php if( !empty( $store_description ) ) { ?>
						<p><?php echo $store_description; ?></p>
						<?php } ?>
						<div class="footer_carparts_hotline">
							<h4>Got questions? Call us 24/7!</h4>
							<span>(800) 8001-8588, (0600) 874 548</span>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="footer_widget footer_useful_links clearfix">
						<h3 class="footer_widget_title text-white">Find it Fast</h3>
						<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_CATEGORIES_LINKS, 'false'); ?>
					</div>
				</div>

				<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
					<div class="footer_widget footer_useful_links clearfix">
						<h3 class="footer_widget_title text-white">Customer Care</h3>
						<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_INFORMATION_LINKS, 'false'); ?>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="footer_widget footer_instagram">
						<h3 class="footer_widget_title text-white">Customer Care</h3>
						<ul class="zoom-gallery ul_li clearfix">
							<li>
								<a class="popup_image" href="images/wt_images/instagram/img_01.jpg">
									<img src="images/wt_images/instagram/img_01.jpg" alt="image_not_found">
								</a>
							</li>
							<li>
								<a class="popup_image" href="images/wt_images/instagram/img_02.jpg">
									<img src="images/wt_images/instagram/img_02.jpg" alt="image_not_found">
								</a>
							</li>
							<li>
								<a class="popup_image" href="images/wt_images/instagram/img_03.jpg">
									<img src="images/wt_images/instagram/img_03.jpg" alt="image_not_found">
								</a>
							</li>
							<li>
								<a class="popup_image" href="images/wt_images/instagram/img_04.jpg">
									<img src="images/wt_images/instagram/img_04.jpg" alt="image_not_found">
								</a>
							</li>
							<li>
								<a class="popup_image" href="images/wt_images/instagram/img_05.jpg">
									<img src="images/wt_images/instagram/img_05.jpg" alt="image_not_found">
								</a>
							</li>
							<li>
								<a class="popup_image" href="images/wt_images/instagram/img_06.jpg">
									<img src="images/wt_images/instagram/img_06.jpg" alt="image_not_found">
								</a>
							</li>
						</ul>
						<strong class="brand_name">@neoncart</strong>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="footer_bottom clearfix" data-bg-color="#000000">
		<div class="container">
			<div class="row align-items-center justify-content-lg-between">
				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
						<p class="copyright_text mb-0 text-white"><?php echo $store_copyright; ?></p>
				</div>

				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
					<div class="payment_methods float-lg-right">
						<?php echo ($payment_image) ?  wt_image( $uploads_path.$payment_image, '', '', '', ' class="lazyload" ' ) : ''; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<div class="backtotop bg_carparts_red">
	<a href="#" class="scroll">
		<i class="far fa-arrow-up"></i>
	</a>
</div>