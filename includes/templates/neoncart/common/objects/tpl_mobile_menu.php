<div class="sidebar_mobile_menu">
	<button type="button" class="close_btn fa-lg round-close" aria-label="Close"><i class="fal fa-times"></i></button>
	<div class="msb_widget brand_logo text-center">
		<?php require( $template->get_template_dir('tpl_logo.php', DIR_WS_TEMPLATE, $current_page_base,'common/objects'). '/tpl_logo.php' ); ?>
	</div>
	<div class="msb_widget mobile_menu_list clearfix">
		<h3 class="title_text mb_15 text-uppercase"><i class="far fa-bars me-2"></i> Menu List</h3>
		<ul id="cat-toggle" class="category-nav ul_li_block cat-toggle">
			<?php if ( file_exists( $template->get_template_dir( 'tpl_wt_drop_mobile_menu_static_content.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common' ). '/tpl_wt_drop_mobile_menu_static_content.php' ) ) {
					require( $template->get_template_dir( 'tpl_wt_drop_mobile_menu_static_content.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common' ). '/tpl_wt_drop_mobile_menu_static_content.php' );
			} else { ?>
			<li class="home"><a href="<?php echo zen_href_link(FILENAME_DEFAULT, '', 'SSL'); ?>"><?php echo HEADER_TITLE_CATALOG; ?></a></li>
			<?php } ?>
			<?php echo wt_neoncart_menu('mmenu'); ?>
		</ul>
	</div>
	<div class="user_info msb_widget clearfix">
		<ul class="settings_options ul_li_block clearfix">
			<li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><i class="fal fa-user-circle"></i><span><?php echo HEADER_TOP_MYACCOUNT_TITLE; ?></span></a></li>
			<?php if ( zen_is_logged_in() ) { ?>
			<li><a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><i class="fal fa-sign-out-alt"></i><span><?php echo HEADER_TOP_SIGN_OUT_TEXT; ?></span></a></li>
			<?php } else { ?>
			<li><a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>" ><i class="fal fa-sign-in-alt"></i><span><?php echo HEADER_TOP_SIGN_IN_TEXT;?></span></a></li>
			<?php } ?>
			<?php if ( zen_is_logged_in() && $_SESSION['cart']->count_contents() != 0) { ?>
			<li><a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><i class="far fa-cart"></i><span><?php echo HEADER_TOP_CHECKOUT_TITLE; ?></span></a></li>
			<?php }?>
			<?php if ( COMPARE_VALUE_COUNT > 0 ) { ?>
			<li><a href="<?php echo zen_href_link(FILENAME_COMPARE, '', 'SSL'); ?>"><i class="far fa-random"></i><span><?php echo HEADER_TITLE_COMPARE;?></span></a></li>
			<?php } ?>
			<?php if ( UN_DB_MODULE_WISHLISTS_ENABLED == 'true' ) { ?>
			<li><a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST, '', 'SSL'); ?>"><i class="far fa-heart"></i><span><?php echo HEADER_TITLE_WISHLIST;?></span></a></li>
			<?php } ?>
		</ul>
	</div>
	<div class="msb_widget mobile_menu_list clearfix">
		<ul class="settings_options ul_li_block clearfix currency-list">
		<?php include(DIR_WS_MODULES . zen_get_module_directory('header_currencies.php')); ?>
		</ul>
	</div>
</div>