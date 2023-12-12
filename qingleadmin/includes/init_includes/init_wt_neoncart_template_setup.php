<?php 
#WT_NEONCART_TEMPLATE_BASE#

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}
//define('STRICT_ERROR_REPORTING', true);

global $messageStack;
$install_incomplete=false;
$no_template=false;

//chk is login, cur template**************************************************************************
// do not run installer on log in page
if(isset($_SESSION['admin_id']) && $_SESSION['admin_id']==0)
{
	$install_incomplete=true;
}

// find current template
$sql = "SELECT template_dir FROM ".TABLE_TEMPLATE_SELECT." LIMIT 1";
$obj = $db->Execute($sql);
$current_template = $obj->fields['template_dir'];
if($current_template == '' )
{
	$install_incomplete = true;
	$no_template = true;
}
//EOF chk is login, cur template**************************************************************************

if(!$install_incomplete && !$no_template ){	
	global $db;
	$table_exits=wt_neoncart_checkdb_tables(WT_NEONCART_TEMPLATE_TABLES);
	//************************************* SQL FILE SETUP *******************************************/
	if(empty($table_exits) && (isset($_GET['wt_install']) && $_GET['wt_install']=1) ){
		wt_neoncart_execute_sql(WT_NEONCART_TEMPLATE_SQL,DB_DATABASE,DB_PREFIX);
	}
	if(empty($table_exits)){
		$messageStack->add('Install Neoncart template settings : <a href="'.zen_href_link(basename($PHP_SELF),'wt_install=1','SSL').'">Click to Install</a>', 'success');
	}
	//************************************* EOF SQL FILE SETUP ***************************************/
}
if(isset($_GET['wt_install_force']) && $_GET['wt_install_force']==1 ){	
	global $db;
	//************************************* SQL FILE SETUP *******************************************/
		wt_neoncart_execute_sql_force(WT_NEONCART_TEMPLATE_SQL_FORCE, DB_DATABASE,DB_PREFIX);
	//************************************* EOF SQL FILE SETUP ***************************************/
}

