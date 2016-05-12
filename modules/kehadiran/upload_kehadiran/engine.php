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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kehadiran/upoload_kehadiran';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kehadiran');
$FILE_JS  = $JS_MODUL.'/upload_kehadiran';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "tbl_file_kehadiran";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM tbl_file_kehadiran ";
$sql .="WHERE  id= '$_GET[id]' ";

$sqlresult = $db->Execute($sql);

$user_id = base64_decode($_SESSION['UID']);
 $ip_now = $_SERVER['REMOTE_ADDR'];
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id ) VALUES ('$ip_now',now(),'Hapus data >> master WNI Non TKI','$user_id') ";
 $db->Execute($sql2);

}

function edit_(){
global $mod_id;
global $db;


$nama = addslashes($_POST[nama]);

$sql_cek="select * from tbl_mast_pegawi where trim(id)='id' and id !='$_POST[id]' ";
 $rs_val = $db->Execute($sql_cek);
 $id = $rs_val->fields['id'];

		if ($id!='') {
		 
				Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);

		} else { 

   
			$sql_edit  ="  UPDATE tbl_file_kehadiran  ";
			$sql_edit .="  SET id='$_POST[id]', ";
                      //  $sql_edit .=" nip = '$_POST[nip]' , ";
                        $sql_edit .=" kode_cabang = '$_POST[kode_cabang]' , ";
                        $sql_edit .=" kode_departemen = '$_POST[kode_departemen]' , ";
                        $sql_edit .=" kode_jabatan = '$_POST[kode_jabatan]' , ";
                        $sql_edit .=" kode_level = '$_POST[kode_level]' , ";
                        $sql_edit .=" kode_absensi = '$_POST[kode_absensi]' , ";
                        $sql_edit .=" nama = '$_POST[nama]' , ";
                        $sql_edit .=" pendidikan_akhir = '$_POST[pendidikan_akhir]' , ";
                        $sql_edit .=" foto = '$_POST[foto]' , ";
                        $sql_edit .=" tempat_lahir = '$_POST[tempat_lahir]' , ";
                        $sql_edit .=" tgl_lahir = '$_POST[tgl_lahir]' , ";
                        $sql_edit .=" jk = '$_POST[jk]' , ";
                        $sql_edit .=" kode_agama = '$_POST[kode_agama]' , ";
                        $sql_edit .=" no_ktp_sim = '$_POST[no_ktp_sim]' , ";
                        $sql_edit .=" alamat_ktp = '$_POST[alamat_ktp]' , ";
                        $sql_edit .=" kode_pos_ktp = '$_POST[kode_pos_ktp]' , ";
                        $sql_edit .=" rt_rw_ktp = '$_POST[rt_rw_ktp]' , ";
                        $sql_edit .=" no_propinsi = '$_POST[no_propinsi]' , ";
                        $sql_edit .=" id_kab = '$_POST[id_kab]' , ";
                        $sql_edit .=" alamat_domisil = '$_POST[alamat_domisil]' , ";
                        $sql_edit .=" kode_pos_domisil = '$_POST[kode_pos_domisil]' , ";
                        
                        $sql_edit .=" rt_rw_domisil = '$_POST[rt_rw_domisil]' , ";
                        $sql_edit .=" kode_gol_darah = '$_POST[kode_gol_darah]' , ";
                        $sql_edit .=" telp_rmh = '$_POST[telp_rmh]' , ";
                        $sql_edit .=" hp = '$_POST[hp]' , ";
                        $sql_edit .=" telp_inventaris = '$_POST[telp_inventaris]' , ";
                        $sql_edit .=" tgl_masuk = '$_POST[tgl_masuk]' , ";
                        $sql_edit .=" tgl_kontrak_awal = '$_POST[tgl_kontrak_awal]' , ";
                        $sql_edit .=" tgl_kontrak_akhir = '$_POST[tgl_kontrak_akhir]' , ";
                        $sql_edit .=" kode_status = '$_POST[kode_status]' , ";
                        $sql_edit .=" kontrak_ke = '$_POST[kontrak_ke]' , ";
                        $sql_edit .=" no_npwp = '$_POST[no_npwp]' , ";
                        $sql_edit .=" no_bpjs_kt = '$_POST[no_bpjs_kt]' , ";
                        $sql_edit .=" no_bpjs_kes = '$_POST[no_bpjs_kes]' , ";
                        $sql_edit .=" no_inhealth = '$_POST[no_inhealth]' , ";
                        $sql_edit .=" kode_bank = '$_POST[kode_bank]' , ";
                        $sql_edit .=" alamat_buka_bank = '$_POST[alamat_buka_bank]' , ";
                        $sql_edit .=" rek_bank_baru = '$_POST[rek_bank_baru]' , ";
                        $sql_edit .=" nama_rek_bank = '$_POST[nama_rek_bank]' , ";
                        $sql_edit .=" kota_bank = '$_POST[kota_bank]' ";
			$sql_edit .="  WHERE id ='$_POST[id]' ";
			$sqlresult4 = $db->Execute($sql_edit);
                   //var_dump($sql_edit)or die();
$ip_now = $_SERVER['REMOTE_ADDR'];
$user_id = base64_decode($_SESSION['UID']);
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id )  VALUES ('$ip_now',now(),'Ubah data >> master WNI  ($nama)','$user_id') ";
 $db->Execute($sql2);

			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}
}

function create_(){
    
global $mod_id;	
global $db;
global $tbl_name;//nama_sektor
global $field_name;


$now= date("Y-m-d");
$kode_cabang = addslashes($_POST[kode_cabang]);
$tanggal_upload = $now;
$nama_file='$DIR_UPLOAD'; 
 

$uploadMessageError="Error while uploading file....";
		$uploadOk = 1;
		if($_FILES['txt_photo']['error'] == 0)
		{
                      	$target_dir = 'uploads/';
			$target_file = $target_dir.basename($_FILES["txt_photo"]["name"]);      
                        chmod("$txt_photo", 0644);
                        //var_dump($nama)or die();
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                       
			// Check if image file is a actual image or fake image
			  $check = getimagesize($_FILES["txt_photo"]["tmp_name"]); 
                          
                          /*
                           $uploaddir = 'images/';
                            $uploadfile = $uploaddir . $_FILES['userfile']['name'];
                            chmod("$userfile", 0644);
                            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
                               echo "File sudah sukses diupload ke server pada folder dan nama file $uploadfile";
                            } else {
                               echo "Proses upload gagal, kode error = " . $_FILES['userfile']['error'];
                            }                           
                           */
                        
                    
			if($check !== false) {
				$uploadMessageError = "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				$uploadMessageError = "File is not an image.";
				$uploadOk = 0;
			}
			
			// Check file size
			if ($_FILES["txt_photo"]["size"] > 2000000) {
				$uploadMessageError = "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "GIF") {
				$uploadMessageError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
                         
                 // move_uploaded_file($_FILES["txt_photo"]["tmp_name"], $target_file);
			// Check if $uploadOk is set to 0 by an error
			// chmod("$target_file",0775);
                            if (move_uploaded_file($_FILES["txt_photo"]["tmp_name"], $target_file)) {
                                  //  chmod("$target_file",0775);
                                    $uploadMessageError = "The file ". basename($_FILES["txt_photo"]["name"]). " has been uploaded.";
                                    $uploadOk=1;
                            } else {
                                    $uploadMessageError = "Sorry, there was an error uploading your file.";
                                    $uploadOk=0;
                            }
                                      
                            var_dump($uploadMessageError)or die();
		}

//INSERT INTO db_hris.tbl_file_kehadiran (id, nama_file, tanggal_upload, kode_cabang)
$sql	 = "INSERT INTO tbl_file_kehadiran (id,nama_file,tanggal_upload,kode_cabang) ";
$sql	.= " VALUES ('','".strip_tags($nama_file)."','".strip_tags($now)."','".strip_tags($kode_cabang)."')";

$sqlresult = $db->Execute($sql);
//var_dump($sql) or die(); 
$ip_now = $_SERVER['REMOTE_ADDR'];
$user_id = base64_decode($_SESSION['UID']);
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id )  VALUES ('$ip_now',now(),'Tambah Data >> master Sektor Pekerjaan','$user_id') ";

$db->Execute($sql2);


    Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
    
    
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
