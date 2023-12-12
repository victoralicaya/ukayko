<?php
/**
	* WT Neoncart Banner Manager for Zen Cart.
	* WARNING: Do not change this file. Your changes will be lost.
	*
	* @copyright 2021 WT Tech. Designs.
	* Version : WT Neoncart Banner Manager 1.0
*/
class zcAjaxWTBnrMgr extends base
{
    public function bnrClick(){
        global $db, $zco_notifier, $currencies, $messages;
		$messages = array();
		$zco_notifier->notify('NOTIFY_HEADER_START_WT_BANNER_MANAGER_CLICK');
		if(isset($_POST['bnr_id']) && $_POST['bnr_id'] != ''){
			$bnr_id = $_POST['bnr_id'];
			$banner_query = "select wtwbmb_id, wtwbmb_image, wtwbmb_url
                         from " . TABLE_WT_NEONCART_BANNER_MANAGER_BANNERS . "
                         where wtwbmb_status = 1
                         and wtwbmb_id = '" . (int)$bnr_id . "'";

			$banner = $db->Execute($banner_query);
			
			if($banner->RecordCount() > 0){
				$messages['messages'] = wtwbm_update_banner_click_count($banner->fields['wtwbmb_id']);
			}
		}
		return $messages;
		$zco_notifier->notify('NOTIFY_HEADER_END_WT_BANNER_MANAGER_CLICK');
    }

}
