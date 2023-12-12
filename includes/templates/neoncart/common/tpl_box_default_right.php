<?php
/**
 * Common Template - tpl_box_default_right.php
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Jul 10 Modified in v1.5.8-alpha $
 */

?>
<!--// bof: <?php echo $box_id; ?> //-->
<div class="rightBoxContainer tt-collapse open <?php echo ($box_id) ? 'blk-'.$box_id : ''; ?>">
	<?php if ( !empty( $title ) ) { ?>
	<h3 class="tt-collapse-title rightBoxHeading" id="<?php echo str_replace('_', '-', $box_id) . 'Heading'; ?>"><?php echo $title; ?></h3>
	<?php } ?>
	<div class="tt-collapse-content sideBoxContent">
		<?php echo $content; ?>
		<?php if ($title_link) { echo '<a class="btn sideboxHeadingLink mt-2 btn-sm" href="' . zen_href_link($title_link, '', 'SSL') . '">' . BOX_HEADING_LINKS . '</a>'; } ?>
	</div>
</div>
<!--// eof: <?php echo $box_id; ?> //-->