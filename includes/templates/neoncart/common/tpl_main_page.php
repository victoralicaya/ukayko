<?php
/**
 * Common Template - tpl_main_page.php
 *
 * Governs the overall layout of an entire page
 * Normally consisting of a header, left side column. center column. right side column and footer
 * For customizing, this file can be copied to /templates/your_template_dir/pagename
 * example: to override the privacy page
 * - make a directory /templates/my_template/privacy
 * - copy /templates/templates_defaults/common/tpl_main_page.php to /templates/my_template/privacy/tpl_main_page.php
 *
 * to override the global settings and turn off columns un-comment the lines below for the correct column to turn off
 * to turn off the header and/or footer uncomment the lines below
 * Note: header can be disabled in the tpl_header.php
 * Note: footer can be disabled in the tpl_footer.php
 *
 * $flag_disable_header = true;
 * $flag_disable_left = true;
 * $flag_disable_right = true;
 * $flag_disable_footer = true;
 *
 * // example to not display right column on main page when Always Show Categories is OFF
 *
 * if ($current_page_base == 'index' and $cPath == '') {
 *  $flag_disable_right = true;
 * }
 *
 * example to not display right column on main page when Always Show Categories is ON and set to categories_id 3
 *
 * if ($current_page_base == 'index' and $cPath == '' or $cPath == '3') {
 *  $flag_disable_right = true;
 * }
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 29 Modified in v1.5.8-alpha $
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

/** bof DESIGNER TESTING ONLY: */
// $messageStack->add('header', 'this is a sample error message', 'error');
// $messageStack->add('header', 'this is a sample caution message', 'caution');
// $messageStack->add('header', 'this is a sample success message', 'success');
// $messageStack->add('main', 'this is a sample error message', 'error');
// $messageStack->add('main', 'this is a sample caution message', 'caution');
// $messageStack->add('main', 'this is a sample success message', 'success');
/** eof DESIGNER TESTING ONLY */



// the following IF statement can be duplicated/modified as needed to set additional flags
  if (in_array($current_page_base,explode(",",'list_pages_to_skip_all_right_sideboxes_on_here,separated_by_commas,and_no_spaces')) ) {
    $flag_disable_right = true;
  }


  $header_template = 'tpl_header.php';
  $footer_template = 'tpl_footer.php';
  $left_column_file = 'column_left.php';
  $right_column_file = 'column_right.php';
  $body_id = ($this_is_home_page) ? 'indexHome' : str_replace('_', '', $_GET['main_page']);

  require($template->get_template_dir('tpl_wt_before_body_start.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common'). '/tpl_wt_before_body_start.php');
?>
<body id="<?php echo $body_id . 'Body'; ?>"<?php if($zv_onload !='') echo ' onload="'.$zv_onload.'"'; ?> class="<?php echo wt_stringify_classes( $body_classes ); ?>">
	<?php require($template->get_template_dir('tpl_wt_after_body_start.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common'). '/tpl_wt_after_body_start.php'); ?>
<?php
  if (SHOW_BANNERS_GROUP_SET1 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET1)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerOne" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>

<div id="mainWrapper">
<?php
 /**
  * prepares and displays header output
  *
  */
  if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_HEADER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or !zen_is_logged_in())) {
    $flag_disable_header = true;
  }
  require($template->get_template_dir('tpl_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_header.php');?>
	<div class="mainContainer" id="contentMainWrapper">
		<?php if (!$breadcrumb->isEmpty() && (DEFINE_BREADCRUMB_STATUS == '1' || (DEFINE_BREADCRUMB_STATUS == '2' && !$this_is_home_page)) && !$this_is_home_page) { ?>
			<div id="navBreadCrumb" class="f2_breadcrumb_nav_wrap mt-0 sec_ptb_50">
				<div class="container">
					<ul class="ce_breadcrumb_nav ul_li clearfix"><?php echo $breadcrumb->trail('', '<li>', '</li>'); ?></ul>
				</div>
			</div>
		<?php } ?>
		<?php /*========================================= Contact Us ==================================================*/ ?>
		<?php if (in_array($current_page_base,explode(",",'contact_us')) && $store_map!='') { ?>
			<section class="content-bottom">
				<div class="map_section clearfix" id="map">
					<?php echo $store_map; ?>
				</div>
			</section>
		<?php } ?>
		<?php /*========================================= EOF Contact Us ==================================================*/ ?>
		<div <?php echo wt_stringify_atts( $main_page_wrap_attr ); ?>>
		<?php echo ( !$this_is_home_page || ( $page_layout != '1column' ) ) ? '<div class="container-indent"><div class="container">' : ''; ?>
			<?php 
			if (COLUMN_LEFT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and !zen_is_logged_in()) || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or !zen_is_logged_in()))) {
			  // global disable of column_left
			  $flag_disable_left = true;
			}
			?>
			<?php if((!$flag_disable_left == true && !$flag_disable_right == true) ||  (!($flag_disable_left == true && $flag_disable_right == true)) ) { ?>
			<div class="row">
			<?php } ?>
			<?php if($flag_disable_left == true && $flag_disable_right == true ) { ?>
			<div id="centercontent-wrapper" class="page-content single-column">
			<?php } elseif($flag_disable_left == true) { ?> 
			<div id="centercontent-wrapper" class="page-content <?php echo ($is_checkout_page)? $ck_main_cols_class : 'col-lg-9'; ?> columnwith-right centerColumn pull-left aside"> 
			<?php } elseif($flag_disable_right == true) { ?> 
			<div id="centercontent-wrapper" class="page-content col-md-12 col-lg-9 columnwith-left centerColumn aside">
			<?php }else { $class_name = 'three-columns'; ?> 
			<div id="centercontent-wrapper" class="page-content col-lg-6 noleft-margin two-column centerColumn aside">
			<?php } ?>
				<?php /*=========================================Body Code ==================================================*/ ?>
				<?php  if (SHOW_BANNERS_GROUP_SET3 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET3)) {
					if ($banner->RecordCount() > 0) { ?>
						<div id="bannerThree" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
					<?php }
				  }	?>
				<?php if ($messageStack->size('upload') > 0) echo $messageStack->output('upload'); ?>
				<?php if ($messageStack->size('main_content') > 0) echo $messageStack->output('main_content'); ?>
				<div <?php echo wt_stringify_atts( $page_wrap_attr ); ?>>
				<?php
				if ( $this_is_home_page && CATEGORIES_START_MAIN == 0 ) {
					$homepage_html = file_get_contents(zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', 'define_'.$homepage_version, 'false'));
					$body_code = wt_neoncart_home_shortcode($homepage_html);
					echo $body_code;
				} else {
					require($body_code);
				}
				?>
				</div>
				<?php if (SHOW_BANNERS_GROUP_SET4 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET4)) {
					if ($banner->RecordCount() > 0) { ?>
						<div id="bannerFour" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
				<?php }
				} ?>
				<?php /*=========================================EOF Body Code ==================================================*/ ?>
			</div>
			<?php /*========================================= Left Column ==================================================*/ ?>
			<?php
			if (!isset($flag_disable_left) || !$flag_disable_left) {
				if($flag_disable_right == true) { ?>
				<div id="js-leftColumn-aside" class="col-md-4 col-lg-3 col-xl-3 leftColumn aside aside--left col-sidebar <?php echo $class_name; ?>">	
				<?php } else { ?>
				<div id="js-leftColumn-aside" class="col-md-4 col-lg-3 col-xl-3 leftColumn aside aside--left col-sidebar">
				<?php } ?>
					<?php require(DIR_WS_MODULES . zen_get_module_directory('column_left.php')); ?>
				</div>
			<?php }	?>
			<?php /*========================================= EOF Left Column ==================================================*/ ?>
			<?php /*=========================================Right Column ==================================================*/ ?>
			<?php
			if (COLUMN_RIGHT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and !zen_is_logged_in()) || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or !zen_is_logged_in()))) {
			  // global disable of column_right
			  $flag_disable_right = true;
			}
			if (!isset($flag_disable_right) || !$flag_disable_right) {
				if($flag_disable_left == true) { ?>
				<div id="js-rightColumn-aside" class="col-md-4 col-lg-3 col-xl-3 rightColumn aside aside--right hidden-xs hidden-sm hidden-md pull-righ  col-sidebar">
				<?php } else { ?>
				<div id="js-rightColumn-aside" class="col-md-4 col-lg-3 col-xl-3 rightColumn aside aside--right hidden-xs hidden-sm hidden-md pull-right col-sidebar">
				<?php } ?>
					<?php require(DIR_WS_MODULES . zen_get_module_directory('column_right.php')); ?>
				</div>
			<?php } ?>
			<?php /*=========================================EOF Right Column ==================================================*/ ?>
			<?php /*<?php if(($flag_disable_left == true || $flag_disable_right == true)) { ?>
			</div>
			<?php } ?>*/?>
			<?php if((!$flag_disable_left == true && !$flag_disable_right == true) ||  (!($flag_disable_left == true && $flag_disable_right == true)) ) { ?>
			</div>
			<?php } ?>
		<?php echo (!$this_is_home_page || ($page_layout!='1column')) ? '</div></div>' : ''; ?>
		</div>
	</div>
<?php
 /**
  * prepares and displays footer output
  *
  */
  if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_FOOTER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or !zen_is_logged_in())) {
    $flag_disable_footer = true;
  }
  require($template->get_template_dir('tpl_footer.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_footer.php');
?>

</div>
<!--bof- banner #6 display -->
<?php
  if (SHOW_BANNERS_GROUP_SET6 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET6)) {
    if ($banner->RecordCount() > 0) {
?>
<div id="bannerSix" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
<?php
    }
  }
?>
<!--eof- banner #6 display -->

<?php /* add any end-of-page code via an observer class */
  $zco_notifier->notify('NOTIFY_FOOTER_END', $current_page);
?>
<?php
/**
* load the loader JS files
*/
if(!empty($RC_loader_files)){
  foreach($RC_loader_files['css'] as $RC_order=>$file){
		if ($file['defer']) {
			if($file['include']) {
					include($file['src']);
			} else if (!$RI_CJLoader->get('minify_css')) {
					//$link = $file['src'];
					echo '
					<script type="text/javascript" async>
						var elm = document.createElement("link");
						elm.rel = "stylesheet";
						elm.type = "text/css";
						elm.href = "'.$file['src'] .'";
						
						var links = document.getElementsByTagName("link")[0];
						links.parentNode.appendChild(elm);
					</script>';
			} else {
					//$link = 'min/?f='.$file['src'].'&'.$RI_CJLoader->get('minify_time');
					echo '
					<script type="text/javascript" async>
						var elm = document.createElement("link");
						elm.rel = "stylesheet";
						elm.type = "text/css";
						elm.href = "min/?f='.$file['src'].'&'.$RI_CJLoader->get('minify_time').'";
						
						var links = document.getElementsByTagName("link")[0];
						links.parentNode.appendChild(elm);
					</script>';
			}
		}
	}

  foreach($RC_loader_files['jscript'] as $file)
    if($file['include']) {
      include($file['src']);
    } else if(!$RI_CJLoader->get('minify_js')) {
      echo '<script type="text/javascript" src="'.$file['src'].'"'.($file['defer'] ? ' defer async': '').'></script>'."\n";

    } else {
      echo '<script type="text/javascript" src="min/?f='.$file['src'].'&'.$RI_CJLoader->get('minify_time').'"'.($file['defer'] ? ' defer async': '').'></script>'."\n";
    }
}
//DEBUG: echo '';
?>
<?php require($template->get_template_dir('tpl_wt_before_body_end.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common'). '/tpl_wt_before_body_end.php'); ?>
</body>
