<?php

# Including Main Configuration
# including file for Main Configurations
require_once ('../../../../includes/config.conf.php');	 	
require_once ('../../../../includes/funct.php');

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/propinsi/rdp_1_jp';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/propinsi/rdp_1_jp';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
} else {
		$mod_id = $_GET['mod_id'];
}

$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name_main = "tbl_form_rd_01_jp_main";
$tbl_name_detail = "tbl_form_rd_01_jp_detail";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id) {
global $mod_id;
global $db;
global $_POST, $_GET, $_SERVER;
global $tbl_name_main;
global $tbl_name_detail;

$sql  ="DELETE ";
$sql .="FROM ".$tbl_name_main." ";
$sql .="WHERE id_form_rd_01_jp_main = '$id'";

$sqlresult = $db->Execute($sql);
}

function edit_(){
global $mod_id;
global $db;
global $_POST, $_GET, $_SERVER;
global $tbl_name_main;
global $tbl_name_detail;

$sql = "update `".$tbl_name_main."` set `tanggal`=" .sqlvalue(@$_POST["tanggal"], true) .", 
		`no_propinsi`=" .sqlvalue(@$_POST["no_propinsi"], false) ." 
		where " ."(`id_form_rd_01_jp_main`=" .sqlvalue(@$_POST["xid_form_rd_01_jp_main"], false) .")";
		
$sqlresult = $db->Execute($sql);

$sql = "update `".$tbl_name_detail."` set `kode_proyek`=" .sqlvalue(@$_POST["kode_proyek"], true) .", 
		`nama_proyek`=" .sqlvalue(@$_POST["nama_proyek"], true) .", 
		`no_ruas`=" .sqlvalue(@$_POST["no_ruas"], true) .", 
		`nama_ruas`=" .sqlvalue(@$_POST["nama_ruas"], true) .", 
		`panjang_jalan`=" .sqlvalue(@$_POST["panjang_jalan"], false) .", 
		`sasaran`=" .sqlvalue(@$_POST["sasaran"], false) .", 
		`kabupaten`='" .get_data_kabupaten($_POST["jml_kabupaten"])."', 
		`panjang_proyek`=" .sqlvalue(@$_POST["panjang_proyek"], false) .", 
		`status_awal_jalan`=" .sqlvalue(@$_POST["status_awal_jalan"], true) .", 
		`status_akhir_jalan`=" .sqlvalue(@$_POST["status_akhir_jalan"], true) .", 
		`jenis_penanganan`=" .sqlvalue(@$_POST["jenis_penanganan"], false) .", 
		`tipe_pkrsn`=" .sqlvalue(@$_POST["tipe_pkrsn"], false) .", 
		`lebar_pkrsn`=" .sqlvalue(@$_POST["lebar_pkrsn"], false) .", 
		`biaya_jalan`=" .sqlvalue(@$_POST["biaya_jalan"], false) .", 
		`jumlah_jembatan`=" .sqlvalue(@$_POST["jumlah_jembatan"], false) .", 
		`panjang_jembatan`=" .sqlvalue(@$_POST["panjang_jembatan"], false) .", 
		`biaya_jembatan`=" .sqlvalue(@$_POST["biaya_jembatan"], false) .", 
		`total_biaya`=" .sqlvalue(@$_POST["total_biaya"], false) .", 
		`pad1`=" .sqlvalue(@$_POST["pad1"], false) .", 
		`du_prop`=" .sqlvalue(@$_POST["du_prop"], false) .", 
		`pjp_prop`=" .sqlvalue(@$_POST["pjp_prop"], false) .", 
		`jenis_loan_phln`=" .sqlvalue(@$_POST["jenis_loan_phln"], false) .", 
		`jumlah_loan_phln`=" .sqlvalue(@$_POST["jumlah_loan_phln"], false) .", 
		`jenis_sumber_dana_lain`=" .sqlvalue(@$_POST["jenis_sumber_dana_lain"], false) .", 
		`jumlah_sumber_dana_lain`=" .sqlvalue(@$_POST["jumlah_sumber_dana_lain"], false) .", 
		`ur_01_jp_konsistensi`=" .sqlvalue(@$_POST["ur_01_jp_konsistensi"], true) .", 
		`biaya_per_km_konsistensi`=" .sqlvalue(@$_POST["biaya_per_km_konsistensi"], false) .", 
		`kelayakan_konsistensi`=" .sqlvalue(@$_POST["kelayakan_konsistensi"], false) .", 
		`catatan_konsistensi`=" .sqlvalue(@$_POST["catatan_konsistensi"], false) .", 
		`keterangan`=" .sqlvalue(@$_POST["keterangan"], true) ." 
		where " ."(`id_form_rd_01_jp_detail`=" .sqlvalue(@$_POST["xid_form_rd_01_jp_detail"], false) .")";
		
$sqlresult = $db->Execute($sql);

}

function create_(){
global $mod_id;
global $db;
global $_POST, $_GET, $_SERVER;
global $tbl_name_main;
global $tbl_name_detail;	

$sql = "insert into `".$tbl_name_main."` (`tanggal`, `no_propinsi`) values (
		" .sqlvalue(@$_POST["tanggal"], true) .", " .sqlvalue(@$_POST["no_propinsi"], false) .")";

$sqlresult = $db->Execute($sql);

$sql = "insert into `".$tbl_name_detail."` (`id_form_rd_01_jp_main`, `kode_proyek`, `nama_proyek`, `no_ruas`, 
		`nama_ruas`, `panjang_jalan`, `sasaran`, `kabupaten`, `panjang_proyek`, `status_awal_jalan`, 
		`status_akhir_jalan`, `jenis_penanganan`, `tipe_pkrsn`, `lebar_pkrsn`, `biaya_jalan`, `jumlah_jembatan`, 
		`panjang_jembatan`, `biaya_jembatan`, `total_biaya`, `pad1`, `du_prop`, `pjp_prop`, `jenis_loan_phln`, 
		`jumlah_loan_phln`, `jenis_sumber_dana_lain`, `jumlah_sumber_dana_lain`, `ur_01_jp_konsistensi`, 
		`biaya_per_km_konsistensi`, `kelayakan_konsistensi`, `catatan_konsistensi`, `keterangan`) values (
		(SELECT MAX(id_form_rd_01_jp_main) FROM ".$tbl_name_main."), 
		" .sqlvalue(@$_POST["kode_proyek"], true) .", 
		" .sqlvalue(@$_POST["nama_proyek"], true) .", 
		" .sqlvalue(@$_POST["no_ruas"], true) .", 
		" .sqlvalue(@$_POST["nama_ruas"], true) .", 
		" .sqlvalue(@$_POST["panjang_jalan"], false) .", 
		" .sqlvalue(@$_POST["sasaran"], false) .", 
		'" .get_data_kabupaten($_POST["jml_kabupaten"])."', 
		" .sqlvalue(@$_POST["panjang_proyek"], false) .", 
		" .sqlvalue(@$_POST["status_awal_jalan"], true) .", 
		" .sqlvalue(@$_POST["status_akhir_jalan"], true) .", 
		" .sqlvalue(@$_POST["jenis_penanganan"], false) .", 
		" .sqlvalue(@$_POST["tipe_pkrsn"], false) .", 
		" .sqlvalue(@$_POST["lebar_pkrsn"], false) .", 
		" .sqlvalue(@$_POST["biaya_jalan"], false) .", 
		" .sqlvalue(@$_POST["jumlah_jembatan"], false) .", 
		" .sqlvalue(@$_POST["panjang_jembatan"], false) .", 
		" .sqlvalue(@$_POST["biaya_jembatan"], false) .", 
		" .sqlvalue(@$_POST["total_biaya"], false) .", 
		" .sqlvalue(@$_POST["pad1"], false) .", 
		" .sqlvalue(@$_POST["du_prop"], false) .", 
		" .sqlvalue(@$_POST["pjp_prop"], false) .", 
		" .sqlvalue(@$_POST["jenis_loan_phln"], false) .", 
		" .sqlvalue(@$_POST["jumlah_loan_phln"], false) .", 
		" .sqlvalue(@$_POST["jenis_sumber_dana_lain"], false) .", 
		" .sqlvalue(@$_POST["jumlah_sumber_dana_lain"], false) .", 
		" .sqlvalue(@$_POST["ur_01_jp_konsistensi"], true) .", 
		" .sqlvalue(@$_POST["biaya_per_km_konsistensi"], false) .", 
		" .sqlvalue(@$_POST["kelayakan_konsistensi"], false) .", 
		" .sqlvalue(@$_POST["catatan_konsistensi"], false) .", 
		" .sqlvalue(@$_POST["keterangan"], true) .")";

$sqlresult = $db->Execute($sql);  
}

if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];


switch ($op){

case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
		//lockTables($tbl_name_main);
		//lockTables($tbl_name_detail);
		create_();		
		//unlockTables($tbl_name_main);	
		//unlockTables($tbl_name_detail);	
		//Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_();
		//unlockTables($tbl_name);		
		//Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		lockTables($tbl_name_main);
		delete_($_GET['id_form_rd_01_jp_main']);
		unlockTables($tbl_name_main);				
	}
break;
}

Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&Date_Year=".$_POST[tanggal]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);

}

?>
