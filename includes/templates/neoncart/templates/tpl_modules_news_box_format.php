<?php
// -----
// Part of the News Box Manager plugin, re-structured for Zen Cart v1.5.1 and later by lat9.
// Copyright (C) 2015, Vinos de Frutas Tropicales
//
// +----------------------------------------------------------------------+
// | Do Not Remove: Coded for Zen-Cart by geeks4u.com                     |
// | Dedicated to Memory of Amelita "Emmy" Abordo Gelarderes              |
// +----------------------------------------------------------------------+
//

$max_news_items = (int)NEWS_BOX_SHOW_CENTERBOX;
$news_box_content_length = NEWS_BOX_CONTENT_LENGTH_CENTERBOX;

//Bof wt custom ---
global $wt_pimgldr, $db, $template, $current_page_base;
if ( empty( $wt_display_style ) ) {
	$wt_display_style = 'slider';
}

$max_items = (int)NEWS_BOX_SHOW_CENTERBOX;
if ( isset( $max_news ) ) {
	$max_items = $max_news;
}

$max_display_columns = 1;
if ( isset( $show_rows ) ) {
	$max_display_columns = $show_rows;
}
//Eof wt custom ---

include ( DIR_WS_MODULES . zen_get_module_directory (FILENAME_NEWS_BOX_FORMAT) );

$row = 0;
$col = 0;
$list_box_contents = array();

if ( !empty( $news ) ) {
	
	$lazyClass = (!empty($wt_pimgldr)) ? $wt_pimgldr['class'] : '';
	
	if ( $max_display_columns > 1 ) {
		$list_box_contents[$row]['row_class'] = 'tt-items';
	}
	
	foreach ( $news as $news_id => $news_item ) {
	
		$news_content = '';
		if ( !empty( $news_item['news_content'] ) ) {
			$new_cont_nums_char = 55;
			$news_content = substr(strip_tags(html_entity_decode($news_item['news_content'])), 0, $new_cont_nums_char); 
			$news_content .= (strlen($news_item['news_content']) > $new_cont_nums_char) ? '...' : '';
		}

		$news_date = date("F j, Y", strtotime( $news_item['news_added_date'] ) );
		
		$list_box_contents[$row][$col] = array(
			'products_type' => 'news',
			'params' => array ( 
				'class' => '',
			),
			'text' => '<div class="fm_blog_grid">
							<div class="item_image">
								<a href="' . zen_href_link (FILENAME_ARTICLE, 'p=' . $news_id, 'SSL') . '">' . wt_image( DIR_WS_IMAGES . $news_item['news_image'], $news_item['title'], NEWS_BOX_HOME_IMAGE_WIDTH, NEWS_BOX_HOME_IMAGE_HEIGHT, 'class="post-img '.$lazyClass.'"') . '</a>
							</div>
						<div class="item_content">
							<h3 class="item_title"><a href="' . zen_href_link (FILENAME_ARTICLE, 'p=' . $news_id, 'SSL') . '">' . $news_item['title'] . '</a></h3>
							' . ( ( !empty( $news_date ) ) ? '<div class="tt-meta"><div class="post_date">' . $news_date . '</div></div>' : '' ) . '
							' . ( ( !empty( $news_content ) ) ? '<p class="mb_30">' . $news_content . '</p>' : '' ) . '
							<a class="custom_btn btn_sm bg_gray text-uppercase" href="' . zen_href_link (FILENAME_ARTICLE, 'p=' . $news_id, 'SSL') . '">'. TEXT_READ_MORE .'</a>
						</div>
					</div>'
		);
		
		$col ++;
		if ( $col > ( $max_display_columns - 1 ) ) {
			$col = 0;
			$row ++;
		}
	}
	require( $template->get_template_dir('tpl_wt_display_styles.php', DIR_WS_TEMPLATE, $current_page_base,'wt_common'). '/tpl_wt_display_styles.php' );
}