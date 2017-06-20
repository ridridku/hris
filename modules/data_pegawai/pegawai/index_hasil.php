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
// echo "<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>";
#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);
//$smarty->assign ("HREF_HOME_PATH_AJAX", $HREF_HOME.'/modules/form_isian/form_peminjaman');
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_pegawai/pegawai';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_pegawai');
$FILE_JS  = $JS_MODUL.'/pegawai';

$JS_MODUL2 = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts');
  

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$jenis_user   = $_SESSION['SESSION_JNS_USER'];
$kode_pw_ses  = $_SESSION['SESSION_KODE_CABANG'];
$user_id = base64_decode($_SESSION['UID']);

$smarty->assign ("MOD_ID", $mod_id);

 
if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="kode_jadwal";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['kode_jadwal']) $KODE_JADWAL = $_GET['kode_jadwal'];
else if ($_POST['kode_jadwal']) $KODE_JADWAL = $_POST['kode_jadwal'];
else $KODE_JADWAL="";

if ($_GET['kode_proyek']) $KODE_PROYEK = $_GET['kode_proyek'];
else if ($_POST['kode_proyek']) $KODE_PROYEK = $_POST['kode_proyek'];
else $KODE_PROYEK="";

 
 

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_proyek=".$KODE_PROYEK."&kode_ruas=".$KODE_RUAS."&kode_instansi=".$KODE_INSTANSI."&kode_jadwal=".$KODE_JADWAL."&tgl=".$TGL;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;

$SES_TAHUN		    = $_SESSION['TAHUN'];
$SES_INSTANSI		= $_SESSION['KODE_INSTANSI'];
$SES_JENIS_USER		= $_SESSION['JENIS_USER'];
 

 IF ($_GET['ERR'] =='5') {
	 $label_error = "DATA SUDAH MASUK";
 } else {
	 $label_error = "DATA SUDAH MASUK";	
 }
$smarty->assign ("LABEL_ERROR", $label_error);


//view_index
if ($_GET['search'] == '1')
    {
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
 
		  if($jenis_user=='2'){

                                                $sql  = "select A.r_pegawai__id AS r_pegawai__id,A.r_pegawai__nama AS r_pegawai__nama, A.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk 
            from r_pegawai A where A.r_pegawai__id not in (select distinct B.r_pnpt__id_pegawai from r_penempatan B)";
			} else {
						$sql  = " select A.r_pegawai__id AS r_pegawai__id,A.r_pegawai__nama AS r_pegawai__nama, A.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk 
            from r_pegawai A where A.r_pegawai__id not in (select distinct B.r_pnpt__id_pegawai from r_penempatan B) ";	

			}
 
				//echo "<br><br><br><br><br><br><br><br><br><br>dddddddddkode_perwakilan_cari ===".$kode_perwakilan_cari;
//                                if($kode_cabang_cari !=''){
//					$sql .= "AND peg.r_cabang__id = '".$kode_cabang_cari."' ";
//				}
//				if($kode_subcab_cari !=''){
//					$sql .= "AND peg.r_subcab__id = '".$kode_subcab_cari."' "; 
//				}
//
//				if( $departemen_cari!=''){
//					$sql .= "AND peg.r_dept__id = '".$departemen_cari."' ";
//				} 
//                                if($nama_pegawai_cari!=''){
//					
//                                        $sql .= "AND peg.r_pegawai__nama LIKE '%".addslashes($nama_pegawai_cari)."%'";
//				} 
//                                 if($finger_pegawai_cari!=''){
//					
//                                        $sql .= "AND peg.r_pnpt__finger_print ='".$finger_pegawai_cari."'";
//				} 
				


				$sql .= "ORDER BY  r_pegawai__id asc ";

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
				$count_all  = $start+$end;
				$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 
}

}
else
    
{
				

			if($jenis_user=='2'){

                                                
$sql =  "SELECT
A.r_pegawai__id AS r_pegawai__id,
A.r_pegawai__nama AS r_pegawai__nama,
A.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk
FROM r_pegawai A,r_cabang C
WHERE 
A.r_pegawai__id NOT IN (SELECT DISTINCT B.r_pnpt__id_pegawai FROM r_penempatan B) AND C.r_cabang__id=A.r_pegawai__id_subcab AND r_cabang__id='$kode_pw_ses'";
                                            

			} else {
						$sql  =  "select A.r_pegawai__id AS r_pegawai__id,A.r_pegawai__nama AS r_pegawai__nama, A.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk 
            from r_pegawai A where A.r_pegawai__id not in (select distinct B.r_pnpt__id_pegawai from r_penempatan B) ";	

			}

				
                      



//                         if($kode_cabang_cari !=''){
//					$sql .= "AND peg.r_cabang__id = '".$kode_cabang_cari."' ";
//				}
//				if($kode_subcab_cari !=''){
//					$sql .= "AND peg.r_subcab__id = '".$kode_subcab_cari."' "; 
//				}
//
//				if( $departemen_cari!=''){
//					$sql .= "AND peg.r_dept__id = '".$departemen_cari."' ";
//				} 
//                                if($nama_pegawai_cari!=''){
//					
//                                        $sql .= "AND peg.r_pegawai__nama LIKE '%".addslashes($nama_pegawai_cari)."%'";
//				} 
//                                 if($finger_pegawai_cari!=''){
//					
//                                        $sql .= "AND peg.r_pnpt__finger_print ='".$finger_pegawai_cari."'";
//				} 
                                
                                
                            $sql .= " ORDER BY r_pegawai__id asc ";
 
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
				$count_all  = $start+$end;
				$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 
}
//close_VIEW

  
$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_KAT);
$smarty->assign ("TB_NO", _NO);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_INSTANSI);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("TITLE", _TITLE_KAT);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_KAT);
$smarty->assign ("TB_CODE", _ID_KAT);
$smarty->assign ("TB_NAME", _NAMA_KAT);
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
$smarty->assign ("LIST", _LIST_PROP);
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


$smarty->assign ("SES_TAHUN", $SES_TAHUN);
$smarty->assign ("SES_INSTANSI", $SES_INSTANSI);
$smarty->assign ("SES_JENIS_USER", $SES_JENIS_USER);
 


# Finally Grab All Parsed variables, parse it into the template, and generate ouput
# Clear Cache First
$smarty->clear_cache ($TPL_PATH.'/'.$DOC_SELF_NAME_ONLY.'.tpl');
# Parsing the proper theme template & Generate Output
$smarty->display ($TPL_PATH.'/'.$DOC_SELF_NAME_ONLY.'.tpl');
//require_once($DIR_THEME.'/'.base64_decode($_SESSION['THEME']).$DOC_SELF_PATH.$DOC_SELF_NAME_ONLY.'.tpl');
//=================================== END PARSING TEMPLATE BLOCK====================================
# Store all the JavaScript  for this pages into /javascripts/file_name  and include it here (bottom page)
//require_once($FILE_JS.'/'.$DOC_SELF_NAME_ONLY.'.js');

# AdoDb closed here
$db->Close();
}
?>