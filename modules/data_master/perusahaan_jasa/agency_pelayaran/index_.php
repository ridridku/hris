<?php

# Including Main Configuration
# including file for Main Configurations
require_once('../../../../includes/config.conf.php');	 	

# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
	require_once('../../../../includes/header.redirect.inc');

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
//require_once($DIR_INC.'/copyright.tpl');

//=================================== BEGIN PARSING TEMPLATE BLOCK====================================

# including Header file for Smarty Parser Configurator
require_once($DIR_INC."/libs.inc.php");
# setting Smarty Class Debugger
#$smarty->debugging = true;

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_master/perusahaan_jasa/agency_pelayaran';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_master');
$FILE_JS  = $JS_MODUL.'/perusahaan_jasa/agency_pelayaran';

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}

$user_id = base64_decode($_SESSION['UID']);

$smarty->assign ("MOD_ID", $mod_id);

#Initiate TABLE
$tbl_name	= "tbl_mast_agency_pelayaran";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//


if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="tbl_mast_agency_pelayaran.kode_agency ASC,tbl_mast_agency_pelayaran.kode_jenis_agency";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['kode_agency']) $CODE = $_GET['kode_agency'];
else if ($_POST['kode_agency']) $CODE = $_POST['kode_agency'];
else $CODE="";

if ($_GET['nama_agency']) $NAME = $_GET['nama_agency'];
else if ($_POST['nama_agency']) $NAME = $_POST['nama_agency'];
else $NAME="";

if ($_GET['kode_jenis_agency']) $KODE = $_GET['kode_jenis_agency'];
else if ($_POST['kode_jenis_agency']) $KODE = $_POST['kode_jenis_agency'];
else $KODE="";

if ($_GET['alamat_agency']) $ALAMAT_AGENCY = $_GET['alamat_agency'];
else if ($_POST['alamat_agency']) $ALAMAT_AGENCY = $_POST['alamat_agency'];
else $ALAMAT_AGENCY="";

if ($_GET['tlp_agency']) $TLP_AGENCY = $_GET['tlp_agency'];
else if ($_POST['tlp_agency']) $TLP_AGENCY = $_POST['tlp_agency'];
else $TLP_AGENCY="";

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_agency=".$CODE."&nama_agency=".$NAME."&kode_jenis_agency=".$KODE."&alamat_agency=".$ALAMAT_AGENCY."&tlp_agency=".$TLP_AGENCY;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;

//SHOW DATA KABUPATEN

//-------------------------------------
//$smarty->assign ("EDIT_PROV_ID", 64);

//------------------------------------


				
$opt = $_GET['opt'];				

if ($opt=="1") {
	
	//print $_GET[opt];
$kode_agency = $_GET[kode_agency];
	
	$sql_	 = "SELECT tbl_mast_agency_pelayaran.kode_agency,tbl_mast_agency_pelayaran.nama_agency,tbl_mast_agency_pelayaran.kode_jenis_agency,
	tbl_mast_agency_pelayaran.alamat_agency,tbl_mast_agency_pelayaran.tlp_agency FROM tbl_mast_agency_pelayaran  ";
	$sql_	.= "WHERE  kode_agency='".$_GET['kode_agency']."'";

	$resultSet = $db->Execute($sql_);
	$edit_kode_agency = $resultSet->fields[kode_agency];
	$edit_nama_agency= $resultSet->fields[nama_agency];
	$edit_alamat_agency= $resultSet->fields[alamat_agency];
	$edit_tlp_agency= $resultSet->fields[tlp_agency];
	$edit_kode_jenis_agency = $resultSet->fields[kode_jenis_agency];
	$edit = 1;
	//$opt = 1;
	//print $edit_nama_kabupaten;
	/***
	$delimeter   = "-";
	$option_choice = $opt."^/&".$edit_prov_id."^/&".$edit_no_kab."^/&".$edit_kab_id."^/&".$edit_nama_kabupaten."^/&".$delimeter;	
	echo $option_choice;
	***/
}
$smarty->assign ("OPT", $opt);
$smarty->assign("EDIT_KODE_AGENCY",$edit_kode_agency);
$smarty->assign("EDIT_NAMA_AGENCY",$edit_nama_agency);
$smarty->assign("EDIT_KODE_JENIS_AGENCY",$edit_kode_jenis_agency);
$smarty->assign("EDIT_ALAMAT_AGENCY",$edit_alamat_agency);
$smarty->assign("EDIT_TLP_AGENCY",$edit_tlp_agency);


if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{

				$sql  = "SELECT tbl_mast_agency_pelayaran.kode_agency,tbl_mast_agency_pelayaran.nama_agency,tbl_mast_agency_pelayaran.kode_jenis_agency,
	tbl_mast_agency_pelayaran.alamat_agency,tbl_mast_agency_pelayaran.tlp_agency FROM tbl_mast_agency_pelayaran  ";

	
				if($CODE!=''){
					$sql .= "AND tbl_mast_agency_pelayaran.kode_agency LIKE '%".$CODE."%' "; 
				}

				if($NAME!=''){
					$sql .= "AND tbl_mast_agency_pelayaran.nama_agency LIKE '%".$NAME."%' "; 
				}
				
				if($KODE!=''){
					$sql .= "AND tbl_mast_agency_pelayaran.kode_jenis_agency LIKE '%".$KODE."%' "; 
				}
				if($ALAMAT_AGENCY!=''){
					$sql .= "AND tbl_mast_agency_pelayaran.alamat_agency LIKE '%".$ALAMAT_AGENCY."%' "; 
				}
				if($TLP_AGENCY!=''){
					$sql .= "AND tbl_mast_agency_pelayaran.tlp_agency LIKE '%".$TLP_AGENCY."%' "; 
				}
				
				$sql .= "ORDER BY ".$ORDER." ".$SORT." ";

				if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
				$numresults=$db->Execute($sql);
				//var_dump($sql)or die();
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
}

}
else
{
				$sql  = "SELECT tbl_mast_agency_pelayaran.kode_agency,tbl_mast_agency_pelayaran.nama_agency,tbl_mast_agency_pelayaran.kode_jenis_agency,
	tbl_mast_agency_pelayaran.alamat_agency,tbl_mast_agency_pelayaran.tlp_agency FROM tbl_mast_agency_pelayaran  ";

	
	
					if($CODE!=''){
					$sql .= "AND tbl_mast_agency_pelayaran.kode_agency LIKE '%".$CODE."%' "; 
				}

				if($NAME!=''){
					$sql .= "AND tbl_mast_agency_pelayaran.nama_agency LIKE '%".$NAME."%' "; 
				}
				
				if($KODE!=''){
					$sql .= "AND tbl_mast_agency_pelayaran.kode_jenis_agency LIKE '%".$KODE."%' "; 
				}
				if($ALAMAT_AGENCY!=''){
					$sql .= "AND tbl_mast_agency_pelayaran.alamat_agency LIKE '%".$ALAMAT_AGENCY."%' "; 
				}
				if($TLP_AGENCY!=''){
					$sql .= "AND tbl_mast_agency_pelayaran.tlp_agency LIKE '%".$TLP_AGENCY."%' "; 
				}

				$sql .= "ORDER BY ".$ORDER." ".$SORT." ";
				if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
				$numresults=$db->Execute($sql);
				//print $sql;
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
						$ROW_CLASSNAME=$ROW_CLASSNAME_2;
					   }
					array_push($row_class, $ROW_CLASSNAME);
					array_push($initSet, $z);
					$z++;
				}

				$count_view = $start+1;
				$count_all  = $start+$end;
				$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 


}

$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_KABUPATEN);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_KABUPATEN);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("TITLE", _TITLE_KAB);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_KAB);
$smarty->assign ("TB_CODE", _ID_KAB);
$smarty->assign ("TB_CODE_2", _ID_KABUPATEN);
$smarty->assign ("TB_NAME", _NAMA_PROP);
$smarty->assign ("TB_NO_KAB",_NO_KAB);
$smarty->assign ("TB_KABUPATEN_NAMA", _NAMA_KABUPATEN);
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
$smarty->assign ("LIST", _LIST_KAB);
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