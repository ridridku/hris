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
$tahun_ses_aktif		=$_SESSION['SESSION_TAHUN_AKTIF'];
$bulan_ses_aktif		=$_SESSION['SESSION_BULAN_AKTIF'];
$smarty->assign ("TAHUN_SES", $tahun_ses_aktif);
$smarty->assign ("BULAN_SES", $bulan_ses_aktif);
 

$smarty->assign ("JENIS_USER_SES", $jenis_user);
$smarty->assign ("KODE_PW_SES", $kode_pw_ses);

//echo "JENIS USER".$_SESSION['SESSION_JNS_USER'];
//echo "<br>KODE PERWAKILAN".$_SESSION['SESSION_KODE_PERWAKILAN'];

#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);

$smarty->assign ("HREF_HOME_PATH_AJAX", $HREF_HOME.'/modules/kehadiran/surat_cuti');
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kehadiran/surat_cuti/';
#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kehadiran');
$FILE_JS  = $JS_MODUL.'/surat_cuti';

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
$tbl_name	= "t_cuti";

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

if ($_GET['nama_pegawai_cari']) $nama_pegawai_cari = $_GET['nama_pegawai_cari'];
else if ($_POST['nama_pegawai_cari']) $nama_pegawai_cari = $_POST['nama_pegawai_cari'];
else $nama_pegawai_cari="";

if ($_GET['departemen_cari']) $departemen_cari = $_GET['departemen_cari'];
else if ($_POST['departemen_cari']) $departemen_cari= $_POST['departemen_cari'];
else $departemen_cari="";

if ($_GET['bulan']) $bulan = $_GET['bulan'];
else if ($_POST['bulan']) $bulan = $_POST['bulan'];
else $bulan="";

if ($_GET['tahun']) $tahun = $_GET['tahun'];
else if ($_POST['tahun']) $tahun = $_POST['tahun'];
else $tahun="";

if ($_GET['finger_cari']) $finger_cari =$_GET['finger_cari'];
else if ($_POST['finger_cari']) $finger_cari= $_POST['finger_cari'];
else $finger_cari="";


$smarty->assign ("KODE_PERWAKILAN_CARI", $kode_perwakilan_cari);
$smarty->assign ("NO_PASPOR_CARI", $no_paspor_cari);
$smarty->assign ("NAMA_WNI_CARI", $nama_wni_cari);
$smarty->assign ("KODE_SUMBER", $kode_sumber);
$smarty->assign ("KODE_SUBCAB_CARI", $kode_subcab_cari);



$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_perwakilan_cari=".$kode_subcab_cari."&kode_subcab_cari=".$kode_subcab_cari;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;


$current_month=date("m");
$current_year=date("Y");
$sub_current_month= substr($current_month, -2);
$sub_current_year = substr($current_year, -2);

//echo $current_year; die;

$array1=explode("-",$current_year);
$tahun_masuk    =   $array1[0];
$bulan_masuk    =   $array1[1];
$tgl_masuk      =   $array1[2];

$tahun_pinjam= substr($tahun_masuk,2,4);

$sql_cek_no="SELECT count(A.t_cuti__no) as no_cuti FROM t_cuti A";
//var_dump($sql_cek_no)or die();
$rs_val = $db->Execute($sql_cek_no);

$no_pel= $rs_val->fields[no_cuti];

$idMax = $no_pel;
$idMax++;
$newID =sprintf("%04s", $idMax);
//var_dump($newID) or die();
$smarty->assign ("ID_PELATIHAN", $sub_current_year.''.$sub_current_month.''.$newID);




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

//------SHOW DATA PROVINSI------//
$sql_propinsi = "SELECT r_provinsi__id,r_provinsi__nama FROM r_provinsi ";
$result_propinsi = $db->Execute($sql_propinsi);
$initSet = array();
$data_propinsi = array();
$z=0;
while ($arr=$result_propinsi->FetchRow()) {
	array_push($data_propinsi, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PROPINSI_KTP", $data_propinsi);



$sql_propinsi_alm = "SELECT r_provinsi__id,r_provinsi__nama FROM r_provinsi ";
$result_propinsi_alm = $db->Execute($sql_propinsi_alm);
$initSet = array();
$data_propinsi_alm = array();
$z=0;
while ($arr=$result_propinsi_alm->FetchRow()) {
	array_push($data_propinsi_alm, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PROPINSI_ALM", $data_propinsi_alm);


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
//------------closer AJAX SUBDEP----------------------------------------//



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

	$sql_ = "SELECT                     
            A.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
            A.r_pnpt__id_pegawai AS r_pnpt__id_pegawai,
            A.r_pnpt__nip AS r_pnpt__nip,
            A.r_pnpt__status AS r_pnpt__status,
            A.r_pnpt__tipe_salary AS r_pnpt__tipe_salary,
            A.r_pnpt__subdept AS r_pnpt__subdept,
            A.r_pnpt__jabatan AS r_pnpt__jabatan,
            A.r_pnpt__finger_print AS r_pnpt__finger_print,
            A.r_pnpt__gapok AS r_pnpt__gapok,
            A.r_pnpt__subcab AS r_pnpt__subcab,
            A.r_pnpt__shift AS r_pnpt__shift,
            A.r_pnpt__kon_awal AS r_pnpt__kon_awal,
            A.r_pnpt__kon_akhir AS r_pnpt__kon_akhir,
            A.r_pnpt__aktif AS r_pnpt__aktif,
            B.r_pegawai__id AS r_pegawai__id,
            B.r_pegawai__nama AS r_pegawai__nama,
            C.r_subdept__id AS 	r_subdept__id,
            C.r_subdept__ket AS	r_subdept__ket,
            C.r_subdept__dept AS r_subdept__dept,
            D.r_dept__id AS r_dept__id,
            D.r_dept__akronim AS r_dept__akronim,
            D.r_dept__ket AS r_dept__ket,
            D.r_dept__cc AS r_dept__cc,
            E.r_subcab__id AS r_subcab__id,
            E.r_subcab__nama AS	r_subcab__nama,
            E.r_subcab__cabang AS r_subcab__cabang,
            E.r_subcab__alamat AS r_subcab__alamat,
            E.r_subcab__tlp AS	r_subcab__tlp,
            E.r_subcab__headdept AS r_subcab__headdept,
            E.r_subcab__status_adm AS r_subcab__status_adm,
            E.r_subcab__umr AS	r_subcab__umr,
            E.r_subcab__parent AS r_subcab__parent, F.r_cabang__id  AS r_cabang__id,
            F.r_cabang__akronim AS r_cabang__akronim,
            F.r_cabang__nama AS	r_cabang__nama,
            F.r_cabang__kelas AS r_cabang__kelas,
            G.r_jabatan__id AS	r_jabatan__id,
            G.r_jabatan__ket AS	r_jabatan__ket,
            H.r_stp__id AS r_stp__id,
            H.r_stp__nama AS r_stp__nama,
            K.t_cuti__no AS t_cuti__no,
            K.t_cuti__nip AS t_cuti__nip,
            K.t_cuti__atasan_nama AS t_cuti__atasan_nama ,
            K.t_cuti__atasan_nip AS t_cuti__atasan_nip,
            K.t_cuti__tgl AS t_cuti__tgl,
            K.t_cuti__lama_hari AS t_cuti__lama_hari,
            K.t_cuti__jenis_cuti AS t_cuti__jenis_cuti,
            K.t_cuti__alasan AS t_cuti__alasan,
            K.t_cuti__approval AS t_cuti__approval,
            K.t_cuti__date_created AS t_cuti__date_created,
            K.t_cuti__date_updated AS t_cuti__date_updated,
            K.t_cuti__user_created AS t_cuti__user_created ,
            K.t_cuti__user_updated AS t_cuti__user_updated

            FROM r_penempatan A,r_pegawai B,r_subdepartement C,r_departement D,r_subcabang E,r_cabang F,r_jabatan G,r_status_pegawai H
            ,t_cuti K
            where A.r_pnpt__id_pegawai=B.r_pegawai__id
            AND A.r_pnpt__subdept=C.r_subdept__id AND D.r_dept__id=C.r_subdept__dept
            AND A.r_pnpt__subcab=E.r_subcab__id AND E.r_subcab__cabang=F.r_cabang__id
            AND A.r_pnpt__jabatan=G.r_jabatan__id AND A.r_pnpt__status=H.r_stp__id
            AND K.t_cuti__nip=A.r_pnpt__no_mutasi AND A.r_pnpt__aktif=1 AND t_cuti__no='".$_GET['id']."' ";
     // var_dump($sql_)or die();
$resultSet = $db->Execute($sql_);
$edit_t_cuti__no = $resultSet->fields[t_cuti__no];
$edit_t_cuti__cabang=$resultSet->fields[r_cabang__id];
$edit_t_cuti__pegawai_nama = $resultSet->fields[r_pegawai__nama];
$edit_t_cuti__pegawai_nip = $resultSet->fields[t_cuti__nip];
$edit_t_cuti__atasan_nama= $resultSet->fields[t_cuti__atasan_nama];
$edit_t_cuti__atasan_nip = $resultSet->fields[t_cuti__atasan_nip];
$edit_t_cuti__tgl = $resultSet->fields[t_cuti__tgl];
//$edit_t_cuti__tgl_akhir= $resultSet->fields[t_cuti__tgl_akhir];
$edit_t_cuti__lama_hari= $resultSet->fields[t_cuti__lama_hari];
$edit_t_cuti__jenis_cuti= $resultSet->fields[t_cuti__jenis_cuti];
$edit_t_cuti__alasan= $resultSet->fields[t_cuti__alasan];
$edit_t_cuti__approval = $resultSet->fields[t_cuti__approval];
$edit_t_cuti__date_created = $resultSet->fields[t_cuti__date_created];
$edit_t_cuti__date_updated = $resultSet->fields[t_cuti__date_updated];
$edit_t_cuti__user_created = $resultSet->fields[t_cuti__user_created];
$edit_t_cuti__user_updated = $resultSet->fields[t_cuti__user_updated];
$edit = 1;

}

//----------------CLOSE EDIT---------------------//

$smarty->assign ("OPT", $opt);
$smarty->assign ("EDIT_ID",$edit_id);

$smarty->assign ("EDIT_T_CUTI__CABANG",$edit_t_cuti__cabang); 
$smarty->assign ("EDIT_T_CUTI__NO",$edit_t_cuti__no); 
$smarty->assign ("EDIT_T_LEMBUR__PEGAWAI_NAMA",$edit_t_cuti__pegawai_nama);
$smarty->assign ("EDIT_T_LEMBUR__PEGAWAI_NIP",$edit_t_cuti__pegawai_nip); 
$smarty->assign ("EDIT_T_CUTI__ATASAN_NAMA",$edit_t_cuti__atasan_nama);
$smarty->assign ("EDIT_T_CUTI__ATASAN_NIP",$edit_t_cuti__atasan_nip);
$smarty->assign ("EDIT_T_CUTI__TGL",$edit_t_cuti__tgl);  
$smarty->assign ("EDIT_T_CUTI__LAMA",$edit_t_cuti__lama_hari); 
$smarty->assign ("EDIT_T_CUTI__JENIS",$edit_t_cuti__jenis_cuti);  
$smarty->assign ("EDIT_T_CUTI__ALASAN",$edit_t_cuti__alasan);
$smarty->assign ("EDIT_T_CUTI__APPROVAL",$edit_t_cuti__approval);
$smarty->assign ("EDIT_T_CUTI__DATE_CREATED",$edit_t_cuti__date_created);
$smarty->assign ("EDIT_T_CUTI__DATE_UPDATED",$edit_t_cuti__date_updated);
$smarty->assign ("EDIT_T_CUTI__USER_CREATED",$edit_t_cuti__user_created);
$smarty->assign ("EDIT_T_CUTI__USER_UPDATED",$edit_t_cuti__user_updated);
$smarty->assign ("EDIT_VAL", $edit);

//-----------------------CLOSE VIEW EDIT----------------------------------------------------------------------------------//
//-----------------------------------------VIEW INDEX---------------------------------------------------------------------//
if ($_GET['search'] == '1')
    {
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
 
		  if($jenis_user=='2'){

                                    $sql  = "SELECT
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
                                            t_cuti__tgl AS t_cuti__tgl ,
                                            SUM(t_cuti__lama_hari) AS t_cuti__lama_hari,
                                            t_cuti__jenis_cuti AS t_cuti__jenis_cuti,
                                            t_cuti__alasan AS t_cuti__alasan,
                                            t_cuti__approval AS t_cuti__approval
                                    FROM
                                            v_pegawai peg
                                    INNER JOIN t_cuti ON t_cuti.t_cuti__nip=peg.r_pnpt__no_mutasi AND peg.r_pnpt__aktif=1 AND peg.r_cabang__id= '".$kode_pw_ses."' ";



            } else {
                                    $sql  = "SELECT
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
                                            t_cuti__tgl AS t_cuti__tgl ,
                                            SUM(t_cuti__lama_hari) AS t_cuti__lama_hari,
                                            t_cuti__jenis_cuti AS t_cuti__jenis_cuti,
                                            t_cuti__alasan AS t_cuti__alasan,
                                            t_cuti__approval AS t_cuti__approval
                                    FROM
                                            v_pegawai peg
                                    INNER JOIN t_cuti ON t_cuti.t_cuti__nip=peg.r_pnpt__no_mutasi AND peg.r_pnpt__aktif=1 ";	

            }
 
				//echo "<br><br><br><br><br><br><br><br><br><br>dddddddddkode_perwakilan_cari ===".$kode_perwakilan_cari;


				 
				if($kode_cabang_cari !=''){
					$sql .= "AND r_cabang__id = '".$kode_cabang_cari."' ";
				}
				if($kode_subcab_cari !=''){
					$sql .= "AND r_subcab__id = '".$kode_subcab_cari."' "; 
				}

				if( $departemen_cari!=''){
					$sql .= "AND r_dept__id = '".$departemen_cari."' ";
				} 
                                if($nama_pegawai_cari!=''){
					
                                        $sql .= "AND r_pegawai__nama LIKE '%".addslashes($nama_pegawai_cari)."%'";
				} 
                                if ($bulan !='') {
                                       $sql.=" AND MONTH(t_cuti__tgl)='$bulan'";
                                }

                                 if ($tahun !='') {
                                       $sql.=" AND YEAR(t_cuti__tgl)='$tahun'";
                                }
                                
                                 if ($finger_cari !='') {
                                       $sql.=" AND r_pnpt__finger_print='$finger_cari'";
                                }
                                
			 	$sql .= " GROUP BY t_cuti__no ORDER BY  trim(r_pegawai__nama) asc ";

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
				$count_all  = $start+$end;
				$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 
}

}
else
    
{
				

			if($jenis_user=='2'){

                                                
                            $sql = "SELECT
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
                                            t_cuti__tgl AS t_cuti__tgl ,
                                            SUM(t_cuti__lama_hari) AS t_cuti__lama_hari,
                                            t_cuti__jenis_cuti AS t_cuti__jenis_cuti,
                                            t_cuti__alasan AS t_cuti__alasan,
                                            t_cuti__approval AS t_cuti__approval
                                    FROM
                                            v_pegawai peg
                                    INNER JOIN t_cuti ON t_cuti.t_cuti__nip=peg.r_pnpt__no_mutasi AND peg.r_pnpt__aktif=1 AND peg.r_cabang__id = '".$kode_pw_ses."' ";


			} else {
						$sql  = "SELECT
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
                                            t_cuti__tgl AS t_cuti__tgl ,
                                        
                                            SUM(t_cuti__lama_hari) AS t_cuti__lama_hari,
                                            t_cuti__jenis_cuti AS t_cuti__jenis_cuti,
                                            t_cuti__alasan AS t_cuti__alasan,
                                            t_cuti__approval AS t_cuti__approval
                                    FROM
                                            v_pegawai peg
                                    INNER JOIN t_cuti ON t_cuti.t_cuti__nip=peg.r_pnpt__no_mutasi AND peg.r_pnpt__aktif=1 ";	

			}

				
 				

				if($kode_cabang_cari !=''){
					$sql .= " AND r_cabang__id = '".$kode_cabang_cari."' ";
				}
				if($kode_subcab_cari !=''){
					$sql .= " AND r_pnpt__subcab = '".$kode_subcab_cari."' "; 
				}
                                if( $departemen_cari!=''){
					$sql .= "AND r_dept__id = '".$departemen_cari."' ";
				} 
                                if($nama_pegawai_cari!=''){
					
                                           $sql .= "AND r_pegawai__nama LIKE '%".addslashes($nama_pegawai_cari)."%'";
				} 
                                if ($bulan !='') {
                                       $sql.=" AND MONTH(t_cuti__tgl_awal)='$bulan'";
                                }

                                 if ($tahun !='') {
                                       $sql.=" AND YEAR(t_cuti__tgl_awal)='$tahun'";
                                }
                                 if ($finger_cari !='') {
                                       $sql.=" AND r_pnpt__finger_print='$finger_cari'";
                                }

				$sql .= " GROUP BY t_cuti__no ORDER BY  trim(r_pegawai__nama) asc ";
                         
 
				if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);


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
				$count_all  = $start+$end;
				$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 
}
//---------------------------------CLOSE VIEW INDEX---------------------------------------------------------------------//

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