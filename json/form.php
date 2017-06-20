<?PHP

require_once('../includes/db.conf.php');
require_once('../adodb/adodb.inc.php');
require_once('../includes/config.conf.php');
$db = &ADONewConnection($DB_TYPE);
//$db->debug = true;1800000
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

$sql="SELECT  * from  t_json_absensi  where out_end >= '".$periode2."'";
$rs_paging	= $db->execute($sql);


$rs2	= $db->execute($sql);
$list_arr_satuan = array();
$arrTmp = array();
$hasil=array();
		
$i=0;$z=1;
while($arr=$rs2->FetchRow()){
	array_push($list_arr_satuan, $arr); 
	
                 
				$arrTmp["finger"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["finger"]));
				$arrTmp["in_start"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["in_start"]));
				$arrTmp["out_end"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["out_end"]));
			
				
				$hasil[$i]=$arrTmp;
				$i++;
}

//$fp = fopen('results.json', 'w');
//fwrite($fp, json_encode($response));
//fclose($fp);
//
//
//$arr= json_encode($hasil);
//$fp = fopen('results.json', 'w');
//fwrite($fp, $arr);
//fclose($fp);


// $arr= json_encode($hasil);


 //echo $arr;
?>
<form action="closing.php" method="POST" enctype='application/json'>
<input type="text" name="awal" value="2016-11-21">
<input type="text" name="akhir" value="2016-12-20">
<input type="text" name="awalnext" value="2016-12-21">
<input type="text" name="akhirnext" value="2017-01-20">




<input type="text" name="kunci" value="tmw2016">

<input type="submit">
</form>

