<?php
/**
	* WT Neoncart Banner Manager for Zen Cart.
	* WARNING: Do not change this file. Your changes will be lost.
	*
	* @copyright 2021 WT Tech. Designs.
	* Version : WT Neoncart Banner Manager 1.2.0
*/
require('includes/application_top.php');
require('includes/functions/wt_neoncart_banner_manager_graphs.php');
$languages = zen_get_languages();

function wtwbm_data_recent($wtwbmb_id, $days) {
    global $db;
    $set1 = $set2 = $stats = array();

    $result = $db->Execute("select dayofmonth(wtwbmbh_history_date) as source,
                                       wtwbmbh_shown as impressions, wtwbmbh_clicked as clicks
                     from " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_HISTORY . "
                     where wtwbmb_id = '" . (int)$wtwbmb_id . "'
                     and to_days(now()) - to_days(wtwbmbh_history_date) < " . zen_db_input($days) . "
                     order by wtwbmbh_history_date");

    while (!$result->EOF) {
      $set1[] = array($result->fields['source'], $result->fields['impressions']);
      $set2[] = array($result->fields['source'], $result->fields['clicks']);
      $stats[] = array($result->fields['source'], $result->fields['impressions'], $result->fields['clicks']);
      $result->MoveNext();
    }
    if (sizeof($set1) < 1) $set1 = $set2 = array(array(date('j'), 0));

    return array($set1, $set2, $stats);
}

$template_query = $db->Execute("select template_dir from " . TABLE_TEMPLATE_SELECT . " where template_language in (" . (int)$_SESSION['languages_id'] . ', 0' . ") order by template_language DESC");
$template_dir = $template_query->fields['template_dir'];

$action = (isset($_GET['action']) ? $_GET['action'] : '');
if (isset($_GET['flagbanners_on_ssl'])) {
	$_GET['flagbanners_on_ssl'] = (int)$_GET['flagbanners_on_ssl'];
}
if (isset($_GET['wtwbmID'])) {
	$_GET['wtwbmID'] = (int)$_GET['wtwbmID'];
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

$wtwbmb_image_dir_name = WT_NEONCART_BANNER_MANAGER_IMAGES;
$wtwbmb_image_target = DIR_FS_CATALOG_IMAGES . $wtwbmb_image_dir_name . '/';

if (zen_not_null($action)) {
	switch ($action) {
		case 'setflag':
		if (($_GET['flag'] == '0') || ($_GET['flag'] == '1')) {
			if((isset($_GET['wtwbmID']) && $_GET['wtwbmID']!='') && (!(isset($_GET['wtwbmbID']) && $_GET['wtwbmbID']!=''))){
				global $db;
				$sql = "update " . TABLE_WT_NEONCART_BANNER_MANAGER;
				$sql .= ($_GET['flag'] == '1') ? " set wtwbm_status = 1" : " set wtwbm_status = 0";
				$sql .= " where wtwbm_id = '" . (int)$_GET['wtwbmID'] . "'";
				$db->Execute($sql);
				$messageStack->add_session(SUCCESS_SLIDER_STATUS_UPDATED, 'success');
				zen_redirect(zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page']));
			} else if((isset($_GET['wtwbmID']) && $_GET['wtwbmID']!='') && (isset($_GET['wtwbmbID']) && $_GET['wtwbmbID']!='')){
				global $db;
				$sql = "update " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS;
				$sql .= ($_GET['flag'] == '1') ? " set wtwbmb_status = 1" : " set wtwbmb_status = 0";
				$sql .= ", wtwbmb_date_status_change = now() where wtwbmb_id = '" . (int)$_GET['wtwbmbID'] . "'";
				$db->Execute($sql);
				$messageStack->add_session(SUCCESS_BANNER_STATUS_UPDATED, 'success');
				zen_redirect(zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&wtwbmID=' . $_GET['wtwbmID'] . '&wtwbmb_page=' . $_GET['wtwbmb_page'] . '&wtwbmbID='.$_GET['wtwbmbID'].'&action=wtwbmb-view'));
			}			
		} else {
			$messageStack->add_session(ERROR_UNKNOWN_STATUS_FLAG, 'error');
		}
		break;
		case 'wtwbm-add':
		case 'wtwbm-upd':
			if (isset($_POST['wtwbm_id'])) {
				$wtwbm_id = zen_db_prepare_input($_POST['wtwbm_id']);
			}
			$wtwbm_title = zen_db_prepare_input($_POST['wtwbm_title']);
			$wtwbm_type = zen_db_prepare_input($_POST['wtwbm_type']);
			$wtwbm_status = zen_db_prepare_input($_POST['wtwbm_status']);
			
			$wtwbm_error = false;
			if (empty($wtwbm_title)) {
				$messageStack->add(ERROR_SLIDER_TITLE_REQUIRED, 'error');
				$wtwbm_error = true;
			}
			
			if (empty($wtwbm_type)) {
				$messageStack->add(ERROR_SLIDER_TYPE_REQUIRED, 'error');
				$wtwbm_error = true;
			}
			
			if ($wtwbm_error == false) {
				$sql_data_array = array(
					'wtwbm_title' => $wtwbm_title,
					'wtwbm_type' => $wtwbm_type,
					'wtwbm_status' => $wtwbm_status,
					'wtwbm_updated_at' => 'now()',
				);
					
				if ($action == 'wtwbm-add') {
					$insert_sql_data = array('wtwbm_date_added' => 'now()');
					$sql_data_array = array_merge($sql_data_array, $insert_sql_data);
						
					zen_db_perform(TABLE_WT_NEONCART_BANNER_MANAGER, $sql_data_array);
						
					$wtwbm_id = zen_db_insert_id();
					$messageStack->add_session(SUCCESS_SLIDER_INSERTED, 'success');
					
				} elseif ($action == 'wtwbm-upd') {
					zen_db_perform(TABLE_WT_NEONCART_BANNER_MANAGER, $sql_data_array, 'update', "wtwbm_id = '" . (int)$wtwbm_id . "'");
					$messageStack->add_session(SUCCESS_SLIDER_UPDATED, 'success');
				}
				
				zen_redirect(zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'wtwbmID=' . $wtwbm_id));
			} else {
				$action = 'wtwbm-new';
			}
			break;
		case 'wtwbmb-add':
		case 'wtwbmb-upd':
			if (isset($_POST['wtwbmb_id'])) {
				$wtwbmb_id = zen_db_prepare_input($_POST['wtwbmb_id']);
			}
			$wtwbm_id = zen_db_prepare_input($_POST['wtwbm_id']);
			$wtwbmbc_title_ar = ($_POST['wtwbmbc_title']);
			$wtwbmb_url = zen_db_prepare_input($_POST['wtwbmb_url']);
			$wtwbmb_image = zen_db_prepare_input($_FILES['wtwbmb_image']['name']);
			$wtwbmbc_content_ar = ($_POST['wtwbmbc_content']);
			$wtwbmb_sort_order = zen_db_prepare_input($_POST['wtwbmb_sort_order']);
			$wtwbmb_status = zen_db_prepare_input($_POST['wtwbmb_status']);
			$wtwbmb_expires_date = zen_db_prepare_input($_POST['wtwbmb_expires_date']) == '' ? 'null' : zen_date_raw($_POST['wtwbmb_expires_date']);
			$wtwbmb_expires_impressions = zen_db_prepare_input($_POST['wtwbmb_expires_impressions']);
			$wtwbmb_date_scheduled = zen_db_prepare_input($_POST['wtwbmb_date_scheduled']) == '' ? 'null' : zen_date_raw($_POST['wtwbmb_date_scheduled']);
			
			$wtwbmb_error = false;
			if (empty($wtwbm_id)) {
				$messageStack->add(ERROR_BANNER_SLIDER_REQUIRED, 'error');
				$wtwbmb_error = true;
			}
			if (empty($wtwbmbc_title_ar)) {
				$messageStack->add(ERROR_BANNER_TITLE_REQUIRED, 'error');
				$wtwbmb_error = true;
			}
						
			if($wtwbmb_image){
				$wtwbmb_image = new upload('wtwbmb_image');
				$wtwbmb_image->set_extensions(array('jpg', 'jpeg', 'gif', 'png', 'webp', 'flv', 'webm', 'ogg'));
				$wtwbmb_image->set_destination($wtwbmb_image_target);
				if (($wtwbmb_image->parse() == false) || ($wtwbmb_image->save() == false)) {
					$messageStack->add(ERROR_BANNER_IMAGE_REQUIRED, 'error');
					$wtwbmb_error = true;
				}
			}
			
			
			if ($wtwbmb_error == false) {
			
				
				//$db_image_location = zen_limit_image_filename($db_image_location, TABLE_WT_NEONCART_BANNER_MANAGER, 'wtwbmb_image');
				//$wtwbmb_url = zen_limit_image_filename($wtwbmb_url, TABLE_WT_NEONCART_BANNER_MANAGER, 'wtwbmb_url');
				
				$sql_data_array = array(
					'wtwbm_id' => $wtwbm_id,
					'wtwbmb_url' => $wtwbmb_url,
					'wtwbmb_sort_order' => $wtwbmb_sort_order,
					'wtwbmb_status' => $wtwbmb_status,
					'wtwbmb_updated_at' => 'now()',
				);
				
				if( !empty( $wtwbmb_image->filename ) ){
					$db_image_location = $wtwbmb_image_dir_name.'/'.$wtwbmb_image->filename;
					$sql_data_array['wtwbmb_image'] = $db_image_location;
				}
				
					
				if ($action == 'wtwbmb-add') {
					$insert_sql_data = array('wtwbmb_date_added' => 'now()');
					$sql_data_array = array_merge($sql_data_array, $insert_sql_data);
						
					zen_db_perform(TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS, $sql_data_array);
						
					$wtwbmb_id = zen_db_insert_id();
					$messageStack->add_session(SUCCESS_BANNER_INSERTED, 'success');
					
				} elseif ($action == 'wtwbmb-upd') {
					zen_db_perform(TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS, $sql_data_array, 'update', "wtwbmb_id = '" . (int)$wtwbmb_id . "'");
					$messageStack->add_session(SUCCESS_BANNER_UPDATED, 'success');
				}
				
				for ( $i = 0, $n = sizeof( $languages ); $i < $n; $i++ ) {
					$language_id = $languages[$i]['id'];
					$sql_data_array = array( 'wtwbmbc_title' => zen_db_prepare_input( $wtwbmbc_title_ar[$language_id] ), 'wtwbmbc_content' => zen_db_prepare_input( $wtwbmbc_content_ar[$language_id] ) );
					$ban_cont = $db->Execute( "select * from " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_CONTENT . " where wtwbmb_id = '" . (int)$wtwbmb_id . "' and languages_id = '" . (int)$language_id . "'"  );
					if ( $action == 'wtwbmb-upd' && $ban_cont->RecordCount() > 0 ) {
						zen_db_perform( TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_CONTENT, $sql_data_array, 'update', "wtwbmb_id = " . (int)$wtwbmb_id . " and languages_id = " . (int)$language_id );
					} else {
						$insert_sql_data = array(
							'wtwbmb_id' => $wtwbmb_id,
							'languages_id' => $language_id
						);
						$sql_data_array = array_merge( $sql_data_array, $insert_sql_data );
						zen_db_perform( TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_CONTENT, $sql_data_array );
					}
				}
				
				// NOTE: status will be reset by the /functions/banner.php
				// build new update sql for date_scheduled, expires_date and expires_impressions
					
				$sql = "UPDATE " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS . "
				SET wtwbmb_date_scheduled = DATE_ADD(:scheduledDate, INTERVAL '00:00:00' HOUR_SECOND),
				wtwbmb_expires_date = DATE_ADD(:expiresDate, INTERVAL '23:59:59' HOUR_SECOND),
				wtwbmb_expires_impressions = " . ($wtwbmb_expires_impressions == 0 ? "null" : ":expiresImpressions") . "
				WHERE wtwbmb_id = :wtwbmbID";
				$sql = $db->bindVars($sql, ':expiresImpressions', $wtwbmb_expires_impressions, 'integer');
				$sql = $db->bindVars($sql, ':scheduledDate', $wtwbmb_date_scheduled, 'date');
				$sql = $db->bindVars($sql, ':expiresDate', $wtwbmb_expires_date, 'date');
				$sql = $db->bindVars($sql, ':wtwbmbID', $wtwbmb_id, 'integer');
				$db->Execute($sql);
					
				zen_redirect(zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] : '') . '&wtwbmID=' . $wtwbm_id . (isset($_GET['wtwbmb_page']) ? 'wtwbmb_page=' . $_GET['wtwbmb_page'] : '') .'&wtwbmbID=' . $wtwbmb_id . '&action=wtwbmb-view'));
			} else {
				$action = 'wtwbmb-new';
			}
			break;
		case 'deleteconfirm':
			if((isset($_POST['wtwbmID']) && $_POST['wtwbmID']!='') && (isset($_POST['wtwbmbID']) && $_POST['wtwbmbID']!='')){
				$wtwbmID = zen_db_prepare_input($_POST['wtwbmID']);
				$wtwbmbID = zen_db_prepare_input($_POST['wtwbmbID']);

				if (isset($_POST['delete_image']) && ($_POST['delete_image'] == 'on')) {
					$banner = $db->Execute("SELECT wtwbmb_image
					FROM " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS . "
					WHERE wtwbmb_id = " . (int)$wtwbmbID);
					if (is_file(DIR_FS_CATALOG_IMAGES . $banner->fields['wtwbmb_image'])) {
						if (is_writeable(DIR_FS_CATALOG_IMAGES . $banner->fields['wtwbmb_image'])) {
								unlink(DIR_FS_CATALOG_IMAGES . $banner->fields['wtwbmb_image']);
							} else {
								$messageStack->add_session(ERROR_IMAGE_IS_NOT_WRITEABLE, 'error');
							}
						} else {
							$messageStack->add_session(ERROR_IMAGE_DOES_NOT_EXIST, 'error');
						}
				}
				
				$db->Execute("DELETE FROM " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS . " WHERE wtwbmb_id = " . (int)$_POST['wtwbmbID']);
				$db->Execute("DELETE FROM " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_HISTORY . " WHERE wtwbmb_id = " . (int)$_POST['wtwbmbID']);
				$messageStack->add_session(SUCCESS_BANNER_REMOVED, 'success');
				zen_redirect(zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] : '') . '&wtwbmID=' . $wtwbmID . (isset($_GET['wtwbmb_page']) ? 'wtwbmb_page=' . $_GET['wtwbmb_page'] : '') .'&action=wtwbmb-view'));
				
			} else if((isset($_POST['wtwbmID']) && $_POST['wtwbmID']!='') && (!(isset($_POST['wtwbmbID']) && $_POST['wtwbmbID']!=''))){
					$wtwbmID = zen_db_prepare_input($_POST['wtwbmID']);
					$banners = $db->Execute("SELECT wtwbmb_image	FROM " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS . " WHERE wtwbm_id = " . (int)$wtwbmID);
					foreach($banners as $banner){
						if (is_file(DIR_FS_CATALOG_IMAGES . $banner->fields['wtwbmb_image'])) {
							if (is_writeable(DIR_FS_CATALOG_IMAGES . $banner->fields['wtwbmb_image'])) {
								unlink(DIR_FS_CATALOG_IMAGES . $banner->fields['wtwbmb_image']);
							} else {
								$messageStack->add_session(ERROR_IMAGE_IS_NOT_WRITEABLE, 'error');
							}
						} else {
							$messageStack->add_session(ERROR_IMAGE_DOES_NOT_EXIST, 'error');
						}
					}
					
				$db->Execute("DELETE FROM " . TABLE_WT_NEONCART_BANNER_MANAGER . " WHERE wtwbm_id = " . (int)$wtwbmID);
				$db->Execute("DELETE FROM " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS . " WHERE wtwbm_id = " . (int)$wtwbmID);
				$db->Execute("DELETE wtwbmbh FROM " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_HISTORY . " wtwbmbh LEFT JOIN " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS . " wtwbmb on wtwbmbh.wtwbmb_id = wtwbmb.wtwbmb_id WHERE wtwbmb.wtwbm_id = " . (int)$wtwbmID);
				$messageStack->add_session(SUCCESS_SLIDER_REMOVED, 'success');
				zen_redirect(zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] : '') . '&wtwbmID=' . $wtwbmID)); 
			
			}
			break;
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
	<link rel="stylesheet" href="includes/banner_tools.css" />
	<?php /*<link rel="stylesheet" type="text/css" href="includes/<?php echo WT_NEONCART_BANNER_MANAGER_INCLUDES; ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="includes/<?php echo WT_NEONCART_BANNER_MANAGER_INCLUDES; ?>/css/select2.min.css">*/?>
	<link rel="stylesheet" type="text/css" href="includes/<?php echo WT_NEONCART_BANNER_MANAGER_INCLUDES; ?>/css/wtwbm_style.css">
	<script src="includes/menu.js"></script>
	<script src="includes/general.js"></script>
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
	<script src="includes/javascript/flot/jquery.flot.min.js"></script>
	<script src="includes/javascript/flot/jquery.flot.orderbars.js"></script>
	
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
		<?php /***********************************************SLIDER FORM*************************************************/?>
		<?php
			if ($action == 'wtwbm-new') {
				$form_action = 'wtwbm-add';
				
				$parameters = array(
				'wtwbm_title' => '',
				'wtwbm_type' => 'hm1-s1',
				'wtwbm_expires_impressions' => '',
				'wtwbm_status' => '1');
				
				$bInfo = new objectInfo($parameters);
				
				if (isset($_GET['wtwbmID'])) {
					$form_action = 'wtwbm-upd';
					
					$wtwbmID = zen_db_prepare_input($_GET['wtwbmID']);
					
					$banner = $db->Execute("SELECT wtwbm_title, wtwbm_type, wtwbm_status
					FROM " . TABLE_WT_NEONCART_BANNER_MANAGER . "
					WHERE wtwbm_id = " . (int)$wtwbmID);
					$bInfo->updateObjectInfo($banner->fields);
				} elseif (zen_not_null($_POST)) {
					$bInfo->updateObjectInfo($_POST);
				}
				
				$groups_array = array();
				/*
				$groups = $db->Execute("SELECT DISTINCT banners_group
				FROM " . TABLE_WT_NEONCART_BANNER_MANAGER . "
				ORDER BY banners_group");
				foreach ($groups as $group) {
					$groups_array[] = array(
					'id' => $group['banners_group'],
					'text' => $group['banners_group']);
				}*/
			?>
			
			<div class="row">
				<?php
					echo zen_draw_form('wtwbm_new', FILENAME_WT_NEONCART_BANNER_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'action=' . $form_action, 'post', 'enctype="multipart/form-data" class="form-horizontal"');
					if ($form_action == 'wtwbm-upd') {
						echo zen_draw_hidden_field('wtwbm_id', $wtwbmID);
					}
				?>
				<div class="form-group">
					<?php echo zen_draw_label(TEXT_SLIDER_TITLE, 'wtwbm_title', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<?php echo zen_draw_input_field('wtwbm_title', htmlspecialchars($bInfo->wtwbm_title, ENT_COMPAT, CHARSET, TRUE), zen_set_field_length(TABLE_WT_NEONCART_BANNER_MANAGER, 'wtwbm_title') . ' class="form-control"', true); ?>
					</div>
				</div>
				<?php 
					$wtwbm_type_ar = array(
					array( 'id' => 'hm1-s1', 'text'=> 'Home - 1 Top Banners' ),
					array( 'id' => 'hm1-s6', 'text'=> 'Home - 1 Category Slider' ),
					array( 'id' => 'hm1-s2', 'text'=> 'Home - 1 Sidebar Banner' ),
					array( 'id' => 'hm1-s3', 'text'=> 'Home - 1 Middle Banners' ),
					array( 'id' => 'hm1-s4', 'text'=> 'Home - 1 Bottom Banners' ),
					array( 'id' => 'hm1-s5', 'text'=> 'Home - 1 Bottom Slider' ),
					array( 'id' => 'hm2-s1-s1', 'text'=> 'Home - 2 Top Banners Slider' ),
					array( 'id' => 'hm2-s1-s2', 'text'=> 'Home - 2 Top Banners' ),
					array( 'id' => 'hm2-s2', 'text'=> 'Home - 2 Bottom Banners' ),
					array( 'id' => 'hm3-s1', 'text'=> 'Home - 3 Top Banners' ),
					array( 'id' => 'hm3-s2', 'text'=> 'Home - 3 Top Offer Banners' ),
					array( 'id' => 'hm3-s3', 'text'=> 'Home - 3 Middle Banners' ),
					array( 'id' => 'hm3-s4', 'text'=> 'Home - 3 Botom Banners' ),
					);
					?>
				<div class="form-group">
					<?php echo zen_draw_label(TEXT_SLIDER_TYPE, 'wtwbm_type', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<?php echo zen_draw_pull_down_menu('wtwbm_type', $wtwbm_type_ar, $bInfo->wtwbm_type, 'class="form-control" id="wtwbm_type" onchange="onChangeBannerStyle(this.value);"'); ?>
					</div>
				</div>
				<script type="text/javascript">
					window.onload = (function(){onChangeBannerStyle('<?php echo $bInfo->wtwbm_type; ?>');});
					function onChangeBannerStyle(ban_style){
						var style_path = "<?php echo 'includes/'.WT_NEONCART_BANNER_MANAGER_INCLUDES.'/images/styles/'; ?>"
						var img_path = style_path + ban_style+'.png';
							document.getElementById('wtwbm-bn-img').innerHTML = '';
							document.getElementById('wtwbm-bn-img').append(img_create(img_path, ban_style, ban_style));
					}
					function img_create(src, alt, title) {
						var img = document.createElement("img");
						img.src = src;
						if ( alt != null ) img.alt = alt;
						if ( title != null ) img.title = title;
						return img;
					}
				</script>
				<style>.wtwbm-bn-img img {max-width: 100%;height: auto;}</style>
				<div class="form-group">
					<label class="col-sm-3 control-label"></label>
					<div id="wtwbm-bn-img" class="wtwbm-bn-img col-md-4"></div>
				</div>
				<div class="form-group">
					<?php echo zen_draw_label(TEXT_SLIDER_STATUS, 'wtwbm_status', 'class="col-sm-3 control-label"'); ?>
					<div class="col-sm-9 col-md-6">
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtwbm_status', '1', $bInfo->wtwbm_status == 1) . TEXT_BANNERS_ACTIVE; ?></label>
						<label class="radio-inline"><?php echo zen_draw_radio_field('wtwbm_status', '0', $bInfo->wtwbm_status == 0) . TEXT_BANNERS_NOT_ACTIVE; ?></label><br>
						<span class="help-block"><?php echo TEXT_INFO_SLIDER_STATUS; ?></span>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-12 text-right">
						<button type="submit" class="btn btn-primary"><?php echo (($form_action == 'wtwbm-add') ? IMAGE_INSERT : IMAGE_UPDATE); ?></button> <a href="<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . (isset($_GET['wtwbmID']) ? 'wtwbmID=' . $_GET['wtwbmID'] : '')); ?>" class="btn btn-default" role="button"><?php echo IMAGE_CANCEL; ?></a>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-3 col-sm-9 col-md-6">
						<?php echo TEXT_SLIDER_EXPIRCY_NOTE . '<br>' . TEXT_SLIDER_SCHEDULE_NOTE; ?>
					</div>
				</div>
				<?php echo '</form>'; ?>
			</div>
			<?php /***********************************************BANNER FORM*************************************************/?>
			<?php } else if($action == 'wtwbmb-new') { ?>
			<?php
				if(isset($_GET['wtwbmID'])){
					$form_action = 'wtwbmb-add';
					$wtwbmID = zen_db_prepare_input($_GET['wtwbmID']);
					$parameters = array(
					'wtwbmbc_title' => '',
					'wtwbmb_url' => '',
					'wtwbmb_image' => '',
					'wtwbmbc_content' => '',
					'wtwbm_expires_impressions' => '',
					'wtwbmb_expires_date' => '',
					'wtwbmb_date_scheduled' => '',
					'wtwbm_sort_order' => '',
					'wtwbm_status' => '1');
					
					$bInfo = new objectInfo($parameters);
					
					if (isset($_GET['wtwbmbID'])) {
						$form_action = 'wtwbmb-upd';
						
						$wtwbmbID = zen_db_prepare_input($_GET['wtwbmbID']);
						
						$wtwbmb_res = $db->Execute("SELECT *, 
						date_format(wtwbmb_date_scheduled, '%Y/%m/%d') as wtwbmb_date_scheduled,
						date_format(wtwbmb_expires_date, '%Y/%m/%d') as wtwbmb_expires_date,
						wtwbmb_expires_impressions
						FROM " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS . "
						WHERE wtwbmb_id = " . (int)$wtwbmbID);
						
						$bInfo->updateObjectInfo($wtwbmb_res->fields);
						
						$wtwbmbc_title = $wtwbmbc_content = array();
						$wtwbmbc_res = $db->Execute("SELECT *
						FROM " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_CONTENT . "
						WHERE wtwbmb_id = " . (int)$wtwbmbID);
						if ( $wtwbmbc_res->RecordCount() > 0 ) {
							foreach( $wtwbmbc_res as $wtwbmbc ) {
								$wtwbmbc_title[$wtwbmbc['languages_id']] = $wtwbmbc['wtwbmbc_title'];
								$wtwbmbc_content[$wtwbmbc['languages_id']] = $wtwbmbc['wtwbmbc_content'];
							}
						}
						$bInfo->wtwbmbc_title = $wtwbmbc_title;
						$bInfo->wtwbmbc_content = $wtwbmbc_content;
						
					} elseif (zen_not_null($_POST)) {
						$bInfo->updateObjectInfo($_POST);
					}
				?>
				<link rel="stylesheet" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
				<script src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
				<script>
					var dateExpires = new ctlSpiffyCalendarBox("dateExpires", "wtwbmb_banner", "wtwbmb_expires_date", "btnDate1", "<?php echo zen_date_short($bInfo->wtwbmb_expires_date); ?>", scBTNMODE_CUSTOMBLUE);
					var dateScheduled = new ctlSpiffyCalendarBox("dateScheduled", "wtwbmb_banner", "wtwbmb_date_scheduled", "btnDate2", "<?php echo zen_date_short($bInfo->wtwbmb_date_scheduled); ?> ", scBTNMODE_CUSTOMBLUE);
				</script>
				<div class="row">
					<?php
						echo zen_draw_form('wtwbmb_banner', FILENAME_WT_NEONCART_BANNER_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'action=' . $form_action, 'post', ' onsubmit="return check_dates(date_scheduled, dateScheduled.required, expires_date, dateExpires.required);" enctype="multipart/form-data" class="form-horizontal"');
						echo zen_draw_hidden_field('wtwbm_id', $wtwbmID);
						if ($form_action == 'wtwbmb-upd') {
							echo zen_draw_hidden_field('wtwbmb_id', $wtwbmbID);
						}
					?>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNERS_TITLE, 'wtwbmbc_title', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {  ?>
							<div class="input-group">
								<span class="input-group-addon">
									<?php echo zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
								</span>
								<?php echo zen_draw_textarea_field('wtwbmbc_title[' . $languages[$i]['id'] . ']', 'text', '100%', '1', (isset($bInfo->wtwbmbc_title[$languages[$i]['id']])) ? html_entity_decode(stripslashes($bInfo->wtwbmbc_title[$languages[$i]['id']])) : '', 'class="editorHook form-control"'); ?>
							</div>
							<br>
							<?php
						  }
						  ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNERS_URL, 'wtwbmb_url', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php echo zen_draw_input_field('wtwbmb_url', $bInfo->wtwbmb_url, zen_set_field_length(TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS, 'wtwbmb_url') . ' class="form-control"'); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNERS_IMAGE, 'wtwbmb_image', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php echo zen_draw_file_field('wtwbmb_image', '', 'class="form-control"'); ?>
							<?php 
								if($bInfo->wtwbmb_image){
									echo zen_image(DIR_WS_CATALOG_IMAGES . $bInfo->wtwbmb_image, $bInfo->wtwbmb_image, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '');
								}
							?>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNERS_HTML_TEXT, 'wtwbmbc_content', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {  ?>
							<div class="input-group">
								<span class="input-group-addon">
									<?php echo zen_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
								</span>
								<?php echo zen_draw_textarea_field('wtwbmbc_content[' . $languages[$i]['id'] . ']', 'text', '100%', '10', (isset($bInfo->wtwbmbc_content[$languages[$i]['id']])) ? html_entity_decode(stripslashes($bInfo->wtwbmbc_content[$languages[$i]['id']])) : '', 'class="editorHook form-control"'); ?>
							</div>
							<br>
							<?php
						  }
						  ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNERS_ALL_SORT_ORDER, 'wtwbmb_sort_order', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<?php echo zen_draw_input_field('wtwbmb_sort_order', $bInfo->wtwbmb_sort_order, zen_set_field_length(TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS, 'wtwbmb_sort_order') . ' class="form-control"', false); ?>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_SLIDER_SCHEDULED_AT, 'wtwbmb_date_scheduled', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<script>dateScheduled.writeControl(); dateScheduled.dateFormat = "<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_SLIDER_EXPIRES_ON, 'wtwbmb_expires_impressions', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<script>dateExpires.writeControl(); dateExpires.dateFormat = "<?php echo DATE_FORMAT_SPIFFYCAL; ?>";</script>
							<div style="display:none;">
							<?php echo TEXT_BANNERS_OR_AT . '<br><br>' . zen_draw_input_field('wtwbmb_expires_impressions', $bInfo->wtwbmb_expires_impressions, 'maxlength="7" size="7" class="form-control"') . ' ' . zen_draw_label(TEXT_BANNERS_IMPRESSIONS, 'wtwbmb_expires_impressions', 'class="control-label"') ; ?>
							</div>
						</div>
					</div>
					<div class="form-group">
						<?php echo zen_draw_label(TEXT_BANNERS_STATUS, 'wtwbmb_status', 'class="col-sm-3 control-label"'); ?>
						<div class="col-sm-9 col-md-6">
							<label class="radio-inline"><?php echo zen_draw_radio_field('wtwbmb_status', '1', $bInfo->wtwbmb_status == 1) . TEXT_BANNERS_ACTIVE; ?></label>
							<label class="radio-inline"><?php echo zen_draw_radio_field('wtwbmb_status', '0', $bInfo->wtwbmb_status == 0) . TEXT_BANNERS_NOT_ACTIVE; ?></label><br>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-12 text-right">
							<button type="submit" class="btn btn-primary"><?php echo (($form_action == 'wtwbmb-add') ? IMAGE_INSERT : IMAGE_UPDATE); ?></button> <a href="<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . (isset($_GET['wtwbmID']) ? 'wtwbmID=' . $_GET['wtwbmID'] . '&' : '') . (isset($_GET['wtwbmb_page']) ? 'wtwbmb_page=' . $_GET['wtwbmb_page'] . '&' : '') . (isset($_GET['wtwbmbID']) ? 'wtwbmbID=' . $_GET['wtwbmbID'] : '') . '&action=wtwbmb-view' ); ?>" class="btn btn-default" role="button"><?php echo IMAGE_CANCEL; ?></a>
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
			<?php /***********************************************BANNER LIST*************************************************/?>
			<?php } else if($action == 'wtwbmb-view' || $action == 'wtwbmb-del' ) { ?>
			<?php 
			$wtwbm_rs = $db->Execute("SELECT wtwbm.wtwbm_title FROM " . TABLE_WT_NEONCART_BANNER_MANAGER . " wtwbm WHERE wtwbm.wtwbm_id = " .(int)$_GET['wtwbmID']); ?>
			<?php if($wtwbm_rs->RecordCount() >  0){ ?>
			<br>
			<h4><?php echo TEXT_SELECTED_SLIDER . '  :  ' .$wtwbm_rs->fields['wtwbm_title']; ?></h4>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 configurationColumnLeft">
					<table class="table table-hover">
						<thead>
							<tr class="dataTableHeadingRow">
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_BANNERS; ?></th>
								<th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_BANNERS_IMAGE; ?></th>
								<th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_STATISTICS; ?></th>
								<th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_SLIDER_AVAILABLE; ?></th>
								<th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_SLIDER_EXPIRES; ?></th>
								<th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_STATUS; ?></th>
								<th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_BANNER_STATUS; ?></th>
								<th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_BANNER_SORT_ORDER; ?></th>
								<th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_ACTION; ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$wtwbmb_query_raw = "SELECT wtwbmb.*
                                        FROM " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS . " wtwbmb
                                        LEFT JOIN " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_CONTENT . " wtwbmbc on wtwbmbc.wtwbmb_id = wtwbmb.wtwbmb_id and wtwbmbc.languages_id = '". $_SESSION['languages_id'] ."'
										WHERE wtwbmb.wtwbm_id = '" .(int)$_GET['wtwbmID']. "'
                                        ORDER BY wtwbmb.wtwbmb_sort_order";
								// Split Page
								// reset page when page is unknown
								 if ((empty($_GET['wtwbmb_page']) || $_GET['wtwbmb_page'] == '1') && !empty($_GET['wtwbmbID'])) {
									$check_page = $db->Execute( $wtwbmb_query_raw );
									$check_count = 1;
									if ($check_page->RecordCount() > MAX_DISPLAY_SEARCH_RESULTS) {
										foreach ($check_page as $item) {
											if ($item['wtwbmb_id'] == $_GET['wtwbmbID']) {
												break;
											}
											$check_count++;
										}
										$_GET['wtwbmb_page'] = round((($check_count / MAX_DISPLAY_SEARCH_RESULTS) + (fmod_round($check_count, MAX_DISPLAY_SEARCH_RESULTS) != 0 ? .5 : 0)), 0);
										} else {
										$_GET['wtwbmb_page'] = 1;
									}
								}
								$wtwbmb_split = new splitPageResults($_GET['wtwbmb_page'], MAX_DISPLAY_SEARCH_RESULTS, $wtwbmb_query_raw, $wtwbmb_query_numrows);
								$banners = $db->Execute($wtwbmb_query_raw);
								if($banners->RecordCount() > 0){
									foreach ($banners as $banner) {
										$info = $db->Execute("SELECT SUM(wtwbmbh_shown) AS wtwbmbh_shown,
										SUM(wtwbmbh_clicked) AS wtwbmbh_clicked
										FROM " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_HISTORY . "
										WHERE wtwbmb_id = " . (int)$banner['wtwbmb_id']);
										
										if ((!isset($_GET['wtwbmbID']) || (isset($_GET['wtwbmbID']) && ($_GET['wtwbmbID'] == $banner['wtwbmb_id']))) && !isset($bInfo) && (substr($action, 0, 3) != 'wtwbmb-new')) {
											$bInfo_array = array_merge($banner, $info->fields);
											$bInfo = new objectInfo($bInfo_array);
											if ( isset ( $bInfo->wtwbmb_title ) ) {
												$wtwbmb_title_res_ar = unserialize(base64_decode($bInfo->wtwbmb_title));
												$bInfo->wtwbmb_title = ((!empty($wtwbmb_title_res_ar[$_SESSION['languages_id']])) ? html_entity_decode(stripslashes($wtwbmb_title_res_ar[$_SESSION['languages_id']])) : $bInfo->wtwbmb_title);
											}
										}
										
										$wtwbmbh_shown = ($info->fields['wtwbmbh_shown'] != '') ? $info->fields['wtwbmbh_shown'] : '0';
										$wtwbmbh_clicked = ($info->fields['wtwbmbh_clicked'] != '') ? $info->fields['wtwbmbh_clicked'] : '0';
										
										if (isset($bInfo) && is_object($bInfo) && ($banner['wtwbmb_id'] == $bInfo->wtwbmb_id)) {
										?>
										<tr id="defaultSelected" class="dataTableRowSelected" onclick="document.location.href = '<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page']. '&wtwbmID=' . $banner['wtwbm_id'].'&wtwbmb_page=' . $_GET['wtwbmb_page'] . '&wtwbmbID=' . $banner['wtwbmb_id'] . '&action=wtwbmb-view'); ?>'" role="button">
										<?php } else { ?>
										<tr class="dataTableRow" onclick="document.location.href = '<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page']. '&wtwbmID=' . $banner['wtwbm_id'].'&wtwbmb_page=' . $_GET['wtwbmb_page'] . '&wtwbmbID=' . $banner['wtwbmb_id'] . '&action=wtwbmb-view'); ?>'" role="button">
											<?php
											}
										?>
											<td class="dataTableContent"><a href="javascript:popupImageWindow('<?php echo FILENAME_POPUP_IMAGE; ?>.php?banner=<?php echo $banner['wtwbmb_id']; ?>')"><?php echo zen_image(DIR_WS_IMAGES . 'icon_popup.gif', 'View Banner'); ?></a>&nbsp;
											<?php echo ((!empty($wtwbmb_title_res_ar[$_SESSION['languages_id']])) ? html_entity_decode(stripslashes($wtwbmb_title_res_ar[$_SESSION['languages_id']])) : ''); ?>
											</td>
											<td width="200" align="center"><?php echo zen_image(DIR_WS_CATALOG_IMAGES . $banner['wtwbmb_image'], $banner['wtwbmb_image'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, ''); ?></td>
											<td class="dataTableContent text-right"><?php echo $wtwbmbh_shown . ' / ' . $wtwbmbh_clicked; ?></td>
											<td class="dataTableContent text-right"><?php echo $banner['wtwbmb_date_scheduled']; ?></td>
											<td class="dataTableContent text-right"><?php echo $banner['wtwbmb_expires_date']; ?></td>
											<td class="dataTableContent text-center">
												<?php if ($banner['wtwbmb_status'] == '1') { ?>
													<a href="<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&wtwbmID='.$banner['wtwbm_id'].'&wtwbmb_page=' . $_GET['wtwbmb_page'] . '&wtwbmbID=' . $banner['wtwbmb_id'] . '&action=setflag&flag=0'); ?>"><?php echo zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON); ?></a>
													<?php } else { ?>
													<a href="<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&wtwbmID='.$banner['wtwbm_id'].'&wtwbmb_page=' . $_GET['wtwbmb_page'] . '&wtwbmbID=' . $banner['wtwbmb_id'] . '&action=setflag&flag=1'); ?>"><?php echo zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF); ?></a>
												<?php } ?>
											</td>
											<td class="dataTableContent text-center">
												<?php
													$cur_date = strtotime(date('Y-m-d H:i:s'));
													$wtwbmb_date_scheduled = strtotime($banner['wtwbmb_date_scheduled']);
													$wtwbmb_expires_date = strtotime($banner['wtwbmb_expires_date']);
													$wtwbmb_status = '';
													$wtwbmb_status_ar = array('disabled' => TEXT_PTBM_DISABLED, 'expired' => TEXT_PTBM_EXPIRED, 'queued' => TEXT_PTBM_QUEUED, 'running' => TEXT_PTBM_RUNNING);
													if($banner['wtwbmb_status']==0){
														$wtwbmb_status = 'disabled';
													}else if($cur_date > $wtwbmb_date_scheduled && $cur_date > $wtwbmb_expires_date ){
														$wtwbmb_status = 'expired';
													}else if($cur_date < $wtwbmb_date_scheduled && $cur_date < $wtwbmb_expires_date ){
														$wtwbmb_status = 'queued';
													}else if($cur_date > $wtwbmb_date_scheduled && $cur_date < $wtwbmb_expires_date ){
														$wtwbmb_status = 'running';
													}
												?>
												<span class="itms_status"><span class="<?php echo $wtwbmb_status; ?> st"><?php echo $wtwbmb_status_ar[$wtwbmb_status]; ?></span></span>
											</td>
											<td class="dataTableContent text-right"><?php echo $banner['wtwbmb_sort_order']; ?></td>
											<td class="dataTableContent text-right">
												<a href="<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER_BANNER_STATISTICS, 'wtwbmb_page=' . $_GET['wtwbmb_page'] . '&wtwbmbID=' . $banner['wtwbmb_id']); ?>"><?php echo zen_image(DIR_WS_ICONS . 'statistics.gif', ICON_STATISTICS); ?></a>
												<?php
													if (isset($bInfo) && is_object($bInfo) && ($banner['wtwbmb_id'] == $bInfo->wtwbmb_id)) {
														echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
														} else {
														echo '<a href="' . zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'wtwbmb_page=' . $_GET['wtwbmb_page'] . '&wtwbmbID=' . $banner['wtwbmb_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
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
								case 'wtwbmb-del':
									$heading[] = array('text' => '<h4>' . $bInfo->wtwbmb_title . '</h4>');
									
									$contents = array('form' => zen_draw_form('wtwbmb_del', FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&action=deleteconfirm') . zen_draw_hidden_field('wtwbmID', $bInfo->wtwbm_id).
									zen_draw_hidden_field('wtwbmbID', $bInfo->wtwbmb_id)
									);
									$contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
									$contents[] = array('text' => '<br><b>' . $bInfo->wtwbmb_title . '</b>');
									if ($bInfo->wtwbmb_image) {
										$contents[] = array('text' => '<br>' . zen_draw_checkbox_field('delete_image', 'on', true) . ' ' . TEXT_INFO_DELETE_IMAGE);
									}
									$contents[] = array('align' => 'center', 'text' => '<br><button type="submit" class="btn btn-danger">' . IMAGE_DELETE . '</button> <a href="' . zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&wtwbmbID=' . $_GET['wtwbmbID']) . '" class="btn btn-default" role="button">' . IMAGE_CANCEL . '</a>');
									break;
									default:
									if (is_object($bInfo)) {
										$heading[] = array('text' => '<h4>' . $bInfo->wtwbmb_title . '</h4>');
										
										$contents[] = array('align' => 'text-center', 'text' => '<a href="' . zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page']. '&wtwbmID=' . $bInfo->wtwbm_id.'&wtwbmb_page=' . $_GET['wtwbmb_page'] . '&wtwbmbID=' . $bInfo->wtwbmb_id . '&action=wtwbmb-new') . '" class="btn btn-primary" role="button">' . IMAGE_EDIT . '</a> <a href="' . zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page']. '&wtwbmID=' . $bInfo->wtwbm_id.'&wtwbmb_page=' . $_GET['wtwbmb_page'] . '&wtwbmbID=' . $bInfo->wtwbmb_id . '&action=wtwbmb-del') . '" class="btn btn-warning" role="button">' . IMAGE_DELETE . '</a>');
										$contents[] = array('text' => '<br>' . TEXT_BANNERS_DATE_ADDED . ' ' . zen_date_short($bInfo->wtwbmb_date_added));
										$contents[] = array('text-center', 'text' => '<br>' . '<a href="' . zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page']. '&wtwbmID=' . $bInfo->wtwbm_id.'&wtwbmb_page=' . $_GET['wtwbmb_page'] . '&wtwbmbID=' . $bInfo->wtwbmb_id. '&action=wtwbmb-view') . '" class="btn btn-default" role="button">' . IMAGE_UPDATE . '</a>');
										
										$banner_id = $bInfo->wtwbmb_id;
										$days = 3;
										$stats = wtwbm_data_recent($banner_id, $days);
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
										'</script>');
										
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
							<td><?php echo $wtwbmb_split->display_count($wtwbmb_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_BANNERS); ?></td>
							<td class="text-right"><?php echo $wtwbmb_split->display_links($wtwbmb_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
						</tr>
						<tr>
							<td class="text-right" colspan="2"><a href="<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&wtwbmID=' . (int)$_GET['wtwbmID'].'&action=wtwbmb-new'); ?>" class="btn btn-primary" role="button"><?php echo IMAGE_NEW_BANNER; ?></a>&nbsp;&nbsp;<a href="<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&wtwbmID=' . (int)$_GET['wtwbmID']); ?>" class="btn btn-primary" role="button"><?php echo TEXT_BACK_SLIDER; ?></a></td>
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
							<td class="text-right" colspan="2"><a href="<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page']); ?>" class="btn btn-primary" role="button"><?php echo TEXT_BACK_BUTTON; ?></a></td>
						</tr>
					</table>
			
			<?php } ?>
			<?php /***********************************************SLIDER LIST*************************************************/?>
			<?php } else { ?>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 configurationColumnLeft">
					<table class="table table-hover">
						<thead>
							<tr class="dataTableHeadingRow">
								<th class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDER; ?></th>
								<th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_SLIDER_TYPE; ?></th>
								<th class="dataTableHeadingContent text-center"><?php echo TABLE_HEADING_STATUS; ?></th>
								<th class="dataTableHeadingContent text-right"><?php echo TABLE_HEADING_ACTION; ?></th>
							</tr>
						</thead>
						<tbody>
							<?php
								$wtwbm_query_raw = "SELECT wtwbm_id, wtwbm_title, wtwbm_type, wtwbm_date_added, wtwbm_status                                              
                                        FROM " . TABLE_WT_NEONCART_BANNER_MANAGER . "
                                        ORDER BY wtwbm_id";
								// Split Page
								// reset page when page is unknown
								if ( ( empty( $_GET['page'] ) || $_GET['page'] == '1') && !empty( $_GET['wtwbmID'] ) ) {
									$check_page = $db->Execute($wtwbm_query_raw);
									$check_count = 1;
									if ($check_page->RecordCount() > MAX_DISPLAY_SEARCH_RESULTS) {
										foreach ($check_page as $item) {
											if ($item['wtwbm_id'] == $_GET['wtwbmID']) {
												break;
											}
											$check_count++;
										}
										$_GET['page'] = round((($check_count / MAX_DISPLAY_SEARCH_RESULTS) + (fmod_round($check_count, MAX_DISPLAY_SEARCH_RESULTS) != 0 ? .5 : 0)), 0);
										} else {
										$_GET['page'] = 1;
									}
								}
								$wtwbm_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $wtwbm_query_raw, $wtwbm_query_numrows);
								$sliders = $db->Execute($wtwbm_query_raw);
								if($sliders->RecordCount() > 0){
									foreach ($sliders as $slider) {
										if ((!isset($_GET['wtwbmID']) || (isset($_GET['wtwbmID']) && ($_GET['wtwbmID'] == $slider['wtwbm_id']))) && !isset($bInfo) && (substr($action, 0, 3) != 'wtwbm-new')) {
											$bInfo = new objectInfo($slider);
										}
										
										//$wtwbm_shown = ($info->fields['wtwbm_shown'] != '') ? $info->fields['wtwbm_shown'] : '0';
										//$wtwbm_clicked = ($info->fields['wtwbm_clicked'] != '') ? $info->fields['wtwbm_clicked'] : '0';
										
										if (isset($bInfo) && is_object($bInfo) && ($slider['wtwbm_id'] == $bInfo->wtwbm_id)) {
										?>
										<tr id="defaultSelected" class="dataTableRowSelected" onclick="document.location.href = '<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&wtwbmID=' . $bInfo->wtwbm_id); ?>'" role="button">
										<?php } else { ?>
										<tr class="dataTableRow" onclick="document.location.href = '<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&wtwbmID=' . $slider['wtwbm_id']); ?>'" role="button">
										<?php }	?>
											<td class="dataTableContent"><?php echo $slider['wtwbm_title']; ?></td>
											<td class="dataTableContent text-center"><a href="javascript:popupImageWindow('<?php echo FILENAME_POPUP_IMAGE; ?>.php?banner=<?php echo $slider['wtwbm_id']; ?>')"><?php echo zen_image('includes/'.WT_NEONCART_BANNER_MANAGER_INCLUDES.'/images/styles/'.$slider['wtwbm_type'].'.png', '', '100', 'auto', 'style="max-height:80px;display:table;width:auto;max-width:100px;margin:0 auto;"'); ?></td>
											<!--<td class="dataTableContent text-right"><?php //echo $wtwbm_shown . ' / ' . $wtwbm_clicked; ?></td>-->
											<td class="dataTableContent text-center">
												<?php if ($slider['wtwbm_status'] == '1') { ?>
													<a href="<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&wtwbmID=' . $slider['wtwbm_id'] . '&action=setflag&flag=0'); ?>"><?php echo zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON); ?></a>
													<?php } else { ?>
													<a href="<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&wtwbmID=' . $slider['wtwbm_id'] . '&action=setflag&flag=1'); ?>"><?php echo zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF); ?></a>
												<?php } ?>
											</td>
											<td class="dataTableContent text-right">
												<?php
													if (isset($bInfo) && is_object($bInfo) && ($slider['wtwbm_id'] == $bInfo->wtwbm_id)) {
														echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
														} else {
														echo '<a href="' . zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&wtwbmID=' . $slider['wtwbm_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
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
								case 'wtwbm-del':
									$heading[] = array('text' => '<h4>' . $bInfo->wtwbm_title . '</h4>');
									
									$contents = array('form' => zen_draw_form('wtwbm_del', FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&action=deleteconfirm') . zen_draw_hidden_field('wtwbmID', $bInfo->wtwbm_id));
									$contents[] = array('text' => TEXT_SLIDER_INFO_DELETE_INTRO);
									$contents[] = array('text' => '<br><b>' . $bInfo->wtwbm_title . '</b>');
									$contents[] = array('align' => 'center', 'text' => '<br><button type="submit" class="btn btn-danger">' . IMAGE_DELETE . '</button> <a href="' . zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&wtwbmID=' . $_GET['wtwbmID']) . '" class="btn btn-default" role="button">' . IMAGE_CANCEL . '</a>');
									break;
								default:
								if (is_object($bInfo)) {
									$heading[] = array('text' => '<h4>' . $bInfo->wtwbm_title . '</h4>');
									
									$contents[] = array('align' => 'text-center', 'text' => '
									<a href="' . zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&wtwbmID=' . $bInfo->wtwbm_id . '&action=wtwbm-new') . '" class="btn btn-primary" role="button">' . IMAGE_EDIT . '</a> 
									<a href="' . zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&wtwbmID=' . $bInfo->wtwbm_id . '&action=wtwbm-del') . '" class="btn btn-warning" role="button">' . IMAGE_DELETE . '</a><br/><br/>
									<a href="' . zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'page=' . $_GET['page'] . '&wtwbmID=' . $bInfo->wtwbm_id . '&action=wtwbmb-view') . '" class="btn btn-primary" role="button">' . IMAGE_VIEW_BANNER . '</a>
									');
									$contents[] = array('text' => '<br>' . TEXT_BANNERS_DATE_ADDED . ' ' . zen_date_short($bInfo->wtwbm_date_added));
									
									
									$contents[] = array('text' => '<div style="background:#ff000021;"><hr style="border-color:red;margin:0;"><h4 class="text-center">'.TEXT_EMBED_SLIDER.'</h4><hr style="border-color:red;margin:0;"></div>');
									$contents[] = array('text' => '<br>' . TEXT_HOMEPAGE_SHORT_CODE . '  :  ' . '<code style="font-size:15px;">[wtwbm_slider ID="'.$bInfo->wtwbm_id.'"]</code>');
									$contents[] = array('text' => '<br>' . TEXT_OTHERPAGE_SHORT_CODE . '  :  ' . '<code style="font-size:15px;">wt_'.$template_dir.'_banner_manager("'.$bInfo->wtwbm_id.'");</code>');
									$contents[] = array('text' => '<hr style="border-color:red">');
									
									
									$wtwbm_id = $bInfo->wtwbm_id;
									
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
							<td><?php echo $wtwbm_split->display_count($wtwbm_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_BANNERS); ?></td>
							<td class="text-right"><?php echo $wtwbm_split->display_links($wtwbm_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
						</tr>
						<tr>
							<td class="text-right" colspan="2"><a href="<?php echo zen_href_link(FILENAME_WT_NEONCART_BANNER_MANAGER, 'action=wtwbm-new'); ?>" class="btn btn-primary" role="button"><?php echo IMAGE_NEW_SLIDER; ?></a></td>
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
		<script>
			$(function () {
				$(".datepicker").datepicker({
					showOn: "both",
					buttonImage: "images/calendar.gif",
					dateFormat: '<?php echo DATE_FORMAT_SPIFFYCAL; ?>',
					changeMonth: true,
					changeYear: true
				});
			});
		</script>
	</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
