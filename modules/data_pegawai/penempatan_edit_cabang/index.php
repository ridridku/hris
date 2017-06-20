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
 

$smarty->assign ("JENIS_USER_SES", $jenis_user);
$smarty->assign ("KODE_PW_SES", $kode_pw_ses);
//var_dump($jenis_user)or die();

//echo "JENIS USER".$_SESSION['SESSION_JNS_USER'];
//echo "<br>KODE PERWAKILAN".$_SESSION['SESSION_KODE_PERWAKILAN'];

#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);

$smarty->assign ("HREF_HOME_PATH_AJAX", $HREF_HOME.'/modules/data_pegawai/penempatan');
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_pegawai/penempatan/';
#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_pegawai');
$FILE_JS  = $JS_MODUL.'/penempatan';


if($_POST['mod_id'])
    
{
		$mod_id = $_POST['mod_id'];
                  
}else
{
		$mod_id =  $_GET['mod_id'];
}
//var_dump($mod_id) or die();

$user_id = base64_decode($_SESSION['UID']);

$smarty->assign ("MOD_ID", $mod_id);

#Initiate TABLE
$tbl_name	= "r_penempatan";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//


if ($_POST['limit2']) { $LIMIT =$_POST['limit2']; }
else if ($_GET['limit2']) {$LIMIT = $_GET['limit2']; }
else $LIMIT=$nLimit;

//if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
//else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
//else $SORT="ASC";

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

if ($_GET['level_cari']) $level_cari = $_GET['level_cari'];
else if ($_POST['level_cari']) $level_cari= $_POST['level_cari'];
else $level_cari="";

if ($_GET['r_pnpt__nip_cari']) $r_pnpt__nip_cari = $_GET['r_pnpt__nip_cari'];
else if ($_POST['r_pnpt__nip_cari']) $r_pnpt__nip_cari= $_POST['r_pnpt__nip_cari'];
else $r_pnpt__nip_cari="";

if ($_GET['finger_pegawai_cari']) $finger_pegawai_cari = $_GET['finger_pegawai_cari'];
else if ($_POST['finger_pegawai_cari']) $finger_pegawai_cari = $_POST['finger_pegawai_cari'];
else $finger_pegawai_cari="";

if ($_GET['sts_pegawai']) $sts_pegawai_cari = $_GET['sts_pegawai'];
else if ($_POST['sts_pegawai']) $sts_pegawai_cari = $_POST['sts_pegawai'];
else $sts_pegawai_cari="";

if ($_GET['tahun']) $tahun_cari = $_GET['tahun'];
else if ($_POST['tahun']) $tahun_cari = $_POST['tahun'];
else $tahun_cari="";

if ($_GET['bulan']) $bulan_cari = $_GET['bulan'];
else if ($_POST['bulan']) $bulan_cari = $_POST['bulan'];
else $bulan_cari="";


if ($_GET['cek_jabatan']) $cek_jabatan = $_GET['cek_jabatan'];
else if ($_POST['cek_jabatan']) $cek_jabatan = $_POST['cek_jabatan'];
else $cek_jabatan="";

$tahun_ses_aktif=$_SESSION['SESSION_TAHUN_AKTIF'];
$bulan_ses_aktif=$_SESSION['SESSION_BULAN_AKTIF'];
$smarty->assign ("TAHUN_SES", $tahun_ses_aktif);
$smarty->assign ("BULAN_SES", $bulan_ses_aktif);

$smarty->assign ("KODE_PERWAKILAN_CARI", $kode_perwakilan_cari);
$smarty->assign ("NO_PASPOR_CARI", $no_peg_cari);
$smarty->assign ("NAMA_WNI_CARI", $nama_wni_cari);
$smarty->assign ("KODE_SUMBER", $kode_sumber);
$smarty->assign ("R_PNPT__NIP_CARI",$r_pnpt__nip_cari);
$smarty->assign ("FINGER_PRINT_CARI",$finger_pegawai_cari);



$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."kode_cabang_cari=".$kode_cabang_cari."&kode_subcab_cari=".$kode_subcab_cari."&r_pnpt__nip_cari=".$r_pnpt__nip_cari;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&kode_cabang_cari=".$kode_cabang_cari."&kode_subcab_cari=".$kode_subcab_cari."&r_pnpt__nip_cari=".$r_pnpt__nip_cari;;

//echo "<br><br><br><br><br><br><br><br><br><br>kode_perwakilan_cari".$kode_perwakilan_cari;
//-----------SHOW DATA STATUS KARYAWAN-----------//
if($jenis_user==1)
{
    $sql_status= "Select r_status_pegawai.r_stp__id,r_status_pegawai.r_stp__nama FROM r_status_pegawai";
}
else
{
    $sql_status= "Select r_status_pegawai.r_stp__id,r_status_pegawai.r_stp__nama FROM r_status_pegawai where r_stp__id!=4";
}
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


//----------------NO_OTOMATIS------------//
$sql_cek_no="SELECT count(A.r_pnpt__no_mutasi) as no_mutasi FROM r_penempatan A";
//var_dump($sql_cek_no) or die();
$rs_val = $db->Execute($sql_cek_no);

$no_mutasi_new= $rs_val->fields[no_mutasi];

$id_mutasi= $no_mutasi_new;
$id_mutasi++;
//var_dump($id_mutasi)or die();
$id_mutasi_new =sprintf("%04s", $id_mutasi);
//var_dump($id_mutasi_new)or die();
$smarty->assign ("ID_MUTASI_NEW", $id_mutasi_new);
//------------------NO_OTOMATIS----------//



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

$sql_subcab_cari = "SELECT subcab.r_subcab__nama,subcab.r_subcab__id FROM r_cabang cab,r_subcabang subcab
               where cab.r_cabang__id=subcab.r_subcab__cabang and cab.r_cabang__id='$kode_pw_ses' order by subcab.r_subcab__id";
//var_dump($sql_subcab)or die();
$result_subcab_cari = $db->Execute($sql_subcab_cari);
        $initSet = array();
        $data_subcab_cari = array();
        $z=0;
        while ($arr=$result_subcab_cari->FetchRow()) {
                array_push($data_subcab_cari, $arr);
                array_push($initSet, $z);
                $z++;
                        }
$smarty->assign ("DATA_SUBCABANG_CARI", $data_subcab_cari);

//-----------------------DATA AJAX SUBCAB---------//

if ($_GET[get_subcab] == 1)
{
	$subcabang = $_GET[no_subcab];
	if($subcabang!=''){
					$sql_kabupaten = "SELECT cab.r_cabang__id ,cab.r_cabang__nama,subcab.r_subcab__nama,subcab.r_subcab__id as subcab FROM r_cabang cab,r_subcabang subcab
                                                          where cab.r_cabang__id=subcab.r_subcab__cabang AND cab.r_cabang__id='$subcabang' ORDER BY cab.r_cabang__nama ASC";
                                      
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
			if($subcabang!='')
                            {
					$sql_kabupaten = "SELECT cab.r_cabang__id ,cab.r_cabang__nama,subcab.r_subcab__nama,subcab.r_subcab__id as subcab FROM r_cabang cab,r_subcabang subcab
                                                          where cab.r_cabang__id=subcab.r_subcab__cabang AND cab.r_cabang__id='$subcabang' ORDER BY cab.r_cabang__nama ASC";
                                        
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

//-----------DATA STATUS PEGAWAI-----------------------//
$sql_sts = "SELECT * FROM r_status_pegawai";
$result_sts = $db->Execute($sql_sts);
$initSet = array();
$data_sts = array();
$z=0;
while ($arr=$result_sts->FetchRow()) {
	array_push($data_sts, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_STS", $data_sts);
//-----------DATA STATUS PEGAWAI-----------------------//

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
        if($subdep!=''){
                        $sql_kabupaten = " SELECT dep.r_dept__id,dep.r_dept__akronim,dep.r_dept__ket,subdep.r_subdept__ket,subdep.r_subdept__id FROM r_departement dep LEFT JOIN r_subdepartement subdep ON subdep.r_subdept__dept=dep.r_dept__id  "
                                . "where dep.r_dept__id=".$subdep." ORDER BY dep.r_dept__ket ASC";
                        //var_dump($sql_kabupaten)or die();
                        $recordSet_kabupaten = $db->Execute($sql_kabupaten);

                        $input_kab="<select name=kode_subdep onchange=\"cari_jabatan(this.value)\">";
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



//------------open AJAX jabatan----------------------------------------//

if ($_GET[get_jab_cari] == 1)
{  
  
    	$subdep = $_GET[subdep];
        if($subdep!=''){
    if($kode_pw_ses==2)
    {
        
            $sql_kabupaten = " SELECT r_jabatan.r_jabatan__id,r_jabatan.r_jabatan__ket,r_jabatan.r_jabatan__level,
                            r_jabatan.r_jabatan__sub_departemen,r_jabatan.r_jabatan__departemen,r_jabatan.r_jabatan__kategori_cabang,
                            r_subdepartement.r_subdept__ket from r_jabatan
                            inner join r_subdepartement on r_subdepartement.r_subdept__id=r_jabatan.r_jabatan__sub_departemen
                            WHERE r_subdepartement.r_subdept__id=".$subdep."  and r_jabatan.r_jabatan__kategori_cabang=".$kode_pw_ses." ORDER BY r_jabatan__id ASC ";
    }else{      
            $sql_kabupaten = " SELECT r_jabatan.r_jabatan__id,r_jabatan.r_jabatan__ket,r_jabatan.r_jabatan__level,
                            r_jabatan.r_jabatan__sub_departemen,r_jabatan.r_jabatan__departemen,r_jabatan.r_jabatan__kategori_cabang,
                            r_subdepartement.r_subdept__ket from r_jabatan
                            inner join r_subdepartement on r_subdepartement.r_subdept__id=r_jabatan.r_jabatan__sub_departemen
                            WHERE r_subdepartement.r_subdept__id=".$subdep."  ORDER BY r_jabatan__id ASC ";
    }               
                        $recordSet_kabupaten = $db->Execute($sql_kabupaten);

                        $input_kab="<select name=r_jabatan >";
                        $input_kab.="<option value=''> ";
                        $input_kab.="</option> ";
                        while(!$recordSet_kabupaten->EOF):
                                $input_kab.="<option value=";
                                $input_kab.= $recordSet_kabupaten->fields[r_jabatan__id].">".$recordSet_kabupaten->fields['r_jabatan__ket'];
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
//------------Close AJAX jabatan----------------------------------------//


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
            r_penempatan.r_pnpt__pdrm AS r_pnpt__pdrm,
            r_penempatan.r_pnpt__areakerja AS r_pnpt__areakerja,
            r_penempatan.r_pnpt__tgl_efektif AS r_pnpt__tgl_efektif,
            r_penempatan.r_pnpt__date_created AS r_pnpt__date_created,
            r_penempatan.r_pnpt__date_updated AS r_pnpt__user_created,
            r_penempatan.r_pnpt__user_created AS r_pnpt__user_created,
            r_penempatan.r_pnpt__user_updated AS r_pnpt__user_updated,
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
            r_pegawai.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
            r_status_pegawai.r_stp__id AS r_stp__id,
            r_status_pegawai.r_stp__nama AS r_stp__nama,
            r_tipe_penempatan.tipe_penempatan__id,
            r_tipe_penempatan.tipe_penempatan AS tipe_penempatan,
            r_tipe_penempatan.tipe_penempatan__pdrm AS tipe_penempatan__pdrm
            

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
            INNER JOIN r_status_pegawai
              ON r_status_pegawai.r_stp__id = r_penempatan.r_pnpt__status
            INNER JOIN r_tipe_penempatan 
            ON r_penempatan.r_pnpt__pdrm= r_tipe_penempatan.tipe_penempatan__id
              AND r_penempatan.r_pnpt__aktif = '1' AND r_pnpt__no_mutasi='".$_GET['id']."' ";
       // var_dump($sql_)or die();
	$resultSet = $db->Execute($sql_);
        
        $edit_r_pnpt__no_mutasi     = $resultSet->fields[r_pnpt__no_mutasi];
        $edit_r_pnpt__id_pegawai   = $resultSet->fields[r_pnpt__id_pegawai];
        $edit_r_pnpt__nip           = $resultSet->fields[r_pnpt__nip];
        $edit_r_pnpt__status        = $resultSet->fields[r_pnpt__status];
        $edit_r_pnpt__tipe_salary   = $resultSet->fields[r_pnpt__tipe_salary];
        $edit_r_pnpt__subdept       = $resultSet->fields[r_pnpt__subdept];
        $edit_r_pnpt__jabatan       = $resultSet->fields[r_pnpt__jabatan];
        $edit_r_pnpt__finger_print  = $resultSet->fields[r_pnpt__finger_print];
        $edit_r_pnpt__gapok         = $resultSet->fields[r_pnpt__gapok];
        $edit_r_pnpt__subcab        = $resultSet->fields[r_pnpt__subcab];
       // var_dump($edit_r_pnpt__subcab) or die();
        $edit_r_pnpt__shift         = $resultSet->fields[r_pnpt__shift];
        $edit_r_pnpt__kon_awal      = $resultSet->fields[r_pnpt__kon_awal];
        $edit_r_pnpt__kon_akhir     = $resultSet->fields[r_pnpt__kon_akhir];
        $edit_r_pnpt__date_created  = $resultSet->fields[r_pnpt__date_created];
        $edit_r_pnpt__date_updated  = $resultSet->fields[r_pnpt__date_updated];
        $edit_r_pnpt__user_created  = $resultSet->fields[r_pnpt__user_created];
        $edit_r_pnpt__user_updated  = $resultSet->fields[r_pnpt__user_updated];
        $edit_r_pnpt__aktif         = $resultSet->fields[r_pnpt__aktif];
        $edit_r_pegawai__id         = $resultSet->fields[r_pegawai__id];
        $edit_r_pegawai__nama       = $resultSet->fields[r_pegawai__nama];
        $edit_r_pegawai__tgl_masuk  = $resultSet->fields[r_pegawai__tgl_masuk];
        $edit_r_cabang__nama        = $resultSet->fields[r_cabang__nama];
        $edit_r_jabatan__ket        = $resultSet->fields[r_jabatan__ket];
        $edit_r_dept__ket           = $resultSet->fields[r_dept__ket];
        $edit_r_cabang__id          = $resultSet->fields[r_cabang__id];
        $edit_r_subcab__id          = $resultSet->fields[r_subcab__id];
        $edit_r_dept__id            = $resultSet->fields[r_dept__id];
        $edit_r_subdept__id         = $resultSet->fields[r_subdept__id];
        $edit_r_pnpt__pdrm          = $resultSet->fields[r_pnpt__pdrm];
        $edit_tgl_sk                = $resultSet->fields[r_pnpt__tgl_efektif];
        $edit_r_pnpt__areakerja = $resultSet->fields[r_pnpt__areakerja];


   
        $edit = 1;
       

 //-----------------DATA SUBCABANG-------------------------//and cab.r_cabang__id='$kode_pw_ses' 
$sql_subcab = "SELECT subcab.r_subcab__nama,subcab.r_subcab__id FROM r_cabang cab,r_subcabang subcab
               where cab.r_cabang__id=subcab.r_subcab__cabang and cab.r_cabang__id='$edit_r_cabang__id' order by subcab.r_subcab__id";

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

}

//----------------CLOSE EDIT---------------------//

$smarty->assign("OPT", $opt);
$smarty->assign("EDIT_ID", $edit_id);
$smarty->assign("EDIT_R_PNPT__NO_MUTASI",$edit_r_pnpt__no_mutasi);
$smarty->assign("EDIT_R_PNPT__ID_PEGAWAI",$edit_r_pnpt__id_pegawai);
$smarty->assign("EDIT_R_PNPT__NIP",$edit_r_pnpt__nip);
$smarty->assign("EDIT_R_PNPT__STATUS",$edit_r_pnpt__status);
$smarty->assign("EDIT_R_PNPT__TIPE_SALARY",$edit_r_pnpt__tipe_salary);
$smarty->assign("EDIT_R_PNPT__SUBDEPT",$edit_r_pnpt__subdept);
$smarty->assign("EDIT_R_PNPT__JABATAN",$edit_r_pnpt__jabatan);
$smarty->assign("EDIT_R_PNPT__FINGER_PRINT",$edit_r_pnpt__finger_print);
$smarty->assign("EDIT_R_PNPT__GAPOK",$edit_r_pnpt__gapok);
$smarty->assign("EDIT_R_PNPT__SUBCAB",$edit_r_pnpt__subcab);
$smarty->assign("EDIT_R_PNPT__SHIFT",$edit_r_pnpt__shift);
$smarty->assign("EDIT_R_PNPT__KON_AWAL",$edit_r_pnpt__kon_awal);
$smarty->assign("EDIT_R_PNPT__KON_AKHIR",$edit_r_pnpt__kon_akhir);
$smarty->assign("EDIT_R_PNPT__DATE_CREATED",$edit_r_pnpt__date_created);
$smarty->assign("EDIT_R_PNPT__DATE_UPDATED",$edit_r_pnpt__date_updated);
$smarty->assign("EDIT_R_PNPT__USER_CREATED",$edit_r_pnpt__user_created);
$smarty->assign("EDIT_R_PNPT__USER_UPDATED",$edit_r_pnpt__user_updated);
$smarty->assign("EDIT_R_PNPT__AKTIF",$edit_r_pnpt__aktif);      
$smarty->assign("EDIT_R_PEGAWAI__ID",$edit_r_pegawai__id);
$smarty->assign("EDIT_R_PEGAWAI__NAMA",$edit_r_pegawai__nama);
$smarty->assign("EDIT_R_PEGAWAI__TGL_MASUK",$edit_r_pegawai__tgl_masuk);
$smarty->assign("EDIT_R_CABANG__NAMA",$edit_r_cabang__nama);
$smarty->assign("EDIT_R_JABATAN__KET",$edit_r_jabatan__ket);
$smarty->assign("EDIT_R_DEPT__KET",$edit_r_dept__ket);
$smarty->assign("EDIT_R_CABANG__ID",$edit_r_cabang__id);  
$smarty->assign("EDIT_R_SUBCAB__ID",$edit_r_subcab__id);
$smarty->assign("EDIT_R_DEPT__ID",$edit_r_dept__id );
$smarty->assign("EDIT_R_SUBDEP__ID",$edit_r_subdept__id ); 
$smarty->assign("EDIT_R_PNPT__PDRM",$edit_r_pnpt__pdrm ); 
$smarty->assign("EDIT_TGL_SK",$edit_tgl_sk ); 
$smarty->assign("EDIT_AREA_KERJA",$edit_r_pnpt__areakerja ); 
$smarty->assign ("EDIT_VAL", $edit);




$sql_tipe_pdrm= "SELECT
  tipe_penempatan__id,tipe_penempatan,tipe_penempatan__status,tipe_penempatan__pdrm FROM r_tipe_penempatan
  where tipe_penempatan__id='$edit_r_pnpt__pdrm' 
  GROUP BY tipe_penempatan__pdrm  Order BY  tipe_penempatan asc";

$result_pdrm = $db->Execute($sql_tipe_pdrm);
$initSet = array();
$data_pdrm = array();
$z=0;
while ($arr=$result_pdrm->FetchRow()) {
	array_push($data_pdrm, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_TIPEPDRM", $data_pdrm);

//-----------------------CLOSE VIEW EDIT----------------------------------------------------------------------------------//
//$tahun = now();
//-----------------------------------------VIEW INDEX---------------------------------------------------------------------//
if ($_GET['search'] == '1')
    {
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
            
		  if($jenis_user=='2'){

                                                $sql  = "SELECT
                                                        r_penempatan.r_pnpt__pdrm AS r_pnpt__pdrm,
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
                                                        r_pegawai.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
                                                        r_status_pegawai.r_stp__id AS r_stp__id,
                                                        r_status_pegawai.r_stp__nama AS r_stp__nama,
                                                        r_level.r_level__ket,
                                                        TIMESTAMPDIFF(MONTH, r_pnpt__kon_akhir, DATE(NOW())) as warning

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
                                                        INNER JOIN r_level
                                                            ON r_jabatan.r_jabatan__level = r_level.r_level__id
                                                        INNER JOIN r_status_pegawai
                                                             ON r_status_pegawai.r_stp__id = r_penempatan.r_pnpt__status                                                     
                                                        INNER JOIN r_tipe_penempatan ON r_tipe_penempatan.tipe_penempatan__id = r_penempatan.r_pnpt__pdrm
                                                        WHERE r_penempatan.r_pnpt__aktif = '1' AND r_cabang__id= '".$kode_pw_ses."' ";
                                                
                      

                                                    

			} else {
						$sql  = "SELECT
                                                        r_penempatan.r_pnpt__pdrm AS r_pnpt__pdrm,
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
                                                        r_pegawai.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
                                                        r_status_pegawai.r_stp__id AS r_stp__id,
                                                        r_status_pegawai.r_stp__nama AS r_stp__nama,
                                                         r_level.r_level__ket,
                                                        TIMESTAMPDIFF(MONTH, r_pnpt__kon_akhir, DATE(NOW())) as warning

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
                                                            INNER JOIN r_level
                                                          ON r_jabatan.r_jabatan__level = r_level.r_level__id
                                                             INNER JOIN r_status_pegawai
                                                            ON r_status_pegawai.r_stp__id = r_penempatan.r_pnpt__status
                                                         INNER JOIN r_tipe_penempatan ON r_tipe_penempatan.tipe_penempatan__id = r_penempatan.r_pnpt__pdrm
                                                             WHERE r_penempatan.r_pnpt__aktif = '1' ";	

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
                                if( $r_pnpt__nip_cari!=''){
					$sql .= "AND r_pnpt__nip= '".$r_pnpt__nip_cari."' ";
				} 
                                
                                   if($finger_pegawai_cari!=''){
					
                                        $sql .= "AND r_pnpt__finger_print ='".$finger_pegawai_cari."'";
				} 
                                 if($sts_pegawai_cari!=''){
					
                                        $sql .= "AND r_pnpt__status ='".$sts_pegawai_cari."'";
				} 
                                   if($level_cari!=''){
					
                                        $sql .= "AND r_level__id ='".$level_cari."'";
				} 
                                
                                
                                 if($bulan_cari!=''){
					
                                        $sql .= "AND MONTH(r_pnpt__kon_akhir) ='".$bulan_cari."'";
				} 
                                 if($tahun_cari!=''){
					
                                        $sql .= "AND YEAR(r_pnpt__kon_akhir) ='".$tahun_cari."'";
				} 
                              
			 	$sql .= " GROUP BY r_pnpt__no_mutasi ORDER BY  trim(r_pegawai__nama) asc ";

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

                            //HITUNG  kontrak   
                                
  $date1=$data_tb[0][12];                              
//$date1=$arr[r_pnpt__kon_akhir]; 	
$date2=date("Y-m-d");
$ts1 = strtotime($date1);
$ts2 = strtotime($date2);
$year1 = date('Y', $ts1);
$year2 = date('Y', $ts2);
$month1 = date('m', $ts1);
$month2 = date('m', $ts2);
$diff = (($year2 - $year1) * 12) + ($month2 - $month1);
if ($diff>=-2 )
{
         $err_font_open='<font color="#ff0000">';
         $err_font_close='<font> Kontrak Habis';
}else
{
	$err_font_open='<font color="#4286f4">';
        $err_font_close='<font>';
}





                            //    tutup
                                
				$count_view = $start+1;
				$count_all  = $start+$end;
				$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 
}

}
else
    
{
				

	if($jenis_user=='2'){
                                                $sql = "SELECT  r_penempatan.r_pnpt__pdrm AS r_pnpt__pdrm,
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
                                                        r_pegawai.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
                                                        r_status_pegawai.r_stp__id AS r_stp__id,
                                                        r_status_pegawai.r_stp__nama AS r_stp__nama,
                                                         r_level.r_level__ket,
                                                        TIMESTAMPDIFF(MONTH, r_pnpt__kon_akhir, DATE(NOW())) as warning

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
                                                          INNER JOIN r_level
                                                        ON r_jabatan.r_jabatan__level = r_level.r_level__id
                                                      INNER JOIN r_status_pegawai
                                                        ON r_status_pegawai.r_stp__id = r_penempatan.r_pnpt__status
                                                        INNER JOIN r_tipe_penempatan ON r_tipe_penempatan.tipe_penempatan__id = r_penempatan.r_pnpt__pdrm
                                                          WHERE r_penempatan.r_pnpt__aktif = '1' AND r_cabang__id = '".$kode_pw_ses."' ";
                                            

			} else {
						$sql  = "SELECT  r_penempatan.r_pnpt__pdrm AS r_pnpt__pdrm,
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
                                                        r_pegawai.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
                                                        r_status_pegawai.r_stp__id AS r_stp__id,
                                                        r_status_pegawai.r_stp__nama AS r_stp__nama,
                                                        r_level.r_level__ket,
                                                        TIMESTAMPDIFF(MONTH, r_pnpt__kon_akhir, DATE(NOW())) as warning

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
                                                          INNER JOIN r_level
                                                        ON r_jabatan.r_jabatan__level = r_level.r_level__id
                                                      INNER JOIN r_status_pegawai
                                                        ON r_status_pegawai.r_stp__id = r_penempatan.r_pnpt__status
                                                       INNER JOIN r_tipe_penempatan ON r_tipe_penempatan.tipe_penempatan__id = r_penempatan.r_pnpt__pdrm
                                                          WHERE r_penempatan.r_pnpt__aktif = '1'";	

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
                                if( $r_pnpt__nip_cari!=''){
					$sql .= "AND r_pnpt__nip= '".$r_pnpt__nip_cari."' ";
				} 
                                
                                  if($finger_pegawai_cari!=''){
					
                                        $sql .= "AND r_pnpt__finger_print ='".$finger_pegawai_cari."'";
				} 
                                
                                 if($sts_pegawai_cari!=''){
					
                                        $sql .= "AND r_pnpt__status ='".$sts_pegawai_cari."'";
				} 
                                 if($sts_pegawai_cari!=''){
					
                                        $sql .= "AND r_pnpt__status ='".$sts_pegawai_cari."'";
				} 
                                    if($bulan_cari!=''){
					
                                        $sql .= "AND MONTH(r_pnpt__kon_akhir) ='".$bulan_cari."'";
				} 
                                 if($tahun_cari!=''){
					
                                        $sql .= "AND YEAR(r_pnpt__kon_akhir) ='".$tahun_cari."'";
				} 
                                
                              // var_dump($sql)or die();
				$sql .= " GROUP BY r_pnpt__no_mutasi ORDER BY  trim(r_pegawai__nama) asc ";
 
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
                                    
                                        //HITUNG  kontrak   
                                
                                $date1=$arr[r_pnpt__kon_akhir];                              
                              //$date1=$arr[r_pnpt__kon_akhir]; 	
                              $date2=date("Y-m-d");
                              $ts1 = strtotime($date1);
                              $ts2 = strtotime($date2);
                              $year1 = date('Y', $ts1);
                              $year2 = date('Y', $ts2);
                              $month1 = date('m', $ts1);
                              $month2 = date('m', $ts2);
                              $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
                              if ($diff==-2 )
                              {

                                      $err_font_open='<font color="#ff0000">';
                                       $err_font_close='<font> Kontrak Habis';
                              }else
                              {
                                      $err_font_open='<font color="#4286f4">';
                                       $err_font_close='<font>';
}
                                    
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



if ($_GET[cek_list] == 1)
{  

	$cek_jabatan = $_GET['cek_jabatan'];
        if($cek_jabatan!=''){
					$sql_kabupaten = "SELECT cab.r_cabang__id ,cab.r_cabang__nama,subcab.r_subcab__nama,subcab.r_subcab__id as subcab FROM r_cabang cab,r_subcabang subcab
                                                          where cab.r_cabang__id=subcab.r_subcab__cabang AND cab.r_cabang__id='$subcabang' ORDER BY cab.r_cabang__nama ASC";
                                        //var_dump($sql_kabupaten)or die();
                                        $recordSet_kabupaten = $db->Execute($sql_kabupaten);
					 
                                        $input_kab="<TABLE class='tborder' border='0' cellpadding='1' cellspacing='1' width='100%' align='left'>";
                                        $input_kab.='<THEAD>';
                                        $input_kab.="<th class='tdatahead align='left'>No</th>";
                                        $input_kab.="<th class='tdatahead' align='left' width='5%'>Nama</th>";
                                        $input_kab.="<th class='tdatahead' align='left' width='5%'>Finger Print</th>";
                                        $input_kab.="<th class='tdatahead' align='left' width='5%'>Cabang</th>";
                                        $input_kab.="<th class='tdatahead' align='left' width='5%'>Sub Cabang</th>";
                                        $input_kab.="<th class='tdatahead' align='left' width='5%'>Departemen</th>";
                                        $input_kab.="<th class='tdatahead' align='left' width='5%'>Jabatan</th>";
                                        $input_kab.="<th class='tdatahead' align='left' width='5%'>Tgl Masuk</th>";
                                        $input_kab.="<th class='tdatahead' align='left' width='5%'>Status Pegawai</th>";
                                        $input_kab.="<th class='tdatahead' align='left' width='5%'>Kontrak Awal</th>";
                                        $input_kab.="<th class='tdatahead' align='left' width='5%'>Kontrak Akhir</th>";
                                         $input_kab.="<th class='tdatahead' align='left' width='5%'>Keterangan</th>";
                                        $input_kab.='</THEAD>'; 
					
                                        $i=0; //inisialisasi untuk penomoran data
                                        //perintah untuk menampilkan data, id_brg terbesar ke kecil
                                            $tampil = "SELECT
                                                        r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                                        r_penempatan.r_pnpt__pdrm AS r_pnpt__pdrm,
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
                                                        DATE_FORMAT(r_penempatan.r_pnpt__kon_awal,'%d-%m-%Y') AS r_pnpt__kon_awal,
                                                        DATE_FORMAT(r_penempatan.r_pnpt__kon_akhir,'%d-%m-%Y') AS r_pnpt__kon_akhir,
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
                                                        r_subcabang.r_subcab__nama AS r_subcab__nama,
                                                        r_pegawai.r_pegawai__id AS r_pegawai__id,
                                                        r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                                  DATE_FORMAT(r_pegawai.r_pegawai__tgl_masuk,'%d-%m-%Y') AS r_pegawai__tgl_masuk,
                                                        r_status_pegawai.r_stp__id AS r_stp__id,
                                                        r_status_pegawai.r_stp__nama AS r_stp__nama,
                                                        r_level.r_level__ket AS r_level__ket,
                                                        r_tipe_penempatan.tipe_penempatan AS tipe_penempatan,
                                                        r_tipe_penempatan.tipe_penempatan__pdrm AS tipe_penempatan__pdrm,
                                                         r_tipe_penempatan.tipe_penempatan AS tipe_penempatan
                                                        
                                                FROM
                                                        r_pegawai
                                                INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                                INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                                INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                                INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                                INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                                INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                                INNER JOIN r_level ON r_jabatan.r_jabatan__level = r_level.r_level__id
                                                INNER JOIN r_status_pegawai ON r_status_pegawai.r_stp__id = r_penempatan.r_pnpt__status
                                                INNER JOIN r_tipe_penempatan ON r_penempatan.r_pnpt__pdrm = r_tipe_penempatan.tipe_penempatan__id
                                                WHERE
                                                        r_penempatan.r_pnpt__id_pegawai='$cek_jabatan'
                                                 GROUP BY r_pnpt__no_mutasi Order By r_pnpt__no_mutasi DESC";
                                        //perintah menampilkan data dikerjakan
                                     // var_dump($tampil)  or die();
                                        $sql = mysql_query($tampil);
                                        //tampilkan seluruh data yang ada pada tabel user
                                   
                                        if(mysql_num_rows($sql) > 0)
                                            
                                        
                                        while($data = mysql_fetch_array($sql))
                                         {  
                                                                                  
                                            $i++;
                                            
                                               
                                               $cek_pdrm=$data[r_stp__id];
                                             //  var_dump($cek_pdrm) or die();
                                         
                                    if($cek_pdrm==4)
                                               {
                                                    $pdrm1='Tetap';
                                               }
                                                else {
                                                    $pdrm1=$data[r_pnpt__kon_awal];
                                                }
                                                
                                      if($cek_pdrm==4)
                                               {
                                                    $pdrm2='Tetap';
                                               }
                                                else {
                                                    $pdrm2=$data[r_pnpt__kon_akhir];
                                                }
                                              
                                         
                                              $input_kab.="<TBODY><tr><TD class='tdatacontent-first-col'>$i</td>";
                                              $input_kab.="<TD width='10%' class='tdatacontent'>".$data[r_pegawai__nama]."</td>";
                                              $input_kab.="<td width='10%' class='tdatacontent'>".$data[r_pnpt__finger_print]."</td>";
                                              $input_kab.="<td width='10%' class='tdatacontent'>".$data[r_cabang__nama]."</td>";
                                              $input_kab.="<td width='10%' class='tdatacontent'>".$data[r_subcab__nama]."</td>";
                                              $input_kab.="<td width='5%' class='tdatacontent'>".$data[r_dept__ket]."</td>";
                                              $input_kab.="<td width='10%' class='tdatacontent'>".$data[r_jabatan__ket]."</td>";
                                              $input_kab.="<td width='8%' class='tdatacontent'>".$data[r_pegawai__tgl_masuk]."</td>";
                                              $input_kab.="<td width='5%' class='tdatacontent'>".$data[r_stp__nama]."</td>";
                                              $input_kab.="<td width='10%' class='tdatacontent'>".$pdrm1."</td>";
                                              $input_kab.="<td width='10%'class='tdatacontent'>".$pdrm2."</td>";
                                              $input_kab.="<td width='10%'class='tdatacontent'>".$data[tipe_penempatan]."</td>";
                                              $input_kab.="</tr></TBODY>";
                                        
                                       
                                              }
                                              else
                                              {
                                            $input_kab="<TABLE class='tborder'  width='100%'>";
                                            $input_kab.="<TBODY><tr><TD class='tdatacontent' colspan='12' align='center'>Daftar Riwayat Karyawan Di Atas Belum Ada Di PT.TMW </td>";
                                            $input_kab.="</tr></TBODY>";
                                                  
                                              }
                                        $input_kab.="</table> ";
					$delimeter   = "-";
					$option_choice = $input_kab."^/&".$delimeter;
					echo $option_choice;

			}

        
        
}


//----------- AJAX SUBPENEMPATAN ------------------//
if ($_GET[get_subpenempatan] == 1)
{  
    	$subdep = $_GET[no_subpenempatan];
            //var_dump($subdep) or die();
		if($subdep!=''){
                    $sql_kabupaten = " SELECT
                                A.r_stp__id,
                                A.r_stp__nama,
                                B.tipe_penempatan__id,
                                B.tipe_penempatan,
                                B.tipe_penempatan__status,
                                B.tipe_penempatan__pdrm,
                                B.tipe_penempatan__date_created,
                                B.tipe_penempatan__date_updated,
                                B.tipe_penempatan__user_created,
                                B.tipe_penempatan__user_updated
                                from r_status_pegawai A
                                INNER JOIN r_tipe_penempatan B ON A.r_stp__id=B.tipe_penempatan__status
                                where r_stp__id='$subdep' AND B.tipe_penempatan__jenisuser LIKE '%$jenis_user%' ORDER BY tipe_penempatan ASC";
                                //  var_dump($sql_kabupaten) or die();
                                $recordSet_kabupaten = $db->Execute($sql_kabupaten);

                                $input_kab="<select name=tipe_pdrm>";
                                $input_kab.="<option value=''> ";
                                $input_kab.="</option> ";
                                while(!$recordSet_kabupaten->EOF):
                                        $input_kab.="<option value=";
                                        $input_kab.= $recordSet_kabupaten->fields[tipe_penempatan__pdrm].">".$recordSet_kabupaten->fields['tipe_penempatan'];
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
//------------closer AJAX SUBPENEMPATAN----------------------------------------//






//---------------------------------CLOSE VIEW INDEX---------------------------------------------------------------------//
$smarty->assign ("LABEL_KONTRAK",$label_kontrak);
$smarty->assign ("ERR_FONT1",$err_font_open);
$smarty->assign ("ERR_FONT2",$err_font_close);
$smarty->assign ("WARNING",$warning); 
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
$smarty->assign ("DATA_TB2", $data_tb2);

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