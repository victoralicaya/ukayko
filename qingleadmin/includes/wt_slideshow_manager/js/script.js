/**
 * WT Slideshow Manager for Zen Cart.
 * WARNING: Do not change this file. Your changes will be lost.
 *
 * @copyright 2021 WT Tech. Designs.
 * Version : WT Slideshow Manager 1.0
 */
// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    wtsm_general_functions();
	
});

function wtsm_general_functions() {
	$( 'body' ).on( 'change', '[name="wtsm_full_screen"]', function(){
		wtsm_slider_full_screen( $("input[name='wtsm_full_screen']:checked").val() );
	} );
	$( 'body' ).on( 'change', '#wtsmb_type', function(){
		wtsmb_banner_fields_handler( $(this).val() );
	} );
	$( 'body' ).on( 'change', '#wtsmb_cp', function(){
		wtsm_content_custom_postion( $(this).val() );
	} );
	wtsmb_banner_fields_handler( $("#wtsmb_type option:selected").val() );
	wtsm_slider_full_screen( $("input[name='wtsm_full_screen']:checked").val() );

}
function wtsm_slider_full_screen( action ) {
	if ( action == 1 ) {
		$( '.wtsm-fs-group' ).addClass('hidden');
	} else {
		$( '.wtsm-fs-group' ).removeClass('hidden');
	}
}
function wtsmb_banner_fields_handler( bType ) {
	$( '.wtsmb_fields_group' ).addClass('hidden');
	wtsm_content_custom_postion('');
	$( '.wtsmb_fields_group'+'.'+bType ).removeClass('hidden');
}
function wtsm_content_custom_postion( cpPos ) {
	$( '.wtsmb_custom_postion' ).addClass('hidden');
	if ( cpPos == 'cp-custom' ) {
		$( '.wtsmb_custom_postion' ).removeClass('hidden');
	}
}