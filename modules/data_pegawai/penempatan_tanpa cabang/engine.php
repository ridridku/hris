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
$jenis_user  = $_SESSION['SESSION_JNS_USER'];
#Initiate TABLE
$tbl_name	= "r_penempatan";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM $tbl_name ";
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
$jenis_user  = $_SESSION['SESSION_JNS_USER'];
       
        $tipe_pdrm          = $_POST[tipe_pdrm];
        $r_pnpt__no_mutasi  = addslashes($_POST[r_pnpt__no_mutasi]);
        $r_pnpt__id_pegawai =addslashes($_POST[r_pnpt__id_pegawai]);
        $r_pnpt__nip        = addslashes($_POST[r_pnpt__nip]);
        $r_pnpt__status     = $_POST[r_pnpt__status];
        $r_pnpt__tipe_salary= addslashes($_POST[r_pnpt__tipe_salary]);
        $r_pnpt__subdept    =$_POST[kode_subdep];
        $kode_departemen    =  $_POST[kode_departemen_new];
        $r_pnpt__jabatan    = addslashes($_POST[r_jabatan]);
        $r_pnpt__finger_print= addslashes($_POST[r_pnpt__finger_print]);
        $r_pnpt__gapok= addslashes($_POST[r_pnpt__gapok]);
        $r_pnpt__subcab= addslashes($_POST[kode_subcab_cari]);
        $r_pnpt__shift= addslashes($_POST[r_pnpt__shift]);
        $r_pnpt__kon_awal= addslashes($_POST[r_pnpt__kon_awal]);
        $r_pnpt__kon_akhir= addslashes($_POST[r_pnpt__kon_akhir]);
        $r_pnpt__date_created= addslashes($_POST[r_pnpt__date_created]);
        $r_pnpt__date_updated= addslashes($_POST[r_pnpt__date_updated]);
        $r_pnpt__user_created= addslashes($_POST[r_pnpt__user_created]);
        $r_pnpt__user_updated= addslashes($_POST[r_pnpt__user_updated]);
        $r_pnpt__aktif= addslashes($_POST[r_pnpt__aktif]);
        $r_pegawai__nama= addslashes($_POST[r_pegawai__nama]);
        $r_pegawai__tgl_masuk= addslashes($_POST[r_pegawai__tgl_masuk]);
        $r_cabang__nama= addslashes($_POST[r_cabang__nama]);
        $r_jabatan__ket= addslashes($_POST[r_jabatan__ket]);
        $r_dept__ket= addslashes($_POST[r_dept__ket]);
        $r_cabang__id= addslashes($_POST[r_cabang__id]);
        $r_subcab__id= addslashes($_POST[r_subcab__id]);
        $r_dept__id= addslashes($_POST[r_dept__id]);
        $r_subdept__id= addslashes($_POST[r_subdept__id]);
        $user_id = base64_decode($_SESSION['UID']);
        $id_peg = $_SESSION['SESSION_ID_PEG'];
        $tgl_now = date("Y-m-d h:i:s");
        $r_pnpt__pdrm = $_POST[tipe_pdrm];
        $tgl_sk = $_POST[tgl_sk];
        $r_pnpt__areakerja = $_POST[areakerja];
        

        $sql_11 =" SELECT " ;    
$sql_11    .= "r_jabatan.r_jabatan__id AS r_jabatan__id,";
$sql_11    .= "r_jabatan.r_jabatan__ket AS r_jabatan__ket,";
$sql_11    .= "r_jabatan.r_jabatan__level,";
$sql_11    .= "r_jabatan.r_jabatan__sub_departemen,";
$sql_11    .= "r_jabatan.r_jabatan__departemen,";
$sql_11    .= "r_jabatan.r_jabatan__kategori_cabang,";
$sql_11    .= "r_subdepartement.r_subdept__id,";
$sql_11    .= "r_subdepartement.r_subdept__ket,";
$sql_11    .= "r_subdepartement.r_subdept__dept,";
$sql_11    .= "r_departement.r_dept__id,";
$sql_11    .= "r_departement.r_dept__ket";
$sql_11    .= " from r_jabatan 
inner join r_subdepartement ON r_jabatan.r_jabatan__sub_departemen=r_subdepartement.r_subdept__id
inner join r_departement on r_departement.r_dept__id=r_subdepartement.r_subdept__dept
WHERE r_departement.r_dept__id ='$kode_departemen' and r_subdepartement.r_subdept__id='$r_pnpt__subdept'  and r_jabatan__id='$r_pnpt__jabatan'
GROUP BY r_jabatan__id";// 

$rs_val_11 = $db->Execute($sql_11);
$cek_jabatan__id= $rs_val_11->fields["r_jabatan__id"];
        
        
        

        if ($cek_jabatan__id==''&& $tipe_pdrm==''){
        
      //  if (($cek_jabatan__id=='')or($tipe_pdrm==2 AND $jenis_user==2)OR($tipe_pdrm==3 AND $jenis_user==2 AND $jenis_user==2)OR($tipe_pdrm==6 AND $jenis_user==2)OR($tipe_pdrm==7 AND $jenis_user==2)OR($tipe_pdrm==8 AND $jenis_user==2)OR($tipe_pdrm==9 AND $jenis_user==2)) {
           Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
        } else {
            
            if($jenis_user=='1')
            {
              
                    $sql_edit  =" UPDATE r_penempatan SET ";
//                    $sql_edit .=" r_pnpt__no_mutasi='$r_pnpt__no_mutasi', ";
//                    $sql_edit .=" r_pnpt__id_pegawai='$r_pnpt__id_pegawai',";
//                    $sql_edit .=" r_pnpt__nip='$r_pnpt__nip',";
                    $sql_edit .=" r_pnpt__status='$r_pnpt__status',";
                    $sql_edit .=" r_pnpt__tipe_salary='$r_pnpt__tipe_salary',";
                    $sql_edit .=" r_pnpt__subdept= $r_pnpt__subdept,";
                    $sql_edit .=" r_pnpt__jabatan='$r_pnpt__jabatan',";
                    $sql_edit .=" r_pnpt__finger_print= '$r_pnpt__finger_print',";
                    $sql_edit .=" r_pnpt__gapok= '$r_pnpt__gapok',";
                    $sql_edit .=" r_pnpt__subcab = '$r_pnpt__subcab',";
                    $sql_edit .=" r_pnpt__shift = '$r_pnpt__shift',";
                    $sql_edit .=" r_pnpt__kon_awal = '$r_pnpt__kon_awal',";
                    $sql_edit .=" r_pnpt__kon_akhir = '$r_pnpt__kon_akhir',";
                    $sql_edit .=" r_pnpt__pdrm = '$r_pnpt__pdrm',";
                    $sql_edit .=" r_pnpt__tgl_efektif = '$tgl_sk',";
                    $sql_edit .=" r_pnpt__areakerja = '$r_pnpt__areakerja',";
                    $sql_edit .=" r_pnpt__aktif = '$r_pnpt__aktif',";
                    $sql_edit .=" r_pnpt__date_updated = '$tgl_now',";
                    $sql_edit .=" r_pnpt__user_updated = '$id_peg'";
                    $sql_edit .="  WHERE r_pnpt__no_mutasi='$_POST[r_pnpt__no_mutasi]' ";
                   // var_dump($sql_edit)or die();
                    $sqlresult = $db->Execute($sql_edit);
                 //   Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&page=".$_POST[page]."&r_pnpt__nip_cari=".$_POST[r_pnpt__nip]);
		
            }else
            {
// tanpa edit di cabang
//                   $sql_edit  =" UPDATE r_penempatan SET ";
//                    $sql_edit .=" r_pnpt__shift = '$r_pnpt__shift',";
//                    $sql_edit .=" r_pnpt__date_updated = now(),";
//                    $sql_edit .=" r_pnpt__user_updated = '$id_peg'";
//                    $sql_edit .="  WHERE r_pnpt__no_mutasi='$_POST[r_pnpt__no_mutasi]' ";
                  $sql_edit  =" UPDATE r_penempatan SET ";
                    $sql_edit .=" r_pnpt__no_mutasi='$r_pnpt__no_mutasi', ";
                    $sql_edit .=" r_pnpt__id_pegawai='$r_pnpt__id_pegawai',";
                    $sql_edit .=" r_pnpt__nip='$r_pnpt__nip',";
                    $sql_edit .=" r_pnpt__status='$r_pnpt__status',";
                    $sql_edit .=" r_pnpt__tipe_salary='$r_pnpt__tipe_salary',";
                    $sql_edit .=" r_pnpt__subdept= $r_pnpt__subdept,";
                    $sql_edit .=" r_pnpt__jabatan='$r_pnpt__jabatan',";
                    $sql_edit .=" r_pnpt__finger_print= '$r_pnpt__finger_print',";
                    $sql_edit .=" r_pnpt__gapok= '$r_pnpt__gapok',";
                    $sql_edit .=" r_pnpt__subcab = '$r_pnpt__subcab',";
                    $sql_edit .=" r_pnpt__shift = '$r_pnpt__shift',";
                    $sql_edit .=" r_pnpt__kon_awal = '$r_pnpt__kon_awal',";
                    $sql_edit .=" r_pnpt__kon_akhir = '$r_pnpt__kon_akhir',";
                    $sql_edit .=" r_pnpt__pdrm = '$r_pnpt__pdrm',";
                    $sql_edit .=" r_pnpt__tgl_efektif = '$tgl_sk',";
                    $sql_edit .=" r_pnpt__areakerja = '$r_pnpt__areakerja',";
                    $sql_edit .=" r_pnpt__aktif = '$r_pnpt__aktif',";
                    $sql_edit .=" r_pnpt__date_updated = '$tgl_now',";
                    $sql_edit .=" r_pnpt__user_updated = '$id_peg'";
                    $sql_edit .="  WHERE r_pnpt__no_mutasi='$_POST[r_pnpt__no_mutasi]' ";
                   
                    $sqlresult = $db->Execute($sql_edit);
               
            }
                    
                     
//                    
//                    
//                $sql8	 = "INSERT INTO t_penempatan_detail ("
//                              . "t_penempatan__detail_mutasi,"
//                              . "t_penempatan__detail_nip,"
//                              . "t_penempatan__detail_finger,"
//                              . "r_penempatan__date_updated,"
//                              . "r_penempatan__user_updated)";
//                            $sql8   .= " VALUES ($r_pnpt__no_mutasi,$r_pnpt__pdrm,$r_pnpt__finger_print,now(),$id_peg)";
//                            $sqlresult8 = $db->Execute($sql8);

			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&page=".$_POST[page]."&r_pnpt__nip_cari=".$_POST[r_pnpt__nip]);
		}
}

function create_(){
$jenis_user  = $_SESSION['SESSION_JNS_USER'];
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];
$tgl_now = date("Y-m-d h:i:s");

$tipe_pdrm          = $_POST[tipe_pdrm];
$pdrm__finger       = $_POST[pdrm__finger];
$pdrm__nip = $_POST[pdrm__nip_new];
$r_pnpt__no_mutasi  = $_POST[r_pnpt__no_mutasi];
$r_pnpt__id         = $_POST[r_pegawai__id];
$r_pegawai__tgl_masuk =$_POST[r_pegawai__tgl_masuk];
$r_pnpt__tipe_salary = $_POST[r_pnpt__tipe_salary];
$r_pnpt__kon_awal   = $_POST[r_pnpt__kon_awal];
$r_pnpt__kon_akhir  = $_POST[r_pnpt__kon_akhir];
$kode_cabang        = $_POST[kode_cabang];
$r_pnpt__subcab   = $_POST[kode_subcab_cari];
$r_pnpt__subdept    = $_POST[kode_subdep];
$kode_departemen    =  $_POST[kode_departemen_new];
$r_pnpt__jabatan    =  $_POST[r_jabatan];
$r_pnpt__finger_print = $_POST[r_pnpt__finger_print];
$r_pnpt__aktif  = $_POST[r_pnpt__aktif];
$r_pnpt__shift  = $_POST[r_pnpt__shift];
$tgl_sk = $_POST[tgl_sk];
$r_pnpt__areakerja = $_POST[areakerja];

$r_pnpt__status     = $_POST[r_pnpt__status];
$r_pnpt__date_created= addslashes($_POST[r_pnpt__date_created]);
$r_pnpt__user_created = addslashes($_POST[r_pnpt__user_created]);


$array1=explode("-",$r_pegawai__tgl_masuk);
$tahun_masuk    =   $array1[0];
$bulan_masuk    =   $array1[1];
$tgl_masuk      =   $array1[2];

$tahun_masuk__nip = substr($tahun_masuk,2,4);
$bulan_masuk__nip=$bulan_masuk;
$kode_cabang__nip = sprintf('%02s',$kode_cabang); 
$no_urut_pegawai=sprintf('%04s',$r_pnpt__id); 
$kode_departemen_nip=$kode_departemen; 


//$sql_cek_nip="SELECT MAX(A.r_pnpt__id_pegawai) as nip_max  FROM r_penempatan A ";   
$sql_cek_nip="SELECT MAX(A.r_pegawai__id) as nip_max  FROM r_pegawai A ";   
$rs_val = $db->Execute($sql_cek_nip);
$nip_max= $rs_val->fields['nip_max'];
//var_dump($nip_max)or die();
$NewID = sprintf('%04s', $nip_max+1);


$nip_karyawan=$tahun_masuk__nip.''.$kode_cabang__nip.''.$kode_departemen_nip.''.$no_urut_pegawai ;
$cek_nip="SELECT r_pnpt__nip as nip FROM r_penempatan a where  a.r_pnpt__nip= '$nip_karyawan'";
$rs_val_nip = $db->Execute($cek_nip);
$nip= $rs_val_nip->fields["nip"];

$cek_nip_lama="SELECT r_pnpt__nip as nip,r_pnpt__no_mutasi as mutasi FROM r_penempatan a where  a.r_pnpt__nip= '$pdrm__nip'";

$rs_val = $db->Execute($cek_nip_lama);
$nip_lama= $rs_val->fields["nip"];
$mutasi_lama= $rs_val->fields["mutasi"];
    
$sql_edit10  ="UPDATE r_gapok set ";
$sql_edit10 .="r_gapok__aktif = '0' ";
$sql_edit10 .="  WHERE r_gapok__id_penempatan='$mutasi_lama'";
$sqlresult10 = $db->Execute($sql_edit10);


$sql_11     =" SELECT " ;    
$sql_11    .= "r_jabatan.r_jabatan__id AS r_jabatan__id,";
$sql_11    .= "r_jabatan.r_jabatan__ket AS r_jabatan__ket,";
$sql_11    .= "r_jabatan.r_jabatan__level,";
$sql_11    .= "r_jabatan.r_jabatan__sub_departemen,";
$sql_11    .= "r_jabatan.r_jabatan__departemen,";
$sql_11    .= "r_jabatan.r_jabatan__kategori_cabang,";
$sql_11    .= "r_subdepartement.r_subdept__id,";
$sql_11    .= "r_subdepartement.r_subdept__ket,";
$sql_11    .= "r_subdepartement.r_subdept__dept,";
$sql_11    .= "r_departement.r_dept__id,";
$sql_11    .= "r_departement.r_dept__ket";
$sql_11    .= " from r_jabatan 
inner join r_subdepartement ON r_jabatan.r_jabatan__sub_departemen=r_subdepartement.r_subdept__id
inner join r_departement on r_departement.r_dept__id=r_subdepartement.r_subdept__dept
WHERE r_departement.r_dept__id ='$kode_departemen' and r_subdepartement.r_subdept__id='$r_pnpt__subdept'  and r_jabatan__id='$r_pnpt__jabatan'
GROUP BY r_jabatan__id";

$rs_val_11 = $db->Execute($sql_11);
$cek_jabatan__id= $rs_val_11->fields["r_jabatan__id"];

 if (($cek_jabatan__id=='')or($nip_karyawan=='')OR($mutasi_lama==$r_pnpt__no_mutasi)OR($tipe_pdrm==2 AND $jenis_user==2)OR($tipe_pdrm==3 AND $jenis_user==2 AND $jenis_user==2)OR($tipe_pdrm==6 AND $jenis_user==2)OR($tipe_pdrm==7 AND $jenis_user==2)OR($tipe_pdrm==8 AND $jenis_user==2)OR($tipe_pdrm==9 AND $jenis_user==2) ) 
    {
       
        Header("Location:index_cek.php?ERR=5&nip_karyawan=".$nip_karyawan."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
    }
     elseif ($tipe_pdrm!=101)
    {

                $sqlresult = $db->Execute($sql);
                $sql_edit7  ="UPDATE r_penempatan set ";
                $sql_edit7 .=" r_pnpt__aktif = '0' ";
                $sql_edit7 .=" WHERE r_pnpt__nip='$pdrm__nip'";
                $sqlresult7 = $db->Execute($sql_edit7);
//                
        $sql	 = "INSERT INTO r_penempatan ("
                     . "r_pnpt__id_pegawai, "
                     . "r_pnpt__nip, "
                     . "r_pnpt__status, "
                     . "r_pnpt__tipe_salary, "
                     . "r_pnpt__subdept, "
                     . "r_pnpt__jabatan, "
                     . "r_pnpt__finger_print, "
                     . "r_pnpt__gapok, "
                     . "r_pnpt__subcab, "
                     . "r_pnpt__aktif, "
                     . "r_pnpt__areakerja, "
                     . "r_pnpt__tgl_efektif, "
                     . "r_pnpt__kon_awal, "
                     . "r_pnpt__kon_akhir, "
                     . "r_pnpt__date_created, "
                     . "r_pnpt__user_created, "
                     . "r_pnpt__date_updated, "
                     . "r_pnpt__user_updated, "
                     . "r_pnpt__shift,"
                      . "r_pnpt__pdrm)";
            $sql	.= " VALUES ("
                    . "'".strip_tags($r_pnpt__id)."',"
                    . "'$nip_lama',"
                    . "'".strip_tags($r_pnpt__status)."',"
                    . "'".strip_tags($r_pnpt__tipe_salary)."',"
                    . "'".strip_tags($r_pnpt__subdept)."',"
                    . "'".strip_tags($r_pnpt__jabatan)."',"
                    . "'$r_pnpt__finger_print',"
                    . "'".strip_tags($r_pnpt__gapok)."',"
                    . "'".strip_tags($r_pnpt__subcab)."',"
                    . "'".strip_tags($r_pnpt__aktif)."',"
                    . "'".strip_tags($tgl_sk)."',"
                    . "'".strip_tags($r_pnpt__areakerja)."',"
                    . "'".strip_tags($r_pnpt__kon_awal)."',"
                    . "'".strip_tags($r_pnpt__kon_akhir)."',"
                    . "now(),"
                    . "'".strip_tags($id_peg)."',"
                    . "now(),"
                    . "'$id_peg',"
                    . "'".strip_tags($r_pnpt__shift)."',"
                    . "'$tipe_pdrm')";
         
             $sqlresult = $db->Execute($sql);

       
        $sql9	 = "INSERT INTO r_gapok (r_gapok__id_penempatan,r_gapok__aktif,r_gapok__date_created,r_gapok__user_created)";
        $sql9  .= " VALUES ($r_pnpt__no_mutasi,'1',now(),$id_peg)";
        $sqlresult9 = $db->Execute($sql9);
         
            Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&r_pnpt__nip_cari=".$nip_lama);
    }
    else
    {

                
                    $sql	 = "INSERT INTO r_penempatan ("
                                  
                                    . "r_pnpt__id_pegawai, "
                                    . "r_pnpt__nip, "
                                    . "r_pnpt__status, "
                                    . "r_pnpt__tipe_salary, "
                                    . "r_pnpt__subdept, "
                                    . "r_pnpt__jabatan, "
                                    . "r_pnpt__finger_print, "
                                    . "r_pnpt__gapok, "
                                    . "r_pnpt__subcab, "
                                    . "r_pnpt__aktif, "
                                    . "r_pnpt__areakerja, "
                                    . "r_pnpt__tgl_efektif, "
                                    . "r_pnpt__kon_awal, "
                                    . "r_pnpt__kon_akhir, "
                                    . "r_pnpt__date_created, "
                                    . "r_pnpt__user_created, "
                                    . "r_pnpt__date_updated, "
                                    . "r_pnpt__user_updated, "
                                    . "r_pnpt__shift,"
                                     . "r_pnpt__pdrm)";
                    $sql	.= " VALUES ("
                          
                            . "'".strip_tags($r_pnpt__id)."',"
                            . "'".strip_tags($nip_karyawan)."',"
                            . "'".strip_tags($r_pnpt__status)."',"
                            . "'".strip_tags($r_pnpt__tipe_salary)."',"
                            . "'".strip_tags($r_pnpt__subdept)."',"
                            . "'".strip_tags($r_pnpt__jabatan)."',"
                            . "'".strip_tags($r_pnpt__finger_print)."',"
                            . "'".strip_tags($r_pnpt__gapok)."',"
                            . "'".strip_tags($r_pnpt__subcab)."',"
                            . "'".strip_tags($r_pnpt__aktif)."',"
                            . "'".strip_tags($r_pnpt__areakerja)."',"
                            . "'".strip_tags($tgl_sk)."',"
                            . "'".strip_tags($r_pnpt__kon_awal)."',"
                            . "'".strip_tags($r_pnpt__kon_akhir)."',"
                            . " now(),"
                            . "'".strip_tags($id_peg)."',"
                             . " now(),"
                            . "'$id_peg',"
                            . "'".strip_tags($r_pnpt__shift)."',"
                            . "'1')";
                 // var_dump($sql)or die();
$sqlresult = $db->Execute($sql);


 $sql8	 = "INSERT INTO t_penempatan_detail ("
                                    . "t_penempatan__detail_mutasi,"
                                    . "t_penempatan__detail_nip,"
                                    . "t_penempatan__detail_finger,"
                                    . "r_penempatan__date_created,"
                                    . "r_penempatan__user_created)";
    $sql8   .= " VALUES ($r_pnpt__no_mutasi,$nip_karyawan,$r_pnpt__finger_print,now(),$id_peg)";
    $sqlresult8 = $db->Execute($sql8);
                   
                        
        $sql9 = "INSERT INTO r_gapok (r_gapok__id_penempatan,r_gapok__aktif,r_gapok__date_created,r_gapok__user_created)";
        $sql9  .= " VALUES ($r_pnpt__no_mutasi,'1',now(),$id_peg)";
        $sqlresult9 = $db->Execute($sql9);

        
        Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&r_pnpt__nip_cari=".$nip_karyawan);
                }

    
    
}

 
// TUTUP CREATE
 
if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];


switch ($op){

case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
	//	lockTables($tbl_name);
		create_($r_pnpt__no_mutasi);
	//	unlockTables($tbl_name);	
        //        Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
	//	lockTables($tbl_name);
		edit_($r_pnpt__no_mutasi);
	//	unlockTables($tbl_name);		
	//	Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
	//	lockTables($tbl_name);
		delete_($r_pnpt__no_mutasi);
	//	unlockTables($tbl_name);		
	//	Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
}


}
?>
