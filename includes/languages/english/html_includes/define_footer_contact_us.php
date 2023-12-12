<ul class="ul_li_block clearfix">
	<li>
		<div class="item_icon">
			<i class="fas fa-map-marker-alt"></i>
		</div>
		<div class="item_content">
			<p class="mb-0">
				<?php echo $store_address; ?>
			</p>
		</div>
	</li>
	<li>
		<div class="item_icon">
			<i class="fas fa-phone-alt"></i>
		</div>
		<div class="item_content">
			<?php echo $store_contact; ?>
		</div>
	</li>
	<li>
		<div class="item_icon">
			<i class="fas fa-envelope"></i>
		</div>
		<div class="item_content">
			<p class="mb-0">Email: <a href="mailto:<?php echo $store_email; ?>"><?php echo $store_email; ?></a></p>
			<p class="mb-0"><?php echo $store_time; ?></p>
		</div>
	</li>
</ul>