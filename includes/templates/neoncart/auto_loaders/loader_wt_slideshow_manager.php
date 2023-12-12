<?php 
/**
 * WT Slideshow Manager for Zen Cart.
 * WARNING: Do not change this file. Your changes will be lost.
 *
 * @copyright 2021 WT Tech. Designs.
 * Version : WT Slideshow Manager 1.0
 */

if ( WT_SLIDESHOW_MANAGER_STATUS == 'true' ) {
	
	$wt_loader = array( 'conditions' => array( 'pages' => array('index_home') ),
		'css_files' => array(
			'stylesheet_wt_slideshow.css' => -900,
		),
		'jscript_files' => array(
			//'wt_slideshow_manager/wt_slideshow_carousel.js' => 2229,
			'wt_slideshow_manager/jscript_wtsm.js' => 2229
		)
	);
	if( WT_SLIDESHOW_MANAGER_JQUERY_STATUS == 'true' ){
		$wt_loader['jscript_files']['wt_slideshow_manager/wtslideshow-jquery1.12.4.min.js'] = 1;
	}
	
	$loaders[] = $wt_loader;
}