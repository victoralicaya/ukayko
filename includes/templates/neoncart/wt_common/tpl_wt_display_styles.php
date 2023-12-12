<?php
$GLOBALS['zco_notifier']->notify('NOTIFY_TPL_WT_DISPLAY_STYLES_START', $current_page_base, $list_box_contents, $title, $wt_display_style );

$dis_html = '';
$show_rows = ( isset( $show_rows ) ) ? $show_rows : 1;
$wt_content_type = ( isset( $wt_content_type ) ) ? $wt_content_type : 'products';

//if ( in_array( $wt_display_style, array( 'grid', 'micro_list' ) ) ) {
//	require( $template->get_template_dir( 'tpl_products_grid.php', DIR_WS_TEMPLATE, $current_page_base, 'common' ) . '/tpl_products_grid.php' );
//}  else {

	$title_position_text = ( !empty( $title_position ) ) ? 'text-'.$title_position : 'text-left';
	$title = ( !empty( $slider_title ) ) ? ( ( $slider_title != 'none' ) ? '<h3 class="tt-title">' . $slider_title . '</h3>' : '') : $title;
	$dis_html = '';
	if ( !empty( $title )  && $title != 'none' ) {
		$dis_html .= '<div class="tt-block-title '.$title_position_text.'">'.$title.'</div>';
	}
	
	if ( is_array( $list_box_contents ) > 0 ) {
		
		$product_listing_layout_style = isset($_GET['view'])? $_GET['view']: PRODUCT_LISTING_LAYOUT_STYLE;
		
		$wrap_attr = $item_class = array();
		$wrap_attr['class'][] = 'row';
		
		// Is Slider
		if ( in_array( $wt_display_style, array( 'slider', 'micro_slider', 'micro_ver_slider', 'micro_small_slider', 'micro_small_ver_slider' ) ) ) {
			if ( !empty( $wrap_attr['class'] ) ) {
				$wrap_attr['class'] = array_merge( $wrap_attr['class'], array( 'tt-carousel-products', 'tt-alignment-img', 'tt-layout-product-item', 'slick-animated-show-js', 'slick-slider' ) );
			}
							
			// Is Vertical Slider
			if ( !empty( $slider_vertical ) ) {
				$wrap_attr['data-slider-vertical'] = true;
			}
			
			if ( in_array( $wt_display_style, array( 'micro_slider', 'micro_ver_slider' ) ) ) {
				$item_class[] = 'tt-item';
			} else {
				if ( in_array( $wt_content_type, array( 'brands' ) ) ) {
					$item_class[] = 'tt-collection-item';
				} else {
					$item_class[] = 'item';
				}
				/*if ( !empty( $arrows_class ) && in_array( $arrows_class, array('arrow-location-tab') ) ) {
					$item_class[] = 'tt-collection-item';
				} else {
					$item_class[] = 'tt-col-item';
				}*/
			}
			
			$item_class[] = 'col-12';
			
			// Slider Arrows
			if ( !empty( $arrows_class ) ) {
				$wrap_attr['class'][] = $arrows_class;
			} else {
				$wrap_attr['class'][] = 'arrow-location-tab';
			}
			
		} else {
			
			$wrap_attr['class'][] = 'product-listing';
			$wrap_attr['class'][] = 'tt-product-listing';
			
			if ( $product_listing_layout_style != 'rows' ) {
				
				$item_class[] = wt_cols_class( 'xxl', $show_xxl_columns );
				$item_class[] = wt_cols_class( 'xl', $show_xl_columns );
				$item_class[] = wt_cols_class( 'lg', $show_lg_columns );
				$item_class[] = wt_cols_class( 'md', $show_md_columns );
				$item_class[] = wt_cols_class( 'sm', $show_sm_columns );
				$item_class[] = wt_cols_class( 'xs', $show_xs_columns );
			}
			$wrap_attr['class'][] = ( $product_listing_layout_style == 'rows' ) ? 'row-view listing-view tt-col-one' : 'grid-view';
			if ( in_array( $wt_display_style, array( 'micro_grid' ) ) ) {
				$item_class[] = 'tt-item';
			} else {
				$item_class[] = 'tt-item';
			}
		}
			
		$wrap_attr['data-item'] = $show_xxl_columns;
		$wrap_attr['data-item-xxl'] = $show_xxl_columns;
		$wrap_attr['data-item-xl'] = $show_xl_columns;
		$wrap_attr['data-item-lg'] = $show_lg_columns;
		$wrap_attr['data-item-md'] = $show_md_columns;
		$wrap_attr['data-item-sm'] = $show_sm_columns;
		$wrap_attr['data-item-xs'] = $show_xs_columns;
		
		
		$dis_html .= '<div '. wt_stringify_atts( $wrap_attr ) . ' >';
		if ( is_array( $list_box_contents ) > 0 ) {
			for ( $row = 0; $row < sizeof( $list_box_contents ); $row++ ) {
				if ( !empty( $list_box_contents[$row]['row_class'] ) && !in_array( $wt_display_style, array( 'grid', 'micro_grid' ) ) ) $dis_html .= '<div class="'. $list_box_contents[$row]['row_class'] .'">';
				for ( $col = 0; $col < sizeof( $list_box_contents[$row] ); $col++ ) {
					if( isset( $list_box_contents[$row][$col]['products_count'] ) && $list_box_contents[$row][$col]['products_count'] == 0 ) {
						$item_class = array();
					}
					if ( isset( $list_box_contents[$row][$col]['params'] ) && !empty( $list_box_contents[$row][$col]['params']['class'] ) && !empty( $item_class ) ) {
						$list_box_contents[$row][$col]['params']['class'] = array_merge( $item_class, (array)$list_box_contents[$row][$col]['params']['class'] );
					} else {
						if ( isset( $list_box_contents[$row][$col]['params']['class'] ) ) $list_box_contents[$row][$col]['params']['class'] = $item_class;
					}
					if ( isset( $list_box_contents[$row][$col]['text'] ) ) {
						$dis_html .= '<div ' . wt_stringify_atts( $list_box_contents[$row][$col]['params'] ) . '>' . $list_box_contents[$row][$col]['text'] .  '</div>';
					}
				}
				if ( !empty( $list_box_contents[$row]['row_class'] ) && !in_array( $wt_display_style, array( 'grid', 'micro_grid' ) ) ) $dis_html .= '</div>';
			}
		}
		$dis_html .= '</div>';
	}
//}
$GLOBALS['zco_notifier']->notify('NOTIFY_TPL_WT_DISPLAY_STYLES_START', $current_page_base, $list_box_contents, $title, $dis_html );
echo $dis_html;