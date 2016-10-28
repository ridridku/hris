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
require_once($DIR_INC.'/func.inc.php');
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
$kode_pw_ses  =  $_SESSION['SESSION_KODE_CABANG'];
$tahun_ses_aktif = $_SESSION['SESSION_TAHUN_AKTIF'];
$bulan_ses_aktif = $_SESSION['SESSION_BULAN_AKTIF'];
$smarty->assign ("TAHUN_SES", $tahun_ses_aktif);
$smarty->assign ("BULAN_SES", $bulan_ses_aktif);
 

$smarty->assign ("JENIS_USER_SES", $jenis_user);
$smarty->assign ("KODE_PW_SES", $kode_pw_ses);

//echo "JENIS USER".$_SESSION['SESSION_JNS_USER'];
//echo "<br>KODE PERWAKILAN".$_SESSION['SESSION_KODE_PERWAKILAN'];

#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);
$smarty->assign ("HREF_HOME_PATH_AJAX", $HREF_HOME.'/modules/manfaat/angsuran');
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/manfaat/angsuran';
#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/manfaat');
$FILE_JS  = $JS_MODUL.'/angsuran';

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

if ($_GET['jenis_cari']) $jenis_cari = $_GET['jenis_cari'];
else if ($_POST['jenis_cari']) $jenis_cari = $_POST['jenis_cari'];
else $jenis_cari="";


if ($_GET['nama_cari']) $nama_cari = $_GET['nama_cari'];
else if ($_POST['nama_cari']) $nama_cari = $_POST['nama_cari'];
else $nama_cari="";

if ($_GET['nopjm_cari']) $nopjm_cari = $_GET['nopjm_cari'];
else if ($_POST['nopjm_cari']) $nopjm_cari = $_POST['nopjm_cari'];
else $nopjm_cari="";



$smarty->assign ("NAMA_CARI", $nama_cari);
$smarty->assign ("JENIS_CARI", jenis_cari);




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
                                        r_ang__id,
                                        r_ang__jenis,
                                        r_ang__platfond,
                                        r_ang__ket,
                                        r_ang__total,
                                        r_ang__tenor_bulan,
                                        r_ang__cicilan,
                                        r_ang__date_created,
                                        r_ang__date_updated,
                                        r_ang__user_created,
                                        r_ang__user_updated FROM r_angsuran where r_ang__id ='".$_GET['id']."' ";
                      
                        $resultSet = $db->Execute($sql_);
                                                               
                                
$edit_r_ang__id = $resultSet->fields[r_ang__id];
$edit_r_ang__jenis=$resultSet->fields[r_ang__jenis];
$edit_r_ang__platfond=$resultSet->fields[r_ang__platfond];
$edit_r_ang__ket = $resultSet->fields[r_ang__ket];
$edit_r_ang__total = $resultSet->fields[r_ang__total];
$edit_r_ang__tenor_bulan = $resultSet->fields[r_ang__tenor_bulan];
$edit_r_ang__cicilan = $resultSet->fields[r_ang__cicilan];



}

//----------------CLOSE EDIT---------------------//

$smarty->assign ("OPT", $opt);
$smarty->assign ("EDIT_ID",$edit_id);
$smarty->assign ("EDIT_R__ANG__ID",$edit_r_ang__id); 
$smarty->assign ("EDIT_R_ANG__JENIS",$edit_r_ang__jenis);
$smarty->assign ("EDIT_R_ANG__PLATFON",$edit_r_ang__platfond);
$smarty->assign ("EDIT_R_ANG__KET",$edit_r_ang__ket);
$smarty->assign ("EDIT_R_ANG__TOTAL",$edit_r_ang__total);
$smarty->assign ("EDIT_R_ANG__TENOR",$edit_r_ang__tenor_bulan);
$smarty->assign ("EDIT_R_ANG__CICILAN",$edit_r_ang__cicilan);


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
                                            r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                            r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                            r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
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
                                            r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                                            r_angsuran.r_ang__id AS r_ang__id,
                                            r_angsuran.r_ang__jenis AS r_ang__jenis,
                                            r_angsuran.r_ang__platfond AS r_ang__platfond,
                                            r_angsuran.r_ang__cicilan AS r_ang__cicilan,
                                            r_angsuran.r_ang__tenor_bulan AS r_ang__tenor_bulan,
                                            t_pinjaman.t_pjm__no_pinjaman AS t_pjm__no_pinjaman,
                                            t_pinjaman.t_pjm__approval AS t_pjm__approval,
                                            t_angsuran_pinjaman.t_ang__jenis AS t_ang__jenis,
                                            t_angsuran_pinjaman.t_ang__nopjm AS t_ang__nopjm,
                                            t_angsuran_pinjaman.t_ang__mutasi AS t_ang__mutasi,
                                            t_angsuran_pinjaman.t_ang__tanggal AS t_ang__tanggal,
                                            t_angsuran_pinjaman.t_ang__nilai_angsuran AS t_ang__nilai_angsuran,
                                             t_angsuran_pinjaman.t_ang__angsuran_ke AS t_ang__angsuran_ke
                                            FROM
                                                    r_pegawai
                                            INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                            INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                            INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                            INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                            INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                            INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                            INNER JOIN t_pinjaman ON t_pinjaman.t_pjm__mutasi = r_penempatan.r_pnpt__no_mutasi
                                            INNER JOIN t_angsuran_pinjaman ON t_angsuran_pinjaman.t_ang__mutasi = t_pinjaman.t_pjm__mutasi
                                            INNER JOIN r_angsuran ON r_angsuran.r_ang__id = t_pinjaman.t_pjm__jenis 
                                            WHERE t_pjm__approval=1  AND r_cabang__id = '".$kode_pw_ses."' ";



            } else {
                                    $sql  = "SELECT
                                            r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                            r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                            r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
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
                                            r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                                            r_angsuran.r_ang__id AS r_ang__id,
                                            r_angsuran.r_ang__jenis AS r_ang__jenis,
                                            r_angsuran.r_ang__platfond AS r_ang__platfond,
                                            r_angsuran.r_ang__cicilan AS r_ang__cicilan,
                                            r_angsuran.r_ang__tenor_bulan AS r_ang__tenor_bulan,
                                            t_pinjaman.t_pjm__no_pinjaman AS t_pjm__no_pinjaman,
                                            t_pinjaman.t_pjm__approval AS t_pjm__approval,
                                            t_angsuran_pinjaman.t_ang__jenis AS t_ang__jenis,
                                            t_angsuran_pinjaman.t_ang__nopjm AS t_ang__nopjm,
                                            t_angsuran_pinjaman.t_ang__mutasi AS t_ang__mutasi,
                                            t_angsuran_pinjaman.t_ang__tanggal AS t_ang__tanggal,
                                            t_angsuran_pinjaman.t_ang__nilai_angsuran AS t_ang__nilai_angsuran,
                                             t_angsuran_pinjaman.t_ang__angsuran_ke AS t_ang__angsuran_ke
                                            FROM
                                                    r_pegawai
                                            INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                            INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                            INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                            INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                            INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                            INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                            INNER JOIN t_pinjaman ON t_pinjaman.t_pjm__mutasi = r_penempatan.r_pnpt__no_mutasi
                                            INNER JOIN t_angsuran_pinjaman ON t_angsuran_pinjaman.t_ang__mutasi = t_pinjaman.t_pjm__mutasi
                                            INNER JOIN r_angsuran ON r_angsuran.r_ang__id = t_pinjaman.t_pjm__jenis 
                                            WHERE t_pjm__approval=1 ";	

            }
 
				//echo "<br><br><br><br><br><br><br><br><br><br>dddddddddkode_perwakilan_cari ===".$kode_perwakilan_cari;
				 
				                               
				if($nama_cari !=''){
					$sql .= " AND r_pegawai__nama LIKE  '%".$nama_cari."%' "; 
				}
                                if($nopjm_cari !=''){
					$sql .= " AND t_ang__nopjm =  '".$nopjm_cari."' "; 
				}


		
			 	$sql .= " ORDER BY  trim(r_pegawai__nama) asc ";

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
                                            r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                            r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                            r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
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
                                            r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                                            r_angsuran.r_ang__id AS r_ang__id,
                                            r_angsuran.r_ang__jenis AS r_ang__jenis,
                                            r_angsuran.r_ang__platfond AS r_ang__platfond,
                                            r_angsuran.r_ang__cicilan AS r_ang__cicilan,
                                            r_angsuran.r_ang__tenor_bulan AS r_ang__tenor_bulan,
                                            t_pinjaman.t_pjm__no_pinjaman AS t_pjm__no_pinjaman,
                                            t_pinjaman.t_pjm__approval AS t_pjm__approval,
                                            t_angsuran_pinjaman.t_ang__jenis AS t_ang__jenis,
                                            t_angsuran_pinjaman.t_ang__nopjm AS t_ang__nopjm,
                                            t_angsuran_pinjaman.t_ang__mutasi AS t_ang__mutasi,
                                            t_angsuran_pinjaman.t_ang__tanggal AS t_ang__tanggal,
                                            t_angsuran_pinjaman.t_ang__nilai_angsuran AS t_ang__nilai_angsuran,
                                             t_angsuran_pinjaman.t_ang__angsuran_ke AS t_ang__angsuran_ke
                                            FROM
                                                    r_pegawai
                                            INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                            INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                            INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                            INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                            INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                            INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                            INNER JOIN t_pinjaman ON t_pinjaman.t_pjm__mutasi = r_penempatan.r_pnpt__no_mutasi
                                            INNER JOIN t_angsuran_pinjaman ON t_angsuran_pinjaman.t_ang__mutasi = t_pinjaman.t_pjm__mutasi
                                            INNER JOIN r_angsuran ON r_angsuran.r_ang__id = t_pinjaman.t_pjm__jenis 
                                            WHERE t_pjm__approval=1 AND r_cabang__id = '".$kode_pw_ses."' "; 


			} else {
						$sql  = "SELECT
                                            r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                            r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                            r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
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
                                            r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                                            r_angsuran.r_ang__id AS r_ang__id,
                                            r_angsuran.r_ang__jenis AS r_ang__jenis,
                                            r_angsuran.r_ang__platfond AS r_ang__platfond,
                                            r_angsuran.r_ang__cicilan AS r_ang__cicilan,
                                            r_angsuran.r_ang__tenor_bulan AS r_ang__tenor_bulan,
                                            t_pinjaman.t_pjm__no_pinjaman AS t_pjm__no_pinjaman,
                                            t_pinjaman.t_pjm__approval AS t_pjm__approval,
                                            t_angsuran_pinjaman.t_ang__jenis AS t_ang__jenis,
                                            t_angsuran_pinjaman.t_ang__nopjm AS t_ang__nopjm,
                                            t_angsuran_pinjaman.t_ang__mutasi AS t_ang__mutasi,
                                            t_angsuran_pinjaman.t_ang__tanggal AS t_ang__tanggal,
                                            t_angsuran_pinjaman.t_ang__nilai_angsuran AS t_ang__nilai_angsuran,
                                             t_angsuran_pinjaman.t_ang__angsuran_ke AS t_ang__angsuran_ke
                                            FROM
                                                    r_pegawai
                                            INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                            INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                            INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                            INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                            INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                            INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                            INNER JOIN t_pinjaman ON t_pinjaman.t_pjm__mutasi = r_penempatan.r_pnpt__no_mutasi
                                            INNER JOIN t_angsuran_pinjaman ON t_angsuran_pinjaman.t_ang__mutasi = t_pinjaman.t_pjm__mutasi
                                            INNER JOIN r_angsuran ON r_angsuran.r_ang__id = t_pinjaman.t_pjm__jenis 
                                            WHERE t_pjm__approval=1 ";	

			}

                                if($nama_cari !=''){
					$sql .= " AND r_pegawai__nama LIKE  '%".$nama_cari."%' "; 
				}
                                if($nopjm_cari !=''){
					$sql .= " AND t_ang__nopjm =  '".$nopjm_cari."' "; 
				}

                               

				$sql .= " ORDER BY  trim(r_pegawai__nama) asc ";
                         
 
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



//view-tambah


$sql ="SELECT
  B.r_ang__id AS r_ang__id,
  B.r_ang__jenis AS r_ang__jenis,
  B.r_ang__platfond AS r_ang__jenis,
  B.r_ang__ket AS r_ang__ket,
  B.r_ang__total AS r_ang__total,
  B.r_ang__tenor_bulan AS r_ang__tenor_bulan,
  B.r_ang__cicilan AS r_ang__cicilan,
  C.t_pjm__no_pinjaman,
  C.t_pjm__jenis,
  C.t_pjm__mutasi,
  C.t_pjm__tgl_disetujui,
  C.t_pjm__approval AS t_pjm__approval,
  C.t_pjm__keterangan,
  peg.r_pegawai__nama,
  peg.r_pnpt__no_mutasi,
  peg.r_cabang__nama,
  peg.r_pnpt__finger_print
FROM r_angsuran B
  INNER JOIN t_pinjaman C ON B.r_ang__id=C.t_pjm__jenis
  INNER JOIN v_pegawai peg ON peg.r_pnpt__no_mutasi=C.t_pjm__mutasi
WHERE
  t_pjm__approval = 1 ";
//var_dump($sql)or die();
$rs_cek_list_parent = $db->execute($sql);

$arr_cek_list = array();
$daftar_parent_menu = array();

while($arr = $rs_cek_list_parent->FetchRow()){
	array_push ($arr_cek_list, $arr);

	$daftar_parent_menu[] = $arr['t_pjm__no_pinjaman'];

}
//var_dump($daftar_parent_menu)or die();
//masih dogol...
/*** Debug
End Debug ***/
$implode_daftar_parent_id= implode(",",$daftar_parent_menu);

for($x=0; $x<count($implode_daftar_parent_id); $x++){
	//echo "daftar_parent_id:".$implode_daftar_parent_id[$x]."</br>";
}

$smarty->assign ("IMPLODE_DAFTAR_PARENT_ID", $implode_daftar_parent_id);





$sql = "SELECT
  B.r_ang__id AS r_ang__id,
  B.r_ang__jenis AS r_ang__jenis,
  B.r_ang__platfond AS r_ang__platfond,
  B.r_ang__ket AS r_ang__ket,
  B.r_ang__total AS r_ang__total,
  B.r_ang__tenor_bulan AS r_ang__tenor_bulan,
  B.r_ang__cicilan AS r_ang__cicilan,
  C.t_pjm__no_pinjaman AS t_pjm__no_pinjaman ,
  C.t_pjm__jenis AS t_pjm__jenis,
  C.t_pjm__mutasi AS t_pjm__mutasi,
  C.t_pjm__tgl_disetujui AS t_pjm__tgl_disetujui ,
  C.t_pjm__approval AS t_pjm__approval ,
  C.t_pjm__keterangan AS t_pjm__keterangan,
  peg.r_pegawai__nama AS r_pegawai__nama,
  peg.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
  peg.r_cabang__nama AS r_cabang__nama,
  peg.r_pnpt__finger_print AS r_pnpt__finger_print,
  peg.r_pnpt__nip AS r_pnpt__nip
FROM r_angsuran B
  INNER JOIN t_pinjaman C ON B.r_ang__id=C.t_pjm__jenis
  INNER JOIN v_pegawai peg ON peg.r_pnpt__no_mutasi=C.t_pjm__mutasi
WHERE
  t_pjm__approval = 1 ";
$result_list_pjm = $db->Execute($sql);
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





//close-view-tambah
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