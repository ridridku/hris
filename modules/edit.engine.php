<?php

# Including Main Configuration
# including file for Main Configurations
require_once('../includes/config.conf.php');	 	


# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
		require_once('../includes/header.redirect.inc');
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

$db = &ADONewConnection($DB_TYPE);
//  $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
//------------------------------------LOCAL CONFIG--------------------------------------//

#IMAGES
$DIR_IMAGES = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images');

#SETTING FOR TEMPLATE 
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/administrasi_sistem');
$FILE_JS  = $JS_MODUL.'/daftar_user';


#Initiate TABLE
$tbl_name	= "tbl_sys_master_user";
$field_name	= "user";


//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $db;
global $tbl_name;
global $field_name;
$sql  ="DELETE ";
$sql .="FROM ".$tbl_name." ";
$sql .="WHERE ".$field_name."_id = '$id' ";
$sqlresult = $db->Execute($sql);
}

function edit_($first_name, $last_name, $address, $telp, $gender, $email, $id){
global $db;
global $tbl_name;
global $field_name;


$password = base64_encode($_POST['password']);


$sql  ="UPDATE ".$tbl_name." ";
$sql .="SET ".$field_name."_first_name='".strip_tags(strtoupper($first_name))."',".$field_name."_last_name='".strip_tags(strtoupper($last_name))."',".$field_name."_address='".strip_tags($address)."',".$field_name."_telp='".strip_tags($telp)."',".$field_name."_gender='".strip_tags($gender)."', ".$field_name."_email='".$email."',user_password='$password' ";
$sql .="WHERE ".$field_name."_id = '".strip_tags($id)."' ";
$sqlresult = $db->Execute($sql);
}

function create_($first_name, $last_name, $address, $telp, $gender, $email, $id, $password, $status){
global $db;
global $tbl_name;
global $field_name;

$date_join = strtotime('now');

$sql	 = "INSERT INTO ".$tbl_name." ";
$sql	.= "(user_id, user_password, user_first_name, user_last_name, user_date_join, user_address, user_telp, user_gender, user_email, user_active_status) ";
$sql	.= "VALUES ('".strip_tags($id)."','".strip_tags(base64_encode($password))."', '".strip_tags(strtoupper($first_name))."','".strip_tags(strtoupper($last_name))."', '".strip_tags($date_join)."', '".strip_tags($address)."', '".strip_tags($telp)."', '".strip_tags($gender)."','".$email."', '".$status."')";
$sqlresult = $db->Execute($sql);

}


if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];

switch ($op){

case 0:
	create_($_POST[$field_name.'_first_name'], $_POST[$field_name.'_last_name'], $_POST[$field_name.'_address'], $_POST[$field_name.'_telp'], $_POST[$field_name.'_gender'], $_POST[$field_name.'_email'], $_POST[$field_name.'_id'], $_POST[$field_name.'_password'], $_POST[$field_name.'_status']);

break;
case 1:
	edit_($_POST[$field_name.'_first_name'], $_POST[$field_name.'_last_name'], $_POST[$field_name.'_address'], $_POST[$field_name.'_telp'], $_POST[$field_name.'_gender'], $_POST[$field_name.'_email'], $_POST[$field_name.'_id']);
break;
case 2:
	delete_($_GET[$field_name.'_id']);
break;
}

$user_id = $_POST['user_id'];

	Header("Location:edit.profile.php?user_id=$user_id");

}
?>
