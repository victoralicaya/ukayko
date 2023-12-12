<?php
/**
 * Module Template
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: torvista 2022 Aug 03 Modified in v1.5.8-alpha2 $
 */
include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_UPCOMING_PRODUCTS));
?>
<!-- bof: upcoming_products -->
<div class="centerBoxWrapper" id="upcomingProducts">
	<?php require( $template->get_template_dir( 'tpl_wt_display_styles.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common'). '/tpl_wt_display_styles.php' ); ?>
</div>
<!-- eof: upcoming_products -->