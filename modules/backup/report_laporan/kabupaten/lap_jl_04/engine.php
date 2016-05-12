<?php

# Including Main Configuration
# including file for Main Configurations
require_once('../../../includes/config.conf.php');	 	
require_once('../../../includes/funct.php');

# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
		require_once('../../../includes/header.redirect.inc');
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/report_laporan/kabupaten/lap_jl_04';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/report_laporan');
$FILE_JS  = $JS_MODUL.'/kabupaten/lap_jl_04';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name_main	= "tbl_form_jl_04_main";
$tbl_name_detail	= "tbl_form_jl_04_detail";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;

$sql  ="DELETE ";
$sql .="FROM ".$tbl_name_main." ";
$sql .="WHERE id_fjl_04_main = '$id'";

$sqlresult = $db->Execute($sql);
}

function edit_(){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;

$sql = "update `tbl_form_jl_04_main` set `id_fjl_04_main`=" .sqlvalue(@$_POST["id_fjl_04_main"], false) .", `tanggal`=" .sqlvalue(@$_POST["tanggal"], true) .", `no_propinsi`=" .sqlvalue(@$_POST["no_propinsi"], false) .", `no_kabupaten`=" .sqlvalue(@$_POST["no_kabupaten"], false) .", `apbd`=" .sqlvalue(@$_POST["apbd"], true) .", `thn_anggaran`=" .sqlvalue(@$_POST["thn_anggaran"], true) ." where " ."(`id_fjl_04_main`=" .sqlvalue(@$_POST["xid_fjl_04_main"], false) .")";

$sqlresult = $db->Execute($sql);

$sql = "update `tbl_form_jl_04_detail` set
`id_program_penanganan`=" .sqlvalue(@$_POST["id_program_penanganan"], false) .",
`apbd_target`=" .sqlvalue(@$_POST["apbd_target"], false) .",
`apbd_biaya`=" .sqlvalue(@$_POST["apbd_biaya"], false) .",
`apbd_jalan_target`=" .sqlvalue(@$_POST["apbd_jalan_target"], false) .",
`apbd_jalan_biaya`=" .sqlvalue(@$_POST["apbd_jalan_biaya"], false) .",
`dak_target`=" .sqlvalue(@$_POST["dak_target"], false) .",
`dak_biaya`=" .sqlvalue(@$_POST["dak_biaya"], false) .",
`sektor_target`=" .sqlvalue(@$_POST["sektor_target"], false) .",
`sektor_biaya`=" .sqlvalue(@$_POST["sektor_biaya"], false) .",
`pinjaman_target`=" .sqlvalue(@$_POST["pinjaman_target"], false) .",
`pinjaman_biaya`=" .sqlvalue(@$_POST["pinjaman_biaya"], false) .",
`total_target`=" .sqlvalue(@$_POST["total_target"], false) .",
`total_biaya`=" .sqlvalue(@$_POST["total_biaya"], false) ." 
where " ."(`id_fjl_04_detail`=" .sqlvalue(@$_POST["xid_fjl_04_detail"], false) .")";
//print $sql;		
$sqlresult = $db->Execute($sql);

}

function create_(){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;	

$sql_ = "insert into `tbl_form_jl_04_main` (`id_fjl_04_main`, `tanggal`, `no_propinsi`, `no_kabupaten`, `apbd`, `thn_anggaran`) values (" .sqlvalue(@$_POST["id_fjl_04_main"], false) .", " .sqlvalue(@$_POST["tanggal"], true) .", " .sqlvalue(@$_POST["no_propinsi"], false) .", " .sqlvalue(@$_POST["no_kabupaten"], false) .", " .sqlvalue(@$_POST["apbd"], true) .", " .sqlvalue(@$_POST["thn_anggaran"], true) .")";
//print $sql_;
$sqlresult = $db->Execute($sql_);

$sql ="insert into `tbl_form_jl_04_detail` (`id_fjl_04_detail`, `id_fjl_04_main`, `id_program_penanganan`, `apbd_target`, `apbd_biaya`, `apbd_jalan_target`, `apbd_jalan_biaya`, `dak_target`, `dak_biaya`, `sektor_target`, `sektor_biaya`, `pinjaman_target`, `pinjaman_biaya`, `total_target`, `total_biaya`) values 
(" .sqlvalue(@$_POST["id_fjl_04_detail"], false) .",
(SELECT MAX(id_fjl_04_main) FROM ".$tbl_name_main."),
" .sqlvalue(@$_POST["id_program_penanganan"], false) .",
" .sqlvalue(@$_POST["apbd_target"], false) .",
" .sqlvalue(@$_POST["apbd_biaya"], false) .",
" .sqlvalue(@$_POST["apbd_jalan_target"], false) .",
" .sqlvalue(@$_POST["apbd_jalan_biaya"], false) .",
" .sqlvalue(@$_POST["dak_target"], false) .",
" .sqlvalue(@$_POST["dak_biaya"], false) .", " .sqlvalue(@$_POST["sektor_target"], false) .",
" .sqlvalue(@$_POST["sektor_biaya"], false) .", " .sqlvalue(@$_POST["pinjaman_target"], false) .",
" .sqlvalue(@$_POST["pinjaman_biaya"], false) .", " .sqlvalue(@$_POST["total_target"], false) .",
" .sqlvalue(@$_POST["total_biaya"], false) .")";

//print $sql;
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
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_();
		//unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		lockTables($tbl_name_main);
		delete_($_GET['id_fjl_04_main']);
		unlockTables($tbl_name_main);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&no_kabupaten=".$_GET[no_kabupaten]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
}


}
?>
