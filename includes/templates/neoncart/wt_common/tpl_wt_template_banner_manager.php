<?php
global $template, $current_page_base, $wt_pimgldr, $display_top_banners, $top_banners_style, $top_banner_query;
if($wtwbm_id){
	if (WT_NEONCART_BANNER_MANAGER_STATUS == 'true') {
		echo wt_neoncart_banner_manager($wtwbm_id, $slider_title);
	}
}