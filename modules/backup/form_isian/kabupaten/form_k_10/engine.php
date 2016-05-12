<?php

# Including Main Configuration
# including file for Main Configurations
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

#Initiate TABLE
$tbl_name_main	= "tbl_form_k_10_main";
$tbl_name_detail	= "tbl_form_k_10_detail";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;

$sql  ="DELETE ";
$sql .="FROM ".$tbl_name_main." ";
$sql .="WHERE id_k_10_main = '$id'";

$sqlresult = $db->Execute($sql);
}

function edit_(){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;

$sql = "update `".$tbl_name_main."` set `tanggal`=" .sqlvalue(@$_POST["tanggal"], true) .", 
		`no_propinsi`=" .sqlvalue(@$_POST["no_propinsi"], false) .", 
		`no_kabupaten`=" .sqlvalue(@$_POST["no_kabupaten"], false) .", 
		`nama_penggisi`=" .sqlvalue(@$_POST["nama_penggisi"], true) ." 
		where " ."(`id_k_10_main`=" .sqlvalue(@$_POST["xid_k_10_main"], false) .")";
		
$sqlresult = $db->Execute($sql);

$sql = "update `".$tbl_name_detail."` set `no_ruas`=" .sqlvalue(@$_POST["no_ruas"], true) .", 
		`nama_jembatan_sungai`=" .sqlvalue(@$_POST["nama_jembatan_sungai"], true) .", 
		`pal_km`=" .sqlvalue(@$_POST["pal_km"], true) .", 
		`tipe_penyebrangan`=" .sqlvalue(@$_POST["tipe_penyebrangan"], true) .", 
		`panjang`=" .sqlvalue(@$_POST["panjang"], false) .", 
		`lebar`=" .sqlvalue(@$_POST["lebar"], false) .", 
		`jumlah_bentang`=" .sqlvalue(@$_POST["jumlah_bentang"], false) .", 
		`bangunan_atas_tipe`=" .sqlvalue(@$_POST["bangunan_atas_tipe"], true) .", 
		`bangunan_atas_bahan`=" .sqlvalue(@$_POST["bangunan_atas_bahan"], true) .", 
		`bangunan_atas_asal`=" .sqlvalue(@$_POST["bangunan_atas_asal"], true) .", 
		`bangunan_atas_kondisi`=" .sqlvalue(@$_POST["bangunan_atas_kondisi"], false) .", 
		`lantai_tipe1`=" .sqlvalue(@$_POST["lantai_tipe1"], true) .", 
		`lantai_tipe2`=" .sqlvalue(@$_POST["lantai_tipe2"], true) .", 
		`lantai_kondisi`=" .sqlvalue(@$_POST["lantai_kondisi"], true) .", 
		`sandaran_tipe1`=" .sqlvalue(@$_POST["sandaran_tipe1"], true) .", 
		`sandaran_tipe2`=" .sqlvalue(@$_POST["sandaran_tipe2"], true) .", 
		`sandaran_kondisi`=" .sqlvalue(@$_POST["sandaran_kondisi"], true) .", 
		`pondasi_tipe`=" .sqlvalue(@$_POST["pondasi_tipe"], true) .", 
		`pondasi_bahan1`=" .sqlvalue(@$_POST["pondasi_bahan1"], true) .", 
		`pondasi_bahan2`=" .sqlvalue(@$_POST["pondasi_bahan2"], true) .", 
		`pondasi_kondisi`=" .sqlvalue(@$_POST["pondasi_kondisi"], true) .", 
		`kep_jembatan_tipe`=" .sqlvalue(@$_POST["kep_jembatan_tipe"], true) .", 
		`kep_jembatan_bahan1`=" .sqlvalue(@$_POST["kep_jembatan_bahan1"], true) .", 
		`kep_jembatan_bahan2`=" .sqlvalue(@$_POST["kep_jembatan_bahan2"], true) ." 
		where " ."(`id_fk_10_detail`=" .sqlvalue(@$_POST["xid_form_k_10_detail"], false) .")";
		
$sqlresult = $db->Execute($sql);

}

function create_(){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;	

$sql = "insert into `".$tbl_name_main."` (`tanggal`, `no_propinsi`, `no_kabupaten`, `nama_penggisi`) values (
		" .sqlvalue(@$_POST["tanggal"], true) .", 
		" .sqlvalue(@$_POST["no_propinsi"], false) .", 
		" .sqlvalue(@$_POST["no_kabupaten"], false) .", 
		" .sqlvalue(@$_POST["nama_penggisi"], true) .")";

$sqlresult = $db->Execute($sql);

$sql = "insert into `".$tbl_name_detail."` (`id_fk_10_main`, `no_ruas`, `nama_jembatan_sungai`, `pal_km`, 
		`tipe_penyebrangan`, `panjang`, `lebar`, `jumlah_bentang`, `bangunan_atas_tipe`, `bangunan_atas_bahan`, 
		`bangunan_atas_asal`, `bangunan_atas_kondisi`, `lantai_tipe1`, `lantai_tipe2`, `lantai_kondisi`, 
		`sandaran_tipe1`, `sandaran_tipe2`, `sandaran_kondisi`, `pondasi_tipe`, `pondasi_bahan1`, `pondasi_bahan2`, 
		`pondasi_kondisi`, `kep_jembatan_tipe`, `kep_jembatan_bahan1`, `kep_jembatan_bahan2`) values (
		(SELECT MAX(id_k_10_main) FROM ".$tbl_name_main."), 
		" .sqlvalue(@$_POST["no_ruas"], true) .", 
		" .sqlvalue(@$_POST["nama_jembatan_sungai"], true) .", 
		" .sqlvalue(@$_POST["pal_km"], true) .", 
		" .sqlvalue(@$_POST["tipe_penyebrangan"], true) .", 
		" .sqlvalue(@$_POST["panjang"], false) .", 
		" .sqlvalue(@$_POST["lebar"], false) .", 
		" .sqlvalue(@$_POST["jumlah_bentang"], false) .", 
		" .sqlvalue(@$_POST["bangunan_atas_tipe"], true) .", 
		" .sqlvalue(@$_POST["bangunan_atas_bahan"], true) .", 
		" .sqlvalue(@$_POST["bangunan_atas_asal"], true) .", 
		" .sqlvalue(@$_POST["bangunan_atas_kondisi"], false) .", 
		" .sqlvalue(@$_POST["lantai_tipe1"], true) .", 
		" .sqlvalue(@$_POST["lantai_tipe2"], true) .", 
		" .sqlvalue(@$_POST["lantai_kondisi"], true) .", 
		" .sqlvalue(@$_POST["sandaran_tipe1"], true) .", 
		" .sqlvalue(@$_POST["sandaran_tipe2"], true) .", 
		" .sqlvalue(@$_POST["sandaran_kondisi"], true) .", 
		" .sqlvalue(@$_POST["pondasi_tipe"], true) .", 
		" .sqlvalue(@$_POST["pondasi_bahan1"], true) .", 
		" .sqlvalue(@$_POST["pondasi_bahan2"], true) .", 
		" .sqlvalue(@$_POST["pondasi_kondisi"], true) .", 
		" .sqlvalue(@$_POST["kep_jembatan_tipe"], true) .", 
		" .sqlvalue(@$_POST["kep_jembatan_bahan1"], true) .", 
		" .sqlvalue(@$_POST["kep_jembatan_bahan2"], true) .")";

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
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_();
		//unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		lockTables($tbl_name_main);
		delete_($_GET['id_k_10_main']);
		unlockTables($tbl_name_main);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&no_kabupaten=".$_GET[no_kabupaten]."&Search_Year=".$_GET[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;

}


}
?>
