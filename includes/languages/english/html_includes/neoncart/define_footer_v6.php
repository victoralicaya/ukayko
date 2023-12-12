<footer class="footer_section furniture_footer clearfix mt_50">
	<div class="footer_widget_area sec_ptb_100 clearfix">
		<div class="container-fluid prl_90">
			<div class="row justify-content-lg-between">

				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="footer_widget footer_about">
						<div class="brand_logo mb_15">
							<a href="index.html">
								<a class="footer-logo" href="<?php echo zen_href_link(FILENAME_DEFAULT); ?>"><?php echo wt_image( $uploads_path.$footer_logo, '', '176', '', ' class="lazyload" ' ); ?></a>
							</a>
						</div>
						<?php if( !empty( $store_description ) ) { ?>
						<p class="mb_50"><?php echo $store_description; ?></p>
						<?php } ?>
						<div class="footer_newsletter">
							<div class="form_item mb-0">
							<?php echo $newsletter_details; ?>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
					<div class="footer_widget footer_useful_links clearfix">
						<h3 class="footer_widget_title text-white">Usefull Links</h3>
						<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_INFORMATION_LINKS, 'false'); ?>
					</div>
				</div>

				<div class="col-lg-2 col-md-6 col-sm-6 col-xs-12">
					<div class="footer_widget footer_instagram">
						<h3 class="footer_widget_title text-white">Instagram Shop</h3>
						<ul class="zoom-gallery ul_li clearfix">
							<li>
								<a class="popup_image" href="images/wt_images/instagram/img_07.jpg">
									<img class="rounded" src="images/wt_images/instagram/img_07.jpg" alt="image_not_found">
								</a>
							</li>
							<li>
								<a class="popup_image" href="images/wt_images/instagram/img_08.jpg">
									<img class="rounded" src="images/wt_images/instagram/img_08.jpg" alt="image_not_found">
								</a>
							</li>
							<li>
								<a class="popup_image" href="images/wt_images/instagram/img_09.jpg">
									<img class="rounded" src="images/wt_images/instagram/img_09.jpg" alt="image_not_found">
								</a>
							</li>
							<li>
								<a class="popup_image" href="images/wt_images/instagram/img_10.jpg">
									<img class="rounded" src="images/wt_images/instagram/img_10.jpg" alt="image_not_found">
								</a>
							</li>
							<li>
								<a class="popup_image" href="images/wt_images/instagram/img_11.jpg">
									<img class="rounded" src="images/wt_images/instagram/img_11.jpg" alt="image_not_found">
								</a>
							</li>
							<li>
								<a class="popup_image" href="images/wt_images/instagram/img_12.jpg">
									<img class="rounded" src="images/wt_images/instagram/img_12.jpg" alt="image_not_found">
								</a>
							</li>
						</ul>
						<strong class="brand_name text_instagram"><i class="fab fa-instagram"></i> Follow</strong>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="footer_widget footer_contact_info mb_30 clearfix">
						<h3 class="footer_widget_title text-white">Contact Us</h3>
						<ul class="ul_li_block">
							<li>
								<span>Address:</span>
								<?php echo $store_address; ?>
							</li>
							<li><span>Phone: <span class="text-white"><?php echo $store_contact; ?></span></span></li>
							<li><span>Email:</span> <a class="text-white" href="mailto:<?php echo $store_email; ?>"><?php echo $store_email; ?></a></li>
						</ul>
					</div>

					<ul class="primary_social_links ul_li clearfix">
						<?php if($facebook_link!=''){ ?>
						<li><a target="_blank" href="https://www.facebook.com/<?php echo $facebook_link; ?>"><i class="fab fa-facebook-f"></i></a></li>
						<?php } ?>
						<?php if($twitter_link!=''){ ?>
						<li><a target="_blank" href="https://www.twitter.com/<?php echo $twitter_link; ?>"><i class="fab fa-twitter"></i></a></li>
						<?php } ?>
						<?php if($instagram_link!=''){ ?>
						<li><a target="_blank" href="<?php echo $instagram_link; ?>"><i class="fab fa-instagram"></i></a></li>
						<?php } ?>
						<?php if($pinterest_link!=''){ ?>
						<li><a target="_blank" href="<?php echo $pinterest_link; ?>"><i class="fab fa-pinterest"></i></a></li>
						<?php } ?>
					</ul>
				</div>

			</div>
		</div>
	</div>
	<div class="footer_bottom d-flex align-items-center text-center clearfix">
		<div class="container-fluid prl_90">
			<p class="copyright_text mb-0">
				<?php echo $store_copyright; ?>
			</p>
		</div>
	</div>
</footer>