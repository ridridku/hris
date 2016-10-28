<?php

# Including Main Configuration
# including file for Main Configurations
require_once('../../../includes/config.conf.php');	 	


# Create a session to store global config path
session_save_path($DIR_SESS);
//$expiry = 60*120;
session_set_cookie_params($expiry);
session_start();

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
		require_once('../../../includes/header.redirect.inc');
}else{

//yang harus dibuat session
$THEME = base64_encode("default");
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

#IMAGES
$DIR_IMAGES = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images');

#SETTING FOR TEMPLATE 
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/administrasi_sistem/daftar_user';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/administrasi_sistem');
$FILE_JS  = $JS_MODUL.'/daftar_user';


#Initiate TABLE
$tbl_name	= "tbl_sys_master_user";
//$field_name	= "USER";


//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $db;
global $tbl_name;
global $field_name;
$sql  ="DELETE ";
$sql .="FROM ".$tbl_name." ";
$sql .="WHERE user_id = '$id' ";
$sqlresult = $db->Execute($sql);




}

//function edit_($first_name, $last_name, $address, $telp, $gender, $email, $id, $password, $status, $level, $no_propinsi, $no_kabupaten){
function edit_($user_id,$first_name, $last_name,$id_pegawai, $address, $telp, $gender, $email, $id, $password, $user_status, $jns_user,$kode_cabang,$group_user){

global $db;
global $tbl_name;
global $field_name;

$nama =$_POST[user_first_name];
 $nama_ = explode(' ', $nama);
                                $nama1 = $nama_[0];
                                $nama2= $nama_[1];
                                $nama3= $nama_[2];
$sql  ="UPDATE ".$tbl_name." ";
$sql .="SET user_first_name='".strip_tags(strtoupper($nama1))."',"
        . "user_last_name='".strip_tags(strtoupper($nama2))."',"
        . "id_pegawai='$_POST[id_pegawai]',"
        . "user_date_join=now(),"
        . "user_address='".strip_tags($_POST[user_address])."',"
        . "user_telp='$_POST[user_telp]',"
        . "user_gender='".strip_tags($_POST[user_gender])."', "
        . "user_email='$_POST[user_email]',"
        . "user_password='".strip_tags(base64_encode($_POST[user_password]))."',"
        . "user_active_status='$_POST[user_status]',"
        . "level ='$_POST[jns_user]',"
        . "kode_cabang ='$_POST[kode_cabang]',"
        . "group_user ='$_POST[group_user]'";
$sql .=" WHERE user_id = '$_POST[user_id]' ";

$sqlresult = $db->Execute($sql);



}

//function create_($first_name, $last_name, $address, $telp, $gender, $email, $id, $password, $status, $level )
function create_($user_id,$first_name, $last_name,$id_pegawai, $address, $telp, $gender, $email, $id, $password, $user_status, $jns_user,$kode_cabang,$group_user )
 {
global $db;
global $tbl_name;
global $field_name;

$nama =$_POST[user_first_name];
 $nama_ = explode(' ', $nama);
                                $nama1 = $nama_[0];
                                $nama2= $nama_[1];
                                $nama3= $nama_[2];


$sql	 = "INSERT INTO ".$tbl_name." ";
$sql	.= "(user_id, user_password, user_first_name, user_last_name, id_pegawai,user_date_join, user_address, user_telp, user_gender, user_email, user_active_status, level,user_current_login_date,user_current_login_host,kode_cabang,group_user) ";
$sql	.= "VALUES ('$_POST[user_id]',"
        . "'".strip_tags(base64_encode($_POST[user_password]))."',"
        . " '".strip_tags(strtoupper($nama1))."',"
        . "'".strip_tags(strtoupper($nama2))."',"
        . "'$_POST[id_pegawai]', "
        . "now(), "
        . "'$_POST[user_address]',"
        . " '$_POST[user_telp]', "
        . "'$_POST[user_gender]',"
        . "'$_POST[user_email]', "
        . "'$_POST[user_status]',"
        . "'$_POST[jns_user]',"
        . " now(),"
         . " now(),"
        . "'$_POST[kode_cabang]',"
        . "'$_POST[group_user]')";

//var_dump($sql)or die();
$sqlresult = $db->Execute($sql);

 $ip_now = $_SERVER['REMOTE_ADDR'];
 $user_id = base64_decode($_SESSION['UID']);
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id )  VALUES ('$ip_now',now(),'Simpan data >> User','$user_id') ";
 $db->Execute($sql2);



}


if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];

lockTables($tbl_name);

switch ($op){

case 0:
	create_($_POST['user_first_name'], $_POST['user_last_name'], $_POST['user_address'], $_POST['user_telp'], $_POST['user_gender'], $_POST['user_email'], $_POST['user_id'], $_POST['user_password'], $_POST['user_status'], $_POST['jns_jln'], $_POST['no_propinsi'], $_POST['no_kabupaten']);

break;
case 1:
	edit_($_POST['user_first_name'], $_POST['user_last_name'], $_POST['user_address'], $_POST['user_telp'], $_POST['user_gender'], $_POST['user_email'], $_POST['user_id'], $_POST['user_password'], $_POST['user_status'], $_POST['jns_jln'], $_POST['no_propinsi'], $_POST['no_kabupaten']);
break;
case 2:
	delete_($_GET['user_id']);
break;
}

unlockTables($tbl_name);
	Header("Location:index.php?limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]."&no_propinsi=".$_POST['no_propinsi']."&no_kabupaten=".$_POST['no_kabupaten']);

}
?>
