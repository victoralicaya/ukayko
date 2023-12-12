<?php
#WT_NEONCART_TEMPLATE_BASE#

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
} 

$autoLoadConfig[999][] = array(
    'autoType' => 'init_script',
    'loadFile' => 'init_wt_neoncart_template_setup.php'
 );  
