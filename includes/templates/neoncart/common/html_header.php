<?php
/**
 * Common Template
 *
 * outputs the html header. i,e, everything that comes before the \</head\> tag
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2022 Oct 05 Modified in v1.5.8 $
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

$zco_notifier->notify('NOTIFY_HTML_HEAD_START', $current_page_base, $template_dir);

// Prevent clickjacking risks by setting X-Frame-Options:SAMEORIGIN
//header('X-Frame-Options:SAMEORIGIN');

/**
 * load the module for generating page meta-tags
 */
require(DIR_WS_MODULES . zen_get_module_directory('meta_tags.php'));
/**
 * output main page HEAD tag and related headers/meta-tags, etc
 */
  $paginateAsUL = true;

?>
<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?> class="<?php echo ( get_wt_neoncart_options( 'general_page_layout_mode', 'wide' ) == 'boxed' ) ? 'tt-boxed': ''; ?>">
<head>
<meta charset="<?php echo CHARSET; ?>">
<link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
<link rel="dns-prefetch" href="https://code.jquery.com">
<title><?php echo META_TAG_TITLE; ?></title>
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>">
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>">
<meta name="author" content="<?php echo STORE_NAME ?>">
<meta name="generator" content="shopping cart program by Zen Cart&reg;, http://www.zen-cart.com eCommerce">
<?php if (defined('ROBOTS_PAGES_TO_SKIP') && in_array($current_page_base,explode(",",constant('ROBOTS_PAGES_TO_SKIP'))) || $current_page_base=='down_for_maintenance' || $robotsNoIndex === true) { ?>
<meta name="robots" content="noindex, nofollow">
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=2.0">
<?php if(get_wt_neoncart_options('file_favicon')){ ?>
<link rel="icon" href="<?php echo $uploads_path.get_wt_neoncart_options('file_favicon'); ?>" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo $uploads_path.get_wt_neoncart_options('file_favicon'); ?>" type="image/x-icon">
<?php }else{ ?>
	<?php if (defined('FAVICON')){?>
<link rel="icon" href="<?php echo FAVICON; ?>" type="image/x-icon">
<link rel="shortcut icon" href="<?php echo FAVICON; ?>" type="image/x-icon">
	<?php }?>
<?php } ?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER . DIR_WS_HTTPS_CATALOG : HTTP_SERVER . DIR_WS_CATALOG ); ?>">
<?php if (isset($canonicalLink) && $canonicalLink != '') { ?>
<link rel="canonical" href="<?php echo $canonicalLink; ?>">
<?php } ?>
<?php require( $template->get_template_dir( 'tpl_wt_html_header_head.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common' ) . '/tpl_wt_html_header_head.php' ); ?>
<?php
  // BOF hreflang for multilingual sites
  if (!isset($lng) || (isset($lng) && !is_object($lng))) {
    $lng = new language;
  }
if (count($lng->catalog_languages) > 1) {
  foreach($lng->catalog_languages as $key => $value) {
    echo '<link rel="alternate" href="' . ($this_is_home_page ? zen_href_link(FILENAME_DEFAULT, 'language=' . $key, $request_type, false) : $canonicalLink . (strpos($canonicalLink, '?') ? '&amp;' : '?') . 'language=' . $key) . '" hreflang="' . $key . '">' . "\n";
  }
  }
  // EOF hreflang for multilingual sites
?>

<?php
/**
* load the loader files
*/
$RC_loader_files = array();
if($RI_CJLoader->get('status') && (!isset($Ajax) || !$Ajax->status())){
    $RI_CJLoader->autoloadLoaders();
    $RI_CJLoader->loadCssJsFiles();
    $RC_loader_files = $RI_CJLoader->header();

    if (!empty($RC_loader_files['meta']))
    foreach($RC_loader_files['meta'] as $file) {
        include($file['src']);
        echo "\n";
    }

    foreach($RC_loader_files['css'] as $file){
        if (!$file['defer']) {
          if($file['include']) {
              include($file['src']);
          } else if (!$RI_CJLoader->get('minify_css')) {
              //$link = $file['src'];
              echo '<link rel="stylesheet" href="'.$file['src'] .'">'."\n";
          } else {
              //$link = 'min/?f='.$file['src'].'&'.$RI_CJLoader->get('minify_time');
              echo '<link rel="stylesheet" href="min/?f='.$file['src'].'&'.$RI_CJLoader->get('minify_time').'">'."\n";
          }
        }
        else {
          if (!$RI_CJLoader->get('minify_css')) {
            echo '<noscript><link rel="stylesheet" href="'.$file['src'] .'" /></noscript>'."\n";
          } else {
            echo '<noscript><link rel="stylesheet" href="min/?f='.$file['src'].'&'.$RI_CJLoader->get('minify_time').'" /></noscript>'."\n";
          }
        }
    }
}
//DEBUG: echo '<!-- I SEE cat: ' . $current_category_id . ' || vs cpath: ' . $cPath . ' || page: ' . $current_page . ' || template: ' . $current_template . ' || main = ' . ($this_is_home_page ? 'YES' : 'NO') . ' -->';
?>
<?php require( $template->get_template_dir( 'tpl_wt_html_header_end.php', DIR_WS_TEMPLATE, $current_page_base, 'wt_common' ) . '/tpl_wt_html_header_end.php' ); ?>
<?php
$zco_notifier->notify('NOTIFY_HTML_HEAD_END', $current_page_base);
?>
</head>
<?php // NOTE: Blank line following is intended: ?>