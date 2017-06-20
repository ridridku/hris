<?PHP
//header("Content-Type: application/json;charset=utf-8");
require_once('../includes/db.conf.php');
require_once('../adodb/adodb.inc.php');
require_once('../includes/config.conf.php');

$db = &ADONewConnection($DB_TYPE);
//$db->debug = true;1800000
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

$tbl_name	= "t_absensi";

$periode2= $_POST['periode'];
$kunci2= $_POST['kunci'];


    $sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_awal,r_periode__payroll_akhir,r_periode__payroll_status "
                 . "FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
        $rs_val = $db->Execute($sql_cek_periode);
        $periode_awal= $rs_val->fields['r_periode__payroll_awal'];
        $periode_akhir= $rs_val->fields['r_periode__payroll_akhir'];






//$image_name=$_FILES['file']['name'];

  if(isset($_FILES['file_absen'])){
      $errors= array();
      $file_name = $_FILES['file_absen']['name'];
      $file_size =$_FILES['file_absen']['size'];
      $file_tmp =$_FILES['file_absen']['tmp_name'];
      $file_type=$_FILES['file_absen']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['file_absen']['name'])));
      
      $expensions= array("dat");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a .dat";
      }
      
      if($file_size > 5097152){
         $errors[]='File size max is 5 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"uploads/".$file_name);
		
		$fp = fopen("uploads/".$file_name, 'r');
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
                        
	
                //      echo $idFinger."-".$waktu_absen."<br>";
                      
                      
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
     //   var_dump('$finger')or die();
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
                //  var_dump('$finger')or die();      
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
            
        if($time<$jam_msk_cek) // format satu ubah jam masuk 
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
                    
                     
                     
           elseif($time>$jam_msk_cek) // format satu ubah jam keluar
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
                      //      $sqlresult4= $db->Execute("TRUNCATE TABLE t_absensi");
                                    
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
                       //   var_dump($sql_edit)or die();
                        $sqlresult5 = $db->Execute($sql_edit);
                     }
                     elseif($finger==$finger_cek && $date==$tgl_cek && $worktime_cek<0)
                     {
                         
                        //  var_dump($worktime_cek>0)or die(); //$finger==$finger_cek && $date==$tgl_cek && 
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


         
     
         
      }else{
         print_r($errors);
      }
   }

    

?>
