<nav>
	<ul>
		<?php
			/**================================================================================================
			**Megamenu Category
			**===============================================================================================*/
			echo wt_neoncart_menu('ver_megamenu');
		?>
		<?php if (EZPAGES_STATUS_HEADER == '1' or (EZPAGES_STATUS_HEADER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
			<li class="dropdown tt-megamenu-col-01 tt-submenu level0">
				<a><?php echo HEADER_TITLE_EZPAGES; ?></a>
				<div class="dropdown-menu size-xs">
					<div class="dropdown-menu-wrapper">
						<?php require( $template->get_template_dir('tpl_ezpages_menu.php', DIR_WS_TEMPLATE, $current_page_base,'common/objects'). '/tpl_ezpages_menu.php' ); ?>
					</div>
				</div>
			</li>  
		<?php } ?>
	</ul>
</nav>
		