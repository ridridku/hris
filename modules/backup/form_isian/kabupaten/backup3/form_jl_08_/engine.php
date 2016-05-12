<?php
/*** Modify by Agus Somantri
28-06-2010, Last Modify 11-07-2010
***/

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_jl_08';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_jl_08';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name_main	= "tbl_form_jl_08_main";
$tbl_name_detail	= "tbl_form_jl_08_detail";

$tmp_tbl_name_main	= "tmp_tbl_form_jl_08_main";
$tmp_tbl_name_detail	= "tmp_tbl_form_jl_08_detail";
//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;

global $tmp_tbl_name_main;
global $tmp_tbl_name_detail;

$sql  ="DELETE ";
$sql .="FROM ".$tbl_name_main." ";
$sql .="WHERE id_fjl_08_main = '$id'";
//$sqlresult = $db->Execute($sql);
$tmp_sql  = " DELETE FROM ".$tmp_tbl_name_main." WHERE id_fjl_08_main='{$id}' " ;

if($db->Execute($sql)){
	$db->Execute($tmp_sql);
}
}

function edit_(){
global $mod_id;
global $db;
global $_POST,$_GET;
global $tbl_name_main;
global $tbl_name_detail;
global $tmp_tbl_name_main;
global $tmp_tbl_name_detail;

$tgl = explode("-",$_POST["tanggal"],strlen($_POST["tanggal"])); // dd-mm-YYYY
$tanggal = $tgl[2]."-".$tgl[1]."-".$tgl[0]; // YYYY-mm-dd

$sql = " UPDATE `".$tbl_name_main."` SET `tanggal`=" .sqlvalue($tanggal, true) .", 
		`no_propinsi`=" .sqlvalue(@$_POST["no_propinsi"], false) .", 
		`no_kabupaten`=" .sqlvalue(@$_POST["no_kabupaten"], false) .", 
		`triwulan`=" .sqlvalue(@$_POST["triwulan"], false) .", 
		`status_progress`=" .sqlvalue(@$_POST["status_progres"], true) .",
		`id_jns_jln`=" .sqlvalue(@$_POST['txt_hidden_jns_jln'], false) ."
		WHERE " ."(`id_fjl_08_main`=" .sqlvalue(@$_POST["xid_jl_08_main"], false) .")";
		
$sqlresult = $db->Execute($sql);
/*** Disabled on 07-09-2010
		`jembatan_beton`=" .sqlvalue(@$_POST["jembatan_beton"], true) .", 
		`jembatan_kayu`=" .sqlvalue(@$_POST["jembatan_kayu"], true) .", 
		`jembatan_oprit`=" .sqlvalue(@$_POST["jembatan_oprit"], true) .", 
		`jembatan_pengecatan`=" .sqlvalue(@$_POST["jembatan_pengecatan"], true) .", 
		`jembatan_lainnya`=" .sqlvalue(@$_POST["jembatan_lainnya"], true) .", 
***/
$sql = " UPDATE `".$tbl_name_detail."` SET `nama_paket`=" .sqlvalue(trim(@$_POST["nama_paket"]), true) .", 
		`lhr`=" .sqlvalue(@$_POST["lhr"], false) .", 
		`jalan_perkerasan`=" .sqlvalue(@$_POST["jalan_perkerasan"], true) .", 
		`jalan_bahu`=" .sqlvalue(@$_POST["jalan_bahu"], true) .", 
		`jalan_drainase`=" .sqlvalue(@$_POST["jalan_drainase"], true) .", 
		`jalan_trotoar`=" .sqlvalue(@$_POST["jalan_trotoar"], true) .", 
		`jalan_pengaman`=" .sqlvalue(@$_POST["jalan_pengaman"], true) .", 
		`jalan_talud`=" .sqlvalue(@$_POST["jalan_talud"], true) .", 
		`jalan_lain`=" .sqlvalue(@$_POST["jalan_lain"], true) .", 
		`keterangan`=" .sqlvalue(@$_POST["keterangan"], true) ." 
		WHERE " ."(`id_fjl_08_detail`=" .sqlvalue(@$_POST["xid_form_jl_08_detail"], false) .")";
		
$sqlresult = $db->Execute($sql);

/*** Tambahan ***/
$tmp_sql = " UPDATE `".$tmp_tbl_name_main."` SET `tanggal`=" .sqlvalue($tanggal, true) .", 
		`no_propinsi`=" .sqlvalue(@$_POST["no_propinsi"], false) .", 
		`no_kabupaten`=" .sqlvalue(@$_POST["no_kabupaten"], false) .", 
		`triwulan`=" .sqlvalue(@$_POST["triwulan"], false) .", 
		`status_progress`=" .sqlvalue(@$_POST["status_progres"], true) .",
		`id_jns_jln`=" .sqlvalue(@$_POST['txt_hidden_jns_jln'], false) ."
		WHERE " ."(`id_fjl_08_main`=" .sqlvalue(@$_POST["xid_jl_08_main"], false) .")";
		
$tmp_sqlresult = $db->Execute($tmp_sql);
/*** Disabled on 07-09-2010
		`jembatan_beton`=" .sqlvalue(@$_POST["jembatan_beton"], true) .", 
		`jembatan_kayu`=" .sqlvalue(@$_POST["jembatan_kayu"], true) .", 
		`jembatan_oprit`=" .sqlvalue(@$_POST["jembatan_oprit"], true) .", 
		`jembatan_pengecatan`=" .sqlvalue(@$_POST["jembatan_pengecatan"], true) .", 
		`jembatan_lainnya`=" .sqlvalue(@$_POST["jembatan_lainnya"], true) .", 
***/
$tmp_sql = " UPDATE `".$tmp_tbl_name_detail."` SET `nama_paket`=" .sqlvalue(trim(@$_POST["nama_paket"]), true) .", 
		`lhr`=" .sqlvalue(@$_POST["lhr"], false) .", 
		`jalan_perkerasan`=" .sqlvalue(@$_POST["jalan_perkerasan"], true) .", 
		`jalan_bahu`=" .sqlvalue(@$_POST["jalan_bahu"], true) .", 
		`jalan_drainase`=" .sqlvalue(@$_POST["jalan_drainase"], true) .", 
		`jalan_trotoar`=" .sqlvalue(@$_POST["jalan_trotoar"], true) .", 
		`jalan_pengaman`=" .sqlvalue(@$_POST["jalan_pengaman"], true) .", 
		`jalan_talud`=" .sqlvalue(@$_POST["jalan_talud"], true) .", 
		`jalan_lain`=" .sqlvalue(@$_POST["jalan_lain"], true) .", 
		`keterangan`=" .sqlvalue(@$_POST["keterangan"], true) ." 
		WHERE " ."(`id_fjl_08_detail`=" .sqlvalue(@$_POST["xid_form_jl_08_detail"], false) .")";
		
$tmp_sqlresult = $db->Execute($tmp_sql);
/*** End 0f Tambahan ***/
}

function create_(){
global $mod_id;
global $db;
global $_POST,$_GET;
global $tbl_name_main;
global $tbl_name_detail;	
global $tmp_tbl_name_main;
global $tmp_tbl_name_detail;

$tgl = explode("-",$_POST["tanggal"],strlen($_POST["tanggal"])); // dd-mm-YYYY
$tanggal = $tgl[2]."-".$tgl[1]."-".$tgl[0]; // YYYY-mm-dd

$sql = " INSERT INTO `".$tbl_name_main."` (`tanggal`, `no_propinsi`, `no_kabupaten`, `triwulan`, 
		`status_progress`,`id_jns_jln`) VALUES (
		" .sqlvalue($tanggal, true) .", 
		" .sqlvalue(@$_POST["no_propinsi"], false) .", 
		" .sqlvalue(@$_POST["no_kabupaten"], false) .", 
		" .sqlvalue(@$_POST["triwulan"], false) .", 
		" .sqlvalue(@$_POST["status_progres"], true) .",
		" .sqlvalue(@$_POST["txt_hidden_jns_jln"], false) .")";

$sqlresult = $db->Execute($sql);
//print $sql;
/*** Disabled on 07-09-2010
`jembatan_beton`, 
		`jembatan_kayu`, `jembatan_oprit`, `jembatan_pengecatan`, `jembatan_lainnya`,

		" .sqlvalue(@$_POST["jembatan_beton"], true) .", 
		" .sqlvalue(@$_POST["jembatan_kayu"], true) .", 
		" .sqlvalue(@$_POST["jembatan_oprit"], true) .", 
		" .sqlvalue(@$_POST["jembatan_pengecatan"], true) .", 
		" .sqlvalue(@$_POST["jembatan_lainnya"], true) .", 
***/
$sql = " INSERT INTO `".$tbl_name_detail."` (`id_fjl_08_main`, `nama_paket`, `lhr`, `jalan_perkerasan`, `jalan_bahu`, 
		`jalan_drainase`, `jalan_trotoar`, `jalan_pengaman`, `jalan_talud`, `jalan_lain`, `keterangan`) VALUES (
		(SELECT MAX(id_fjl_08_main) FROM ".$tbl_name_main."), 
		" .sqlvalue(@$_POST["nama_paket"], true) .", 
		" .sqlvalue(@$_POST["lhr"], false) .", 
		" .sqlvalue(@$_POST["jalan_perkerasan"], true) .", 
		" .sqlvalue(@$_POST["jalan_bahu"], true) .", 
		" .sqlvalue(@$_POST["jalan_drainase"], true) .", 
		" .sqlvalue(@$_POST["jalan_trotoar"], true) .", 
		" .sqlvalue(@$_POST["jalan_pengaman"], true) .", 
		" .sqlvalue(@$_POST["jalan_talud"], true) .", 
		" .sqlvalue(@$_POST["jalan_lain"], true) .", 
		" .sqlvalue(@$_POST["keterangan"], true) .")";
$sqlresult = $db->Execute($sql);  

/*** Tambahan ***/
$tmp_sql = " INSERT INTO `".$tmp_tbl_name_main."` (`id_fjl_08_main`, `tanggal`, `no_propinsi`, `no_kabupaten`, `triwulan`, 
		`status_progress`,`id_jns_jln`) VALUES (
		(SELECT MAX(id_fjl_08_main) FROM ".$tbl_name_main."),
		" .sqlvalue($tanggal, true) .", 
		" .sqlvalue(@$_POST["no_propinsi"], false) .", 
		" .sqlvalue(@$_POST["no_kabupaten"], false) .", 
		" .sqlvalue(@$_POST["triwulan"], false) .", 
		" .sqlvalue(@$_POST["status_progres"], true) .",
		" .sqlvalue(@$_POST["txt_hidden_jns_jln"], false) .")";

$tmp_sqlresult = $db->Execute($tmp_sql);
//print $sql;
/*** Disabled on 07-09-2010
`jembatan_beton`, 
		`jembatan_kayu`, `jembatan_oprit`, `jembatan_pengecatan`, `jembatan_lainnya`, 

		" .sqlvalue(@$_POST["jembatan_beton"], true) .", 
		" .sqlvalue(@$_POST["jembatan_kayu"], true) .", 
		" .sqlvalue(@$_POST["jembatan_oprit"], true) .", 
		" .sqlvalue(@$_POST["jembatan_pengecatan"], true) .", 
		" .sqlvalue(@$_POST["jembatan_lainnya"], true) .", 
***/
$tmp_sql = " INSERT INTO `".$tmp_tbl_name_detail."` (`id_fjl_08_detail`, `id_fjl_08_main`, `nama_paket`, `lhr`, `jalan_perkerasan`, `jalan_bahu`, 
		`jalan_drainase`, `jalan_trotoar`, `jalan_pengaman`, `jalan_talud`, `jalan_lain`, `keterangan`) VALUES (
		(SELECT MAX(id_fjl_08_detail) FROM ".$tbl_name_detail."),
		(SELECT MAX(id_fjl_08_main) FROM ".$tbl_name_main."), 
		" .sqlvalue(@$_POST["nama_paket"], true) .", 
		" .sqlvalue(@$_POST["lhr"], false) .", 
		" .sqlvalue(@$_POST["jalan_perkerasan"], true) .", 
		" .sqlvalue(@$_POST["jalan_bahu"], true) .", 
		" .sqlvalue(@$_POST["jalan_drainase"], true) .", 
		" .sqlvalue(@$_POST["jalan_trotoar"], true) .", 
		" .sqlvalue(@$_POST["jalan_pengaman"], true) .", 
		" .sqlvalue(@$_POST["jalan_talud"], true) .", 
		" .sqlvalue(@$_POST["jalan_lain"], true) .", 
		" .sqlvalue(@$_POST["keterangan"], true) .")";
$tmp_sqlresult = $db->Execute($tmp_sql);  
/*** End 0f Tambahan ***/
}

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
	$conn=mysql_connect($_POST['hostname1'],$_POST['username1'],$_POST['password1']);
	if(!$conn)
    {

        echo("<BR><BR>Koneksi Gagal<BR><BR>");

    }

    else
	{
	$get_sql		= " SELECT * FROM `".$tmp_tbl_name_main."` ORDER BY id_fjl_08_main ASC ";
	//print $get_sql;
	$get_recordSet 	= $tb_import->Execute($get_sql);
	@$count = $get_recordSet->RecordCount();
	if (@$count!='') {//if1
	$z=1;
	while ($arr=$get_recordSet->FetchRow()) {
		$sql_insert = " INSERT INTO `".$tbl_name_main."` (`tanggal`, `no_propinsi`, `no_kabupaten`, `triwulan`, `status_progress`, `catatan`, `id_jns_jln`) 
				VALUES (" .sqlvalue(@$arr["tanggal"], true) .", 
				" .sqlvalue(@$arr["no_propinsi"], false) .", 
				" .sqlvalue(@$arr["no_kabupaten"], false) .", 
				".sqlvalue(@$arr["triwulan"], false) .", 
				".sqlvalue(@$arr["status_progress"], false) .", 
				".sqlvalue(@$arr["catatan"], false) .", 
				" .sqlvalue(@$arr["id_jns_jln"], false) .")";
		$sql_exec = $tb_import->Execute($sql_insert);
		
		$sql_detail	=  " SELECT * FROM `".$tmp_tbl_name_detail."` WHERE id_fjl_08_main='$arr[id_fjl_08_main]' ";
		$get_recordSet2	= $tb_import->Execute($sql_detail);
		if($get_recordSet2->RecordCount()>0){
			/*** Disabled on 07-09-2010
`jembatan_beton`, 
						`jembatan_kayu`, `jembatan_oprit`, `jembatan_pengecatan`, `jembatan_lainnya`, 

						" .sqlvalue(@$get_recordSet2->fields["jembatan_beton"], true) .", 
						" .sqlvalue(@$get_recordSet2->fields["jembatan_kayu"], true) .", 
						" .sqlvalue(@$get_recordSet2->fields["jembatan_oprit"], true) .", 
						" .sqlvalue(@$get_recordSet2->fields["jembatan_pengecatan"], true) .", 
						" .sqlvalue(@$get_recordSet2->fields["jembatan_lainnya"], true) .", 
			***/
		 while ($arr2=$get_recordSet2->FetchRow()) {
				$sql_insert2 = " 
				INSERT INTO `".$tbl_name_detail."` (`id_fjl_08_main`, `nama_paket`, `lhr`, `jalan_perkerasan`, `jalan_bahu`, 
						`jalan_drainase`, `jalan_trotoar`, `jalan_pengaman`, `jalan_talud`, `jalan_lain`, `keterangan`) VALUES (
						(SELECT MAX(id_fjl_08_main) FROM ".$tbl_name_main."), 
						" .sqlvalue(@$arr2["nama_paket"], true) .", 
						" .sqlvalue(@$arr2["lhr"], false) .", 
						" .sqlvalue(@$arr2["jalan_perkerasan"], true) .", 
						" .sqlvalue(@$arr2["jalan_bahu"], true) .", 
						" .sqlvalue(@$arr2["jalan_drainase"], true) .", 
						" .sqlvalue(@$arr2["jalan_trotoar"], true) .", 
						" .sqlvalue(@$arr2["jalan_pengaman"], true) .", 
						" .sqlvalue(@$arr2["jalan_talud"], true) .", 
						" .sqlvalue(@$arr2["jalan_lain"], true) .", 
						" .sqlvalue(@$arr2["keterangan"], true) .")				
				";
					
				$sql_exec2 = $tb_import->Execute($sql_insert2);
				
			}
		}
			$sql_del = "DELETE FROM `".$tmp_tbl_name_detail."` WHERE id_fjl_08_detail='{$get_recordSet2->fields[id_fjl_08_detail]}' ";
			$sql_exec3 = $tb_import->Execute($sql_del);			$sql_del2 = "DELETE FROM `".$tmp_tbl_name_main."` WHERE id_fjl_08_main='$arr[id_fjl_08_main]' ";
			$sql_exec4 = $tb_import->Execute($sql_del2);
			
		//}
		$z++;
				
		
		}//end while1
		echo "Data Telah dieksport";
		
		}else {
		   echo "Tidak ada data yang akan di eksport";
			
		}//end if 2
		
	}	//end else
}//end func


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
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_();
		//unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST['txt_hidden_jns_jln']);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		//lockTables($tbl_name_main);
		delete_($_GET['id_fjl_08_main']);
		//unlockTables($tbl_name_main);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&no_kabupaten=".$_GET[no_kabupaten]."&Search_Year=".$_GET[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST['txt_hidden_jns_jln']);
	}
break;
case 3:
		//lockTables($tbl_name);
		import_();
		//unlockTables($tbl_name);		
		//Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST['txt_hidden_jns_jln']);
break;
}
}
?>