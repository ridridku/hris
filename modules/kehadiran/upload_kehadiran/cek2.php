<?PHP
require_once('../../../includes/config.conf.php');	 
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');
 
$db = &ADONewConnection($DB_TYPE);
 //$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
 
 $HREF_HOME_PATH_AJAX = $HREF_HOME."/modules/kehadiran/upload_kehadiran";

 $file_xls= trim($_GET['file_xls']);
 $tipe_file= trim($_GET['tipe_file']);
 
// $smarty->assign ("FILE_XLS", $file_xls);
  
$ext = pathinfo($file_xls, PATHINFO_EXTENSION);
          
//var_dump($ext)or die();
 if ($ext=='xls' && $tipe_file==1 ) {		 
		// no pasport sudah ada
		$ket="<font color=\"#ff0000\">Betul xls</font>";
 } elseif($ext=='dat'&& $tipe_file==2) {
		// no pasport belum ada
		$ket="<font color=\"#330099\">Betul File Data</font>";
 }
 else {
     $ket="<font color=\"#330099\">Tipe Data Salah</font>";
}
// echo  $sql_cek;
?>
  
<div id="ajax_cek_id2">
    <input type="file" NAME="file_xls" id="file_xls" 
size="35" OnChange="JavaScript:Ajax('ajax_cek_id2','<?=$HREF_HOME_PATH_AJAX?>/cek2.php?tipe_file='+frmCreate.tipe_file.value)"> 		
 <?=$ket?>			
 </div>
 


