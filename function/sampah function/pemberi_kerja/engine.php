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
 
  if($_POST['kode_wni'])
{ $kode_wni = $_POST['kode_wni'];
}else{ $kode_wni = $_GET['kode_wni'];}
 


 
$nama_majikan = addslashes($_POST[nama_majikan]);
 $alamat_majikan = addslashes($_POST[alamat_majikan]);
 $tlp_majikan = addslashes($_POST[tlp_majikan]);

$sql="insert into tbl_kerja_tki(kode_wni, kode_pjtki,kode_pjtka,nama_majikan,alamat_majikan,tgl_awal,tgl_akhir,tlp_majikan,tanggal_input,kode_perwakilan ) 
values ('$kode_wni', '$_POST[kode_pjtki]','$_POST[kode_pjtka]','$nama_majikan','$alamat_majikan', '$_POST[tgl_awal]','$_POST[tgl_akhir]','$tlp_majikan',CURDATE(),'$kode_perwakilan')";			 
 $sqlresult = $db->Execute($sql);
 

 Header("Location:../list_pemberi_kerja.php?kode_wni=".$kode_wni); 
	 


?>
 