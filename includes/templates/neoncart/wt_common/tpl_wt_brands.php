<?php
//Bof wt custom ---
global $product_style, $wt_display_style, $wt_pimgldr, $db, $template, $current_page_base;
if ( empty( $wt_display_style ) ) {
	$wt_display_style = 'slider';
}

$max_items = '';
if ( $max_brands ) {
	$max_items = $max_brands;
}

$max_display_columns = 1;
if ( isset( $show_rows ) ) {
	$max_display_columns = $show_rows;
}
//Eof wt custom ---

$brands = $db->Execute( 'select * from ' . TABLE_MANUFACTURERS . ' ORDER BY manufacturers_name', $max_items );	
$nums_of_brands = $brands->RecordCount();

$row = 0;
$col = 0;
$list_box_contents = array();

if ( $nums_of_brands > 0 ) {
	
	$lazyClass = (!empty($wt_pimgldr)) ? $wt_pimgldr['class'] : '';
	
	if ( $max_display_columns > 1 ) {
		$list_box_contents[$row]['row_class'] = 'tt-items';
	}
	
	foreach( $brands as $brand ) {
		
		$list_box_contents[$row][$col] = array(
			'products_type' => 'brands',
			'params' => array ( 
				'class' => 'brand_item',
			),
			'text' => 
				'<a class="' . ( in_array( $wt_display_style, array( 'box' ) ) ? 'tt-img-box' : '' ) . '" href="'. zen_href_link( FILENAME_DEFAULT, 'manufacturers_id=' . $brand['manufacturers_id'] ) . '">' . wt_image(DIR_WS_IMAGES. $brand['manufacturers_image'], $brand['manufacturers_name'], 'auto', 'auto', 'class="'.$lazyClass.'"', 'brand' ) . '</a>'
		);
		
		$col ++;
		if ( $col > ( $max_display_columns - 1 ) ) {
			$col = 0;
			$row ++;
		}
	}
	require( $template->get_template_dir('tpl_wt_display_styles.php', DIR_WS_TEMPLATE, $current_page_base,'wt_common'). '/tpl_wt_display_styles.php' );
}