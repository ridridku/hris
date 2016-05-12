<?php

//session_start();

# Including Main Configuration
# including file for Main Configurations
require_once('includes/config.conf.php');	 	

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
//var_dump($db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME));

# including the proper language file
require_once($DIR_LANG.'/'.base64_decode($_SESSION['LANG']).'.lang.php');
# including the proper theme template file and also generate output
//require_once($DIR_INC.'/copyright.tpl');

# including Header file for Smarty Parser Configurator
require_once($DIR_INC."/libs.inc.php");
# setting Smarty Class Debugger
//$smarty->debugging = true;

# Start Parsing the Template
$smarty->assign ("TITLE", $MAIN->TITLE);


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

$usr_name = $_POST['txt_username'];
$usr_password = base64_encode($_POST['txt_password']);
$jenis_jl = $_POST['jns_jln'];
//$jenis_jl = '1';

$th = $_POST['txt_tahun'];
$kode_cabang = $_POST['kode_cabang'];
//var_dump($kode_cabang)or die();
if($jenis_jl==1):
$sql  = "SELECT * FROM tbl_sys_master_user WHERE (user_id = '$usr_name' AND user_password = '$usr_password' AND user_active_status = '1') AND level='".$jenis_jl."' ";
else:
$sql  = "SELECT * FROM tbl_sys_master_user WHERE user_id = '$usr_name' AND user_password = '$usr_password' AND user_active_status = '1' AND level='".$jenis_jl."' AND kode_perwakilan='".$kode_cabang."' ";
endif;

//$sql  = "SELECT * FROM tbl_sys_master_user WHERE user_id = '$usr_name' AND user_password = '$usr_password' AND user_active_status = '1' ";


//print $sql;
$recordSet = $db->Execute($sql);


$cek_rows = $recordSet->RecordCount();

 if ($cek_rows <= 0) {
		$smarty->assign ("SUCCEED", "0");
		$smarty->assign ("ACTION", $HREF_HOME);
		$smarty->assign ("METHOD", "GET");
		$smarty->assign ("TARGET", "_self");
		$smarty->assign ("AUTHCOMPLETE", _AUTHCOMPLETE);
		$smarty->assign ("RESULTS", _RESULTS);
		$smarty->assign ("ACCESS", _ACCESSNO);
		$smarty->assign ("PRIV1", _PRIV1NO);
		$smarty->assign ("PRIV2", _PRIV2NO);
		$smarty->assign ("PRESSOK", _PRESSOK);

}
else
{
			if($jenis_jl==""){
				$smarty->assign ("SUCCEED", "0");
				$smarty->assign ("ACTION", $HREF_HOME);
				$smarty->assign ("METHOD", "GET");
				$smarty->assign ("TARGET", "_self");
				$smarty->assign ("AUTHCOMPLETE", _AUTHCOMPLETE);
				$smarty->assign ("RESULTS", _RESULTS);
				$smarty->assign ("ACCESS", _ACCESSNO);
				$smarty->assign ("PRIV1", _PRIV1NO);
				$smarty->assign ("PRIV2", _PRIV2NO);
				$smarty->assign ("PRESSOK", _PRESSOK);			
			} else {
				$smarty->assign ("SUCCEED", "1");
				$_SESSION['UID']	= base64_encode($recordSet->fields['user_id']);
				$date_now = strtotime('now');
				$ip_now = $_SERVER['REMOTE_ADDR'];
				$user_id = $recordSet->fields['user_id'];
				$_SESSION['SESSION_TAHUN']			= $th;
				$_SESSION['SESSION_JNS_USER']		= $jenis_jl;
				$_SESSION['SESSION_KODE_PERWAKILAN'] = $recordSet->fields['kode_perwakilan'];
				 
				$tahun	= $_SESSION['SESSION_TAHUN'];				
				//print $tahun;
		 
				
				$sql="UPDATE tbl_sys_master_user SET user_current_login_date = '$date_now', user_current_login_host = '$ip_now' WHERE user_id = '".$recordSet->fields['user_id']."'" ;
				$db->Execute($sql);
	
				$sql="INSERT INTO tbl_sys_history_log_user (log_user_id, log_login_date, log_login_host)  VALUES ('$user_id','$date_now','$ip_now') ";
				$db->Execute($sql);

				//$smarty->assign ("TEST", $th);
					
				$smarty->assign ("ACTION", $HREF_HOME.'/modules/');
				$smarty->assign ("CHECKER", '1');
				$smarty->assign ("METHOD", "POST");
				$smarty->assign ("TARGET", "_self");
				$smarty->assign ("AUTHCOMPLETE", _AUTHCOMPLETE);
				$smarty->assign ("RESULTS", _RESULTS);
				$smarty->assign ("ACCESS", _ACCESS);
				$smarty->assign ("PRIV1", _PRIV1);
				$smarty->assign ("PRIV2", _PRIV2);
				$smarty->assign ("PRESSOK", _PRESSOK);
			}	
}


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