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
 if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "tbl_bhi";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM tbl_bhi ";
$sql .="WHERE  kode_bhi= '$_GET[kode_bhi]' ";

$sqlresult = $db->Execute($sql);

$user_id = base64_decode($_SESSION['UID']);
 $ip_now = $_SERVER['REMOTE_ADDR'];
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id ) VALUES ('$ip_now',now(),'Hapus data >> master BHI','$user_id') ";
 $db->Execute($sql2);
}

function edit_(){
global $mod_id;
global $db;
    
			$sql_edit  ="UPDATE tbl_bhi  ";
			$sql_edit .=" SET kode_perwakilan='$_POST[kode_perwakilan]', ";
			$sql_edit .="  bhi='$_POST[bhi]', ";
			$sql_edit .="  tgl_input='$_POST[tgl_input]' , ";	
			$sql_edit .="  alamat_ln='$_POST[alamat_ln]' , ";	
			$sql_edit .="  pemilik='$_POST[pemilik]' , ";	
			$sql_edit .="  no_tlp='$_POST[no_tlp]',  ";
  	        $sql_edit .="  thn_pendirian='$_POST[tahun]',  ";
            $sql_edit .="  jml_karjaya='$_POST[jml_karjaya]',  ";
            $sql_edit .="  jenis_bh='$_POST[jenis_bh]', ";
			$sql_edit .="  kode_kat_usaha='$_POST[kode_kat_usaha]' ";
            			 
			$sql_edit .="WHERE kode_bhi ='$_POST[kode_bhi]' ";
            
			$sqlresult4 = $db->Execute($sql_edit);
			
			
			
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
 
 
 $ip_now = $_SERVER['REMOTE_ADDR'];
$user_id = base64_decode($_SESSION['UID']);
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id )  VALUES ('$ip_now',now(),'Ubah data >> master BHI','$user_id') ";
 $db->Execute($sql2);
}


function create_(
                 $kode_bhi,
                 $kode_perwakilan, 
                 $bhi, 
                 $tgl_input, 
                 $alamat_ln, 
                 $pemilik, 
                 $no_tlp, 
                 $thn_pendirian, 
                 $jml_karjaya, 
                 $jenis_bh,
				 $kode_kat_usaha
                 ){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;
$sql	 = "INSERT INTO tbl_bhi (
                                 `kode_bhi`,
                                 `kode_perwakilan`,
                                 `bhi`,
                                 `tgl_input`,
                                 `alamat_ln`,
                                 `pemilik`,
                                 `no_tlp`,
                                 `thn_pendirian`,
                                 `jml_karjaya`,
                                 `jenis_bh`,
								 `kode_kat_usaha`) ";
$sql	.= " VALUES (
                     '".strip_tags($kode_bhi)."',
                     '".strip_tags($kode_perwakilan)."',
                     '".strip_tags($bhi)."',
                     '".strip_tags($tgl_input)."',
                     '".strip_tags($alamat_ln)."',
                     '".strip_tags($pemilik)."',
                     '".strip_tags($no_tlp)."',
                      '".$_POST['tahun']."',
                     '".strip_tags($jml_karjaya)."',
                     '".strip_tags($jenis_bh)."',
					 '".strip_tags($kode_kat_usaha)."')";

$sqlresult = $db->Execute($sql);

$ip_now = $_SERVER['REMOTE_ADDR'];
$user_id = base64_decode($_SESSION['UID']);
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id )  VALUES ('$ip_now',now(),'Tambah Data >> master BHI','$user_id') ";
 $db->Execute($sql2);
}

if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];


switch ($op){

case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
	  //  lockTables($tbl_name);
		create_($_POST['kode_bhi'], $_POST['kode_perwakilan'],$_POST['bhi'], $_POST['tgl_input'], $_POST['alamat_ln'], $_POST['pemilik'],$_POST['no_tlp'], $_POST['thn_pendirian'], $_POST['jml_karjaya'], $_POST['jenis_bh'], $_POST['kode_kat_usaha']);
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
