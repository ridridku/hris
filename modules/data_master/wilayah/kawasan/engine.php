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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_master/wilayah/kawasan';

#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_master');
$FILE_JS  = $JS_MODUL.'/wilayah/kawasan';

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "tbl_mast_kawasan";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $mod_id;
global $db;
global $tbl_name;
global $field_name;
$sql  ="DELETE ";
$sql .="FROM ".$tbl_name." ";
$sql .="WHERE kode_kawasan = $id";

$sqlresult = $db->Execute($sql);

$user_id = base64_decode($_SESSION['UID']);
 $ip_now = $_SERVER['REMOTE_ADDR'];
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id ) VALUES ('$ip_now',now(),'Hapus data >> master Kawasan','$user_id') ";
 $db->Execute($sql2);
}

function edit_(){
global $mod_id;
global $db;
    
			$sql_edit  ="UPDATE tbl_mast_kawasan  ";
			$sql_edit .=" SET nama_kawasan='$_POST[nama_kawasan]' ";
		          			 
			$sql_edit .="WHERE kode_kawasan ='$_POST[kode_kawasan]' ";
            
			$sqlresult4 = $db->Execute($sql_edit);
			
$ip_now = $_SERVER['REMOTE_ADDR'];
$user_id = base64_decode($_SESSION['UID']);
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id )  VALUES ('$ip_now',now(),'Ubah data >> master Kawasan','$user_id') ";
 $db->Execute($sql2);			
			
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
 
}

function create_($kode_kawasan,$nama_kawasan){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;
$sql	 = "INSERT INTO tbl_mast_kawasan (`kode_kawasan`,`nama_kawasan`) ";
$sql	.= " VALUES ('".strip_tags($kode_kawasan)."','".strip_tags($nama_kawasan)."')";

$sqlresult = $db->Execute($sql);


$ip_now = $_SERVER['REMOTE_ADDR'];
$user_id = base64_decode($_SESSION['UID']);
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id )  VALUES ('$ip_now',now(),'Tambah Data >> master Kawasan','$user_id') ";
 $db->Execute($sql2);
}

if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];


switch ($op){

case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
		//lockTables($tbl_name);
		create_($_POST['kode_kawasan'], $_POST['nama_kawasan']);
		//unlockTables($tbl_name);
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		edit_();
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		//lockTables($tbl_name);
		delete_($_GET['kode_kawasan']);
		//unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
}


}
?>
