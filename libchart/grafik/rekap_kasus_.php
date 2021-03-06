<? 
 $sql_kawasan= "select IFNULL(count(*),0) as orang, nama_negara from tbl_kasus_pengaduan
inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
left  join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara 
 inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan 
inner  JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan 
 	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus 
 inner join tbl_wni on tbl_kasus_pengaduan.kode_wni = tbl_wni.kode_wni where 1=1 

";
 
			  if ($kode_kasus!='') { 
								  $sql_kawasan.= "  AND tbl_kasus_pengaduan_detail.kode_kasus='$kode_kasus' ";
			  }


			  if ($tahun!='') { 
								  $sql_kawasan.= "  AND year(tgl_pengaduan)='$tahun' ";		
			  
			  }

			  if ($bulan!='') { 
								  $sql_kawasan.= "  and month(tgl_pengaduan)='$bulan' ";		
			  
			  }

 

			 	 if ($kode_klasifikasi_wni !='') { 
					 $sql_kawasan.= " AND kode_sumber='$kode_klasifikasi_wni' ";
					 }
							 if ($kode_jenis !='') { 
									 $sql_kawasan.= " and tbl_wni.kode_jenis='$kode_jenis' ";
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



							if ($kode_kawasan!='') { 
								  $sql_kawasan.= "  AND tbl_mast_negara.kode_kawasan='$kode_kawasan' ";
							 }


$sql_kawasan.=" group by tbl_mast_negara.kode_negara  ";
 
 
 $rs = $db->Execute($sql_kawasan);				

if ($jenis_grafik==1) {
	$chart = new VerticalBarChart();
	$dataSet = new XYDataSet();
	while(!$rs->EOF):		
		$nama_kawasan = $rs->fields['nama_negara'];
		$orang = $rs->fields['orang'];
		if ($orang !='') {
			$dataSet->addPoint(new Point($nama_kawasan,$orang)); 
		}
	 $rs->MoveNext();
	 endwhile;
	$chart->setDataSet($dataSet);
	$chart->setTitle("GRAFIK REKAP KASUS PER NEGARA ");
	$chart->render("generated/demo1.png");


} else if ($jenis_grafik==2) {
	$chart = new LineChart();
	$dataSet = new XYDataSet();
 
	 while(!$rs->EOF):		
		$nama_kawasan = $rs->fields['nama_negara'];
		$orang = $rs->fields['orang'];
		if ($orang !='') {
			$dataSet->addPoint(new Point($nama_kawasan,$orang)); 
		} 
	 $rs->MoveNext();
	 endwhile;



	$chart->setDataSet($dataSet);

	$chart->setTitle("GRAFIK REKAP KASUS PER NEGARA ");
	$chart->render("generated/demo5.png");

} else if ($jenis_grafik==3) { //pie Chart
		$chart = new HorizontalBarChart(600, 450);

	$dataSet = new XYDataSet();

 	 
	  while(!$rs->EOF):		
		$nama_kawasan = $rs->fields['nama_negara'];
		$orang = $rs->fields['orang'];
		if ($orang !='') {
			$dataSet->addPoint(new Point($nama_kawasan,$orang)); 
		}
	 $rs->MoveNext();
	 endwhile;


	$chart->setDataSet($dataSet);
	$chart->getPlot()->setGraphPadding(new Padding(5, 30, 20, 140));

	$chart->setTitle("GRAFIK REKAP KASUS PER NEGARA ");
	$chart->render("generated/demo2.png");


} 
?>