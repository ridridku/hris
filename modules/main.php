<?php
/*****************************************************************************
 *                                                                           *
 * SISTEM INFORMASI KEMISKINAN                                               *
 * Copyright © 2007 Iie Sumitra™ Production®.								 *
 * Created by : iie sumitra                                                  *
 * Email	  : iiesumit@yahoo.com                                           *
 *																			 *
 ****************************************************************************/

# Including Main Configuration
# including file for Main Configurations
require_once('../includes/config.conf.php');	 	


# Create a session to store global config path
session_save_path($DIR_SESS);
$expiry = 60*120;
session_set_cookie_params($expiry);
session_start();



//yang harus dibuat session
$THEME = base64_encode("default");
$LANG = base64_encode("indonesia");
$_SESSION['THEME']	= $THEME;
$_SESSION['LANG']   = $LANG;




//=================================== CONFIGURATION FILE====================================
# including Header file for Content Expiring
require_once($DIR_INC.'/header.exp.inc');
# including Header file for Database Configuration
require_once($DIR_INC.'/db.conf');
require_once($DIR_ADODB.'/adodb.inc.php');

# AdoDb Initialize here
$db = &ADONewConnection($DB_TYPE);
//$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

# including the proper language file
require_once($DIR_LANG.'/'.base64_decode($_SESSION['LANG']).'.lang.php');
# including the proper theme template file and also generate output
require_once($DIR_INC.'/copyright.tpl');

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





$sql  = "SELECT * FROM tbl_master_identitas_pekerjaan ";
$recordSet = $db->Execute($sql);
$test = array();
while($arr = $recordSet->FetchRow()){
array_push ($test, $arr);
}



$iie = "iie kasep sekali yaaaa kemana aja kleiiii.....<br>";


$smarty->assign ("TEST", $test);
$smarty->assign ("BAHASA", _BAHASA);






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