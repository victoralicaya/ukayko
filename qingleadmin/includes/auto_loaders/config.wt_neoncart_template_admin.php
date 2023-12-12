<?php
#WT_NEONCART_TEMPLATE_BASE#
if (!defined('IS_ADMIN_FLAG')) {
	die('Illegal Access');
}
                             
$autoLoadConfig[999][] = array(
    'autoType' => 'class',
    'loadFile' => 'observers/wt_neoncart_template_admin_observer.php',
    'classPath' => DIR_WS_CLASSES
);
$autoLoadConfig[999][] = array(
    'autoType' => 'classInstantiate',
    'className' => 'wtNeoncartTemplateAdminObserver',
    'objectName' => 'wtNeoncartTemplateAdminObserver'
);