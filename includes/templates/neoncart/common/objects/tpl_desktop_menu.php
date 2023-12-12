<?php
#WT_NEONCART_TEMPLATE_BASE#
$header_template = get_wt_neoncart_options( 'header_style', 'tpl_header_v1' );
if( $menutype == 'simple' ) {
  /**================================================================
  ** Simple Menu
  **================================================================*/
  ?>
<nav class="main_menu clearfix">
<ul class="ul_li clearfix">
	<?php if( $this_is_home_page && $header_template == 'tpl_header_v1' ) { ?>
	<li>
		<button class="alldepartments_btn bg_supermarket_red text-uppercase" type="button" data-toggle="collapse" data-target="#alldepartments_dropdown" aria-expanded="false" aria-controls="alldepartments_dropdown">
			<i class="far fa-bars"></i> All Departments
		</button>
		<?php //echo wt_sidebar_megamenu_shortcode( array(), ''); ?>
	</li>
	<?php } ?>
	<?php if ( file_exists($template->get_template_dir('tpl_wt_define_simple_menu_static_content.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common'). '/tpl_wt_define_simple_menu_static_content.php') ) {
		require( $template->get_template_dir( 'tpl_wt_define_simple_menu_static_content.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common'). '/tpl_wt_define_simple_menu_static_content.php');
	} else {
	?><li class="home dropdown tt-submenu"><a href="<?php echo zen_href_link(FILENAME_DEFAULT, '', 'SSL'); ?>"><?php echo HEADER_TITLE_CATALOG; ?></a></li>
	<?php } ?>
	<li class="dropdown menu_item_has_child tt-submenu">
		<a href="#" title="<?php echo HEADER_TITLE_CATEGORIES; ?>"><?php echo HEADER_TITLE_CATEGORIES; ?></a>
		<?php echo wt_neoncart_menu('simple'); ?>
	</li>
	<?php
		global $languages_id, $db;
		$mn_manfact_query = "SELECT m.manufacturers_id, m.manufacturers_name, m.manufacturers_image FROM ".DB_PREFIX."manufacturers m GROUP BY m.manufacturers_id ORDER BY m.manufacturers_name" ;
		$mn_manfact = $db->Execute($mn_manfact_query);
	?>
	<?php if (count($mn_manfact) > 0 ) { ?>
	<li class="dropdown menu_item_has_child">
		<a href="<?php echo zen_href_link(FILENAME_MANUFACTURERS_ALL,'&pg=brands', 'SSL'); ?>"><?php echo HEADER_TITLE_MANUFACTURER; ?></a>
		<ul class="submenu">
			<?php
				while (!$mn_manfact->EOF) {
					$mn_manfact_id=$mn_manfact->fields['manufacturers_id'];
					$mn_manfact_name=$mn_manfact->fields['manufacturers_name'];
						if($mn_manfact_name !='' ) { ?>
							<li><a href="<?php echo zen_href_link(FILENAME_DEFAULT,'&manufacturers_id='.$mn_manfact_id.'&pg=brands','SSL'); ?>">
								<?php echo $mn_manfact_name; ?></a>
							</li>
					<?php }
					$mn_manfact->MoveNext();
				}
			?>
		</ul>
	</li>
	<?php } ?>
	<?php if (EZPAGES_STATUS_HEADER == '1' or (EZPAGES_STATUS_HEADER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
	<li class="dropdown menu_item_has_child">
		<a href="<?php echo zen_href_link(FILENAME_DEFAULT,'', 'SSL'); ?>"><?php echo HEADER_TITLE_EZPAGES; ?></a>
		<?php require( $template->get_template_dir('tpl_ezpages_menu.php', DIR_WS_TEMPLATE, $current_page_base,'common/objects'). '/tpl_ezpages_menu.php' ); ?>
	</li>
<?php } ?>
</ul>
</nav>
<?php } else if( $menutype == 'mega' ){ ?>
<?php
/**================================================================
** Mega Menu
**================================================================*/
?>
<nav class="main_menu clearfix">
<ul class="ul_li clearfix">
	<?php if( $this_is_home_page && $header_template == 'tpl_header_v1' ) { ?>
	<li style="display:none;">
		<button class="alldepartments_btn bg_supermarket_red text-uppercase" type="button" data-toggle="collapse" data-target="#alldepartments_dropdown" aria-expanded="false" aria-controls="alldepartments_dropdown">
			<i class="far fa-bars"></i> All Departments
		</button>
		<?php //echo wt_sidebar_megamenu_shortcode( array(), ''); ?>
	</li>
	<?php } ?>

	<?php if ( file_exists( $template->get_template_dir( 'tpl_wt_drop_menu_static_content.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common' ). '/tpl_wt_drop_menu_static_content.php' ) ) {
		require( $template->get_template_dir( 'tpl_wt_drop_menu_static_content.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common' ). '/tpl_wt_drop_menu_static_content.php' );
	} else {
	?><li class="home dropdown"><a href="<?php echo zen_href_link(FILENAME_DEFAULT, '', 'SSL'); ?>"><?php echo HEADER_TITLE_CATALOG; ?></a></li>
	<?php } ?>
	<?php
		/**================================================================================================
		**Megamenu Category
		**===============================================================================================*/
		echo wt_neoncart_menu('megamenu');
	?>
	<?php if (EZPAGES_STATUS_HEADER == '1' or (EZPAGES_STATUS_HEADER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
		<li class="dropdown menu_item_has_child">
			<a href="<?php echo zen_href_link(FILENAME_DEFAULT,'', 'SSL'); ?>"><?php echo HEADER_TITLE_EZPAGES; ?></a>
			<?php require( $template->get_template_dir('tpl_ezpages_menu.php', DIR_WS_TEMPLATE, $current_page_base,'common/objects'). '/tpl_ezpages_menu.php' ); ?>
		</li>
	<?php } ?>
</ul>
</nav>
<?php } ?>
<!-- end dropMenuWrapper-->
