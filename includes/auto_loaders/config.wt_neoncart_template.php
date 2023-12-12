<?php
#WT_NEONCART_TEMPLATE_BASE#

if (!defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}

$autoLoadConfig[111][] = array(
	'autoType' => 'init_script',
	'loadFile'=> 'init_wt_neoncart_template.php'
);

$autoLoadConfig[5000][] = array(
	'autoType' => 'init_script',
	'loadFile'=> 'init_wt_neoncart_template_config.php'
);

$autoLoadConfig[200][] = array(
	'autoType' => 'class',
	'loadFile' => 'observers/class.wt_neoncart_template.php'
);

$autoLoadConfig[200][] = array(
	'autoType' => 'classInstantiate',
	'className' => 'wtNeoncartTemplateObservers',
	'objectName' => 'wtNeoncartTemplateObservers'
);