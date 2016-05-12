<?php

/*** Modify by Agus Somantri
	 20-02-2010
***/

# Including Main Configuration
# including file for Main Configurations
require_once('../includes/config.conf.php');	 	

# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
	header("Location:".$HREF_HOME."/");
	require_once('../includes/header.redirect.inc');
}else{

//yang harus dibuat session
$THEME = base64_encode("defaults");
$LANG = base64_encode("indonesia");
$_SESSION['THEME']	= $THEME;
$_SESSION['LANG']   = $LANG;

if($_SESSION['SESSION_JNS_JLN']==0){
	$get_jl	= "Administrator";
	$rs_jl	= "Propinsi, Kabupaten/ Kota"; 
} else if($_SESSION['SESSION_JNS_JLN']==1){
	$get_jl	= "Provinsi";
	$rs_jl	= "Propinsi";
} else if($_SESSION['SESSION_JNS_JLN']==2){
	$get_jl	= "Kabupaten/ Kota";
	$rs_jl	= "Kabupaten/ Kota"; }

$th = $_SESSION['SESSION_TAHUN'];

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
$smarty->assign ("TITLE", _TITLE);
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

//=================================== END OF FILE CONFIGURATION====================================

$user_id = base64_decode($_SESSION['UID']);
$tgl_skr = date('now');

/*** Disabled 20-02-2010 
$sql_info = "select a.nama_propinsi, (select count(*) from tbl_mast_wil_kabupaten) as jumlah_kabupaten, 
 (select count(*) from tbl_mast_wil_kecamatan) as jumlah_kecamatan, 
 (select count(*) from tbl_mast_wil_kelurahan) as jumlah_kelurahan    
from tbl_mast_wil_propinsi a 
WHERE a.no_propinsi='64'";
***/

$sql_info = "select (select count(a.nama_propinsi)) as nama_propinsi, (select count(*) from tbl_mast_wil_kabupaten) as jumlah_kabupaten, 
 (select count(*) from tbl_mast_wil_kecamatan) as jumlah_kecamatan, 
 (select count(*) from tbl_mast_wil_kelurahan) as jumlah_kelurahan    
from tbl_mast_wil_propinsi a 
WHERE a.no_propinsi='71'";

$recordSet_info = $db->Execute($sql_info);
$smarty->assign ("NAMA_PROPINSI", $recordSet_info->fields[nama_propinsi]);
$smarty->assign ("JUMLAH_KABUPATEN", $recordSet_info->fields[jumlah_kabupaten]);
$smarty->assign ("JUMLAH_KECAMATAN", $recordSet_info->fields[jumlah_kecamatan]);
$smarty->assign ("JUMLAH_KELURAHAN", $recordSet_info->fields[jumlah_kelurahan]);

$sql  = "SELECT a.*,DATE_FORMAT(a.user_date_join,'%D %M %Y %r') as user_date_join,DATE_FORMAT(a.user_current_login_date,'%D %M %Y %r') as user_current_login_date, CONCAT(a.user_first_name,' ', a.user_last_name) as user_full_name FROM tbl_sys_master_user as a where user_id = '$user_id' ";
$recordSet = $db->Execute($sql);

$smarty->assign ("TAHUN", $th);
$smarty->assign ("LEVEL", $get_jl);
$smarty->assign ("JENIS_RUAS_JALAN", $rs_jl);
$smarty->assign ("USER_ID", $user_id);
$smarty->assign ("USER_NAME", $recordSet->fields['user_full_name']);
$smarty->assign ("USER_NICK", $recordSet->fields['user_first_name']);
$smarty->assign ("USER_DATE_JOIN", $recordSet->fields['user_date_join']);
$smarty->assign ("USER_ADDRESS", $recordSet->fields['user_address']);
$smarty->assign ("USER_TELEPON", $recordSet->fields['user_telp']);
$smarty->assign ("USER_EMAIL", $recordSet->fields['user_email']);
$smarty->assign ("USER_CURRENT_LOGIN_DATE", $recordSet->fields['user_current_login_date']);
$smarty->assign ("USER_CURRENT_LOGIN_IP", $_ENV[COMPUTERNAME]." [ ".$_ENV[OS].", ".$_ENV["PROCESSOR_IDENTIFIER"]." ] - ".$recordSet->fields['user_current_login_host']);

$sql = "SELECT a.* FROM tbl_sys_history_log_user as a where a.log_user_id = '$user_id' ORDER BY log_login_date DESC ";
$rec_log = $db->Execute($sql);
$rec_log->MoveNext(); 
$smarty->assign ("USER_LAST_LOGIN_DATE", date("l dS \o\f F Y h:i:s A",$rec_log->fields['log_login_date']));
$smarty->assign ("USER_LAST_LOGIN_HOST", $rec_log->fields['log_login_host']);

$sql = "SELECT a.* FROM tbl_sys_history_log_user as a where a.log_user_id = '$user_id' ORDER BY log_logout_date DESC ";
$rec_logout = $db->Execute($sql);
$smarty->assign ("USER_LAST_LOGOUT_DATE", date("l dS \o\f F Y h:i:s A",$rec_logout->fields['log_logout_date']));
$smarty->assign ("USER_LAST_LOGOUT_HOST", $rec_logout->fields['log_logout_host']);

# Finally Grab All Parsed variables, parse it into the template, and generate ouput
# Clear Cache First
$smarty->clear_cache (base64_decode($_SESSION['THEME']).'/modules/'.$DOC_SELF_NAME_ONLY.'.tpl');
# Parsing the proper theme template & Generate Output
$smarty->display (base64_decode($_SESSION['THEME']).'/modules/'.$DOC_SELF_NAME_ONLY.'.tpl');

# Store all the JavaScript  for this pages into /javascripts/file_name  and include it here (bottom page)
//require_once($DIR_JS.'/'.$DOC_SELF_NAME_ONLY.'.js');

# AdoDb closed here
$db->Close();
}
?>