<?PHP
function print_content($cols1,$cols2,$cols3,$cols4,$cols5,$cols6,$cols7,$cols8) {
	
}


function print_header($nm_perwakilan,$bulan,$tahun,$data_tb) {
require_once('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->SetFont('helvetica','B',8);
$pdf->SetFillColor(255,255,255);
$pdf->AddPage('P','A4','');


		
$pdf->SetTextColor(0,0,0);
$pdf->Image('http://localhost/hris/laporan/fpdf/logo.jpg',15,9,15,15);


$pdf->SetFont('helvetica','B',14);  
$pdf->SetLeftMargin(35);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(35,3,'PT.TRITUNGGAL MULIA WISESSA',15);

$pdf->Ln();
$pdf->SetFont('helvetica','B',8); 
$pdf->Cell(35,4,'Jl.Kopo Jaya I No.8 Telp (022) 5416678 Fax.(022) 5415888',10);
$pdf->Ln();
$pdf->Cell(35,4,'Kompleks Perkantoran Kopo Cirangrang - Bandung 40224',10);
$pdf->Ln();
$pdf->Cell(35,4,'============================================================================================',0,'R',1);



//   
//$pdf->Cell(30,1,'',0,'C',1);
//
//$pdf->Cell(30,1,'',0,'C',1);

$pdf->Ln();
$pdf->SetLeftMargin(60);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('helvetica','B',13); 
$pdf->SetFont('helvetica','U',13); 
$pdf->Cell(0,1,'      SURAT KEPUTUSAN ',0,'C',1); //TBLR (untuk garis)=> B = Bottom,
$pdf->Ln();
$pdf->Ln();

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('helvetica','',10); 
$pdf->Cell(0,3,'       No.12 / HRD / TMW / '.$tahun ,0,'C',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

//Menimbang
$pdf->SetLeftMargin(27);
$pdf->Ln();
$pdf->SetFont('helvetica','B',12);
$pdf->Cell(27,1,'Menimbang  :',0,'',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('helvetica','',12);
$pdf->Cell(27,4,'Bahwa perusahaan Memandang perlu menegakkan peraturan dan tata tertib kerja, serta',0,'FJ',1);
$pdf->Ln();
$pdf->Cell(27,8,'ketentuan-ketentuan lain yang berlaku bagi karyawan PT.TRITUNGGAL MULIA WISESA ',0,'FJ',1);
$pdf->Ln();
$pdf->Ln();

//mengingat
$pdf->SetLeftMargin(27);
$pdf->SetFont('helvetica','B',12);
$pdf->Cell(27,1,'Mengingat  :',0,'',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('helvetica','',12);
$pdf->Cell(27,4,'Hasil Pemeriksaan dan bukti-bukti yang ditemukan serta keterangan -keterangan yang',0,'FJ',1);
$pdf->Ln();
$pdf->Cell(27,6,'dihimpun dan diakui oleh karyawan.berdasarkan PP PT.TMW Pasal 40 yang berbunyi : ',0,'FJ',1);
$pdf->Ln();
$pdf->Cell(27,7,'Melakukan Pelanggaran yang sama setelah diingatkan dan menerima teguran.',0,'FJ',1);

//mengingat
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetLeftMargin(27);
$pdf->SetFont('helvetica','B',12);
$pdf->Cell(0,1,'Maka dengan ini Memutuskan  :',0,'',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('helvetica','',12);
$pdf->Cell(27,4,'Memberikan sanksi SURAT PERINGATAN (KESATU) Kepada karyawan dibawah ini',0,'FJ',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(27,4,'Nama       ',0,'FJ',1);$pdf->Cell(27,4,' : '.$data_tb[0][r_pegawai__nama],10,'FJ',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(27,4,'Posisi     ',0,'FJ',1);$pdf->Cell(27,4,' : '.$data_tb[0][r_jabatan__ket],10,'FJ',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(27,4,'Cabang     ',0,'FJ',1);$pdf->Cell(27,4,' : '.$data_tb[0][r_cabang__nama],10,'FJ',1);
$pdf->Ln();
$pdf->Ln();
$pdf->MultiCell( 160,4,$data_tb[0][t_sp__alasan].'aa',0,'FJ',1);
//$pdf->Cell(27,4,'Karena telah melakukan kelalaian dan pelanggaran SOP yang telah diarahkan secara',0,'FJ',1);
//$pdf->Ln();
//$pdf->Cell(27,6,'tertu
//lis,terkait eksekusi SUB D Dan P3B.',0,'FJ',1);
//$pdf->Ln();
$pdf->Ln();
$pdf->Cell(27,4,'Apabila dalam waktu 6(enam) bulan sejak dibuatnya surat keputusan ini karyawan',0,'FJ',1);
$pdf->Ln();
$pdf->Cell(27,6,'kesalahan yang sama atau kesalahan lain maka perusahaan akan memberikan sanksi',0,'FJ',1);
$pdf->Ln();
$pdf->Cell(27,6,'lebih lanjut.',0,'FJ',1);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(27,4,'Demikian keputusan ini dibuat dan diberikan kepada Bapak / Ibu / Saurdara agar kemudian',0,'FJ',1);
$pdf->Ln();
$pdf->Cell(27,6,'hari dapat lebih hati-hati dan tidak melakukan kesalahan lagi.',0,'FJ',1);
$pdf->Ln();

$pdf->Cell(40,4,'Dibuat',0,'FJ',1);$pdf->Cell(27,4,'    : Bandung',10,'FJ',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,4,'Pada tanggal',0,'FJ',1);$pdf->Cell(27,4,'  : '.$data_tb[0][t_sp__tgl],10,'FJ',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

 	

$pdf->Ln(); //KOLOM 1
$pdf->Cell(40,3.5,'Yang membuat','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,'Penerima Sanksi','',0,'C',true);


$pdf->Ln(); //KOLOM 1
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);

$pdf->Ln(); //KOLOM 1
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);	

$pdf->Ln(); //KOLOM 1
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,' ','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);	


		
$pdf->Ln(); //KOLOM 1
$pdf->Cell(40,3.5,'Cecep Yosep','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,$data_tb[0][r_pegawai__nama],'',0,'C',true);

$pdf->SetFont('helvetica','',9);
$pdf->Ln(); //KOLOM 1
$pdf->Cell(40,3.5,'HGL Manager','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,$data_tb[0][r_jabatan__ket],'',0,'C',true);	



$pdf->Ln(); //KOLOM 1
$pdf->Cell(160,3.5,'Mengetahui','',0,'C',true);

$pdf->Ln(); //KOLOM 1
$pdf->Cell(160,3.5,'','',0,'C',true);

$pdf->Ln(); //KOLOM 1
$pdf->Cell(160,3.5,'','',0,'C',true);
$pdf->Ln(); //KOLOM 1
$pdf->Cell(160,3.5,'','',0,'C',true);

$pdf->Ln(); //KOLOM 1
$pdf->Cell(160,3.5,'','',0,'C',true);



$pdf->Ln(); //KOLOM 1
$pdf->SetFont('helvetica','',12);
$pdf->Cell(160,3.5,'Damian R Djono Putro','',0,'C',true);
$pdf->Ln(); //KOLOM 1
$pdf->SetFont('helvetica','',9);
$pdf->Cell(160,3.5,'COO','',0,'C',true);



//$pdf->Cell(120,400,$data_tb[0][r_pegawai__nama],0,0,1);
//$pdf->Ln();
//$pdf->SetFont('helvetica','',8);
//$pdf->Cell(27,400,'HGL Manager',0,'FJ',1);$pdf->Cell(120,400,$data_tb[0][r_jabatan__ket],0,0,1);


$date=date('d-m-Y');
$namaFile="Surat_Peringatan_$date.pdf" ;
//$pdf->Output($namaFile,'D');
$pdf->Output();


	
}


?>