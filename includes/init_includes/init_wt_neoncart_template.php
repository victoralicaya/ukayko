<?php
#WT_NEONCART_TEMPLATE_BASE#
if (!defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}
global $wt_menu, $wt_pimgldr, $template, $product_style, $current_page_base, $uploads_path, $homepage_version, $theme_layout_mode;
$wt_pimgldr = array();

// Get WT Template Data
$GLOBALS['wtTempData'] = get_wt_neoncart_template_data();