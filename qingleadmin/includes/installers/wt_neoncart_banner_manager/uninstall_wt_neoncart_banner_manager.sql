/* Tables need to be ensured to include the prefix if it exists. */


SELECT @WTNeoncartBannerManagerSgID := configuration_group_id 
FROM configuration_group where configuration_group_title = 'WT Neoncart Banner Manager';

DELETE FROM configuration WHERE configuration_group_id = @WTNeoncartBannerManagerSgID; 

DELETE FROM admin_pages WHERE page_key = 'configWTNeoncartBannerManager';
DELETE FROM admin_pages WHERE page_key = 'toolsWTNeoncartBannerManager';

DELETE FROM configuration_group WHERE configuration_group_id = @WTNeoncartBannerManagerSgID;