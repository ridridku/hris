<?php
/*** Last Modify 13-07-2010
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
} else {

// yang harus dibuat session
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_k_01';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_k_01';

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

$tbl_name_main = "tbl_form_k_01_main";
$tbl_name_detail = "tbl_form_k_01_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
$tbl_name_kecamatan = "tbl_mast_wil_kecamatan";
$tbl_name_fungsi_ruas = "tbl_mast_ruas_fungsi";
//$tbl_name_status_adm = "tbl_mast_ruas_stat_administrasi";
$tbl_name_stat_jln	= "tbl_mast_sistem_fungsi_stat_jalan";
$tbl_name_tipe_permukaan_jalan = "tbl_mast_ruas_tipe_jalan";
//$tbl_name_tipe_perkerasan_jalan = "tbl_mast_prop_tipe_pkrsn";
$tbl_name_kondisi_jalan = "tbl_mast_ruas_kondisi_jalan";
$tbl_name_hambatan_lalin = "tbl_mast_ruas_hambatan_lalin";
$tbl_name_kelas_lalin = "tbl_mast_ruas_kls_lalin";
/*** Tambahan 05-06-2010 ***/
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
else $ORDER="a.id_form_k_01_detail";

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
/***
if ($_GET['jns_jln2']) $jns_jln = $_GET['jns_jln2'];
else if ($_POST['jns_jln2']) $jns_jln = $_POST['jns_jln2'];
else $jns_jln2="";

$fields_find_jns_jln_	= $jns_jln!=""?$jns_jln:$jns_jln2;
***/
if($_GET[Search_Year]){
	$Search_Year=$_GET[Search_Year];
} else {
	$Search_Year=$_SESSION['THN'];
}

//$Search_Year = $_GET[Search_Year]?$_GET[Search_Year]:$_SESSION['THN'];

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year."&jns_jln=".$jns_jln;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year."&jns_jln=".$jns_jln;

$SES_THN		= $_SESSION['SESSION_TAHUN'];
$SES_JNS_JLN	= $_SESSION['SESSION_JNS_JLN'];
$SES_NO_PROP	= $_SESSION['SESSION_NO_PROPINSI'];
$SES_NO_KAB		= $_SESSION['SESSION_NO_KABUPATEN'];

//----------EDIT DATA FORM K-01-----------------------------------

$opt = $_GET[opt];
$id_k_01_main = $_GET[id_k_01_main];
$id_form_k_01_detail = $_GET[id_k_01_detail];
/*** Tambahan 05-06-2010 ***/
$id_jns_jln = $jns_jln;
/*** End 0f Tambahan 05-06-2010 ***/

$ed = 0;

if ($opt=="1" AND $id_k_01_main<>'' AND $id_form_k_01_detail<>'') {

$sql = "SELECT * 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_form_k_01_main=b.id_k_01_main 
		WHERE 1=1 AND b.id_k_01_main='".$id_k_01_main."' AND b.id_jns_jln='".$id_jns_jln."' AND a.id_form_k_01_detail='".$id_form_k_01_detail."' ";

//$smarty->assign ("CHECK",$sql);

/***
$sql = "SELECT * 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_form_k_01_main=b.id_k_01_main 
		WHERE 1=1 AND b.id_k_01_main='".$id_k_01_main."' AND a.id_form_k_01_detail='".$id_form_k_01_detail."' ";
***/
				
$recordSet_Edit = $db->execute($sql);

$arr_kecamatan = explode(";",$recordSet_Edit->fields[kecamatan_yg_dilalui]);
$edit = 1;	
$tgl = explode("-",$recordSet_Edit->fields[tanggal],strlen($recordSet_Edit->fields[tanggal])); // YYYY-mm-dd
$format_tgl = $tgl[2]."-".$tgl[1]."-".$tgl[0];

$tgl_perencanaan_terakhir = explode("-", $recordSet_Edit->fields[bln_th_perenc_akhir], strlen($recordSet_Edit->fields[bln_th_perenc_akhir]));
$bln_perencanaan_terakhir = $tgl_perencanaan_terakhir[1];
$thn_perencanaan_terakhir = $tgl_perencanaan_terakhir[0];
$format_bln_perencanaan_terakhir = $daftar_bulan[$bln_perencanaan_terakhir];

$tgl_perubahaan_data = explode("-", $recordSet_Edit->fields[bln_thn_perubahan_data], strlen($recordSet_Edit->fields[bln_thn_perubahan_data]));
$bln_perubahaan_data = $tgl_perubahaan_data[1];
$thn_perubahaan_data = $tgl_perubahaan_data[0];
$format_bln_perubahaan_data = $daftar_bulan[$bln_perubahaan_data]; 

$smarty->assign ("OPT", $opt);
$smarty->assign ("ID_K_01_MAIN", $recordSet_Edit->fields[id_k_01_main]);
$smarty->assign ("ID_FORM_K_01_DETAIL", $recordSet_Edit->fields[id_form_k_01_detail]);
/***
Disabled 06-09-2010
$smarty->assign ("TANGGAL", $recordSet_Edit->fields[tanggal]);
***/
$smarty->assign ("TANGGAL", $format_tgl);
$smarty->assign ("DATA_BULAN",$bln_perencanaan_terakhir);
$smarty->assign ("DATA_TAHUN",$thn_perencanaan_terakhir);
$smarty->assign ("DATA_BULAN_2",$bln_perubahaan_data);
$smarty->assign ("DATA_TAHUN_2",$thn_perubahaan_data);
$smarty->assign ("NO_RUAS", $recordSet_Edit->fields[no_ruas]);
$smarty->assign ("NAMA_PANGKAL_RUAS", $recordSet_Edit->fields[nama_pangkal_ruas]);
$smarty->assign ("NAMA_UJUNG_RUAS", $recordSet_Edit->fields[nama_ujung_ruas]);
$smarty->assign ("TITIK_PENGENAL_PANGKAL", $recordSet_Edit->fields[titik_pengenal_pangkal]);
$smarty->assign ("TITIK_PENGENAL_UJUNG", $recordSet_Edit->fields[titik_pengenal_ujung]);

/*** Tambahan 04-08-2010 ***/
/*** Disabled on 06-09-2010
$smarty->assign ("TITIK_AWAL_JALAN", $recordSet_Edit->fields[titik_awal_jalan]);
$smarty->assign ("TITIK_AKHIR_JALAN", $recordSet_Edit->fields[titik_akhir_jalan]);
$smarty->assign ("TITIK_AWAL_KEGIATAN", $recordSet_Edit->fields[titik_awal_kegiatan]);
$smarty->assign ("TITIK_AKHIR_KEGIATAN", $recordSet_Edit->fields[titik_akhir_kegiatan]);
End 0f Disabled ***/

/*** remark 16-08-2010
$smarty->assign ("TITIK_KOORDINAT", $recordSet_Edit->fields[titik_koordinat]);
***/

// 16-08-2010
$smarty->assign ("TITIK_AWAL_KOORDINAT_LINTANG", $recordSet_Edit->fields[t_awal_rs_jln_lintang]);
$smarty->assign ("TITIK_AWAL_KOORDINAT_BUJUR", $recordSet_Edit->fields[t_awal_rs_jln_bujur]);
$smarty->assign ("TITIK_AKHIR_KOORDINAT_LINTANG", $recordSet_Edit->fields[t_akhir_rs_jln_lintang]);
$smarty->assign ("TITIK_AKHIR_KOORDINAT_BUJUR", $recordSet_Edit->fields[t_akhir_rs_jln_bujur]);
$smarty->assign ("TITIK_AWAL_KEGIATAN_KOORDINAT_LINTANG", $recordSet_Edit->fields[t_awal_kegiatan_lintang]);
$smarty->assign ("TITIK_AWAL_KEGIATAN_KOORDINAT_BUJUR", $recordSet_Edit->fields[t_awal_kegiatan_bujur]);
$smarty->assign ("TITIK_AKHIR_KEGIATAN_KOORDINAT_LINTANG", $recordSet_Edit->fields[t_akhir_kegiatan_lintang]);
$smarty->assign ("TITIK_AKHIR_KEGIATAN_KOORDINAT_BUJUR", $recordSet_Edit->fields[t_akhir_kegiatan_bujur]);

$smarty->assign ("PANJANG_RUAS", $recordSet_Edit->fields[panjang_ruas]);
$smarty->assign ("KODE_KLASIFIKASI", $recordSet_Edit->fields[klasifikasi_ruas]);
//$smarty->assign ("KODE_STATUS_ADMINISTRASI", $recordSet_Edit->fields[kode_status_administrasi]);
$smarty->assign ("KODE_STATUS_ADM_JLN", $recordSet_Edit->fields[kode_status_administrasi]);
$smarty->assign ("KECAMATAN_YG_DILALUI", $arr_kecamatan);
$smarty->assign ("PAL_KM_AWAL", $recordSet_Edit->fields[pal_km_awal]);
$smarty->assign ("PAL_KM_AKHIR", $recordSet_Edit->fields[pal_km_akhir]);
$smarty->assign ("LEBAR", $recordSet_Edit->fields[lebar]);
$smarty->assign ("KODE_TIPE_PERMUKAAN", $recordSet_Edit->fields[tipe_permukaan]);
$smarty->assign ("KODE_KONDISI_JALAN", $recordSet_Edit->fields[kondisi_permukaan]);
$smarty->assign ("KODE_HAMBATAN_LALIN", $recordSet_Edit->fields[hambatan_lalin]);
/*** Disabled on 06-09-2010
$smarty->assign ("BLN_TH_PERENC_AKHIR", $recordSet_Edit->fields[bln_th_perenc_akhir]);
***/
$smarty->assign ("KODE_TIPE_PERMUKAAN2", $recordSet_Edit->fields[tipe_thn_pekerj_akhir]);
$smarty->assign ("KODE_KONDISI_JALAN2", $recordSet_Edit->fields[kondisi_thn_pekerj_akhir]);
$smarty->assign ("KODE_KELAS_LALIN", $recordSet_Edit->fields[kelas_renc_lalin]);
$smarty->assign ("LHR_RODA_4", $recordSet_Edit->fields[lhr_roda_4]);
$smarty->assign ("LHR_EKIVALEN_RODA_4", $recordSet_Edit->fields[lhr_ekivalen_roda_4]);
/*** remark 16-08-2010
$smarty->assign ("JUMLAH_PENDUDUK", $recordSet_Edit->fields[jumlah_penduduk]);
***/
/*** Disabled on 06-09-2010
$smarty->assign ("BLN_THN_PERUBAHAN_DATA", $recordSet_Edit->fields[bln_thn_perubahan_data]);
***/
/*** Disabled on 16-09-2010
$smarty->assign ("STATUS_LINGKUNGAN", $recordSet_Edit->fields[status_lingkungan]);
$smarty->assign ("RAWAN_LINGKUNGAN", $recordSet_Edit->fields[rawan_lingkungan]);
$smarty->assign ("STUDI_LINGKUNGAN", $recordSet_Edit->fields[studi_lingkungan]);
***/
/*** Tambahan 05-06-2010 ***/
$smarty->assign ("PID_JENIS_JLN", $recordSet_Edit->fields[id_jns_jln]);
/*** End 0f Tambahan ***/
$smarty->assign ("FORM_TAHUN", $recordSet_Edit->fields[tahun]);
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

//-----------FUNGSI RUAS JALAN---------------------------------

$sql_fungsi = "SELECT * FROM ".$tbl_name_fungsi_ruas." ORDER BY kode_klasifikasi ASC";
$recordSet_fungsi = $db->Execute($sql_fungsi);
$initSet = array();
$data_fungsi = array();
$z=0;
while ($arr=$recordSet_fungsi->FetchRow()) {
	array_push($data_fungsi, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_FUNGSI", $data_fungsi);


//-----STATUS ADMINISTRASI---------------------------------------
/*** Disabled on 15-07-2010
$sql_administrasi = "SELECT * FROM ".$tbl_name_status_adm." ORDER BY kode_status ASC";
$recordSet_administrasi = $db->Execute($sql_administrasi);
$initSet = array();
$data_administrasi = array();
$z=0;
while ($arr=$recordSet_administrasi->FetchRow()) {
	array_push($data_administrasi, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_ADMINISTRASI", $data_administrasi);
***/

//----- SISTEM, FUNGSI DAN STATUS JALAN
$sql_stat_jl = "SELECT * FROM ".$tbl_name_stat_jln." ORDER BY kode_status ASC";
$recordSet_stat_jl = $db->Execute($sql_stat_jl);
$initSet = array();
$data_stat_jl = array();
$z=0;
while ($arr=$recordSet_stat_jl->FetchRow()) {
	array_push($data_stat_jl, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_STAT_JL", $data_stat_jl);

//-----TIPE PERMUKAAN JALAN------------------------------------
$sql_tipe_permukaan = "SELECT * FROM ".$tbl_name_tipe_permukaan_jalan." ORDER BY id ASC";
$recordSet_tipe_permukaan = $db->Execute($sql_tipe_permukaan);
$initSet = array();
$data_tipe_permukaan = array();
$z=0;
while ($arr=$recordSet_tipe_permukaan->FetchRow()) {
	array_push($data_tipe_permukaan, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_TIPE_PERMUKAAN", $data_tipe_permukaan);

/***
$sql_tipe_permukaan = "SELECT * FROM ".$tbl_name_tipe_perkerasan_jalan." ORDER BY id_prop_tipe_pkrsn ASC";
$recordSet_tipe_permukaan = $db->Execute($sql_tipe_permukaan);
$initSet = array();
$data_tipe_permukaan = array();
$z=0;
while ($arr=$recordSet_tipe_permukaan->FetchRow()) {
	array_push($data_tipe_permukaan, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_TIPE_PERMUKAAN", $data_tipe_permukaan);
**/

//-----KONDISI JALAN ------------------------------------------

$sql_kondisi_jalan = "SELECT * FROM ".$tbl_name_kondisi_jalan." ORDER BY kode_kondisi_jalan ASC";
$recordSet_kondisi_jalan = $db->Execute($sql_kondisi_jalan);
$initSet = array();
$data_kondisi_jalan = array();
$z=0;
while ($arr=$recordSet_kondisi_jalan->FetchRow()) {
	array_push($data_kondisi_jalan, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_KONDISI_JALAN", $data_kondisi_jalan);


//-----HAMBATAN LALU LINTAS----------------------

$sql_hambatan_lalin = "SELECT * FROM ".$tbl_name_hambatan_lalin." ORDER BY kode_hambatan_lalin ASC";
$recordSet_hambatan_lalin = $db->Execute($sql_hambatan_lalin);
$initSet = array();
$data_hambatan_lalin = array();
$z=0;
while ($arr=$recordSet_hambatan_lalin->FetchRow()) {
	array_push($data_hambatan_lalin, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_HAMBATAN_LALIN", $data_hambatan_lalin);


//-----KELAS RENCANA LALU LINTAS

$sql_kelas_lalin = "SELECT * FROM ".$tbl_name_kelas_lalin." ORDER BY kode_kelas_lalin ASC";
$recordSet_kelas_lalin = $db->Execute($sql_kelas_lalin);
$initSet = array();
$data_kelas_lalin = array();
$z=0;
while ($arr=$recordSet_kelas_lalin->FetchRow()) {
	array_push($data_kelas_lalin, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_KELAS_LALIN", $data_kelas_lalin);


//----------Menampilkan Data Kabupaten---------------------------

if ($_GET[get_propinsi] == 1)
{
	$no_propinsi = $_GET[no_propinsi];
			if($no_propinsi!=''){	
					$sql_kab_combo 	  = " SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$no_propinsi' ORDER BY nama_kabupaten ";
					$result_kab_combo  = $db->Execute($sql_kab_combo);
					$input_kab="<select name=no_kabupaten  onChange=\"cari_kecamatan(".$no_propinsi.",this.value)\">";
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

//----------Menampilkan Data Kecamatan---------------------------

if ($_GET[get_kabupaten] == 1)
{

			if($no_propinsi!='' AND $no_kabupaten!=''){	
					$sql_kecamatan_combo 	  = "SELECT * FROM ".$tbl_name_kecamatan." where no_propinsi='$no_propinsi' AND no_kabupaten='$no_kabupaten'";
					
					$result_kecamatan_combo  = $db->Execute($sql_kecamatan_combo);
					$table_kecamatan="<table cellspacing=\"0\" cellpadding=\"0\" width=\"400\">\n";
					$z=0;
					while(!$result_kecamatan_combo ->EOF): 						
						$sisa = $z%2;				
						if ($sisa==0) {	$table_kecamatan.="<tr>"; } 
						$table_kecamatan.="<td width=\"15\"><input type=\"checkbox\" class=\"checkbox\" name=\"akecamatan".$z."\" value=\"".$result_kecamatan_combo  ->fields['nama_kecamatan']."\"/></td>
<td class=\"text-regular\">".$result_kecamatan_combo  ->fields['nama_kecamatan']."</td>";
						if ($sisa==1) { $table_kecamatan.="</tr>\n"; }
					$result_kecamatan_combo->MoveNext();
					$z++;
					endwhile; 					
					$table_kecamatan.="</table>\n";
					$table_kecamatan.="<input type=\"hidden\" name=\"jml_kecamatan\" value=\"".$z++."\">";				
					$delimeter   = "-";
					$option_choice = $table_kecamatan."^/&".$delimeter;	
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
	$sql_kecamatan 	  = "SELECT * FROM ".$tbl_name_kecamatan." where no_propinsi='$no_propinsi' AND no_kabupaten='$no_kabupaten'";
	$recordSet_kecamatan = $db->Execute($sql_kecamatan);
	$initSet = array();
	$data_kecamatan = array();
	$z=0;
	while ($arr=$recordSet_kecamatan->FetchRow()) {
		array_push($data_kecamatan, $arr);
		array_push($initSet, $z);
		$z++;
	}
	$smarty->assign ("DATA_KECAMATAN", $data_kecamatan);
	$smarty->assign ("JML_KECAMATAN", $z);
}
			
//if ($_GET['search'] == '1')
if ($_GET['search'] == '1')
{
	if( $_SESSION[rg_no_propinsi]!="" && 
	    $_SESSION[rg_no_kabupaten]!="" ){
	    $_SESSION[rg_no_propinsi] = "";
		$_SESSION[rg_no_kabupaten] = "";
		$_SESSION[rg_jns_jln] = "";
	} 
	if( $_SESSION[rg_no_propinsi]=="" && 
	    $_SESSION[rg_no_kabupaten]=="" ){
	    $_SESSION[rg_no_propinsi] = $no_propinsi;
		$_SESSION[rg_no_kabupaten] = $no_kabupaten;
		$_SESSION[rg_jns_jln] = $jns_jln;
	}
	
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
				// print $no_kabupaten;
				/*** 
				Kondisi jika id<>0
				1 = Provinsi
				2 = Kabupaten/ Kota
				***/
				$f_id_jns_jln	= $SES_JNS_JLN!='0'?" AND b.id_jns_jln='".$SES_JNS_JLN."' ":"";
				$f_no_propinsi	= $SES_NO_PROP!='0'?" AND b.no_propinsi='".$SES_NO_PROP."' ":"";
				$f_no_kabupaten	= $SES_NO_KAB!='0'?" AND b.no_kabupaten='".$SES_NO_KAB."' ":"";
				/*** Disabled 06-09-2010
				$tahun			= ($Search_Year=="" || $Search_Year==0)?" AND YEAR(b.tanggal)='".$SES_THN."' ":" AND YEAR(b.tanggal)='".$Search_Year."' ";
				***/
				$tahun			= ($Search_Year=="" || $Search_Year==0)?" AND b.tahun='".$SES_THN."' ":" AND b.tahun='".$Search_Year."' ";

				$sql_data_wilayah = "SELECT get_nama_propinsi(no_propinsi) as nama_propinsi,get_nama_kabupaten(no_propinsi,no_kabupaten) as nama_kabupaten FROM ".$tbl_name_kabupaten." WHERE no_propinsi='".$no_propinsi."' AND no_kabupaten='".$no_kabupaten."' ";
				$recordSet_wilayah = $db->execute($sql_data_wilayah);
				$nama_propinsi2 = $recordSet_wilayah->fields[nama_propinsi];
				$nama_kabupaten2 = $recordSet_wilayah->fields[nama_kabupaten];
				
				//print $nama_propinsi2." ".$nama_kabupaten2;
				$sql = "SELECT b.id_k_01_main,a.id_form_k_01_detail,a.no_ruas,a.nama_pangkal_ruas,a.nama_ujung_ruas,a.titik_pengenal_pangkal,a.titik_pengenal_ujung 
				FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_form_k_01_main=b.id_k_01_main 
				WHERE 1=1 ";
								
				/**** Disabled 17-07-2010
				if($no_propinsi!='' AND $no_kabupaten!='' AND $jns_jln==''){
					$sql .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' AND YEAR(b.tanggal)='".$Search_Year."' ";
				} else if ($no_propinsi!='' AND $no_kabupaten!='' AND $jns_jln!=''){
					$sql .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' AND id_jns_jln='".$jns_jln."' AND YEAR(b.tanggal)='".$Search_Year."' ";
				}
				***/
				
				if($no_propinsi!='' AND $no_kabupaten!='' AND $jns_jln==''){
					$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) $tahun $f_id_jns_jln ";
				} else if ($no_propinsi!='' AND $no_kabupaten!='' AND $jns_jln!=''){
					$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) AND (b.id_jns_jln='".$jns_jln."' $f_id_jns_jln) $tahun ";
				} else {
					$sql .= "AND b.no_propinsi='".$SES_NO_PROP."' AND b.no_kabupaten='".$SES_NO_KAB."' $f_id_jns_jln ";
				}
												
				$sql .= "ORDER BY ".$ORDER." ".$SORT." ";
					
				//print $sql;
						
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

} /*
else
{
				$sql  = "SELECT id_k_01_main,get_nama_propinsi(no_propinsi) as nama_propinsi,get_nama_kabupaten(no_propinsi,no_kabupaten) as nama_kabupaten FROM ".$tbl_name." WHERE 1=1 ";

				if($CODE!=''){
					$sql .= "AND get_nama_propinsi(no_propinsi) LIKE '%".$CODE."%' ";
				}

				if($NAME!=''){
					$sql .= "AND get_nama_kabupaten(no_propinsi,no_kabupaten) LIKE '%".$NAME."%' ";
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
*/

($_POST["opt"])?$_POST["opt"]:$_GET["opt"];

if($_GET["opt"]==3):
$smarty->assign("OPT",$_GET["opt"]);
endif;
	
($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;

$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_FORM_K_01);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_FORM_K_01);
$smarty->assign ("FORM_NAME", _FORM);

// TAMBAHAN
$smarty->assign ("FORM_NAME2", _FORM_NAME_IMPORT);

$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NO_KABUPATEN", $no_kabupaten);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi2);
$smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten2);
$smarty->assign ("SEARCH_YEAR", $Search_Year);
$smarty->assign ("TITLE", _TITLE_FORM_K_01_MAIN);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_FORM_K_01_MAIN);
$smarty->assign ("TB_NO", _NO_RUAS);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);
$smarty->assign ("TB_NAMA_PANGKAL_RUAS", _NAMA_PANGKAL_RUAS);
$smarty->assign ("TB_NAMA_UJUNG_RUAS", _NAMA_UJUNG_RUAS);
$smarty->assign ("TB_TITIK_PENGENAL_PANGKAL", _TITIK_PENGENAL_PANGKAL);
$smarty->assign ("TB_TITIK_PENGENAL_UJUNG", _TITIK_PENGENAL_UJUNG);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_FORM_K_01_MAIN);
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
/*** Tambahan 05-06-2010 ***/
$smarty->assign ("TB_JENIS_JALAN", _NAMA_JENIS_JALAN);
// kolom pada form pencarian
$smarty->assign ("PID_JENIS_JLN2", $jns_jln);
/*** End 0f 05-06-2010 ***/
$smarty->assign("_THN_",$_SESSION["THN_ANG"]);
$smarty->assign("DAFTAR_BULAN",$daftar_bulan);
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