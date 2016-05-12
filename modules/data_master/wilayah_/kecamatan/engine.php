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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_master/wilayah/kecamatan';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_master');
$FILE_JS  = $JS_MODUL.'/wilayah/kecamatan';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "tbl_mast_wil_kecamatan";

//$no_propz	= $_POST['no_prop'] && !empty($_POST['no_prop']) ? $_POST['no_prop']:$_GET['no_prop'];
//$no_kabz	= $_POST['no_kab'] && !empty($_POST['no_kab']) ? $_POST['no_kab']:$_GET['no_kab'];

# Update
//$id_kecamatan	= $_POST['id_kecamatan'] ?$_POST['id_kecamatan']:$_GET['id_kecamatan'];
//$no_kecamatan	= $_POST['no_kecamatan']?$_POST['no_kecamatan']:$_GET['no_kecamatan'];
//$nama_kecamatan = $_POST['nama_kecamatan']?$_POST['nama_kecamatan']:$_GET['nama_kecamatan'];

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($no_prop,$no_kab,$id_kec){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM tbl_mast_wil_kecamatan ";
$sql .="WHERE no_propinsi = '$no_prop' AND no_kabupaten = '$no_kab' AND id_kecamatan = '$id_kec'";

$sqlresult = $db->Execute($sql);
}

function edit_($id_kecamatan,$no_propinsi,$no_kabupaten,$no_kecamatan,$nama_kecamatan){

global $_POST, $_GET, $_SERVER;

global $mod_id;
global $db;

$sql  ="UPDATE tbl_mast_wil_kecamatan ";
$sql .="SET no_propinsi='".strip_tags($no_propinsi)."', ";
//$sql .="id_kecamatan='".strip_tags($id_kecamatan)."', ";
$sql .="no_kabupaten='".strip_tags($no_kabupaten)."', ";
$sql .="no_kecamatan='".strip_tags($no_kecamatan)."', ";
$sql .="nama_kecamatan='".strip_tags($nama_kecamatan)."' ";
$sql .="WHERE id_kecamatan = '$id_kecamatan'";

$sqlresult = $db->Execute($sql);

//print $sql."<br>";
//print $no_propinsi."-".$id_kecamatan."-".$no_kabupaten."-".$no_kecamatan."-".$nama_kecamatan;
}

//function create_($id_kac,$no_prop,$no_kab,$no_kec,$nama_kecamatan) {
//function create_($no_prop,$no_kab,$no_kec,$nama_kecamatan) {
function create_($propinsi,$kabupaten,$nomor_kec,$nm_kec) {
global $_POST, $_GET;
global $mod_id;	
global $db;

/*$sql_id_kab = "SELECT max(id_kabupaten)+1 as id_kab FROM tbl_mast_wil_kecamatan WHERE no_propinsi=$no_prop";
$result_id_kab = $db->execute($sql_id_kab);
$id_kab = $result_id_kab->fields[id_kab];*/

$sql	 = "INSERT INTO tbl_mast_wil_kecamatan (id_kecamatan, no_propinsi, no_kabupaten, no_kecamatan, nama_kecamatan) ";
$sql	.= "VALUES ('NULL','".$propinsi."','".$kabupaten."','".strip_tags($nomor_kec)."','".strip_tags($nm_kec)."')";

$sqlresult = $db->Execute($sql);
}

if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];


switch ($op){

case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
		lockTables($tbl_name);
		
		//create_($id_kecamatan2, $no_prop2, $no_kab2, $no_kecamatan2, $nama_kecamatan2);
		//create_($_POST['no_prop2'], $_POST['no_kab2'], $_POST['no_kecamatan2'], $_POST['nama_kecamatan2']);
		//create_();
		create_($_POST['no_prop'],$_POST['no_kab'],$_POST['no_kecamatan'],$_POST['nama_kecamatan']);
		
		unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		lockTables($tbl_name);
		edit_($_POST['id_kecamatan'],$_POST['no_prop'],$_POST['no_kab'],$_POST['no_kecamatan'],$_POST['nama_kecamatan']);
		//edit_($id_kecamatan,$no_propinsi,$no_kabupaten,$no_kecamatan,$nama_kecamatan)
		
		unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		lockTables($tbl_name);
		delete_($_GET['no_propinsi'],$_GET['no_kabupaten'],$_GET['id_kecamatan']);
		unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
}
}
?>