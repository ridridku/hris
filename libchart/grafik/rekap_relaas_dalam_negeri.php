<br> 
 <link href="style.css" type="text/css" rel="stylesheet" />

<?php
 
 require_once('../../includes/db.conf.php');
 require_once('../../adodb/adodb.inc.php');
 
 $db = &ADONewConnection($DB_TYPE);
 //$db->debug = true;
 $db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
 include "../libchart/classes/libchart.php";

if ($_GET['kode_kawasan']) $kode_kawasan = $_GET['kode_kawasan'];
else if ($_POST['kode_kawasan']) $kode_kawasan = $_POST['kode_kawasan'];
else $kode_kawasan="";

if ($_GET['bulan']) $bulan = $_GET['bulan'];
else if ($_POST['bulan']) $bulan = $_POST['bulan'];
else $bulan="";

if ($_GET['tahun']) $tahun = $_GET['tahun'];
else if ($_POST['tahun']) $tahun = $_POST['tahun'];
else $tahun="";


if ($_GET['no_propinsi']) $no_propinsi = $_GET['no_propinsi'];
else if ($_POST['no_propinsi']) $no_propinsi = $_POST['no_propinsi'];
else $no_propinsi="";
 
if ($_GET['id_kab']) $id_kab = $_GET['id_kab'];
else if ($_POST['id_kab']) $id_kab = $_POST['id_kab'];
else $id_kab="";


if ($_GET['search']) $search = $_GET['search'];
else if ($_POST['search']) $search = $_POST['search'];
else $search="";
 

if ($_GET['kode_perwakilan']) $kode_perwakilan = $_GET['kode_perwakilan'];
else if ($_POST['kode_perwakilan']) $kode_perwakilan = $_POST['kode_perwakilan'];
else $kode_perwakilan="";

if ($_GET['kode_kawasan']) $kode_kawasan = $_GET['kode_kawasan'];
else if ($_POST['kode_kawasan']) $kode_kawasan = $_POST['kode_kawasan'];
else $kode_kawasan="";

if ($_GET['kode_sebab']) $kode_sebab = $_GET['kode_sebab'];
else if ($_POST['kode_sebab']) $kode_sebab = $_POST['kode_sebab'];
else $kode_sebab="";

if ($_GET['bulan']) $bulan = $_GET['bulan'];
else if ($_POST['bulan']) $bulan = $_POST['bulan'];
else $bulan="";

if ($_GET['tahun']) $tahun = $_GET['tahun'];
else if ($_POST['tahun']) $tahun = $_POST['tahun'];
else $tahun="";

if ($_GET['kode_kat_kasus']) $kode_kat_kasus = $_GET['kode_kat_kasus'];
else if ($_POST['kode_kat_kasus']) $kode_kat_kasus = $_POST['kode_kat_kasus'];
else $kode_kat_kasus="";


if ($_GET['kode_jenis_panggil']) $kode_jenis_panggil = $_GET['kode_jenis_panggil'];
else if ($_POST['kode_jenis_panggil']) $kode_jenis_panggil = $_POST['kode_jenis_panggil'];
else $kode_jenis_panggil="";


if ($_GET['kode_asal']) $kode_asal = $_GET['kode_asal'];
else if ($_POST['kode_asal']) $kode_asal = $_POST['kode_asal'];
else $kode_asal="";


if ($_GET['kode_kawasan']) $kode_kawasan = $_GET['kode_kawasan'];
else if ($_POST['kode_kawasan']) $kode_kawasan = $_POST['kode_kawasan'];
else $kode_kawasan="";


if ($_GET['no_propinsi']) $no_propinsi = $_GET['no_propinsi'];
else if ($_POST['no_propinsi']) $no_propinsi = $_POST['no_propinsi'];
else $no_propinsi="";

if ($_GET['kode_pn']) $kode_pn = $_GET['kode_pn'];
else if ($_POST['kode_pn']) $kode_pn = $_POST['kode_pn'];
else $kode_pn="";




				  if ($bulan!='') { 
											if ($bulan==1) { $nama_bulan="JANUARI"; }
									if ($bulan==2) { $nama_bulan="FEBRUARI"; }
									if ($bulan==3) { $nama_bulan="MARET"; }
									if ($bulan==4) { $nama_bulan="APRIL"; }
									if ($bulan==5) { $nama_bulan="MEI"; }
									if ($bulan==6) { $nama_bulan="JUNI"; }
									if ($bulan==7) { $nama_bulan="JULI"; }
									if ($bulan==8) { $nama_bulan="AGUSTUS"; }
									if ($bulan==9) { $nama_bulan="SEPTEMBER"; }
									if ($bulan==10) { $nama_bulan="OKTOBER"; }
									if ($bulan==11) { $nama_bulan="NOVEMBER"; }
									if ($bulan==12) { $nama_bulan="DESEMBER"; }
  
					  
				 }
 
				 

			   


 if ($kode_jenis_panggil!='') { 

					  if ($kode_jenis_panggil==1) {
						$jenis_panggil="WNI";	
					  }
					    if ($kode_jenis_panggil==2) {
						$jenis_panggil="Badan Hukum Indonesia (BHI) ";	
					  }

					   if ($kode_jenis_panggil==3) {
						$jenis_panggil="WNA";	
					  }

					   if ($kode_jenis_panggil==4) {
						$jenis_panggil="Badan Usaha Asing ";	
					  }
 	 
				 }


				  if ($kode_asal!='') { 

					  if ($kode_asal==1) {
						$asal="PENGADILAN NEGERI";	
					  }
					    if ($kode_asal==2) {
						$asal="PENGADILAN TINGGI";	
					  }

					   if ($kode_asal==3) {
						$asal="PENGADILAN AGAMA";	
					  }
 	 
				 }

				 

					 if ($kode_pn !='') {
						 
						 $sql__="select * , upper(nama_pn) as nama_pn from tbl_mast_pengadilan where kode_pn='$kode_pn' ";
						 $rs__=$db->Execute($sql__);			  
						 $nama_pn = $rs__->fields['nama_pn']; 				 
			 
 
					 }

					if ($no_propinsi !='') {
						 $sql__="select * , upper(nama_propinsi) as nama_propinsi from tbl_mast_wil_propinsi where no_propinsi='$no_propinsi' ";
						 $rs__=$db->Execute($sql__);			  
						 $nama_propinsi = $rs__->fields['nama_propinsi']; 				 
						 
					}
 




?>


<table width="100%"    border=0 width="100%">	
				 
			 
				

				<? if ($bulan !='') {  ?>
				 <tr><td class="ewTableHeader"  width="200" ><b>BULAN</b></td><td width="5"> <b>:</b> </td><td colspan="2"><b><?=$bulan?></b>&nbsp;</td></tr>
				<? } ?>
 

				<? if ($tahun !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>TAHUN</b></td><td width="5"> <b>:</b>  </td><td colspan="2"><b><?=$tahun?></b>&nbsp;</td></tr>
				<? } ?>

				<? if ($kode_jenis_panggil !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>JENIS PANGGIL</b></td><td width="5"> <b>:</b>  </td><td colspan="2"><b><?=$jenis_panggil?></b>&nbsp;</td></tr>
				<? } ?>


				<? if ($nama_pn !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>ASAL PENGADILAN</b></td><td width="5"> <b>:</b>  </td><td colspan="2"><b><?=$nama_pn?></b>&nbsp;</td></tr>
				<? } ?>

				<? if ($nama_propinsi !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>PROPINSI</b></td><td width="5"> <b>:</b>  </td><td colspan="2"><b><?=$nama_propinsi?></b>&nbsp;</td></tr>
				<? } ?>

				<? if ($nama_pn !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>NAMA PENGADILAN</b></td><td width="5"> <b>:</b>  </td><td colspan="2"><b><?=$nama_pn?></b>&nbsp;</td></tr>
				<? } ?>



				

 
				 </table>

				<br>


						<?

						  $sql_kawasan="SELECT distinct nama_kawasan,(SELECT COUNT(tbl_dok_pengadilan.kode_terpanggil) from tbl_dok_pengadilan
				 left join tbl_mast_pengadilan on tbl_mast_pengadilan.kode_pn = tbl_dok_pengadilan.kode_pn
			   inner join tbl_mast_perwakilan on tbl_dok_pengadilan.kode_perwakilan=tbl_mast_perwakilan.kode_perwakilan
				LEFT JOIN tbl_mast_negara ON tbl_mast_perwakilan.kode_negara=tbl_mast_negara.kode_negara
				LEFT JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan
				where   1=1  ";


					if ($tahun !='') {
					 $sql_kawasan .= " and  LEFT(tbl_dok_pengadilan.tgl_surat_keluar,4) ='$tahun'  ";
					 }

					if ($bulan !='') {
					 $sql_kawasan .= " and MONTH(tgl_surat_keluar)= '$bulan' ";
					 }

					if ($kode_jenis_panggil !='') {
					$sql_kawasan.= "and  kode_jenis_panggil ='$kode_jenis_panggil' ";
					}

					if ($kode_asal !='') {
					$sql_kawasan.= "and  tbl_mast_pengadilan.kode_asal ='$kode_asal' ";
					}


					 if ($kode_pn !='') {
						$sql_kawasan.= "and  tbl_dok_pengadilan.kode_pn ='$kode_pn' ";
					 }

					if ($no_propinsi !='') {
					$sql_kawasan.= "and  tbl_mast_pengadilan.no_propinsi ='$no_propinsi' ";
					}
 
				 
				 $sql_kawasan.= "   and   tbl_mast_kawasan.kode_kawasan=a.kode_kawasan) as orang  	FROM tbl_mast_kawasan a  ";
				 
				
				if ($kode_kawasan !='') {
				 	$sql_kawasan.="  where  a.kode_kawasan = '$kode_kawasan' ";
			    }	


				 $sql_kawasan.= " order by nama_kawasan ";
 $rs = $db->Execute($sql_kawasan);				


	$chart = new VerticalBarChart();

	$dataSet = new XYDataSet();
	while(!$rs->EOF): 
		
		$nama_kawasan = $rs->fields['nama_kawasan'];
		$jml_wni = $rs->fields['orang'];

			$dataSet->addPoint(new Point($nama_kawasan,$jml_wni));
 
	 $rs->MoveNext();
	 endwhile;

	$chart->setDataSet($dataSet);

	$chart->setTitle("GRAFIK REKAP RELAAS DALAM NEGERI");

	$chart->render("generated/demo1.png");
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>GRAFIK REKAP RELAAS DALAM NEGERI</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Vertical bars chart" src="generated/demo1.png" style="border: 1px solid gray;"/>
</body>
</html>
