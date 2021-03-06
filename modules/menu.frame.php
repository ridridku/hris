<?php

# Including Main Configuration
# including file for Main Configurations

require_once('../includes/config.conf.php');	 	

# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();

//yang harus dibuat session
$THEME = base64_encode("defaults");
$LANG = base64_encode("indonesia");
$_SESSION['THEME']	= $THEME;
$_SESSION['LANG']   = $LANG;


//=================================== CONFIGURATION FILE====================================
# including Header file for Content Expiring
require_once($DIR_INC.'/header.exp.inc');
# including Header file for Database Configuration
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');

# AdoDb Initialize here
$db = &ADONewConnection($DB_TYPE);
//$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

# including the proper language file
require_once($DIR_LANG.'/'.base64_decode($_SESSION['LANG']).'.lang.php');
# including the proper theme template file and also generate output
//require_once($DIR_INC.'/copyright.tpl');

# including Header file for Smarty Parser Configurator
require_once($DIR_INC."/libs.inc.php");
# setting Smarty Class Debugger
//$smarty->debugging = true;

# Start Parsing the Template
#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);
$smarty->assign ("HREF_IMG_PATH", $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images'));
$smarty->assign ("HREF_CSS_PATH", $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/css'));
$smarty->assign ("HREF_JS_PATH", $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts'));

#DIR
$smarty->assign ("DIR_HOME_PATH", $DIR_HOME);
$smarty->assign ("DIR_IMG_PATH", $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images'));
$smarty->assign ("DIR_CSS_PATH", $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/css'));
$smarty->assign ("DIR_JS_PATH", $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts'));
$smarty->assign ("TITLE", _TITLE);
//=================================== END OF FILE CONFIGURATION====================================
$user_id = base64_decode($_SESSION['UID']);
//$HREF_MODUL_MASTER = $HREF_HOME ."/modules/data_master" ;
$HREF_MODUL_MASTER = $HREF_HOME ."/modules" ;
$smarty->assign ("DATA_MODULE", $HREF_MODUL_MASTER);

//parent level 0
$sql = "SELECT a.* FROM tbl_sys_master_menu as a INNER JOIN tbl_sys_master_privileges as b ON a.menu_id = b.priv_menu_id INNER JOIN tbl_sys_master_user as c ON b.priv_user_id = c.user_id ";
$sql .= "WHERE a.menu_level = '0' AND c.user_id = '$user_id' AND a.menu_active = '1' AND b.priv_view = '1' ORDER BY a.menu_id ASC ";

$resultSet = $db->Execute($sql);
$data_menu = array();
while ($arr=$resultSet->FetchRow()) {
	array_push($data_menu, $arr);
}

$smarty->assign ("DATA_MENU_PARENT", $data_menu);

//child level 1
$sql_child = " SELECT a.*,(SELECT COUNT(*) FROM tbl_sys_master_menu WHERE menu_level = '2' AND menu_parent=a.menu_id) as sum_child FROM tbl_sys_master_menu as a INNER JOIN tbl_sys_master_privileges as b ON a.menu_id = b.priv_menu_id INNER JOIN tbl_sys_master_user as c ON b.priv_user_id = c.user_id ";
$sql_child .= " WHERE a.menu_level = '1' AND c.user_id = '$user_id' AND a.menu_active = '1' AND b.priv_view = '1' ORDER BY a.menu_parent,a.menu_sort asc";
//var_dump($sql_child)or die();
$resultSet_child = $db->Execute($sql_child);
$data_menu_child = array();
while ($arr=$resultSet_child->FetchRow()) {
	array_push($data_menu_child, $arr);
}

$smarty->assign ("DATA_MENU_CHILD", $data_menu_child);

//sub child level 2
$sql_sub_child = " SELECT a.*  ,(SELECT COUNT(*) FROM tbl_sys_master_menu WHERE menu_level = '3' AND menu_parent=a.menu_id) as sum_child2 FROM tbl_sys_master_menu as a INNER JOIN tbl_sys_master_privileges as b ON a.menu_id = b.priv_menu_id INNER JOIN tbl_sys_master_user as c ON b.priv_user_id = c.user_id ";
$sql_sub_child .= " WHERE a.menu_level = '2' AND c.user_id = '$user_id' AND b.priv_view = '1' AND a.menu_active = '1' ORDER BY a.menu_sort ASC ";
$resultSet_sub_child = $db->Execute($sql_sub_child);

$data_menu_sub_child = array();
while ($arr=$resultSet_sub_child->FetchRow()) {
	array_push($data_menu_sub_child, $arr);
}

$smarty->assign ("DATA_MENU_SUB_CHILD", $data_menu_sub_child);


//sub child level 3
$sql_sub_child2 = " SELECT a.* FROM tbl_sys_master_menu as a INNER JOIN tbl_sys_master_privileges as b ON a.menu_id = b.priv_menu_id INNER JOIN tbl_sys_master_user as c ON b.priv_user_id = c.user_id ";
$sql_sub_child2 .= " WHERE a.menu_level = '3' AND c.user_id = '$user_id' AND b.priv_view = '1' AND a.menu_active = '1' ORDER BY a.menu_sort ASC ";
$resultSet_sub_child2 = $db->Execute($sql_sub_child2);

$data_menu_sub_child2 = array();
while ($arr=$resultSet_sub_child2->FetchRow()) {
	array_push($data_menu_sub_child2, $arr);
}

$smarty->assign ("DATA_MENU_SUB_CHILD2", $data_menu_sub_child2);


$smarty->assign ("HARI", $data_menu_sub_child);
$user_id = base64_decode($_SESSION['UID']);
$smarty->assign ("USER_ID", $user_id);

# Finally Grab All Parsed variables, parse it into the template, and generate ouput
# Clear Cache First
$smarty->clear_cache (base64_decode($_SESSION['THEME']).'/modules/'.$DOC_SELF_NAME_ONLY.'.tpl');
# Parsing the proper theme template & Generate Output
$smarty->display (base64_decode($_SESSION['THEME']).'/modules/'.$DOC_SELF_NAME_ONLY.'.tpl');

# Store all the JavaScript  for this pages into /javascripts/file_name  and include it here (bottom page)
//require_once($DIR_JS.'/'.$DOC_SELF_NAME_ONLY.'.js');


# AdoDb closed here
$db->Close();

?>