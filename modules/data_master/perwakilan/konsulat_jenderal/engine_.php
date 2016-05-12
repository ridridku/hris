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
$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
//------------------------------------LOCAL CONFIG--------------------------------------//
#SETTING FOR TEMPLATE 
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_master/perwakilan/perwakilan';

#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_master');
$FILE_JS  = $JS_MODUL.'/perwakilan/perwakilan';

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "tbl_mast_perwakilan";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM tbl_mast_perwakilan ";
$sql .="WHERE  kode_perwakilan= '$_GET[kode_perwakilan]' ";

$sqlresult = $db->Execute($sql);
}



function edit_($id, $kode_perwakilan,$name,$alamat, $kode_negara){
global $mod_id;
global $db;
global $tbl_name;
global $field_name;

$sql  ="UPDATE ".$tbl_name." ";
$sql .="SET kode_perwakilan ='".strip_tags($kode_perwakilan)."' ";
$sql .=" nm_perwakilan ='".strip_tags($name)."' ";
$sql .=" alamat ='".strip_tags($alamat)."' ";
$sql .=" kode_negara='".strip_tags($kode_negara)."' ";
$sql .="WHERE kode_perwakilan = $id ";

$sqlresult = $db->Execute($sql);
}

function create_($code,$name,$alamat,$kode_negara){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;
$sql	 = "INSERT INTO tbl_mast_perwakilan (`kode_perwakilan`,`nm_perwakilan`,`alamat`,`kode_negara`) ";
$sql	.= " VALUES ('".strip_tags($code)."','".strip_tags($name)."','".strip_tags($alamat)."','".strip_tags($kode_negara)."')";

$sqlresult = $db->Execute($sql);
}

if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];


switch ($op){

case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
		lockTables($tbl_name);
		create_($_POST['kode_perwakilan'],$_POST['nm_perwakilan'],$_POST['alamat'],$_POST['kode_negara']);
		unlockTables($tbl_name);
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		lockTables($tbl_name);
		edit_($_POST['kode_perwakilan'], $_POST['nm_perwakilan'],$_POST['alamat'],$_POST['kode_negara']);
		unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		//lockTables($tbl_name);
		delete_();
	//	unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
}


}
?>
