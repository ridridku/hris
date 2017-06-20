<?PHP
require_once('../../../includes/config.conf.php');	 
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');
 
$db = &ADONewConnection($DB_TYPE);
 //$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
 
 $HREF_HOME_PATH_AJAX = $HREF_HOME."/modules/data_pegawai/penempatan";

 $r_pnpt__no_mutasi = trim($_GET['r_pnpt__no_mutasi']);
 
  $sql_cek_no="SELECT  A.r_pnpt__no_mutasi FROM r_penempatan A where A.r_pnpt__no_mutasi='$r_pnpt__no_mutasi'";

  $rs_val = $db->Execute($sql_cek_no);
   
   $cek_no__sp= $rs_val->fields['r_pnpt__no_mutasi'];

 if ($cek_no__sp!='') {		 
		// no pasport sudah ada
		$ket="<font color=\"#ff0000\">NO Mutasi ".$r_pnpt__no_mutasi." Sudah Ada</font>";
 } else {
		// no pasport belum ada
		$ket="<font color=\"#330099\">No Mutasi ".$r_pnpt__no_mutasi." Bisa Digunakan</font>";
 }
// echo  $sql_cek;
?>
  
<div id="ajax_cek_id">
<INPUT TYPE="text" NAME="r_pnpt__no_mutasi" value="<?=$r_pnpt__no_mutasi;?>" 
size="35" OnChange="JavaScript:Ajax('ajax_cek_id','<?=$HREF_HOME_PATH_AJAX?>/cek.php?r_pnpt__no_mutasi='+frmCreate.r_pnpt__no_mutasi.value)"> 		
 <?=$ket?>			
 </div>
 