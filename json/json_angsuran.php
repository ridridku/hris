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

   $sql="SELECT  * from  r_angsuran  where r_ang__date_updated >= '".$periode2."'";;

$rs_paging	= $db->execute($sql);


$rs2	= $db->execute($sql);
$list_arr_satuan = array();
$arrTmp = array();
$hasil=array();
		
$i=0;$z=1;
while($arr=$rs2->FetchRow()){
	array_push($list_arr_satuan, $arr); 
	
                                 $arrTmp["r_ang__id"]=$arr["r_ang__id"];
				$arrTmp["r_ang__jenis"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_ang__jenis"]));
				$arrTmp["r_ang__platfond"]=$arr["r_ang__platfond"];
				$arrTmp["r_ang__ket"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_ang__ket"]));
				$arrTmp["r_ang__total"]=$arr["r_ang__total"];
				$arrTmp["r_ang__tenor_bulan"]=$arr["r_ang__tenor_bulan"];
				$arrTmp["r_ang__cicilan"]=$arr["r_ang__cicilan"];
				$arrTmp["r_ang__date_created"]=$arr["r_ang__date_created"];
				$arrTmp["r_ang__date_updated"]=$arr["r_ang__date_updated"];
				$arrTmp["r_ang__user_created"]=$arr["r_ang__user_created"];
				$arrTmp["r_ang__user_updated"]=$arr["r_ang__user_updated"];
				
				$hasil[$i]=$arrTmp;
				$i++;
}
echo json_encode($hasil);





}
}
?>

