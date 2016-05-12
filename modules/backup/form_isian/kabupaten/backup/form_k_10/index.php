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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_k_10';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_k_10';

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

$tbl_name_main = "tbl_form_k_10_main";
$tbl_name_detail = "tbl_form_k_10_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
$tbl_name_tipe_penyebrangan = "tbl_mast_jembatan_penyebrangan";
$tbl_name_tipe_bangunan_atas = "tbl_mast_jembatan_bangunan_atas";
$tbl_name_tipe_bangunan_bahan = "tbl_mast_jembatan_bahan";
$tbl_name_tipe_pondasi = "tbl_mast_jembatan_pondasi";
$tbl_name_tipe_kepala_jembatan = "tbl_mast_jembatan_kepala";
$tbl_name_tipe_pilar = "tbl_mast_jembatan_pilar";
$tbl_name_kondisi = "tbl_mast_jembatan_kondisi";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//


if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="a.no_ruas";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['no_propinsi']) $no_propinsi = $_GET['no_propinsi'];
else if ($_POST['no_propinsi']) $no_propinsi = $_POST['no_propinsi'];
else $no_propinsi="";

if ($_GET['no_kabupaten']) $no_kabupaten = $_GET['no_kabupaten'];
else if ($_POST['no_kabupaten']) $no_kabupaten = $_POST['no_kabupaten'];
else $no_kabupaten="";

$Search_Year = $_GET[Search_Year];

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year;


//----------EDIT DATA FORM K-01-----------------------------------

$opt = $_GET[opt];
$id_k_10_main = $_GET[id_k_10_main];
$id_form_k_10_detail = $_GET[id_k_10_detail];
$ed = 0;

if ($opt=="1" AND $id_k_10_main<>'' AND $id_form_k_10_detail<>'') {

$sql = "SELECT * 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fk_10_main=b.id_k_10_main 
		WHERE 1=1 AND b.id_k_10_main='".$id_k_10_main."' AND a.id_fk_10_detail='".$id_form_k_10_detail."' ";
$recordSet_Edit = $db->execute($sql);

$edit = 1;	

$smarty->assign ("OPT", $opt);					
$smarty->assign ("ID_K_10_MAIN", $recordSet_Edit->fields[id_k_10_main]);
$smarty->assign ("ID_FORM_K_10_DETAIL", $recordSet_Edit->fields[id_fk_10_detail]);
$smarty->assign ("TANGGAL", $recordSet_Edit->fields[tanggal]);

$smarty->assign ("NAMA_PENGGISI", $recordSet_Edit->fields[nama_penggisi]);
$smarty->assign ("NO_RUAS", $recordSet_Edit->fields[no_ruas]);
$smarty->assign ("NAMA_JEMBATAN_SUNGAI", $recordSet_Edit->fields[nama_jembatan_sungai]);
$smarty->assign ("PAL_KM", $recordSet_Edit->fields[pal_km]);
$smarty->assign ("TIPE_PENYEBRANGAN", $recordSet_Edit->fields[tipe_penyebrangan]);
$smarty->assign ("PANJANG", $recordSet_Edit->fields[panjang]);
$smarty->assign ("LEBAR", $recordSet_Edit->fields[lebar]);
$smarty->assign ("JUMLAH_BENTANG", $recordSet_Edit->fields[jumlah_bentang]);
$smarty->assign ("BANGUNAN_ATAS_TIPE", $recordSet_Edit->fields[bangunan_atas_tipe]);
$smarty->assign ("BANGUNAN_ATAS_BAHAN", $recordSet_Edit->fields[bangunan_atas_bahan]);
$smarty->assign ("BANGUNAN_ATAS_ASAL", $recordSet_Edit->fields[bangunan_atas_asal]);
$smarty->assign ("BANGUNAN_ATAS_KONDISI", $recordSet_Edit->fields[bangunan_atas_kondisi]);
$smarty->assign ("LANTAI_TIPE1", $recordSet_Edit->fields[lantai_tipe1]);
$smarty->assign ("LANTAI_TIPE2", $recordSet_Edit->fields[lantai_tipe2]);
$smarty->assign ("LANTAI_KONDISI", $recordSet_Edit->fields[lantai_kondisi]);
$smarty->assign ("SANDARAN_TIPE1", $recordSet_Edit->fields[sandaran_tipe1]);
$smarty->assign ("SANDARAN_TIPE2", $recordSet_Edit->fields[sandaran_tipe2]);
$smarty->assign ("SANDARAN_KONDISI", $recordSet_Edit->fields[sandaran_kondisi]);
$smarty->assign ("PONDASI_TIPE", $recordSet_Edit->fields[pondasi_tipe]);
$smarty->assign ("PONDASI_BAHAN1", $recordSet_Edit->fields[pondasi_bahan1]);
$smarty->assign ("PONDASI_BAHAN2", $recordSet_Edit->fields[pondasi_bahan2]);
$smarty->assign ("PONDASI_KONDISI", $recordSet_Edit->fields[pondasi_kondisi]);
$smarty->assign ("KEP_JEMBATAN_TIPE", $recordSet_Edit->fields[kep_jembatan_tipe]);
$smarty->assign ("KEP_JEMBATAN_BAHAN1", $recordSet_Edit->fields[kep_jembatan_bahan1]);
$smarty->assign ("KEP_JEMBATAN_BAHAN2", $recordSet_Edit->fields[kep_jembatan_bahan2]);

}

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



//-------------MASTER JEMBATAN TIPE PENYEBRANGAN---------------------------

$sql_tipe_penyebrangan = "SELECT * FROM ".$tbl_name_tipe_penyebrangan." ORDER BY nama_tipe_penyebrangan ASC";
$recordSet_tipe_penyebrangan = $db->Execute($sql_tipe_penyebrangan);
$initSet = array();
$data_tipe_penyebrangan = array();
$z=0;
while ($arr=$recordSet_tipe_penyebrangan->FetchRow()) {
	array_push($data_tipe_penyebrangan, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_TIPE_PENYEBRANGAN", $data_tipe_penyebrangan);

//-------------MASTER JEMBATAN BANGUNAN ATAS---------------------------

$sql_tipe_bangunan_atas = "SELECT * FROM ".$tbl_name_tipe_bangunan_atas." ORDER BY nama_bangunan_atas_jembatan ASC";
$recordSet_tipe_bangunan_atas = $db->Execute($sql_tipe_bangunan_atas);
$initSet = array();
$data_tipe_bangunan_atas = array();
$z=0;
while ($arr=$recordSet_tipe_bangunan_atas->FetchRow()) {
	array_push($data_tipe_bangunan_atas, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_TIPE_BANGUNAN_ATAS", $data_tipe_bangunan_atas);


//-------------MASTER JEMBATAN BANGUNAN BAHAN---------------------------

$sql_tipe_bangunan_bahan = "SELECT * FROM ".$tbl_name_tipe_bangunan_bahan." ORDER BY nama_bahan_jembatan ASC";
$recordSet_tipe_bangunan_bahan = $db->Execute($sql_tipe_bangunan_bahan);
$initSet = array();
$data_tipe_bangunan_bahan = array();
$z=0;
while ($arr=$recordSet_tipe_bangunan_bahan->FetchRow()) {
	array_push($data_tipe_bangunan_bahan, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_TIPE_BANGUNAN_BAHAN", $data_tipe_bangunan_bahan);

//-------------MASTER JEMBATAN TIPE PONDASI---------------------------

$sql_tipe_pondasi = "SELECT * FROM ".$tbl_name_tipe_pondasi." ORDER BY nama_pondasi_jembatan ASC";
$recordSet_tipe_pondasi = $db->Execute($sql_tipe_pondasi);
$initSet = array();
$data_tipe_pondasi = array();
$z=0;
while ($arr=$recordSet_tipe_pondasi->FetchRow()) {
	array_push($data_tipe_pondasi, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_TIPE_PONDASI", $data_tipe_pondasi);

//-------------MASTER JEMBATAN TIPE KEPALA JEMBATAN---------------------------

$sql_tipe_kepala_jembatan = "SELECT * FROM ".$tbl_name_tipe_kepala_jembatan." ORDER BY nama_kepala_jembatan ASC";
$recordSet_tipe_kepala_jembatan = $db->Execute($sql_tipe_kepala_jembatan);
$initSet = array();
$data_tipe_kepala_jembatan = array();
$z=0;
while ($arr=$recordSet_tipe_kepala_jembatan->FetchRow()) {
	array_push($data_tipe_kepala_jembatan, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_TIPE_KEPALA_JEMBATAN", $data_tipe_kepala_jembatan);



//-------------MASTER JEMBATAN TIPE PILAR---------------------------

$sql_tipe_pilar = "SELECT * FROM ".$tbl_name_tipe_pilar." ORDER BY nama_pilar_jembatan ASC";
$recordSet_tipe_pilar = $db->Execute($sql_tipe_pilar);
$initSet = array();
$data_tipe_pilar = array();
$z=0;
while ($arr=$recordSet_tipe_pilar->FetchRow()) {
	array_push($data_tipe_pilar, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_TIPE_PILAR", $data_tipe_pilar);


//-------------MASTER JEMBATAN KONDISI---------------------------

$sql_kondisi = "SELECT * FROM ".$tbl_name_kondisi." ORDER BY nama_kondisi_jembatan ASC";
$recordSet_kondisi = $db->Execute($sql_kondisi);
$initSet = array();
$data_kondisi = array();
$z=0;
while ($arr=$recordSet_kondisi->FetchRow()) {
	array_push($data_kondisi, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_KONDISI", $data_kondisi);


//----------Menampilkan Data Kabupaten---------------------------

if ($_GET[get_propinsi] == 1)
{
	$no_propinsi = $_GET[no_propinsi];
			if($no_propinsi!=''){	
					$sql_kab_combo 	  = "SELECT * FROM ".$tbl_name_kabupaten." where no_propinsi='$no_propinsi'";
					$result_kab_combo  = $db->Execute($sql_kab_combo);
					$input_kab="<select name=no_kabupaten>";
					$input_kab.="<option>[Pilih Kabupaten]";
					$input_kab.="</option> ";
					while(!$result_kab_combo ->EOF): 						
						($result_kab_combo  ->fields['no_kabupaten']==$no_kabupaten) ? $selected=" selected":$selected=NULL;
						$input_kab.="<option value=";
						$input_kab.= $result_kab_combo  ->fields['no_kabupaten']."".$selected.">".$result_kab_combo ->fields['nama_kabupaten'];   
						$input_kab.="</option>";
					$result_kab_combo->MoveNext();
					endwhile; 
					$input_kab.="</select> ";
					//
					$delimeter   = "-";
					$option_choice = $input_kab."^/&".$delimeter;	
					echo $option_choice;
			}
}

//---------------------------------------------------------------

if($no_propinsi!=''){	
	$sql_kabupaten 	  = "SELECT * FROM ".$tbl_name_kabupaten." where no_propinsi='$no_propinsi'";
	$recordSet_kabupaten = $db->Execute($sql_kabupaten);
	$initSet = array();
	$data_kabupaten = array();
	$z=0;
	while ($arr=$recordSet_kabupaten->FetchRow()) {
		array_push($data_kabupaten, $arr);
		array_push($initSet, $z);
		$z++;
	}
	$smarty->assign ("DATA_KABUPATEN", $data_kabupaten);
}
		
			
if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
				

				$sql_data_wilayah = "SELECT get_nama_propinsi(no_propinsi) as nama_propinsi,get_nama_kabupaten(no_propinsi,no_kabupaten) as nama_kabupaten FROM ".$tbl_name_kabupaten." WHERE no_propinsi='".$no_propinsi."' AND no_kabupaten='".$no_kabupaten."' ";
				$recordSet_wilayah = $db->execute($sql_data_wilayah);
				$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];
				$nama_kabupaten = $recordSet_wilayah->fields[nama_kabupaten];
				
				$sql = "SELECT b.id_k_10_main,a.id_fk_10_detail,a.no_ruas,a.nama_jembatan_sungai,a.pal_km,b.nama_penggisi 
				FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fk_10_main=b.id_k_10_main 
				WHERE 1=1 ";
				
				if($no_propinsi!='' AND $no_kabupaten!=''){
					$sql .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' AND YEAR(b.tanggal)='".$Search_Year."' ";
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

($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;


$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_FORM_K_10);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_FORM_K_10);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NO_KABUPATEN", $no_kabupaten);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten);
$smarty->assign ("SEARCH_YEAR", $Search_Year);
$smarty->assign ("TITLE", _TITLE_FORM_K_10_MAIN);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_FORM_K_10_MAIN);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);
$smarty->assign ("TB_NO_RUAS", _NO_RUAS);
$smarty->assign ("TB_NAMA_JEMBATAN", _NAMA_JEMBATAN);
$smarty->assign ("TB_PAL_KM", _PAL_KM);
$smarty->assign ("TB_NAMA_PENGGISI", _NAMA_PENGGISI);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_FORM_K_10_MAIN);
$smarty->assign ("RECORD_PER_PAGE", _RECORD_PER_PAGE);
$smarty->assign ("ACTION", _ACTION);
$smarty->assign ("EDIT", _EDIT);
$smarty->assign ("DELETE", _DELETE);
$smarty->assign ("SORT_IN", _SORT_IN);
$smarty->assign ("SORT_ORDER", _SORT_ORDER);
$smarty->assign ("SHOWING", _SHOWING);
$smarty->assign ("OF", _OF);
$smarty->assign ("RECORDS", _RECORDS);
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