 <?php
  require_once('../../includes/config.conf.php');
 require_once('../../includes/db.conf.php');
 require_once('../../adodb/adodb.inc.php');
 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

 
 
 $nama_wna = addslashes($_POST[nama_wna]);
 $alamat_ind = addslashes($_POST[alamat_ind]);
 $tlp_ind = addslashes($_POST[tlp_ind]);
 
  $alamat_ln = addslashes($_POST[alamat_ln]);
   $tlp_ln = addslashes($_POST[tlp_ln]);
    $keterangan = addslashes($_POST[keterangan]);



	    $sql	 = "INSERT INTO tbl_wna ( `kode_negara`,`nama_wna`,`alamat_ind`,`tlp_ind`,`alamat_ln`,`tlp_ln`,`keterangan`) ";
		$sql	.= " VALUES ( '".$_POST[kode_negara]."','".$nama_wna."','".$alamat_ind."','".$tlp_ind."','".$alamat_ln."','".$tlp_ln."','".$keterangan."')";

		$sqlresult = $db->Execute($sql);
		
		
		Header("Location:../list_wna.php?pil=1&kode_perwakilan=".$kode_perwakilan."&cari=".$nama_wna); 

	 


?>
 