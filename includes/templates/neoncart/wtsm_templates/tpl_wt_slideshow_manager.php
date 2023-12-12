<?php 
/**
 * WT Slideshow Manager for Zen Cart.
 * WARNING: Do not change this file. Your changes will be lost.
 *
 * @copyright 2021 WT Tech. Designs.
 * Version : WT Slideshow Manager 1.0
 */
if ( WT_SLIDESHOW_MANAGER_STATUS == 'true' ) {
	
	global $template, $current_page_base, $wt_pimgldr;
	if ( !empty( $wtsm_id ) ) {
		echo wt_slideshow_manager( $wtsm_id, $slider_title );
	}
}