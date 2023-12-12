<div class="tt-multi-obj tt-dropdown-obj">
	<button class="tt-dropdown-toggle" data-tooltip="Settings" data-tposition="bottom"><i class="icon-f-79"></i></button>
	<div class="tt-dropdown-menu">
		<div class="tt-mobile-add">
			<button class="tt-close"><?php echo TEXT_CLOSE; ?></button>
		</div>
		<div class="tt-dropdown-inner">
			<ul>
				<?php include(DIR_WS_MODULES . zen_get_module_directory('header_languages.php')); ?>
			</ul>
			<ul>
				<?php include(DIR_WS_MODULES . zen_get_module_directory('header_currencies.php')); ?>
			</ul>
		</div>
	</div>
</div>