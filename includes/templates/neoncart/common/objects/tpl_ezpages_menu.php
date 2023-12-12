<?php
 /**
   * require code to show EZ-Pages list
   */
  include(DIR_WS_MODULES . zen_get_module_directory('ezpages_bar_header.php'));
?>
<?php if (!empty($var_linksList)) { ?>
  <ul class="submenu level1">
<?php for ($i=1, $n=sizeof($var_linksList); $i<=$n; $i++) {  ?>
    <li><a href="<?php echo $var_linksList[$i]['link']; ?>"><?php echo $var_linksList[$i]['name']; ?></a></li>
<?php } // end FOR loop ?>
  </ul>
<?php } ?>
