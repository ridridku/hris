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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_pegawai/pegawai';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_pegawai');
$FILE_JS  = $JS_MODUL.'/pegawai';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "r_pegawai";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM r_pegawai ";
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


$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];
$tgl_now = date("Y-m-d h:i:s");

      


            $r_pegawai__id = addslashes($_POST[r_pegawai__id]);
            $r_pegawai__nama = addslashes($_POST[r_pegawai__nama]);
            $r_pegawai__tgl_lahir = addslashes($_POST[r_pegawai__tgl_lahir]);
            $r_pegawai__tmpt_lahir = addslashes($_POST[r_pegawai__tmpt_lahir]);
            $r_pegawai__jk = addslashes($_POST[r_pegawai__jk]);
            $r_pegawai__ktp = addslashes($_POST[r_pegawai__ktp]);
            $r_pegawai__sim = addslashes($_POST[r_pegawai__sim]);
            $r_pegawai__nama_jalan=addslashes($_POST[r_pegawai__nama_jalan]);

            $r_pegawai__ktp_prov = addslashes($_POST[r_pegawai__ktp_prov]);
            $r_pegawai__ktp_kab = addslashes($_POST[r_pegawai__ktp_kab]);
            $r_pegawai__ktp_kec = addslashes($_POST[r_pegawai__ktp_kec]);
            $r_pegawai__ktp_desa = addslashes($_POST[r_pegawai__ktp_desa]);
            $r_pegawai__ktp_rt = addslashes($_POST[r_pegawai__ktp_rt]);
            $r_pegawai__ktp_rw = addslashes($_POST[r_pegawai__ktp_rw]);
            $r_pegawai__ktp_kodepos = addslashes($_POST[r_pegawai__ktp_kodepos]);
            $r_pegawai__alm_prov = addslashes($_POST[r_pegawai__alm_prov]);
            $r_pegawai__alm_kab = addslashes($_POST[r_pegawai__alm_kab]);
            $r_pegawai__alm_kec = addslashes($_POST[r_pegawai__alm_kec]);
            $r_pegawai__alm_desa = addslashes($_POST[r_pegawai__alm_desa]);
            $r_pegawai__alm_rt = addslashes($_POST[r_pegawai__alm_rt]);
            $r_pegawai__alm_rw = addslashes($_POST[r_pegawai__alm_rw]);
            $r_pegawai__alm_kodepos = addslashes($_POST[r_pegawai__alm_kodepos]);
            $r_pegawai__tlp_rumah = addslashes($_POST[r_pegawai__tlp_rumah]);
            $r_pegawai__tlp_pribadi = addslashes($_POST[r_pegawai__tlp_pribadi]);
            $r_pegawai__tlp_kantor = addslashes($_POST[r_pegawai__tlp_kantor]);
            $r_pegawai__gol_darah = addslashes($_POST[r_pegawai__gol_darah]);
            $r_pegawai__agama = addslashes($_POST[r_pegawai__agama]);
            $r_pegawai__tinggi = addslashes($_POST[r_pegawai__tinggi]);
            $r_pegawai__berat = addslashes($_POST[r_pegawai__berat]);
            $r_pegawai__ayah = addslashes($_POST[r_pegawai__ayah]);
            $r_pegawai__ibu = addslashes($_POST[r_pegawai__ibu]);
            $r_pegawai__ortu_prov = addslashes($_POST[r_pegawai__ortu_prov]);
            $r_pegawai__ortu_kab = addslashes($_POST[r_pegawai__ortu_kab]);
            $r_pegawai__ortu_kec = addslashes($_POST[r_pegawai__ortu_kec]);
            $r_pegawai__ortu_desa = addslashes($_POST[r_pegawai__ortu_desa]);
            $r_pegawai__ortu_rt = addslashes($_POST[r_pegawai__ortu_rt]);
            $r_pegawai__ortu_rw = addslashes($_POST[r_pegawai__ortu_rw]);
            $r_pegawai__ortu_kodepos = addslashes($_POST[r_pegawai__ortu_kodepos]);
            $r_pegawai__npwp = addslashes($_POST[r_pegawai__npwp]);
            $r_pegawai__no_bpjs = addslashes($_POST[r_pegawai__no_bpjs]);
           
            $r_pegawai__no_askes = addslashes($_POST[r_pegawai__no_askes]);
            $r_pegawai__bank1 = addslashes($_POST[r_pegawai__bank1]);
            $r_pegawai__bank1_rek = addslashes($_POST[r_pegawai__bank1_rek]);
            $r_pegawai__bank1_norek = addslashes($_POST[r_pegawai__bank1_norek]);
            $r_pegawai__bank1_alm = addslashes($_POST[r_pegawai__bank1_alm]);
            $r_pegawai__bank2 = addslashes($_POST[r_pegawai__bank2]);
            $r_pegawai__bank2_rek = addslashes($_POST[r_pegawai__bank2_rek]);
            $r_pegawai__bank2_norek = addslashes($_POST[r_pegawai__bank2_norek]);
            $r_pegawai__bank2_alm = addslashes($_POST[r_pegawai__bank2_alm]);
            $r_pegawai__pasangan = addslashes($_POST[r_pegawai__pasangan]);
            $r_pegawai__pas_tgllahir = addslashes($_POST[r_pegawai__pas_tgllahir]);
            $r_pegawai__pas_tmptlahir = addslashes($_POST[r_pegawai__pas_tmptlahir]);
            $r_pegawai__pas_prov = addslashes($_POST[r_pegawai__pas_prov]);
            $r_pegawai__pas_kab = addslashes($_POST[r_pegawai__pas_kab]);
            $r_pegawai__pas_kec = addslashes($_POST[r_pegawai__pas_kec]);
            $r_pegawai__pas_desa = addslashes($_POST[r_pegawai__pas_desa]);
            $r_pegawai__pas_rt = addslashes($_POST[r_pegawai__pas_rt]);
            $r_pegawai__pas_rw = addslashes($_POST[r_pegawai__pas_rw]);
            $r_pegawai__pas_kodepos = addslashes($_POST[r_pegawai__pas_kodepos]);
            $r_pegawai__pas_tlp = addslashes($_POST[r_pegawai__pas_tlp]);
            $r_pegawai__pas_jml_anak = addslashes($_POST[r_pegawai__pas_jml_anak]);
            $r_pegawai__pas_anak1 = addslashes($_POST[r_pegawai__pas_anak1]);
            $r_pegawai__pas_anak2 = addslashes($_POST[r_pegawai__pas_anak2]);
            $r_pegawai__pas_anak3 = addslashes($_POST[r_pegawai__pas_anak3]);
            $r_pegawai__photo = addslashes($_POST[r_pegawai__photo]);
            $r_pegawai__status_kawin = addslashes($_POST[r_pegawai__status_kawin]);
            $r_pegawai__tgl_masuk = addslashes($_POST[r_pegawai__tgl_masuk]);
            $r_pegawai__id_subcab = addslashes($_POST[r_pegawai__id_subcab]);
            $r_pegawai__subdept = addslashes($_POST[r_pegawai__subdept]);
            $r_pegawai__jabatan = addslashes($_POST[r_pegawai__jabatan]);
            $r_pegawai__st_pegawai = addslashes($_POST[r_pegawai__st_pegawai]);
            $r_pegawai__tgl_pengangkatan = addslashes($_POST[r_pegawai__tgl_pengangkatan]);
            $r_pegawai__pend_akhir = addslashes($_POST[r_pegawai__pend_akhir]);
            $r_pegawai__pend_sekolah = addslashes($_POST[r_pegawai__pend_sekolah]);
            $r_pegawai__pend_jurusan = addslashes($_POST[r_pegawai__pend_jurusan]);
            $r_pegawai__date_updated = addslashes($_POST[r_pegawai__date_updated]);
            $r_pegawai__user_updated = addslashes($_POST[r_pegawai__user_updated]);
            
            $foto=$_FILES['file_foto']['name'] ;
            $foto2=$_POST[foto2];
            $cek_foto=$_POST[checkboxname];

          
            IF($cek_foto==1)
            {
                $nama_foto=$_POST[foto2];
            }
            else
            {
                 $nama_foto=$_POST[foto2];

            }

            $nama_pegawai_cari=$_POST[r_pegawai__nama];

        if ($r_pegawai__id=='' AND $r_pegawai__ktp_prov=='' AND $r_pegawai__ktp_kab=='' AND $r_pegawai__ktp_kec=='' AND $r_pegawai__ktp_desa=='' )
            {
		 
				Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
            }else{
            
            if ($foto!="")
            {
            $target_dir ='./uploads/';
            $target_file = $target_dir.basename($_FILES["file_foto"]["name"],$target_dir);
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            $check = getimagesize($_FILES["file_foto"]["tmp_name"]); 
            if($check !== false) {
                                $uploadMessageError = "File is an image - " . $check["mime"] . ".";
                                $uploadOk = 1;
                        } else {
                                $uploadMessageError = "File is not an image.";
                                $uploadOk = 0;
                        }        
                // Check file size
                if ($_FILES["file_foto"]["size"] > 2000000) {
                        $uploadMessageError = "Sorry, your file is too large.";
                        $uploadOk = 0;
                }
                // Allow certain file formats
                if($imageFileType != "jpg" && $imageFileType != "GIF") {
                        $uploadMessageError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                        $uploadOk = 0;
                }


                    if (move_uploaded_file($_FILES["file_foto"]["tmp_name"], $target_file)) {
                          chmod("$target_file",0775);
                            $uploadMessageError = "The file ". basename($_FILES["file_foto"]["name"]). " has been uploaded.";
                            $uploadOk=1;
                            $image_name=$_FILES['file_foto']['name'];
                            $nama_foto = round(microtime(true)).'_'.$image_name;
                            
                       
                            
              } else {
                                        $uploadMessageError = "Sorry, there was an error uploading your file.";
                                        $uploadOk=0;
                                }



     }

            
            
			$sql_edit  ="  UPDATE r_pegawai SET ";
                        $sql_edit .=" r_pegawai__nama = '$_POST[r_pegawai__nama]', ";
                        $sql_edit .=" r_pegawai__tgl_lahir = '$_POST[r_pegawai__tgl_lahir]', ";
                        $sql_edit .=" r_pegawai__tmpt_lahir = '$_POST[r_pegawai__tmpt_lahir]', ";
                        $sql_edit .=" r_pegawai__jk = '$_POST[r_pegawai__jk]', ";
                        $sql_edit .=" r_pegawai__ktp = '$_POST[r_pegawai__ktp]', ";
                        $sql_edit .=" r_pegawai__sim = '$_POST[r_pegawai__sim]', ";
                        $sql_edit .=" r_pegawai__nama_jalan = '$_POST[r_pegawai__nama_jalan]', ";
                        $sql_edit .=" r_pegawai__ktp_prov = '$_POST[r_pegawai__ktp_prov]', ";
                        $sql_edit .=" r_pegawai__ktp_kab = '$_POST[r_pegawai__ktp_kab]', ";
                        $sql_edit .=" r_pegawai__ktp_kec = '$_POST[r_pegawai__ktp_kec]', ";
                        $sql_edit .=" r_pegawai__ktp_desa = '$_POST[r_pegawai__ktp_desa]', ";
                        $sql_edit .=" r_pegawai__ktp_rt = '$_POST[r_pegawai__ktp_rt]', ";
                        $sql_edit .=" r_pegawai__ktp_rw = '$_POST[r_pegawai__ktp_rw]', ";
                        $sql_edit .=" r_pegawai__ktp_kodepos = '$_POST[r_pegawai__ktp_kodepos]' , ";
                        $sql_edit .=" r_pegawai__alm_prov = '$_POST[r_pegawai__alm_prov]', ";
                        $sql_edit .=" r_pegawai__alm_kab = '$_POST[r_pegawai__alm_kab]' , ";
                        $sql_edit .=" r_pegawai__alm_kec = '$_POST[r_pegawai__alm_kec]', ";
                        $sql_edit .=" r_pegawai__alm_desa = '$_POST[r_pegawai__alm_desa]', ";
                        $sql_edit .=" r_pegawai__alm_rt = '$_POST[r_pegawai__alm_rt]', ";
                        $sql_edit .=" r_pegawai__alm_rw = '$_POST[r_pegawai__alm_rw]', ";
                        $sql_edit .=" r_pegawai__alm_kodepos = '$_POST[r_pegawai__alm_kodepos]', ";
                        $sql_edit .=" r_pegawai__tlp_rumah = '$_POST[r_pegawai__tlp_rumah]', ";
                        $sql_edit .=" r_pegawai__tlp_pribadi = '$_POST[r_pegawai__tlp_pribadi]' , ";
                        $sql_edit .=" r_pegawai__tlp_kantor = '$_POST[r_pegawai__tlp_kantor]', ";
                        $sql_edit .=" r_pegawai__gol_darah = '$_POST[r_pegawai__gol_darah]', ";
                        $sql_edit .=" r_pegawai__agama = '$_POST[r_pegawai__agama]', ";
                        $sql_edit .=" r_pegawai__tinggi = '$_POST[r_pegawai__tinggi]', ";
                        $sql_edit .=" r_pegawai__berat = '$_POST[r_pegawai__berat]', ";
                        $sql_edit .=" r_pegawai__ayah = '$_POST[r_pegawai__ayah]', ";
                        $sql_edit .=" r_pegawai__ibu = '$_POST[r_pegawai__ibu]', ";
                        $sql_edit .=" r_pegawai__ortu_prov = '$_POST[r_pegawai__ortu_prov]', ";
                        $sql_edit .=" r_pegawai__ortu_kab = '$_POST[r_pegawai__ortu_kab]', ";
                        $sql_edit .=" r_pegawai__ortu_kec = '$_POST[r_pegawai__ortu_kec]', ";
                        $sql_edit .=" r_pegawai__ortu_desa = '$_POST[r_pegawai__ortu_desa]', ";
                        $sql_edit .=" r_pegawai__ortu_rt = '$_POST[r_pegawai__ortu_rt]', ";
                        $sql_edit .=" r_pegawai__ortu_rw = '$_POST[r_pegawai__ortu_rw]', ";
                        $sql_edit .=" r_pegawai__ortu_kodepos = '$_POST[r_pegawai__ortu_kodepos]', ";
                        $sql_edit .=" r_pegawai__npwp = '$_POST[r_pegawai__npwp]', ";
                        $sql_edit .=" r_pegawai__no_bpjs = '$_POST[r_pegawai__no_bpjs]', ";
                        $sql_edit .=" r_pegawai__no_askes = '$_POST[r_pegawai__no_askes]', ";
                        $sql_edit .=" r_pegawai__bank1 = '$_POST[r_pegawai__bank1]', ";
                        $sql_edit .=" r_pegawai__bank1_rek = '$_POST[r_pegawai__bank1_rek]', ";
                        $sql_edit .=" r_pegawai__bank1_norek = '$_POST[r_pegawai__bank1_norek]', ";
                        $sql_edit .=" r_pegawai__bank1_alm = '$_POST[r_pegawai__bank1_alm]', ";
                        $sql_edit .=" r_pegawai__bank2 = '$_POST[r_pegawai__bank2]', ";
                        $sql_edit .=" r_pegawai__bank2_rek = '$_POST[r_pegawai__bank2_rek]', ";
                        $sql_edit .=" r_pegawai__bank2_norek = '$_POST[r_pegawai__bank2_norek]', ";
                        $sql_edit .=" r_pegawai__bank2_alm = '$_POST[r_pegawai__bank2_alm]', ";
                        $sql_edit .=" r_pegawai__pasangan = '$_POST[r_pegawai__pasangan]', ";
                        $sql_edit .=" r_pegawai__pas_tgllahir = '$_POST[r_pegawai__pas_tgllahir]' , ";
                        $sql_edit .=" r_pegawai__pas_tmptlahir = '$_POST[r_pegawai__pas_tmptlahir]', ";
                        $sql_edit .=" r_pegawai__pas_prov = '$_POST[r_pegawai__pas_prov]', ";
                        $sql_edit .=" r_pegawai__pas_kab = '$_POST[r_pegawai__pas_kab]', ";
                        $sql_edit .=" r_pegawai__pas_kec = '$_POST[r_pegawai__pas_kec]', ";
                        $sql_edit .=" r_pegawai__pas_desa = '$_POST[r_pegawai__pas_desa]', ";
                        $sql_edit .=" r_pegawai__pas_rt = '$_POST[r_pegawai__pas_rt]', ";
                        $sql_edit .=" r_pegawai__pas_rw = '$_POST[r_pegawai__pas_rw]', ";
                        $sql_edit .=" r_pegawai__pas_kodepos = '$_POST[r_pegawai__pas_kodepos]', ";
                        $sql_edit .=" r_pegawai__pas_tlp = '$_POST[r_pegawai__pas_tlp]', ";
                        $sql_edit .=" r_pegawai__pas_jml_anak = '$_POST[r_pegawai__pas_jml_anak]', ";
                        $sql_edit .=" r_pegawai__pas_anak1 = '$_POST[r_pegawai__pas_anak1]', ";
                        $sql_edit .=" r_pegawai__pas_anak2 = '$_POST[r_pegawai__pas_anak2]', ";
                        $sql_edit .=" r_pegawai__pas_anak3 = '$_POST[r_pegawai__pas_anak3]', ";
                        $sql_edit .=" r_pegawai__photo = '$nama_foto', ";
                        $sql_edit .=" r_pegawai__status_kawin = '$_POST[r_pegawai__status_kawin]', ";
                        $sql_edit .=" r_pegawai__tgl_masuk = '$_POST[r_pegawai__tgl_masuk]' , ";
                        $sql_edit .=" r_pegawai__id_subcab = '$_POST[r_pegawai__id_subcab]', ";
                        $sql_edit .=" r_pegawai__subdept = '$_POST[r_pegawai__subdept]', ";
                        $sql_edit .=" r_pegawai__jabatan = '$_POST[r_pegawai__jabatan]', ";
                        $sql_edit .=" r_pegawai__st_pegawai = '$_POST[r_pegawai__st_pegawai]', ";
                        $sql_edit .=" r_pegawai__pend_tgl_lulus = '$_POST[r_pegawai__pend_tgl_lulus]' , ";
                        $sql_edit .=" r_pegawai__pend_akhir = '$_POST[r_pegawai__pend_akhir]', ";
                        $sql_edit .=" r_pegawai__pend_sekolah = '$_POST[r_pegawai__pend_sekolah]', ";
                        $sql_edit .=" r_pegawai__pend_jurusan = '$_POST[r_pegawai__pend_jurusan]', ";
                        $sql_edit .=" r_pegawai__date_updated = now(),";
                        $sql_edit .=" r_pegawai__user_updated = '$id_peg' ";
			$sql_edit .="  WHERE r_pegawai__id='$_POST[r_pegawai__id]' ";
                      //  var_dump($sql_edit)or die();
			$sqlresult = $db->Execute($sql_edit);
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&nama_pegawai_cari=".$_POST[r_pegawai__nama]);//."&r_pnpt__nip_cari=".$_POST[r_pnpt__nip]
        }
}

function create_(){
    
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];
$tgl_now = date("Y-m-d h:i:s");

$r_pegawai__pend_tgl_lulus=addslashes($_POST[$r_pegawai__pend_tgl_lulus]);
$r_pegawai__id = addslashes($_POST[r_pegawai__id]);
$r_pegawai__nama = addslashes($_POST[r_pegawai__nama]);
$r_pegawai__tgl_lahir= addslashes($_POST[r_pegawai__tgl_lahir]);
$r_pegawai__tmpt_lahir= addslashes($_POST[r_pegawai__tmpt_lahir]);
$r_pegawai__jk= addslashes($_POST[r_pegawai__jk]);
$r_pegawai__ktp= addslashes($_POST[r_pegawai__ktp]);
$r_pegawai__sim= addslashes($_POST[r_pegawai__sim]);
$r_pegawai__nama_jalan= addslashes($_POST[r_pegawai__nama_jalan]);
$r_pegawai__ktp_prov= addslashes($_POST[r_pegawai__ktp_prov]);
$r_pegawai__ktp_kab= addslashes($_POST[r_pegawai__ktp_kab]);
$r_pegawai__ktp_kec= addslashes($_POST[r_pegawai__ktp_kec]);
$r_pegawai__ktp_desa = addslashes($_POST[r_pegawai__ktp_desa]);
$r_pegawai__ktp_rt= addslashes($_POST[r_pegawai__ktp_rt]);
$r_pegawai__ktp_rw= addslashes($_POST[r_pegawai__ktp_rw]);
$r_pegawai__ktp_kodepos= addslashes($_POST[r_pegawai__ktp_kodepos]);
$r_pegawai__alm_prov= addslashes($_POST[r_pegawai__alm_prov]);
$r_pegawai__alm_kab= addslashes($_POST[r_pegawai__alm_kab]);
$r_pegawai__alm_kec= addslashes($_POST[r_pegawai__alm_kec]);
$r_pegawai__alm_desa= addslashes($_POST[r_pegawai__alm_desa]);
$r_pegawai__alm_rt= addslashes($_POST[r_pegawai__alm_rt]);
$r_pegawai__alm_rw= addslashes($_POST[r_pegawai__alm_rw]);
$r_pegawai__alm_kodepos= addslashes($_POST[r_pegawai__alm_kodepos]);
$r_pegawai__tlp_rumah= addslashes($_POST[r_pegawai__tlp_rumah]);
$r_pegawai__tlp_pribadi= addslashes($_POST[r_pegawai__tlp_pribadi]);

$r_pegawai__tlp_kantor= addslashes($_POST[r_pegawai__tlp_kantor]);
$r_pegawai__gol_darah= addslashes($_POST[r_pegawai__gol_darah]);
$r_pegawai__agama= addslashes($_POST[r_pegawai__agama]);
$r_pegawai__tinggi= addslashes($_POST[r_pegawai__tinggi]);
$r_pegawai__berat= addslashes($_POST[r_pegawai__berat]);
$r_pegawai__ayah= addslashes($_POST[r_pegawai__ayah]);
$r_pegawai__ibu= addslashes($_POST[r_pegawai__ibu]);
$r_pegawai__ortu_prov= addslashes($_POST[r_pegawai__ortu_prov]);
$r_pegawai__ortu_kab= addslashes($_POST[r_pegawai__ortu_kab]);
$r_pegawai__ortu_kec= addslashes($_POST[r_pegawai__ortu_kec]);
$r_pegawai__ortu_desa= addslashes($_POST[r_pegawai__ortu_desa]);
$r_pegawai__ortu_rt= addslashes($_POST[r_pegawai__ortu_rt]);
$r_pegawai__ortu_rw= addslashes($_POST[r_pegawai__ortu_rw]);
$r_pegawai__ortu_kodepos= addslashes($_POST[r_pegawai__ortu_kodepos]);
$r_pegawai__npwp= addslashes($_POST[r_pegawai__npwp]);
$r_pegawai__no_bpjs= addslashes($_POST[r_pegawai__no_bpjs]);
$r_pegawai__no_askes= addslashes($_POST[r_pegawai__no_askes]);
$r_pegawai__bank1= addslashes($_POST[r_pegawai__bank1]);
$r_pegawai__bank1_rek= addslashes($_POST[r_pegawai__bank1_rek]);
$r_pegawai__bank1_norek= addslashes($_POST[r_pegawai__bank1_norek]);
$r_pegawai__bank1_alm= addslashes($_POST[r_pegawai__bank1_alm]);
$r_pegawai__bank2= addslashes($_POST[r_pegawai__bank2]);
$r_pegawai__bank2_rek= addslashes($_POST[r_pegawai__bank2_rek]);
$r_pegawai__bank2_norek= addslashes($_POST[r_pegawai__bank2_norek]);
$r_pegawai__bank2_alm= addslashes($_POST[r_pegawai__bank2_alm]);
$r_pegawai__pasangan= addslashes($_POST[r_pegawai__pasangan]);
$r_pegawai__pas_tgllahir= addslashes($_POST[r_pegawai__pas_tgllahir]);
$r_pegawai__pas_tmptlahir= addslashes($_POST[r_pegawai__pas_tmptlahir]);
$r_pegawai__pas_prov = addslashes($_POST[r_pegawai__pas_prov]);
$r_pegawai__pas_kab = addslashes($_POST[r_pegawai__pas_kab]);
$r_pegawai__pas_kec = addslashes($_POST[r_pegawai__pas_kec]);
$r_pegawai__pas_desa = addslashes($_POST[r_pegawai__pas_desa]);
$r_pegawai__pas_rt = addslashes($_POST[r_pegawai__pas_rt]);
$r_pegawai__pas_rw = addslashes($_POST[r_pegawai__pas_rw]);
$r_pegawai__pas_kodepos= addslashes($_POST[r_pegawai__pas_kodepos]);
$r_pegawai__photo= addslashes($_POST[r_pegawai__photo]);
$r_pegawai__status_kawin= addslashes($_POST[r_pegawai__status_kawin]);
$r_pegawai__tgl_masuk= addslashes($_POST[r_pegawai__tgl_masuk]);
$r_pegawai__id_subcab= addslashes($_POST[r_pegawai__id_subcab]);
$r_pegawai__subdept= addslashes($_POST[r_pegawai__subdept]);
$r_pegawai__jabatan= addslashes($_POST[r_pegawai__jabatan]);
$r_pegawai__st_pegawai= addslashes($_POST[r_pegawai__st_pegawai]);
$r_pegawai__pend_tgl_lulus= addslashes($_POST[r_pegawai__pend_tgl_lulus]);
$r_pegawai__pend_akhir= addslashes($_POST[r_pegawai__pend_akhir]);
$r_pegawai__pend_sekolah= addslashes($_POST[r_pegawai__pend_sekolah]);
$r_pegawai__pend_jurusan= addslashes($_POST[r_pegawai__pend_jurusan]);
$r_pegawai__date_created= addslashes($_POST[r_pegawai__date_created]);
$r_pegawai__date_updated= addslashes($_POST[r_pegawai__date_updated]);
$r_pegawai__user_created = addslashes($_POST[r_pegawai__user_created]);
$r_pegawai__user_updated = addslashes($_POST[r_pegawai__user_updated]);

if($r_pegawai__pas_tgllahir=='')
{    
    $pas_tgllahir='1990-01-01';

}
else
{
    $pas_tgllahir=$r_pegawai__pas_tgllahir;
}

error_reporting(E_ALL ^ E_NOTICE);
error_reporting(0);
//  ini_set("display_errors",1);
ini_set("memory_limit","1024M");
$foto=$_FILES['file_foto']['name'] ;

if($foto!="")
 {
         $target_dir ='./uploads/';
                    $target_file = $target_dir.basename($_FILES["file_foto"]["name"],$target_dir);  
                 //   chmod("$target_file",0777);
                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                    // Check if image file is a actual image or fake image
                    $check = getimagesize($_FILES["file_foto"]["tmp_name"]); 
                    if($check !== false) {
                                        $uploadMessageError = "File is an image - " . $check["mime"] . ".";
                                        $uploadOk = 1;
                                } else {
                                        $uploadMessageError = "File is not an image.";
                                        $uploadOk = 0;
                                }        
			// Check file size
			if ($_FILES["file_foto"]["size"] > 2000000) {
				$uploadMessageError = "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "GIF") {
				$uploadMessageError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
                         
                        
                            if (move_uploaded_file($_FILES["file_foto"]["tmp_name"], $target_file)) {
                                  chmod("$target_file",0775);
                                    $uploadMessageError = "The file ". basename($_FILES["file_foto"]["name"]). " has been uploaded.";
                                    $uploadOk=1;
                                  $image_name=$_FILES['file_foto']['name'];
                                    $nama_foto = round(microtime(true)).'_'.$image_name;
                                  
                                     
                      } else {
                                    $uploadMessageError = "Sorry, there was an error uploading your file.";
                                    $uploadOk=0;
                            }
                            
                          
                        
                                   
                         
 }

 if ($r_pegawai__ktp_prov=='' AND $r_pegawai__ktp_kab=='' AND $r_pegawai__ktp_kec=='' AND $r_pegawai__ktp_desa=='' ) {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else
                {
$sql	 = "INSERT INTO r_pegawai (r_pegawai__nama,
        r_pegawai__tgl_lahir,
        r_pegawai__tmpt_lahir,
        r_pegawai__jk,
        r_pegawai__ktp,
        r_pegawai__sim,
        r_pegawai__nama_jalan,
        r_pegawai__ktp_prov,
        r_pegawai__ktp_kab,
        r_pegawai__ktp_kec,
        r_pegawai__ktp_desa,
        r_pegawai__ktp_rt,
        r_pegawai__ktp_rw,
        r_pegawai__ktp_kodepos,
        r_pegawai__alm_prov,
        r_pegawai__alm_kab,
        r_pegawai__alm_kec,
        r_pegawai__alm_desa,
        r_pegawai__alm_rt,
        r_pegawai__alm_rw,
        r_pegawai__alm_kodepos,
        r_pegawai__tlp_rumah,
        r_pegawai__tlp_pribadi,
        r_pegawai__tlp_kantor,
        r_pegawai__gol_darah,
        r_pegawai__agama,
        r_pegawai__tinggi,
        r_pegawai__berat,
        r_pegawai__ayah,
        r_pegawai__ibu,
        r_pegawai__ortu_prov,
        r_pegawai__ortu_kab,
        r_pegawai__ortu_kec,
        r_pegawai__ortu_desa,
        r_pegawai__ortu_rt,
        r_pegawai__ortu_rw,
        r_pegawai__ortu_kodepos,
        r_pegawai__npwp,
        r_pegawai__no_bpjs,
        r_pegawai__no_askes,
        r_pegawai__bank1,
        r_pegawai__bank1_rek,
        r_pegawai__bank1_norek,
        r_pegawai__bank1_alm,
        r_pegawai__bank2,
        r_pegawai__bank2_rek,
        r_pegawai__bank2_norek,
        r_pegawai__bank2_alm,
        r_pegawai__pasangan,
        r_pegawai__pas_tgllahir,
        r_pegawai__pas_tmptlahir,
        r_pegawai__pas_prov,
        r_pegawai__pas_kab,
        r_pegawai__pas_kec,
        r_pegawai__pas_desa,
        r_pegawai__pas_rt,
        r_pegawai__pas_rw,
        r_pegawai__pas_kodepos,
        r_pegawai__photo,
        r_pegawai__status_kawin,
        r_pegawai__tgl_masuk,
        r_pegawai__st_pegawai,
        r_pegawai__pend_tgl_lulus,
        r_pegawai__pend_akhir,
        r_pegawai__pend_sekolah,
        r_pegawai__pend_jurusan,
        r_pegawai__date_created,
        r_pegawai__user_created
       )";
$sql	.= " VALUES ('".strip_tags($r_pegawai__nama)."',"
        . "'".strip_tags($r_pegawai__tgl_lahir)."',"
        . "'".strip_tags($r_pegawai__tmpt_lahir)."',"
        . "'".strip_tags($r_pegawai__jk)."',"
        . "'".strip_tags($r_pegawai__ktp)."',"
        . "'".strip_tags($r_pegawai__sim)."',"
        . "'".strip_tags($r_pegawai__nama_jalan)."',"
        . "'".strip_tags($r_pegawai__ktp_prov)."',"
        . "'".strip_tags($r_pegawai__ktp_kab)."',"
        . "'".strip_tags($r_pegawai__ktp_kec)."',"
        . "'".strip_tags($r_pegawai__ktp_desa)."',"
        . "'".strip_tags($r_pegawai__ktp_rt)."',"
        . "'".strip_tags($r_pegawai__ktp_rw)."',"
        . "'".strip_tags($r_pegawai__ktp_kodepos)."',"
        . "'".strip_tags($r_pegawai__alm_prov)."',"
        . "'".strip_tags($r_pegawai__alm_kab)."',"
        . "'".strip_tags($r_pegawai__alm_kec)."',"
        . "'".strip_tags($r_pegawai__alm_desa)."',"
        . "'".strip_tags($r_pegawai__alm_rt)."',"
        . "'".strip_tags($r_pegawai__alm_rw)."',"
        . "'".strip_tags($r_pegawai__alm_kodepos)."',"
        . "'".strip_tags($r_pegawai__tlp_rumah)."',"
        . "'".strip_tags($r_pegawai__tlp_pribadi)."',"
        . "'".strip_tags($r_pegawai__tlp_kantor)."',"
        . "'".strip_tags($r_pegawai__gol_darah)."',"
        . "'".strip_tags($r_pegawai__agama)."',"
        . "'".strip_tags($r_pegawai__tinggi)."',"
        . "'".strip_tags($r_pegawai__berat)."',"
        . "'".strip_tags($r_pegawai__ayah)."',"
        . "'".strip_tags($r_pegawai__ibu)."',"
        . "'".strip_tags($r_pegawai__ortu_prov)."',"
        . "'".strip_tags($r_pegawai__ortu_kab)."',"
        . "'".strip_tags($r_pegawai__ortu_kec)."',"
        . "'".strip_tags($r_pegawai__ortu_desa)."',"
        . "'".strip_tags($r_pegawai__ortu_rt)."',"
        . "'".strip_tags($r_pegawai__ortu_rw)."',"
        . "'".strip_tags($r_pegawai__ortu_kodepos)."',"
        . "'".strip_tags($r_pegawai__npwp)."',"
        . "'".strip_tags($r_pegawai__no_bpjs)."',"
        . "'".strip_tags($r_pegawai__no_askes)."',"
        . "'".strip_tags($r_pegawai__bank1)."',"
        . "'".strip_tags($r_pegawai__bank1_rek)."',"
        . "'".strip_tags($r_pegawai__bank1_norek)."',"
        . "'".strip_tags($r_pegawai__bank1_alm)."',"
        . "'".strip_tags($r_pegawai__bank2)."',"
        . "'".strip_tags($r_pegawai__bank2_rek)."',"
        . "'".strip_tags($r_pegawai__bank2_norek)."',"
        . "'".strip_tags($r_pegawai__bank2_alm)."',"
        . "'".strip_tags($r_pegawai__pasangan)."',"
        . "'".strip_tags($pas_tgllahir)."',"
        . "'".strip_tags($r_pegawai__pas_tmptlahir)."',"
        . "'".strip_tags($r_pegawai__pas_prov)."',"
        . "'".strip_tags($r_pegawai__pas_kab)."',"
        . "'".strip_tags($r_pegawai__pas_kec)."',"
        . "'".strip_tags($r_pegawai__pas_desa)."',"
        . "'".strip_tags($r_pegawai__pas_rt)."',"
        . "'".strip_tags($r_pegawai__pas_rw)."',"
        . "'".strip_tags($r_pegawai__pas_kodepos)."',"
        . "'".strip_tags($nama_foto)."',"
        . "'".strip_tags($r_pegawai__status_kawin)."',"      
        . "'".strip_tags($r_pegawai__tgl_masuk)."',"
        . "'".strip_tags($r_pegawai__st_pegawai)."',"
        . "'".strip_tags($r_pegawai__pend_tgl_lulus)."',"
        . "'".strip_tags($r_pegawai__pend_akhir)."',"
        . "'".strip_tags($r_pegawai__pend_sekolah)."',"
        . "'".strip_tags($r_pegawai__pend_jurusan)."',"
        . " now(),"
        . "'".strip_tags($id_peg)."')";

        $sqlresult = $db->Execute($sql);

    Header("Location:index_hasil.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&nama_pegawai_cari=".$_POST[r_pegawai__nama]);
    
}

  }
// TUTUP CREATE

if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];
switch ($op){

case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
	//	lockTables($tbl_name);
		create_($r_pegawai__id);
		//unlockTables($tbl_name);
            //    Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_($r_pegawai__id);
		//unlockTables($tbl_name);		
		//Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		//lockTables($tbl_name);
		delete_($r_pegawai__id);
		//unlockTables($tbl_name);		
		//Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
}


}
?>
