<?PHP 
require_once('../../../includes/config.conf.php');	 
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');
 
$db = &ADONewConnection($DB_TYPE);
 //$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
 
 $HREF_HOME_PATH_AJAX = $HREF_HOME."/modules/data_pegawai/pegawai";
 
 $r_pegawai__ktp = trim($_GET['r_pegawai__ktp']);
 $id = $_GET['id'];
   
 $sql_cek="select * from r_pegawai where trim(r_pegawai__ktp)='$r_pegawai__ktp' ";
 $rs_val = $db->Execute($sql_cek);
 $kode_wni_cek = $rs_val->fields['r_pegawai__ktp'];

 if ($kode_wni_cek!='') {		 
		// no pasport sudah ada
		$ket="<font color=\"#ff0000\">No. KTP Sudah Ada</font>";
 } else {
		// no pasport belum ada
		$ket="<font color=\"#330099\">No. KTP Belum Ada</font>";
		
 }
 
 //echo  $sql_cek;

?>
  
<div id="ajax_cek_id">
<INPUT TYPE="text" NAME="r_pegawai__ktp" value="<?=$r_pegawai__ktp?>" 
size="35" OnChange="JavaScript:Ajax('ajax_cek_id','<?=$HREF_HOME_PATH_AJAX?>/cek.php?r_pegawai__ktp='+frmCreate.r_pegawai__ktp.value)"> 		
 <?=$ket?>			
 </div>
 