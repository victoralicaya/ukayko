<li>
	<div class="dropdown">
	  <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false"><?php echo ucfirst( $_SESSION['language'] ); ?></button>
	  <ul class="dropdown-menu">
		<?php include(DIR_WS_MODULES . zen_get_module_directory('header_languages.php')); ?>
	  </ul>
	</div>
</li>
