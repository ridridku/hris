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
$smarty->assign ("JENIS_USER_SES", $jenis_user);
$smarty->assign ("KODE_PW_SES", $kode_pw_ses);

#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);

$smarty->assign ("HREF_HOME_PATH_AJAX", $HREF_HOME.'/modules/master/periode_aktif');
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/master/periode_aktif/';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/master');
$FILE_JS  = $JS_MODUL.'/periode_aktif';

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
$tbl_name	= "r_periode_payroll";

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


$tahun_ses_aktif		=$_SESSION['SESSION_TAHUN_AKTIF'];
$bulan_ses_aktif		=$_SESSION['SESSION_BULAN_AKTIF'];
$smarty->assign ("TAHUN_SES", $tahun_ses_aktif);
$smarty->assign ("BULAN_SES", $bulan_ses_aktif);

 
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
//-------------CLOSE DATA CABANG--------------------------------------//

//-----------------------VIEW EDIT ---------------------------------------//
$opt = $_GET[opt];
$ed = 0;
if($opt=="1")
{ 

    $sql_= "Select * from r_periode_payroll A WHERE A.r_periode__payroll_id='".$_GET['id']."'";     
    $resultSet = $db->Execute($sql_);                    
    $edit_r_periode__payroll_id = $resultSet->fields[r_periode__payroll_id];
    $edit_r_periode__payroll_bulan = $resultSet->fields[r_periode__payroll_bulan];
    $edit_r_periode__payroll_tahun = $resultSet->fields[r_periode__payroll_tahun];
    $edit_r_periode__payroll_status = $resultSet->fields[r_periode__payroll_status];
    
    
    $edit_r_periode__payroll_created = $resultSet->fields[r_periode__payroll_created];
    $edit_r_periode__payroll_user_created = $resultSet->fields[r_periode__payroll_user_created];
    $edit_r_periode__payroll_updated = $resultSet->fields[r_periode__payroll_updated];
    $edit_r_periode__payroll_user_updated = $resultSet->fields[r_periode__payroll_user_updated];
       
    $date_periode=$edit_r_periode__payroll_tahun.'-'.$edit_r_periode__payroll_bulan.'-'.'1'; 
       
    $smarty->assign ("OPT", $opt); //component_edit
    $smarty->assign ("EDIT_ID", $edit_id);//component_edit 
    
    $smarty->assign("EDIT_R_PERIODE__PAYROLL_ID",$edit_r_periode__payroll_id);
    $smarty->assign("EDIT_R_PERIODE__PAYROLL_BULAN", $edit_r_periode__payroll_bulan);
    $smarty->assign("EDIT_R_PERIODE__PAYROLL_TAHUN",$edit_r_periode__payroll_tahun);
    
    $smarty->assign("EDIT_R_PERIODE__PAYROLL_STATUS",$edit_r_periode__payroll_status);	
    $smarty->assign("EDIT_R_PERIODE__PAYROLL_CREATED",$edit_r_periode__payroll_created);	
    $smarty->assign("EDIT_R_PERIODE__PAYROLL_USER_CREATED",$edit_r_periode__payroll_user_created);	
    $smarty->assign("EDIT_R_PERIODE__PAYROLL_UPDATED",$edit_r_periode__payroll_updated);	
    $smarty->assign("EDIT_R_PERIODE__PAYROLL_USER_UPDATED",$edit_t_abs__jam_keluar);	
    
     //var_dump($sql_)or die(); 
  
    $smarty->assign ("EDIT_VAL", $edit);
}                    
//---------------------------------CLOSE VIEW EDIT ----------------------------------------------------------------//


//------------------------------------------VIEW INDEX ------------------------------------------------------------------------//
if ($_GET['search'] == '1')
    {
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
 
		  if($jenis_user=='2'){
                                                  $sql  = "SELECT
                                                            r_periode__payroll_id,
                                                            r_periode__payroll_awal,
                                                            r_periode__payroll_akhir,
                                                            r_periode__payroll_status,
                                                            r_periode__payroll_created,
                                                            r_periode__payroll_user_created,
                                                            r_periode__payroll_updated,
                                                            r_periode__payroll_user_updated
                                                          FROM
                                                            r_periode_payroll";
                      

			} else {
						$sql  = "SELECT
                                                            r_periode__payroll_id,
                                                            r_periode__payroll_awal,
                                                            r_periode__payroll_akhir,
                                                            r_periode__payroll_status,
                                                            r_periode__payroll_created,
                                                            r_periode__payroll_user_created,
                                                            r_periode__payroll_updated,
                                                            r_periode__payroll_user_updated
                                                          FROM
                                                            r_periode_payroll WHERE  1 = 1   ";	

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
          
                                                $sql = "SELECT
                                                            r_periode__payroll_id,
                                                            r_periode__payroll_awal,
                                                            r_periode__payroll_akhir,
                                                            r_periode__payroll_status,
                                                            r_periode__payroll_created,
                                                            r_periode__payroll_user_created,
                                                            r_periode__payroll_updated,
                                                            r_periode__payroll_user_updated
                                                          FROM
                                                            r_periode_payroll WHERE  1 = 1   ";
                                            

			} else {
						$sql  = "SELECT
                                                            r_periode__payroll_id,
                                                            r_periode__payroll_awal,
                                                            r_periode__payroll_akhir,
                                                            r_periode__payroll_status,
                                                            r_periode__payroll_created,
                                                            r_periode__payroll_user_created,
                                                            r_periode__payroll_updated,
                                                            r_periode__payroll_user_updated
                                                          FROM
                                                            r_periode_payroll WHERE  1 = 1  ";	

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
$smarty->assign ("DAFTAR_BULAN",$daftar_bulan);


$smarty->assign('cust_ids', array(1000,1001,1002,1003));
$smarty->assign('cust_names', array(
                              'Joe Schmoe',
                              'Jack Smith',
                              'Jane Johnson',
                              'Charlie Brown')
                              );
$smarty->assign('customer_id', 1001);

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
