<?php 
/**
	* WT Neoncart Banner Manager for Zen Cart.
	* WARNING: Do not change this file. Your changes will be lost.
	*
	* @copyright 2021 WT Tech. Designs.
	* Version : WT Neoncart Banner Manager 1.0
*/
?>
<?php
if (WT_NEONCART_BANNER_MANAGER_STATUS == 'true') {                                                            
	$wt_loader = array('conditions' => array('pages' => array('*')),
    'jscript_files' => array(
		'wt_template_banner_manager/jscript_wtwbm.js' => 2229
		)
	);
	$loaders[] = $wt_loader;
}