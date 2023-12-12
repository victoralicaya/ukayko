<?php
// -----
// Part of the News Box Manager plugin, re-structured for Zen Cart v1.5.6 and later by lat9.
// Copyright (C) 2015-2020, Vinos de Frutas Tropicales
//
// +----------------------------------------------------------------------+
// | Do Not Remove: Coded for Zen-Cart by geeks4u.com                     |
// | Dedicated to Memory of Amelita "Emmy" Abordo Gelarderes              |
// +----------------------------------------------------------------------+
//
// -----
// The following variables have been set by /includes/modules/news_box_sidebox_base.php:
//
// - $news_sidebox_layout ... Identifies the 'type' of layout to apply to the sidebox information.
//
if ($news_sidebox_layout == 'List') {
    $content = '<div class="sideBoxContent newsBoxList"><ol class="tt-list-number">' . PHP_EOL;  
    while (!$news_box_query->EOF) {
        $news_sidebox_id = $news_box_query->fields['box_news_id'];
        $news_sidebox_title = $news_box_query->fields['news_title'];
        $news_content_type = $news_box_query->fields['news_content_type'];
        $content_class = "nb-t$news_content_type";
        $content .= '<li><a href="' . zen_href_link(FILENAME_ARTICLE, "p=$news_sidebox_id") . '" class="' . $content_class . '">' . $news_sidebox_title. '</a></li>' . PHP_EOL; 
        $news_box_query->MoveNext();
    }
    $content .= '</ol></div>' . PHP_EOL;
} else {
	
	global $wt_pimgldr;
	//lazyload Class
	$lazyClass = (!empty($wt_pimgldr)) ? $wt_pimgldr['class'] : '';
	if ( $news_box_query->RecordCount() > 0 ) {
		$content ='<div class="tt-aside-post post-prws post-prws-carousel tt-aside tt-carousel-products arrow-location-03 slick-slider" data-item="1">';
		while ( !$news_box_query->EOF ) {
				$dateAdded = date("j", strtotime($news_box_query->fields['news_modified_date']));
				$monthAdded = date("M", strtotime($news_box_query->fields['news_modified_date']));
				$content .= '<div class="tt-aside-info">
								<div class="item">
									' . ( !empty( $news_box_query->fields['news_image'] ) ? '<div class="tt-aside-img"><a href="' . zen_href_link (FILENAME_ARTICLE, 'p=' . $news_box_query->fields['box_news_id'], 'SSL') . '" class="post-img">'.zen_image(DIR_WS_IMAGES . $news_box_query->fields['news_image'], $news_box_query->fields['news_title'], '263', 'auto', 'class="'.$lazyClass.'"').'</a></div>' : '' ) . '
									<a href="' . zen_href_link (FILENAME_ARTICLE, 'p=' . $news_box_query->fields['box_news_id'], 'SSL') . '">
										<div class="tt-title">'. $news_box_query->fields['news_title']. '</div>
										<div class="tt-description">'. htmlspecialchars_decode(stripslashes(zen_trunc_string($news_box_query->fields['news_content'],NEWS_BOX_CONTENT_LENGTH_CENTERBOX))).'</div>
									</a>
									<div class="tt-info">
										<div class="post-date">'.$dateAdded.'&nbsp;'.$monthAdded.'</div>
										<a href="'.zen_href_link (FILENAME_ARTICLE, 'p=' . $news_box_query->fields['box_news_id'], 'SSL').'">'.TEXT_READ_MORE.'</a>
									</div>
								</div>
							</div>';
		  $news_box_query->MoveNext();
		  
		}
		$content .= '</div>';	
	}
}
$content .= '<div class="newsbox-bot mt-2"><a class="btn button btn-sm sideboxHeadingLink" href="' . zen_href_link(FILENAME_ALL_ARTICLES, $news_box_params) . '">View all</a></div>';