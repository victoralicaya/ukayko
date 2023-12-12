<?php
global $template, $current_page_base;
$display_testimonials = get_wt_neoncart_options('display_testimonials', 1 );
if ( $display_testimonials ) {
	
	$zc_show_testimonials = false;
	
	//Bof wt custom ---
	global $product_style, $wt_display_style, $wt_pimgldr, $db, $template, $current_page_base;
	if ( empty( $wt_display_style ) ) {
		$wt_display_style = 'slider';
	}

	$max_items = '';
	if ( $max_testimonials ) {
		$max_items = $max_testimonials;
	}
	
	$max_display_columns = 1;
	if ( isset( $show_rows ) ) {
		$max_display_columns = $show_rows;
	}
	//Eof wt custom ---
	
	$testimonials_query_raw = "select * from " . TABLE_TESTIMONIALS_MANAGER . " where status = 1 and language_id = '" . (int)$_SESSION['languages_id'] . "' order by date_added DESC, testimonials_title";
	$testimonials = $db->Execute( $testimonials_query_raw, $max_items);
	
	$row = 0;
	$col = 0;
	$list_box_contents = array();
	
	if($testimonials->RecordCount() > 0){
		$zc_show_testimonials = true;
		
		if ( $nu )
			
		if ( $max_display_columns > 1 ) {
			$list_box_contents[$row]['row_class'] = 'tt-items';
		}
		
		while (!$testimonials->EOF){
			$testname = $testimonials->fields['testimonials_name'];
			$test_title = $testimonials->fields['testimonials_title'];
			$testimonialid = $testimonials->fields['testimonials_id'];
			$testimonialid_date = date('d M', strtotime($testimonials->fields['date_added']));
			
			$test_text = htmlspecialchars_decode(stripslashes($testimonials->fields['testimonials_html_text']));
			$new_cont_nums_char = 55;
			$test_text = substr(strip_tags(html_entity_decode($test_text)), 0, $new_cont_nums_char); 
			$test_text .= (strlen($test_text) > $new_cont_nums_char) ? '...' : '';
		
			$testimonials_image = zen_image(DIR_WS_IMAGES . $testimonials->fields['testimonials_image'], 
			$testimonials->fields['testimonials_title'], TESTIMONIAL_IMAGE_WIDTH, TESTIMONIAL_IMAGE_HEIGHT);
			
			$list_box_contents[$row][$col] = array(
				'products_type' => 'testimonials',
				'params' => array ( 
					'class' => 'item tst-item',
				),
				'text' => '
					<a class="tt-content-info tst-item">
						'. ( !empty( $testimonials_image ) ? '<div class="tt-images">' . $testimonials_image . '</div>' : '' ) .'
						<h2 class="tt-title">' . $testname . '</h2>
						' . ( ( !empty( $test_text ) ) ? '<p>' . $test_text . '</p>' : '' ) . '
						<div class="tt-subscription">
							<div class="tt-text-large">
								' . $testimonialid_date . '
							</div>
						</div>
					</a>
				'
			);
	
			$col ++;
			if ( $col > ( $max_display_columns - 1 ) ) {
				$col = 0;
				$row ++;
			}
			$testimonials->MoveNext();
		}
	}
	
	if ( $zc_show_testimonials == true ) {
		require( $template->get_template_dir('tpl_wt_display_styles.php', DIR_WS_TEMPLATE, $current_page_base,'wt_common'). '/tpl_wt_display_styles.php' );
	}
}