<?php

# Including Main Configuration
# including file for Main Configurations
require_once('../../../../includes/config.conf.php');

# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
	require_once('../../../../includes/header.redirect.inc');
}else{

//yang harus dibuat session
$THEME = base64_encode("defaults");
$LANG = base64_encode("indonesia");
$_SESSION['THEME']	= $THEME;
$_SESSION['LANG']       = $LANG;

#FOR IMAGES CLASS PAGER
$HREF_IMAGES = $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images');

# including Header file for Content Expiring
require_once($DIR_INC.'/header.exp.inc');
# including Header file for Database Configuration
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');
//require_once($DIR_HOME.'../../../../laporan/inc.kasus_wni.php'); 
//require_once('/laporan/inc.detail_pegawai.php');  

$p = new Pager; 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
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

#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/pelaporan/lap_kepegawaian/data_pegawai_detail';
 
#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/pelaporan/lap_kepegawaian');
$FILE_JS  = $JS_MODUL.'/data_pegawai_detail';

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}

$user_id = base64_decode($_SESSION['UID']);

$smarty->assign ("MOD_ID", $mod_id);

$smarty->assign ("ID_PROPINSI",$MAIN_PROP);

#Initiate TABLE
 
//-----------------------------------END OF LOCAL CONFIG-------------------------------//

if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="a.id_fjl_01_detail";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['kode_cabang_cari']) $kode_cabang_cari = $_GET['kode_cabang_cari'];
else if ($_POST['kode_cabang_cari']) $kode_cabang_cari = $_POST['kode_cabang_cari'];
else $kode_cabang_cari="";


if ($_GET['kode_subcab_cari']) $kode_subcab_cari = $_GET['kode_subcab_cari'];
else if ($_POST['kode_subcab_cari']) $kode_subcab_cari = $_POST['kode_subcab_cari'];
else $kode_subcab_cari="";

if ($_GET['departemen_cari']) $departemen_cari = $_GET['departemen_cari'];
else if ($_POST['departemen_cari']) $departemen_cari = $_POST['departemen_cari'];
else $departemen_cari="";

if ($_GET['nama_karyawan_cari']) $nama_karyawan_cari = $_GET['nama_karyawan_cari'];
else if ($_POST['nama_karyawan_cari']) $nama_karyawan_cari = $_POST['nama_karyawan_cari'];
else $nama_karyawan_cari="";


if ($_GET['nip_karyawan_cari']) $nip_karyawan_cari = $_GET['nip_karyawan_cari'];
else if ($_POST['nip_karyawan_cari']) $nip_karyawan_cari = $_POST['nip_karyawan_cari'];
else $nip_karyawan_cari="";

if ($_GET['search']) $search = $_GET['search'];
else if ($_POST['search']) $search = $_POST['search'];
else $search="";

$smarty->assign ("KODE_CABANG_CARI", $kode_cabang_cari);
$tahun_ses=$_SESSION['SESSION_TAHUN'];
$smarty->assign ("TAHUN_SES", $tahun_ses);


$Search_Year = $_GET[tahun];
$smarty->assign ("SEARCH", $search);

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&search=1&Search_Year=".$Search_Year."&kode_cabang_cari=".$kode_cabang_cari."&nama_karyawan_cari=".$nama_karyawan_cari."&kode_subcab_cari=".$kode_subcab_cari;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&search=1&Search_Year=".$Search_Year;

$SES_TAHUN		= $_SESSION['TAHUN'];
$SES_INSTANSI		= $_SESSION['KODE_INSTANSI'];
$SES_JENIS_USER		= $_SESSION['JENIS_USER'];
//var_dump($str_completer)or die();

$jenis_user     = $_SESSION['SESSION_JNS_USER'];
$kode_pw_ses    = $_SESSION['SESSION_KODE_CABANG'];
$tahun_session	= $_SESSION['SESSION_TAHUN'];
$bulan_session	= $_SESSION['SESSION_BULAN'];  

$smarty->assign ("JENIS_USER_SES", $jenis_user);
$smarty->assign ("KODE_PW_SES", $kode_pw_ses);

$smarty->assign ("TAHUN_SESSION", $tahun_session);
$smarty->assign ("BULAN_SESSION", $bulan_session);
//--------------------------------------
//SHOW DATA INSTANSI
//---------------------------------------

$smarty->assign ("SES_TAHUN", $SES_TAHUN);
$smarty->assign ("SES_INSTANSI", $SES_INSTANSI);
$smarty->assign ("SES_JENIS_USER", $SES_JENIS_USER);

$smarty->assign ("BULAN", $bulan);
$smarty->assign ("TAHUN", $tahun);
$smarty->assign ("KODE_KAT_KASUS", $kode_kat_kasus);
//--------------------------------------
 

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
//-----------------CLOSE DATA SUBCABANG------------------//

//------------------DATA AJAX SUBCAB---------------------//

if ($_GET[get_subcab] == 1)
{  
    
	$subcabang = $_GET[no_subcab];   
       
       

			if($subcabang!=''){
					$sql_kabupaten = "SELECT cab.r_cabang__id ,cab.r_cabang__nama,subcab.r_subcab__nama,subcab.r_subcab__id as subcab FROM r_cabang cab,r_subcabang subcab
                                                          where cab.r_cabang__id=subcab.r_subcab__cabang AND cab.r_cabang__id='$subcabang' ORDER BY cab.r_cabang__nama ASC";
                                        //var_dump($sql_kabupaten)or die();
                                        $recordSet_kabupaten = $db->Execute($sql_kabupaten);
					
					$input_kab="<select name=kode_subcab_cari >";
					$input_kab.="<option value=''> ";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF):
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields[subcab].">".$recordSet_kabupaten->fields['r_subcab__nama'];
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
//---------------------closer ajax subcabang id------------------------------------------------//


/**DATA COMBO KARYAWAN**/

    $sql_cari_karyawan = "SELECT peg.r_cabang__nama,peg.r_dept__ket,peg.r_jabatan__id,peg.r_jabatan__ket,peg.r_pegawai__nama,peg.r_pnpt__nip FROM v_pegawai peg 
where peg.r_cabang__id='$kode_pw_ses'  " ;
        
    $result_cari_karyawan = $db->Execute($sql_cari_karyawan);
        $initSet = array();
        $data_cari_karyawan = array();
        $z=0;
        while ($arr=$result_cari_karyawan->FetchRow()) {
                array_push($data_cari_karyawan, $arr);
                array_push($initSet, $z);
                $z++;
                        }
$smarty->assign ("DATA_CARI_KARYAWAN", $data_cari_karyawan);



if ($_GET[get_combo_karyawan] == 1)
{  
    
	$subcabang = $_GET[no_subcab];   
       
       

			if($subcabang!=''){
					$sql_kabupaten = "SELECT peg.r_cabang__nama,peg.r_dept__ket,peg.r_jabatan__id,peg.r_jabatan__ket,peg.r_pegawai__nama,peg.r_pnpt__nip FROM v_pegawai peg 
                                                          where peg.r_cabang__id='$kode_pw_ses'  AND peg.r_dept__id='$subcabang' ";
                                        //var_dump($sql_kabupaten)or die();
                                        $recordSet_kabupaten = $db->Execute($sql_kabupaten);
					
					$input_kab="<select name='nama_karyawan_cari'>";
					$input_kab.="<option value=''> ";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF):
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields[r_pnpt__nip].">".$recordSet_kabupaten->fields['r_pnpt__nip']."-".$recordSet_kabupaten->fields['r_pegawai__nama'];
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


/**TUTUP COMBO KARYAWAN**/

//-----------SHOW DATA CABANG--------------------------//

$sql_cabang = "SELECT * FROM r_cabang";
$result_cabang = $db->Execute($sql_cabang);
$initSet = array();
$data_cabang = array();
$z=0;
while ($arr=$result_cabang->FetchRow()) {
	array_push($data_cabang, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_CABANG", $data_cabang);
//---------------CLOSE DATA CABANG-------------------------//

//-----------SHOW DATA DEPARTEMEN-----//
$sql_departemen = "SELECT * FROM r_departement";
$result_departemen = $db->Execute($sql_departemen);
$initSet = array();
$data_departemen = array();
$z=0;
while ($arr=$result_departemen->FetchRow()) {
	array_push($data_departemen, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_DEPARTEMEN", $data_departemen);
//-----------CLOSE DATA DEPARTEMEN----//


//-----------------BLN PERIODE AKTIF--------------------------------------------------------//
$sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_bulan,r_periode__payroll_tahun,r_periode__payroll_status
                                  FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
                  
        $rs_val = $db->Execute($sql_cek_periode);
        $periode_bulan= $rs_val->fields['r_periode__payroll_bulan'];
        $periode_tahun= $rs_val->fields['r_periode__payroll_tahun'];

        $smarty->assign ("PERIODE_BULAN",  $periode_bulan);
        $smarty->assign ("PERIODE_TAHUN",  $periode_tahun);

//--------------CLOSE BLN PERIODE AKTIF-----------------------------------//


        
//-----------------view_index-----------------------//
if ($_GET['search'] == '1')
    {
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
            $sql__="SELECT *,UPPER(r_cabang__nama) AS nm_perwakilan FROM r_cabang WHERE  r_cabang.r_cabang__id='$kode_cabang_cari' ";
            $rs__=$db->Execute($sql__);
            $nm_perwakilan = $rs__->fields['nm_perwakilan'];
            $smarty->assign ("NM_PERWAKILAN", $nm_perwakilan);
            
            $sql_jabatan =  "SELECT `peg`.`r_pnpt__no_mutasi` AS `r_pnpt__no_mutasi`,
                `peg`.`r_pnpt__kon_awal` AS `r_pnpt__kon_awal`,
                `peg`.`r_pnpt__kon_akhir` AS `r_pnpt__kon_akhir`,
                `peg`.`r_jabatan__ket` AS `r_jabatan__ket`,
                `peg`.`r_dept__ket` AS `r_dept__ket`,
                `peg`.`r_subdept__id` AS `r_subdept__id` from v_pegawai peg where peg.r_pnpt__nip ='$nip_karyawan_cari' ";

$recordSet_jabatan = $db->Execute($sql_jabatan);
$initSet = array();
$data_jabatan_history = array();
$z=0;
while ($arr=$recordSet_jabatan->FetchRow()) {
	array_push($data_jabatan_history, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("CV_JABATAN", $data_jabatan_history);
     

$sql_pendidikan ="SELECT peg.r_pnpt__nip AS r_pnpt__nip, 
                peg.r_pegawai__pend_akhir AS r_pegawai__pend_akhir,
                peg.r_pegawai__pend_sekolah  AS r_pegawai__pend_sekolah,
                peg.r_pegawai__pend_tgl_lulus  AS r_pegawai__pend_tgl_lulus,
                peg.r_pegawai__pend_jurusan AS r_pegawai__pend_jurusan  
                from v_pegawai peg where peg.r_pnpt__nip ='$nip_karyawan_cari' ";
//var_dump($sql_pendidikan)or die();
$recordSet_pendidikan = $db->Execute($sql_pendidikan);
$initSet = array();
$data_pendidikan = array();
$z=0;
while ($arr=$recordSet_pendidikan->FetchRow()) {
	array_push($data_pendidikan, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("CV_PENDIDIKAN", $data_pendidikan);
 
		  if($jenis_user=='2'){
     
                          
                      
                                            $sql  ="SELECT
                                                r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                                r_penempatan.r_pnpt__no_mutasi  AS r_pnpt__no_mutasi,
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
                                                r_pegawai.r_pegawai__ktp AS r_pegawai__ktp ,
                                                r_pegawai.r_pegawai__sim AS r_pegawai__sim,
                                                r_pegawai.r_pegawai__nama_jalan AS r_pegawai__nama_jalan ,
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
                                                r_provinsi.r_provinsi__nama AS r_provinsi__nama,r_provinsi.r_provinsi__nama AS r_provinsi__nama,r_kabupaten.r_kabupaten__nama AS r_kabupaten__nama,
                                                r_kecamatan.r_kecamatan__nama AS r_kecamatan__nama,
                                                r_wilayah.r_desa__nama AS r_desa__nama,
                                                r_agama.r_agama__nama AS r_agama__nama

                                                FROM
                                                r_pegawai
                                                INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                                INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                                INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                                INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                                INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                                INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                                INNER JOIN r_agama ON r_agama.r_agama__id=r_pegawai.r_pegawai__agama
                                                INNER JOIN r_provinsi ON r_provinsi__id=r_pegawai__ktp_prov
                                                INNER JOIN r_kabupaten ON r_kabupaten.r_kabupaten__id= r_pegawai__ktp_kab
                                                INNER JOIN r_kecamatan ON r_kecamatan.r_kecamatan__id= r_pegawai__ktp_kec
                                                INNER JOIN r_wilayah ON r_wilayah.r_desa__id= r_pegawai__ktp_desa AND r_cabang__id = '".$kode_pw_ses."' ";
                                                
                      

			} else {
					$sql  ="SELECT r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                                r_penempatan.r_pnpt__no_mutasi  AS r_pnpt__no_mutasi,
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
                                                r_pegawai.r_pegawai__ktp AS r_pegawai__ktp ,
                                                r_pegawai.r_pegawai__sim AS r_pegawai__sim,
                                                r_pegawai.r_pegawai__nama_jalan AS r_pegawai__nama_jalan ,
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
                                                r_provinsi.r_provinsi__nama AS r_provinsi__nama,r_provinsi.r_provinsi__nama AS r_provinsi__nama,r_kabupaten.r_kabupaten__nama AS r_kabupaten__nama,
                                                r_kecamatan.r_kecamatan__nama AS r_kecamatan__nama,
                                                r_wilayah.r_desa__nama AS r_desa__nama,
                                                 r_agama.r_agama__nama AS r_agama__nama
                                                FROM
                                                r_pegawai
                                                INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                                INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                                INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                                INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                                INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                                INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                                INNER JOIN r_agama ON r_agama.r_agama__id=r_pegawai.r_pegawai__agama
                                                INNER JOIN r_provinsi ON r_provinsi__id=r_pegawai__ktp_prov
                                                INNER JOIN r_kabupaten ON r_kabupaten.r_kabupaten__id= r_pegawai__ktp_kab
                                                INNER JOIN r_kecamatan ON r_kecamatan.r_kecamatan__id= r_pegawai__ktp_kec
                                                INNER JOIN r_wilayah ON r_wilayah.r_desa__id= r_pegawai__ktp_desa ";	

			}
 
				//echo "<br><br><br><br><br><br><br><br><br><br>dddddddddkode_perwakilan_cari ===".$kode_perwakilan_cari;

                                             if ($kode_cabang_cari !='') {
						 	$sql.=" and  r_cabang__id =".$kode_cabang_cari."  ";
						 }

						 if ($kode_subcab_cari !='') {
						 	$sql.=" and  r_subcab__id ='$kode_subcab_cari' ";
						 }

						if ($departemen_cari !=''  ) {
						 	$sql.="  and r_dept__id='$departemen_cari' ";
						 }
                                                 
                                                  if ($nip_karyawan_cari !='') {
						 	$sql.="and r_pnpt__nip ='$nip_karyawan_cari'";
						 }

		

			 	 $sql.=" ORDER BY r_pegawai__id ";

			    if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);

				$numresults=$db->Execute($sql);
				$count = $numresults->RecordCount();
				$pages = $p->findPages($count,$LIMIT); 
				$sql  .= "LIMIT ".$start.", ".$LIMIT;
				$recordSet = $db->Execute($sql);
				//print $sql;
				$end = $recordSet->RecordCount();
				$initSet = array();
				$data_tb = array();
				$row_class = array();
				$z=0;
				 $count_no = 1;
				while ($arr=$recordSet->FetchRow()) {
					array_push($data_tb, $arr);
                                        
                                   $approval=$arr[t_lembur__approval];    
                                   IF( $approval==2)
                                   {
                                       $approval_status='Disetujui Oleh BOM';
                                   }else
                                   {
                                        $approval_status='Tidak Disetujui Oleh BOM';
                                   }
                                        
                                 $label="Nama :". $arr[r_pegawai__nama]; 
                                 
                                 
                                 $label_bln=$arr[label_bulan];
                                 $label_tahun=$arr[label_tahun];
				
					
			   
//			   $content_data .= print_content(
//                                        $count_no,
//                                        $arr[r_pnpt__nip],
//                                        $arr[r_pegawai__nama],
//                                        $arr[r_cabang__nama],
//                                        $arr[r_subcab__nama],
//                                        $arr[r_dept__ket],
//                                        $arr[r_jabatan__ket],
//                                        $arr[t_lembur__atasan_nama],
//                                        $arr[t_lembur__tanggal],
//                                        $arr[t_lembur__durasi],
//                                        $arr[t_lembur__total],
//                                        $arr[t_lembur__job_description],
//                                        $arr[t_lembur__job_evaluasi],
//                                        $approval_status);
                           //
                           
					if ($z%2==0){ 
						$ROW_CLASSNAME="#CCCCCC"; }
					else {
						$ROW_CLASSNAME="#EEEEEE";
					   }
					array_push($row_class, $ROW_CLASSNAME);
					array_push($initSet, $z);
					$z++;
					  $count_no=$count_no+1;
				}
				
				$count_view = $start+1;
				$count_all  = $start+$end;
				$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 
                                
                                 
                                
                                  $smarty->assign ("DATA_TB", $data_tb);
//				$file= $DIR_HOME."/files/rekap_lembur_".$nm_perwakilan."_".$tahun.".xls";
//				$fp=@fopen($file,"w");
//				if(!is_resource($fp))
//				return false;
//				//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
//				stream_set_write_buffer($fp, 0);
//                             
//				$content = print_header($nm_perwakilan,$bulan,$tahun);
//				$content .= $content_data;
//				
//				$content .= print_footer();
//				fwrite($fp,$content);
//				fclose($fp);
			//	$file_2= $HREF_HOME."/files/rekap_lembur_".$nm_perwakilan."_".$tahun.".xls";
                                
}

}
else
{
				
            $sql__="SELECT *,UPPER(r_cabang__nama) AS nm_perwakilan FROM r_cabang WHERE  r_cabang.r_cabang__id='$kode_cabang_cari' ";
            $rs__=$db->Execute($sql__);
            $nm_perwakilan = $rs__->fields['nm_perwakilan'];
            $smarty->assign ("NM_PERWAKILAN", $nm_perwakilan);
            
			if($jenis_user=='2'){
                            
                           

                                                
                                                $sql = "SELECT r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                                r_penempatan.r_pnpt__no_mutasi  AS r_pnpt__no_mutasi,
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
                                                r_pegawai.r_pegawai__ktp AS r_pegawai__ktp ,
                                                r_pegawai.r_pegawai__sim AS r_pegawai__sim,
                                                r_pegawai.r_pegawai__nama_jalan AS r_pegawai__nama_jalan ,
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
                                                r_provinsi.r_provinsi__nama AS r_provinsi__nama,r_kabupaten.r_kabupaten__nama AS r_kabupaten__nama,
                                                r_kecamatan.r_kecamatan__nama AS r_kecamatan__nama,
                                                r_wilayah.r_desa__nama AS r_desa__nama,
                                                 r_agama.r_agama__nama AS r_agama__nama
                                                FROM
                                                r_pegawai
                                                INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                                INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                                INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                                INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                                INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                                INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                                INNER JOIN r_agama ON r_agama.r_agama__id=r_pegawai.r_pegawai__agama
                                                INNER JOIN r_provinsi ON r_provinsi__id=r_pegawai__ktp_prov
                                                INNER JOIN r_kabupaten ON r_kabupaten.r_kabupaten__id= r_pegawai__ktp_kab
                                                INNER JOIN r_kecamatan ON r_kecamatan.r_kecamatan__id= r_pegawai__ktp_kec
                                                INNER JOIN r_wilayah ON r_wilayah.r_desa__id= r_pegawai__ktp_desa AND  r_cabang__id= '".$kode_pw_ses."' ";
                                            

			} else {
						$sql  = " SELECT r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                                r_penempatan.r_pnpt__no_mutasi  AS r_pnpt__no_mutasi,
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
                                                r_pegawai.r_pegawai__ktp AS r_pegawai__ktp ,
                                                r_pegawai.r_pegawai__sim AS r_pegawai__sim,
                                                r_pegawai.r_pegawai__nama_jalan AS r_pegawai__nama_jalan ,
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
                                                r_provinsi.r_provinsi__nama AS r_provinsi__nama,r_kabupaten.r_kabupaten__nama AS r_kabupaten__nama,
                                                r_kecamatan.r_kecamatan__nama AS r_kecamatan__nama,
                                                r_wilayah.r_desa__nama AS r_desa__nama,
                                                 r_agama.r_agama__nama AS r_agama__nama
                                                FROM
                                                r_pegawai
                                                INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                                INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                                INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                                INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                                INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                                INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                                INNER JOIN r_agama ON r_agama.r_agama__id=r_pegawai.r_pegawai__agama
                                                INNER JOIN r_provinsi ON r_provinsi__id=r_pegawai__ktp_prov
                                                INNER JOIN r_kabupaten ON r_kabupaten.r_kabupaten__id= r_pegawai__ktp_kab
                                                INNER JOIN r_kecamatan ON r_kecamatan.r_kecamatan__id= r_pegawai__ktp_kec
                                                INNER JOIN r_wilayah ON r_wilayah.r_desa__id= r_pegawai__ktp_desa";	

			}
 				
                                       if ($kode_cabang_cari !='') {
						 	$sql.=" and  r_cabang__id =".$kode_cabang_cari."  ";
						 }

						 if ($kode_subcab_cari !='') {
						 	$sql.=" and  r_subcab__id ='$kode_subcab_cari' ";
						 }

						if ($departemen_cari !=''  ) {
						 	$sql.="  and r_dept__id='$departemen_cari' ";
						 }                                                 
                                                  if ($nama_karyawan_cari !='') {
						 	$sql.="and r_pnpt__nip ='$nip_karyawan_cari'  ";
						 }

		

			 	 $sql.=" ORDER BY r_pegawai__id ";
 
				if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
//var_dump($sql)or die();
                                $numresults=$db->Execute($sql);
                          
				$count = $numresults->RecordCount();

				$pages = $p->findPages($count,$LIMIT); 
				$sql  .= "LIMIT ".$start.", ".$LIMIT;
				
				$recordSet = $db->Execute($sql);
				$end = $recordSet->RecordCount();
				$initSet = array();
				$data_tb = array();
				$row_class = array();
				$z=0;
                                 $count_no = 1;
				while ($arr=$recordSet->FetchRow()) {
					array_push($data_tb, $arr);
                                        
                                 $label="Nama :". $arr[r_pegawai__nama]; 					
                                 $label_bln=$arr[label_bulan];
                                 $label_tahun=$arr[label_tahun];
				
					
			    $approval=$arr[t_lembur__approval];    
                                   IF( $approval==2)
                                   {
                                       $approval_status='Disetujui Oleh BOM';
                                   }else
                                   {
                                        $approval_status='Tidak Disetujui Oleh BOM';
                                   }
//			   $content_data .= print_content(
//                                        $count_no,
//                                        $arr[r_pnpt__nip],
//                                        $arr[r_pegawai__nama],
//                                        $arr[r_cabang__nama],
//                                        $arr[r_subcab__nama],
//                                        $arr[r_dept__ket],
//                                        $arr[r_jabatan__ket],
//                                        $arr[t_lembur__atasan_nama],
//                                        $arr[t_lembur__tanggal],
//                                        $arr[t_lembur__durasi],
//                                        $arr[t_lembur__total],
//                                        $arr[t_lembur__job_description],
//                                        $arr[t_lembur__job_evaluasi],
//                                        $approval_status);
                           
					if ($z%2==0){ 
						$ROW_CLASSNAME="#CCCCCC"; }
					else {
						$ROW_CLASSNAME="#EEEEEE";
					   }
					array_push($row_class, $ROW_CLASSNAME);
					array_push($initSet, $z);
					$z++;
                                         $count_no=$count_no+1;
				}

				$count_view = $start+1;
				$count_all  = $start+$end;
				$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 
                                
                                
                                $smarty->assign ("DATA_TB", $data_tb);
//				$file= $DIR_HOME."/files/rekap_lembur_".$nm_perwakilan."_".$tahun.".xls";
//				$fp=@fopen($file,"w");
//				if(!is_resource($fp))
//				return false;
//				//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
//				stream_set_write_buffer($fp, 0);
//				$content = print_header($nm_perwakilan,$bulan,$tahun);
//				$content .= $content_data;
//				
//				$content .= print_footer();
//				fwrite($fp,$content);
//				fclose($fp);
			//	$file_2= $HREF_HOME."/files/rekap_lembur_".$nm_perwakilan."_".$tahun.".xls";
                                
}
//------------------tutup_view_index---------------//        
    
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
//-----------------CLOSE DATA SUBCABANG-------------------------//       


($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;
$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("SEARCH_YEAR", $Search_Year);
$smarty->assign ("FILES", $file_2);
$smarty->assign ("COUNT_NO",$count_no);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _PRINT_LIST_JL_01_MAIN);
$smarty->assign ("RECORD_PER_PAGE", _RECORD_PER_PAGE);
$smarty->assign ("ACTION", _ACTION);
$smarty->assign ("EDIT", _EDIT);
$smarty->assign ("DELETE", _DELETE);
$smarty->assign ("SORT_IN", _SORT_IN);
$smarty->assign ("SORT_ORDER", _SORT_ORDER);
$smarty->assign ("SHOWING", _SHOWING);
$smarty->assign ("OF", _OF);
$smarty->assign ("RECORDS", _RECORDS);
$smarty->assign ("BTN_NEW", _BTN_NEW);
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
$smarty->assign ("DATA_TB", $data_tb);


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