<?PHP
/*engine upload*/

# Including Main Configuration
# including file for Main Configurations
require_once('../../../includes/config.conf.php');
require_once('../../../includes/func.inc.php');

//var_dump($bb) or die();
//require_once('../../../lib/excel_reader.php');
# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
		require_once('../../../includes/');
}else{

//yang harus dibuat session
$THEME = base64_encode("defaults");
$LANG = base64_encode("indonesia");
$_SESSION['THEME']	= $THEME;
$_SESSION['LANG']       = $LANG;

# including Header file for Content Expiring
require_once($DIR_INC.'/header.exp.inc');
# including Header file for Database Configuration
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_INC.'/excel_reader2.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.locker.php');

$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

//------------------------------------LOCAL CONFIG--------------------------------------//
#SETTING FOR TEMPLATE 
$TPL_PATH = base64_decode($_SESSION['UPLOAD']).'/uploads';
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kehadiran/rekap_kehadiran_hrd';


$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kehadiran');
$FILE_JS  = $JS_MODUL.'/rekap_kehadiran_hrd';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "t_rekap_absensi";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

}

function edit_(){
global $mod_id;
global $db;
$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];
$today = date("Y-m-d h:i:s");

}

function create_(){
    
   
        global $mod_id;	
        global $db;
        global $tbl_name;
        global $field_name;
                
        $kode_cabang = addslashes($_POST[kode_cabang]);
        $id_peg = $_SESSION['SESSION_ID_PEG'];
        $awal_aktif	= $_SESSION['SESSION_AWAL_AKTIF'];
        $akhir_aktif	= $_SESSION['SESSION_AKHIR_AKTIF'];
       
        $periode_awal = addslashes($_POST[periode_awal]);
        $periode_akhir = addslashes($_POST[periode_akhir]);
    
        
                            
                    
        
    $sql_cek_rekap="SELECT DISTINCT 
                    A.t_abs__fingerprint, 
                    A.t_abs__id_shift,
                    B.r_pnpt__no_mutasi AS mutasi
                    FROM t_absensi A
             LEFT JOIN r_penempatan B ON A.t_abs__fingerprint=B.r_pnpt__finger_print
             LEFT JOIN (SELECT rc.r_cabang__id,rc.r_cabang__nama,rs.r_subcab__cabang,rs.r_subcab__nama,rs.r_subcab__id
                         FROM r_cabang rc,r_subcabang rs WHERE rc.r_cabang__id=rs.r_subcab__cabang )as cab ON cab.r_subcab__id=B.r_pnpt__subcab
             WHERE   A.t_abs__tgl>='$periode_awal' AND A.t_abs__tgl<='$periode_akhir'  AND cab.r_cabang__id='$kode_cabang'
              GROUP BY A.t_abs__fingerprint ORDER BY B.r_pnpt__no_mutasi DESC ";
   
  
             $sqlres = $db->Execute($sql_cek_rekap);
             $tmp = array();
             $z=0;
             while ($data=$sqlres->FetchRow())
                     {

                         $rekap__finger=$data[0];
                         $rekap__shift=$data[1];
                         $mutasi=$data[2];
                         array_push($tmp, $rekap__finger);
                                
                                       
                          
                   $sql_cek_update_rekap="SELECT t_rekap_absensi.t_rkp__approval AS t_rkp__approval ,
                   t_rekap_absensi.t_rkp__no_mutasi AS t_rkp__no_mutasi,
                   t_rekap_absensi.t_rkp__awal AS t_rkp__awal,
                   t_rekap_absensi.t_rkp__akhir AS t_rkp__akhir,
                   t_absensi.t_abs__fingerprint AS t_abs__fingerprint,
                   t_absensi.t_abs__tgl AS t_abs__tgl, 
                   v_pegawai.r_cabang__id AS r_cabang__id
                   FROM
                   t_rekap_absensi
                   INNER JOIN v_pegawai ON t_rekap_absensi.t_rkp__no_mutasi = v_pegawai.r_pnpt__no_mutasi
                   INNER JOIN t_absensi ON t_absensi.t_abs__fingerprint = v_pegawai.r_pnpt__finger_print
                   WHERE t_rkp__no_mutasi='$mutasi' AND
                   t_rekap_absensi.t_rkp__awal <= '$periode_awal' AND
                   t_rekap_absensi.t_rkp__akhir >= '$periode_akhir' AND
                   v_pegawai.r_cabang__id = '$kode_cabang'

                   GROUP BY t_absensi.t_abs__fingerprint";          
                 
                   
                    $rs_val = $db->Execute($sql_cek_update_rekap);
                    
                     $cek_approval = $rs_val->fields['t_rkp__approval'];
                     $cek_no_mutasi= $rs_val->fields['t_rkp__no_mutasi'];

                     
                    
      if ($cek_approval=='1' OR $cek_no_mutasi !='' )
      {
         

       $sql_del="DELETE t_rekap_absensi from t_rekap_absensi 
                 INNER JOIN r_penempatan ON r_penempatan.r_pnpt__no_mutasi=t_rekap_absensi.t_rkp__no_mutasi
                 INNER JOIN r_subcabang ON r_subcabang.r_subcab__id=r_penempatan.r_pnpt__subcab
                 INNER JOIN r_cabang ON r_cabang.r_cabang__id=r_subcabang.r_subcab__cabang
                 WHERE t_rekap_absensi.t_rkp__no_mutasi='$cek_no_mutasi' AND r_cabang.r_cabang__id='$kode_cabang' AND  t_rekap_absensi.t_rkp__awal>='$periode_awal' AND t_rekap_absensi.t_rkp__akhir<='$periode_akhir'";       
       
                 $sqlresult = $db->Execute($sql_del);      
        } 
        

                      
$sql="INSERT INTO t_rekap_absensi (
     t_rkp__no_mutasi,
     t_rkp__awal, 
     t_rkp__akhir, 
     t_rkp__approval, 
     t_rkp__keterangan, 
     t_rkp__hadir, 
     t_rkp__sakit, 
     t_rkp__izin, 
     t_rkp__alpa, 
     t_rkp__dinas, 
     t_rkp__cuti,
    t_rkp__date_created,
    t_rkp__user_created,
    t_rkp__date_updated,
    t_rkp__user_updated)
SELECT
  (SELECT
    r_pnpt__no_mutasi AS no_mutasi
  FROM
    r_penempatan pnpt
  WHERE
    pnpt.r_pnpt__finger_print = '$rekap__finger'  GROUP BY pnpt.r_pnpt__no_mutasi )
  AS no_mutasi,
  '$periode_awal' AS bln,
  '$periode_akhir' AS tahun,
  '1' AS approval,
  CASE WHEN jml_hari < min_masuk THEN 'KURANG' WHEN jml_hari = min_masuk THEN jml_hari END AS keterangan,
   IF ((SELECT r_penempatan.r_pnpt__jabatan FROM r_penempatan WHERE	r_penempatan.r_pnpt__finger_print = '$rekap__finger'
		AND r_penempatan.r_pnpt__aktif = '1' AND r_penempatan.r_pnpt__jabatan = '46' GROUP BY r_penempatan.r_pnpt__id_pegawai
	) = '46',(SELECT COUNT(*) AS jml_hari FROM t_absensi ab	WHERE ab.t_abs__fingerprint = '$rekap__finger' AND (ab.t_abs__status = 1
			OR ab.t_abs__status = 2)AND ab.t_abs__tgl >= '$periode_awal'AND ab.t_abs__tgl <= '$periode_akhir'),
	(SELECT COUNT(*) AS jml_hari FROM t_absensi ab WHERE ab.t_abs__worktime >= '03:00:00' AND ab.t_abs__fingerprint = '$rekap__finger'
		AND ab.t_abs__status = 1 AND ab.t_abs__tgl >= '$periode_awal' AND ab.t_abs__tgl <= '$periode_akhir' AND ab.t_abs__tgl NOT IN (
		SELECT r_libur__tgl FROM t_libur WHERE r_libur__shift = $rekap__shift))) AS hadir,
  (SELECT
    COUNT(*) AS jml_sakit
  FROM
    t_absensi ab
  WHERE
    ab.t_abs__fingerprint = $rekap__finger AND ab.t_abs__status = 2 AND ab.t_abs__tgl >= '$periode_awal' AND ab.t_abs__tgl <= '$periode_akhir')
  AS sakit,
  (SELECT
    COUNT(*) AS jml_izin
  FROM
    t_absensi ab
  WHERE
    ab.t_abs__fingerprint = $rekap__finger AND ab.t_abs__status = 3 AND ab.t_abs__tgl >= '$periode_awal' AND ab.t_abs__tgl <= '$periode_akhir')
  AS izin,
  (SELECT
    COUNT(*) AS jml_alpa
  FROM
    t_absensi ab
  WHERE
    ab.t_abs__fingerprint = '$rekap__finger' AND ab.t_abs__status = 4 AND ab.t_abs__tgl >= '$periode_awal' AND ab.t_abs__tgl <= '$periode_akhir')
  AS alpa,
  (SELECT
    COUNT(*) AS jml_dinas
  FROM
    t_absensi ab
  WHERE
    ab.t_abs__fingerprint = '$rekap__finger' AND ab.t_abs__status = 5 AND ab.t_abs__tgl >= '$periode_awal' AND ab.t_abs__tgl <= '$periode_akhir')
  AS dinas,
  (SELECT
    COUNT(*) AS jml_cuti
  FROM
    t_absensi ab
  WHERE
    ab.t_abs__fingerprint = '$rekap__finger' AND ab.t_abs__status = 6 AND ab.t_abs__tgl >= '$periode_awal' AND ab.t_abs__tgl <= '$periode_akhir')
  AS cuti,
  NOW() AS date_created,
 '$id_peg' AS user_created,
  NOW() AS date_updated,
 '$id_peg' AS user_updated
  
FROM
  (SELECT* FROM (SELECT MIN_DAY.jml_hari-MIN_DAY.jml_libur AS min_masuk
 FROM (SELECT
(datediff('$periode_akhir','$periode_awal')) AS jml_hari ,
(SELECT COUNT(r_libur__shift) 
	FROM t_libur L,r_shift S
	WHERE L.r_libur__shift = S.r_shift__id
	AND r_libur__tgl >= '$periode_awal'
	AND r_libur__tgl <= '$periode_akhir'
	AND L.r_libur__shift = '$rekap__shift'
)AS jml_libur) MIN_DAY) AS min_masuk) batas
  ,
  (SELECT
    COUNT(*) AS jml_hari
  FROM
    t_absensi ab
  WHERE
    ab.t_abs__fingerprint = '$rekap__finger' AND
    (ab.t_abs__status = 1 OR
    ab.t_abs__status = 2) AND
    ab.t_abs__tgl >= '$periode_awal' AND YEAR(ab.t_abs__tgl) <= '$periode_akhir' AND
    ab.t_abs__tgl NOT IN
    (SELECT
      r_libur__tgl
    FROM
      t_libur
    WHERE
      r_libur__shift = $rekap__shift AND r_libur__tgl>='$periode_awal' AND r_libur__tgl<='$periode_akhir'
    )) hadir ";
                     var_dump($sql)or die();
$sqlresult = $db->Execute($sql);		 
                        
 }
if ($cek_approval>=2)
    {
               Header("Location:index_cek.php?ERR=5&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);           
    }  else {
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
