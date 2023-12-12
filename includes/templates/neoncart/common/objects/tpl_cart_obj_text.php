<div class="tt-cart tt-cart02 tt-dropdown-obj wt-dropdown-obj wtajax-minicart" data-tooltip="Cart" data-tposition="bottom">
	<div class="minicart minicart-js sideboxwt-cart">
		<button class="tt-dropdown-toggle">
			<i class="icon-f-47"></i>
			<span class="tt-text"><?php echo HEADER_TOP_MY_CART_TEXT; ?></span>
			<span class="tt-badge-cart cart-count"><?php echo $_SESSION['cart']->count_contents(); ?></span>
		</button>
		<?php
		//BOF WTAjxcart
		require(DIR_WS_MODULES. 'sideboxes/'.$template_dir. '/wt_ajax_shopping_cart.php');
		//EOF WTAjxcart
		?>
	</div>
</div>