<?php
require_once('../../../../includes/config.conf.php');	 	
require_once('../../../../includes/funct.php');

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

# including Header file for Content Expiring
require_once($DIR_INC.'/header.exp.inc');
# including Header file for Database Configuration
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.locker.php');

$db = &ADONewConnection($DB_TYPE);
//$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
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

#Initiate TABLE
$tbl_name_main	= "tbl_form_k_01_main";
$tbl_name_detail	= "tbl_form_k_01_detail";
$tbl_name_kondisi_main	= "tbl_form_kondisi_k_01_detail";

$tmp_tbl_name_main	= "tmp_tbl_form_k_01_main";
$tmp_tbl_name_detail	= "tmp_tbl_form_k_01_detail";
$tmp_tbl_name_kondisi_main	= "tmp_tbl_form_kondisi_k_01_detail";
		
if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];

/*** Arrays Defined ***/

/*** End 0f Arrays Defined ***/

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $mod_id;
global $db;
global $_POST,$_GET;


//Tambahan, ngambil no_ruas 
//Update tuti 15 agst 2011
$sql_cek_data= " SELECT no_ruas,nama_pangkal_ruas,nama_ujung_ruas FROM tbl_form_k_01_detail where id_form_k_01_main='$id'";
$get_recordSet_cek	= $db->Execute($sql_cek_data);
$arr_cek=$get_recordSet_cek->FetchRow();
$no_ruas_induk=$arr_cek[no_ruas];
$nama_ruas_induk=$arr_cek[no_ruas];

$nama_pangkal=$arr_cek[nama_pangkal_ruas];
$nama_ujung=$arr_cek[nama_ujung_ruas];
$nama_ruas_induk=$nama_pangkal." - ".$nama_ujung;

//cek dulu data mana JL05
$sql_jl05= " SELECT id_fjl_05_main FROM tbl_form_jl_05_detail where nama_ruas='".$nama_ruas_induk."'";
$recordSet	= $db->Execute($sql_jl05);
while ($arr_jl05=$recordSet->FetchRow()) {
		 $sql_edit_jl05 = " DELETE FROM tbl_form_jl_05_detail WHERE id_fjl_05_main='".$arr_jl05["id_fjl_05_main"]."' " ;
		 $sqlresult_jl05 = $db->Execute($sql_edit_jl05 );
		 $sql_edit_jl05_main = " DELETE FROM tbl_form_jl_05_detail WHERE id_fjl_05_main='".$arr_jl05["id_fjl_05_main"]."' " ;
		 $sqlresult_jl05_main = $db->Execute($sql_edit_jl05_main );
}

//cek dulu data mana JL06
$sql_jl06= " SELECT id_fjl_06_main FROM tbl_form_jl_06_detail where nama_paket='".$nama_ruas_induk."'";
$recordSet	= $db->Execute($sql_jl06);
while ($arr_jl06=$recordSet->FetchRow()) {
		 $sql_edit_jl06 = " DELETE FROM tbl_form_jl_06_detail WHERE id_fjl_06_main='".$arr_jl06["id_fjl_06_main"]."' " ;
		 $sqlresult_jl06 = $db->Execute($sql_edit_jl06 );
		 $sql_edit_jl06_main = " DELETE FROM tbl_form_jl_06_detail WHERE id_fjl_06_main='".$arr_jl06["id_fjl_06_main"]."' " ;
		 $sqlresult_jl06_main = $db->Execute($sql_edit_jl06_main );
}

//cek dulu data mana JL07
$sql_jl07= " SELECT id_fjl_07_main FROM tbl_form_jl_07_detail where no_paket='".$no_ruas_induk."'";
$recordSet	= $db->Execute($sql_jl07);
while ($arr_jl07=$recordSet->FetchRow()) {
		 $sql_edit_jl07 = " DELETE FROM tbl_form_jl_07_detail WHERE id_fjl_07_main='".$arr_jl07["id_fjl_07_main"]."' " ;
		 $sqlresult_jl07 = $db->Execute($sql_edit_jl07 );
		 $sql_edit_jl07_main = " DELETE FROM tbl_form_jl_07_detail WHERE id_fjl_07_main='".$arr_jl07["id_fjl_07_main"]."' " ;
		 $sqlresult_jl07_main = $db->Execute($sql_edit_jl07_main );
}


//End Update tuti 15 agst 2011

//cek dulu data mana S01A
$sql_s01A= " SELECT id_fs_01A_main FROM tbl_form_s_01a_main where no_ruas='".$no_ruas_induk."'";
$recordSet	= $db->Execute($sql_s01A);
while ($arr_s01A=$recordSet->FetchRow()) {
		 $sql_edit_s01A = " DELETE FROM tbl_form_s_01a_detail WHERE id_fs_01A_main='".$arr_s01A["id_fs_01A_main"]."' " ;
		 $sqlresult_s01A = $db->Execute($sql_edit_s01A );
		 $sql_edit_s01A_main = " DELETE FROM tbl_form_s_01a_main WHERE id_fs_01A_main='".$arr_s01A["id_fs_01A_main"]."' " ;
		 $sqlresult_s01A_main = $db->Execute($sql_edit_s01A_main );
}

//cek dulu data mana S01
$sql_s01= " SELECT id_fs_01_main FROM tbl_form_s_01_main where no_ruas='".$no_ruas_induk."'";
$recordSet	= $db->Execute($sql_s01);
while ($arr_s01=$recordSet->FetchRow()) {
		 $sql_edit_s01 = " DELETE FROM tbl_form_s_01_detail WHERE id_fs_01_main='".$arr_s01["id_fs_01_main"]."' " ;
		 $sqlresult_s01 = $db->Execute($sql_edit_s01 );
		 $sql_edit_s01_main = " DELETE FROM tbl_form_s_01_main WHERE id_fs_01_main='".$arr_s01["id_fs_01_main"]."' " ;
		 $sqlresult_s01_main = $db->Execute($sql_edit_s01_main );
}

//cek dulu data mana k02
$sql_k02= " SELECT id_usulan_main FROM tbl_form_k_02_detail where no_ruas='".$no_ruas_induk."'";
$recordSet	= $db->Execute($sql_k02);
while ($arr_k02=$recordSet->FetchRow()) {
		 $sql_edit_k02 = " DELETE FROM tbl_form_k_02_detail WHERE id_usulan_main='".$arr_k02["id_usulan_main"]."' " ;
		 $sqlresult_k02 = $db->Execute($sql_edit_k02 );
		 $sql_edit_k02_main = " DELETE FROM tbl_form_k_02_main WHERE id_usulan='".$arr_k02["id_usulan_main"]."' " ;
		 $sqlresult_k02_main = $db->Execute($sql_edit_k02_main );
}

//cek dulu data mana JL03
$sql_jl03= " SELECT id_fjl_03_main FROM tbl_form_jl_03_detail where no_ruas='".$no_ruas_induk."'";
$recordSet	= $db->Execute($sql_jl03);
while ($arr_jl03=$recordSet->FetchRow()) {
		 $sql_edit_jl03 = " DELETE FROM tbl_form_jl_03_detail WHERE id_fjl_03_main='".$arr_jl03["id_fjl_03_main"]."' " ;
		 $sqlresult_jl03 = $db->Execute($sql_edit_jl03 );
		 $sql_edit_jl03_main = " DELETE FROM tbl_form_jl_03_main WHERE id_fjl_03_main='".$arr_jl03["id_fjl_03_main"]."' " ;
		 $sqlresult_jl03_main = $db->Execute($sql_edit_jl03_main );
}

//cek dulu data mana JL02
$sql_jl02= " SELECT id_fjl_02_main FROM tbl_form_jl_02_detail where no_ruas='".$no_ruas_induk."'";
$recordSet	= $db->Execute($sql_jl02);
while ($arr_jl02=$recordSet->FetchRow()) {
		$sql_edit_jl02 = " DELETE FROM tbl_form_jl_02_detail WHERE id_fjl_02_main='".$arr_jl02["id_fjl_02_main"]."' " ;
		 $sqlresult_jl02 = $db->Execute($sql_edit_jl02 );
		 $sql_edit_jl02_main = " DELETE FROM tbl_form_jl_02_main WHERE id_fjl_02_main='".$arr_jl02["id_fjl_02_main"]."' " ;
		 $sqlresult_jl02_main = $db->Execute($sql_edit_jl02_main );
}
//cek dulu data mana JL01
$sql_jl01= " SELECT id_fjl_01_main FROM tbl_form_jl_01_detail where no_ruas='".$no_ruas_induk."'";
$recordSet	= $db->Execute($sql_jl01);
while ($arr_jl01=$recordSet->FetchRow()) {
		$sql_edit_jl01 = " DELETE FROM tbl_form_jl_01_detail WHERE id_fjl_01_main='".$arr_jl01["id_fjl_01_main"]."' " ;
		 $sqlresult_jl01 = $db->Execute($sql_edit_jl01 );
		 $sql_edit_jl01_main = " DELETE FROM tbl_form_jl_01_main WHERE id_fjl_01_main='".$arr_jl01["id_fjl_01_main"]."' " ;
		 $sqlresult_jl01_main = $db->Execute($sql_edit_jl01_main );
}

}


function edit_(){

global $mod_id;
global $db;
global $_POST,$_GET;
global $tbl_name_main;
global $tbl_name_detail;
global $tmp_tbl_name_main;
global $tmp_tbl_name_detail;	
global $tbl_name_kondisi_main;
global $tmp_tbl_name_kondisi_main;

$data_bulan = $_POST[data_bulan];
$data_tahun = $_POST[data_tahun];
$data_bulan_2 = $_POST[data_bulan_2];
$data_tahun_2 = $_POST[data_tahun_2];

$bln_thn_perencanaan_terakhir = $data_tahun."-".$data_bulan."-"."00"; // YYYY-mm-dd
$bln_thn_perubahaan_data = $data_tahun_2."-".$data_bulan_2."-"."00"; // YYYY-mm-dd

$tgl = explode("-",$_POST["tanggal"],strlen($_POST["tanggal"])); // dd-mm-YYYY
$format_tgl = $tgl[2]."-".$tgl[1]."-".$tgl[0]; // YYYY-mm-dd

/*** edit 24--06-2010 ***/

$sql = " UPDATE `".$tbl_name_kondisi_main."` SET `kondisi_permukaan`=" .covt(@$_POST["kondisi_permukaan"]) ."
		WHERE " ."`id_form_k_01_main`=" .sqlvalue(@$_POST["xid_k_01_main"], false) ."";
		
$sqlresult = $db->Execute($sql);

$sql = " UPDATE `".$tbl_name_main."` SET `tanggal`=" .sqlvalue($format_tgl, true) .",
		`tahun`=" .sqlvalue(@$_POST["tahun"], true) .",
		`no_propinsi`=" .sqlvalue(@$_POST["no_propinsi"], false) .", 
		`no_kabupaten`=" .sqlvalue(@$_POST["no_kabupaten"], false) .", 
		`id_jns_jln`=" .sqlvalue(@$_POST["jns_jln"], false) ."
		WHERE " ."`id_k_01_main`=" .sqlvalue(@$_POST["xid_k_01_main"], false) ."";
		
$sqlresult = $db->Execute($sql);

$kondisi	= ($_POST["kondisi_permukaan"]=='B' || $_POST["kondisi_permukaan"]=='S')?"mantap":"tdk mantap";

//Tambahan, ngambil no_ruas

//update tuti 15 Agst 2011  >>  TTD RED ##
$sql_cek_data= " SELECT no_ruas,nama_pangkal_ruas,nama_ujung_ruas FROM tbl_form_k_01_detail where id_form_k_01_detail='".$_POST["xid_form_k_01_detail"]."'";
$get_recordSet_cek	= $db->Execute($sql_cek_data);
$arr_cek=$get_recordSet_cek->FetchRow();
$no_ruas_induk=$arr_cek[no_ruas];
$nama_pangkal=$arr_cek[nama_pangkal_ruas];
$nama_ujung=$arr_cek[nama_ujung_ruas];
$nama_ruas_induk=$nama_pangkal." - ".$nama_ujung;
//end update tuti 15 Agst 2011 >> TTD RED ##

//OLD ##################################
// $sql_cek_data= " SELECT no_ruas FROM tbl_form_k_01_detail where id_form_k_01_detail='".$_POST["xid_form_k_01_detail"]."'";
//$get_recordSet_cek	= $db->Execute($sql_cek_data);
//$arr_cek=$get_recordSet_cek->FetchRow();
//$no_ruas_induk=$arr_cek[no_ruas];
//END OLD #############################


//ngupdate tabel JL01
//cek dulu data mana JL01
$sql_jl01= " SELECT id_fjl_01_detail FROM tbl_form_jl_01_detail where no_ruas='".$no_ruas_induk."'";
$recordSet	= $db->Execute($sql_jl01);
while ($arr_jl01=$recordSet->FetchRow()) {
$sql_edit_jl01 = " UPDATE tbl_form_jl_01_detail SET no_ruas='".$_POST["no_ruas"]."', 
		 nama_ruas='".$_POST["nama_pangkal_ruas"]." - ".$_POST["nama_ujung_ruas"]."',
		 titik_pengenal_pangkal='".$_POST["titik_pengenal_pangkal"]."', 
		 titik_pengenal_ujung='".$_POST["titik_pengenal_ujung"]."', 
		 kecamatan_yg_dilalui='".get_data_kecamatan($_POST["jml_kecamatan"])."', 
		 panjang='".$_POST["panjang_ruas"]."', 
		 lebar='".$_POST["lebar"]."' 	
		 WHERE id_fjl_01_detail='".$arr_jl01["id_fjl_01_detail"]."'";		
         $sqlresult_jl01 = $db->Execute($sql_edit_jl01 );
		 
//--end update
}

//ngupdate tabel JL02
//cek dulu data mana JL02
$m=1000;
$sql_jl02= " SELECT id_fjl_02_detail FROM tbl_form_jl_02_detail where no_ruas='".$no_ruas_induk."'";
$recordSet	= $db->Execute($sql_jl02);
while ($arr_jl02=$recordSet->FetchRow()) {
$sql_edit_jl02 = " UPDATE tbl_form_jl_02_detail SET no_ruas='".$_POST["no_ruas"]."', 
		 nama_ruas='".$_POST["nama_pangkal_ruas"]." - ".$_POST["nama_ujung_ruas"]."',
		 panjang_km='".$_POST["panjang_ruas"]."', 
		 panjang_m='".$_POST["panjang_ruas"]*$m."' 	
		 WHERE id_fjl_02_detail='".$arr_jl02["id_fjl_02_detail"]."'";		
         $sqlresult_jl02 = $db->Execute($sql_edit_jl02 );
		 
//--end update
}



//..........................

$sql = " UPDATE `".$tbl_name_detail."` SET `no_ruas`=" .sqlvalue(@$_POST["no_ruas"], true) .", 
		`nama_pangkal_ruas`=" .sqlvalue(@$_POST["nama_pangkal_ruas"], true) .", 
		`nama_ujung_ruas`=" .sqlvalue(@$_POST["nama_ujung_ruas"], true) .", 
		`titik_pengenal_pangkal`=" .sqlvalue(@$_POST["titik_pengenal_pangkal"], true) .",
		`titik_pengenal_ujung`=" .sqlvalue(@$_POST["titik_pengenal_ujung"], true) .", 
		`t_awal_rs_jln_lintang`=".sqlvalue(@$_POST["titik_awal_koordinat_lintang"], true).",
		`t_awal_rs_jln_bujur`=".sqlvalue(@$_POST["titik_awal_koordinat_bujur"], true).",
		`t_akhir_rs_jln_lintang`=".sqlvalue(@$_POST["titik_akhir_koordinat_lintang"], true).",
		`t_akhir_rs_jln_bujur`=".sqlvalue(@$_POST["titik_akhir_koordinat_bujur"], true).",
		`t_awal_kegiatan_lintang`=".sqlvalue(@$_POST["titik_awal_kegiatan_koordinat_lintang"], true).",
		`t_awal_kegiatan_bujur`=".sqlvalue(@$_POST["titik_awal_kegiatan_koordinat_bujur"], true).",
		`t_akhir_kegiatan_lintang`=".sqlvalue(@$_POST["titik_akhir_kegiatan_koordinat_lintang"], true).",
		`t_akhir_kegiatan_bujur`=".sqlvalue(@$_POST["titik_akhir_kegiatan_koordinat_bujur"], true).",		
		`panjang_ruas`=" .sqlvalue(@$_POST["panjang_ruas"], false) .", 
		`klasifikasi_ruas`=" .sqlvalue(@$_POST["klasifikasi_ruas"], true) .", 
		`kode_status_administrasi`=" .sqlvalue(@$_POST["kode_stat_jln"], true) .", 
		`kecamatan_yg_dilalui`='" .get_data_kecamatan($_POST["jml_kecamatan"])."', 
		`pal_km_awal`=" .htmlentities(sqlvalue(@$_POST["pal_km_awal"], true)).", 
		`pal_km_akhir`=" .htmlentities(sqlvalue(@$_POST["pal_km_akhir"], true)).", 
		`lebar`=" .sqlvalue(@$_POST["lebar"], false) .", 
		`tipe_permukaan`=" .sqlvalue(@$_POST["tipe_permukaan"], true) .", 
		`kondisi_permukaan`=" .sqlvalue(@$_POST["kondisi_permukaan"], true) .", 
		`kondisi`='".$kondisi."',
		`hambatan_lalin`=" .sqlvalue(@$_POST["hambatan_lalin"], true) .", 
		`bln_th_perenc_akhir`=" .sqlvalue($bln_thn_perencanaan_terakhir, true) .", 
		`tipe_thn_pekerj_akhir`=" .sqlvalue(@$_POST["tipe_thn_pekerj_akhir"], true) .", 
		`kondisi_thn_pekerj_akhir`=" .sqlvalue(@$_POST["kondisi_thn_pekerj_akhir"], true) .", 
		`kelas_renc_lalin`=" .sqlvalue(@$_POST["kelas_renc_lalin"], true) .", 
		`lhr_roda_4`=" .sqlvalue(@$_POST["lhr_roda_4"], false) .", 
		`lhr_ekivalen_roda_4`=" .sqlvalue(@$_POST["lhr_ekivalen_roda_4"], false) .", 
		`bln_thn_perubahan_data`=" .sqlvalue($bln_thn_perubahaan_data, true) ."
		WHERE " ."(`id_form_k_01_main`=" .sqlvalue(@$_POST["xid_k_01_main"], false) .") AND 
		(`id_form_k_01_detail`=" .sqlvalue(@$_POST["xid_form_k_01_detail"], false) .")";
		
$sqlresult = $db->Execute($sql);

}

function create_(){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;	
global $tmp_tbl_name_main;
global $tmp_tbl_name_detail;	
global $tbl_name_kondisi_main;
global $tmp_tbl_name_kondisi_main;

$data_bulan = $_POST[data_bulan];
$data_tahun = $_POST[data_tahun];
$data_bulan_2 = $_POST[data_bulan_2];
$data_tahun_2 = $_POST[data_tahun_2];

$bln_thn_perencanaan_terakhir = $data_tahun."-".$data_bulan."-"."00"; // YYYY-mm-dd
$bln_thn_perubahaan_data = $data_tahun_2."-".$data_bulan_2."-"."00"; // YYYY-mm-dd

$tgl = explode("-",$_POST["tanggal"],strlen($_POST["tanggal"])); // dd-mm-YYYY
$format_tgl = $tgl[2]."-".$tgl[1]."-".$tgl[0]; // YYYY-mm-dd

$sql = " INSERT INTO `".$tbl_name_main."` (`tanggal`, `tahun`, `no_propinsi`, `no_kabupaten`, `id_jns_jln`) 
		VALUES (" .sqlvalue($format_tgl, true) .", " .sqlvalue(@$_POST["tahun"], true) .", 
		" .sqlvalue(@$_POST["no_propinsi"], false) .", " .sqlvalue(@$_POST["no_kabupaten"], false) .", " .sqlvalue(@$_POST["jns_jln"], false) .")";

$sqlresult = $db->Execute($sql);
//print $sql."<br>";

/*** 
sqlvalue(@$_POST["kode_status_administrasi"], true)
***/
/***
`titik_awal_jalan`,`titik_akhir_jalan`,

`titik_awal_kegiatan`,`titik_akhir_kegiatan`,

		" .sqlvalue(@$_POST["titik_awal_jalan"], true).", 
		" .sqlvalue(@$_POST["titik_akhir_jalan"], true).", 

		" .sqlvalue(@$_POST["titik_awal_kegiatan"], true).", 
		" .sqlvalue(@$_POST["titik_akhir_kegiatan"], true).", 
***/
/*** Disabled on 16-09-2010
`status_lingkungan`, `rawan_lingkungan`, `studi_lingkungan`


***/
$kondisi	= ($_POST["kondisi_permukaan"]=='B' || $_POST["kondisi_permukaan"]=='S')?"mantap":"tdk mantap";

$sql = " INSERT INTO `".$tbl_name_detail."` (`id_form_k_01_main`, `no_ruas`, `nama_pangkal_ruas`, 
		`nama_ujung_ruas`, `titik_pengenal_pangkal`, `titik_pengenal_ujung`, 
		`t_awal_rs_jln_lintang`,`t_awal_rs_jln_bujur`,`t_akhir_rs_jln_lintang`,`t_akhir_rs_jln_bujur`,
		`t_awal_kegiatan_lintang`,`t_awal_kegiatan_bujur`,`t_akhir_kegiatan_lintang`,`t_akhir_kegiatan_bujur`,
		`panjang_ruas`, `klasifikasi_ruas`, 
		`kode_status_administrasi`, `kecamatan_yg_dilalui`, `pal_km_awal`, `pal_km_akhir`, `lebar`, `tipe_permukaan`, 
		`kondisi_permukaan`, `kondisi`, `hambatan_lalin`, `bln_th_perenc_akhir`, `tipe_thn_pekerj_akhir`, `kondisi_thn_pekerj_akhir`, 
		`kelas_renc_lalin`, `lhr_roda_4`, `lhr_ekivalen_roda_4`, `bln_thn_perubahan_data`) VALUES ( 
		(SELECT MAX(id_k_01_main) FROM ".$tbl_name_main."), " .sqlvalue(@$_POST["no_ruas"], true) .", 
		" .sqlvalue(@$_POST["nama_pangkal_ruas"], true) .", " .sqlvalue(@$_POST["nama_ujung_ruas"], true) .", 
		" .sqlvalue(@$_POST["titik_pengenal_pangkal"], true) .", " .sqlvalue(@$_POST["titik_pengenal_ujung"], true) .", 

		" .sqlvalue(@$_POST["titik_awal_koordinat_lintang"], true).", 
		" .sqlvalue(@$_POST["titik_awal_koordinat_bujur"], true).", 
		" .sqlvalue(@$_POST["titik_akhir_koordinat_lintang"], true).", 
		" .sqlvalue(@$_POST["titik_akhir_koordinat_bujur"], true).", 

		" .sqlvalue(@$_POST["titik_awal_kegiatan_koordinat_lintang"], true).", 
		" .sqlvalue(@$_POST["titik_awal_kegiatan_koordinat_bujur"], true).", 
		" .sqlvalue(@$_POST["titik_akhir_kegiatan_koordinat_lintang"], true).", 
		" .sqlvalue(@$_POST["titik_akhir_kegiatan_koordinat_bujur"], true).", 		
		" .sqlvalue(@$_POST["panjang_ruas"], false) .", " .sqlvalue(@$_POST["klasifikasi_ruas"], true) .", 
		" .sqlvalue(@$_POST["kode_stat_jln"], true) .", '" .get_data_kecamatan($_POST["jml_kecamatan"])."', 
		" .htmlentities(sqlvalue(@$_POST["pal_km_awal"], true)).", " .htmlentities(sqlvalue(@$_POST["pal_km_akhir"], true)).", 
		" .sqlvalue(@$_POST["lebar"], false) .", " .sqlvalue(@$_POST["tipe_permukaan"], true) .", 
		" .sqlvalue(@$_POST["kondisi_permukaan"], true) .", '".$kondisi."', " .sqlvalue(@$_POST["hambatan_lalin"], true) .", 
		" .sqlvalue($bln_thn_perencanaan_terakhir, true) .", " .sqlvalue(@$_POST["tipe_thn_pekerj_akhir"], true) .", 
		" .sqlvalue(@$_POST["kondisi_thn_pekerj_akhir"], true) .", " .sqlvalue(@$_POST["kelas_renc_lalin"], true) .", 
		" .sqlvalue(@$_POST["lhr_roda_4"], false) .", " .sqlvalue(@$_POST["lhr_ekivalen_roda_4"], false) .", 
		" .sqlvalue($bln_thn_perubahaan_data, true) .")";

$sqlresult = $db->Execute($sql);  
//print $sql."<br>";

$sql = " INSERT INTO `".$tbl_name_kondisi_main."` (`id_form_k_01_main`, `no_ruas`, `kondisi_permukaan`) 
		VALUES ((SELECT MAX(id_k_01_main) FROM ".$tbl_name_main."), " .sqlvalue(@$_POST["no_ruas"], true) .", 
		" .covt(@$_POST["kondisi_permukaan"]) .")";

$sqlresult = $db->Execute($sql);
//print $sql."<br>";

/*** Tambahan 
***/
$tmp_sql = " INSERT INTO `".$tmp_tbl_name_main."` (`id_k_01_main`, `tanggal`, `tahun`, `no_propinsi`, `no_kabupaten`, `id_jns_jln`) 
		VALUES ((SELECT MAX(id_k_01_main) FROM ".$tbl_name_main."), " .sqlvalue($format_tgl, true) .", " .sqlvalue(@$_POST["tahun"], true) .", 
		" .sqlvalue(@$_POST["no_propinsi"], false) .", " .sqlvalue(@$_POST["no_kabupaten"], false) .", " .sqlvalue(@$_POST["jns_jln"], false) .")";

$tmp_sqlresult = $db->Execute($tmp_sql);
//print $tmp_sql."<br>";

/*** 
sqlvalue(@$_POST["kode_status_administrasi"], true)
***/
/***
`titik_awal_jalan`,`titik_akhir_jalan`,

`titik_awal_kegiatan`,`titik_akhir_kegiatan`,

		" .sqlvalue(@$_POST["titik_awal_jalan"], true).", 
		" .sqlvalue(@$_POST["titik_akhir_jalan"], true).", 

		" .sqlvalue(@$_POST["titik_awal_kegiatan"], true).", 
		" .sqlvalue(@$_POST["titik_akhir_kegiatan"], true).", 
***/
/*** Disabled on 16-09-2010
`status_lingkungan`, `rawan_lingkungan`, `studi_lingkungan`

		" .sqlvalue(@$_POST["status_lingkungan"], true) .", " .sqlvalue(@$_POST["rawan_lingkungan"], true) .", 
		" .sqlvalue(@$_POST["studi_lingkungan"], true)
***/
$kondisi	= ($_POST["kondisi_permukaan"]=='B' || $_POST["kondisi_permukaan"]=='S')?"mantap":"tdk mantap";
$tmp_sql = " INSERT INTO `".$tmp_tbl_name_detail."` (`id_form_k_01_detail`,`id_form_k_01_main`, `no_ruas`, `nama_pangkal_ruas`, 
		`nama_ujung_ruas`, `titik_pengenal_pangkal`, `titik_pengenal_ujung`, 
		`t_awal_rs_jln_lintang`, `t_awal_rs_jln_bujur`, `t_akhir_rs_jln_lintang`, `t_akhir_rs_jln_bujur`,
		`t_awal_kegiatan_lintang`, `t_awal_kegiatan_bujur`, `t_akhir_kegiatan_lintang`, `t_akhir_kegiatan_bujur`,
		`panjang_ruas`, `klasifikasi_ruas`, 
		`kode_status_administrasi`, `kecamatan_yg_dilalui`, `pal_km_awal`, `pal_km_akhir`, `lebar`, `tipe_permukaan`, 
		`kondisi_permukaan`, `kondisi`, `hambatan_lalin`, `bln_th_perenc_akhir`, `tipe_thn_pekerj_akhir`, `kondisi_thn_pekerj_akhir`, 
		`kelas_renc_lalin`, `lhr_roda_4`, `lhr_ekivalen_roda_4`, `bln_thn_perubahan_data`) VALUES ( 
		(SELECT MAX(id_form_k_01_detail) FROM ".$tbl_name_detail."), 
		(SELECT MAX(id_k_01_main) FROM ".$tbl_name_main."), 
		" .sqlvalue(@$_POST["no_ruas"], true) .", 
		" .sqlvalue(@$_POST["nama_pangkal_ruas"], true) .", " .sqlvalue(@$_POST["nama_ujung_ruas"], true) .", 
		" .sqlvalue(@$_POST["titik_pengenal_pangkal"], true) .", " .sqlvalue(@$_POST["titik_pengenal_ujung"], true) .", 

		" .sqlvalue(@$_POST["titik_awal_koordinat_lintang"], true).", 
		" .sqlvalue(@$_POST["titik_awal_koordinat_bujur"], true).", 
		" .sqlvalue(@$_POST["titik_akhir_koordinat_lintang"], true).", 
		" .sqlvalue(@$_POST["titik_akhir_koordinat_bujur"], true).", 

		" .sqlvalue(@$_POST["titik_awal_kegiatan_koordinat_lintang"], true).", 
		" .sqlvalue(@$_POST["titik_awal_kegiatan_koordinat_bujur"], true).", 
		" .sqlvalue(@$_POST["titik_akhir_kegiatan_koordinat_lintang"], true).", 
		" .sqlvalue(@$_POST["titik_akhir_kegiatan_koordinat_bujur"], true).", 		
		" .sqlvalue(@$_POST["panjang_ruas"], false) .", " .sqlvalue(@$_POST["klasifikasi_ruas"], true) .", 
		" .sqlvalue(@$_POST["kode_stat_jln"], true) .", '" .get_data_kecamatan($_POST["jml_kecamatan"])."', 
		" .htmlentities(sqlvalue(@$_POST["pal_km_awal"], true)).", " .htmlentities(sqlvalue(@$_POST["pal_km_akhir"], true)).", 
		" .sqlvalue(@$_POST["lebar"], false) .", " .sqlvalue(@$_POST["tipe_permukaan"], true) .", 
		" .sqlvalue(@$_POST["kondisi_permukaan"], true) .", '".$kondisi."', " .sqlvalue(@$_POST["hambatan_lalin"], true) .", 
		" .sqlvalue($bln_thn_perencanaan_terakhir, true) .", " .sqlvalue(@$_POST["tipe_thn_pekerj_akhir"], true) .", 
		" .sqlvalue(@$_POST["kondisi_thn_pekerj_akhir"], true) .", " .sqlvalue(@$_POST["kelas_renc_lalin"], true) .", 
		" .sqlvalue(@$_POST["lhr_roda_4"], false) .", " .sqlvalue(@$_POST["lhr_ekivalen_roda_4"], false) .", 
		" .sqlvalue($bln_thn_perubahaan_data, true) .")";

$tmp_sqlresult = $db->Execute($tmp_sql);  
//print $tmp_sql;

$tmp_sql2 = " INSERT INTO `".$tmp_tbl_name_kondisi_main."` (`id_form_k_01_main`, `no_ruas`, `kondisi_permukaan`) 
		VALUES ((SELECT MAX(id_k_01_main) FROM ".$tbl_name_main."), " .sqlvalue(@$_POST["no_ruas"], true) .", 
		" .covt(@$_POST["kondisi_permukaan"]) .")";

$tmp_sqlresult = $db->Execute($tmp_sql2);
//print $tmp_sql2;
/*** End 0f Tambahan ***/
}


/*** 
sqlvalue(@$_POST["kode_status_administrasi"], true)
***/


function import_() {
	global $mod_id;
	global $db;
	global $DB_TYPE;
	global $DB_NAME;
	global $_POST, $_GET;
	global $tbl_name_main;
	global $tbl_name_detail;	
	
	global $tmp_tbl_name_main;
	global $tmp_tbl_name_detail;
	global $tbl_name_kondisi_main;	
	global $tmp_tbl_name_kondisi_main;
	
	$tb_import = &ADONewConnection($DB_TYPE);
	//$tb_import->debug = true;
	$tb_import->Connect($_POST['hostname1'], $_POST['username1'], $_POST['password1'], $DB_NAME);
	//------------------------------------LOCAL CONFIG--------------------------------------//
 

	$conn=mysql_connect($_POST['hostname1'],$_POST['username1'],$_POST['password1']);

  //buat cek koneksinya

  if(!$conn)
    {
 Header("Location:index.php?status_error=1&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);
    }

    else { 

	$sql_ambil_data = " SELECT * FROM tmp_tbl_form_k_01_main "; //localhost
	$get_recordSet =   $db->Execute($sql_ambil_data);  
	@$count = $get_recordSet->RecordCount();
	
	if (@$count!='') {
				$z=1;
				
				while ($arr=$get_recordSet->FetchRow()) { //simpan di server
					
			 
					//simpan di tabel asli server
					$sql_insert = " INSERT INTO tbl_form_k_01_main (`tanggal`, `tahun`, `no_propinsi`, `no_kabupaten`, `id_jns_jln` ) 
					 VALUES (" .sqlvalue(@$arr["tanggal"], true) .", " .sqlvalue(@$arr["tahun"], true) .", 
					 " .sqlvalue(@$arr["no_propinsi"], false) .", " .sqlvalue(@$arr["no_kabupaten"], false) .", " .sqlvalue(@$arr["id_jns_jln"], false) ."  )";
					$sqlexec3 = $tb_import->Execute($sql_insert);

			 
				  
							//cari detail di local
							 $sql_detail	=  " SELECT * FROM tbl_form_k_01_detail WHERE id_form_k_01_main='$arr[id_k_01_main]' "; //ambil di localhost
							 $get_recordSet2	= $db->Execute($sql_detail);

					if($get_recordSet2->RecordCount()>0){
						while ($arr2=$get_recordSet2->FetchRow()) {

							
							//SIMPAN DI TABEL ASLI SERVER
							$sql_insert2 = " INSERT INTO tbl_form_k_01_detail (id_form_k_01_main, no_ruas, `nama_pangkal_ruas`, 
							`nama_ujung_ruas`, `titik_pengenal_pangkal`, `titik_pengenal_ujung`, 
							`titik_awal_jalan`, `titik_akhir_jalan`, `t_awal_rs_jln_lintang`, `t_awal_rs_jln_bujur`, `t_akhir_rs_jln_lintang`, `t_akhir_rs_jln_bujur`,
							`titik_awal_kegiatan`, `titik_akhir_kegiatan`, `t_awal_kegiatan_lintang`, `t_awal_kegiatan_bujur`, `t_akhir_kegiatan_lintang`, `t_akhir_kegiatan_bujur`,
							`panjang_ruas`, `klasifikasi_ruas`, 
							`kode_status_administrasi`, `kecamatan_yg_dilalui`, `pal_km_awal`, `pal_km_akhir`, `lebar`, `tipe_permukaan`, 
							`kondisi_permukaan`, `kondisi`, `hambatan_lalin`, `bln_th_perenc_akhir`, `tipe_thn_pekerj_akhir`, `kondisi_thn_pekerj_akhir`, 
							`kelas_renc_lalin`, `lhr_roda_4`, `lhr_ekivalen_roda_4`, `bln_thn_perubahan_data`) VALUES ( 
							(SELECT MAX(id_k_01_main) FROM  tbl_form_k_01_main ), 
							" .sqlvalue(@$arr2["no_ruas"], true) .", 
							" .sqlvalue(@$arr2["nama_pangkal_ruas"], true) .", " .sqlvalue(@$arr2["nama_ujung_ruas"], true) .", 
							" .sqlvalue(@$arr2["titik_pengenal_pangkal"], true) .", 
							" .sqlvalue(@$arr2["titik_pengenal_ujung"], true) .", 
							" .sqlvalue(@$arr2["titik_awal_jalan"], true).", 
							" .sqlvalue(@$arr2["titik_akhir_jalan"], true).", 
							" .sqlvalue(@$arr2["titik_awal_koordinat_lintang"], true).", 
							" .sqlvalue(@$arr2["titik_awal_koordinat_bujur"], true).", 
							" .sqlvalue(@$arr2["titik_akhir_koordinat_lintang"], true).", 
							" .sqlvalue(@$arr2["titik_akhir_koordinat_bujur"], true).", 				
							" .sqlvalue(@$arr2["titik_awal_kegiatan"], true).", 
							" .sqlvalue(@$arr2["titik_akhir_kegiatan"], true).", 
							" .sqlvalue(@$arr2["titik_awal_kegiatan_koordinat_lintang"], true).", 
							" .sqlvalue(@$arr2["titik_awal_kegiatan_koordinat_bujur"], true).", 
							" .sqlvalue(@$arr2["titik_akhir_kegiatan_koordinat_lintang"], true).", 
							" .sqlvalue(@$arr2["titik_akhir_kegiatan_koordinat_bujur"], true).", 						
							" .sqlvalue(@$arr2["panjang_ruas"], false) .", 
							" .sqlvalue(@$arr2["klasifikasi_ruas"], true) .", 
							" .sqlvalue(@$arr2["kode_stat_jln"], true) .", '" .get_data_kecamatan($arr2["jml_kecamatan"])."', 
							" .sqlvalue(@$arr2["pal_km_awal"], true) .", " .sqlvalue(@$arr2["pal_km_akhir"], true) .", 
							" .sqlvalue(@$arr2["lebar"], false) .", " .sqlvalue(@$arr2["tipe_permukaan"], true) .", 
							" .sqlvalue(@$arr2["kondisi_permukaan"], true) .", ".sqlvalue(@$arr2["kondisi"], true).", " .sqlvalue(@$arr2["hambatan_lalin"], true) .", 
							" .sqlvalue(@$arr2["bln_th_perenc_akhir"], true) .", " .sqlvalue(@$arr2["tipe_thn_pekerj_akhir"], true) .", 
							" .sqlvalue(@$arr2["kondisi_thn_pekerj_akhir"], true) .", " .sqlvalue(@$arr2["kelas_renc_lalin"], true) .", 
							" .sqlvalue(@$arr2["lhr_roda_4"], false) .", " .sqlvalue(@$arr2["lhr_ekivalen_roda_4"], false) .", 
							" .sqlvalue(@$arr2["bln_thn_perubahan_data"], true) .") ";
							
							////remark temp
							$sql_exec2 = $tb_import->Execute($sql_insert2);

							 
							 // SIMANPAN DI TABEL ASLI SERVER
							$sqlinsert3 = " INSERT INTO tbl_form_kondisi_k_01_detail (`id_form_k_01_main`, `no_ruas`, `kondisi_permukaan`) 
									VALUES ((SELECT MAX(id_k_01_main) FROM tbl_form_kondisi_k_01_detail), " .sqlvalue(@$arr2["no_ruas"], true) .", 
									" .covt(@$_POST["kondisi_permukaan"]) .")";
							 $sqlexec3 = $tb_import->Execute($sqlinsert3);
									
						}
					}

					//HAPUS TABEL TEMP LOCAL ARTINYA SUDAH DI EKSPORT
					 $sql_del = "DELETE FROM tmp_tbl_form_k_01_detail WHERE id_form_k_01_main='$arr[id_k_01_main]' ";
					 $sql_del2 = "DELETE FROM tmp_tbl_form_k_01_main WHERE id_k_01_main='$arr[id_k_01_main]' ";

					 $db->Execute($sql_del);
					 $db->Execute($sql_del2);


					 
					$z++;
				}//end while1
		Header("Location:index.php?status_error=3&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);

		}else {
		   Header("Location:index.php?status_error=2&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);	
		}//end if 2
	}
}

switch ($op){
	case 0:
		if (Privi($mod_id, $user_id, 'insert') != 'no') {
			create_();		
			Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);
		}
	break;
	case 1:
		if (Privi($mod_id, $user_id, 'edit') != 'no') {
			edit_();
	//		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);
		}
	break;
	
	case 2:
		if (Privi($mod_id, $user_id, 'delete') != 'no') {
			//lockTables($tbl_name_main);
			//lockTables($tmp_tbl_name_main);
			delete_($_GET['id_k_01_main']);
			//unlockTables($tbl_name_main);
			//unlockTables($tmp_tbl_name_main);		
			Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&no_kabupaten=".$_GET[no_kabupaten]."&Search_Year=".$_GET[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);
		}
	break;
	
	case 3:
			import_();
			
	break;
} // End 0f Switch

} // End 0f if
?>