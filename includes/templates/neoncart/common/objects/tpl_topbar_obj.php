<?php if( $display_promo_topbar && !empty( $promo_topbar_content ) ) { ?>
<div class="tt-top-panel" id="js-tt-top-panel">
	<div class="container">
		<div class="tt-row">
			<div class="tt-description">
				<?php echo $promo_topbar_content; ?>
			</div>
			<button class="tt-btn-close"></button>
		</div>
	</div>
</div>
<?php } ?>