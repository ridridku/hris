<?PHP
/*egine upload*/

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
		require_once('../../../includes/                                ');
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
$tbl_name	= "t_absensi";




//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM t_absensi ";
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
$today = date("Y-m-d h:i:s");

        $t_abs__id= addslashes($_POST[t_abs__id]);	
        $r_pegawai__nama= addslashes($_POST[r_pegawai__nama]);	
        $r_cabang__id= addslashes($_POST[r_cabang__id]);	

        $t_abs__fingerprint= addslashes($_POST[r_pnpt__finger_print]);
        $t_abs__tgl= addslashes($_POST[t_abs__tgl]);	
        $t_abs__id_shift= addslashes($_POST[r_pnpt__shift]);	
        $t_abs__jam_masuk= addslashes($_POST[t_abs__jam_masuk]);	
        $t_abs__jam_keluar= addslashes($_POST[t_abs__jam_keluar]);	
        $t_abs__early = addslashes($_POST[t_abs__early]);
        $t_abs__lately = addslashes($_POST[t_abs__jam_lately]);	
        $t_abs__approval= addslashes($_POST[t_abs__approval]);	
        $t_abs__lesstime= addslashes($_POST[t_abs__lesstime]);	
        $t_abs__overtime= addslashes($_POST[t_abs__overtime]);	
        $t_abs__worktime= addslashes($_POST[t_abs__worktime]);	
        $t_abs__status= addslashes($_POST[t_abs__status]);	
        $t_abs__catatan= addslashes($_POST[t_abs__catatan]);	
        $t_abs__date_created= addslashes($_POST[t_abs__date_created]);	
        $t_abs__date_updated= date("Y-m-d h:i:s");
        $t_abs__user_created= addslashes($_POST[t_abs__user_created]);	
        $t_abs__user_updated= $id_peg;	

        $sql_cek_edit="SELECT * FROM t_absensi A where A.t_abs__fingerprint='$t_abs__fingerprint' AND A.t_abs__tgl='$t_abs__tgl'";
        
        $rs_val = $db->Execute($sql_cek_edit);
        $fingerprint = $rs_val->fields['t_abs__fingerprint'];
        $tgl_masuk = $rs_val->fields['t_abs__tgl'];
        $absen_id = $rs_val->fields['t_abs__id'];
      


		if ($t_abs__fingerprint!=$fingerprint AND $t_abs__tgl !=$tgl_masuk) {
		 
				Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);

		} else { 

                    
			$sql_edit  ="  UPDATE t_absensi set ";
                        $sql_edit .=" t_abs__fingerprint = '$_POST[r_pnpt__finger_print]', ";
                        $sql_edit .=" t_abs__tgl = '$_POST[t_abs__tgl]', ";
                        $sql_edit .=" t_abs__id_shift = '$_POST[r_pnpt__shift]', ";
                        $sql_edit .=" t_abs__jam_masuk = '$_POST[t_abs__jam_masuk]', ";
                        $sql_edit .=" t_abs__jam_keluar = '$_POST[t_abs__jam_keluar]', ";
                        $sql_edit .=" t_abs__early = '$_POST[t_abs__early]', ";
                        $sql_edit .=" t_abs__lately = '$_POST[t_abs__jam_lately]', ";
                        $sql_edit .=" t_abs__approval = '$_POST[t_abs__approval]', ";
                        $sql_edit .=" t_abs__lesstime = '$_POST[t_abs__lesstime]', ";
                        $sql_edit .=" t_abs__overtime = '$_POST[t_abs__overtime]', ";
                        $sql_edit .=" t_abs__worktime = '$_POST[t_abs__worktime]', ";
                        $sql_edit .=" t_abs__status = '$_POST[t_abs__status]', ";
                        $sql_edit .=" t_abs__catatan = '$_POST[t_abs__catatan]', ";
                        $sql_edit .=" t_abs__date_updated =  '$t_abs__date_updated',";
                        $sql_edit .=" t_abs__user_updated = '$id_peg'";
                        $sql_edit .="  WHERE t_abs__id='$_POST[t_abs__id]' ";
                       // var_dump($sql_edit)or die();
			$sqlresult4 = $db->Execute($sql_edit);
                   
                        
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
        global $tbl_name;
        global $field_name;
        
        $today = date("Y-m-d");
        $kode_cabang = addslashes($_POST[kode_cabang]);
        $tahun = addslashes($_POST[tahun]);
        $bulan = addslashes($_POST[bulan]);
      
        $sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_bulan,r_periode__payroll_tahun,r_periode__payroll_status
                                  FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
                  
        $rs_val = $db->Execute($sql_cek_periode);
        $periode_bulan= $rs_val->fields['r_periode__payroll_bulan'];
        $periode_tahun= $rs_val->fields['r_periode__payroll_tahun'];  

        $sql_cek_approval="SELECT A.t_rkp__no_mutasi,A.t_rkp__approval,A.t_rkp__bln,A.t_rkp__thn
        FROM  t_rekap_absensi A LEFT JOIN v_pegawai P ON P.r_pnpt__no_mutasi=A.t_rkp__no_mutasi
        WHERE A.t_rkp__thn='$periode_tahun' AND A.t_rkp__bln='$periode_bulan' AND A.t_rkp__no_mutasi='$edit_t_rkp__no_mutasi' ";

       
        $rs_val = $db->Execute($sql_cek_approval);
        $cek__no_mutasi= $rs_val->fields['t_rkp__no_mutasi'];
        $cek__approval= $rs_val->fields['t_rkp__approval'];

          
       
        
    
  
    if ($tahun!=$periode_tahun AND $bulan !=$periode_bulan) {
        
        
			Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else { 
                    
                                   
                    $sql_cek_rekap="SELECT DISTINCT A.t_abs__fingerprint, A.t_abs__id_shift FROM t_absensi A
                    LEFT JOIN r_penempatan B ON A.t_abs__fingerprint=B.r_pnpt__finger_print
                    LEFT JOIN (SELECT rc.r_cabang__id,rc.r_cabang__nama,rs.r_subcab__cabang,rs.r_subcab__nama,rs.r_subcab__id
                                FROM r_cabang rc,r_subcabang rs WHERE rc.r_cabang__id=rs.r_subcab__cabang )as cab ON cab.r_subcab__id=B.r_pnpt__subcab
                    WHERE YEAR(A.t_abs__tgl)='$tahun'  AND MONTH(A.t_abs__tgl)='$bulan' AND cab.r_cabang__id='$kode_cabang'
                    GROUP BY A.t_abs__fingerprint";
                   
                    var_dump($sql_cek_rekap)or die();
                    $sqlres = $db->Execute($sql_cek_rekap);
                    $tmp = array();
                    $z=0;
                          
      
                    while ($data=$sqlres->FetchRow())
                            {
                                
                                $rekap__finger=$data[0];
                                $rekap__shift=$data[1];
                                array_push($tmp, $rekap__finger);
                                
			$sql="INSERT INTO t_rekap_absensi (
     t_rkp__no_mutasi,
     t_rkp__bln, 
     t_rkp__thn, 
     t_rkp__approval, 
     t_rkp__keterangan, 
     t_rkp__hadir, 
     t_rkp__sakit, 
     t_rkp__izin, 
     t_rkp__alpa, 
     t_rkp__dinas, 
     t_rkp__cuti,
    t_rkp__date_created,t_rkp__user_created)
SELECT
  (SELECT
    r_pnpt__no_mutasi AS no_mutasi
  FROM
    r_penempatan pnpt
  WHERE
    pnpt.r_pnpt__finger_print = '$rekap__finger')
  AS no_mutasi,
  '$bulan' AS bln,
  '$tahun' AS tahun,
  '1' AS approval,
  CASE WHEN jml_hari < min_masuk THEN 'KURANG' WHEN jml_hari = min_masuk THEN jml_hari END AS keterangan,
  (SELECT
    COUNT(*) AS jml_hari
  FROM
    t_absensi ab
  WHERE
    ab.t_abs__fingerprint = '$rekap__finger' AND ab.t_abs__status = 1 AND MONTH(ab.t_abs__tgl) = '$bulan' AND YEAR(ab.t_abs__tgl) = '$tahun' AND ab.t_abs__tgl NOT IN
    (SELECT
      r_libur__tgl
    FROM
      t_libur
    WHERE
      r_libur__shift = $rekap__shift
    ))
  AS hadir,
  (SELECT
    COUNT(*) AS jml_sakit
  FROM
    t_absensi ab
  WHERE
    ab.t_abs__fingerprint = $rekap__finger AND ab.t_abs__status = 2 AND MONTH(ab.t_abs__tgl) = '$bulan' AND YEAR(ab.t_abs__tgl) = '$tahun')
  AS sakit,
  (SELECT
    COUNT(*) AS jml_izin
  FROM
    t_absensi ab
  WHERE
    ab.t_abs__fingerprint = $rekap__finger AND ab.t_abs__status = 3 AND MONTH(ab.t_abs__tgl) = '$bulan' AND YEAR(ab.t_abs__tgl) = '$tahun')
  AS izin,
  (SELECT
    COUNT(*) AS jml_alpa
  FROM
    t_absensi ab
  WHERE
    ab.t_abs__fingerprint = '$rekap__finger' AND ab.t_abs__status = 4 AND MONTH(ab.t_abs__tgl) = '$bulan' AND YEAR(ab.t_abs__tgl) = '$tahun')
  AS alpa,
  (SELECT
    COUNT(*) AS jml_dinas
  FROM
    t_absensi ab
  WHERE
    ab.t_abs__fingerprint = '$rekap__finger' AND ab.t_abs__status = 5 AND MONTH(ab.t_abs__tgl) = '$bulan' AND YEAR(ab.t_abs__tgl) = '$tahun')
  AS dinas,
  (SELECT
    COUNT(*) AS jml_cuti
  FROM
    t_absensi ab
  WHERE
    ab.t_abs__fingerprint = '$rekap__finger' AND ab.t_abs__status = 6 AND MONTH(ab.t_abs__tgl) = '$bulan' AND YEAR(ab.t_abs__tgl) = '$tahun')
  AS cuti,
  NOW() AS date_created,
  '1' AS user_created
FROM
  (SELECT
    DAY(LAST_DAY(NOW())) -
    (SELECT
      COUNT(r_libur__shift) AS jml_libur
    FROM
      t_libur L, r_shift S
    WHERE
      L.r_libur__shift = S.r_shift__id AND
      MONTH(r_libur__tgl) = '$bulan' AND
      YEAR(r_libur__tgl) = '$tahun' AND
      L.r_libur__shift = 1)
    AS min_masuk) batas
  ,
  (SELECT
    COUNT(*) AS jml_hari
  FROM
    t_absensi ab
  WHERE
    ab.t_abs__fingerprint = '$rekap__finger' AND
    (ab.t_abs__status = 1 OR
    ab.t_abs__status = 2) AND
    MONTH(ab.t_abs__tgl) = '$bulan' AND
    YEAR(ab.t_abs__tgl) = '$tahun' AND
    ab.t_abs__tgl NOT IN
    (SELECT
      r_libur__tgl
    FROM
      t_libur
    WHERE
      r_libur__shift = $rekap__shift
    )) hadir ";
                      
                     // var_dump($sql)or die();
                         $sqlresult = $db->Execute($sql);		 
                        
                            }
                            
                        
                           
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
