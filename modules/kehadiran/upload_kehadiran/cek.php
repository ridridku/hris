<? 
require_once('../../../includes/config.conf.php');	 
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');
 
$db = &ADONewConnection($DB_TYPE);
 //$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
 
 $HREF_HOME_PATH_AJAX = $HREF_HOME."/modules/data_wni/wni";
 
 $kode_wni = trim($_GET['kode_wni']);
 $id = $_GET['id'];
   
 $sql_cek="select * from tbl_wni where trim(kode_wni)='$kode_wni' and id!='$id' ";
 $rs_val = $db->Execute($sql_cek);
 $kode_wni_cek = $rs_val->fields['kode_wni'];

 if ($kode_wni_cek!='') {		 
		// no pasport sudah ada
		$ket="<font color=\"#ff0000\">No. Paspor Sudah Ada</font>";
 } else {
		// no pasport belum ada
		$ket="<font color=\"#330099\">No. Paspor Belum Ada</font>";
		
 }
 
 //echo  $sql_cek;

?>
  
<div id="ajax_cek_id">
<INPUT TYPE="text" NAME="kode_wni" value="<?=$kode_wni?>" 
size="35" OnChange="JavaScript:Ajax('ajax_cek_id','<?=$HREF_HOME_PATH_AJAX?>/cek.php?kode_wni='+frmCreate.kode_wni.value+'&id='+frmCreate.id.value)"> 		
 <?=$ket?>			
 </div>
 