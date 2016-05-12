<br> 
 <link href="style.css" type="text/css" rel="stylesheet" />

<?php
 
 require_once('../../includes/db.conf.php');
 require_once('../../adodb/adodb.inc.php');
 
 $db = &ADONewConnection($DB_TYPE);
 // $db->debug = true;
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

if ($_GET['kode_kat_kasus']) $kode_kat_kasus = $_GET['kode_kat_kasus'];
else if ($_POST['kode_kat_kasus']) $kode_kat_kasus = $_POST['kode_kat_kasus'];
else $kode_kat_kasus="";
 

if ($_GET['no_propinsi']) $no_propinsi = $_GET['no_propinsi'];
else if ($_POST['no_propinsi']) $no_propinsi = $_POST['no_propinsi'];
else $no_propinsi="";
 
if ($_GET['id_kab']) $id_kab = $_GET['id_kab'];
else if ($_POST['id_kab']) $id_kab = $_POST['id_kab'];
else $id_kab="";

if ($_GET['usia']) $usia = $_GET['usia'];
else if ($_POST['usia']) $usia = $_POST['usia'];
else $usia="";

if ($_GET['jk']) $jk = $_GET['jk'];
else if ($_POST['jk']) $jk = $_POST['jk'];
else $jk="";


if ($_GET['search']) $search = $_GET['search'];
else if ($_POST['search']) $search = $_POST['search'];
else $search="";
 

 if ($_GET['kode_klasifikasi_wni']) $kode_klasifikasi_wni = $_GET['kode_klasifikasi_wni'];
else if ($_POST['kode_klasifikasi_wni']) $kode_klasifikasi_wni = $_POST['kode_klasifikasi_wni'];
else $kode_klasifikasi_wni="";
 

if ($_GET['kode_sektor']) $kode_sektor = $_GET['kode_sektor'];
else if ($_POST['kode_sektor']) $kode_sektor = $_POST['kode_sektor'];
else $kode_sektor="";
 

 if ($_GET['kode_jenis']) $kode_jenis = $_GET['kode_jenis'];
else if ($_POST['kode_jenis']) $kode_jenis = $_POST['kode_jenis'];
else $kode_jenis="";
 

				if ($no_propinsi !='') { 
				 $sql__="select upper(nama_propinsi) as nama_propinsi from tbl_mast_wil_propinsi where no_propinsi='$no_propinsi' ";
				 $rs__=$db->Execute($sql__);			  
				 $nama_propinsi = $rs__->fields['nama_propinsi']; 			 
	 
				 }
 
				  if ($id_kab !='') { 
				  $sql__="select upper(nama_kabupaten) as nama_kabupaten   from tbl_mast_wil_kabupaten where id_kabupaten='$id_kab' ";
				$rs__=$db->Execute($sql__);			  
				 $nama_kabupaten = $rs__->fields['nama_kabupaten']; 				 
				 

				  }

				  if ($jk!='') { 
					  if ($jk==1) {
						$nama_jk="PEREMPUAN";	
					  }
					    if ($jk==2) {
						$nama_jk="LAKI - LAKI ";	
					  }				  
				 }


				  if ($usia!='') { 
					  if ($usia==1) {
						$nama_usia=" 0 - 20 ";	
					  }
					    if ($usia==2) {
						$nama_usia="  21 - 40 ";	
					  }

					  if ($usia==3) {
						$nama_usia="  41 - 60 ";	
					  }

					  if ($usia==4) {
						$nama_usia="  60 Keatas ";	
					  }
  
					  
				 }
 
					


			    if ($kode_klasifikasi_wni!='') { 

					  if ($kode_klasifikasi_wni==1) {
						$nama_kw="WNI NON TKI";	
							if ($kode_jenis !='') {
							 $sql_jenis="select upper( nama_jenis_wni) as nama_jenis_wni  from tbl_mast_jenis_wni where  kode_jenis_wni='$kode_jenis' ";
							 $rs_jenis=$db->Execute($sql_jenis);			  
							 $nama_jenis = $rs_jenis->fields['nama_jenis_wni']; 

							}
					  }
					  if ($kode_klasifikasi_wni==3) {
						$nama_kw="  TKI FORMAL ";
						if ($kode_jenis !='') {
							 $sql_jenis="select  upper (nama_formal) as nama_formal  from tbl_mast_jenis_formal  where  kode_jenis_formal='$kode_jenis' ";
							  $rs_jenis=$db->Execute($sql_jenis);			  
							 $nama_jenis = $rs_jenis->fields['nama_formal']; 
							}
					  }

					   if ($kode_klasifikasi_wni==4) {
						$nama_kw="  TKI INFORMAL ";	
						if ($kode_jenis !='') {
							 $sql_jenis="select  upper(nama_informal) as nama_informal  from tbl_mast_jenis_informal  where  kode_jenis_informal='$kode_jenis' ";
							   $rs_jenis=$db->Execute($sql_jenis);			  
							 $nama_jenis = $rs_jenis->fields['nama_informal']; 
							}
					  }

					   if ($kode_klasifikasi_wni==6) {
						$nama_kw="  TKI ABK ";
						if ($kode_jenis !='') {
							 $sql_jenis="select  upper(nama_abk) as nama_abk  from tbl_mast_jenis_abk  where  kode_jenis_abk='$kode_jenis' ";
							  $rs_jenis=$db->Execute($sql_jenis);			  
							 $nama_jenis = $rs_jenis->fields['nama_abk']; 
							}
					  } 
					 $nama_klasifikasi = $nama_kw;
					  $nama_jenis = $nama_jenis;

				 }


?>


<table width="100%"    border=0 width="100%">	
				 
			 
				<? if ($nama_klasifikasi !='') {  ?>
				 <tr><td width="150" ><b>KLASIFIKASI WNI</b></td><td width="5"> <b>: </b></td><td colspan="2"><b><?=$nama_klasifikasi?></b> &nbsp;</td></tr>
				<? } ?>

				<? if ($nama_jenis !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>JENIS WNI</b></td><td width="5"> <b>:</b> </td><td colspan="2"><b><?=$nama_jenis?></b>&nbsp;</td></tr>
				<? } ?>
 

				<? if ($nama_propinsi !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>PROPINSI</b></td><td width="5"> <b>:</b>  </td><td colspan="2"><b><?=$nama_propinsi?></b>&nbsp;</td></tr>
				<? } ?>

				<? if ($nama_kabupaten !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>KABUPATEN</b></td><td width="5"> <b>:</b>  </td><td colspan="2"><b><?=$nama_kabupaten?></b>&nbsp;</td></tr>
				<? } ?>

				<? if ($nama_jk !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>JENIS KELAMIN</b></td><td width="5"> <b>:</b> </td><td colspan="2"><b><?=$nama_jk?></b> &nbsp;</td></tr>
				<? } ?>


				<? if ($nama_usia !='') {  ?>
				 <tr><td class="ewTableHeader"  width="100" ><b>USIA</b></td><td width="5"> <b>:</b>  </td><td colspan="2"><b><?=$nama_usia?> </b> &nbsp;</td></tr>
				<? } ?>

 
				 </table>

				<br>


						<?

						$sql_kawasan="select nama_kawasan ,
						 (select count(*) from tbl_wni  left join tbl_mast_wil_kabupaten on tbl_mast_wil_kabupaten.id_kabupaten=tbl_wni.id_kabupaten
						 left join tbl_mast_wil_propinsi on tbl_mast_wil_propinsi.no_propinsi=tbl_mast_wil_kabupaten.no_propinsi 
						 inner join tbl_mast_perwakilan on  tbl_mast_perwakilan.kode_perwakilan = tbl_wni.kode_perwakilan
						 left join  tbl_mast_negara  ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara  ";	 
						   $sql_kawasan.=" where 1=1  and tbl_mast_negara.kode_kawasan = a.kode_kawasan ";
 
							if ($kode_klasifikasi_wni !='') { 
									  $sql_kawasan.= " AND kode_sumber='$kode_klasifikasi_wni' ";
  							 }
							 if ($kode_jenis !='') { 
									 $sql_kawasan.= " and tbl_wni.kode_jenis='$kode_jenis' ";
							 }
 
							 if ($no_propinsi !='') { 
								  $sql_kawasan.= "  AND tbl_mast_wil_kabupaten.no_propinsi='$no_propinsi' ";
							 }

							 if ($id_kab !='') { 
								  $sql_kawasan.= "  AND tbl_wni.id_kabupaten='$id_kab' ";
							 }

							  if ($jk!='') { 
								  $sql_kawasan.= "  AND jk='$jk' ";
							 }

							
							if ($usia!='') { 
								  if ($usia=='1') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 0 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 20  ";
								 }

								 if ($usia=='2') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 21 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 40  ";
								 }

								  if ($usia=='3') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 41 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 60  ";
								 }


								   if ($usia=='4') { 
									  $sql_kawasan.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >=60 ";
								 }
 
							}
   

						  $sql_kawasan.=" ) as jml_wni "; 
 
						  $sql_kawasan.=" FROM tbl_mast_kawasan a     ";
				  

						 

						$sql_kawasan.= " order by nama_kawasan asc ";
						$rs = $db->Execute($sql_kawasan);				


	$chart = new VerticalBarChart();

	$dataSet = new XYDataSet();
	while(!$rs->EOF): 
		
		$nama_kawasan = $rs->fields['nama_kawasan'];
		$jml_wni = $rs->fields['jml_wni'];

			$dataSet->addPoint(new Point($nama_kawasan,$jml_wni));
 
	 $rs->MoveNext();
	 endwhile;

	$chart->setDataSet($dataSet);

	$chart->setTitle("GRAFIK DATA WNI PER KAWASAN ");

	$chart->render("generated/demo1.png");
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>GRAFIK REKAP WNI</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-15" />
</head>
<body>
	<img alt="Vertical bars chart" src="generated/demo1.png" style="border: 1px solid gray;"/>
</body>
</html>
