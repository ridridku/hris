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


			$date_now = strtotime('now');
			$ip_now = $_SERVER['REMOTE_ADDR'];
			$user_id = base64_decode($_SESSION['UID']);

			$sql="INSERT INTO tbl_sys_history_log_user (log_user_id, log_logout_date, log_logout_host)  VALUES ('$user_id','$date_now','$ip_now') ";
			$db->Execute($sql);


				$sql2="INSERT INTO tbl_log (url, waktu,   module, user_id )  VALUES ('$ip_now',now(),'Keluar Aplikasi','$user_id') ";
				$db->Execute($sql2);
			
		$TARGET	= $HREF_HOME."/index2.php";

		$_SESSION['UID']='';
		unset($_SESSION['LANG']);
		unset($_SESSION['THEME']);
		unset($_SESSION['UID']);
		unset($_SESSION['SESSION_TAHUN']);
		unset($_SESSION['SESSION_JNS_JLN']);
		unset($_SESSION['SESSION_NO_PROPINSI']);
		unset($_SESSION['SESSION_NO_KABUPATEN']);

		session_unset();
		session_destroy();
?>

		<SCRIPT LANGUAGE="JavaScript">
		parent.location ='<?php echo $TARGET; ?>';
		</SCRIPT>
		
<?php
		
# Finally Grab All Parsed variables, parse it into the template, and generate ouput
# Clear Cache First
$smarty->clear_cache ($DIR_THEME.'/'.base64_decode($_SESSION['THEME']).'/'.$DOC_SELF_NAME_ONLY.'.tpl');
# Parsing the proper theme template & Generate Output
$smarty->display ($DIR_THEME.'/'.base64_decode($_SESSION['THEME']).'/'.$DOC_SELF_NAME_ONLY.'.tpl');

# Store all the JavaScript  for this pages into /javascripts/file_name  and include it here (bottom page)
//require_once($DIR_JS.'/'.$DOC_SELF_NAME_ONLY.'.js');

# AdoDb closed here
$db->Close();

?>