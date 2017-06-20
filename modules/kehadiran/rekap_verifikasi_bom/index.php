<?php

# Including Main Configuration
# including file for Main Configurations
require_once('../../../includes/config.conf.php');


# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
	require_once('../../../includes/header.redirect.inc');
}else{

//yang harus dibuat session
$THEME = base64_encode("defaults");
$LANG = base64_encode("indonesia");
$_SESSION['THEME']	= $THEME;
$_SESSION['LANG']   = $LANG;

#FOR IMAGES CLASS PAGER
$HREF_IMAGES = $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images');

# including Header file for Content Expiring
require_once($DIR_INC.'/header.exp.inc');
# including Header file for Database Configuration
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');

require_once($DIR_INC.'/func.inc.php');

$p = new Pager;
$db = &ADONewConnection($DB_TYPE);
 //$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

# including the proper language file
require_once($DIR_LANG.'/'.base64_decode($_SESSION['LANG']).'.lang.php');
# including the proper theme template file and also generate output
//require_once($DIR_INC.'/copyright.tpl');

//=================================== BEGIN PARSING TEMPLATE BLOCK====================================

# including Header file for Smarty Parser Configurator
require_once($DIR_INC."/libs.inc.php");
# setting Smarty Class Debugger
//$smarty->debugging = true;

# Start Parsing the Template

$jenis_user  = $_SESSION['SESSION_JNS_USER'];
$kode_pw_ses  = $_SESSION['SESSION_KODE_CABANG'];
$periode_awal	= $_SESSION['SESSION_AWAL_AKTIF'];
$periode_akhir	= $_SESSION['SESSION_AKHIR_AKTIF'];  

$smarty->assign ("JENIS_USER_SES", $jenis_user);
$smarty->assign ("KODE_PW_SES", $kode_pw_ses);

IF ($kode_pw_ses==1){$nama_priv='COORDINATOR';}else{$nama_priv='BOM';}
$smarty->assign ("NAMA_PRIV", $nama_priv);

$smarty->assign ("PERIODE_AWAL", $periode_awal);
$smarty->assign ("PERIODE_AKHIR", $periode_akhir);

#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);
$smarty->assign ("HREF_HOME_PATH_AJAX", $HREF_HOME.'/modules/kehadiran/rekap_verifikasi_bom');
$smarty->assign ("HREF_IMG_PATH", $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images'));
$smarty->assign ("HREF_CSS_PATH", $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/css'));
$smarty->assign ("HREF_JS_PATH", $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts'));


#DIR
$smarty->assign ("DIR_HOME_PATH", $DIR_HOME);
$smarty->assign ("DIR_IMG_PATH", $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images'));
$smarty->assign ("DIR_CSS_PATH", $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/css'));
$smarty->assign ("DIR_JS_PATH", $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts'));
$smarty->assign ("SELF", $_SERVER['PHP_SELF']);

//------------------------------------LOCAL CONFIG--------------------------------------//
#SETTING FOR TEMPLATE
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kehadiran/rekap_verifikasi_bom/';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kehadiran');
$FILE_JS  = $JS_MODUL.'/rekap_verifikasi_bom';

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}

$user_id = base64_decode($_SESSION['UID']);

$smarty->assign ("MOD_ID", $mod_id);

#Initiate TABLE
$tbl_name	= "t_absensi";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//
if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="  tanggal desc ";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['kode_perwakilan_cari']) $kode_perwakilan_cari = $_GET['kode_perwakilan_cari'];
else if ($_POST['kode_perwakilan_cari']) $kode_perwakilan_cari = $_POST['kode_perwakilan_cari'];
else $kode_perwakilan_cari="";


if ($_GET['nama_karyawan_cari']) $nama_karyawan_cari = $_GET['nama_karyawan_cari'];
else if ($_POST['nama_karyawan_cari']) $nama_karyawan_cari = $_POST['nama_karyawan_cari'];
else $nama_karyawan_cari="";


if ($_GET['kode_subcab_cari']) $kode_subcab_cari = $_GET['kode_subcab_cari'];
else if ($_POST['kode_subcab_cari']) $kode_subcab_cari = $_POST['kode_subcab_cari'];
else $kode_subcab_cari="";

if ($_GET['id_finger_cari']) $id_finger_cari = $_GET['id_finger_cari'];
else if ($_POST['id_finger_cari']) $kode_subcab_cari = $_POST['id_finger_cari'];
else $id_finger_cari="";

if ($_GET['bulan']) $bulan = $_GET['bulan'];
else if ($_POST['bulan']) $bulan = $_POST['bulan'];
else $bulan="";

if ($_GET['tahun']) $tahun = $_GET['tahun'];
else if ($_POST['tahun']) $tahun = $_POST['tahun'];
else $tahun="";


$tahun_ses_aktif		=	$_SESSION['SESSION_TAHUN_AKTIF'];
$bulan_ses_aktif		=	$_SESSION['SESSION_BULAN_AKTIF'];
$smarty->assign ("TAHUN_SES", $tahun_ses_aktif);
$smarty->assign ("BULAN_SES", $bulan_ses_aktif);


 
$smarty->assign ("KODE_PERWAKILAN_CARI", $kode_perwakilan_cari);
$smarty->assign ("NAMA_KARYAWAN_CARI", $nama_karyawan_cari);
$smarty->assign ("KODE_SUBCAB_CARI", $kode_subcab_cari);
$smarty->assign ("KODE_SUBCAB_CARI2", $id_finger_cari);
$smarty->assign ("NAMA_WNI_CARI", $nama_wni_cari);
$smarty->assign ("KODE_SUMBER", $kode_sumber);
 
$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_perwakilan_cari=".$kode_perwakilan_cari."&kode_subcab_cari=".$kode_subcab_cari."&id_finger_cari=".$id_finger_cari."&nama_karyawan_cari=".$nama_karyawan_cari."&kode_sumber=".$kode_sumber;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;

//-----------------------DATA AJAX SUBCAB-----------------------------//

if ($_GET[get_subcab] == 1)
{  
    $subcabang = $_GET[no_subcab];   
			if($subcabang!=''){
					$sql_kabupaten = "SELECT cab.r_cabang__id,cab.r_cabang__nama,subcab.r_subcab__nama,subcab.r_subcab__id FROM r_cabang cab,r_subcabang subcab
                                                          where cab.r_cabang__id=subcab.r_subcab__cabang AND cab.r_cabang__id='$subcabang' ORDER BY cab.r_cabang__nama ASC";
					$recordSet_kabupaten = $db->Execute($sql_kabupaten);
					
					$input_kab="<select name=kode_subcab_cari >";
					$input_kab.="<option value=''> ";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF):
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields['r_cabang__id'].">".$recordSet_kabupaten->fields['r_subcab__nama'];
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
//-------------------------------------------closer ajax subcabang id-------------------------------------------------------------//

//-------------DATA CABANG--------------------------------------//
$sql_pwk = "SELECT * FROM r_cabang order by r_cabang__id  ";
$result_pwk = $db->Execute($sql_pwk);

$initSet = array();
$data_pwk = array();
$z=0;
while ($arr=$result_pwk->FetchRow()) {
	array_push($data_pwk, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_CABANG", $data_pwk);
//-------------CLOSE DATA CABANG-------------------------------------------------------//

//-----------------DATA SUBCABANG--------------------------------------------------------//

    $sql_subcab = "SELECT cab.r_cabang__id,cab.r_cabang__nama,subcab.r_subcab__nama,subcab.r_subcab__id FROM r_cabang cab,r_subcabang subcab
        where cab.r_cabang__id=subcab.r_subcab__cabang and cab.r_cabang__id='$kode_pw_ses'  order by subcab.r_subcab__id " ;
        
    $result_subcab = $db->Execute($sql_subcab);
        $initSet = array();
        $data_subcab = array();
        $z=0;
        while ($arr=$result_subcab->FetchRow()) {
                array_push($data_subcab, $arr);
                array_push($initSet, $z);
                $z++;
                        }
$smarty->assign ("DATA_SUBCABANG", $data_subcab);
 

//-------------CLOSE DATA SUBCABANG--------------------------------//
//-----------------------VIEW EDIT --------------------------------//
$opt = $_GET[opt];

$ed = 0;
if($opt=="1")
{     
    $sql_2= "SELECT 
                                    (C.rkp_peg-C.rkp_resign)as rkp_peg_aktif,
                                    C.* 
                                    FROM (SELECT 
                                    (B.JML_HARI-B.jml)+1 as mx_day,
                                    IF((r_resign.r_resign__approval)IS NULL ,'0','1')ket_keluar,
                                    COUNT(B.r_pnpt__no_mutasi) as rkp_peg,
                                    IF(SUM(B.t_rkp__approval=0)IS NULL,'0',SUM(B.t_rkp__approval=0)) as rkp_nol,
                                    IF(SUM(B.t_rkp__approval=1)IS NULL,'0',SUM(B.t_rkp__approval=1)) as rkp_hrd,
                                    IF(SUM(B.t_rkp__approval=2)IS NULL,'0',SUM(B.t_rkp__approval=2))as rkp_bom,
                                    IF(SUM(B.t_rkp__approval=3)IS NULL,'0',SUM(B.t_rkp__approval=3))as rkp_hglm,
                                    IF(SUM(B.t_rkp__approval=4)IS NULL,'0',SUM(B.t_rkp__approval=4))as rkp_closing,
                                    count(r_resign.r_resign__approval=1)as rkp_resign,
                                    B.*
                                    FROM (SELECT 
                                     datediff('$periode_akhir','$periode_awal') AS JML_HARI,
                                    COUNT(t_libur.r_libur__tgl) as jml,
                                    A.* 
                                    FROM  (SELECT 
                                    r_pegawai.r_pegawai__id,
                                    r_pegawai.r_pegawai__nama,
                                    r_pegawai.r_pegawai__tgl_masuk,
                                    peg.r_pnpt__subcab,
                                    peg.r_pnpt__jabatan,
                                    peg.r_pnpt__no_mutasi,
                                    peg.r_pnpt__finger_print,
                                    peg.r_pnpt__shift,
                                     peg.t_rkp__no_mutasi,
                                     IF((peg.t_rkp__awal)is null,'$periode_awal',peg.t_rkp__awal)as t_rkp__awal,
                                    IF((peg.t_rkp__akhir)is null,'$periode_akhir',peg.t_rkp__akhir)as t_rkp__akhir,
                                    IF((peg.t_rkp__approval)is null,'0',peg.t_rkp__approval)as t_rkp__approval,
                                    IF((peg.t_rkp__hadir)is null,'0',peg.t_rkp__hadir)as t_rkp__hadir,
                                    IF((peg.t_rkp__sakit)is null,'0',peg.t_rkp__sakit)as t_rkp__sakit,
                                    IF((peg.t_rkp__izin)is null,'0',peg.t_rkp__izin)as t_rkp__izin,
                                    IF((peg.t_rkp__alpa)is null,'0',peg.t_rkp__alpa)as t_rkp__alpa,
                                    IF((peg.t_rkp__dinas)is null,'0',peg.t_rkp__dinas)as t_rkp__dinas,
                                    IF((peg.t_rkp__cuti)is null,'0',peg.t_rkp__cuti)as t_rkp__cuti,
                                    IF((peg.t_rkp__keterangan)is null,'',peg.t_rkp__keterangan)as t_rkp__keterangan,
                                    r_departement.r_dept__id,
                                    r_departement.r_dept__ket,
                                    r_jabatan.r_jabatan__id,
                                    r_jabatan.r_jabatan__ket,
                                    r_cabang.r_cabang__id,
                                    r_cabang.r_cabang__nama,
                                    r_subcabang.r_subcab__id,
                                    r_subcabang.r_subcab__nama

                                     FROM 
                                    (SELECT mutasi.* FROM (
                                    SELECT 
                                    peg_rkp.*, rkp.* FROM (SELECT t_rekap_absensi.*
                                    FROM t_rekap_absensi WHERE t_rekap_absensi.t_rkp__awal='$periode_awal' and t_rekap_absensi.t_rkp__akhir='$periode_akhir')rkp 
                                    right JOIN (SELECT 
                                    r_penempatan.r_pnpt__no_mutasi,
                                    r_penempatan.r_pnpt__id_pegawai,
                                    r_penempatan.r_pnpt__nip,
                                    r_penempatan.r_pnpt__status,
                                    r_penempatan.r_pnpt__tipe_salary,
                                    r_penempatan.r_pnpt__subdept,
                                    r_penempatan.r_pnpt__jabatan,
                                    r_penempatan.r_pnpt__finger_print,
                                    r_penempatan.r_pnpt__gapok,
                                    r_penempatan.r_pnpt__subcab,
                                    r_penempatan.r_pnpt__shift,
                                    r_penempatan.r_pnpt__kon_awal,
                                    r_penempatan.r_pnpt__kon_akhir,
                                    r_penempatan.r_pnpt__pdrm,
                                    r_penempatan.r_pnpt__aktif,
                                    r_penempatan.r_pnpt__areakerja,
                                    r_penempatan.r_pnpt__tgl_efektif,
                                    r_penempatan.r_pnpt__date_created,
                                    r_penempatan.r_pnpt__date_updated,
                                    r_penempatan.r_pnpt__user_created,
                                    r_penempatan.r_pnpt__user_updated

                                    FROM r_penempatan ORDER BY 	r_penempatan.r_pnpt__no_mutasi DESC) peg_rkp
                                     ON peg_rkp.r_pnpt__id_pegawai=rkp.t_rkp__idpeg GROUP BY peg_rkp.r_pnpt__id_pegawai ORDER BY peg_rkp.r_pnpt__no_mutasi DESC)mutasi
                                    INNER JOIN r_pegawai On r_pegawai.r_pegawai__id=mutasi.r_pnpt__id_pegawai)peg
                                    inner join r_pegawai on r_pegawai.r_pegawai__id=peg.r_pnpt__id_pegawai
                                    INNER JOIN r_subcabang ON r_subcabang.r_subcab__id=peg.r_pnpt__subcab
                                    INNER JOIN r_cabang ON r_cabang.r_cabang__id=r_subcabang.r_subcab__cabang
                                    INNER JOIN r_jabatan ON r_jabatan__id=peg.r_pnpt__jabatan
                                    INNER JOIN r_subdepartement ON peg.r_pnpt__subdept=r_subdepartement.r_subdept__id
                                    INNER JOIN r_departement ON r_departement.r_dept__id=r_subdepartement.r_subdept__dept
                                    GROUP BY peg.r_pnpt__id_pegawai ORDER BY peg.r_pnpt__no_mutasi DESC)A
                                    inner JOIN t_libur ON t_libur.r_libur__shift=A.r_pnpt__shift 
                                    and t_libur.r_libur__tgl>='$periode_awal' and t_libur.r_libur__tgl<='$periode_akhir'
                                    WHERE A.r_pnpt__no_mutasi NOT IN (select DISTINCT  r_resign.r_resign__mutasi FROM r_resign 
                                    WHERE r_resign.r_resign__tgl <= '$periode_akhir'- INTERVAL DATEDIFF('$periode_akhir','$periode_awal') day and r_resign.r_resign__approval=1)
                                    GROUP BY A.r_pegawai__id ORDER BY A.r_pnpt__no_mutasi)B
                                    LEFT JOIN r_resign ON r_resign.r_resign__mutasi=B.r_pnpt__no_mutasi and r_resign__approval=1
                                    GROUP BY B.r_pegawai__id
                                    )C  WHERE C.r_cabang__id='$kode_pw_ses'";
 // var_dump($sql_2)or die();
$result_list_pjm = $db->Execute($sql_2);
$jumlah_menu_cek = $result_list_pjm->RecordCount();
$list_pjm = array();

$initSet = array();
$row_class = array();

$z=0;
while($arr = $result_list_pjm->FetchRow()){
array_push ($list_pjm, $arr);
if ($z%2==0){ 
		$ROW_CLASSNAME="#CCCCCC"; }
	else {
		$ROW_CLASSNAME="#EEEEEE";
	   }
	array_push($row_class, $ROW_CLASSNAME);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_RKP", $list_pjm);

$smarty->assign ("OPT", $opt);
$smarty->assign ("EDIT_ID",$edit_id);    
$smarty->assign ("EDIT_VAL", $edit);
}                    
//---------------------------------CLOSE VIEW EDIT ----------------------------------------------------------------//



//---------------------------------VIEW INDEX---------------------------------------------------------------------//
if ($_GET['search'] == '1')
    {
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
 
		  if($jenis_user=='2'){
                    $sql  = "SELECT  (C.rkp_peg-C.rkp_resign)as rkp_peg_aktif,C.* FROM (SELECT 
                                    IF((r_resign.r_resign__approval)IS NULL ,'0','1')ket_keluar,
                                    COUNT(B.r_pnpt__no_mutasi) as rkp_peg,
                                    IF(SUM(B.t_rkp__approval=0)IS NULL,'0',SUM(B.t_rkp__approval=0)) as rkp_nol,
                                    IF(SUM(B.t_rkp__approval=1)IS NULL,'0',SUM(B.t_rkp__approval=1)) as rkp_hrd,
                                    IF(SUM(B.t_rkp__approval=2)IS NULL,'0',SUM(B.t_rkp__approval=2))as rkp_bom,
                                    IF(SUM(B.t_rkp__approval=3)IS NULL,'0',SUM(B.t_rkp__approval=3))as rkp_hglm,
                                    IF(SUM(B.t_rkp__approval=4)IS NULL,'0',SUM(B.t_rkp__approval=4))as rkp_closing,
                                    count(r_resign.r_resign__approval=1)as rkp_resign,
                                    B.*
                                    FROM (SELECT 
                                     datediff('$periode_akhir','$periode_awal')+1 AS JML_HARI,
                                    COUNT(t_libur.r_libur__tgl) as jml,
                                    A.* 
                                    FROM  (SELECT 
                                    r_pegawai.r_pegawai__id,
                                    r_pegawai.r_pegawai__nama,
                                    r_pegawai.r_pegawai__tgl_masuk,
                                    peg.r_pnpt__subcab,
                                    peg.r_pnpt__jabatan,
                                    peg.r_pnpt__no_mutasi,
                                    peg.r_pnpt__finger_print,
                                    peg.r_pnpt__shift,
                                     peg.t_rkp__no_mutasi,
                                     IF((peg.t_rkp__awal)is null,'$periode_awal',peg.t_rkp__awal)as t_rkp__awal,
                                    IF((peg.t_rkp__akhir)is null,'$periode_akhir',peg.t_rkp__akhir)as t_rkp__akhir,
                                    IF((peg.t_rkp__approval)is null,'0',peg.t_rkp__approval)as t_rkp__approval,
                                    IF((peg.t_rkp__hadir)is null,'0',peg.t_rkp__hadir)as t_rkp__hadir,
                                    IF((peg.t_rkp__sakit)is null,'0',peg.t_rkp__sakit)as t_rkp__sakit,
                                    IF((peg.t_rkp__izin)is null,'0',peg.t_rkp__izin)as t_rkp__izin,
                                    IF((peg.t_rkp__alpa)is null,'0',peg.t_rkp__alpa)as t_rkp__alpa,
                                    IF((peg.t_rkp__dinas)is null,'0',peg.t_rkp__dinas)as t_rkp__dinas,
                                    IF((peg.t_rkp__cuti)is null,'0',peg.t_rkp__cuti)as t_rkp__cuti,
                                    IF((peg.t_rkp__keterangan)is null,'',peg.t_rkp__keterangan)as t_rkp__keterangan,
                                    r_departement.r_dept__id,
                                    r_departement.r_dept__ket,
                                    r_jabatan.r_jabatan__id,
                                    r_jabatan.r_jabatan__ket,
                                    r_cabang.r_cabang__id,
                                    r_cabang.r_cabang__nama,
                                    r_subcabang.r_subcab__id,
                                    r_subcabang.r_subcab__nama

                                     FROM 
                                    (SELECT mutasi.* FROM (
                                    SELECT 
                                    peg_rkp.*, rkp.* FROM (SELECT t_rekap_absensi.*
                                    FROM t_rekap_absensi WHERE t_rekap_absensi.t_rkp__awal='$periode_awal' and t_rekap_absensi.t_rkp__akhir='$periode_akhir')rkp 
                                    right JOIN (SELECT 
                                    r_penempatan.r_pnpt__no_mutasi,
                                    r_penempatan.r_pnpt__id_pegawai,
                                    r_penempatan.r_pnpt__nip,
                                    r_penempatan.r_pnpt__status,
                                    r_penempatan.r_pnpt__tipe_salary,
                                    r_penempatan.r_pnpt__subdept,
                                    r_penempatan.r_pnpt__jabatan,
                                    r_penempatan.r_pnpt__finger_print,
                                    r_penempatan.r_pnpt__gapok,
                                    r_penempatan.r_pnpt__subcab,
                                    r_penempatan.r_pnpt__shift,
                                    r_penempatan.r_pnpt__kon_awal,
                                    r_penempatan.r_pnpt__kon_akhir,
                                    r_penempatan.r_pnpt__pdrm,
                                    r_penempatan.r_pnpt__aktif,
                                    r_penempatan.r_pnpt__areakerja,
                                    r_penempatan.r_pnpt__tgl_efektif,
                                    r_penempatan.r_pnpt__date_created,
                                    r_penempatan.r_pnpt__date_updated,
                                    r_penempatan.r_pnpt__user_created,
                                    r_penempatan.r_pnpt__user_updated

                                    FROM r_penempatan ORDER BY 	r_penempatan.r_pnpt__no_mutasi DESC) peg_rkp
                                     ON peg_rkp.r_pnpt__id_pegawai=rkp.t_rkp__idpeg GROUP BY peg_rkp.r_pnpt__id_pegawai ORDER BY peg_rkp.r_pnpt__no_mutasi DESC)mutasi
                                    INNER JOIN r_pegawai On r_pegawai.r_pegawai__id=mutasi.r_pnpt__id_pegawai)peg
                                    inner join r_pegawai on r_pegawai.r_pegawai__id=peg.r_pnpt__id_pegawai
                                    INNER JOIN r_subcabang ON r_subcabang.r_subcab__id=peg.r_pnpt__subcab
                                    INNER JOIN r_cabang ON r_cabang.r_cabang__id=r_subcabang.r_subcab__cabang
                                    INNER JOIN r_jabatan ON r_jabatan__id=peg.r_pnpt__jabatan
                                    INNER JOIN r_subdepartement ON peg.r_pnpt__subdept=r_subdepartement.r_subdept__id
                                    INNER JOIN r_departement ON r_departement.r_dept__id=r_subdepartement.r_subdept__dept
                                    GROUP BY peg.r_pnpt__id_pegawai ORDER BY peg.r_pnpt__no_mutasi DESC)A
                                    inner JOIN t_libur ON t_libur.r_libur__shift=A.r_pnpt__shift 
                                    and t_libur.r_libur__tgl>='$periode_awal' and t_libur.r_libur__tgl<='$periode_akhir'
                                    WHERE A.r_pnpt__no_mutasi NOT IN (select DISTINCT  r_resign.r_resign__mutasi FROM r_resign 
                                    WHERE r_resign.r_resign__tgl <= '$periode_akhir'- INTERVAL DATEDIFF('$periode_akhir','$periode_awal') day and r_resign.r_resign__approval=1)
                                    GROUP BY A.r_pegawai__id ORDER BY A.r_pnpt__no_mutasi)B
                                    LEFT JOIN r_resign ON r_resign.r_resign__mutasi=B.r_pnpt__no_mutasi and r_resign__approval=1
                                    GROUP BY B.r_pegawai__id
                                    )C   WHERE C.r_cabang__id='$kode_pw_ses' ";
                      
                                                        //$kode_pw_ses $periode_awal $periode_akhir
			} else {
                        $sql  = "SELECT (C.rkp_peg-C.rkp_resign)as rkp_peg_aktif,C.* FROM (SELECT 
                                    IF((r_resign.r_resign__approval)IS NULL ,'0','1')ket_keluar,
                                    COUNT(B.r_pnpt__no_mutasi) as rkp_peg,
                                    IF(SUM(B.t_rkp__approval=0)IS NULL,'0',SUM(B.t_rkp__approval=0)) as rkp_nol,
                                    IF(SUM(B.t_rkp__approval=1)IS NULL,'0',SUM(B.t_rkp__approval=1)) as rkp_hrd,
                                    IF(SUM(B.t_rkp__approval=2)IS NULL,'0',SUM(B.t_rkp__approval=2))as rkp_bom,
                                    IF(SUM(B.t_rkp__approval=3)IS NULL,'0',SUM(B.t_rkp__approval=3))as rkp_hglm,
                                    IF(SUM(B.t_rkp__approval=4)IS NULL,'0',SUM(B.t_rkp__approval=4))as rkp_closing,
                                    count(r_resign.r_resign__approval=1)as rkp_resign,
                                    B.*
                                    FROM (SELECT 
                                     datediff('$periode_akhir','$periode_awal')+1 AS JML_HARI,
                                    COUNT(t_libur.r_libur__tgl) as jml,
                                    A.* 
                                    FROM  (SELECT 
                                    r_pegawai.r_pegawai__id,
                                    r_pegawai.r_pegawai__nama,
                                    r_pegawai.r_pegawai__tgl_masuk,
                                    peg.r_pnpt__subcab,
                                    peg.r_pnpt__jabatan,
                                    peg.r_pnpt__no_mutasi,
                                    peg.r_pnpt__finger_print,
                                    peg.r_pnpt__shift,
                                     peg.t_rkp__no_mutasi,
                                     IF((peg.t_rkp__awal)is null,'$periode_awal',peg.t_rkp__awal)as t_rkp__awal,
                                    IF((peg.t_rkp__akhir)is null,'$periode_akhir',peg.t_rkp__akhir)as t_rkp__akhir,
                                    IF((peg.t_rkp__approval)is null,'0',peg.t_rkp__approval)as t_rkp__approval,
                                    IF((peg.t_rkp__hadir)is null,'0',peg.t_rkp__hadir)as t_rkp__hadir,
                                    IF((peg.t_rkp__sakit)is null,'0',peg.t_rkp__sakit)as t_rkp__sakit,
                                    IF((peg.t_rkp__izin)is null,'0',peg.t_rkp__izin)as t_rkp__izin,
                                    IF((peg.t_rkp__alpa)is null,'0',peg.t_rkp__alpa)as t_rkp__alpa,
                                    IF((peg.t_rkp__dinas)is null,'0',peg.t_rkp__dinas)as t_rkp__dinas,
                                    IF((peg.t_rkp__cuti)is null,'0',peg.t_rkp__cuti)as t_rkp__cuti,
                                    IF((peg.t_rkp__keterangan)is null,'',peg.t_rkp__keterangan)as t_rkp__keterangan,
                                    r_departement.r_dept__id,
                                    r_departement.r_dept__ket,
                                    r_jabatan.r_jabatan__id,
                                    r_jabatan.r_jabatan__ket,
                                    r_cabang.r_cabang__id,
                                    r_cabang.r_cabang__nama,
                                    r_subcabang.r_subcab__id,
                                    r_subcabang.r_subcab__nama

                                     FROM 
                                    (SELECT mutasi.* FROM (
                                    SELECT 
                                    peg_rkp.*, rkp.* FROM (SELECT t_rekap_absensi.*
                                    FROM t_rekap_absensi WHERE t_rekap_absensi.t_rkp__awal='$periode_awal' and t_rekap_absensi.t_rkp__akhir='$periode_akhir')rkp 
                                    right JOIN (SELECT 
                                    r_penempatan.r_pnpt__no_mutasi,
                                    r_penempatan.r_pnpt__id_pegawai,
                                    r_penempatan.r_pnpt__nip,
                                    r_penempatan.r_pnpt__status,
                                    r_penempatan.r_pnpt__tipe_salary,
                                    r_penempatan.r_pnpt__subdept,
                                    r_penempatan.r_pnpt__jabatan,
                                    r_penempatan.r_pnpt__finger_print,
                                    r_penempatan.r_pnpt__gapok,
                                    r_penempatan.r_pnpt__subcab,
                                    r_penempatan.r_pnpt__shift,
                                    r_penempatan.r_pnpt__kon_awal,
                                    r_penempatan.r_pnpt__kon_akhir,
                                    r_penempatan.r_pnpt__pdrm,
                                    r_penempatan.r_pnpt__aktif,
                                    r_penempatan.r_pnpt__areakerja,
                                    r_penempatan.r_pnpt__tgl_efektif,
                                    r_penempatan.r_pnpt__date_created,
                                    r_penempatan.r_pnpt__date_updated,
                                    r_penempatan.r_pnpt__user_created,
                                    r_penempatan.r_pnpt__user_updated

                                    FROM r_penempatan ORDER BY 	r_penempatan.r_pnpt__no_mutasi DESC) peg_rkp
                                     ON peg_rkp.r_pnpt__id_pegawai=rkp.t_rkp__idpeg GROUP BY peg_rkp.r_pnpt__id_pegawai ORDER BY peg_rkp.r_pnpt__no_mutasi DESC)mutasi
                                    INNER JOIN r_pegawai On r_pegawai.r_pegawai__id=mutasi.r_pnpt__id_pegawai)peg
                                    inner join r_pegawai on r_pegawai.r_pegawai__id=peg.r_pnpt__id_pegawai
                                    INNER JOIN r_subcabang ON r_subcabang.r_subcab__id=peg.r_pnpt__subcab
                                    INNER JOIN r_cabang ON r_cabang.r_cabang__id=r_subcabang.r_subcab__cabang
                                    INNER JOIN r_jabatan ON r_jabatan__id=peg.r_pnpt__jabatan
                                    INNER JOIN r_subdepartement ON peg.r_pnpt__subdept=r_subdepartement.r_subdept__id
                                    INNER JOIN r_departement ON r_departement.r_dept__id=r_subdepartement.r_subdept__dept
                                    GROUP BY peg.r_pnpt__id_pegawai ORDER BY peg.r_pnpt__no_mutasi DESC)A
                                    inner JOIN t_libur ON t_libur.r_libur__shift=A.r_pnpt__shift 
                                    and t_libur.r_libur__tgl>='$periode_awal' and t_libur.r_libur__tgl<='$periode_akhir'
                                    WHERE A.r_pnpt__no_mutasi NOT IN (select DISTINCT  r_resign.r_resign__mutasi FROM r_resign 
                                    WHERE r_resign.r_resign__tgl <= '$periode_akhir'- INTERVAL DATEDIFF('$periode_akhir','$periode_awal') day and r_resign.r_resign__approval=1)
                                    GROUP BY A.r_pegawai__id ORDER BY A.r_pnpt__no_mutasi)B
                                    LEFT JOIN r_resign ON r_resign.r_resign__mutasi=B.r_pnpt__no_mutasi and r_resign__approval=1
                                    GROUP BY B.r_pegawai__id
                                    )C   WHERE 1=1 ";	

			}
 
				//echo "<br><br><br><br><br><br><br><br><br><br>dddddddddkode_perwakilan_cari ===".$kode_perwakilan_cari;

				if($kode_perwakilan_cari !=''){
					$sql .= " AND C.r_cabang__id= '".$kode_perwakilan_cari."' ";
				}
				if($nama_karyawan_cari !=''){
					$sql .= "    AND  C.r_pegawai__nama LIKE '%".addslashes($nama_karyawan_cari)."%' "; 
				}

				if($kode_subcab_cari!=''){
					$sql .= "    AND C.r_subcab__id  = '".$kode_subcab_cari."' ";
				} 
                                
                                if($id_finger_cari!=''){
					$sql .= "    AND C.r_pnpt__finger_print  = '".$id_finger_cari."' ";
				} 
                                if ($bulan !='') {
                                       $sql.=" and C.t_rkp__awal='$bulan'  ";
                                }

                                 if ($tahun !='') {
                                       $sql.=" AND C.t_rkp__akhir='$tahun'  ";
                                }

			 	 $sql .= "  ORDER BY  trim(C.r_pegawai__nama) asc ";

                                
                                 if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);

                                $numresults=$db->Execute($sql);
				$count = $numresults->RecordCount();
				//$pages = $p->findPages($count,$LIMIT); 
				//$sql  .= "LIMIT ".$start.", ".$LIMIT;
				$recordSet = $db->Execute($sql);
				$end = $recordSet->RecordCount();
				$initSet = array();
				$data_tb = array();
				$row_class = array();
				$z=0;
				while ($arr=$recordSet->FetchRow()) {
					array_push($data_tb, $arr);
					if ($z%2==0){ 
						$ROW_CLASSNAME="#CCCCCC"; }
					else {
						$ROW_CLASSNAME="#EEEEEE";
					   }
					array_push($row_class, $ROW_CLASSNAME);
					array_push($initSet, $z);
					$z++;
				}

				$count_view = $start+1;
				//$count_all  = $start+$end;
				//$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 
}

}
else
    
{
				

			if($jenis_user=='2'){
          
                       $sql  = "SELECT (C.rkp_peg-C.rkp_resign)as rkp_peg_aktif,C.* FROM (SELECT 
                                    IF((r_resign.r_resign__approval)IS NULL ,'0','1')ket_keluar,
                                    COUNT(B.r_pnpt__no_mutasi) as rkp_peg,
                                    IF(SUM(B.t_rkp__approval=0)IS NULL,'0',SUM(B.t_rkp__approval=0)) as rkp_nol,
                                    IF(SUM(B.t_rkp__approval=1)IS NULL,'0',SUM(B.t_rkp__approval=1)) as rkp_hrd,
                                    IF(SUM(B.t_rkp__approval=2)IS NULL,'0',SUM(B.t_rkp__approval=2))as rkp_bom,
                                    IF(SUM(B.t_rkp__approval=3)IS NULL,'0',SUM(B.t_rkp__approval=3))as rkp_hglm,
                                    IF(SUM(B.t_rkp__approval=4)IS NULL,'0',SUM(B.t_rkp__approval=4))as rkp_closing,
                                    count(r_resign.r_resign__approval=1)as rkp_resign,
                                    B.*
                                    FROM (SELECT 
                                     datediff('$periode_akhir','$periode_awal')+1 AS JML_HARI,
                                    COUNT(t_libur.r_libur__tgl) as jml,
                                    A.* 
                                    FROM  (SELECT 
                                    r_pegawai.r_pegawai__id,
                                    r_pegawai.r_pegawai__nama,
                                    r_pegawai.r_pegawai__tgl_masuk,
                                    peg.r_pnpt__subcab,
                                    peg.r_pnpt__jabatan,
                                    peg.r_pnpt__no_mutasi,
                                    peg.r_pnpt__finger_print,
                                    peg.r_pnpt__shift,
                                     peg.t_rkp__no_mutasi,
                                     IF((peg.t_rkp__awal)is null,'$periode_awal',peg.t_rkp__awal)as t_rkp__awal,
                                    IF((peg.t_rkp__akhir)is null,'$periode_akhir',peg.t_rkp__akhir)as t_rkp__akhir,
                                    IF((peg.t_rkp__approval)is null,'0',peg.t_rkp__approval)as t_rkp__approval,
                                    IF((peg.t_rkp__hadir)is null,'0',peg.t_rkp__hadir)as t_rkp__hadir,
                                    IF((peg.t_rkp__sakit)is null,'0',peg.t_rkp__sakit)as t_rkp__sakit,
                                    IF((peg.t_rkp__izin)is null,'0',peg.t_rkp__izin)as t_rkp__izin,
                                    IF((peg.t_rkp__alpa)is null,'0',peg.t_rkp__alpa)as t_rkp__alpa,
                                    IF((peg.t_rkp__dinas)is null,'0',peg.t_rkp__dinas)as t_rkp__dinas,
                                    IF((peg.t_rkp__cuti)is null,'0',peg.t_rkp__cuti)as t_rkp__cuti,
                                    IF((peg.t_rkp__keterangan)is null,'',peg.t_rkp__keterangan)as t_rkp__keterangan,
                                    r_departement.r_dept__id,
                                    r_departement.r_dept__ket,
                                    r_jabatan.r_jabatan__id,
                                    r_jabatan.r_jabatan__ket,
                                    r_cabang.r_cabang__id,
                                    r_cabang.r_cabang__nama,
                                    r_subcabang.r_subcab__id,
                                    r_subcabang.r_subcab__nama

                                     FROM 
                                    (SELECT mutasi.* FROM (
                                    SELECT 
                                    peg_rkp.*, rkp.* FROM (SELECT t_rekap_absensi.*
                                    FROM t_rekap_absensi WHERE t_rekap_absensi.t_rkp__awal='$periode_awal' and t_rekap_absensi.t_rkp__akhir='$periode_akhir')rkp 
                                    right JOIN (SELECT 
                                    r_penempatan.r_pnpt__no_mutasi,
                                    r_penempatan.r_pnpt__id_pegawai,
                                    r_penempatan.r_pnpt__nip,
                                    r_penempatan.r_pnpt__status,
                                    r_penempatan.r_pnpt__tipe_salary,
                                    r_penempatan.r_pnpt__subdept,
                                    r_penempatan.r_pnpt__jabatan,
                                    r_penempatan.r_pnpt__finger_print,
                                    r_penempatan.r_pnpt__gapok,
                                    r_penempatan.r_pnpt__subcab,
                                    r_penempatan.r_pnpt__shift,
                                    r_penempatan.r_pnpt__kon_awal,
                                    r_penempatan.r_pnpt__kon_akhir,
                                    r_penempatan.r_pnpt__pdrm,
                                    r_penempatan.r_pnpt__aktif,
                                    r_penempatan.r_pnpt__areakerja,
                                    r_penempatan.r_pnpt__tgl_efektif,
                                    r_penempatan.r_pnpt__date_created,
                                    r_penempatan.r_pnpt__date_updated,
                                    r_penempatan.r_pnpt__user_created,
                                    r_penempatan.r_pnpt__user_updated

                                    FROM r_penempatan ORDER BY 	r_penempatan.r_pnpt__no_mutasi DESC) peg_rkp
                                     ON peg_rkp.r_pnpt__id_pegawai=rkp.t_rkp__idpeg GROUP BY peg_rkp.r_pnpt__id_pegawai ORDER BY peg_rkp.r_pnpt__no_mutasi DESC)mutasi
                                    INNER JOIN r_pegawai On r_pegawai.r_pegawai__id=mutasi.r_pnpt__id_pegawai)peg
                                    inner join r_pegawai on r_pegawai.r_pegawai__id=peg.r_pnpt__id_pegawai
                                    INNER JOIN r_subcabang ON r_subcabang.r_subcab__id=peg.r_pnpt__subcab
                                    INNER JOIN r_cabang ON r_cabang.r_cabang__id=r_subcabang.r_subcab__cabang
                                    INNER JOIN r_jabatan ON r_jabatan__id=peg.r_pnpt__jabatan
                                    INNER JOIN r_subdepartement ON peg.r_pnpt__subdept=r_subdepartement.r_subdept__id
                                    INNER JOIN r_departement ON r_departement.r_dept__id=r_subdepartement.r_subdept__dept
                                    GROUP BY peg.r_pnpt__id_pegawai ORDER BY peg.r_pnpt__no_mutasi DESC)A
                                    inner JOIN t_libur ON t_libur.r_libur__shift=A.r_pnpt__shift 
                                    and t_libur.r_libur__tgl>='$periode_awal' and t_libur.r_libur__tgl<='$periode_akhir'
                                    WHERE A.r_pnpt__no_mutasi NOT IN (select DISTINCT  r_resign.r_resign__mutasi FROM r_resign 
                                    WHERE r_resign.r_resign__tgl <= '$periode_akhir'- INTERVAL DATEDIFF('$periode_akhir','$periode_awal') day and r_resign.r_resign__approval=1)
                                    GROUP BY A.r_pegawai__id ORDER BY A.r_pnpt__no_mutasi)B
                                    LEFT JOIN r_resign ON r_resign.r_resign__mutasi=B.r_pnpt__no_mutasi and r_resign__approval=1
                                    GROUP BY B.r_pegawai__id
                                    )C   WHERE C.r_cabang__id='$kode_pw_ses' ";
                                            

			} else {
			$sql  = "SELECT (C.rkp_peg-C.rkp_resign)as rkp_peg_aktif,C.* FROM (SELECT 
                                    IF((r_resign.r_resign__approval)IS NULL ,'0','1')ket_keluar,
                                    COUNT(B.r_pnpt__no_mutasi) as rkp_peg,
                                    IF(SUM(B.t_rkp__approval=0)IS NULL,'0',SUM(B.t_rkp__approval=0)) as rkp_nol,
                                    IF(SUM(B.t_rkp__approval=1)IS NULL,'0',SUM(B.t_rkp__approval=1)) as rkp_hrd,
                                    IF(SUM(B.t_rkp__approval=2)IS NULL,'0',SUM(B.t_rkp__approval=2))as rkp_bom,
                                    IF(SUM(B.t_rkp__approval=3)IS NULL,'0',SUM(B.t_rkp__approval=3))as rkp_hglm,
                                    IF(SUM(B.t_rkp__approval=4)IS NULL,'0',SUM(B.t_rkp__approval=4))as rkp_closing,
                                    count(r_resign.r_resign__approval=1)as rkp_resign,
                                    B.*
                                    FROM (SELECT 
                                     datediff('$periode_akhir','$periode_awal')+1 AS JML_HARI,
                                    COUNT(t_libur.r_libur__tgl) as jml,
                                    A.* 
                                    FROM  (SELECT 
                                    r_pegawai.r_pegawai__id,
                                    r_pegawai.r_pegawai__nama,
                                    r_pegawai.r_pegawai__tgl_masuk,
                                    peg.r_pnpt__subcab,
                                    peg.r_pnpt__jabatan,
                                    peg.r_pnpt__no_mutasi,
                                    peg.r_pnpt__finger_print,
                                    peg.r_pnpt__shift,
                                     peg.t_rkp__no_mutasi,
                                     IF((peg.t_rkp__awal)is null,'$periode_awal',peg.t_rkp__awal)as t_rkp__awal,
                                    IF((peg.t_rkp__akhir)is null,'$periode_akhir',peg.t_rkp__akhir)as t_rkp__akhir,
                                    IF((peg.t_rkp__approval)is null,'0',peg.t_rkp__approval)as t_rkp__approval,
                                    IF((peg.t_rkp__hadir)is null,'0',peg.t_rkp__hadir)as t_rkp__hadir,
                                    IF((peg.t_rkp__sakit)is null,'0',peg.t_rkp__sakit)as t_rkp__sakit,
                                    IF((peg.t_rkp__izin)is null,'0',peg.t_rkp__izin)as t_rkp__izin,
                                    IF((peg.t_rkp__alpa)is null,'0',peg.t_rkp__alpa)as t_rkp__alpa,
                                    IF((peg.t_rkp__dinas)is null,'0',peg.t_rkp__dinas)as t_rkp__dinas,
                                    IF((peg.t_rkp__cuti)is null,'0',peg.t_rkp__cuti)as t_rkp__cuti,
                                    IF((peg.t_rkp__keterangan)is null,'',peg.t_rkp__keterangan)as t_rkp__keterangan,
                                    r_departement.r_dept__id,
                                    r_departement.r_dept__ket,
                                    r_jabatan.r_jabatan__id,
                                    r_jabatan.r_jabatan__ket,
                                    r_cabang.r_cabang__id,
                                    r_cabang.r_cabang__nama,
                                    r_subcabang.r_subcab__id,
                                    r_subcabang.r_subcab__nama

                                     FROM 
                                    (SELECT mutasi.* FROM (
                                    SELECT 
                                    peg_rkp.*, rkp.* FROM (SELECT t_rekap_absensi.*
                                    FROM t_rekap_absensi WHERE t_rekap_absensi.t_rkp__awal='$periode_awal' and t_rekap_absensi.t_rkp__akhir='$periode_akhir')rkp 
                                    right JOIN (SELECT 
                                    r_penempatan.r_pnpt__no_mutasi,
                                    r_penempatan.r_pnpt__id_pegawai,
                                    r_penempatan.r_pnpt__nip,
                                    r_penempatan.r_pnpt__status,
                                    r_penempatan.r_pnpt__tipe_salary,
                                    r_penempatan.r_pnpt__subdept,
                                    r_penempatan.r_pnpt__jabatan,
                                    r_penempatan.r_pnpt__finger_print,
                                    r_penempatan.r_pnpt__gapok,
                                    r_penempatan.r_pnpt__subcab,
                                    r_penempatan.r_pnpt__shift,
                                    r_penempatan.r_pnpt__kon_awal,
                                    r_penempatan.r_pnpt__kon_akhir,
                                    r_penempatan.r_pnpt__pdrm,
                                    r_penempatan.r_pnpt__aktif,
                                    r_penempatan.r_pnpt__areakerja,
                                    r_penempatan.r_pnpt__tgl_efektif,
                                    r_penempatan.r_pnpt__date_created,
                                    r_penempatan.r_pnpt__date_updated,
                                    r_penempatan.r_pnpt__user_created,
                                    r_penempatan.r_pnpt__user_updated

                                    FROM r_penempatan ORDER BY 	r_penempatan.r_pnpt__no_mutasi DESC) peg_rkp
                                     ON peg_rkp.r_pnpt__id_pegawai=rkp.t_rkp__idpeg GROUP BY peg_rkp.r_pnpt__id_pegawai ORDER BY peg_rkp.r_pnpt__no_mutasi DESC)mutasi
                                    INNER JOIN r_pegawai On r_pegawai.r_pegawai__id=mutasi.r_pnpt__id_pegawai)peg
                                    inner join r_pegawai on r_pegawai.r_pegawai__id=peg.r_pnpt__id_pegawai
                                    INNER JOIN r_subcabang ON r_subcabang.r_subcab__id=peg.r_pnpt__subcab
                                    INNER JOIN r_cabang ON r_cabang.r_cabang__id=r_subcabang.r_subcab__cabang
                                    INNER JOIN r_jabatan ON r_jabatan__id=peg.r_pnpt__jabatan
                                    INNER JOIN r_subdepartement ON peg.r_pnpt__subdept=r_subdepartement.r_subdept__id
                                    INNER JOIN r_departement ON r_departement.r_dept__id=r_subdepartement.r_subdept__dept
                                    GROUP BY peg.r_pnpt__id_pegawai ORDER BY peg.r_pnpt__no_mutasi DESC)A
                                    inner JOIN t_libur ON t_libur.r_libur__shift=A.r_pnpt__shift 
                                    and t_libur.r_libur__tgl>='$periode_awal' and t_libur.r_libur__tgl<='$periode_akhir'
                                    WHERE A.r_pnpt__no_mutasi NOT IN (select DISTINCT  r_resign.r_resign__mutasi FROM r_resign 
                                    WHERE r_resign.r_resign__tgl <= '$periode_akhir'- INTERVAL DATEDIFF('$periode_akhir','$periode_awal') day and r_resign.r_resign__approval=1)
                                    GROUP BY A.r_pegawai__id ORDER BY A.r_pnpt__no_mutasi)B
                                    LEFT JOIN r_resign ON r_resign.r_resign__mutasi=B.r_pnpt__no_mutasi and r_resign__approval=1
                                    GROUP BY B.r_pegawai__id
                                    )C   WHERE C.r_cabang__id='$kode_pw_ses' ";	

			}
                              
                              if($kode_perwakilan_cari !=''){
					$sql .= " AND  C.r_cabang__id= '".$kode_perwakilan_cari."' ";
				}
				if($nama_karyawan_cari !=''){
					$sql .= "    AND C.r_pegawai__nama LIKE '%".addslashes($nama_karyawan_cari)."%' "; 
				}

				if($kode_subcab_cari!=''){
					$sql .= "    AND C.r_subcab__id  = '".$kode_subcab_cari."' ";
				} 
                                
                                if($id_finger_cari!=''){
					$sql .= "    AND C.r_pnpt__finger_print  = '".$id_finger_cari."' ";
				} 
                                if ($bulan !='') {
                                       $sql.=" and C.t_rkp__awal='$bulan'  ";
                                }

                                 if ($tahun !='') {
                                       $sql.=" AND C.t_rkp__akhir='$tahun'  ";
                                }

			 	 $sql .= " ORDER BY  trim(C.r_pegawai__nama) asc ";
 
			  if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
                          
                                $numresults=$db->Execute($sql);
                                $count = $numresults->RecordCount();
				//$pages = $p->findPages($count,$LIMIT); 
				//$sql  .= "LIMIT ".$start.", ".$LIMIT;
				
				$recordSet = $db->Execute($sql);
				$end = $recordSet->RecordCount();
                                
				$initSet = array();
				$data_tb = array();
                           
				$row_class = array();
				$z=0;
				while ($arr=$recordSet->FetchRow()) {
                                    
					array_push($data_tb, $arr);
					if ($z%2==0){ 
						$ROW_CLASSNAME="#CCCCCC"; }
					else {
						$ROW_CLASSNAME="#EEEEEE";
					   }
					array_push($row_class, $ROW_CLASSNAME);
					array_push($initSet, $z);
					$z++;
				}
                                    
                          
				$count_view = $start+1;
			//	$count_all  = $start+$end;
			//	$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 
}
//---------------------------------CLOSE VIEW INDEX---------------------------------------------------------------------//

  


//---------------     LOOPING       -----------------------------------------///
$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_KELURAHAN);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_KELURAHAN);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("TITLE", _TITLE_KEL);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_KEL);

$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("APPROVE", _APPROVE);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_ME);
$smarty->assign ("RECORD_PER_PAGE", _RECORD_PER_PAGE);
$smarty->assign ("ACTION", _ACTION);
$smarty->assign ("EDIT", _EDIT);
$smarty->assign ("DELETE", _DELETE);
$smarty->assign ("SORT_IN", _SORT_IN);
$smarty->assign ("SORT_ORDER", _SORT_ORDER);
$smarty->assign ("SHOWING", _SHOWING);
$smarty->assign ("OF", _OF);
$smarty->assign ("RECORDS", _RECORDS);
$smarty->assign ("LIST", _LIST_KEL);
$smarty->assign ("BTN_NEW", _BTN_NEW);
$smarty->assign ("POSTING", _POSTING);
$smarty->assign ("BTN_VERIFIKASI",_BTN_VERIFIKASI);


$smarty->assign ("INITSET", $initSet);
$smarty->assign ("PATH", $PATH);
$smarty->assign ("LIMIT", $LIMIT);
$smarty->assign ("SORT", $SORT);
$smarty->assign ("ORDER", $ORDER);
$smarty->assign ("page", $page);
$smarty->assign ("LISTVAL", $arrayName);
$smarty->assign ("SELECTED", $selected);
$smarty->assign ("ROW_CLASSNAME", $row_class);
$smarty->assign ("STR_COMPLETER", $str_completer);
$smarty->assign ("STR_COMPLETER_", $str_completer_);
$smarty->assign ("COUNT_VIEW", $count_view);
$smarty->assign ("COUNT_ALL", $count_all);
$smarty->assign ("COUNT", $count);
$smarty->assign ("NEXT_PREV", $next_prev);
$smarty->assign ("DATA_TB",$data_tb);

$config['date'] = '%I:%M %p';
$config['time'] = '%H:%M:%S';
$smarty->assign('config', $config);
$smarty->assign ("DATA_TB_TGL_MASUK", $tgl_masuk);
$smarty->assign ("LABEL_HEADER", 'REKAP DATA ABSEN');
# Finally Grab All Parsed variables, parse it into the template, and generate ouput
# Clear Cache First
$smarty->clear_cache ($TPL_PATH.'/'.$DOC_SELF_NAME_ONLY.'.tpl');
# Parsing the proper theme template & Generate Output
$smarty->display ($TPL_PATH.'/'.$DOC_SELF_NAME_ONLY.'.tpl');
//require_once($DIR_THEME.'/'.base64_decode($_SESSION['THEME']).$DOC_SELF_PATH.$DOC_SELF_NAME_ONLY.'.tpl');
//=================================== END PARSING TEMPLATE BLOCK====================================
# Store all the JavaScript  for this pages into /javascripts/file_name  and include it here (bottom page)
require_once($FILE_JS.'/'.$DOC_SELF_NAME_ONLY.'.js');

# AdoDb closed here
$db->Close();
}
?>
