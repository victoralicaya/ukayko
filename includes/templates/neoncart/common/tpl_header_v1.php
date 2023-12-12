<header class="header_section supermarket_header bg-white clearfix">
	<?php if( $display_promo_topbar && !empty( $promo_topbar_content ) ) { ?>
	<div class="header_top text-white clearfix">
		<div class="container">
			<div class="row align-items-center justify-content-lg-between">
				<div class="col-lg-5">
					<p class="welcome_text mb-0"><?php echo $promo_topbar_content; ?></p>
				</div>
				<div class="col-lg-7">
					<ul class="info_list ul_li_right clearfix">
						<?php if(COMPARE_VALUE_COUNT > 0){ ?>
						<li><a href="<?php echo zen_href_link(FILENAME_COMPARE, '', 'SSL'); ?>" title="<?php echo HEADER_TITLE_COMPARE;?>"><i class="far fa-random"></i><span><?php echo HEADER_TITLE_COMPARE;?></span></a></li>
						<?php } ?>
						<?php if (UN_MODULE_WISHLISTS_ENABLED) { ?>
						<li><a href="<?php echo zen_href_link(UN_FILENAME_WISHLIST, '', 'SSL'); ?>" title="<?php echo HEADER_TITLE_WISHLIST;?>"><i class="far fa-heart"></i><span><?php echo HEADER_TITLE_WISHLIST;?></span></a></li>
						<?php } ?>
						<?php if (HEADER_CURRENCIES_DISPLAY == 'True') { ?>
							<?php require( $template->get_template_dir('tpl_single_currency_box.php', DIR_WS_TEMPLATE, $current_page_base,'common/objects'). '/tpl_single_currency_box.php' ); ?>
						<?php } ?>
						<?php if (HEADER_LANGUAGES_DISPLAY == 'True') { ?>
							<?php require( $template->get_template_dir('tpl_single_languages_box.php', DIR_WS_TEMPLATE, $current_page_base,'common/objects'). '/tpl_single_languages_box.php' ); ?>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="header_middle clearfix">
		<div class="container">
			<div class="row align-items-center justify-content-lg-between">
				<div class="col-lg-3">
					<div class="brand_logo">
						<?php require( $template->get_template_dir('tpl_logo.php', DIR_WS_TEMPLATE, $current_page_base,'common/objects'). '/tpl_logo.php' ); ?>
						<ul class="mh_action_btns ul_li clearfix">
							<li>
								<a class="search_btn button" data-bs-toggle="collapse" data-bs-target="#search_body_collapse" role="button" aria-expanded="false" aria-controls="search_body_collapse" aria-label="Search"><i class="fal fa-search"></i></a>
							</li>
							<li>
								<button type="button" class="cart_btn">
									<i class="fal fa-shopping-cart"></i>
									<span class="btn_badge"><?php echo $_SESSION['cart']->count_contents(); ?></span>
								</button>
							</li>
							<li><button type="button" class="mobile_menu_btn"><i class="far fa-bars"></i></button></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<?php require( $template->get_template_dir('tpl_logo.php', DIR_WS_TEMPLATE, $current_page_base,'common/objects'). '/tpl_search_obj.php' ); ?>
				</div>
				<div class="col-lg-3">
					<div class="supermarket_header_btns clearfix">
						<ul class="action_btns_group ul_li_right clearfix">
							<li>
								<a href="<?php echo zen_href_link(FILENAME_CONTACT_US, '', 'SSL'); ?>" title="<?php echo HEADER_TITLE_CONTACT_US; ?>">
									<?php echo HEADER_TEXT_NEED_HELP; ?>
								</a>
							</li>
							<li>
								<?php echo HEADER_TEXT_YOUR; ?>
								<?php if ( zen_is_logged_in() ) { ?>
								<a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><strong><?php echo HEADER_TOP_MYACCOUNT_TITLE;?></strong></a> or <a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><strong><?php echo HEADER_TOP_SIGN_OUT_TEXT; ?></strong></a>
								<?php } else { ?>
								<a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>" target="_blank"><strong><?php echo HEADER_TOP_SIGN_IN_TEXT;?></strong></a> or <a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>" target="_blank"><strong><?php echo HEADER_TOP_REGISTER_TEXT;?></strong></a>
								<?php } ?>
							</li>
							<li>
								<button type="button" class="cart_btn" aria-label="Cart">
									<i class="fal fa-shopping-bag"></i>
									<span class="btn_badge"><?php echo $_SESSION['cart']->count_contents(); ?></span>
								</button>
							</li>
						</ul>
						<?php //echo TEXT_GET_YOUR_COUPONS;  ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="header_bottom clearfix">
		<div class="container">
			<?php require( $template->get_template_dir('tpl_desktop_menu.php', DIR_WS_TEMPLATE, $current_page_base,'common/objects'). '/tpl_desktop_menu.php' ); ?>
		</div>
	</div>
	<div id="search_body_collapse" class="search_body_collapse collapse">
		<div class="search_body">
			<div class="container-fluid prl_90">
				<?php echo zen_draw_form('quick_find_header', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'SSL', false), 'get',  ' class="search"'); ?>
					<?php echo zen_draw_hidden_field('main_page',FILENAME_ADVANCED_SEARCH_RESULT); ?>
					<?php echo zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id(); ?>
					<div class="form_item mb-0">
						<?php echo zen_draw_input_field('keyword', '', 'class="search-input tt-search-input" value="'.TEXT_SEARCH_PLACEHOLDER_KEYWORD.'" onfocus="if(this.value == \''.TEXT_SEARCH_PLACEHOLDER_KEYWORD.'\') this.value = \'\';" onblur="if (this.value == \'\') this.value = \'' . TEXT_SEARCH_PLACEHOLDER_KEYWORD . '\';"'); ?>
					</div>
					<div class="search-results">
						<div class="resultsContainer"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</header>
