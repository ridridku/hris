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
$jenis_user  = $_SESSION['SESSION_JNS_USER'];



//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;
$periode_awal	= $_SESSION['SESSION_AWAL_AKTIF'];
$periode_akhir	= $_SESSION['SESSION_AKHIR_AKTIF'];  
$t_rkp__no_mutasi=$_GET[id];

$sql_cek_edit ="SELECT "
        . "A.t_rkp__approval as approval,"
        . "A.t_rkp__no_mutasi as mutasi,"
        . "A.t_rkp__awal as t_rkp__awal,"
        . "A.t_rkp__akhir as t_rkp__akhir"
        . " FROM t_rekap_absensi A "
        . "  where  A.t_rkp__no_mutasi='$t_rkp__no_mutasi' AND A.t_rkp__awal>='$periode_awal' AND A.t_rkp__akhir<='$periode_akhir'";

        $rs_val = $db->Execute($sql_cek_edit);
        $approval = $rs_val->fields['approval'];
        
 if ($approval>=1) 
    {
       Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
    }  else {
            $sql  ="DELETE ";
            $sql .="FROM t_rekap_absensi ";
            $sql .="WHERE  t_rkp__no_mutasi= '$_GET[id]'  AND t_rkp__awal>='$periode_awal' AND t_rkp__akhir<='$periode_akhir' ";
            $sqlresult = $db->Execute($sql);
            Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
                }


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
  
 $app_count= $_POST['mutasi'];  
  //  var_dump(count($app_count))or die();
if (!empty($app_count))
    {
    $bad_symbols = array(",", ".");
    $approval_array=$_POST['mutasi'];
     $mutasi_array=$_POST['mutasi'];
    $array__hadir = $_POST['hadir'];
    $array__sakit = str_replace($bad_symbols,"",$_POST['sakit']);
    $array__izin = str_replace($bad_symbols,"",$_POST['izin']);
    $array__alpa = str_replace($bad_symbols,"",$_POST['alpa']);
    $array__dinas = str_replace($bad_symbols,"",$_POST['dinas']);
    $array__cuti = str_replace($bad_symbols,"",$_POST['cuti']);
    $array__keterangan = str_replace($bad_symbols,"",$_POST['keterangan']);
    $array__awal = str_replace($bad_symbols,"",$_POST['awal']);
    $array__akhir = str_replace($bad_symbols,"",$_POST['akhir']);
    $array__status = str_replace($bad_symbols,"",$_POST['status']);

     
   for ($i = 0; $i < count($approval_array); $i++) 
    {
        
        $t_rkp__mutasi = mysql_real_escape_string($mutasi_array[$i]);
        $t_rkp__awal= mysql_real_escape_string($array__awal[$i]);
        $t_rkp__akhir= mysql_real_escape_string($array__akhir[$i]);
        $t_rkp__hadir= mysql_real_escape_string($array__hadir[$i]);
        $t_rkp__sakit= mysql_real_escape_string($array__sakit[$i]);
        $t_rkp__izin= mysql_real_escape_string($array__izin[$i]);
        $t_rkp__alpa= mysql_real_escape_string($array__alpa[$i]);
        $t_rkp__dinas= mysql_real_escape_string($array__dinas[$i]);
        $t_rkp__cuti= mysql_real_escape_string($array__cuti[$i]);    
        $t_rkp__keterangan= mysql_real_escape_string($array__keterangan[$i]);
        $t_rkp__status= mysql_real_escape_string($array__status[$i]);
        
      $jml_hadir=$t_rkp__hadir+$t_rkp__sakit+$t_rkp__izin+$t_rkp__alpa+$t_rkp__dinas+$t_rkp__cuti;
      
       IF ($jml_hadir>0)
      {$status='3';}else{$status='0';}
      
      
      $sql_status="SELECT 
                    A.t_rkp__awal,
                    A.t_rkp__akhir,
                    A.t_rkp__approval,
                    A.t_rkp__no_mutasi,
                    (A.t_rkp__hadir+A.t_rkp__cuti+A.t_rkp__dinas+A.t_rkp__izin+A.t_rkp__sakit+A.t_rkp__alpa) as jml_hadir
                    FROM (SELECT
                    t_rekap_absensi.t_rkp__no_mutasi AS t_rkp__no_mutasi,
                    t_rekap_absensi.t_rkp__awal AS t_rkp__awal,
                    t_rekap_absensi.t_rkp__akhir AS t_rkp__akhir,
                    t_rekap_absensi.t_rkp__approval AS t_rkp__approval,
                    t_rekap_absensi.t_rkp__hadir,
                    t_rekap_absensi.t_rkp__sakit,
                    t_rekap_absensi.t_rkp__izin,
                    t_rekap_absensi.t_rkp__alpa,
                    t_rekap_absensi.t_rkp__dinas,
                    t_rekap_absensi.t_rkp__cuti,
                    t_rekap_absensi.t_rkp__keterangan,
                    t_rekap_absensi.t_rkp__date_created,
                    t_rekap_absensi.t_rkp__date_updated,
                    t_rekap_absensi.t_rkp__user_created,
                    t_rekap_absensi.t_rkp__user_updated
                    FROM 	t_rekap_absensi 
                    WHERE t_rekap_absensi.t_rkp__no_mutasi='$t_rkp__mutasi'
                    AND t_rekap_absensi.t_rkp__awal>='$t_rkp__awal' AND t_rekap_absensi.t_rkp__akhir<='$t_rkp__akhir') A";
    
                        $rs_val = $db->Execute($sql_status);
                        $status_id= $rs_val->fields['t_rkp__no_mutasi'];
                       $status_app= $rs_val->fields['t_rkp__approval'];
                         $jml_hadir= $rs_val->fields['jml_hadir'];

      // var_dump($jml_hadir>0)or die();
  
if($status_id!='' AND $status_app<=3 AND $jml_hadir>0)
    {
   // var_dump('1')or die();
        $sql_edit  =" UPDATE t_rekap_absensi set ";
                    $sql_edit .=" t_rkp__no_mutasi = '$t_rkp__mutasi', ";
                    $sql_edit .=" t_rkp__awal = '$t_rkp__awal', ";
                    $sql_edit .=" t_rkp__akhir = '$t_rkp__akhir', ";
                    $sql_edit .=" t_rkp__approval = '$status', ";
                    $sql_edit .=" t_rkp__keterangan = '$t_rkp__keterangan', ";
                    $sql_edit .=" t_rkp__hadir = '$t_rkp__hadir', ";
                    $sql_edit .=" t_rkp__sakit = '$t_rkp__sakit', ";
                    $sql_edit .=" t_rkp__izin = '$t_rkp__izin', ";
                    $sql_edit .=" t_rkp__alpa = '$t_rkp__alpa', ";
                    $sql_edit .=" t_rkp__dinas = '$t_rkp__dinas', ";
                    $sql_edit .=" t_rkp__cuti = '$t_rkp__cuti', ";
                    $sql_edit .=" t_rkp__date_updated = now(),";
                    $sql_edit .=" t_rkp__user_updated = '$id_peg'";
                    $sql_edit .="  WHERE t_rkp__no_mutasi='$t_rkp__mutasi' AND t_rkp__awal>='$t_rkp__awal' AND t_rkp__akhir<='$t_rkp__akhir'";
      
                    $sqlresult4 = $db->Execute($sql_edit);
     
  
    }elseif($status_id=='' AND $status_app==''AND $jml_hadir>0)
        {  
     //  var_dump('2')or die();
        $sql2="INSERT INTO t_rekap_absensi"
                            . " (t_rkp__no_mutasi,"
                            . " t_rkp__awal, "
                            . "t_rkp__akhir, "
                            . "t_rkp__approval, "
                            . "t_rkp__keterangan, "
                            . "t_rkp__hadir, "
                            . "t_rkp__sakit, "
                            . "t_rkp__izin, "
                            . "t_rkp__alpa, "
                            . "t_rkp__dinas, "
                            . "t_rkp__cuti, "
                            . "t_rkp__date_created, "
                            . "t_rkp__date_updated, "
                            . "t_rkp__user_created, "
                            . "t_rkp__user_updated) ";

                        $sql2 .= " VALUES ('".strip_tags($t_rkp__mutasi)."',"
                            . "'".strip_tags($t_rkp__awal)."',"
                            . "'".strip_tags($t_rkp__akhir)."',"
                            . "'".strip_tags($status)."',"
                            . "'$t_rkp__keterangan',"
                            . "'".strip_tags($t_rkp__hadir)."',"
                            . "'".strip_tags($t_rkp__sakit)."',"
                            . "'".strip_tags($t_rkp__izin)."',"
                            . "'".strip_tags($t_rkp__alpa)."',"
                            . "'".strip_tags($t_rkp__dinas)."',"
                            . "'".strip_tags($t_rkp__cuti)."',"
                            . "now(),"
                            . "now(),"
                            . "'".strip_tags($id_peg)."',"
                            . "'".strip_tags($id_peg)."')";
            //  var_dump($sql2)or die();
                            $sqlresult = $db->Execute($sql2);
               
        }
        else
        { //var_dump('3')or die();
             $sql_edit  =" UPDATE t_rekap_absensi set ";
                    $sql_edit .=" t_rkp__no_mutasi = '$t_rkp__mutasi', ";
                    $sql_edit .=" t_rkp__awal = '$t_rkp__awal', ";
                    $sql_edit .=" t_rkp__akhir = '$t_rkp__akhir', ";
                    $sql_edit .=" t_rkp__approval = '$status', ";
                    $sql_edit .=" t_rkp__keterangan = '$t_rkp__keterangan', ";
                    $sql_edit .=" t_rkp__hadir = '$t_rkp__hadir', ";
                    $sql_edit .=" t_rkp__sakit = '$t_rkp__sakit', ";
                    $sql_edit .=" t_rkp__izin = '$t_rkp__izin', ";
                    $sql_edit .=" t_rkp__alpa = '$t_rkp__alpa', ";
                    $sql_edit .=" t_rkp__dinas = '$t_rkp__dinas', ";
                    $sql_edit .=" t_rkp__cuti = '$t_rkp__cuti', ";
                    $sql_edit .=" t_rkp__date_updated = now(),";
                    $sql_edit .=" t_rkp__user_updated = '$id_peg'";
                    $sql_edit .="  WHERE t_rkp__no_mutasi='$t_rkp__mutasi' AND t_rkp__awal>='$t_rkp__awal' AND t_rkp__akhir<='$t_rkp__akhir'";
      
                    $sqlresult4 = $db->Execute($sql_edit);
        }
    
    

  } 
    
   

}
  
      Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
     

     
}

function create_(){
    
      var_dump('tambah')or die();
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
