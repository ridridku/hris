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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_master/wilayah/kecamatan';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_master');
$FILE_JS  = $JS_MODUL.'/wilayah/kecamatan';

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
$tbl_name	= "tbl_mast_wil_kecamatan";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//


if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="a.no_propinsi ASC,a.no_kabupaten,a.id_kecamatan";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['id_kecamatan']) $CODE = $_GET['id_kecamatan'];
else if ($_POST['id_kecamatan']) $CODE = $_POST['id_kecamatan'];
else $CODE="";

if ($_GET['nama_kecamatan']) $NAME = $_GET['nama_kecamatan'];
else if ($_POST['nama_kecamatan']) $NAME = $_POST['nama_kecamatan'];
else $NAME="";

if ($_GET['nama_propinsi']) $NAMA_PROP = $_GET['nama_propinsi'];
else if ($_POST['nama_propinsi']) $NAMA_PROP = $_POST['nama_propinsi'];
else $NAMA_PROP="";

if ($_GET['nama_kabupaten']) $NAMA_KAB = $_GET['nama_kabupaten'];
else if ($_POST['nama_kabupaten']) $NAMA_KAB = $_POST['nama_kabupaten'];
else $NAMA_KAB="";

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&id_kecamatan=".$CODE."&nama_kecamatan=".$NAME."&nama_propinsi=".$NAMA_PROP."&nama_kabupaten=".$NAMA_KAB;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;

//SHOW DATA PROVINSI

//-------------------------------------
$sql_propinsi = "SELECT id_propinsi,no_propinsi,nama_propinsi FROM tbl_mast_wil_propinsi ";
$result_propinsi = $db->Execute($sql_propinsi);

$initSet = array();
$data_propinsi = array();
$z=0;

while ($arr=$result_propinsi->FetchRow()) {
	array_push($data_propinsi, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PROPINSI", $data_propinsi);

//------------------------------------

//SHOW DATA PROVINSI


if ($_GET[get_prop] == 1)
{
	$no_propinsi = $_GET[no_prop];
			if($no_propinsi!=''){
					$sql_kabupaten = "SELECT id_kabupaten,no_kabupaten,nama_kabupaten FROM tbl_mast_wil_kabupaten WHERE no_propinsi='".$no_propinsi."' ORDER BY id_kabupaten ASC";
					$recordSet_kabupaten = $db->Execute($sql_kabupaten);
					$input_kab="<select name=\"no_kab\" >";
					$input_kab.="<option value=\"[Pilih Kabupaten]\">[Pilih Kabupaten]";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF): 
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields['no_kabupaten'].">".$recordSet_kabupaten->fields['nama_kabupaten'];   
						$input_kab.="</option>";
					$recordSet_kabupaten->MoveNext();
					endwhile; 
					$input_kab.="</select> ";

					$delimeter   = "-";
					$option_choice = $input_kab."^/&".$delimeter;	
					echo $option_choice;
			}
}
				
				
$opt = $_GET[opt];

$ed = 0;
if($opt=="1"){
	$sql_	 = "SELECT * FROM tbl_mast_wil_kecamatan ";
	$sql_	.= "WHERE no_propinsi ='".$_GET['no_propinsi']."' AND no_kabupaten='".$_GET['no_kabupaten']."' AND id_kecamatan='".$_GET['id_kecamatan']."'";
	//print $sql_;
	$resultSet = $db->Execute($sql_);
	$edit_prov_id = $resultSet->fields[no_propinsi];
	$edit_no_kab= $resultSet->fields[no_kabupaten];
	$edit_no_kec= $resultSet->fields[no_kecamatan];
	$edit_id_kec= $resultSet->fields[id_kecamatan];
	$edit_nama_kecamatan = $resultSet->fields[nama_kecamatan];
	$edit = 1;
	
	$sql_kabupaten = "SELECT id_kabupaten,no_kabupaten,nama_kabupaten FROM tbl_mast_wil_kabupaten where no_propinsi='".$_GET['no_propinsi']."' ORDER BY id_kabupaten ASC ";
	$result_kabupaten = $db->Execute($sql_kabupaten);
	$initSet = array();
	$data_kabupaten = array();
	$z=0;
	while ($arr=$result_kabupaten->FetchRow()) {
	array_push($data_kabupaten, $arr);
	array_push($initSet, $z);
	$z++;
	}
	$smarty->assign ("DATA_KABUPATEN", $data_kabupaten);
}
//print $sql_.$edit_prov_id;

$smarty->assign ("OPT", $opt);
$smarty->assign ("EDIT_PROV_ID", $edit_prov_id);
$smarty->assign ("EDIT_NO_KAB", $edit_no_kab);
$smarty->assign ("EDIT_NO_KEC", $edit_no_kec);
$smarty->assign ("EDIT_ID_KEC", $edit_id_kec);
$smarty->assign ("EDIT_KECAMATAN_NAMA", $edit_nama_kecamatan);
//$smarty->assign ("EDIT_PROV_ID", $edit_prov_id);
$smarty->assign ("EDIT_VAL", $edit);


if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{

				$sql  = "SELECT a.no_propinsi,a.no_kabupaten,a.id_kecamatan,a.nama_kecamatan,c.nama_kabupaten,b.nama_propinsi
						FROM tbl_mast_wil_kecamatan as a, 
						(select * FROM tbl_mast_wil_propinsi) as b,
						(SELECT * from tbl_mast_wil_kabupaten) as c
						where a.no_kabupaten=c.no_kabupaten and a.no_propinsi=b.no_propinsi and b.no_propinsi=c.no_propinsi ";

				if($CODE!=''){
					$sql .= "AND a.id_kecamatan LIKE '%".$CODE."%' ";
				}

				if($NAME!=''){
					$sql .= "AND a.nama_kecamatan LIKE '%".$NAME."%' ";
				}
				if($NAMA_PROP!=''){
					$sql .= "AND b.nama_propinsi LIKE '%".$NAMA_PROP."%' ";
				}
				
				if($NAMA_KAB!=''){
					$sql .= "AND c.nama_kabupaten LIKE '%".$NAMA_KAB."%' ";
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
				$sql  = "SELECT a.no_propinsi,a.no_kabupaten,a.id_kecamatan,a.nama_kecamatan,(select nama_propinsi FROM tbl_mast_wil_propinsi WHERE no_propinsi=a.no_propinsi) as nama_propinsi,
						(SELECT nama_kabupaten from tbl_mast_wil_kabupaten WHERE no_propinsi=a.no_propinsi AND no_kabupaten=a.no_kabupaten) as nama_kabupaten
						FROM tbl_mast_wil_kecamatan a WHERE 1=1  ";

				if($CODE!=''){
					$sql .= "AND a.id_kecamatan LIKE '%".$CODE."%' ";
				}

				if($NAME!=''){
					$sql .= "AND a.nama_kecamatan LIKE '%".$NAME."%' ";
				}
				if($NAMA_PROP!=''){
					$sql .= "AND a.nama_propinsi LIKE '%".$NAMA_PROP."%' ";
				}
				
				if($NAMA_KAB!=''){
					$sql .= "AND a.nama_kabupaten LIKE '%".$NAMA_KAB."%' ";
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

$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_KECAMATAN);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_KECAMATAN);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("TITLE", _TITLE_KEC);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_KEC);
$smarty->assign ("TB_CODE", _ID_KEC);
$smarty->assign ("TB_CODE_2", _ID_KECAMATAN);
$smarty->assign ("TB_NAMA_PROP", _NAMA_PROP);
$smarty->assign ("TB_NAMA_KAB", _NAMA_KABUPATEN);
//$smarty->assign ("TB_NAMA_KEC", _NAMA_KEC);
//$smarty->assign ("TB_NO_KAB",_NO_KAB);
$smarty->assign ("TB_NO_KEC",_NO_KEC);
$smarty->assign ("TB_NO_KECAMATAN",_NO_KECAMATAN);
$smarty->assign ("TB_KECAMATAN_NAMA", _NAMA_KECAMATAN);
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
$smarty->assign ("LIST", _LIST_KEC);
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