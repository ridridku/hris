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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_jl_04';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_jl_04';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name_main		= "tbl_form_jl_04_main";
$tbl_name_detail	= "tbl_form_jl_04_detail";
$tmp_tbl_name_main	= "tmp_tbl_form_jl_04_main";
$tmp_tbl_name_detail= "tmp_tbl_form_jl_04_detail";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $mod_id;
global $db;
global $_POST,$_GET;
global $tbl_name_main;
global $tbl_name_detail;

$sql  ="DELETE ";
$sql .="FROM ".$tbl_name_main." ";
$sql .="WHERE id_fjl_04_main = '$id'";

$sqlresult = $db->Execute($sql);
}

function edit_(){
global $mod_id;
global $db;
global $_POST,$_GET;
global $tbl_name_main;
global $tbl_name_detail;

$tgl = explode("-",$_POST["tanggal"],strlen($_POST["tanggal"])); // dd-mm-YYYY
$format_tgl = $tgl[2]."-".$tgl[1]."-".$tgl[0]; // YYYY-mm-dd

$sql = " UPDATE `tbl_form_jl_04_main` SET `tanggal`=".sqlvalue($format_tgl, true) .", `no_propinsi`=".sqlvalue(@$_POST["no_propinsi"], false).", 
`no_kabupaten`=".sqlvalue(@$_POST["no_kabupaten"], false).", `apbd`=".sqlvalue(@$_POST["apbd"], true).", 
`thn_anggaran`=".sqlvalue(@$_POST["thn_anggaran"], true).",
`id_jns_jln`=".sqlvalue(@$_POST["jns_jln"], true)." 
WHERE " ."(`id_fjl_04_main`=".sqlvalue(@$_POST["xid_fjl_04_main"], false).")";

$sqlresult = $db->Execute($sql);
$db->Execute("DELETE FROM tbl_form_jl_04_detail WHERE id_fjl_04_main=".sqlvalue(@$_POST["xid_fjl_04_main"], false) ."");
//print $sql."<br>";

$last_id = sqlvalue(@$_POST["xid_fjl_04_main"], false);

/*** Disabled 19-08-2010
$sql_program_penanganan = "SELECT id_program_penanganan FROM tbl_mast_program_penanganan WHERE sub_kategori<>'0' ORDER BY id_program_penanganan ASC";
***/

$sql_program_penanganan = "SELECT id_program_penanganan FROM tbl_mast_program_penanganan WHERE sub_kategori<>'0' AND status<>'0' ORDER BY id_program_penanganan ASC";

$recordSet_Program = $db->execute($sql_program_penanganan);

$que_value = "";
while(!$recordSet_Program->EOF) {
	$que_value.="(".$last_id.",";
	$que_value.=$recordSet_Program->fields[id_program_penanganan].",";
	$que_value.=sqlvalue(@$_POST["th1_apbd_target_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th1_apbd_biaya_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_apbd_target_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_apbd_biaya_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_dak_target_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_dak_biaya_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_sektor_target_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_sektor_biaya_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_pinjaman_target_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_pinjaman_biaya_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_total_target_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_total_biaya_".$recordSet_Program->fields[id_program_penanganan]], false)."),";
	$recordSet_Program->MoveNext();
}

$sql_detail_ =" INSERT INTO `tbl_form_jl_04_detail` (`id_fjl_04_main`, `id_program_penanganan`, `apbd_target`, `apbd_biaya`, `apbd_jalan_target`, `apbd_jalan_biaya`, `dak_target`, `dak_biaya`, `sektor_target`, `sektor_biaya`, `pinjaman_target`, `pinjaman_biaya`,`total_target`,`total_biaya`) 
VALUES ".substr($que_value,0,-1);
$sqlresult = $db->Execute($sql_detail_);  
//print $sql_detail_;

/*$last_id = sqlvalue(@$_POST["xid_fjl_04_main"], false);

$sql_program_penanganan = "SELECT id_program_penanganan FROM tbl_mast_program_penanganan WHERE sub_kategori<>'0' ORDER BY id_program_penanganan ASC";
$recordSet_Program = $db->execute($sql_program_penanganan);

$que_value = "";
while(!$recordSet_Program->EOF) {
	$que_value.="(".$last_id.",";
	$que_value.=$recordSet_Program->fields[id_program_penanganan].",";
	$que_value.=$_POST["th1_apbd_target_".$recordSet_Program->fields[id_program_penanganan]].",";
	$que_value.=$_POST["th1_apbd_biaya_".$recordSet_Program->fields[id_program_penanganan]].",";
	$que_value.=$_POST["th2_apbd_target_".$recordSet_Program->fields[id_program_penanganan]].",";
	$que_value.=$_POST["th2_apbd_biaya_".$recordSet_Program->fields[id_program_penanganan]].",";
	$que_value.=$_POST["th2_dak_target_".$recordSet_Program->fields[id_program_penanganan]].",";
	$que_value.=$_POST["th2_dak_biaya_".$recordSet_Program->fields[id_program_penanganan]].",";
	$que_value.=$_POST["th2_sektor_target_".$recordSet_Program->fields[id_program_penanganan]].",";
	$que_value.=$_POST["th2_sektor_biaya_".$recordSet_Program->fields[id_program_penanganan]].",";
	$que_value.=$_POST["th2_pinjaman_target_".$recordSet_Program->fields[id_program_penanganan]].",";
	$que_value.=$_POST["th2_pinjaman_biaya_".$recordSet_Program->fields[id_program_penanganan]].",";
	$que_value.=$_POST["th2_total_target_".$recordSet_Program->fields[id_program_penanganan]].",";
	$que_value.=$_POST["th2_total_biaya_".$recordSet_Program->fields[id_program_penanganan]]."),";
	$recordSet_Program->MoveNext();
}

$sql_detail_ ="insert into `tbl_form_jl_04_detail` (`id_fjl_04_main`, `id_program_penanganan`, `apbd_target`, `apbd_biaya`, `apbd_jalan_target`, `apbd_jalan_biaya`, `dak_target`, `dak_biaya`, `sektor_target`, `sektor_biaya`, `pinjaman_target`, `pinjaman_biaya`,`total_target`,`total_biaya`) 
values ".substr($que_value,0,-1);
$sqlresult = $db->Execute($sql_detail_);  
*/
}

function create_(){
global $mod_id;
global $db;
global $_POST,$_GET;
global $tbl_name_main;
global $tbl_name_detail;	

$tgl = explode("-",$_POST["tanggal"],strlen($_POST["tanggal"])); // dd-mm-YYYY
$format_tgl = $tgl[2]."-".$tgl[1]."-".$tgl[0]; // YYYY-mm-dd

$sql_delete_ = " DELETE FROM tbl_form_jl_04_main WHERE no_propinsi=".sqlvalue(@$_POST["no_propinsi"], false)." AND no_kabupaten=".sqlvalue(@$_POST["no_kabupaten"], false)." AND apbd=".sqlvalue(@$_POST["apbd"], false)." AND thn_anggaran=".sqlvalue(@$_POST["thn_anggaran"], false)."";
$db->Execute($sql_delete_);
//print $sql_delete_."<br>";

$sql_main_ = " INSERT INTO `tbl_form_jl_04_main` (`tanggal`, `no_propinsi`, `no_kabupaten`, `apbd`, 
		`thn_anggaran`,`id_jns_jln`) VALUES (".sqlvalue($format_tgl, true).", ".sqlvalue(@$_POST["no_propinsi"], false).", ".sqlvalue(@$_POST["no_kabupaten"], false).", ".sqlvalue(@$_POST["apbd"], true).", ".sqlvalue(@$_POST["thn_anggaran"], true).", ".sqlvalue(@$_POST["jns_jln"], true).")";

$sqlresult = $db->Execute($sql_main_);
$last_id = $db->Insert_ID();
//print $sql_main_."<br>";

//print $sql_main_;
/**** Disabled 19-08-2010
$sql_program_penanganan = " SELECT id_program_penanganan FROM tbl_mast_program_penanganan WHERE sub_kategori<>'0' ORDER BY id_program_penanganan ASC ";
***/
$sql_program_penanganan = " SELECT id_program_penanganan FROM tbl_mast_program_penanganan WHERE sub_kategori<>'0' AND status<>'0' ORDER BY id_program_penanganan ASC ";

$recordSet_Program = $db->execute($sql_program_penanganan);

$que_value = "";
while(!$recordSet_Program->EOF) {
	$que_value.="(".$last_id.",";
	$que_value.=$recordSet_Program->fields[id_program_penanganan].",";
	$que_value.=sqlvalue(@$_POST["th1_apbd_target_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th1_apbd_biaya_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_apbd_target_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_apbd_biaya_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_dak_target_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_dak_biaya_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_sektor_target_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_sektor_biaya_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_pinjaman_target_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_pinjaman_biaya_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_total_target_".$recordSet_Program->fields[id_program_penanganan]], false).",";
	$que_value.=sqlvalue(@$_POST["th2_total_biaya_".$recordSet_Program->fields[id_program_penanganan]], false)."),";
	$recordSet_Program->MoveNext();
}

$sql_detail_ =" INSERT INTO `tbl_form_jl_04_detail` (`id_fjl_04_main`, `id_program_penanganan`, `apbd_target`, `apbd_biaya`, `apbd_jalan_target`, `apbd_jalan_biaya`, `dak_target`, `dak_biaya`, `sektor_target`, `sektor_biaya`, `pinjaman_target`, `pinjaman_biaya`,`total_target`,`total_biaya`) 
VALUES ".substr($que_value,0,-1);
$sqlresult = $db->Execute($sql_detail_);  
//print $sql_detail_;
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

	$get_sql		= " SELECT * FROM `".$tmp_tbl_name_main."` ORDER BY id_fjl_04_main ASC ";
	//print $get_sql;
	$get_recordSet 	= $tb_import->Execute($get_sql);
	$count = $get_recordSet->RecordCount();

	$z=1;
	while ($arr=$get_recordSet->FetchRow()) {
		$sql_insert = " INSERT INTO `".$tbl_name_main."` (`tanggal`, `no_propinsi`, `no_kabupaten`, `apbd`, `thn_anggaran`, `id_jns_jln`) 
				VALUES (".sqlvalue(@$arr["tanggal"], true).", 
				".sqlvalue(@$arr["no_propinsi"], false).", 
				".sqlvalue(@$arr["no_kabupaten"], false).", 
				".sqlvalue(@$arr["apbd"], true).",
				".sqlvalue(@$arr["thn_anggaran"], true).",
				".sqlvalue(@$arr["id_jns_jln"], true).")";
		$sql_exec = $tb_import->Execute($sql_insert);
		
		$sql_detail	=  " SELECT * FROM `".$tmp_tbl_name_detail."` WHERE id_fjl_04_main='$arr[id_fjl_04_main]' ";
		$get_recordSet2	= $tb_import->Execute($sql_detail);
		if($get_recordSet2->RecordCount()>0) {
			while ($arr2=$get_recordSet2->FetchRow()) {
				$sql_insert2 = " INSERT INTO `".$tbl_name_detail."` (`id_fjl_04_main`,`id_program_penanganan`,`apbd_target`,`apbd_biaya`,`apbd_jalan_target`,`apbd_jalan_biaya`,`dak_target`,`dak_biaya`,`sektor_target`,`sektor_biaya`,`pinjaman_target`,`pinjaman_biaya`,`total_target`,`total_biaya`) VALUES (
					(SELECT MAX(id_fjl_04_main) FROM ".$tbl_name_main."), 
					".sqlvalue(@$get_recordSet2->fields["id_program_penanganan"], true).",
					".sqlvalue(@$get_recordSet2->fields["apbd_target"], true).", 
					".sqlvalue(@$get_recordSet2->fields["apbd_biaya"], false).", 
					".sqlvalue(@$get_recordSet2->fields["apbd_jalan_target"], false).", 
					".sqlvalue(@$get_recordSet2->fields["apbd_jalan_biaya"], false).", 
					".sqlvalue(@$get_recordSet2->fields["dak_target"], false).", 
					".sqlvalue(@$get_recordSet2->fields["dak_biaya"], false).", 
					".sqlvalue(@$get_recordSet2->fields["sektor_target"], false).", 
					".sqlvalue(@$get_recordSet2->fields["sektor_biaya"], false).", 
					".sqlvalue(@$get_recordSet2->fields["pinjaman_target"], false).", 
					".sqlvalue(@$get_recordSet2->fields["pinjaman_biaya"], false).", 
					".sqlvalue(@$get_recordSet2->fields["total_target"], false).", 					
					".sqlvalue(@$get_recordSet2->fields["total_biaya"], true).")";
					
				$sql_exec2 = $tb_import->Execute($sql_insert2);
				$sql_del = "DELETE FROM `".$tmp_tbl_name_detail."` WHERE id_fjl_04_detail='{$get_recordSet2->fields[id_fjl_04_detail]}' ";
				$sql_exec3 = $tb_import->Execute($sql_del);
			}
		}	
		//if($sql_exec){
			$sql_del2 = "DELETE FROM `".$tmp_tbl_name_main."` WHERE id_fjl_04_main='$arr[id_fjl_04_main]' ";
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
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_();
		//unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		lockTables($tbl_name_main);
		delete_($_GET['id_fjl_04_main']);
		unlockTables($tbl_name_main);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&no_kabupaten=".$_GET[no_kabupaten]."&Search_Year=".$_GET[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);
	}
break;
}
}
?>