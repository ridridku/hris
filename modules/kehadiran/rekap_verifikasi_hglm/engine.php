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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kehadiran/rekap_verifikasi_hglm';


$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kehadiran');
$FILE_JS  = $JS_MODUL.'/rekap_verifikasi_hglm';
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
$user_id     = base64_decode($_SESSION['UID']);
$id_peg      = $_SESSION['SESSION_ID_PEG'];
$today       = date("Y-m-d h:i:s");




$edit_r_cabang__id = addslashes($_POST[r_cabang__id]);
$edit_r_subdept__ket = addslashes($_POST[r_subdept__ket]);
$edit_r_cabang__nama = addslashes($_POST[r_cabang__nama]);
$edit_r_pegawai__nama = addslashes($_POST[r_pegawai__nama]);
$edit_t_rkp__no_mutasi = addslashes($_POST[t_rkp__no_mutasi]);
$edit_t_rkp__bln = addslashes($_POST[t_rkp__bln]);
$edit_t_rkp__thn = addslashes($_POST[t_rkp__thn]);
$edit_t_rkp__approval =$_POST[approval]; 
$edit_t_rkp__keterangan = addslashes($_POST[t_rkp__keterangan]);
$edit_t_rkp__hadir = addslashes($_POST[t_rkp__hadir]);
$edit_t_rkp__sakit = addslashes($_POST[t_rkp__sakit]);
$edit_t_rkp__izin = addslashes($_POST[t_rkp__izin]);
$edit_t_rkp__alpa = addslashes($_POST[t_rkp__alpa]);
$edit_t_rkp__dinas = addslashes($_POST[t_rkp__dinas]);
$edit_t_rkp__cuti = addslashes($_POST[t_rkp__cuti]);


$t_rkp__date_updated= date("Y-m-d h:i:s");
$t_rkp__user_updated= $id_peg;	

//        $sql_cek_edit="SELECT * FROM t_absensi A where A.t_abs__fingerprint='$t_abs__fingerprint' AND A.t_abs__tgl='$t_abs__tgl'";
//        $rs_val = $db->Execute($sql_cek_edit);
//        $fingerprint = $rs_val->fields['t_abs__fingerprint'];
//        $tgl_masuk = $rs_val->fields['t_abs__tgl'];
//        $absen_id = $rs_val->fields['t_abs__id'];

$sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_bulan,r_periode__payroll_tahun,r_periode__payroll_status
                                  FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
                  
$rs_val = $db->Execute($sql_cek_periode);
$periode_bulan= $rs_val->fields['r_periode__payroll_bulan'];
$periode_tahun= $rs_val->fields['r_periode__payroll_tahun'];
      


		if ($edit_t_rkp__bln!=$periode_bulan AND $edit_t_rkp__thn !=$periode_tahun) {
		 
				Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);

		} else {
                    
			$sql_edit  =" UPDATE t_rekap_absensi set ";
                        $sql_edit .=" t_rkp__no_mutasi = '$edit_t_rkp__no_mutasi', ";
                        $sql_edit .=" t_rkp__bln = '$edit_t_rkp__bln', ";
                        $sql_edit .=" t_rkp__thn = '$edit_t_rkp__thn', ";
                        $sql_edit .=" t_rkp__approval = '$_POST[approval]', ";
                        $sql_edit .=" t_rkp__keterangan = '$edit_t_rkp__keterangan', ";
                        $sql_edit .=" t_rkp__hadir = '$edit_t_rkp__hadir', ";
                        $sql_edit .=" t_rkp__sakit = '$edit_t_rkp__sakit', ";
                        $sql_edit .=" t_rkp__izin = '$edit_t_rkp__izin', ";
                        $sql_edit .=" t_rkp__alpa = '$edit_t_rkp__alpa', ";
                        $sql_edit .=" t_rkp__dinas = '$edit_t_rkp__dinas', ";
                        $sql_edit .=" t_rkp__cuti = '$edit_t_rkp__cuti', ";
                        $sql_edit .=" t_rkp__date_updated =  '$t_rkp__date_updated',";
                        $sql_edit .=" t_rkp__user_updated = '$id_peg'";
                        $sql_edit .="  WHERE t_rkp__no_mutasi='$_POST[t_rkp__no_mutasi]' AND t_rkp__bln='$edit_t_rkp__bln' AND t_rkp__thn='$edit_t_rkp__thn'";
                       
                      // var_dump($sql_edit)or die();
			$sqlresult4 = $db->Execute($sql_edit);
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}
}

function create_(){
    
        global $mod_id;	
        global $db;
        global $tbl_name;
        global $field_name;
        $today = date("Y-m-d");
        $r_pnpt__no_mutasi = addslashes($_POST[r_pnpt__finger_print]);

        $tahun = addslashes($_POST[tahun]);
        $bulan = addslashes($_POST[bulan]);
        $shift = $_POST[r_pnpt__shift];
        
        $arr = array($tahun,$bulan,'1');                                 
        $tgl__input = implode("-",$arr);
        
        $t_rkp__hadir = addslashes($_POST[t_rkp__hadir]);
        $t_rkp__sakit = addslashes($_POST[t_rkp__sakit]);
        $t_rkp__izin = addslashes($_POST[t_rkp__izin]);
        $t_rkp__alpa = addslashes($_POST[t_rkp__alpa]);
        $t_rkp__dinas = addslashes($_POST[t_rkp__dinas]);
        $t_rkp__cuti = addslashes($_POST[t_rkp__cuti]);
        
      
        $sql_cek_periode=" SELECT B.t_rkp__no_mutasi,  A.r_periode__payroll_bulan,A.r_periode__payroll_tahun,A.r_periode__payroll_status
                             FROM r_periode_payroll A ,t_rekap_absensi B WHERE r_periode__payroll_status = 1 AND B.t_rkp__thn=A.r_periode__payroll_tahun AND A.r_periode__payroll_bulan=B.t_rkp__bln";
                
              
        $rs_val = $db->Execute($sql_cek_periode);
        $periode_bulan = $rs_val->fields['r_periode__payroll_bulan'];
        $periode_tahun = $rs_val->fields['r_periode__payroll_tahun'];  
        $periode_mutasi = $rs_val->fields['t_rkp__no_mutasi'];
     
        
        
        
        $sql_cek_libur="SELECT DAY(LAST_DAY('$tahun-$bulan-1')) - (SELECT COUNT(r_libur__shift) AS jml_libur FROM t_libur L, r_shift S 
                        WHERE
                        L.r_libur__shift = S.r_shift__id AND MONTH(r_libur__tgl) = '$bulan' AND YEAR(r_libur__tgl) = '$tahun' AND L.r_libur__shift =$shift) AS min_masuk";
       
        $rs_val_libur= $db->Execute($sql_cek_libur);
        $cek_libur = $rs_val_libur->fields['min_masuk'];
        
     
  
    if ($tahun!=$periode_tahun AND $bulan !=$periode_bulan AND $periode_mutasi!=$r_pnpt__no_mutasi OR $t_rkp__hadir>$cek_libur  ) {
        
        
			Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else {
                        
                           
                     $sql ="INSERT INTO t_rekap_absensi (t_rkp__no_mutasi, t_rkp__bln, t_rkp__thn, t_rkp__approval, t_rkp__keterangan, t_rkp__hadir, t_rkp__sakit, t_rkp__izin, t_rkp__alpa, t_rkp__dinas, t_rkp__cuti, t_rkp__date_created, t_rkp__user_created)";
                     $sql	.= " VALUES ('".strip_tags($r_pnpt__no_mutasi)."',"
                                        . "'".strip_tags($bulan)."',"
                                        . "'".strip_tags($tahun)."',"
                                        . "'".strip_tags('1')."',"
                                        . "'keterangan',"
                                        . "'".strip_tags($t_rkp__hadir)."',"
                                        . "'".strip_tags($t_rkp__sakit)."',"
                                        . "'".strip_tags($t_rkp__izin)."',"
                                        . "'".strip_tags($t_rkp__alpa)."',"
                                        . "'".strip_tags($t_rkp__dinas)."',"
                                        . "'".strip_tags($t_rkp__cuti)."',"
                                        . "'".strip_tags($tgl_now)."',"
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
