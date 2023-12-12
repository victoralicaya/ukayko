<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=contact_us.
 * Displays contact us page form.
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: lat9 2022 Jun 23 Modified in v1.5.8-alpha $
 */
?>

<span class="breadcrumb-title"><?php echo $var_pageDetails->fields['pages_title']; ?></span>

<div class="centerColumn holder mt-0" id="contactUsDefault">
	<?php echo zen_draw_form('contact_us', zen_href_link(FILENAME_CONTACT_US, 'action=send', 'SSL')); ?>
    <?php
  		if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
	?>
		<div class="alert alert-success alert-dismissable"><?php echo TEXT_SUCCESS; ?></div>
	<?php
  		} 
	?>
    <?php if ($messageStack->size('contact') > 0) echo $messageStack->output('contact'); ?>
    <div class="contact-details alert alert-info">
		<div class="contact-sample-text">
		<?php if (DEFINE_CONTACT_US_STATUS >= '1' and DEFINE_CONTACT_US_STATUS <= '2') { ?>
			<?php
			/**
			 * require html_define for the contact_us page
			 */
				require($define_page); 
			?>
		<?php
			}
		?>
		</div>
   	</div>
	<div class="main_contact_section sec_ptb_100 clearfix">
		<div class="container">
			<div class="row justify-content-lg-between">
				<div class="col-lg-5">
					<div class="main_contact_content">
						<h3 class="title_text mb_15"><?php echo TEXT_GET_IN_TOUCH; ?></h3>
						<p class="mb_30"><?php echo TEXT_GET_IN_TOUCH_CONTENT; ?></p>
						<ul class="main_contact_info ul_li_block clearfix">
							<li>
								<span class="icon">
									<i class="fal fa-map-marked-alt"></i>
								</span>
								<p class="mb-0">
									<?php echo $store_address; ?>
								</p>
							</li>
							<li>
								<span class="icon">
									<i class="fal fa-phone-volume"></i>
								</span>
								<p class="mb-0"><?php echo $store_contact; ?></p>
							</li>
							<li>
								<span class="icon">
									<i class="fal fa-fax"></i>
								</span>
								<p class="mb-0"><?php echo $store_fax; ?></p>
							</li>
							<li>
								<span class="icon">
									<i class="fal fa-paper-plane"></i>
								</span>
								<p class="mb-0"><a href="mailto:<?php echo $store_email; ?>"><?php echo $store_email; ?></a></p>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="main_contact_form">
						<h3 class="title_text mb_30"><?php echo HEADING_FEEDBACK_TEXT; ?></h3>
						<form id="contactform" class="contact-form form-default" method="post" novalidate="novalidate" action="#">
							<div class="row">
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
									<?php if (CONTACT_US_LIST !== '') {	?>
									<div class="form-group">
										<div class="select-wrapper-sm">
											<?php echo zen_draw_pull_down_menu('send_to',  $send_to_array, $send_to_default, 'id="send-to" required size="' . count($send_to_array) . '"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?>
										</div>
									</div>
									<?php }	?>
									<div class="form_item">
										<?php echo zen_draw_input_field('contactname', $name, ' size="40" id="contactname" placeholder="' . ENTRY_REQUIRED_SYMBOL . ENTRY_NAME . '" required'); ?>
									</div>
								</div>
								<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
									<div class="form_item">
										<?php echo zen_draw_input_field('email', ($email_address), ' size="40" id="email-address" autocomplete="off" placeholder="' . ENTRY_REQUIRED_SYMBOL . ENTRY_EMAIL . '" required', 'email'); ?>
									</div>
								</div>
								<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
									<div class="form_item">
										<?php echo zen_draw_input_field('telephone', ($telephone), ' size="20" id="telephone" placeholder="' . ENTRY_TELEPHONE_NUMBER . '" autocomplete="off"', 'tel'); ?>
									</div>
								</div>
							</div>
							<?php echo zen_draw_input_field($antiSpamFieldName, '', ' size="40" id="CUAS" style="visibility:hidden; display:none;" autocomplete="off"'); ?>
							<?php if ($siteKey != NULL || $secret != NULL) { ?>
							<!-- bo Google reCAPTCHA  -->
							<script src='https://www.google.com/recaptcha/api.js'></script>
							<div class="recaptcha-details">
								<label><?php echo GOOGLE_RECAPTCHA . '<span class="alertrequired">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
								<div class="g-recaptcha" data-sitekey="<?php echo $siteKey;?>"></div>
							</div>
							<!-- eo Google reCAPTCHA  -->
							<?php } ?>
							<div class="form_item">
								<?php echo zen_draw_textarea_field('enquiry', '30', '7', $enquiry, 'id="enquiry" placeholder="' . ENTRY_REQUIRED_SYMBOL . ENTRY_ENQUIRY . '" required'); ?>
							</div>
							<div class="text-left">
								<?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT); ?>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
</div>