<footer class="footer_section fashion_minimal_footer clearfix mt_100" data-bg-color="#222222">
	<div class="backtotop" data-background="images/pages/shape_01.png">
		<a href="#" class="scroll">
			<i class="far fa-arrow-up"></i>
		</a>
	</div>
	<div class="footer_widget_area sec_ptb_100 clearfix">
		<div class="container maxw_1200">
			<div class="row justify-content-lg-between">

				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="footer_widget footer_about">
						<div class="brand_logo mb_30">
							<a class="footer-logo" href="<?php echo zen_href_link(FILENAME_DEFAULT); ?>"><?php echo wt_image( $uploads_path.$footer_logo, '', '176', '', ' class="lazyload" ' ); ?></a>
						</div>
						<?php if( !empty( $store_description ) ) { ?>
						<p class="mb-0"><?php echo $store_description; ?></p>
						<?php } ?>
					</div>
				</div>

				<div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
					<div class="row justify-content-lg-between">
						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="footer_widget footer_useful_links clearfix">
								<h3 class="footer_widget_title text-white">Contact</h3>
								<ul class="ul_li_block">
									<li><i class="fal fa-phone-square"></i> <?php echo $store_contact; ?></li>
									<li><i class="fal fa-envelope"></i> <a href="mailto:<?php echo $store_email; ?>"><?php echo $store_email; ?></a></li>
									<li><i class="fal fa-map"></i> <?php echo $store_address; ?></li>
								</ul>
							</div>
						</div>

						<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
							<div class="footer_widget footer_useful_links clearfix">
								<h3 class="footer_widget_title text-white">Links</h3>
								<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_INFORMATION_LINKS, 'false'); ?>
							</div>
						</div>

						<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
							<div class="footer_widget footer_useful_links clearfix">
								<h3 class="footer_widget_title text-white">Activities</h3>
								<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_CATEGORIES_LINKS, 'false'); ?>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<div class="footer_widget fm_footer_newsletter">
						<h3 class="footer_widget_title text-white">Activities</h3>
						<div class="form_item mb-0">
							<?php echo $newsletter_details; ?>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>

	<div class="container">
		<div class="footer_bottom text-center">
			<ul class="circle_social_links ul_li_center clearfix">
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
			<p class="copyright_text mb-0">
				<?php echo $store_copyright; ?>
			</p>
		</div>
	</div>
</footer>