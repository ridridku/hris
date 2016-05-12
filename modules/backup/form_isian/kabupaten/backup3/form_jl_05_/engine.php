<?php
/*** Modify 24-06-2010, Last Modifty 11-07-2010
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_jl_05';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_jl_05';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name_main	= "tbl_form_jl_05_main";
$tbl_name_detail	= "tbl_form_jl_05_detail";
$tmp_tbl_name_main	= "tmp_tbl_form_jl_05_main";
$tmp_tbl_name_detail	= "tmp_tbl_form_jl_05_detail";
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
$sql .="WHERE id_fjl_05_main = '$id'";
//$sqlresult = $db->Execute($sql);

$tmp_sql  = " DELETE FROM ".$tmp_tbl_name_main." WHERE id_fjl_05_main='{$id}' " ;

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
$format_tgl = $tgl[2]."-".$tgl[1]."-".$tgl[0]; // YYYY-mm-dd
/*** Disabled on 14-09-2010
$tgl2 = explode("-",$_POST["tanggal_spmk"],strlen($_POST["tanggal_spmk"])); // dd-mm-YYYY
$tanggal_spmk = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]; // YYYY-mm-dd
$tgl3 = explode("-",$_POST["rencana_pho"],strlen($_POST["rencana_pho"])); // dd-mm-YYYY
$rencana_pho = $tgl3[2]."-".$tgl3[1]."-".$tgl3[0]; // YYYY-mm-dd
***/
$tanggal_spmk = $_POST["tahun_spmk"]."-".$_POST["bulan_spmk"]."-".$_POST["tanggal_spmk"]; // YYYY-mm-dd
$rencana_pho = $_POST["tahun_pho"]."-".$_POST["bulan_pho"]."-".$_POST["tanggal_pho"]; // YYYY-mm-dd

$sql = " UPDATE `".$tbl_name_main."` SET `tanggal`=".sqlvalue($format_tgl, true).", 
		`tahun`=".sqlvalue(@$_POST["tahun"], true).", 
		`no_propinsi`=".sqlvalue(@$_POST["no_propinsi"], false).", 
		`no_kabupaten`=".sqlvalue(@$_POST["no_kabupaten"], false).",
		`id_jns_jln`=".sqlvalue(@$_POST['txt_hidden_jns_jln'], false)."
		WHERE " ."(`id_fjl_05_main`=".sqlvalue(@$_POST["xid_jl_05_main"], false).")";
		
$sqlresult = $db->Execute($sql);
/*** Disabled on 07-09-2010
		`biaya_dak`=".sqlvalue(@$_POST["biaya_dak"], false).",
		`biaya_pendamping`=".sqlvalue(@$_POST["biaya_pendamping"], false).",
***/
/***
`target_unit`=".sqlvalue(@$_POST["target_unit"], false).",
***/
$sql = " UPDATE `".$tbl_name_detail."` SET `nama_ruas`=".sqlvalue(@$_POST["nama_paket"], true).", 
		`nama_jenis_penanganan`=".sqlvalue(@$_POST["nama_jenis_penanganan"], false).",
		`kecamatan_yg_dilalui`='".get_data_kecamatan2($_POST["jml_kecamatan"])."',
		`target_m`=".sqlvalue(@$_POST["target_m"], false).",

		`biaya_total`=".sqlvalue(@$_POST["biaya_total"], false).", 
        `sumber_pendanaan`=".sqlvalue(@$_POST["sumber_pendanaan"], false).",
		`metoda_pelaksanaan`=".sqlvalue(@$_POST["metoda_pelaksanaan"], true).", 
		`tanggal_spmk`=".sqlvalue($tanggal_spmk, true).", 
		`rencana_pho`=".sqlvalue($rencana_pho, true).", 
		`waktu_pelaksanaan`=".sqlvalue(@$_POST["waktu_pelaksanaan"], false).", 
		`pimpro`=".sqlvalue(@$_POST["pimpro"], true).", 
		`kontraktor`=".sqlvalue(@$_POST["kontraktor"], true).", 
		`pengawas`=".sqlvalue(@$_POST["pengawas"], true).", 
		`keterangan`=".sqlvalue(@$_POST["keterangan"], true)." 
		WHERE " ."(`id_fjl_05_detail`=".sqlvalue(@$_POST["xid_form_jl_05_detail"], false).")";
		
$sqlresult = $db->Execute($sql);
//print $sql;

/***
Tambahan
***/
$tmp_sql = " UPDATE `".$tmp_tbl_name_main."` SET `tanggal`=".sqlvalue($format_tgl, true).", 
		`tahun`=".sqlvalue(@$_POST["tahun"], true).", 
		`no_propinsi`=".sqlvalue(@$_POST["no_propinsi"], false).", 
		`no_kabupaten`=".sqlvalue(@$_POST["no_kabupaten"], false).",
		`id_jns_jln`=".sqlvalue(@$_POST['txt_hidden_jns_jln'], false)."
		WHERE " ."(`id_fjl_05_main`=".sqlvalue(@$_POST["xid_jl_05_main"], false).")";
		
$tmp_sqlresult = $db->Execute($tmp_sql);
/*** Disabled on 07-09-2010
		`biaya_dak`=".sqlvalue(@$_POST["biaya_dak"], false).",
		`biaya_pendamping`=".sqlvalue(@$_POST["biaya_pendamping"], false).",
***/
/*** Disabled on 22-09-2010
`target_unit`=".sqlvalue(@$_POST["target_unit"], false).",
***/
$tmp_sql = " UPDATE `".$tmp_tbl_name_detail."` SET `nama_ruas`=".sqlvalue(@$_POST["nama_paket"], true).", 
		`nama_jenis_penanganan`=".sqlvalue(@$_POST["nama_jenis_penanganan"], false).",
		`kecamatan_yg_dilalui`='".get_data_kecamatan2($_POST["jml_kecamatan"])."',
		`target_m`=".sqlvalue(@$_POST["target_m"], false).",
	
		`biaya_total`=".sqlvalue(@$_POST["biaya_total"], false).", 
        `sumber_pendanaan`=".sqlvalue(@$_POST["sumber_pendanaan"], false).",
		`metoda_pelaksanaan`=".sqlvalue(@$_POST["metoda_pelaksanaan"], true).", 
		`tanggal_spmk`=".sqlvalue($tanggal_spmk, true).", 
		`rencana_pho`=".sqlvalue($rencana_pho, true).", 
		`waktu_pelaksanaan`=".sqlvalue(@$_POST["waktu_pelaksanaan"], false).", 
		`pimpro`=".sqlvalue(@$_POST["pimpro"], true).", 
		`kontraktor`=".sqlvalue(@$_POST["kontraktor"], true).", 
		`pengawas`=".sqlvalue(@$_POST["pengawas"], true).", 
		`keterangan`=".sqlvalue(@$_POST["keterangan"], true)." 
		WHERE " ."(`id_fjl_05_detail`=".sqlvalue(@$_POST["xid_form_jl_05_detail"], false).")";
		
$tmp_sqlresult = $db->Execute($tmp_sql);
/*** End 0f Tambahan ***/
}

function create_(){
// get_data_kecamatan($_POST["jml_kecamatan"],$source="kecamatan")
global $mod_id;
global $db;
global $_POST,$_GET;
global $tbl_name_main;
global $tbl_name_detail;
global $tmp_tbl_name_main;
global $tmp_tbl_name_detail;

$tgl = explode("-",$_POST["tanggal"],strlen($_POST["tanggal"])); // dd-mm-YYYY
$format_tgl = $tgl[2]."-".$tgl[1]."-".$tgl[0]; // YYYY-mm-dd
/*** Disabled on 15-09-2010
$tgl2 = explode("-",$_POST["tanggal_spmk"],strlen($_POST["tanggal_spmk"])); // dd-mm-YYYY
$tanggal_spmk = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]; // YYYY-mm-dd
$tgl3 = explode("-",$_POST["rencana_pho"],strlen($_POST["rencana_pho"])); // dd-mm-YYYY
$rencana_pho = $tgl3[2]."-".$tgl3[1]."-".$tgl3[0]; // YYYY-mm-dd
***/
$tanggal_spmk = $_POST["tahun_spmk"]."-".$_POST["bulan_spmk"]."-".$_POST["tanggal_spmk"]; // YYYY-mm-dd
$rencana_pho = $_POST["tahun_pho"]."-".$_POST["bulan_pho"]."-".$_POST["tanggal_pho"]; // YYYY-mm-dd

$sql = " INSERT INTO `".$tbl_name_main."` (`tanggal`, `tahun`, `no_propinsi`, `no_kabupaten`,`id_jns_jln`) VALUES 
		(".sqlvalue($format_tgl, true).", ".sqlvalue(@$_POST["tahun"], true).", " .sqlvalue(@$_POST["no_propinsi"], false).", 
		".sqlvalue(@$_POST["no_kabupaten"], false).", 
		".sqlvalue(@$_POST["txt_hidden_jns_jln"], false).")";

//print $sql."<br>";
$sqlresult = $db->Execute($sql);

/***
List data kecamatan nilainya tdk terambil 
masih dogol........ ***/
/*** Disabled on 07-09-2010
				`biaya_dak`, 
				`biaya_pendamping`, 

		".sqlvalue(@$_POST["biaya_dak"], false).", 
		".sqlvalue(@$_POST["biaya_pendamping"], false).", 
***/
/*** Disabled on 22-09-2010
`target_unit`, 
".sqlvalue(@$_POST["target_unit"], false).", 
***/
$sql2 = " INSERT INTO `".$tbl_name_detail."` (`id_fjl_05_main`, 
				`nama_ruas`, 
				`nama_jenis_penanganan`
				`kecamatan_yg_dilalui`, 
				`target_m`, 
				
				`biaya_total`, 
                `sumber_pendanaan`, 
				`metoda_pelaksanaan`, 
				`tanggal_spmk`, 
				`rencana_pho`, 
				`waktu_pelaksanaan`, 
				`pimpro`, 
				`kontraktor`, 
				`pengawas`, 
				`keterangan`) 
		VALUES (
		(SELECT MAX(id_fjl_05_main) FROM ".$tbl_name_main."),
		".sqlvalue(@$_POST["nama_paket"], true) .", 
		".sqlvalue(@$_POST["nama_jenis_penanganan"], false) .", 
		'".get_data_kecamatan2($_POST["jml_kecamatan"])."',
		".sqlvalue(@$_POST["target_m"], false).", 

		".sqlvalue(@$_POST["biaya_total"], false).", 
		".sqlvalue(@$_POST["sumber_pendanaan"], false).",
		".sqlvalue(@$_POST["metoda_pelaksanaan"], true).", 
		".sqlvalue($tanggal_spmk, true).", 
		".sqlvalue($rencana_pho, true).", 
		".sqlvalue(@$_POST["waktu_pelaksanaan"], false).", 
		".sqlvalue(@$_POST["pimpro"], true).", 
		".sqlvalue(@$_POST["kontraktor"], true).", 
		".sqlvalue(@$_POST["pengawas"], true).", 
		".sqlvalue(@$_POST["keterangan"], true).")";

$sqlresult = $db->Execute($sql2);  
//print $sql2;

/*** Tambahan ***/
$tmp_sql = " INSERT INTO `".$tmp_tbl_name_main."` (`id_fjl_05_main`, `tanggal`, `tahun`, `no_propinsi`, `no_kabupaten`,`id_jns_jln`) VALUES 
		((SELECT MAX(id_fjl_05_main) FROM ".$tbl_name_main."), ".sqlvalue($format_tgl, true).", ".sqlvalue(@$_POST["tahun"], true).", ".sqlvalue(@$_POST["no_propinsi"], false).", 
		".sqlvalue(@$_POST["no_kabupaten"], false).", 
		".sqlvalue(@$_POST["txt_hidden_jns_jln"], false).")";

$tmp_sqlresult = $db->Execute($tmp_sql);
/*** Disabled on 07-09-2010
				`biaya_dak`, 
				`biaya_pendamping`, 

		".sqlvalue(@$_POST["biaya_dak"], false).", 
		".sqlvalue(@$_POST["biaya_pendamping"], false).", 
***/
/*** Disabled on 22-09-2010
`target_unit`, 
		".sqlvalue(@$_POST["target_unit"], false).", 
***/
$tmp_sql2 = " INSERT INTO `".$tmp_tbl_name_detail."` (`id_fjl_05_detail`, `id_fjl_05_main`, 
				`nama_ruas`, 
				`nama_jenis_penanganan`
				`kecamatan_yg_dilalui`, 
				`target_m`, 

				`biaya_total`, 
				`sumber_pendanaan`,
				`metoda_pelaksanaan`, 
				`tanggal_spmk`, 
				`rencana_pho`, 
				`waktu_pelaksanaan`, 
				`pimpro`, 
				`kontraktor`, 
				`pengawas`, 
				`keterangan`) 
		VALUES (
		(SELECT MAX(id_fjl_05_detail) FROM ".$tbl_name_detail."),
		(SELECT MAX(id_fjl_05_main) FROM ".$tbl_name_main."),
		".sqlvalue(@$_POST["nama_paket"], true).", 
		".sqlvalue(@$_POST["nama_jenis_penanganan"], false).", 
		'".get_data_kecamatan2($_POST["jml_kecamatan"])."',
		".sqlvalue(@$_POST["target_m"], false).", 

		".sqlvalue(@$_POST["biaya_total"], false).",
		".sqlvalue(@$_POST["sumber_pendanaan"], false).",	
		".sqlvalue(@$_POST["metoda_pelaksanaan"], true).", 
		".sqlvalue($tanggal_spmk, true).", 
		".sqlvalue($rencana_pho, true).", 
		".sqlvalue(@$_POST["waktu_pelaksanaan"], false).", 
		".sqlvalue(@$_POST["pimpro"], true).", 
		".sqlvalue(@$_POST["kontraktor"], true).", 
		".sqlvalue(@$_POST["pengawas"], true).", 
		".sqlvalue(@$_POST["keterangan"], true).")";

$tmp_sqlresult = $db->Execute($tmp_sql2);  
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
	$get_sql		= " SELECT * FROM `".$tmp_tbl_name_main."` ORDER BY id_fjl_05_main ASC ";
	//print $get_sql;
	$get_recordSet 	= $tb_import->Execute($get_sql);
	@$count = $get_recordSet->RecordCount();

	if (@$count!='') {//if1
	$z=1;
	while ($arr=$get_recordSet->FetchRow()) {
		$sql_insert = " INSERT INTO `".$tbl_name_main."` (`tanggal`, `no_propinsi`, `no_kabupaten`, `catatan`, `id_jns_jln`) 
				VALUES (".sqlvalue(@$arr["tanggal"], true).", 
				".sqlvalue(@$arr["no_propinsi"], false).", ".sqlvalue(@$arr["no_kabupaten"], false).", ".sqlvalue(@$arr["catatan"], false).", ".sqlvalue(@$arr["id_jns_jln"], false).")";
		$sql_exec = $tb_import->Execute($sql_insert);
		
		$sql_detail	=  " SELECT * FROM `".$tmp_tbl_name_detail."` WHERE id_fjl_05_main='$arr[id_fjl_05_main]' ";
		$get_recordSet2	= $tb_import->Execute($sql_detail);
		if($get_recordSet2->RecordCount()>0){
			while ($arr2=$get_recordSet2->FetchRow()) {
				$sql_insert2 = " 
				INSERT INTO `".$tbl_name_detail."` (`id_fjl_05_main`, 
								`nama_ruas`, 
								`nama_jenis_penanganan`
								`kecamatan_yg_dilalui`, 
								`target_m`, 

								`biaya_total`, 
								`sumber_pendanaan`, 
								`metoda_pelaksanaan`, 
								`tanggal_spmk`, 
								`rencana_pho`, 
								`waktu_pelaksanaan`, 
								`pimpro`, 
								`kontraktor`, 
								`pengawas`, 
								`keterangan`) 
						VALUES (
						(SELECT MAX(id_fjl_05_main) FROM ".$tbl_name_main."),
						".sqlvalue(@$arr2["nama_paket"], true).", 
						".sqlvalue(@$arr2["nama_jenis_penanganan"], false).", 
						'".get_data_kecamatan2(@$arr2["jml_kecamatan"])."',
						".sqlvalue(@$arr2["target_m"], false).", 

						".sqlvalue(@$arr2["biaya_total"], false).", 
						".sqlvalue(@$arr2["sumber_pendanaan"], false).",
						".sqlvalue(@$arr2["metoda_pelaksanaan"], true) .", 
						".sqlvalue(@$arr2["tanggal_spmk"], true).", 
						".sqlvalue(@$arr2["rencana_pho"], true).", 
						".sqlvalue(@$arr2["waktu_pelaksanaan"], false) .", 
						".sqlvalue(@$arr2["pimpro"], true).", 
						".sqlvalue(@$arr2["kontraktor"], true).", 
						".sqlvalue(@$arr2["pengawas"], true).", 
						".sqlvalue(@$arr2["keterangan"], true).")				
				";
					
				$sql_exec2 = $tb_import->Execute($sql_insert2);
				
			}
		}
		//if($sql_exec){
		$sql_del = "DELETE FROM `".$tmp_tbl_name_detail."` WHERE id_fjl_05_main='$arr[id_fjl_05_main]' ";
				$sql_exec3 = $tb_import->Execute($sql_del);
			$sql_del2 = "DELETE FROM `".$tmp_tbl_name_main."` WHERE id_fjl_05_main='$arr[id_fjl_05_main]' ";
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
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Date_Year=".$_POST[tahun]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST["txt_hidden_jns_jln"]);
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_();
		//unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Date_Year=".$_POST[tahun]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST["txt_hidden_jns_jln"]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		//lockTables($tbl_name_main);
		delete_($_GET['id_fjl_05_main']);
		//unlockTables($tbl_name_main);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&no_kabupaten=".$_GET[no_kabupaten]."&Date_Year=".$_GET[Date_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST["txt_hidden_jns_jln"]);
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