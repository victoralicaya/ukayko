<?php
/**
	* WT Slideshow Manager for Zen Cart.
	* WARNING: Do not change this file. Your changes will be lost.
	*
	* @copyright 2021 WT Tech. Designs.
	* Version : WT Slideshow Manager 1.0
*/
if (!defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}

$autoLoadConfig[0][] = array('autoType'=>'class',
							'loadFile'=>'observers/class.wt_slideshow_manager.php');
$autoLoadConfig[120][] = array('autoType'=>'classInstantiate',
							'className'=>'wt_slideshow_manager',
							'objectName'=>'wt_slideshow_manager',
							'classSession' => true
							);
							