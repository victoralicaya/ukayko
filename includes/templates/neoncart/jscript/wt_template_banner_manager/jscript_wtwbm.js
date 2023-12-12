/**
	* WT Neoncart Banner Manager for Zen Cart.
	* WARNING: Do not change this file. Your changes will be lost.
	*
	* @copyright 2021 WT Tech. Designs.
	* Version : WT Neoncart Banner Manager 1.0
*/
jQuery(document).ready(function(){
	jQuery('body').on('click', '.bnr-click', function(e) {
		var $this = $(this);
		if( $this.data("bnr-id") && $this.data("href") ) {
			e.preventDefault();
			var d= new FormData(),
			time = 1000,
			url = $this.data("href");
			d.append('bnr_id', $this.data("bnr-id"));
			try {
				jQuery.ajax({
					type : 'POST',
					url  : 'ajax.php?act=ajaxWTBnrMgr&method=bnrClick',
					dataType : 'json',
					contentType: false, // The content type used when sending data to the server.
					cache: false,  // To unable request pages to be cached
					processData:false,  
					data:d,
					success :function(data){
						if(data.messages.status == 'success'){
							if(url){
								window.setTimeout(function(){document.location.href=url;}, time);
								return -1;
							}	
						}
					},
					error: function(xhr, textStatus, errorThrown) {
						var err = eval("(" + xhr.responseText + ")");
						alert("Error: " + xhr.status + ": " + xhr.statusText);
					}
				});
			} catch (e) {
			}
		}
	});
});