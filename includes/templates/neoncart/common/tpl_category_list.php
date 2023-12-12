<?php
/**
 * Common Template - tpl_tabular_display.php
 *
 * This file is used for generating tabular output where needed, based on the supplied array of table-cell contents.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: picaflor-azul Mon Feb 15 13:59:01 2016 -0500 New in v1.5.5 $
 */
$wrap_attr = array();
$wrap_attr['class'] = array( 'row', 'tt-layout-promo-box', 'category-listing', 'mt-4' );

$catgrid_col_xxl = get_wt_neoncart_options( 'catgrid_col_xxl', 3 );
$catgrid_col_xl = get_wt_neoncart_options( 'catgrid_col_xl', 3 );
$catgrid_col_lg = get_wt_neoncart_options( 'catgrid_col_lg', 3 );
$catgrid_col_md = get_wt_neoncart_options( 'catgrid_col_md', 3 );
$catgrid_col_sm = get_wt_neoncart_options( 'catgrid_col_sm', 3 );
$catgrid_col_xs = get_wt_neoncart_options( 'catgrid_col_xs', 1 );

$zco_notifier->notify('NOTIFY_TPL_CATEGORY_LIST_DISPLAY_START', $current_page_base, $list_box_contents);
?>
<div <?php echo wt_stringify_atts( $wrap_attr ); ?>>
	<?php
	if ( is_array( $list_box_contents ) > 0 ) {
		for ( $row = 0; $row < sizeof( $list_box_contents ); $row++ ) {
			for ( $col = 0; $col < sizeof( $list_box_contents[$row] ); $col++ ) {
				if ( !empty( $list_box_contents[$row][$col]['params']['class'] ) ) {
					$list_box_contents[$row][$col]['params']['class'][] = wt_cols_class( 'xxl', $catgrid_col_xxl );
					$list_box_contents[$row][$col]['params']['class'][] = wt_cols_class( 'xl', $catgrid_col_xl );
					$list_box_contents[$row][$col]['params']['class'][] = wt_cols_class( 'lg', $catgrid_col_lg );
					$list_box_contents[$row][$col]['params']['class'][] = wt_cols_class( 'md', $catgrid_col_md );
					$list_box_contents[$row][$col]['params']['class'][] = wt_cols_class( 'sm', $catgrid_col_sm );
					$list_box_contents[$row][$col]['params']['class'][] = wt_cols_class( 'xs', $catgrid_col_xs );
				}
				if (isset($list_box_contents[$row][$col]['text'])) {
					echo '<div ' . wt_stringify_atts( $list_box_contents[$row][$col]['params'] ) . '>' . $list_box_contents[$row][$col]['text'] .  '</div>';
				}
			}
		}
	}
	?>
</div>
<?php 
$zco_notifier->notify('NOTIFY_TPL_CATEGORY_LIST_DISPLAY_END', $current_page_base, $list_box_contents);
