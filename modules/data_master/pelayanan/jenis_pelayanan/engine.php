<?php

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_master/pelayanan/jenis_pelayanan';

#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_master');
$FILE_JS  = $JS_MODUL.'/pelayanan/jenis_pelayanan';

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "tbl_mast_jenis_pelayanan";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $mod_id;
global $db;
global $tbl_name;
global $field_name;
$sql  ="DELETE ";
$sql .="FROM ".$tbl_name." ";
$sql .="WHERE kode_jenis_pelayanan = $id";

$sqlresult = $db->Execute($sql);

$user_id = base64_decode($_SESSION['UID']);
 $ip_now = $_SERVER['REMOTE_ADDR'];
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id ) VALUES ('$ip_now',now(),'Hapus data >> master Jenis Pelayanan','$user_id') ";
 $db->Execute($sql2);
}

function edit_($id, $name){
global $mod_id;
global $db;
global $tbl_name;
global $field_name;
$sql  ="UPDATE ".$tbl_name." ";
$sql .="SET nama_jenis_pelayanan='".strip_tags($name)."' ";
$sql .="WHERE kode_jenis_pelayanan = $id ";

$sqlresult = $db->Execute($sql);

$ip_now = $_SERVER['REMOTE_ADDR'];
$user_id = base64_decode($_SESSION['UID']);
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id )  VALUES ('$ip_now',now(),'Ubah data >> master Jenis Pelayanan','$user_id') ";
 $db->Execute($sql2);
}

function create_($name){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;
$sql	 = "INSERT INTO tbl_mast_jenis_pelayanan (`nama_jenis_pelayanan`) ";
$sql	.= " VALUES ('".strip_tags($name)."')";

$sqlresult = $db->Execute($sql);

$ip_now = $_SERVER['REMOTE_ADDR'];
$user_id = base64_decode($_SESSION['UID']);
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id )  VALUES ('$ip_now',now(),'Tambah Data >> master Jenis Pelayanan','$user_id') ";
 $db->Execute($sql2);
}

if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];


switch ($op){

case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
		//lockTables($tbl_name);
		create_($_POST['nama_jenis_pelayanan']);
		//unlockTables($tbl_name);
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_($_POST['kode_jenis_pelayanan'], $_POST['nama_jenis_pelayanan']);
		//unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		//lockTables($tbl_name);
		delete_($_GET['kode_jenis_pelayanan']);
		//unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
}


}
?>
