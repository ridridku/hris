 <?php
  require_once('../../includes/config.conf.php');
 require_once('../../includes/db.conf.php');
 require_once('../../adodb/adodb.inc.php');
 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);


 if($_POST['kode_perwakilan'])
{ $kode_perwakilan = $_POST['kode_perwakilan'];
}else{ $kode_perwakilan = $_GET['kode_perwakilan'];}
 
 
 $bhi = addslashes($_POST[bhi]);
 $alamat_ln = addslashes($_POST[alamat_ln]);
 $pemilik = addslashes($_POST[pemilik]);
 


$sql	 = "INSERT INTO tbl_bhi (
                                
                                 `kode_perwakilan`,
                                 `bhi`,
                                 `tgl_input`,
                                 `alamat_ln`,
                                 `pemilik`,
                                 `no_tlp`,
                                 `thn_pendirian`,
                                 `jml_karjaya`,
                                 `jenis_bh`,
								 `kode_kat_usaha`) ";
$sql	.= " VALUES (
                   
                     '".$kode_perwakilan."',
                     '".$bhi."',
                     '".$_POST['tgl_input']."',
                     '".$alamat_ln."',
                     '".$pemilik."',
                     '".$_POST['no_tlp']."',
                      '".$_POST['tahun']."',
                     '".$_POST['jml_karjaya']."',
                     '".$_POST['jenis_bh']."',
					 '".$_POST['kode_kat_usaha']."') ";

$sqlresult = $db->Execute($sql);
  Header("Location:../list_bhi2.php?pil=1&kode_perwakilan=".$kode_perwakilan."&cari=".$bhi); 

	 


?>
 