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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/propinsi/rfk_2_jp';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/propinsi/rfk_2_jp';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name_main = "tbl_form_rfk_02_jp_main";
$tbl_name_detail = "tbl_form_rfk_02_jp_detail";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;

$sql  ="DELETE ";
$sql .="FROM ".$tbl_name_main." ";
$sql .="WHERE id_form_rfk_02_jp_main = '$id'";

$sqlresult = $db->Execute($sql);
}

function edit_(){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;

$sql = "update `".$tbl_name_main."` set `tanggal`=" .sqlvalue(@$_POST["tanggal"], true) .", 
		`no_propinsi`=" .sqlvalue(@$_POST["no_propinsi"], false) ." 
		where " ."(`id_form_rfk_02_jp_main`=" .sqlvalue(@$_POST["xid_form_rfk_02_jp_main"], false) .")";
		
$sqlresult = $db->Execute($sql);

$sql = "update `".$tbl_name_detail."` set 
		`kode_proyek`=" .sqlvalue(@$_POST["kode_proyek"], true) .", 
		`jenis_penanganan`=" .sqlvalue(@$_POST["jenis_penanganan"], true) .", 
		`jumlah_proyek`=" .sqlvalue(@$_POST["jumlah_proyek"], false) .", 
		`total_fisik_jalan`=" .sqlvalue(@$_POST["total_fisik_jalan"], false) .", 
		`total_fisik_jembatan`=" .sqlvalue(@$_POST["total_fisik_jembatan"], false) .", 
		`total_biaya`=" .sqlvalue(@$_POST["total_biaya"], false) .", 
		`biaya_pad1`=" .sqlvalue(@$_POST["biaya_pad1"], false) .", 
		`persen_fisik_pad1_bulan_ini`=" .sqlvalue(@$_POST["persen_fisik_pad1_bulan_ini"], false) .", 
		`nilai_fisik_pad1_bulan_ini`=" .sqlvalue(@$_POST["nilai_fisik_pad1_bulan_ini"], false) .", 
		`persen_keuangan_pad1_bulan_ini`=" .sqlvalue(@$_POST["persen_keuangan_pad1_bulan_ini"], false) .", 
		`nilai_keuangan_pad1_bulan_ini`=" .sqlvalue(@$_POST["nilai_keuangan_pad1_bulan_ini"], false) .", 
		`biaya_du_dpp`=" .sqlvalue(@$_POST["biaya_du_dpp"], false) .", 
		`persen_fisik_du_dpp_bulan_ini`=" .sqlvalue(@$_POST["persen_fisik_du_dpp_bulan_ini"], false) .", 
		`nilai_fisik_du_dpp_bulan_ini`=" .sqlvalue(@$_POST["nilai_fisik_du_dpp_bulan_ini"], false) .", 
		`persen_keuangan_du_dpp_bulan_ini`=" .sqlvalue(@$_POST["persen_keuangan_du_dpp_bulan_ini"], false) .", 
		`nilai_keuangan_du_dpp_bulan_ini`=" .sqlvalue(@$_POST["nilai_keuangan_du_dpp_bulan_ini"], false) .", 
		`biaya_pjp`=" .sqlvalue(@$_POST["biaya_pjp"], false) .", 
		`persen_fisik_pjp_bulan_ini`=" .sqlvalue(@$_POST["persen_fisik_pjp_bulan_ini"], false) .", 
		`nilai_fisik_pjp_bulan_ini`=" .sqlvalue(@$_POST["nilai_fisik_pjp_bulan_ini"], false) .", 
		`persen_keuangan_pjp_bulan_ini`=" .sqlvalue(@$_POST["persen_keuangan_pjp_bulan_ini"], false) .", 
		`nilai_keuangan_pjp_bulan_ini`=" .sqlvalue(@$_POST["nilai_keuangan_pjp_bulan_ini"], false) .", 
		`jenis_loan_phln`=" .sqlvalue(@$_POST["jenis_loan_phln"], false) .", 
		`biaya_loan_phln`=" .sqlvalue(@$_POST["biaya_loan_phln"], false) .", 
		`persen_fisik_loan_phln_bulan_ini`=" .sqlvalue(@$_POST["persen_fisik_loan_phln_bulan_ini"], false) .", 
		`nilai_fisik_loan_phln_bulan_ini`=" .sqlvalue(@$_POST["nilai_fisik_loan_phln_bulan_ini"], false) .", 
		`persen_keuangan_loan_phln_bulan_ini`=" .sqlvalue(@$_POST["persen_keuangan_loan_phln_bulan_ini"], false) .", 
		`nilai_keuangan_loan_phln_bulan_ini`=" .sqlvalue(@$_POST["nilai_keuangan_loan_phln_bulan_ini"], false) .", 
		`jenis_sumber_dana_lain`=" .sqlvalue(@$_POST["jenis_sumber_dana_lain"], false) .", 
		`biaya_sumber_dana_lain`=" .sqlvalue(@$_POST["biaya_sumber_dana_lain"], false) .", 
		`persen_fisik_sumber_dana_bulan_ini`=" .sqlvalue(@$_POST["persen_fisik_sumber_dana_bulan_ini"], false) .", 
		`nilai_fisik_sumber_dana_bulan_ini`=" .sqlvalue(@$_POST["nilai_fisik_sumber_dana_bulan_ini"], false) .", 
		`persen_keuangan_sumber_dana_bulan_ini`=" .sqlvalue(@$_POST["persen_keuangan_sumber_dana_bulan_ini"], false) .",
		 `nilai_keuangan_sumber_dana_bulan_ini`=" .sqlvalue(@$_POST["nilai_keuangan_sumber_dana_bulan_ini"], false) .", 
		 `keterangan`=" .sqlvalue(@$_POST["keterangan"], true) ." 
		 where " ."(`id_form_rfk_02_jp_detail`=" .sqlvalue(@$_POST["xid_form_rfk_02_jp_detail"], false) .")";
		
$sqlresult = $db->Execute($sql);

}

function create_(){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;	

$sql = "insert into `".$tbl_name_main."` (`tanggal`, `no_propinsi`) values (
		" .sqlvalue(@$_POST["tanggal"], true) .", " .sqlvalue(@$_POST["no_propinsi"], false) .")";

$sqlresult = $db->Execute($sql);

$sql = "insert into `".$tbl_name_detail."` (`id_form_rfk_02_jp_main`, `jenis_penanganan`, `kode_proyek`,
		`jumlah_proyek`, `total_fisik_jalan`, `total_fisik_jembatan`, `total_biaya`, `biaya_pad1`, 
		`persen_fisik_pad1_bulan_ini`, `nilai_fisik_pad1_bulan_ini`, `persen_keuangan_pad1_bulan_ini`, 
		`nilai_keuangan_pad1_bulan_ini`, `biaya_du_dpp`, `persen_fisik_du_dpp_bulan_ini`, 
		`nilai_fisik_du_dpp_bulan_ini`, `persen_keuangan_du_dpp_bulan_ini`, `nilai_keuangan_du_dpp_bulan_ini`, 
		`biaya_pjp`, `persen_fisik_pjp_bulan_ini`, `nilai_fisik_pjp_bulan_ini`, `persen_keuangan_pjp_bulan_ini`, 
		`nilai_keuangan_pjp_bulan_ini`, `jenis_loan_phln`, `biaya_loan_phln`, `persen_fisik_loan_phln_bulan_ini`, 
		`nilai_fisik_loan_phln_bulan_ini`, `persen_keuangan_loan_phln_bulan_ini`, `nilai_keuangan_loan_phln_bulan_ini`, 
		`jenis_sumber_dana_lain`, `biaya_sumber_dana_lain`, `persen_fisik_sumber_dana_bulan_ini`, 
		`nilai_fisik_sumber_dana_bulan_ini`, `persen_keuangan_sumber_dana_bulan_ini`, 
		`nilai_keuangan_sumber_dana_bulan_ini`, `keterangan`) values (
		(SELECT MAX(id_form_rfk_02_jp_main) FROM ".$tbl_name_main."), 		
		" .sqlvalue(@$_POST["jenis_penanganan"], true) .", 
		" .sqlvalue(@$_POST["kode_proyek"], true) .", 
		" .sqlvalue(@$_POST["jumlah_proyek"], false) .", 
		" .sqlvalue(@$_POST["total_fisik_jalan"], false) .", 
		" .sqlvalue(@$_POST["total_fisik_jembatan"], false) .", 
		" .sqlvalue(@$_POST["total_biaya"], false) .", 
		" .sqlvalue(@$_POST["biaya_pad1"], false) .", 
		" .sqlvalue(@$_POST["persen_fisik_pad1_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["nilai_fisik_pad1_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["persen_keuangan_pad1_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["nilai_keuangan_pad1_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["biaya_du_dpp"], false) .", 
		" .sqlvalue(@$_POST["persen_fisik_du_dpp_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["nilai_fisik_du_dpp_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["persen_keuangan_du_dpp_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["nilai_keuangan_du_dpp_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["biaya_pjp"], false) .", 
		" .sqlvalue(@$_POST["persen_fisik_pjp_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["nilai_fisik_pjp_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["persen_keuangan_pjp_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["nilai_keuangan_pjp_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["jenis_loan_phln"], false) .", 
		" .sqlvalue(@$_POST["biaya_loan_phln"], false) .", 
		" .sqlvalue(@$_POST["persen_fisik_loan_phln_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["nilai_fisik_loan_phln_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["persen_keuangan_loan_phln_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["nilai_keuangan_loan_phln_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["jenis_sumber_dana_lain"], false) .", 
		" .sqlvalue(@$_POST["biaya_sumber_dana_lain"], false) .", 
		" .sqlvalue(@$_POST["persen_fisik_sumber_dana_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["nilai_fisik_sumber_dana_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["persen_keuangan_sumber_dana_bulan_ini"], false) .", 
		" .sqlvalue(@$_POST["nilai_keuangan_sumber_dana_bulan_ini"], false) .", 
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
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&Date_Year=".$_POST[tanggal]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_();
		//unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&Date_Year=".$_POST[tanggal]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		lockTables($tbl_name_main);
		delete_($_GET['id_form_rfk_02_jp_main']);
		unlockTables($tbl_name_main);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&Date_Year=".$_GET[Date_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
}


}
?>
