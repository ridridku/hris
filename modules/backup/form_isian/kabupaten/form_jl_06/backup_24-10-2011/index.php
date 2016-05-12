<?php
/*** Last Modify 17-07-2010
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_jl_06';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_jl_06';

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

$tbl_name_main = "tbl_form_jl_06_main";
$tbl_name_detail = "tbl_form_jl_06_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
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
else $ORDER="a.nama_paket";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['no_propinsi']) $no_propinsi = $_GET['no_propinsi'];
else if ($_POST['no_propinsi']) $no_propinsi = $_POST['no_propinsi'];
else $no_propinsi="";

if ($_GET['no_kabupaten']) $no_kabupaten = $_GET['no_kabupaten'];
else if ($_POST['no_kabupaten']) $no_kabupaten = $_POST['no_kabupaten'];
else $no_kabupaten="";

if ($_GET['triwulan_search']) $triwulan_search = $_GET['triwulan_search'];
else if ($_POST['triwulan_search']) $triwulan_search = $_POST['triwulan_search'];
else $triwulan_search="";

if ($_GET['jns_jln']) $jns_jln = $_GET['jns_jln'];
else if ($_POST['jns_jln']) $jns_jln = $_POST['jns_jln'];
else $jns_jln="";

if ($_GET['txt_hidden_jns_jln']) $txt_hidden_jns_jln = $_GET['txt_hidden_jns_jln'];
else if ($_POST['txt_hidden_jns_jln']) $txt_hidden_jns_jln = $_POST['txt_hidden_jns_jln'];
else $txt_hidden_jns_jln="";

if ($_GET['status_error']) $status_error = $_GET['status_error'];
else if ($_POST['status_error']) $status_error = $_POST['status_error'];
else $status_error="";
/****
if($jns_jln!="" || strlen($jns_jln)!=0){
	$jns_jln = $jns_jln;
} else if ( $txt_hidden_jns_jln!="" && strlen($txt_hidden_jns_jln)!=0 ){
	$jns_jln = $txt_hidden_jns_jln;
}
***/

if ($_GET['Date_Year']) $tahun = $_GET['Date_Year'];
else if ($_POST['Date_Year']) $tahun = $_POST['Date_Year'];
else $tahun="";

/***
if ($_GET['Search_Year']) $Search_Year = $_GET['Search_Year'];
else if ($_POST['Search_Year']) $Search_Year = $_POST['Search_Year'];
else $Search_Year="";
***/

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Date_Year=".$tahun."&jns_jln=".$jns_jln."&triwulan_search=".$triwulan_search;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Date_Year=".$tahun."&jns_jln=".$jns_jln."&triwulan_search=".$triwulan_search;

$SES_THN		= $_SESSION['SESSION_TAHUN'];
$SES_JNS_JLN	= $_SESSION['SESSION_JNS_JLN'];
$SES_NO_PROP	= $_SESSION['SESSION_NO_PROPINSI'];
$SES_NO_KAB		= $_SESSION['SESSION_NO_KABUPATEN'];

//----------EDIT DATA FORM K-01-----------------------------------

$opt = $_GET[opt];
$id_form_jl_06_main = $_GET[id_fjl_06_main];
$id_form_jl_06_detail = $_GET[id_fjl_06_detail];
$ed = 0;

if ($opt=="1" AND $id_form_jl_06_main<>'' AND $id_form_jl_06_detail<>'') {

$sql = "SELECT * 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_06_main=b.id_fjl_06_main 
		WHERE 1=1 AND b.id_fjl_06_main='".$id_form_jl_06_main."' AND a.id_fjl_06_detail='".$id_form_jl_06_detail."' ";
		
$recordSet_Edit = $db->execute($sql);

$edit = 1;	

$tgl = explode("-",$recordSet_Edit->fields[tanggal],strlen($recordSet_Edit->fields[tanggal])); // YYYY-mm-dd
$tanggal = !empty($tgl[2])?$tgl[2]."-".$tgl[1]."-".$tgl[0]:"";
/***
$tgl2 = explode("-",$recordSet_Edit->fields[status_progres],strlen($recordSet_Edit->fields[status_progres])); // YYYY-mm-dd
$status_progres = !empty($tgl2[2])?$tgl2[2]."-".$tgl2[1]."-".$tgl2[0]:"";
***/
$smarty->assign ("OPT", $opt);					
$smarty->assign ("ID_JL_06_MAIN", $recordSet_Edit->fields[id_fjl_06_main]);
$smarty->assign ("ID_FORM_JL_06_DETAIL", $recordSet_Edit->fields[id_fjl_06_detail]);
$smarty->assign ("TANGGAL", $tanggal);
//$smarty->assign ("STATUS", $recordSet_Edit->fields[status_progres]);
$smarty->assign ("TRIWULAN", $recordSet_Edit->fields[triwulan]);
$smarty->assign ("DATA_STATUS_PROGRES", $recordSet_Edit->fields[status_progres]);
$smarty->assign ("NAMA_PAKET", $recordSet_Edit->fields[nama_paket]);
$smarty->assign ("TARGET_KM", $recordSet_Edit->fields[target_km]);
$smarty->assign ("TARGET_M", $recordSet_Edit->fields[target_m]);
$smarty->assign ("BIAYA", $recordSet_Edit->fields[biaya]);
$smarty->assign ("RENCANA_FISIK", $recordSet_Edit->fields[rencana_fisik]);
$smarty->assign ("RENCANA_KEUANGAN", $recordSet_Edit->fields[rencana_keuangan]);
$smarty->assign ("REALISASI_FISIK", $recordSet_Edit->fields[realisasi_fisik]);
$smarty->assign ("REALISASI_KEUANGAN", $recordSet_Edit->fields[realisasi_keuangan]);
$smarty->assign ("DEVIASI_FISIK", $recordSet_Edit->fields[deviasi_fisik]);
$smarty->assign ("DEVIASI_KEUANGAN", $recordSet_Edit->fields[deviasi_keuangan]);
$smarty->assign ("MASALAH", $recordSet_Edit->fields[masalah]);
$smarty->assign ("JUMLAH_TENAGA", $recordSet_Edit->fields[jumlah_tenaga]);
$smarty->assign ("KETERANGAN", $recordSet_Edit->fields[keterangan]);
//$smarty->assign ("PID_JENIS_JLN2", $recordSet_Edit->fields[id_jns_jln]);

/*** Tambahan 24-06-2010 ***/
$smarty->assign("ID_HIDDEN_JSN_JLN",$recordSet_Edit->fields[id_jns_jln]);
$jenis_jalan	= $recordSet_Edit->fields[id_jns_jln]==1? "Provinsi":"Kabupaten/ Kota";
$smarty->assign ("PID_JENIS_JLN2", $jenis_jalan);
/*** End 0f 24-06-2010 ***/

}

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
					$sql_kab_combo 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$no_propinsi' ORDER BY nama_kabupaten ASC ";
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
	$sql_kabupaten 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$no_propinsi' ORDER BY nama_kabupaten ASC ";
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
	$sql_kabupaten 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$MAIN_PROP'";
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
		
if($no_propinsi!='' AND $no_kabupaten!=''){	
	/**** Tambahan utk filter no_provinsi, no_kabupaten
	*****/
	$f_no_prov	= $_SESSION['SESSION_NO_PROPINSI']!='0'?" AND a.no_propinsi='".$_SESSION['SESSION_NO_PROPINSI']."'":"";
	$f_no_kabta	= $_SESSION['SESSION_NO_KABUPATEN']!='0'?" AND a.no_kabupaten='".$_SESSION['SESSION_NO_KABUPATEN']."' ":"";

	/*** 07-08-2010 ***/
	$f_id_jns_jln	= $_SESSION['SESSION_JNS_JLN']!='0'?" AND a.id_jns_jln='".$_SESSION['SESSION_JNS_JLN']."' ":"";
			
	$sql_data_paket_jalan = "SELECT * FROM tbl_form_jl_05_main a LEFT JOIN tbl_form_jl_05_detail b ON 					
	a.id_fjl_05_main=b.id_fjl_05_main LEFT JOIN tbl_mast_prop_jenis_penanganan c ON c.id_prop_jenis_penanganan=b.nama_jenis_penanganan WHERE (a.no_propinsi='".$no_propinsi."' $f_no_prov) AND (a.no_kabupaten='".$no_kabupaten."' $f_no_kabta) AND YEAR(a.tanggal)='".$tahun."' $f_id_jns_jln AND b.id_fjl_05_detail IS NOT NULL";
	
	$result_data_paket_jalan = $db->execute($sql_data_paket_jalan);
	$total_paket = $result_data_paket_jalan->numrows();
	
	$initSet = array();
	$data_paket_jalan = array();
	$z=0;
	
	while ($arr=$result_data_paket_jalan->FetchRow()) {
		array_push($data_paket_jalan, $arr);
		array_push($initSet, $z);
		$z++;
	}
	$smarty->assign ("TOTAL_PAKET_JALAN", $total_paket);
	$smarty->assign ("DATA_PAKET_JALAN", $data_paket_jalan);
} else {
	$smarty->assign ("TESTAJA","<br>(Informasi Provinsi & Kabupaten/Kota:".$tahun.",tdk dipilih)");
}
	
if($_GET[get_paket]==1) {
	$isi_paket	= $_GET[isi_paket];
	$get_paket	= $_GET[get_paket];

	$sql_jns_jln = "SELECT 
	a.id_jns_jln,
	b.id_fjl_05_detail,
	b.nama_ruas 
	FROM tbl_form_jl_05_main a 
	LEFT JOIN tbl_form_jl_05_detail b 
	ON 					
	a.id_fjl_05_main=b.id_fjl_05_main 
	WHERE b.nama_ruas='".$isi_paket."' 
	AND b.id_fjl_05_detail IS NOT NULL";
	
	$result_jns_jln = $db->execute($sql_jns_jln);
	
	$id_jns_jln		= $result_jns_jln->fields[id_jns_jln]==1? "1":"2";
	$jenis_jalan	= $id_jns_jln==1? "Provinsi":"Kabupaten/ Kota";
	
	$tmp_hidden_jsn_jln = "<input name=\"txt_hidden_jns_jln\" type=\"hidden\" size=\"35\" value=\"".$id_jns_jln."\" >";
	$nm_jns_jln = "<input name=\"txt_jns_jln\" type=\"text\" value=\"".$jenis_jalan."\" size=\"35\" maxlength=\"200\" readonly>";
	
	$delimeter   = "-";
	$option_choice = $nm_jns_jln."^/&".$tmp_hidden_jsn_jln."^/&".$delimeter;	
	echo $option_choice;	
}

if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{	
				//print "--- Debug --- ";
				/***
				Kondisi jika id<>0
				1 = Provinsi
				2 = Kabupaten/ Kota
				***/
				if ($_GET['Date_Year']) $tahun = $_GET['Date_Year'];
				else if ($_POST['Date_Year']) $tahun = $_POST['Date_Year'];
				else $tahun="";
				
				//print "triwulan_search:".$triwulan_search;
				
				$no_propinsi = $_POST["no_propinsi"]?$_POST["no_propinsi"]:$_GET["no_propinsi"];
				$no_kabupaten = $_POST["no_kabupaten"]?$_POST["no_kabupaten"]:$_GET["no_kabupaten"];
				$jns_jln = $_POST["jns_jln"]?$_POST["jns_jln"]:$_GET["jns_jln"];
				$triwulan_search = isset($_POST["triwulan_search"])?$_POST["triwulan_search"]:$_GET["triwulan_search"];
				
				$f_id_jns_jln	= $SES_JNS_JLN!='0'?" AND b.id_jns_jln='".$SES_JNS_JLN."' ":"";
				$f_no_propinsi	= $SES_NO_PROP!='0'?" AND b.no_propinsi='".$SES_NO_PROP."' ":"";
				$f_no_kabupaten	= $SES_NO_KAB!='0'?" AND b.no_kabupaten='".$SES_NO_KAB."' ":"";
				$tahun2			= ($tahun=="" || $tahun==0)?" AND YEAR(b.tanggal)='".$SES_THN."' ":" AND YEAR(b.tanggal)='".$tahun."' ";
								
				$sql_data_wilayah = "SELECT nama_propinsi,nama_kabupaten FROM ".$tbl_name_kabupaten." a join tbl_mast_wil_propinsi b on a.no_propinsi=b.no_propinsi WHERE a.no_propinsi='".$no_propinsi."' AND no_kabupaten='".$no_kabupaten."' ";
				$recordSet_wilayah = $db->execute($sql_data_wilayah);
				$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];
				$nama_kabupaten = $recordSet_wilayah->fields[nama_kabupaten];
				
				$sql = "SELECT b.id_fjl_06_main,a.id_fjl_06_detail,a.nama_paket,a.target_km,a.target_m,a.biaya 
				FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_06_main=b.id_fjl_06_main 
				WHERE 1=1 ";
				
				/***
				if($no_propinsi!='' AND $no_kabupaten!='' AND $tahun!='' AND $jns_jln!='' ){
					$sql .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' AND YEAR(b.tanggal)='".$tahun."' AND b.id_jns_jln='".$jns_jln."' ";
				}
				***/
				
				if($no_propinsi!='' AND $no_kabupaten!='' AND $jns_jln==''){
					$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) $tahun2 $f_id_jns_jln AND b.triwulan='".$triwulan_search."' ";
				} else if ($no_propinsi!='' AND $no_kabupaten!='' AND $jns_jln!=''){
					$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) AND (b.id_jns_jln='".$jns_jln."' $f_id_jns_jln) $tahun2 AND b.triwulan='".$triwulan_search."' ";
				} else {
					$sql .= "AND b.no_propinsi='".$SES_NO_PROP."' AND b.no_kabupaten='".$SES_NO_KAB."' $f_id_jns_jln AND b.triwulan='".$triwulan_search."' ";
				}
				
				$sql .= "ORDER BY ".$ORDER." ".$SORT." ";
				
				//print "--- Debug --- ".$sql;		
				
				if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);

				$numresults=$db->Execute($sql);
				$count = $numresults->RecordCount();

				$pages = $p->findPages($count,$LIMIT); 
				$sql  .= "LIMIT ".$start.", ".$LIMIT;
				$recordSet = $db->Execute($sql);
				$end = $recordSet->RecordCount();
				$initSet = array();
				$data_tb = array();
				$data_target_km = array();
				$data_target_m = array();
				$data_biaya = array();				
				$row_class = array();
				$z=0;

				while ($arr=$recordSet->FetchRow()) {
					$target_km = number_format($arr[target_km],2,',','.');;
					$target_m = number_format($arr[target_m],2,',','.');;
					$biaya = number_format($arr[biaya],2,',','.');;
									
					array_push($data_tb, $arr);
					array_push($data_target_km, $target_km);
					array_push($data_target_m, $target_m);
					array_push($data_biaya, $biaya);
										
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

$smarty->assign('TRIWULANARR', array(
			"1" => 'Triwulan I',
			"2" => 'Triwulan II',
			"3" => 'Triwulan III',
			"4" => 'Triwulan IV'));

$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_FORM_JL_06);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_FORM_JL_06);
$smarty->assign ("FORM_NAME", _FORM);

// TAMBAHAN
$smarty->assign ("FORM_NAME2", _FORM_NAME_IMPORT);

$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NO_KABUPATEN", $no_kabupaten);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten);
$smarty->assign ("TAHUN", $tahun);
$smarty->assign ("TRIWULAN_SEARCH", $triwulan_search);
//$smarty->assign ("TOTAL_PAKET_JALAN", $total_paket);
$smarty->assign ("TITLE", _TITLE_FORM_JL_06_MAIN);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_FORM_JL_06_MAIN);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("TB_NAMA_PAKET", _NAMA_PAKET);
$smarty->assign ("TB_TARGET", _TARGET2);
$smarty->assign ("TB_TARGET_KM", _TARGET_KM);
$smarty->assign ("TB_TARGET_M", _TARGET_M);
$smarty->assign ("TB_BIAYA", _BIAYA);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_FORM_JL_06_MAIN);
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
/*** Tambahan 24-06-2010 ***/
$smarty->assign ("TB_JENIS_JALAN", _NAMA_JENIS_JALAN);
// kolom pada form pencarian
$smarty->assign ("PID_JENIS_JLN", $jns_jln);
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
$smarty->assign ("DAFTAR_STATUS_PROGRES",$daftar_status_progres);
$smarty->assign ("DATA_TARGET_KM", $data_target_km);
$smarty->assign ("DATA_TARGET_M", $data_target_m);
$smarty->assign ("DATA_BIAYA", $data_biaya);
$smarty->assign ("STATUS_ERROR", $status_error);

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