<footer class="footer_section electronic_footer clearfix mt_50">
	<div class="footer_widget_area clearfix">
		<div class="container maxw_1600">
			<div class="row justify-content-lg-between">
				<div class="col-lg-3 col-md-4">
					<div class="footer_widget footer_about">
						<div class="brand_logo mb_30">
							<a class="footer-logo" href="<?php echo zen_href_link(FILENAME_DEFAULT); ?>"><?php echo wt_image( $uploads_path.$footer_logo, '', '176', '', ' class="lazyload" ' ); ?></a>
						</div>
						<?php if( !empty( $store_description ) ) { ?>
						<p class="mb_30"><?php echo $store_description; ?></p>
						<?php } ?>
						<div class="footer_electronic_hotline mb_30">
							<i class="fal fa-headset"></i>
							<h4>GOT QUESTION? CALL US 24/7!</h4>
							<span>801 017 197</span>
						</div>

						<ul class="circle_social_links ul_li clearfix">
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

				<div class="col-lg-3 col-md-4">
					<div class="footer_widget footer_useful_links clearfix">
						<h3 class="footer_widget_title text-white text-uppercase">FIND IT FAST</h3>
						<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_CATEGORIES_LINKS, 'false'); ?>
					</div>
				</div>

				<div class="col-lg-2 col-md-4">
					<div class="footer_widget footer_useful_links clearfix">
						<h3 class="footer_widget_title text-white text-uppercase">CUSTOMER CARE</h3>
						<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_ACCOUNT_LINKS, 'false'); ?>
					</div>
				</div>

				<div class="col-lg-4 col-md-12">
					<div class="footer_widget footer_recent_post">
						<h3 class="footer_widget_title text-white text-uppercase mb-0">Weekly Selected</h3>
						<?php echo products_shortcode( array('type' => 'best_sellers', 'style'=> 'micro_small_grid', 'max_products' => 2, 'show_xxl_columns'=> 1, 'show_xl_columns'=> 1, 'show_lg_columns'=> 2, 'show_md_columns' => 2, 'show_sm_columns' => 1, 'show_xs_columns' => 1, 'title' => 'none', 'show_product_labels' => false, 'show_product_buttons' => false, 'show_product_reviews' => false, 'product_class' => 'electronic_product_small text-white'), '' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer_bottom text-center bg_black clearfix">
		<div class="container maxw_1600">
			<p class="copyright_text mb-0"><?php echo $store_copyright; ?></p>
		</div>
	</div>
</footer>