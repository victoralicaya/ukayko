<?php 
/**
 * WT Slideshow Manager for Zen Cart.
 *
 * @copyright 2021 WT Tech. Designs.
 * Version : WT Slideshow Manager 1.0
 */
?>
<?php 
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

if (!empty($_SESSION['admin_id']) && $_SERVER['SCRIPT_NAME'] !== DIR_WS_ADMIN . (!strstr(FILENAME_LOGIN, '.php') ? FILENAME_LOGIN . '.php' : FILENAME_LOGIN) && $_SERVER['SCRIPT_NAME'] !== DIR_WS_ADMIN . (!strstr(FILENAME_LOGOFF, '.php') ? FILENAME_LOGOFF . '.php' : FILENAME_LOGOFF)) {
	$module_constant = 'WT_SLIDESHOW_MANAGER'; // This should be a UNIQUE name followed by _VERSION for convention
	$module_installer_directory = DIR_FS_ADMIN . 'includes/installers/'.WT_SLIDESHOW_MANAGER_INSTALLER_DIR; // This is the directory your installer is in, usually this is lower case
	$module_name = MODULE_NAME_WT_SLIDESHOW_MANAGER; // This should be a plain English or Other in a user friendly way
	$zencart_com_plugin_id = 0; // from zencart.com plugins - Leave Zero not to check
	//Just change the stuff above... Nothing down here should need to change

	$configuration_group_id = '';
	if (defined($module_constant . '_VERSION')) {
		// Version information exists, therefore use that information as the current version.
		$current_version = constant($module_constant . '_VERSION');
		// Should collect the configuration information here before moving down/further
		$installed = $db->Execute("SELECT configuration_group_id FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = '" . $module_constant . "_VERSION'");
		//$configuration_group_id = $installed->fields['configuration_group_id'];
		//$configuration_group_id_is_new = false;
	} else {
		// Version information does not exist, begin with version 0.0.0.
		$current_version = "0.0.0";

		// Check to see if the configuration group is in the database/plugin has been installed.
		$installed = $db->Execute("SELECT configuration_group_id FROM " . TABLE_CONFIGURATION_GROUP . " WHERE configuration_group_title = '" . $module_name . "'");
		if ($installed->EOF || $installed->RecordCount() == 0){
			// The configuration group does not exist, so add it to the database and establish the configuration_group_id.
			$db->Execute("INSERT INTO " . TABLE_CONFIGURATION_GROUP . " (configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('" . $module_name . "', 'Set " . $module_name . " Configuration Options', '1', '1');");
			$configuration_group_id = $db->Insert_ID();
		} else {
			// Configuration group exists in database, so get the configuration_group_id.
			$configuration_group_id = $installed->fields['configuration_group_id'];
		}

		// Set the sort order of the configuration group to be equal to the configuration_group_id, idea being that each new group will be added to the end.
		$db->Execute("UPDATE " . TABLE_CONFIGURATION_GROUP . " SET sort_order = " . $configuration_group_id . " WHERE configuration_group_id = " . $configuration_group_id . ";");

		// If the configuration group did not previously exist, then neither did the version information because it is created in this module.
		if ($installed->EOF || $installed->RecordCount() == 0){
			$db->Execute("INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES
                      ('" . $module_name . " (Version Installed)', '" . $module_constant . "_VERSION', '" . $current_version . "', 'Version installed:', " . $configuration_group_id . ", 0, NOW(), NULL, 'zen_cfg_select_option(array(\'0.0.0\'),');");
		}
	}
	if ($configuration_group_id == '') {
		$config = $db->Execute("SELECT configuration_group_id FROM " . TABLE_CONFIGURATION . " WHERE configuration_key= '" . $module_constant . "_VERSION'");
		$configuration_group_id = $config->fields['configuration_group_id'];
	}

	// Obtain a list of files in the installer directory.
	if (is_dir($module_installer_directory)) {
		$installers = scandir($module_installer_directory, (defined('SCANDIR_SORT_DESCENDING') ? SCANDIR_SORT_DESCENDING : 1)); // Sorted Descending

		// Determine the extension of this file to be used for comparison on the others.
		$file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
		$file_extension_len = strlen($file_extension); // Allow file extension to be "flexible"

		// sequence the installer files to support stepping through them. (Already done by sort above.

		while (substr($installers[0], strrpos($installers[0], '.')) != $file_extension || preg_match('~^[^\._].*\.php$~i', $installers[0]) <= 0 || $installers[0] == 'empty.txt' /*|| version_compare($newest_version, $current_version) <= 0*/) {
			unset($installers[0]);
			if (count($installers) == 0) {
				break;
			}
			$installers = array_values($installers);
		}

		// If there are still installer files to process, then do so.
		if (count($installers) > 0) {
			$newest_version = $installers[0];
			$newest_version = substr($newest_version, 0, -1 * $file_extension_len);
			sort($installers);
			if (version_compare($newest_version, $current_version) > 0) {
				foreach ($installers as $installer) {
					if (substr($installer, strrpos($installer, '.')) == $file_extension && (preg_match('~^[^\._].*\.php$~i', $installer) > 0 || $installer != 'empty.txt')) {
						if (version_compare($newest_version, substr($installer, 0, -1 * $file_extension_len)) >= 0 && version_compare($current_version, substr($installer, 0, -1 * $file_extension_len)) < 0) {
								include($module_installer_directory . '/' . $installer);
								$current_version = str_replace("_", ".", substr($installer, 0, -1 * $file_extension_len));
								$db->Execute("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = '" . $current_version . "', set_function = 'zen_cfg_select_option(array(\'" . $current_version . "\'),' WHERE configuration_key = '" . $module_constant . "_VERSION' LIMIT 1;");
								$messageStack->add("Installed " . $module_name . " v" . $current_version, 'success');
							}
					}
				}
			}
		}
	}
}