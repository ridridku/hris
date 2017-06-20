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

$sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_awal,r_periode__payroll_akhir,r_periode__payroll_status
                    FROM r_periode_payroll WHERE r_periode__payroll_status = 1";                 
                $rs_val = $db->Execute($sql_cek_periode);
                $periode_awal= $rs_val->fields['r_periode__payroll_awal'];
                $periode_akhir= $rs_val->fields['r_periode__payroll_akhir']; 
  

if($kunci2=='tmw2016')
{
   $sql="SELECT  * from t_rekap_absensi where t_rkp__awal>='$periode_awal' AND t_rkp__akhir<='$periode_akhir' AND t_rkp__approval=3 ";
   $rs_paging	= $db->execute($sql);
   $rs2	= $db->execute($sql);
   $list_arr_satuan = array();
   $arrTmp = array();
   $hasil=array();
		
$i=0;$z=1;
while($arr=$rs2->FetchRow()){
	array_push($list_arr_satuan, $arr); 
	
                                $arrTmp["t_rkp__no_mutasi"]=preg_replace('/[\x00-\x1F\x80-\xFF]/','',utf8_encode($arr["t_rkp__no_mutasi"]));
                                $arrTmp["t_rkp__awal"]=$arr["t_rkp__awal"];
                                $arrTmp["t_rkp__akhir"]=$arr["t_rkp__akhir"];
                                $arrTmp["t_rkp__approval"]=$arr["t_rkp__approval"];
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

