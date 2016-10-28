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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/administrasi_sistem/user_privileges';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/administrasi_sistem');
$FILE_JS  = $JS_MODUL.'/user_privileges';


#Initiate TABLE
$tbl_name	= "tbl_sys_master_user";
$field_name	= "user";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//


if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER=$field_name."_id";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET[$field_name.'_id']) $CODE = $_GET[$field_name.'_id'];
else if ($_POST[$field_name.'_id']) $CODE = $_POST[$field_name.'_id'];
else $CODE="";

if ($_GET[$field_name.'_first_name']) $NAME = $_GET[$field_name.'_first_name'];
else if ($_POST[$field_name.'_first_name']) $NAME = $_POST[$field_name.'_first_name'];
else $NAME="";

$str_completer = "limit=".$LIMIT."&mod_id=".$mod_id."&SORT=".$SORT."&".$field_name."_id=".$CODE."&".$field_name."_first_name=".$NAME;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;

$opt = $_GET[opt];

$ed = 0;
if($opt=="1"){
	$sql_	 = "SELECT * FROM ".$tbl_name." ";
	$sql_	.= "WHERE ".$field_name."_id =".$_GET['user_id'];
	$resultSet = $db->Execute($sql_);
	$edit_user_id = $resultSet->fields['user_id'];
	$edit_user_first_name = $resultSet->fields['user_first_name'];
	$edit_user_alamat = $resultSet->fields['user_alamat'];
	$edit_user_kantor_id = $resultSet->fields['user_kantor_id'];
	$edit_user_jabatan_id = $resultSet->fields['user_jabatan_id'];
	$edit_user_email = $resultSet->fields['user_email'];
	$edit_user_tgl_gabung = $resultSet->fields['user_tgl_gabung'];
	$edit_user_user_name = $resultSet->fields['user_user_name'];
	$edit_user_status = $resultSet->fields['user_status'];
	$edit = 1;


	$temp_tgl_gabung = explode("-", $edit_user_tgl_gabung);
	$edit_user_tgl_gabung = $temp_tgl_gabung[2]."/".$temp_tgl_gabung[1]."/".$temp_tgl_gabung[0];
}

$smarty->assign ("OPT", $opt);
$smarty->assign ("EDIT_USER_NAMA", $edit_user_first_name);
$smarty->assign ("EDIT_USER_NIP", $edit_user_id);
$smarty->assign ("EDIT_USER_ALAMAT", $edit_user_alamat);
$smarty->assign ("EDIT_USER_KANTOR_ID", $edit_user_kantor_id);
$smarty->assign ("EDIT_USER_JABATAN_ID", $edit_user_jabatan_id);
$smarty->assign ("EDIT_USER_EMAIL", $edit_user_email);
$smarty->assign ("EDIT_USER_TGL_GABUNG", $edit_user_tgl_gabung);
$smarty->assign ("EDIT_USER_USER_NAME", $edit_user_user_name);
$smarty->assign ("EDIT_USER_STATUS", $edit_user_status);
$smarty->assign ("EDIT_VAL", $edit);
			
$sql  = "SELECT DISTINCT a.*, CONCAT(a.user_first_name,' ', a.user_last_name) as full_name ";
$sql .= "FROM ".$tbl_name." as a ";
$sql .= "LEFT JOIN tbl_sys_master_privileges as b ON a.user_id = b.priv_user_id ";
$sql .= "WHERE a.user_active_status = '1' ";

if($CODE!=''){
	$sql .= "AND a.user_id LIKE '%".$CODE."%' ";
}

if($NAME!=''){
	$sql .= "AND a.user_first_name LIKE '%".$NAME."%' OR a.user_last_name LIKE '%".$NAME."%' ";
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
		$ROW_CLASSNAME="#CCCCCC"; }
	else {
		$ROW_CLASSNAME="#EEEEEE";
	   }
	array_push($row_class, $ROW_CLASSNAME);
	array_push($initSet, $z);
	$z++;
}

$count_view = $start+1;
$count_all  = $start+$end;
$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 

$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_USER_PRIV);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_USER_PRIV);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("TITLE", _TITLE_USER_PRIV);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_USER_PRIV);
$smarty->assign ("TB_CODE", _ID_USER_PRIV);
$smarty->assign ("TB_NAME", _NAMA_USER_PRIV);
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
$smarty->assign ("LIST", _LIST_USER_PRIV);
$smarty->assign ("BTN_NEW", _BTN_NEW);

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