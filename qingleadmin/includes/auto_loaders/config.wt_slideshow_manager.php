<?php 
/**
 * WT Slideshow Manager for Zen Cart.
 *
 * @copyright 2021 WT Tech. Designs.
 * Version : WT Slideshow Manager 1.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
} 

if (IS_ADMIN_FLAG === true) { // Verify that file is in the admin.
	$autoLoadConfig[999][] = array(
		'autoType' => 'init_script',
		'loadFile' => 'init_wt_slideshow_manager.php'
	);
} else {
	trigger_error('Install file attempted in location not related to the admin.', E_USER_WARNING);
	@unlink(__FILE__); // Remove this file if it was placed in the store side.
}