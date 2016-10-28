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
$_SESSION['LANG']   = $LANG;

#FOR IMAGES CLASS PAGER
$HREF_IMAGES = $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images');

# including Header file for Content Expiring
require_once($DIR_INC.'/header.exp.inc');
# including Header file for Database Configuration
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');
require_once($DIR_HOME.'../laporan/inc.rekap_absen_harian.php');  

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/pelaporan/lap_absen/rekap_absen_harian';
 
#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/pelaporan/lap_absen');
$FILE_JS  = $JS_MODUL.'/rekap_absen_harian';

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
else $ORDER="r_pnpt__finger_print";

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

if ($_GET['bulan']) $bulan = $_GET['bulan'];
else if ($_POST['bulan']) $bulan = $_POST['bulan'];
else $bulan="";

if ($_GET['tahun']) $tahun = $_GET['tahun'];
else if ($_POST['tahun']) $tahun = $_POST['tahun'];
else $tahun="";


if ($_GET['nama_karyawan_cari']) $nama_karyawan_cari = $_GET['nama_karyawan_cari'];
else if ($_POST['nama_karyawan_cari']) $nama_karyawan_cari = $_POST['nama_karyawan_cari'];
else $nama_karyawan_cari="";
//var_dump($a)or die();

if ($_GET['search']) $search = $_GET['search'];
else if ($_POST['search']) $search = $_POST['search'];
else $search="";


$smarty->assign ("KODE_CABANG_CARI", $kode_cabang_cari);
$tahun_ses_aktif		=	$_SESSION['SESSION_TAHUN_AKTIF'];
$bulan_ses_aktif		=	$_SESSION['SESSION_BULAN_AKTIF'];
$smarty->assign ("TAHUN_SES", $tahun_ses_aktif);
$smarty->assign ("BULAN_SES", $bulan_ses_aktif);

//$fields_find_jns_jln_	= $jns_jln!=""?$jns_jln:$jns_jln2;

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
//-----------------CLOSE DATA SUBCABANG-------------------------------------------------------//

//-----------------------DATA AJAX SUBCAB-----------------------------------------------------//

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
//-------------------------------------------closer ajax subcabang id-------------------------------------------------------------//


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

//if ($_GET[get_proyek] == 1)
//{
//	$kode_proyek = $_GET[kode_proyek];
//			if($kode_proyek!=''){	
//					$sql_ruas_combo 	  = " SELECT * FROM tbl_proyek_detail_ruas   WHERE kode_proyek ='$kode_proyek' ORDER BY nama_paket ";
//					$result_data_usulan = $db->execute($sql_ruas_combo);
//			 
//					//echo $sql_data_usulan;
//					$data_usulan = "<select id=\"kode_paket\"  name=\"kode_paket\" style=\"width:200px\" >";
//					$data_usulan .= "<option value=\"\"> [Pilih  Paket] </option>";
//
//					while(!$result_data_usulan ->EOF):
//						$data_usulan .= "<option value=".$result_data_usulan->fields['kode_paket'].">".$result_data_usulan->fields['nama_paket']."</option>";
//						$result_data_usulan->MoveNext();
//					endwhile; 	
//					 $data_usulan .="</select>";
//					$delimeter   = "-";
//			 
//					 $option_choice = $data_usulan."^/&".$delimeter;	
//					echo $option_choice;	
//			}
//}

    
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
	 
                            
                           

if ($_GET['search'] == '1')
    {
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
            $sql__="SELECT *,UPPER(r_cabang__nama) AS nm_perwakilan FROM r_cabang WHERE  r_cabang.r_cabang__id='$kode_cabang_cari' ";
            $rs__=$db->Execute($sql__);
            $nm_perwakilan = $rs__->fields['nm_perwakilan'];
            $smarty->assign ("NM_PERWAKILAN", $nm_perwakilan);
 
		  if($jenis_user=='2'){
                      
                                                $sql  = "SELECT
                                                        r_shift__ket AS r_shift__ket ,
                                                        r_shift__jam_masuk AS r_shift__jam_masuk,
                                                        r_shift__jam_pulang AS r_shift__jam_pulang,
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
                                                        t_abs__id AS t_abs__id,
                                                        t_abs__fingerprint AS t_abs__fingerprint,
                                                        t_abs__tgl AS t_abs__tgl,
                                                        t_abs__id_shift AS t_abs__id_shift,
                                                        t_abs__jam_masuk AS t_abs__jam_masuk,
                                                        t_abs__jam_keluar AS t_abs__jam_keluar,
                                                        t_abs__early AS t_abs__early,
                                                        t_abs__lately AS t_abs__lately,
                                                        t_abs__approval AS t_abs__approval,
                                                        t_abs__lesstime AS t_abs__lesstime,
                                                        t_abs__overtime AS t_abs__overtime,
                                                        t_abs__worktime AS t_abs__worktime

                                                        FROM
                                                        r_pegawai
                                                        INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                                        INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                                        INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                                        INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                                        INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                                        INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                                        INNER JOIN t_absensi ON t_absensi.t_abs__fingerprint=r_penempatan.r_pnpt__finger_print
                                                        INNER JOIN r_shift ON r_shift.r_shift__id=t_absensi.t_abs__id_shift where r_cabang__id = '".$kode_pw_ses."' ";
                                                
                      

			} else {
						$sql  = "SELECT
                                                        r_shift__ket AS r_shift__ket,
                                                        r_shift__jam_masuk AS r_shift__jam_masuk,
                                                        r_shift__jam_pulang AS r_shift__jam_pulang,
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
                                                        t_abs__id AS t_abs__id,
                                                        t_abs__fingerprint AS t_abs__fingerprint,
                                                        t_abs__tgl AS t_abs__tgl,
                                                        t_abs__id_shift AS t_abs__id_shift,
                                                        t_abs__jam_masuk AS t_abs__jam_masuk,
                                                        t_abs__jam_keluar AS t_abs__jam_keluar,
                                                        t_abs__early AS t_abs__early,
                                                        t_abs__lately AS t_abs__lately,
                                                        t_abs__approval AS t_abs__approval,
                                                        t_abs__lesstime AS t_abs__lesstime,
                                                        t_abs__overtime AS t_abs__overtime,
                                                        t_abs__worktime AS t_abs__worktime

                                                        FROM
                                                        r_pegawai
                                                        INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                                        INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                                        INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                                        INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                                        INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                                        INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                                        INNER JOIN t_absensi ON t_absensi.t_abs__fingerprint=r_penempatan.r_pnpt__finger_print
                                                        INNER JOIN r_shift ON r_shift.r_shift__id=t_absensi.t_abs__id_shift where 1=1 ";	

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

						 
                                                  if ($bulan !='') {
						 	$sql.=" and MONTH(t_abs__tgl)='$bulan'  ";
						 }
                                                 
                                                  if ($tahun !='') {
						 	$sql.=" AND YEAR(t_abs__tgl)=$tahun  ";
						 }
                                                 
                                                  if ($nama_karyawan_cari !='') {
						 	$sql.="and r_pegawai__nama LIKE '%".$nama_karyawan_cari."%'  ";
						 }

		

			 	$sql.=" ORDER BY t_abs__tgl asc ";

			//    if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
                    // var_dump($sql)or die();
                                 
				$numresults=$db->Execute($sql);
				$count = $numresults->RecordCount();
			//	$pages = $p->findPages($count,$LIMIT); 
			//	$sql  .= "LIMIT ".$start.", ".$LIMIT;
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
                                        
                                 $label="Nama :". $arr[r_pegawai__nama]; 
                                 
                                 
                                 $label_bln=$arr[label_bulan];
                                 $label_tahun=$arr[label_tahun];
				
					
			   
			   $content_data .= print_content(
                                    $count_no,
                                    $arr[r_pnpt__finger_print],
                                    $arr[r_pegawai__nama],
                                    $arr[r_subcab__nama],
                                    $arr[r_dept__ket],
                                    $arr[r_shift__jam_masuk],
                                    $arr[r_shift__jam_pulang],
                                    $arr[t_abs__tgl],
                                    $arr[t_abs__jam_masuk],
                                    $arr[t_abs__jam_keluar],
                                    $arr[t_abs__early],
                                    $arr[t_abs__lately],
                                    $arr[t_abs__worktime],
                                    $arr[t_abs__lesstime],
                                    $arr[t_abs__overtime],
                                    $arr[r_shift__ket]
                                   );	
                           
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
			//	$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer);                                 
                                  $smarty->assign ("DATA_TB", $data_tb);
                                  
                              //total karyawan
                          $sql_total="SELECT COUNT(t_abs__tgl) As sum_tgl,
                                        SEC_TO_TIME( sum(t_abs__jam_masuk)) as sum_masuk,
                                        SEC_TO_TIME( sum(t_abs__jam_keluar)) as sum_keluar,
                                        SEC_TO_TIME(sum(TIME_TO_SEC(t_abs__early))) as sum_early,
                                        SEC_TO_TIME(sum(TIME_TO_SEC(t_abs__lately))) as sum_lately,
                                        SEC_TO_TIME(sum(TIME_TO_SEC(t_abs__worktime))) as sum_worktime,
                                        SEC_TO_TIME(sum(TIME_TO_SEC(t_abs__lesstime))) as sum_lesstime,
                                        SEC_TO_TIME(sum(TIME_TO_SEC(t_abs__overtime))) as sum_overtime

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
                                  INNER JOIN t_absensi
                                    ON t_absensi.t_abs__fingerprint = r_penempatan.r_pnpt__finger_print
                                  INNER JOIN r_shift
                                    ON r_shift.r_shift__id = t_absensi.t_abs__id_shift where 1=1 ";
                             if ($kode_cabang_cari !='') {
                                       $sql_total.=" and  r_cabang__id =".$kode_cabang_cari."  ";
                                }

                                if ($kode_subcab_cari !='') {
                                       $sql_total.=" and  r_subcab__id ='$kode_subcab_cari' ";
                                }

                               if ($departemen_cari !=''  ) {
                                       $sql_total.="  and r_dept__id='$departemen_cari' ";
                                } 
                               if ($nama_karyawan_cari !='') {
                                        $sql_total.="and r_pegawai__nama LIKE '%".$nama_karyawan_cari."%'  ";
						 }
//
                                   $rs_sum=$db->Execute($sql_total);
                                   
                                   $sum_early =$rs_sum->fields['sum_early'];
                                   $sum_lately =$rs_sum->fields['sum_lately'];
                                   $sum_worktime =$rs_sum->fields['sum_worktime'];
                                   $sum_overtime= $rs_sum->fields['sum_overtime'];
                                   $sum_lesstime= $rs_sum->fields['sum_lesstime'];
                                   
                               //    var_dump($sum_early) or die();
                                 $smarty->assign ("SUM_EARLY", $sum_early); 
                                 $smarty->assign ("SUM_LATELY", $sum_lately);
                                 $smarty->assign ("SUM_WORKTIME", $sum_worktime);
                                 $smarty->assign ("SUM_OVERTIME", $sum_overtime);
                                 $smarty->assign ("SUM_LESSTIME", $sum_lesstime);
           
        
                               //TUTUP TOTAL    
//                                 //   var_dump($sum_overtime)or die();
//                                $numresults4=$db->Execute($sql_total);
//				$count4 = $numresults4->RecordCount();
// 				$recordSet4 = $db->Execute($sql_total);
//				$end4 = $recordSet4->RecordCount();
//				$initSet4 = array();
//				$data_tb4 = array();
//				$row_class4 = array();
//				$z=0;
//				while ($arr4=$recordSet4->FetchRow()) {
//					array_push($data_tb4, $arr4);
//					if ($z%2==0){
//						$ROW_CLASSNAME="#CCCCCC"; }
//					else {
//						$ROW_CLASSNAME="#EEEEEE";
//					   }
//                                array_push($row_class4, $ROW_CLASSNAME2);
//				array_push($initSet4, $z);
//					$z++;
//                                  //      var_dump($arr4[sum_early])or die();
//				//	$label="JML KARYAWAN : ".$arr4[total_orang];
//				//	$content_data .= print_content("","","","","","","","","","","",$label);
//				}
//$content_data .= print_content("","","","","","","","","",$label,$sum_early,$sum_lately,$sum_worktime,$sum_lesstime,$sum_overtime,"");
                           
//                                  $sum_early =$arr4['sum_early'];
//                                   $sum_lately =$arr4['sum_lately'];
//                                   $sum_worktime =$arr4['sum_worktime'];
//                                   $sum_overtime= $arr4['sum_overtime'] ;
//                                   $sum_lesstime= $arr4['sum_lesstime'] ;
                                
                                $label="TOTAL JAM :";
                         //   $content_data .= print_content("","","","","","","","","",$label,$arr4[sum_early],$arr4[sum_lately],$arr4[sum_worktime],$arr4[sum_lesstime],$arr4[sum_overtime],"");
$content_data .= print_content("","","","","","","","","",$label,$sum_early,$sum_lately,$sum_worktime,$sum_lesstime,$sum_overtime,"");                           
                            $smarty->assign ("DATA_TB4", $data_tb4);  
                                  
				$file= $DIR_HOME."/files/rekap_absen_harian_".$nm_perwakilan."_".$tahun.".xls";
				$fp=@fopen($file,"w");
				if(!is_resource($fp))
				return false;
				//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
				stream_set_write_buffer($fp, 0);
                             
				$content = print_header($nm_perwakilan,$bulan,$tahun);
				$content .= $content_data;
				
				$content .= print_footer();
				fwrite($fp,$content);
				fclose($fp);
				$file_2= $HREF_HOME."/files/rekap_absen_harian_".$nm_perwakilan."_".$tahun.".xls";
                                
}

}
else
 
{
				
            $sql__="SELECT *,UPPER(r_cabang__nama) AS nm_perwakilan FROM r_cabang WHERE  r_cabang.r_cabang__id='$kode_cabang_cari' ";
            $rs__=$db->Execute($sql__);
            $nm_perwakilan = $rs__->fields['nm_perwakilan'];
            $smarty->assign ("NM_PERWAKILAN", $nm_perwakilan);
            
			if($jenis_user=='2'){
                            
                           

                                                
                                                $sql = "SELECT
                                                    r_shift__ket AS r_shift__ket,
                                                        r_shift__jam_masuk AS r_shift__jam_masuk,
                                                        r_shift__jam_pulang AS r_shift__jam_pulang,
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
                                                        t_abs__id AS t_abs__id,
                                                        t_abs__fingerprint AS t_abs__fingerprint,
                                                        t_abs__tgl AS t_abs__tgl,
                                                        t_abs__id_shift AS t_abs__id_shift,
                                                        t_abs__jam_masuk AS t_abs__jam_masuk,
                                                        t_abs__jam_keluar AS t_abs__jam_keluar,
                                                        t_abs__early AS t_abs__early,
                                                        t_abs__lately AS t_abs__lately,
                                                        t_abs__approval AS t_abs__approval,
                                                        t_abs__lesstime AS t_abs__lesstime,
                                                        t_abs__overtime AS t_abs__overtime,
                                                        t_abs__worktime AS t_abs__worktime

                                                        FROM
                                                        r_pegawai
                                                        INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                                        INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                                        INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                                        INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                                        INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                                        INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                                        INNER JOIN t_absensi ON t_absensi.t_abs__fingerprint=r_penempatan.r_pnpt__finger_print
                                                        INNER JOIN r_shift ON r_shift.r_shift__id=t_absensi.t_abs__id_shift where 1=1  AND r_cabang__id='".$kode_pw_ses."' ";
                                            

			} else {
						$sql  = "SELECT
                                                    r_shift__ket AS r_shift__ket,
                                                        r_shift__jam_masuk AS r_shift__jam_masuk,
                                                        r_shift__jam_pulang AS r_shift__jam_pulang,
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
                                                        t_abs__id AS t_abs__id,
                                                        t_abs__fingerprint AS t_abs__fingerprint,
                                                        t_abs__tgl AS t_abs__tgl,
                                                        t_abs__id_shift AS t_abs__id_shift,
                                                        t_abs__jam_masuk AS t_abs__jam_masuk,
                                                        t_abs__jam_keluar AS t_abs__jam_keluar,
                                                        t_abs__early AS t_abs__early,
                                                        t_abs__lately AS t_abs__lately,
                                                        t_abs__approval AS t_abs__approval,
                                                        t_abs__lesstime AS t_abs__lesstime,
                                                        t_abs__overtime AS t_abs__overtime,
                                                        t_abs__worktime AS t_abs__worktime

                                                        FROM
                                                        r_pegawai
                                                        INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                                        INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                                        INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                                        INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                                        INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                                        INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                                        INNER JOIN t_absensi ON t_absensi.t_abs__fingerprint=r_penempatan.r_pnpt__finger_print
                                                        INNER JOIN r_shift ON r_shift.r_shift__id=t_absensi.t_abs__id_shift where 1=1";	

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

						 
                                                  if ($bulan !='') {
						 	$sql.=" and MONTH(t_abs__tgl)='$bulan'  ";
						 }
                                                 
                                                  if ($tahun !='') {
						 	$sql.=" AND YEAR(t_abs__tgl)=$tahun  ";
						 }
                                                 
                                                  if ($nama_karyawan_cari !='') {
						 	$sql.="and r_pegawai__nama LIKE '%".$nama_karyawan_cari."%'  ";
						 }
		
 
			 	$sql.=" ORDER BY t_abs__tgl asc ";
 
			//	if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
                      
                                $numresults=$db->Execute($sql);
                          
				$count = $numresults->RecordCount();

//				$pages = $p->findPages($count,$LIMIT); 
//				$sql  .= "LIMIT ".$start.", ".$LIMIT;
//				
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
				
					
			   
			       $content_data .= print_content(
                                    $count_no,
                                    $arr[r_pnpt__finger_print],
                                    $arr[r_pegawai__nama],
                                    $arr[r_subcab__nama],
                                    $arr[r_dept__ket],
                                    $arr[r_shift__jam_masuk],
                                    $arr[r_shift__jam_pulang],
                                    $arr[t_abs__tgl],
                                    $arr[t_abs__jam_masuk],
                                    $arr[t_abs__jam_keluar],
                                    $arr[t_abs__early],
                                    $arr[t_abs__lately],
                                    $arr[t_abs__worktime],
                                    $arr[t_abs__lesstime],
                                    $arr[t_abs__overtime],
                                    $arr[r_shift__ket]
                                   );			
                           
                           
                           
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
			//	$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 
                                $smarty->assign ("DATA_TB", $data_tb);
                                
                                 //total karyawan
                          $sql_total="SELECT COUNT(t_abs__tgl) As sum_tgl,
                                        SEC_TO_TIME( sum(t_abs__jam_masuk)) as sum_masuk,
                                        SEC_TO_TIME( sum(t_abs__jam_keluar)) as sum_keluar,
                                        SEC_TO_TIME(sum(TIME_TO_SEC(t_abs__early))) as sum_early,
                                        SEC_TO_TIME(sum(TIME_TO_SEC(t_abs__lately))) as sum_lately,
                                        SEC_TO_TIME(sum(TIME_TO_SEC(t_abs__worktime))) as sum_worktime,
                                        SEC_TO_TIME(sum(TIME_TO_SEC(t_abs__lesstime))) as sum_lesstime,
                                        SEC_TO_TIME(sum(TIME_TO_SEC(t_abs__overtime))) as sum_overtime

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
                                  INNER JOIN t_absensi
                                    ON t_absensi.t_abs__fingerprint = r_penempatan.r_pnpt__finger_print
                                  INNER JOIN r_shift
                                    ON r_shift.r_shift__id = t_absensi.t_abs__id_shift where 1=1 ";
                             if ($kode_cabang_cari !='') {
                                       $sql_total.=" and  r_cabang__id =".$kode_cabang_cari."  ";
                                }

                                if ($kode_subcab_cari !='') {
                                       $sql_total.=" and  r_subcab__id ='$kode_subcab_cari' ";
                                }

                               if ($departemen_cari !=''  ) {
                                       $sql_total.="  and r_dept__id='$departemen_cari' ";
                                } 
                               if ($nama_karyawan_cari !='') {
                                        $sql_total.="and r_pegawai__nama LIKE '%".$nama_karyawan_cari."%'  ";
						 }

                                   $rs_sum=$db->Execute($sql_total);
                                   $sum_early =$rs_sum->fields['sum_early'];
                                   $sum_lately =$rs_sum->fields['sum_lately'];
                                   $sum_worktime =$rs_sum->fields['sum_worktime'];
                                   $sum_overtime= $rs_sum->fields['sum_overtime'];
                                   $sum_lesstime= $rs_sum->fields['sum_lesstime'];
            
           
                            $label="TOTAL JAM :";
                            $content_data .= print_content("","","","","","","","","",$label,$sum_early,$sum_lately,$sum_worktime,$sum_lesstime,$sum_overtime,"");
                             $smarty->assign ("DATA_LABEL", $label);   
                             $smarty->assign ("DATA_EARLY", $sum_early);   
                             $smarty->assign ("DATA_LATELY", $sum_worktime);   
                             $smarty->assign ("DATA_WORKTIME", $sum_lesstime);   
                             $smarty->assign ("DATA_LESSTIME", $sum_lesstime);   
                            $smarty->assign ("DATA_OVERTIME", $sum_overtime);
                            $smarty->assign ("DATA_TB4", $data_tb4);   
                          
                          
                          
                               //TUTUP TOTAL   
				$file= $DIR_HOME."/files/rekap_absen_harian_".$nm_perwakilan."_".$tahun.".xls";
				$fp=@fopen($file,"w");
				if(!is_resource($fp))
				return false;
				//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
				stream_set_write_buffer($fp, 0);
				$content = print_header($nm_perwakilan,$bulan,$tahun);
				$content .= $content_data;
				
				$content .= print_footer();
				fwrite($fp,$content);
				fclose($fp);
				$file_2= $HREF_HOME."/files/rekap_absen_harian_".$nm_perwakilan."_".$tahun.".xls";
                                
}



($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;
$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_URUT", $count_no); 
$smarty->assign ("SEARCH_YEAR", $Search_Year);
$smarty->assign ("FILES", $file_2);
$smarty->assign ("TITLE", _PRINT_TITLE_JL_01_MAIN);
$smarty->assign ("HEAD_TITLE", _PRINT_HEAD_TITLE_JL_01_MAIN);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("TB_NO_KABUPATEN", _NO_KABUPATEN);
$smarty->assign ("TB_NO_RUAS", _NO_RUAS);
$smarty->assign ("TB_NAMA_RUAS", _NAMA_RUAS);
$smarty->assign ("TB_TITIK_PENGENAL_PANGKAL", _TITIK_PENGENAL_PANGKAL);
$smarty->assign ("TB_TITIK_PENGENAL_UJUNG", _TITIK_PENGENAL_UJUNG);
$smarty->assign ("TB_NAMA_KECAMATAN", _NAMA_KECAMATAN);
$smarty->assign ("TB_PANJANG_RUAS", _PANJANG_RUAS);
$smarty->assign ("TB_LEBAR_RATA_RATA", _LEBAR_RATA_RATA);
$smarty->assign ("TB_PANJANG_PERMUKAAN", _PANJANG_PERMUKAAN);
/*** remark 17-08-2010 
$smarty->assign ("TB_ASPAL", _ASPAL);
$smarty->assign ("TB_PM", _PENETRASI_MACADAM);
$smarty->assign ("TB_TELFORD", _TELFORD);
$smarty->assign ("TB_TANAH", _TANAH);
$smarty->assign ("TB_BLM_TEMBUS", _BELUM_TEMBUS);
***/
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