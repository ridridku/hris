<?PHP
require_once('../../../includes/config.conf.php');	 
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');
 
$db = &ADONewConnection($DB_TYPE);
 //$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
 
 $HREF_HOME_PATH_AJAX = $HREF_HOME."/modules/data_pegawai/support_mdrp";
 
 $no_mdrp = trim($_GET['no_mdrp']);

  $sql_cek_no=" SELECT
                t_mdrp.mdrp__id,
                t_mdrp.mdrp__formulir,
                t_mdrp.mdrp__idpegawai,
                t_mdrp.mdrp__cab_lama,
                t_mdrp.mdrp__dep_lama,
                t_mdrp.mdrp__sudep_lama,
                t_mdrp.mdrp__jab_lama,
                t_mdrp.mdrp__lokasibaru,
                t_mdrp.mdrp__subcab_baru,
                t_mdrp.mdrp__depbaru,
                t_mdrp.mdrp__subdepbaru,
                t_mdrp.mdrp__jabatanbaru,
                t_mdrp.mdrp__efektif,
                t_mdrp.mdrp__tipe,
                t_mdrp.mdrp__status,
                t_mdrp.mdrp__date_created,
                t_mdrp.mdrp__date_updated,
                t_mdrp.mdrp__user_created,
                t_mdrp.mdrp__user_updated
FROM
t_mdrp where t_mdrp.mdrp__formulir='$no_mdrp'";
 //var_dump($sql_cek_no)or die();
   $rs_val = $db->Execute($sql_cek_no);
   
   $cek_no__sp= $rs_val->fields['mdrp__formulir'];

 if ($cek_no__sp!='') {		 
		// no pasport sudah ada
		$ket="<font color=\"#ff0000\">No Formulir ".$no_mdrp." Sudah Ada</font>";
 } else {
		// no pasport belum ada
		$ket="<font color=\"#330099\">No Formulir ".$no_mdrp." Bisa Digunakan</font>";
 }
 //echo  $sql_cek;
?>
  
<div id="ajax_cek_id">
<INPUT TYPE="text" NAME="no_mdrp" value="<?=$no_mdrp?>" 
size="35" OnChange="JavaScript:Ajax('ajax_cek_id','<?=$HREF_HOME_PATH_AJAX?>/cek.php?no_mdrp='+frmCreate.no_mdrp.value)"> 		
 <?=$ket?>			
 </div>
 