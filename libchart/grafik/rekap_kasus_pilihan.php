<br> 
 <link href="style.css" type="text/css" rel="stylesheet" />

<?php
 
 require_once('../../includes/db.conf.php');
 require_once('../../adodb/adodb.inc.php');
 
 $db = &ADONewConnection($DB_TYPE);
 // $db->debug = true;
 $db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
 include "../libchart/classes/libchart.php";

if ($_GET['kode_perwakilan']) $kode_perwakilan = $_GET['kode_perwakilan'];
else if ($_POST['kode_perwakilan']) $kode_perwakilan = $_POST['kode_perwakilan'];
else $kode_perwakilan="";

if ($_GET['bulan']) $bulan = $_GET['bulan'];
else if ($_POST['bulan']) $bulan = $_POST['bulan'];
else $bulan="";

if ($_GET['tahun']) $tahun = $_GET['tahun'];
else if ($_POST['tahun']) $tahun = $_POST['tahun'];
else $tahun="";

if ($_GET['kode_kasus']) $kode_kasus = $_GET['kode_kasus'];
else if ($_POST['kode_kasus']) $kode_kasus = $_POST['kode_kasus'];
else $kode_kasus="";
 

if ($_GET['search']) $search = $_GET['search'];
else if ($_POST['search']) $search = $_POST['search'];
else $search="";
 

if ($_GET['kode_kawasan']) $kode_kawasan = $_GET['kode_kawasan'];
else if ($_POST['kode_kawasan']) $kode_kawasan = $_POST['kode_kawasan'];
else $kode_kawasan="";
 

if ($_GET['kode_negara']) $kode_negara = $_GET['kode_negara'];
else if ($_POST['kode_negara']) $kode_negara = $_POST['kode_negara'];
else $kode_negara="";

 if ($_GET['kode_klasifikasi_wni']) $kode_klasifikasi_wni = $_GET['kode_klasifikasi_wni'];
else if ($_POST['kode_klasifikasi_wni']) $kode_klasifikasi_wni = $_POST['kode_klasifikasi_wni'];
else $kode_klasifikasi_wni="";
 

if ($_GET['kode_sektor']) $kode_sektor = $_GET['kode_sektor'];
else if ($_POST['kode_sektor']) $kode_sektor = $_POST['kode_sektor'];
else $kode_sektor="";
 

 if ($_GET['kode_jenis']) $kode_jenis = $_GET['kode_jenis'];
else if ($_POST['kode_jenis']) $kode_jenis = $_POST['kode_jenis'];
else $kode_jenis="";
 

if ($_GET['usia']) $usia = $_GET['usia'];
else if ($_POST['usia']) $usia = $_POST['usia'];
else $usia="";

if ($_GET['jk']) $jk = $_GET['jk'];
else if ($_POST['jk']) $jk = $_POST['jk'];
else $jk="";




if ($_GET['jenis_grafik']) $jenis_grafik = $_GET['jenis_grafik'];
else if ($_POST['jenis_grafik']) $jenis_grafik = $_POST['jenis_grafik'];
else $jenis_grafik="1";

		
				
 ?>

  
<center> 
<form name="frm" action="rekap_kasus.php" > <br><br><br>
	<table   border=0 width="100%">	
	  <tr>
	  <td class="ewTableHeader" align="center" width="100" > <b>PILIHAN GRAFIK  : </b>

 <select name="pil_grafik" OnChange="window.location.href='rekap_kasus.php?kode_perwakilan=<?=$kode_perwakilan?>&bulan=<?=$bulan?>&tahun=<?=$tahun?>&kode_kasus=<?=$kode_kasus?>&kode_kawasan=<?=$kode_kawasan?>&kode_negara=<?=$kode_negara?>&kode_klasifikasi_wni=<?=$kode_klasifikasi_wni?>&kode_sektor=<?=$kode_sektor?>&kode_jenis=<?=$kode_jenis?>&usia=<?=$usia?>&jk=<?=$jk?>&pil_grafik='+frm.pil_grafik.value+''";>

			 <option value=""> [ Pilih Grafik ] </option>
			 <option value="1"     > Kawasan</option>
			 <option value="2"  > Negara </option>		  
			 
		  </select>

	   </td></tr>
	</table>
 </form>
 </center> 
 