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
$periode2= $_POST['periode'];
$kunci2= $_POST['kunci'];



 
  

if($kunci2=='tmw2016')
{

   $sql="SELECT  * from  r_penempatan  where r_pnpt__date_updated >= '".$periode2."'";;

$rs_paging	= $db->execute($sql);


$rs2	= $db->execute($sql);
$list_arr_satuan = array();
$arrTmp = array();
$hasil=array();
		
$i=0;$z=1;
while($arr=$rs2->FetchRow()){
	array_push($list_arr_satuan, $arr); 
	
                                $arrTmp["r_pnpt__no_mutasi"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pnpt__no_mutasi"]));
				$arrTmp["r_pnpt__id_pegawai"]=$arr["r_pnpt__id_pegawai"];
				$arrTmp["r_pnpt__nip"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pnpt__nip"]));
				$arrTmp["r_pnpt__status"]=$arr["r_pnpt__status"];
				$arrTmp["r_pnpt__tipe_salary"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pnpt__tipe_salary"]));
				$arrTmp["r_pnpt__subdept"]=$arr["r_pnpt__subdept"];
				$arrTmp["r_pnpt__jabatan"]=$arr["r_pnpt__jabatan"];
				$arrTmp["r_pnpt__finger_print"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pnpt__finger_print"]));
				$arrTmp["r_pnpt__gapok"]=$arr["r_pnpt__gapok"];
				$arrTmp["r_pnpt__subcab"]=$arr["r_pnpt__subcab"];
				$arrTmp["r_pnpt__shift"]=$arr["r_pnpt__shift"];
				$arrTmp["r_pnpt__kon_awal"]=$arr["r_pnpt__kon_awal"];
				$arrTmp["r_pnpt__kon_akhir"]=$arr["r_pnpt__kon_akhir"];
				$arrTmp["r_pnpt__pdrm"]=$arr["r_pnpt__pdrm"];
				$arrTmp["r_pnpt__aktif"]=$arr["r_pnpt__aktif"];
				$arrTmp["r_pnpt__date_created"]=$arr["r_pnpt__date_created"];
				$arrTmp["r_pnpt__date_updated"]=$arr["r_pnpt__date_updated"];
				$arrTmp["r_pnpt__user_created"]=$arr["r_pnpt__user_created"];
				$arrTmp["r_pnpt__user_updated"]=$arr["r_pnpt__user_updated"];
				$arrTmp["r_pnpt__date_updated"]=$arr["r_pnpt__date_updated"];
				
				$hasil[$i]=$arrTmp;
				$i++;
}
echo json_encode($hasil);





}
}
?>

