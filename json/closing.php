<?PHP
header("Content-Type: application/json;charset=utf-8");
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	require_once('../includes/config.conf.php');

	# Create a session to store global config path
	session_save_path($DIR_SESS);
	session_set_cookie_params($expiry);
	session_start();

	//if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
	//	require_once('../includes/header.redirect.inc');
	//}else{
	// }
	 
	 require_once('../includes/db.conf.php');
	 require_once('../adodb/adodb.inc.php');
	 require_once('../includes/config.conf.php');
	 
	//$p = new Pager; 
	$db = &ADONewConnection($DB_TYPE);
	// $db->debug = true;
	$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
	$awal2= $_POST['awal'];
	$akhir2= $_POST['akhir'];
        
        $awal_next= $_POST['awalnext'];
	$akhir_next= $_POST['akhirnext'];
        $kunci2= $_POST['kunci'];

        $next_int=strtotime($awal_next);
        $akhir_int=strtotime($akhir_next);
        //$today=date('Y-m-d');
        $today='2016-01-09';
        $int_today=strtotime($today);
        
       // var_dump('2017-01-20'<'2017-01-20')or die();
        
        

        $tbl_name	= "t_rekap_absensi";
  
if($akhir_next<$today)
{
 
    exit();
    
}    
    
else
{
   
  
    if($awal2!='' and $akhir2!='')
    {
      
        begin();
        $sql1  =" UPDATE $tbl_name SET ";
        $sql1 .=" t_rkp__approval='4'";
        $sql1 .=" WHERE t_rkp__awal>='$awal2' and t_rkp__akhir<='$akhir2' AND t_rkp__approval ='3' ";
        $sqlresult = $db->Execute($sql1);
        commit();
    }  else {
      
        rollback();
      
    }
     
        $cek_periode="SELECT
        r_periode__payroll_id,r_periode__payroll_awal,r_periode__payroll_akhir,r_periode__payroll_status
        FROM
        r_periode_payroll where  r_periode__payroll_awal='$awal_next' AND  r_periode__payroll_akhir='$akhir_next'";
          
 
     
        $rs_val = $db->Execute($cek_periode);
        $periode_aktif= $rs_val->fields["r_periode__payroll_id"];
        $awal_aktif= $rs_val->fields["r_periode__payroll_awal"];
        $akhir_aktif= $rs_val->fields["r_periode__payroll_akhir"];
           
                 
        $sql_edit_periode  =" UPDATE r_periode_payroll SET ";
        $sql_edit_periode .=" r_periode__payroll_status='0'";
        $sql_edit_periode .=" WHERE r_periode__payroll_status='1'";
        $sqlresult  = $db->Execute($sql_edit_periode);

        
        if($awal_aktif=='' && $akhir_aktif=='' ) 
            {
         
                      
                                    $sql_in= "INSERT INTO r_periode_payroll ("
                                          
                                            . "r_periode__payroll_awal, "
                                            . "r_periode__payroll_akhir,"
                                            . "r_periode__payroll_status,"
                                            . "r_periode__payroll_created,"
                                            . "r_periode__payroll_user_created,"
                                            . "r_periode__payroll_updated,"
                                            . "r_periode__payroll_user_updated)";
                                    
                                $sql_in	.= " VALUES ("
                                            . "'$awal_next',"
                                            . "'$akhir_next',"
                                            . "'1',"
                                            . "now(),"
                                            . "101,"
                                            . "now(),"
                                            . "101)";
                                           
                                            $sqlresult = $db->Execute($sql_in); 
                
                }  else {
                                    $sql_edit_periode  =" UPDATE r_periode_payroll SET ";
                                    $sql_edit_periode .=" r_periode__payroll_status='1',"
                                                        . "r_periode__payroll_created=now(),"
                                                        . "r_periode__payroll_user_created='101',"
                                                        . "r_periode__payroll_updated=now(),"
                                                        . "r_periode__payroll_user_updated='101'";
                                    
                                    
                                    $sql_edit_periode .=" WHERE r_periode__payroll_awal='$awal_next' and r_periode__payroll_akhir='$akhir_next'";
                                   
                                    $sqlresult  = $db->Execute($sql_edit_periode);
                    
                }
        
        
        
    
      
	}
}
?>

