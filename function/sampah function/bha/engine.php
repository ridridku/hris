 <?php
  require_once('../../includes/config.conf.php');
 require_once('../../includes/db.conf.php');
 require_once('../../adodb/adodb.inc.php');
 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

 
 
 $nama_bha = addslashes($_POST[nama_bha]);
 $alamat = addslashes($_POST[alamat]);
 $tlp = addslashes($_POST[tlp]);
 
  $alamat_ln = addslashes($_POST[alamat_ln]);
   $tlp_ln = addslashes($_POST[tlp_ln]);
    $keterangan = addslashes($_POST[keterangan]);
 
		
				$sql	 = "INSERT INTO tbl_mast_badan_hukum_asing ( `nama_bha`,`alamat`,`tlp`, kode_negara,fax,email) ";
				$sql	.= " VALUES ( '".$nama_bha."','".$alamat."','".$tlp."', '$_POST[kode_negara]','$_POST[fax]','$_POST[email]')";

				$sqlresult = $db->Execute($sql);



		Header("Location:../list_bha.php?pil=1&kode_perwakilan=".$kode_perwakilan."&cari=".$nama_bha); 

	 


?>
 