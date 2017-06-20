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
$group_session = $_SESSION['SESSION_GROUP'];
$smarty->assign ("TAHUN_SES", $tahun_ses_aktif);
$smarty->assign ("BULAN_SES", $bulan_ses_aktif);
 

$smarty->assign ("JENIS_USER_SES", $jenis_user);
$smarty->assign ("KODE_PW_SES", $kode_pw_ses);
$smarty->assign ("GROUP_USER", $group_session);

//echo "JENIS USER".$_SESSION['SESSION_JNS_USER'];
//echo "<br>KODE PERWAKILAN".$_SESSION['SESSION_KODE_PERWAKILAN'];

#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);
$smarty->assign ("HREF_HOME_PATH_AJAX", $HREF_HOME.'/modules/data_pegawai/support_mdrp');
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_pegawai/support_mdrp';
#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_pegawai');
$FILE_JS  = $JS_MODUL.'/support_mdrp';

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
$tbl_name	= "t_mdrp";

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

if ($_GET['status_cari']) $status_cari = $_GET['status_cari'];
else if ($_POST['status_cari']) $status_cari= $_POST['status_cari'];
else $status_cari="";

if ($status_cari==2)
{
    $status2=0;
}  else {
    $status2=1;
}

if ($_GET['bulan']) $bulan = $_GET['bulan'];
else if ($_POST['bulan']) $bulan = $_POST['bulan'];
else $bulan="";

if ($_GET['tahun']) $tahun = $_GET['tahun'];
else if ($_POST['tahun']) $tahun = $_POST['tahun'];
else $tahun="";

if ($_GET['no_cari']) $no_cari = $_GET['no_cari'];
else if ($_POST['no_cari']) $no_cari = $_POST['no_cari'];
else $no_cari="";


if ($_GET['mdrp_cari']) $mdrp_cari = $_GET['mdrp_cari'];
else if ($_POST['mdrp_cari']) $mdrp_cari = $_POST['mdrp_cari'];
else $mdrp_cari="";


$smarty->assign ("KODE_PERWAKILAN_CARI", $kode_perwakilan_cari);
$smarty->assign ("NO_PASPOR_CARI", $no_paspor_cari);
$smarty->assign ("NAMA_WNI_CARI", $nama_wni_cari);
$smarty->assign ("KODE_SUMBER", $kode_sumber);
$smarty->assign ("KODE_SUBCAB_CARI", $kode_subcab_cari);



$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_perwakilan_cari=".$kode_subcab_cari."&kode_subcab_cari=".$kode_subcab_cari;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;


$sql_cek_no="SELECT COUNT(r_resign__no) AS no_otomatis FROM r_resign";
//var_dump($sql_cek_no) or die();
$rs_val = $db->Execute($sql_cek_no);

$no_resign_new= $rs_val->fields[no_otomatis];
$no_resign_new++;

$smarty->assign ("ID_RESIGN_NEW", $no_resign_new);
//------------------NO_OTOMATIS----------//



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
               where cab.r_cabang__id=subcab.r_subcab__cabang  order by subcab.r_subcab__id";
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
					
					$input_kab="<select name=subcabang_baru >";
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
					
					$input_kab="<select name=subcabang_baru>";
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


$sql_tipe_pdrm= "SELECT
  tipe_penempatan__id,tipe_penempatan,tipe_penempatan__status,tipe_penempatan__pdrm FROM r_tipe_penempatan
 where	tipe_penempatan__id !=1 AND tipe_penempatan__id!=13 AND tipe_penempatan__id!=25
  GROUP BY tipe_penempatan";
 // var_dump($sql_tipe_pdrm)or die();
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
//----------TIPE_MDRP----------------


//----------- AJAX SUBDEP ------------------//
if ($_GET[get_subdep] == 1)
{  
    	$subdep = $_GET[no_subdep];
            //var_dump($subdep) or die();
			if($subdep!=''){
					$sql_kabupaten = " SELECT dep.r_dept__id,dep.r_dept__akronim,dep.r_dept__ket,subdep.r_subdept__ket,subdep.r_subdept__id FROM r_departement dep LEFT JOIN r_subdepartement subdep ON subdep.r_subdept__dept=dep.r_dept__id  "
                                                . "where dep.r_dept__id=".$subdep." ORDER BY dep.r_dept__ket ASC";
                                       // var_dump($sql_kabupaten)or die();
                                        $recordSet_kabupaten = $db->Execute($sql_kabupaten);
					
					$input_kab="<select name=subdep_baru onchange=\"cari_jabatan(this.value)\">";
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
                            WHERE r_subdepartement.r_subdept__id=".$subdep."   ORDER BY r_jabatan__id ASC "; //and r_jabatan.r_jabatan__kategori_cabang=".$kode_pw_ses."
    }else{      
            $sql_kabupaten = " SELECT r_jabatan.r_jabatan__id,r_jabatan.r_jabatan__ket,r_jabatan.r_jabatan__level,
                            r_jabatan.r_jabatan__sub_departemen,r_jabatan.r_jabatan__departemen,r_jabatan.r_jabatan__kategori_cabang,
                            r_subdepartement.r_subdept__ket from r_jabatan
                            inner join r_subdepartement on r_subdepartement.r_subdept__id=r_jabatan.r_jabatan__sub_departemen
                            WHERE r_subdepartement.r_subdept__id=".$subdep."  ORDER BY r_jabatan__id ASC ";
    }               
                        $recordSet_kabupaten = $db->Execute($sql_kabupaten);

                        $input_kab="<select name=jabatan_baru >";
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


//-----------------------VIEW EDIT ---------------------------------------//
$opt = $_GET[opt];

$ed = 0;
if($opt=="1"){ 

                      $sql_ = " SELECT
                              r_penempatan.r_pnpt__aktif AS r_pnpt__aktif,
                              r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
                              r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                              r_jabatan.r_jabatan__id AS jab_baru_id,
                              r_jabatan.r_jabatan__ket AS jab_baru,
                              r_departement.r_dept__id AS dep_baru_id,
                              r_departement.r_dept__ket AS dep_baru,
                              r_cabang.r_cabang__nama AS cabang_baru,
                              r_cabang.r_cabang__id AS cabang_id_baru,
                              r_pegawai.r_pegawai__id AS r_pegawai__id,
                              r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                              r_pegawai.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
                              A.mdrp__formulir AS formulir,
                              A.mdrp__idpegawai AS idpegawai,
                              cab_lama.r_cabang__nama AS cabang_lama,
                              A.mdrp__id AS mdrp__id,
                              A.mdrp__dep_lama AS dep_lama,
                              A.mdrp__sudep_lama AS subdep_lama,
                              A.mdrp__cab_lama AS cab_lama,
                              A.mdrp__jab_lama AS jab_lama,
                              A.mdrp__lokasibaru AS lokasibaru,
                              A.mdrp__subcab_baru AS subcab_baru,
                              A.mdrp__depbaru AS mdrp__depbaru,
                              A.mdrp__subdepbaru AS subdepbaru,
                              A.mdrp__jabatanbaru AS jabatanbaru, 
                              A.mdrp__efektif AS mdrp__efektif,
                              A.mdrp__tipe AS mdrp__tipe,
                              A.mdrp__status AS mdrp__status,
                              A.mdrp__lokasibaru AS mdrp__lokasibaru,
                              r_tipe_penempatan.tipe_penempatan AS jenis_mdrp,
                               (YEAR(CURDATE())-YEAR(r_pegawai__tgl_masuk)) - (RIGHT(CURDATE(),5)<RIGHT(r_pegawai__tgl_masuk,5)) AS lama_kerja
                            FROM
                                    t_mdrp A
                            INNER JOIN r_cabang ON r_cabang.r_cabang__id = A.mdrp__lokasibaru
                            INNER JOIN r_pegawai ON r_pegawai.r_pegawai__id = A.mdrp__idpegawai
                            INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai__id
                            INNER JOIN r_jabatan ON A.mdrp__jabatanbaru = r_jabatan.r_jabatan__id
                            INNER JOIN r_departement ON A.mdrp__depbaru = r_dept__id
                            INNER JOIN r_tipe_penempatan ON r_tipe_penempatan.tipe_penempatan__id = A.mdrp__tipe
                            JOIN (SELECT r_cabang.r_cabang__id,r_cabang__nama FROM r_cabang,t_mdrp WHERE r_cabang__id = t_mdrp.mdrp__cab_lama) cab_lama
                            WHERE A.mdrp__id ='".$_GET['id']."' GROUP BY A.mdrp__id";
        
     
$resultSet = $db->Execute($sql_);
$edit_formulir = $resultSet->fields[formulir];
$edit_cabang_lama=$resultSet->fields[cab_lama];
$edit_pegawai__nama=$resultSet->fields[r_pegawai__nama];
$edit_pegawai__id=$resultSet->fields[r_pegawai__id];
$edit_namacab_lama=$resultSet->fields[cabang_lama];
$edit_dep_lama=$resultSet->fields[dep_lama];
$edit_subdep_lama=$resultSet->fields[subdep_lama];
$edit_jab_lama=$resultSet->fields[jab_lama];
$edit_tgl_masuk=$resultSet->fields[r_pegawai__tgl_masuk];
$edit_lama_kerja=$resultSet->fields[lama_kerja];
$edit_cab_baru=$resultSet->fields[lokasibaru];
$edit_subcab_baru=$resultSet->fields[subcab_baru];
$edit_dep_baru=$resultSet->fields[mdrp__depbaru];
$edit_subdepbaru=$resultSet->fields[subdepbaru];
$edit_jabatanbaru=$resultSet->fields[jabatanbaru];
$edit_jenis_mdrp=$resultSet->fields[mdrp__tipe];
$edit_tgl_efektif=$resultSet->fields[mdrp__efektif];
$edit_status=$resultSet->fields[mdrp__status];
$edit_mdrp__id=$resultSet->fields[mdrp__id];


//var_dump($edit_jenis_mdrp)or die();
$edit=1;

}

//----------------CLOSE EDIT---------------------//

$smarty->assign ("OPT", $opt);
$smarty->assign ("EDIT_FORMULIR",$edit_formulir);
$smarty->assign ("EDIT_CABANG_LAMA",$edit_cabang_lama); 
$smarty->assign ("EDIT_NAMA",$edit_pegawai__nama); 
$smarty->assign ("EDIT_PEGAWAI_ID",$edit_pegawai__id); 
$smarty->assign ("EDIT_NAMACABANG_LAMA",$edit_namacab_lama); 
$smarty->assign ("EDIT_DEP_LAMA",$edit_dep_lama); 
$smarty->assign ("EDIT_SUBDEP_LAMA",$edit_subdep_lama); 
$smarty->assign ("EDIT_JAB_LAMA",$edit_jab_lama); 
$smarty->assign ("EDIT_TGL_MSK",$edit_tgl_masuk); 
$smarty->assign ("EDIT_LAMA_KERJA",$edit_lama_kerja); 
$smarty->assign ("EDIT_CAB_BARU",$edit_cab_baru); 
$smarty->assign ("EDIT_SUB_BARU",$edit_subcab_baru); 
$smarty->assign ("EDIT_DEP_BARU",$edit_dep_baru); 
$smarty->assign ("EDIT_SUBDEPT_BARU",$edit_subdepbaru); 
$smarty->assign ("EDIT_JAB_BARU",$edit_jabatanbaru); 
$smarty->assign ("EDIT_JENIS_PENEMPATAN",$edit_jenis_mdrp); 
$smarty->assign ("EDIT_TGL_EFEKTIF",$edit_tgl_efektif); 
$smarty->assign ("EDIT_STATUS",$edit_status); 
$smarty->assign ("EDIT_MDRP_ID",$edit_mdrp__id);

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
                            r_penempatan.r_pnpt__aktif AS r_pnpt__aktif,
                            r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
                            r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                            r_jabatan.r_jabatan__id AS jab_baru_id,
                            r_jabatan.r_jabatan__ket AS jab_baru,
                            r_departement.r_dept__id AS dep_baru_id,
                            r_departement.r_dept__ket AS dep_baru,
                            r_cabang.r_cabang__nama AS cabang_baru,
                            r_cabang.r_cabang__id AS cabang_id_baru,
                            r_pegawai.r_pegawai__id AS r_pegawai__id,
                            r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                            A.mdrp__formulir AS formulir,
                            A.mdrp__idpegawai AS idpegawai,
                            A.mdrp__id AS mdrp__id,
                            A.mdrp__dep_lama AS dep_lama,
                            A.mdrp__sudep_lama AS subdep_lama,
                            A.mdrp__cab_lama AS cab_lama,
							CASE mdrp__cab_lama
							WHEN 1 THEN
								'PUSAT'
							WHEN 2 THEN
								'BANDUNG'
							WHEN 3 THEN
								'SUBANG'
							WHEN 4 THEN
								'SUKABUMI'
							WHEN 5 THEN
								'CIREBON'
							WHEN 6 THEN
								'TASIKMALAYA'
							WHEN 7 THEN
								'SEMARANG'
							WHEN 8 THEN
								'PATI'
							WHEN 9 THEN
								'TEGAL'
							WHEN 10 THEN
								'YOGYAKARTA'
							WHEN 11 THEN
								'SOLO'
							WHEN 12 THEN
								'PURWOKERTO'
							ELSE
								'PURWOKERTO'

							END AS nama_cabang_lama,
                            A.mdrp__jab_lama AS jab_lama,
                            A.mdrp__lokasibaru AS lokasibaru,
                            A.mdrp__subcab_baru AS subcab_baru,
                            A.mdrp__depbaru AS mdrp__depbaru,
                            A.mdrp__subdepbaru AS subdepbaru,
                            A.mdrp__jabatanbaru AS jabatanbaru,
                            A.mdrp__efektif AS mdrp__efektif,
                            A.mdrp__tipe AS mdrp__tipe,
                            A.mdrp__status AS mdrp__status,
                            A.mdrp__lokasibaru AS mdrp__lokasibaru,
                              A.mdrp__date_created,
                            A.mdrp__date_updated,
                            A.mdrp__user_created,
                            A.mdrp__user_updated,
                            r_tipe_penempatan.tipe_penempatan AS jenis_mdrp,
                            r_tipe_penempatan.tipe_penempatan__pdrm AS tipe_penempatan__pdrm
                            FROM t_mdrp A
                            INNER JOIN r_cabang ON r_cabang.r_cabang__id = A.mdrp__lokasibaru
                            INNER JOIN r_pegawai ON r_pegawai.r_pegawai__id = A.mdrp__idpegawai
                            INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai__id
                            INNER JOIN r_jabatan ON A.mdrp__jabatanbaru = r_jabatan.r_jabatan__id
                            INNER JOIN r_departement ON A.mdrp__depbaru = r_dept__id
                            INNER JOIN r_tipe_penempatan ON r_tipe_penempatan.tipe_penempatan__pdrm = A.mdrp__tipe
                            LEFT JOIN (
                                    SELECT   r_cabang.r_cabang__nama,t_mdrp.mdrp__cab_lama as id
                                    FROM t_mdrp
                                    LEFT JOIN r_cabang ON r_cabang.r_cabang__id = t_mdrp.mdrp__cab_lama
                            ) cab_lama ON cab_lama.id=r_cabang.r_cabang__id
                            WHERE A.mdrp__cab_lama = '".$kode_pw_ses."' ";

            } else {
                        $sql  = "SELECT
                            r_penempatan.r_pnpt__aktif AS r_pnpt__aktif,
                            r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
                            r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                            r_jabatan.r_jabatan__id AS jab_baru_id,
                            r_jabatan.r_jabatan__ket AS jab_baru,
                            r_departement.r_dept__id AS dep_baru_id,
                            r_departement.r_dept__ket AS dep_baru,
                            r_cabang.r_cabang__nama AS cabang_baru,
                            r_cabang.r_cabang__id AS cabang_id_baru,
                            r_pegawai.r_pegawai__id AS r_pegawai__id,
                            r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                            A.mdrp__formulir AS formulir,
                            A.mdrp__idpegawai AS idpegawai,
                            A.mdrp__id AS mdrp__id,
                            A.mdrp__dep_lama AS dep_lama,
                            A.mdrp__sudep_lama AS subdep_lama,
                            A.mdrp__cab_lama AS cab_lama,
                           CASE mdrp__cab_lama
							WHEN 1 THEN
								'PUSAT'
							WHEN 2 THEN
								'BANDUNG'
							WHEN 3 THEN
								'SUBANG'
							WHEN 4 THEN
								'SUKABUMI'
							WHEN 5 THEN
								'CIREBON'
							WHEN 6 THEN
								'TASIKMALAYA'
							WHEN 7 THEN
								'SEMARANG'
							WHEN 8 THEN
								'PATI'
							WHEN 9 THEN
								'TEGAL'
							WHEN 10 THEN
								'YOGYAKARTA'
							WHEN 11 THEN
								'SOLO'
							WHEN 12 THEN
								'PURWOKERTO'
							ELSE
								'PURWOKERTO'

							END AS nama_cabang_lama,
                            A.mdrp__jab_lama AS jab_lama,
                            A.mdrp__lokasibaru AS lokasibaru,
                            A.mdrp__subcab_baru AS subcab_baru,
                            A.mdrp__depbaru AS mdrp__depbaru,
                            A.mdrp__subdepbaru AS subdepbaru,
                            A.mdrp__jabatanbaru AS jabatanbaru,
                            A.mdrp__efektif AS mdrp__efektif,
                            A.mdrp__tipe AS mdrp__tipe,
                            A.mdrp__status AS mdrp__status,
                            A.mdrp__lokasibaru AS mdrp__lokasibaru,
                            A.mdrp__date_created,
                            A.mdrp__date_updated,
                            A.mdrp__user_created,
                            A.mdrp__user_updated,
                            r_tipe_penempatan.tipe_penempatan AS jenis_mdrp,
                            r_tipe_penempatan.tipe_penempatan__pdrm AS tipe_penempatan__pdrm
                            FROM t_mdrp A
                            INNER JOIN r_cabang ON r_cabang.r_cabang__id = A.mdrp__lokasibaru
                            INNER JOIN r_pegawai ON r_pegawai.r_pegawai__id = A.mdrp__idpegawai
                            INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai__id
                            INNER JOIN r_jabatan ON A.mdrp__jabatanbaru = r_jabatan.r_jabatan__id
                            INNER JOIN r_departement ON A.mdrp__depbaru = r_dept__id
                            INNER JOIN r_tipe_penempatan ON r_tipe_penempatan.tipe_penempatan__pdrm = A.mdrp__tipe
                            LEFT JOIN (
                                    SELECT   r_cabang.r_cabang__nama,t_mdrp.mdrp__cab_lama as id
                                    FROM t_mdrp
                                    LEFT JOIN r_cabang ON r_cabang.r_cabang__id = t_mdrp.mdrp__cab_lama
                            ) cab_lama ON cab_lama.id=r_cabang.r_cabang__id
                            WHERE 1 = 1  ";	

            }
 
				//echo "<br><br><br><br><br><br><br><br><br><br>dddddddddkode_perwakilan_cari ===".$kode_perwakilan_cari;

                            if($no_cari !=''){
					$sql .= " AND A.mdrp__id = '".$no_cari."' ";
				}
				 
				if($kode_cabang_cari !=''){
					$sql .= " AND A.mdrp__cab_lama = '".$kode_cabang_cari."' ";
				}
                               
				if($status_cari !=''){
					$sql .= " AND  A.mdrp__status = '".$status2."' ";
				}  
                                if($nama_pegawai_cari!=''){
                                        $sql .= " AND r_pegawai__nama LIKE '%".addslashes($nama_pegawai_cari)."%'";
				} 
                                
                                if ($mdrp_cari !='') {
                                       $sql.=" AND tipe_penempatan__pdrm ='$mdrp_cari'";
                                }
                                if ($bulan !='') {
                                       $sql.=" AND MONTH( A.mdrp__efektif)='$bulan'";
                                }

                                 if ($tahun !='') {
                                       $sql.=" AND YEAR( A.mdrp__efektif)='$tahun'";
                                }	
			 	
                                $sql .= " GROUP BY A.mdrp__id ORDER BY A.mdrp__date_updated desc ";
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
				//$next_prev = $p->nextPrevCustom($page,$pages,"ORDER=".$ORDER."&".$str_completer); 
}

}
else
    
{
				

                if($jenis_user=='2')
                    {

                                                
                     $sql = "SELECT
                            r_penempatan.r_pnpt__aktif AS r_pnpt__aktif,
                            r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
                            r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                            r_jabatan.r_jabatan__id AS jab_baru_id,
                            r_jabatan.r_jabatan__ket AS jab_baru,
                            r_departement.r_dept__id AS dep_baru_id,
                            r_departement.r_dept__ket AS dep_baru,
                            r_cabang.r_cabang__nama AS cabang_baru,
                            r_cabang.r_cabang__id AS cabang_id_baru,
                            r_pegawai.r_pegawai__id AS r_pegawai__id,
                            r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                            A.mdrp__formulir AS formulir,
                            A.mdrp__idpegawai AS idpegawai,
                            A.mdrp__id AS mdrp__id,
                            A.mdrp__dep_lama AS dep_lama,
                            A.mdrp__sudep_lama AS subdep_lama,
                            A.mdrp__cab_lama AS cab_lama,
                            CASE mdrp__cab_lama
							WHEN 1 THEN
								'PUSAT'
							WHEN 2 THEN
								'BANDUNG'
							WHEN 3 THEN
								'SUBANG'
							WHEN 4 THEN
								'SUKABUMI'
							WHEN 5 THEN
								'CIREBON'
							WHEN 6 THEN
								'TASIKMALAYA'
							WHEN 7 THEN
								'SEMARANG'
							WHEN 8 THEN
								'PATI'
							WHEN 9 THEN
								'TEGAL'
							WHEN 10 THEN
								'YOGYAKARTA'
							WHEN 11 THEN
								'SOLO'
							WHEN 12 THEN
								'PURWOKERTO'
							ELSE
								'PURWOKERTO'

							END AS nama_cabang_lama,
                            A.mdrp__jab_lama AS jab_lama,
                            A.mdrp__lokasibaru AS lokasibaru,
                            A.mdrp__subcab_baru AS subcab_baru,
                            A.mdrp__depbaru AS mdrp__depbaru,
                            A.mdrp__subdepbaru AS subdepbaru,
                            A.mdrp__jabatanbaru AS jabatanbaru,
                            A.mdrp__efektif AS mdrp__efektif,
                            A.mdrp__tipe AS mdrp__tipe,
                            A.mdrp__status AS mdrp__status,
                            A.mdrp__lokasibaru AS mdrp__lokasibaru,
                            A.mdrp__date_created,
                            A.mdrp__date_updated,
                            A.mdrp__user_created,
                            A.mdrp__user_updated,
                            r_tipe_penempatan.tipe_penempatan AS jenis_mdrp,
                            r_tipe_penempatan.tipe_penempatan__pdrm AS tipe_penempatan__pdrm
                            FROM t_mdrp A
                            INNER JOIN r_cabang ON r_cabang.r_cabang__id = A.mdrp__lokasibaru
                            INNER JOIN r_pegawai ON r_pegawai.r_pegawai__id = A.mdrp__idpegawai
                            INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai__id
                            INNER JOIN r_jabatan ON A.mdrp__jabatanbaru = r_jabatan.r_jabatan__id
                            INNER JOIN r_departement ON A.mdrp__depbaru = r_dept__id
                            INNER JOIN r_tipe_penempatan ON r_tipe_penempatan.tipe_penempatan__pdrm = A.mdrp__tipe
                            LEFT JOIN (
                                    SELECT   r_cabang.r_cabang__nama,t_mdrp.mdrp__cab_lama as id
                                    FROM t_mdrp
                                    LEFT JOIN r_cabang ON r_cabang.r_cabang__id = t_mdrp.mdrp__cab_lama
                            ) cab_lama ON cab_lama.id=r_cabang.r_cabang__id
                            WHERE A.mdrp__cab_lama = '".$kode_pw_ses."' ";


			} else {
                                $sql  = "SELECT
                            r_penempatan.r_pnpt__aktif AS r_pnpt__aktif,
                            r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
                            r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                            r_jabatan.r_jabatan__id AS jab_baru_id,
                            r_jabatan.r_jabatan__ket AS jab_baru,
                            r_departement.r_dept__id AS dep_baru_id,
                            r_departement.r_dept__ket AS dep_baru,
                            r_cabang.r_cabang__nama AS cabang_baru,
                            r_cabang.r_cabang__id AS cabang_id_baru,
                            r_pegawai.r_pegawai__id AS r_pegawai__id,
                            r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                            A.mdrp__formulir AS formulir,
                            A.mdrp__idpegawai AS idpegawai,
                            A.mdrp__id AS mdrp__id,
                            A.mdrp__dep_lama AS dep_lama,
                            A.mdrp__sudep_lama AS subdep_lama,
                            A.mdrp__cab_lama AS cab_lama,
							CASE mdrp__cab_lama
							WHEN 1 THEN
								'PUSAT'
							WHEN 2 THEN
								'BANDUNG'
							WHEN 3 THEN
								'SUBANG'
							WHEN 4 THEN
								'SUKABUMI'
							WHEN 5 THEN
								'CIREBON'
							WHEN 6 THEN
								'TASIKMALAYA'
							WHEN 7 THEN
								'SEMARANG'
							WHEN 8 THEN
								'PATI'
							WHEN 9 THEN
								'TEGAL'
							WHEN 10 THEN
								'YOGYAKARTA'
							WHEN 11 THEN
								'SOLO'
							WHEN 12 THEN
								'PURWOKERTO'
							ELSE
								'PURWOKERTO'

							END AS nama_cabang_lama,
                            A.mdrp__jab_lama AS jab_lama,
                            A.mdrp__lokasibaru AS lokasibaru,
                            A.mdrp__subcab_baru AS subcab_baru,
                            A.mdrp__depbaru AS mdrp__depbaru,
                            A.mdrp__subdepbaru AS subdepbaru,
                            A.mdrp__jabatanbaru AS jabatanbaru,
                            A.mdrp__efektif AS mdrp__efektif,
                            A.mdrp__tipe AS mdrp__tipe,
                            A.mdrp__status AS mdrp__status,
                            A.mdrp__lokasibaru AS mdrp__lokasibaru,
                            A.mdrp__date_created,
                            A.mdrp__date_updated,
                            A.mdrp__user_created,
                            A.mdrp__user_updated,
                            r_tipe_penempatan.tipe_penempatan AS jenis_mdrp,
                            r_tipe_penempatan.tipe_penempatan__pdrm AS tipe_penempatan__pdrm
                            FROM t_mdrp A
                            INNER JOIN r_cabang ON r_cabang.r_cabang__id = A.mdrp__lokasibaru
                            INNER JOIN r_pegawai ON r_pegawai.r_pegawai__id = A.mdrp__idpegawai
                            INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai__id
                            INNER JOIN r_jabatan ON A.mdrp__jabatanbaru = r_jabatan.r_jabatan__id
                            INNER JOIN r_departement ON A.mdrp__depbaru = r_dept__id
                            INNER JOIN r_tipe_penempatan ON r_tipe_penempatan.tipe_penempatan__pdrm = A.mdrp__tipe
                            LEFT JOIN (
                                    SELECT   r_cabang.r_cabang__nama,t_mdrp.mdrp__cab_lama as id
                                    FROM t_mdrp
                                    LEFT JOIN r_cabang ON r_cabang.r_cabang__id = t_mdrp.mdrp__cab_lama
                            ) cab_lama ON cab_lama.id=r_cabang.r_cabang__id
                            WHERE 1= 1 ";	

			}
                         if($no_cari !=''){
					$sql .= " AND A.mdrp__id = '".$no_cari."' ";
				}

				if($kode_cabang_cari !=''){
					$sql .= " AND A.mdrp__cab_lama = '".$kode_cabang_cari."' ";
				}
                               
				if($status_cari !=''){
					$sql .= " AND  A.mdrp__status = '".$status2."' ";
				}  
                                if($nama_pegawai_cari!=''){
                                        $sql .= " AND r_pegawai__nama LIKE '%".addslashes($nama_pegawai_cari)."%'";
				} 
                                if ($bulan !='') {
                                       $sql.=" AND MONTH( A.mdrp__efektif)='$bulan'";
                                }

                                 if ($tahun !='') {
                                       $sql.=" AND YEAR( A.mdrp__efektif)='$tahun'";
                                }
		
			 	$sql .= " GROUP BY A.mdrp__id ORDER BY A.mdrp__date_updated desc ";
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