<?PHP
require_once('../../../includes/config.conf.php');	 
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');
 
$db = &ADONewConnection($DB_TYPE);
 //$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
 
 $HREF_HOME_PATH_AJAX = $HREF_HOME."/modules/jaminan/jaminan";
 
 $t_sp__no = trim($_GET['t_sp__no']);
 
 
  $sql_cek_no="SELECT  A.t_sp__no,  A.t_sp__nip,  A.t_sp__tgl,  A.t_sp__jabatan,  A.t_sp__cabang,  A.t_sp__jenis,  A.t_sp__alasan
                       FROM t_surat_peringatan A where A.t_sp__no='$t_sp__no'";

   $rs_val = $db->Execute($sql_cek_no);
   
   $cek_no__sp= $rs_val->fields['t_sp__no'];

 if ($cek_no__sp!='') {		 
		// no pasport sudah ada
		$ket="<font color=\"#ff0000\">NO SP ".$t_sp__no." Sudah Ada</font>";
 } else {
		// no pasport belum ada
		$ket="<font color=\"#330099\">No SP ".$t_sp__no." Bisa Digunakan</font>";
 }
 //echo  $sql_cek;
?>
  
<div id="ajax_cek_id">
<INPUT TYPE="text" NAME="t_sp__no" value="<?=$t_sp__no?>" 
size="35" OnChange="JavaScript:Ajax('ajax_cek_id','<?=$HREF_HOME_PATH_AJAX?>/cek.php?t_sp__no='+frmCreate.t_sp__no.value)"> 		
 <?=$ket?>			
 </div>
 