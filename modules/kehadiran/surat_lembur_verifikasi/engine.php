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

    $sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_awal,r_periode__payroll_akhir,r_periode__payroll_status "
                 . "FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
        $rs_val = $db->Execute($sql_cek_periode);
        $periode_awal= $rs_val->fields['r_periode__payroll_awal'];
        $periode_akhir= $rs_val->fields['r_periode__payroll_akhir'];

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM t_lembur ";
$sql .="WHERE  t_lembur__no= '$_GET[id]' ";
$sqlresult = $db->Execute($sql);



}

function edit_(){
    
   
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;
$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];
  
    $sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_awal,r_periode__payroll_akhir,r_periode__payroll_status "
                 . "FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
        $rs_val = $db->Execute($sql_cek_periode);
        $periode_awal= $rs_val->fields['r_periode__payroll_awal'];
        $periode_akhir= $rs_val->fields['r_periode__payroll_akhir'];
 
if (
   !empty($_POST['id_pegawai']) && !empty($_POST['tgl_lembur']) && !empty($_POST['overtime']) && !empty($_POST['level'])&&
   is_array($_POST['id_pegawai']) && is_array($_POST['tgl_lembur']) && is_array($_POST['overtime']) &&is_array($_POST['approval']) &&
   count($_POST['id_pegawai']) === count($_POST['tgl_lembur'])
    ) {

            $id_karyawan_array=$_POST['id_pegawai'];
            $tgl_lembur_array=$_POST['tgl_lembur'];
            $overtime_array=$_POST['overtime'];
            $level_array=$_POST['level'];
            $approval_array=$_POST['approval'];
            $atasan_array=$_POST['nama_atasan'];

//  //$array = json_decode($id_karyawan_array,true);
//    var_dump($approval_array[0].''.$overtime_array[0])or die(); 

     
    for ($i = 0; $i < count($approval_array); $i++) 
    {
        $id_pegawai= mysql_real_escape_string($id_karyawan_array[$i]);
        $tgl_lembur = mysql_real_escape_string($tgl_lembur_array[$i]);
        $jml_jam= mysql_real_escape_string($overtime_array[$i]);
       $level= mysql_real_escape_string($level_array[$i]);
       $atasan_nama= mysql_real_escape_string($atasan_array[$i]);
        $id_absensi= mysql_real_escape_string($approval_array[$i]);
      
          
         
             $CekFingerPrint="SELECT
                        A.r_shift__jam_masuk AS r_shift__jam_masuk,
                        A.r_shift__jam_pulang AS r_shift__jam_pulang,
                        A.r_shift__jml_jam AS r_shift__jml_jam,
                        A.r_shift__id AS r_shift__id,B.r_pnpt__finger_print AS finger_print
                        FROM
                        r_shift A
                        INNER JOIN r_penempatan B ON B.r_pnpt__shift=A.r_shift__id
                        WHERE B.r_pnpt__id_pegawai=$id_pegawai";
            
                    $rs_val = $db->Execute($CekFingerPrint);
                    $rule_jam_masuk= $rs_val->fields['r_shift__jam_masuk'];
                    $rule_jam_keluar= $rs_val->fields['r_shift__jam_pulang'];
                    $rule_jam_total= $rs_val->fields['r_shift__jml_jam'];
                    $rule_shift= $rs_val->fields['r_shift__id'];
                    $finger_print= $rs_val->fields['finger_print'];
        
        
           $sql_cek="SELECT A.t_abs__fingerprint AS t_abs__fingerprint,"
            . " A.t_abs__tgl AS t_abs__tgl,"
            . "A.t_abs__jam_masuk AS t_abs__jam_masuk,"
            . "A.t_abs__jam_keluar AS t_abs__jam_keluar, "
            . " A.t_abs__status AS t_abs__status,"
            . "	A.t_abs__overtime AS overtime "
            . " FROM t_absensi A "
            . " where A.t_abs__id='$id_absensi' "
            . " AND A.t_abs__tgl>='$periode_awal' AND A.t_abs__tgl <= '$periode_akhir'";
   //        . " AND A.t_abs__tgl='$tgl_lembur' ";
      // var_dump($sql_cek)or die();
           
            $rs_val = $db->Execute($sql_cek);
            $finger_cek= $rs_val->fields['t_abs__fingerprint'];
            $tgl_cek = $rs_val->fields['t_abs__tgl'];
            $status_cek= $rs_val->fields['t_abs__status'];
            $jam_msk_cek=$rs_val->fields['t_abs__jam_masuk'];
            $jam_keluar_cek=$rs_val->fields['t_abs__jam_keluar'];
            $overtime_cek=$rs_val->fields['overtime'];

      $durasi_iterasi_str= strtotime($overtime_cek);
      $durasi=idate('h',$durasi_iterasi_str);
     

            if($overtime_cek>='01:00:00')
            {
                
           
                $sql_libur ="SELECT
                        r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                        r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                        r_pegawai.r_pegawai__id AS r_pegawai__id,
                        r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                        r_pegawai.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
                        r_pegawai.r_pegawai__ktp AS r_pegawai__ktp,
                        r_status_pegawai.r_stp__id AS r_stp__id,
                        r_status_pegawai.r_stp__nama AS r_stp__nama,
                        r_level.r_level__id AS r_level__id,
                        r_level.r_level__ket AS r_level__ket,
                        r_level_lembur.r_level__ket AS r_level__ket,
                        r_level_lembur.r_level__nominal AS r_level__nominal,
                        r_level_lembur.r_level__makan AS r_level__makan,
                        r_level_lembur.r_level__transport AS r_level__transport,
                        t_libur.r_libur__tgl AS r_libur__tgl,
                        t_libur.r_libur__id AS r_libur__id,
                        t_libur.r_libur__ket AS r_libur__ket
                        FROM
                                r_pegawai
                        INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                        INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                        INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                        INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                        INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                        INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                        INNER JOIN r_status_pegawai ON r_status_pegawai.r_stp__id = r_penempatan.r_pnpt__status
                        INNER JOIN r_level ON r_level__id=r_jabatan__level
                        INNER JOIN r_level_lembur ON r_level_lembur.r_level__id=r_level.r_level__id 
                        inner JOIN t_libur ON t_libur.r_libur__shift = r_pnpt__shift
                         where r_level.r_level__id='$level' AND  r_libur__tgl='$tgl_lembur'  AND r_pnpt__id_pegawai='$id_pegawai'";



    $resultSet = $db->Execute($sql_libur);
    $cek_libur= $resultSet->fields[r_libur__tgl];
    $cek_level= $resultSet->fields[r_level__id];
    $cek_nominal= $resultSet->fields[r_level__nominal];
       
    
    if($cek_libur>0)
    {   
     //   jika libur  var_dump('a')or die();  
        $lembur_sql=" SELECT
            r_level.r_level__id AS r_level__id,
            r_level.r_level__ket AS r_level__ket,
            r_level_lembur.r_level__ket AS r_level__ket,
            r_level_lembur.r_level__nominal AS r_level__nominal,
            r_level_lembur.r_level__makan AS r_level__makan,
            r_level_lembur.r_level__transport AS r_level__transport,
            t_libur.r_libur__tgl AS r_libur__tgl,
            t_libur.r_libur__id AS r_libur__id,
            t_libur.r_libur__ket AS r_libur__ket
            FROM
                    r_pegawai
            INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
            INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
            INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
            INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
            INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
            INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
            INNER JOIN r_status_pegawai ON r_status_pegawai.r_stp__id = r_penempatan.r_pnpt__status
            INNER JOIN r_level ON r_level__id=r_jabatan__level
            INNER JOIN r_level_lembur ON r_level_lembur.r_level__id=r_level.r_level__id 
            inner JOIN t_libur ON t_libur.r_libur__shift = r_pnpt__shift
             where r_level.r_level__id='$level'  GROUP BY r_level__id";
     
        $resultSet = $db->Execute($lembur_sql);
        $nominal_lembur =  ($libur= $resultSet->fields[r_level__nominal]*2);
       
        if($durasi>=4)
        {
              $nominal_makan=$resultSet->fields[r_level__makan];
               $nominal_transport=$resultSet->fields[r_level__transport];
        }
        else
        {
            $nominal_makan=0;
            $nominal_transport=0;
        }
        
        
        
       
        
    }
    else
    { 
        //   jika hari biasa weekday
            $lembur_sql=" SELECT
            r_level.r_level__id AS r_level__id,
            r_level.r_level__ket AS r_level__ket,
            r_level_lembur.r_level__ket AS r_level__ket,
            r_level_lembur.r_level__nominal AS r_level__nominal,
            r_level_lembur.r_level__makan AS r_level__makan,
            r_level_lembur.r_level__transport AS r_level__transport,
            t_libur.r_libur__tgl AS r_libur__tgl,
            t_libur.r_libur__id AS r_libur__id,
            t_libur.r_libur__ket AS r_libur__ket
            FROM
            r_pegawai
            INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
            INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
            INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
            INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
            INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
            INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
            INNER JOIN r_status_pegawai ON r_status_pegawai.r_stp__id = r_penempatan.r_pnpt__status
            INNER JOIN r_level ON r_level__id=r_jabatan__level
            INNER JOIN r_level_lembur ON r_level_lembur.r_level__id=r_level.r_level__id 
            inner JOIN t_libur ON t_libur.r_libur__shift = r_pnpt__shift
             where r_level.r_level__id='$level'";
       
        $resultSet = $db->Execute($lembur_sql);
        $nominal_lembur = $resultSet->fields[r_level__nominal];
    if($durasi>=2)
        {
              $nominal_makan=$resultSet->fields[r_level__makan];
              $nominal_transport=0;    
        }
        else
        {
             $nominal_makan=0;
             $nominal_transport=0;    
        }
        
        
          
        
        
    }
    
     
    
    $jumlah_lembur=$nominal_lembur*$durasi;
    $TOTAL=0;
    $TOTAL=$jumlah_lembur+$nominal_makan+$nominal_transport;
   
    $cek_lembur="SELECT
                t_lembur.t_lembur__no AS no_lembur,
                t_lembur.t_lembur__idpeg AS cek_peg,
                t_lembur.t_lembur__tanggal AS cek_tgl
                FROM t_lembur 
                where t_lembur__idpeg='$id_pegawai' AND t_lembur__tanggal='$tgl_lembur'";
                $resultSet = $db->Execute($cek_lembur);
                $cek_pegawai = $resultSet->fields[cek_peg];
                $cek_tgl = $resultSet->fields[cek_tgl];
                 $no_lembur = $resultSet->fields[no_lembur];
                
                  
    if($cek_pegawai=='' AND  $cek_tgl=='')
    {
    
    $sql	 = "INSERT INTO $tbl_name ("
                                  
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

                                            . "'$finger_cek',"
                                            . "'$atasan_nama',"
                                            . "'12',"
                                            . "'$tgl_cek',"
                                            . "'$nominal_lembur',"
                                            . "'$durasi',"
                                            . "'$jumlah_lembur',"
                                            . "'$nominal_makan',"
                                            . "'$nominal_transport',"
                                            . "'$TOTAL',"
                                            . "'',"
                                            . "'',"
                                            . "'1',"
                                            . "now(),"
                                            . "now(),"
                                            . "'".strip_tags($id_peg)."',"
                                            . "'".strip_tags($id_peg)."')";

    // var_dump($sql)or die();
    $sqlresult = $db->Execute($sql);
    
    }elseif($cek_pegawai!='' AND  $cek_tgl!='' )
    {
        
        
          $sql_edit  ="  UPDATE $tbl_name SET ";
     
                    $sql_edit .=" t_lembur__idpeg='$finger_cek',";
                    $sql_edit .=" t_lembur__atasan_nama='$atasan_nama',";
                    $sql_edit .=" t_lembur__atasan_idpeg='',";
                    $sql_edit .=" t_lembur__tanggal='$tgl_cek',";
                    $sql_edit .=" t_lembur__nominal='$nominal_lembur',";
                    $sql_edit .=" t_lembur__durasi= '$durasi',";
                    $sql_edit .=" t_lembur__jml_nominal= '$jumlah_lembur',";
                    $sql_edit .=" t_lembur__makan= '$nominal_makan',";
                    $sql_edit .=" t_lembur__transport= '$nominal_transport',";
                    $sql_edit .=" t_lembur__total='$TOTAL',";
                    $sql_edit .=" t_lembur__job_description= '',";
                    $sql_edit .=" t_lembur__job_evaluasi = '',";
                    $sql_edit .=" t_lembur__approval = '1',";
                    $sql_edit .=" t_lembur__date_updated = now(),";
                    $sql_edit .=" t_lembur__user_updated = '$id_peg'";
                    $sql_edit .="  WHERE t_lembur__no='$no_lembur' ";

                 
                    $sqlresult = $db->Execute($sql_edit);
        
        
        
        
    } 
    
     }

    } 
    
   
   
}


    Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
               
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
