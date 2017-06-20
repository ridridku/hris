<?php

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
$LANG  = base64_encode("indonesia");
$_SESSION['THEME']	= $THEME;
$_SESSION['LANG']       = $LANG;



////=================================== CONFIGURATION FILE=======================================================
//# including the proper language file
//require_once($DIR_LANG.'/'.base64_decode($_SESSION['LANG']).'.lang.php');
//# including the proper theme template file and also generate output
////require_once($DIR_INC.'/copyright.tpl');
//
//# including Header file for Smarty Parser Configurator
//require_once($DIR_INC."/libs.inc.php");
//# setting Smarty Class Debugger
////$smarty->debugging = true;

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
$session_nama   = $_SESSION['SESSION_NAMA'];
$session_tahun	= $_SESSION['SESSION_TAHUN'];
$session_bulan	= $_SESSION['SESSION_BULAN'];  
                   

$smarty->assign ("SESSION_NAMA", $session_nama);
$smarty->assign ("SESSION_TAHUN", $session_tahun);
$smarty->assign ("SESSION_BULAN", $session_bulan);


 $sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_bulan,r_periode__payroll_tahun,r_periode__payroll_status
                                  FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
//  var_dump($sql_cek_periode)or die();
$rs_val = $db->Execute($sql_cek_periode);
$periode_bulan= $rs_val->fields['r_periode__payroll_bulan'];
$periode_tahun= $rs_val->fields['r_periode__payroll_tahun'];  
$smarty->assign ("PERIODE_TAHUN", $periode_tahun);
$smarty->assign ("PERIODE_BULAN", $periode_bulan);


# Finally Grab All Parsed variables, parse it into the template, and generate ouput
# Clear Cache First
$smarty->clear_cache (base64_decode($_SESSION['THEME']).'/modules/'.$DOC_SELF_NAME_ONLY.'.tpl');
# Parsing the proper theme template & Generate Output
$smarty->display (base64_decode($_SESSION['THEME']).'/modules/'.$DOC_SELF_NAME_ONLY.'.tpl');

# Store all the JavaScript  for this pages into /javascripts/file_name  and include it here (bottom page)
//require_once($DIR_JS.'/'.$DOC_SELF_NAME_ONLY.'.js');

}

?>