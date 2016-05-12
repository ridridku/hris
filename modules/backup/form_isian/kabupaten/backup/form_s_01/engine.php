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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_s_01';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_s_01';

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}

$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name_main	= "tbl_form_s_01_main";
$tbl_name_detail	= "tbl_form_s_01_detail";
$tmp_tbl_name_main	= "tmp_tbl_form_s_01_main";
$tmp_tbl_name_detail	= "tmp_tbl_form_s_01_detail";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $mod_id;
global $db;
global $_POST,$_GET;
global $tbl_name_main;
global $tbl_name_detail;

$sql  ="DELETE ";
$sql .="FROM ".$tbl_name_main." ";
$sql .="WHERE id_fs_01_main = '$id'";

$sqlresult = $db->Execute($sql);
//print $sql;
}

function edit_(){
global $mod_id;
global $db;
global $_POST,$_GET;
global $tbl_name_main;
global $tbl_name_detail;

$tgl = explode("-",$_POST["tanggal"],strlen($_POST["tanggal"])); // dd-mm-YYYY
$format_tgl = $tgl[2]."-".$tgl[1]."-".$tgl[0]; // YYYY-mm-dd

$sql = " UPDATE `tbl_form_s_01_main` SET `tanggal`=" .sqlvalue($format_tgl, true) .",
`no_propinsi`=" .sqlvalue(@$_POST["no_propinsi"], false) .", 
`no_kabupaten`=" .sqlvalue(@$_POST["no_kabupaten"], false) .", 
`no_ruas`=" .sqlvalue(@$_POST["no_ruas"], true) .", 
`nama_ruas_pangkal`=" .sqlvalue(@$_POST["nama_pangkal_ruas"], true) .", 
`nama_ruas_ujung`=" .sqlvalue(@$_POST["nama_ujung_ruas"], true) .", 
`titik_pengenal_ujung`=" .sqlvalue(@$_POST["titik_pengenal_ujung"], true) .", 
`titik_pengenal_pangkal`=" .sqlvalue(@$_POST["titik_pengenal_pangkal"], true) .", 
`disurvai`=" .sqlvalue(@$_POST["disurvai"], true) .", 
`tipe_kendaraan`=" .sqlvalue(@$_POST["tipe_kendaraan"], true) .", 
`fakt_penyesuaian_odometer`=" .sqlvalue(@$_POST["fakt_penyesuaian_odometer"], false) .", 
`km_odometer`=" .sqlvalue(@$_POST["km_odometer"], false) .", 
`km_ysd`=" .sqlvalue(@$_POST["km_ysd"], false) .",
`id_jns_jln`=" .sqlvalue(@$_POST['txt_hidden_jns_jln'], false) ." 
WHERE " ."(`id_fs_01_main`=" .sqlvalue(@$_POST["xid_s_01_main"], false) .")";
		
$sqlresult = $db->Execute($sql);
//print $sql."<br>";

$sql  ="DELETE ";
$sql .="FROM ".$tbl_name_detail." ";
$sql .="WHERE id_fs_01_main = '" .sqlvalue(@$_POST["xid_s_01_main"], false) ."'";

$sqlresult = $db->Execute($sql);
//print $sql."<br>";

$jum_rows = $_POST[jum_rows];

if ($jum_rows>=1) {
$sql = " INSERT INTO ".$tbl_name_detail." (`id_fs_01_main`, `km_odometer`, `km_ysd`, 
`tipe_permukaan_jalan`, `kondisi_permukaan_jalan`, `lebar_permukaan_jalan`, `drainase`, `kolom1`, `kolom2`, 
`kolom3`, `kolom4`, `kolom5`, `kolom6`,`penilaian`) VALUES ";

$arrItem = "";
$jum_rows =$jum_rows - 1; 
for ($i=0; $i <= $jum_rows; $i++)
		 {
		 $jml_penilaian = $_POST["drainase_".$i]+$_POST["kolom1_".$i]+$_POST["kolom2_".$i]+$_POST["kolom3_".$i]+$_POST["kolom4_".$i]+$_POST["kolom5_".$i]+$_POST["kolom6_".$i];
		$arrItem .= "(
" .sqlvalue(@$_POST["xid_s_01_main"], false) .", " .sqlvalue(@$_POST["km_odometer_".$i], false) .", 
" .sqlvalue(@$_POST["km_ysd_".$i], false) .", " .sqlvalue(@$_POST["tipe_permukaan_jalan_".$i], true) .", 
" .sqlvalue(@$_POST["kondisi_permukaan_jalan_".$i], true) .", " .sqlvalue(@$_POST["lebar_permukaan_jalan_".$i], false) .", 
" .sqlvalue(@$_POST["drainase_".$i], false) .", " .sqlvalue(@$_POST["kolom1_".$i], false) .", 
" .sqlvalue(@$_POST["kolom2_".$i], false) .", " .sqlvalue(@$_POST["kolom3_".$i], false) .", 
" .sqlvalue(@$_POST["kolom4_".$i], false) .", " .sqlvalue(@$_POST["kolom5_".$i], false) .", 
" .sqlvalue(@$_POST["kolom6_".$i], false) .", " .sqlvalue($jml_penilaian, false) ."),";
		}
		
		$sqlItem = substr($sql.$arrItem,0,-1);
		
$sqlresult = $db->Execute($sqlItem);  
//print $sqlItem;
}
}

function create_(){
global $mod_id;
global $db;
global $_POST, $_GET;
global $tbl_name_main;
global $tbl_name_detail;	

$tgl = explode("-",$_POST["tanggal"],strlen($_POST["tanggal"])); // dd-mm-YYYY
$format_tgl = $tgl[2]."-".$tgl[1]."-".$tgl[0]; // YYYY-mm-dd

$sql_ = " INSERT INTO `".$tbl_name_main."` (`tanggal`, `no_propinsi`, `no_kabupaten`, `no_ruas`, `nama_ruas_pangkal`, 
`nama_ruas_ujung`, `titik_pengenal_ujung`, `titik_pengenal_pangkal`, `disurvai`, `tipe_kendaraan`, 
`fakt_penyesuaian_odometer`, `km_odometer`, `km_ysd`, `id_jns_jln`) VALUES 
(" .sqlvalue($format_tgl, true) .", " .sqlvalue(@$_POST["no_propinsi"], false) .", 
" .sqlvalue(@$_POST["no_kabupaten"], false) .", " .sqlvalue(@$_POST["no_ruas"], true) .", 
" .sqlvalue(@$_POST["nama_pangkal_ruas"], true) .", " .sqlvalue(@$_POST["nama_ujung_ruas"], true) .", 
" .sqlvalue(@$_POST["titik_pengenal_ujung"], true) .", " .sqlvalue(@$_POST["titik_pengenal_pangkal"], true) .", 
" .sqlvalue(@$_POST["disurvai"], true) .", " .sqlvalue(@$_POST["tipe_kendaraan"], true) .", 
" .sqlvalue(@$_POST["fakt_penyesuaian_odometer"], false) .", " .sqlvalue(@$_POST["km_odometer"], false) .", 
" .sqlvalue(@$_POST["km_ysd"], false) .", 
" .sqlvalue(@$_POST["txt_hidden_jns_jln"], false) ." )";

$sqlresult = $db->Execute($sql_);
$_id_main = $db->Insert_ID();
//print $sql_."<br>";

$jum_rows = $_POST[jum_rows];

$sql = " INSERT INTO ".$tbl_name_detail." (`id_fs_01_main`, `km_odometer`, `km_ysd`, 
`tipe_permukaan_jalan`, `kondisi_permukaan_jalan`, `lebar_permukaan_jalan`, `drainase`, `kolom1`, `kolom2`, 
`kolom3`, `kolom4`, `kolom5`, `kolom6`,`penilaian`) VALUES ";

$arrItem = "";
$jum_rows =$jum_rows - 1; 
for ($i=0; $i <= $jum_rows; $i++)
		 {
		 $jml_penilaian = $_POST["drainase_".$i]+$_POST["kolom1_".$i]+$_POST["kolom2_".$i]+$_POST["kolom3_".$i]+$_POST["kolom4_".$i]+$_POST["kolom5_".$i]+$_POST["kolom6_".$i];
		$arrItem .= "(
".$_id_main.", " .sqlvalue(@$_POST["km_odometer_".$i], false) .", 
" .sqlvalue(@$_POST["km_ysd_".$i], false) .", " .sqlvalue(@$_POST["tipe_permukaan_jalan_".$i], true) .", 
" .sqlvalue(@$_POST["kondisi_permukaan_jalan_".$i], true) .", " .sqlvalue(@$_POST["lebar_permukaan_jalan_".$i], false) .", 
" .sqlvalue(@$_POST["drainase_".$i], false) .", " .sqlvalue(@$_POST["kolom1_".$i], false) .", 
" .sqlvalue(@$_POST["kolom2_".$i], false) .", " .sqlvalue(@$_POST["kolom3_".$i], false) .", 
" .sqlvalue(@$_POST["kolom4_".$i], false) .", " .sqlvalue(@$_POST["kolom5_".$i], false) .", 
" .sqlvalue(@$_POST["kolom6_".$i], false) .", " .sqlvalue($jml_penilaian, false) ."),";					

		}		
		$sqlItem = substr($sql.$arrItem,0,-1);
		
$sqlresult = $db->Execute($sqlItem);  
//print $sqlItem."<br>";
}

/*** 20-08-2010 ***/
function import_() {
	global $mod_id;
	global $db;
	
	global $DB_TYPE;
	global $DB_NAME;
	global $_POST, $_GET;
	global $tbl_name_main;
	global $tbl_name_detail;	
	
	global $tmp_tbl_name_main;
	global $tmp_tbl_name_detail;
	$tb_import = &ADONewConnection($DB_TYPE);
	
	//$db->debug = true;
	$tb_import->Connect($_POST['hostname1'], $_POST['username1'], $_POST['password1'], $DB_NAME);
	//------------------------------------LOCAL CONFIG--------------------------------------//

	$get_sql		= " SELECT * FROM `".$tmp_tbl_name_main."` ORDER BY id_fs_01_main ASC ";
	//print $get_sql;
	$get_recordSet 	= $tb_import->Execute($get_sql);
	$count = $get_recordSet->RecordCount();

	$z=1;
	while ($arr=$get_recordSet->FetchRow()) {
		$sql_insert = " INSERT INTO `".$tbl_name_main."` (`tanggal`, `no_propinsi`, `no_kabupaten`, `no_ruas`, `nama_ruas_pangkal`, `nama_ruas_ujung`, `titik_pengenal_ujung`, `titik_pengenal_pangkal`, `disurvai`, `tipe_kendaraan`, `fakt_penyesuaian_odometer`, `km_odometer`, `km_ysd`, `id_jns_jln`) 
				VALUES (".sqlvalue(@$arr["tanggal"], true).", 
				".sqlvalue(@$arr["no_propinsi"], false).", 
				".sqlvalue(@$arr["no_kabupaten"], false).", 
				".sqlvalue(@$arr["no_ruas"], true).",
				".sqlvalue(@$arr["nama_ruas_pangkal"], true).",
				".sqlvalue(@$arr["nama_ruas_ujung"], true).",
				".sqlvalue(@$arr["titik_pengenal_ujung"], true).",
				".sqlvalue(@$arr["titik_pengenal_pangkal"], true).",
				".sqlvalue(@$arr["disurvai"], true).",
				".sqlvalue(@$arr["tipe_kendaraan"], true).",
				".sqlvalue(@$arr["fakt_penyesuaian_odometer"], true).",
				".sqlvalue(@$arr["km_odometer"], true).",
				".sqlvalue(@$arr["km_ysd"], true).",
				".sqlvalue(@$arr["id_jns_jln"], true).")";
		$sql_exec = $tb_import->Execute($sql_insert);
		
		$sql_detail	=  " SELECT * FROM `".$tmp_tbl_name_detail."` WHERE id_fs_01_main='$arr[id_fs_01_main]' ";
		$get_recordSet2	= $tb_import->Execute($sql_detail);
		if($get_recordSet2->RecordCount()>0) {
			while ($arr2=$get_recordSet2->FetchRow()) {
				$sql_insert2 = " INSERT INTO `".$tbl_name_detail."` (`id_fs_01_main`,`km_odometer`,`km_ysd`,`tipe_permukaan_jalan`,`kondisi_permukaan_jalan`,`lebar_permukaan_jalan`,`drainase`,`kolom1`,`kolom2`,`kolom3`,`kolom4`,`kolom5`,`kolom6`,`penilaian`) VALUES (
					(SELECT MAX(id_fs_01_main) FROM ".$tbl_name_main."), 
					" .sqlvalue(@$get_recordSet2->fields["km_odometer"], true) .", 
					" .sqlvalue(@$get_recordSet2->fields["km_ysd"], true) .", 
					" .sqlvalue(@$get_recordSet2->fields["tipe_permukaan_jalan"], false) .", 
					" .sqlvalue(@$get_recordSet2->fields["kondisi_permukaan_jalan"], false) .", 
					" .sqlvalue(@$get_recordSet2->fields["lebar_permukaan_jalan"], false) .", 
					" .sqlvalue(@$get_recordSet2->fields["drainase"], false) .", 
					" .sqlvalue(@$get_recordSet2->fields["kolom1"], false) .", 
					" .sqlvalue(@$get_recordSet2->fields["kolom2"], false) .", 
					" .sqlvalue(@$get_recordSet2->fields["kolom3"], false) .", 
					" .sqlvalue(@$get_recordSet2->fields["kolom4"], false) .", 
					" .sqlvalue(@$get_recordSet2->fields["kolom5"], false) .", 
					" .sqlvalue(@$get_recordSet2->fields["kolom6"], false) .", 					
					" .sqlvalue(@$get_recordSet2->fields["penilaian"], true) .") ";
					
				$sql_exec2 = $tb_import->Execute($sql_insert2);
				$sql_del = "DELETE FROM `".$tmp_tbl_name_detail."` WHERE id_fs_01_detail='{$get_recordSet2->fields[id_fs_01_detail]}' ";
				$sql_exec3 = $tb_import->Execute($sql_del);
			}
		}	
		//if($sql_exec){
			$sql_del2 = "DELETE FROM `".$tmp_tbl_name_main."` WHERE id_fs_01_main='$arr[id_fs_01_main]' ";
			$sql_exec4 = $tb_import->Execute($sql_del2);
		//}
		$z++;
	}	
}
/*** End 0f Date ***/

if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];

switch ($op){
case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
		//lockTables($tbl_name_main);
		//lockTables($tbl_name_detail);
		create_();		
		//unlockTables($tbl_name_main);	
		//unlockTables($tbl_name_detail);	
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST["txt_hidden_jns_jln"]);
	}
break;
case 1:
	if(Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_();
		//unlockTables($tbl_name);
			
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[txt_hidden_jns_jln]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		lockTables($tbl_name_main);
		delete_($_GET['id_fs_01_main']);
		unlockTables($tbl_name_main);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&no_kabupaten=".$_GET[no_kabupaten]."&Search_Year=".$_GET[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_GET['jns_jln']."&txt_hidden_jns_jln=".$_GET[txt_hidden_jns_jln]);
	}
break;
}
}
?>