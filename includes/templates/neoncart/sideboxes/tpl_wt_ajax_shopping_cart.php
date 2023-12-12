<?php 
#WT_NEONCART_TEMPLATE_BASE#

$content = '';
if ( function_exists( 'wtAjaxMinicart' ) ) {
	$content .= wtAjaxMinicart();
}
