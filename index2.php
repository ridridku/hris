<?php

# Including Main Configuration
# including file for Main Configurations

# Including variables declaration file
require_once('includes/config.conf.php');	
 	
# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();

$jns_jln	= $_POST[jns_jln]?$_POST[jns_jln]:$_GET[jns_jln];

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

$tbl_name_jenis_jln = "tbl_mast_jln";

 /*** End 0f MASTER JENIS JALAN ***/

$smarty->assign ("TITLE", _TITLE);

//$smarty->assign ("TITLE", $MAIN->TITLE);
$tahun = date(Y);

if ($_GET[get_item_detail] == 1)
{
	 $jenis_user = $_GET[jenis_user];

	 if($jenis_user!=''){	

		if($jenis_user=='1'){ //bina marga semua disabled
		
				 
				$data_usulan = "<select id=\"kode_perwakilan\"   disabled name=\"kode_perwakilan\"  >";
				$data_usulan .= "<option value=\"\"> [Pilih Cabang] </option >";
			    $data_usulan .="</select>";
 
				$delimeter   = "-";
				$option_choice =  $data_usulan."^/&".$delimeter;		
				echo $option_choice;	

		} else {
		
				$sql_data_usulan = "SELECT * FROM tbl_mast_cabang order by kode_cabang";
				$result_data_usulan = $db->execute($sql_data_usulan);
				$total_data_usulan = $result_data_usulan->numrows();
				
				$data_usulan = "<select id=\"kode_cabang\" name=\"kode_cabang\"  >";
				$data_usulan .= "<option value=\"\"> [Pilih Cabang] </option >";
				while(!$result_data_usulan ->EOF):
				 $data_usulan .= "<option value=".$result_data_usulan->fields['kode_cabang'].">".$result_data_usulan->fields['nama_cabang']."</option>";
					$result_data_usulan->MoveNext();
				endwhile; 	

				 $data_usulan .="</select>";

 

				 $delimeter   = "-";
					$option_choice =  $data_usulan."^/&".$delimeter;	
				echo $option_choice;
				
		}
			}
}






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
$smarty->assign ("PID_JENIS_JLN2", $jns_jln);
$smarty->assign ("SUBMIT2", _SUBMIT2);
$smarty->assign ("RESET", "RESET");


$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/');

//=================================== END OF FILE CONFIGURATION====================================
# Finally Grab All Parsed variables, parse it into the template, and generate ouput
# Clear Cache First
$smarty->clear_cache ($DIR_THEME.'/'.base64_decode($_SESSION['THEME']).'/'.$DOC_SELF_NAME_ONLY.'.tpl');
# Parsing the proper theme template & Generate Output
$smarty->display ($DIR_THEME.'/'.base64_decode($_SESSION['THEME']).'/'.$DOC_SELF_NAME_ONLY.'.tpl');
# Store all the JavaScript  for this pages into /javascripts/file_name  and include it here (bottom page)
 require_once($JS_MODUL.'/index.js');
# AdoDb closed here
$db->Close();

?>