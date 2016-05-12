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
//require_once($DIR_INC.'/copyright.tpl');

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_master/perusahaan_jasa/pjtka';


#SETTING FILE JS INCLUDE
// themes\defaults\javascripts\modules\data_master\perusahaan_jasa\pjtka
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_master');
$FILE_JS  = $JS_MODUL.'/perusahaan_jasa/pjtka';

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
$tbl_name	= "tbl_mast_pjtka";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//


if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="kode_pjtka";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['kode_pjtka']) $CODE = $_GET['kode_pjtka'];
else if ($_POST['kode_pjtka']) $CODE = $_POST['kode_pjtka'];
else $CODE="";

if ($_GET['nama_pjtka']) $NAME = $_GET['nama_pjtka'];
else if ($_POST['nama_pjtka']) $NAME = $_POST['nama_pjtka'];
else $NAME="";

if ($_GET['alamat']) $ALAMAT = $_GET['alamat'];
else if ($_POST['alamat']) $ALAMAT = $_POST['alamat'];
else $ALAMAT="";

if ($_GET['tlp']) $TLP = $_GET['tlp'];
else if ($_POST['tlp']) $TLP = $_POST['tlp'];
else $TLP="";

if ($_GET['kode_perwakilan']) $KODEP = $_GET['kode_perwakilan'];
else if ($_POST['kode_perwakilan']) $KODEP = $_POST['kode_perwakilan'];
else $KODEP="";


$smarty->assign ("KODE_PERWAKILAN", $KODEP);
$smarty->assign ("TLP", $TLP);
$smarty->assign ("ALAMAT", $ALAMAT);
$smarty->assign ("nama_pjtka", $NAME);
$smarty->assign ("kode_pjtka", $CODE);

//-------------------------------------
$sql_pe = "SELECT * FROM tbl_mast_perwakilan ";
$result_pe = $db->Execute($sql_pe);
$initSet = array();
$data_pe = array();
$z=0;
while ($arr=$result_pe->FetchRow()) {
	array_push($data_pe, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PERWAKILAN", $data_pe);

//------------------------------------

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_pjtka=".$CODE."&nama_pjtka=".$NAME."&alamat=".$ALAMAT."&tlp=".$TLP."&kode_perwakilan=".$KODEP;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;

$opt = $_GET[opt];

$ed = 0;
if($opt=="1"){
	$sql_	 = "SELECT * FROM ".$tbl_name." ";
	$sql_	.= "WHERE kode_pjtka =".$_GET['kode_pjtka'];
	$resultSet = $db->Execute($sql_);
	$edit_kode_pjtka = $resultSet->fields[kode_pjtka];
	$edit_nama_pjtka = $resultSet->fields[nama_pjtka];
	$edit_alamat = $resultSet->fields[alamat];
	$edit_tlp = $resultSet->fields[tlp];
	$edit_kode_perwakilan = $resultSet->fields[kode_perwakilan];
	$edit = 1;
}

$smarty->assign ("OPT", $opt);
$smarty->assign ("EDIT_KODE_PJTKA", $edit_kode_pjtka);
$smarty->assign ("EDIT_NAMA_PJTKA", $edit_nama_pjtka);
$smarty->assign ("EDIT_ALAMAT", $edit_alamat);
$smarty->assign ("EDIT_TLP", $edit_tlp);
$smarty->assign ("EDIT_KODE_PERWAKILAN", $edit_kode_perwakilan);
$smarty->assign ("EDIT_VAL", $edit);


if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{

				$sql  = "SELECT *, tbl_mast_pjtka.alamat, tbl_mast_pjtka.tlp ";
				$sql .= "FROM ".$tbl_name." ";
				$sql .= " inner join tbl_mast_perwakilan on tbl_mast_pjtka.kode_perwakilan = tbl_mast_perwakilan.kode_perwakilan ";
				$sql .= "WHERE 1=1 ";

				if($CODE!=''){
					$sql .= "AND kode_pjtka LIKE '%".$CODE."%' ";
				}
				
				if($NAME!=''){
					$sql .= "AND nama_pjtka LIKE '%".$NAME."%' ";
				}
				
				if($ALAMAT!=''){
					$sql .= "AND alamat LIKE '%".$ALAMAT."%' ";
				}
				
				if($TLP!=''){
					$sql .= "AND tlp LIKE '%".$TLP."%' ";
				}
				
				if($KODEP!=''){
					$sql .= "AND kode_perwakilan LIKE '%".$KODEP."%' ";
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
}

}
else
{
					$sql  = "SELECT *, tbl_mast_pjtka.alamat, tbl_mast_pjtka.tlp ";
				$sql .= "FROM ".$tbl_name." ";
				$sql .= " inner join tbl_mast_perwakilan on tbl_mast_pjtka.kode_perwakilan = tbl_mast_perwakilan.kode_perwakilan ";
				$sql .= "WHERE 1=1 ";

				if($CODE!=''){
					$sql .= "AND kode_pjtka LIKE '%".$CODE."%' ";
				}

				if($NAME!=''){
					$sql .= "AND nama_pjtka LIKE '%".$NAME."%' ";
				}
				
				if($ALAMAT!=''){
					$sql .= "AND alamat LIKE '%".$ALAMAT."%' ";
				}
				
				if($TLP!=''){
					$sql .= "AND tlp LIKE '%".$TLP."%' ";
				}
				
				if($KODEP!=''){
					$sql .= "AND kode_perwakilan LIKE '%".$KODEP."%' ";
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

$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_PJTKA);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_PJTKA);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("TITLE", _TITLE_PJTKA);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_PJTKA);
$smarty->assign ("TB_CODE", _ID_JENIS_PJTKA);
$smarty->assign ("TB_NAME", _NAMA_PJTKA);
$smarty->assign ("TB_KET", _KET_PJTKA);
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
$smarty->assign ("LIST", _LIST_PJTKA);
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