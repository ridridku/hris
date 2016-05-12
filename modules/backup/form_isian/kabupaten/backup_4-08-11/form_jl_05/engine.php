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

		
		$sql_insert2 = " INSERT INTO tbl_form_jl_05_detail (id_fjl_05_main, nama_ruas, 
									nama_jenis_penanganan, kecamatan_yg_dilalui,target_m, 
									target_unit,biaya_total,sumber_pendanaan,metoda_pelaksanaan,tanggal_spmk,rencana_pho,
									waktu_pelaksanaan,pimpro,kontraktor,pengawas,keterangan,id_auto_daerah) VALUES (  
									(SELECT MAX(id_fjl_05_main) FROM  tbl_form_jl_05_main) ," .sqlvalue(@$_POST["nama_paket"], true) .", 
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
									$sqlresult = $db->Execute($sql_insert2);


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

        Header("Location:index.php?status_error=1&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);

    }

    else//else 6
	{
	$SES_NO_PROP	= $_SESSION['SESSION_NO_PROPINSI'];
	$get_sql		= " SELECT * FROM tbl_form_jl_05_main where no_propinsi=".$SES_NO_PROP ;
	//print $get_sql;
	$get_recordSet 	= $db->Execute($get_sql);
	@$count = $get_recordSet->RecordCount();

	if (@$count!='') {//if5
	$z=1;
	while ($arr=$get_recordSet->FetchRow()) {//4
	//cek data di pusat
	$sql_cek="select * from tbl_form_jl_05_main where id_auto_daerah=".sqlvalue(@$arr["id_fjl_05_main"], true)." AND no_propinsi=".sqlvalue(@$arr["no_propinsi"], true)." and no_kabupaten=".sqlvalue(@$arr["no_kabupaten"], true);
	$rs_cari =   	$tb_import->Execute($sql_cek); 
                    $id_auto_daerah = $rs_cari->fields['id_auto_daerah'];
					$id_k_01_main_cek = $rs_cari->fields['id_fjl_05_main'];
					
					if ($id_auto_daerah !='') { //data sudah ada di pusat
					// script update DI PUSAT
					$tmp_sql = " UPDATE tbl_form_jl_05_main SET tanggal='".$arr[tanggal]."', ";
					$tmp_sql.= " tahun ='".$arr[tahun]."',"; 
					$tmp_aql.= " no_propinsi ='".$arr[no_propinsi]."',"; 
					$tmp_sql.= " no_kabupaten ='".$arr[no_kabupaten]."',";
					$tmp_sql.= " id_jns_jln ='".$arr[id_jns_jln]."'";
					$tmp_sql.= " WHERE id_auto_daerah='".$arr[id_fjl_05_main]."'";
		
					$tmp_sqlresult = $tb_import->Execute($tmp_sql);
					
					//$sql_del = "DELETE FROM tbl_form_jl_05_detail WHERE id_fjl_05_main='$id_k_01_main_cek' ";
					//$tb_import->Execute($sql_del);
					}else
					{
					//simpan di tabel asli server
							$sql_insert = " INSERT INTO tbl_form_jl_05_main (`tanggal`, `tahun`, `no_propinsi`, `no_kabupaten`, `id_jns_jln` , id_auto_daerah ) 
							 VALUES (" .sqlvalue(@$arr["tanggal"], true) .", " .sqlvalue(@$arr["tahun"], true) .", 
							 " .sqlvalue(@$arr["no_propinsi"], false) .", " .sqlvalue(@$arr["no_kabupaten"], false) .", " .sqlvalue(@$arr["id_jns_jln"], false) ." , " .sqlvalue(@$arr["id_fjl_05_main"], false) ." )";
							$sqlexec3 = $tb_import->Execute($sql_insert);

					}
					
					 //cari detail di local atw daerah
					  $sql_detail	    =  " SELECT * FROM tbl_form_jl_05_detail WHERE id_fjl_05_main='$arr[id_fjl_05_main]' "; //ambil di localhost
					  $get_recordSet2	= $db->Execute($sql_detail);
					  
					if($get_recordSet2->RecordCount()>0){//if 3
						while ($arr2=$get_recordSet2->FetchRow()) {//2
						if ($id_auto_daerah !='') { //jika  data induk sudah ada  1
									//SIMPAN DI TABEL ASLI SERVER
									$sql_insert2  = " update tbl_form_jl_05_detail set ";
									$sql_insert2 .= "  nama_ruas='".sqlvalue(@$arr2[nama_ruas], true)."',"; 
									$sql_insert2 .= "  nama_jenis_penanganan='".sqlvalue(@$arr2[nama_jenis_penanganan], true)."',"; 
									$sql_insert2 .= "  kecamatan_yg_dilalui='".sqlvalue(@$arr2[kecamatan_yg_dilalui], true)."',"; 
									$sql_insert2 .= "  target_m='".sqlvalue(@$arr2[target_m], true)."',"; 
									$sql_insert2 .= "  target_unit='".sqlvalue(@$arr2[target_unit], true)."',"; 
									$sql_insert2 .= "  biaya_total='".sqlvalue(@$arr2[biaya_total], true)."',"; 
									$sql_insert2 .= "  sumber_pendanaan='".sqlvalue(@$arr2[sumber_pendanaan], true)."',"; 
									$sql_insert2 .= "  metoda_pelaksanaan='".sqlvalue(@$arr2[metoda_pelaksanaan], true)."',"; 
									$sql_insert2 .= "  tanggal_spmk='".sqlvalue(@$arr2[tanggal_spmk], true)."',"; 
									$sql_insert2 .= "  rencana_pho='".sqlvalue(@$arr2[rencana_pho], true)."',";
									$sql_insert2 .= "  waktu_pelaksanaan='".sqlvalue(@$arr2[waktu_pelaksanaan], true)."',";
									$sql_insert2 .= "  pimpro='".sqlvalue(@$arr2[pimpro], true)."',";
									$sql_insert2 .= "  kontraktor='".sqlvalue(@$arr2[kontraktor], true)."',";
									$sql_insert2 .= "  pengawas='".sqlvalue(@$arr2[pengawas], true)."',";
									$sql_insert2 .= "  keterangan='".sqlvalue(@$arr2[keterangan], true)."',";
									$sql_insert2 .= " WHERE id_auto_daerah='".$arr[id_fjl_05_main]."'";
									 
									$tmp_sqlresult = $tb_import->Execute($sql_insert2);
							} else { //jika data belum ada else 2
							
									//SIMPAN DI TABEL ASLI SERVER
									$sql_insert2 = " INSERT INTO tbl_form_jl_05_detail (id_fjl_05_main, nama_ruas, 
									nama_jenis_penanganan, kecamatan_yg_dilalui,target_m, 
									target_unit,biaya_total,sumber_pendanaan,metoda_pelaksanaan,tanggal_spmk,rencana_pho,
									waktu_pelaksanaan,pimpro,kontraktor,pengawas,keterangan,id_auto_daerah) VALUES (  
									(SELECT MAX(id_fjl_05_main) FROM  tbl_form_jl_05_main) ," .sqlvalue(@$arr2[nama_ruas], true) .", 
									" .sqlvalue(@$arr2[nama_jenis_penanganan], true) .",
									" .sqlvalue(@$arr2[kecamatan_yg_dilalui], true) .", 
									" .sqlvalue(@$arr2[target_m], true) .", 
									" .sqlvalue(@$arr2[target_unit], true) .", 
									" .sqlvalue(@$arr2[biaya_total], true).", 
									" .sqlvalue(@$arr2[sumber_pendanaan], true).", 
									" .sqlvalue(@$arr2[metoda_pelaksanaan], true).", 
									" .sqlvalue(@$arr2[tanggal_spmk], true).", 
									" .sqlvalue(@$arr2[rencana_pho], true).", 
									" .sqlvalue(@$arr2[waktu_pelaksanaan], true).", 				
									" .sqlvalue(@$arr2[pimpro], true).", 
									" .sqlvalue(@$arr2[kontraktor], true).", 
									" .sqlvalue(@$arr2[pengawas], true).", 
									" .sqlvalue(@$arr2[keterangan], true).",
									" .sqlvalue(@$arr[id_fjl_05_main], true).") ";
									$sql_exec2 = $tb_import->Execute($sql_insert2);
									}//1
						}//2
				}//3
				$z++;
			}//4
			Header("Location:index.php?status_error=3&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);
			} else {
			
			//echo "Tidak ada data yang akan di eksport";
			Header("Location:index.php?status_error=2&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);

		}//5
	}	//6
}//7



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