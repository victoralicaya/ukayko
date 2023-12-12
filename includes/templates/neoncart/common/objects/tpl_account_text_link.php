<div class="tt-account-textlink">
	<?php if ( zen_is_logged_in() ) { ?>
	<a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo HEADER_TOP_MYACCOUNT_TITLE;?></a> or <a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo HEADER_TOP_SIGN_OUT_TEXT; ?></a> 
	<?php } else { ?>
	<a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>" target="_blank"><?php echo HEADER_TOP_SIGN_IN_TEXT;?></a> or <a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>" target="_blank"><?php echo HEADER_TOP_REGISTER_TEXT;?></a>
	<?php } ?>
</div>