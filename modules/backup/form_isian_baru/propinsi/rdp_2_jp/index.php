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
} else {

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/propinsi/rdp_2_jp';

#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/propinsi/rdp_2_jp';

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
} else {
		$mod_id = $_GET['mod_id'];
}

$user_id = base64_decode($_SESSION['UID']);

$smarty->assign ("MOD_ID", $mod_id);

#Initiate TABLE

$tbl_name_main = "tbl_form_rd_02_jp_main";
$tbl_name_detail = "tbl_form_rd_02_jp_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
$tbl_name_jenis_loan_phln = "tbl_mast_prop_loan_phln";
$tbl_name_sumber_dana_lain = "tbl_mast_prop_sumber_dana_lain";


//-----------------------------------END OF LOCAL CONFIG-------------------------------//

if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="a.id_form_rd_02_jp_detail";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['no_propinsi']) $no_propinsi = $_GET['no_propinsi'];
else if ($_POST['no_propinsi']) $no_propinsi = $_POST['no_propinsi'];
else $no_propinsi="";

if ($_GET['no_kabupaten']) $no_kabupaten = $_GET['no_kabupaten'];
else if ($_POST['no_kabupaten']) $no_kabupaten = $_POST['no_kabupaten'];
else $no_kabupaten="";

if ($_GET['Date_Year']) $tahun = $_GET['Date_Year'];
else if ($_POST['Date_Year']) $tahun = $_POST['Date_Year'];
else $tahun="";

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&search=".$search."&Date_Year=".$tahun;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&search=".$search."&Date_Year=".$tahun;

//----------EDIT DATA  -----------------------------------

$opt = $_GET[opt];
$id_form_rd_02_jp_main = $_GET[id_form_rd_02_jp_main];
$id_form_jl_02_detail = $_GET[id_form_rd_02_jp_detail];
$ed = 0;

if ($opt=="1" AND $id_form_rd_02_jp_main<>'' AND $id_form_jl_02_detail<>'') {

$sql = "SELECT * 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_form_rd_02_jp_main=b.id_form_rd_02_jp_main 
		WHERE 1=1 AND b.id_form_rd_02_jp_main='".$id_form_rd_02_jp_main."' AND a.id_form_rd_02_jp_detail='".$id_form_jl_02_detail."' ";
//print $sql;		
$recordSet_Edit = $db->execute($sql);

$edit = 1;	

$smarty->assign ("OPT", $opt);					
$smarty->assign ("ID_FORM_RD_02_MAIN", $recordSet_Edit->fields[id_form_rd_02_jp_main]);
$smarty->assign ("ID_FORM_RD_02_DETAIL", $recordSet_Edit->fields[id_form_rd_02_jp_detail]);
$smarty->assign ("TANGGAL", $recordSet_Edit->fields[tanggal]);
$smarty->assign ("KODE_PROYEK", $recordSet_Edit->fields[kode_proyek]);
$smarty->assign ("JENIS_PENANGANAN", $recordSet_Edit->fields[jenis_penanganan]);
$smarty->assign ("JUMLAH_PROYEK_PER_PAKET", $recordSet_Edit->fields[jumlah_proyek_per_paket]);
$smarty->assign ("JUMLAH_KABUPATEN", $recordSet_Edit->fields[jumlah_kabupaten]);
$smarty->assign ("TOTAL_PANJANG_RUAS", $recordSet_Edit->fields[total_panjang_ruas]);
$smarty->assign ("PANJANG_PROYEK_JALAN", $recordSet_Edit->fields[panjang_proyek_jalan]);
$smarty->assign ("BIAYA_JALAN", $recordSet_Edit->fields[biaya_jalan]);
$smarty->assign ("JUMLAH_JEMBATAN", $recordSet_Edit->fields[jumlah_jembatan]);
$smarty->assign ("PANJANG_JEMBATAN", $recordSet_Edit->fields[panjang_jembatan]);
$smarty->assign ("BIAYA_JEMBATAN", $recordSet_Edit->fields[biaya_jembatan]);
$smarty->assign ("BIAYA_UMUM", $recordSet_Edit->fields[biaya_umum]);
$smarty->assign ("TOTAL_BIAYA", $recordSet_Edit->fields[total_biaya]);
$smarty->assign ("PAD1", $recordSet_Edit->fields[pad1]);
$smarty->assign ("DU_PROP", $recordSet_Edit->fields[du_prop]);
$smarty->assign ("PJP_PROP", $recordSet_Edit->fields[pjp_prop]);
$smarty->assign ("JENIS_LOAN_PHLN", $recordSet_Edit->fields[jenis_loan_phln]);
$smarty->assign ("JUMLAH_LOAN_PHLN", $recordSet_Edit->fields[jumlah_loan_phln]);
$smarty->assign ("JENIS_SUMBER_DANA_LAIN", $recordSet_Edit->fields[jenis_sumber_dana_lain]);
$smarty->assign ("JUMLAH_SUMBER_DANA_LAIN", $recordSet_Edit->fields[jumlah_sumber_dana_lain]);
$smarty->assign ("KETERANGAN", $recordSet_Edit->fields[keterangan]);
}

//-------------MASTER WILAYAH PROPINSI---------------------------

$sql_propinsi = " SELECT no_propinsi,nama_propinsi FROM ".$tbl_name_propinsi." GROUP BY nama_propinsi ORDER BY no_propinsi ASC ";
$recordSet_propinsi = $db->Execute($sql_propinsi);
$initSet = array();
$data_propinsi = array();
$z=0;
while ($arr=$recordSet_propinsi->FetchRow()) {
	array_push($data_propinsi, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PROPINSI", $data_propinsi);

//---------------------------------------------------------------

$sql_dpa = "SELECT b.id_form_rd_01_jp_detail,b.kode_proyek FROM tbl_form_rd_01_jp_main a LEFT JOIN tbl_form_rd_01_jp_detail b ON a.id_form_rd_01_jp_main=b.id_form_rd_01_jp_main WHERE a.no_propinsi='".$_GET[no_propinsi]."' and YEAR(a.tanggal)='".$_GET[Date_Year]."' ORDER BY b.kode_proyek ASC";
$recordSet_dpa = $db->Execute($sql_dpa);

$initSet = array();
$data_dpa = array();
$z=0;
while ($arr=$recordSet_dpa->FetchRow()) {
	array_push($data_dpa, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_DPA", $data_dpa);

if ($_GET[get_kode] == 1)
{
	$_no_propinsi = $_GET[no_propinsi];
	$_tahun = $_GET[tahun];
	
			if($_no_propinsi!='' && $_tahun!=''){	
					$sql_kode 	  = "SELECT b.id_form_rd_01_jp_detail,b.kode_proyek FROM tbl_form_rd_01_jp_main a LEFT JOIN tbl_form_rd_01_jp_detail b ON a.id_form_rd_01_jp_main=b.id_form_rd_01_jp_main WHERE a.no_propinsi='".$_no_propinsi."' and YEAR(a.tanggal)='".$_tahun."' ORDER BY b.kode_proyek ASC";
					$result_kode = $db->Execute($sql_kode);
					
					$input_kode="<select name=\"kode_proyek\"  onChange=\"cari_proyek();\">";
					$input_kode.="<option>[Pilih Kode Proyek]";
					$input_kode.="</option> ";
					while(!$result_kode ->EOF): 												
						$input_kode.="<option value=";
						$input_kode.= $result_kode  ->fields['kode_proyek'].">".$result_kode ->fields['kode_proyek'];   
						$input_kode.="</option>";
					$result_kode->MoveNext();
					endwhile; 
					$input_kode.="</select> ";
					
					//
					$delimeter   = "-";
					$option_choice = $input_kode."^/&".$delimeter;	
					echo $option_choice;
			}
}

if ($_GET[get_proyek] == 1)
{
	$_no_propinsi = $_GET[no_propinsi];
	$_tahun = $_GET[tahun];
	$_kode_proyek = $_GET[kode_proyek];
	
			if($_no_propinsi!='' && $_tahun!='' && $_kode_proyek!=''){	
					$sql_proyek 	  = "SELECT b.* FROM tbl_form_rd_01_jp_main a LEFT JOIN tbl_form_rd_01_jp_detail b ON a.id_form_rd_01_jp_main=b.id_form_rd_01_jp_main WHERE a.no_propinsi='".$_no_propinsi."' and YEAR(a.tanggal)='".$_tahun."' and b.kode_proyek='".$_kode_proyek."'";
					$result_proyek  = $db->Execute($sql_proyek);
					
					$input_jenis_penanganan = $result_proyek->fields[jenis_penanganan];
					$input_kabupaten = count(explode(';',$result_proyek->fields[kabupaten]));
					$input_panjang_jalan = $result_proyek->fields[panjang_jalan];
					$input_panjang_proyek = $result_proyek->fields[panjang_proyek];
					$input_biaya_jalan = $result_proyek->fields[biaya_jalan];
					$input_jumlah_jembatan = $result_proyek->fields[jumlah_jembatan];
					$input_panjang_jembatan = $result_proyek->fields[panjang_jembatan];
					$input_biaya_jembatan = $result_proyek->fields[biaya_jembatan];
					$input_total_biaya = $result_proyek->fields[total_biaya];
					$input_pad1 = $result_proyek->fields[pad1];
					$input_du_dpp = $result_proyek->fields[du_prop];
					$input_pjp_dpp = $result_proyek->fields[pjp_prop];
					$input_jenis_loan_phln = $result_proyek->fields[jenis_loan_phln];
					$input_jumlah_loan_phln = $result_proyek->fields[jumlah_loan_phln];
					$input_jenis_sumber_dana_lain = $result_proyek->fields[jenis_sumber_dana_lain];
					$input_jumlah_sumber_dana_lain = $result_proyek->fields[jumlah_sumber_dana_lain];
					$input_keterangan = $result_proyek->fields[keterangan];
					
					//
					$delimeter   = "-";
					$option_choice = $input_kabupaten."^/&".$input_jenis_penanganan."^/&".$input_panjang_jalan."^/&".$input_panjang_proyek."^/&".$input_biaya_jalan."^/&".$input_jumlah_jembatan."^/&".$input_panjang_jembatan."^/&".$input_biaya_jembatan."^/&".$input_total_biaya."^/&".$input_pad1."^/&".$input_du_dpp."^/&".$input_pjp_dpp."^/&".$input_jenis_loan_phln."^/&".$input_jumlah_loan_phln."^/&".$input_jenis_sumber_dana_lain."^/&".$input_jumlah_sumber_dana_lain."^/&".$input_keterangan."^/&".$delimeter;	
					echo $option_choice;
			}
}


$sql_jenis_penanganan = "SELECT * FROM tbl_mast_prop_jenis_penanganan ORDER BY id_prop_jenis_penanganan ASC";
$recordSet_jenis_penanganan = $db->Execute($sql_jenis_penanganan);
$initSet = array();
$data_jenis_penanganan = array();
$z=0;
while ($arr=$recordSet_jenis_penanganan->FetchRow()) {
	array_push($data_jenis_penanganan, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_JENIS_PENANGANAN", $data_jenis_penanganan);

//----------Menampilkan Data Kabupaten---------------------------

if ($_GET[get_propinsi] == 1)
{
	$no_propinsi = $_GET[no_propinsi];
			if($no_propinsi!=''){	
					$sql_kab_combo 	  = "SELECT * FROM ".$tbl_name_kabupaten." where no_propinsi='$no_propinsi'";
					$result_kab_combo  = $db->Execute($sql_kab_combo);
					$input_kab="<select name=no_kabupaten>";
					$input_kab.="<option>[Pilih Kabupaten]";
					$input_kab.="</option> ";
					while(!$result_kab_combo ->EOF): 						
						($result_kab_combo  ->fields['no_kabupaten']==$no_kabupaten) ? $selected=" selected":$selected=NULL;
						$input_kab.="<option value=";
						$input_kab.= $result_kab_combo  ->fields['no_kabupaten']."".$selected.">".$result_kab_combo ->fields['nama_kabupaten'];   
						$input_kab.="</option>";
					$result_kab_combo->MoveNext();
					endwhile; 
					$input_kab.="</select> ";
					//
					$delimeter   = "-";
					$option_choice = $input_kab."^/&".$delimeter;	
					echo $option_choice;
			}
}

//---------------------------------------------------------------

if($no_propinsi!=''){	
	$sql_kabupaten 	  = "SELECT * FROM ".$tbl_name_kabupaten." where no_propinsi='$no_propinsi'";
	$recordSet_kabupaten = $db->Execute($sql_kabupaten);
	$initSet = array();
	$data_kabupaten = array();
	$z=0;
	while ($arr=$recordSet_kabupaten->FetchRow()) {
		array_push($data_kabupaten, $arr);
		array_push($initSet, $z);
		$z++;
	}
	$smarty->assign ("DATA_KABUPATEN", $data_kabupaten);
}
	
//-----JENIS LOAN PHLN---------------------------------------

$sql_jenis_loan_phln = "SELECT * FROM ".$tbl_name_jenis_loan_phln." ORDER BY id_prop_loan_phln ASC";
$recordSet_jenis_loan_phln = $db->Execute($sql_jenis_loan_phln);
$initSet = array();
$data_jenis_loan_phln = array();
$z=0;
while ($arr=$recordSet_jenis_loan_phln->FetchRow()) {
	array_push($data_jenis_loan_phln, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_JENIS_LOAN_PHLN", $data_jenis_loan_phln);

//--------------------------------------------------------------------
		
//-----JENIS SUMBER DANA LAIN---------------------------------------

$sql_sumber_dana_lain = "SELECT * FROM ".$tbl_name_sumber_dana_lain." ORDER BY id_prop_sumber_dana_lain ASC";
$recordSet_sumber_dana_lain = $db->Execute($sql_sumber_dana_lain);
$initSet = array();
$data_sumber_dana_lain = array();
$z=0;
while ($arr=$recordSet_sumber_dana_lain->FetchRow()) {
	array_push($data_sumber_dana_lain, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_SUMBER_DANA_LAIN", $data_sumber_dana_lain);

//--------------------------------------------------------------------

			
if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
				
				$sql_data_wilayah = "SELECT get_nama_propinsi(no_propinsi) as nama_propinsi FROM ".$tbl_name_kabupaten." WHERE no_propinsi='".$no_propinsi."'";
				$recordSet_wilayah = $db->execute($sql_data_wilayah);
				$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];
				
				$sql = "SELECT b.id_form_rd_02_jp_main,a.id_form_rd_02_jp_detail,a.kode_proyek,c.nama_prop_jenis_penanganan,a.jumlah_proyek_per_paket,a.jumlah_kabupaten 
				FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_form_rd_02_jp_main=b.id_form_rd_02_jp_main 
				LEFT JOIN tbl_mast_prop_jenis_penanganan c ON a.jenis_penanganan=c.id_prop_jenis_penanganan 
				WHERE 1=1 ";
				
				if($no_propinsi!=''){
					$sql .= "AND b.no_propinsi='".$no_propinsi."' AND YEAR(b.tanggal)='".$tahun."' ";
				}
				
				$sql .= "ORDER BY ".$ORDER." ".$SORT." ";
						
				if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
				
				$numresults=$db->Execute($sql);
				//print $sql;
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

($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;


$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_RDP_2_JP);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_RDP_2_JP);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("TAHUN", $tahun);
$smarty->assign ("TITLE", _TITLE_FORM_RDP_2_MAIN);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_FORM_RDP_2_MAIN);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("TB_KODE_PROYEK", _KODE_PROYEK);
$smarty->assign ("TB_JENIS_PENANGANAN", _JENIS_PENANGANAN);
$smarty->assign ("TB_JUMLAH_PROYEK_PER_PAKET", _JUMLAH_PROYEK_PER_PAKET);
$smarty->assign ("TB_JUMLAH_KABUPATEN", _JUMLAH_KABUPATEN);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_FORM_RDP_2_MAIN);
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