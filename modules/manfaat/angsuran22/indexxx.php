<?php

# Including Main Configuration
# including file for Main Configurations
require_once('../../../includes/config.conf.php');	 	

# Create a session to store global config path
session_save_path($DIR_SESS);
$expiry = 172800;
session_set_cookie_params($expiry);
session_start();

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
	require_once('../../../includes/header.redirect.inc');
	
} else {

//yang harus dibuat session
$THEME = base64_encode("defaults");
$LANG = base64_encode("indonesia");
$_SESSION['THEME']	= $THEME;
$_SESSION['LANG']   = $LANG;

#FOR IMAGES CLASS PAGER
$HREF_IMAGES = $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images');

# including Header file for Content Expiring
require_once($DIR_INC.'/header.exp.inc');
# including Header file for Database Configuration
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');

$p = new Pager; 
$db = &ADONewConnection($DB_TYPE);
//$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

# including the proper language file
require_once($DIR_LANG.'/'.base64_decode($_SESSION['LANG']).'.lang.php');
# including the proper theme template file and also generate output
# require_once($DIR_INC.'/copyright.tpl');

//=================================== BEGIN PARSING TEMPLATE BLOCK====================================

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
$smarty->assign ("SELF", $_SERVER['PHP_SELF']);

//------------------------------------LOCAL CONFIG--------------------------------------//
#SETTING FOR TEMPLATE 
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/manfaat/angsuran';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/manfaat');
$FILE_JS  = $JS_MODUL.'/angsuran';


#Initiate TABLE
$tbl_name	= "tbl_sys_master_privileges";
$field_name	= "priv";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

//$user_id = $_GET['user_id'];
$user_id='admin';
$menu_id = $_GET['menu_parent'];

$sql = "SELECT a.*,DATE_FORMAT(a.user_date_join,'%D %M %Y %r') as user_date_join, CONCAT(a.user_first_name, ' ', a.user_last_name) as user_full_name FROM tbl_sys_master_user as a WHERE a.user_id = '$user_id' ";
//var_dump($sql)or die();
$result = $db->Execute($sql);

$smarty->assign ("USER_ID", $result->fields['user_id']);
$smarty->assign ("USER_FULL_NAME", $result->fields['user_full_name']);
$smarty->assign ("USER_DATE_JOIN", $result->fields['user_date_join']);
$smarty->assign ("USER_ADDRESS", $result->fields['user_address']);
$smarty->assign ("USER_GENDER", $result->fields['user_gender']);
$smarty->assign ("USER_EMAIL", $result->fields['user_email']);
$smarty->assign ("USER_TELP", $result->fields['user_telp']);


$sql = "SELECT a.* FROM tbl_sys_master_menu as a WHERE a.menu_level = '0' AND a.menu_active = '1' ";
$result_menu_parent = $db->Execute($sql);
$jumlah_menu_cek = $result_menu_parent->RecordCount();
$menu_parent = array();

$initSet = array();
$row_class = array();

$z=0;
while($arr = $result_menu_parent->FetchRow()){
array_push ($menu_parent, $arr);
if ($z%2==0){ 
		$ROW_CLASSNAME="#CCCCCC"; }
	else {
		$ROW_CLASSNAME="#EEEEEE";
	   }
	array_push($row_class, $ROW_CLASSNAME);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("MENU_PARENT", $menu_parent);
$smarty->assign ("ROW_CLASSNAME", $row_class);
$smarty->assign ("MENU_ID", $menu_id);


$sql ="SELECT a.*, b.* FROM tbl_sys_master_privileges as a INNER JOIN tbl_sys_master_menu as b ON a.priv_menu_id = b.menu_id WHERE b.menu_level = '0' AND b.menu_active = '1' AND priv_user_id = '$user_id'   ";
//var_dump($sql)or die();
$rs_cek_list_parent = $db->execute($sql);

$arr_cek_list = array();
$daftar_parent_menu = array();

while($arr = $rs_cek_list_parent->FetchRow()){
	array_push ($arr_cek_list, $arr);

	$daftar_parent_menu[] = $arr['menu_id'];
        

}
//var_dump($daftar_parent_menu)or die();
//masih dogol...
/*** Debug
End Debug ***/
$implode_daftar_parent_id= implode(",",$daftar_parent_menu);

for($x=0; $x<count($implode_daftar_parent_id); $x++){
	echo "daftar_parent_id:".$implode_daftar_parent_id[$x]."</br>";
}

$smarty->assign ("IMPLODE_DAFTAR_PARENT_ID", $implode_daftar_parent_id);


$smarty->assign ("ARR_CEK_LIST", $arr_cek_list);
$smarty->assign ("JUM_SUPER_PARENT", $jumlah_menu_cek);
$smarty->assign ("USER_ID", $user_id);

$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_USER_PRIV);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_USER_PRIV);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("TITLE", _TITLE_user_PRIV);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_user_PRIV);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);

# Finally Grab All Parsed variables, parse it into the template, and generate ouput
# Clear Cache First
$smarty->clear_cache ($TPL_PATH.'/'.$DOC_SELF_NAME_ONLY.'.tpl');
# Parsing the proper theme template & Generate Output
$smarty->display ($TPL_PATH.'/'.$DOC_SELF_NAME_ONLY.'.tpl');
//require_once($DIR_THEME.'/'.base64_decode($_SESSION['THEME']).$DOC_SELF_PATH.$DOC_SELF_NAME_ONLY.'.tpl');
//=================================== END PARSING TEMPLATE BLOCK====================================
# Store all the JavaScript  for this pages into /javascripts/file_name  and include it here (bottom page)
require_once($FILE_JS.'/'.$DOC_SELF_NAME_ONLY.'.js');

# AdoDb closed here
$db->Close();
}
?>