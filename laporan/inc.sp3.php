<?PHP
ob_start();
$tahun= $_GET[tahun];
$bulan= $_GET[bulan];
$nip=$_GET[nip];
$no=$_GET[no];
$mutasi=$_GET[mutasi];


require_once('fpdf/fpdf.php');
require_once('../includes/db.conf.php');
require_once('../includes/config.conf.php');
require_once('../adodb/adodb.inc.php');
 
 
//$p = new Pager; 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);


  
function Romawi($n){
$hasil = "";
$iromawi = array("","I","II","III","IV","V","VI","VII","VIII","IX","X",20=>"XX",30=>"XXX",40=>"XL",50=>"L",
60=>"LX",70=>"LXX",80=>"LXXX",90=>"XC",100=>"C",200=>"CC",300=>"CCC",400=>"CD",500=>"D",600=>"DC",700=>"DCC",
800=>"DCCC",900=>"CM",1000=>"M",2000=>"MM",3000=>"MMM");
if(array_key_exists($n,$iromawi)){
$hasil = $iromawi[$n];
}elseif($n >= 11 && $n <= 99){
$i = $n % 10;
$hasil = $iromawi[$n-$i] . Romawi($n % 10);
}elseif($n >= 101 && $n <= 999){
$i = $n % 100;
$hasil = $iromawi[$n-$i] . Romawi($n % 100);
}else{
$i = $n % 1000;
$hasil = $iromawi[$n-$i] . Romawi($n % 1000);
}
return $hasil;
}
$bulan=  date("m");
$tahun= date("Y");
$bulan_romawi=Romawi($bulan);

//CLOSE BULAN_SESSION



$sql_cek_periode="SELECT 
                                            A.t_sp__no AS t_sp__no,
                                            A.t_sp__mutasi AS t_sp__mutasi,
                                            A.t_sp__hglm AS t_sp__hglm,
                                            A.t_sp__hglm_mutasi AS t_sp__hglm_mutasi,
                                            A.t_sp__atasan AS t_sp__atasan,
                                            A.t_sp__atasan_jabatan AS t_sp__atasan_jabatan,
                                            A.t_sp__tgl AS t_sp__tgl ,
                                            A.t_sp__tgl_expired AS t_sp__tgl_expired,
                                            unix_timestamp(A.t_sp__tgl) AS str_sp_keluar,
                                            unix_timestamp(A.t_sp__tgl_expired) AS str_sp_exp,
                                            unix_timestamp(date(now())) as str_sekarang,
                                            (UNIX_TIMESTAMP(DATE(NOW())))-(UNIX_TIMESTAMP(A.t_sp__tgl_expired)) AS selisih,
                                            A.t_sp__pelanggaran AS t_sp__pelanggaran,
                                            A.t_sp__jenis AS t_sp__jenis,
                                            A.t_sp__alasan AS t_sp__alasan,
                                            peg.r_pnpt__finger_print AS r_pnpt__finger_print,
                                            peg.r_pnpt__nip AS r_pnpt__nip,
                                            peg.r_pnpt__aktif AS r_pnpt__aktif,
                                            peg.r_jabatan__id AS r_jabatan__id,
                                            peg.r_jabatan__ket AS r_jabatan__ket,
                                            peg.r_subdept__id AS r_subdept__id,
                                            peg.r_subdept__ket AS r_subdept__ket,
                                            peg.r_dept__akronim AS r_dept__akronim,
                                            peg.r_dept__id AS r_dept__id,
                                            peg.r_dept__ket AS r_dept__ket,
                                            peg.r_subcab__nama AS r_subcab__nama,
                                            peg.r_cabang__nama AS r_cabang__nama,
                                            peg.r_cabang__id AS r_cabang__id,
                                            peg.r_subcab__id AS r_subcab__id,
                                            peg.r_subcab__cabang AS r_subcab__cabang,
                                            peg.r_pegawai__id AS r_pegawai__id,
                                            peg.r_pegawai__nama AS r_pegawai__nama
                                            FROM
                                            t_surat_peringatan A
                                            INNER JOIN v_pegawai peg ON peg.r_pnpt__no_mutasi=A.t_sp__mutasi
                                            WHERE r_pnpt__aktif=1  AND t_sp__mutasi='$mutasi' AND t_sp__no='$no'";
             

        $rs_val = $db->Execute($sql_cek_periode);
  
        $no = $rs_val->fields['t_sp__no'];
        $nip = $rs_val->fields['r_pnpt__nip'];
        $r_pegawai__nama =$rs_val->fields['r_pegawai__nama'];
        $r_cabang__nama =$rs_val->fields['r_cabang__nama'];
        $r_subcab__nama =$rs_val->fields['r_subcab__nama'];
        $r_dept__ket=$rs_val->fields['r_dept__ket'];
        $t_sp__tgl=$rs_val->fields['t_sp__tgl'];
        $t_sp__alasan=$rs_val->fields['t_sp__alasan'];
        $pelanggaran=$rs_val->fields['t_sp__pelanggaran'];
        $r_jabatan__ket=$rs_val->fields['r_jabatan__ket'];
        $t_sp__no=$rs_val->fields['t_sp__no'];
        $jenis=$rs_val->fields['t_sp__jenis'];
        $t_sp__tgl=$rs_val->fields['t_sp__tgl'];
        $tgl_keluar_sp=$rs_val->fields['t_sp__tgl'];
        $t_sp__tgl_expired=$rs_val->fields['t_sp__tgl_expired'];
        $t_sp__hglm = $rs_val->fields['t_sp__hglm'];
        $t_sp__hglm_mutasi =$rs_val->fields['t_sp__hglm_mutasi'];
        $t_sp__atasan = $rs_val->fields['t_sp__atasan'];
        $t_sp__atasan_jabatan = $rs_val->fields['t_sp__atasan_jabatan'];
        $tgl_keluar_sp1=TanggalIndo($tgl_keluar_sp);
        
        $t_sp__tgl = explode('-', $t_sp__tgl);
        $y1 = $t_sp__tgl[0];
        $m1 = $t_sp__tgl[1];
        $d1 = $t_sp__tgl[2];
        
        
        $t_sp__tgl_expired= explode('-',$t_sp__tgl_expired);
        $y2 = $t_sp__tgl_expired[0];
        $m2 = $t_sp__tgl_expired[1];
        $d2 = $t_sp__tgl_expired[2];
        
        
      $jml_bulan_sp=($m2-$m1)+1;
     
     if($jml_bulan_sp==1)
        {
               $huruf_sp="(Satu)";   
        }
     elseif($jml_bulan_sp==2)
        {
              $huruf_sp="(Dua)";   
        }
     elseif($jml_bulan_sp==3)
        {
            $huruf_sp="(Tiga)";  
        }
    elseif($jml_bulan_sp==4)
        {
            $huruf_sp="(Empat)";  
        }
    elseif($jml_bulan_sp==5)
        {
            $huruf_sp="(Lima)";  
        }
    else
         {
            $huruf_sp="Enam";  
        }    
      

     
     
        
          
        IF($jenis==1)
        {
            $ket_jenis="(KESATU)";
        }elseIF($jenis==2)
        {
             $ket_jenis="(KEDUA)";
        }else
        {
            $ket_jenis="(KETIGA)";
        }
            
 

$pdf = new FPDF();
$pdf->SetFont('helvetica','B',8);
$pdf->SetFillColor(255,255,255);
$pdf->AddPage('P','A4','');		
$pdf->SetTextColor(0,0,0);
$pdf->Image('http://hris.tmw.co.id/hris/laporan/logo.jpg',15,9,15,15,'JPG'); 
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
$pdf->Cell(35,4,'===============================================================================================',0,'R',1);



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
$pdf->SetLeftMargin(75);
$pdf->Cell(160,1,'SURAT KEPUTUSAN',0,'C',1); //TBLR (untuk garis)=> B = Bottom,
$pdf->Ln();
$pdf->Ln();

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('helvetica','',10); 
$pdf->SetLeftMargin(75);
$pdf->Cell(160,1,'             /HRD/TMW/'.$bulan_romawi.'/'.$tahun,0,'C',1);
//$pdf->Cell(160,1,'  No.'.$t_sp__no.'/HRD/TMW/'.$bulan_romawi.'/'.$tahun,0,'C',1); //NO ROMAWI
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
//$pdf->Cell(27,4,'Hasil Pemeriksaan dan bukti-bukti yang ditemukan serta keterangan -keterangan yang',0,'FJ',1);
//$pdf->Ln();
//$pdf->Cell(27,6,'dihimpun dan diakui oleh karyawan.berdasarkan PP PT.TMW Pasal 40 yang berbunyi : ',0,'FJ',1);
//$pdf->Ln();
//$pdf->Cell(27,7,'Melakukan Pelanggaran yang sama setelah diingatkan dan menerima teguran.',0,'FJ',1);
//$pdf->MultiCell( 160,4,$pelanggaran,0,'FJ',1);
$pdf->MultiCell(170, 5, $pelanggaran, 0, "L", 0, 5, 5, 5, 5); 
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
$pdf->Cell(27,4,'Memberikan sanksi SURAT PERINGATAN '.$ket_jenis.' Kepada karyawan dibawah ini',0,'FJ',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(27,4,'Nama       ',0,'FJ',1);$pdf->Cell(27,4,' : '.$r_pegawai__nama,10,'FJ',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(27,4,'Posisi     ',0,'FJ',1);$pdf->Cell(27,4,' : '.$r_jabatan__ket,10,'FJ',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(27,4,'Cabang     ',0,'FJ',1);$pdf->Cell(27,4,' : '.$r_cabang__nama,10,'FJ',1);
$pdf->Ln();
$pdf->Ln();
//$pdf->MultiCell( 160,4, $t_sp__alasan,0,'FJ',1);
$pdf->MultiCell(170, 5, $t_sp__alasan, 0, "L", 0, 5, 5, 5, 5); 

$pdf->Ln();
$pdf->Cell(27,4,'Apabila dalam waktu '.$jml_bulan_sp.' '.$huruf_sp.' bulan sejak dibuatnya surat keputusan ini karyawan',0,'FJ',1);
$pdf->Ln();
$pdf->Cell(27,6,'Melakukan kesalahan yang sama atau kesalahan lain maka perusahaan akan memberikan',0,'FJ',1);
$pdf->Ln();
$pdf->Cell(27,6,'sanksi lebih lanjut.',0,'FJ',1);

$pdf->Ln();
$pdf->Ln();
$pdf->Cell(27,4,'Demikian keputusan ini dibuat dan diberikan kepada Bapak / Ibu / Saudara agar kemudian',0,'FJ',1);
$pdf->Ln();
$pdf->Cell(27,6,'hari dapat lebih hati-hati dan tidak melakukan kesalahan lagi.',0,'FJ',1);
$pdf->Ln();

$pdf->Cell(40,4,'Dibuat',0,'FJ',1);$pdf->Cell(27,4,'    : Bandung',10,'FJ',1);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(40,4,'Pada tanggal',0,'FJ',1);$pdf->Cell(27,4,'  : '.$tgl_keluar_sp1,10,'FJ',1);
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
$pdf->Cell(40,5,$t_sp__hglm,'',0,'C',true);//NAMA HGLM
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,5,$r_pegawai__nama,'',0,'C',true);

$pdf->SetFont('helvetica','',7);
$pdf->Ln(); //KOLOM 1
$pdf->Cell(40,4,$t_sp__hglm_mutasi,'',0,'C',true);//HGLM MUTASI
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->Cell(40,3.5,'','',0,'C',true);
$pdf->SetFont('helvetica','',7);
$pdf->Cell(40,4,$r_jabatan__ket,'',0,'C',true);	



$pdf->Ln(); //KOLOM 1
$pdf->SetFont('helvetica','',10);
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
$pdf->Cell(160,5,$t_sp__atasan,'',0,'C',true);//atasan
$pdf->Ln(); //KOLOM 1
$pdf->SetFont('helvetica','',7);
$pdf->Cell(160,3.5,$t_sp__atasan_jabatan,'',0,'C',true);//atasan jabatan



//$pdf->Cell(120,400,$data_tb[0][r_pegawai__nama],0,0,1);
//$pdf->Ln();
//$pdf->SetFont('helvetica','',8);
//$pdf->Cell(27,400,'HGL Manager',0,'FJ',1);$pdf->Cell(120,400,$data_tb[0][r_jabatan__ket],0,0,1);


//$date=date('d-m-Y');
//$namaFile="Surat_Peringatan_$date.pdf" ;
//$pdf->Output($namaFile,'D');
$pdf->Output();


?>