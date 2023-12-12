<?php
#WT_NEONCART_TEMPLATE_BASE#
if (!defined('IS_ADMIN_FLAG') || IS_ADMIN_FLAG !== true) {
    die('Illegal Access');
}

class wtNeoncartTemplateAdminObserver extends base 
{
    public function __construct() {
        $this->attach (
            $this, 
            array( 
                'NOTIFY_MODULES_COPY_TO_CONFIRM_DUPLICATE',
				'NOTIFY_MODULES_UPDATE_PRODUCT_END',
                'NOTIFY_ADMIN_PRODUCT_COLLECT_INFO_EXTRA_INPUTS',
            ) 
        );
    }
  
    public function update(&$class, $eventID, $pa, &$p1, &$p2) {
        global $db;
        
        switch ($eventID) {
           
            case 'NOTIFY_MODULES_COPY_TO_CONFIRM_DUPLICATE':
				$this->duplicateProductsFamilyInputes($class, $eventID, $pa);
                break;
			case 'NOTIFY_MODULES_UPDATE_PRODUCT_END':
				$this->updateProductsFamilyInputes($class, $eventID, $pa);
                break;
            case 'NOTIFY_ADMIN_PRODUCT_COLLECT_INFO_EXTRA_INPUTS':
				$this->generateProductsFamilyInpute($class, $eventID, $pa, $p1, $p2);
                break;
            default:
                break;
        }
    }
	
	protected function updateProductsFamilyInputes ( &$class, $eventID, $pa ) {
		
		if ( !empty( $pa['action'] ) && !empty( $pa['products_id'] ) && !empty( $_POST['products_related'] ) ) {
			$sql_data_array = array(
				'products_related' => zen_db_prepare_input($_POST['products_related'])
			);
			zen_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id='" .$pa['products_id']. "'" );
		}
		
	}
	
	protected function duplicateProductsFamilyInputes ( &$class, $eventID, $pa ) {
		
		if ( !empty( $pa['products_id'] ) && !empty( $pa['dup_products_id'] ) ) {
			global $db;
			$product = $db->Execute("SELECT products_related FROM " . TABLE_PRODUCTS . " WHERE products_id = " . $pa['products_id']);
			if ( $product->RecordCount() > 0 && !empty( $product->fields['products_related'] ) ) {
				$sql_data_array = array('products_related' =>  zen_db_prepare_input($product->fields['products_related']));
				zen_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id='" .$pa['dup_products_id']. "'" );
			}	
		}
		
	}
	
	protected function generateProductsFamilyInpute ( &$class, $eventID, $pInfo, &$extra_product_inputs ) {
		$products_related_inputs_ar = array(
			'label' => array(
					'text' => TEXT_PRODUCTS_RELATED,
					'field_name' => 'products_related',
					'addl_class' => '',
					'parms' => '',
				),
			'input' => zen_draw_input_field('products_related', $pInfo->products_related, 'class="form-control" id="products_related"')
		);
		if ( !empty( $products_related_inputs_ar ) ) {
			$extra_product_inputs[] = $products_related_inputs_ar;
		}
	}
}
