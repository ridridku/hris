<?php

# Including Main Configuration
# including file for Main Configurations
require_once('../../../includes/config.conf.php');	 	


# Create a session to store global config path
session_save_path($DIR_SESS);
//$expiry = 60*120;
session_set_cookie_params($expiry);
session_start();

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
	require_once('../../../includes/header.redirect.inc');
}else{

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/administrasi_sistem/daftar_user';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/administrasi_sistem');
$FILE_JS  = $JS_MODUL.'/daftar_user';


#Initiate TABLE
$tbl_name	= "tbl_sys_master_user";
$tbl_name_jenis_jln = "tbl_mast_jln";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
$tbl_name_kecamatan = "tbl_mast_wil_kecamatan";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//


if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="user_id";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['user_id']) $CODE = $_GET['user_id'];
else if ($_POST['user_id']) $CODE = $_POST['user_id'];
else $CODE="";

if ($_GET['user_first_name']) $NAME = $_GET['user_first_name'];
else if ($_POST['user_first_name']) $NAME = $_POST['user_first_name'];
else $NAME="";

$jns_jln	= $_POST[jns_jln]?$_POST[jns_jln]:$_GET[jns_jln];

$str_completer = "limit=".$LIMIT."&SORT=".$SORT."&user_id=".$CODE."&user_first_name=".$NAME."&jns_jln=".$jns_jln;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&jns_jln=".$jns_jln;

//-------------MASTER WILAYAH PROPINSI---------------------------
$sql_propinsi = "SELECT no_propinsi,nama_propinsi FROM ".$tbl_name_propinsi." ORDER BY no_propinsi ASC";
$recordSet_propinsi = $db->Execute($sql_propinsi);
$initSet = array();
$data_propinsi = array();
$z=0;
while ($arr=$recordSet_propinsi->FetchRow()) {
	array_push($data_propinsi, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PROPINSI", $data_propinsi);
$smarty->assign ("ID_PROPINSI",$MAIN_PROP);
 




if ($_GET[get_propinsi] == 1)
{
			 $jenis_user = $_GET[jenis_user];

			if ($jenis_user==2) { 
				$sql_data_usulan = "SELECT * FROM tbl_mast_perwakilan";
				$result_data_usulan = $db->execute($sql_data_usulan);
				$total_data_usulan = $result_data_usulan->numrows();
				
				$data_usulan = "<select id=\"kode_perwakilan\" name=\"kode_perwakilan\"  style=\width:250px\" >";
				$data_usulan .= "<option value=\"\"> [Pilih Perwakilan] </option >";
				while(!$result_data_usulan ->EOF):
				 $data_usulan .= "<option value=".$result_data_usulan->fields['kode_perwakilan'].">".$result_data_usulan->fields['nm_perwakilan']."</option>";
					$result_data_usulan->MoveNext();
				endwhile;
				$data_usulan .="</select>";

			} else {
				
					$data_usulan = "<select id=\"kode_perwakilan\" name=\"kode_perwakilan\" disabled  style=\width:250px\" >";
				 	$data_usulan .= "<option value=\"\"> [Pilih Perwakilan] </option >";			 
				 $data_usulan .="</select>";


			}

				 $delimeter   = "-";
				$option_choice =  $data_usulan."^/&".$delimeter;	
				echo $option_choice;
	 
}



 

 
$opt = $_GET[opt];

$ed = 0;
if($opt=="1"){
	$sql_	 = "SELECT * FROM ".$tbl_name." ";
	$sql_	.= "WHERE user_id ='".$_GET['user_id']."' ";
	$resultSet = $db->Execute($sql_);
	$edit_user_id = $resultSet->fields['user_id'];
	$edit_user_first_name = $resultSet->fields['user_first_name'];
	$edit_user_last_name = $resultSet->fields['user_last_name'];
	$edit_user_date_join = $resultSet->fields['user_date_join'];
	$edit_user_address = $resultSet->fields['user_address'];
	$edit_user_telp = $resultSet->fields['user_telp'];
	$edit_user_gender = $resultSet->fields['user_gender'];
	$edit_user_email = $resultSet->fields['user_email'];
	$edit_user_active_status = $resultSet->fields['user_active_status'];
	$edit_level_user = $resultSet->fields['level'];
		$edit_kode_perwakilan = $resultSet->fields['kode_perwakilan'];
	$edit_user_password = $resultSet->fields['user_password'];
		
	$edit = 1;

	if ($edit_level_user ==2) {
	
//-------------------------------------
$sql_pwk = "SELECT  *  FROM tbl_mast_perwakilan ";
$result_pwk = $db->Execute($sql_pwk);
$initSet = array();
$data_pwk = array();
$z=0;
while ($arr=$result_pwk->FetchRow()) {
	array_push($data_pwk, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_INSTANSI2", $data_pwk);

	}
	$smarty->assign ("EDIT_LEVEL", $edit_level_user);
} else {
	if(isset($_POST[jns_jln])){
		$smarty->assign ("EDIT_LEVEL", $_POST['jns_jln']);
	}
}

$smarty->assign ("OPT", $opt);
$smarty->assign ("EDIT_KODE_PERWAKILAN", $edit_kode_perwakilan);
$smarty->assign ("EDIT_USER_ID", $edit_user_id);
$smarty->assign ("EDIT_USER_PASSWORD", base64_decode($edit_user_password));
$smarty->assign ("EDIT_USER_FIRST_NAME", $edit_user_first_name);
$smarty->assign ("EDIT_USER_LAST_NAME", $edit_user_last_name);
$smarty->assign ("EDIT_USER_DATE_JOIN", $edit_user_date_join);
$smarty->assign ("EDIT_USER_ADDRESS", $edit_user_address);
$smarty->assign ("EDIT_USER_TELP", $edit_user_telp);
$smarty->assign ("EDIT_USER_GENDER", $edit_user_gender);
$smarty->assign ("EDIT_USER_EMAIL", $edit_user_email);
$smarty->assign ("EDIT_USER_STATUS", $edit_user_active_status);
$smarty->assign ("EDIT_LEVEL", $edit_level_user);
$smarty->assign ("NO_PROPINSI", $resultSet->fields['no_propinsi']);
$smarty->assign ("NO_KABUPATEN", $resultSet->fields['no_kabupaten']);

$smarty->assign ("EDIT_VAL", $edit);

$sql  = "SELECT a.*, CONCAT(a.user_first_name,' ', a.user_last_name) as full_name ";
$sql .= "FROM ".$tbl_name." as a ";
$sql .= "WHERE 1=1 ";

if($CODE!=''){
	$sql .= "AND a.user_id LIKE '%".$CODE."%' ";
}

if($NAME!=''){
	$sql .= "AND a.user_first_name LIKE '%".$NAME."%' OR a.user_last_name LIKE '%".$NAME."%'  ";
}

$sql .= "ORDER BY ".$ORDER." ".$SORT." ";

if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
$numresults=$db->Execute($sql);
$count = $numresults->RecordCount();

$pages = $p->findPages($count,$LIMIT); 
$sql  .= "LIMIT ".$start.", ".$LIMIT;

$recordSet = $db->Execute($sql);
$end = $recordSet->RecordCount();
$initSet = array();
$data_tb = array();
$row_class = array();
$z=0;
while ($arr=$recordSet->FetchRow()) {
	array_push($data_tb, $arr);
	if ($z%2==0){ 
		$ROW_CLASSNAME=$ROW_CLASSNAME_1; }
	else {
		$ROW_CLASSNAME=$ROW_CLASSNAME_2;;
	   }
	array_push($row_class, $ROW_CLASSNAME);
	array_push($initSet, $z);
	$z++;
}

$count_view = $start+1;
$count_all  = $start+$end;
$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 


$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_USER);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_USER);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("TITLE", _TITLE_USER);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_USER);
$smarty->assign ("TB_CODE", _ID_USER);
$smarty->assign ("TB_NAME", _NAMA_USER);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_ME);
$smarty->assign ("RECORD_PER_PAGE", _RECORD_PER_PAGE);
$smarty->assign ("ACTION", _ACTION);
$smarty->assign ("EDIT", _EDIT);
$smarty->assign ("DELETE", _DELETE);
$smarty->assign ("SORT_IN", _SORT_IN);
$smarty->assign ("SORT_ORDER", _SORT_ORDER);
$smarty->assign ("SHOWING", _SHOWING);
$smarty->assign ("OF", _OF);
$smarty->assign ("RECORDS", _RECORDS);
$smarty->assign ("LIST", _LIST_USER);
$smarty->assign ("BTN_NEW", _BTN_NEW);
$smarty->assign ("MOD_ID", $_GET[mod_id]);
$smarty->assign ("INITSET", $initSet);
$smarty->assign ("PATH", $PATH);
$smarty->assign ("LIMIT", $LIMIT);
$smarty->assign ("SORT", $SORT);
$smarty->assign ("ORDER", $ORDER);
$smarty->assign ("page", $page);
$smarty->assign ("LISTVAL", $arrayName);
$smarty->assign ("SELECTED", $selected);
$smarty->assign ("ROW_CLASSNAME", $row_class);
$smarty->assign ("STR_COMPLETER", $str_completer);
$smarty->assign ("STR_COMPLETER_", $str_completer_);
$smarty->assign ("COUNT_VIEW", $count_view);
$smarty->assign ("COUNT_ALL", $count_all);
$smarty->assign ("COUNT", $count);
$smarty->assign ("NEXT_PREV", $next_prev);
$smarty->assign ("DATA_TB", $data_tb);


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