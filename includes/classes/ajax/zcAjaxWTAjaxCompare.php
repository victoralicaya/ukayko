<?php
/**
 * WT AjaxCompare for Zen Cart.
 * WARNING: Do not change this file. Your changes will be lost.
 *
 * @copyright 2021 WT Tech. Designs.
 * Version : WT AjaxCompare 1.0
 */
class zcAjaxWTAjaxCompare extends base
{
    public function ajaxCompare(){
        global $db, $zco_notifier, $currencies;
		$zco_notifier->notify('NOTIFY_HEADER_START_WT_AJX_COMPARE');
		$messages = array( 'status' => true );
		if ( !empty( $_POST['wt_action'] ) && !empty( $_POST['compare_id'] ) ) {
			if ( !isset( $_SESSION['compare'] ) ) $_SESSION['compare'] = 0;
			$comp_value_count = ( !empty( $_SESSION['compare'] ) ) ? count($_SESSION['compare']) : 0;
			$action = $_POST['wt_action'];
			$cid = $_POST['compare_id'];
			$compare_array = array();
			// add new products selected
			if ( $action == 'add' ) {
				if ( $comp_value_count < COMPARE_VALUE_COUNT ) {
					$compare_array[] = $cid;
					foreach ((array)$_SESSION['compare'] as $c) {
						if ($c != $cid) {
							$compare_array[] = $c;
						}
					}
					$_SESSION['compare'] = array_unique(array_filter($compare_array));
					$messages['msgs'][] = $_SESSION['WTClass']->getWtMessages( 'success', COMPARE_PRODUCTS_ADDED );
				} else {
					$messages['msgs'][] = $_SESSION['WTClass']->getWtMessages( 'warning', COMPARE_ONETIME_ITEM_COMPARE );
				}
			} else if ( $action == 'remove' ) {
				$removed_compare_array = array();
				if ( !empty( $_SESSION['compare'] ) ) {
					foreach ( $_SESSION['compare'] as $rValue ) {
						if ( $rValue != $cid ) {
							$removed_compare_array[] = $rValue;
						}
					}
					$_SESSION['compare'] = array_unique(array_filter($removed_compare_array));
				}
			}
			$messages['compare_count'] = count($_SESSION['compare']);
			$messages['pop_timer'] = 2000;
			
		} else {
			$messages['msgs'][] = $_SESSION['WTClass']->getWtMessages( 'error', COMPARE_ERROR_TRY_AGAIN );
		}
		$messages = $_SESSION['WTClass']->setMessagesStatus( $messages );
		$zco_notifier->notify( 'NOTIFY_HEADER_END_WT_AJX_COMPARE', $messages );
		return $messages;
    }
}
