<?php

# Including Main Configuration
# including file for Main Configurations
require_once('../../../includes/config.conf.php');	 	


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
 $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
//------------------------------------LOCAL CONFIG--------------------------------------//
#SETTING FOR TEMPLATE 
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_wni/wni';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_wni');
$FILE_JS  = $JS_MODUL.'/wni';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "tbl_wni";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM tbl_wni ";
$sql .="WHERE  id= '$_GET[id]' ";

$sqlresult = $db->Execute($sql);
}

function edit_(){
global $mod_id;
global $db;

$sql_cek="select * from tbl_wni where kode_wni='$_POST[kode_wni]' and id !='$_POST[id]' ";
 $rs_val = $db->Execute($sql_cek);
 $kode_wni = $rs_val->fields['kode_wni'];

		if ($kode_wni!='') {
		 
				Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);

		} else { 

   
			$sql_edit  ="UPDATE tbl_wni  ";
			$sql_edit .="  SET kode_wni='$_POST[kode_wni]', ";
			$sql_edit .="  kode_perwakilan='$_POST[kode_perwakilan]' , ";
			$sql_edit .="  nama='$_POST[nama]' , ";	
			$sql_edit .="  kode_agama='$_POST[kode_agama]' , ";	
			$sql_edit .="  tgl_lahir='$_POST[tanggal]' , ";	
			$sql_edit .="  kode_jenis='$_POST[kode_jenis_wni]' , ";
			$sql_edit .="  no_propinsi='$_POST[no_propinsi]' , ";
			$sql_edit .="  id_kabupaten='$_POST[id_kab]' , ";
			$sql_edit .="  alamat='$_POST[alamat]' , ";	
			$sql_edit .="  jk='$_POST[jk]' , ";	
			$sql_edit .="  no_paspor='$_POST[no_paspor]', ";
			$sql_edit .="  tlp='$_POST[tlp]' , ";
			$sql_edit .="  alamat_ln='$_POST[alamat_ln]' , ";	
			$sql_edit .="  tlp_ln='$_POST[tlp_ln]' , ";
			$sql_edit .="WHERE id ='$_POST[id]' , ";
						
			$sqlresult4 = $db->Execute($sql_edit);
print $sql_edit
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}
}

function create_(){
global $mod_id;	
global $db;
 
 $sql_cek="select * from tbl_wni where kode_wni='$_POST[kode_wni]'";
 $rs_val = $db->Execute($sql_cek);
 $kode_wni = $rs_val->fields['kode_wni'];

		if ($kode_wni!='') {		 
				Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		} else { 
			$sql="insert into tbl_wni(kode_wni, kode_perwakilan,nama,kode_agama,tgl_lahir,kode_jenis,kode_sumber,id_kabupaten,alamat,jk,no_paspor,tanggal,tlp,alamat_ln,tlp_ln) values ('$_POST[kode_wni]','$_POST[kode_perwakilan]','$_POST[nama]','$_POST[kode_agama]','$_POST[tanggal]','$_POST[kode_jenis_wni]','1','$_POST[id_kab]','$_POST[alamat]','$_POST[jk]','$_POST[no_paspor]',CURDATE(),'$_POST[tlp]','$_POST[alamat_ln]','$_POST[tlp_ln]')";			 
			$sqlresult = $db->Execute($sql);
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}

 }

if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];


switch ($op){

case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
	//	lockTables($tbl_name);
		// create_($no_propinsi,$no_kab,$no_kec,$no_kel,$nama_kelurahan)
		create_();
		//unlockTables($tbl_name);		
		
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
