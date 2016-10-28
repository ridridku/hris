<?PHP
ob_start();
$tahun= $_GET[tahun];
$bulan= $_GET[bulan];
//$kode_pw_ses =$_GET[kode_pw_ses];
$nip=$_GET[nip];
$no_mutasi=$_GET[no_mutasi];




require_once('fpdf/fpdf.php');
require_once('../includes/db.conf.php');
require_once('../includes/config.conf.php');
require_once('../adodb/adodb.inc.php');
 
//$p = new Pager; 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

$sql_cek_periode="SELECT
  r_penempatan.r_pnpt__nip AS r_pnpt__nip,
  r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
  r_penempatan.r_pnpt__jabatan AS r_pnpt__jabatan,
  r_penempatan.r_pnpt__id_pegawai AS r_pnpt__id_pegawai,
  r_penempatan.r_pnpt__status AS r_pnpt__status,
  r_penempatan.r_pnpt__tipe_salary AS r_pnpt__tipe_salary,
  r_penempatan.r_pnpt__subdept AS r_pnpt__subdept,
  r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
  r_penempatan.r_pnpt__gapok AS r_pnpt__gapok,
  r_penempatan.r_pnpt__subcab AS r_pnpt__subcab,
  r_penempatan.r_pnpt__shift AS r_pnpt__shift,
  r_penempatan.r_pnpt__kon_awal AS r_pnpt__kon_awal,
  r_penempatan.r_pnpt__kon_akhir AS r_pnpt__kon_akhir,
  r_penempatan.r_pnpt__aktif AS r_pnpt__aktif,
  r_jabatan.r_jabatan__id AS r_jabatan__id,
  r_jabatan.r_jabatan__ket AS r_jabatan__ket,
  r_subdepartement.r_subdept__id AS r_subdept__id,
  r_subdepartement.r_subdept__ket AS r_subdept__ket,
  r_departement.r_dept__akronim AS r_dept__akronim,
  r_departement.r_dept__id AS r_dept__id,
  r_departement.r_dept__ket AS r_dept__ket,
  r_subcabang.r_subcab__nama AS r_subcab__nama,
  r_cabang.r_cabang__nama AS r_cabang__nama,
  r_cabang.r_cabang__id AS r_cabang__id,
  r_subcabang.r_subcab__id AS r_subcab__id,
  r_subcabang.r_subcab__cabang AS r_subcab__cabang,
  r_pegawai.r_pegawai__id AS r_pegawai__id,
  r_pegawai.r_pegawai__nama AS r_pegawai__nama,
  r_pegawai.r_pegawai__tgl_lahir AS r_pegawai__tgl_lahir,
  r_pegawai.r_pegawai__ktp_prov AS r_pegawai__ktp_prov,
  r_pegawai.r_pegawai__ktp_kab AS r_pegawai__ktp_kab,
  r_pegawai.r_pegawai__ktp_kec AS r_pegawai__ktp_kec,
  r_pegawai.r_pegawai__ktp_desa AS r_pegawai__ktp_desa,
  r_pegawai.r_pegawai__agama AS r_pegawai__agama,
  r_pegawai.r_pegawai__tmpt_lahir AS r_pegawai__tmpt_lahir,
  r_pegawai.r_pegawai__jk AS r_pegawai__jk,
  r_pegawai.r_pegawai__ktp AS r_pegawai__ktp,
  r_pegawai.r_pegawai__sim AS r_pegawai__sim,
  r_pegawai.r_pegawai__nama_jalan AS r_pegawai__nama_jalan,
  r_pegawai.r_pegawai__ktp_rt AS r_pegawai__ktp_rt,
  r_pegawai.r_pegawai__ktp_rw AS r_pegawai__ktp_rw,
  r_pegawai.r_pegawai__ktp_kodepos AS r_pegawai__ktp_kodepos,
  r_pegawai.r_pegawai__alm_prov AS r_pegawai__alm_prov,
  r_pegawai.r_pegawai__alm_kab AS r_pegawai__alm_kab,
  r_pegawai.r_pegawai__alm_kec AS r_pegawai__alm_kec,
  r_pegawai.r_pegawai__alm_desa AS r_pegawai__alm_desa,
  r_pegawai.r_pegawai__alm_rt AS r_pegawai__alm_rt,
  r_pegawai.r_pegawai__alm_rw AS r_pegawai__alm_rw,
  r_pegawai.r_pegawai__alm_kodepos AS r_pegawai__alm_kodepos,
  r_pegawai.r_pegawai__tlp_rumah AS r_pegawai__tlp_rumah,
  r_pegawai.r_pegawai__tlp_pribadi AS r_pegawai__tlp_pribadi,
  r_pegawai.r_pegawai__tlp_kantor AS r_pegawai__tlp_kantor,
  r_pegawai.r_pegawai__gol_darah AS r_pegawai__gol_darah,
  r_pegawai.r_pegawai__tinggi AS r_pegawai__tinggi,
  r_pegawai.r_pegawai__berat AS r_pegawai__berat,
  r_pegawai.r_pegawai__ayah AS r_pegawai__ayah,
  r_pegawai.r_pegawai__ibu AS r_pegawai__ibu,
  r_pegawai.r_pegawai__ortu_prov AS r_pegawai__ortu_prov,
  r_pegawai.r_pegawai__ortu_kab AS r_pegawai__ortu_kab,
  r_pegawai.r_pegawai__ortu_kec AS r_pegawai__ortu_kec,
  r_pegawai.r_pegawai__ortu_desa AS r_pegawai__ortu_desa,
  r_pegawai.r_pegawai__ortu_rt AS r_pegawai__ortu_rt,
  r_pegawai.r_pegawai__ortu_rw AS r_pegawai__ortu_rw,
  r_pegawai.r_pegawai__ortu_kodepos AS r_pegawai__ortu_kodepos,
  r_pegawai.r_pegawai__npwp AS r_pegawai__npwp,
  r_pegawai.r_pegawai__no_bpjs AS r_pegawai__no_bpjs,
  r_pegawai.r_pegawai__no_askes AS r_pegawai__no_askes,
  r_pegawai.r_pegawai__bank1 AS r_pegawai__bank1,
  r_pegawai.r_pegawai__bank1_rek AS r_pegawai__bank1_rek,
  r_pegawai.r_pegawai__bank1_norek AS r_pegawai__bank1_norek,
  r_pegawai.r_pegawai__bank1_alm AS r_pegawai__bank1_alm,
  r_pegawai.r_pegawai__bank2 AS r_pegawai__bank2,
  r_pegawai.r_pegawai__bank2_rek AS r_pegawai__bank2_rek,
  r_pegawai.r_pegawai__bank2_norek AS r_pegawai__bank2_norek,
  r_pegawai.r_pegawai__bank2_alm AS r_pegawai__bank2_alm,
  r_pegawai.r_pegawai__pasangan AS r_pegawai__pasangan,
  r_pegawai.r_pegawai__pas_tgllahir AS r_pegawai__pas_tgllahir,
  r_pegawai.r_pegawai__pas_tmptlahir AS r_pegawai__pas_tmptlahir,
  r_pegawai.r_pegawai__pas_prov AS r_pegawai__pas_prov,
  r_pegawai.r_pegawai__pas_kab AS r_pegawai__pas_kab,
  r_pegawai.r_pegawai__pas_kec AS r_pegawai__pas_kec,
  r_pegawai.r_pegawai__pas_desa AS r_pegawai__pas_desa,
  r_pegawai.r_pegawai__pas_rt AS r_pegawai__pas_rt,
  r_pegawai.r_pegawai__pas_rw AS r_pegawai__pas_rw,
  r_pegawai.r_pegawai__pas_kodepos AS r_pegawai__pas_kodepos,
  r_pegawai.r_pegawai__pas_tlp AS r_pegawai__pas_tlp,
  r_pegawai.r_pegawai__pas_jml_anak AS r_pegawai__pas_jml_anak,
  r_pegawai.r_pegawai__pas_anak1 AS r_pegawai__pas_anak1,
  r_pegawai.r_pegawai__pas_anak2 AS r_pegawai__pas_anak2,
  r_pegawai.r_pegawai__pas_anak3 AS r_pegawai__pas_anak3,
  r_pegawai.r_pegawai__photo AS r_pegawai__photo,
  r_pegawai.r_pegawai__status_kawin AS r_pegawai__status_kawin,
  r_pegawai.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
  r_pegawai.r_pegawai__id_subcab AS r_pegawai__id_subcab,
  r_pegawai.r_pegawai__subdept AS r_pegawai__subdept,
  r_pegawai.r_pegawai__jabatan AS r_pegawai__jabatan,
  r_pegawai.r_pegawai__st_pegawai AS r_pegawai__st_pegawai,
  r_pegawai.r_pegawai__pend_tgl_lulus AS r_pegawai__pend_tgl_lulus,
  r_pegawai.r_pegawai__pend_akhir AS r_pegawai__pend_akhir,
  r_pegawai.r_pegawai__pend_sekolah AS r_pegawai__pend_sekolah,
  r_pegawai.r_pegawai__pend_jurusan AS r_pegawai__pend_jurusan,
  r_provinsi.r_provinsi__nama AS r_provinsi__nama,
  r_provinsi.r_provinsi__nama AS r_provinsi__nama,
  r_kabupaten.r_kabupaten__nama AS r_kabupaten__nama,
  r_kecamatan.r_kecamatan__nama AS r_kecamatan__nama,
  r_wilayah.r_desa__nama AS r_desa__nama,
  r_agama.r_agama__nama AS r_agama__nama

FROM
  r_pegawai
  INNER JOIN r_penempatan
    ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
  INNER JOIN r_jabatan
    ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
  INNER JOIN r_subdepartement
    ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
  INNER JOIN r_subcabang
    ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
  INNER JOIN r_departement
    ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
  INNER JOIN r_cabang
    ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
  INNER JOIN r_agama
    ON r_agama.r_agama__id = r_pegawai.r_pegawai__agama
  INNER JOIN r_provinsi
    ON r_provinsi__id = r_pegawai__ktp_prov
  INNER JOIN r_kabupaten
    ON r_kabupaten.r_kabupaten__id = r_pegawai__ktp_kab
  INNER JOIN r_kecamatan
    ON r_kecamatan.r_kecamatan__id = r_pegawai__ktp_kec
  INNER JOIN r_wilayah
    ON r_wilayah.r_desa__id = r_pegawai__ktp_desa 

  WHERE r_pnpt__nip='$nip'  AND r_pnpt__no_mutasi='$no_mutasi'";
             

        $rs_val = $db->Execute($sql_cek_periode);
  
        $no_mutasi = $rs_val->fields[r_pnpt__no_mutasi];
        $nip = $rs_val->fields[r_pnpt__nip];
        $nama_pegawai =$rs_val->fields[r_pegawai__nama];
     
        $tgl_lahir=$rs_val->fields[r_pegawai__tgl_lahir];
        $agama=$rs_val->fields[r_agama__nama];
        $ktp=$rs_val->fields[r_pegawai__ktp];
        $propinsi=$rs_val->fields[r_provinsi__nama];
        $kab=$rs_val->fields[r_kabupaten__nama];
        $kec=$rs_val->fields[r_kecamatan__nama]; 
        $desa=$rs_val->fields[r_desa__nama];
        
         $masuk_kerja=$rs_val->fields[r_pegawai__tgl_masuk];
         $r_cabang__nama =$rs_val->fields[r_cabang__nama];
        $r_subcab__nama =$rs_val->fields[r_subcab__nama];
        $r_dept__ket=$rs_val->fields[r_dept__ket];
        $jabatan=$rs_val->fields[r_jabatan__ket];
        
         $sekolah_th_lulus=$rs_val->fields[r_pegawai__pend_tgl_lulus];
         $sekolah_akhir=$rs_val->fields[r_pegawai__pend_akhir];
         $sekolah_nama=$rs_val->fields[r_pegawai__pend_sekolah];
         $sekolah_jur=$rs_val->fields[r_pegawai__pend_jurusan];
         
     
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
$pdf->SetFont('helvetica','B',12); 
$pdf->SetFont('helvetica','U',12); 
$pdf->SetLeftMargin(75);
$pdf->Cell(80,1,'BIO DATA KARYAWAN',0,'C',1); //TBLR (untuk garis)=> B = Bottom,
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->SetLeftMargin(30);
$pdf->SetFont('helvetica','',11);		
$pdf->Ln();		
$pdf->Ln();
$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Nama Karyawan','',0,'L',true);
$pdf->Cell(60,6,': '.$nama_pegawai,'',0,'L',true);
$pdf->Ln();

$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Nip karyawan','',0,'L',true);
$pdf->Cell(60,6,': '.$nip,'',0,'L',true);
$pdf->Ln();

$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Tgl Lahir','',0,'L',true);
$pdf->Cell(60,6,': '.$tgl_lahir,'',0,'L',true);
$pdf->Ln();


$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Agama','',0,'L',true);
$pdf->Cell(60,6,': '.$agama,'',0,'L',true);
$pdf->Ln();

$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'No KTP','',0,'L',true);
$pdf->Cell(60,6,': '.$ktp,'',0,'L',true);
$pdf->Ln();

$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Propinsi','',0,'L',true);
$pdf->Cell(60,6,': '.$propinsi,'',0,'L',true);
$pdf->Ln();


$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Kabupaten','',0,'L',true);
$pdf->Cell(60,6,': '.$kab,'',0,'L',true);
$pdf->Ln();


$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Kecamatan','',0,'L',true);
$pdf->Cell(60,6,': '.$kec,'',0,'L',true);
$pdf->Ln();


$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Desa / kelurahan','',0,'L',true);
$pdf->Cell(60,6,': '.$desa,'',0,'L',true);
$pdf->Ln();


$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Tgl Mulai Bekerja','',0,'L',true);
$pdf->Cell(60,6,': '.$masuk_kerja,'',0,'L',true);
$pdf->Ln();

$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Cabang','',0,'L',true);
$pdf->Cell(60,6,': '.$r_cabang__nama,'',0,'L',true);
$pdf->Ln();


$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Departemen','',0,'L',true);
$pdf->Cell(60,6,': '.$r_dept__ket,'',0,'L',true);
$pdf->Ln();


$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Jabatan','',0,'L',true);
$pdf->Cell(60,6,': '.$jabatan,'',0,'L',true);
$pdf->Ln();
    
//JABATAN BUKA
$pdf->SetLeftMargin(15);
$pdf->Ln();
$pdf->SetFont('helvetica','',10); 
$pdf->Cell(10,6,'1. RIWAYAT JABATAN','',0,'',true);				  
	
  $sql_jabatan="SELECT
  r_penempatan.r_pnpt__nip AS r_pnpt__nip,
  r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
  r_penempatan.r_pnpt__jabatan AS r_pnpt__jabatan,
  r_penempatan.r_pnpt__id_pegawai AS r_pnpt__id_pegawai,
  r_penempatan.r_pnpt__status AS r_pnpt__status,
  r_penempatan.r_pnpt__tipe_salary AS r_pnpt__tipe_salary,
  r_penempatan.r_pnpt__subdept AS r_pnpt__subdept,
  r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
  r_penempatan.r_pnpt__gapok AS r_pnpt__gapok,
  r_penempatan.r_pnpt__subcab AS r_pnpt__subcab,
  r_penempatan.r_pnpt__shift AS r_pnpt__shift,
  r_penempatan.r_pnpt__kon_awal AS r_pnpt__kon_awal,
  r_penempatan.r_pnpt__kon_akhir AS r_pnpt__kon_akhir,
  r_penempatan.r_pnpt__aktif AS r_pnpt__aktif,
  r_jabatan.r_jabatan__id AS r_jabatan__id,
  r_jabatan.r_jabatan__ket AS r_jabatan__ket,
  r_subdepartement.r_subdept__id AS r_subdept__id,
  r_subdepartement.r_subdept__ket AS r_subdept__ket,
  r_departement.r_dept__akronim AS r_dept__akronim,
  r_departement.r_dept__id AS r_dept__id,
  r_departement.r_dept__ket AS r_dept__ket,
  r_subcabang.r_subcab__nama AS r_subcab__nama,
  r_cabang.r_cabang__nama AS r_cabang__nama,
  r_cabang.r_cabang__id AS r_cabang__id,
  r_subcabang.r_subcab__id AS r_subcab__id,
  r_subcabang.r_subcab__cabang AS r_subcab__cabang,
  r_pegawai.r_pegawai__id AS r_pegawai__id,
  r_pegawai.r_pegawai__nama AS r_pegawai__nama
  
 
FROM
  r_pegawai
  LEFT JOIN r_penempatan
    ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
  LEFT JOIN r_jabatan
    ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
  LEFT JOIN r_subdepartement
    ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
  LEFT JOIN r_subcabang
    ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
  LEFT JOIN r_departement
    ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
  LEFT JOIN r_cabang
    ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
  
WHERE
  r_pnpt__nip = '$nip'  ";

$result_jabatan = $db->Execute($sql_jabatan);
$initSet = array();
$data_jabatan = array();
$z=0;
while ($arr=$result_jabatan->FetchRow()) {
	array_push($data_jabatan, $arr);
	array_push($initSet, $z);
	$z++;

   }  
            $pdf->Ln(); //KOLOM JABATAN
            //$pdf->SetFillColor(120,180,230);
            $pdf->SetFillColor(222,222,222);
            $pdf->SetFont('helvetica','',10); 
            $pdf->Cell(10,6,'No','LRT',0,'L',true);
            $pdf->Cell(40,6,'Tgl Kont Awal','LRT',0,'C',true);
            $pdf->Cell(40,6,'Tgl Kont Akhir','LRT',0,'C',true);
            $pdf->Cell(40,6,'JABATAN','LRT',0,'C',true);
            $pdf->Cell(40,6,'Cabang','LRT',0,'C',true);      
            
 for ($i=0;$i<=$z-1;$i++)
 {
            $pdf->Ln(); //KOLOM JABATAN
             $pdf->SetFillColor(255,255,255);
            $pdf->SetFont('helvetica','',10); 
            $pdf->Cell(10 ,6 ,$i+1,'LRTB',0,'L',true);
            $pdf->Cell(40 ,6,$data_jabatan[$i][r_pnpt__kon_awal],'LRTB',0,'C',true);
            $pdf->Cell(40,6,$data_jabatan[$i][r_pnpt__kon_akhir],'LRTB',0,'C',true);
            $pdf->Cell(40,6,$data_jabatan[$i][r_jabatan__ket],'LRTB',0,'C',true);
            $pdf->Cell(40,6,$data_jabatan[$i][r_cabang__nama],'LRTB',0,'C',true);
 }
 
 
 //PENDIKAN 
$pdf->SetLeftMargin(15);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('helvetica','',10); 
$pdf->Cell(10,6,'2. PENDIDIKAN','',0,'',true);	
$pdf->Ln(); //KOLOM PENDIDIKAN
//$pdf->SetFillColor(120,180,230);
$pdf->SetFillColor(222,222,222);
$pdf->SetFont('helvetica','',10); 
$pdf->Cell(10,6,'No','LRT',0,'L',true);
$pdf->Cell(40,6,'Nama Sekolah','LRT',0,'C',true);
$pdf->Cell(40,6,'Jenjang','LRT',0,'C',true);
$pdf->Cell(40,6,'Jurusan','LRT',0,'C',true);
$pdf->Cell(40,6,'Tahun Lulus','LRT',0,'C',true);   
 $pdf->Ln(); //KOLOM PENDIDIKAN
 $pdf->SetFillColor(255,255,255);
$pdf->SetFont('helvetica','',10); 
$pdf->Cell(10,6,'1','LRTB',0,'L',true);
$pdf->Cell(40,6,$sekolah_nama,'LRTB',0,'C',true);
$pdf->Cell(40,6,$sekolah_akhir,'LRTB',0,'C',true);
$pdf->Cell(40,6,$sekolah_jur,'LRTB',0,'C',true);
$pdf->Cell(40,6,$sekolah_th_lulus,'LRTB',0,'C',true);   
 

//PELATIHAN 
$pdf->SetLeftMargin(15);
$pdf->Ln();
$pdf->Ln();

$pdf->SetFont('helvetica','',10); 
$pdf->Cell(10,6,'3.PELATIHAN','',0,'',true);	
$pdf->Ln(); //KOLOM PENDIDIKAN
$pdf->SetFont('helvetica','',10); 
$pdf->SetFillColor(222,222,222);
$pdf->Cell(10,6,'No','LRTB',0,'L',true);
$pdf->Cell(60,6,'Training','LRT',0,'C',true);
$pdf->Cell(80,6,'Lembaga','LRT',0,'C',true);
$pdf->Cell(20,6,'Tahun','LRT',0,'C',true);

 $pdf->Ln(); //KOLOM PENDIDIKAN
 $pdf->SetFillColor(255,255,255);
$pdf->SetFont('helvetica','',10); 
$pdf->Cell(10,6,'1','LRTB',0,'L',true);
$pdf->Cell(60,6,$sekolah_nama,'LRTB',0,'C',true);
$pdf->Cell(80,6,$sekolah_akhir,'LRTB',0,'C',true);
$pdf->Cell(20,6,$sekolah_jur,'LRTB',0,'C',true);
  
  
 
$date=  date('d-m-Y');
$namaFile="Bio_Data_$date.pdf" ;
$pdf->Output($namaFile,'D');
$pdf->Output();


?>