<?PHP
/*egine upload*/

# Including Main Configuration
# including file for Main Configurations
require_once('../../../includes/config.conf.php');
require_once('../../../includes/func.inc.php');

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kehadiran/verifikasi_kehadiran';


$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kehadiran');
$FILE_JS  = $JS_MODUL.'/verifikasi_kehadiran';
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
$sql .="WHERE  t_abs__id= '$_GET[id]' ";

$sqlresult = $db->Execute($sql);

//$user_id = base64_decode($_SESSION['UID']);
// $ip_now = $_SERVER['REMOTE_ADDR'];
// $sql2="INSERT INTO tbl_log (url, waktu, module, user_id ) VALUES ('$ip_now',now(),'Hapus data >> master WNI Non TKI','$user_id') ";
// $db->Execute($sql2);

}

function edit_(){
global $mod_id;
global $db;

$periode_awal= $_SESSION['SESSION_AWAL_AKTIF'];
$periode_akhir= $_SESSION['SESSION_AKHIR_AKTIF'];




$idfinger_cari= $_POST['idfinger_cari'];	
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
$t_abs__lately = addslashes($_POST[t_abs__lately]);	
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
 $atasan= addslashes($_POST[atasan]);
 $jenis_cuti= addslashes($_POST[jenis_cuti]);

    $sql_cek_edit="SELECT * FROM t_absensi A where A.t_abs__fingerprint='$t_abs__fingerprint' AND A.t_abs__tgl='$t_abs__tgl'";
    $rs_val = $db->Execute($sql_cek_edit);
    $old__fingerprint = $rs_val->fields['t_abs__fingerprint'];
    $old__tgl_masuk = $rs_val->fields['t_abs__tgl'];
    $absen_id = $rs_val->fields['t_abs__id'];
    $cek_jam_masuk = $rs_val->fields['t_abs__jam_masuk'];
    $cek_jam_masuk = $rs_val->fields['t_abs__jam_keluar'];
        

         //START PERHITUNGAN
        $CekFingerPrint="SELECT
        A.r_shift__jam_masuk AS r_shift__jam_masuk,
        A.r_shift__jam_pulang AS r_shift__jam_pulang,
        A.r_shift__jml_jam AS r_shift__jml_jam,
        A.r_shift__id AS r_shift__id,A.r_shift__terlambat
        FROM
        r_shift A
        INNER JOIN r_penempatan B ON B.r_pnpt__shift=A.r_shift__id
        WHERE B.r_pnpt__finger_print='$t_abs__fingerprint'";
        $rs_val = $db->Execute($CekFingerPrint);
        $rule_jam_masuk= $rs_val->fields['r_shift__jam_masuk'];
        $rule_jam_keluar= $rs_val->fields['r_shift__jam_pulang'];   
        $rule_jam_total= $rs_val->fields['r_shift__jml_jam'];   
        $rule_jam_shift= $rs_val->fields['r_shift__id'];  
         $rule_terlambat= $rs_val->fields['r_shift__terlambat'];  
       
       
        
        IF($rule_jam_total!='')
           {
                 $t1=$rule_jam_total;
                 $a1 = explode(":",$t1);
                 $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                 $diff = abs($time1);
                 $hours = floor($diff/(60*60));
                 $mins = floor(($diff-($hours*60*60))/(60));
                 $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                 $result = $hours.":".$mins.":".$secs;
                 $rule_jam_total2 = $result;
           }
                                            
                $datetime1=$t_abs__tgl.' '.$t_abs__jam_masuk;    
                $date1 = new DateTime($datetime1);
                $result_tgl1 = $date1->format('Y-m-d H:i:s');

                $datetime2=$t_abs__tgl.' '.$t_abs__jam_keluar;    
                $date2 = new DateTime($datetime2);
                $result_tgl2 = $date2->format('Y-m-d H:i:s');

                $date = new DateTime($t_abs__tgl);  
                $dateTo = new \DateTime($t_abs__tgl.' +1 day');
                $date_tommorow=$dateTo->format('Y-m-d'); 
                
                $date_masuk1 = date('Y-m-d', strtotime($result_tgl1));
                $time_masuk1 = date('H:i:s', strtotime($result_tgl1));
             
                
                $date_masuk2 = date('Y-m-d', strtotime($result_tgl2));
                $time_masuk2 = date('H:i:s', strtotime($datetime2));

           
                IF($time_masuk1>'00:00:00')
                {
                  $t_abs__jam_masuk2=$time_masuk1;
                }
                else
                {
                     $t_abs__jam_masuk2='00:00:00';   
                }
                            
            

                IF($time_masuk2>'00:00:00')
               {
                   $t_abs__jam_keluar2=$time_masuk2;
               }else
               {
                   $t_abs__jam_keluar2='00:00:00';   
                }

                    
                 
                            IF($time_masuk2!='00:00:00' && $t_abs__jam_keluar!='00:00:00' )
                            {
                                 
                        
                                if($rule_jam_shift<6)
                                {
                                  $t1=$t_abs__jam_masuk2;
                                  $t2=$t_abs__jam_keluar2;
                                  $a1 = explode(":",$t1);
                                  $a2 = explode(":",$t2);
                                  $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                                  $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                                  $diff = abs($time1-$time2);
                                  $hours = floor($diff/(60*60))-1;
                                  $mins = floor(($diff-($hours*60*60))/(60)-60);
                                  $secs = floor(($diff-(($hours*60*60)+($mins*60)))-3600);
                                  $result_reguler = $hours.":".$mins.":".$secs;
                                  $total_jam_kerja2 = $result_reguler;

                                }else
                                {
                                $datetime1=$t_abs__tgl.' '.$t_abs__jam_masuk;     
                                $date1 = new DateTime($datetime1);
                                $result_tgl1 = $date1->format('Y-m-d H:i:s');
                             
                                $date = new DateTime($t_abs__tgl);  
                                $dateTo = new \DateTime($t_abs__tgl.' +1 day');
                                $add_day=$dateTo->format('Y-m-d'); // 1980-12-08
                                
                                $datetime2=$add_day.' '.$t_abs__jam_keluar;    
                                $date2 = new DateTime($datetime2);
                                $result_tgl2 = $date2->format('Y-m-d H:i:s');
                                
                                $total_jam_kerja2 = datediff($result_tgl1, $result_tgl2);                                    
                                // $total_jam_kerja2 = $result_split_res; 
                                }
                               
                            }
                            else
                            {
                                  $total_jam_kerja2 = '00:00:00';    
                            }
                            
                             IF(($time_masuk1=='00:00:00')OR($time_masuk2=='00:00:00'))
                           {$status='0';}else{$status='1';}

//          $durasi_kerja= strtotime($total_jam_kerja2);
//          $durasi_total=idate('h',$durasi_kerja);
                           
                           
                   //LATELY
                      
                           
                          IF($t_abs__jam_masuk>$rule_jam_masuk) 
                           {
                                  $t1=$rule_jam_masuk;
                                  $t2=$t_abs__jam_masuk;
                                  $a1 = explode(":",$t1);
                                  $a2 = explode(":",$t2);
                                  $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                                  $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                                  $diff = abs($time1-$time2);
                                  $hours = floor($diff/(60*60));
                                  $mins = floor(($diff-($hours*60*60))/(60));
                                  $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                                  $result = $hours.":".$mins.":".$secs;
                                  $keterlambatan = $result;
                            }
                            else {
                                     $result = "00:00:00";
                                     $keterlambatan = $result;       
                                } 
                         
                    
                        //EARLY
                          IF($t_abs__jam_masuk<$rule_jam_masuk) 
                           {
                             
                                  $t3=$rule_jam_masuk;
                                  $t4=$t_abs__jam_masuk;
                                  $a1 = explode(":",$t3);
                                  $a2 = explode(":",$t4);
                                  $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                                  $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                                  $diff = abs($time2-$time1);
                                  $hours = floor($diff/(60*60));
                                  $mins = floor(($diff-($hours*60*60))/(60));
                                  $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                                  $result = $hours.":".$mins.":".$secs;
                                  $early_time= $result;   
                            }
                            else {
                                     $result = "00:00:00";
                                     $early_time = $result;
                                     
                                    }                            
                            
                              // OVERTIME 
                                $date1 = strtotime("$rule_jam_total2");
                                $date2 = strtotime("$total_jam_kerja2");
                                 
                            IF( $date2  > $date1)
                            {
                                 
                                $a2 = strtotime("$rule_jam_total2");
                                $b2 = strtotime("$total_jam_kerja2");
                                $interval = $b2 - $a2;
                                $seconds = $interval % 60;
                                $minutes = floor(($interval % 3600) / 60);
                                $hours = floor($interval / 3600);
                                $overtime=$hours.":".$minutes.":".$seconds;
                                
                            }
                            else
                            {
                                 $overtime= '00:00:00';
                                 
                            }

                             // LESSTIME
                                $rule_masuk = strtotime("$rule_jam_total2");
                                $jml_msk = strtotime("$total_jam_kerja2");
                               
                    
                            IF($jml_msk  < $rule_masuk && $total_jam_kerja2!='0:0:0')
                            {
                                
                                $rule_masuk = strtotime("$rule_jam_total2");
                                $jml_msk = strtotime("$total_jam_kerja2");
                                $interval = $rule_masuk - $jml_msk;
                                $seconds = $interval % 60;
                                $minutes = floor(($interval % 3600) / 60);
                                $hours = floor($interval / 3600);
                                $lesstime= $hours.":".$minutes.":".$seconds;

                            }
                            else
                            {
                                 $lesstime= '00:00:00';                  
                            }      
//  END HITUNG  
                           
   $ket_hadir=strtotime($total_jam_kerja2);
   
     IF($ket_hadir>1495569600)
        {
            $status_hadir='1';
        }  else {
             $status_hadir='0';
        }

   IF(($t_abs__tgl<$periode_awal) or ($t_abs__tgl>$periode_akhir))
	{	          
            Header("Location:index_cek.php?ERR=1&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);

	} elseif(($t_abs__tgl>=$periode_awal) &&($t_abs__tgl<=$periode_akhir)&&($status==1)&&($t_abs__status==1)&&($total_jam_kerja2!='0:0:0' && $total_jam_kerja2>='04:00:00')) 
        {
            
            
                        $sql_edit  =" UPDATE t_absensi set ";
                        $sql_edit .=" t_abs__fingerprint = '$_POST[r_pnpt__finger_print]', ";
                        $sql_edit .=" t_abs__tgl = '$t_abs__tgl', ";
                        $sql_edit .=" t_abs__id_shift = '$_POST[r_pnpt__shift]', ";
                        $sql_edit .=" t_abs__jam_masuk = '$t_abs__jam_masuk2', ";
                        $sql_edit .=" t_abs__jam_keluar = '$t_abs__jam_keluar2', ";
                        $sql_edit .=" t_abs__early = '$early_time', ";
                        $sql_edit .=" t_abs__lately = '$keterlambatan', ";
                        $sql_edit .=" t_abs__approval = '$t_abs__approval', ";
                        $sql_edit .=" t_abs__lesstime = '$lesstime', ";
                        $sql_edit .=" t_abs__overtime = '$overtime', ";
                        $sql_edit .=" t_abs__worktime = '$total_jam_kerja2', ";
                        $sql_edit .=" t_abs__status = '$status_hadir', ";
                        $sql_edit .=" t_abs__catatan = '$t_abs__catatan', ";
                        $sql_edit .=" t_abs__date_updated =  now(),";
                        $sql_edit .=" t_abs__user_updated = '$id_peg'";
                        $sql_edit .="  WHERE t_abs__id='$_POST[t_abs__id]' ";
			$sqlresult4 = $db->Execute($sql_edit);
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&idfinger_cari=".$t_abs__fingerprint);
	}elseif(($t_abs__tgl>=$periode_awal && $t_abs__tgl<=$periode_akhir)&&($t_abs__status>1))
        {
           
			$sql_edit  =" UPDATE t_absensi set ";
                        $sql_edit .=" t_abs__fingerprint = '$_POST[r_pnpt__finger_print]', ";
                        $sql_edit .=" t_abs__tgl = '$t_abs__tgl', ";
                        $sql_edit .=" t_abs__id_shift = '$_POST[r_pnpt__shift]', ";
                        $sql_edit .=" t_abs__jam_masuk = '0', ";
                        $sql_edit .=" t_abs__jam_keluar = '0', ";
                        $sql_edit .=" t_abs__early = '0', ";
                        $sql_edit .=" t_abs__lately = '0', ";
                        $sql_edit .=" t_abs__approval = '0', ";
                        $sql_edit .=" t_abs__lesstime = '0', ";
                        $sql_edit .=" t_abs__overtime = '0', ";
                        $sql_edit .=" t_abs__worktime = '0', ";
                        $sql_edit .=" t_abs__status = '$t_abs__status', ";
                        $sql_edit .=" t_abs__catatan = '$t_abs__catatan', ";
                        $sql_edit .=" t_abs__date_updated =  now(),";
                        $sql_edit .=" t_abs__user_updated = '$id_peg'";
                        $sql_edit .="  WHERE t_abs__id='$_POST[t_abs__id]' ";
			$sqlresult4 = $db->Execute($sql_edit);
                        
                         $sql_print="SELECT peg.r_pnpt__id_pegawai,peg.r_pnpt__finger_print,peg.r_pegawai__nama FROm v_pegawai peg
                        WHERE peg.r_pnpt__aktif=1 AND peg.r_pnpt__finger_print='$t_abs__fingerprint' GROUP BY peg.r_pegawai__id";
                      
                        $rs_val = $db->Execute($sql_print);
                        $finger_cuti= $rs_val->fields['t_abs__fingerprint'];
                        $idpeg_cuti = $rs_val->fields['r_pnpt__id_pegawai'];
                        
                         $sql_cek="SELECT
                                    peg.r_pnpt__id_pegawai,
                                    peg.r_pnpt__finger_print,
                                    peg.r_pegawai__nama,
                                    t_cuti.t_cuti__no
                                    FROM v_pegawai peg INNER JOIN t_cuti On t_cuti.t_cuti__nip=peg.r_pnpt__id_pegawai and t_cuti.t_cuti__awal='$t_abs__tgl'
                                    WHERE peg.r_pnpt__aktif = 1 AND t_cuti.t_cuti__nip='$idpeg_cuti' GROUP BY peg.r_pegawai__id";
                        $rs_val = $db->Execute($sql_cek);
                        $finger_cek= $rs_val->fields['t_abs__fingerprint'];
                        $idpeg_cek = $rs_val->fields['r_pnpt__id_pegawai'];
                        $cuti_cek = $rs_val->fields['t_cuti__no'];
                        
                           
          
                        if($jenis_cuti==1)
                        {
                            $ket_cuti='Cuti Tahunan';
                        }else
                        {
                              $ket_cuti='Cuti Khusus';
                        }
                            
                     if (($cuti_cek=='' AND $t_abs__status>1))
                     {
                         
                         $sql_cuti = "INSERT INTO t_cuti (t_cuti__nip,"
                                        . "t_cuti__atasan_nama,"
                                        . "t_cuti__awal,"
                                        . "t_cuti__akhir,"
                                        . "t_cuti__lama_hari,"
                                        . "t_cuti__jenis_cuti,"
                                        . "t_cuti__alasan,"
                                        ."t_cuti__date_created,"
                                        ."t_cuti__date_updated,"
                                        ."t_cuti__user_created,"
                                        ."t_cuti__user_updated)";
                        $sql_cuti .= " VALUES ('$idpeg_cuti',"
                                                . "'$atasan',"
                                               . "'$t_abs__tgl'," 
                                               . "'$t_abs__tgl',"
                                               . "'1',"
                                               . "'$jenis_cuti',"
                                               . "'$t_abs__catatan',"
                                               . "now(),"
                                               . "now(),"
                                               . "$id_peg,"
                                               . "$id_peg)";
                                   
                                $sqlresult = $db->Execute($sql_cuti);
                     }
                    else {
                          
                         $sql_cuti = " Update t_cuti set "
                                    . "t_cuti__jenis_cuti='$jenis_cuti',"
                                    . "t_cuti__atasan_nama='$atasan',"
                                    . "t_cuti__alasan='$t_abs__catatan'"
                                    . "WHERE t_cuti__no='$cuti_cek' and t_cuti__awal='$t_abs__tgl'" ;
                         //  var_dump($sql_cuti)or die();
                         $sqlresult = $db->Execute($sql_cuti);
                    }
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&idfinger_cari=".$t_abs__fingerprint."&bulan=".$abs_bulan."&tahun=".$abs_tahun);
	
        }  
 else {
    

       Header("Location:index_cek.php?ERR=".$status_hadir."&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
 }


}

function create_(){
    
        global $mod_id;	
        global $db;
        global $tbl_name;
        global $field_name;
        
        $periode_awal= $_SESSION['SESSION_AWAL_AKTIF'];
        $periode_akhir= $_SESSION['SESSION_AKHIR_AKTIF'];
        
        
        $user_id = base64_decode($_SESSION['UID']);
        $id_peg = $_SESSION['SESSION_ID_PEG'];
        $today = date("Y-m-d h:i:s");

        $now= date("Y-m-d");
        $kode_cabang = addslashes($_POST[kode_cabang]);
        $kode_cabang = addslashes($_POST[r_pegawai__nama]);
        $t_abs__fingerprint = addslashes($_POST[r_pnpt__finger_print]);
        $t_abs__tgl =addslashes($_POST[t_abs__tgl]);
        $t_abs__id_shift =addslashes($_POST[r_pnpt__shift]);
        $t_abs__jam_masuk =addslashes($_POST[t_abs__jam_masuk]);
        $t_abs__jam_keluar =addslashes($_POST[t_abs__jam_keluar]);
        $t_abs__worktime = addslashes($_POST[t_abs__worktime]);
        $t_abs__status= addslashes($_POST[t_abs__status]);
        $jenis_cuti= addslashes($_POST[jenis_cuti]);
        $t_abs__catatan= addslashes($_POST[t_abs__catatan]);
        $atasan= addslashes($_POST[atasan]);
        
       
       
        $sql_cek="SELECT * FROM t_absensi A where A.t_abs__fingerprint='$t_abs__fingerprint' AND A.t_abs__tgl='$t_abs__tgl'";
        $rs_val = $db->Execute($sql_cek);
         
        $old__fingerprint = $rs_val->fields['t_abs__fingerprint'];
        $old__tgl_masuk = $rs_val->fields['t_abs__tgl'];
        $absen_id = $rs_val->fields['t_abs__id'];
        $cek_jam_masuk = $rs_val->fields['t_abs__jam_masuk'];
        $cek_jam_masuk = $rs_val->fields['t_abs__jam_keluar'];
        
        //START PERHITUNGAN
        $CekFingerPrint="SELECT
        A.r_shift__jam_masuk AS r_shift__jam_masuk,
        A.r_shift__jam_pulang AS r_shift__jam_pulang,
        A.r_shift__jml_jam AS r_shift__jml_jam,
        A.r_shift__id AS r_shift__id
        FROM
        r_shift A
        INNER JOIN r_penempatan B ON B.r_pnpt__shift=A.r_shift__id
        WHERE B.r_pnpt__finger_print='$t_abs__fingerprint'";
        $rs_val = $db->Execute($CekFingerPrint);
        $rule_jam_masuk= $rs_val->fields['r_shift__jam_masuk'];
        $rule_jam_keluar= $rs_val->fields['r_shift__jam_pulang'];   
        $rule_jam_total= $rs_val->fields['r_shift__jml_jam'];   
        $rule_jam_shift= $rs_val->fields['r_shift__id'];  
        
        $datetime1=$t_abs__tgl.' '.$t_abs__jam_masuk;    
        $date1 = new DateTime($datetime1);
        $result_tgl1 = $date1->format('Y-m-d H:i:s');

        $datetime2=$t_abs__tgl.' '.$t_abs__jam_keluar;    
        $date2 = new DateTime($datetime2);
        $result_tgl2 = $date2->format('Y-m-d H:i:s');

        $date = new DateTime($t_abs__tgl);  
        $dateTo = new \DateTime($t_abs__tgl.' +1 day');
        $date_tommorow=$dateTo->format('Y-m-d'); 

        $date_masuk1 = date('Y-m-d', strtotime($result_tgl1));
        $time_masuk1 = date('H:i:s', strtotime($result_tgl1));


        $date_masuk2 = date('Y-m-d', strtotime($result_tgl2));
        $time_masuk2 = date('H:i:s', strtotime($datetime2));
        
        
        IF($rule_jam_total!='')
           {
                 $t1=$rule_jam_total;
                 $a1 = explode(":",$t1);
                 $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                 $diff = abs($time1);
                 $hours = floor($diff/(60*60));
                 $mins = floor(($diff-($hours*60*60))/(60));
                 $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                 $result = $hours.":".$mins.":".$secs;
                 $rule_jam_total2 = $result;
           }
          
         

                            
                            IF($t_abs__jam_masuk!='')
                            {
                                
                              $t_abs__jam_masuk2=$t_abs__jam_masuk;
                                
                            }
                            else {
                                $t_abs__jam_masuk2='00:00:00';
                            }
                           
                          
                            
                             IF($t_abs__jam_keluar!='')
                            {
                                $t_abs__jam_keluar2=$t_abs__jam_keluar;
                              
                               
                            }else
                            {
                                 $t_abs__jam_keluar2='00:00:00';
                            } 
                                
                           
                       
                             IF($time_masuk1!='00:00:00' && $time_masuk2!='00:00:00'  )
                     
                            {
                                 
                                 if($rule_jam_shift<6)
                                {
                                  $t1=$t_abs__jam_masuk2;
                                  $t2=$t_abs__jam_keluar2;
                                  $a1 = explode(":",$t1);
                                  $a2 = explode(":",$t2);
                                  $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                                  $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                                  $diff = abs($time1-$time2);
                                  $hours = floor($diff/(60*60))-1;
                                  $mins = floor(($diff-($hours*60*60))/(60)-60);
                                  $secs = floor(($diff-(($hours*60*60)+($mins*60)))-3600);
                                  $result_reguler = $hours.":".$mins.":".$secs;
                                  $total_jam_kerja2 = $result_reguler;

                                }else
                                {
                                $datetime1=$t_abs__tgl.' '.$t_abs__jam_masuk;     
                                $date1 = new DateTime($datetime1);
                                $result_tgl1 = $date1->format('Y-m-d H:i:s');
                             
                                $date = new DateTime($t_abs__tgl);  
                                $dateTo = new \DateTime($t_abs__tgl.' +1 day');
                                $add_day=$dateTo->format('Y-m-d'); // 1980-12-08
                                
                                $datetime2=$add_day.' '.$t_abs__jam_keluar;    
                                $date2 = new DateTime($datetime2);
                                $result_tgl2 = $date2->format('Y-m-d H:i:s');
                                
                                $total_jam_kerja2 = datediff($result_tgl1, $result_tgl2);                                    
                                // $total_jam_kerja2 = $result_split_res; 
                                }
                                
                               
                            }  else
                            {
                                  $total_jam_kerja2 = '00:00:00';    
                            }
                            
                           
                            
                             IF($total_jam_kerja2>0)
                                {$status='1';}else{$status='0';$total_jam_kerja2 = '00:00:00'; }
                        
//                            $durasi_kerja= strtotime($total_jam_kerja2);
//                             $durasi_total=idate('h',$durasi_kerja);
                            
                       
                          
                            
                            
                   
                   //LATELY
                        
                           
                          IF($t_abs__jam_masuk>$rule_jam_masuk) 
                           {
                                  $t1=$rule_jam_masuk;
                                  $t2=$t_abs__jam_masuk;
                                  $a1 = explode(":",$t1);
                                  $a2 = explode(":",$t2);
                                  $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                                  $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                                  $diff = abs($time1-$time2);
                                  $hours = floor($diff/(60*60));
                                  $mins = floor(($diff-($hours*60*60))/(60));
                                  $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                                  $result = $hours.":".$mins.":".$secs;
                                  $keterlambatan = $result;
                            }
                            else {
                                     $result = "00:00:00";
                                        $keterlambatan = $result;
                                         // "-";
                            } 

                         
                        //EARLY
                          IF($t_abs__jam_masuk<$rule_jam_masuk) 
                           {
                             
                                  $t3=$rule_jam_masuk;
                                  $t4=$t_abs__jam_masuk;
                                  $a1 = explode(":",$t3);
                                  $a2 = explode(":",$t4);
                                  $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                                  $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                                  $diff = abs($time2-$time1);
                                  $hours = floor($diff/(60*60));
                                  $mins = floor(($diff-($hours*60*60))/(60));
                                  $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                                  $result = $hours.":".$mins.":".$secs;
                                  $early_time= $result;   
                            }
                            else {
                                     $result = "00:00:00";
                                     $early_time = $result;
                                     
                                    }                            
                            
                            
                              // OVERTIME 
                                $date1 = strtotime("$rule_jam_total2");
                                $date2 = strtotime("$total_jam_kerja2");
                                 
                            IF( $date2  > $date1)
                            {
                                 
                                $a2 = strtotime("$rule_jam_total2");
                                $b2 = strtotime("$total_jam_kerja2");
                                $interval = $b2 - $a2;
                                $seconds = $interval % 60;
                                $minutes = floor(($interval % 3600) / 60);
                                $hours = floor($interval / 3600);
                                $overtime=$hours.":".$minutes.":".$seconds;
                                
                            }
                            else
                            {
                                 $overtime= '0:0:0';
                                 
                            }
                            
                        
                            
                         
                            
                             // LESSTIME
                                $rule_masuk = strtotime("$rule_jam_total2");
                                $jml_msk = strtotime("$total_jam_kerja2");
                               
                            IF($jml_msk  < $rule_masuk)
                            {
                                
                                $rule_masuk = strtotime("$rule_jam_total2");
                                $jml_msk = strtotime("$total_jam_kerja2");
                                $interval = $rule_masuk - $jml_msk;
                                $seconds = $interval % 60;
                                $minutes = floor(($interval % 3600) / 60);
                                $hours = floor($interval / 3600);
                                $lesstime= $hours.":".$minutes.":".$seconds;

                            }
                            else
                            {
                                 $lesstime= '00:00:00';
                                
                            }
                            
                            
                        
                               
        IF(($t_abs__tgl<$periode_awal) or ($t_abs__tgl>$periode_akhir) or $old__tgl_masuk!='')
        {
         
                Header("Location:index_cek.php?ERR=1&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&id_error=".$old__tgl_masuk);
        
                
        }elseif(($t_abs__tgl>=$periode_awal && $t_abs__tgl<=$periode_akhir)&&($status==1)&&($t_abs__status==1)&&($total_jam_kerja2!='0:0:0' && $total_jam_kerja2>='04:00:00'))
        { 
                $sql="INSERT INTO t_absensi("
                        . "t_abs__fingerprint,"
                        . "t_abs__tgl,"
                        . "t_abs__id_shift,"
                        . "t_abs__jam_masuk,"
                        . "t_abs__jam_keluar,"
                        . "t_abs__early, "
                        . "t_abs__lately,"
                        . "t_abs__approval, "
                        . "t_abs__lesstime,"
                        . "t_abs__overtime,"
                        . "t_abs__worktime,"
                        . "t_abs__status,"
                        . "t_abs__catatan,"
                        . "t_abs__date_created,"
                        . " t_abs__date_updated,"
                        . " t_abs__user_created,"
                        . " t_abs__user_updated) VALUES "
	
                         . "('$t_abs__fingerprint',"
                        . "'$t_abs__tgl',"
                        . "'$rule_jam_shift',"
                        . "'$t_abs__jam_masuk2',"
                        . "'$t_abs__jam_keluar2',"
                        . "'$early_time',"
                        . "'$keterlambatan',"
                        . "'$t_abs__approval',"
                        . "'$lesstime',"
                        . "'$overtime',"
                        . "'$total_jam_kerja2',"
                        . "$status,"
                        . "'$t_abs__catatan',"
                        . "now(),"
                        . "now(),"
                        . "'$id_peg',"
                        . "'$id_peg')";
               
                $sqlresult = $db->Execute($sql);
                 Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&idfinger_cari=".$t_abs__fingerprint);  
                
                 
                 }elseif(($t_abs__tgl>=$periode_awal &&$t_abs__tgl<=$periode_akhir)&&($t_abs__status>1)){
                   
                     $sql="INSERT INTO t_absensi("
                        . "t_abs__fingerprint,"
                        . "t_abs__tgl,"
                        . "t_abs__id_shift,"
                        . "t_abs__jam_masuk,"
                        . "t_abs__jam_keluar,"
                        . "t_abs__early, "
                        . "t_abs__lately,"
                        . "t_abs__approval, "
                        . "t_abs__lesstime,"
                        . "t_abs__overtime,"
                        . "t_abs__worktime,"
                        . "t_abs__status,"
                        . "t_abs__catatan,"
                        . "t_abs__date_created,"
                        . " t_abs__date_updated,"
                        . " t_abs__user_created,"
                        . " t_abs__user_updated) VALUES "
	
                         . "('$t_abs__fingerprint',"
                        . "'$t_abs__tgl',"
                        . "'',"
                        . "'',"
                        . "'',"
                        . "'',"
                        . "'',"
                        . "'',"
                        . "'',"
                        . "'',"
                        . "'',"
                        . "$t_abs__status,"
                        . "'$t_abs__catatan',"
                        . "now(),"
                        . "now(),"
                        . "'$id_peg',"
                        . "'$id_peg')";
           
              
                    $sqlresult = $db->Execute($sql);
                    
                        $sql_cek="SELECT peg.r_pnpt__id_pegawai,peg.r_pnpt__finger_print,peg.r_pegawai__nama FROm v_pegawai peg
                        WHERE peg.r_pnpt__aktif=1 AND peg.r_pnpt__finger_print='$t_abs__fingerprint' GROUP BY peg.r_pegawai__id";
                      
                        $rs_val = $db->Execute($sql_cek);
                        $finger_cek= $rs_val->fields['t_abs__fingerprint'];
                        $idpeg_cek = $rs_val->fields['r_pnpt__id_pegawai'];
                        if($jenis_cuti==1)
                        {
                            $ket_cuti='Cuti Tahunan';
                        }else
                        {
                              $ket_cuti='Cuti Khusus';
                        }
                            
                        
                        
                     if ($sqlresult==true AND $sql_cek==true AND $t_abs__status==6 OR $t_abs__status==3)
                     {
                                $sql_cuti = "INSERT INTO t_cuti (t_cuti__nip,"
                                        . "t_cuti__atasan_nama,"
                                                . "t_cuti__awal,"
                                                . "t_cuti__akhir,"
                                                . "t_cuti__lama_hari,"
                                                . "t_cuti__jenis_cuti,"
                                                . "t_cuti__alasan,"
                                                ."t_cuti__date_created,"
                                                ."t_cuti__date_updated,"
                                                ."t_cuti__user_created,"
                                                ."t_cuti__user_updated)";
                                $sql_cuti .= " VALUES ('$idpeg_cek',"
                                                        . "'$atasan',"
                                                        . "'$t_abs__tgl'," 
                                                        . "'$t_abs__tgl',"
                                                        . "'1',"
                                                        . "'$jenis_cuti',"
                                                        . "'$t_abs__catatan',"
                                                        . "now(),"
                                                        . "now(),"
                                                        . "$id_peg,"
                                                        . "$id_peg)";
                                                    $sqlresult = $db->Execute($sql_cuti);
                     }
                   
                  
                    
                 
                    
                    Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&idfinger_cari=".$t_abs__fingerprint);
                            }
                
                 else {
                        Header("Location:index_cek.php?ERR=5&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
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
