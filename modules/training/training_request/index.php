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

$jenis_user   =  $_SESSION['SESSION_JNS_USER'];
$kode_pw_ses  = $_SESSION['SESSION_KODE_CABANG'];
$tahun_ses_aktif=$_SESSION['SESSION_TAHUN_AKTIF'];
$bulan_ses_aktif=$_SESSION['SESSION_BULAN_AKTIF'];
$smarty->assign ("TAHUN_SES", $tahun_ses_aktif);
$smarty->assign ("BULAN_SES", $bulan_ses_aktif);
 

$smarty->assign ("JENIS_USER_SES", $jenis_user);
$smarty->assign ("KODE_PW_SES", $kode_pw_ses);

//echo "JENIS USER".$_SESSION['SESSION_JNS_USER'];
//echo "<br>KODE PERWAKILAN".$_SESSION['SESSION_KODE_PERWAKILAN'];

#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);
$smarty->assign ("HREF_HOME_PATH_AJAX", $HREF_HOME.'/modules/training/training_request');
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/training/training_request';
#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/training');
$FILE_JS  = $JS_MODUL.'/training_request';

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
$tbl_name	= "r_master_pelatihan";

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

if ($_GET['bulan']) $bulan = $_GET['bulan'];
else if ($_POST['bulan']) $bulan = $_POST['bulan'];
else $bulan="";

if ($_GET['tahun']) $tahun = $_GET['tahun'];
else if ($_POST['tahun']) $tahun = $_POST['tahun'];
else $tahun="";


if ($_GET['nama_cari']) $nama_pegawai_cari = $_GET['nama_cari'];
else if ($_POST['nama_cari']) $nama_pegawai_cari = $_POST['nama_cari'];
else $nama_pegawai_cari="";


if ($_GET['bidang_cari']) $bidang_cari = $_GET['bidang_cari'];
else if ($_POST['bidang_cari']) $bidang_cari = $_POST['bidang_cari'];
else $bidang_cari="";

if ($_GET['status_cari']) $status_cari= $_GET['status_cari'];
else if ($_POST['status_cari']) $status_cari = $_POST['status_cari'];
else $status_cari="";



$smarty->assign ("BIDANG_CARI", $bidang_cari);
$smarty->assign ("NAMA_CARI", $nama_cari);
$smarty->assign ("KODE_SUBCAB_CARI", $kode_subcab_cari);



$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_perwakilan_cari=".$kode_subcab_cari."&kode_subcab_cari=".$kode_subcab_cari;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;

//echo "<br><br><br><br><br><br><br><br><br><br>kode_perwakilan_cari".$kode_perwakilan_cari;
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
$curren_month=date("m");
$current_year=date("Y");


$array1=explode("-",$current_year);
$tahun_masuk    =   $array1[0];
$bulan_masuk    =   $array1[1];
$tgl_masuk      =   $array1[2];

$tahun_pinjam= substr($tahun_masuk,2,4);



$sql_cek_no="SELECT count(A.r_mastpel__id) as no_pel FROM r_master_pelatihan A";

$rs_val = $db->Execute($sql_cek_no);

$no_pel= $rs_val->fields[no_pel];

$idMax = $no_pel;
$idMax++;
$newID =($idMax);

$smarty->assign ("ID_PELATIHAN", $newID);


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



//-------------DATA JENIS PINJAMAN---------------------------------//
$sql_pinjaman = "SELECT  r_ang__id,r_ang__jenis,r_ang__platfond FROM r_angsuran";
//var_dump($sql_pinjaman)or die();
$result_pinjaman = $db->Execute($sql_pinjaman);
$initSet = array();
$data_pinjaman = array();
$z=0;
while ($arr=$result_pinjaman->FetchRow()) {
	array_push($data_pinjaman, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PINJAMAN", $data_pinjaman);


//-------------DATA JENIS PINJAMAN---------------------------------//




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
            B.r_mastpel__id AS r_mastpel__id,
            B.r_mastpel__mutasi AS r_mastpel__mutasi,
            B.r_mastpel__email_pic AS r_mastpel__email_pic,
            B.r_mastpel__tema AS r_mastpel__tema,
            B.r_mastpel__tgl_awal AS r_mastpel__tgl_awal,
            B.r_mastpel__tgl_akhir AS r_mastpel__tgl_akhir,
            B.r_mastpel__penyelenggara AS r_mastpel__penyelenggara,
            B.r_mastpel__jenis AS r_mastpel__jenis,
            B.r_mastpel__deskripsi AS r_mastpel__deskripsi,
            B.r_mastpel__tempat AS r_mastpel__tempat,
            B.r_mastpel__status AS r_mastpel__status,
            peg.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
            peg.r_pnpt__nip AS r_pnpt__nip,
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
            peg.r_pegawai__nama AS r_pegawai__nama
    FROM
            v_pegawai peg
    INNER JOIN r_master_pelatihan B ON peg.r_pnpt__no_mutasi = B.r_mastpel__mutasi
    WHERE r_pnpt__aktif = 1 AND r_mastpel__id='".$_GET['id']."' ";
       
       
$resultSet = $db->Execute($sql_);
$edit_r_mastpel__id=$resultSet->fields[r_mastpel__id];
$edit_r_mastpel__mutasi=$resultSet->fields[r_mastpel__mutasi];
$edit_r_mastpel__email_pic=$resultSet->fields[r_mastpel__email_pic];
$edit_r_mastpel__tema=$resultSet->fields[r_mastpel__tema];
$edit_r_mastpel__tgl_awal=$resultSet->fields[r_mastpel__tgl_awal];
$edit_r_mastpel__tgl_akhir=$resultSet->fields[r_mastpel__tgl_akhir];
$edit_r_mastpel__penyelenggara=$resultSet->fields[r_mastpel__penyelenggara];
$edit_r_mastpel__jenis=$resultSet->fields[r_mastpel__jenis];
$edit_r_mastpel__deskripsi=$resultSet->fields[r_mastpel__deskripsi];
$edit_r_mastpel__tempat=$resultSet->fields[r_mastpel__tempat];
$edit_r_mastpel__status=$resultSet->fields[r_mastpel__status];
$edit_r_pnpt__nip = $resultSet->fields[r_pnpt__nip];
$edit_r_jabatan__ket = $resultSet->fields[r_jabatan__ket];
$edit_r_cabang__id=$resultSet->fields[r_cabang__id];
$edit_r_cabang__nama=$resultSet->fields[r_cabang__nama];
$edit_r_pnpt__no_mutasi=$resultSet->fields[r_pnpt__no_mutasi];
$edit_r_pegawai__id=$resultSet->fields[r_pegawai__id];
$edit_r_pegawai__nama=$resultSet->fields[r_pegawai__nama];                               
$edit = 1;

}

//----------------CLOSE EDIT---------------------//

$smarty->assign ("OPT", $opt);
$smarty->assign ("EDIT_ID",$edit_id);
$smarty->assign ("EDIT_PEL_ID",$edit_r_mastpel__id); 
$smarty->assign ("EDIT_PEL_MUTASI",$edit_r_mastpel__mutasi);
$smarty->assign ("EDIT_EMAIL",$edit_r_mastpel__email_pic);
$smarty->assign ("EDIT_TEMA",$edit_r_mastpel__tema);
$smarty->assign ("EDIT_TGL_AWAL",$edit_r_mastpel__tgl_awal);
$smarty->assign ("EDIT_TGL_AKHIR",$edit_r_mastpel__tgl_akhir);
$smarty->assign ("EDIT_PENYELENGGARA",$edit_r_mastpel__penyelenggara);
$smarty->assign ("EDIT_JENIS",$edit_r_mastpel__jenis);
$smarty->assign ("EDIT_DESKRIPSI",$edit_r_mastpel__deskripsi);
$smarty->assign ("EDIT_TEMPAT",$edit_r_mastpel__tempat);
$smarty->assign ("EDIT_STATUS",$edit_r_mastpel__status);
$smarty->assign ("EDIT_PNPT_NIP",$edit_r_pnpt__nip);
$smarty->assign ("EDIT_JABATAN",$edit_r_jabatan__ket);
$smarty->assign ("EDIT_CABANG_ID",$edit_r_cabang__id);
$smarty->assign ("EDIT_CABANG_NAMA",$edit_r_cabang__nama);
$smarty->assign ("EDIT_PNPT_MUTASI",$edit_r_pnpt__no_mutasi);
$smarty->assign ("EDIT_PEGAWAI_ID",$edit_r_pegawai__id);
$smarty->assign ("EDIT_PEGAWAI_NAMA",$edit_r_pegawai__nama);
 

$smarty->assign ("EDIT_VAL", $edit);


//-----------------------CLOSE VIEW EDIT----------------------------------------------------------------------------------//
//$tahun = now();
//-----------------------------------------VIEW INDEX---------------------------------------------------------------------//
if ($_GET['search'] == '1')
    {
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
 
		  if($jenis_user=='2'){

                                  $sql  = "SELECT
                                            B.r_mastpel__id AS r_mastpel__id,
                                            B.r_mastpel__mutasi AS r_mastpel__mutasi,
                                            B.r_mastpel__email_pic AS r_mastpel__email_pic,
                                            B.r_mastpel__tema AS r_mastpel__tema,
                                            B.r_mastpel__tgl_awal AS r_mastpel__tgl_awal,
                                            B.r_mastpel__tgl_akhir AS r_mastpel__tgl_akhir,
                                            B.r_mastpel__penyelenggara AS r_mastpel__penyelenggara,
                                            B.r_mastpel__jenis AS r_mastpel__jenis,
                                            B.r_mastpel__deskripsi AS r_mastpel__deskripsi,
                                            B.r_mastpel__tempat AS r_mastpel__tempat,
                                            B.r_mastpel__status AS r_mastpel__status,
                                      peg.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                            peg.r_pnpt__nip AS r_pnpt__nip,
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
                                            peg.r_pegawai__nama AS r_pegawai__nama
                                    FROM
                                            v_pegawai peg
                                    INNER JOIN r_master_pelatihan B ON peg.r_pnpt__no_mutasi = B.r_mastpel__mutasi  AND r_cabang__id= '".$kode_pw_ses."' ";



            } else {
                                    $sql  = "SELECT
                                            B.r_mastpel__id AS r_mastpel__id,
                                            B.r_mastpel__mutasi AS r_mastpel__mutasi,
                                            B.r_mastpel__email_pic AS r_mastpel__email_pic,
                                            B.r_mastpel__tema AS r_mastpel__tema,
                                            B.r_mastpel__tgl_awal AS r_mastpel__tgl_awal,
                                            B.r_mastpel__tgl_akhir AS r_mastpel__tgl_akhir,
                                            B.r_mastpel__penyelenggara AS r_mastpel__penyelenggara,
                                            B.r_mastpel__jenis AS r_mastpel__jenis,
                                            B.r_mastpel__deskripsi AS r_mastpel__deskripsi,
                                            B.r_mastpel__tempat AS r_mastpel__tempat,
                                            B.r_mastpel__status AS r_mastpel__status,
                                      peg.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                            peg.r_pnpt__nip AS r_pnpt__nip,
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
                                            peg.r_pegawai__nama AS r_pegawai__nama
                                    FROM
                                            v_pegawai peg
                                    INNER JOIN r_master_pelatihan B ON peg.r_pnpt__no_mutasi = B.r_mastpel__mutasi WHERE 1=1";	

            }
 
				//echo "<br><br><br><br><br><br><br><br><br><br>dddddddddkode_perwakilan_cari ===".$kode_perwakilan_cari;


				 
				if($kode_cabang_cari !=''){
					$sql .= " AND r_cabang__id = '".$kode_cabang_cari."' ";
				}
                               
				if($kode_subcab_cari !=''){
					$sql .= " AND r_subcab__id = '".$kode_subcab_cari."' "; 
				}

				if( $departemen_cari!=''){
					$sql .= " AND r_dept__id = '".$departemen_cari."' ";
				}  
                                if($nama_pegawai_cari!=''){
					
                                        $sql .= " AND r_pegawai__nama LIKE '%".addslashes($nama_pegawai_cari)."%'";
				} 
                                if($bidang_cari!=''){
					
                                        $sql .= " AND r_mastpel__tema LIKE '%".addslashes($bidang_cari)."%'";
				} 
                                 if($status_cari!=''){
					
                                        $sql .= " AND r_mastpel__status = '".$status_cari."'";
				} 
                                if($bulan!=''){
					
                                        $sql .= " AND MONTH(r_mastpel__tgl_awal) = '".$bulan."'";
				} 
                                if($tahun!=''){
					
                                        $sql .= " AND YEAR(r_mastpel__tgl_awal) = '".$tahun."'";
				} 
                                
		
			 	$sql .= " ORDER BY  r_mastpel__tgl_awal DESC ";

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

}
else
    
{
				

			if($jenis_user=='2'){

                                                
                            $sql = "SELECT
                                    B.r_mastpel__id AS r_mastpel__id,
                                    B.r_mastpel__mutasi AS r_mastpel__mutasi,
                                    B.r_mastpel__email_pic AS r_mastpel__email_pic,
                                    B.r_mastpel__tema AS r_mastpel__tema,
                                    B.r_mastpel__tgl_awal AS r_mastpel__tgl_awal,
                                    B.r_mastpel__tgl_akhir AS r_mastpel__tgl_akhir,
                                    B.r_mastpel__penyelenggara AS r_mastpel__penyelenggara,
                                    B.r_mastpel__jenis AS r_mastpel__jenis,
                                    B.r_mastpel__deskripsi AS r_mastpel__deskripsi,
                                    B.r_mastpel__tempat AS r_mastpel__tempat,
                                    B.r_mastpel__status AS r_mastpel__status,
                                    peg.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                    peg.r_pnpt__nip AS r_pnpt__nip,
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
                                    peg.r_pegawai__nama AS r_pegawai__nama
                                    FROM
                                            v_pegawai peg
                                    INNER JOIN r_master_pelatihan B ON peg.r_pnpt__no_mutasi = B.r_mastpel__mutasi   AND r_cabang__id= '".$kode_pw_ses."'";


			} else {
                                            $sql  = "SELECT
                                            B.r_mastpel__id AS r_mastpel__id,
                                            B.r_mastpel__mutasi AS r_mastpel__mutasi,
                                            B.r_mastpel__email_pic AS r_mastpel__email_pic,
                                            B.r_mastpel__tema AS r_mastpel__tema,
                                            B.r_mastpel__tgl_awal AS r_mastpel__tgl_awal,
                                            B.r_mastpel__tgl_akhir AS r_mastpel__tgl_akhir,
                                            B.r_mastpel__penyelenggara AS r_mastpel__penyelenggara,
                                            B.r_mastpel__jenis AS r_mastpel__jenis,
                                            B.r_mastpel__deskripsi AS r_mastpel__deskripsi,
                                            B.r_mastpel__tempat AS r_mastpel__tempat,
                                            B.r_mastpel__status AS r_mastpel__status,
                                      peg.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                            peg.r_pnpt__nip AS r_pnpt__nip,
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
                                            peg.r_pegawai__nama AS r_pegawai__nama
                                    FROM
                                            v_pegawai peg
                                    INNER JOIN r_master_pelatihan B ON peg.r_pnpt__no_mutasi = B.r_mastpel__mutasi where 1=1 ";	

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
					
                                        $sql .= " AND r_pegawai__nama LIKE '%".addslashes($nama_pegawai_cari)."%'";
				} 
                                if($bidang_cari!=''){
					
                                        $sql .= " AND r_mastpel__tema LIKE '%".addslashes($bidang_cari)."%'";
				} 
                                 if($status_cari!=''){
					
                                         $sql .= " AND r_mastpel__status = '".$status_cari."'";
				} 
                                 if($bulan!=''){
					
                                        $sql .= " AND MONTH(r_mastpel__tgl_awal) = '".$bulan."'";
				} 
                                if($tahun!=''){
					
                                        $sql .= " AND YEAR(r_mastpel__tgl_awal) = '".$tahun."'";
				} 

				$sql .= " ORDER BY   r_mastpel__tgl_awal DESC ";
                         
 
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