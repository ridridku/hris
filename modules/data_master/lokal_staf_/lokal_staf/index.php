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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_master/lokal_staf/lokal_staf';


#SETTING FILE JS INCLUDE
// themes\defaults\javascripts\modules\data_master\wilayah\propinsi
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_master');
$FILE_JS  = $JS_MODUL.'/lokal_staf/lokal_staf';

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
$tbl_name	= "tbl_mast_staf";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//


if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="kode_staf";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['kode_staf']) $CODE = $_GET['kode_staf'];
else if ($_POST['kode_staf']) $CODE = $_POST['kode_staf'];
else $CODE="";

if ($_GET['kode_perwakilan_asing']) $KODE_P = $_GET['kode_perwakilan_asing'];
else if ($_POST['kode_perwakilan_asing']) $KODE_P = $_POST['kode_perwakilan_asing'];
else $KODE_P="";

if ($_GET['nama']) $NAMA = $_GET['nama'];
else if ($_POST['nama']) $NAMA = $_POST['nama'];
else $NAMA="";

if ($_GET['kode_jenis_pw_cari']) $kode_jenis_pw_cari = $_GET['kode_jenis_pw_cari'];
else if ($_POST['kode_jenis_pw_cari']) $kode_jenis_pw_cari = $_POST['kode_jenis_pw_cari'];
else $kode_jenis_pw_cari="";
 


$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_staf=".$CODE."&kode_perwakilan_asing=".$KODE_P."&nama=".$NAMA."&alamat=".$ALAMAT."&tlp=".$TLP."&jk=".$JK."&kode_jenis_pw_cari=".$kode_jenis_pw_cari;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;


if ($_GET[get_prop] == 1)
{
	$no_propinsi = $_GET[no_prop];
			if($no_propinsi!=''){	
					$sql_kabupaten = "SELECT * from tbl_mast_perwakilan_asing  WHERE kode_jenis_pw='".$no_propinsi."'  ";
					$recordSet_kabupaten = $db->Execute($sql_kabupaten);
					//print $sql_kabupaten;
					$input_kab="<select name=kode_perwakilan_asing  >";
					$input_kab.="<option value= > Pilih Perwakilan Asing ";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF): 
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields['kode_perwakilan_asing'].">".$recordSet_kabupaten->fields['nama_perwakilan'];   
						$input_kab.="</option>";
					$recordSet_kabupaten->MoveNext();
					endwhile; 
					$input_kab.="</select> ";
					//
					$delimeter   = "-";
					$option_choice = $input_kab."^/&".$delimeter;	
					echo $option_choice;
			}
}
 





$opt = $_GET[opt];

$kod=$_GET['kode_staf'];

$ed = 0;
if($opt=="1"){
	
	$sql_	 = "SELECT * FROM ".$tbl_name."  inner join tbl_mast_perwakilan_asing on tbl_mast_perwakilan_asing.kode_perwakilan_asing = tbl_mast_staf.kode_perwakilan_asing ";
	$sql_	.= "WHERE tbl_mast_staf.kode_staf ='".$kod."' ";
	$resultSet = $db->Execute($sql_);
	$edit_kode_staf = $resultSet->fields[kode_staf];
	$edit_kode_perwakilan_asing = $resultSet->fields[kode_perwakilan_asing];
	$edit_nama = $resultSet->fields[nama];
	$edit_alamat = $resultSet->fields[alamat];
	$edit_tlp = $resultSet->fields[tlp];
	$edit_jk = $resultSet->fields[jk];
	$edit_tgl_lahir = $resultSet->fields[tgl_lahir];
	$edit_tempat_lahir = $resultSet->fields[tempat_lahir];
		$kode_jenis_pw = $resultSet->fields[kode_jenis_pw];
	$edit = 1;
 


 // SHOW DATA PERWAKILAN ========================
$sql_perwakilan_asing_show = "SELECT  *  FROM tbl_mast_perwakilan_asing where kode_jenis_pw='$kode_jenis_pw' ";
$result_perwakilan_asing_show = $db->Execute($sql_perwakilan_asing_show);
$initSet = array();
$data_perwakilan_asing_show = array();
$z=0;
while ($arr=$result_perwakilan_asing_show->FetchRow()) {
	array_push($data_perwakilan_asing_show, $arr);
	array_push($initSet, $z);
	$z++;
}

$smarty->assign ("DATA_PERWAKILAN_ASING_SHOW", $data_perwakilan_asing_show);



}

$smarty->assign ("OPT", $opt);
$smarty->assign ("EDIT_KODE_STAF", $edit_kode_staf);
$smarty->assign ("EDIT_KODE_PERWAKILAN_ASING", $edit_kode_perwakilan_asing);
$smarty->assign ("EDIT_NAMA", $edit_nama);
$smarty->assign ("EDIT_ALAMAT", $edit_alamat);
$smarty->assign ("EDIT_TLP", $edit_tlp);
$smarty->assign ("EDIT_JK", $edit_jk);
$smarty->assign ("EDIT_TGL_LAHIR", $edit_tgl_lahir);
$smarty->assign ("EDIT_TEMPAT_LAHIR", $edit_tempat_lahir);
$smarty->assign ("JENIS_PW", $kode_jenis_pw);
$smarty->assign ("EDIT_VAL", $edit);


if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{

				$sql  = "SELECT * ";
				$sql .= "FROM ".$tbl_name." inner join tbl_mast_perwakilan_asing on tbl_mast_perwakilan_asing.kode_perwakilan_asing = tbl_mast_staf.kode_perwakilan_asing  ";
				$sql .= "WHERE 1=1 ";

				if($CODE!=''){
					$sql .= "AND kode_staf LIKE '%".$CODE."%' ";
				}
				
				if($KODE_P!=''){
					$sql .= "AND kode_perwakilan_asing LIKE '%".$KODE_P."%' ";
				}
				
				if($NAMA!=''){
					$sql .= "AND nama LIKE '%".$NAMA."%' ";
				}
				if($kode_jenis_pw_cari!=''){
						$sql .= "AND kode_jenis_pw = '".$kode_jenis_pw_cari."' ";
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
				
				$sql  = "SELECT * ";
				$sql .= "FROM ".$tbl_name." inner join tbl_mast_perwakilan_asing on tbl_mast_perwakilan_asing.kode_perwakilan_asing = tbl_mast_staf.kode_perwakilan_asing  ";
				$sql .= "WHERE 1=1 ";

				if($CODE!=''){
					$sql .= "AND kode_staf LIKE '%".$CODE."%' ";
				}
				
				if($KODE_P!=''){
					$sql .= "AND kode_perwakilan_asing LIKE '%".$KODE_P."%' ";
				}
				
				if($NAMA!=''){
					$sql .= "AND nama LIKE '%".$NAMA."%' ";
				}

				if($kode_jenis_pw_cari!=''){
					$sql .= "AND kode_jenis_pw = '".$kode_jenis_pw_cari."' ";
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