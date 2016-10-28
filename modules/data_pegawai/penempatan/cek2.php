<?PHP
require_once('../../../includes/config.conf.php');	 
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');
 
$db = &ADONewConnection($DB_TYPE);
 //$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
 
 $HREF_HOME_PATH_AJAX = $HREF_HOME."/modules/data_pegawai/penempatan";

 $r_pnpt__finger_print= trim($_GET['r_pnpt__finger_print']);
 
  $sql_cek_no="SELECT  A.r_pnpt__finger_print FROM r_penempatan A where A.r_pnpt__finger_print='$r_pnpt__finger_print'";
//  var_dump($sql_cek_no)or die();
  $rs_val = $db->Execute($sql_cek_no);
   
   $cek_no__sp= $rs_val->fields['r_pnpt__finger_print'];

 if ($cek_no__sp!='') {		 
		// no pasport sudah ada
		$ket="<font color=\"#ff0000\">NO Mutasi ".$r_pnpt__finger_print." Sudah Ada</font>";
 } else {
		// no pasport belum ada
		$ket="<font color=\"#330099\">No Mutasi ".$r_pnpt__finger_print." Bisa Digunakan</font>";
 }
// echo  $sql_cek;
?>
  
<div id="ajax_cek_id2">
<INPUT TYPE="text" id="r_pnpt__finger_print" NAME="r_pnpt__finger_print" value="<?=$r_pnpt__finger_print;?>" 
size="35" OnChange="JavaScript:Ajax('ajax_cek_id2','<?=$HREF_HOME_PATH_AJAX?>/cek2.php?r_pnpt__finger_print='+frmCreate.r_pnpt__finger_print.value)"> 		
 <?=$ket?>			
 </div>
 


