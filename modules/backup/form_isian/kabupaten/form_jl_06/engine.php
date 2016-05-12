<?php
/*** Modify 24-06-2010, Last Modify 11-07-2010
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_jl_06';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_jl_06';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name_main	= "tbl_form_jl_06_main";
$tbl_name_detail	= "tbl_form_jl_06_detail";
$tmp_tbl_name_main	= "tmp_tbl_form_jl_06_main";
$tmp_tbl_name_detail	= "tmp_tbl_form_jl_06_detail";
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
$sql .="WHERE id_fjl_06_main = '$id'";
//$sqlresult = $db->Execute($sql);
$tmp_sql  = " DELETE FROM ".$tmp_tbl_name_main." WHERE id_fjl_06_main='{$id}' " ;

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
/***
$tgl2 = explode("-",$_POST["status_progres"],strlen($_POST["status_progres"])); // dd-mm-YYYY
$format_tgl2 = $tgl2[2]."-".$tgl2[1]."-".$tgl2[0]; // YYYY-mm-dd
***/
$sql = " UPDATE `".$tbl_name_main."` SET `tanggal`=" .sqlvalue($format_tgl, true) .", 
		`no_propinsi`=".sqlvalue(@$_POST["no_propinsi"], false).", 
		`no_kabupaten`=".sqlvalue(@$_POST["no_kabupaten"], false).", 
		`triwulan`=".sqlvalue(@$_POST["triwulan"], false).", 
		`status_progres`=".sqlvalue(@$_POST["status_progres"], true).",
		`id_jns_jln`=".sqlvalue(@$_POST['txt_hidden_jns_jln'], false)."
		WHERE " ."(`id_fjl_06_main`=".sqlvalue(@$_POST["xid_jl_06_main"], false).")";
		
$sqlresult = $db->Execute($sql);

$sql = " UPDATE `".$tbl_name_detail."` SET `nama_paket`=".sqlvalue(@$_POST["nama_paket"], true).", 
		`target_km`=".sqlvalue(@$_POST["target_km"], false).", 
		`target_m`=".sqlvalue(@$_POST["target_m"], false).", 
		`biaya`=".sqlvalue(@$_POST["biaya"], false).", 
		`rencana_fisik`=".sqlvalue(@$_POST["rencana_fisik"], false).", 
		`rencana_keuangan`=".sqlvalue(@$_POST["rencana_keuangan"], false).", 
		`realisasi_fisik`=".sqlvalue(@$_POST["realisasi_fisik"], false).", 
		`realisasi_keuangan`=".sqlvalue(@$_POST["realisasi_keuangan"], false).", 
		`deviasi_fisik`=".sqlvalue(@$_POST["deviasi_fisik"], false).", 
		`deviasi_keuangan`=".sqlvalue(@$_POST["deviasi_keuangan"], false).", 
		`masalah`=".sqlvalue(@$_POST["masalah"], true).", 
		`jumlah_tenaga`=".sqlvalue(@$_POST["jumlah_tenaga"], false).", 
		`keterangan`=".sqlvalue(@$_POST["keterangan"], true)." 
		WHERE " ."(`id_fjl_06_detail`=".sqlvalue(@$_POST["xid_form_jl_06_detail"], false).")";
		
$sqlresult = $db->Execute($sql);

/*** Tambahan ***/
$tmp_sql = " UPDATE `".$tmp_tbl_name_main."` SET `tanggal`=".sqlvalue($format_tgl, true).", 
		`no_propinsi`=".sqlvalue(@$_POST["no_propinsi"], false).", 
		`no_kabupaten`=".sqlvalue(@$_POST["no_kabupaten"], false).", 
		`triwulan`=".sqlvalue(@$_POST["triwulan"], false).", 
		`status_progres`=".sqlvalue(@$_POST["status_progres"], true).",
		`id_jns_jln`=".sqlvalue(@$_POST['txt_hidden_jns_jln'], false)."
		WHERE " ."(`id_fjl_06_main`=".sqlvalue(@$_POST["xid_jl_06_main"], false).")";
		
$tmp_sqlresult = $db->Execute($tmp_sql);

$tmp_sql = " UPDATE `".$tmp_tbl_name_detail."` SET `nama_paket`=".sqlvalue(@$_POST["nama_paket"], true).", 
		`target_km`=".sqlvalue(@$_POST["target_km"], false).", 
		`target_m`=".sqlvalue(@$_POST["target_m"], false).", 
		`biaya`=".sqlvalue(@$_POST["biaya"], false).", 
		`rencana_fisik`=".sqlvalue(@$_POST["rencana_fisik"], false).", 
		`rencana_keuangan`=".sqlvalue(@$_POST["rencana_keuangan"], false).", 
		`realisasi_fisik`=".sqlvalue(@$_POST["realisasi_fisik"], false).", 
		`realisasi_keuangan`=".sqlvalue(@$_POST["realisasi_keuangan"], false).", 
		`deviasi_fisik`=".sqlvalue(@$_POST["deviasi_fisik"], false).", 
		`deviasi_keuangan`=".sqlvalue(@$_POST["deviasi_keuangan"], false).", 
		`masalah`=".sqlvalue(@$_POST["masalah"], true).", 
		`jumlah_tenaga`=".sqlvalue(@$_POST["jumlah_tenaga"], false).", 
		`keterangan`=".sqlvalue(@$_POST["keterangan"], true)." 
		WHERE " ."(`id_fjl_06_detail`=".sqlvalue(@$_POST["xid_form_jl_06_detail"], false).")";
		
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
$format_tgl = $tgl[2]."-".$tgl[1]."-".$tgl[0]; // YYYY-mm-dd


$sql = " INSERT INTO `".$tbl_name_main."` (`tanggal`, `no_propinsi`, `no_kabupaten`, `triwulan`, 
		`status_progres`, `id_jns_jln`) 
		 VALUES (
		 " .sqlvalue($format_tgl, true) .", 
		 " .sqlvalue(@$_POST["no_propinsi"], false) .", 
		 " .sqlvalue(@$_POST["no_kabupaten"], false) .", 
		" .sqlvalue(@$_POST["triwulan"], false) .", 
		" .sqlvalue(@$_POST["status_progres"], true) .",
		".sqlvalue(@$_POST["txt_hidden_jns_jln"], false).")"; 
		

$sqlresult = $db->Execute($sql);
/*$sql1 = "SELECT * FROM tbl_form_jl_05_main a LEFT JOIN tbl_form_jl_05_detail b ON 					
	a.id_fjl_05_main=b.id_fjl_05_main LEFT JOIN tbl_mast_prop_jenis_penanganan c ON c.id_prop_jenis_penanganan=b.nama_jenis_penanganan WHERE (a.no_propinsi='".$no_propinsi."' $f_no_prov) AND (a.no_kabupaten='".$no_kabupaten."' $f_no_kabta) AND YEAR(a.tanggal)='".$tahun."' $f_id_jns_jln AND b.id_fjl_05_detail IS NOT NULL";*/
	
$sql = " INSERT INTO `".$tbl_name_detail."` (`id_fjl_06_main`, `nama_paket`, `target_km`, `target_m`, `biaya`, 
		`rencana_fisik`, `rencana_keuangan`, `realisasi_fisik`, `realisasi_keuangan`, `deviasi_fisik`, 
		`deviasi_keuangan`, `masalah`, `jumlah_tenaga`, `keterangan`) VALUES (
		(SELECT MAX(id_fjl_06_main) FROM ".$tbl_name_main."), 
		".sqlvalue(@$_POST["nama_paket"], true).", 
		".sqlvalue(@$_POST["target_km"], false).", 
		".sqlvalue(@$_POST["target_m"], false).", 
		".sqlvalue(@$_POST["biaya"], false).", 
		".sqlvalue(@$_POST["rencana_fisik"], false).", 
		".sqlvalue(@$_POST["rencana_keuangan"], false).", 
		".sqlvalue(@$_POST["realisasi_fisik"], false).", 
		".sqlvalue(@$_POST["realisasi_keuangan"], false).", 
		".sqlvalue(@$_POST["deviasi_fisik"], false).", 
		".sqlvalue(@$_POST["deviasi_keuangan"], false).", 
		".sqlvalue(@$_POST["masalah"], true).", 
		".sqlvalue(@$_POST["jumlah_tenaga"], false).", 
		".sqlvalue(@$_POST["keterangan"], true).")";

$sqlresult = $db->Execute($sql);  

/*** Tambahan **/
$tmp_sql = " INSERT INTO `".$tmp_tbl_name_main."` (`id_fjl_06_main`, `tanggal`, `no_propinsi`, `no_kabupaten`,`triwulan`, 
		`status_progres`, `id_jns_jln`) VALUES (
		(SELECT MAX(id_fjl_06_main) FROM ".$tbl_name_main."),
		".sqlvalue($format_tgl, true).", 
		".sqlvalue(@$_POST["no_propinsi"], false).", 
		".sqlvalue(@$_POST["no_kabupaten"], false).", 
		".sqlvalue(@$_POST["triwulan"], false).", 
		".sqlvalue(@$_POST["status_progres"], true).",
		".sqlvalue(@$_POST["txt_hidden_jns_jln"], false).")";

$tmp_sqlresult = $db->Execute($tmp_sql);

$tmp_sql = " INSERT INTO `".$tmp_tbl_name_detail."` (`id_fjl_06_detail`, `id_fjl_06_main`, `nama_paket`, `target_km`, `target_m`, `biaya`, 
		`rencana_fisik`, `rencana_keuangan`, `realisasi_fisik`, `realisasi_keuangan`, `deviasi_fisik`, 
		`deviasi_keuangan`, `masalah`, `jumlah_tenaga`, `keterangan`) VALUES (
		(SELECT MAX(id_fjl_06_detail) FROM ".$tbl_name_detail."),
		(SELECT MAX(id_fjl_06_main) FROM ".$tbl_name_main."), 
		".sqlvalue(@$_POST["nama_paket"], true).", 
		".sqlvalue(@$_POST["target_km"], false).", 
		".sqlvalue(@$_POST["target_m"], false).", 
		".sqlvalue(@$_POST["biaya"], false).", 
		".sqlvalue(@$_POST["rencana_fisik"], false).", 
		".sqlvalue(@$_POST["rencana_keuangan"], false).", 
		".sqlvalue(@$_POST["realisasi_fisik"], false).", 
		".sqlvalue(@$_POST["realisasi_keuangan"], false).", 
		".sqlvalue(@$_POST["deviasi_fisik"], false).", 
		".sqlvalue(@$_POST["deviasi_keuangan"], false).", 
		".sqlvalue(@$_POST["masalah"], true).", 
		".sqlvalue(@$_POST["jumlah_tenaga"], false).", 
		".sqlvalue(@$_POST["keterangan"], true).")";

$tmp_sqlresult = $db->Execute($tmp_sql);  
/*** End 0f Tambahan**/
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

      Header("Location:index.php?status_error=1&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]."&triwulan_search=".$_POST["triwulan"]);

    }

    else//6
	{
	$SES_NO_PROP	= $_SESSION['SESSION_NO_PROPINSI'];
	$get_sql		= " SELECT * FROM tbl_form_jl_06_main where no_propinsi=".$SES_NO_PROP ;
	//print $get_sql;
	$get_recordSet 	= $db->Execute($get_sql);
	@$count = $get_recordSet->RecordCount();
	
	if (@$count!='') {//5
	$z=1;
	while ($arr=$get_recordSet->FetchRow()) {//4
	//cek data di pusat
	$sql_cek="select * from tbl_form_jl_06_main where id_auto_daerah=".sqlvalue(@$arr["id_fjl_06_main"], true)." AND no_propinsi=".sqlvalue(@$arr["no_propinsi"], true)." and no_kabupaten=".sqlvalue(@$arr["no_kabupaten"], true);
	$rs_cari =   	$tb_import->Execute($sql_cek); 
                    $id_auto_daerah = $rs_cari->fields['id_auto_daerah'];
					$id_k_01_main_cek = $rs_cari->fields['id_fjl_06_main'];
					
					if ($id_auto_daerah !='') { //data sudah ada di pusat
	// script update DI PUSAT
					$tmp_sql = " UPDATE tbl_form_jl_06_main SET tanggal='".$arr[tanggal]."', ";
					$tmp_aql.= " no_propinsi ='".$arr[no_propinsi]."',"; 
					$tmp_sql.= " no_kabupaten ='".$arr[no_kabupaten]."',";
					$tmp_sql.= " triwulan ='".$arr[triwulan]."',";
					$tmp_sql.= " status_progres ='".$arr[status_progres]."',";
					$tmp_sql.= " catatan ='".$arr[catatan]."',";
					$tmp_sql.= " id_jns_jln ='".$arr[id_jns_jln]."'";
					$tmp_sql.= " WHERE id_auto_daerah='".$arr[id_fjl_06_main]."'";
		
					$tmp_sqlresult = $tb_import->Execute($tmp_sql);
					
					//$sql_del = "DELETE FROM tbl_form_jl_05_detail WHERE id_fjl_05_main='$id_k_01_main_cek' ";
					//$tb_import->Execute($sql_del);
					}else
					{
					//simpan di tabel asli server
							$sql_insert = " INSERT INTO `".$tbl_name_main."` (`tanggal`, `no_propinsi`, `no_kabupaten`, `triwulan`, `status_progres`, `catatan`, `id_jns_jln`, id_auto_daerah) 
							VALUES (".sqlvalue(@$arr["tanggal"], true).", 
									".sqlvalue(@$arr["no_propinsi"], false).", 
									".sqlvalue(@$arr["no_kabupaten"], false).", 
									".sqlvalue(@$arr["triwulan"], false).", 
									".sqlvalue(@$arr["status_progres"], false).", 
									".sqlvalue(@$arr["catatan"], false).", 
									".sqlvalue(@$arr["id_jns_jln"], false).", 
									".sqlvalue(@$arr["id_fjl_06_main"], false) .")";
									$sql_exec = $tb_import->Execute($sql_insert);

					}
					//cari detail di local atw daerah
					  $sql_detail	    =  " SELECT * FROM tbl_form_jl_06_detail WHERE id_fjl_06_main='$arr[id_fjl_06_main]' "; //ambil di localhost
					  $get_recordSet2	= $db->Execute($sql_detail);
		

		if($get_recordSet2->RecordCount()>0){//3
			while ($arr2=$get_recordSet2->FetchRow()) {//2
			if ($id_auto_daerah !='') { //jika  data induk sudah ada  1
			//SIMPAN DI TABEL ASLI SERVER
									$sql_insert2  = " update tbl_form_jl_06_detail set ";
									$sql_insert2 .= "  nama_paket='".sqlvalue(@$arr2[nama_paket], true)."',"; 
									$sql_insert2 .= "  target_km='".sqlvalue(@$arr2[target_km], true)."',"; 
									$sql_insert2 .= "  target_m='".sqlvalue(@$arr2[target_m], true)."',"; 
									$sql_insert2 .= "  biaya='".sqlvalue(@$arr2[biaya], true)."',"; 
									$sql_insert2 .= "  target_unit='".sqlvalue(@$arr2[target_unit], true)."',"; 
									$sql_insert2 .= "  biaya_total='".sqlvalue(@$arr2[biaya_total], true)."',"; 
									$sql_insert2 .= "  rencana_fisik='".sqlvalue(@$arr2[rencana_fisik], true)."',"; 
									$sql_insert2 .= "  rencana_keuangan='".sqlvalue(@$arr2[rencana_keuangan], true)."',"; 
									$sql_insert2 .= "  realisasi_fisik='".sqlvalue(@$arr2[realisasi_fisik], true)."',"; 
									$sql_insert2 .= "  realisasi_keuangan='".sqlvalue(@$arr2[realisasi_keuangan], true)."',";
									$sql_insert2 .= "  deviasi_fisik='".sqlvalue(@$arr2[deviasi_fisik], true)."',";
									$sql_insert2 .= "  deviasi_keuangan='".sqlvalue(@$arr2[deviasi_keuangan], true)."',";
									$sql_insert2 .= "  masalah='".sqlvalue(@$arr2[masalah], true)."',";
									$sql_insert2 .= "  jumlah_tenaga='".sqlvalue(@$arr2[jumlah_tenaga], true)."',";
									$sql_insert2 .= "  keterangan='".sqlvalue(@$arr2[keterangan], true)."'";
									$sql_insert2 .= " WHERE id_auto_daerah='".$arr[id_fjl_06_main]."'";
									 
									$tmp_sqlresult = $tb_import->Execute($sql_insert2);
							} else { //jika data belum ada else 2
				$sql_insert2 = " INSERT INTO tbl_form_jl_06_detail (`id_fjl_06_main`, `nama_paket`, `target_km`, `target_m`, `biaya`, 
						`rencana_fisik`, `rencana_keuangan`, `realisasi_fisik`, `realisasi_keuangan`, `deviasi_fisik`, 
						`deviasi_keuangan`, `masalah`, `jumlah_tenaga`, `keterangan`,id_auto_daerah) VALUES (
						(SELECT MAX(id_fjl_06_main) FROM ".$tbl_name_main."), 
						".sqlvalue(@$arr2["nama_paket"], true).", 
						".sqlvalue(@$arr2["target_km"], false).", 
						".sqlvalue(@$arr2["target_m"], false).", 
						".sqlvalue(@$arr2["biaya"], false).", 
						".sqlvalue(@$arr2["rencana_fisik"], false).", 
						".sqlvalue(@$arr2["rencana_keuangan"], false).", 
						".sqlvalue(@$arr2["realisasi_fisik"], false).", 
						".sqlvalue(@$arr2["realisasi_keuangan"], false).", 
						".sqlvalue(@$arr2["deviasi_fisik"], false).", 
						".sqlvalue(@$arr2["deviasi_keuangan"], false).", 
						".sqlvalue(@$arr2["masalah"], true).", 
						".sqlvalue(@$arr2["jumlah_tenaga"], false).", 
						".sqlvalue(@$arr2["keterangan"], true).",
						".sqlvalue(@$arr[id_fjl_06_main], true).") ";
				$sql_exec2 = $tb_import->Execute($sql_insert2);
				}//1
						}//2
				}//3
				$z++;
			}//4
				Header("Location:index.php?status_error=3&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]."&triwulan_search=".$_POST["triwulan"]);
		} else {
			
			//echo "Tidak ada data yang akan di eksport";

		 Header("Location:index.php?status_error=2&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]."&triwulan_search=".$_POST["triwulan"]);
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
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Date_Year=".$_POST[Date_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST["jns_jln"]."&triwulan_search=".$_POST["triwulan"]);
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_();
		//unlockTables($tbl_name);
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Date_Year=".$_POST[Date_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST["txt_hidden_jns_jln"]."&triwulan_search=".$_POST["triwulan"]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		//lockTables($tbl_name_main);
		delete_($_GET['id_fjl_06_main']);
		//unlockTables($tbl_name_main);
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&no_kabupaten=".$_GET[no_kabupaten]."&Date_Year=".$_GET[Date_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST["txt_hidden_jns_jln"]."&triwulan_search=".$_POST["triwulan"]);
	}
break;
case 3:
		//lockTables($tbl_name);
		import_();
		//unlockTables($tbl_name);
		//Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST["txt_hidden_jns_jln"]."&triwulan_search=".$_POST["triwulan_search"]);
break;
}
}

?>