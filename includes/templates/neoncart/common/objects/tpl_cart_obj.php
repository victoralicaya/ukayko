<div class="sidebar-menu-wrapper">
	<div class="cart_sidebar">
		<button type="button" class="close_btn round-close" aria-label="Close"><i class="fal fa-times"></i></button>
		<?php
		//BOF WTAjxcart
		require(DIR_WS_MODULES. 'sideboxes/'.$template_dir. '/wt_ajax_shopping_cart.php');
		//EOF WTAjxcart
		?>
	</div>
	<div class="overlay"></div>
</div>