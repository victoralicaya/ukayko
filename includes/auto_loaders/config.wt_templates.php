<?php
#WT_TEMPLATES_BASE#
if (!defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}

$autoLoadConfig[0][] = array(
    'autoType' => 'class',
    'loadFile' => 'class.wt_templates.php'
);
$autoLoadConfig[999][] = array(
    'autoType' => 'classInstantiate',
    'className' => 'wtTemplatesClass',
    'objectName' => 'WTClass',
    'checkInstantiated' => true,
    'classSession' => true
);