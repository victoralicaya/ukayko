<?php
/**
 * Common Template - tpl_header.php
 *
 * this file can be copied to /templates/your_template_dir/pagename
 * example: to override the privacy page
 * make a directory /templates/my_template/privacy
 * copy /templates/templates_defaults/common/tpl_footer.php to /templates/my_template/privacy/tpl_header.php
 * to override the global settings and turn off the footer un-comment the following line:
 *
 * $flag_disable_header = true;
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: John 2022 Jul 07 Modified in v1.5.8-alpha $
 */
?>
<?php /* add any end-of-page code via an observer class */
  $zco_notifier->notify('NOTIFY_TW_HEADER_START', $current_page);
?>
<?php
  // Display all header alerts via messageStack:
if ($messageStack->size('header') > 0) {
	$messagesModalContent = '';
	foreach( $messageStack->messages as $msg_key => $message ) {
		if ( !empty( $message['text'] ) && ( strpos( $message['text'], SUCCESS_ADDED_TO_CART_PRODUCT) !== false || strpos( $message['text'], SUCCESS_ADDED_TO_CART_PRODUCTS) !== false ) ) {
			$messagesModalContent .= $message['text'];
		}
	}
	if ( !empty( $messagesModalContent ) ) { ?>
		<div id="wtWokAddtoCartModal" class="modal fade wtWokModal" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog modal-md">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="text-uppercase mb-0"><?php echo HEADING_YOUR_CART; ?></h4>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><i class="fal fa-times"></i></button>
					</div>
					<div class="modal-body">
						<div class="wok-modal-content desctope">
							<div class="alert-messages mb-4">
								<?php echo $messageStack->output('header'); ?>
							</div>
						</div>
						<div class="wok-actions">
							<div class="actions mt-2 d-flex gap-2 justify-content-center"><?php echo WT_MODAL_CART_SUCCESS_ACTIONS; ?></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#wtWokAddtoCartModal').modal('show');
			});
		</script>
		<?php
	} else {
		echo $messageStack->output('header');
	}
}
if (!empty($_GET['error_message'])) {
	echo zen_output_string_protected(urldecode($_GET['error_message']));
}
if (!empty($_GET['info_message'])) {
	echo zen_output_string_protected($_GET['info_message']);
}
// check whether to only display errors/alerts, or to also display the rest of the header
if (isset($flag_disable_header) && $flag_disable_header === true) {
	// do early-return from this template since $flag_disable_header is true
	return;
  }
?>
<div id="headerWrapper">
	<?php require( $template->get_template_dir( $header_template.'.php', DIR_WS_TEMPLATE, $current_page_base, 'common'). '/' . $header_template.'.php' ); ?>
</div>
<?php /* add any end-of-page code via an observer class */
  $zco_notifier->notify('NOTIFY_TW_HEADER_END', $current_page);
?>