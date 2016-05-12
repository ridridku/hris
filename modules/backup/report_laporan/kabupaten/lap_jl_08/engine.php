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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/report_laporan/kabupaten/lap_jl_08';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/report_laporan');
$FILE_JS  = $JS_MODUL.'/kabupaten/lap_jl_08';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name_main	= "tbl_form_jl_08_main";
$tbl_name_detail	= "tbl_form_jl_08_detail";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;

$sql  ="DELETE ";
$sql .="FROM ".$tbl_name_main." ";
$sql .="WHERE id_fjl_08_main = '$id'";

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
		`triwulan`=" .sqlvalue(@$_POST["triwulan"], false) .", 
		`status_progress`=" .sqlvalue(@$_POST["status_progress"], true) .", 
		`catatan`=" .sqlvalue(@$_POST["catatan"], true) ." 
		where " ."(`id_fjl_08_main`=" .sqlvalue(@$_POST["xid_jl_08_main"], false) .")";
		
$sqlresult = $db->Execute($sql);

$sql = "update `".$tbl_name_detail."` set `nama_paket`=" .sqlvalue(@$_POST["nama_paket"], true) .", 
		`lhr`=" .sqlvalue(@$_POST["lhr"], false) .", 
		`jalan_perkerasan`=" .sqlvalue(@$_POST["jalan_perkerasan"], true) .", 
		`jalan_bahu`=" .sqlvalue(@$_POST["jalan_bahu"], true) .", 
		`jalan_drainase`=" .sqlvalue(@$_POST["jalan_drainase"], true) .", 
		`jalan_trotoar`=" .sqlvalue(@$_POST["jalan_trotoar"], true) .", 
		`jalan_pengaman`=" .sqlvalue(@$_POST["jalan_pengaman"], true) .", 
		`jalan_talud`=" .sqlvalue(@$_POST["jalan_talud"], true) .", 
		`jalan_lain`=" .sqlvalue(@$_POST["jalan_lain"], true) .", 
		`jembatan_beton`=" .sqlvalue(@$_POST["jembatan_beton"], true) .", 
		`jembatan_kayu`=" .sqlvalue(@$_POST["jembatan_kayu"], true) .", 
		`jembatan_oprit`=" .sqlvalue(@$_POST["jembatan_oprit"], true) .", 
		`jembatan_pengecatan`=" .sqlvalue(@$_POST["jembatan_pengecatan"], true) .", 
		`jembatan_lainnya`=" .sqlvalue(@$_POST["jembatan_lainnya"], true) .", 
		`keterangan`=" .sqlvalue(@$_POST["keterangan"], true) ." 
		where " ."(`id_fjl_08_detail`=" .sqlvalue(@$_POST["xid_form_jl_08_detail"], false) .")";
		
$sqlresult = $db->Execute($sql);

}

function create_(){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;	

$sql = "insert into `".$tbl_name_main."` (`tanggal`, `no_propinsi`, `no_kabupaten`, `triwulan`, 
		`status_progress`, `catatan`) values (
		" .sqlvalue(@$_POST["tanggal"], true) .", 
		" .sqlvalue(@$_POST["no_propinsi"], false) .", 
		" .sqlvalue(@$_POST["no_kabupaten"], false) .", 
		" .sqlvalue(@$_POST["triwulan"], false) .", 
		" .sqlvalue(@$_POST["status_progress"], true) .", 
		" .sqlvalue(@$_POST["catatan"], true) .")";

$sqlresult = $db->Execute($sql);

$sql = "insert into `".$tbl_name_detail."` (`id_fjl_08_main`, `nama_paket`, `lhr`, `jalan_perkerasan`, `jalan_bahu`, 
		`jalan_drainase`, `jalan_trotoar`, `jalan_pengaman`, `jalan_talud`, `jalan_lain`, `jembatan_beton`, 
		`jembatan_kayu`, `jembatan_oprit`, `jembatan_pengecatan`, `jembatan_lainnya`, `keterangan`) values (
		(SELECT MAX(id_fjl_08_main) FROM ".$tbl_name_main."), 
		" .sqlvalue(@$_POST["nama_paket"], true) .", 
		" .sqlvalue(@$_POST["lhr"], false) .", 
		" .sqlvalue(@$_POST["jalan_perkerasan"], true) .", 
		" .sqlvalue(@$_POST["jalan_bahu"], true) .", 
		" .sqlvalue(@$_POST["jalan_drainase"], true) .", 
		" .sqlvalue(@$_POST["jalan_trotoar"], true) .", 
		" .sqlvalue(@$_POST["jalan_pengaman"], true) .", 
		" .sqlvalue(@$_POST["jalan_talud"], true) .", 
		" .sqlvalue(@$_POST["jalan_lain"], true) .", 
		" .sqlvalue(@$_POST["jembatan_beton"], true) .", 
		" .sqlvalue(@$_POST["jembatan_kayu"], true) .", 
		" .sqlvalue(@$_POST["jembatan_oprit"], true) .", 
		" .sqlvalue(@$_POST["jembatan_pengecatan"], true) .", 
		" .sqlvalue(@$_POST["jembatan_lainnya"], true) .", 
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
		delete_($_GET['id_fjl_08_main']);
		unlockTables($tbl_name_main);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&no_kabupaten=".$_GET[no_kabupaten]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
}


}
?>
