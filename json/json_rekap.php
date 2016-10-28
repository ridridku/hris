<?PHP
header("Content-Type: application/json;charset=utf-8");
if($_SERVER['REQUEST_METHOD'] == "POST")
{
require_once('../includes/config.conf.php');

# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();

 
 require_once('../includes/db.conf.php');
 require_once('../adodb/adodb.inc.php');
 require_once('../includes/config.conf.php');

 
 
//$p = new Pager; 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
$periode2= $_POST['periode'];
$kunci2= $_POST['kunci'];

$sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_bulan,r_periode__payroll_tahun,r_periode__payroll_status
                                  FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";                 
                $rs_val = $db->Execute($sql_cek_periode);
                $periode_bulan= $rs_val->fields['r_periode__payroll_bulan'];
                $periode_tahun= $rs_val->fields['r_periode__payroll_tahun']; 
            //    var_dump($periode_bulan)   or die();           
 //SELECT  * from t_rekap_absensi where t_rkp__bln=7 AND t_rkp__thn=2016 AND t_rkp__approval=3
  

if($kunci2=='tmw2016')
{

    
   $sql="SELECT  * from t_rekap_absensi where t_rkp__bln='7' AND t_rkp__thn='$periode_tahun' AND t_rkp__approval=3 ";

   $rs_paging	= $db->execute($sql);


    $rs2	= $db->execute($sql);
    $list_arr_satuan = array();
    $arrTmp = array();
    $hasil=array();
		
$i=0;$z=1;
while($arr=$rs2->FetchRow()){
	array_push($list_arr_satuan, $arr); 
	
                                $arrTmp["t_rkp__no_mutasi"]=preg_replace('/[\x00-\x1F\x80-\xFF]/','',utf8_encode($arr["t_rkp__no_mutasi"]));
                                $arrTmp["t_rkp__bln"]=$arr["t_rkp__bln"];
                                $arrTmp["t_rkp__thn"]=$arr["t_rkp__thn"];
                                $arrTmp["t_rkp__hadir"]=$arr["t_rkp__hadir"];
                                $arrTmp["t_rkp__sakit"]=$arr["t_rkp__sakit"];
                                $arrTmp["t_rkp__izin"]=$arr["t_rkp__izin"];
                                $arrTmp["t_rkp__alpa"]=$arr["t_rkp__alpa"];
                                $arrTmp["t_rkp__dinas"]=$arr["t_rkp__dinas"];
                                $arrTmp["t_rkp__cuti"]=$arr["t_rkp__cuti"];
                                $arrTmp["t_rkp__keterangan"]=preg_replace('/[\x00-\x1F\x80-\xFF]/','',utf8_encode($arr["t_rkp__keterangan"]));
                                $arrTmp["t_rkp__date_created"]=$arr["t_rkp__date_created"];
                                $arrTmp["t_rkp__date_updated"]=$arr["t_rkp__date_updated"];
                                $arrTmp["t_rkp__user_created"]=$arr["t_rkp__user_created"];
                                $arrTmp["t_rkp__user_updated"]=$arr["t_rkp__user_updated"];
                             				
				$hasil[$i]=$arrTmp;
				$i++;
}
echo json_encode($hasil);





}
}
?>

