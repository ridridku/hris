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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_pegawai/wni';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_pegawai');
$FILE_JS  = $JS_MODUL.'/wni';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "tbl_mast_pegawai";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM tbl_wni ";
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

   
			$sql_edit  ="  UPDATE tbl_mast_pegawai  ";
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
/*

$tempat_lahir = addslashes($_POST[tempat_lahir]);
$tlp = addslashes($_POST[tlp]);
$tlp_ln = addslashes($_POST[tlp_ln]);
  */

$nip = addslashes($_POST[nip]);
$kode_cabang= addslashes($_POST[kode_cabang]);
$kode_departemen = addslashes($_POST[kode_departemen]);
$kode_jabatan = addslashes($_POST[kode_jabatan]);
$kode_level = addslashes($_POST[kode_level]);
$kode_absensi = addslashes($_POST[kode_absensi]);
$nama = addslashes($_POST[nama]);
$pendidikan_akhir = addslashes($_POST[pendidikan_akhir]);
$foto = addslashes($_POST[foto]);
$tempat_lahir = addslashes($_POST[tempat_lahir]);
$tgl_lahir = addslashes($_POST[tgl_lahir]);
$jk = addslashes($_POST[jk]);
$kode_agama = addslashes($_POST[kode_agama]);
$no_ktp_sim = addslashes($_POST[no_ktp_sim]);
$alamat_ktp = addslashes($_POST[alamat_ktp]);
$kode_pos_ktp = addslashes($_POST[kode_pos_ktp]);
$rt_rw_ktp = addslashes($_POST[rt_rw_ktp]);
$no_propinsi = addslashes($_POST[no_propinsi]);
$id_kab = addslashes($_POST[id_kab]);
$alamat_domisil = addslashes($_POST[alamat_domisil]);
$kode_pos_domisil = addslashes($_POST[kode_pos_domisil]);
$rt_rw_domisil = addslashes($_POST[rt_rw_domisil ]);
$kode_gol_darah = addslashes($_POST[kode_gol_darah]);
$telp_rmh = addslashes($_POST[telp_rmh]);
$hp = addslashes($_POST[hp]);
$telp_inventaris = addslashes($_POST[telp_inventaris]);
$tgl_masuk = addslashes($_POST[tgl_masuk ]);
$tgl_kontrak_awal = addslashes($_POST[tgl_kontrak_awal]);
$tgl_kontrak_akhir = addslashes($_POST[tgl_kontrak_akhir ]);
$status_pegawai = addslashes($_POST[status_pegawai]);
$kontrak_ke = addslashes($_POST[kontrak_ke]);
$no_npwp = addslashes($_POST[no_npwp ]);
$no_bpjs_kt = addslashes($_POST[no_bpjs_kt]);
$no_bpjs_kes = addslashes($_POST[no_bpjs_kes ]);
$no_inhealth = addslashes($_POST[no_inhealth]);
$kode_bank = addslashes($_POST[kode_bank]);
$alamat_buka_bank = addslashes($_POST[alamat_buka_bank ]);
$rek_bank_baru = addslashes($_POST[rek_bank_baru ]);
$nama_rek_bank = addslashes($_POST[nama_rek_bank]);
$kota_bank = addslashes($_POST[kota_bank]);


$sql	 = "INSERT INTO tbl_mast_pegawai (id,"
        . "nik,kode_cabang,"
        . "kode_departemen,"
        . "kode_jabatan,"
        . "kode_level,
kode_absensi,
nama,
pendidikan_akhir,
foto,
tempat_lahir,
tgl_lahir,
jk,
kode_agama,
no_ktp_sim,
alamat_ktp,
kode_pos_ktp,
rt_rw_ktp,
no_propinsi,
id_kab,
alamat_domisil,
kode_pos_domisil,
rt_rw_domisil,
kode_gol_darah,
telp_rmh,
hp,
telp_inventaris,
tgl_masuk,
tgl_kontrak_awal,
tgl_kontrak_akhir,
kode_status,
kontrak_ke,
no_npwp,
no_bpjs_kt,
no_bpjs_kes,
no_inhealth,
kode_bank,
alamat_buka_bank,
rek_bank_baru,
nama_rek_bank,
kota_bank) ";
$sql	.= " VALUES ('','".strip_tags($nik)."',"
        . "'".strip_tags($kode_cabang)."',"
        . "'".strip_tags($kode_departemen)."',"
        . "'".strip_tags($kode_jabatan)."',"
        . "'".strip_tags($kode_level)."',"
        . "'".strip_tags($kode_absensi)."',"
        . "'".strip_tags($nama)."',"
        . "'".strip_tags($pendidikan_akhir)."',"
        . "'".strip_tags($foto)."',"
        . "'".strip_tags($tempat_lahir)."',"
        . "'".strip_tags($tgl_lahir)."',"
        . "'".strip_tags($jk)."',"
        . "'".strip_tags($kode_agama)."',"
        . "'".strip_tags($no_ktp_sim)."',"
       . "'".strip_tags($alamat_ktp)."',"
        . "'".strip_tags($kode_pos_ktp)."',"
        . "'".strip_tags($rt_rw_ktp)."',"
        . "'".strip_tags($no_propinsi)."',"
        . "'".strip_tags($id_kab)."',"
        . "'".strip_tags($alamat_domisil)."',"
        . "'".strip_tags($kode_pos_domisil)."',"
        . "'".strip_tags($rt_rw_domisil)."',"
        . "'".strip_tags($kode_gol_darah)."',"
        . "'".strip_tags($telp_rmh)."',"
        . "'".strip_tags($hp)."',"
        . "'".strip_tags($telp_inventaris)."',"
        . "'".strip_tags($tgl_masuk)."',"
        . "'".strip_tags($tgl_kontrak_awal)."',"
        . "'".strip_tags($tgl_kontrak_akhir)."',"
        . "'".strip_tags($kode_status)."',"
        . "'".strip_tags($kontrak_ke)."',"
        . "'".strip_tags($no_npwp)."',"
        . "'".strip_tags($no_bpjs_kt)."',"
        . "'".strip_tags($no_bpjs_kes)."',"
        . "'".strip_tags($no_inhealth)."',"
        . "'".strip_tags($kode_bank)."',"
        . "'".strip_tags($alamat_buka_bank)."',"
        . "'".strip_tags($rek_bank_baru)."',"
        . "'".strip_tags($nama_rek_bank)."',"
        . "'".strip_tags($kota_bank)."')";

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
