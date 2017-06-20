<?PHP
header("Content-Type: application/json;charset=utf-8");
require_once('../includes/db.conf.php');
require_once('../adodb/adodb.inc.php');
require_once('../includes/config.conf.php');

$db = &ADONewConnection($DB_TYPE);
//$db->debug = true;1800000
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

$tbl_name	= "t_absensi";

$periode2= $_POST['periode'];
$kunci2= $_POST['kunci'];

$image_name=$_FILES['file']['name'];

    error_reporting(E_ALL ^ E_NOTICE);
    error_reporting(0);
    ini_set("display_errors",1);
    ini_set("memory_limit","1024M");
    $nama_file=$_FILES['file']['name'] ;
    
    $fh = fopen($_FILES['file']['tmp_name'],'r');
    $baca=$line;   
while ($line = fgets($fh)) 
   {
      $baca=$line;   
      fclose(count($line));
   }   
       
    IF ($_FILES['file']['name'] !="")
        {
                 if ($_FILES['file']['type']!='')
                    {
                        $target_dir ='./uploads/';
                        $temp = explode(".",$_FILES["file"]["name"]);
                        $newfilename = substr(microtime(), 2, 7) . '.' .end($temp);
                        $ori_src="uploads/".$_FILES['file']['name'];
                        if(move_uploaded_file($_FILES["file"]["tmp_name"],$target_dir.$_FILES['file']['name']))

                                         {
                                                 chmod("$ori_src",0777);
                                         }else{
                                                 echo "Gagal melakukan proses upload file.";
                                                 exit;
                                         }
                     }
                     else
                        {
                        echo 'upload gagal salah';
                        }
                
                               
                
                      $sql8= "INSERT INTO r_json_file ("
                                    . "json__name,"
                                    . "json__date_created,"
                                    . "json__date_updated,"
                                    . "json__user_created,"
                                    . "json__user_updated)";
                      
                        $sql8   .= " VALUES ('$nama_file',"
                                . "now(),"
                                . "now(),"
                                . "'1',"
                                . "'1')";
                   
                        $sqlresult8 = $db->Execute($sql8);
            
        }
        
$data = json_decode($baca,true);

//var_dump($baca)or die();
function datediff( $date1, $date2 )
{
    $diff = abs( strtotime( $date1 ) - strtotime( $date2 ) );

    return sprintf
    (
            // "%d Days, %d Hours, %d Mins, %d Seconds",
        "%d,%d,%d,%d",
        intval( $diff / 86400 ),
        intval( ( $diff % 86400 ) / 3600),
        intval( ( $diff / 60 ) % 60 ),
        intval( $diff % 60 )
    );
}
  
     for ($i = 0; $i<count($data); $i++) 
    {
        // var_dump($data[0]['idfingerprint'])or die();
       	$finger=$data[$i]['idfingerprint'];
        $in = $data[$i]['masuk'];
        $out = $data[$i]['keluar'];

  
        
         $t1_tgl = date("Y-m-d",strtotime($in));
        $t1_time = date("h:i:s",strtotime($in));

       
        
        $t2_tgl = date("Y-m-d",strtotime($out));
        $t2_time = date("h:i:s",strtotime($out));

        $tgl_in = explode('-',$t1_tgl);
        $tahun1 = $tgl_in[0];
        $bulan1= $tgl_in[1];
        $tgl1=$tgl_in[2];


        $tgl_out = explode('-',$t2_tgl);
        $tahun2 = $tgl_out[0];
        $bulan2= $tgl_out[1];
        $tgl2=$tgl_out[2];

        $arr_date_in = array($tahun1,$bulan1,$tgl1);
        $tgl1__input = implode("-",$arr_date_in);
        $t1_time_start = date("h:i:s",strtotime($in));

        $arr_date_out = array($tahun2,$bulan2,$tgl2);
        $tgl2__out = implode("-",$arr_date_out);
        $t2_time_end = date("h:i:s",strtotime($out));

        $total_kerja=  datediff($out, $in);
        
        
        
        $arr_work = explode(',',$total_kerja);
        $hari= $arr_work[0];
        $jam= $arr_work[1];
        $menit=$arr_work[2];
        $detik=$arr_work[3];

        $implode_work_time= array($jam-1,$menit,$detik);// breaktime
        $work_time = implode(":",$implode_work_time);


        $CekFingerPrint="SELECT
                        A.r_shift__jam_masuk AS r_shift__jam_masuk,
                        A.r_shift__jam_pulang AS r_shift__jam_pulang,
                        A.r_shift__jml_jam AS r_shift__jml_jam,
                        A.r_shift__id AS r_shift__id
                        FROM
                        r_shift A
                        INNER JOIN r_penempatan B ON B.r_pnpt__shift=A.r_shift__id
                        WHERE B.r_pnpt__finger_print=$finger";

        $rs_val = $db->Execute($CekFingerPrint);
        $rule_jam_masuk= $rs_val->fields['r_shift__jam_masuk'];
        $rule_jam_keluar= $rs_val->fields['r_shift__jam_pulang'];
        $rule_jam_total= $rs_val->fields['r_shift__jml_jam'];
        $rule_jam_shift= $rs_val->fields['r_shift__id'];


         $sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_awal,r_periode__payroll_akhir,r_periode__payroll_status "
                 . "FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
        $rs_val = $db->Execute($sql_cek_periode);
        $periode_awal= $rs_val->fields['r_periode__payroll_awal'];
        $periode_akhir= $rs_val->fields['r_periode__payroll_akhir'];

 //EARLY
IF($t1_time_start<$rule_jam_masuk)
    {

        $t3=$rule_jam_masuk;
        $t4=$t1_time_start;
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
IF($t1_time_start>$rule_jam_masuk)
{
       $t1=$rule_jam_masuk;
       $t2=$t1_time_start;
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
else
{
           $result = "00:00:00";
           $keterlambatan = $result;

}
// LESSTIME
    $t1_less= $rule_jam_total;
    $t2_less= $work_time;

    $a1 = explode(":",$t1_less);
    $a2 = explode(":",$t2_less);

if($a2<$a1)
    {
        $t1= $rule_jam_total;
        $t2= $work_time;
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


// OVERTIME
    $t1_over= $rule_jam_total;
    $t2_over= $work_time;

    $a1 = explode(":",$t1_over);
    $a2 = explode(":",$t2_over);

if($a2>$a1)
    {
        $t1= $rule_jam_total;
        $t2= $work_time;
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


 IF($work_time!='')
    {
        $status='0';
    }
    else
    {
        $status='1';
    }

 $status='1';
 
 
  $sql_cek="SELECT A.t_abs__fingerprint AS t_abs__fingerprint,"
            . " A.t_abs__tgl AS t_abs__tgl,"
            . " A.t_abs__status AS t_abs__status "
            . " FROM t_absensi A "
            . " where A.t_abs__fingerprint='$finger' "
            . " AND A.t_abs__tgl>='$periode_awal' AND A.t_abs__tgl <= '$periode_akhir' ";
            $rs_val = $db->Execute($sql_cek);
            $t_abs__fingerprint_update = $rs_val->fields['t_abs__fingerprint'];
            $t_abs__tgl_update = $rs_val->fields['t_abs__tgl'];
            $t_abs__status_update= $rs_val->fields['t_abs__status'];

            $tgl_input_str=strtotime($tgl1__input);
            $periode_awal_str=  strtotime($periode_awal);
            $periode_akhir_str= strtotime($periode_akhir);
        
      
        
        $sql2 = "delete from t_absensi where t_abs__tgl='$tgl1__input' AND t_abs__fingerprint='$finger' ";
         $db->Execute($sql2);
        $sql = "INSERT INTO $tbl_name(t_abs__fingerprint, t_abs__tgl, t_abs__id_shift, t_abs__jam_masuk, t_abs__jam_keluar, t_abs__early, t_abs__lately, t_abs__approval, t_abs__lesstime, t_abs__overtime, t_abs__worktime, t_abs__status, t_abs__catatan, t_abs__date_created, t_abs__date_updated, t_abs__user_created, t_abs__user_updated) VALUES "
                . "('$finger',"
                . "'$tgl1__input',"
                . "'$rule_jam_shift',"
                . "'$t1_time_start',"
                . "'$t2_time_end',"
                . "'$early_time',"
                . "'$keterlambatan',"
                . "'',"
                . "'$lesstime',"
                . "'$overtime',"
                . "'$work_time',"
                . "$status,"
                . "'',"
                . "now(),"
                . "now(),"
                . "'1',"
                . "'1')";
                $db->Execute($sql);

    }
 
?>
