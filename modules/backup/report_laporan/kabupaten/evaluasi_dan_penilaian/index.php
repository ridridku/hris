<?php

/*** Modify 18-07-2010
***/

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
require_once($DIR_HOME.'/laporan_excell/inc.env.php');

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/report_laporan/kabupaten/evaluasi_dan_penilaian';

#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/report_laporan');
$FILE_JS  = $JS_MODUL.'/kabupaten/evaluasi_dan_penilaian';

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}

$user_id = base64_decode($_SESSION['UID']);

$smarty->assign ("MOD_ID", $mod_id);

$smarty->assign ("ID_PROPINSI",$MAIN_PROP);

#Initiate TABLE

$tbl_name_main = "tbl_form_jl_01_main";
$tbl_name_detail = "tbl_form_jl_01_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";

$tbl_name_jenis_jln = "tbl_mast_jln";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

if ($_GET['Date_Year']) $tahun = $_GET['Date_Year'];
else if ($_POST['Date_Year']) $tahun = $_POST['Date_Year'];
else $tahun="";

if ($_GET['no_propinsi']) $no_propinsi = $_GET['no_propinsi'];
else if ($_POST['no_propinsi']) $no_propinsi = $_POST['no_propinsi'];
else $no_propinsi="";

if ($_GET['jns_jln']) $jns_jln = $_GET['jns_jln'];
else if ($_POST['jns_jln']) $jns_jln = $_POST['jns_jln'];
else $jns_jln="";

$SES_THN		= $_SESSION['SESSION_TAHUN'];
$SES_JNS_JLN	= $_SESSION['SESSION_JNS_JLN'];
$SES_NO_PROP	= $_SESSION['SESSION_NO_PROPINSI'];
$SES_NO_KAB		= $_SESSION['SESSION_NO_KABUPATEN'];

/*** Tambahan MASTER JENIS JALAN ***/
$sql_jln = "SELECT id, nm, ket FROM ".$tbl_name_jenis_jln." ORDER BY id ASC LIMIT 5 ";
$recordSet_jln = $db->Execute($sql_jln);
$initSet = array();
$data_jln = array();
$z=0;
while ($arr=$recordSet_jln->FetchRow()) {
	array_push($data_jln, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_JENIS_JLN", $data_jln);
/*** End 0f MASTER JENIS JALAN ***/

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
	
/*** Add Filtering for id_jns_jln, 30-06-2010
***/	
if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{

	/***
	Kondisi jika id<>0
	1 = Provinsi
	2 = Kabupaten/ Kota
	***/
	$f_id_jns_jln_mantap	= $SES_JNS_JLN!='0'?" AND a.id_jns_jln='".$SES_JNS_JLN."' ":"";
	$f_no_propinsi_mantap	= $SES_NO_PROP!='0'?" AND a.no_propinsi='".$SES_NO_PROP."' ":"";
	$f_no_kabupaten_mantap	= $SES_NO_KAB!='0'?" AND a.no_kabupaten='".$SES_NO_KAB."' ":"";
	$f_id_jns_jln_dak	= $SES_JNS_JLN!='0'?" AND b.id_jns_jln='".$SES_JNS_JLN."' ":"";
	$f_no_propinsi_dak	= $SES_NO_PROP!='0'?" AND b.no_propinsi='".$SES_NO_PROP."' ":"";
	$f_no_kabupaten_dak	= $SES_NO_KAB!='0'?" AND b.no_kabupaten='".$SES_NO_KAB."' ":"";
	$f_no_propinsi_wil	= $SES_NO_PROP!='0'?" AND no_propinsi='".$SES_NO_PROP."' ":"";
								
	$sql_data_wilayah = "SELECT get_nama_propinsi(a1.no_propinsi) as nama_propinsi, a1.no_kabupaten, a1.nama_kabupaten,

	(
	SELECT (((sum(tahun2_baik)*4)+(sum(tahun2_sedang)*3)+(sum(tahun2_rusak)*2)+(sum(tahun2_rusak_berat)*1))/10)-(((sum(tahun1_baik)*4)+(sum(tahun1_sedang)*3)+(sum(tahun1_rusak)*2)+(sum(tahun1_rusak_berat)*1))/10)
	FROM tbl_form_jl_10_main a 
	LEFT JOIN tbl_form_jl_10_detail b ON a.id_fjl_10_main=b.id_fjl_10_main 
	WHERE (a.no_propinsi=a1.no_propinsi $f_no_propinsi_mantap) AND (a.no_kabupaten=a1.no_kabupaten $f_no_kabupaten_mantap) AND a.tahun2='".$tahun."' AND (a.id_jns_jln='".$jns_jln."' $f_id_jns_jln_mantap)
	) as kemantapan,
	
	(
	SELECT (sum(if(rd_dak='1',1,0))/count(rd_dak)*100)
	FROM tbl_form_jl_03_detail a 
	LEFT JOIN tbl_form_jl_03_main b ON a.id_fjl_03_main=b.id_fjl_03_main 
	WHERE (b.no_propinsi=a1.no_propinsi $f_no_propinsi_dak) AND (b.no_kabupaten=a1.no_kabupaten $f_no_kabupaten_dak) AND YEAR(b.tanggal)='".$tahun."' AND (b.id_jns_jln='".$jns_jln."' $f_id_jns_jln_dak)
	) as rd_dak,

	(
	SELECT (sum(realisasi_fisik)/sum(rencana_fisik))*100
	FROM tbl_form_jl_06_detail a 
	LEFT JOIN tbl_form_jl_06_main b ON a.id_fjl_06_main=b.id_fjl_06_main 
	WHERE (b.no_propinsi=a1.no_propinsi $f_no_propinsi_dak) AND (b.no_kabupaten=a1.no_kabupaten $f_no_kabupaten_dak) AND YEAR(b.tanggal)='".$tahun."' AND (b.id_jns_jln='".$jns_jln."' $f_id_jns_jln_dak)
	) as deviasi,	

	(
	SELECT (sum(if(rd='1',1,0))/count(rd)*100)
	FROM tbl_form_jl_03_detail a 
	LEFT JOIN tbl_form_jl_03_main b ON a.id_fjl_03_main=b.id_fjl_03_main 
	WHERE (b.no_propinsi=a1.no_propinsi $f_no_propinsi_dak) AND (b.no_kabupaten=a1.no_kabupaten $f_no_kabupaten_dak) AND YEAR(b.tanggal)='".$tahun."' AND (b.id_jns_jln='".$jns_jln."' $f_id_jns_jln_dak)
	) as rd		
	
	FROM tbl_mast_wil_kabupaten a1 WHERE a1.no_propinsi='".$no_propinsi."' $f_no_propinsi_wil ";

		$recordSet_wilayah = $db->execute($sql_data_wilayah);
		$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];		
		$jenis_jalan	= $jns_jln==1?"Provinsi":"Kabupaten/ Kota";
		
		$initSet = array();
		$data_wilayah = array();
		$z=0;
		while ($arr=$recordSet_wilayah->FetchRow()) {
			$content_data .= print_content($z+1,$arr[nama_kabupaten],$arr[kemantapan],$arr[rd_dak],$arr[rd],$arr[deviasi],"","","","");
			array_push($data_wilayah, $arr);
			array_push($initSet, $z);
			$z++;
		}
                
		$smarty->assign ("DATA_WILAYAH", $data_wilayah);

				$file= $DIR_HOME."/files/env_".$no_propinsi."_".$no_kabupaten."_".$jns_jln."_".$tahun.".xls";

				$fp=@fopen($file,"w");
				if(!is_resource($fp))
				return false;
				//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
				stream_set_write_buffer($fp, 0);
				
				$content = print_header($nama_propinsi,$tahun,$jenis_jalan);
				$content .= $content_data;
				$content .= print_footer();
				
				fwrite($fp,$content);
				fclose($fp);
				$file_2= $HREF_HOME."/files/env_".$no_propinsi."_".$no_kabupaten."_".$jns_jln."_".$tahun.".xls";				
			
	}

}

($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;


$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NO_KABUPATEN", $no_kabupaten);
$smarty->assign ("NO_JENIS_JALAN", $jns_jln);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten);
$smarty->assign ("TAHUN", $tahun);
$smarty->assign ("FILES", $file_2);
$smarty->assign ("HEAD_TITLE", _PRINT_HEAD_TITLE_JL_01_MAIN);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("TB_NO_KABUPATEN", _NO_KABUPATEN);
$smarty->assign ("TB_NO_RUAS", _NO_RUAS);
$smarty->assign ("TB_NAMA_RUAS", _NAMA_RUAS);
$smarty->assign ("TB_TITIK_PENGENAL_PANGKAL", _TITIK_PENGENAL_PANGKAL);
$smarty->assign ("TB_TITIK_PENGENAL_UJUNG", _TITIK_PENGENAL_UJUNG);
$smarty->assign ("TB_NAMA_KECAMATAN", _NAMA_KECAMATAN);
$smarty->assign ("TB_PANJANG_RUAS", _PANJANG_RUAS);
$smarty->assign ("TB_LEBAR_RATA_RATA", _LEBAR_RATA_RATA);
$smarty->assign ("TB_PANJANG_PERMUKAAN", _PANJANG_PERMUKAAN);
$smarty->assign ("TB_ASPAL", _ASPAL);
$smarty->assign ("TB_PM", _PENETRASI_MACADAM);
$smarty->assign ("TB_TELFORD", _TELFORD);
$smarty->assign ("TB_TANAH", _TANAH);
$smarty->assign ("TB_BLM_TEMBUS", _BELUM_TEMBUS);
$smarty->assign ("TB_KETERANGAN", _KETERANGAN);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _PRINT_KAB_EVALUASI_PENILAIAN);
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

$smarty->assign ("TB_JENIS_JALAN", _NAMA_JENIS_JALAN);

// kolom pada form pencarian
$smarty->assign ("PID_JENIS_JLN2", $jns_jln);
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