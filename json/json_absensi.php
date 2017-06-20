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
if(isset($_POST['json'])){
 $data = json_decode($_POST['json'],true);

}

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

foreach ($data as $key => $val)
{
	$finger=$val['finger'];
        $in = $val['in_start'];
        $out = $val['out_end'];

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


         $sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_bulan,r_periode__payroll_tahun,r_periode__payroll_status "
                 . "FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
        $rs_val = $db->Execute($sql_cek_periode);
        $periode_bulan_aktif= $rs_val->fields['r_periode__payroll_bulan'];
        $periode_tahun_aktif= $rs_val->fields['r_periode__payroll_tahun'];


        //cari shift
         $CekFingerPrint="SELECT
                                A.r_shift__jam_masuk AS r_shift__jam_masuk,
                                A.r_shift__jam_pulang AS r_shift__jam_pulang,
                                A.r_shift__jml_jam AS r_shift__jml_jam,
                                A.r_shift__id AS r_shift__id,
                                B.r_pnpt__finger_print AS r_pnpt__finger_print
                                FROM
                                r_shift A
                                INNER JOIN r_penempatan B ON B.r_pnpt__shift=A.r_shift__id
                                WHERE B.r_pnpt__finger_print='$finger'";
                $rs_val = $db->Execute($CekFingerPrint);
                $rule_jam_masuk= $rs_val->fields['r_shift__jam_masuk'];
                $rule_jam_keluar= $rs_val->fields['r_shift__jam_pulang'];
                $rule_jam_total= $rs_val->fields['r_shift__jml_jam'];
                $rule_jam_shift= $rs_val->fields['r_shift__id'];
                $rule_finger=$rs_val->fields['r_pnpt__finger_print'];



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


$sql_cek="SELECT * FROM $tbl_name A where A.t_abs__fingerprint='$finger' AND A.t_abs__tgl='$tgl2__out'";

$rs_val = $db->Execute($sql_cek);
$cek_finger = $rs_val->fields['t_abs__fingerprint'];
$cek_tgl = $rs_val->fields['t_abs__tgl'];
                 
                   
    
if (($tahun1!=$periode_tahun_aktif) OR ($bulan1!=$periode_bulan_aktif AND $rule_jam_shift==''))
    {

        echo 'Salah';
header("Location:http://localhost/hris/json/form.php");
    }
    elseif ($cek_tgl==$tgl2__out AND $cek_finger==$finger AND $tahun1==$periode_tahun_aktif AND $bulan1==$periode_bulan_aktif )
	{

    $sql_edit  ="UPDATE $tbl_name";
                    $sql_edit .=" SET t_abs__fingerprint ='$finger', ";
                    $sql_edit .= " t_abs__tgl ='$tgl2__out',";
                    $sql_edit .= " t_abs__id_shift = '$rule_jam_shift',";
                    $sql_edit .= " t_abs__jam_masuk = '$t1_time_start',";
                    $sql_edit .= " t_abs__jam_keluar = '$t2_time_end',";
                    $sql_edit .= " t_abs__early = '$early_time',";
                    $sql_edit .= " t_abs__lately = '$keterlambatan',";
                    $sql_edit .= " t_abs__approval = '',";
                    $sql_edit .= " t_abs__lesstime ='$lesstime',";
                    $sql_edit .= " t_abs__overtime= '$overtime',";
                    $sql_edit .= " t_abs__worktime ='$work_time',";
                    $sql_edit .= " t_abs__status= '$status',";
                    $sql_edit .= " t_abs__catatan= '',";
                    $sql_edit .= " t_abs__date_created = now(),";
                    $sql_edit .= " t_abs__date_updated =now(),";
                    $sql_edit .= " t_abs__user_created = '1',";
                    $sql_edit .= "t_abs__user_updated = '1'";
                    $sql_edit .="  WHERE  t_abs__fingerprint='$finger' AND t_abs__tgl ='$tgl2__out' ";
                  
                    $sqlresult5 = $db->Execute($sql_edit);
                     header("Location:http://localhost/hris/json/form.php");
			
	}
    elseif ($cek_tgl=='' AND $cek_finger=='' AND $rule_jam_shift!='' )
    {
        $sql = "INSERT INTO $tbl_name(t_abs__fingerprint, t_abs__tgl, t_abs__id_shift, t_abs__jam_masuk, t_abs__jam_keluar, t_abs__early, t_abs__lately, t_abs__approval, t_abs__lesstime, t_abs__overtime, t_abs__worktime, t_abs__status, t_abs__catatan, t_abs__date_created, t_abs__date_updated, t_abs__user_created, t_abs__user_updated) VALUES "
                                 . "('$finger',"
                                 . "'$tgl2__out',"
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
       header("Location:http://localhost/hris/json/form.php");

    }

        

}

?>
