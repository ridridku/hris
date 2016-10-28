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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kehadiran/upoload_kehadiran';


$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kehadiran');
$FILE_JS  = $JS_MODUL.'/upload_kehadiran';
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

        $sql_cek_edit="SELECT * FROM t_absensi A where A.t_abs__fingerprint='$t_abs__fingerprint' AND A.t_abs__tgl='$t_abs__tgl'";
        
        $rs_val = $db->Execute($sql_cek_edit);
        $old__fingerprint = $rs_val->fields['t_abs__fingerprint'];
        $old__tgl_masuk = $rs_val->fields['t_abs__tgl'];
        $absen_id = $rs_val->fields['t_abs__id'];
        
        
        $sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_bulan,r_periode__payroll_tahun,r_periode__payroll_status
                                  FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
                  
                                $rs_val = $db->Execute($sql_cek_periode);
                                $periode_bulan= $rs_val->fields['r_periode__payroll_bulan'];
                                $periode_tahun= $rs_val->fields['r_periode__payroll_tahun'];  
   
                                $t_abs__tgl = explode('-', $t_abs__tgl);
                                $abs_tahun  = $t_abs__tgl[0];
                                $abs_bulan= $t_abs__tgl[1];
                                $abs_tgl=$t_abs__tgl[2];
                               
                                                          
                                $arr = array($abs_tahun ,$abs_bulan,$abs_tgl);                                 
                                $tgl__input = implode("-",$arr);
      

                if($abs_bulan!=$periode_bulan or $abs_tahun!=$periode_tahun)
		
                    {
		 
				Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);

		} else {
			$sql_edit  =" UPDATE t_absensi set ";
                        $sql_edit .=" t_abs__fingerprint = '$_POST[r_pnpt__finger_print]', ";
                        $sql_edit .=" t_abs__tgl = '$tgl__input', ";
                        $sql_edit .=" t_abs__id_shift = '$_POST[r_pnpt__shift]', ";
                        $sql_edit .=" t_abs__jam_masuk = '$_POST[t_abs__jam_masuk]', ";
                        $sql_edit .=" t_abs__jam_keluar = '$_POST[t_abs__jam_keluar]', ";
                        $sql_edit .=" t_abs__early = '$t_abs__early', ";
                        $sql_edit .=" t_abs__lately = '$t_abs__lately', ";
                        $sql_edit .=" t_abs__approval = '$_POST[t_abs__approval]', ";
                        $sql_edit .=" t_abs__lesstime = '$_POST[t_abs__lesstime]', ";
                        $sql_edit .=" t_abs__overtime = '$_POST[t_abs__overtime]', ";
                        $sql_edit .=" t_abs__worktime = '$_POST[t_abs__worktime]', ";
                        $sql_edit .=" t_abs__status = '$_POST[t_abs__status]', ";
                        $sql_edit .=" t_abs__catatan = '$_POST[t_abs__catatan]', ";
                        $sql_edit .=" t_abs__date_updated =  now(),";
                        $sql_edit .=" t_abs__user_updated = '$id_peg'";
                        $sql_edit .="  WHERE t_abs__id='$_POST[t_abs__id]' ";
                      //  var_dump($sql_edit) or die();
			$sqlresult4 = $db->Execute($sql_edit);
                   
            
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&idfinger_cari=".$t_abs__fingerprint."&bulan=".$abs_bulan."&tahun=".$abs_tahun);
		}
}

function create_(){
    
        global $mod_id;	
        global $db;
        global $tbl_name;
        global $field_name;
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
       
        $t_abs__date_created = Date('Y-m-d H:i:s');
        $t_abs__date_updated = '';
        $t_abs__user_created= $id_peg;
        $t_abs__user_updated = '';

        
        $sql_cek="SELECT * FROM t_absensi A where A.t_abs__fingerprint='$t_abs__fingerprint' AND A.t_abs__tgl='$t_abs__tgl'";
        $rs_val = $db->Execute($sql_cek);
        $old__fingerprint = $rs_val->fields['t_abs__fingerprint'];
        $old__tgl_masuk = $rs_val->fields['t_abs__tgl'];
        
          $sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_bulan,r_periode__payroll_tahun,r_periode__payroll_status
                                                FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
                              $rs_val = $db->Execute($sql_cek_periode);
                              $periode_bulan= $rs_val->fields['r_periode__payroll_bulan'];
                              $periode_tahun= $rs_val->fields['r_periode__payroll_tahun'];   
                              
                                $t_abs__tgl = explode('-', $t_abs__tgl);
                                $abs_tahun  = $t_abs__tgl[0];
                                $abs_bulan= $t_abs__tgl[1];
                                $abs_tgl=$t_abs__tgl[2];
                                
                                $arr = array($abs_tahun ,$abs_bulan,$abs_tgl);                                 
                                $tgl__input = implode("-",$arr); 
                    

 
    if($t_abs__fingerprint==$old__fingerprint and $tgl__input==$old__tgl_masuk or $abs_bulan!=$periode_bulan or $abs_tahun!=$periode_tahun) {
        
      
			Header("Location:index_cek.php?ERR=5&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else
                    
              
                        { 
                       $CekFingerPrint="SELECT
                                    A.r_shift__jam_masuk,
                                    A.r_shift__jam_pulang,
                                    A.r_shift__jml_jam,
                                    A.r_shift__id,
                                    L.r_libur__tgl,
                                    L.r_libur__ket
                                  FROM
                                             r_shift A, r_penempatan B,t_libur L
                                      WHERE
                                   A.r_shift__id = B.r_pnpt__shift AND  B.r_pnpt__finger_print = '".$t_abs__fingerprint."' AND A.r_shift__id=L.r_libur__shift";
                     
                    $sqlresult = $db->Execute($CekFingerPrint);
                    $initSet = array();
                    $data_finger = array();
                    $z=0;
                          
                   
                    while ($arr=$sqlresult->FetchRow())
                            {
                                array_push($data_finger, $arr);
                                array_push($initSet, $z);
                                $z++;
                                $rule_jam_masuk=$data_finger[0][0];
                                $rule_jam_keluar=$data_finger[0][1];
                                $rule_jam_total=$data_finger[0][2];
                                $rule_jam_shift=$data_finger[0][3];
                                $rule_tgl_libur=$data_finger[0][4];
                                $rule_tgl_ket=$data_finger[0][5];
                                
                             
                              
                            list($jam,$menit,$detik)=explode(':',$rule_jam_masuk);
                            $r_jam_masuk=mktime($jam,$menit,$detik,1,1,1);
                             
                            list($jam,$menit,$detik)=explode(':',$rule_jam_total);
                            $r_jam_total=mktime($jam,$menit,$detik,1,1,1);
                            
                            
                            list($jam,$menit,$detik)=explode(':',$t_abs__jam_masuk);
                            $jam_masuk=mktime($jam,$menit,$detik,1,1,1);                    
                            
                            list($jam,$menit,$detik)=explode(':',$t_abs__jam_keluar);
                            $jam_keluar=mktime($jam,$menit,$detik,1,1,1);
                            
                            list($jam,$menit,$detik)=explode(':',$t_abs__worktime);
                            $work_time=mktime($jam,$menit,$detik,1,1,1);
                                                        
                            $total_jam_kerja=diffTime($t_abs__jam_masuk,$t_abs__jam_keluar);
                    
                            //lately  
                            IF($jam_masuk>$r_jam_masuk) 
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
                            
                          IF($jam_masuk<$r_jam_masuk) 
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
                                         // "-";
                            }   
                            
                            
                            // OVERTIME 
                            IF($work_time>$r_jam_total)
                            {
                                
                                $date1 = strtotime("$rule_jam_total");
                                $date2 = strtotime("$t_abs__worktime");
                                $interval = $date2 - $date1;
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
                            IF($work_time<$r_jam_total)
                            {
                                
                                $aturan_jm = strtotime("$rule_jam_total");
                                $kerja_jm = strtotime("$t_abs__worktime");
                                $interval = $aturan_jm - $kerja_jm;
                                $seconds = $interval % 60;
                                $minutes = floor(($interval % 3600) / 60);
                                $hours = floor($interval / 3600);
                                $lesstime= $hours.":".$minutes.":".$seconds;

                            }
                            else
                            {
                                 $lesstime= '00:00:00';
                                
                            }
                            
                                
               if ($abs_bulan==$periode_bulan  AND $abs_tahun==$periode_tahun)     
               {   
                            $sql="INSERT INTO t_absensi(t_abs__fingerprint, t_abs__tgl, t_abs__id_shift, t_abs__jam_masuk, t_abs__jam_keluar, t_abs__early, t_abs__lately, t_abs__approval, t_abs__lesstime, t_abs__overtime, t_abs__worktime, t_abs__status, t_abs__catatan, t_abs__date_created, t_abs__user_created) VALUES "
                                 . "('$t_abs__fingerprint',"
                                 . "'$tgl__input',"
                                 . "'$rule_jam_shift',"
                                 . "'$t_abs__jam_masuk',"
                                 . "'$t_abs__jam_keluar',"
                                 . "'$t_abs__early',"
                                 . "'$t_abs__lately',"
                                 . "'$t_abs__approval',"
                                 . "'$t_abs__lesstime',"
                                 . "'$t_abs__overtime',"
                                 . "'$t_abs__worktime',"
                                 . "'$t_abs__status',"
                                 . "'$t_abs__catatan',"
                                 . "'$today',"
                                 . "'$id_peg')";	
                       
			 $sqlresult = $db->Execute($sql);
                         
               }                            
                         
                         
                    	
                        Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
                            
                        
                            }
                            
                            
                            
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
