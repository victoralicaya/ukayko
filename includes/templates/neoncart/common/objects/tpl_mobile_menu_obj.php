<div class="sidebar-menu-wrapper">
	<div class="cart_sidebar">
		<button type="button" class="close_btn"><i class="fal fa-times"></i></button>
		<?php
		//BOF WTAjxcart
		require(DIR_WS_MODULES. 'sideboxes/'.$template_dir. '/wt_ajax_shopping_cart.php');
		//EOF WTAjxcart
		?>
	</div>
	<div class="overlay"></div>
</div>

<!--<div class ="tt-cart tt-dropdown-obj" data-tooltip="Cart" data-tposition="bottom">
	<div class="minicart minicart-js sideboxwt-cart">
		<button class="tt-dropdown-toggle">
			<i class="icon-f-39"></i>
			<span class="tt-badge-cart cart-count""><?php echo $_SESSION['cart']->count_contents(); ?></span>
		</button>
		<?php
		//BOF WTAjxcart
		require(DIR_WS_MODULES. 'sideboxes/'.$template_dir. '/wt_ajax_shopping_cart.php');
		//EOF WTAjxcart
		?>
	</div>
</div>-->