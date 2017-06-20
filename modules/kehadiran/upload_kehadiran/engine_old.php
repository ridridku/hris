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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kehadiran/upload_kehadiran';


$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kehadiran');
$FILE_JS  = $JS_MODUL.'/upload_kehadiran';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$cabang_id=$_SESSION['SESSION_KODE_CABANG'];
$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];
$today = date("Y-m-d h:i:s");
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

}

function create_(){
    
global $mod_id;	
global $db;
global $tbl_name;//nama_sektor
global $field_name;
$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];


$now= date("Y-m-d");
$kode_cabang = addslashes($_POST[kode_cabang]);
$tipe_file=$_POST[tipe_file];

$periode_awal	= $_SESSION['SESSION_AWAL_AKTIF'];
$periode_akhir	= $_SESSION['SESSION_AKHIR_AKTIF']; 



error_reporting(E_ALL ^ E_NOTICE);
error_reporting(0);

ini_set("memory_limit","1024M");

if(isset($_FILES['file_xls']))
    {
      $errors= array();
      $file_name = $_FILES['file_xls']['name'];
      $file_size =$_FILES['file_xls']['size'];
      $file_tmp =$_FILES['file_xls']['tmp_name'];
      $file_type=$_FILES['file_xls']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['file_xls']['name'])));
    }

   

if($tipe_file==1 and $file_ext=='xls')  //upload_xls     
{ var_dump('aa')  or die();
              
            $data = new Spreadsheet_Excel_Reader($_FILES['file_xls']['tmp_name']);
            $hasildata = $data->rowcount($sheet_index=0);
            $sukses = 0;
            $gagal = 0;
            
            
         
            for ($i=2; $i<=$hasildata; $i++)
            {
                        $t_abs__fingerprint = $data->val($i,1);
                        $t_abs__tgl = $data->val($i, 2);
                        $t_abs__id_shift = $data->val($i, 3);
                        $t_abs__jam_masuk = $data->val($i, 4);
                        $t_abs__jam_keluar= $data->val($i,5);
                      
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
                
                
          //   var_dump($nama_foto)or die();  
            IF($rule_jam_total!='' )
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
          
                                
            

               if(($t_abs__tgl!=null)&&($t_abs__jam_masuk!=null)or($t_abs__jam_keluar!=null))
               {
                $datetime1=$t_abs__tgl.' '.$t_abs__jam_masuk;    
                $date1 = new DateTime($datetime1);
                $result_tgl1 = $date1->format('Y-m-d H:i:s');
                $date_in=$date1->format('Y-m-d');
               }
                
           
            if(($t_abs__tgl!=null)&&($t_abs__jam_masuk!=null)or($t_abs__jam_keluar!=null))
               {
                $datetime2=$t_abs__tgl.' '.$t_abs__jam_keluar;    
                $date2 = new DateTime($datetime2);
                $result_tgl2 = $date2->format('Y-m-d H:i:s');

                $date = new DateTime($t_abs__tgl);  
                $dateTo = new \DateTime($t_abs__tgl);
                $test=$dateTo->format('Y-m-d'); // 1980-12-08
               }
               
            if(($t_abs__tgl!='null')&&($t_abs__jam_masuk!=null)&&($t_abs__jam_keluar!=null))
            {
                $date_masuk = $date_in;
                $time_masuk = $t_abs__jam_masuk;
                $time_keluar = $t_abs__jam_keluar;
            }
            else
            {
                $date_masuk =5;
                $time_masuk =5;
                $time_keluar =5;
                
            }
        
               
                            IF($t_abs__jam_masuk!='')
                            {  
                                $t_abs__jam_masuk2=$t_abs__jam_masuk;  
                            }
                                elseif   ($t_abs__jam_masuk =='00:00:00' )
                            {  
                                $t_abs__jam_masuk2='00:00:00';  
                            }
                                else
                            {
                                $t_abs__jam_masuk2='00:00:00';  
                            }
                            
                            
                            
                           IF($t_abs__jam_keluar!='')
                            {
                                $t_abs__jam_keluar2=$t_abs__jam_keluar;
                            }
                                elseif ($t_abs__jam_keluar =='')
                            {
                               $t_abs__jam_keluar2='00:00:00';
                            }
                                else{$t_abs__jam_keluar2='00:00:00';}
                            
                            
                            

                         
                            
                            IF($t_abs__jam_masuk!='' && $t_abs__jam_keluar!='' )
                            {
                                 
                        
                                if($rule_jam_shift<6)  
                                { //  var_dump('a')or die();
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
                                  
                                  
                                //  var_dump($total_jam_kerja2.'====='.$t_abs__jam_masuk2.'a'.$t_abs__jam_keluar2)or die();

                                }elseif(($rule_jam_shift>=6) AND (($time_masuk1!='00:00:00')AND($time_masuk2!='00:00:00')))
                                {
                                       
                         //    var_dump('b')or die();
                             
                                  $t1=$t_abs__jam_keluar2;
                                  $t2=$t_abs__jam_masuk2;
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
                                }
                               
                                    
//                                 
                               
                               
                            } else { 
                                          $total_jam_kerja2 = '00:00:00';
                                }
                                
                          
                               
                         
                        IF($total_jam_kerja2=='00:00:00')
                           {$status='0';}else{$status='1';}
                           
                          IF($t_abs__jam_masuk>$rule_jam_masuk && $t_abs__jam_masuk=='' && $t_abs__jam_keluar=='') 
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
                        
                          IF($t_abs__jam_masuk<$rule_jam_masuk && $t_abs__jam_masuk=='' && $t_abs__jam_keluar=='') 
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
                               
                            IF($jml_msk  < $rule_masuk &&  $t_abs__jam_masuk=='' && $t_abs__jam_keluar=='') 
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
                         
                   
                            
        $sql_cek="SELECT A.t_abs__fingerprint AS t_abs__fingerprint,"
        . " A.t_abs__tgl AS t_abs__tgl,"
        . " A.t_abs__status AS t_abs__status "
        . " FROM t_absensi A "
        . " where A.t_abs__fingerprint='$t_abs__fingerprint' "
        . " AND A.t_abs__tgl>='$periode_awal' AND A.t_abs__tgl <= '$periode_akhir' AND A.t_abs__tgl='$t_abs__tgl' ";
                   
                                   
        $rs_val = $db->Execute($sql_cek);
        $t_abs__fingerprint_update = $rs_val->fields['t_abs__fingerprint'];
        $t_abs__tgl_update = $rs_val->fields['t_abs__tgl'];
        $t_abs__status_update= $rs_val->fields['t_abs__status'];

        $tgl_input_str=strtotime($t_abs__tgl);
        $periode_awal_str=  strtotime($periode_awal);
        $periode_akhir_str= strtotime($periode_akhir);
        
      
        
            $sql_cek_I="SELECT A.t_abs__fingerprint AS t_abs__fingerprint,"
                        . " A.t_abs__tgl AS t_abs__tgl,"
                        . " A.t_abs__jam_masuk AS t_abs__jam_masuk,"
                        . " A.t_abs__jam_keluar AS t_abs__jam_keluar, "
                        . " A.t_abs__status AS t_abs__status,"
                        . " A.t_abs__worktime AS worktime "
                        . " FROM t_absensi A "
                        . " where A.t_abs__fingerprint='$t_abs__fingerprint' "
                        . " AND A.t_abs__tgl>='$periode_awal' AND A.t_abs__tgl <= '$periode_akhir'"
                        . " AND A.t_abs__tgl='$t_abs__tgl' ";
           $rs_val = $db->Execute($sql_cek_I);
             
        
            $finger_cek= $rs_val->fields['t_abs__fingerprint'];
            $tgl_cek = $rs_val->fields['t_abs__tgl'];
            $status_cek= $rs_val->fields['t_abs__status'];
            $jam_msk_cek=$rs_val->fields['t_abs__jam_masuk'];
            $jam_keluar_cek=$rs_val->fields['t_abs__jam_keluar'];
            $worktime_cek=$rs_val->fields['worktime'];
                
IF(($t_abs__tgl!=$tgl_cek) and ($finger_cek!=$t_abs__fingerprint )and($t_abs__tgl>=$periode_awal AND $t_abs__tgl <=$periode_akhir)&&($time_masuk>='00:00:01') && ($time_keluar>='00:00:01' )&& ($time_masuk!=5&&$time_keluar!=5))
   {
            
                        $sql = "INSERT INTO t_absensi(t_abs__fingerprint, t_abs__tgl, t_abs__id_shift, t_abs__jam_masuk, t_abs__jam_keluar, t_abs__early, t_abs__lately, t_abs__approval, t_abs__lesstime, t_abs__overtime, t_abs__worktime, t_abs__status, t_abs__catatan, t_abs__date_created, t_abs__date_updated, t_abs__user_created, t_abs__user_updated) VALUES "
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
                                 . "'$status',"
                                 . "'$t_abs__catatan',"
                                 . "now(),"
                                 . "now(),"
                                 . "'$id_peg',"
                                 . "'$id_peg')";
               
                        $sqlresult = $db->Execute($sql);
                            
                                   
          
                              
                     }
                  
                elseif(($t_abs__tgl_update==$t_abs__tgl && $t_abs__fingerprint_update==$t_abs__fingerprint )&&($t_abs__tgl>=$periode_awal AND $t_abs__tgl <=$periode_akhir))
                     {
                //     var_dump('b')or die();
                                 $sql_edit  ="  UPDATE t_absensi";
                                 $sql_edit .= " SET t_abs__fingerprint ='$t_abs__fingerprint', ";
                                 $sql_edit .= " t_abs__tgl ='$t_abs__tgl',";
                                 $sql_edit .= " t_abs__id_shift = '$rule_jam_shift',";
                                 $sql_edit .= " t_abs__jam_masuk = '$t_abs__jam_masuk2',";
                                 $sql_edit .= " t_abs__jam_keluar = '$t_abs__jam_keluar2',";
                                 $sql_edit .= " t_abs__early = '$early_time',";
                                 $sql_edit .= " t_abs__lately = '$keterlambatan',";
                                 $sql_edit .= " t_abs__approval = '$t_abs__approval',";
                                 $sql_edit .= " t_abs__lesstime ='$lesstime',";
                                 $sql_edit .= " t_abs__overtime= '$overtime',";
                                 $sql_edit .= " t_abs__worktime ='$total_jam_kerja2',";
                                 $sql_edit .= " t_abs__status= '$status',";
                                 $sql_edit .= " t_abs__catatan= '$t_abs__catatan',";
                                 $sql_edit .= " t_abs__date_created = '$t_abs__date_created',";
                                 $sql_edit .= " t_abs__date_updated ='now()',";
                                 $sql_edit .= " t_abs__user_created = '$t_abs__user_created',";
                                 $sql_edit .= " t_abs__user_updated = '$id_peg'";
                                 $sql_edit .="  WHERE  t_abs__fingerprint='$t_abs__fingerprint_update' AND  t_abs__tgl='$t_abs__tgl' ";
                                 $sqlresult5 = $db->Execute($sql_edit);

                }elseif($status==0 && $total_jam_kerja2<0)
                     {  
                         $sql211 = "UPDATE $tbl_name set "
                            . " t_abs__lesstime = '00:00:00',"
                            . " t_abs__overtime = '00:00:00',"
                            . " t_abs__worktime = '00:00:00',"
                            . " t_abs__status = '0'"
                            . " WHERE t_abs__fingerprint='$finger' AND t_abs__tgl='$t_abs__tgl' ";
                         
                            $db->Execute($sql211);  
                     }

                     
             }
                        ini_set("memory_limit","1024M");
                        $target_dir ='./uploads/';
                        $temp = explode(".",$_FILES["file_xls"]["name"]);
                        $newfilename = substr(microtime(), 2, 7) . '.' .end($temp);
                        $ori_src="uploads/".$_FILES['file_xls']['name'];
                        if(move_uploaded_file($_FILES["file_xls"]["tmp_name"],$target_dir.$newfilename))
                            {chmod("$ori_src",0777);}
                            else
                            {echo "Gagal melakukan proses upload file.";
                            exit;}
                            $nama_foto = $newfilename;
                              
                    $sql_upload="INSERT INTO r_upload_absensi "
                                    . "(r_upload__cabang,"
                                    . "r_upload__user,"
                                    . "r_upload__filename,"
                                    . "r_upload__date_created,"
                                    . "r_upload__user_created,"
                                    . "r_upload__date_updated,"
                                    . "r_upload__user_updated)"
                                    . "  VALUES ('$kode_cabang',"
                                    . "'$id_peg',"
                                    . "'$nama_foto',"
                                    . "now(),"
                                    . "'$id_peg',"
                                    . "now(),"
                                    . "'$id_peg') ";
                       
                                    $db->Execute($sql_upload);         
  Header("Location:index_cek.php?ERR=2&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);                   
      }   
elseif($tipe_file==2 and $file_ext=='dat') //upload_secure_data 
  {
                        ini_set("memory_limit","1024M");
                        $target_dir ='./uploads/';
                        $temp = explode(".",$_FILES["file_xls"]["name"]);
                        $newfilename = substr(microtime(), 2, 7) . '.' .end($temp);
                        $ori_src="uploads/".$_FILES['file_xls']['name'];
                        if(move_uploaded_file($_FILES["file_xls"]["tmp_name"],$target_dir.$newfilename))
                            {chmod("$ori_src",0777);}
                            else
                            {echo "Gagal melakukan proses upload file.";
                            exit;}
                            $nama_foto = $newfilename;
                         //  var_dump($nama_foto)or die();
                         
            move_uploaded_file($file_tmp,"uploads/".$nama_foto);
		
		$fp = fopen("uploads/".$nama_foto, 'r');
		while ( ($line = fgets($fp)) !== false) 
		{
			$arr = explode("\t",$line);
			$idFinger =$arr[0];
			$waktu_absen = $arr[1];
			$test1 = DateTime::createFromFormat('Y-m-d H:i:s',$waktu_absen);
			$data_finger = preg_replace('/[ ]{2,}|[\t]/', ' ', trim($idFinger));
			
			$cek_str_finger=strlen($data_finger);
		
			if($cek_str_finger==6)
			{
					$finger=$data_finger;
			}else
			{
				
                                        $finger='00'.$data_finger;
			}

                     $date = date('Y-m-d', strtotime($waktu_absen));
                     $time = date('H:i:s', strtotime($waktu_absen));
             
            
             $CekFingerPrint="SELECT
                        A.r_shift__jam_masuk AS r_shift__jam_masuk,
                        A.r_shift__jam_pulang AS r_shift__jam_pulang,
                        A.r_shift__jml_jam AS r_shift__jml_jam,
                        A.r_shift__id AS r_shift__id
                        FROM
                        r_shift A
                        INNER JOIN r_penempatan B ON B.r_pnpt__shift=A.r_shift__id
                        WHERE B.r_pnpt__finger_print=$finger";
           
            // var_dump($CekFingerPrint)or die();
        $rs_val = $db->Execute($CekFingerPrint);
        $rule_jam_masuk= $rs_val->fields['r_shift__jam_masuk'];
        $rule_jam_keluar= $rs_val->fields['r_shift__jam_pulang'];
        $rule_jam_total= $rs_val->fields['r_shift__jml_jam'];
        $rule_shift= $rs_val->fields['r_shift__id'];
            
      
        
        $sql_cek="SELECT A.t_abs__fingerprint AS t_abs__fingerprint,"
            . " A.t_abs__tgl AS t_abs__tgl,"
            . " A.t_abs__jam_masuk AS t_abs__jam_masuk,"
            . " A.t_abs__jam_keluar AS t_abs__jam_keluar, "
            . " A.t_abs__status AS t_abs__status,"
            . " A.t_abs__worktime AS worktime "
            . " FROM t_absensi A "
            . " where A.t_abs__fingerprint='$finger' "
            . " AND A.t_abs__tgl>='$periode_awal' AND A.t_abs__tgl <= '$periode_akhir'"
            . " AND A.t_abs__tgl='$date' ";
            $rs_val = $db->Execute($sql_cek);
            $finger_cek= $rs_val->fields['t_abs__fingerprint'];
            $tgl_cek = $rs_val->fields['t_abs__tgl'];
            $status_cek= $rs_val->fields['t_abs__status'];
            $jam_msk_cek=$rs_val->fields['t_abs__jam_masuk'];
            $jam_keluar_cek=$rs_val->fields['t_abs__jam_keluar'];
             $worktime_cek=$rs_val->fields['worktime'];
         
           
   if (($date>=$periode_awal and $date<=$periode_akhir) AND ($tgl_cek=='')AND ($time<=$rule_jam_masuk))  
    {
     
          $sql = "INSERT INTO $tbl_name("
                  . "t_abs__fingerprint,"
                  . " t_abs__tgl,"
                  . " t_abs__id_shift,"
                  . " t_abs__jam_masuk,"
                  . " t_abs__jam_keluar, "
                  . "t_abs__early,"
                  . " t_abs__lately, "
                  . "t_abs__approval,"
                  . " t_abs__lesstime,"
                  . " t_abs__overtime, "
                  . "t_abs__worktime, "
                  . "t_abs__status,"
                  . " t_abs__catatan, "
                  . "t_abs__date_created, "
                  . "t_abs__date_updated, "
                  . "t_abs__user_created, "
                  . "t_abs__user_updated) "
                  . "VALUES "
                    . "('$finger',"
                    . "'$date',"
                    . "'$rule_shift',"
                    . "'$time',"
                    . "'$time',"
                    . "'',"
                    . "'',"
                    . "'',"
                    . "'',"
                    . "'',"
                    . "'',"
                    . "'',"
                    . "'',"
                    . "now(),"
                    . "now(),"
                    . "'1',"
                    . "'1')";

                  $db->Execute($sql);
                            
           
        }
      
        elseif(($date>=$periode_awal and $date<=$periode_akhir) AND ($tgl_cek=='') AND ($time>=$rule_jam_masuk))
        {
                 
            $sql = "INSERT INTO $tbl_name("
                  . "t_abs__fingerprint,"
                  . " t_abs__tgl,"
                  . " t_abs__id_shift,"
                  . " t_abs__jam_masuk,"
                  . " t_abs__jam_keluar, "
                  . "t_abs__early,"
                  . " t_abs__lately, "
                  . "t_abs__approval,"
                  . " t_abs__lesstime,"
                  . " t_abs__overtime, "
                  . "t_abs__worktime, "
                  . "t_abs__status,"
                  . " t_abs__catatan, "
                  . "t_abs__date_created, "
                  . "t_abs__date_updated, "
                  . "t_abs__user_created, "
                  . "t_abs__user_updated) "
                  . "VALUES "
                    . "('$finger',"
                    . "'$date',"
                    . "'$rule_shift',"
                    . "'$time',"
                    . "'$time',"
                    . "'',"
                    . "'',"
                    . "'',"
                    . "'',"
                    . "'',"
                    . "'',"
                    . "'',"
                    . "'',"
                    . "now(),"
                    . "now(),"
                    . "'1',"
                    . "'1')";

                  $db->Execute($sql);           
        }
                             
      elseif($finger_cek!='' && $tgl_cek!='')
      {
            
        if($time<$jam_msk_cek && $rule_shift<6) // format satu ubah jam masuk 
          {
                 
       
                  //EARLY
                IF($time<$rule_jam_masuk)
                    {
               
                        $t3=$rule_jam_masuk;
                        $t4=$time;
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
                    else
                    {
                         $result = "00:00:00";
                         $early_time = $result;

                    }
                  
                    //TERLAMBAT LATELY
                    IF($time>$rule_jam_masuk)
                    {
                    $t1=$rule_jam_masuk;
                    $t2=$time;
                    $a1 = explode(":",$t1);
                    $a2 = explode(":",$t2);
                    $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                    $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                    $diff = abs($time2-$time1);
                    $hours = floor($diff/(60*60));
                    $mins = floor(($diff-($hours*60*60))/(60));
                    $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                    $result = $hours.":".$mins.":".$secs;
                    $keterlambatan = $result;
                     }
                    else
                    {
                               $result = "00:00:00";
                               $keterlambatan = $result;

                    }
              
                         
                      
                    //worktime total kerja
                    IF($time!='')
                       {
                                  $t1=$jam_msk_cek;
                                  $t2=$time;
                                  $a1 = explode(":",$t1);
                                  $a2 = explode(":",$t2);
                                  $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                                  $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                                  $diff = abs($time1-$time2);
                                  $hours = floor($diff/(60*60));
                                  $mins = floor(($diff-($hours*60*60))/(60));
                                  $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                                  $result = ($hours-1).":".$mins.":".$secs;
                                  $total_kerja = $result;

                        }
                       else
                       {

                                          $result = "00:00:00";
                                          $total_kerja = $result;

                       }
                            
                       
                        
                            // OVERTIME
                                       $t1_over= $rule_jam_total;
                                       $t2_over= $total_kerja;
 
                                        $a1 = explode(":",$t1_over);
                                        $a2 = explode(":",$t2_over);

                                    if($a2>$a1)
                                  
                                       {
                                           $t1= $rule_jam_total;
                                           $t2= $total_kerja;
                                           $a1 = explode(":",$t1);
                                           $a2 = explode(":",$t2);
                                           $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                                           $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                                           $diff = abs($time1-$time2);
                                           $hours = floor($diff/(60*60));
                                           $mins = floor(($diff-($hours*60*60))/(60));
                                           $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                                           $result = $hours.":".$mins.":".$secs;
                                           $overtime = $result;
                                       }
                                    else
                                       {
                                           $result='00:00:00';
                                           $overtime = $result;
                                       }
                               
     
                                    // LESSTIME
                                      $t1_less= $rule_jam_total;
                                      $t2_less= $total_kerja;
                                       
                                       $a1 = explode(":",$t1_less);
                                       $a2 = explode(":",$t2_less);

                                  if($a2<$a1)
                                      {
                                          $t1= $rule_jam_total;
                                          $t2= $total_kerja;
                                          $a1 = explode(":",$t1);
                                          $a2 = explode(":",$t2);
                                          $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                                          $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                                          $diff = abs($time1-$time2);
                                          $hours = floor($diff/(60*60));
                                          $mins = floor(($diff-($hours*60*60))/(60));
                                          $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                                          $result = $hours.":".$mins.":".$secs;
                                          $lesstime = $result;
                                      }
                                   else
                                      {
                                          $result='00:00:00';
                                          $lesstime = $result;
                                      }
                                  
              
                                      
                                IF($total_kerja!='')
                                    {
                                        $status='1';
                                    }
                                    else
                                    {
                                        $status='0';
                                    }
                                    
                                    
                         $sql_edit  ="UPDATE $tbl_name";
                        $sql_edit .=" SET t_abs__fingerprint ='$finger', ";
                        $sql_edit .= " t_abs__tgl ='$date',";
                        $sql_edit .= " t_abs__id_shift = '$rule_shift',";
                        $sql_edit .= " t_abs__jam_masuk = '$time',";
                        $sql_edit .= " t_abs__jam_keluar = '$jam_keluar_cek',";
                        $sql_edit .= " t_abs__early = '$early_time',";
                        $sql_edit .= " t_abs__lately = '$keterlambatan',";
                        $sql_edit .= " t_abs__approval = '',";
                        $sql_edit .= " t_abs__lesstime ='$lesstime',";
                        $sql_edit .= " t_abs__overtime= '$overtime',";
                        $sql_edit .= " t_abs__worktime ='$total_kerja',";
                        $sql_edit .= " t_abs__status= '$status',";
                        $sql_edit .= " t_abs__catatan= '',";
                        $sql_edit .= " t_abs__date_created = now(),";
                        $sql_edit .= " t_abs__date_updated =now(),";
                        $sql_edit .= " t_abs__user_created = '1',";
                        $sql_edit .= " t_abs__user_updated = '1'";
                        $sql_edit .="  WHERE  t_abs__fingerprint='$finger' AND t_abs__tgl ='$date'";
                        
                        $sqlresult5 = $db->Execute($sql_edit);
                     }
 
           elseif($time>$jam_msk_cek && $rule_shift<6) 
              {
             
          
                 //EARLY
                IF($jam_msk_cek<$rule_jam_masuk)
                    {
                          
                        $t3=$rule_jam_masuk;
                        $t4=$jam_msk_cek;
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
                    else
                    {
                         $result = "00:00:00";
                         $early_time = $result;

                    }
                  
                    //TERLAMBAT LATELY
                        IF($jam_msk_cek>$rule_jam_masuk)
                        {
                            
                            
                               $t1=$rule_jam_masuk;
                               $t2=$jam_msk_cek;
                               $a1 = explode(":",$t1);
                               $a2 = explode(":",$t2);
                               $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                               $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                               $diff = abs($time2-$time1);
                               $hours = floor($diff/(60*60));
                               $mins = floor(($diff-($hours*60*60))/(60));
                               $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                               $result = $hours.":".$mins.":".$secs;
                               $keterlambatan = $result;


                                }
                               else
                               {
                                          $result = "00:00:00";
                                          $keterlambatan = $result;

                               }
              
                         
                         
                        //worktime total kerja
                                    IF($time!='')
                                       {
                                                  $t1=$jam_msk_cek;
                                                  $t2=$time;
                                                  $a1 = explode(":",$t1);
                                                  $a2 = explode(":",$t2);
                                                  $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                                                  $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                                                  $diff = abs($time1-$time2);
                                                  $hours = floor($diff/(60*60));
                                                  $mins = floor(($diff-($hours*60*60))/(60));
                                                  $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                                                  $result = ($hours-1).":".$mins.":".$secs;
                                                  $total_kerja = $result;
                                                  if($total_kerja<0)
                                       {
                                           
                                           $total_kerja='00:00:00';
                                       } 

                                        }
                                       else
                                       {

                                        $result = "00:00:00";
                                        $total_kerja = $result;

                                       }
                                       
                                       
                                       
                                       
                                       
                            // OVERTIME
                                    $t1_over= $rule_jam_total;
                                    $t2_over= $total_kerja;
                                                                    

                                    $a1 = explode(":",$t1_over);
                                    $a2 = explode(":",$t2_over);
                               
                                IF($a2>$a1)
                                       {
                                           $t1= $rule_jam_total;
                                           $t2= $total_kerja;
                                           $a1 = explode(":",$t1);
                                           $a2 = explode(":",$t2);
                                           $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                                           $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                                           $diff = abs($time1-$time2);
                                           $hours = floor($diff/(60*60));
                                           $mins = floor(($diff-($hours*60*60))/(60));
                                           $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                                           $result = $hours.":".$mins.":".$secs;
                                           $overtime = $result;
                                       }
                                    else
                                       {
                                           $result='00:00:00';
                                           $overtime = $result;
                                       }
    
                                     // var_dump($total_kerja.'tk-rule'.$rule_jam_total)or die();
                                    // LESSTIME
                                      $t1_less= $rule_jam_total;
                                      $t2_less= $total_kerja;

                                        $a1 = explode(":",$t1_less);
                                        $a2 = explode(":",$t2_less);

                                    if($a2<$a1)
                                 // if($t2_less<$t1_less)
                                      {
                                          $t1= $rule_jam_total;
                                          $t2= $total_kerja;
                                          $a1 = explode(":",$t1);
                                          $a2 = explode(":",$t2);
                                          $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                                          $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                                          $diff = abs($time1-$time2);
                                          $hours = floor($diff/(60*60));
                                          $mins = floor(($diff-($hours*60*60))/(60));
                                          $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                                          $result = $hours.":".$mins.":".$secs;
                                          $lesstime = $result;
                                      }
                                   else
                                      {
                                          $result='00:00:00';
                                          $lesstime = $result;
                                      }
                                
                                     
                                 //     var_dump($lesstime)or die();
                                IF($total_kerja>0)
                                    {
                                        $status='1';
                                    }
                                    else
                                    {
                                        $status='0';
                                    }
                      
                                    
                        $sql_edit  ="UPDATE $tbl_name";
                        $sql_edit .=" SET t_abs__fingerprint ='$finger', ";
                        $sql_edit .= " t_abs__tgl ='$date',";
                        $sql_edit .= " t_abs__id_shift = '$rule_shift',";
                        $sql_edit .= " t_abs__jam_masuk = '$jam_msk_cek',";
                        $sql_edit .= " t_abs__jam_keluar = '$time',";
                        $sql_edit .= " t_abs__early = '$early_time',";
                        $sql_edit .= " t_abs__lately = '$keterlambatan',";
                        $sql_edit .= " t_abs__approval = '',";
                        $sql_edit .= " t_abs__lesstime ='$lesstime',";
                        $sql_edit .= " t_abs__overtime= '$overtime',";
                        $sql_edit .= " t_abs__worktime ='$total_kerja',";
                        $sql_edit .= " t_abs__status= '$status',";
                        $sql_edit .= " t_abs__catatan= '',";
                        $sql_edit .= " t_abs__date_created = now(),";
                        $sql_edit .= " t_abs__date_updated =now(),";
                        $sql_edit .= " t_abs__user_created = '1',";
                        $sql_edit .= " t_abs__user_updated = '1'";
                        $sql_edit .="  WHERE  t_abs__fingerprint='$finger' AND t_abs__tgl ='$date'";
                      
                        $sqlresult5 = $db->Execute($sql_edit);
                     }
                     
                    elseif($time>$jam_msk_cek && $rule_shift>=6)//shift_enam
                        {
                        // var_dump($time)or die();
                 //EARLY
                IF($jam_msk_cek<$rule_jam_masuk)
                    {
                          
                        $t3=$rule_jam_masuk;
                        $t4=$jam_msk_cek;
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
                    else
                    {
                         $result = "00:00:00";
                         $early_time = $result;

                    }
                   
                    //TERLAMBAT LATELY
                        IF($jam_msk_cek>$rule_jam_masuk)
                        {
                            
                            
                               $t1=$rule_jam_masuk;
                               $t2=$jam_msk_cek;
                               $a1 = explode(":",$t1);
                               $a2 = explode(":",$t2);
                               $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                               $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                               $diff = abs($time2-$time1);
                               $hours = floor($diff/(60*60));
                               $mins = floor(($diff-($hours*60*60))/(60));
                               $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                               $result = $hours.":".$mins.":".$secs;
                               $keterlambatan = $result;


                                }
                               else
                               {
                                          $result = "00:00:00";
                                          $keterlambatan = $result;

                               }
              
                         
                         
                        //worktime total kerja
                                    IF($time!='')
                                       {
                                                  $t1=$jam_msk_cek;
                                                  $t2=$time;
                                                  $a1 = explode(":",$t1);
                                                  $a2 = explode(":",$t2);
                                                  $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                                                  $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                                                  $diff = abs($time1-$time2);
                                                  $hours = floor($diff/(60*60));
                                                  $mins = floor(($diff-($hours*60*60))/(60));
                                                  $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                                                  $result = ($hours-1).":".$mins.":".$secs;
                                                  $total_kerja = $result;
                                                  if($total_kerja<0)
                                       {
                                           
                                           $total_kerja='00:00:00';
                                       } 




                                        }
                                       else
                                       {

                                                          $result = "00:00:00";
                                                          $total_kerja = $result;

                                       }
                                       
                                       
                                       
                                       
                                       
                            // OVERTIME
                                    $t1_over= $rule_jam_total;
                                    $t2_over= $total_kerja;
                                                                    

                                    $a1 = explode(":",$t1_over);
                                    $a2 = explode(":",$t2_over);
                                //    var_dump(10>1)or die();
                                        if($a2>$a1)
                                //   if($t2_over>$t1_over)
                                       {
                                           $t1= $rule_jam_total;
                                           $t2= $total_kerja;
                                           $a1 = explode(":",$t1);
                                           $a2 = explode(":",$t2);
                                           $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                                           $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                                           $diff = abs($time1-$time2);
                                           $hours = floor($diff/(60*60));
                                           $mins = floor(($diff-($hours*60*60))/(60));
                                           $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                                           $result = $hours.":".$mins.":".$secs;
                                           $overtime = $result;
                                       }
                                    else
                                       {
                                           $result='00:00:00';
                                           $overtime = $result;
                                       }
    
                                     // var_dump($total_kerja.'tk-rule'.$rule_jam_total)or die();
                                    // LESSTIME
                                      $t1_less= $rule_jam_total;
                                      $t2_less= $total_kerja;

                                        $a1 = explode(":",$t1_less);
                                        $a2 = explode(":",$t2_less);

                                    if($a2<$a1)
                                 // if($t2_less<$t1_less)
                                      {
                                          $t1= $rule_jam_total;
                                          $t2= $total_kerja;
                                          $a1 = explode(":",$t1);
                                          $a2 = explode(":",$t2);
                                          $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
                                          $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
                                          $diff = abs($time1-$time2);
                                          $hours = floor($diff/(60*60));
                                          $mins = floor(($diff-($hours*60*60))/(60));
                                          $secs = floor(($diff-(($hours*60*60)+($mins*60))));
                                          $result = $hours.":".$mins.":".$secs;
                                          $lesstime = $result;
                                      }
                                   else
                                      {
                                          $result='00:00:00';
                                          $lesstime = $result;
                                      }
                                
                                     
                                 //     var_dump($lesstime)or die();
                                IF($total_kerja>0)
                                    {
                                        $status='1';
                                    }
                                    else
                                    {
                                        $status='0';
                                    }
                      
                                    
                        $sql_edit  ="UPDATE $tbl_name";
                        $sql_edit .=" SET t_abs__fingerprint ='$finger', ";
                        $sql_edit .= " t_abs__tgl ='$date',";
                        $sql_edit .= " t_abs__id_shift = '$rule_shift',";
                        $sql_edit .= " t_abs__jam_masuk = '$time',";
                        $sql_edit .= " t_abs__jam_keluar = '$jam_msk_cek',";
                        $sql_edit .= " t_abs__early = '$early_time',";
                        $sql_edit .= " t_abs__lately = '$keterlambatan',";
                        $sql_edit .= " t_abs__approval = '',";
                        $sql_edit .= " t_abs__lesstime ='$lesstime',";
                        $sql_edit .= " t_abs__overtime= '$overtime',";
                        $sql_edit .= " t_abs__worktime ='$total_kerja',";
                        $sql_edit .= " t_abs__status= '$status',";
                        $sql_edit .= " t_abs__catatan= '',";
                        $sql_edit .= " t_abs__date_created = now(),";
                        $sql_edit .= " t_abs__date_updated =now(),";
                        $sql_edit .= " t_abs__user_created = '1',";
                        $sql_edit .= " t_abs__user_updated = '1'";
                        $sql_edit .="  WHERE  t_abs__fingerprint='$finger' AND t_abs__tgl ='$date'";
                      
                        $sqlresult5 = $db->Execute($sql_edit);
                     }
                     elseif($finger==$finger_cek && $date==$tgl_cek && $worktime_cek<0)
                     {
                         
                     
                         $sql211 = "UPDATE $tbl_name set "
                            . " t_abs__lesstime = '00:00:00',"
                            . " t_abs__overtime = '00:00:00',"
                            . " t_abs__worktime = '00:00:00',"
                            . " t_abs__status = '0'"
                            . " WHERE t_abs__fingerprint='$finger' AND t_abs__tgl='$date' ";
              
                   
                            $db->Execute($sql211);  
                     }
                        
                    
        }  

             }
                       
 $sql_upload="INSERT INTO r_upload_absensi "
                                            . "(r_upload__cabang,"
                                            . "r_upload__user,"
                                            . "r_upload__filename,"
                                            . "r_upload__date_created,"
                                            . "r_upload__user_created,"
                                            . "r_upload__date_updated,"
                                            . "r_upload__user_updated)"
                                    . "  VALUES ('$kode_cabang',"
                                    . "'$id_peg',"
                                    . "'$nama_foto',"
                                    . "now(),"
                                    . "'$id_peg',"
                                    . "now(),"
                                    . "'$id_peg') ";
                      //  var_dump($sql_upload)or die();
                                    $db->Execute($sql_upload);         
    Header("Location:index_cek.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
    
    
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
            //unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
}


}
?>

