<?php
#WT_NEONCART_TEMPLATE_BASE#
define('TABLE_WT_NEONCART_TEMPLATE', DB_PREFIX . 'wt_neoncart_template');
define('TABLE_WT_SLIDER', DB_PREFIX.'wt_slider');
define('TABLE_WT_NEONCART_TOPBANNER', DB_PREFIX.'wt_neoncart_topbanner');
define('TABLE_WT_NEONCART_BOTTOMBANNER', DB_PREFIX.'wt_neoncart_bottombanner');
define('TABLE_WT_NEONCART_SIDEBARBANNER', DB_PREFIX.'wt_neoncart_sidebarbanner');
define('WT_NEONCART_TEMPLATE_SQL',  DIR_WS_INCLUDES.'wt_neoncart_template/sql/template_sql.sql');
define('WT_NEONCART_TEMPLATE_SQL_FORCE',  DIR_WS_INCLUDES.'wt_template/sql/force_sql.sql');
define('WT_NEONCART_TEMPLATE_CREATETABLE_SQL',  DIR_WS_INCLUDES.'wt_template/sql/template_createtable_sql.sql');
define('WT_NEONCART_TEMPLATE_TABLES', TABLE_WT_NEONCART_TEMPLATE.",".TABLE_WT_SLIDER.",".TABLE_WT_NEONCART_TOPBANNER.",".TABLE_WT_NEONCART_BOTTOMBANNER.",".TABLE_WT_NEONCART_SIDEBARBANNER);