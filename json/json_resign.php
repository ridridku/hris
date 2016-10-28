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

    $sql="SELECT  * from  r_resign A  where A.t_resign__date_updated>= '".$periode2."'";;
    $rs_paging	= $db->execute($sql);
    $rs2	= $db->execute($sql);
    $list_arr_satuan = array();
    $arrTmp = array();
    $hasil=array();
		
$i=0;$z=1;
while($arr=$rs2->FetchRow()){
	array_push($list_arr_satuan, $arr); 
                                $arrTmp["r_resign__no"]=$arr["r_resign__no"];
				$arrTmp["r_resign__tgl"]=$arr["r_resign__tgl"];
				$arrTmp["r_resign__mutasi"]=$arr["r_resign__mutasi"];
                                $arrTmp["r_resign__approval"]=$arr["r_resign__approval"];
				$arrTmp["r_resign__ket"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_resign__ket"]));
				$arrTmp["t_resign__date_created"]=$arr["t_resign__date_created"];
				$arrTmp["t_resign__date_updated"]=$arr["t_resign__date_updated"];
				$arrTmp["t_resign__user_created"]=$arr["t_resign__user_created"];
				$arrTmp["t_resign__user_updated"]=$arr["t_resign__user_updated"];
				$hasil[$i]=$arrTmp;
				$i++;
}
echo json_encode($hasil);





}
}
?>

