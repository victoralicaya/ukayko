<?php
#WT_NEONCART_TEMPLATE_BASE#

global $wt_gl_config;

// Display Wt Modal
?>
<?php require( $template->get_template_dir('tpl_cart_obj.php', DIR_WS_TEMPLATE, $current_page_base,'common/objects'). '/tpl_cart_obj.php' ); ?>
<?php require( $template->get_template_dir('tpl_mobile_menu.php', DIR_WS_TEMPLATE, $current_page_base,'common/objects'). '/tpl_mobile_menu.php' ); ?>
<?php
/*------------------------- Newsletter Popup ----------------------- */
if ( $display_newsletter_popup && $this_is_home_page ) {
	include zen_get_file_directory( DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_NEWSLETTER_POPUP, 'false' );
}