<?php
/**
	* WT Slideshow Manager for Zen Cart.
	* WARNING: Do not change this file. Your changes will be lost.
	*
	* @copyright 2021 WT Tech. Designs.
	* Version : WT Slideshow Manager 1.0
*/
class wt_slideshow_manager extends base 
{
	public function __construct()
	{
		$this->attach($this, array(
            'NOTIFY_HEADER_END_EZPAGE',
        ));
	}
	
	function update(&$class, $eventID, $pa, &$p1 = NULL, &$p2 = NULL, &$p3 = NULL, &$p4 = NULL, &$p5 = NULL, &$p6 = NULL)
	{
		switch($eventID)
		{
			case 'NOTIFY_HEADER_END_EZPAGE':
				$this->notifyHeaderEndEzpage( $pa, $p1 );
				break;
		}
	}
	
	function notifyHeaderEndEzpage( $pa, &$p1 ) {
		global $var_pageDetails;
		if ( !empty( $var_pageDetails->fields['pages_html_text'] ) ) {
			$var_pageDetails->fields['pages_html_text'] = wt_slideshow_manager_shortcode( $var_pageDetails->fields['pages_html_text'] );
		}
	}
}