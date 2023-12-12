<ul class="ul_li_block clearfix">
	<li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'); ?>"><?php echo FOOTER_TITLE_ORDER_HISTORY; ?></a></li>
	<?php if ( COMPARE_VALUE_COUNT > 0 ) { ?>
	<li><a href="<?php echo zen_href_link(FILENAME_COMPARE, '', 'SSL'); ?>"><?php echo HEADER_TITLE_COMPARE;?></a></li>
	<?php } ?>
	<?php if ( UN_DB_MODULE_WISHLISTS_ENABLED == 'true' ) { ?>
	<li><a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST, '', 'SSL'); ?>"><?php echo HEADER_TITLE_WISHLIST;?></a></li>
	<?php } ?>
	<?php if ( zen_is_logged_in() ) { ?>
	<li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo HEADER_TOP_MYACCOUNT_TITLE; ?></a></li>
	<?php } else { ?>
	<li><a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>" ><?php echo HEADER_TOP_SIGN_IN_TEXT;?></a></li>
	<?php } ?>
	<li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL'); ?>"><?php echo FOOTER_TITLE_CHANGE_PASSWORD; ?></a></li>
</ul>
