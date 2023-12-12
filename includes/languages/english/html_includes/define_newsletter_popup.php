<div id="ModalNewsletter" class="modal--newsletter js-newslettermodal modal fade" data-pause="5000" data-expires="1" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content ">
			<div class="modal-header"><button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button></div>
			<div class="row">
				<div class="col-sm d-none d-md-flex align-items-center justify-content-center">
					<div class="newslettermodal-img"><?php echo wt_image( DIR_WS_IMAGES.$template_dir.'/uploads/news-subscribe.jpg', 'Subscribe Us', '387', '' ); ?></div>
				</div>
				<div class="col-sm">
					<div class="justify-content-center h-100 d-flex flex-column gap-2 text-center align-items-center primary_social_links py-4">
						<div class="newslettermodal-content-logo"><img class="img-responsive" alt="logo" src="<?php echo $uploads_path.$file_logo;?>" /></div>
						<h3 class="h2-style newslettermodal-content-title">Sign up our newsletter</h3>
						<div class="newslettermodal-content-text">Enter Your email address to sign up to receive our latest news and offers</div>
						<div class="supermarket_footer sub-newsltr">
						<div class="form_item">
							<?php echo str_replace( array( 'mc_embed_signup', 'mce-EMAIL', 'mc-embedded-subscribe-form' ), array('mc_embed_signup-sub', 'mce-EMAIL-sub', 'mc-embedded-subscribe-form-sub'), $newsletter_details ); ?>
						</div>
						</div>
						<div class="checkbox-group mt-2"><input type="checkbox" name="newsletter" id="newsLetterCheckBox"> <label for="newsLetterCheckBox">Don't show this popup</label></div>
						<ul class="contact_info ul_li clearfix mt-3">
							<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_SOCIAL_LINKS, 'false'); ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>