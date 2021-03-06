<?php

# Including Main Configuration
# including file for Main Configurations
require_once('../../../includes/config.conf.php');	 	


# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
		require_once('../../../includes/header.redirect.inc');
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
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
//------------------------------------LOCAL CONFIG--------------------------------------//
#SETTING FOR TEMPLATE 
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kehadiran/surat_lembur';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kehadiran');
$FILE_JS  = $JS_MODUL.'/surat_lembur';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "t_lembur";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM t_lembur ";
$sql .="WHERE  t_lembur__no= '$_GET[id]' ";

$sqlresult = $db->Execute($sql);

$user_id = base64_decode($_SESSION['UID']);
 $ip_now = $_SERVER['REMOTE_ADDR'];
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id ) VALUES ('$ip_now',now(),'Hapus data >> master WNI Non TKI','$user_id') ";
 $db->Execute($sql2);

}

function edit_(){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;
$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];
$t_lembur__no  = $_POST[lembur__no];
$t_lembur__idpeg = $_POST[karyawan_id];
$t_lembur__atasan_idpeg = $_POST[atasan__nip];
$t_lembur__atasan_nama = $_POST[atasan__nama];
$t_lembur__tanggal = $_POST[lembur_tanggal];
$t_lembur__nominal=$_POST[lembur_nominal];
$t_lembur__durasi   = $_POST[lembur_durasi];
$t_lembur__jml_nominal = $_POST[lembur_jml];
$t_lembur__makan= $_POST[lembur_makan];
$t_lembur__transport= $_POST[lembur_transport];
$t_lembur__total= $_POST[lembur__total];
$t_lembur__job_description  = $_POST[lembur_deskripsi];
$t_lembur__job_evaluasi = $_POST[lembur_evaluasi];
$t_lembur__approval   = $_POST[approval];

        
        $total_lembur=$t_lembur__jml_nominal+$t_lembur__makan+$t_lembur__transport ;
     
        
        
$sql_cek="select * from $tbl_name where t_lembur__approval ='$t_lembur__approval' AND t_lembur__no=$t_lembur__no ";

$rs_val = $db->Execute($sql_cek);
 $cek_approval = $rs_val->fields['$t_lembur__approval'];
 
 if ($t_lembur__no=='') {
			Header("Location:index_cek.php?ERR=5&nip_karyawan=".$nip_karyawan."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else{

                    
                    $sql_edit  ="  UPDATE $tbl_name SET ";
     
                    $sql_edit .=" t_lembur__idpeg='$t_lembur__idpeg',";
                    $sql_edit .=" t_lembur__atasan_nama='$t_lembur__atasan_nama',";
                    $sql_edit .=" t_lembur__atasan_idpeg='$t_lembur__atasan_idpeg',";
                    $sql_edit .=" t_lembur__tanggal='$t_lembur__tanggal',";
                    $sql_edit .=" t_lembur__nominal='$t_lembur__nominal',";
                    $sql_edit .=" t_lembur__durasi= '$t_lembur__durasi',";
                    $sql_edit .=" t_lembur__jml_nominal= '$t_lembur__jml_nominal',";
                    $sql_edit .=" t_lembur__makan= '$t_lembur__makan',";
                    $sql_edit .=" t_lembur__transport= '$t_lembur__transport',";
                    $sql_edit .=" t_lembur__total='$total_lembur',";
                    $sql_edit .=" t_lembur__job_description= '$t_lembur__job_description',";
                    $sql_edit .=" t_lembur__job_evaluasi = '$t_lembur__job_evaluasi',";
                    $sql_edit .=" t_lembur__approval = '$t_lembur__approval',";
                    $sql_edit .=" t_lembur__date_updated = now(),";
                    $sql_edit .=" t_lembur__user_updated = '$id_peg'";
                    $sql_edit .="  WHERE t_lembur__no='$t_lembur__no' ";

                //var_dump($sql_edit)or die(); 
                    $sqlresult = $db->Execute($sql_edit);
                     
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		
                }
}

function create_(){
    
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];

$t_lembur__no  = $_POST[lembur__no];
$t_lembur__idpeg = $_POST[karyawan_id];
$t_lembur__atasan_idpeg = $_POST[atasan__nip];
$t_lembur__atasan_nama = $_POST[atasan__nama];
$t_lembur__tanggal = $_POST[lembur_tanggal];
$t_lembur__nominal=$_POST[lembur_nominal];
$t_lembur__durasi   = $_POST[lembur_durasi];
$t_lembur__jml_nominal = $_POST[lembur_jml];
$t_lembur__makan= $_POST[lembur_makan];
$t_lembur__transport= $_POST[lembur_transport];
$t_lembur__total= $_POST[lembur__total];
$t_lembur__job_description  = $_POST[lembur_deskripsi];
$t_lembur__job_evaluasi = $_POST[lembur_evaluasi];
$t_lembur__approval   = $_POST[approval];
$t_lembur__user_created = $id_peg;


$total_lembur=$t_lembur__jml_nominal+$t_lembur__makan+$t_lembur__transport ;

$sql_cek_nip="SELECT MAX(A.r_pnpt__id_pegawai) as nip_max  FROM r_penempatan A ";   
$rs_val = $db->Execute($sql_cek_nip);
$nip_max= $rs_val->fields['nip_max'];


 if ($t_lembur__no=='') {
			Header("Location:index_cek.php?ERR=5&nip_karyawan=".$nip_karyawan."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else
                {
                    $sql	 = "INSERT INTO $tbl_name ("
                                    . "t_lembur__no, "
                                    . "t_lembur__idpeg,"
                                    . "t_lembur__atasan_nama,"
                                    . "t_lembur__atasan_idpeg, "
                                    . "t_lembur__tanggal,"
                                    . "t_lembur__nominal, "
                                    . "t_lembur__durasi,"
                                    . "t_lembur__jml_nominal,"
                                    . "t_lembur__makan, "
                                    . "t_lembur__transport, "
                                    . "t_lembur__total,"
                                    . "t_lembur__job_description,"
                                    . "t_lembur__job_evaluasi,"
                                    . "t_lembur__approval, "
                                    . "t_lembur__date_created,"
                                    . "t_lembur__date_updated,"
                                    . "t_lembur__user_created,"
                                    . "t_lembur__user_updated)";
$sql	.= " VALUES ("
        . "'$t_lembur__no',"
        . "'$t_lembur__idpeg',"
        . "'$t_lembur__atasan_nama',"
        . "'$t_lembur__atasan_idpeg',"
        . "'$t_lembur__tanggal',"
        . "'$t_lembur__nominal',"
        . "'$t_lembur__durasi',"
        . "'$t_lembur__jml_nominal',"
        . "'$t_lembur__makan',"
        . "'$t_lembur__transport',"
        . "'$total_lembur',"
        . "'$t_lembur__job_description',"
        . "'$t_lembur__job_evaluasi',"
        . "'$t_lembur__approval',"
        . "now(),"
        . "now(),"
        . "'".strip_tags($id_peg)."',"
        . "'".strip_tags($id_peg)."')";


$sqlresult = $db->Execute($sql);
Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
                }

    
    
}

 
// TUTUP CREATE
 

if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];


switch ($op){

case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
	//	lockTables($tbl_name);
		// create_($no_propinsi,$no_kab,$no_kec,$no_kel,$nama_kelurahan)
		create_();
		//unlockTables($tbl_name);		
		
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_();
		//unlockTables($tbl_name);		
		//Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		//lockTables($tbl_name);
		delete_();
	//	unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
}


}
?>
