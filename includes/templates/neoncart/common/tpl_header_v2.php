<header class="header_section classic_ecommerce_header sticky_header clearfix">
	<?php if( $display_promo_topbar && !empty( $promo_topbar_content ) ) { ?>
	<div class="header_top bg_black text-white clearfix">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-6">
					<span class="offer_text"><?php echo $promo_topbar_content; ?></span>
				</div>
				<div class="col-lg-6">
					<ul class="primary_social_links ul_li_right clearfix">
						<?php include zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FOOTER_SOCIAL_LINKS, 'false'); ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
	<div class="header_bottom clearfix">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-3">
					<div class="brand_logo">
						<?php require( $template->get_template_dir('tpl_logo.php', DIR_WS_TEMPLATE, $current_page_base,'common/objects'). '/tpl_logo.php' ); ?>

						<ul class="mh_action_btns ul_li clearfix">
							<li>
								<button class="search_btn" data-bs-toggle="collapse" data-bs-target="#search_body_collapse" role="button" aria-expanded="false" aria-controls="search_body_collapse" aria-label="Search"><i class="fal fa-search"></i></button>
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
					<?php require( $template->get_template_dir('tpl_desktop_menu.php', DIR_WS_TEMPLATE, $current_page_base,'common/objects'). '/tpl_desktop_menu.php' ); ?>	
				</div>
				<div class="col-lg-3">
					<ul class="action_btns_group ul_li_right clearfix">
						<li>
							<button class="search_btn" data-bs-toggle="collapse" data-bs-target="#search_body_collapse" role="button" aria-expanded="false" aria-controls="search_body_collapse" aria-label="Search"><i class="fal fa-search"></i></button>
						</li>
						<li>
							<button type="button" class="user_btn" data-bs-toggle="collapse" href="#use_deropdown" role="button" aria-expanded="false" aria-controls="use_deropdown">
								<i class="fal fa-user"></i>
							</button>
							<div id="use_deropdown" class="collapse_dropdown collapse">
								<div class="dropdown_content">
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
							</div>
						</li>
						<li>
							<button type="button" class="cart_btn">
								<i class="fal fa-shopping-cart"></i>
								<span class="btn_badge"><?php echo $_SESSION['cart']->count_contents(); ?></span>
							</button>
						</li>
					</ul>
				</div>
			</div>
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