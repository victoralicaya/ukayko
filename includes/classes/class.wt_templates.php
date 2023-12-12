<?php
#WT_TEMPLATES_BASE#

if (!defined('IS_ADMIN_FLAG')) {
      die('Illegal Access');
}
class wtTemplatesClass extends base {
  
	public function __construct() {  
	}
  
	function getWtMessages( $type = 'success', $message = '' ) {
		$msg = array();
		$GLOBALS['zco_notifier']->notify('NOTIFIER_START_WT_MESSAGES', $message);
		if ( $type == 'error' ) {
			$msg = sprintf( WT_TEXT_ERROR_MSGS, $message );
		} else if( $type == 'success' ) {
			$msg = sprintf( WT_TEXT_SUCCESS_MSGS, $message );
		} else if( $type == 'warning' ) {
			$msg = sprintf( WT_TEXT_WARNING_MSGS, $message );
		} else if( $type == 'info' ) {
			$msg = sprintf( WT_TEXT_INFO_MSGS, $message );
		}
		$msg = array( 'status' => $type, 'message' => $msg );
		$GLOBALS['zco_notifier']->notify('NOTIFIER_END_WT_MESSAGES', $type, $msg);
		return $msg;
	}
	
	function setMessagesStatus( $messages ) {
		if ( !empty( $messages['msgs'] ) ) {
			$messages['message'] = '';
			$messagesStatusFlag = true;
			foreach( $messages['msgs'] as $k => $message ) {
				if( !empty( $message['message'] ) ) {
					$messages['message'] .= $message['message'];
				}
				if ( $message['status'] != 'success' ) {
					$messagesStatusFlag = false;
				}
			}
			$messages['status'] = $messagesStatusFlag;
			unset($messages['msgs']);
		}
		return $messages;
	}
}    