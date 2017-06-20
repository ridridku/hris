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
$_SESSION['LANG']       = $LANG;

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

$jenis_user   = $_SESSION['SESSION_JNS_USER'];
$kode_pw_ses  = $_SESSION['SESSION_KODE_CABANG'];
$today =date("Y-m-d");



$smarty->assign ("JENIS_USER_SES", $jenis_user);
$smarty->assign ("KODE_PW_SES", $kode_pw_ses);
$smarty->assign ("TODAY", $today);
//echo "JENIS USER".$_SESSION['SESSION_JNS_USER'];
//echo "<br>KODE PERWAKILAN".$_SESSION['SESSION_KODE_PERWAKILAN'];HREF_IMG_PATH

#HREF
$smarty->assign ("HREF_FOTO", $HREF_HOME.'/modules/data_pegawai/pegawai/uploads');
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);
$smarty->assign ("HREF_HOME_PATH_AJAX", $HREF_HOME.'/modules/data_pegawai/pegawai');
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_pegawai/pegawai/';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_pegawai');
$FILE_JS  = $JS_MODUL.'/pegawai';

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
$tbl_name	= "r_pegawai";

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

if ($_GET['departemen_cari']) $departemen_cari = $_GET['departemen_cari'];
else if ($_POST['departemen_cari']) $departemen_cari= $_POST['departemen_cari'];
else $departemen_cari="";


if ($_GET['nama_pegawai_cari']) $nama_pegawai_cari_ = $_GET['nama_pegawai_cari'];
else if ($_POST['nama_pegawai_cari']) $nama_pegawai_cari_ = $_POST['nama_pegawai_cari'];
else $nama_pegawai_cari_="";

if ($_GET['finger_pegawai_cari']) $finger_pegawai_cari = $_GET['finger_pegawai_cari'];
else if ($_POST['finger_pegawai_cari']) $finger_pegawai_cari = $_POST['finger_pegawai_cari'];
else $finger_pegawai_cari="";


if ($_GET['ktp_cari']) $ktp_cari= $_GET['ktp_cari'];
else if ($_POST['ktp_cari']) $ktp_cari= $_POST['ktp_cari'];
else $ktp_cari="";


$smarty->assign ("KODE_PERWAKILAN_CARI", $kode_perwakilan_cari);
$smarty->assign ("NO_PASPOR_CARI", $no_paspor_cari);
$smarty->assign ("NAMA_PEGAWAI_CARI", $nama_pegawai_cari);
$smarty->assign ("KODE_SUMBER", $kode_sumber);


//$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_cabang_cari=".$kode_cabang_cari."&nama_pegawai_cari=".$nama_pegawai_cari;
//$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;
$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."kode_cabang_cari=".$kode_cabang_cari."&kode_subcab_cari=".$kode_subcab_cari."&r_pnpt__nip_cari=".$r_pnpt__nip_cari."&nama_pegawai_cari=".$nama_pegawai_cari;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&kode_cabang_cari=".$kode_cabang_cari."&kode_subcab_cari=".$kode_subcab_cari."&r_pnpt__nip_cari=".$r_pnpt__nip_cari."&nama_pegawai_cari=".$nama_pegawai_cari;

//PENCARIAN
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
//------------------DATA AJAX SUBCAB2-------------//


if ($_GET[q] == 1)
{
    $nosubcab = $_GET[y];
			if($nosubcab!=''){
					$sql_kabupaten = "SELECT cab.r_cabang__id ,cab.r_cabang__nama,subcab.r_subcab__nama,subcab.r_subcab__id as subcab FROM r_cabang cab,r_subcabang subcab
                                                          where cab.r_cabang__id=subcab.r_subcab__cabang AND cab.r_cabang__id='$nosubcab' ORDER BY cab.r_cabang__nama ASC";
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
/*================TUTUP PENCARIAN=====================*/


//SHOW DATA PROVINSI
//----------------------------------------------------------------------------------------------------
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

//-------------------------------------
$sql_agama = "SELECT  *  FROM r_agama ";
$result_agama = $db->Execute($sql_agama);
$initSet = array();
$data_agama = array();
$z=0;
while ($arr=$result_agama->FetchRow()) {
	array_push($data_agama, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_AGAMA",$data_agama);


//-------------------data_dep------------------
$sql_dep = " SELECT r_dept__id,
  r_dept__akronim,
  r_dept__ket,
  r_dept__cc,
  r_dept__date_created,
  r_dept__date_updated,
  r_dept__user_created,
  r_dept__user_updated from r_departement A order by r_dept__ket";
$result_dep = $db->Execute($sql_dep);
$initSet = array();
$data_dep = array();
$z=0;
while ($arr=$result_dep->FetchRow()) {
	array_push($data_dep, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_DEP",$data_dep);

//-------------data_pwk------------------------
$sql_pwk = "SELECT * FROM r_cabang order by r_cabang__nama  ";
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
//---------------------data_pwk---------------------------

$sql_jabatan= "SELECT * FROM r_jabatan order by r_jabatan__ket ";
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

//-----------------------DATA AJAX KTP-----------------------------//

if ($_GET[get_prop_ktp] == 1)
{  
	$no_propinsi = $_GET[no_prop_ktp];
			if($no_propinsi!=''){
					$sql_kabupaten = "SELECT A.r_provinsi__id,A.r_provinsi__nama,B.r_kabupaten__id,B.r_kabupaten__nama,B.r_kabupaten__sts FROM r_provinsi A
                                                            LEFT JOIN r_kabupaten B on A.r_provinsi__id = B.r_kabupaten__provinsi_id
                                                            WHERE A.r_provinsi__id='".$no_propinsi."' ORDER BY A.r_provinsi__id ASC";
					$recordSet_kabupaten = $db->Execute($sql_kabupaten);
					
					$input_kab="<select name='r_pegawai__ktp_kab'  onchange=\"cari_kec_ktp(this.value)\">";
					$input_kab.="<option value=''> ";
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

if ($_GET[get_kec_ktp] == 1)
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
					$input_kec.="<option value=''> ";
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



if ($_GET[get_desa_ktp] == 1)
{
   
  $kecamatan_id = $_GET[kec_id];

  if($kecamatan_id!=''){
					$sql_kecamatan = "SELECT
                                                            A.r_kecamatan__id,
                                                            A.r_kecamatan__kabupaten_id,
                                                            A.r_kecamatan__nama,
                                                            B.r_desa__nama,
                                                            B.r_desa__sts,B.r_desa__id

                                                          FROM
                                                            r_kecamatan A
                                                            LEFT JOIN r_wilayah B
                                                              ON A.r_kecamatan__id=B.r_desa__kecamatan_id
                                                          WHERE
                                                           r_kecamatan__id='".$kecamatan_id."' ORDER BY r_desa__id ASC";
					
                                        $recordSet_kecamatan = $db->Execute($sql_kecamatan); 
                                        $input_kec="<select name=r_pegawai__ktp_desa  >";
					$input_kec.="<option value=''> ";
					$input_kec.="</option> ";
					while(!$recordSet_kecamatan->EOF):
						$input_kec.="<option value=";
						$input_kec.= $recordSet_kecamatan->fields['r_desa__id'].">".$recordSet_kecamatan->fields['r_desa__sts'].'-'.$recordSet_kecamatan->fields['r_desa__nama'];
						$input_kec.="</option>";
					$recordSet_kecamatan->MoveNext();
					endwhile;
					$input_kec.="</select> ";
					//
					$delimeter   = "-";
					$option_choice = $input_kec."^/&".$delimeter;
					echo $option_choice;
			}
  
  
    
}
//-----------------------DATA AJAX DOMISILI-----------------------------//
if ($_GET[get_prop_alm] == 1)
{  
	$no_propinsi_alm = $_GET[no_prop_alm];    
       
			if($no_propinsi_alm!=''){
					$sql_kabupaten = "SELECT A.r_provinsi__id,A.r_provinsi__nama,B.r_kabupaten__id,B.r_kabupaten__nama,B.r_kabupaten__sts FROM r_provinsi A
                                                            LEFT JOIN r_kabupaten B on A.r_provinsi__id = B.r_kabupaten__provinsi_id
                                                            WHERE A.r_provinsi__id='".$no_propinsi_alm."' ORDER BY A.r_provinsi__id ASC";
					$recordSet_kabupaten = $db->Execute($sql_kabupaten);
					
					$input_kab2="<select name=r_pegawai__alm_kab  onchange=\"cari_kec_alm(this.value)\">";
					$input_kab2.="<option value=''> ";
					$input_kab2.="</option> ";
					while(!$recordSet_kabupaten->EOF):
						$input_kab2.="<option value=";
						$input_kab2.= $recordSet_kabupaten->fields['r_kabupaten__id'].">".$recordSet_kabupaten->fields['r_kabupaten__sts'].'-'.$recordSet_kabupaten->fields['r_kabupaten__nama'];
						$input_kab2.="</option>";
					$recordSet_kabupaten->MoveNext();
					endwhile;
					$input_kab2.="</select> ";
					//
					$delimeter   = "-";
                                      
					$option_choice = $input_kab2."^/&".$delimeter;
					echo $option_choice;
                                        
                                        
			}
}

if ($_GET[get_kec_alm] == 1)
{
	$kab_id_alm = $_GET[kab_id];
			if($kab_id_alm!=''){
					$sql_kecamatan = "SELECT A.r_kecamatan__id,
                                                        A.r_kecamatan__kabupaten_id,
                                                        A.r_kecamatan__nama,
                                                        B.r_kabupaten__nama,
                                                        B.r_kabupaten__provinsi_id
                                                        FROM r_kecamatan A
                                                          LEFT JOIN r_kabupaten B on A.r_kecamatan__kabupaten_id= B.r_kabupaten__id
                                                           WHERE r_kabupaten__id='".$kab_id_alm."' ORDER BY r_kecamatan__id ASC";
					$recordSet_kecamatan = $db->Execute($sql_kecamatan);
                                        $input_kec="<select name=r_pegawai__alm_kec  onchange=\"cari_kec2_alm(this.value)\">";
					$input_kec.="<option value=''> ";
					$input_kec.="</option> ";
					while(!$recordSet_kecamatan->EOF):
						$input_kec.="<option value=";
						$input_kec.= $recordSet_kecamatan->fields['r_kecamatan__id'].">".$recordSet_kecamatan->fields['r_kecamatan__nama'];
						$input_kec.="</option>";
					$recordSet_kecamatan->MoveNext();
					endwhile;
					$input_kec.="</select> ";
					//
					$delimeter   = "-";
					$option_choice = $input_kec."^/&".$delimeter;
					echo $option_choice;
			}
}

if ($_GET[get_desa_alm] == 1)
{
  $kec_id = $_GET[kec_id];
  if($kec_id!=''){
					$sql_kecamatan = "SELECT
                                                            A.r_kecamatan__id,
                                                            A.r_kecamatan__kabupaten_id,
                                                            A.r_kecamatan__nama,
                                                            B.r_desa__nama,
                                                            B.r_desa__sts,B.r_desa__id

                                                          FROM
                                                            r_kecamatan A
                                                            LEFT JOIN r_wilayah B
                                                              ON A.r_kecamatan__id=B.r_desa__kecamatan_id
                                                          WHERE
                                                           r_kecamatan__id='".$kec_id."' ORDER BY r_desa__id ASC";
					$recordSet_kecamatan = $db->Execute($sql_kecamatan);
					 
                                        $input_kec="<select name=r_pegawai__alm_desa  >";
					$input_kec.="<option value=''> ";
					$input_kec.="</option> ";
					while(!$recordSet_kecamatan->EOF):
						$input_kec.="<option value=";
						$input_kec.= $recordSet_kecamatan->fields['r_desa__id'].">".$recordSet_kecamatan->fields['r_desa__sts'].'-'.$recordSet_kecamatan->fields['r_desa__nama'];
						$input_kec.="</option>";
					$recordSet_kecamatan->MoveNext();
					endwhile;
					$input_kec.="</select> ";
					//
					$delimeter   = "-";
					$option_choice = $input_kec."^/&".$delimeter;
					echo $option_choice;
			}  
}

//-----------------------CLOSE AJAX DOMISILI-----------------------------------------------------------------------------//

//-----------------------OPEN AJAX ORTU----------------------------------------------------------------------------------//
if ($_GET[get_prop_ortu] == 1)
{  
	$no_prop_ortu = $_GET[no_prop_ortu];    
			if($no_prop_ortu!=''){
					$sql_kabupaten = "SELECT A.r_provinsi__id,A.r_provinsi__nama,B.r_kabupaten__id,B.r_kabupaten__nama,B.r_kabupaten__sts FROM r_provinsi A
                                                          LEFT JOIN r_kabupaten B on A.r_provinsi__id = B.r_kabupaten__provinsi_id
                                                          WHERE A.r_provinsi__id='".$no_prop_ortu."' ORDER BY A.r_provinsi__id ASC";
					$recordSet_kabupaten = $db->Execute($sql_kabupaten);
					$input_kab2="<select name=r_pegawai__ortu_kab  onchange=\"cari_kec_ortu(this.value)\">";
					$input_kab2.="<option value=''";
					$input_kab2.="</option> ";
					while(!$recordSet_kabupaten->EOF):
						$input_kab2.="<option value=";
						$input_kab2.= $recordSet_kabupaten->fields['r_kabupaten__id'].">".$recordSet_kabupaten->fields['r_kabupaten__sts'].'-'.$recordSet_kabupaten->fields['r_kabupaten__nama'];
						$input_kab2.="</option>";
					$recordSet_kabupaten->MoveNext();
					endwhile;
					$input_kab2.="</select> ";
					//
					$delimeter   = "-";
                                      
					$option_choice = $input_kab2."^/&".$delimeter;
					echo $option_choice;
                                        
                                        
			}
}

if ($_GET[get_kec_ortu] == 1)
{
	$kab_id_ortu = $_GET[kab_id];
			if($kab_id_ortu!=''){
					$sql_kecamatan = "SELECT A.r_kecamatan__id,
                                                        A.r_kecamatan__kabupaten_id,
                                                        A.r_kecamatan__nama,
                                                        B.r_kabupaten__nama,
                                                        B.r_kabupaten__provinsi_id
                                                        FROM r_kecamatan A
                                                          LEFT JOIN r_kabupaten B on A.r_kecamatan__kabupaten_id= B.r_kabupaten__id
                                                           WHERE r_kabupaten__id='".$kab_id_ortu."' ORDER BY r_kecamatan__id ASC";
					$recordSet_kecamatan = $db->Execute($sql_kecamatan);
                                        $input_kec="<select name=r_pegawai__ortu_kec  onchange=\"cari_kec2_ortu(this.value)\">";
					$input_kec.="<option value=''> ";
					$input_kec.="</option> ";
					while(!$recordSet_kecamatan->EOF):
						$input_kec.="<option value=";
						$input_kec.= $recordSet_kecamatan->fields['r_kecamatan__id'].">".$recordSet_kecamatan->fields['r_kecamatan__nama'];
						$input_kec.="</option>";
					$recordSet_kecamatan->MoveNext();
					endwhile;
					$input_kec.="</select> ";
					//
					$delimeter   = "-";
					$option_choice = $input_kec."^/&".$delimeter;
					echo $option_choice;
			}
}

if ($_GET[get_desa_ortu] == 1)
{
   
  $kec_id = $_GET[kec_id];
  if($kec_id!=''){
					$sql_kecamatan = "SELECT
                                                            A.r_kecamatan__id,
                                                            A.r_kecamatan__kabupaten_id,
                                                            A.r_kecamatan__nama,
                                                            B.r_desa__nama,
                                                            B.r_desa__sts,B.r_desa__id

                                                          FROM
                                                            r_kecamatan A
                                                            LEFT JOIN r_wilayah B
                                                              ON A.r_kecamatan__id=B.r_desa__kecamatan_id
                                                          WHERE
                                                           r_kecamatan__id='".$kec_id."' ORDER BY r_desa__id ASC";
					$recordSet_kecamatan = $db->Execute($sql_kecamatan);
					 
                                        $input_kec="<select name='r_pegawai__ortu_desa'>";
					$input_kec.="<option value=''> ";
					$input_kec.="</option> ";
					while(!$recordSet_kecamatan->EOF):
						$input_kec.="<option value=";
						$input_kec.= $recordSet_kecamatan->fields['r_desa__id'].">".$recordSet_kecamatan->fields['r_desa__sts'].'-'.$recordSet_kecamatan->fields['r_desa__nama'];
						$input_kec.="</option>";
					$recordSet_kecamatan->MoveNext();
					endwhile;
					$input_kec.="</select> ";
					//
					$delimeter   = "-";
					$option_choice = $input_kec."^/&".$delimeter;
					echo $option_choice;
			}
  
  
    
}

//-----------------------CLOSE AJAX ORTU-----------------------------//


//-----------------------OPEN AJAX PASANGAN-----------------------------//
if ($_GET[get_prop_pas] == 1)
{  

	$no_prop_pas = $_GET[no_prop_pas];    
    
        
			if($no_prop_pas!=''){
					$sql_kabupaten = "SELECT A.r_provinsi__id,A.r_provinsi__nama,B.r_kabupaten__id,B.r_kabupaten__nama,B.r_kabupaten__sts FROM r_provinsi A
                                                            LEFT JOIN r_kabupaten B on A.r_provinsi__id = B.r_kabupaten__provinsi_id
                                                            WHERE A.r_provinsi__id='".$no_prop_pas."' ORDER BY A.r_provinsi__id ASC";
					$recordSet_kabupaten = $db->Execute($sql_kabupaten);
					
					$input_kab2="<select name=r_pegawai__pas_kab  onchange=\"cari_kec_pas(this.value)\">";
					$input_kab2.="<option value=''> ";
					$input_kab2.="</option> ";
					while(!$recordSet_kabupaten->EOF):
						$input_kab2.="<option value=";
						$input_kab2.= $recordSet_kabupaten->fields['r_kabupaten__id'].">".$recordSet_kabupaten->fields['r_kabupaten__sts'].'-'.$recordSet_kabupaten->fields['r_kabupaten__nama'];
						$input_kab2.="</option>";
					$recordSet_kabupaten->MoveNext();
					endwhile;
					$input_kab2.="</select> ";
					//
					$delimeter   = "-";
                                      
					$option_choice = $input_kab2."^/&".$delimeter;
					echo $option_choice;
                                        
                                        
			}
}

if ($_GET[get_kec_pas] == 1)
{
	$kab_id_pas = $_GET[kab_id_pas];
       
			if($kab_id_pas!=''){
					$sql_kecamatan = "SELECT A.r_kecamatan__id,
                                                        A.r_kecamatan__kabupaten_id,
                                                        A.r_kecamatan__nama,
                                                        B.r_kabupaten__nama,
                                                        B.r_kabupaten__provinsi_id
                                                        FROM r_kecamatan A
                                                           LEFT JOIN r_kabupaten B on A.r_kecamatan__kabupaten_id= B.r_kabupaten__id
                                                           WHERE r_kabupaten__id='".$kab_id_pas."' ORDER BY r_kecamatan__id ASC";
					$recordSet_kecamatan = $db->Execute($sql_kecamatan);
                                        $input_kec="<select name=r_pegawai__pas_kec  onchange=\"cari_desa_pas(this.value)\">";
					$input_kec.="<option value=''> ";
					$input_kec.="</option> ";
					while(!$recordSet_kecamatan->EOF):
						$input_kec.="<option value=";
						$input_kec.= $recordSet_kecamatan->fields['r_kecamatan__id'].">".$recordSet_kecamatan->fields['r_kecamatan__nama'];
						$input_kec.="</option>";
					$recordSet_kecamatan->MoveNext();
					endwhile;
					$input_kec.="</select> ";
					//
					$delimeter   = "-";
					$option_choice = $input_kec."^/&".$delimeter;
					echo $option_choice;
			}
}

if ($_GET[get_desa_pas] == 1)
{
  $kec_id = $_GET[kec_id];
  if($kec_id!=''){
					$sql_kecamatan = "SELECT
                                                            A.r_kecamatan__id,
                                                            A.r_kecamatan__kabupaten_id,
                                                            A.r_kecamatan__nama,
                                                            B.r_desa__nama,
                                                            B.r_desa__sts,B.r_desa__id

                                                          FROM
                                                            r_kecamatan A
                                                            LEFT JOIN r_wilayah B
                                                              ON A.r_kecamatan__id=B.r_desa__kecamatan_id
                                                          WHERE
                                                           r_kecamatan__id='".$kec_id."' ORDER BY r_desa__id ASC";
					$recordSet_kecamatan = $db->Execute($sql_kecamatan);
					 
                                        $input_kec="<select name='r_pegawai__pas_desa'>";
					$input_kec.="<option value=''> ";
					$input_kec.="</option> ";
					while(!$recordSet_kecamatan->EOF):
						$input_kec.="<option value=";
						$input_kec.= $recordSet_kecamatan->fields['r_desa__id'].">".$recordSet_kecamatan->fields['r_desa__sts'].'-'.$recordSet_kecamatan->fields['r_desa__nama'];
						$input_kec.="</option>";
					$recordSet_kecamatan->MoveNext();
					endwhile;
					$input_kec.="</select> ";
					//
					$delimeter   = "-";
					$option_choice = $input_kec."^/&".$delimeter;
					echo $option_choice;
			}
  
  
    
}

//-----------------------CLOSE AJAX PASANGAN-----------------------------//



//-----------------------VIEW EDIT ---------------------------------------//
$opt = $_GET[opt];

$ed = 0;
if($opt=="1"){ 

	$sql_ = "SELECT * FROM r_pegawai peg where peg.r_pegawai__id ='".$_GET['id']."' ";

  // var_dump($sql_) or die();
	$resultSet = $db->Execute($sql_);
        $edit_r_pegawai__id = $resultSet->fields[r_pegawai__id];
        $edit_r_pegawai__nama = $resultSet->fields[r_pegawai__nama];
        $edit_r_pegawai__tgl_lahir = $resultSet->fields[r_pegawai__tgl_lahir];
        $edit_r_pegawai__tmpt_lahir = $resultSet->fields[r_pegawai__tmpt_lahir];
        $edit_r_pegawai__jk = $resultSet->fields[r_pegawai__jk];
        $edit_r_pegawai__ktp = $resultSet->fields[r_pegawai__ktp];
        $edit_r_pegawai__sim = $resultSet->fields[r_pegawai__sim];
        $edit_r_pegawai__nama_jalan=$resultSet->fields[r_pegawai__nama_jalan];
        $edit_r_pegawai__ktp_prov = $resultSet->fields[r_pegawai__ktp_prov];
        $edit_r_pegawai__ktp_kab = $resultSet->fields[r_pegawai__ktp_kab];
        $edit_r_pegawai__ktp_kec = $resultSet->fields[r_pegawai__ktp_kec];
        $edit_r_pegawai__ktp_desa = $resultSet->fields[r_pegawai__ktp_desa];
        $edit_r_pegawai__ktp_rt = $resultSet->fields[r_pegawai__ktp_rt];
        $edit_r_pegawai__ktp_rw = $resultSet->fields[r_pegawai__ktp_rw];
        $edit_r_pegawai__ktp_kodepos = $resultSet->fields[r_pegawai__ktp_kodepos];
        
        $edit_r_pegawai__alm_prov = $resultSet->fields[r_pegawai__alm_prov];
        $edit_r_pegawai__alm_kab = $resultSet->fields[r_pegawai__alm_kab];
        $edit_r_pegawai__alm_kec = $resultSet->fields[r_pegawai__alm_kec];
        $edit_r_pegawai__alm_desa = $resultSet->fields[r_pegawai__alm_desa];
        $edit_r_pegawai__alm_rt = $resultSet->fields[r_pegawai__alm_rt];
        $edit_r_pegawai__alm_rw = $resultSet->fields[r_pegawai__alm_rw];
        $edit_r_pegawai__alm_kodepos = $resultSet->fields[r_pegawai__alm_kodepos];
        
        $edit_r_pegawai__tlp_rumah = $resultSet->fields[r_pegawai__tlp_rumah];
        $edit_r_pegawai__tlp_pribadi = $resultSet->fields[r_pegawai__tlp_pribadi];
        $edit_r_pegawai__tlp_kantor = $resultSet->fields[r_pegawai__tlp_kantor];
        $edit_r_pegawai__gol_darah = $resultSet->fields[r_pegawai__gol_darah];
        $edit_r_pegawai__agama = $resultSet->fields[r_pegawai__agama];
        $edit_r_pegawai__tinggi = $resultSet->fields[r_pegawai__tinggi];
        $edit_r_pegawai__berat = $resultSet->fields[r_pegawai__berat];
        $edit_r_pegawai__ayah = $resultSet->fields[r_pegawai__ayah];
        $edit_r_pegawai__ibu = $resultSet->fields[r_pegawai__ibu];
        
        $edit_r_pegawai__ortu_prov = $resultSet->fields[r_pegawai__ortu_prov];
        $edit_r_pegawai__ortu_kab = $resultSet->fields[r_pegawai__ortu_kab];
        $edit_r_pegawai__ortu_kec = $resultSet->fields[r_pegawai__ortu_kec];
        $edit_r_pegawai__ortu_desa = $resultSet->fields[r_pegawai__ortu_desa];
        $edit_r_pegawai__ortu_rt = $resultSet->fields[r_pegawai__ortu_rt];
        $edit_r_pegawai__ortu_rw = $resultSet->fields[r_pegawai__ortu_rw];
        $edit_r_pegawai__ortu_kodepos = $resultSet->fields[r_pegawai__ortu_kodepos];
        
        $edit_r_pegawai__npwp = $resultSet->fields[r_pegawai__npwp];
        $edit_r_pegawai__no_bpjs = $resultSet->fields[r_pegawai__no_bpjs];
        $edit_r_pegawai__no_askes = $resultSet->fields[r_pegawai__no_askes];
        $edit_r_pegawai__bank1 = $resultSet->fields[r_pegawai__bank1];
        $edit_r_pegawai__bank1_rek = $resultSet->fields[r_pegawai__bank1_rek];
        $edit_r_pegawai__bank1_norek = $resultSet->fields[r_pegawai__bank1_norek];
        $edit_r_pegawai__bank1_alm = $resultSet->fields[r_pegawai__bank1_alm];
        $edit_r_pegawai__bank2 = $resultSet->fields[r_pegawai__bank2];
        $edit_r_pegawai__bank2_rek = $resultSet->fields[r_pegawai__bank2_rek];
        $edit_r_pegawai__bank2_norek = $resultSet->fields[r_pegawai__bank2_norek];
        $edit_r_pegawai__bank2_alm = $resultSet->fields[r_pegawai__bank2_alm];
        
        $edit_r_pegawai__pasangan = $resultSet->fields[r_pegawai__pasangan];
        $edit_r_pegawai__pas_tgllahir = $resultSet->fields[r_pegawai__pas_tgllahir];
        $edit_r_pegawai__pas_tmptlahir = $resultSet->fields[r_pegawai__pas_tmptlahir];
        $edit_r_pegawai__pas_prov = $resultSet->fields[r_pegawai__pas_prov];
        $edit_r_pegawai__pas_kab = $resultSet->fields[r_pegawai__pas_kab];
        $edit_r_pegawai__pas_kec = $resultSet->fields[r_pegawai__pas_kec];
        $edit_r_pegawai__pas_desa = $resultSet->fields[r_pegawai__pas_desa];
        $edit_r_pegawai__pas_rt = $resultSet->fields[r_pegawai__pas_rt];
        $edit_r_pegawai__pas_rw = $resultSet->fields[r_pegawai__pas_rw];
        $edit_r_pegawai__pas_tlp= $resultSet->fields[r_pegawai__pas_tlp];
        $edit_r_pegawai__pas_jml_anak= $resultSet->fields[r_pegawai__pas_jml_anak];
        $edit_r_pegawai__pas_anak1= $resultSet->fields[r_pegawai__pas_anak1];
        $edit_r_pegawai__pas_anak2= $resultSet->fields[r_pegawai__pas_anak2];
        $edit_r_pegawai__pas_anak3= $resultSet->fields[r_pegawai__pas_anak3];
        $edit_r_pegawai__pas_kodepos = $resultSet->fields[r_pegawai__pas_kodepos];
        $edit_r_pegawai__photo = $resultSet->fields[r_pegawai__photo];
        $edit_r_pegawai__status_kawin = $resultSet->fields[r_pegawai__status_kawin];
        $edit_r_pegawai__tgl_masuk = $resultSet->fields[r_pegawai__tgl_masuk];
        $edit_r_pegawai__id_subcab = $resultSet->fields[r_pegawai__id_subcab];
        $edit_r_pegawai__subdept = $resultSet->fields[r_pegawai__bpjs_kesehatan];
        $edit_r_pegawai__jabatan = $resultSet->fields[r_pegawai__jabatan];
        $edit_r_pegawai__st_pegawai = $resultSet->fields[r_pegawai__st_pegawai];
        $edit_r_pegawai__pend_tgl_lulus = $resultSet->fields[r_pegawai__pend_tgl_lulus];
        $edit_r_pegawai__pend_akhir = $resultSet->fields[r_pegawai__pend_akhir];
        $edit_r_pegawai__pend_sekolah = $resultSet->fields[r_pegawai__pend_sekolah];
        $edit_r_pegawai__pend_jurusan = $resultSet->fields[r_pegawai__pend_jurusan];
       // $edit_r_pegawai__date_created = $resultSet->fields[r_pegawai__date_created];
        $edit_r_pegawai__date_updated = $resultSet->fields[r_pegawai__date_updated];
       // $edit_r_pegawai__user_created = $resultSet->fields[r_pegawai__user_created];
        $edit_r_pegawai__user_updated = $resultSet->fields[r_pegawai__user_updated];
        
        $edit=1;
}
//----------------CLOSE EDIT---------------------//
	
$smarty->assign ("OPT", $opt);
$smarty->assign ("EDIT_ID", $edit_id);
//$smarty->assign ("EDIT_KODE_CABANG", $edit_kode_cabang);
$smarty->assign ("EDIT_R_PEGAWAI__ID",$edit_r_pegawai__id);
$smarty->assign ("EDIT_R_PEGAWAI__NAMA",$edit_r_pegawai__nama);
$smarty->assign ("EDIT_R_PEGAWAI__TGL_LAHIR",$edit_r_pegawai__tgl_lahir);
$smarty->assign ("EDIT_R_PEGAWAI__TMPT_LAHIR",$edit_r_pegawai__tmpt_lahir);
$smarty->assign ("EDIT_R_PEGAWAI__JK",$edit_r_pegawai__jk);
$smarty->assign ("EDIT_R_PEGAWAI__KTP",$edit_r_pegawai__ktp);
$smarty->assign ("EDIT_R_PEGAWAI__SIM",$edit_r_pegawai__sim);
$smarty->assign ("EDIT_R_PEGAWAI__KTP_PROV",$edit_r_pegawai__ktp_prov);
$smarty->assign ("EDIT_R_PEGAWAI__KTP_KAB",$edit_r_pegawai__ktp_kab);
$smarty->assign ("EDIT_R_PEGAWAI__KTP_KEC",$edit_r_pegawai__ktp_kec);
$smarty->assign ("EDIT_R_PEGAWAI__KTP_DESA",$edit_r_pegawai__ktp_desa);
$smarty->assign ("EDIT_R_PEGAWAI__KTP_RT",$edit_r_pegawai__ktp_rt);
$smarty->assign ("EDIT_R_PEGAWAI__KTP_RW",$edit_r_pegawai__ktp_rw);
$smarty->assign ("EDIT_R_PEGAWAI__KTP_KODEPOS",$edit_r_pegawai__ktp_kodepos);
$smarty->assign ("EDIT_R_PEGAWAI__ALM_PROV",$edit_r_pegawai__alm_prov);
$smarty->assign ("EDIT_R_PEGAWAI__ALM_KAB",$edit_r_pegawai__alm_kab);
$smarty->assign ("EDIT_R_PEGAWAI__ALM_KEC",$edit_r_pegawai__alm_kec);
$smarty->assign ("EDIT_R_PEGAWAI__ALM_DESA",$edit_r_pegawai__alm_desa);
$smarty->assign ("EDIT_R_PEGAWAI__ALM_RT",$edit_r_pegawai__alm_rt);
$smarty->assign ("EDIT_R_PEGAWAI__ALM_RW",$edit_r_pegawai__alm_rw);
$smarty->assign ("EDIT_R_PEGAWAI__ALM_KODEPOS",$edit_r_pegawai__alm_kodepos);
$smarty->assign ("EDIT_R_PEGAWAI__TLP_RUMAH",$edit_r_pegawai__tlp_rumah);
$smarty->assign ("EDIT_R_PEGAWAI__TLP_PRIBADI",$edit_r_pegawai__tlp_pribadi);
$smarty->assign ("EDIT_R_PEGAWAI__TLP_KANTOR",$edit_r_pegawai__tlp_kantor);
$smarty->assign ("EDIT_R_PEGAWAI__GOL_DARAH",$edit_r_pegawai__gol_darah);
$smarty->assign ("EDIT_R_PEGAWAI__AGAMA",$edit_r_pegawai__agama);
$smarty->assign ("EDIT_R_PEGAWAI__TINGGI",$edit_r_pegawai__tinggi);
$smarty->assign ("EDIT_R_PEGAWAI__BERAT",$edit_r_pegawai__berat);
$smarty->assign ("EDIT_R_PEGAWAI__AYAH",$edit_r_pegawai__ayah);
$smarty->assign ("EDIT_R_PEGAWAI__IBU",$edit_r_pegawai__ibu);
$smarty->assign ("EDIT_R_PEGAWAI__ORTU_PROV",$edit_r_pegawai__ortu_prov);
$smarty->assign ("EDIT_R_PEGAWAI__ORTU_KAB",$edit_r_pegawai__ortu_kab);
$smarty->assign ("EDIT_R_PEGAWAI__ORTU_KEC",$edit_r_pegawai__ortu_kec);
$smarty->assign ("EDIT_R_PEGAWAI__ORTU_DESA",$edit_r_pegawai__ortu_desa);
$smarty->assign ("EDIT_R_PEGAWAI__ORTU_RT",$edit_r_pegawai__ortu_rt);
$smarty->assign ("EDIT_R_PEGAWAI__ORTU_RW",$edit_r_pegawai__ortu_rw);
$smarty->assign ("EDIT_R_PEGAWAI__ORTU_KODEPOS",$edit_r_pegawai__ortu_kodepos);
$smarty->assign ("EDIT_R_PEGAWAI__NPWP",$edit_r_pegawai__npwp);
$smarty->assign ("EDIT_BPJS_KETENAGAKERJAAN",$edit_r_pegawai__no_bpjs);
$smarty->assign ("EDIT_R_PEGAWAI__NO_ASKES",$edit_r_pegawai__no_askes);
$smarty->assign ("EDIT_R_PEGAWAI__BANK1",$edit_r_pegawai__bank1);
$smarty->assign ("EDIT_R_PEGAWAI__BANK1_REK",$edit_r_pegawai__bank1_rek);
$smarty->assign ("EDIT_R_PEGAWAI__BANK1_NOREK",$edit_r_pegawai__bank1_norek);
$smarty->assign ("EDIT_R_PEGAWAI__BANK1_ALM",$edit_r_pegawai__bank1_alm);
$smarty->assign ("EDIT_R_PEGAWAI__BANK2",$edit_r_pegawai__bank2);
$smarty->assign ("EDIT_R_PEGAWAI__BANK2_REK",$edit_r_pegawai__bank2_rek);
$smarty->assign ("EDIT_R_PEGAWAI__BANK2_NOREK",$edit_r_pegawai__bank2_norek);
$smarty->assign ("EDIT_R_PEGAWAI__BANK2_ALM",$edit_r_pegawai__bank2_alm);
$smarty->assign ("EDIT_R_PEGAWAI__PASANGAN",$edit_r_pegawai__pasangan);
$smarty->assign ("EDIT_R_PEGAWAI__PAS_TGLLAHIR",$edit_r_pegawai__pas_tgllahir);
$smarty->assign ("EDIT_R_PEGAWAI__PAS_TMPTLAHIR",$edit_r_pegawai__pas_tmptlahir);
$smarty->assign ("EDIT_R_PEGAWAI__PAS_PROV",$edit_r_pegawai__pas_prov);
$smarty->assign ("EDIT_R_PEGAWAI__PAS_KAB",$edit_r_pegawai__pas_kab);
$smarty->assign ("EDIT_R_PEGAWAI__PAS_KEC",$edit_r_pegawai__pas_kec);
$smarty->assign ("EDIT_R_PEGAWAI__PAS_DESA",$edit_r_pegawai__pas_desa);
$smarty->assign ("EDIT_R_PEGAWAI__PAS_RT",$edit_r_pegawai__pas_rt);
$smarty->assign ("EDIT_R_PEGAWAI__PAS_RW",$edit_r_pegawai__pas_rw);
$smarty->assign ("EDIT_R_PEGAWAI__PAS_KODEPOS",$edit_r_pegawai__pas_kodepos);
$smarty->assign ("EDIT_R_PEGAWAI__PAS_TLP",$edit_r_pegawai__pas_tlp);
$smarty->assign ("EDIT_R_PEGAWAI__PAS_JML_ANAK",$edit_r_pegawai__pas_jml_anak);
$smarty->assign ("EDIT_R_PEGAWAI__PAS_ANAK1",$edit_r_pegawai__pas_anak1);
$smarty->assign ("EDIT_R_PEGAWAI__PAS_ANAK2",$edit_r_pegawai__pas_anak2);
$smarty->assign ("EDIT_R_PEGAWAI__PAS_ANAK3",$edit_r_pegawai__pas_anak3);


$path_gambar = explode('_', $edit_r_pegawai__photo);
$foto_no  = $path_gambar[0];
$foto_name= $path_gambar[1];

IF($edit_r_pegawai__photo=='' OR $edit_r_pegawai__photo=='-')
    {
        $true=0;
        $foto_name='images.png';
        $smarty->assign ("ADA_IMAGE",$true);   
        $smarty->assign ("FOTO_NAME",$foto_name);
    }  else {
        $true=1;
        $smarty->assign ("ADA_IMAGE",$true);   
        $smarty->assign ("FOTO_NO",$foto_no);   
        $smarty->assign ("FOTO_NAME",$edit_r_pegawai__photo);
    }
 


$smarty->assign ("EDIT_R_PEGAWAI__STATUS_KAWIN",$edit_r_pegawai__status_kawin);
$smarty->assign ("EDIT_R_PEGAWAI__TGL_MASUK",$edit_r_pegawai__tgl_masuk);
$smarty->assign ("EDIT_R_PEGAWAI__ID_SUBCAB",$edit_r_pegawai__id_subcab);
$smarty->assign ("EDIT_BPJS_KESEHATAN",$edit_r_pegawai__subdept);
$smarty->assign ("EDIT_R_PEGAWAI__JABATAN",$edit_r_pegawai__jabatan);
$smarty->assign ("EDIT_R_PEGAWAI__ST_PEGAWAI",$edit_r_pegawai__st_pegawai);
$smarty->assign ("EDIT_R_PEGAWAI__TGL_PENGANGKATAN",$edit_r_pegawai__tgl_pengangkatan);
$smarty->assign ("EDIT_R_PEGAWAI__TGL_LULUS",$edit_r_pegawai__pend_tgl_lulus);
$smarty->assign ("EDIT_R_PEGAWAI__PEND_AKHIR",$edit_r_pegawai__pend_akhir);
$smarty->assign ("EDIT_R_PEGAWAI__PEND_SEKOLAH",$edit_r_pegawai__pend_sekolah);
$smarty->assign ("EDIT_R_PEGAWAI__PEND_JURUSAN",$edit_r_pegawai__pend_jurusan);
$smarty->assign ("EDIT_R_PEGAWAI__DATE_CREATED",$edit_r_pegawai__date_created);
$smarty->assign ("EDIT_R_PEGAWAI__DATE_UPDATED",$edit_r_pegawai__date_updated);
$smarty->assign ("EDIT_R_PEGAWAI__USER_CREATED",$edit_r_pegawai__user_created);
$smarty->assign ("EDIT_R_PEGAWAI__USER_UPDATED",$edit_r_pegawai__user_updated);
$smarty->assign ("EDIT_R_PEGAWAI__ALAMAT", $edit_r_pegawai__nama_jalan);
$smarty->assign ("EDIT_VAL", $edit);
//-----------------------CLOSE VIEW EDIT----------------------------------------------------------------------------------//


       
//----------------EDIT DATA KABUPATEN KTP---------------------//	
   
        $sql_kabupaten_ktp = "SELECT * FROM r_kabupaten where r_kabupaten__id='".$edit_r_pegawai__ktp_kab."' ORDER BY r_kabupaten__id ASC ";
        $result_kabupaten_ktp = $db->Execute($sql_kabupaten_ktp);
        $initSet = array();
        $data_kabupaten_ktp = array();
        $z=0;
        while ($arr=$result_kabupaten_ktp->FetchRow()) {
        array_push($data_kabupaten_ktp, $arr);
        array_push($initSet, $z);
        $z++;
        }
        $smarty->assign ("DATA_KABUPATEN_KTP", $data_kabupaten_ktp);
      
//----------------CLOSE EDIT DATA KABUPATEN---------------------------------//
	
//----------------EDIT DATA KECAMATAN---------------------------------------//	
        $sql_kecamatan = "SELECT
                        C.r_kecamatan__id,
                        C.r_kecamatan__kabupaten_id,
                        C.r_kecamatan__nama
                        FROM
                            r_kecamatan C
                        WHERE
                          C.r_kecamatan__id = '".$edit_r_pegawai__ktp_kec."' ";
      
        $result_kecamatan = $db->Execute($sql_kecamatan);
        $initSet = array();
        $data_kecamatan_ktp = array();
        $z=0;
        while ($arr=$result_kecamatan->FetchRow()) {
        array_push($data_kecamatan_ktp, $arr);
        array_push($initSet, $z);
        $z++;
        }
        $smarty->assign ("DATA_KECAMATAN_KTP", $data_kecamatan_ktp);

//----------------CLOSE EDIT DATA KECAMATAN-------------//	
        
//----------------EDIT DATA DESA KTP-------------------//
       $sql_desa= "SELECT
                            A.r_desa__id,
                            A.r_desa__kecamatan_id,
                            A.r_desa__nama,
                            A.r_desa__sts
                      FROM
                        r_wilayah A
                        LEFT JOIN r_kecamatan B ON A.r_desa__kecamatan_id=B.r_kecamatan__id 
                      WHERE
                        A.r_desa__id = '".$edit_r_pegawai__ktp_desa."' AND B.r_kecamatan__id='".$edit_r_pegawai__ktp_kec."' ";
      
        $result_desa = $db->Execute($sql_desa);  
        $initSet = array();
        $data_desa_ktp = array();
        $z=0;
        while ($arr=$result_desa->FetchRow()) {
        array_push($data_desa_ktp, $arr);
        array_push($initSet, $z);
        $z++;
        }
        $smarty->assign ("DATA_DESA_KTP", $data_desa_ktp);
      
//----------------CLOSE DATA DESA KTP---------------------//        
       
        
//----------------DATA KABUPATEN ALM---------------------//	
      
        $sql_kabupaten_alm = "SELECT * FROM r_kabupaten where r_kabupaten__id='".$edit_r_pegawai__alm_kab."' ORDER BY r_kabupaten__id ASC ";
        $result_kabupaten_alm = $db->Execute($sql_kabupaten_alm);
        $initSet = array();
        $data_kabupaten_alm = array();
        $z=0;
        while ($arr=$result_kabupaten_alm->FetchRow()) {
        array_push($data_kabupaten_alm, $arr);
        array_push($initSet, $z);
        $z++;
        }
        $smarty->assign ("DATA_KABUPATEN_ALM", $data_kabupaten_alm);
      
//----------------CLOSE DATA KABUPATEN ALM---------------------------------//      
        
 //----------------DATA EDIT KECAMATAN ALM---------------------------------//	
      
         $sql_kecamatan_alm = "SELECT
                        C.r_kecamatan__id,
                        C.r_kecamatan__kabupaten_id,
                        C.r_kecamatan__nama
                        FROM
                            r_kecamatan C
                        WHERE
                          C.r_kecamatan__id = '".$edit_r_pegawai__alm_kec."' ";
        
       
        $result_kecamatan_alm = $db->Execute($sql_kecamatan_alm);
        $initSet = array();
        $data_kecamatan_alm= array();
        $z=0;
        while ($arr=$result_kecamatan_alm->FetchRow()) {
        array_push($data_kecamatan_alm, $arr);
        array_push($initSet, $z);
        $z++;
        }
        $smarty->assign ("DATA_KECAMATAN_ALM", $data_kecamatan_alm);

//----------------CLOSE EDIT DATA KECAMATAN ALM-----------------------------------//	       
//
 //---------------- DATA EDIT DESA ALM---------------------------------------------//
       $sql_desa_alm= "SELECT
                            A.r_desa__id,
                            A.r_desa__kecamatan_id,
                            A.r_desa__nama,
                            A.r_desa__sts
                      FROM
                        r_wilayah A
                        LEFT JOIN r_kecamatan B ON A.r_desa__kecamatan_id=B.r_kecamatan__id 
                      WHERE
                        A.r_desa__id = '".$edit_r_pegawai__alm_desa."' AND B.r_kecamatan__id='".$edit_r_pegawai__alm_kec."' ";
      
 
        $result_desa_alm = $db->Execute($sql_desa_alm);  
        $initSet = array();
        $data_desa_alm = array();
        $z=0;
        while ($arr=$result_desa_alm->FetchRow()) {
        array_push($data_desa_alm, $arr);
        array_push($initSet, $z);
        $z++;
        }
        $smarty->assign ("DATA_DESA_ALM", $data_desa_alm);
      
//------------------- CLOSE EDIT DATA DESA ALM---------------------------------//    



//------------------- DATA EDIT KABUPATEN ORTU -----------------------------//  
        $sql_kabupaten_ortu = "SELECT * FROM r_kabupaten where r_kabupaten__id='".$edit_r_pegawai__ortu_kab."' ORDER BY r_kabupaten__id ASC ";
         
        $result_kabupaten_ortu = $db->Execute($sql_kabupaten_ortu);
        $initSet = array();
        $data_kabupaten_ortu = array();
        $z=0;
        while ($arr=$result_kabupaten_ortu->FetchRow()) {
        array_push($data_kabupaten_ortu, $arr);
        array_push($initSet, $z);
        $z++;
        }
        $smarty->assign ("DATA_KABUPATEN_ORTU", $data_kabupaten_ortu);    
//------------------- CLOSE EDIT DATA KABUPATEN ORTU  -----------------------------//  
        
//------------------- DATA EDIT KECAMATAN ORTU  -----------------------------// 
        $sql_kecamatan_ortu = "SELECT
                        C.r_kecamatan__id,
                        C.r_kecamatan__kabupaten_id,
                        C.r_kecamatan__nama
                        FROM
                            r_kecamatan C
                        WHERE
                          C.r_kecamatan__id = '".$edit_r_pegawai__ortu_kec."' ";
        
       
        $result_kecamatan_ortu = $db->Execute($sql_kecamatan_ortu);
        $initSet = array();
        $data_kecamatan_ortu= array();
        $z=0;
        while ($arr=$result_kecamatan_ortu->FetchRow()) {
        array_push($data_kecamatan_ortu, $arr);
        array_push($initSet, $z);
        $z++;
        }
        $smarty->assign ("DATA_KECAMATAN_ORTU", $data_kecamatan_ortu);
//------------------- CLOSE EDIT KECAMATAN ORTU  ----------------------//  

        
//------------------- DATA EDIT DESA ORTU  -----------------------------//     
$sql_desa_ortu= "SELECT
                            A.r_desa__id,
                            A.r_desa__kecamatan_id,
                            A.r_desa__nama,
                            A.r_desa__sts
                      FROM
                        r_wilayah A
                        LEFT JOIN r_kecamatan B ON A.r_desa__kecamatan_id=B.r_kecamatan__id 
                      WHERE
                        A.r_desa__id = '".$edit_r_pegawai__ortu_desa."' AND B.r_kecamatan__id='".$edit_r_pegawai__ortu_kec."' ";
      

        $result_desa_ortu = $db->Execute($sql_desa_ortu);  
        $initSet = array();
        $data_desa_ortu = array();
        $z=0;
        while ($arr=$result_desa_ortu->FetchRow()) {
        array_push($data_desa_ortu, $arr);
        array_push($initSet, $z);
        $z++;
        }
        $smarty->assign ("DATA_DESA_ORTU", $data_desa_ortu);
     
//------------------- CLOSE EDIT DESA ORTU -----------------------------//     
 
        
//------------------- EDIT DATA KABUPATEN PASANGAN -----------------------------//  
 $sql_kabupaten_pas = "SELECT * FROM r_kabupaten where r_kabupaten__id='".$edit_r_pegawai__pas_kab."' ORDER BY r_kabupaten__id ASC ";
 $result_kabupaten_pas= $db->Execute($sql_kabupaten_pas);
 $initSet = array();
 $data_kabupaten_pas = array();
 $z=0;
    while ($arr=$result_kabupaten_pas->FetchRow()) {
    array_push($data_kabupaten_pas, $arr);
    array_push($initSet, $z);
    $z++;
    }
$smarty->assign ("DATA_KABUPATEN_PAS", $data_kabupaten_pas);   
 
//------------------- CLOSE DATA KABUPATEN PASANGAN  -----------------------------// 
        
////------------------- DATA KECAMATAN PASANGAN-----------------------------// 
        $sql_kecamatan_pas = "SELECT
                        C.r_kecamatan__id,
                        C.r_kecamatan__kabupaten_id,
                        C.r_kecamatan__nama
                        FROM
                            r_kecamatan C
                        WHERE
                          C.r_kecamatan__id = '".$edit_r_pegawai__pas_kec."' ";
       // var_dump($sql_kecamatan_pas) or die();
        $result_kecamatan_pas = $db->Execute($sql_kecamatan_pas);
        $initSet = array();
        $data_kecamatan_pas= array();
        $z=0;
        while ($arr=$result_kecamatan_pas->FetchRow()) {
        array_push($data_kecamatan_pas, $arr);
        array_push($initSet, $z);
        $z++;
        }
        $smarty->assign ("DATA_KECAMATAN_PAS", $data_kecamatan_pas);
       
//--------------------- CLOSE KECAMATAN PASANGAN  -----------------------------//         

//------------------- DATA EDIT DESA PASANGAN  -----------------------------//     
$sql_desa_pas= "SELECT
                            A.r_desa__id,
                            A.r_desa__kecamatan_id,
                            A.r_desa__nama,
                            A.r_desa__sts
                      FROM
                        r_wilayah A
                        LEFT JOIN r_kecamatan B ON A.r_desa__kecamatan_id=B.r_kecamatan__id 
                      WHERE
                        A.r_desa__id = '".$edit_r_pegawai__pas_desa."' AND B.r_kecamatan__id='".$edit_r_pegawai__pas_kec."' ";
      
 
        $result_desa_pas = $db->Execute($sql_desa_pas);  
        $initSet = array();
        $data_desa_pas = array();
        $z=0;
        while ($arr=$result_desa_pas->FetchRow()) {
        array_push($data_desa_pas, $arr);
        array_push($initSet, $z);
        $z++;
        }
        $smarty->assign ("DATA_DESA_PAS", $data_desa_pas);
//------------------- CLOSE EDIT DESA PASANGAN -----------------------------//        
        
        

        
        
        

//$tahun = now();
 //var_dump($nama_pegawai_cari)or die();
//-----------------------------------------VIEW INDEX---------------------------------------------------------------------//
if ($_GET['search'] == '1')
    {
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
 
		  if($jenis_user=='2'){

                            $sql  = "SELECT  CASE B.r_pnpt__no_mutasi
					WHEN (SELECT r_resign.r_resign__mutasi
					FROM r_resign WHERE r_resign.r_resign__mutasi = B.r_pnpt__no_mutasi
					AND r_resign__approval = 1
					) THEN '0' ELSE'1'
					END ket_resign,	B.*  FROM (SELECT 
                                       r_jabatan.*,r_subdepartement.*,r_departement.*,r_subcabang.*,r_cabang.*,r_kecamatan.*,r_kabupaten.*,r_provinsi.*,
                                        A.*
                                         FROM (SELECT r_penempatan .*,r_pegawai.* FROM r_penempatan
                                        INNER JOIN r_pegawai ON r_pegawai.r_pegawai__id = r_penempatan.r_pnpt__id_pegawai
                                        ORDER BY r_penempatan.r_pnpt__date_updated DESC )A
                                        INNER JOIN r_jabatan ON A.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                        INNER JOIN r_subdepartement ON A.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                        INNER JOIN r_subcabang ON  r_subcabang.r_subcab__id = A.r_pnpt__subcab
                                        INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                        INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                        INNER JOIN r_status_pegawai ON r_status_pegawai.r_stp__id = A.r_pnpt__status
                                        INNER JOIN r_provinsi ON r_provinsi.r_provinsi__id = r_pegawai__ktp_prov
                                        INNER JOIN r_kabupaten ON r_kabupaten.r_kabupaten__id = r_pegawai__ktp_kab
                                        INNER JOIN r_kecamatan ON r_kecamatan.r_kecamatan__id = r_pegawai__ktp_kec
                                        INNER JOIN r_wilayah ON r_wilayah.r_desa__id = r_pegawai__ktp_desa
                                        INNER JOIN r_agama ON r_agama.r_agama__id = r_pegawai__agama
                                        GROUP BY A.r_pegawai__id)B
                                        where B.r_cabang__id= '".$kode_pw_ses."'";
			} else {
                            $sql  = "SELECT  CASE B.r_pnpt__no_mutasi
					WHEN (SELECT r_resign.r_resign__mutasi
					FROM r_resign WHERE r_resign.r_resign__mutasi = B.r_pnpt__no_mutasi
					AND r_resign__approval = 1
					) THEN '0' ELSE'1'
					END ket_resign,	B.*  FROM (SELECT 
                                    	r_jabatan.*,r_subdepartement.*,r_departement.*,r_subcabang.*,r_cabang.*,r_kecamatan.*,r_kabupaten.*,r_provinsi.*,
                                        A.*
                                         FROM (SELECT r_penempatan .*,r_pegawai.* FROM r_penempatan
                                        INNER JOIN r_pegawai ON r_pegawai.r_pegawai__id = r_penempatan.r_pnpt__id_pegawai
                                        ORDER BY r_penempatan.r_pnpt__date_updated DESC )A
                                        INNER JOIN r_jabatan ON A.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                        INNER JOIN r_subdepartement ON A.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                        INNER JOIN r_subcabang ON  r_subcabang.r_subcab__id = A.r_pnpt__subcab
                                        INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                        INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                        INNER JOIN r_status_pegawai ON r_status_pegawai.r_stp__id = A.r_pnpt__status
                                        INNER JOIN r_provinsi ON r_provinsi.r_provinsi__id = r_pegawai__ktp_prov
                                        INNER JOIN r_kabupaten ON r_kabupaten.r_kabupaten__id = r_pegawai__ktp_kab
                                        INNER JOIN r_kecamatan ON r_kecamatan.r_kecamatan__id = r_pegawai__ktp_kec
                                        INNER JOIN r_wilayah ON r_wilayah.r_desa__id = r_pegawai__ktp_desa
                                        INNER JOIN r_agama ON r_agama.r_agama__id = r_pegawai__agama
                                        GROUP BY A.r_pegawai__id)B
                                        where 1=1";	

			}
 
				//echo "<br><br><br><br><br><br><br><br><br><br>dddddddddkode_perwakilan_cari ===".$kode_perwakilan_cari;
                                if($kode_cabang_cari !=''){
					$sql .= " AND B.r_cabang__id = '".$kode_cabang_cari."' ";
				}
				if($kode_subcab_cari !=''){
					$sql .= " AND B.r_subcab__id = '".$kode_subcab_cari."' "; 
				}

				if( $departemen_cari!=''){
					$sql .= " AND B.r_dept__id = '".$departemen_cari."' ";
				} 
                                if($nama_pegawai_cari_!=''){
					
                                        $sql .= " AND B.r_pegawai__nama LIKE '%".addslashes($nama_pegawai_cari_)."%'";
				} 
                                 if($finger_pegawai_cari!=''){
					
                                        $sql .= " AND B.r_pnpt__finger_print ='".$finger_pegawai_cari."'";
				} 
				  if($ktp_cari!=''){
					
                                        $sql .= " AND B.r_pegawai__ktp ='".$ktp_cari."'";
				} 


				$sql .= " GROUP BY B.r_pegawai__id ORDER BY B.r_pegawai__id asc  ";

                    if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);


				$numresults=$db->Execute($sql);
				$count = $numresults->RecordCount();

//				$pages = $p->findPages($count,$LIMIT); 
//         			$sql  .= "LIMIT ".$start.", ".$LIMIT;
                                
				$recordSet = $db->Execute($sql);
			
				$end = $recordSet->RecordCount();
				$initSet = array();
				$data_tb = array();
				$row_class = array();
				$z=0;
                                 $count_no = 1;
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
                                         $count_no=$count_no+1;
				}

				$count_view = $start+1;
//				$count_all  = $start+$end;
//				$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 
}

}
else
    
{
				

			if($jenis_user=='2'){

                                                
                                                $sql =  "SELECT  CASE B.r_pnpt__no_mutasi
					WHEN (SELECT r_resign.r_resign__mutasi
					FROM r_resign WHERE r_resign.r_resign__mutasi = B.r_pnpt__no_mutasi
					AND r_resign__approval = 1
					) THEN '0' ELSE'1'
					END ket_resign,	B.* FROM (SELECT 
                                       	r_jabatan.*,r_subdepartement.*,r_departement.*,r_subcabang.*,r_cabang.*,r_kecamatan.*,r_kabupaten.*,r_provinsi.*,
                                        A.*
                                         FROM (SELECT r_penempatan .*,r_pegawai.* FROM r_penempatan
                                        INNER JOIN r_pegawai ON r_pegawai.r_pegawai__id = r_penempatan.r_pnpt__id_pegawai
                                        ORDER BY r_penempatan.r_pnpt__date_updated DESC )A
                                        INNER JOIN r_jabatan ON A.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                        INNER JOIN r_subdepartement ON A.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                        INNER JOIN r_subcabang ON  r_subcabang.r_subcab__id = A.r_pnpt__subcab
                                        INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                        INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                        INNER JOIN r_status_pegawai ON r_status_pegawai.r_stp__id = A.r_pnpt__status
                                        INNER JOIN r_provinsi ON r_provinsi.r_provinsi__id = r_pegawai__ktp_prov
                                        INNER JOIN r_kabupaten ON r_kabupaten.r_kabupaten__id = r_pegawai__ktp_kab
                                        INNER JOIN r_kecamatan ON r_kecamatan.r_kecamatan__id = r_pegawai__ktp_kec
                                        INNER JOIN r_wilayah ON r_wilayah.r_desa__id = r_pegawai__ktp_desa
                                        INNER JOIN r_agama ON r_agama.r_agama__id = r_pegawai__agama
                                        GROUP BY A.r_pegawai__id)B
                                        where B.r_cabang__id = '".$kode_pw_ses."'";
                                            

			} else {
                                $sql  = "SELECT  CASE B.r_pnpt__no_mutasi
					WHEN (SELECT r_resign.r_resign__mutasi
					FROM r_resign WHERE r_resign.r_resign__mutasi = B.r_pnpt__no_mutasi
					AND r_resign__approval = 1
					) THEN '0' ELSE'1'
					END ket_resign,	
					B.* FROM (SELECT 
                                       	r_jabatan.*,r_subdepartement.*,r_departement.*,r_subcabang.*,r_cabang.*,r_kecamatan.*,r_kabupaten.*,r_provinsi.*,
                                        A.*
                                         FROM (SELECT r_penempatan .*,r_pegawai.* FROM r_penempatan
                                        INNER JOIN r_pegawai ON r_pegawai.r_pegawai__id = r_penempatan.r_pnpt__id_pegawai
                                        ORDER BY r_penempatan.r_pnpt__date_updated DESC )A
                                        INNER JOIN r_jabatan ON A.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                        INNER JOIN r_subdepartement ON A.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                        INNER JOIN r_subcabang ON  r_subcabang.r_subcab__id = A.r_pnpt__subcab
                                        INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                        INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                        INNER JOIN r_status_pegawai ON r_status_pegawai.r_stp__id = A.r_pnpt__status
                                        INNER JOIN r_provinsi ON r_provinsi.r_provinsi__id = r_pegawai__ktp_prov
                                        INNER JOIN r_kabupaten ON r_kabupaten.r_kabupaten__id = r_pegawai__ktp_kab
                                        INNER JOIN r_kecamatan ON r_kecamatan.r_kecamatan__id = r_pegawai__ktp_kec
                                        INNER JOIN r_wilayah ON r_wilayah.r_desa__id = r_pegawai__ktp_desa
                                        INNER JOIN r_agama ON r_agama.r_agama__id = r_pegawai__agama
                                        GROUP BY A.r_pegawai__id)B
                                         where B.r_cabang__id = '1'"; 	

			}
                
                                if($kode_cabang_cari !=''){
					$sql .= " AND r_cabang__id = '".$kode_cabang_cari."' ";
				}
				if($kode_subcab_cari !=''){
					$sql .= " AND B.r_subcab__id = '".$kode_subcab_cari."' "; 
				}
				if( $departemen_cari!=''){
					$sql .= " AND B.r_dept__id = '".$departemen_cari."' ";
				} 
                                if($nama_pegawai_cari_!=''){
					
                                        $sql .= " AND B.r_pegawai__nama LIKE '%".addslashes($nama_pegawai_cari_)."%'";
				} 
                                 if($finger_pegawai_cari!=''){
					
                                        $sql .= " AND B.r_pnpt__finger_print ='".$finger_pegawai_cari."'";
				} 
                                 if($ktp_cari!=''){
					
                                        $sql .= " AND B.r_pegawai__ktp ='".$ktp_cari."'";
				} 
                                
                            $sql .= "  GROUP BY B.r_pegawai__id ORDER BY B.r_pegawai__id asc ";
 
				if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);


                                $numresults=$db->Execute($sql);
				$count = $numresults->RecordCount();
//				$pages = $p->findPages($count,$LIMIT); 
//				$sql  .= "LIMIT ".$start.", ".$LIMIT;
				
				$recordSet = $db->Execute($sql);
				$end = $recordSet->RecordCount();
				$initSet = array();
				$data_tb = array();
				$row_class = array();
				$z=0;
                                 $count_no = 1;
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
                                         $count_no=$count_no+1;
				}

				$count_view = $start+1;
//				$count_all  = $start+$end;
//				$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 
}
//---------------------------------CLOSE VIEW INDEX---------------------------------------------------------------------//

$smarty->assign ("NO_URUT", $count_no); 
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