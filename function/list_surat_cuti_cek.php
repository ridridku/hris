 <?PHP
require_once('../includes/db.conf.php');
require_once('../adodb/adodb.inc.php');
require_once('../includes/config.conf.php');
//$p = new Pager; 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);


 if($_POST['no_mutasi'])
{ $no_mutasi= $_POST['no_mutasi'];
}else{ $no_mutasi = $_GET['no_mutasi'];}

 if($_POST['pil'])
{ $pil = $_POST['pil'];
}else{ $pil = $_GET['pil'];}


 if($_POST['cari'])
{ $cari = $_POST['cari'];
}else{ $cari = $_GET['cari'];}

$n_limit=20;
if (empty($_POST['paging']))
{	$hal_ke=1;
}else{
	$hal_ke = $_POST['paging'];
}
$hal_ke_ = $n_limit*($hal_ke-1);


// TAMBAHAN UNTUK AJAX WNI */
// TAMBAHAN UNTUK AJAX WNI */
// TAMBAHAN UNTUK AJAX WNI */
// TAMBAHAN UNTUK AJAX WNI */

if ($_GET[get_prop] == 1)
{  
	$no_propinsi = $_GET[no_prop_ktp];
	if($no_propinsi!=''){
					$sql_kabupaten = "SELECT A.r_provinsi__id,A.r_provinsi__nama,B.r_kabupaten__id,B.r_kabupaten__nama,B.r_kabupaten__sts FROM r_provinsi A
                                                            LEFT JOIN r_kabupaten B on A.r_provinsi__id = B.r_kabupaten__provinsi_id
                                                            WHERE A.r_provinsi__id='".$no_propinsi."' ORDER BY A.r_provinsi__id ASC";
					$recordSet_kabupaten = $db->Execute($sql_kabupaten);
					
					$input_kab="<select name=r_pegawai__ktp_kab  onchange=\"cari_kec_ktp(this.value)\">";
					$input_kab.="<option value=[Pilih Kabupaten]> ";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF):
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields['r_kabupaten__id'].">".$recordSet_kabupaten->fields['r_kabupaten__sts'].'-'.$recordSet_kabupaten->fields['r_kabupaten__nama'];
						$input_kab.="</option>";
					$recordSet_kabupaten->MoveNext();
					endwhile;
					$input_kab.="</select> ";
					//
					$delimeter   = "-";
                                      
					$option_choice = $input_kab."^/&".$delimeter;
					echo $option_choice;
                                        
                                        
			}
}

if ($_GET[get_kec] == 1)
{
	$kab_id = $_GET[kab_id];
    
			if($kab_id!=''){
					$sql_kecamatan = "SELECT A.r_kecamatan__id as kec_id,
                                                        A.r_kecamatan__kabupaten_id,
                                                        A.r_kecamatan__nama,
                                                        B.r_kabupaten__nama,
                                                        B.r_kabupaten__provinsi_id
                                                        FROM r_kecamatan A
                                                          LEFT JOIN r_kabupaten B on A.r_kecamatan__kabupaten_id= B.r_kabupaten__id
                                                           WHERE r_kabupaten__id='".$kab_id."' ORDER BY r_kecamatan__id ASC";
					$recordSet_kecamatan = $db->Execute($sql_kecamatan);
					
					//$input_kec="<select name=r_kecamatan__id onchange=\"cari_kec2($r_kecamatan__id,this.value)\">";
                                        $input_kec="<select name=r_pegawai__ktp_kec  onchange=\"cari_kec2_ktp(this.value)\">";
					$input_kec.="<option value=[Pilih Kecamatan]> ";
					$input_kec.="</option> ";
                                        
					while(!$recordSet_kecamatan->EOF):
						$input_kec.="<option value=";
						$input_kec.= $recordSet_kecamatan->fields[kec_id].">".$recordSet_kecamatan->fields['r_kecamatan__nama'];
                                            
						$input_kec.="</option>";
                                               
					$recordSet_kecamatan->MoveNext();
					endwhile;
					$input_kec.="</select> ";
					
					$delimeter   = "-";
					$option_choice = $input_kec."^/&".$delimeter;
					echo $option_choice;
			}
}

		
$sql_cek_cuber="SELECT COUNT(r_cutibersama.r_tglcuti__id) AS jml_libur_bersama FROM
            r_cutibersama r_cutibersama WHERE YEAR (r_cutibersama.r_tglcuti__tgl) = YEAR(NOW())GROUP BY YEAR (r_cutibersama.r_tglcuti__tgl)";
            $rs_cuber	= $db->execute($sql_cek_cuber);
            $jml_cuti_tahunan=$rs_cuber->fields['jml_libur_bersama'];

// END TAMBAHAN UNTUK AJAX WNI */


$sql="SELECT
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
	t_cuti.t_cuti__atasan_nip,
	t_cuti__no,
	t_cuti__nip,
	t_cuti__atasan_nama,
	t_cuti__atasan_nip,
	t_cuti__tgl,
	SUM(t_cuti__lama_hari) AS cuti,
	t_cuti__jenis_cuti,
	t_cuti__alasan
FROM
	v_pegawai peg
INNER JOIN t_cuti ON t_cuti.t_cuti__nip=r_pnpt__no_mutasi
where r_pnpt__no_mutasi='$no_mutasi' AND YEAR(t_cuti__tgl)=YEAR(NOW())";

$sql.=" GROUP BY r_pnpt__no_mutasi,t_cuti__jenis_cuti "; 
//var_dump($sql)or die();
$rs_paging	= $db->execute($sql);
$n_rec = $rs_paging->recordCount();
$sql .= "limit $hal_ke_,$n_limit ";
$n_page = ceil($n_rec/$n_limit);  
$rs2	= $db->execute($sql);
$list_arr_satuan = array();
$row_class = array();
$initSet = array();
$z=0;$i=1;$y=2;$n=0;
while($arr=$rs2->FetchRow()){
	array_push($list_arr_satuan, $arr); 
	if ($i%2==0){ 
			$ROW_CLASSNAME="#FFFFFF"; }
		else {
			$ROW_CLASSNAME="#F0F0F0";
	    }
    array_push($row_class, $ROW_CLASSNAME);
	array_push($initSet, $z);
	$z++;$i++;$y++;$n++;
}

$jum = count($list_arr_satuan);

$sql_pw="SELECT
	peg.r_pegawai__nama AS nama,
	peg.r_cabang__nama AS r_cabang__nama,
        DATE_FORMAT(peg.r_pegawai__tgl_masuk, '%d-%m-%Y') AS r_pegawai__tgl_masuk,    
        peg.r_pnpt__no_mutasi AS r_pnpt__no_mutasi	
        FROM
	v_pegawai peg

where r_pnpt__no_mutasi='$no_mutasi'";
//var_dump($sql_pw)or die();
$rs_pw	= $db->execute($sql_pw);
$nm_cabang=$rs_pw->fields['r_cabang__nama'];
$no_cuti=$rs_pw->fields['t_cuti__no'];
$nama_karyawan=$rs_pw->fields['nama'];
$tgl_masuk=$rs_pw->fields['r_pegawai__tgl_masuk'];

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

$periode_aktif   = implode("-",$start_cuti);
$periode_expired = implode("-",$expired_cuti);


if($role_cuti>=1)
    {
        $role_cuti_label='Bersangkutan Bisa Ambil Cuti Tahunan';
    } else 
    {
        $role_cuti_label='<font color="#ff0000">Maaf Bersangkutan/ Tidak Bisa Ambil Cuti Tahunan Belum 1 Tahun*</font>';
    }


$sql_tahunan="SELECT
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
	t_cuti.t_cuti__atasan_nip,
	t_cuti__no,
	t_cuti__nip,
	t_cuti__atasan_nama,
	t_cuti__atasan_nip,
	t_cuti__tgl,
	SUM(t_cuti__lama_hari) AS cuti,
	t_cuti__jenis_cuti,
	t_cuti__alasan
FROM
	v_pegawai peg
INNER JOIN t_cuti ON t_cuti.t_cuti__nip=peg.r_pnpt__no_mutasi
where r_pnpt__no_mutasi='$no_mutasi' AND t_cuti.t_cuti__jenis_cuti=1 AND t_cuti__tgl between '$periode_aktif' and '$periode_expired'";
//var_dump($sql_tahunan)or die();
$rs_tahunan	= $db->execute($sql_tahunan);
$cuti_tahunan_jml=$rs_tahunan->fields['cuti'];

IF($cuti_tahunan_jml<= 0)
{
    $cuti_tahunan_jml='0';
}  else {
    $cuti_tahunan_jml=$rs_tahunan->fields['cuti'];
}


$sql_khusus="SELECT
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
	t_cuti.t_cuti__atasan_nip,
	t_cuti__no,
	t_cuti__nip,
	t_cuti__atasan_nama,
	t_cuti__atasan_nip,
	t_cuti__tgl,
	SUM(t_cuti__lama_hari) AS cuti,
	t_cuti__jenis_cuti,
	t_cuti__alasan
FROM
v_pegawai peg
INNER JOIN t_cuti ON t_cuti.t_cuti__nip=peg.r_pnpt__no_mutasi
where r_pnpt__no_mutasi='$no_mutasi' AND t_cuti.t_cuti__jenis_cuti=2 AND YEAR (t_cuti__tgl) = YEAR (NOW())";

$rs_khusus	= $db->execute($sql_khusus);
$cuti_khusus=$rs_khusus->fields['cuti'];

IF($cuti_khusus<= 0)
{
    $cuti_khusus_jml='0';
}  else {
    $cuti_khusus_jml=$rs_tahunan->fields['cuti'];
}

$sisa_cuti=(12-($jml_cuti_tahunan+$cuti_tahunan_jml));
IF($sisa_cuti<=0)
{
    $label_sisa='<font color="#ff0000" ><b>'.$sisa_cuti.'  Habis Tidak bisa</b></font>';
}  else {
    $label_sisa='<font color="#2e20ea"><b>Jatah '.$sisa_cuti.' Hari lagi Boleh Diambil </b></font>';
}

?>
<link href="style.css" type="text/css" rel="stylesheet" />
<link href="formulir.css" type="text/css" rel="stylesheet" />
<SCRIPT LANGUAGE="JavaScript" SRC="global.js"></SCRIPT> 
<SCRIPT LANGUAGE="JavaScript" SRC="tw-ajax.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="tw-sack.js"></SCRIPT>
<SCRIPT LANGUAGE="JavaScript" SRC="<?=$HREF_THEME?>/defaults/javascripts/calendar/dhtmlgoodies_calendar.js"></SCRIPT>
<link rel="stylesheet" href="<?=$HREF_THEME?>/defaults/css/dhtmlgoodies_calendar.css" type="text/css">
<div id="ajax_input"> 
<form action="list_surat_cuti_cek.php" method="POST" name="frm">
<TABLE width="500" height="400" border="0" cellpadding="0" cellspacing="0">
<TR>
<TD width="500"  valign="top">
<table width="500" border="0" cellpadding="0" cellspacing="0">
<tr><td colspan="5" align="center" class="judul"><strong>&nbsp;</strong></td></tr>
<tr><td colspan="5" align="center" class="judul"><strong>DAFTAR  KARYAWAN </strong></td></tr>
<tr><td colspan="5" align="center"><hr width="100%"></td></tr> 
</table>
<table width="500" border="0" cellpadding="0" cellspacing="0" class="ewTable">
<TR><TD align="left">Nama</TD><TD align="left"><?= $nama_karyawan;?></TD> </TR>
<TR><TD align="left">Cabang </TD><TD align="left" valign="top" > <?PHP echo $nm_cabang;?></TD></TR>
<TR><TD align="left">Tgl Masuk </TD><TD align="left" valign="top" > <?PHP echo $tgl_masuk;?></TD></TR>
<TR><TD align="left">Keterangan </TD><TD align="left" valign="top" > <?PHP echo $role_cuti_label;?></TD></TR>
<TR><TD align="left">Periode Aktif</TD><TD align="left" valign="top" > <?PHP echo $periode_aktif;?></TD></TR>
<TR><TD align="left">Periode Expired </TD><TD align="left" valign="top" > <?PHP echo $periode_expired;?></TD></TR>
</TABLE>
<table width="500" border="0" cellpadding="0" cellspacing="0" class="ewTable">
       <TR><TD align="left"  class="ewTableHeader">NO</TD><TD align="left" valign="top" class="ewTableHeader">Jenis Cuti</TD> <TD align="left"  class="ewTableHeader">Jumlah Cuti</TD></TR>
       <TR><TD align="left">1</TD><TD align="left" valign="top" >Jatah Libur Cuti Bersama</TD><TD align="left"><?=  $jml_cuti_tahunan;?> Hari</TD></TR>
       <TR><TD align="left">2</TD><TD align="left" valign="top">Cuti Tahunan Yang Sudah Diambil</TD><TD align="left"><?=$cuti_tahunan_jml;?> Hari</TD></TR>
       <TR><TD align="left">3</TD><TD align="left" valign="top">Cuti Khusus Yang Sudah Diambil</TD><TD align="left"><?=$cuti_khusus_jml;?> Hari</TD></TR>
       <TR><TD align="left"></TD><TD align="left" valign="top">Sisa Cuti Tahunan  (12 Hari -(Cuti Bersama+cuti Tahunan))</TD><TD align="left"><?=$label_sisa;?> </TD></TR>
</TABLE>
<button type="button" onclick="window.open('', '_self', ''); window.close();">Close</button>

<script>
function GetPengaduan(r_pegawai__nama,r_pnpt__no_mutasi) {
         window.opener.document.getElementById('r_pegawai__nama').value=r_pegawai__nama;
         window.opener.document.getElementById('r_pnpt__no_mutasi').value=r_pnpt__no_mutasi;
         window.close();
    //    alert(KodeDepartemen);
}

function doPaging(hal) {
  frm.action="list_surat_cuti_cek.php";
  frm.submit();
}


function submit(){
  frm.action="list_surat_cuti_cek.php";
  frm.submit();
}

// JAVA SCRIPT AJAX
// JAVA SCRIPT AJAX

function checkFrm(theForm){
with (theForm){
	 if (kode_perwakilan.value == "") 
		{ 
			alert ("Silahkan Pilih Perwakilan !"); 
			kode_perwakilan.focus();
			return false; 
		}
	else if (finger_print.value == "") 
		{ 
			alert ("Silahkan isi No.Paspor WNI !"); 
			finger_print.focus();
			return false; 
		}
 
	 else if (nama.value == "") 
		{ 
			alert ("Silahkan isi Nama WNI !"); 
			nama.focus();
			return false; 
		}

	else if (jk.value == "") 
		{ 
			alert ("Silahkan Pilih Jenis Kelamin !"); 
			jk.focus();
			return false; 
		}

        else if (kode_klasifikasi_wni.value == "") 
		{ 
			alert ("Silahkan Pilih Jenis Klasifikasi WNI !"); 
			kode_klasifikasi_wni.focus();
			return false; 
		}
        else if (kode_jenis.value == "") 
	 		{ 
			alert ("Silahkan Pilih Jenis WNI !"); 
			kode_jenis.focus();
			return false; 
		}
 
	else
		{
			submit();
			return true;
		}
        }
	
    }

// CEK FORM
// CEK FORM
// CEK FORM
 
</script>