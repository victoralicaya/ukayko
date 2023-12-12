<div class="tt-account tt-dropdown-obj">
	<button class="tt-dropdown-toggle" data-tooltip="<?php echo HEADER_TOP_MYACCOUNT_TITLE; ?>" data-tposition="bottom"><i class="icon-f-94"></i></button>
	<div class="tt-dropdown-menu">
		<div class="tt-mobile-add">
			<button class="tt-close"><?php echo TEXT_CLOSE; ?></button>
		</div>
		<div class="tt-dropdown-inner">
			<ul>
				<li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><i class="icon-f-94"></i><span><?php echo HEADER_TOP_MYACCOUNT_TITLE; ?></span></a></li>
				<?php if ( zen_is_logged_in() ) { ?>
				<li><a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><i class="icon-f-77"></i><span><?php echo HEADER_TOP_SIGN_OUT_TEXT; ?></span></a></li>
				<?php } else { ?>
				<li><a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>" ><i class="icon-f-76"></i><span><?php echo HEADER_TOP_SIGN_IN_TEXT;?></span></a></li>
				<?php } ?>
				<?php if ( zen_is_logged_in() && $_SESSION['cart']->count_contents() != 0) { ?>
				<li><a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><i class="icon-f-68"></i><span><?php echo HEADER_TOP_CHECKOUT_TITLE; ?></span></a></li>
				<?php }?>
				<?php if ( COMPARE_VALUE_COUNT > 0 ) { ?>
				<li><a href="<?php echo zen_href_link(FILENAME_COMPARE, '', 'SSL'); ?>"><i class="icon-n-08"></i><span><?php echo HEADER_TITLE_COMPARE;?></span></a></li>
				<?php } ?>
				<?php if ( UN_DB_MODULE_WISHLISTS_ENABLED == 'true' ) { ?>
				<li><a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST, '', 'SSL'); ?>"><i class="icon-n-072"></i><span><?php echo HEADER_TITLE_WISHLIST;?></span></a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
</div>