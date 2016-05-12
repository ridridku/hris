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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_jl_09';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_jl_09';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name_main	= "tbl_form_jl_09_main";
$tbl_name_detail	= "tbl_form_jl_09_detail";
$tmp_tbl_name_main	= "tmp_tbl_form_jl_09_main";
$tmp_tbl_name_detail	= "tmp_tbl_form_jl_09_detail";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $mod_id;
global $db;
global $_POST;
global $tbl_name_main;
global $tbl_name_detail;

$sql  ="DELETE ";
$sql .="FROM ".$tbl_name_detail." ";
$sql .="WHERE id_fjl_09_detail = '$id'";

$sqlresult = $db->Execute($sql);
//print $sql;
}
//--------------------------------------------------------
function edit_(){
global $mod_id;
global $db;
global $_POST,$_GET;
global $tbl_name_main;
global $tbl_name_detail;

$tgl = explode("-",$_POST["tanggal"],strlen($_POST["tanggal"])); // dd-mm-YYYY
$tanggal = $tgl[2]."-".$tgl[1]."-".$tgl[0]; // YYYY-mm-dd

$sql = " UPDATE `".$tbl_name_main."` SET `tanggal`=" .sqlvalue($tanggal, true) .",
		`no_propinsi`=" .sqlvalue(@$_POST["no_propinsi"], false) .",
		`no_kabupaten`=" .sqlvalue(@$_POST["no_kabupaten"], false) .",
		`triwulan`=" .sqlvalue(@$_POST["triwulan"], false) .",
		`status_progres`=" .sqlvalue(@$_POST["status_progres"], true) ."
		WHERE " ."(`id_fjl_09_main`=" .sqlvalue(@$_POST["xid_jl_09_main"], false) .")";

$sqlresult = $db->Execute($sql);
//print $sql."<br>";

$sql  ="DELETE ";
$sql .="FROM ".$tbl_name_detail." ";
$sql .="WHERE id_fjl_09_main = '" .sqlvalue(@$_POST["xid_jl_09_main"], false) ."'";

$sqlresult = $db->Execute($sql);
//print $sql."<br>";

$sql = " INSERT INTO `".$tbl_name_detail."` (`id_fjl_09_main`, `nama_paket`, `tujuan`, `manfaat`, `keterangan`,`id_jns_jln`) VALUES ";

$data_query = "";
//print $jum_rows;
//echo "a";
for($i=0;$i<$_POST[jum_rows];$i++) {

	$data_query .= "(" .sqlvalue(@$_POST["xid_jl_09_main"], false) .",
		" .sqlvalue(@$_POST["no_paket_select_".$i], true) .",
		" .sqlvalue(@$_POST["tujuan_".$i], true) .",
		" .sqlvalue(@$_POST["manfaat_".$i], true) .",
		" .sqlvalue(@$_POST["keterangan_".$i], true) .",
		" .sqlvalue(@$_POST["no_jns_select_".$i], true) ."),";
}
$sqlresult = $db->Execute($sql.substr($data_query,0,-1));
//print $_POST[jum_rows];
//print $sql.substr($data_query,0,-1);
}

//-----------------------------------------------------------------------
function create_(){
global $mod_id;
global $db;
global $_POST,$_GET;
global $tbl_name_main;
global $tbl_name_detail;

$tgl = explode("-",$_POST["tanggal"],strlen($_POST["tanggal"])); // dd-mm-YYYY
$tanggal = $tgl[2]."-".$tgl[1]."-".$tgl[0]; // YYYY-mm-dd

$sql = " INSERT INTO `".$tbl_name_main."` (`tanggal`, `no_propinsi`, `no_kabupaten`, `triwulan`,
		`status_progres`) VALUES (
		" .sqlvalue($tanggal, true) .",
		" .sqlvalue(@$_POST["no_propinsi"], false) .",
		" .sqlvalue(@$_POST["no_kabupaten"], false) .",
		" .sqlvalue(@$_POST["triwulan"], false) .",
		" .sqlvalue(@$_POST["status_progres"], true) .")";

$sqlresult = $db->Execute($sql);
//print $sql."<br>";

$sql = " INSERT INTO `".$tbl_name_detail."` (`id_fjl_09_main`, `nama_paket`, `tujuan`, `manfaat`, `keterangan`,`id_jns_jln`) VALUES ";
$data_query = "";

for($i=0;$i<$_POST[jum_rows];$i++) {

	$data_query .= "(LAST_INSERT_ID(),
		" .sqlvalue(@$_POST["no_paket_select_".$i], true) .",
		" .sqlvalue(@$_POST["tujuan_".$i], true) .",
		" .sqlvalue(@$_POST["manfaat_".$i], true) .",
		" .sqlvalue(@$_POST["keterangan_".$i], true) .",
		" .sqlvalue(@$_POST["no_jns_select_".$i], true) ."),";
}
$sqlresult = $db->Execute($sql.substr($data_query,0,-1));
//print $_POST[jum_rows];
//print $sql.substr($data_query,0,-1);
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
	$conn=mysql_connect($_POST['hostname1'],$_POST['username1'],$_POST['password1']);
	//$tb_import->debug = true;
	if(!$conn)
    {
 Header("Location:index.php?status_error=1&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]."&triwulan_search=".$_POST["triwulan"]);
    }


//=================================================================
    else//6
	{
	$SES_NO_PROP	= $_SESSION['SESSION_NO_PROPINSI'];
	$get_sql		= " SELECT * FROM tbl_form_jl_09_main where no_propinsi=".$SES_NO_PROP ;
	//print $get_sql;
	$get_recordSet 	= $db->Execute($get_sql);
	@$count = $get_recordSet->RecordCount();
	
	if (@$count!='') {//5
	$z=1;
	while ($arr=$get_recordSet->FetchRow()) {//4
	//cek data di pusat
	$sql_cek="select * from tbl_form_jl_09_main where id_auto_daerah=".sqlvalue(@$arr["id_fjl_09_main"], true)." AND no_propinsi=".sqlvalue(@$arr["no_propinsi"], true)." and no_kabupaten=".sqlvalue(@$arr["no_kabupaten"], true);
	$rs_cari =   	$tb_import->Execute($sql_cek); 
                    $id_auto_daerah = $rs_cari->fields['id_auto_daerah'];
					$id_k_01_main_cek = $rs_cari->fields['id_fjl_09_main'];
					
					if ($id_auto_daerah !='') { //data sudah ada di pusat
	// script update DI PUSAT
					$tmp_sql = " UPDATE tbl_form_jl_09_main SET tanggal='".$arr[tanggal]."', ";
					$tmp_aql.= " no_propinsi ='".$arr[no_propinsi]."',"; 
					$tmp_sql.= " no_kabupaten ='".$arr[no_kabupaten]."',";
					$tmp_sql.= " triwulan ='".$arr[triwulan]."',";
					$tmp_sql.= " status_progres ='".$arr[status_progres]."',";
					$tmp_sql.= " WHERE id_auto_daerah='".$arr[id_fjl_09_main]."'";
		
					$tmp_sqlresult = $tb_import->Execute($tmp_sql);
					
					//$sql_del = "DELETE FROM tbl_form_jl_05_detail WHERE id_fjl_05_main='$id_k_01_main_cek' ";
					//$tb_import->Execute($sql_del);
					}else
					{
					//simpan di tabel asli server
							$sql_insert = " INSERT INTO `".$tbl_name_main."` (`tanggal`, `no_propinsi`, `no_kabupaten`, `triwulan`, `status_progres`, id_auto_daerah) 
							VALUES (".sqlvalue(@$arr["tanggal"], true).", 
									".sqlvalue(@$arr["no_propinsi"], false).", 
									".sqlvalue(@$arr["no_kabupaten"], false).", 
									".sqlvalue(@$arr["triwulan"], false).", 
									".sqlvalue(@$arr["status_progres"], false).", 
									".sqlvalue(@$arr["id_fjl_09_main"], false) .")";
									$sql_exec = $tb_import->Execute($sql_insert);

					}
					//cari detail di local atw daerah
					  $sql_detail	    =  " SELECT * FROM tbl_form_jl_09_detail WHERE id_fjl_09_main='".$arr[id_fjl_09_main]."' "; //ambil di localhost
					  $get_recordSet2	= $db->Execute($sql_detail);
		

		if($get_recordSet2->RecordCount()>0){//3
			while ($arr2=$get_recordSet2->FetchRow()) {//2
			if ($id_auto_daerah !='') { //jika  data induk sudah ada  1
			//SIMPAN DI TABEL ASLI SERVER
									$sql_insert2  = " update tbl_form_jl_09_detail set ";
									
									$sql_insert2 .= "  nama_paket='".sqlvalue(@$arr2[nama_paket], true)."',"; 
									$sql_insert2 .= "  tujuan='".sqlvalue(@$arr2[tujuan], true)."',"; 
									$sql_insert2 .= "  manfaat='".sqlvalue(@$arr2[manfaat], true)."',"; 
									$sql_insert2 .= "  keterangan='".sqlvalue(@$arr2[keterangan], true)."',"; 
									$sql_insert2 .= "  id_jns_jln='".sqlvalue(@$arr2[id_jns_jln], true)."',"; 
									$sql_insert2 .= " WHERE id_auto_daerah='".$arr[id_fjl_09_main]."'";
									 
									$tmp_sqlresult = $tb_import->Execute($sql_insert2);
							/*} else { //jika data belum ada else 2
								$sql_insert2 =  " INSERT INTO tbl_form_jl_09_detail (id_fjl_09_main,nama_paket,tujuan,manfaat, 
		keterangan,id_jns_jln, id_auto_daerah) VALUES (
		(SELECT MAX(id_fjl_09_main) FROM ".$tbl_name_main."), 

		" .sqlvalue(@$arr2[nama_paket], false) .", 
		" .sqlvalue(@$arr2[tujuan], false) .", 
		" .sqlvalue(@$arr2[manfaat], false) .", 
		" .sqlvalue(@$arr2[keterangan], false) .", 
		" .sqlvalue(@$arr2[id_jns_jln], false) .",  
		" .sqlvalue(@$arr[id_fjl_09_main], false) .")";*/
		} else { //jika data belum ada else 2
								$sql_insert2 =  " INSERT INTO tbl_form_jl_09_detail (id_fjl_09_main,nama_paket, tujuan, manfaat, 
		keterangan, id_jns_jln, id_auto_daerah) VALUES ((SELECT MAX(id_fjl_09_main) FROM ".$tbl_name_main."),'" .sqlvalue(@$arr2[nama_paket], false) ."',  '" .sqlvalue(@$arr2["tujuan"], false) ."','" .sqlvalue(@$arr2["manfaat"], false) ."'," .sqlvalue(@$arr2["keterangan"], true) .", " .sqlvalue(@$arr2["id_jns_jln"], true) .", " .sqlvalue(@$arr[id_fjl_09_main], false) .")";
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

for($i=0;$i<$_POST[jum_rows];$i++) {
	$j2[$i]= $_POST["no_jns_select_".$i];
}
$jenis	= $j2[0];

switch ($op){

case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
		//lockTables($tbl_name_main);
		//lockTables($tbl_name_detail);
		create_();
		//unlockTables($tbl_name_main);
		//unlockTables($tbl_name_detail);
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&triwulan_search=".$_POST[triwulan_search]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$jenis."&triwulan_search=".$_POST[triwulan_search]);
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_();
		//unlockTables($tbl_name);
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&triwulan_search=".$_POST[triwulan_search]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$jenis."&triwulan_search=".$_POST[triwulan_search]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		//lockTables($tbl_name_main);
		delete_($_GET['id_fjl_09_detail']);
		//unlockTables($tbl_name_main);
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&no_kabupaten=".$_GET[no_kabupaten]."&Search_Year=".$_GET[Search_Year]."&triwulan_search=".$_GET[triwulan_search]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$jenis."&triwulan_search=".$_POST[triwulan_search]);
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