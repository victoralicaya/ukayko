<?php 
/**
 * WT Slideshow Manager for Zen Cart.
 * WARNING: Do not change this file. Your changes will be lost.
 *
 * @copyright 2021 WT Tech. Designs.
 * Version : WT Slideshow Manager 1.0
 */

$zc150 = (PROJECT_VERSION_MAJOR > 1 || (PROJECT_VERSION_MAJOR == 1 && substr(PROJECT_VERSION_MINOR, 0, 3) >= 5));
if ($zc150 || $zc130) { // continue Zen Cart 1.5.0 or Zen Cart 1.3.x
	
	$db->Execute("CREATE TABLE IF NOT EXISTS ".TABLE_WT_SLIDESHOW_MANAGER." (
	wtsm_id int(11) NOT NULL,
	  wtsm_title varchar(64) NOT NULL DEFAULT '',
	  wtsm_full_screen int(11) NOT NULL DEFAULT 0,
	  wtsm_width varchar(50) NOT NULL DEFAULT '0',
	  wtsm_height varchar(50) NOT NULL DEFAULT '0',
	  wtsm_infinite int(1) NOT NULL DEFAULT 0,
	  wtsm_on_hover int(1) NOT NULL DEFAULT 0,
	  wtsm_controls int(1) NOT NULL DEFAULT 1,
	  wtsm_pager int(1) NOT NULL DEFAULT 1,
	  wtsm_autoplay int(1) NOT NULL DEFAULT 1,
	  wtsm_interval_time varchar(100) NOT NULL DEFAULT '3000',
	  wtsm_slide_speed int(11) NOT NULL DEFAULT 300,
	  wtsm_slide_animation varchar(100) NOT NULL DEFAULT 'fade',
	  wtsm_slider_background_color text DEFAULT NULL,
	  wtsm_date_added datetime NOT NULL DEFAULT '0001-01-01 00:00:00',
	  wtsm_updated_at datetime NOT NULL DEFAULT '0001-01-01 00:00:00',
	  wtsm_status int(1) NOT NULL DEFAULT 1,
	PRIMARY KEY (wtsm_id))
	");
	
	$db->Execute("CREATE TABLE IF NOT EXISTS ".TABLE_WT_SLIDESHOW_MANAGER_BANNERS." (
	wtsmb_id int(11) NOT NULL,
  wtsm_id int(11) NOT NULL DEFAULT 0,
  wtsmb_title varchar(64) NOT NULL DEFAULT '',
  wtsmb_type varchar(100) NOT NULL DEFAULT '',
  wtsmb_background_color text DEFAULT NULL,
  wtsmb_background_image varchar(255) DEFAULT NULL,
  wtsmb_cp varchar(100) NOT NULL DEFAULT '',
  wtsmb_cptop int(11) DEFAULT NULL,
  wtsmb_cpleft int(11) DEFAULT NULL,
  wtsmb_url text DEFAULT NULL,
  wtsmb_image varchar(255) NOT NULL DEFAULT '',
  wtsmb_extra_classes varchar(255) DEFAULT NULL,
  wtsmb_item_image varchar(255) DEFAULT NULL,
  wtsmb_sort_order int(11) NOT NULL DEFAULT 0,
  wtsmb_expires_impressions int(7) DEFAULT 0,
  wtsmb_date_scheduled datetime DEFAULT NULL,
  wtsmb_expires_date datetime DEFAULT NULL,
  wtsmb_date_added datetime NOT NULL DEFAULT '0001-01-01 00:00:00',
  wtsmb_date_status_change datetime NOT NULL DEFAULT '0001-01-01 00:00:00',
  wtsmb_updated_at datetime NOT NULL DEFAULT '0001-01-01 00:00:00',
  wtsmb_status int(1) NOT NULL DEFAULT 1,
	PRIMARY KEY (wtsmb_id),
	KEY idx_wtsmb_id_zen (wtsm_id)
	)");
	
	$db->Execute("CREATE TABLE IF NOT EXISTS ".TABLE_WT_SLIDESHOW_MANAGER_BANNERS_CONTENT." (
	wtsmbc_id int(11) NOT NULL auto_increment,
	wtsmb_id int(11) NOT NULL default '0',
	languages_id int(11) NOT NULL default '1',
	wtsmbc_content text,
	PRIMARY KEY (wtsmbc_id),
	KEY idx_wtsmbc_id_zen (wtsmb_id)
	)");
	
	$db->Execute("CREATE TABLE IF NOT EXISTS ".TABLE_WT_SLIDESHOW_MANAGER_BANNERS_HISTORY." (
	wtsmbh_id int(11) NOT NULL auto_increment,
	wtsmb_id int(11) NOT NULL default '0',
	wtsmbh_shown int(5) NOT NULL DEFAULT '0',
	wtsmbh_clicked int(5) NOT NULL DEFAULT '0',
	wtsmbh_history_date datetime NOT NULL DEFAULT '0001-01-01 00:00:00',
	PRIMARY KEY (wtsmbh_id),
	KEY idx_wtsmbh_id_zen (wtsmb_id)
	)");
	
	// Initialize the variable.
    $sort_order = array();
	
	$sort_order = array(				
		array('configuration_group_id' => array('value' => $configuration_group_id, 'type' => 'integer'),
              'configuration_key' 	   => array('value' => 'WT_SLIDESHOW_MANAGER_STATUS', 'type' => 'string'),
              'configuration_title' => array('value' => 'WT Slideshow Manager Status', 'type' => 'string'),
              'configuration_value' => array('value' => 'true', 'type' => 'string'),
              'configuration_description' => array('value' => 'Enable WT Slideshow Manager?', 'type' => 'string'),
              'date_added' => array('value' => 'NOW()', 'type' => 'noquotestring'),
              'use_function' => array('value' => 'NULL', 'type' => 'noquotestring'),
              'set_function' => array('value' => 'zen_cfg_select_option(array(\'true\', \'false\'),', 'type' => 'string'),
        ),
		array('configuration_group_id' => array('value' => $configuration_group_id, 'type' => 'integer'),
              'configuration_key' 	   => array('value' => 'WT_SLIDESHOW_MANAGER_JQUERY_STATUS', 'type' => 'string'),
              'configuration_title' => array('value' => 'Enable jQuery v1.12.4', 'type' => 'string'),
              'configuration_value' => array('value' => 'false', 'type' => 'string'),
              'configuration_description' => array('value' => 'Enable jQuery?', 'type' => 'string'),
              'date_added' => array('value' => 'NOW()', 'type' => 'noquotestring'),
              'use_function' => array('value' => 'NULL', 'type' => 'noquotestring'),
              'set_function' => array('value' => 'zen_cfg_select_option(array(\'true\', \'false\'),', 'type' => 'string'),
        ),
	);
	
	if(function_exists('zen_register_admin_page')) {
		if(!zen_page_key_exists('config'.WT_SLIDESHOW_MANAGER_PAGEKEYS)){
			$page_sort_query = "SELECT MAX(sort_order) as max_sort FROM ". TABLE_ADMIN_PAGES ." WHERE menu_key='configuration'";
			$page_sort = $db->Execute($page_sort_query);
			$page_sort = $page_sort->fields['max_sort'] + 1;
			zen_register_admin_page('config'.WT_SLIDESHOW_MANAGER_PAGEKEYS, 'BOX_CONFIGURATION_WT_SLIDESHOW_MANAGER', 'FILENAME_CONFIGURATION', 'gID=' . $configuration_group_id, 'configuration', 'Y', $page_sort);
		}
	}
	
	if(function_exists('zen_register_admin_page')) {
		if(!zen_page_key_exists('tools'.WT_SLIDESHOW_MANAGER_PAGEKEYS)){
			$page_sort_query = "SELECT MAX(sort_order) as max_sort FROM `". TABLE_ADMIN_PAGES ."` WHERE menu_key='tools'";
			$page_sort = $db->Execute($page_sort_query);
			$page_sort = $page_sort->fields['max_sort'] + 1;
			zen_register_admin_page('tools'.WT_SLIDESHOW_MANAGER_PAGEKEYS, 'BOX_TOOLS_WT_SLIDESHOW_MANAGER', 'FILENAME_WT_SLIDESHOW_MANAGER', '', 'tools', 'Y', $page_sort);
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
