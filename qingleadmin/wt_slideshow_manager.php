<?php
/**
 * WT Slideshow Manager for Zen Cart.
 * WARNING: Do not change this file. Your changes will be lost.
 *
 * @copyright 2021 WT Tech. Designs.
 * Version : WT Slideshow Manager 1.0
 */

require('includes/application_top.php');
require('includes/functions/wt_slideshow_manager_graphs.php');
$languages = zen_get_languages();

function wtsm_data_recent($wtsmb_id, $days) {
    global $db;
    $set1 = $set2 = $stats = array();

    $result = $db->Execute("select dayofmonth(wtsmbh_history_date) as source,
                                       wtsmbh_shown as impressions, wtsmbh_clicked as clicks
                     from " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS_HISTORY . "
                     where wtsmb_id = '" . (int)$wtsmb_id . "'
                     and to_days(now()) - to_days(wtsmbh_history_date) < " . zen_db_input($days) . "
                     order by wtsmbh_history_date");

    while (!$result->EOF) {
      $set1[] = array($result->fields['source'], $result->fields['impressions']);
      $set2[] = array($result->fields['source'], $result->fields['clicks']);
      $stats[] = array($result->fields['source'], $result->fields['impressions'], $result->fields['clicks']);
      $result->MoveNext();
    }
    if (sizeof($set1) < 1) $set1 = $set2 = array(array(date('j'), 0));

    return array($set1, $set2, $stats);
}

function wtsm_get_width_text( $width ) {
	if ( $width == 0 ) {
		return 'Full Width';
	} else {
		return $width . 'px';
	}
}

function wtsm_get_height_text( $height ) {
	if ( $height == 0 ) {
		return 'Auto Height';
	} else {
		return $height . 'px';
	}
}


$template_query = $db->Execute("select template_dir from " . TABLE_TEMPLATE_SELECT . " where template_language in (" . (int)$_SESSION['languages_id'] . ', 0' . ") order by template_language DESC");
$template_dir = $template_query->fields['template_dir'];

$action = (isset($_GET['action']) ? $_GET['action'] : '');
if (isset($_GET['flagbanners_on_ssl'])) {
	$_GET['flagbanners_on_ssl'] = (int)$_GET['flagbanners_on_ssl'];
}
if (isset($_GET['wtsmID'])) {
	$_GET['wtsmID'] = (int)$_GET['wtsmID'];
}
if (isset($_GET['flag'])) {
	$_GET['flag'] = (int)$_GET['flag'];
}
if (isset($_GET['page'])) {
	$_GET['page'] = (int)$_GET['page'];
}
if (isset($_GET['flagbanners_open_new_windows'])) {
	$_GET['flagbanners_open_new_windows'] = (int)$_GET['flagbanners_open_new_windows'];
}

$wtsmb_image_dir_name = WT_SLIDESHOW_MANAGER_IMAGES;
$wtsmb_image_target = DIR_FS_CATALOG_IMAGES . $wtsmb_image_dir_name . '/';

if (zen_not_null($action)) {
	switch ($action) {
		case 'setflag':
		if (($_GET['flag'] == '0') || ($_GET['flag'] == '1')) {
			if((isset($_GET['wtsmID']) && $_GET['wtsmID']!='') && (!(isset($_GET['wtsmbID']) && $_GET['wtsmbID']!=''))){
				global $db;
				$sql = "update " . TABLE_WT_SLIDESHOW_MANAGER;
				$sql .= ($_GET['flag'] == '1') ? " set wtsm_status = 1" : " set wtsm_status = 0";
				$sql .= " where wtsm_id = '" . (int)$_GET['wtsmID'] . "'";
				$db->Execute($sql);
				$messageStack->add_session(SUCCESS_SLIDER_STATUS_UPDATED, 'success');
				zen_redirect(zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page']));
			} else if((isset($_GET['wtsmID']) && $_GET['wtsmID']!='') && (isset($_GET['wtsmbID']) && $_GET['wtsmbID']!='')){
				global $db;
				$sql = "update " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS;
				$sql .= ($_GET['flag'] == '1') ? " set wtsmb_status = 1" : " set wtsmb_status = 0";
				$sql .= ", wtsmb_date_status_change = now() where wtsmb_id = '" . (int)$_GET['wtsmbID'] . "'";
				$db->Execute($sql);
				$messageStack->add_session(SUCCESS_BANNER_STATUS_UPDATED, 'success');
				zen_redirect(zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&wtsmID=' . $_GET['wtsmID'] . '&wtsmb_page=' . $_GET['wtsmb_page'] . '&wtsmbID='.$_GET['wtsmbID'].'&action=wtsmb-view'));
			}			
		} else {
			$messageStack->add_session(ERROR_UNKNOWN_STATUS_FLAG, 'error');
		}
		break;
		case 'wtsm-add':
		case 'wtsm-upd':
			if (isset($_POST['wtsm_id'])) {
				$wtsm_id = zen_db_prepare_input($_POST['wtsm_id']);
			}
			$wtsm_title = zen_db_prepare_input($_POST['wtsm_title']);
			$wtsm_full_screen = zen_db_prepare_input($_POST['wtsm_full_screen']);
			$wtsm_width = zen_db_prepare_input($_POST['wtsm_width']);
			$wtsm_height = zen_db_prepare_input($_POST['wtsm_height']);
			$wtsm_infinite = zen_db_prepare_input($_POST['wtsm_infinite']);
			$wtsm_on_hover = zen_db_prepare_input($_POST['wtsm_on_hover']);
			$wtsm_controls = zen_db_prepare_input($_POST['wtsm_controls']);
			$wtsm_pager = zen_db_prepare_input($_POST['wtsm_pager']);
			$wtsm_autoplay = zen_db_prepare_input($_POST['wtsm_autoplay']);
			$wtsm_interval_time = zen_db_prepare_input($_POST['wtsm_interval_time']);
			$wtsm_slide_speed = zen_db_prepare_input($_POST['wtsm_slide_speed']);
			$wtsm_slide_animation = zen_db_prepare_input($_POST['wtsm_slide_animation']);
			$wtsm_status = zen_db_prepare_input($_POST['wtsm_status']);
			
			$wtsm_error = false;
			if (empty($wtsm_title)) {
				$messageStack->add(ERROR_SLIDER_TITLE_REQUIRED, 'error');
				$wtsm_error = true;
			}
			
			if ($wtsm_error == false) {
				$sql_data_array = array(
					'wtsm_title' => $wtsm_title,
					'wtsm_full_screen' => $wtsm_full_screen,
					'wtsm_width' => $wtsm_width,
					'wtsm_height' => $wtsm_height,
					'wtsm_infinite' => $wtsm_infinite,
					'wtsm_on_hover' => $wtsm_on_hover,
					'wtsm_controls' => $wtsm_controls,
					'wtsm_pager' => $wtsm_pager,
					'wtsm_autoplay' => $wtsm_autoplay,
					'wtsm_interval_time' => $wtsm_interval_time,
					'wtsm_slide_speed' => $wtsm_slide_speed,
					'wtsm_slide_animation' => $wtsm_slide_animation,
					'wtsm_status' => $wtsm_status,
					'wtsm_updated_at' => 'now()',
				);
					
				if ($action == 'wtsm-add') {
					$insert_sql_data = array('wtsm_date_added' => 'now()');
					$sql_data_array = array_merge($sql_data_array, $insert_sql_data);
						
					zen_db_perform(TABLE_WT_SLIDESHOW_MANAGER, $sql_data_array);
						
					$wtsm_id = zen_db_insert_id();
					$messageStack->add_session(SUCCESS_SLIDER_INSERTED, 'success');
					
				} elseif ($action == 'wtsm-upd') {
					zen_db_perform(TABLE_WT_SLIDESHOW_MANAGER, $sql_data_array, 'update', "wtsm_id = '" . (int)$wtsm_id . "'");
					$messageStack->add_session(SUCCESS_SLIDER_UPDATED, 'success');
				}
				
				zen_redirect(zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'wtsmID=' . $wtsm_id));
			} else {
				$action = 'wtsm-new';
			}
			break;
		case 'wtsmb-add':
		case 'wtsmb-upd':
			if (isset($_POST['wtsmb_id'])) {
				$wtsmb_id = zen_db_prepare_input($_POST['wtsmb_id']);
			}
			$wtsm_id = zen_db_prepare_input($_POST['wtsm_id']);
			$wtsmb_title = zen_db_prepare_input($_POST['wtsmb_title']);
			$wtsmb_type = zen_db_prepare_input($_POST['wtsmb_type']);
			$wtsmb_background_color = zen_db_prepare_input($_POST['wtsmb_background_color']);
			$wtsmb_background_image = zen_db_prepare_input($_FILES['wtsmb_background_image']['name']);
			$wtsmb_cp = zen_db_prepare_input($_POST['wtsmb_cp']);
			$wtsmb_cptop = zen_db_prepare_input($_POST['wtsmb_cptop']);
			$wtsmb_cpleft = zen_db_prepare_input($_POST['wtsmb_cpleft']);
			$wtsmb_url = zen_db_prepare_input($_POST['wtsmb_url']);
			$wtsmb_image = zen_db_prepare_input($_FILES['wtsmb_image']['name']);
			$wtsmb_image_remove = zen_db_prepare_input( ( isset( $_POST['wtsmb_image_remove'] ) ) ? $_POST['wtsmb_image_remove'] : '' );
			$wtsmb_item_image = zen_db_prepare_input($_FILES['wtsmb_item_image']['name']);
			$wtsmb_item_image_remove = zen_db_prepare_input( ( isset( $_POST['wtsmb_item_image_remove'] ) ) ? $_POST['wtsmb_item_image_remove'] : '' );
			$wtsmbc_content_ar = ($_POST['wtsmbc_content']);
			$wtsmb_sort_order = zen_db_prepare_input($_POST['wtsmb_sort_order']);
			$wtsmb_extra_classes = zen_db_prepare_input($_POST['wtsmb_extra_classes']);
			$wtsmb_status = zen_db_prepare_input($_POST['wtsmb_status']);
			$wtsmb_expires_date = zen_db_prepare_input($_POST['wtsmb_expires_date']) == '' ? 'null' : zen_date_raw($_POST['wtsmb_expires_date']);
			$wtsmb_expires_impressions = zen_db_prepare_input($_POST['wtsmb_expires_impressions']);
			$wtsmb_date_scheduled = zen_db_prepare_input($_POST['wtsmb_date_scheduled']) == '' ? 'null' : zen_date_raw($_POST['wtsmb_date_scheduled']);
			
			$wtsmb_error = false;
			if (empty($wtsm_id)) {
				$messageStack->add(ERROR_BANNER_SLIDER_REQUIRED, 'error');
				$wtsmb_error = true;
			}
			if (empty($wtsmb_title)) {
				$messageStack->add(ERROR_BANNER_TITLE_REQUIRED, 'error');
				$wtsmb_error = true;
			}
						
			if($wtsmb_image){
				$wtsmb_image = new upload('wtsmb_image');
				$wtsmb_image->set_extensions(array('jpg', 'jpeg', 'gif', 'png', 'webp', 'flv', 'webm', 'ogg'));
				$wtsmb_image->set_destination($wtsmb_image_target);
				if (($wtsmb_image->parse() == false) || ($wtsmb_image->save() == false)) {
					$messageStack->add(ERROR_BANNER_IMAGE_REQUIRED, 'error');
					$wtsmb_error = true;
				}
			}
			
			if($wtsmb_item_image){
				$wtsmb_item_image = new upload('wtsmb_item_image');
				$wtsmb_item_image->set_extensions(array('jpg', 'jpeg', 'gif', 'png', 'webp', 'flv', 'webm', 'ogg'));
				$wtsmb_item_image->set_destination($wtsmb_image_target);
				if (($wtsmb_item_image->parse() == false) || ($wtsmb_item_image->save() == false)) {
					$messageStack->add(ERROR_BANNER_ITEM_IMAGE_REQUIRED, 'error');
					$wtsmb_error = true;
				}
			}
			
			if($wtsmb_background_image){
				$wtsmb_background_image = new upload('wtsmb_background_image');
				$wtsmb_background_image->set_extensions(array('jpg', 'jpeg', 'gif', 'png', 'webp', 'flv', 'webm', 'ogg'));
				$wtsmb_background_image->set_destination($wtsmb_image_target);
				if (($wtsmb_background_image->parse() == false) || ($wtsmb_background_image->save() == false)) {
					$messageStack->add(ERROR_BANNER_BACKGROUND_IMAGE_REQUIRED, 'error');
					$wtsmb_error = true;
				}
			}
			
			
			if ( $wtsmb_error == false ) {
				
				if( !empty($wtsmb_id  ) ) {
					$banner = $db->Execute("SELECT wtsmb_image, wtsmb_item_image, wtsmb_background_image	FROM " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS . " WHERE wtsmb_id = " . (int)$wtsmb_id);
				}
				
				//$db_image_location = zen_limit_image_filename($db_image_location, TABLE_WT_SLIDESHOW_MANAGER, 'wtsmb_image');
				//$wtsmb_url = zen_limit_image_filename($wtsmb_url, TABLE_WT_SLIDESHOW_MANAGER, 'wtsmb_url');
				
				$sql_data_array = array(
					'wtsm_id' => $wtsm_id,
					'wtsmb_title' => $wtsmb_title,
					'wtsmb_type' => $wtsmb_type,
					'wtsmb_background_color' => $wtsmb_background_color,
					'wtsmb_cp' => $wtsmb_cp,
					'wtsmb_cptop' => (int)$wtsmb_cptop,
					'wtsmb_cpleft' => (int)$wtsmb_cpleft,
					'wtsmb_url' => $wtsmb_url,
					'wtsmb_sort_order' => $wtsmb_sort_order,
					'wtsmb_extra_classes' => $wtsmb_extra_classes,
					'wtsmb_status' => $wtsmb_status,
					'wtsmb_updated_at' => 'now()',
				);

				//remove
				if( !empty( $wtsmb_image_remove ) && !empty( $banner->fields['wtsmb_image'] ) ) {
					wtsm_remove_image( $banner->fields['wtsmb_image'] );
					$wtsmb_image = $sql_data_array['wtsmb_image'] = '';
				}
				
				if( !empty( $wtsmb_image->filename ) ) {
					$db_image_location = $wtsmb_image_dir_name.'/'.$wtsmb_image->filename;
					$sql_data_array['wtsmb_image'] = $db_image_location;
				}
				
				//remove
				if( !empty( $wtsmb_item_image_remove ) && !empty( $banner->fields['wtsmb_item_image'] ) ) {
					wtsm_remove_image( $banner->fields['wtsmb_item_image'] );
					$wtsmb_item_image = $sql_data_array['wtsmb_item_image'] = '';
					
				}
				
				if( !empty( $wtsmb_item_image->filename ) ){
					$db_item_image_location = $wtsmb_image_dir_name.'/'.$wtsmb_item_image->filename;
					$sql_data_array['wtsmb_item_image'] = $db_item_image_location;
				}
				
				//remove
				if( !empty( $wtsmb_background_image_remove ) && !empty( $banner->fields['wtsmb_background_image'] ) ) {
					wtsm_remove_image( $banner->fields['wtsmb_background_image'] );
					$wtsmb_background_image = $sql_data_array['wtsmb_background_image'] = '';
				}
			
				if( !empty( $wtsmb_background_image->filename ) ) {
					$db_item_image_location = $wtsmb_image_dir_name.'/'.$wtsmb_background_image->filename;
					$sql_data_array['wtsmb_background_image'] = $db_item_image_location;
				}
				
					
				if ($action == 'wtsmb-add') {
					$insert_sql_data = array('wtsmb_date_added' => 'now()');
					$sql_data_array = array_merge($sql_data_array, $insert_sql_data);
						
					zen_db_perform(TABLE_WT_SLIDESHOW_MANAGER_BANNERS, $sql_data_array);
						
					$wtsmb_id = zen_db_insert_id();
					$messageStack->add_session(SUCCESS_BANNER_INSERTED, 'success');
					
				} elseif ($action == 'wtsmb-upd' ) {
					zen_db_perform(TABLE_WT_SLIDESHOW_MANAGER_BANNERS, $sql_data_array, 'update', "wtsmb_id = '" . (int)$wtsmb_id . "'");
					$messageStack->add_session(SUCCESS_BANNER_UPDATED, 'success');
				}
				
				for ( $i = 0, $n = sizeof( $languages ); $i < $n; $i++ ) {
					$language_id = $languages[$i]['id'];
					$sql_data_array = array( 'wtsmbc_content' => zen_db_prepare_input( $wtsmbc_content_ar[$language_id] ) );
					$ban_cont = $db->Execute( "select * from " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS_CONTENT . " where wtsmb_id = '" . (int)$wtsmb_id . "' and languages_id = '" . (int)$language_id . "'"  );
					if ( $action == 'wtsmb-upd' && $ban_cont->RecordCount() > 0 ) {
						zen_db_perform( TABLE_WT_SLIDESHOW_MANAGER_BANNERS_CONTENT, $sql_data_array, 'update', "wtsmb_id = " . (int)$wtsmb_id . " and languages_id = " . (int)$language_id );
					} else {
						$insert_sql_data = array(
							'wtsmb_id' => $wtsmb_id,
							'languages_id' => $language_id
						);
						$sql_data_array = array_merge( $sql_data_array, $insert_sql_data );
						zen_db_perform( TABLE_WT_SLIDESHOW_MANAGER_BANNERS_CONTENT, $sql_data_array );
					}
				}
				
				// NOTE: status will be reset by the /functions/banner.php
				// build new update sql for date_scheduled, expires_date and expires_impressions
					
				$sql = "UPDATE " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS . "
				SET wtsmb_date_scheduled = DATE_ADD(:scheduledDate, INTERVAL '00:00:00' HOUR_SECOND),
				wtsmb_expires_date = DATE_ADD(:expiresDate, INTERVAL '23:59:59' HOUR_SECOND),
				wtsmb_expires_impressions = " . ($wtsmb_expires_impressions == 0 ? "null" : ":expiresImpressions") . "
				WHERE wtsmb_id = :wtsmbID";
				$sql = $db->bindVars($sql, ':expiresImpressions', $wtsmb_expires_impressions, 'integer');
				$sql = $db->bindVars($sql, ':scheduledDate', $wtsmb_date_scheduled, 'date');
				$sql = $db->bindVars($sql, ':expiresDate', $wtsmb_expires_date, 'date');
				$sql = $db->bindVars($sql, ':wtsmbID', $wtsmb_id, 'integer');
				$db->Execute($sql);
				
				zen_redirect(zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] : '') . '&wtsmID=' . $wtsm_id . (isset($_GET['wtsmb_page']) ? 'wtsmb_page=' . $_GET['wtsmb_page'] : '') .'&wtsmbID=' . $wtsmb_id . '&action=wtsmb-view'));
			} else {
				$action = 'wtsmb-new';
			}
			break;
		case 'deleteconfirm':
			if((isset($_POST['wtsmID']) && $_POST['wtsmID']!='') && (isset($_POST['wtsmbID']) && $_POST['wtsmbID']!='')){
				$wtsmID = zen_db_prepare_input($_POST['wtsmID']);
				$wtsmbID = zen_db_prepare_input($_POST['wtsmbID']);

				if (isset($_POST['delete_image']) && ($_POST['delete_image'] == 'on')) {
					$banner = $db->Execute("SELECT wtsmb_image
					FROM " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS . "
					WHERE wtsmb_id = " . (int)$wtsmbID);
					wtsm_remove_image( $banner->fields['wtsmb_image'] );
				}
				
				$db->Execute("DELETE FROM " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS . " WHERE wtsmb_id = " . (int)$_POST['wtsmbID']);
				$db->Execute("DELETE FROM " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS_HISTORY . " WHERE wtsmb_id = " . (int)$_POST['wtsmbID']);
				$messageStack->add_session(SUCCESS_BANNER_REMOVED, 'success');
				zen_redirect(zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] : '') . '&wtsmID=' . $wtsmID . (isset($_GET['wtsmb_page']) ? 'wtsmb_page=' . $_GET['wtsmb_page'] : '') .'&action=wtsmb-view'));
				
			} else if((isset($_POST['wtsmID']) && $_POST['wtsmID']!='') && (!(isset($_POST['wtsmbID']) && $_POST['wtsmbID']!=''))){
					$wtsmID = zen_db_prepare_input($_POST['wtsmID']);
					$banners = $db->Execute("SELECT wtsmb_image, wtsmb_item_image, wtsmb_background_image	FROM " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS . " WHERE wtsm_id = " . (int)$wtsmID);
					foreach($banners as $banner){
						wtsm_remove_image( $banner->fields['wtsmb_image'] );
						wtsm_remove_image( $banner->fields['wtsmb_item_image'] );
						wtsm_remove_image( $banner->fields['wtsmb_background_image'] );
					}
					
				$db->Execute("DELETE FROM " . TABLE_WT_SLIDESHOW_MANAGER . " WHERE wtsm_id = " . (int)$wtsmID);
				$db->Execute("DELETE FROM " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS . " WHERE wtsm_id = " . (int)$wtsmID);
				$db->Execute("DELETE wtsmbh_ FROM " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS_HISTORY . " wtsmbh_ LEFT JOIN " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS . " wtsmb on wtsmbh_.wtsmb_id = wtsmb.wtsmb_id WHERE wtsmb.wtsm_id = " . (int)$wtsmID);
				$messageStack->add_session(SUCCESS_SLIDER_REMOVED, 'success');
				zen_redirect(zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] : '') . '&wtsmID=' . $wtsmID)); 
			
			}
			break;
	}
}
function wtsm_remove_image( $image ) {
	
	global $messageStack;
	
	if ( is_file(DIR_FS_CATALOG_IMAGES . $image ) ) {
		if ( is_writeable(DIR_FS_CATALOG_IMAGES . $image ) ) {
			unlink( DIR_FS_CATALOG_IMAGES . $image );
		} else {
			$messageStack->add_session(ERROR_IMAGE_IS_NOT_WRITEABLE, 'error');
		}
	} else {
		$messageStack->add_session(ERROR_IMAGE_DOES_NOT_EXIST, 'error');
	}
}

?>
<!doctype html>
<html <?php echo HTML_PARAMS; ?>>
<head>
	<meta charset="<?php echo CHARSET; ?>">
	<title><?php echo TITLE; ?></title>
	<link rel="stylesheet" href="includes/stylesheet.css">
	<link rel="stylesheet" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
	<link rel="stylesheet" type="text/css" href="includes/<?php echo WT_SLIDESHOW_MANAGER_INCLUDES; ?>/css/style.css">
	<link rel="stylesheet" type="text/css" href="includes/<?php echo WT_SLIDESHOW_MANAGER_INCLUDES ?>/css/mcColorPicker.css" />
	<script src="includes/menu.js"></script>
	<script src="includes/general.js"></script>
	<style>#spiffycalendar{z-index:111;}</style>
	<script>
		function popupImageWindow(url) {
			window.open(url, 'popupImageWindow', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=100,height=100,screenX=150,screenY=150,top=150,left=150')
		}
	</script>
	<script>
		function init() {
			cssjsmenu('navbar');
			if (document.getElementById) {
				var kill = document.getElementById('hoverJS');
				kill.disabled = true;
			}
		}
		
		// -->
	</script>
	<?php if ($editor_handler != '') include ($editor_handler); ?>
</head>
<body onload="init()">
	<div id="spiffycalendar" class="text"></div>
	<!-- header //-->
	<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
	<!-- header_eof //-->
	
	<!--[if lte IE 8]><script type="text/javascript" src="includes/javascript/flot/excanvas.min.js"></script><![endif]-->
	<?php /*<script src="includes/javascript/flot/jquery.flot.min.js"></script>
	<script src="includes/javascript/flot/jquery.flot.orderbars.js"></script>*/?>
	
	<!-- body //-->
	<div class="container-fluid">
		<h1><?php echo HEADING_TITLE; ?></h1>
		<!-- body_text //-->
		<?php if ($action == '') { ?>
			<div class="row">
				<table class="table-condensed">
					<tr>
						<td class="text-center"><?php echo TEXT_LEGEND; ?></td>
						<td class="text-center"><?php echo TABLE_HEADING_STATUS . '<br>' . zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON) . '&nbsp;' . zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF); ?></td>
					</tr>
				</table>
			</div>
		<?php } // legend ?>
		<?php /*********************************************** Slider Form *************************************************/?>
		<?php
			if ( $action == 'wtsm-new' ) {
				$form_action = 'wtsm-add';
				
				$parameters = array(
				'wtsm_title' => '',
				'wtsm_full_screen' => 0,
				'wtsm_width' => 0,
				'wtsm_height' => 0,
				'wtsm_infinite' => 0,
				'wtsm_on_hover' => 0,
				'wtsm_controls' => 1,
				'wtsm_pager' => 1,
				'wtsm_autoplay' => 1,
				'wtsm_interval_time' => 5000,
				'wtsm_slide_speed' => 2000,
				'wtsm_slide_animation' => 'slide',
				'wtsm_status' => '1'
				);
				
				$bInfo = new objectInfo($parameters);
				
				if (isset($_GET['wtsmID'])) {
					$form_action = 'wtsm-upd';
					
					$wtsmID = zen_db_prepare_input($_GET['wtsmID']);
					
					$slider = $db->Execute("SELECT *
					FROM " . TABLE_WT_SLIDESHOW_MANAGER . "
					WHERE wtsm_id = " . (int)$wtsmID);
					$bInfo->updateObjectInfo($slider->fields);
				} elseif (zen_not_null($_POST)) {
					$bInfo->updateObjectInfo($_POST);
				}
			?>
			<div class="row">
				<?php
					echo zen_draw_form('wtsm_new', FILENAME_WT_SLIDESHOW_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'action=' . $form_action, 'post', 'onsubmit="return check_dates(date_scheduled, dateScheduled.required, expires_date, dateExpires.required);" enctype="multipart/form-data" class="form-horizontal"');
					if ($form_action == 'wtsm-upd') {
						echo zen_draw_hidden_field('wtsm_id', $wtsmID);
					}
				?>
				<div class="form-group">
					<?php echo zen_draw_label(TEXT_SLIDER_TITLE, 'wtsm_title', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<?php echo zen_draw_input_field('wtsm_title', htmlspecialchars($bInfo->wtsm_title, ENT_COMPAT, CHARSET, TRUE), zen_set_field_length(TABLE_WT_SLIDESHOW_MANAGER, 'wtsm_title') . ' class="form-control"', true); ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo zen_draw_label(TEXT_SLIDER_FULL_SCREEN, 'wtsm_full_screen', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtsm_full_screen', '1', $bInfo->wtsm_full_screen == 1) . TEXT_YES; ?></label>
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtsm_full_screen', '0', $bInfo->wtsm_full_screen == 0) . TEXT_NO; ?></label><br>
					</div>
				</div>
				<div class="form-group wtsm-fs-group">
					<?php echo zen_draw_label(TEXT_SLIDER_WIDTH, 'wtsm_width', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<?php echo zen_draw_input_field('wtsm_width', $bInfo->wtsm_width, zen_set_field_length(TABLE_WT_SLIDESHOW_MANAGER, 'wtsm_width') . ' class="form-control"', true); ?>
						<br>
						<?php echo TEXT_SLIDER_WIDTH_NOTICE; ?>
					</div>
				</div>
				<div class="form-group wtsm-fs-group">
					<?php echo zen_draw_label(TEXT_SLIDER_HEIGHT, 'wtsm_height', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<?php echo zen_draw_input_field('wtsm_height', $bInfo->wtsm_height, zen_set_field_length(TABLE_WT_SLIDESHOW_MANAGER, 'wtsm_height') . ' class="form-control"', true); ?>
						<br>
						<?php echo TEXT_SLIDER_HEIGHT_NOTICE; ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo zen_draw_label(TEXT_SLIDER_INFINITE, 'wtsm_infinite', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtsm_infinite', '1', $bInfo->wtsm_infinite == 1) . TEXT_YES; ?></label>
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtsm_infinite', '0', $bInfo->wtsm_infinite == 0) . TEXT_NO; ?></label><br>
					</div>
				</div>
				<div class="form-group">
					<?php echo zen_draw_label(TEXT_SLIDER_ON_HOVER, 'wtsm_on_hover', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtsm_on_hover', '1', $bInfo->wtsm_on_hover == 1) . TEXT_YES; ?></label>
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtsm_on_hover', '0', $bInfo->wtsm_on_hover == 0) . TEXT_NO; ?></label><br>
						<?php echo TEXT_SLIDER_ON_HOVER_NOTICE; ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo zen_draw_label(TEXT_SLIDER_CONTROLS, 'wtsm_controls', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtsm_controls', '1', $bInfo->wtsm_controls == 1) . TEXT_YES; ?></label>
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtsm_controls', '0', $bInfo->wtsm_controls == 0) . TEXT_NO; ?></label><br>
					</div>
				</div>
				<div class="form-group">
					<?php echo zen_draw_label(TEXT_SLIDER_PAGER, 'wtsm_pager', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtsm_pager', '1', $bInfo->wtsm_pager == 1) . TEXT_YES; ?></label>
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtsm_pager', '0', $bInfo->wtsm_pager == 0) . TEXT_NO; ?></label><br>
					</div>
				</div>
				<div class="form-group">
					<?php echo zen_draw_label(TEXT_SLIDER_AUTO_PLAY, 'wtsm_autoplay', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtsm_autoplay', '1', $bInfo->wtsm_autoplay == 1) . TEXT_YES; ?></label>
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtsm_autoplay', '0', $bInfo->wtsm_autoplay == 0) . TEXT_NO; ?></label><br>
					</div>
				</div>
				<div class="form-group">
					<?php echo zen_draw_label(TEXT_SLIDER_AUTO_PLAY_INTERVAL_TIME, 'wtsm_interval_time', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<?php echo zen_draw_input_field('wtsm_interval_time', $bInfo->wtsm_interval_time, zen_set_field_length(TABLE_WT_SLIDESHOW_MANAGER, 'wtsm_interval_time') . ' class="form-control"', true); ?>
						<br>
						<?php echo TEXT_SLIDER_AUTO_PLAY_INTERVAL_TIME_NOTICE; ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo zen_draw_label(TEXT_SLIDER_SLIDE_SPEED, 'wtsm_slide_speed', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<?php echo zen_draw_input_field('wtsm_slide_speed', $bInfo->wtsm_slide_speed, zen_set_field_length(TABLE_WT_SLIDESHOW_MANAGER, 'wtsm_slide_speed') . ' class="form-control"', true); ?>
						<br>
						<?php echo TEXT_SLIDER_SLIDE_SPEED_NOTICE; ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo zen_draw_label(TEXT_SLIDER_ANIMATION, 'wtsm_slide_animation', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<?php echo zen_draw_pull_down_menu('wtsm_slide_animation', array( array( 'id' => 'slide', 'text'=> 'Slide' ), array( 'id' => 'fade', 'text'=> 'Fade' ) ), $bInfo->wtsm_slide_animation, 'class="form-control" id="wtsm_slide_animation"'); ?>
						<br>
						<?php echo TEXT_SLIDER_ANIMATION_NOTICE; ?>
					</div>
				</div>
				<div class="form-group">
					<?php echo zen_draw_label(TEXT_SLIDER_STATUS, 'wtsm_status', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtsm_status', '1', $bInfo->wtsm_status == 1) . TEXT_BANNERS_ACTIVE; ?></label>
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtsm_status', '0', $bInfo->wtsm_status == 0) . TEXT_BANNERS_NOT_ACTIVE; ?></label><br>
						<span class="help-block"><?php echo TEXT_INFO_SLIDER_STATUS; ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 text-right">
						<button type="submit" class="btn btn-primary"><?php echo (($form_action == 'wtsm-add') ? IMAGE_INSERT : IMAGE_UPDATE); ?></button> <a href="<?php echo zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . (isset($_GET['wtsmID']) ? 'wtsmID=' . $_GET['wtsmID'] : '')); ?>" class="btn btn-default" role="button"><?php echo IMAGE_CANCEL; ?></a>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9 col-md-6">
						<?php echo TEXT_SLIDER_EXPIRCY_NOTE . '<br>' . TEXT_SLIDER_SCHEDULE_NOTE; ?>
					</div>
				</div>
				<?php echo '</form>'; ?>
			</div>
			<?php /*********************************************** Banner Form *************************************************/ ?>
			<?php } else if ( $action == 'wtsmb-new' ) { ?>
			<?php
				if( isset( $_GET['wtsmID'] ) ) {
					$form_action = 'wtsmb-add';
					$wtsmID = zen_db_prepare_input( $_GET['wtsmID'] );
					$parameters = array(
						'wtsmb_title' => '',
						'wtsmb_url' => '',
						'wtsmb_image' => '',
						'wtsmb_item_image' => '',
						'wtsmb_background_color' => '',
						'wtsmbc_content' => '',
						'wtsmb_date_scheduled' => '',
						'wtsmb_expires_date' => '',
						'wtsmb_expires_impressions' => '',
						'wtsm_sort_order' => '',
						'wtsm_status' => '1'
					);
					
					$bInfo = new objectInfo( $parameters );
					
					if (isset($_GET['wtsmbID'])) {
						$form_action = 'wtsmb-upd';
						
						$wtsmbID = zen_db_prepare_input($_GET['wtsmbID']);
						
						$wtsmb_res = $db->Execute("SELECT *,
						date_format(wtsmb_date_scheduled, '%Y/%m/%d') as wtsmb_date_scheduled,
						date_format(wtsmb_expires_date, '%Y/%m/%d') as wtsmb_expires_date
						FROM " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS . "
						WHERE wtsmb_id = " . (int)$wtsmbID);
						
						$bInfo->updateObjectInfo( $wtsmb_res->fields );
						
						$wtsmbc_content = array();
						$wtsmbc_res = $db->Execute("SELECT *
						FROM " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS_CONTENT . "
						WHERE wtsmb_id = " . (int)$wtsmbID);
						if ( $wtsmbc_res->RecordCount() > 0 ) {
							foreach( $wtsmbc_res as $wtsmbc ) {
								$wtsmbc_content[$wtsmbc['languages_id']] = $wtsmbc['wtsmbc_content'];
							}
						}
						$bInfo->wtsmbc_content = $wtsmbc_content;
						
					} elseif (zen_not_null($_POST)) {
						$bInfo->updateObjectInfo($_POST);
					}
				?>
				<link rel="stylesheet" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
				<script src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
				<script>
					var dateExpires = new ctlSpiffyCalendarBox("dateExpires", "wtsmb_banner", "wtsmb_expires_date", "btnDate1", "<?php echo zen_date_short($bInfo->wtsmb_expires_date); ?>", scBTNMODE_CUSTOMBLUE);
					var dateScheduled = new ctlSpiffyCalendarBox("dateScheduled", "wtsmb_banner", "wtsmb_date_scheduled", "btnDate2", "<?php echo zen_date_short($bInfo->wtsmb_date_scheduled); ?>", scBTNMODE_CUSTOMBLUE);
				</script>
				<div class="row">
					<?php
						echo zen_draw_form('wtsmb_banner', FILENAME_WT_SLIDESHOW_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'action=' . $form_action, 'post', '" enctype="multipart/form-data" class="form-horizontal"');
						echo zen_draw_hidden_field('wtsm_id', $wtsmID);
						if ($form_action == 'wtsmb-upd') {
							echo zen_draw_hidden_field('wtsmb_id', $wtsmbID);
						}
					?>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNERS_TITLE, 'wtsmb_title', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php echo zen_draw_input_field('wtsmb_title', htmlspecialchars($bInfo->wtsmb_title, ENT_COMPAT, CHARSET, TRUE), zen_set_field_length(TABLE_WT_SLIDESHOW_MANAGER_BANNERS, 'wtsmb_title') . ' class="form-control"', true); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNERS_BACKGROUND_COLOR, 'wtsmb_background_color', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-1 col-md-1">
							<?php echo zen_draw_input_field('wtsmb_background_color', $bInfo->wtsmb_background_color, zen_set_field_length(TABLE_WT_SLIDESHOW_MANAGER_BANNERS, 'wtsmb_background_color') . ' class="form-control color" width="10"', false); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNERS_BACKGROUND_IMAGE, 'wtsmb_background_image', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php echo zen_draw_file_field('wtsmb_background_image', '', 'class="form-control"'); ?>
							<?php 
								if ( $bInfo->wtsmb_background_image ) {
									echo zen_image(DIR_WS_CATALOG_IMAGES . $bInfo->wtsmb_background_image, $bInfo->wtsmb_background_image, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '');
									echo '<br>'.TEXT_REMOVE_BANNERS_BACKGROUND_IMAGE . zen_draw_checkbox_field( 'wtsmb_background_image_remove' );
								}
							?>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNER_TYPE, 'wtsmb_type', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php echo zen_draw_pull_down_menu('wtsmb_type', array( array( 'id' => 'ban_img_with_content', 'text' => TEXT_IMAGE_WITH_CONTENT ), array( 'id' => 'ban_item_img_with_content', 'text' => TEXT_ITEM_IMAGE_WITH_CONTENT ), array( 'id' => 'img_with_link', 'text' => TEXT_IMAGE_WITH_LINK ) ), $bInfo->wtsmb_type, 'class="form-control" id="wtsmb_type"'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNERS_IMAGE, 'wtsmb_image', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php echo zen_draw_file_field('wtsmb_image', '', 'class="form-control"'); ?>
							<?php 
								if ( $bInfo->wtsmb_image ) {
									echo zen_image(DIR_WS_CATALOG_IMAGES . $bInfo->wtsmb_image, $bInfo->wtsmb_image, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '');
									echo '<br>'.TEXT_REMOVE_BANNERS_IMAGE . zen_draw_checkbox_field( 'wtsmb_image_remove' );
								}
							?>
						</div>
					</div>
					<div id="wtsmb_item_image" class="form-group wtsmb_fields_group ban_item_img_with_content hidden">
						<?php echo zen_draw_label(TEXT_ITEM_IMAGE, 'wtsmb_item_image', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php echo zen_draw_file_field('wtsmb_item_image', '', 'class="form-control"'); ?>
							<?php 
								if ( $bInfo->wtsmb_item_image ) {
									echo zen_image(DIR_WS_CATALOG_IMAGES . $bInfo->wtsmb_item_image, $bInfo->wtsmb_item_image, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '');
									echo '<br>'.TEXT_REMOVE_ITEM_IMAGE . zen_draw_checkbox_field( 'wtsmb_item_image_remove' );
								}
							?>
						</div>
					</div>
					<div id="wtsmb_cp_position" class="form-group wtsmb_cp_group ban_img_with_content ban_item_img_with_content hidden">
						<?php echo zen_draw_label(TEXT_BANNER_CONTENT_POSITION, 'wtsmb_cp', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php echo zen_draw_pull_down_menu('wtsmb_cp', array( array( 'id' => 'cp-left', 'text' => TEXT_CP_LEFT ), array( 'id' => 'cp-center', 'text' => TEXT_CP_CENTER ), array( 'id' => 'cp-right', 'text' => TEXT_CP_RIGHT ), array( 'id' => 'cp-custom', 'text' => TEXT_CP_CUSTOM ) ), $bInfo->wtsmb_cp, 'class="form-control" id="wtsmb_cp"'); ?>
						</div>
					</div>
					<div id="wtsmb_cp_custom_top" class="form-group wtsmb_cp_group wtsmb_custom_postion hidden">
						<?php echo zen_draw_label(TEXT_CP_CUSTOM_TOP, 'wtsmb_cptop', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php echo zen_draw_input_field('wtsmb_cptop', $bInfo->wtsmb_cptop, zen_set_field_length(TABLE_WT_SLIDESHOW_MANAGER_BANNERS, 'wtsmb_cptop') . ' class="form-control"'); ?>
						</div>
					</div>
					<div id="wtsmb_cp_custom_left" class="form-group wtsmb_cp_group wtsmb_custom_postion hidden">
						<?php echo zen_draw_label(TEXT_CP_CUSTOM_LEFT, 'wtsmb_cpleft', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php echo zen_draw_input_field('wtsmb_cpleft', $bInfo->wtsmb_cpleft, zen_set_field_length(TABLE_WT_SLIDESHOW_MANAGER_BANNERS, 'wtsmb_cpleft') . ' class="form-control"'); ?>
						</div>
					</div>
					<div id="wtsmb_cp_url" class="form-group wtsmb_fields_group img_with_link hidden">
						<?php echo zen_draw_label(TEXT_BANNERS_LINK, 'wtsmb_url', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php echo zen_draw_input_field('wtsmb_url', $bInfo->wtsmb_url, zen_set_field_length(TABLE_WT_SLIDESHOW_MANAGER_BANNERS, 'wtsmb_url') . ' class="form-control"'); ?>
						</div>
					</div>
					<div id="wtsmb_cp_content" class="form-group wtsmb_fields_group ban_img_with_content ban_item_img_with_content hidden">
						<?php echo zen_draw_label(TEXT_BANNERS_HTML_TEXT, 'wtsmbc_content', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {  ?>
							<div class="input-group">
								<span class="input-group-addon">
									<?php echo zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
								</span>
								<?php echo zen_draw_textarea_field('wtsmbc_content[' . $languages[$i]['id'] . ']', 'text', '100%', '15', (isset($bInfo->wtsmbc_content[$languages[$i]['id']])) ? html_entity_decode(stripslashes($bInfo->wtsmbc_content[$languages[$i]['id']])) : '', 'class="editorHook form-control"'); ?>
							</div>
							<br>
							<?php
						  }
						  ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNERS_EXTRA_CLASSES, 'wtsmb_extra_classes', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php echo zen_draw_input_field('wtsmb_extra_classes', $bInfo->wtsmb_extra_classes, zen_set_field_length(TABLE_WT_SLIDESHOW_MANAGER_BANNERS, 'wtsmb_extra_classes') . ' class="form-control"', false); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNERS_ALL_SORT_ORDER, 'wtsmb_sort_order', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php echo zen_draw_input_field('wtsmb_sort_order', $bInfo->wtsmb_sort_order, zen_set_field_length(TABLE_WT_SLIDESHOW_MANAGER_BANNERS, 'wtsmb_sort_order') . ' class="form-control"', false); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNERS_SCHEDULED_AT, 'wtsmb_date_scheduled', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<script>dateScheduled.writeControl(); dateScheduled.dateFormat = "<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNERS_EXPIRES_ON, 'wtsmb_expires_impressions', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<script>dateExpires.writeControl(); dateExpires.dateFormat = "<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script>
							<div style="display:none;">
							<?php echo TEXT_BANNERS_OR_AT . '<br><br>' . zen_draw_input_field('wtsmb_expires_impressions', $bInfo->wtsmb_expires_impressions, 'maxlength="7" size="7" class="form-control"') . ' ' . zen_draw_label(TEXT_BANNERS_IMPRESSIONS, 'wtsmb_expires_impressions', 'class="control-label"') ; ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNERS_STATUS, 'wtsmb_status', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<label class="radio-inline"><?php echo zen_draw_radio_field('wtsmb_status', '1', $bInfo->wtsmb_status == 1) . TEXT_BANNERS_ACTIVE; ?></label>
							<label class="radio-inline"><?php echo zen_draw_radio_field('wtsmb_status', '0', $bInfo->wtsmb_status == 0) . TEXT_BANNERS_NOT_ACTIVE; ?></label><br>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-right">
							<button type="submit" class="btn btn-primary"><?php echo (($form_action == 'wtsmb-add') ? IMAGE_INSERT : IMAGE_UPDATE); ?></button> <a href="<?php echo zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . (isset($_GET['wtsmID']) ? 'wtsmID=' . $_GET['wtsmID'] . '&' : '') . (isset($_GET['wtsmb_page']) ? 'wtsmb_page=' . $_GET['wtsmb_page'] . '&' : '') . (isset($_GET['wtsmbID']) ? 'wtsmbID=' . $_GET['wtsmbID'] : '') . '&action=wtsmb-view' ); ?>" class="btn btn-default" role="button"><?php echo IMAGE_CANCEL; ?></a>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9 col-md-6">
							<?php echo TEXT_BANNERS_BANNER_NOTE . '<br>' . TEXT_BANNERS_INSERT_NOTE; ?>
						</div>
					</div>
					<?php echo '</form>'; ?>
				</div>
				<?php }else{ ?>
				<div class="row">
					<div class="form-group">
						<div class="col-sm-offset-3 col-sm-9 col-md-6">
							<?php echo NOTICE_SLIDER_NOT_SELECTED; ?>
						</div>
					</div>
				</div>
				<?php } ?>
			<?php /*********************************************** Banners List *************************************************/?>
			<?php } else if($action == 'wtsmb-view' || $action == 'wtsmb-del' ) { ?>
			<?php 
			$wtsm_rs = $db->Execute("SELECT wtsm.wtsm_title FROM " . TABLE_WT_SLIDESHOW_MANAGER . " wtsm WHERE wtsm.wtsm_id = " .(int)$_GET['wtsmID']); ?>
			<?php if($wtsm_rs->RecordCount() >  0){ ?>
			<br>
			<h4><?php echo TEXT_SELECTED_SLIDER . '  :  ' .$wtsm_rs->fields['wtsm_title']; ?></h4>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 configurationColumnLeft">
					<table class="table table-hover">
						<thead>
							<tr class="dataTableHeadingRow">
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_BANNERS_TITLE; ?></th>
								<th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_BANNERS_BG_IMAGE; ?></th>
								<th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_BANNERS_IMAGE; ?></th>
								<th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_BANNERS_ITEM_IMAGE; ?></th>
								<?php /*<th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_STATISTICS; ?></th>*/ ?>
								<th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_AVAILABLE; ?></th>
								<th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_EXPIRES; ?></th>
								<th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_STATUS; ?></th>
								<th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_BANNER_STATUS; ?></th>
								<th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_BANNER_SORT_ORDER; ?></th>
								<th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_ACTION; ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$wtsmb_query_raw = "SELECT wtsmb_id, wtsm_id, wtsmb_title, wtsmb_image, wtsmb_background_image, wtsmb_item_image, wtsmb_status, wtsmb_date_scheduled, wtsmb_expires_date,
                                               wtsmb_date_status_change, wtsmb_date_added, wtsmb_sort_order
                                        FROM " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS . " wtsmb WHERE wtsmb.wtsm_id = " .(int)$_GET['wtsmID']. "
                                        ORDER BY wtsmb_sort_order, wtsmb_title";
								// Split Page
								// reset page when page is unknown
								if (( empty( $_GET['wtsmb_page'] ) || $_GET['wtsmb_page'] == '1') && !empty( $_GET['wtsmbID'] ) ) {
									$check_page = $db->Execute($wtsmb_query_raw);
									$check_count = 1;
									if ($check_page->RecordCount() > MAX_DISPLAY_SEARCH_RESULTS) {
										foreach ($check_page as $item) {
											if ($item['wtsmb_id'] == $_GET['wtsmbID']) {
												break;
											}
											$check_count++;
										}
										$_GET['wtsmb_page'] = round((($check_count / MAX_DISPLAY_SEARCH_RESULTS) + (fmod_round($check_count, MAX_DISPLAY_SEARCH_RESULTS) != 0 ? .5 : 0)), 0);
										} else {
										$_GET['wtsmb_page'] = 1;
									}
								}
								$wtsmb_split = new splitPageResults($_GET['wtsmb_page'], MAX_DISPLAY_SEARCH_RESULTS, $wtsmb_query_raw, $wtsmb_query_numrows);
								$banners = $db->Execute($wtsmb_query_raw);
								if($banners->RecordCount() > 0){
									foreach ( $banners as $banner ) {
										$info = $db->Execute("SELECT SUM(wtsmbh_shown) AS wtsmbh_shown,
										SUM(wtsmbh_clicked) AS wtsmbh_clicked
										FROM " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS_HISTORY . "
										WHERE wtsmb_id = " . (int)$banner['wtsmb_id']);
										
										if ((!isset($_GET['wtsmbID']) || (isset($_GET['wtsmbID']) && ($_GET['wtsmbID'] == $banner['wtsmb_id']))) && !isset($bInfo) && (substr($action, 0, 3) != 'wtsmb-new')) {
											$bInfo_array = array_merge($banner, $info->fields);
											$bInfo = new objectInfo($bInfo_array);
										}
										
										$wtsmbh_shown = ($info->fields['wtsmbh_shown'] != '') ? $info->fields['wtsmbh_shown'] : '0';
										$wtsmbh_clicked = ($info->fields['wtsmbh_clicked'] != '') ? $info->fields['wtsmbh_clicked'] : '0';
										
										if (isset($bInfo) && is_object($bInfo) && ($banner['wtsmb_id'] == $bInfo->wtsmb_id)) {
										?>
										<tr id="defaultSelected" class="dataTableRowSelected" onclick="document.location.href = '<?php echo zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page']. '&wtsmID=' . $banner['wtsm_id'].'&wtsmb_page=' . $_GET['wtsmb_page'] . '&wtsmbID=' . $banner['wtsmb_id'] . '&action=wtsmb-view'); ?>'" role="button">
										<?php } else { ?>
										<tr class="dataTableRow" onclick="document.location.href = '<?php echo zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page']. '&wtsmID=' . $banner['wtsm_id'].'&wtsmb_page=' . $_GET['wtsmb_page'] . '&wtsmbID=' . $banner['wtsmb_id'] . '&action=wtsmb-view'); ?>'" role="button">
											<?php
											}
										?>
											<td class="dataTableContent"><a href="javascript:popupImageWindow('<?php echo FILENAME_POPUP_IMAGE; ?>.php?banner=<?php echo $banner['wtsmb_id']; ?>')"><?php echo zen_image(DIR_WS_IMAGES . 'icon_popup.gif', 'View Banner'); ?></a>&nbsp;<?php echo $banner['wtsmb_title']; ?></td>
											<td width="100" align="center"><?php echo ( !empty( $banner['wtsmb_background_image'] ) ) ? zen_image(DIR_WS_CATALOG_IMAGES . $banner['wtsmb_background_image'], $banner['wtsmb_background_image'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '') : ''; ?></td>
											<td width="100" align="center"><?php echo !empty( $banner['wtsmb_image'] ) ? zen_image(DIR_WS_CATALOG_IMAGES . $banner['wtsmb_image'], $banner['wtsmb_image'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '') : ''; ?></td>
											<td width="100" align="center"><?php echo !empty( $banner['wtsmb_item_image'] ) ? zen_image(DIR_WS_CATALOG_IMAGES . $banner['wtsmb_item_image'], $banner['wtsmb_item_image'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '') : ''; ?></td>
											<?php /*<td class="dataTableContent text-right"><?php echo $wtsmbh_shown . ' / ' . $wtsmbh_clicked; ?></td> */ ?>
											<td class="dataTableContent text-right"><?php echo $banner['wtsmb_date_scheduled']; ?></td>
											<td class="dataTableContent text-right"><?php echo $banner['wtsmb_expires_date']; ?></td>
											<td class="dataTableContent text-center">
												<?php if ($banner['wtsmb_status'] == '1') { ?>
													<a href="<?php echo zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&wtsmID='.$banner['wtsm_id'].'&wtsmb_page=' . $_GET['wtsmb_page'] . '&wtsmbID=' . $banner['wtsmb_id'] . '&action=setflag&flag=0'); ?>"><?php echo zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON); ?></a>
													<?php } else { ?>
													<a href="<?php echo zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&wtsmID='.$banner['wtsm_id'].'&wtsmb_page=' . $_GET['wtsmb_page'] . '&wtsmbID=' . $banner['wtsmb_id'] . '&action=setflag&flag=1'); ?>"><?php echo zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF); ?></a>
												<?php } ?>
											</td>
											<td class="dataTableContent text-center">
												<?php
													$cur_date = strtotime( date( 'Y-m-d H:i:s' ) );
													$wtsmb_date_available = strtotime( $banner['wtsmb_date_added'] );
													$wtsmb_expires_date = strtotime( $banner['wtsmb_expires_date'] );
													$wtsmb_status = '';
													$wtsmb_status_ar = array( 'disabled' => TEXT_WTSM_DISABLED, 'expired' => TEXT_WTSM_EXPIRED, 'queued' => TEXT_WTSM_QUEUED, 'running' => TEXT_WTSM_RUNNING);
													if ( $banner['wtsmb_status'] == 0 ) {
														$wtsmb_status = 'disabled';
													} else if ( $cur_date > $wtsmb_date_available && $cur_date > $wtsmb_expires_date ) {
														$wtsmb_status = 'expired';
													} else if($cur_date < $wtsmb_date_available && $cur_date < $wtsmb_expires_date ) {
														$wtsmb_status = 'queued';
													} else if($cur_date > $wtsmb_date_available && $cur_date < $wtsmb_expires_date ) {
														$wtsmb_status = 'running';
													}
												?>
												<span class="item-status"><span class="<?php echo $wtsmb_status; ?> item"><?php echo $wtsmb_status_ar[$wtsmb_status]; ?></span></span>
											</td>
											
											<td class="dataTableContent text-right"><?php echo $banner['wtsmb_sort_order']; ?></td>
											<td class="dataTableContent text-right">
												<?php /*<a href="<?php echo zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER_BANNER_STATISTICS, 'wtsmb_page=' . $_GET['wtsmb_page'] . '&wtsmbID=' . $banner['wtsmb_id']); ?>"><?php echo zen_image(DIR_WS_ICONS . 'statistics.gif', ICON_STATISTICS); ?></a>*/?>
												<?php
													if (isset($bInfo) && is_object($bInfo) && ($banner['wtsmb_id'] == $bInfo->wtsmb_id)) {
														echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
														} else {
														echo '<a href="' . zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'wtsmb_page=' . $_GET['wtsmb_page'] . '&wtsmbID=' . $banner['wtsmb_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
													}
												?>
											</td>
										</tr>
										<?php
										}
								}else{ ?>
									<tr id="defaultSelected" class="dataTableRowSelected">
										<td colspan="10"><?php echo TEXT_RECORDS_DOES_NOT_EXIST; ?></td>
									</tr>
								<?php }  ?>
							</tbody>
						</table>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 configurationColumnRight">
						<?php
							$heading = array();
							$contents = array();
							switch ($action) {
								case 'delete': // deprecated
								case 'wtsmb-del':
									$heading[] = array('text' => '<h4>' . $bInfo->wtsmb_title . '</h4>');
									
									$contents = array('form' => zen_draw_form('wtsmb_del', FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&action=deleteconfirm') . zen_draw_hidden_field('wtsmID', $bInfo->wtsm_id).
									zen_draw_hidden_field('wtsmbID', $bInfo->wtsmb_id)
									);
									$contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
									$contents[] = array('text' => '<br><b>' . $bInfo->wtsmb_title . '</b>');
									if ($bInfo->wtsmb_image) {
										$contents[] = array('text' => '<br>' . zen_draw_checkbox_field('delete_image', 'on', true) . ' ' . TEXT_INFO_DELETE_IMAGE);
									}
									$contents[] = array('align' => 'center', 'text' => '<br><button type="submit" class="btn btn-danger">' . IMAGE_DELETE . '</button> <a href="' . zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&wtsmbID=' . $_GET['wtsmbID']) . '" class="btn btn-default" role="button">' . IMAGE_CANCEL . '</a>');
									break;
									default:
									if (is_object($bInfo)) {
										$heading[] = array('text' => '<h4>' . $bInfo->wtsmb_title . '</h4>');
										
										$contents[] = array('align' => 'text-center', 'text' => '<a href="' . zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page']. '&wtsmID=' . $bInfo->wtsm_id.'&wtsmb_page=' . $_GET['wtsmb_page'] . '&wtsmbID=' . $bInfo->wtsmb_id . '&action=wtsmb-new') . '" class="btn btn-primary" role="button">' . IMAGE_EDIT . '</a> <a href="' . zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page']. '&wtsmID=' . $bInfo->wtsm_id.'&wtsmb_page=' . $_GET['wtsmb_page'] . '&wtsmbID=' . $bInfo->wtsmb_id . '&action=wtsmb-del') . '" class="btn btn-warning" role="button">' . IMAGE_DELETE . '</a>');
										$contents[] = array('text' => '<br>' . TEXT_BANNERS_DATE_ADDED . ' ' . zen_date_short($bInfo->wtsmb_date_added));
										/*$contents[] = array('text-center', 'text' => '<br>' . '<a href="' . zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page']. '&wtsmID=' . $bInfo->wtsm_id.'&wtsmb_page=' . $_GET['wtsmb_page'] . '&wtsmbID=' . $bInfo->wtsmb_id. '&action=wtsmb-view') . '" class="btn btn-default" role="button">' . IMAGE_UPDATE . '</a>');
										
										$banner_id = $bInfo->wtsmb_id;
										$days = 3;
										$stats = wtsm_data_recent($banner_id, $days);
										$data = array(array('label' => TEXT_BANNERS_BANNER_VIEWS, 'data' => $stats[0], 'bars' => array('order' => 1)), array('label' => TEXT_BANNERS_BANNER_CLICKS, 'data' => $stats[1], 'bars' => array('order' => 2)));
										$settings = array(
										'series' => array(
										'bars' => array(
										'show' => 'true',
										'barWidth' => 0.4,
										'align' => 'center'),
										'lines, points' => array(
										'show' => 'false'),),
										'xaxis' => array(
										'tickDecimals' => 0,
										'ticks' => sizeof($stats[0]),
										'tickLength' => 0),
										'yaxis' => array('tickLength' => 0),
										'colors' => array('blue', 'red'),
										);
										$opts = json_encode($settings);
										$contents[] = array(
										'align' => 'center',
										'text' => '<br>' .
										'<div id="banner-infobox" style="width:200px;height:220px;"></div>' .
										'<div class="flot-x-axis">' .
										'<div class="flot-tick-label">' . sprintf(TEXT_BANNERS_LAST_3_DAYS) . '</div>' .
										'</div>' .
										'<script>' .
										'var data = ' . json_encode($data) . ' ;' .
										'var options = ' . $opts . ' ;' .
										'var plot = $("#banner-infobox").plot(data, options).data("plot");' .
										'</script>'); */
										
										if ($bInfo->date_scheduled) {
											$contents[] = array('text' => '<br>' . sprintf(TEXT_BANNERS_SCHEDULED_AT_DATE, zen_date_short($bInfo->date_scheduled)));
										}
										
										if ($bInfo->expires_date) {
											$contents[] = array('text' => '<br>' . sprintf(TEXT_BANNERS_EXPIRES_AT_DATE, zen_date_short($bInfo->expires_date)));
											} elseif ($bInfo->expires_impressions) {
											$contents[] = array('text' => '<br>' . sprintf(TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS, $bInfo->expires_impressions));
										}
										
										if ($bInfo->date_status_change) {
											$contents[] = array('text' => '<br>' . sprintf(TEXT_BANNERS_STATUS_CHANGE, zen_date_short($bInfo->date_status_change)));
										}
								}
								break;
							}
							
							if ((zen_not_null($heading)) && (zen_not_null($contents))) {
								$box = new box;
								echo $box->infoBox($heading, $contents);
							}
						?>
					</div>
				</div>
				<div class="row">
					<table class="table">
						<tr>
							<td><?php echo $wtsmb_split->display_count($wtsmb_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_BANNERS); ?></td>
							<td class="text-right"><?php echo $wtsmb_split->display_links($wtsmb_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
						</tr>
						<tr>
							<td class="text-right" colspan="2"><a href="<?php echo zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&wtsmID=' . (int)$_GET['wtsmID'].'&action=wtsmb-new'); ?>" class="btn btn-primary" role="button"><?php echo IMAGE_NEW_BANNER; ?></a>&nbsp;&nbsp;<a href="<?php echo zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&wtsmID=' . (int)$_GET['wtsmID']); ?>" class="btn btn-primary" role="button"><?php echo TEXT_BACK_SLIDESHOW; ?></a></td>
						</tr>
					</table>
				</div>
			<?php } else { ?>
				<div class="row">
					<table class="table">
						<tr>
							<td><?php echo ERROR_SELECTED_SLIDER_IS_NOT_VALID; ?></td>
						</tr>
						<tr>
							<td class="text-right" colspan="2"><a href="<?php echo zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page']); ?>" class="btn btn-primary" role="button"><?php echo TEXT_BACK_BUTTON; ?></a></td>
						</tr>
					</table>
			
			<?php } ?>
			<?php /*********************************************** Slide List *************************************************/ ?>
			<?php } else { ?>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 configurationColumnLeft">
					<table class="table table-hover">
						<thead>
							<tr class="dataTableHeadingRow">
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDER_ID; ?></th>
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDER_NAME; ?></th>
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDER_FULL_SCREEN; ?></th>
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDER_WIDTH; ?></th>
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDER_HEIGHT; ?></th>
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDER_INFINITE; ?></th>
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDER_ON_HOVER_STOP; ?></th>
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDER_CONTROLS; ?></th>
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDER_PAGER; ?></th>
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDER_AUTO_PLAY; ?></th>
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDER_AUTO_PLAY_INTERVAL_TIME; ?></th>
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDER_SLIDE_SPEED; ?></th>
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDER_SLIDE_ANIMATION; ?></th>
								<th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_DATE_ADDED; ?></th>
								<th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_STATUS; ?></th>
								<th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_ACTION; ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$wtsm_query_raw = "SELECT *                                             
                                        FROM " . TABLE_WT_SLIDESHOW_MANAGER . "
                                        ORDER BY wtsm_id";
								// Split Page
								// reset page when page is unknown
								if ((empty($_GET['page']) || $_GET['page'] == '1') && !empty($_GET['wtsmID'])) {
									$check_page = $db->Execute( $wtsm_query_raw );
									$check_count = 1;
									if ($check_page->RecordCount() > MAX_DISPLAY_SEARCH_RESULTS) {
										foreach ($check_page as $item) {
											if ( $item['wtsm_id'] == $_GET['wtsmID'] ) {
												break;
											}
											$check_count++;
										}
										$_GET['page'] = round((($check_count / MAX_DISPLAY_SEARCH_RESULTS) + (fmod_round($check_count, MAX_DISPLAY_SEARCH_RESULTS) != 0 ? .5 : 0)), 0);
										} else {
										$_GET['page'] = 1;
									}
								}
								$wtsm_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $wtsm_query_raw, $wtsm_query_numrows);
								$sliders = $db->Execute( $wtsm_query_raw );
								if ( $sliders->RecordCount() > 0 ) {
									foreach ( $sliders as $slider ) {
										if ( ( !isset($_GET['wtsmID'] ) || (isset($_GET['wtsmID']) && ($_GET['wtsmID'] == $slider['wtsm_id'])) ) && !isset( $bInfo ) && ( substr($action, 0, 3) != 'wtsm-new' ) ) {
											$bInfo = new objectInfo($slider);
										}
										
										if (isset($bInfo) && is_object($bInfo) && ($slider['wtsm_id'] == $bInfo->wtsm_id)) {
										?>
										<tr id="defaultSelected" class="dataTableRowSelected" onclick="document.location.href = '<?php echo zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&wtsmID=' . $bInfo->wtsm_id); ?>'" role="button">
										<?php } else { ?>
										<tr class="dataTableRow" onclick="document.location.href = '<?php echo zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&wtsmID=' . $slider['wtsm_id']); ?>'" role="button">
										<?php }	?>
											<td class="dataTableContent"><?php echo $slider['wtsm_id']; ?></td>
											<td class="dataTableContent"><?php echo $slider['wtsm_title']; ?></td>
											<td class="dataTableContent text-center"><?php echo ( $slider['wtsm_full_screen'] ) ? TEXT_YES : TEXT_NO; ?></td>
											<td class="dataTableContent text-center"><?php echo wtsm_get_width_text( $slider['wtsm_width'] ); ?></td>
											<td class="dataTableContent text-center"><?php echo wtsm_get_height_text( $slider['wtsm_height'] ); ?></td>
											<td class="dataTableContent text-center"><?php echo ( $slider['wtsm_infinite'] ) ? TEXT_YES : TEXT_NO; ?></td>
											<td class="dataTableContent text-center"><?php echo ( $slider['wtsm_on_hover'] ) ? TEXT_YES : TEXT_NO; ?></td>
											<td class="dataTableContent text-center"><?php echo ( $slider['wtsm_controls'] ) ? TEXT_YES : TEXT_NO; ?></td>
											<td class="dataTableContent text-center"><?php echo ( $slider['wtsm_pager'] ) ? TEXT_YES : TEXT_NO; ?></td>
											<td class="dataTableContent text-center"><?php echo ( $slider['wtsm_autoplay'] ) ? TEXT_YES : TEXT_NO; ?></td>
											<td class="dataTableContent text-center"><?php echo $slider['wtsm_interval_time']; ?></td>
											<td class="dataTableContent text-center"><?php echo $slider['wtsm_slide_speed']; ?></td>
											<td class="dataTableContent text-center"><?php echo $slider['wtsm_slide_animation']; ?></td>
											<td class="dataTableContent text-right"><?php echo $slider['wtsm_date_added']; ?></td>
											<td class="dataTableContent text-center">
												<?php if ($slider['wtsm_status'] == '1') { ?>
													<a href="<?php echo zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&wtsmID=' . $slider['wtsm_id'] . '&action=setflag&flag=0'); ?>"><?php echo zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON); ?></a>
													<?php } else { ?>
													<a href="<?php echo zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&wtsmID=' . $slider['wtsm_id'] . '&action=setflag&flag=1'); ?>"><?php echo zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF); ?></a>
												<?php } ?>
											</td>
											<td class="dataTableContent text-right">
												<?php
													if (isset($bInfo) && is_object($bInfo) && ($slider['wtsm_id'] == $bInfo->wtsm_id)) {
														echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
														} else {
														echo '<a href="' . zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&wtsmID=' . $slider['wtsm_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
													}
												?>
											</td>
										</tr>
										<?php
										}
								} else { ?>
									<tr id="defaultSelected" class="dataTableRowSelected">
										<td colspan="10"><?php echo TEXT_RECORDS_DOES_NOT_EXIST; ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 configurationColumnRight">
						<?php
							$heading = array();
							$contents = array();
							switch ($action) {
								case 'delete': // deprecated
								case 'wtsm-del':
									$heading[] = array('text' => '<h4>' . $bInfo->wtsm_title . '</h4>');
									
									$contents = array('form' => zen_draw_form('wtsm_del', FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&action=deleteconfirm') . zen_draw_hidden_field('wtsmID', $bInfo->wtsm_id));
									$contents[] = array('text' => TEXT_SLIDER_INFO_DELETE_INTRO);
									$contents[] = array('text' => '<br><b>' . $bInfo->wtsm_title . '</b>');
									$contents[] = array('align' => 'center', 'text' => '<br><button type="submit" class="btn btn-danger">' . IMAGE_DELETE . '</button> <a href="' . zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&wtsmID=' . $_GET['wtsmID']) . '" class="btn btn-default" role="button">' . IMAGE_CANCEL . '</a>');
									break;
								default:
								if (is_object($bInfo)) {
									$heading[] = array('text' => '<h4>' . $bInfo->wtsm_title . '</h4>');
									
									$contents[] = array('align' => 'text-center', 'text' => '
									<a href="' . zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&wtsmID=' . $bInfo->wtsm_id . '&action=wtsm-new') . '" class="btn btn-primary" role="button">' . IMAGE_EDIT . '</a> 
									<a href="' . zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&wtsmID=' . $bInfo->wtsm_id . '&action=wtsm-del') . '" class="btn btn-warning" role="button">' . IMAGE_DELETE . '</a><br/><br/>
									<a href="' . zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'page=' . $_GET['page'] . '&wtsmID=' . $bInfo->wtsm_id . '&action=wtsmb-view') . '" class="btn btn-primary" role="button">' . IMAGE_VIEW_BANNER . '</a>
									');
									$contents[] = array('text' => '<br>' . TEXT_BANNERS_DATE_ADDED . ' ' . zen_date_short($bInfo->wtsm_date_added));
									$contents[] = array('text' => '<br><strong>' . TEXT_SLIDER_FULL_SCREEN . '</strong> ' . ( ( $bInfo->wtsm_full_screen ) ? TEXT_YES : TEXT_NO ) );
									$contents[] = array('text' => '<strong>' . TEXT_SLIDER_WIDTH . '</strong> ' . $bInfo->wtsm_width );
									$contents[] = array('text' => '<strong>' . TEXT_SLIDER_HEIGHT . '</strong> ' . $bInfo->wtsm_height );
									$contents[] = array('text' => '<strong>' . TEXT_SLIDER_INFINITE . '</strong> ' . ( ( $bInfo->wtsm_infinite ) ? TEXT_YES : TEXT_NO ) );
									$contents[] = array('text' => '<strong>' . TEXT_SLIDER_ON_HOVER . '</strong> ' . ( ( $bInfo->wtsm_on_hover ) ? TEXT_YES : TEXT_NO ) );
									$contents[] = array('text' => '<strong>' . TEXT_SLIDER_CONTROLS . '</strong> ' . ( ( $bInfo->wtsm_controls ) ? TEXT_YES : TEXT_NO ) );
									$contents[] = array('text' => '<strong>' . TEXT_SLIDER_PAGER . '</strong> ' . ( ( $bInfo->wtsm_pager ) ? TEXT_YES : TEXT_NO ) );
									$contents[] = array('text' => '<strong>' . TEXT_SLIDER_AUTO_PLAY . '</strong> ' . ( ( $bInfo->wtsm_autoplay ) ? TEXT_YES : TEXT_NO ) );
									$contents[] = array('text' => '<strong>' . TEXT_SLIDER_AUTO_PLAY_INTERVAL_TIME . '</strong> ' . $bInfo->wtsm_interval_time );
									$contents[] = array('text' => '<strong>' . TEXT_SLIDER_SLIDE_SPEED . '</strong> ' . $bInfo->wtsm_slide_speed );
									$contents[] = array('text' => '<strong>' . TEXT_SLIDER_ANIMATION . '</strong> ' . $bInfo->wtsm_slide_animation );
									
									/*$short_code_ar = array( 'id' => $bInfo->wtsm_id, 
									'full_screen' => $bInfo->wtsm_full_screen,
									'width' => $bInfo->wtsm_width,
									'height' => $bInfo->wtsm_height,
									'on_hover' => $bInfo->wtsm_on_hover,
									'controls' => $bInfo->wtsm_controls,
									'pager' => $bInfo->wtsm_pager,
									'autoplay' => $bInfo->autoplay,
									'interval_time' => $bInfo->wtsm_interval_time,
									'slide_speed' => $bInfo->wtsm_slide_speed,
									'slide_animation' => $bInfo->wtsm_slide_animation,
									);*/
									
									$contents[] = array('text' => '<div style="background:#ff000021;"><hr style="border-color:red;margin:0;"><h4 class="text-center">'.TEXT_EMBED_SLIDESHOW.'</h4><hr style="border-color:red;margin:0;"></div>');
									$contents[] = array('text' => '<br>' . TEXT_HOMEPAGE_SHORT_CODE . '  :  ' . '<code style="font-size:15px;">[wtsm_slideshow ID="'.$bInfo->wtsm_id.'"]</code>');
									$contents[] = array('text' => '<br>' . TEXT_OTHERPAGE_SHORT_CODE . '  :  ' . '<code style="font-size:15px;">&lt;?php echo wt_slideshow_manager("'.$bInfo->wtsm_id.'"); ?></code>');
									$contents[] = array('text' => '<hr style="border-color:red">');
									
									
									$wtsm_id = $bInfo->wtsm_id;
									
									if ($bInfo->date_scheduled) {
										$contents[] = array('text' => '<br>' . sprintf(TEXT_BANNERS_SCHEDULED_AT_DATE, zen_date_short($bInfo->date_scheduled)));
									}
									
									if ($bInfo->expires_date) {
										$contents[] = array('text' => '<br>' . sprintf(TEXT_BANNERS_EXPIRES_AT_DATE, zen_date_short($bInfo->expires_date)));
										} elseif ($bInfo->expires_impressions) {
										$contents[] = array('text' => '<br>' . sprintf(TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS, $bInfo->expires_impressions));
									}
									
									if ($bInfo->date_status_change) {
										$contents[] = array('text' => '<br>' . sprintf(TEXT_BANNERS_STATUS_CHANGE, zen_date_short($bInfo->date_status_change)));
									}
								}
								break;
							}
							
							if ((zen_not_null($heading)) && (zen_not_null($contents))) {
								$box = new box;
								echo $box->infoBox($heading, $contents);
							}
						?>
					</div>
				</div>
				<div class="row">
					<table class="table">
						<tr>
							<td><?php echo $wtsm_split->display_count($wtsm_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_BANNERS); ?></td>
							<td class="text-right"><?php echo $wtsm_split->display_links($wtsm_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
						</tr>
						<tr>
							<td class="text-right" colspan="2"><a href="<?php echo zen_href_link(FILENAME_WT_SLIDESHOW_MANAGER, 'action=wtsm-new'); ?>" class="btn btn-primary" role="button"><?php echo IMAGE_NEW_SLIDER; ?></a></td>
						</tr>
					</table>
				</div>
				<?php } ?>
			
			<!-- body_text_eof //-->
		</div>
		<!-- body_eof //-->
		
		<!-- footer //-->
		<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
		<!-- footer_eof //-->
		<script src="includes/<?php echo WT_SLIDESHOW_MANAGER_INCLUDES; ?>/js/script.js"></script>
		<script src="includes/<?php echo WT_SLIDESHOW_MANAGER_INCLUDES ?>/js/mcColorPicker.js" type="text/javascript"></script>
	</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
