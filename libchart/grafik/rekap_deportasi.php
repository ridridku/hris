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

if ($_GET['kode_kat_kasus']) $kode_kat_kasus = $_GET['kode_kat_kasus'];
else if ($_POST['kode_kat_kasus']) $kode_kat_kasus = $_POST['kode_kat_kasus'];
else $kode_kat_kasus="";
 
if ($_GET['kode_kawasan']) $kode_kawasan = $_GET['kode_kawasan'];
else if ($_POST['kode_kawasan']) $kode_kawasan = $_POST['kode_kawasan'];
else $kode_kawasan="";


if ($_GET['search']) $search = $_GET['search'];
else if ($_POST['search']) $search = $_POST['search'];
else $search="";
 

				
				
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
				$label="BULAN ".$nama_bulan;
				
				


?>


<table width="100%"    border=0 width="100%">	
				 
			 
				

				<? if ($bulan !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>BULAN</b></td><td width="5"> <b>:</b> </td><td colspan="2"><b><?=$nama_bulan?></b>&nbsp;</td></tr>
				<? } ?>
 

				<? if ($tahun !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>TAHUN</b></td><td width="5"> <b>:</b>  </td><td colspan="2"><b><?=$tahun?></b>&nbsp;</td></tr>
				<? } ?>

				
				 </table>

				<br>


						<?

						$sql_kawasan= "SELECT   nama_kawasan,
			(SELECT COUNT(tbl_pemulangan.kode_wni) from tbl_pemulangan 
			 inner join tbl_mast_perwakilan on tbl_pemulangan.kode_perwakilan=tbl_mast_perwakilan.kode_perwakilan
			LEFT JOIN tbl_mast_negara ON tbl_mast_perwakilan.kode_negara=tbl_mast_negara.kode_negara
			LEFT JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan
			where  1=1  " ;
			 
			if ($bulan !='') {	
				 $sql_kawasan .= "and MONTH(tgl_pemulangan)= '$bulan' ";
			}
			if ($tahun !='') {	
				 $sql_kawasan .= "and LEFT(tgl_pemulangan,4)= '$tahun' ";
			}
 
			 
			 $sql_kawasan .= " and tbl_mast_kawasan.kode_kawasan=a.kode_kawasan and kode_pilihan=1) as orang,";
			  
			$sql_kawasan .= " (SELECT COUNT(tbl_pemulangan.kode_wni) from tbl_pemulangan 
			 inner join tbl_mast_perwakilan on tbl_pemulangan.kode_perwakilan=tbl_mast_perwakilan.kode_perwakilan
			LEFT JOIN tbl_mast_negara ON tbl_mast_perwakilan.kode_negara=tbl_mast_negara.kode_negara
			LEFT JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan
			where  1=1  " ;
			 
			if ($bulan !='') {	
				 $sql_kawasan .= "and MONTH(tgl_pemulangan)= '$bulan' ";
			}
			if ($tahun !='') {	
				 $sql_kawasan .= "and LEFT(tgl_pemulangan,4)= '$tahun' ";
			}
 
			 $sql_kawasan .= " and tbl_mast_kawasan.kode_kawasan=a.kode_kawasan and kode_pilihan=2) as orang2,";

			$sql_kawasan .= "(SELECT COUNT(tbl_pemulangan.kode_wni) from tbl_pemulangan 
			 inner join tbl_mast_perwakilan on tbl_pemulangan.kode_perwakilan=tbl_mast_perwakilan.kode_perwakilan
			LEFT JOIN tbl_mast_negara ON tbl_mast_perwakilan.kode_negara=tbl_mast_negara.kode_negara
			LEFT JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan
			where  1=1  " ;
			 
			if ($bulan !='') {	
				 $sql_kawasan .= " and MONTH(tgl_pemulangan)= '$bulan' ";
			}
			if ($tahun !='') {	
				 $sql_kawasan .= "and LEFT(tgl_pemulangan,4)= '$tahun' ";
			}
 
			 $sql_kawasan .= " and tbl_mast_kawasan.kode_kawasan=a.kode_kawasan and kode_pilihan=3) as orang3 ";

			  $sql_kawasan .= " FROM tbl_mast_kawasan a  where 1=1  "; 
	   
 
				
				 $sql_kawasan .= " order by nama_kawasan";
						$rs = $db->Execute($sql_kawasan);				


	$chart = new VerticalBarChart();

	$serie1 = new XYDataSet();
	$serie2 = new XYDataSet();
	$serie3 = new XYDataSet();
	while(!$rs->EOF): 
		
		$nama_kawasan = $rs->fields['nama_kawasan'];
		$orang = $rs->fields['orang'];
		$orang2 = $rs->fields['orang2'];
		$orang3 = $rs->fields['orang3'];

			$serie1->addPoint(new Point($nama_kawasan,$orang));
			$serie2->addPoint(new Point($nama_kawasan,$orang2));
			$serie3->addPoint(new Point($nama_kawasan,$orang3));
	
	$dataSet = new XYSeriesDataSet();
	$dataSet->addSerie("Deportasi", $serie1);
	$dataSet->addSerie("Repatriasi", $serie2);
	$dataSet->addSerie("Evakuasi", $serie3);
	
	 $rs->MoveNext();
	 endwhile;

	$chart->setDataSet($dataSet);

	$chart->setTitle("GRAFIK DATA DEPORTASI/REPATRIASI/EVAKUASI PER KAWASAN ");

	$chart->render("generated/demo1.png");
?>

 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>GRAFIK REKAP DEPORTASI/REPATRIASI/EVAKUASI</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Vertical bars chart" src="generated/demo1.png" style="border: 1px solid gray;"/>
</body>
</html>
