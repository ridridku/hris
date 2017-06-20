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
 

$nama = addslashes($_POST[nama]);
$alamat = addslashes($_POST[alamat]);
$alamat_ln = addslashes($_POST[alamat_ln]);
$lama_tinggal = addslashes($_POST[lama_tinggal]);
$tempat_lahir = addslashes($_POST[tempat_lahir]);
$tlp = addslashes($_POST[tlp]);
$tlp_ln = addslashes($_POST[tlp_ln]);

 $kode_wni = trim($_POST['kode_wni']);

 $sql_cek="select * from tbl_wni where trim(kode_wni)='$kode_wni'";
 $rs_val = $db->Execute($sql_cek);
 $kode_wni = $rs_val->fields['kode_wni'];
 
		if ($kode_wni!='') {			
			 Header("Location:index_cek.php?kode_perwakilan=".$kode_perwakilan);
		} else {
			 $sql="insert into tbl_wni(kode_wni, kode_perwakilan,nama,kode_agama,tempat_lahir,tgl_lahir,kode_jenis,kode_sumber,id_kabupaten,alamat,tlp,alamat_ln,tlp_ln,lama_tinggal,jk,tanggal,no_paspor) values ('$_POST[kode_wni]','$_POST[kode_perwakilan]','$nama','$_POST[kode_agama]','$tempat_lahir','$_POST[tanggal]','$_POST[kode_jenis]','$_POST[kode_klasifikasi_wni]','$_POST[id_kab]','$alamat','$tlp','$alamat_ln','$tlp_ln','$lama_tinggal','$_POST[jk]',CURDATE(),'$_POST[no_paspor]')";			 
			 $sqlresult = $db->Execute($sql);		 
 
			 $ip_now = $_SERVER['REMOTE_ADDR'];
			 $user_id = $_SESSION['UID'];
  
				$kode_wni = trim($_POST['kode_wni']);

 			  Header("Location:../list_abk.php?pil=4&kode_perwakilan=".$kode_perwakilan."&cari=".$kode_wni); 
	 }


?>
 