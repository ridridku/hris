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
$tahun_session	= $_SESSION['SESSION_TAHUN'];
$bulan_session	= $_SESSION['SESSION_BULAN'];  

$smarty->assign ("JENIS_USER_SES", $jenis_user);
$smarty->assign ("KODE_PW_SES", $kode_pw_ses);

$smarty->assign ("TAHUN_SESSION", $tahun_session);
$smarty->assign ("BULAN_SESSION", $bulan_session);

#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);

$smarty->assign ("HREF_HOME_PATH_AJAX", $HREF_HOME.'/modules/kehadiran/rekap_kehadiran_hglm');
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kehadiran/rekap_kehadiran_hglm';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kehadiran');
$FILE_JS  = $JS_MODUL.'/rekap_kehadiran_hglm';

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}

$user_id = base64_decode($_SESSION['UID']);
$smarty->assign ("MOD_ID",$mod_id);
#Initiate TABLE
$tbl_name	= "t_rekap_absensi";

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
 
$smarty->assign ("KODE_PERWAKILAN_CARI", $kode_perwakilan_cari);
$smarty->assign ("NAMA_KARYAWAN_CARI", $nama_karyawan_cari);
$smarty->assign ("NO_PASPOR_CARI", $no_paspor_cari);
$smarty->assign ("NAMA_WNI_CARI", $nama_wni_cari);
$smarty->assign ("KODE_SUMBER", $kode_sumber);
 

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_perwakilan_cari=".$kode_perwakilan_cari."&no_paspor_cari=".$no_paspor_cari."&nama_karyawan_cari=".$nama_karyawan_cari."&kode_sumber=".$kode_sumber;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;

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
//----------------------CLOSE DATA CABANG-------------------------------------------------------------//

//-----------------BLN PERIODE AKTIF--------------------------------------------------------------//
$sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_bulan,r_periode__payroll_tahun,r_periode__payroll_status
                                  FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
                  
        $rs_val = $db->Execute($sql_cek_periode);
        $periode_bulan= $rs_val->fields['r_periode__payroll_bulan'];
        $periode_tahun= $rs_val->fields['r_periode__payroll_tahun'];

        $smarty->assign ("PERIODE_BULAN",$periode_bulan);
        $smarty->assign ("PERIODE_TAHUN",$periode_tahun);

//--------------CLOSE BLN PERIODE AKTIF-----------------------------------//




//-----------------------VIEW EDIT ---------------------------------------//
$opt = $_GET[opt];
$ed = 0;
if($opt=="1")
{ 

        $sql_= "SELECT B.r_pnpt__shift,
                    B.r_pnpt__subcab,
                    C.r_pegawai__nama,
                    CAB.r_cabang__nama,
                    CAB.r_cabang__id,
                    A.*
              FROM
                    t_absensi A
                    LEFT JOIN r_penempatan B ON A.t_abs__fingerprint=B.r_pnpt__finger_print
                    LEFT JOIN r_pegawai C ON C.r_pegawai__id=B.r_pnpt__id_pegawai
                    LEFT JOIN(SELECT D.r_cabang__id,D.r_cabang__nama from r_cabang D,r_penempatan E WHERE E.r_pnpt__subcab=D.r_cabang__id) AS CAB ON CAB.r_cabang__id = B.r_pnpt__subcab
              WHERE
                    A.t_abs__fingerprint = B.r_pnpt__finger_print AND B.r_pnpt__id_pegawai = C.r_pegawai__id
                    AND A.t_abs__id='".$_GET['id']."'";

        
    $resultSet = $db->Execute($sql_);                    
    $edit_t_abs__id = $resultSet->fields[t_abs__id];
    $edit_r_pegawai__nama = $resultSet->fields[r_pegawai__nama];
    $edit_r_cabang__id = $resultSet->fields[r_cabang__id];
    $edit_t_abs__fingerprint = $resultSet->fields[t_abs__fingerprint];
    $edit_t_abs__tgl = $resultSet->fields[t_abs__tgl];
    $edit_t_abs__id_shift = $resultSet->fields[t_abs__id_shift];
    $edit_t_abs__jam_masuk = $resultSet->fields[t_abs__jam_masuk];
    $edit_t_abs__jam_keluar = $resultSet->fields[t_abs__jam_keluar];
    $edit_t_abs__early = $resultSet->fields[t_abs__early];
    $edit_t_abs__lately = $resultSet->fields[t_abs__lately];
    $edit_t_abs__approval = $resultSet->fields[t_abs__approval];
    $edit_t_abs__lesstime = $resultSet->fields[t_abs__lesstime];
    $edit_t_abs__overtime = $resultSet->fields[t_abs__overtime];
    $edit_t_abs__worktime = $resultSet->fields[t_abs__worktime];
    $edit_t_abs__status = $resultSet->fields[t_abs__status];
    $edit_t_abs__catatan = $resultSet->fields[t_abs__catatan];
    $edit_t_abs__date_created = $resultSet->fields[t_abs__date_created];
    $edit_t_abs__date_updated = $resultSet->fields[t_abs__date_updated];
    $edit_t_abs__user_created = $resultSet->fields[t_abs__user_created];
    $edit_t_abs__user_updated = $resultSet->fields[t_abs__user_updated];
                        
    $smarty->assign ("OPT", $opt); //component_edit
    $smarty->assign ("EDIT_ID", $edit_id);//component_edit 
    
    $smarty->assign("EDIT_T_ABS__ID",$edit_t_abs__id);
    $smarty->assign("EDIT_T_ABS__NAMA", $edit_r_pegawai__nama);
    $smarty->assign("EDIT_KODE_CABANG",$edit_r_cabang__id);
    
    $smarty->assign("EDIT_T_ABS__FINGERPRINT",$edit_t_abs__fingerprint);	
    $smarty->assign("EDIT_T_ABS__TGL",$edit_t_abs__tgl);	
    $smarty->assign("EDIT_T_ABS__ID_SHIFT",$edit_t_abs__id_shift);	
    $smarty->assign("EDIT_T_ABS__JAM_MASUK",$edit_t_abs__jam_masuk);	
    $smarty->assign("EDIT_T_ABS__JAM_KELUAR",$edit_t_abs__jam_keluar);	
    $smarty->assign("EDIT_T_ABS__EARLY",$edit_t_abs__early);	
    $smarty->assign("EDIT_T_ABS__LATELY",$edit_t_abs__lately);	
    $smarty->assign("EDIT_T_ABS__APPROVAL",$edit_t_abs__approval);	
    $smarty->assign("EDIT_T_ABS__LESSTIME",$edit_t_abs__lesstime);	
    $smarty->assign("EDIT_T_ABS__OVERTIME",$edit_t_abs__overtime);	
    $smarty->assign("EDIT_T_ABS__WORKTIME",$edit_t_abs__worktime);	
    $smarty->assign("EDIT_T_ABS__STATUS",$edit_t_abs__status);	
    $smarty->assign("EDIT_T_ABS__CATATAN",$edit_t_abs__catatan);	
    $smarty->assign("EDIT_T_ABS__DATE_CREATED",$edit_t_abs__date_created);	
    $smarty->assign("EDIT_T_ABS__DATE_UPDATED",$edit_t_abs__date_updated);	
    $smarty->assign("EDIT_T_ABS__USER_CREATED",$edit_t_abs__user_created);	
    $smarty->assign("EDIT_T_ABS__USER_UPDATED",$edit_t_abs__user_updated);
    
    $smarty->assign ("EDIT_VAL", $edit);
}                    
//---------------------------------CLOSE VIEW EDIT ----------------------------------------------------------------//





//---------------------------------VIEW INDEX---------------------------------------------------------------------//
if ($_GET['search'] == '1')
    {
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
 
		  if($jenis_user=='2'){
                                                  $sql  = "SELECT peg.r_pegawai__nama,peg.r_pnpt__finger_print,
                                                            peg.r_cabang__nama,
                                                            peg.r_cabang__id,
                                                            peg.r_subcab__id,
                                                            peg.r_subcab__nama,
                                                            peg.r_dept__id,
                                                            peg.r_dept__ket,
                                                            ra.t_rkp__no_mutasi,
                                                            ra.t_rkp__bln,
                                                            ra.t_rkp__thn,
                                                            ra.t_rkp__approval,
                                                            ra.t_rkp__hadir,
                                                            ra.t_rkp__sakit,
                                                            ra.t_rkp__izin,
                                                            ra.t_rkp__cuti,
                                                            ra.t_rkp__dinas,
                                                            ra.t_rkp__alpa,
                                                            ra. t_rkp__keterangan
                                                            FROM
                                                            t_rekap_absensi ra 
                                                                    LEFT JOIN v_pegawai peg ON ra.t_rkp__no_mutasi=peg.r_pnpt__no_mutasi WHERE 1=1"  
                                                        . "AND  peg.r_cabang__id= '".$kode_pw_ses."'";
                      

			} else {
						$sql  = "SELECT peg.r_pegawai__nama,peg.r_pnpt__finger_print,
                                                            peg.r_cabang__nama,
                                                            peg.r_cabang__id,
                                                            peg.r_subcab__id,
                                                            peg.r_subcab__nama,
                                                            peg.r_dept__id,
                                                            peg.r_dept__ket,
                                                            ra.t_rkp__no_mutasi,
                                                            ra.t_rkp__bln,
                                                            ra.t_rkp__thn,
                                                            ra.t_rkp__approval,
                                                            ra.t_rkp__hadir,
                                                            ra.t_rkp__sakit,
                                                            ra.t_rkp__izin,
                                                            ra.t_rkp__cuti,
                                                            ra.t_rkp__dinas,
                                                            ra.t_rkp__alpa,
                                                            ra.t_rkp__keterangan
                                                             FROM
                                                            t_rekap_absensi ra 
                                                            LEFT JOIN v_pegawai peg ON ra.t_rkp__no_mutasi=peg.r_pnpt__no_mutasi WHERE 1=1 ";	

			}
 
				//echo "<br><br><br><br><br><br><br><br><br><br>dddddddddkode_perwakilan_cari ===".$kode_perwakilan_cari;


				 
//				if($kode_perwakilan_cari !=''){
//					$sql .= "AND  CAB.r_cabang__id= '".$kode_perwakilan_cari."' ";
//				}
//				if($nama_karyawan_cari !=''){
//					$sql .= "AND  C.r_pegawai__nama LIKE '%".addslashes($nama_karyawan_cari)."%' "; 
//				}
/*
				if($nama_wni_cari!=''){
					$sql .= "AND tbl_wni.nama LIKE '%".addslashes($nama_wni_cari)."%' ";
				} 

				if($kode_sumber!=''){
					$sql .= "AND  tbl_wni.kode_sumber = '$kode_sumber' ";
				} */

 
			 	// $sql .= " GROUP BY A.t_abs__fingerprint,A.t_abs__tgl,C.r_pegawai__nama ORDER BY  trim(C.r_pegawai__nama) asc ";

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
          
                                                $sql  = "SELECT peg.r_pegawai__nama,peg.r_pnpt__finger_print,
                                                            peg.r_cabang__nama,
                                                            peg.r_cabang__id,
                                                            peg.r_subcab__id,
                                                            peg.r_subcab__nama,
                                                            peg.r_dept__id,
                                                            peg.r_dept__ket,
                                                            ra.t_rkp__no_mutasi,
                                                            ra.t_rkp__bln,
                                                            ra.t_rkp__thn,
                                                            ra.t_rkp__approval,
                                                            ra.t_rkp__hadir,
                                                            ra.t_rkp__sakit,
                                                            ra.t_rkp__izin,
                                                            ra.t_rkp__cuti,
                                                            ra.t_rkp__dinas,
                                                            ra.t_rkp__alpa,
                                                            ra. t_rkp__keterangan  FROM t_rekap_absensi ra 
                                                            LEFT JOIN v_pegawai peg ON ra.t_rkp__no_mutasi=peg.r_pnpt__no_mutasi WHERE 1=1 AND  peg.r_cabang__id= '".$kode_pw_ses."'";
                                            

			} else {
						$sql  = "SELECT peg.r_pegawai__nama,peg.r_pnpt__finger_print,
                                                            peg.r_cabang__nama,
                                                            peg.r_cabang__id,
                                                            peg.r_subcab__id,
                                                            peg.r_subcab__nama,
                                                            peg.r_dept__id,
                                                            peg.r_dept__ket,
                                                            ra.t_rkp__no_mutasi,
                                                            ra.t_rkp__bln,
                                                            ra.t_rkp__thn,
                                                            ra.t_rkp__approval,
                                                            ra.t_rkp__hadir,
                                                            ra.t_rkp__sakit,
                                                            ra.t_rkp__izin,
                                                            ra.t_rkp__cuti,
                                                            ra.t_rkp__dinas,
                                                            ra.t_rkp__alpa,
                                                            ra. t_rkp__keterangan
                                                                  FROM
                                                                  t_rekap_absensi ra 
                                                                    LEFT JOIN v_pegawai peg ON ra.t_rkp__no_mutasi=peg.r_pnpt__no_mutasi WHERE 1=1   ";	

			}
                               
                        
//                                if($kode_perwakilan_cari !=''){
//					$sql .= "AND  CAB.r_cabang__id= '".$kode_perwakilan_cari."'  ";
//				}
//				if($nama_karyawan_cari !=''){
//					$sql .= "AND  C.r_pegawai__nama LIKE '%".$nama_karyawan_cari."%' "; 
//				}
//
//				if($nama_wni_cari!=''){
//					$sql .= "AND tbl_wni.nama LIKE '%".addslashes($nama_wni_cari)."%' ";
//				} 
//
//				if($kode_sumber!=''){
//					$sql .= "AND  tbl_wni.kode_sumber = '$kode_sumber' ";
//				} 
//
// 
// 
				//$sql .= " GROUP BY A.t_abs__fingerprint,A.t_abs__tgl ORDER BY  trim(C.r_pegawai__nama) asc  ";
 
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

  
  //var_dump($tgl_masuk) or die();

//---------------     LOOPING       -----------------------------------------///
$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_KELURAHAN);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_KELURAHAN);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("TITLE", _TITLE_KEL);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_KEL);

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
