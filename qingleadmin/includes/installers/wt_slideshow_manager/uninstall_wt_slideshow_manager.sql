/* Tables need to be ensured to include the prefix if it exists. */


SELECT @WTSlideshowManagerSgID := configuration_group_id 
FROM configuration_group where configuration_group_title = 'WT Slideshow Manager';

DELETE FROM configuration WHERE configuration_group_id = @WTSlideshowManagerSgID; 

DELETE FROM admin_pages WHERE page_key = 'configWTSlideshowManager';
DELETE FROM admin_pages WHERE page_key = 'toolsWTSlideshowManager';

DELETE FROM configuration_group WHERE configuration_group_id = @WTSlideshowManagerSgID;