<?php
	//require_once (DIR_WS_CLASSES . 'categories_ul_generator.php');
	//$zen_CategoriesUL = new zen_categories_ul_generator;
	require($template->get_template_dir('tpl_wt_categories.php', DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_wt_categories.php');

	$title = BOX_HEADING_CATEGORIES;
	$left_corner = false;
	$right_corner = false;
	$right_arrow = false;
	$title_link = false;

	require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
?>