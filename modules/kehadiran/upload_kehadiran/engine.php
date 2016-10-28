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
$today = date("Y-m-d h:i:s");

$now= date("Y-m-d");
$kode_cabang = addslashes($_POST[kode_cabang]);
$tanggal_upload = $now;


        error_reporting(E_ALL ^ E_NOTICE);
        error_reporting(0);
      //  ini_set("display_errors",1);
      ini_set("memory_limit","1024M");
        //init_set("allow_url_fopen is on");

         //tes_import
    if($_FILES['file_xls']['name'] !="")
{ 
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
                        //$t_abs__early = ($t_abs__jam_masuk<$ruleJamMasuk)?($ruleJamMasuk-$t_abs__jam_masuk):(0);
                        //$t_abs__lately= ($t_abs__jam_masuk>$ruleJamMasuk)?($t_abs__jam_masuk-$ruleJamMasuk):(0);
                        $t_abs__approval= $data->val($i,8);
                        $t_abs__lesstime = $data->val($i,9);
                        $t_abs__overtime = $data->val($i,10);
                        $t_abs__worktime = $data->val($i,11);
                        $t_abs__status = $data->val($i,12);
                        $t_abs__catatan = $data->val($i,13);
                        $t_abs__date_created = $data->val($i,14);
                        $t_abs__date_updated = $data->val($i,15);
                        $t_abs__user_created= Date('Y-m-d H:i:s');
                        $t_abs__user_updated = Date('Y-m-d H:i:s');
                        
                $sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_bulan,r_periode__payroll_tahun,r_periode__payroll_status
                                  FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";                 
                $rs_val = $db->Execute($sql_cek_periode);
                $periode_bulan= $rs_val->fields['r_periode__payroll_bulan'];
                $periode_tahun= $rs_val->fields['r_periode__payroll_tahun'];        
                    
//                $CekFingerPrint="SELECT A.r_shift__jam_masuk AS r_shift__jam_masuk, A.r_shift__jam_pulang AS r_shift__jam_pulang, A.r_shift__jml_jam AS r_shift__jml_jam, A.r_shift__id AS r_shift__id FROM r_shift A, r_penempatan B,t_libur L WHERE A.r_shift__id = B.r_pnpt__shift AND B.r_pnpt__finger_print = '".$t_abs__fingerprint."'"
//                    . "AND  YEAR(L.r_libur__tgl)='$periode_tahun' AND MONTH(L.r_libur__tgl)='$periode_bulan'";
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
                            
                        
                            
                            IF($t_abs__jam_masuk!='')
                            {
                                
                              $t_abs__jam_masuk2=$t_abs__jam_masuk;
                                
                            }
                                  elseif   ($t_abs__jam_masuk =='00:00:00' )
                            {
                                
                                $t_abs__jam_masuk2='-:-:-';
                                
                                
                            }
                            else
                            {
                                
                                 $t_abs__jam_masuk2='-:-:-';
                                
                            }
                            
                            
                            
                             IF($t_abs__jam_keluar!='')
                            {
                                $t_abs__jam_keluar2=$t_abs__jam_keluar;
                              
                               
                            }
                                  elseif   ($t_abs__jam_keluar =='' )
                            {
                                
                                $t_abs__jam_keluar2='-:-:-';
                                
                                
                            }
                            else
                            {
                                
                                 $t_abs__jam_masuk2='-:-:-';
                                
                            }
                         
                            
                            IF($t_abs__jam_masuk2!='' && $t_abs__jam_keluar2!='' )
                            {
                                 
                        
                                if($rule_jam_shift<=4)
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
                                  $result_split = $hours.":".$mins.":".$secs;
                                  
                                    
                                  $split1=strtotime($result_split);
                                  $role_split='08:00:00';
                                  $split2=strtotime($role_split);
                                   
                                   
                                
                                  if ($split1>=$split2)
                                  {
                                      $result_split_res='08:00:00';
                                  }  else {
                                      //bila kurang
                                      
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
                                        $result_split_res = $hours.":".$mins.":".$secs;
                                        $total_jam_kerja2 = $result_split_res;
                                      
                                  
                                  }
                                  $total_jam_kerja2 = $result_split_res; 
                                }
                               
                            }
                          
                   
                   
                     IF($total_jam_kerja2 == '00:00:00')
                            {
                                $status='0';
                            }
                            else
                            {
                                $status='1';
                            }
                            
                            
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
                                         // "-";
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
                         
                            
                            
                    $sql_cek="SELECT * FROM t_absensi A where A.t_abs__fingerprint='$t_abs__fingerprint' AND A.t_abs__tgl='$t_abs__tgl'";
                     
                    $rs_val = $db->Execute($sql_cek);
                    $t_abs__fingerprint_update = $rs_val->fields['t_abs__fingerprint'];
                    $t_abs__tgl_update = $rs_val->fields['t_abs__tgl'];
                    
                    
                    
                    $sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_bulan,r_periode__payroll_tahun,r_periode__payroll_status FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
                    $rs_val = $db->Execute($sql_cek_periode);
                    $periode_bulan= $rs_val->fields['r_periode__payroll_bulan'];
                    $periode_tahun= $rs_val->fields['r_periode__payroll_tahun'];  
   
                                $t_abs__tgl = explode('-', $t_abs__tgl);
                                $abs_tahun  = $t_abs__tgl[0];
                                $abs_bulan= $t_abs__tgl[1];
                                $abs_tgl=$t_abs__tgl[2];
                               
                                                          
                                $arr = array($abs_tahun ,$abs_bulan,$abs_tgl);                                 
                                $tgl__input = implode("-",$arr);
                                
                           
                if($abs_tahun!=$periode_tahun OR  $periode_bulan!= $abs_bulan OR $rule_jam_masuk=='' OR $rule_jam_shift=='')
                {
                    Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
                }
                elseif ($t_abs__fingerprint!=$t_abs__fingerprint_update  AND  $t_abs__tgl!=$t_abs__tgl_update AND  $abs_bulan== $periode_bulan AND $abs_tahun==$periode_tahun AND $total_jam_kerja2 != '0:0:0' AND $total_jam_kerja2!='-1:0:0') 
                {
                    $sql = "INSERT INTO t_absensi(t_abs__fingerprint, t_abs__tgl, t_abs__id_shift, t_abs__jam_masuk, t_abs__jam_keluar, t_abs__early, t_abs__lately, t_abs__approval, t_abs__lesstime, t_abs__overtime, t_abs__worktime, t_abs__status, t_abs__catatan, t_abs__date_created, t_abs__date_updated, t_abs__user_created, t_abs__user_updated) VALUES "
                                 . "('$t_abs__fingerprint',"
                                 . "'$tgl__input',"
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
                                 . "'$today',"
                                 . "'',"
                                 . "'$id_peg',"
                                 . "'')";
                        
                            
                                $target_dir ='./uploads/';
                                $target_file = $target_dir.basename($_FILES["file_xls"]["name"],$target_dir);  
                                chmod("$target_file",0777);
                                $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                                // Check if image file is a actual image or fake image
                                $check = getimagesize($_FILES["file_xls"]["tmp_name"]); 
                                if($check !== false) {
                                                    $uploadMessageError = "File is an image - " . $check["mime"] . ".";
                                                    $uploadOk = 1;
                                            } else {
                                                    $uploadMessageError = "File is not an image.";
                                                    $uploadOk = 0;
                                            }        
                                    // Check file size
                                    if ($_FILES["file_xls"]["size"] > 2000000) {
                                            $uploadMessageError = "Sorry, your file is too large.";
                                            $uploadOk = 0;
                                    }
                                // Allow certain file formats
                                if($imageFileType != "jpg" && $imageFileType != "GIF") {
                                        $uploadMessageError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                                        $uploadOk = 0;
                                }

                      
                            if (move_uploaded_file($_FILES["file_xls"]["tmp_name"], $target_file)) {
                                  //  chmod("$target_file",0775);
                                    $uploadMessageError = "The file ". basename($_FILES["file_xls"]["name"]). " has been uploaded.";
                                    $uploadOk=1;
                                    $nama_asli = $_FILES['file_xls']['name'];
                                    $id_peg=     $_SESSION['SESSION_ID_PEG'];
                                    $id_cabang=$_SESSION['SESSION_KODE_CABANG'];
                                    $sql_upload="INSERT INTO r_upload_absensi "
                                            . "(r_upload__cabang,"
                                            . "r_upload__user,"
                                            . "r_upload__filename,"
                                            . "r_upload__date_created,"
                                            . "r_upload__user_created)"
                                    . "  VALUES ('$kode_cabang',"
                                    . "'$id_peg',"
                                    . "'$nama_asli',"
                                    . "now(),"
                                    . "'$id_peg') ";

                                    $db->Execute($sql_upload);

                                     
                      } else {
                                    $uploadMessageError = "Sorry, there was an error uploading your file.";
                                    $uploadOk=0;
                            }
            
                            
				$sqlresult = $db->Execute($sql);
                             
                              
                     }

                    else if ($t_abs__fingerprint==$t_abs__fingerprint_update AND  $tgl__input==$t_abs__tgl_update AND  $abs_bulan== $periode_bulan AND $abs_tahun==$periode_tahun AND $t_abs__status=1) 
                    {
                                 $sql_edit  ="UPDATE t_absensi";
                                 $sql_edit .=" SET t_abs__fingerprint ='$t_abs__fingerprint', ";
                                 $sql_edit .= " t_abs__tgl ='$tgl__input',";
                                 $sql_edit .= " t_abs__id_shift = '$rule_jam_shift',";
                                 $sql_edit .= " t_abs__jam_masuk = '$t_abs__jam_masuk2',";
                                 $sql_edit .= " t_abs__jam_keluar = '$t_abs__jam_keluar2',";
                                 $sql_edit .= " t_abs__early = '$early_time',";
                                 $sql_edit .= " t_abs__lately = '$keterlambatan',";
                                 $sql_edit .= " t_abs__approval = '$t_abs__approval',";
                                 $sql_edit .= " t_abs__lesstime ='$lesstime',";
                                 $sql_edit .= " t_abs__overtime= '$overtime',";
                                 $sql_edit .= " t_abs__worktime ='$total_jam_kerja2',";
                                 $sql_edit .= " t_abs__status= '$t_abs__status',";
                                 $sql_edit .= " t_abs__catatan= '$t_abs__catatan',";
                                 $sql_edit .= " t_abs__date_created = '$t_abs__date_created',";
                                 $sql_edit .= " t_abs__date_updated ='$today',";
                                 $sql_edit .= " t_abs__user_created = '$t_abs__user_created',";
                                 $sql_edit .= "t_abs__user_updated = '$id_peg'";
                                 $sql_edit .="  WHERE  t_abs__fingerprint='$t_abs__fingerprint_update' AND t_abs__tgl ='$t_abs__tgl_update' ";
                                 $sqlresult5 = $db->Execute($sql_edit);
                                 $sql_upload="INSERT INTO r_upload_absensi "
                                            . "(r_upload__cabang,"
                                            . "r_upload__user,"
                                            . "r_upload__filename,"
                                            . "r_upload__date_created,"
                                            . "r_upload__user_created)"
                                    . "  VALUES ('$kode_cabang',"
                                    . "'$id_peg',"
                                    . "'$nama_asli',"
                                    . "now(),"
                                    . "'$id_peg') ";

                                    $db->Execute($sql_upload);
                                     
                               

                } 
              
                
               
                     
      //closeperiode
             
             }          
         
            
       

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

