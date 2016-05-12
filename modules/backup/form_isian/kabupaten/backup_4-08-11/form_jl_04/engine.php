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
	$conn=mysql_connect($_POST['hostname1'],$_POST['username1'],$_POST['password1']);
	if(!$conn)
    {

       Header("Location:index.php?status_error=1&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);

    }
			//=================================
			 else//else 6
	{
	$SES_NO_PROP	= $_SESSION['SESSION_NO_PROPINSI'];
	$get_sql		= " SELECT * FROM tbl_form_jl_04_main where no_propinsi=".$SES_NO_PROP ;
	//print $get_sql;
	$get_recordSet 	= $db->Execute($get_sql);
	@$count = $get_recordSet->RecordCount();

	if (@$count!='') {//if5
	$z=1;
	while ($arr=$get_recordSet->FetchRow()) {//4
	//cek data di pusat
	$sql_cek="select * from tbl_form_jl_04_main where id_auto_daerah=".sqlvalue(@$arr["id_fjl_04_main"], true)." AND no_propinsi=".sqlvalue(@$arr["no_propinsi"], true)." and no_kabupaten=".sqlvalue(@$arr["no_kabupaten"], true);
	$rs_cari =   	$tb_import->Execute($sql_cek); 
                    $id_auto_daerah = $rs_cari->fields['id_auto_daerah'];
					$id_k_01_main_cek = $rs_cari->fields['id_fjl_04_main'];
					
					if ($id_auto_daerah !='') { //data sudah ada di pusat
					// script update DI PUSAT
					$tmp_sql = " UPDATE tbl_form_jl_04_main SET tanggal='".$arr[tanggal]."', ";
					$tmp_aql.= " no_propinsi ='".$arr[no_propinsi]."',"; 
					$tmp_sql.= " no_kabupaten ='".$arr[no_kabupaten]."',";
					$tmp_sql.= " apbd ='".$arr[apbd]."',"; 
					$tmp_sql.= " thn_anggaran ='".$arr[thn_anggaran]."',"; 
					$tmp_sql.= " id_jns_jln ='".$arr[id_jns_jln]."'";
					$tmp_sql.= " WHERE id_auto_daerah='".$arr[id_fjl_04_main]."'";
		
					$tmp_sqlresult = $tb_import->Execute($tmp_sql);
					
					//$sql_del = "DELETE FROM tbl_form_jl_05_detail WHERE id_fjl_05_main='$id_k_01_main_cek' ";
					//$tb_import->Execute($sql_del);
					}else
					{
					//simpan di tabel asli server
							$sql_insert = " INSERT INTO tbl_form_jl_04_main (`tanggal`, `no_propinsi`, `no_kabupaten`,`apbd`,`thn_anggaran`,  `id_jns_jln` , id_auto_daerah ) 
							 VALUES (" .sqlvalue(@$arr["tanggal"], true) .",  
							 " .sqlvalue(@$arr["no_propinsi"], false) .", " .sqlvalue(@$arr["no_kabupaten"], false) ."," .sqlvalue(@$arr["apbd"], true) ."," .sqlvalue(@$arr["thn_anggaran"], true) .", " .sqlvalue(@$arr["id_jns_jln"], false) ." , " .sqlvalue(@$arr["id_fjl_04_main"], false) ." )";
							$sqlexec3 = $tb_import->Execute($sql_insert);

					}
					
					 //cari detail di local atw daerah
					  $sql_detail	    =  " SELECT * FROM tbl_form_jl_04_detail WHERE id_fjl_04_main='$arr[id_fjl_04_main]' "; //ambil di localhost
					  $get_recordSet2	= $db->Execute($sql_detail);
					  
					if($get_recordSet2->RecordCount()>0){//if 3
						while ($arr2=$get_recordSet2->FetchRow()) {//2
						if ($id_auto_daerah !='') { //jika  data induk sudah ada  1
					  
						
									//SIMPAN DI TABEL ASLI SERVER
									$sql_insert2  = " update tbl_form_jl_04_detail set id_fjl_04_main='".$id_k_01_main_cek ."',";
									$sql_insert2 .= "  id_program_penanganan='".sqlvalue(@$arr2[nama_ruas], true)."',"; 
									$sql_insert2 .= "  apbd_target='".sqlvalue(@$arr2[nama_jenis_penanganan], true)."',"; 
									$sql_insert2 .= "  apbd_biaya='".sqlvalue(@$arr2[kecamatan_yg_dilalui], true)."',"; 
									$sql_insert2 .= "  apbd_jalan_target='".sqlvalue(@$arr2[target_m], true)."',"; 
									$sql_insert2 .= "  apbd_jalan_biaya='".sqlvalue(@$arr2[target_unit], true)."',"; 
									$sql_insert2 .= "  dak_target='".sqlvalue(@$arr2[biaya_total], true)."',"; 
									$sql_insert2 .= "  sektor_target='".sqlvalue(@$arr2[sumber_pendanaan], true)."',"; 
									$sql_insert2 .= "  sektor_biaya='".sqlvalue(@$arr2[metoda_pelaksanaan], true)."',"; 
									$sql_insert2 .= "  pinjaman_target='".sqlvalue(@$arr2[tanggal_spmk], true)."',"; 
									$sql_insert2 .= "  pinjaman_biaya='".sqlvalue(@$arr2[rencana_pho], true)."',";
									$sql_insert2 .= "  total_target='".sqlvalue(@$arr2[waktu_pelaksanaan], true)."',";
									$sql_insert2 .= "  total_biaya='".sqlvalue(@$arr2[pimpro], true)."',";
									$sql_insert2 .= "  id_auto_daerah='".sqlvalue(@$arr[id_fjl_04_main], true)."'";
									$sql_insert2 .= " WHERE id_fjl_04_main='".$arr[id_fjl_04_main]."'";
									 
									$tmp_sqlresult = $tb_import->Execute($sql_insert2);
							} else { //jika data belum ada else 2
							
									//SIMPAN DI TABEL ASLI SERVER
									
		$sql_insert2 = " INSERT INTO `".$tbl_name_detail."` (`id_fjl_04_main`,`id_program_penanganan`,`apbd_target`,`apbd_biaya`,`apbd_jalan_target`,`apbd_jalan_biaya`,`dak_target`,`dak_biaya`,`sektor_target`,`sektor_biaya`,`pinjaman_target`,`pinjaman_biaya`,`total_target`,`total_biaya`,id_auto_daerah) VALUES (
					(SELECT MAX(id_fjl_04_main) FROM ".$tbl_name_main."), 
					".sqlvalue(@$arr2["id_program_penanganan"], true).",
					".sqlvalue(@$arr2["apbd_target"], true).", 
					".sqlvalue(@$arr2["apbd_biaya"], false).", 
					".sqlvalue(@$arr2["apbd_jalan_target"], false).", 
					".sqlvalue(@$arr2["apbd_jalan_biaya"], false).", 
					".sqlvalue(@$arr2["dak_target"], false).", 
					".sqlvalue(@$arr2["dak_biaya"], false).", 
					".sqlvalue(@$arr2["sektor_target"], false).", 
					".sqlvalue(@$arr2["sektor_biaya"], false).", 
					".sqlvalue(@$arr2["pinjaman_target"], false).", 
					".sqlvalue(@$arr2["pinjaman_biaya"], false).", 
					".sqlvalue(@$arr2["total_target"], false).", 
					" .sqlvalue(@$arr2["total_biaya"], true).",					
					".sqlvalue(@$arr[id_fjl_04_main], true).")";
					
					$sql_exec2 = $tb_import->Execute($sql_insert2);
							}//1
						}//2
				}//3
		$z++;
				
		
		}//end while1
		Header("Location:index.php?status_error=3&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);

		}else {
		   Header("Location:index.php?status_error=2&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);

		
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
		//Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&no_kabupaten=".$_GET[no_kabupaten]."&Search_Year=".$_GET[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);
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