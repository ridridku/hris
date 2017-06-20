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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kehadiran/surat_cuti';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kehadiran');
$FILE_JS  = $JS_MODUL.'/surat_cuti';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "t_cuti";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

$sql  ="DELETE ";
$sql .="FROM $tbl_name ";
$sql .="WHERE  t_cuti__no= '$_GET[id]' ";

$sqlresult = $db->Execute($sql);



}

function edit_(){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;
        
$t_cuti__no= $_POST[cuti__no];
$t_cuti__nip = $_POST[karyawan_nip];
$t_cuti__nama= $_POST[karyawan_nama];
$t_cuti__atasan_nama = $_POST[atasan__nama];
$t_cuti__atasan_nip = $_POST[atasan__nip];
$t_cuti__tgl= $_POST[tgl];
$t_cuti__lama_hari= $_POST[lama_hari];
$t_cuti__jenis_cuti= $_POST[jenis_cuti];
$t_cuti__alasan= $_POST[alasan];

$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];

$hari_ambil=$t_cuti__tgl;
$hari_ambil = explode('-', $hari_ambil);
$ambil_year  = $hari_ambil[0];
$ambil_month = $hari_ambil[1];
$ambil_day   = $hari_ambil[2];

  
        $date1 = $t_cuti__tgl_awal;
        $date2 = $t_cuti__tgl_akhir;
        $diff_hari = ((abs(strtotime ($date1) - strtotime ($date2)))/(60*60*24)+1);
        
        $sql_pw="SELECT
	peg.r_pegawai__nama AS nama,
	peg.r_cabang__nama AS r_cabang__nama,
        peg.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,    
        peg.r_pnpt__no_mutasi AS r_pnpt__no_mutasi
        FROM
	v_pegawai peg where r_pnpt__no_mutasi='$t_cuti__nip'";
        
        $rs_pw	= $db->execute($sql_pw);
        $tgl_masuk=$rs_pw->fields['r_pegawai__tgl_masuk'];
        $tgl_masuk_karyawan=$rs_pw->fields['r_pegawai__tgl_masuk'];
 

        $now=date("Y-m-d");
        $now = explode('-', $now);
        $now_year  = $now[0];
        $now_month = $now[1];
        $now_day   = $now[2];

        $tgl_masuk_explode=date($tgl_masuk);
       
        $tgl_masuk_explode = explode('-',$tgl_masuk_explode);
        $exp_tahun_msk   = $tgl_masuk_explode[0];
        $exp_bln_msk   = $tgl_masuk_explode[1];
        $exp_tgl_msk = $tgl_masuk_explode[2];

        $start_cuti=array($now_year,$exp_bln_msk,$exp_tgl_msk);
        $expired_cuti=array($now_year+1,$exp_bln_msk,$exp_tgl_msk);

        $periode_aktif   = implode("-",$start_cuti);
        $periode_expired = implode("-",$expired_cuti);      
        
      //  $sql_cek_cutibersama="SELECT COUNT(A.r_tglcuti__tgl) AS JML_CUTI FROM r_cutibersama A where YEAR(A.r_tglcuti__tgl)=$ambil_year";  
 $sql_cek_cutibersama="SELECT
                        COUNT(t_libur.r_libur__id) AS JML_CUTI,
                        t_libur.r_libur__shift,
                        t_libur.r_libur__tgl,
                        t_libur.r_libur__jenis,
                        t_libur.r_libur__ket
                        FROM t_libur WHERE r_libur__jenis = '2' AND YEAR(r_libur__tgl)=$ambil_year GROUP BY r_libur__tgl";
        $rs_val = $db->Execute($sql_cek_cutibersama);
        $jml_cutibersama= $rs_val->fields['JML_CUTI'];
     
        $sql_cek_cuti="SELECT SUM(A.t_cuti__lama_hari) AS MAX_CUTI 
                       FROM t_cuti A where t_cuti__nip='$t_cuti__nip' AND t_cuti__jenis_cuti='1' "
                       . " AND t_cuti__tgl between '$periode_aktif' and '$periode_expired' AND t_cuti__no!='$t_cuti__no'";

        $rs_val = $db->Execute($sql_cek_cuti);
        $sudah_cuti= $rs_val->fields['MAX_CUTI'];
        $cuti_yg_diambil=($jml_cutibersama+$sudah_cuti);
   
        $d1 = new DateTime($tgl_masuk_karyawan);
        $d2 = new DateTime(date("Y-m-d"));
        $diff = $d2->diff($d1);
        $role_cuti=$diff->y;
          
       $jml_hari_update= $cuti_yg_diambil+$t_cuti__lama_hari;
 
       
       $sql_pw="SELECT
	peg.r_pegawai__nama AS nama,
	peg.r_cabang__nama AS r_cabang__nama,
        peg.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,    
        peg.r_pnpt__no_mutasi AS r_pnpt__no_mutasi
        FROM
	v_pegawai peg

where r_pnpt__no_mutasi='$t_cuti__nip'";

$rs_pw	= $db->execute($sql_pw);
$tgl_masuk=$rs_pw->fields['r_pegawai__tgl_masuk'];
$tgl_masuk_karyawan=$rs_pw->fields['r_pegawai__tgl_masuk'];

$now=date("Y-m-d");
$now = explode('-', $now);
$now_year  = $now[0];
$now_month = $now[1];
$now_day   = $now[2];

$tgl_masuk_explode=date($tgl_masuk);
$tgl_masuk_explode = explode('-',$tgl_masuk_explode);
$exp_tahun_msk   = $tgl_masuk_explode[0];
$exp_bln_msk   = $tgl_masuk_explode[1];
$exp_tgl_msk = $tgl_masuk_explode[2];
 
$start_cuti=array(trim($now_year),trim($exp_bln_msk),trim($exp_tgl_msk));
$expired_cuti=array(trim($now_year+1),trim($exp_bln_msk),trim($exp_tgl_msk));

$periode_aktif   = implode("-",$start_cuti);
$periode_expired = implode("-",$expired_cuti);

$cek_str=strtotime($periode_aktif);
$cek_exp=strtotime($periode_expired);
$cek_tgl_cuti=strtotime($_POST[tgl]);
       
       
       if(($t_cuti__jenis_cuti==1 AND $role_cuti>12 AND $jml_hari_update>12)OR ($t_cuti__jenis_cuti==1 AND $jml_hari_update>12) OR($cek_tgl_cuti>$cek_exp))
        {
           Header("Location:index_cek.php?ERR=5&nip_karyawan=".$nip_karyawan."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]); 
        }
        elseif($t_cuti__jenis_cuti==2 AND $role_cuti>=1)
                {
        
                    $sql_edit  ="  UPDATE $tbl_name SET ";
                    $sql_edit .=" t_cuti__nip='$t_cuti__nip',";
                    $sql_edit .=" t_cuti__atasan_nama='$t_cuti__atasan_nama',";
                    $sql_edit .=" t_cuti__atasan_nip='$t_cuti__atasan_nip',";
                    $sql_edit .=" t_cuti__tgl='$_POST[tgl]',";
                    $sql_edit .=" t_cuti__lama_hari='$_POST[lama_hari]',";
                    $sql_edit .=" t_cuti__jenis_cuti='$t_cuti__jenis_cuti',";
                    $sql_edit .=" t_cuti__alasan= '$t_cuti__alasan',";
                    $sql_edit .=" t_cuti__date_updated = now(), ";
                    $sql_edit .=" t_cuti__user_updated = '$id_peg'";
                    $sql_edit .="  WHERE t_cuti__no='$_POST[cuti__no]' ";
                    $sqlresult = $db->Execute($sql_edit);
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
                }
        
        else{
           
                    $sql_edit  ="  UPDATE $tbl_name SET ";
                    $sql_edit .=" t_cuti__nip='$t_cuti__nip',";
                    $sql_edit .=" t_cuti__atasan_nama='$t_cuti__atasan_nama',";
                    $sql_edit .=" t_cuti__atasan_nip='$t_cuti__atasan_nip',";
                    $sql_edit .=" t_cuti__tgl='$_POST[tgl]',";
                    $sql_edit .=" t_cuti__lama_hari='$_POST[lama_hari]',";
                    $sql_edit .="t_cuti__jenis_cuti='$t_cuti__jenis_cuti',";
                    $sql_edit .=" t_cuti__alasan= '$t_cuti__alasan',";
                    $sql_edit .=" t_cuti__date_updated = now(), ";
                    $sql_edit .=" t_cuti__user_updated = '$id_peg'";
                    $sql_edit .="  WHERE t_cuti__no='$_POST[cuti__no]' ";
   
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
$t_cuti__no  = $_POST[cuti__no];
$t_cuti__karyawan = $_POST[karyawan_nama];
$t_cuti__nip = $_POST[karyawan_nip];
$t_cuti__atasan_nip = $_POST[atasan__nip];
$t_cuti__atasan_nama = $_POST[atasan__nama];
$t_cuti__awal= $_POST[tgl_awal];
$t_cuti__akhir= $_POST[tgl_akhir];

$t_cuti__lama_hari = $_POST[lama_hari];
$t_cuti__jenis_cuti  = $_POST[jenis_cuti];
$t_cuti__alasan = $_POST[alasan];
$t_lembur__approval   = $_POST[approval];
$t_cuti__date_created= date("Y-m-d h:i:s");
$t_cuti__user_created = $id_peg;

$hari_ambil=$t_cuti__tgl;

$hari_ambil = explode('-', $hari_ambil);
$ambil_year  = $hari_ambil[0];
$ambil_month = $hari_ambil[1];
$ambil_day   = $hari_ambil[2];

$sql_pw="SELECT
	peg.r_pegawai__nama AS nama,
	peg.r_cabang__nama AS r_cabang__nama,
        peg.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,    
        peg.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
          peg.r_pegawai__id as r_pegawai__id,
        peg.r_pnpt__shift AS r_pnpt__shift
        FROM v_pegawai peg where r_pnpt__no_mutasi='$t_cuti__nip'";
$rs_pw	= $db->execute($sql_pw);
$tgl_masuk=$rs_pw->fields['r_pegawai__tgl_masuk'];
$tgl_masuk_karyawan=$rs_pw->fields['r_pegawai__tgl_masuk'];
$shift_karyawan=$rs_pw->fields['r_pnpt__shift'];
$karyawan_id=$rs_pw->fields['r_pegawai__id'];

$now=date("Y-m-d");
$now = explode('-', $now);
$now_year  = $now[0];
$now_month = $now[1];
$now_day   = $now[2];

$tgl_masuk_explode=date($tgl_masuk);
$tgl_masuk_explode = explode('-',$tgl_masuk_explode);
$exp_tahun_msk   = $tgl_masuk_explode[0];
$exp_bln_msk   = $tgl_masuk_explode[1];
$exp_tgl_msk = $tgl_masuk_explode[2];
 
$start_cuti=array(trim($now_year),trim($exp_bln_msk),trim($exp_tgl_msk));
$expired_cuti=array(trim($now_year+1),trim($exp_bln_msk),trim($exp_tgl_msk));

//$periode_aktif   = implode("-",$start_cuti);
//$periode_expired = implode("-",$expired_cuti);

 //var_dump($periode_aktif.'d'.$periode_expired) or die();

$cek_str=strtotime($periode_aktif);
$cek_exp=strtotime($periode_expired);
$cek_tgl_cuti=strtotime($_POST[tgl]);


//cek aktivasi cuti
$sql_cek_aktivasi="SELECT 
B.THN_AWAL,DATE_ADD(B.THN_AWAL,INTERVAL 1 YEAR) AS THN_AKHIR,
B.r_pegawai__nama,
B.r_pegawai__tgl_masuk,
B.r_pegawai__id,
B.mulai_cuti 
FROM (SELECT A.*,
DATE_ADD(A.r_pegawai__tgl_masuk,INTERVAL (A.mulai_cuti) YEAR) AS THN_AWAL
FROM (SELECT r_pegawai__tgl_masuk,r_pnpt__no_mutasi,r_pegawai__id,
YEAR(CURDATE()) AS tahun_now,
FLOOR(DATEDIFF(CURDATE(),r_pegawai__tgl_masuk)/365) as mulai_cuti, 
r_pegawai__nama 
FROM v_pegawai peg
left join t_cuti On t_cuti__atasan_nip=peg.r_pnpt__nip
where r_pnpt__aktif=1 and r_pegawai__id='$karyawan_id' limit 1)A)B";
                        
$rs_val = $db->Execute($sql_cek_aktivasi);
$periode_aktif= $rs_val->fields['THN_AWAL'];
$periode_expired= $rs_val->fields['THN_AKHIR'];
$mulai_cuti= $rs_val->fields['mulai_cuti'];
//cek aktivasi cuti





$sql_cek_cutibersama="SELECT COUNT(*) AS JML_CUTI FROM t_libur WHERE t_libur.r_libur__shift= '$shift_karyawan' 
                        AND t_libur.r_libur__jenis= '2' 
                        and t_libur.r_libur__tgl>='$periode_aktif' AND t_libur.r_libur__tgl<='$periode_expired'";
                        
$rs_val = $db->Execute($sql_cek_cutibersama);
$jml_cutibersama= $rs_val->fields['JML_CUTI'];





$sql_cek_cutibersama="SELECT COUNT(*) AS JML_CUTI FROM t_libur WHERE t_libur.r_libur__shift= '$shift_karyawan' 
                        AND t_libur.r_libur__jenis= '2' 
                        and t_libur.r_libur__tgl>='$periode_aktif' AND t_libur.r_libur__tgl<='$periode_expired'";
                        
$rs_val = $db->Execute($sql_cek_cutibersama);
$jml_cutibersama= $rs_val->fields['JML_CUTI'];

$sql_cek_cuti="SELECT IF(SUM(A.t_cuti__lama_hari)IS NULL ,'0',SUM(A.t_cuti__lama_hari)) AS MAX_CUTI
    FROM t_cuti A where t_cuti__nip='$t_cuti__nip' AND t_cuti__jenis_cuti='1' AND t_cuti__awal between '$periode_aktif' and '$periode_expired'";


$rs_val = $db->Execute($sql_cek_cuti);
$sudah_cuti= $rs_val->fields['MAX_CUTI'];
$cuti_yg_diambil=($jml_cutibersama+$t_cuti__lama_hari+$sudah_cuti);

$d1 = new DateTime($tgl_masuk_karyawan);
$d2 = new DateTime(date("Y-m-d"));
$diff = $d2->diff($d1);
$role_cuti=$diff->y;

   IF (($role_cuti<=0 AND $t_cuti__jenis_cuti==1) OR ($cek_tgl_cuti>$cek_exp)) 
                {
           
                     Header("Location:index_cek.php?ERR=5&nip_karyawan=".$nip_karyawan."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
                }
                elseif ( ($role_cuti>=1 AND $cuti_yg_diambil > 12 AND $t_cuti__jenis_cuti==1) OR ($cek_tgl_cuti>$cek_exp)) 
                {
             
			Header("Location:index_cek.php?ERR=5&nip_karyawan=".$nip_karyawan."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
                }
                elseif($t_cuti__jenis_cuti==2 AND $role_cuti>=1  )
                {
                   
                    $sql	 = "INSERT INTO $tbl_name ("
                                    . "t_cuti__no, "
                                    . "t_cuti__nip,"
                                    . "t_cuti__atasan_nama,"
                                    . "t_cuti__atasan_nip, "
                                    . "t_cuti__awal,"
                                    . "t_cuti__akhir,"
                                    . "t_cuti__lama_hari,"
                                    . "t_cuti__jenis_cuti,"
                                    . "t_cuti__alasan,"
                                    ."t_cuti__date_created,"
                                    ."t_cuti__date_updated,"
                                    ."t_cuti__user_created,"
                                    ."t_cuti__user_updated)";
                    $sql	.= " VALUES ("
                            . "'$_POST[cuti__no]',"
                            . "'$t_cuti__nip',"
                            . "'$_POST[atasan__nama]',"
                            . "'$_POST[atasan__nip]',"
                            . "'$_POST[tgl_awal]'," 
                            . "'$_POST[tgl_akhir]',"
                             . "'$_POST[lama_hari]',"
                            . "'$_POST[jenis_cuti]',"
                            . "'$_POST[alasan]',"
                            . "now(),"
                            . "now(),"
                            . "$id_peg,"
                            . "$id_peg)";

                   
                                $sqlresult = $db->Execute($sql);
                                Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
                }
                elseif($role_cuti<=0 AND $t_cuti__jenis_cuti==2  )
                { 
                    $sql	 = "INSERT INTO $tbl_name ("
                                   . "t_cuti__no, "
                                    . "t_cuti__nip,"
                                    . "t_cuti__atasan_nama,"
                                    . "t_cuti__atasan_nip, "
                                    . "t_cuti__awal,"
                                    . "t_cuti__akhir,"
                                    . "t_cuti__lama_hari,"
                                    . "t_cuti__jenis_cuti,"
                                    . "t_cuti__alasan,"
                                    ."t_cuti__date_created,"
                                    ."t_cuti__date_updated,"
                                    ."t_cuti__user_created,"
                                    ."t_cuti__user_updated)";
                        $sql	.= " VALUES ("
                                . "'$_POST[cuti__no]',"
                                . "'$t_cuti__nip',"
                                . "'$_POST[atasan__nama]',"
                                . "'$_POST[atasan__nip]',"
                                . "'$_POST[tgl_awal]'," 
                                . "'$_POST[tgl_akhir]',"
                                . "'$_POST[lama_hari]',"
                                . "'$_POST[jenis_cuti]',"
                                . "'$_POST[alasan]',"
                                . "now(),"
                                . "now(),"
                                . "$id_peg,"
                                . "$id_peg)";

                   
                                $sqlresult = $db->Execute($sql);
                                Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
                
                    
                    
                }
                    else
                {
                   
                    $sql	 = "INSERT INTO $tbl_name ("
                                   . "t_cuti__no, "
                                    . "t_cuti__nip,"
                                    . "t_cuti__atasan_nama,"
                                    . "t_cuti__atasan_nip, "
                                     . "t_cuti__awal,"
                                    . "t_cuti__akhir,"
                                    . "t_cuti__lama_hari,"
                                    . "t_cuti__jenis_cuti,"
                                    . "t_cuti__alasan,"
                                    ."t_cuti__date_created,"
                                    ."t_cuti__date_updated,"
                                    ."t_cuti__user_created,"
                                    ."t_cuti__user_updated)";
$sql	.= " VALUES ("
        . "'$_POST[cuti__no]',"
        . "'$t_cuti__nip',"
        . "'$_POST[atasan__nama]',"
        . "'$_POST[atasan__nip]',"
       . "'$_POST[tgl_awal]'," 
        . "'$_POST[tgl_akhir]',"
        . "'$_POST[lama_hari]',"
        . "'$_POST[jenis_cuti]',"
        . "'$_POST[alasan]',"
        . "now(),"
        . "now(),"
        . "$id_peg,"
        . "$id_peg)";
 //var_dump($sql) or die();
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
