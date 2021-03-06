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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_master/lokal_staf/lokal_staf';

#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_master');
$FILE_JS  = $JS_MODUL.'/lokal_staf/lokal_staf';

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "tbl_mast_staf";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($kode_staf){
global $mod_id;
global $db;
global $tbl_name;
global $field_name;
$sql  ="DELETE ";
$sql .="FROM ".$tbl_name." ";
$sql .="WHERE kode_staf = '".$kode_staf."' ";

$sqlresult = $db->Execute($sql);
}

function edit_($kode_staf,$kode_p,$nama,$alamat,$tlp,$jk,$tgl_lahir){
global $mod_id;
global $db;
global $tbl_name;
global $field_name;
$sql  ="UPDATE ".$tbl_name." ";
$sql .="SET kode_perwakilan_asing='".strip_tags($kode_p)."', ";
$sql .="  tempat_lahir='".$_POST['tempat_lahir']."', ";
$sql .="nama='".strip_tags($nama)."', ";
$sql .="alamat='".strip_tags($alamat)."', ";
$sql .="tlp='".strip_tags($tlp)."', ";
$sql .="jk='".strip_tags($jk)."', ";
$sql .="tgl_lahir='".strip_tags($tgl_lahir)."' ";
$sql .="WHERE kode_staf = '".$kode_staf."' ";

$sqlresult = $db->Execute($sql);
}

function create_($code,$kode_p,$nama,$alamat,$tlp,$jk,$tgl_lahir){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;
$sql	 = "INSERT INTO tbl_mast_staf (`kode_staf`,`kode_perwakilan_asing`,`nama`,`alamat`,`tlp`,`jk`,`tgl_lahir`,tempat_lahir) ";
$sql	.= " VALUES ('".strip_tags($code)."','".strip_tags($kode_p)."','".strip_tags($nama)."','".strip_tags($alamat)."','".strip_tags($tlp)."','".strip_tags($jk)."','".strip_tags($tgl_lahir)."','$_POST[tempat_lahir]')";

$sqlresult = $db->Execute($sql);
}

if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];


switch ($op){

case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
		lockTables($tbl_name);
		create_($_POST['kode_staf'],$_POST['kode_perwakilan_asing'],$_POST['nama'],$_POST['alamat'],$_POST['tlp'],$_POST['jk'],$_POST['tgl_lahir']);
		unlockTables($tbl_name);
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		lockTables($tbl_name);
		edit_($_POST['kode_staf'], $_POST['kode_perwakilan_asing'],$_POST['nama'],$_POST['alamat'],$_POST['tlp'],$_POST['jk'],$_POST['tgl_lahir']);
		unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		lockTables($tbl_name);
		delete_($_GET['kode_staf']);
		unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
}


}
?>
