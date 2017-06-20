<?PHP

ob_start();
$tahun= $_GET[tahun];
$no_mutasi= $_GET[id];
$key= '1234';



require_once('fpdf/fpdf.php');
require_once('../includes/db.conf.php');
require_once('../includes/config.conf.php');
require_once('../adodb/adodb.inc.php');
 
//$no_mutasi=rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC, md5(md5($key))), "\0");

//$p = new Pager; 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

    
    
    
    
$sql_pw="SELECT peg.r_pegawai__nama AS nama,
	peg.r_cabang__nama AS r_cabang__nama,
	peg.r_jabatan__ket AS r_jabatan__ket,
	peg.r_pnpt__finger_print AS r_pnpt__finger_print,
        peg.r_pnpt__nip AS r_pnpt__nip,
          peg.r_pegawai__id as r_pegawai__id,
	DATE_FORMAT(
	peg.r_pegawai__tgl_masuk,'%d-%m-%Y') AS r_pegawai__tgl_masuk,
        peg.r_pnpt__shift AS r_pnpt__shift,
        TIMESTAMPDIFF(YEAR,peg.r_pegawai__tgl_masuk,DATE_FORMAT(NOW(), '%Y-%m-%d')) AS lama_kerja,
	peg.r_pnpt__no_mutasi AS r_pnpt__no_mutasi
        from v_pegawai peg
        WHERE
        r_pnpt__no_mutasi='$no_mutasi' AND peg.r_pnpt__aktif='1'";

$rs_pw	= $db->execute($sql_pw);
$nm_cabang=$rs_pw->fields['r_cabang__nama'];
$no_cuti=$rs_pw->fields['t_cuti__no'];
$nama_karyawan=$rs_pw->fields['nama'];
$tgl_masuk=$rs_pw->fields['r_pegawai__tgl_masuk'];
$r_jabatan__ket=$rs_pw->fields['r_jabatan__ket'];
$finger=$rs_pw->fields['finger'];
$nip=$rs_pw->fields['nip'];
$shift_karyawan=$rs_pw->fields['r_pnpt__shift'];
$lama_kerja=$rs_pw->fields['lama_kerja'];
$karyawan_id=$rs_pw->fields['r_pegawai__id'];


$now=date("Y-m-d");
$now = explode('-', $now);
$now_year  = $now[0];
$now_month = $now[1];
$now_day   = $now[2];

$tgl_masuk_explode=date($tgl_masuk);
$tgl_masuk_explode = explode('-',$tgl_masuk_explode);
$exp_tgl_msk   = $tgl_masuk_explode[0];
$exp_bln_msk   = $tgl_masuk_explode[1];
$exp_tahun_msk = $tgl_masuk_explode[2];
 
$d1 = new DateTime($tgl_masuk);
$d2 = new DateTime(date("Y-m-d"));
$diff = $d2->diff($d1);
$role_cuti=$diff->y;

$start_cuti=array(trim($now_year),trim($exp_bln_msk),trim($exp_tgl_msk));
$expired_cuti=array(trim($now_year+1),trim($exp_bln_msk),trim($exp_tgl_msk));


//$periode_aktif   = implode("-",$start_cuti);
//$periode_expired = implode("-",$expired_cuti);



//cek aktivasi cuti
$sql_cek_aktivasi="SELECT 
B.THN_AWAL,DATE_ADD(B.THN_AWAL,INTERVAL 1 YEAR) AS THN_AKHIR,
B.r_pegawai__nama,
B.r_pegawai__tgl_masuk,
B.r_pegawai__id,
B.mulai_cuti 
FROM (SELECT A.*,
DATE_ADD(A.r_pegawai__tgl_masuk,INTERVAL (A.mulai_cuti) YEAR) AS THN_AWAL
FROM (SELECT r_pegawai__tgl_masuk,r_pnpt__no_mutasi,r_pegawai__id,
YEAR(CURDATE()) AS tahun_now,
FLOOR(DATEDIFF(CURDATE(),r_pegawai__tgl_masuk)/365) as mulai_cuti, 
r_pegawai__nama 
FROM v_pegawai peg
left join t_cuti On t_cuti__atasan_nip=peg.r_pnpt__nip
where r_pnpt__aktif=1 and r_pegawai__id='$karyawan_id' limit 1)A)B";
                        
$rs_val = $db->Execute($sql_cek_aktivasi);
$periode_aktif= $rs_val->fields['THN_AWAL'];
$periode_expired= $rs_val->fields['THN_AKHIR'];
$mulai_cuti= $rs_val->fields['mulai_cuti'];
//cek aktivasi cuti



$sql_cek_cutibersama="SELECT COUNT(*) AS JML_CUTI FROM t_libur WHERE t_libur.r_libur__shift= '$shift_karyawan' 
                        AND t_libur.r_libur__jenis= '2' 
                        and t_libur.r_libur__tgl>='$periode_aktif' AND t_libur.r_libur__tgl<='$periode_expired'";
//  var_dump($sql_pw)or die();                       
$rs_val = $db->Execute($sql_cek_cutibersama);
$jml_cutibersama= $rs_val->fields['JML_CUTI'];





  
$sql_cek_cuber="SELECT t_cuti.t_cuti__lama_hari as lama_cuti FROM t_cuti 
WHERE t_cuti.t_cuti__jenis_cuti = '1' and t_cuti.t_cuti__nip='$no_mutasi'
AND t_cuti.t_cuti__awal>='$periode_aktif' AND t_cuti.t_cuti__awal<='$periode_expired'";
     
   
    $rs_cuber	= $db->execute($sql_cek_cuber);
    $jml_cuti_tahunan=$rs_cuber->fields['jml_libur_bersama'];

  
if($lama_kerja>=1)
    {
        $role_cuti_label='OK Bisa > 1 Thn';
    } else 
    {
        $role_cuti_label='Belum 1 Thn Tidak Bisa Ambil Cuti Tahunan';
    }
    
    
   $sql_tahunan="SELECT SUM(t_cuti__lama_hari) AS cuti
                FROM v_pegawai peg
                INNER JOIN t_cuti ON t_cuti.t_cuti__nip=peg.r_pnpt__no_mutasi
                where r_pnpt__no_mutasi='$no_mutasi' AND t_cuti.t_cuti__jenis_cuti='1'  
 AND t_cuti__awal between '$periode_aktif' and '$periode_expired'";

$rs_tahunan	= $db->execute($sql_tahunan);
$cuti_tahunan_jml=$rs_tahunan->fields['cuti']; 
    
 IF($cuti_tahunan_jml<= 0)
{
    $cuti_tahunan_jml='0';
}  else {
    $cuti_tahunan_jml=$rs_tahunan->fields['cuti'];
}
   

 $sql_khusus="SELECT
	
	COUNT(*) AS cuti
	
FROM
v_pegawai peg
INNER JOIN t_cuti ON t_cuti.t_cuti__nip=peg.r_pnpt__no_mutasi
where r_pnpt__no_mutasi='$no_mutasi' AND t_cuti.t_cuti__jenis_cuti=2 AND t_cuti__awal between '$periode_aktif' and '$periode_expired'";

$rs_khusus	= $db->execute($sql_khusus);
$cuti_khusus=$rs_khusus->fields['cuti'];   

 IF($cuti_khusus<= 0)
{
    $cuti_khusus_jml='0';
}  else {
    $cuti_khusus_jml=$rs_khusus->fields['cuti'];
}


$sisa_cuti=((12)-($jml_cutibersama+$cuti_tahunan_jml));

IF($sisa_cuti<=0)
{
    $label_sisa='Habis Tidak Dapat Ambil Cuti Tahunan';
}  else {
    $label_sisa= $sisa_cuti.' Hari lagi Boleh Diambil';
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
$pdf->SetFont('helvetica','B',12); 
$pdf->SetFont('helvetica','U',12); 
$pdf->SetLeftMargin(75);
$pdf->Cell(80,1,'Report Cuti Karyawan',0,'C',1); //TBLR (untuk garis)=> B = Bottom,
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
$pdf->Cell(60,6,': '.$nama_karyawan,'',0,'L',true);
$pdf->Ln();

$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'NIP','',0,'L',true);
$pdf->Cell(60,6,': '.$rs_pw->fields['r_pnpt__nip'],'',0,'L',true);
$pdf->Ln();



$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Finger Print','',0,'L',true);
$pdf->Cell(60,6,': '.$rs_pw->fields['r_pnpt__finger_print'],'',0,'L',true);
$pdf->Ln();


$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Jabatan','',0,'L',true);
$pdf->Cell(60,6,': '.$rs_pw->fields['r_jabatan__ket'],'',0,'L',true);
$pdf->Ln();

$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Tgl Masuk','',0,'L',true);
$pdf->Cell(60,6,': '.$tgl_masuk,'',0,'L',true);
$pdf->Ln();

$pdf->Cell(5,6,'','',0,'L',true);
$pdf->Cell(34,6,'Status Hak Cuti','',0,'L',true);
$pdf->Cell(60,6,': '.$role_cuti_label,'',0,'L',true);
$pdf->Ln();

//$pdf->Cell(5,6,'','',0,'L',true);
//$pdf->Cell(34,6,'Cuti Tahunan','',0,'L',true);
//$pdf->Cell(60,6,': '.$label_sisa,'',0,'L',true);


$pdf->Ln();
$pdf->SetTextColor(2,2,2);
// TOTAL 
$pdf->SetLeftMargin(15);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('helvetica','',10); 
$pdf->Cell(10,6,'1. Summary','',0,'',true);	
$pdf->Ln(); //KOLOM PENDIDIKAN
//$pdf->SetFillColor(120,180,230);
$pdf->SetFillColor(222,222,222);
$pdf->SetFont('helvetica','',10); 
$pdf->Cell(10,6,'No','LRT',0,'LRT',true);
$pdf->Cell(35,6,'Periode Aktif','LRT',0,'C',true);
$pdf->Cell(35,6,'Periode Expired','LRT',0,'C',true);
$pdf->Cell(35,6,'Cuti bersama ','LRT',0,'C',true);
$pdf->Cell(35,6,'Cuti Tahunan','LRT',0,'C',true);   

if($role_cuti>=1)
    {
        $pdf->Cell(35,6,'Sisa Cuti Tahunan','LRT',0,'C',true);  
    }
    else
    {
        $pdf->Cell(35,6,'Sisa Cuti Tahunan','LRT',0,'C',true);  
    }
 
$pdf->Ln(); //KOLOM PENDIDIKAN
$pdf->SetFillColor(255,255,255);
$pdf->SetFont('helvetica','',10); 
$pdf->Cell(10,6,'1','LRTB',0,'L',true);
$pdf->Cell(35,6,$periode_aktif,'LRTB',0,'C',true);
$pdf->Cell(35,6,$periode_expired,'LRTB',0,'C',true);
$pdf->Cell(35,6,$jml_cutibersama.' hari','LRTB',0,'C',true);
$pdf->Cell(35,6,$cuti_tahunan_jml.' hari','LRTB',0,'C',true);   

if($sisa_cuti>=1 and $mulai_cuti!=0)
    {
        $pdf->Cell(35,6,$sisa_cuti.' hari','LRTB',0,'C',true);   
    }
    elseif ($mulai_cuti==0) {
        
         $pdf->Cell(35,6,'Tidak Ada Cuti','LRTB',0,'C',true);   
    }
    else
    {
        $pdf->Cell(35,6,'Tidak Ada Hak Cuti','LRTB',0,'C',true);   
    }
    
 $pdf->Ln(); //KOLOM JABATAN
 $pdf->Ln(); //KOLOM JABATAN
 $pdf->Ln(); //KOLOM JABATAN
 $pdf->SetLeftMargin(15);

$pdf->SetFont('helvetica','',10); 
$pdf->Cell(10,6,'2.Report Detail ','',0,'',true);				  
	

$sql_cuti="SELECT
peg.r_pnpt__finger_print AS r_pnpt__finger_print,
peg.r_pnpt__nip AS r_pnpt__nip,
peg.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
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
peg.r_pegawai__nama AS r_pegawai__nama,
t_cuti.t_cuti__atasan_nip AS t_cuti__atasan_nip,
t_cuti__no AS t_cuti__no,
t_cuti__nip AS t_cuti__nip,
t_cuti__atasan_nama AS t_cuti__atasan_nama,
t_cuti__atasan_nip AS t_cuti__atasan_nip,
date_format(t_cuti__awal,'%d/%m/%Y') as t_cuti__awal,
date_format(t_cuti__akhir,'%d/%m/%Y') as t_cuti__akhir,
t_cuti__lama_hari AS t_cuti__lama_hari,
t_cuti__jenis_cuti AS t_cuti__jenis_cuti,
t_cuti__alasan AS t_cuti__alasan,
t_cuti__approval AS t_cuti__approval
FROM
v_pegawai peg
INNER JOIN t_cuti ON t_cuti.t_cuti__nip=peg.r_pnpt__no_mutasi AND peg.r_pnpt__aktif=1
WHERE  r_pnpt__no_mutasi = '$no_mutasi'   AND t_cuti.t_cuti__awal>='$periode_aktif' and t_cuti.t_cuti__awal<='$periode_expired'";


$result_jabatan = $db->Execute($sql_cuti);
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
            $pdf->Cell(60,6,'Dari Tgl','LRT',0,'C',true);
            $pdf->Cell(20,6,'Lama Hari','LRT',0,'C',true);
            $pdf->Cell(40,6,'Jenis','LRT',0,'C',true);
            $pdf->Cell(40,6,'Alasan','LRT',0,'C',true);
            
           
           
 for ($i=0;$i<=$z-1;$i++)
 {
            $pdf->Ln(); //KOLOM JABATAN
             $pdf->SetFillColor(255,255,255);
            $pdf->SetFont('helvetica','',10); 
            $pdf->Cell(10 ,6 ,$i+1,'LRTB',0,'L',true);
            
            $pdf->Cell(60 ,6,$data_jabatan[$i][t_cuti__awal].'  s/d  '.$data_jabatan[$i][t_cuti__akhir],'LRTB',0,'C',true);
            $pdf->Cell(20,6,$data_jabatan[$i][t_cuti__lama_hari],'LRTB',0,'C',true);
            
            if($data_jabatan[$i][t_cuti__jenis_cuti]==1)
            {
                $label_jenis='Cuti Tahunan';
            }  else {
             
                 $label_jenis='Cuti Khusus';
            }
            
            $pdf->Cell(40,6,$label_jenis,'LRTB',0,'C',true);
            $pdf->Cell(40,6,$data_jabatan[$i][t_cuti__alasan],'LRTB',0,'C',true);
           
 }
 
$date=  date('d-m-Y');
$namaFile="Cuti_$date.pdf" ;
$pdf->Output($namaFile,'D');
$pdf->Output();


?>