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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_master/lokal_staf/wna';


#SETTING FILE JS INCLUDE
// themes\defaults\javascripts\modules\data_master\wilayah\propinsi
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_master');
$FILE_JS  = $JS_MODUL.'/lokal_staf/wna';

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
$tbl_name	= "tbl_wna";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//


if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="kode_wna";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['kode_wna']) $KODE_WNA = $_GET['kode_wna'];
else if ($_POST['kode_wna']) $KODE_WNA = $_POST['kode_wna'];
else $KODE_WNA="";

if ($_GET['kode_negara']) $KODE_NEGARA = $_GET['kode_negara'];
else if ($_POST['kode_negara']) $KODE_NEGARA = $_POST['kode_negara'];
else $KODE_NEGARA="";

if ($_GET['nama_wna']) $NAMA_WNA = $_GET['nama_wna'];
else if ($_POST['nama_wna']) $NAMA_WNA = $_POST['nama_wna'];
else $NAMA_WNA="";

if ($_GET['alamat_ind']) $ALAMAT_IND = $_GET['alamat_ind'];
else if ($_POST['alamat_ind']) $ALAMAT_IND = $_POST['alamat_ind'];
else $ALAMAT_IND="";

if ($_GET['tlp_ind']) $TLP_IND = $_GET['tlp_ind'];
else if ($_POST['tlp_ind']) $TLP_IND = $_POST['tlp_ind'];
else $TLP_IND="";

if ($_GET['alamat_ln']) $ALAMAT_LN = $_GET['alamat_ln'];
else if ($_POST['alamat_ln']) $ALAMAT_LN = $_POST['alamat_ln'];
else $ALAMAT_LN="";

if ($_GET['tlp_ln']) $TLP_LN = $_GET['tlp_ln'];
else if ($_POST['tlp_ln']) $TLP_LN = $_POST['tlp_ln'];
else $TLP_LN="";

if ($_GET['keterangan']) $KETERANGAN = $_GET['keterangan'];
else if ($_POST['keterangan']) $KETERANGAN = $_POST['keterangan'];
else $KETERANGAN="";


$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_wna=".$KODE_WNA."&kode_negara=".$KODE_NEGARA."&nama_wna=".$NAMA_WNA."&alamat_ind=".$ALAMAT_IND."&tlp_ind=".$TLP_IND."&alamat_ln=".$ALAMAT_LN."&tlp_ln=".$TLP_LN."&keterangan=".$KETERANGAN;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;


// SHOW DATA NEGARA ========================
$sql_data_negara_show = "SELECT  *  FROM tbl_mast_negara ";
$result_data_negara_show = $db->Execute($sql_data_negara_show);
$initSet = array();
$data_negara_show = array();
$z=0;
while ($arr=$result_data_negara_show->FetchRow()) {
	array_push($data_negara_show, $arr);
	array_push($initSet, $z);
	$z++;
}

$smarty->assign ("DATA_NEGARA_SHOW", $data_negara_show);




$opt = $_GET[opt];

//$kod=$_GET['kode_wna'];

$ed = 0;
if($opt=="1"){
	
	$sql  = "SELECT
  tbl_wna.kode_negara,
  tbl_mast_negara.kode_negara,
  tbl_mast_negara.nama_negara,
  tbl_wna.kode_wna,
  tbl_wna.nama_wna,
  tbl_wna.alamat_ind,
  tbl_wna.tlp_ind,
  tbl_wna.alamat_ln,
  tbl_wna.tlp_ln,
  tbl_wna.keterangan
FROM
  tbl_wna
  INNER JOIN tbl_mast_negara
    ON tbl_wna.kode_negara = tbl_mast_negara.kode_negara  
			where  kode_wna ='".$_GET['kode_wna']."' ";
			
	$resultSet = $db->Execute($sql);
	$edit_kode_wna = $resultSet->fields[kode_wna];
	$edit_kode_negara = $resultSet->fields[kode_negara];
	$edit_nama_wna = $resultSet->fields[nama_wna];
	$edit_alamat_ind = $resultSet->fields[alamat_ind];
	$edit_tlp_ind = $resultSet->fields[tlp_ind];
	$edit_alamat_ln = $resultSet->fields[alamat_ln];
	$edit_tlp_ln = $resultSet->fields[tlp_ln];
	$edit_keterangan = $resultSet->fields[keterangan];

	$edit = 1;
}

$smarty->assign ("OPT", $opt);
$smarty->assign ("EDIT_KODE_WNA", $edit_kode_wna);
$smarty->assign ("EDIT_KODE_NEGARA", $edit_kode_negara);
$smarty->assign ("EDIT_NAMA_WNA", $edit_nama_wna);
$smarty->assign ("EDIT_ALAMAT_IND", $edit_alamat_ind);
$smarty->assign ("EDIT_TLP_IND", $edit_tlp_ind);
$smarty->assign ("EDIT_ALAMAT_LN", $edit_alamat_ln);
$smarty->assign ("EDIT_TLP_LN", $edit_tlp_ln);
$smarty->assign ("EDIT_KETERANGAN", $edit_keterangan);
$smarty->assign ("EDIT_VAL", $edit);


if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{

				$sql  = "SELECT
  tbl_wna.kode_negara,
  tbl_mast_negara.kode_negara,
  tbl_mast_negara.nama_negara,
  tbl_wna.kode_wna,
  tbl_wna.nama_wna,
  tbl_wna.alamat_ind,
  tbl_wna.tlp_ind,
  tbl_wna.alamat_ln,
  tbl_wna.tlp_ln,
  tbl_wna.keterangan
FROM
  tbl_wna
  INNER JOIN tbl_mast_negara
    ON tbl_wna.kode_negara = tbl_mast_negara.kode_negara
			WHERE 1=1 ";

				if($KODE_WNA!=''){
					$sql .= "AND kode_wna LIKE '%".$KODE_WNA."%' ";
				}
				
				if($KODE_NEGARA!=''){
					$sql .= "AND kode_negara LIKE '%".$KODE_NEGARA."%' ";
				}
				
				if($NAMA_WNA!=''){
					$sql .= "AND nama_wna LIKE '%".$NAMA_WNA."%' ";
				}
				if($ALAMAT_IND!=''){
					$sql .= "AND alamat_ind LIKE '%".$ALAMAT_IND."%' ";
				}
				if($TLP_IND!=''){
					$sql .= "AND tlp_ind LIKE '%".$TLP_IND."%' ";
				}
				if($ALAMAT_LN!=''){
					$sql .= "AND alamat_ln LIKE '%".$ALAMAT_LN."%' ";
				}
				if($TLP_LN!=''){
					$sql .= "AND tlp_ln LIKE '%".$TLP_LN."%' ";
				}
				if($KETERANGAN!=''){
					$sql .= "AND keterangan LIKE '%".$KETERANGAN."%' ";
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
				
				/*$sql  = "SELECT * ";
				$sql .= "FROM ".$tbl_name." inner join tbl_mast_negara on tbl_mast_negara.kode_negara = tbl_wna.kode_negara  ";
				$sql .= "WHERE 1=1 ";
				*/
				$sql  = "SELECT
  tbl_wna.kode_negara,
  tbl_mast_negara.kode_negara,
  tbl_mast_negara.nama_negara,
  tbl_wna.kode_wna,
  tbl_wna.nama_wna,
  tbl_wna.alamat_ind,
  tbl_wna.tlp_ind,
  tbl_wna.alamat_ln,
  tbl_wna.tlp_ln,
  tbl_wna.keterangan
FROM
  tbl_wna
  INNER JOIN tbl_mast_negara
    ON tbl_wna.kode_negara = tbl_mast_negara.kode_negara
			WHERE 1=1 ";
				if($KODE_WNA!=''){
					$sql .= "AND kode_wna LIKE '%".$KODE_WNA."%' ";
				}
				
				if($KODE_NEGARA!=''){
					$sql .= "AND kode_negara LIKE '%".$KODE_NEGARA."%' ";
				}
				
				if($NAMA_WNA!=''){
					$sql .= "AND nama_wna LIKE '%".$NAMA_WNA."%' ";
				}
				if($ALAMAT_IND!=''){
					$sql .= "AND alamat_ind LIKE '%".$ALAMAT_IND."%' ";
				}
				if($TLP_IND!=''){
					$sql .= "AND tlp_ind LIKE '%".$TLP_IND."%' ";
				}
				if($ALAMAT_LN!=''){
					$sql .= "AND alamat_ln LIKE '%".$ALAMAT_LN."%' ";
				}
				if($TLP_LN!=''){
					$sql .= "AND tlp_ln LIKE '%".$TLP_LN."%' ";
				}
				if($KETERANGAN!=''){
					$sql .= "AND keterangan LIKE '%".$KETERANGAN."%' ";
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

$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_STAF);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_STAF);
$smarty->assign ("FORM_NAME", _STAF);
$smarty->assign ("TITLE", _TITLE_STAF);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_STAF);
$smarty->assign ("TB_CODE", _ID_JENIS_STAF);
$smarty->assign ("TB_NAME", _kode_perwakilan_asing);
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
$smarty->assign ("LIST", _LIST_STAF);
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