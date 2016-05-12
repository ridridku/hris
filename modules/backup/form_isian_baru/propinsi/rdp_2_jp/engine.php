<?php

# Including Main Configuration
# including file for Main Configurations
require_once('../../../../includes/config.conf.php');	 	
//require_once('../../../includes/funct.php');

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/propinsi/rdp_2_jp';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/propinsi/rdp_2_jp';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
} else {
		$mod_id = $_GET['mod_id'];
}

$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name_main	= "tbl_form_rd_02_jp_main";
$tbl_name_detail	= "tbl_form_rd_02_jp_detail";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//
function sqlstr($val)
{
  return str_replace("'", "''", $val);
}

function sqlvalue($val, $quote)
{
  if ($quote)
    $tmp = sqlstr($val);
  else
    $tmp = $val;
  if ($tmp == "")
    $tmp = "NULL";
  elseif ($quote)
    $tmp = "'".$tmp."'";
  return $tmp;
}

function delete_($id){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;

$sql  ="DELETE ";
$sql .="FROM ".$tbl_name_main." ";
$sql .="WHERE id_form_rd_02_jp_main = '$id'";

$sqlresult = $db->Execute($sql);
}

function edit_(){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;

$sql = "update `tbl_form_rd_02_jp_main` set `tanggal`=" .sqlvalue(@$_POST["tanggal"], true) .", `no_propinsi`=" .sqlvalue(@$_POST["no_propinsi"], false) ." where " ."(`id_form_rd_02_jp_main`=" .sqlvalue(@$_POST["xid_form_rd_02_jp_main"], false) .")";
		
$sqlresult = $db->Execute($sql);

$sql = "update `tbl_form_rd_02_jp_detail` set 
`kode_proyek`=" .sqlvalue(@$_POST["kode_proyek"], true) .",
`jenis_penanganan`=" .sqlvalue(@$_POST["jenis_penanganan"], true) .",
`jumlah_proyek_per_paket`=" .sqlvalue(@$_POST["jumlah_proyek_per_paket"], false) .",
`jumlah_kabupaten`=" .sqlvalue(@$_POST["jumlah_kabupaten"], false) .",
`total_panjang_ruas`=" .sqlvalue(@$_POST["total_panjang_ruas"], false) .",
`panjang_proyek_jalan`=" .sqlvalue(@$_POST["panjang_proyek_jalan"], false) .",
`biaya_jalan`=" .sqlvalue(@$_POST["biaya_jalan"], false) .", 
`jumlah_jembatan`=" .sqlvalue(@$_POST["jumlah_jembatan"], false) .",
`panjang_jembatan`=" .sqlvalue(@$_POST["panjang_jembatan"], false) .",
`biaya_jembatan`=" .sqlvalue(@$_POST["biaya_jembatan"], false) .",`biaya_umum`=" .sqlvalue(@$_POST["biaya_umum"], false) .", `total_biaya`=" .sqlvalue(@$_POST["total_biaya"], false) .",
`pad1`=" .sqlvalue(@$_POST["pad1"], false) .",
`du_prop`=" .sqlvalue(@$_POST["du_prop"], false) .", `pjp_prop`=" .sqlvalue(@$_POST["pjp_prop"], false) .",
`jenis_loan_phln`=" .sqlvalue(@$_POST["jenis_loan_phln"], false) .",
`jumlah_loan_phln`=" .sqlvalue(@$_POST["jumlah_loan_phln"], false) .",
`jenis_sumber_dana_lain`=" .sqlvalue(@$_POST["jenis_sumber_dana_lain"], false) .",
`jumlah_sumber_dana_lain`=" .sqlvalue(@$_POST["jumlah_sumber_dana_lain"], false) .",
`keterangan`=" .sqlvalue(@$_POST["keterangan"], true) ." where " ."(`id_form_rd_02_jp_detail`=" .sqlvalue(@$_POST["xid_form_rd_02_jp_detail"], false) .")";
	//print $sql;	
$sqlresult = $db->Execute($sql);
}

function create_(){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;	

$sql = "insert into `tbl_form_rd_02_jp_main` (`tanggal`, `no_propinsi`) values (" .sqlvalue(@$_POST["tanggal"], true) .", " .sqlvalue(@$_POST["no_propinsi"], false) .")";

$sqlresult = $db->Execute($sql);
$_main_id = $db->Insert_ID();

$sql = "insert into `".$tbl_name_detail."` (`id_form_rd_02_jp_main`, `kode_proyek`, `jenis_penanganan`, 		`jumlah_proyek_per_paket`, `jumlah_kabupaten`, `total_panjang_ruas`, `panjang_proyek_jalan`, `biaya_jalan`, `jumlah_jembatan`, `panjang_jembatan`, `biaya_jembatan`, `biaya_umum`, `total_biaya`, `pad1`, `du_prop`, `pjp_prop`, `jenis_loan_phln`, `jumlah_loan_phln`, `jenis_sumber_dana_lain`, `jumlah_sumber_dana_lain`, `keterangan`) 
values (".$_main_id.",		
		" .sqlvalue(@$_POST["kode_proyek"], true) .",
		" .sqlvalue(@$_POST["jenis_penanganan"], true) .",
		" .sqlvalue(@$_POST["jumlah_proyek_per_paket"], false) .",
		" .sqlvalue(@$_POST["jumlah_kabupaten"], false) .",
		" .sqlvalue(@$_POST["total_panjang_ruas"], false) .",
		" .sqlvalue(@$_POST["panjang_proyek_jalan"], false) .",
		" .sqlvalue(@$_POST["biaya_jalan"], false) .",
		" .sqlvalue(@$_POST["jumlah_jembatan"], false) .",
		" .sqlvalue(@$_POST["panjang_jembatan"], false) .",
		" .sqlvalue(@$_POST["biaya_jembatan"], false) .",
		" .sqlvalue(@$_POST["biaya_umum"], false) .",
		" .sqlvalue(@$_POST["total_biaya"], false) .",
		" .sqlvalue(@$_POST["pad1"], false) .",
		" .sqlvalue(@$_POST["du_prop"], false) .",
		" .sqlvalue(@$_POST["pjp_prop"], false) .",
		" .sqlvalue(@$_POST["jenis_loan_phln"], false) .",
		" .sqlvalue(@$_POST["jumlah_loan_phln"], false) .",
		" .sqlvalue(@$_POST["jenis_sumber_dana_lain"], false) .",
		" .sqlvalue(@$_POST["jumlah_sumber_dana_lain"], false) .",
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
		delete_($_GET['id_form_rd_02_jp_main']);
		unlockTables($tbl_name_main);		
	Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&Date_Year=".$_GET[Date_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
}


}
?>
