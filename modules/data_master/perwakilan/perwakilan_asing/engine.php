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
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
//------------------------------------LOCAL CONFIG--------------------------------------//
 if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "tbl_mast_perwakilan_asing";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM tbl_mast_perwakilan_asing ";
$sql .="WHERE  kode_perwakilan_asing= '$_GET[kode_perwakilan_asing]' ";

$sqlresult = $db->Execute($sql);

$user_id = base64_decode($_SESSION['UID']);
 $ip_now = $_SERVER['REMOTE_ADDR'];
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id ) VALUES ('$ip_now',now(),'Hapus data >> master Kedutaan Besar Asing','$user_id') ";
 $db->Execute($sql2);
}

function edit_(){
global $mod_id;
global $db;
    
			$sql_edit  ="UPDATE tbl_mast_perwakilan_asing  ";
			$sql_edit .=" SET nama_perwakilan='$_POST[nama_perwakilan]', ";
			$sql_edit .="  alamat='$_POST[alamat]', ";

			$sql_edit .="  kode_negara='$_POST[kode_negara]', ";
			$sql_edit .="  fax='$_POST[fax]', ";
			$sql_edit .="  email='$_POST[email]', ";

			$sql_edit .="  tlp='$_POST[tlp]'";	
				
            			 
			$sql_edit .="WHERE kode_perwakilan_asing ='$_POST[kode_perwakilan_asing]' ";
            
			$sqlresult4 = $db->Execute($sql_edit);
			
			$ip_now = $_SERVER['REMOTE_ADDR'];
$user_id = base64_decode($_SESSION['UID']);
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id )  VALUES ('$ip_now',now(),'Ubah data >> master Kedutaan Besar Asing','$user_id') ";
 $db->Execute($sql2);
			
			
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
 
}


function create_($kode_perwakilan_asing,$nama_perwakilan,$alamat,$tlp){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;
$sql	 = "INSERT INTO tbl_mast_perwakilan_asing (`kode_perwakilan_asing`,`nama_perwakilan`,`alamat`,`tlp`,kode_jenis_pw,kode_negara,fax,email) ";
$sql	.= " VALUES ('".strip_tags($kode_perwakilan_asing)."','".strip_tags($nama_perwakilan)."','".strip_tags($alamat)."','".strip_tags($tlp)."','1','$_POST[kode_negara]','$_POST[fax]','$_POST[email]')";

$sqlresult = $db->Execute($sql);

$ip_now = $_SERVER['REMOTE_ADDR'];
$user_id = base64_decode($_SESSION['UID']);
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id )  VALUES ('$ip_now',now(),'Tambah Data >> master Kedutaan Besar Asing','$user_id') ";
 $db->Execute($sql2);
}

if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];


switch ($op){

case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
	   // lockTables($tbl_name);
		create_($_POST['kode_perwakilan_asing'], $_POST['nama_perwakilan'],$_POST['alamat'],$_POST['tlp']);
		//unlockTables($tbl_name);
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);		
		
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_();
		//unlockTables($tbl_name);		
		//Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
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
