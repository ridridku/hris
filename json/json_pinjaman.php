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

$db = &ADONewConnection($DB_TYPE);
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

$periode2= $_POST['periode'];
$kunci2= $_POST['kunci'];


 
  

if($kunci2=='tmw2016')
{

   $sql="SELECT  * from  t_pinjaman where t_pjm__date_updated >= '".$periode2."'";
   $rs_paging	= $db->execute($sql);


$rs2	= $db->execute($sql);
$list_arr_satuan = array();
$arrTmp = array();
$hasil=array();
		
$i=0;$z=1;
while($arr=$rs2->FetchRow()){
	array_push($list_arr_satuan, $arr); 
	
                                $arrTmp["t_pjm__no_pinjaman"]=preg_replace('/[\x00-\x1F\x80-\xFF]/','',utf8_encode($arr["t_pjm__no_pinjaman"]));
				$arrTmp["t_pjm__jenis"]=$arr["t_pjm__jenis"];
				$arrTmp["t_pjm__mutasi"]=preg_replace('/[\x00-\x1F\x80-\xFF]/','',utf8_encode($arr["t_pjm__mutasi"]));
				$arrTmp["t_pjm__tgl_disetujui"]=$arr["t_pjm__tgl_disetujui"];
				$arrTmp["t_pjm__approval"]=$arr["t_pjm__approval"];
				$arrTmp["t_pjm__keterangan"]=preg_replace('/[\x00-\x1F\x80-\xFF]/','',utf8_encode($arr["t_pjm__keterangan"]));
				$arrTmp["t_pjm__lunas"]=$arr["t_pjm__lunas"];
				$arrTmp["t_pjm__date_created"]=$arr["t_pjm__date_created"];
				$arrTmp["t_pjm__date_updated"]=$arr["t_pjm__date_updated"];
				$arrTmp["t_pjm__user_created"]=$arr["t_pjm__user_created"];
				$arrTmp["t_pjm__user_updated"]=$arr["t_pjm__user_updated"];
				
				$hasil[$i]=$arrTmp;
				$i++;
}
echo json_encode($hasil);





}
}
?>

