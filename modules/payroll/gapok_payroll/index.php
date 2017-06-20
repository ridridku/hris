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
$periode_awal= $_SESSION['SESSION_AWAL_AKTIF'];
$periode_akhir= $_SESSION['SESSION_AKHIR_AKTIF'];
$smarty->assign ("PERIODE_AWAL", $periode_awal);
$smarty->assign ("PERIODE_AKHIR", $periode_akhir);


$smarty->assign ("JENIS_USER_SES", $jenis_user);
$smarty->assign ("KODE_PW_SES", $kode_pw_ses);
$today= date("Y-m-d");
$smarty->assign ("TODAY", $today);
//echo "JENIS USER".$_SESSION['SESSION_JNS_USER'];
//echo "<br>KODE PERWAKILAN".$_SESSION['SESSION_KODE_PERWAKILAN'];

#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);
$smarty->assign ("HREF_HOME_PATH_AJAX", $HREF_HOME.'/modules/payroll/gapok_payroll');
$smarty->assign ("HREF_IMG_PATH", $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images'));
$smarty->assign ("HREF_CSS_PATH", $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/css'));
$smarty->assign ("HREF_JS_PATH", $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts'));


#DIR
$smarty->assign ("DIR_HOME_PATH", $DIR_HOME);
$smarty->assign ("DIR_IMG_PATH", $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images'));
$smarty->assign ("DIR_CSS_PATH", $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/css'));
$smarty->assign ("DIR_JS_PATH", $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts'));
$smarty->assign ("SELF", $_SERVER['PHP_SELF']);

//------------------------------------LOCAL CONFIG-----------------------------------------------//
#SETTING FOR TEMPLATE
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/payroll/gapok_payroll/';
#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/payroll');
$FILE_JS  = $JS_MODUL.'/gapok_payroll';

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
$tbl_name	= "t_lembur";

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

if ($_GET['kode_cabang_cari']) $kode_cabang_cari = $_GET['kode_cabang_cari'];
else if ($_POST['kode_cabang_cari']) $kode_cabang_cari = $_POST['kode_cabang_cari'];
else $kode_cabang_cari="";


if ($_GET['kode_subcab_cari']) $kode_subcab_cari = $_GET['kode_subcab_cari'];
else if ($_POST['kode_subcab_cari']) $kode_subcab_cari = $_POST['kode_subcab_cari'];
else $kode_subcab_cari="";

if ($_GET['nama_karyawan_cari']) $nama_karyawan_cari = $_GET['nama_karyawan_cari'];
else if ($_POST['nama_karyawan_cari']) $nama_karyawan_cari = $_POST['nama_karyawan_cari'];
else $nama_karyawan_cari="";

if ($_GET['departemen_cari']) $departemen_cari = $_GET['departemen_cari'];
else if ($_POST['departemen_cari']) $departemen_cari= $_POST['departemen_cari'];
else $departemen_cari="";

if ($_GET['bulan']) $bulan = $_GET['bulan'];
else if ($_POST['bulan']) $bulan = $_POST['bulan'];
else $bulan="";

if ($_GET['tahun']) $tahun = $_GET['tahun'];
else if ($_POST['tahun']) $tahun = $_POST['tahun'];
else $tahun="";



$smarty->assign ("KODE_PERWAKILAN_CARI", $kode_perwakilan_cari);
$smarty->assign ("NO_PASPOR_CARI", $no_paspor_cari);
$smarty->assign ("NAMA_WNI_CARI", $nama_wni_cari);
$smarty->assign ("KODE_SUMBER", $kode_sumber);
$smarty->assign ("KODE_SUBCAB_CARI", $kode_subcab_cari);



$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_perwakilan_cari=".$kode_subcab_cari."&kode_subcab_cari=".$kode_subcab_cari;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;

//OTOMATIS ID//
$sql_cek_no="SELECT count(A.t_lembur__no) as no_pel FROM t_lembur A";
$rs_val = $db->Execute($sql_cek_no);
$no_pel= $rs_val->fields[no_pel];

$idMax = $no_pel;
$idMax++;
$newID =sprintf($idMax);
//var_dump($newID) or die();
$smarty->assign ("LEMBUR_AUTO",$newID);


//--------------PERIODE AFTER CLOSING----------------------------------//
 $sql_after_closing_="SELECT r_periode__payroll_id,
    	DATE_SUB(r_periode__payroll_awal, INTERVAL 1 MONTH) as awal,
	DATE_SUB(r_periode__payroll_akhir, INTERVAL 1 MONTH) as akhir,
        r_periode__payroll_status 
        FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";

        $rs_val = $db->Execute($sql_after_closing_);
        $pre_active= $rs_val->fields['awal'];
        $end_active= $rs_val->fields['akhir'];      
        
        $smarty->assign ("PRE_ACTIVE", $pre_active);
        $smarty->assign ("END_ACTIVE", $end_active);
 //--------------PERIODE AFTER CLOSING----------------------------------//  

//OTOMATIS CLOSE
//-----------SHOW DATA STATUS KARYAWAN-----------//
$sql_status= "SELECT * FROM r_status_pegawai";
$result_status = $db->Execute($sql_status);
$initSet = array();
$data_status = array();
$z=0;
while ($arr=$result_status->FetchRow()) {
	array_push($data_status, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_STATUS", $data_status);
//-----------CLOSE DATA STATUS KARYAWAN--//

//-----------SHOW DATA SHIFT-----------------------//
$sql_shift = "SELECT * FROM r_shift";
//var_dump($sql_shift)or die();
$result_shift = $db->Execute($sql_shift);
$initSet = array();
$data_shift = array();
$z=0;
while ($arr=$result_shift->FetchRow()) {
	array_push($data_shift, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_SHIFT", $data_shift);
//-----------CLOSE DATA SHIFT-----------------------//



//-----------SHOW DATA CABANG----------------------//
$sql_cabang = "SELECT A.r_cabang__id,A.r_cabang__nama FROM r_cabang A";
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

//-----------------DATA SUBCABANG-------------------------//and cab.r_cabang__id='$kode_pw_ses' 
$sql_subcab = "SELECT subcab.r_subcab__nama,subcab.r_subcab__id FROM r_cabang cab,r_subcabang subcab
               where cab.r_cabang__id=subcab.r_subcab__cabang and cab.r_cabang__id='$kode_pw_ses' order by subcab.r_subcab__id";
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
//-----------------CLOSE DATA SUBCABANG------------//

//-----------------------DATA AJAX SUBCAB---------//

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
//---closer ajax subcabang id------//
//-----------------------DATA AJAX SUBCAB2---------//

if ($_GET[get_subcab2] == 1)
{     
    $subcabang = $_GET[no_subcab];   
    if($subcabang!=''){
					$sql_kabupaten = "SELECT cab.r_cabang__id ,cab.r_cabang__nama,subcab.r_subcab__nama,subcab.r_subcab__id as subcab FROM r_cabang cab,r_subcabang subcab
                                                          where cab.r_cabang__id=subcab.r_subcab__cabang AND cab.r_cabang__id='$subcabang' ORDER BY cab.r_cabang__nama ASC";
                                        //var_dump($sql_kabupaten)or die();
                                        $recordSet_kabupaten = $db->Execute($sql_kabupaten);
					
					$input_kab="<select name=kode_subcab_cari>";
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
//---closer ajax subcabang2-----//





//-----------SHOW DATA DEPARTEMEN-----------------------//
$sql_departemen = "SELECT A.r_dept__id,A.r_dept__ket FROM r_departement A";
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
//-----------CLOSE DATA DEPARTEMEN-----------------------//

//-----------SHOW DATA SUBDEPARTEMEN-----------------------//
$sql_subdepartement = "SELECT A.r_subdept__id,A.r_subdept__dept,A.r_subdept__ket  FROM r_subdepartement A";
$result_subdepartement= $db->Execute($sql_subdepartement);
$initSet = array();
$data_subdepartement = array();
$z=0;
while ($arr=$result_subdepartement->FetchRow()) {
	array_push($data_subdepartement, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_SUBDEP", $data_subdepartement);
//-----------CLOSE DATA SUBDEPARTEMEN----------------------//



//----------- AJAX SUBDEP ------------------//
if ($_GET[get_subdep] == 1)
{  
    	$subdep = $_GET[no_subdep];
            //var_dump($subdep) or die();
			if($subdep!=''){
					$sql_kabupaten = " SELECT dep.r_dept__id,dep.r_dept__akronim,dep.r_dept__ket,subdep.r_subdept__ket,subdep.r_subdept__id FROM r_departement dep LEFT JOIN r_subdepartement subdep ON subdep.r_subdept__dept=dep.r_dept__id  "
                                                . "where dep.r_dept__id=".$subdep." ORDER BY dep.r_dept__ket ASC";
                                        //var_dump($sql_kabupaten)or die();
                                        $recordSet_kabupaten = $db->Execute($sql_kabupaten);
					
					$input_kab="<select name=kode_subdep >";
					$input_kab.="<option value=''> ";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF):
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields[r_subdept__id].">".$recordSet_kabupaten->fields['r_subdept__ket'];
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
//------------closer AJAX SUBDEP-------------------------//



//-------------data_pwk---------------------------------//
$sql_pwk = "SELECT * FROM r_cabang order by r_cabang__nama";
$result_pwk = $db->Execute($sql_pwk);

$initSet = array();
$data_pwk = array();
$z=0;
while ($arr=$result_pwk->FetchRow()) {
	array_push($data_pwk, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PWK", $data_pwk);

//---------------------Data_jabatan---------------------------

$sql_jabatan= "SELECT A.r_jabatan__id,A.r_jabatan__ket FROM r_jabatan A ";
$result_jabatan = $db->Execute($sql_jabatan);
$initSet = array();
$data_jabatan = array();
$z=0;
while ($arr=$result_jabatan->FetchRow()) {
	array_push($data_jabatan, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_JABATAN", $data_jabatan);

//----------------------data_bank------------------------------------
$sql_bank = "SELECT * FROM r_bank order by r_bank__kode  ";
$result_bank = $db->Execute($sql_bank);

$initSet = array();
$data_bank = array();
$z=0;
while ($arr=$result_bank->FetchRow()) {
	array_push($data_bank, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_BANK", $data_bank);

//----------------------DATA LEVEL------------------------------
$sql_level = "SELECT * FROM r_level order by r_level__ket  ";
$result_level= $db->Execute($sql_level);

$initSet = array();
$data_level= array();
$z=0;
        while ($arr=$result_level->FetchRow()) {
	array_push($data_level, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_LEVEL", $data_level);

//-----------------------VIEW EDIT ---------------------------------------//
$opt = $_GET[opt];

$ed = 0;
if($opt=="1"){ 
$edit=1;

$parent_id=$_GET[parent_id];
$sql_2="SELECT IF(B.r_gapok__nilai='0','0','1')as verifikasi,
IF(B.r_level__id<9,'1','2')status_staf,
    B.* FROM (SELECT TIMESTAMPDIFF(MONTH,A.r_pegawai__tgl_masuk,DATE_FORMAT(NOW(), '%Y-%m-%d')) AS lama_bln, A.*,r_gapok.* FROM (
SELECT * FROM r_pegawai
INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
INNER JOIN r_level ON r_jabatan.r_jabatan__level = r_level.r_level__id
INNER JOIN r_status_pegawai ON r_status_pegawai.r_stp__id = r_penempatan.r_pnpt__status
INNER JOIN r_tipe_penempatan ON r_tipe_penempatan.tipe_penempatan__id = r_penempatan.r_pnpt__pdrm
WHERE r_penempatan.r_pnpt__aktif = '1' )A
LEFT JOIN r_gapok ON r_gapok.r_gapok__idpeg=A.r_pnpt__id_pegawai)B
WHERE B.r_cabang__id=".$_GET['id']." GROUP BY B.r_pegawai__id order by B.r_pegawai__id ASC";


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
$smarty->assign ("DATA_PJM", $list_pjm);


//
////cek sudah di approve
//
// $sql_2 = "SELECT
//        r_departement.r_dept__ket AS r_dept__ket,
//        r_penempatan.r_pnpt__id_pegawai AS r_pnpt__id_pegawai,
//        r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
//        r_penempatan.r_pnpt__nip AS r_pnpt__nip,
//        r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
//        r_subcabang.r_subcab__id AS r_subcab__id,
//        r_subcabang.r_subcab__nama AS r_subcab__nama,
//        r_cabang.r_cabang__id AS r_cabang__id,
//        r_cabang.r_cabang__nama AS r_cabang__nama,
//        r_pegawai.r_pegawai__id AS id_pegawai,
//        r_pegawai.r_pegawai__nama AS r_pegawai__nama,
//        r_shift.r_shift__jam_masuk AS ketentuan_jam_masuk,
//        r_shift.r_shift__jam_pulang AS ketentuan_jam_keluar,
//        t_absensi.t_abs__id AS t_abs__id,
//        t_absensi.t_abs__tgl AS t_abs__tgl,
//        t_absensi.t_abs__jam_masuk AS t_abs__jam_masuk,
//        t_absensi.t_abs__jam_keluar AS t_abs__jam_keluar,
//        t_absensi.t_abs__early AS t_abs__early,
//      
//        t_absensi.t_abs__lately AS t_abs__lately,
//        t_absensi.t_abs__approval AS t_abs__approval,
//        t_absensi.t_abs__lesstime AS t_abs__lesstime,
//        t_absensi.t_abs__overtime AS t_abs__overtime,
//        t_absensi.t_abs__worktime AS t_abs__worktime,
//        t_absensi.t_abs__status AS t_abs__status,
//        r_jabatan.r_jabatan__id AS r_jabatan__id,
//        r_jabatan.r_jabatan__ket AS r_jabatan__ket,
//
//        r_level_lembur.r_level__nominal AS r_level__nominal,
//        r_level_lembur.r_level__makan AS r_level__makan,
//        r_level_lembur.r_level__transport AS r_level__transport,
//        r_level_lembur.r_level__sewa_kendaraan AS r_level__sewa_kendaraan,
//        r_level_lembur.r_level__ket AS r_level__ket, 
//
//        r_level.r_level__id AS r_level__id,
//        r_level.r_level__ket AS r_level__ket
//        FROM
//        r_penempatan
//        INNER JOIN r_pegawai ON r_pegawai.r_pegawai__id = r_penempatan.r_pnpt__id_pegawai
//        INNER JOIN r_shift ON r_shift.r_shift__id = r_penempatan.r_pnpt__shift
//        INNER JOIN t_absensi ON r_penempatan.r_pnpt__finger_print = t_absensi.t_abs__fingerprint
//        INNER JOIN r_subcabang ON r_subcabang.r_subcab__id = r_penempatan.r_pnpt__subcab
//        INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
//        INNER JOIN r_subdepartement ON r_subdepartement.r_subdept__id = r_pnpt__subdept
//        INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
//        INNER JOIN r_jabatan ON r_jabatan__id = r_penempatan.r_pnpt__jabatan
//        INNER JOIN r_level ON r_level__id = r_jabatan__level
//        INNER JOIN r_level_lembur ON r_level_lembur.r_level__id = r_level.r_level__id
//
//        WHERE
//        t_absensi.t_abs__tgl >= '$periode_awal'
//        AND t_absensi.t_abs__tgl <= '$periode_akhir'
//        AND r_penempatan.r_pnpt__finger_print ='".$_GET['id']."' ";
////var_dump($sql_2)or die();
//$result_cek_lembur = $db->Execute($sql_2);
//$jumlah_menu_cek = $result_cek_lembur->RecordCount();
//$list_cek_lembur = array();
//
//$initSet = array();
//$row_class = array();
//
//$z=0;
//while($arr = $result_cek_lembur->FetchRow()){
//array_push ($list_cek_lembur, $arr);
//if ($z%2==0){ 
//		$ROW_CLASSNAME="#CCCCCC"; }
//	else {
//		$ROW_CLASSNAME="#EEEEEE";
//	   }
//	array_push($row_class, $ROW_CLASSNAME);
//	array_push($initSet, $z);
//	$z++;
//}
//$smarty->assign ("DATA_APP_LEMBUR", $list_cek_lembur);

}



$smarty->assign ("OPT", $opt);
$smarty->assign ("EDIT_ID",$edit_id);
$smarty->assign ("EDIT_VAL", $edit);

//----------------CLOSE EDIT---------------------//

//-----------------------CLOSE VIEW EDIT------------------------//



 
        
        
//-----------------------------------------VIEW INDEX---------------------------------------------------------------------//
if ($_GET['search'] == '1')
    {
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
 
		  if($jenis_user=='2'){
                                   $sql  = "SELECT IF ((SELECT t_gaji.t_gaji__cabang_id from t_gaji 
                                            where t_gaji.t_gaji__awal='$pre_active' and t_gaji.t_gaji__akhir='$end_active' and t_gaji__cabang_id=A.r_cabang__id
                                            GROUP BY t_gaji__cabang_id) IS NULL,'0', ('1')) as ket_posting,
                                            A.* FROM (SELECT r_cabang.*,t_gaji.* FROM r_cabang
                                            LEFT JOIN t_gaji ON t_gaji.t_gaji__cabang_id=r_cabang.r_cabang__id
                                            GROUP BY r_cabang__id)A
                                             WHERE 1=1 ";                     
                                    } else {
				$sql  = "SELECT IF ((SELECT t_gaji.t_gaji__cabang_id from t_gaji 
                                            where t_gaji.t_gaji__awal='$pre_active' and t_gaji.t_gaji__akhir='$end_active' and t_gaji__cabang_id=A.r_cabang__id
                                            GROUP BY t_gaji__cabang_id) IS NULL,'0', ('1')) as ket_posting,
                                            A.* FROM (SELECT r_cabang.*,t_gaji.* FROM r_cabang
                                            LEFT JOIN t_gaji ON t_gaji.t_gaji__cabang_id=r_cabang.r_cabang__id
                                            GROUP BY r_cabang__id)A
                                               WHERE 1=1";	

			}
 
				//echo "<br><br><br><br><br><br><br><br><br><br>dddddddddkode_perwakilan_cari ===".$kode_perwakilan_cari;
			 
				if($kode_cabang_cari !=''){
					$sql .= " AND  A.r_cabang__id= '".$kode_cabang_cari."'  ";
				}
				if($nama_karyawan_cari !=''){
					$sql .= " AND A.r_pegawai__nama LIKE '%".$nama_karyawan_cari."%' "; 
				}
                                if($idfinger_cari !=''){
					$sql .= " AND A.r_pnpt__finger_print = '".$idfinger_cari."' ";
				}
			 	 $sql .= " GROUP BY A.r_cabang__id ";

                        IF ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
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

}
else
    
{
    
				
			if($jenis_user=='2'){
          
                                    $sql = "SELECT IF ((SELECT t_gaji.t_gaji__cabang_id from t_gaji 
                                            where t_gaji.t_gaji__awal='$pre_active' and t_gaji.t_gaji__akhir='$end_active' and t_gaji__cabang_id=A.r_cabang__id
                                            GROUP BY t_gaji__cabang_id) IS NULL,'0', ('1')) as ket_posting,
                                            A.* FROM (SELECT r_cabang.*,t_gaji.* FROM r_cabang
                                            LEFT JOIN t_gaji ON t_gaji.t_gaji__cabang_id=r_cabang.r_cabang__id
                                            GROUP BY r_cabang__id)A
                                               WHERE 1=1";
                                            

			} else {
                                    $sql  = "SELECT IF ((SELECT t_gaji.t_gaji__cabang_id from t_gaji 
                                            where t_gaji.t_gaji__awal='$pre_active' and t_gaji.t_gaji__akhir='$end_active' and t_gaji__cabang_id=A.r_cabang__id
                                            GROUP BY t_gaji__cabang_id) IS NULL,'0', ('1')) as ket_posting,
                                            A.* FROM (SELECT r_cabang.*,t_gaji.* FROM r_cabang
                                            LEFT JOIN t_gaji ON t_gaji.t_gaji__cabang_id=r_cabang.r_cabang__id
                                            GROUP BY r_cabang__id)A
                                               WHERE 1=1 ";	

			}
                                
                              if($kode_cabang_cari !=''){
					$sql .= " AND  A.r_cabang__id= '".$kode_cabang_cari."'  ";
				}
				if($nama_karyawan_cari !=''){
					$sql .= " AND A.r_pegawai__nama LIKE '%".$nama_karyawan_cari."%' "; 
				}
                                if($idfinger_cari !=''){
					$sql .= " AND A.r_pnpt__finger_print = '".$idfinger_cari."' "; 
                                        
				} 

				 $sql .= " GROUP BY A.r_cabang__id ";
 
				if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);

                                $numresults=$db->Execute($sql);
                                $count = $numresults->RecordCount();
			//	$pages = $p->findPages($count,$LIMIT); 
			//	$sql  .= "LIMIT ".$start.", ".$LIMIT;
				
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
				//$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 

}
//---------------------------------CLOSE VIEW INDEX---------------------------------------------------------------------//

//hitung_lembur
if ($_GET[cek_lembur] == 1)
{
    
    $level= $_GET['level_id'];
    $tgl_lembur= $_GET['lembur_tanggal'];
    $durasi= $_GET['lembur_durasi'];
    $id_pegawai= $_GET['id_pegawai'];
    
    $sql_libur ="SELECT
            r_penempatan.r_pnpt__nip AS r_pnpt__nip,
            r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
            r_pegawai.r_pegawai__id AS r_pegawai__id,
            r_pegawai.r_pegawai__nama AS r_pegawai__nama,
            r_pegawai.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
            r_pegawai.r_pegawai__ktp AS r_pegawai__ktp,
            r_status_pegawai.r_stp__id AS r_stp__id,
            r_status_pegawai.r_stp__nama AS r_stp__nama,
            r_level.r_level__id AS r_level__id,
            r_level.r_level__ket AS r_level__ket,
            r_level_lembur.r_level__ket AS r_level__ket,
            r_level_lembur.r_level__nominal AS r_level__nominal,
            r_level_lembur.r_level__makan AS r_level__makan,
            r_level_lembur.r_level__transport AS r_level__transport,
            t_libur.r_libur__tgl AS r_libur__tgl,
            t_libur.r_libur__id AS r_libur__id,
            t_libur.r_libur__ket AS r_libur__ket
            FROM
                    r_pegawai
            INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
            INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
            INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
            INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
            INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
            INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
            INNER JOIN r_status_pegawai ON r_status_pegawai.r_stp__id = r_penempatan.r_pnpt__status
            INNER JOIN r_level ON r_level__id=r_jabatan__level
            INNER JOIN r_level_lembur ON r_level_lembur.r_level__id=r_level.r_level__id 
            inner JOIN t_libur ON t_libur.r_libur__shift = r_pnpt__shift
             where r_level.r_level__id='$level' AND  r_libur__tgl='$tgl_lembur'  AND r_pnpt__id_pegawai='$id_pegawai'";

    $resultSet = $db->Execute($sql_libur);
    $cek_libur= $resultSet->fields[r_libur__tgl];
    $cek_level= $resultSet->fields[r_level__id];
    $cek_nominal= $resultSet->fields[r_level__nominal];
    
   
    
    if($cek_libur>0)
    {
     //   jika libur
        $lembur_sql=" SELECT
            r_level.r_level__id AS r_level__id,
            r_level.r_level__ket AS r_level__ket,
            r_level_lembur.r_level__ket AS r_level__ket,
            r_level_lembur.r_level__nominal AS r_level__nominal,
            r_level_lembur.r_level__makan AS r_level__makan,
            r_level_lembur.r_level__transport AS r_level__transport,
            t_libur.r_libur__tgl AS r_libur__tgl,
            t_libur.r_libur__id AS r_libur__id,
            t_libur.r_libur__ket AS r_libur__ket
            FROM
                    r_pegawai
            INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
            INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
            INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
            INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
            INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
            INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
            INNER JOIN r_status_pegawai ON r_status_pegawai.r_stp__id = r_penempatan.r_pnpt__status
            INNER JOIN r_level ON r_level__id=r_jabatan__level
            INNER JOIN r_level_lembur ON r_level_lembur.r_level__id=r_level.r_level__id 
            inner JOIN t_libur ON t_libur.r_libur__shift = r_pnpt__shift
             where r_level.r_level__id='$level'";
    
        $resultSet = $db->Execute($lembur_sql);
        $nominal_lembur =  ($libur= $resultSet->fields[r_level__nominal]*2);
        
        if($durasi>=4)
        {
              $nominal_makan=$resultSet->fields[r_level__makan];
               $nominal_transport=$resultSet->fields[r_level__transport];
        }
        else
        {
            $nominal_makan=0;
            $nominal_transport=0;
        }
        
        
        
            
        
    }
    else
    {
        //   jika hari biasa weekday
            $lembur_sql=" SELECT
            r_level.r_level__id AS r_level__id,
            r_level.r_level__ket AS r_level__ket,
            r_level_lembur.r_level__ket AS r_level__ket,
            r_level_lembur.r_level__nominal AS r_level__nominal,
            r_level_lembur.r_level__makan AS r_level__makan,
            r_level_lembur.r_level__transport AS r_level__transport,
            t_libur.r_libur__tgl AS r_libur__tgl,
            t_libur.r_libur__id AS r_libur__id,
            t_libur.r_libur__ket AS r_libur__ket
            FROM
            r_pegawai
            INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
            INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
            INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
            INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
            INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
            INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
            INNER JOIN r_status_pegawai ON r_status_pegawai.r_stp__id = r_penempatan.r_pnpt__status
            INNER JOIN r_level ON r_level__id=r_jabatan__level
            INNER JOIN r_level_lembur ON r_level_lembur.r_level__id=r_level.r_level__id 
            inner JOIN t_libur ON t_libur.r_libur__shift = r_pnpt__shift
             where r_level.r_level__id='$level'";
         //   var_dump($lembur_sql)or die();
        $resultSet = $db->Execute($lembur_sql);
        $nominal_lembur = $resultSet->fields[r_level__nominal];
    if($durasi>=2)
        {
              $nominal_makan=$resultSet->fields[r_level__makan];
              $nominal_transport=0;    
        }
        else
        {
             $nominal_makan=0;
             $nominal_transport=0;    
        }
        
        
        
        
        
    }
    
     
    
    $jumlah_lembur=$nominal_lembur*$durasi;
    $TOTAL=0;
    $TOTAL=$jumlah_lembur+$nominal_makan+$nominal_transport;
    
    if($level!=''){
        $input_kab="<TABLE class='tborder' border='0' cellpadding='1' cellspacing='1' border='0' width='100%' align='left'>";
          $input_kab.='<THEAD>';
                                       
                                        $input_kab.="<th class='tdatahead' align='left' width='10%'>Nominal Lembur/Jam</th>";
                                        $input_kab.="<th class='tdatahead' align='left' width='10%'>Jumlah Lembur</th>";
                                        $input_kab.="<th class='tdatahead' align='left' width='10%'>Uang Makan</th>";
                                        $input_kab.="<th class='tdatahead'  align='left'  width='10%'>Uang Transport</th>";
                                        $input_kab.="<th class='tdatahead'  align='left'  width='10%'>TOTAL</th>";
                        
        $input_kab.='</THEAD>';
        $input_kab.="<TR><TD><INPUT TYPE='text' readonly='' name='lembur_nominal' value=".$nominal_lembur." ></TD>";
        $input_kab.="<TD><INPUT TYPE='text' readonly='' name='lembur_jml' value=".$jumlah_lembur."></TD>";
        $input_kab.="<TD><INPUT TYPE='text' readonly='' name='lembur_makan' value=".$nominal_makan."></TD>";
        $input_kab.="<TD><INPUT TYPE='text' readonly='' name='lembur_transport' value=".$nominal_transport." ></TD>";
        $input_kab.="<TD><INPUT TYPE='text' readonly='' name='lembur_total' value=".$TOTAL." ></TD>";
                
                $input_kab.="</table> ";
                $delimeter   = "-";
                $option_choice = $input_kab."^/&".$delimeter;
                echo $option_choice;
        }
    
}

$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_KELURAHAN);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_KELURAHAN);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("TITLE", _TITLE_KEL);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_KEL);
$smarty->assign ("TB_CODE", _ID_KELURAHAN);
$smarty->assign ("TB_CODE_2", _ID_KELURAHAN);
$smarty->assign ("TB_NAMA_PROPINSI",_NAMA_PROPINSI);
$smarty->assign ("TB_NAMA_KABUPATEN",_NAMA_KABUPATEN);
$smarty->assign ("TB_NAMA_KECAMATAN",_NAMA_KECAMATAN);
$smarty->assign ("TB_NAMA_KELURAHAN",_NAMA_KELURAHAN);
$smarty->assign ("TB_NO_KELURAHAN",_NO_KELURAHAN);
$smarty->assign ("SUBMIT", _SUBMIT);
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