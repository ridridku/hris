<?php

/*** Modify 30-06-2010
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
require_once($DIR_HOME.'/laporan_excell/inc.jl_05.php');

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/report_laporan/kabupaten/lap_jl_05';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/report_laporan');
$FILE_JS  = $JS_MODUL.'/kabupaten/lap_jl_05';

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

$tbl_name_main = "tbl_form_jl_05_main";
$tbl_name_detail = "tbl_form_jl_05_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
$tbl_mast_prop_sumber_dana_lain = "tbl_mast_prop_sumber_dana_lain";
$tbl_mast_prop_jenis_penanganan = "tbl_mast_prop_jenis_penanganan";
/*** Tambahan 06-06-2010 ***/
$tbl_name_jenis_jln = "tbl_mast_jln";
/*** End 0f Tambahan ***/

//-----------------------------------END OF LOCAL CONFIG-------------------------------//


if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="a.id_fjl_05_detail";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['no_propinsi']) $no_propinsi = $_GET['no_propinsi'];
else if ($_POST['no_propinsi']) $no_propinsi = $_POST['no_propinsi'];
else $no_propinsi="";

if ($_GET['no_kabupaten']) $no_kabupaten = $_GET['no_kabupaten'];
else if ($_POST['no_kabupaten']) $no_kabupaten = $_POST['no_kabupaten'];
else $no_kabupaten="";

if ($_GET['jns_jln']) $jns_jln = $_GET['jns_jln'];
else if ($_POST['jns_jln']) $jns_jln = $_POST['jns_jln'];
else $jns_jln="";

if ($_GET['jns_jln2']) $jns_jln = $_GET['jns_jln2'];
else if ($_POST['jns_jln2']) $jns_jln = $_POST['jns_jln2'];
else $jns_jln2="";

$fields_find_jns_jln_	= $jns_jln!=""?$jns_jln:$jns_jln2;

$Search_Year = $_GET[Search_Year];

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year."&jns_jln=".$jns_jln;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year."&jns_jln=".$jns_jln;

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

//----------Menampilkan Data Kabupaten---------------------------

if ($_GET[get_propinsi] == 1)
{
	$no_propinsi = $_GET[no_propinsi];
			if($no_propinsi!=''){	
					$sql_kab_combo 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$no_propinsi' ORDER BY nama_kabupaten ASC";
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
	$sql_kabupaten 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$no_propinsi' ORDER BY nama_kabupaten ASC";
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
} else {
	$sql_kabupaten 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$MAIN_PROP' ORDER BY nama_kabupaten ASC";
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

				/***
				Kondisi jika id<>0
				1 = Provinsi
				2 = Kabupaten/ Kota
				***/
				//$no_propinsi	= $_POST['no_propinsi'];
				//$no_kabupaten	= $_POST['no_kabupaten'];
				
				$f_id_jns_jln	= $_SESSION['SESSION_JNS_JLN']!='0'?" AND b.id_jns_jln='".$_SESSION['SESSION_JNS_JLN']."' ":"";
				$f_no_propinsi	= $_SESSION['SESSION_NO_PROPINSI']!='0'?" AND b.no_propinsi='".$_SESSION['SESSION_NO_PROPINSI']."' ":"";
				$f_no_kabupaten	= $_SESSION['SESSION_NO_KABUPATEN']!='0'?" AND b.no_kabupaten='".$_SESSION['SESSION_NO_KABUPATEN']."' ":"";
								
				$sql_data_wilayah = "SELECT get_nama_propinsi(no_propinsi) as nama_propinsi,get_nama_kabupaten(no_propinsi,no_kabupaten) as nama_kabupaten FROM ".$tbl_name_kabupaten." WHERE no_propinsi='".$no_propinsi."' AND no_kabupaten='".$no_kabupaten."' ";
				$recordSet_wilayah = $db->execute($sql_data_wilayah);
				$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];
				$nama_kabupaten = $recordSet_wilayah->fields[nama_kabupaten];
				$jenis_jalan	= $jns_jln==1?"Provinsi":"Kabupaten/ Kota";
				$sql = "SELECT * 
				FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_05_main=b.id_fjl_05_main 
				LEFT JOIN ".$tbl_mast_prop_sumber_dana_lain." c ON c.id_prop_sumber_dana_lain=a.sumber_pendanaan LEFT JOIN ".$tbl_mast_prop_jenis_penanganan." d ON d.id_prop_jenis_penanganan=a.nama_jenis_penanganan WHERE 1=1 ";

				if($no_propinsi!='' AND $no_kabupaten!='' AND $jns_jln!=''){
					$sql .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' AND YEAR(b.tanggal)='".$Search_Year."' AND b.id_jns_jln='".$jns_jln."' ";
				}
				$sql .= "ORDER BY ".$ORDER." ".$SORT." ";
				
				//print $sql;
				
				/***
				if($no_propinsi!='' AND $no_kabupaten!='' AND $Search_Year!='' AND $jns_jln==''){
					$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) AND YEAR(b.tanggal)='".$Search_Year."' $f_id_jns_jln ";
				} else if ($no_propinsi!='' AND $no_kabupaten!='' AND $tahun!=''  AND $jns_jln!=''){
					$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) AND (b.id_jns_jln='".$jns_jln."' $f_id_jns_jln) AND YEAR(b.tanggal)='".$Search_Year."' ";
				} else {
					$sql .= "AND b.no_propinsi='".$_SESSION['SESSION_NO_PROPINSI']."' AND b.no_kabupaten='".$_SESSION['SESSION_NO_KABUPATEN']."' $f_id_jns_jln ";
				}
								
				$sql .= "ORDER BY ".$ORDER." ".$SORT." ";
				
				
				print $sql;
				print "<br>".$_SESSION['SESSION_NO_PROPINSI'];
				***/
				
				if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);

				$numresults=$db->Execute($sql);
				$count = $numresults->RecordCount();

				$pages = $p->findPages($count,$LIMIT); 
				//$sql  .= "LIMIT ".$start.", ".$LIMIT;
				$recordSet = $db->Execute($sql);
				$end = $recordSet->RecordCount();
				$initSet = array();
				$data_tb = array();
				$data_target_m = array();
				$data_biaya_total = array();
				$row_class = array();
				$data_tanggal_spmk = array();
				$data_rencana_pho = array();
				$data_nama_paket = array();
				$z=0;

				while ($arr=$recordSet->FetchRow()) {
					$tgl1 = explode("-", $arr[tanggal_spmk], strlen($arr[tanggal_spmk]));
					$tgl2 = explode("-", $arr[rencana_pho], strlen($arr[rencana_pho]));					
					$tgl_spmk = $tgl1[2]."-".$tgl1[1]."-".$tgl1[0];
					$tgl_rencana_pho = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0];
					$target_m = number_format($arr[target_m],2,',','.');;
					$biaya_total = number_format($arr[biaya_total],2,',','.');;
					$nama_paket = $arr[nama_prop_jenis_penanganan]." jalan ".$arr[nama_ruas];
					//$content_data .= print_content($z+1,$arr[nama_paket],$arr[kecamatan_yg_dilalui],$arr[target_m],$arr[target_unit],$arr[biaya_total],$arr[metoda_pelaksanaan],$tgl_spmk,$tgl_rencana_pho,$arr[waktu_pelaksanaan],$arr[pimpro],$arr[kontraktor],$arr[pengawas],$arr[keterangan],$arr[nama_prop_sumber_dana_lain]);
					$content_data .= print_content($z+1,$nama_paket,$arr[kecamatan_yg_dilalui],$arr[target_m],$arr[biaya_total],$arr[metoda_pelaksanaan],$tgl_spmk,$tgl_rencana_pho,$arr[waktu_pelaksanaan],$arr[pimpro],$arr[kontraktor],$arr[pengawas],$arr[keterangan],$arr[nama_prop_sumber_dana_lain]);
					array_push($data_tb, $arr);
					array_push($data_target_m, $target_m);
					array_push($data_biaya_total, $biaya_total);
					array_push($data_tanggal_spmk,$tgl_spmk);
					array_push($data_rencana_pho,$tgl_rencana_pho);
					array_push($data_nama_paket,$nama_paket);
					
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
				
				$file= $DIR_HOME."/files/jl_05_".$no_propinsi."_".$no_kabupaten."_".$jns_jln."_".$Search_Year.".xls";

				$fp=@fopen($file,"w");
				if(!is_resource($fp))
				return false;
				//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
				stream_set_write_buffer($fp, 0);
				
				$content = print_header($nama_propinsi,$nama_kabupaten,$Search_Year,$jenis_jalan);
				$content .= $content_data;
				$content .= print_footer();
				
				fwrite($fp,$content);
				fclose($fp);
				$file_2= $HREF_HOME."/files/jl_05_".$no_propinsi."_".$no_kabupaten."_".$jns_jln."_".$Search_Year.".xls";
}

}

($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;


$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NO_KABUPATEN", $no_kabupaten);
$smarty->assign ("NO_JENIS_JALAN", $jns_jln);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten);
$smarty->assign ("SEARCH_YEAR", $Search_Year);
$smarty->assign ("FILES", $file_2);
$smarty->assign ("TITLE", _TITLE_FORM_JL_05_MAIN);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_FORM_JL_05_MAIN);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("TB_NAMA_PAKET", _NAMA_PAKET);
$smarty->assign ("TB_NAMA_KECAMATAN", _NAMA_KECAMATAN);
$smarty->assign ("TB_TARGET", _TARGET);
$smarty->assign ("TB_TARGET_M", _TARGET_M);
/*** Disabled on 22-09-2010
$smarty->assign ("TB_TARGET_UNIT", _TARGET_UNIT);
***/
$smarty->assign ("TB_BIAYA", _BIAYA);
/*** Disabled on 07-09-2010
$smarty->assign ("TB_BIAYA_DAK", _BIAYA_DAK);
$smarty->assign ("TB_BIAYA_PENDAMPING", _BIAYA_PENDAMPING);
***/
$smarty->assign ("TB_SUMBER_PENDANAAN", _SUMBER_PENDANAAN);
$smarty->assign ("TB_BIAYA_TOTAL", _BIAYA_TOTAL);
$smarty->assign ("TB_METODA_PELAKSANAAN", _METODA_PELAKSANAAN);
$smarty->assign ("TB_TANGGAL_SPMK", _TANGGAL_SPMK);
$smarty->assign ("TB_RENCANA_PHO", _RENCANA_PHO);
$smarty->assign ("TB_WAKTU_PELAKSANAAN", _WAKTU_PELAKSANAAN);
$smarty->assign ("TB_PIMPRO", _PIMPRO);
$smarty->assign ("TB_KONTRAKTOR", _KONTRAKTOR);
$smarty->assign ("TB_PENGAWAS_LAPANGAN", _PENGAWAS_LAPANGAN);
$smarty->assign ("TB_KETERANGAN", _KETERANGAN);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_FORM_JL_05_MAIN);
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
/*** Tambahan 06-06-2010 ***/
$smarty->assign ("TB_JENIS_JALAN", _NAMA_JENIS_JALAN);
// kolom pada form pencarian
$smarty->assign ("PID_JENIS_JLN2", $fields_find_jns_jln_);
/*** End 0f 06-06-2010 ***/
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
$smarty->assign ("DATA_TANGGAL_SPMK",$data_tanggal_spmk);
$smarty->assign ("DATA_RENCANA_PHO",$data_rencana_pho);
$smarty->assign ("DATA_TARGET_M",$data_target_m);
$smarty->assign ("DATA_BIAYA_TOTAL",$data_biaya_total);
$smarty->assign ("DATA_NAMA_PAKET",$data_nama_paket);

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