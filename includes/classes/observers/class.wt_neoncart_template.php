<?php
#WT_NEONCART_TEMPLATE_BASE#
class wtNeoncartTemplateObservers extends base 
{
	public function __construct()
	{
		$this->attach($this, array(
            'NOTIFY_ZEN_CSS_BUTTON_SUBMIT',
            'NOTIFY_ZEN_CSS_BUTTON_BUTTON',
            'NOTIFY_ZEN_DRAW_PULL_DOWN_MENU',
            'NOTIFY_ZEN_DRAW_INPUT_FIELD',
            //'NOTIFY_OPTIMIZE_IMAGE',
        ));
	}
 
	function update(&$class, $eventID, $pa, &$p1 = NULL, &$p2 = NULL, &$p3 = NULL, &$p4 = NULL, &$p5 = NULL, &$p6 = NULL)
	{
		switch($eventID)
		{
			case 'NOTIFY_ZEN_CSS_BUTTON_SUBMIT':
				$this->notifyZenCssButtonSubmit( $pa, $p1 );
				break;
			case 'NOTIFY_ZEN_CSS_BUTTON_BUTTON':
				$this->notifyZenCssButtonButton( $pa, $p1 );
				break;
			case 'NOTIFY_ZEN_DRAW_PULL_DOWN_MENU':
				$this->notifyZenDrawPullDownMenu( $pa, $p1 );
				break;
			case 'NOTIFY_ZEN_DRAW_INPUT_FIELD':
				$this->notifyAddFormControlClass( $pa, $p1 );
				break;
			case 'NOTIFY_OPTIMIZE_IMAGE':
				$this->notifyOptimizeImage( $pa, $p1, $p2, $p3, $p4, $p5, $p6 );
				break;
		}
	}
	
	function notifyZenCssButtonSubmit( $pa, &$css_button ){
		if ( !empty( $pa ) ) {
			$text = $pa['text'];
			$parameters = $pa['parameters'];
			$sec_class = $pa['sec_class'];
			$mouse_out_class  = 'submit_button button btn' . $sec_class;
			$css_button = '<input class="' . $mouse_out_class . '" type="submit" value="' . $text . '"' . $parameters . ' />';
		}
	}
	
	function notifyZenCssButtonButton( $pa, &$css_button ){
		if ( !empty( $pa ) ) {
			$text = $pa['text'];
			$parameters = $pa['parameters'];
			$sec_class = $pa['sec_class'];
			$mouse_out_class  = 'normal_button button btn' . $sec_class;
			$css_button = '<span class="' . $mouse_out_class . '" ' . $parameters . '>&nbsp;' . $text . '&nbsp;</span>';
		}
	}
	
	function notifyZenDrawPullDownMenu( $pa, &$field ){
		if(!empty($field)){
			$field = '<div class="select-wrapper">'.$field.'</div>';
		}
	}
	
	function notifyAddFormControlClass( $pa, &$field ){
		if ( !empty( $pa ) && !empty( $field ) ) {
			if ( !empty( $field ) ) {
				$matches = array();
				$add_classes = 'form-control';
				preg_match('/class=\"(.*?)\"/i', $field, $matches);
				if ( !empty( $matches ) ) {
					$replace_classes = $matches[1] . ' ' . $add_classes;
					$final_class_str = str_replace( $matches[1], $replace_classes, $matches[0] );
					$field = str_replace( $matches[0], $final_class_str, $field );
				}
				/*else {
					$replace_classes = $exp_field_last . $add_classes;
					$exp_field = preg_split( '#\s+#', $field );
					$exp_field_last = end( $exp_field );
					$field = str_replace( $exp_field_last, ' class="' . $add_classes . '" ' . $exp_field_last, $field);
				}*/
			}
		}
	}
	
	function notifyOptimizeImage( $template_dir, &$src, $alt, $width, $height, &$parameters ){
	
		if ( !empty( $parameters ) ) {
			preg_match('/lazyload=["\'](.*?)\"/i', $parameters, $matches);
			if ( !empty( $matches ) && $matches[1] == 'true' ) {
				$parameters = str_replace( $matches[0], '', $parameters );
				$parameters .= 'data-src="' . $src . '"';
				preg_match('/data-placeholder=["\'](.*?)\"/i', $parameters, $placeholder_matches);
				if ( !empty( $placeholder_matches ) && !empty( $placeholder_matches[1] ) ) {
					$src = '';
				}
			}
		}		
	}
}