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
	global $tbl_name_kondisi_main;	
	global $tmp_tbl_name_kondisi_main;
	
	$tb_import = &ADONewConnection($DB_TYPE);
//	 $tb_import->debug = true;
//   $db->debug = true;

  //$DB_NAME2="db_sippjd2_";
	$tb_import->Connect($_POST['hostname1'], $_POST['username1'], $_POST['password1'], $DB_NAME);
	//------------------------------------LOCAL CONFIG--------------------------------------//
 

	$conn=mysql_connect($_POST['hostname1'],$_POST['username1'],$_POST['password1']);

  //buat cek koneksinya

  if(!$conn)
    {

        Header("Location:index.php?status_error=1&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);

    }

    else { 

	$SES_NO_PROP	= $_SESSION['SESSION_NO_PROPINSI'];

	$sql_ambil_data = " SELECT * FROM tbl_form_s_01_main  where no_propinsi=".$SES_NO_PROP; //localhost atw daerah
	$get_recordSet =   $db->Execute($sql_ambil_data);  
	@$count = $get_recordSet->RecordCount();
	
	if (@$count!='') {
				$z=1;

				while ($arr=$get_recordSet->FetchRow()) { // loop data di daerah
 					
					//cek apakah data sudah ada di server atw belum melalui id_auto_daerah
					$sql_cek="select * from tbl_form_s_01_main where id_auto_daerah=".sqlvalue(@$arr["id_fs_01_main"], true)." AND no_propinsi=".sqlvalue(@$arr["no_propinsi"], true)." and no_kabupaten=".sqlvalue(@$arr["no_kabupaten"], true);
					$rs_cari =   $tb_import->Execute($sql_cek); 

                    $id_auto_daerah = $rs_cari->fields['id_auto_daerah'];
					$id_fs_01_main_cek = $rs_cari->fields['id_fs_01_main'];

					if ($id_auto_daerah !='') { //data sudah ada di pusat
						 
						// script update DI PUSAT
 
						$tmp_sql = " UPDATE tbl_form_s_01_main  SET  " ;
						$tmp_sql.= "  tanggal='".$arr[tanggal]."'," ;
 						$tmp_sql.= "  no_propinsi='".$arr[no_propinsi]."'," ;
						$tmp_sql.= "  no_kabupaten='".$arr[no_kabupaten]."'," ;
						$tmp_sql.= "  no_ruas='".$arr[no_ruas]."'," ;
						$tmp_sql.= "  nama_ruas_pangkal='".$arr[nama_ruas_pangkal]."'," ;
						$tmp_sql.= "  nama_ruas_ujung='".$arr[nama_ruas_ujung]."'," ;
						$tmp_sql.= "  titik_pengenal_ujung='".$arr[titik_pengenal_ujung]."'," ;
						$tmp_sql.= "  titik_pengenal_pangkal='".$arr[titik_pengenal_pangkal]."'," ;
						$tmp_sql.= "  disurvai='".$arr[disurvai]."'," ;
						$tmp_sql.= "  tipe_kendaraan='".$arr[tipe_kendaraan]."'," ;
						$tmp_sql.= "  fakt_penyesuaian_odometer='".$arr[fakt_penyesuaian_odometer]."'," ;
						$tmp_sql.= "  km_odometer='".$arr[km_odometer]."'," ;
						$tmp_sql.= "  km_ysd='".$arr[km_ysd]."'," ;			 
						$tmp_sql.= "  id_jns_jln='".$arr[id_jns_jln]."' "  ;
						$tmp_sql.= "  where id_fs_01_main ='".$id_fs_01_main_cek."' " ;
						$tmp_sqlresult = $tb_import->Execute($tmp_sql);	
						
						 $sql_del = "DELETE FROM tbl_form_s_01_detail WHERE id_fs_01_main='$id_fs_01_main_cek' ";
						 $tb_import->Execute($sql_del);
 

		
					} else { //data belum ada
						
							//simpan di tabel asli server
						 
							$sql_insert = " INSERT INTO tbl_form_s_01_main (`tanggal`, `no_propinsi`, `no_kabupaten`, `no_ruas`, `nama_ruas_pangkal`, `nama_ruas_ujung`, `titik_pengenal_ujung`, `titik_pengenal_pangkal`, `disurvai`, `tipe_kendaraan`, `fakt_penyesuaian_odometer`, `km_odometer`, `km_ysd`, `id_jns_jln` , id_auto_daerah) 
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
							".sqlvalue(@$arr["id_jns_jln"], true).",
							".sqlvalue(@$arr["id_fs_01_main"], true).")";
							$sqlexec3 = $tb_import->Execute($sql_insert);
		

					}
 

					 //cari detail di local atw daerah
					  $sql_detail	    =  " SELECT * FROM tbl_form_s_01_detail WHERE id_fs_01_main='$arr[id_fs_01_main]' "; //ambil di localhost
					  $get_recordSet2	= $db->Execute($sql_detail);

					if($get_recordSet2->RecordCount()>0){
						while ($arr2=$get_recordSet2->FetchRow()) {

							if ($id_auto_daerah !='') { //jika  data induk sudah ada 

									//SIMPAN DI TABEL ASLI SERVER
									
									$sql_insert2 = " INSERT INTO `".$tbl_name_detail."` (`id_fs_01_main`,`km_odometer`,`km_ysd`,`tipe_permukaan_jalan`,`kondisi_permukaan_jalan`,`lebar_permukaan_jalan`,`drainase`,`kolom1`,`kolom2`,`kolom3`,`kolom4`,`kolom5`,`kolom6`,`penilaian`) VALUES (
									$id_fs_01_main_cek , 
									" .sqlvalue(@$arr2["km_odometer"], true) .", 
									" .sqlvalue(@$arr2["km_ysd"], true) .", 
									" .sqlvalue(@$arr2["tipe_permukaan_jalan"], false) .", 
									'" .sqlvalue(@$arr2["kondisi_permukaan_jalan"], false) ."', 
									'" .sqlvalue(@$arr2["lebar_permukaan_jalan"], false) ."', 
									" .sqlvalue(@$arr2["drainase"], false) .", 
									" .sqlvalue(@$arr2["kolom1"], false) .", 
									" .sqlvalue(@$arr2["kolom2"], false) .", 
									" .sqlvalue(@$arr2["kolom3"], false) .", 
									" .sqlvalue(@$arr2["kolom4"], false) .", 
									" .sqlvalue(@$arr2["kolom5"], false) .", 
									" .sqlvalue(@$arr2["kolom6"], false) .", 					
									" .sqlvalue(@$arr2["penilaian"], true) .") ";


									////remark temp
									$sql_exec2 = $tb_import->Execute($sql_insert2);
									 
									  


							} else { //jika data belum ada
							
									//SIMPAN DI TABEL ASLI SERVER
									$sql_insert2 = " INSERT INTO `".$tbl_name_detail."` (`id_fs_01_main`,`km_odometer`,`km_ysd`,`tipe_permukaan_jalan`,`kondisi_permukaan_jalan`,`lebar_permukaan_jalan`,`drainase`,`kolom1`,`kolom2`,`kolom3`,`kolom4`,`kolom5`,`kolom6`,`penilaian`) VALUES (
									(SELECT MAX(id_fs_01_main) FROM ".$tbl_name_main."), 
										" .sqlvalue(@$arr2["km_odometer"], true) .", 
									" .sqlvalue(@$arr2["km_ysd"], true) .", 
									'" .sqlvalue(@$arr2["tipe_permukaan_jalan"], false) ."', 
									'" .sqlvalue(@$arr2["kondisi_permukaan_jalan"], false) ."', 
									'" .sqlvalue(@$arr2["lebar_permukaan_jalan"], false) ."', 
									" .sqlvalue(@$arr2["drainase"], false) .", 
									" .sqlvalue(@$arr2["kolom1"], false) .", 
									" .sqlvalue(@$arr2["kolom2"], false) .", 
									" .sqlvalue(@$arr2["kolom3"], false) .", 
									" .sqlvalue(@$arr2["kolom4"], false) .", 
									" .sqlvalue(@$arr2["kolom5"], false) .", 
									" .sqlvalue(@$arr2["kolom6"], false) .", 					
									" .sqlvalue(@$arr2["penilaian"], true) .") ";

									////remark temp
									$sql_exec2 = $tb_import->Execute($sql_insert2);
									 
									 // S 

							}



									
						}
					}

					 
					 
					$z++;
				}

				Header("Location:index.php?status_error=3&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);
	} else {
			
			//echo "Tidak ada data yang akan di eksport";

			Header("Location:index.php?status_error=2&mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);


	
	}


	}
}


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
case 3:
			import_();
			
	break;
}
}
?>