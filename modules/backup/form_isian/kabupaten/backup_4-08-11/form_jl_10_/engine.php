<?php
/*** Last Modify 11-07-2010
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_jl_10';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_jl_10';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name_main	= "tbl_form_jl_10_main";
$tbl_name_detail	= "tbl_form_jl_10_detail";
$tmp_tbl_name_main	= "tmp_tbl_form_jl_10_main";
$tmp_tbl_name_detail	= "tmp_tbl_form_jl_10_detail";
//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $mod_id;
global $db;
global $_POST,$_GET;
global $tbl_name_main;
global $tbl_name_detail;
global $tmp_tbl_name_main;
global $tmp_tbl_name_detail;

$sql  ="DELETE ";
$sql .="FROM ".$tbl_name_main." ";
$sql .="WHERE id_fjl_10_main = '$id'";
//$sqlresult = $db->Execute($sql);
$tmp_sql  = " DELETE FROM ".$tmp_tbl_name_main." WHERE id_fjl_10_main='{$id}' " ;

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
		`tahun1`=" .sqlvalue(@$_POST["tahun1"], true) .", 
		`tahun2`=" .sqlvalue(@$_POST["tahun2"], true) .",
		`id_jns_jln`=" .sqlvalue(@$_POST['txt_hidden_jns_jln'], false) ."
		WHERE " ."(`id_fjl_10_main`=" .sqlvalue(@$_POST["xid_jl_10_main"], false) .")";
		
$sqlresult = $db->Execute($sql);

$sql = " UPDATE `".$tbl_name_detail."` SET `no_ruas`=" .sqlvalue(@$_POST["no_ruas"], true) .", 
		`nama_ruas`=" .sqlvalue(@$_POST["nama_ruas"], true) .", 
		`panjang_km`=" .sqlvalue(@$_POST["panjang_km"], false) .", 
		`panjang_m`=" .sqlvalue(@$_POST["panjang_m"], false) .", 
		`tahun1_baik`=" .sqlvalue(@$_POST["tahun1_baik"], false) .", 
		`tahun1_sedang`=" .sqlvalue(@$_POST["tahun1_sedang"], false) .", 
		`tahun1_rusak`=" .sqlvalue(@$_POST["tahun1_rusak"], false) .", 
		`tahun1_rusak_berat`=" .sqlvalue(@$_POST["tahun1_rusak_berat"], false) .", 
		`tahun2_baik`=" .sqlvalue(@$_POST["tahun2_baik"], false) .", 
		`tahun2_sedang`=" .sqlvalue(@$_POST["tahun2_sedang"], false) .", 
		`tahun2_rusak`=" .sqlvalue(@$_POST["tahun2_rusak"], false) .", 
		`tahun2_rusak_berat`=" .sqlvalue(@$_POST["tahun2_rusak_berat"], false) .", 
		`keterangan`=" .sqlvalue(@$_POST["keterangan"], true) ." 
		WHERE " ."(`id_fjl_10_detail`=" .sqlvalue(@$_POST["xid_form_jl_10_detail"], false) .")";
		
$sqlresult = $db->Execute($sql);

/*** Tambahan ***/
$tmp_sql = " UPDATE `".$tmp_tbl_name_main."` SET `tanggal`=" .sqlvalue($tanggal, true) .", 
		`no_propinsi`=" .sqlvalue(@$_POST["no_propinsi"], false) .", 
		`no_kabupaten`=" .sqlvalue(@$_POST["no_kabupaten"], false) .", 
		`tahun1`=" .sqlvalue(@$_POST["tahun1"], true) .", 
		`tahun2`=" .sqlvalue(@$_POST["tahun2"], true) .",
		`id_jns_jln`=" .sqlvalue(@$_POST['txt_hidden_jns_jln'], false) ."
		WHERE " ."(`id_fjl_10_main`=" .sqlvalue(@$_POST["xid_jl_10_main"], false) .")";
		
$tmp_sqlresult = $db->Execute($tmp_sql);

$tmp_sql = " UPDATE `".$tmp_tbl_name_detail."` SET `no_ruas`=" .sqlvalue(@$_POST["no_ruas"], true) .", 
		`nama_ruas`=" .sqlvalue(@$_POST["nama_ruas"], true) .", 
		`panjang_km`=" .sqlvalue(@$_POST["panjang_km"], false) .", 
		`panjang_m`=" .sqlvalue(@$_POST["panjang_m"], false) .", 
		`tahun1_baik`=" .sqlvalue(@$_POST["tahun1_baik"], false) .", 
		`tahun1_sedang`=" .sqlvalue(@$_POST["tahun1_sedang"], false) .", 
		`tahun1_rusak`=" .sqlvalue(@$_POST["tahun1_rusak"], false) .", 
		`tahun1_rusak_berat`=" .sqlvalue(@$_POST["tahun1_rusak_berat"], false) .", 
		`tahun2_baik`=" .sqlvalue(@$_POST["tahun2_baik"], false) .", 
		`tahun2_sedang`=" .sqlvalue(@$_POST["tahun2_sedang"], false) .", 
		`tahun2_rusak`=" .sqlvalue(@$_POST["tahun2_rusak"], false) .", 
		`tahun2_rusak_berat`=" .sqlvalue(@$_POST["tahun2_rusak_berat"], false) .", 
		`keterangan`=" .sqlvalue(@$_POST["keterangan"], true) ." 
		WHERE " ."(`id_fjl_10_detail`=" .sqlvalue(@$_POST["xid_form_jl_10_detail"], false) .")";
		
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

$sql = " INSERT INTO `".$tbl_name_main."` (`tanggal`, `no_propinsi`, `no_kabupaten`, `tahun1`, `tahun2`, `id_jns_jln`) VALUES (
		" .sqlvalue($tanggal, true) .", 
		" .sqlvalue(@$_POST["no_propinsi"], false) .", 
		" .sqlvalue(@$_POST["no_kabupaten"], false) .", 
		" .sqlvalue(@$_POST["tahun1"], true) .", 
		" .sqlvalue(@$_POST["tahun2"], true) .", 
		".sqlvalue(@$_POST["txt_hidden_jns_jln"], false) .")";
		
$sqlresult = $db->Execute($sql);

$sql = " INSERT INTO `".$tbl_name_detail."` (`id_fjl_10_main`, `no_ruas`, `nama_ruas`, `panjang_km`, `panjang_m`, 
		`tahun1_baik`, `tahun1_sedang`, `tahun1_rusak`, `tahun1_rusak_berat`, `tahun2_baik`, `tahun2_sedang`, 
		`tahun2_rusak`, `tahun2_rusak_berat`, `keterangan`) VALUES (
		(SELECT MAX(id_fjl_10_main) FROM ".$tbl_name_main."), 
		" .sqlvalue(@$_POST["no_ruas"], true) .", "
		 .sqlvalue(@$_POST["nama_ruas"], true) .", 
		 " .sqlvalue(@$_POST["panjang_km"], false) .", 
		 " .sqlvalue(@$_POST["panjang_m"], false) .", 
		 " .sqlvalue(@$_POST["tahun1_baik"], false) .", 
		 " .sqlvalue(@$_POST["tahun1_sedang"], false) .", 
		 " .sqlvalue(@$_POST["tahun1_rusak"], false) .", 
		 " .sqlvalue(@$_POST["tahun1_rusak_berat"], false) .", 
		 " .sqlvalue(@$_POST["tahun2_baik"], false) .", 
		 " .sqlvalue(@$_POST["tahun2_sedang"], false) .", 
		 " .sqlvalue(@$_POST["tahun2_rusak"], false) .", 
		 " .sqlvalue(@$_POST["tahun2_rusak_berat"], false) .", 
		 " .sqlvalue(@$_POST["keterangan"], true) .")";

$sqlresult = $db->Execute($sql);  

/*** Tambahan ***/
$tmp_sql = " INSERT INTO `".$tmp_tbl_name_main."` (`id_fjl_10_main`, `tanggal`, `no_propinsi`, `no_kabupaten`, `tahun1`, `tahun2`, `id_jns_jln`) VALUES (
		(SELECT MAX(id_fjl_10_main) FROM ".$tbl_name_main."),
		" .sqlvalue($tanggal, true) .", 
		" .sqlvalue(@$_POST["no_propinsi"], false) .", 
		" .sqlvalue(@$_POST["no_kabupaten"], false) .", 
		" .sqlvalue(@$_POST["tahun1"], true) .", 
		" .sqlvalue(@$_POST["tahun2"], true) .", 
		".sqlvalue(@$_POST["txt_hidden_jns_jln"], false) .")";
		
$tmp_sqlresult = $db->Execute($tmp_sql);

$tmp_sql = " INSERT INTO `".$tmp_tbl_name_detail."` (`id_fjl_10_detail`, `id_fjl_10_main`, `no_ruas`, `nama_ruas`, `panjang_km`, `panjang_m`, 
		`tahun1_baik`, `tahun1_sedang`, `tahun1_rusak`, `tahun1_rusak_berat`, `tahun2_baik`, `tahun2_sedang`, 
		`tahun2_rusak`, `tahun2_rusak_berat`, `keterangan`) VALUES (
		(SELECT MAX(id_fjl_10_detail) FROM ".$tbl_name_detail."),
		(SELECT MAX(id_fjl_10_main) FROM ".$tbl_name_main."), 
		" .sqlvalue(@$_POST["no_ruas"], true) .", "
		 .sqlvalue(@$_POST["nama_ruas"], true) .", 
		 " .sqlvalue(@$_POST["panjang_km"], false) .", 
		 " .sqlvalue(@$_POST["panjang_m"], false) .", 
		 " .sqlvalue(@$_POST["tahun1_baik"], false) .", 
		 " .sqlvalue(@$_POST["tahun1_sedang"], false) .", 
		 " .sqlvalue(@$_POST["tahun1_rusak"], false) .", 
		 " .sqlvalue(@$_POST["tahun1_rusak_berat"], false) .", 
		 " .sqlvalue(@$_POST["tahun2_baik"], false) .", 
		 " .sqlvalue(@$_POST["tahun2_sedang"], false) .", 
		 " .sqlvalue(@$_POST["tahun2_rusak"], false) .", 
		 " .sqlvalue(@$_POST["tahun2_rusak_berat"], false) .", 
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
	$get_sql		= " SELECT * FROM `".$tmp_tbl_name_main."` ORDER BY id_fjl_10_main ASC ";
	//print $get_sql;
	$get_recordSet 	= $tb_import->Execute($get_sql);
	@$count = $get_recordSet->RecordCount();
	if (@$count!='') {//if1
	$z=1;
	while ($arr=$get_recordSet->FetchRow()) {
		$sql_insert = " INSERT INTO `".$tbl_name_main."` (`tanggal`, `no_propinsi`, `no_kabupaten`, `tahun1`, `tahun2`, `id_jns_jln`) 
				VALUES (" .sqlvalue(@$arr["tanggal"], true) .", 
				" .sqlvalue(@$arr["no_propinsi"], false) .", 
				" .sqlvalue(@$arr["no_kabupaten"], false) .", 
				".sqlvalue(@$arr["tahun1"], false) .", 
				".sqlvalue(@$arr["tahun2"], false) .", 
				" .sqlvalue(@$arr["id_jns_jln"], false) .")";
		$sql_exec = $tb_import->Execute($sql_insert);
		
		$sql_detail	=  " SELECT * FROM `".$tmp_tbl_name_detail."` WHERE id_fjl_10_main='$arr[id_fjl_10_main]' ";
		$get_recordSet2	= $tb_import->Execute($sql_detail);
		if($get_recordSet2->RecordCount()>0){
			while ($arr2=$get_recordSet2->FetchRow()) {
				$sql_insert2 = " 
				INSERT INTO `".$tbl_name_detail."` (`id_fjl_10_main`, `no_ruas`, `nama_ruas`, `panjang_km`, `panjang_m`, 
						`tahun1_baik`, `tahun1_sedang`, `tahun1_rusak`, `tahun1_rusak_berat`, `tahun2_baik`, `tahun2_sedang`, 
						`tahun2_rusak`, `tahun2_rusak_berat`, `keterangan`) VALUES (
						(SELECT MAX(id_fjl_10_main) FROM ".$tbl_name_main."), 
						" .sqlvalue(@$arr2["no_ruas"], true) .", "
						 .sqlvalue(@$arr2["nama_ruas"], true) .", 
						 " .sqlvalue(@$arr2["panjang_km"], false) .", 
						 " .sqlvalue(@$arr2["panjang_m"], false) .", 
						 " .sqlvalue(@$arr2["tahun1_baik"], false) .", 
						 " .sqlvalue(@$arr2["tahun1_sedang"], false) .", 
						 " .sqlvalue(@$arr2["tahun1_rusak"], false) .", 
						 " .sqlvalue(@$arr2["tahun1_rusak_berat"], false) .", 
						 " .sqlvalue(@$arr2["tahun2_baik"], false) .", 
						 " .sqlvalue(@$arr2["tahun2_sedang"], false) .", 
						 " .sqlvalue(@$arr2["tahun2_rusak"], false) .", 
						 " .sqlvalue(@$arr2["tahun2_rusak_berat"], false) .", 
						 " .sqlvalue(@$arr2["keterangan"], true) .")
				";
					
				$sql_exec2 = $tb_import->Execute($sql_insert2);
				
			}
		}
			$sql_del = "DELETE FROM `".$tmp_tbl_name_detail."` WHERE id_fjl_10_main='$arr[id_fjl_10_main] ";
			$sql_exec3 = $tb_import->Execute($sql_del);
			$sql_del2 = "DELETE FROM `".$tmp_tbl_name_main."` WHERE id_fjl_10_main='$arr[id_fjl_10_main]' ";
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
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST["txt_hidden_jns_jln"]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		//lockTables($tbl_name_main);
		delete_($_GET['id_fjl_10_main']);
		//unlockTables($tbl_name_main);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&no_kabupaten=".$_GET[no_kabupaten]."&Search_Year=".$_GET[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_GET['jns_jln']."&txt_hidden_jns_jln=".$_GET[txt_hidden_jns_jln]);
	}
break;
case 3:
		//lockTables($tbl_name);
		import_();
		//unlockTables($tbl_name);		
		//Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);
break;
}


}
?>
