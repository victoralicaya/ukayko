<?php
$content = '';
$content.='<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="bannerAsid nav-dot">';
	$content .= '<div class="banner-slider banners-carousel owl-carousel" data-item="1" data-lg="1" data-md="2" data-sm="2" data-xs="1" data-auto="true">';
	for ($i=1; $i<=sizeof($page_query_list); $i++) {
		if ($page_query_list[$i]['image'] != '') {
			$content.='<div class="banner-item">';
			if($page_query_list[$i]['link']){
				$content.='<a href="'.$page_query_list[$i]['link'].'" target="_blank">';
			}
			$content.=zen_image(DIR_WS_TEMPLATE.'images/banners/'.$page_query_list[$i]['image'], $page_query_list[$i]['name'], WT_SIDEBAR_BANNER_IMAGE_WIDTH, WT_SIDEBAR_BANNER_IMAGE_HEIGHT, 'class="img-responsive-inline"');
			if($page_query_list[$i]['link']){
				$content.='</a>';
			}
			$content.='</div>';
		}
		else {
			$content.='<div class="text-center">';
			$content .= zen_image(DIR_WS_IMAGES . 'no_picture.gif', $page_query_list[$i]['name'], WT_SIDEBAR_BANNER_IMAGE_WIDTH, WT_SIDEBAR_BANNER_IMAGE_HEIGHT, 'class="img-responsive-inline"');
			$content.='</div>';
		}
	}
	$content .= '</div>';
$content.='
		</div>
		';
//EOF