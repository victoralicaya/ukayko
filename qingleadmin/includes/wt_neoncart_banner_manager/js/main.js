/**
 * WT Promo Offers for Zen Cart.
 * WARNING: Do not change this file. Your changes will be lost.
 *
 * @copyright Copyright 2021 WT Tech. Pvt. Ltd.
 * Version : WT Promo Offers 1.1
 */
// In your Javascript (external .js resource or <script> tag)
jQuery(document).ready(function() {
    wt_general_functions();
});
function wt_general_functions(){
	jQuery('.sel-drpwn').select2({
		width : '100%',
	});
}