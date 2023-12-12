<?php 
/**
 * WT Neoncart Banner Manager for Zen Cart.
 * WARNING: Do not change this file. Your changes will be lost.
 *
 * @copyright 2021 WT Tech. Designs.
 * Version : WT Neoncart Banner Manager 1.0
 */
?>
<?php
$zc150 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5));
if ($zc150 || $zc130) { // continue Zen Cart 1.5.0 or Zen Cart 1.3.x
	
	$db->Execute("CREATE TABLE IF NOT EXISTS ".TABLE_WT_NEONCART_BANNER_MANAGER." (
	wtwbm_id int(11) NOT NULL,
  wtwbm_title varchar(64) NOT NULL DEFAULT '',
  wtwbm_type varchar(100) NOT NULL DEFAULT '',
  wtwbm_date_added datetime NOT NULL DEFAULT '0001-01-01 00:00:00',
  wtwbm_updated_at datetime NOT NULL DEFAULT '0001-01-01 00:00:00',
  wtwbm_status int(1) NOT NULL DEFAULT 1,
	PRIMARY KEY  (wtwbm_id))");
	
	$db->Execute("CREATE TABLE IF NOT EXISTS ".TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS." (
	wtwbmb_id int(11) NOT NULL,
  wtwbm_id int(11) NOT NULL DEFAULT 0,
  wtwbmb_url varchar(255) NOT NULL DEFAULT '',
  wtwbmb_image varchar(255) NOT NULL DEFAULT '',
  wtwbmb_sort_order int(11) NOT NULL DEFAULT 0,
  wtwbmb_expires_impressions int(7) DEFAULT 0,
  wtwbmb_expires_date datetime DEFAULT NULL,
  wtwbmb_date_scheduled datetime DEFAULT NULL,
  wtwbmb_date_added datetime NOT NULL DEFAULT '0001-01-01 00:00:00',
  wtwbmb_date_status_change datetime NOT NULL DEFAULT '0001-01-01 00:00:00',
  wtwbmb_updated_at datetime NOT NULL DEFAULT '0001-01-01 00:00:00',
  wtwbmb_status int(1) NOT NULL DEFAULT 1,
	PRIMARY KEY (wtwbmb_id),
	KEY idx_wtwbmb_id_zen (wtwbm_id)
	)");
	
	$db->Execute("CREATE TABLE IF NOT EXISTS ".TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_CONTENT." (
	wtwbmbc_id int(11) NOT NULL auto_increment,
	wtwbmb_id int(11) NOT NULL default '0',
	languages_id int(11) NOT NULL default '1',
	wtwbmbc_title text,
	wtwbmbc_content text,
	PRIMARY KEY (wtwbmbc_id),
	KEY idx_wtwbmbc_id_zen (wtwbmb_id)
	)");
	
	$db->Execute("CREATE TABLE IF NOT EXISTS ".TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS_HISTORY." (
	wtwbmbh_id int(11) NOT NULL auto_increment,
	wtwbmb_id int(11) NOT NULL default '0',
	wtwbmbh_shown int(5) NOT NULL DEFAULT '0',
	wtwbmbh_clicked int(5) NOT NULL DEFAULT '0',
	wtwbmbh_history_date datetime NOT NULL DEFAULT '0001-01-01 00:00:00',
	PRIMARY KEY (wtwbmbh_id),
	KEY idx_wtwbmbh_id_zen (wtwbmb_id)
	)");
	
	// Initialize the variable.
    $sort_order = array();
	
	$sort_order = array(				
		array('configuration_group_id' => array('value' => $configuration_group_id, 'type' => 'integer'),
              'configuration_key' 	   => array('value' => 'WT_NEONCART_BANNER_MANAGER_STATUS', 'type' => 'string'),
              'configuration_title' => array('value' => 'WT Neoncart Banner Manager Status', 'type' => 'string'),
              'configuration_value' => array('value' => 'true', 'type' => 'string'),
              'configuration_description' => array('value' => 'Enable WT Neoncart Banner Manager?', 'type' => 'string'),
              'date_added' => array('value' => 'NOW()', 'type' => 'noquotestring'),
              'use_function' => array('value' => 'NULL', 'type' => 'noquotestring'),
              'set_function' => array('value' => 'zen_cfg_select_option(array(\'true\', \'false\'),', 'type' => 'string'),
        )
	);
	
	if(function_exists('zen_register_admin_page')) {
		if(!zen_page_key_exists('configWTNeoncartBannerManager')){
			$page_sort_query = "SELECT MAX(sort_order) as max_sort FROM ". TABLE_ADMIN_PAGES ." WHERE menu_key='configuration'";
			$page_sort = $db->Execute($page_sort_query);
			$page_sort = $page_sort->fields['max_sort'] + 1;
			zen_register_admin_page('configWTNeoncartBannerManager', 'BOX_CONFIGURATION_WT_NEONCART_BANNER_MANAGER', 'FILENAME_CONFIGURATION', 'gID=' . $configuration_group_id, 'configuration', 'Y', $page_sort);
		}
	}
	
	if(function_exists('zen_register_admin_page')) {
		if(!zen_page_key_exists('toolsWTNeoncartBannerManager')){
			$page_sort_query = "SELECT MAX(sort_order) as max_sort FROM `". TABLE_ADMIN_PAGES ."` WHERE menu_key='tools'";
			$page_sort = $db->Execute($page_sort_query);
			$page_sort = $page_sort->fields['max_sort'] + 1;
			zen_register_admin_page('toolsWTNeoncartBannerManager', 'BOX_TOOLS_WT_NEONCART_BANNER_MANAGER', 'FILENAME_WT_NEONCART_BANNER_MANAGER', '', 'tools', 'Y', $page_sort);
		}
	}
	
	
	// Identify the sort order item(s) so that can add the new options at the end.  Goal is to
    //   Incorporate the options that already exist(ed) by reassigning them to the next new sort, but
    //   also by not making a mess of the sort orders and just assign the next groupping.
    $sort_query = "SELECT (MAX(sort_order) + 10) AS max_sort FROM " . TABLE_CONFIGURATION . " WHERE configuration_group_id = :configuration_group_id: AND configuration_key != 'ADDITIONAL_SMALL_IMAGE_HEIGHT' AND configuration_key != 'ADDITIONAL_SMALL_IMAGE_WIDTH'";
    $sort_query = $db->bindVars($sort_query, ':configuration_group_id:', $configuration_group_id, 'integer');
    $new_sort_order = $db->Execute($sort_query);

    // Begin next row at a sort order that is rounded to ten.
    $new_sort = (int)round($new_sort_order->fields['max_sort'], -1);

    // Ensure that the number is the next highest value of ten.
    if ($new_sort < $new_sort_order->fields['max_sort']) {
        $new_sort += 10;
    }

    foreach ($sort_order as $config_key => $config_item) {

        $sql = "INSERT IGNORE INTO " . TABLE_CONFIGURATION . " (configuration_group_id, configuration_key, configuration_title, configuration_value, configuration_description, sort_order, date_added, use_function, set_function)
          VALUES (:configuration_group_id:, :configuration_key:, :configuration_title:, :configuration_value:, :configuration_description:, :sort_order:, :date_added:, :use_function:, :set_function:)
          ON DUPLICATE KEY UPDATE configuration_group_id = :configuration_group_id:, sort_order = :sort_order:";
        $sql = $db->bindVars($sql, ':configuration_group_id:', $config_item['configuration_group_id']['value'], $config_item['configuration_group_id']['type']);
        $sql = $db->bindVars($sql, ':configuration_key:', $config_item['configuration_key']['value'], $config_item['configuration_key']['type']);
        $sql = $db->bindVars($sql, ':configuration_title:', $config_item['configuration_title']['value'], $config_item['configuration_title']['type']);
        $sql = $db->bindVars($sql, ':configuration_value:', $config_item['configuration_value']['value'], $config_item['configuration_value']['type']);
        $sql = $db->bindVars($sql, ':configuration_description:', $config_item['configuration_description']['value'], $config_item['configuration_description']['type']);
        $sql = $db->bindVars($sql, ':sort_order:', (int)$new_sort + (int)$config_key * 10, 'integer');
        $sql = $db->bindVars($sql, ':date_added:', $config_item['date_added']['value'], $config_item['date_added']['type']);
        $sql = $db->bindVars($sql, ':use_function:', $config_item['use_function']['value'], $config_item['use_function']['type']);
        $sql = $db->bindVars($sql, ':set_function:', $config_item['set_function']['value'], $config_item['set_function']['type']);
        $db->Execute($sql);
    }
	
    $messageStack->add('Inserted or updated configuration for ' . $module_name , 'success');

} // END OF VERSION 1.5.x INSTALL
