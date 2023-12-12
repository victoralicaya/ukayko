<?php
/**
	* WT Slideshow Manager for Zen Cart.
	* WARNING: Do not change this file. Your changes will be lost.
	*
	* @copyright 2021 WT Tech. Designs.
	* Version : WT Slideshow Manager 1.0
*/
/*class zcAjaxWTSlideshowManager extends base
{
    public function bnrClick(){
        global $db, $zco_notifier, $currencies, $messages;
		$messages = array();
		$zco_notifier->notify('NOTIFY_HEADER_START_WT_SLIDESHOW_MANAGER_CLICK');
		if ( !empty( $_POST['bnr_id'] ) ) {
			$bnr_id = $_POST['bnr_id'];
			$banner_query = "select wtsmb_id, wtsmb_title, wtsmb_image, wtsmb_html_text, wtsmb_url
                         from " . TABLE_WT_SLIDESHOW_MANAGER_BANNERS . "
                         where wtsmb_status = 1
                         and wtsmb_id = '" . (int)$bnr_id . "'";

			$banner = $db->Execute($banner_query);
			if($banner->RecordCount() > 0){
				$messages['messages'] = wtsm_update_banner_click_count( $banner->fields['wtsmb_id'] );
			}
		}
		return $messages;
		$zco_notifier->notify('NOTIFY_HEADER_END_WT_SLIDESHOW_MANAGER_CLICK');
    }

}
*/