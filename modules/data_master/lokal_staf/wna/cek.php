<? 
require_once('../../../../includes/config.conf.php');	 
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');
 
$db = &ADONewConnection($DB_TYPE);
 //$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);


 
 $HREF_HOME_PATH_AJAX = $HREF_HOME."/modules/data_master/lokal_staf/wna";
 
 $kode_wna = $_GET['kode_wna'];
 
   
 $sql_cek="select * from tbl_wna where kode_wna='$kode_wna'";
 $rs_val = $db->Execute($sql_cek);
 $kode_wni_cek = $rs_val->fields['kode_wna'];

 if ($kode_wni_cek!='') {		 
		// no pasport sudah ada
		$ket="Kode WNA Sudah Ada";
 } else {
		// no pasport belum ada
		$ket="Kode WNA Belum Ada";
		
 }
 
 //echo  $sql_cek;

?>
  
<div id="ajax_cek_id">
<INPUT TYPE="text" NAME="kode_wna" value="<?=$kode_wna?>" 
size="35" OnChange="JavaScript:Ajax('ajax_cek_id','<?=$HREF_HOME_PATH_AJAX?>/cek.php?kode_wna='+frmCreate.kode_wna.value)"> 		
<font color="#ff0000"><?=$ket?></font>			
 </div>
 