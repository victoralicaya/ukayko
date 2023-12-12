<?php
if (isset($currencies) && is_object($currencies) && isset( $currencies->currencies[$_SESSION['currency']] ) ) {
	$cur_currencies = $currencies->currencies[$_SESSION['currency']];
	$symbole = (zen_not_null($cur_currencies['symbol_left']) ? $cur_currencies['symbol_left'] : $cur_currencies['symbol_right']);
	$title = (zen_not_null($cur_currencies['title']) ? $cur_currencies['title'] : '');
?>
<li>
	<div class="dropdown">
	  <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
		<?php echo $symbole; ?><?php echo $title;?>
	  </button>
	  <ul class="dropdown-menu">
		<?php include(DIR_WS_MODULES . zen_get_module_directory('header_currencies.php')); ?>
	  </ul>
	</div>
</li>
<?php } ?>
