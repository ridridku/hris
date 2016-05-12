<?php

# Including Main Configuration
# including file for Main Configurations
require_once('../../../../includes/config.conf.php');	 	
require_once('../../../../includes/funct.php');

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/monitoring/kabupaten/pelaporan';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/monitoring');
$FILE_JS  = $JS_MODUL.'/kabupaten/pelaporan';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name_main	= "tbl_monitor_jl_main";
$tbl_name_detail	= "tbl_monitoring_jl_detail";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;

$sql  ="DELETE ";
$sql .="FROM ".$tbl_name_main." ";
$sql .="WHERE id_main = '$id'";

$sqlresult = $db->Execute($sql);
}

function edit_(){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;

$sql = " UPDATE `".$tbl_name_main."` SET `tahun`=" .sqlvalue(@$_POST["tahun"], true) .", 
		`no_propinsi`=" .sqlvalue(@$_POST["no_propinsi"], false) .", 
		`monitoring`=" .sqlvalue(@$_POST["monitoring"], true) .",
		`id_jns_jln`=" .sqlvalue(@$_POST["jns_jln"], true) ."
		WHERE " ."(`id_main`=" .sqlvalue(@$_POST["xid_main"], false) .")";
		
$sqlresult = $db->Execute($sql);

$sql  ="DELETE ";
$sql .="FROM `".$tbl_name_detail."` ";
$sql .="WHERE id_main = '".sqlvalue(@$_POST["xid_main"], false) ."'";

$sqlresult = $db->Execute($sql);
//print $sql."<br>";

$sql = " INSERT INTO `".$tbl_name_detail."` (`id_main`, `no_kabupaten`, `jl_01`, `jl_02`, `jl_03`, `jl_04`, 
		`jl_05a`, `jl_05b`, `jl_05c`, `jl_05d`, `jl_06a`, `jl_06b`, `jl_06c`, `jl_06d`, `jl_07a`, `jl_07b`, `jl_07c`, 
		`jl_07d`, `jl_08`, `jl_09`, `jl_10`) VALUES ";

$data_query = "";		
for($i=0;$i<$_POST['jml_kab'];$i++) {
$data_query .="((SELECT MAX(id_main) FROM ".$tbl_name_main."), " .sqlvalue(@$_POST["no_kab_".$i], false) .", 
		" .sqlvalue(@$_POST["kol_1_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_2_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_3_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_4_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_5a_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_5b_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_5c_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_5d_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_6a_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_6b_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_6c_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_6d_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_7a_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_7b_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_7c_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_7d_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_8_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_9_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_10_".$i], true) ."),";		
}
$sqlresult = $db->Execute($sql.substr($data_query,0,-1));  
//print $sql.substr($data_query,0,-1);
}

function create_(){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;	

$sql = " INSERT INTO `".$tbl_name_main."` (`tahun`, `no_propinsi`, `monitoring`,`id_jns_jln`) VALUES 
		(" .sqlvalue(@$_POST["tahun"], true) .", 
		" .sqlvalue(@$_POST["no_propinsi"], false) .", 
		" .sqlvalue(@$_POST["monitoring"], true) .",
		" .sqlvalue(@$_POST["jns_jln"], true) .")";

$sqlresult = $db->Execute($sql);
//print $sql."<br>";

$sql = " INSERT INTO `".$tbl_name_detail."` (`id_main`, `no_kabupaten`, `jl_01`, `jl_02`, `jl_03`, `jl_04`, 
		`jl_05a`, `jl_05b`, `jl_05c`, `jl_05d`, `jl_06a`, `jl_06b`, `jl_06c`, `jl_06d`, `jl_07a`, `jl_07b`, `jl_07c`, 
		`jl_07d`, `jl_08`, `jl_09`, `jl_10`) VALUES ";

$data_query = "";		
for($i=0;$i<$_POST['jml_kab'];$i++) {
$data_query .="(LAST_INSERT_ID(), 
		" .sqlvalue(@$_POST["no_kab_".$i], false) .", 
		" .sqlvalue(@$_POST["kol_1_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_2_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_3_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_4_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_5a_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_5b_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_5c_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_5d_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_6a_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_6b_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_6c_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_6d_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_7a_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_7b_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_7c_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_7d_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_8_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_9_".$i], true) .", 
		" .sqlvalue(@$_POST["kol_10_".$i], true) ."),";		
}
$sqlresult = $db->Execute($sql.substr($data_query,0,-1));  
//print $sql.substr($data_query,0,-1);
}


if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];
if($_POST[jns_jln]) $jns_jln = $_POST[jns_jln]; else $jns_jln = $_GET[jns_jln];

switch ($op){
case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
		//lockTables($tbl_name_main);
		//lockTables($tbl_name_detail);
		create_();		
		//unlockTables($tbl_name_main);	
		//unlockTables($tbl_name_detail);	
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&Date_Year=".$_POST[tahun]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$jns_jln);
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_();
		//unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&Date_Year=".$_POST[tahun]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$jns_jln);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		lockTables($tbl_name_main);
		delete_($_GET['id_fjl_01_main']);
		unlockTables($tbl_name_main);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&Date_Year=".$_GET[tahun]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$jns_jln);
	}
break;
}
}
?>
