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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/propinsi/rfk_1_jp';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/propinsi/rfk_1_jp';

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
} else {
		$mod_id = $_GET['mod_id'];
}

$user_id = base64_decode($_SESSION['UID']);

$smarty->assign ("MOD_ID", $mod_id);

#Initiate TABLE

$tbl_name_main = "tbl_form_rfk_01_jp_main";
$tbl_name_detail = "tbl_form_rfk_01_jp_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
$tbl_name_loan_phln = "tbl_mast_prop_loan_phln";
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
else $ORDER="a.id_form_rfk_01_jp_detail";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['no_propinsi']) $no_propinsi = $_GET['no_propinsi'];
else if ($_POST['no_propinsi']) $no_propinsi = $_POST['no_propinsi'];
else $no_propinsi="";

if ($_GET['Date_Year']) $tahun = $_GET['Date_Year'];
else if ($_POST['Date_Year']) $tahun = $_POST['Date_Year'];
else $tahun="";

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&search=1&Date_Year=".$tahun;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&search=1&Date_Year=".$tahun;


//----------EDIT DATA FORM RDP 01 JP-----------------------------------

$opt = $_GET[opt];
$id_form_rfk_01_jp_main = $_GET[id_form_rfk_01_jp_main];
$id_form_rfk_01_jp_detail = $_GET[id_form_rfk_01_jp_detail];
$ed = 0;

if ($opt=="1" AND $id_form_rfk_01_jp_main<>'' AND $id_form_rfk_01_jp_detail<>'') {

$sql = " SELECT * 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_form_rfk_01_jp_main=b.id_form_rfk_01_jp_main  
		WHERE 1=1 AND a.id_form_rfk_01_jp_main='".$id_form_rfk_01_jp_main."' AND a.id_form_rfk_01_jp_detail='".$id_form_rfk_01_jp_detail."' ";
$recordSet_Edit = $db->execute($sql);

$edit = 1;	

$smarty->assign ("OPT", $opt);					
$smarty->assign ("ID_FORM_RFK_01_JP_MAIN", $recordSet_Edit->fields[id_form_rfk_01_jp_main]);
$smarty->assign ("ID_FORM_RFK_01_JP_DETAIL", $recordSet_Edit->fields[id_form_rfk_01_jp_detail]);
$smarty->assign ("TANGGAL", $recordSet_Edit->fields[tanggal]);

$smarty->assign ("KODE_PROYEK", $recordSet_Edit->fields[kode_proyek]);
$smarty->assign ("NAMA_PROGRAM", $recordSet_Edit->fields[nama_program]);
$smarty->assign ("NO_RUAS", $recordSet_Edit->fields[no_ruas]);
$smarty->assign ("TARGET_TOTAL_FISIK_JALAN", $recordSet_Edit->fields[target_total_fisik_jalan]);
$smarty->assign ("TARGET_TOTAL_FISIK_JEMBATAN", $recordSet_Edit->fields[target_total_fisik_jembatan]);
$smarty->assign ("TARGET_TOTAL_BIAYA", $recordSet_Edit->fields[target_total_biaya]);
$smarty->assign ("BIAYA_PAD1", $recordSet_Edit->fields[biaya_pad1]);
$smarty->assign ("PERSEN_FISIK_PAD1_BULAN_INI", $recordSet_Edit->fields[persen_fisik_pad1_bulan_ini]);
$smarty->assign ("NILAI_FISIK_PAD1_BULAN_INI", $recordSet_Edit->fields[nilai_fisik_pad1_bulan_ini]);
$smarty->assign ("PERSEN_KEUANGAN_PAD1_BULAN_INI", $recordSet_Edit->fields[persen_keuangan_pad1_bulan_ini]);
$smarty->assign ("NILAI_KEUANGAN_PAD1_BULAN_INI", $recordSet_Edit->fields[nilai_keuangan_pad1_bulan_ini]);
$smarty->assign ("BIAYA_DU_DPP", $recordSet_Edit->fields[biaya_du_dpp]);
$smarty->assign ("PERSEN_FISIK_DU_DPP_BULAN_INI", $recordSet_Edit->fields[persen_fisik_du_dpp_bulan_ini]);
$smarty->assign ("NILAI_FISIK_DU_DPP_BULAN_INI", $recordSet_Edit->fields[nilai_fisik_du_dpp_bulan_ini]);
$smarty->assign ("PERSEN_KEUANGAN_DU_DPP_BULAN_INI", $recordSet_Edit->fields[persen_keuangan_du_dpp_bulan_ini]);
$smarty->assign ("NILAI_KEUANGAN_DU_DPP_BULAN_INI", $recordSet_Edit->fields[nilai_keuangan_du_dpp_bulan_ini]);
$smarty->assign ("BIAYA_PJP_DPP", $recordSet_Edit->fields[biaya_pjp_dpp]);
$smarty->assign ("PERSEN_FISIK_PJP_DPP_BULAN_INI", $recordSet_Edit->fields[persen_fisik_pjp_dpp_bulan_ini]);
$smarty->assign ("NILAI_FISIK_PJP_DPP_BULAN_INI", $recordSet_Edit->fields[nilai_fisik_pjp_dpp_bulan_ini]);
$smarty->assign ("PERSEN_KEUANGAN_PJP_DPP_BULAN_INI", $recordSet_Edit->fields[persen_keuangan_pjp_dpp_bulan_ini]);
$smarty->assign ("NILAI_KEUANGAN_PJP_DPP_BULAN_INI", $recordSet_Edit->fields[nilai_keuangan_pjp_dpp_bulan_ini]);
$smarty->assign ("JENIS_LOAN_PHLN", $recordSet_Edit->fields[jenis_loan_phln]);
$smarty->assign ("JUMLAH_LOAN_PHLN", $recordSet_Edit->fields[jumlah_loan_phln]);
$smarty->assign ("PERSEN_FISIK_PHLN_BULAN_INI", $recordSet_Edit->fields[persen_fisik_phln_bulan_ini]);
$smarty->assign ("NILAI_FISIK_PHLN_BULAN_INI", $recordSet_Edit->fields[nilai_fisik_phln_bulan_ini]);
$smarty->assign ("PERSEN_KEUANGAN_PHLN_BULAN_INI", $recordSet_Edit->fields[persen_keuangan_phln_bulan_ini]);
$smarty->assign ("NILAI_KEUANGAN_PHLN_BULAN_INI", $recordSet_Edit->fields[nilai_keuangan_phln_bulan_ini]);
$smarty->assign ("JENIS_SUMBER_DANA_LAIN", $recordSet_Edit->fields[jenis_sumber_dana_lain]);
$smarty->assign ("JUMLAH_SUMBER_DANA_LAIN", $recordSet_Edit->fields[jumlah_sumber_dana_lain]);
$smarty->assign ("PERSEN_FISIK_SUMBER_LAIN_BULAN_INI", $recordSet_Edit->fields[persen_fisik_sumber_lain_bulan_ini]);
$smarty->assign ("NILAI_FISIK_SUMBER_LAIN_BULAN_INI", $recordSet_Edit->fields[nilai_fisik_sumber_lain_bulan_ini]);
$smarty->assign ("PERSEN_KEUANGAN_SUMBER_LAIN_BULAN_INI", $recordSet_Edit->fields[persen_keuangan_sumber_lain_bulan_ini]);
$smarty->assign ("NILAI_KEUANGAN_SUMBER_LAIN_BULAN_INI", $recordSet_Edit->fields[nilai_keuangan_sumber_lain_bulan_ini]);
$smarty->assign ("KLARSIFIKASI_MASALAH", $recordSet_Edit->fields[klarsifikasi_masalah]);

}

//-------------MASTER WILAYAH PROPINSI---------------------------

$sql_propinsi = " SELECT no_propinsi,nama_propinsi FROM ".$tbl_name_propinsi." ORDER BY no_propinsi ASC ";
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

//-------------MASTER LOAN PHLN---------------------------


$sql_loan_phln = "SELECT * FROM ".$tbl_name_loan_phln." ORDER BY id_prop_loan_phln ASC";
$recordSet_loan_phln = $db->Execute($sql_loan_phln);
$initSet = array();
$data_loan_phln = array();
$z=0;
while ($arr=$recordSet_loan_phln->FetchRow()) {
	array_push($data_loan_phln, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_LOAN_PHLN", $data_loan_phln);


//-------------MASTER SUMBER LAIN---------------------------


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


if ($_GET[get_data_usulan]==1) {
	
	$kode_proyek = $_GET['kode_proyek'];
	$no_propinsi = $_GET['no_propinsi'];
	
	if($no_propinsi!='' AND $kode_proyek!=''){	
	
	$sql_data_usulan = "SELECT * FROM tbl_form_rd_01_jp_detail a LEFT JOIN tbl_form_rd_01_jp_main b 
	ON a.id_form_rd_01_jp_main=b.id_form_rd_01_jp_main 
	WHERE b.no_propinsi='".$no_propinsi."' AND a.kode_proyek='".$kode_proyek."'";
	
	$result_data_usulan = $db->execute($sql_data_usulan);
	$total_data_usulan = $result_data_usulan->numrows();
	
	($total_data_usulan>0) ? $data_input2 = " <img src=\"".$HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images')."/icon/table.gif\" border=\"0\" title=\"Tampilkan Data Usulan Rencana\" onclick=\"showUsulan();\" class=\"imgLink\" align=\"absmiddle\">" : $data_input2=NULL;	
	
	$tmp_kode_proyek = "<input name=\"kode_proyek\" type=\"text\" value=\"".$result_data_usulan->fields[kode_proyek]."\" maxlength=\"50\"> ".$data_input2;
	$tmp_nama_proyek = "<input name=\"nama_program\" type=\"text\" value=\"".$result_data_usulan->fields[nama_proyek]."\" size=\"50\" maxlength=\"200\">";
	$tmp_no_ruas = "<input type=\"text\" name=\"no_ruas\" value=\"".$result_data_usulan->fields[no_ruas]."\"  OnKeyUp=\"validateNum(this)\">";	
	$tmp_target_total_fisik_jalan = "<input type=\"text\" name=\"target_total_fisik_jalan\" value=\"".$result_data_usulan->fields[panjang_jalan]."\" OnKeyUp=\"validateNum(this)\">";
	$tmp_target_total_fisik_jembatan = "<input type=\"text\" name=\"target_total_fisik_jembatan\" value=\"".$result_data_usulan->fields[panjang_jembatan]."\" OnKeyUp=\"validateNum(this)\">";
	$tmp_target_total_biaya = "<input type=\"text\" name=\"target_total_biaya\" value=\"".$result_data_usulan->fields[total_biaya]."\" OnKeyUp=\"validateNum(this)\">";
	$tmp_biaya_pad1 = "<input type=\"text\" name=\"biaya_pad1\" value=\"".$result_data_usulan->fields[pad1]."\" OnKeyUp=\"validateNum(this)\">";
	$tmp_biaya_du_dpp = "<input type=\"text\" name=\"biaya_du_dpp\" value=\"".$result_data_usulan->fields[du_prop]."\" OnKeyUp=\"validateNum(this)\">";
	$tmp_biaya_pjp_dpp = "<input type=\"text\" name=\"biaya_pjp_dpp\" value=\"".$result_data_usulan->fields[pjp_prop]."\" OnKeyUp=\"validateNum(this)\">";
	$tmp_jumlah_loan_phln = "<input type=\"text\" name=\"jumlah_loan_phln\" value=\"".$result_data_usulan->fields[jumlah_loan_phln]."\" OnKeyUp=\"validateNum(this)\">";
	$tmp_jumlah_sumber_dana_lain = "<input type=\"text\" name=\"jumlah_sumber_dana_lain\" value=\"".$result_data_usulan->fields[jumlah_sumber_dana_lain]."\" OnKeyUp=\"validateNum(this)\">";

	// Loan PHLN  ///////
	// /////////////////////////
	
	$sql_jenis_loan_phln = "SELECT * FROM ".$tbl_name_loan_phln." ORDER BY id_prop_loan_phln ASC";
	$recordSet_jenis_loan_phln = $db->Execute($sql_jenis_loan_phln);
	$tmp_jenis_loan_phln = "<SELECT name=\"jenis_loan_phln\">
							<OPTION VALUE=\"\">[Pilih Nomor Loan PHLN]</OPTION>";
	while(!$recordSet_jenis_loan_phln ->EOF):
		($recordSet_jenis_loan_phln->fields[id_prop_loan_phln]==$result_data_usulan->fields[jenis_loan_phln]) ? $selected="selected" : $selected=NULL;
		$tmp_jenis_loan_phln .= "<option value=\"".$recordSet_jenis_loan_phln->fields[id_prop_loan_phln]."\" ".$selected.">".$recordSet_jenis_loan_phln->fields[nama_prop_loan_phln]."</option>";
		$recordSet_jenis_loan_phln->MoveNext();
	endwhile; 	
	$tmp_jenis_loan_phln .= "</selected>";	
	
	// Sumber Dana Lain  ///////
	// /////////////////////////
	
	$sql_jenis_sumber_dana_lain = "SELECT * FROM ".$tbl_name_sumber_dana_lain." ORDER BY id_prop_sumber_dana_lain ASC";
	$recordSet_jenis_sumber_dana_lain = $db->Execute($sql_jenis_sumber_dana_lain);
	$tmp_jenis_sumber_dana_lain = "<SELECT name=\"jenis_sumber_dana_lain\">
							<OPTION VALUE=\"\">[Pilih Sumber Dana Lain]</OPTION>";
	while(!$recordSet_jenis_sumber_dana_lain ->EOF):
		($recordSet_jenis_sumber_dana_lain->fields[id_prop_sumber_dana_lain]==$result_data_usulan->fields[jenis_sumber_dana_lain]) ? $selected="selected" : $selected=NULL;
		$tmp_jenis_sumber_dana_lain .= "<option value=\"".$recordSet_jenis_sumber_dana_lain->fields[id_prop_sumber_dana_lain]."\" ".$selected.">".$recordSet_jenis_sumber_dana_lain->fields[nama_prop_sumber_dana_lain]."</option>";
		$recordSet_jenis_sumber_dana_lain->MoveNext();
	endwhile; 	
	$tmp_jenis_sumber_dana_lain .= "</selected>";	
						
	$delimeter   = "-";
	$option_choice = $tmp_kode_proyek."^/&";
	$option_choice .= $tmp_nama_proyek."^/&";
	$option_choice .= $tmp_no_ruas."^/&";
	$option_choice .= $tmp_target_total_fisik_jalan."^/&";
	$option_choice .= $tmp_target_total_fisik_jembatan."^/&";
	$option_choice .= $tmp_target_total_biaya."^/&";
	$option_choice .= $tmp_biaya_pad1."^/&";
	$option_choice .= $tmp_biaya_du_dpp."^/&";
	$option_choice .= $tmp_biaya_pjp_dpp."^/&";
	$option_choice .= $tmp_jumlah_loan_phln."^/&";	
	$option_choice .= $tmp_jumlah_sumber_dana_lain."^/&";	
	$option_choice .= $tmp_jenis_loan_phln."^/&";	
	$option_choice .= $tmp_jenis_sumber_dana_lain."^/&";	
	$option_choice .= $delimeter;	
	echo $option_choice;
	}
}

if ($_GET[cari_rdp] == 1)
{
	$no_propinsi = $_GET[no_propinsi];
			if($no_propinsi!=''){	
				$sql_data_usulan = "SELECT * FROM tbl_form_rd_01_jp_detail a LEFT JOIN tbl_form_rd_01_jp_main b 
				ON a.id_form_rd_01_jp_main=b.id_form_rd_01_jp_main 
				WHERE b.no_propinsi='".$no_propinsi."'";
				$result_data_usulan = $db->execute($sql_data_usulan);
				$total_data_usulan = $result_data_usulan->numrows();
				
				$data_usulan = "<select id=\"no_usulan_results\" multiple size=\"10\" onclick=\"get_data_usulan($no_propinsi,this.value);showUsulan();\">";
				
				while(!$result_data_usulan ->EOF):
					$data_usulan .= "<option value=".$result_data_usulan->fields['kode_proyek'].">".$result_data_usulan->fields['nama_proyek']."</option>";
					$result_data_usulan->MoveNext();
				endwhile; 	
				
				$data_usulan .="</select>&nbsp;&nbsp;<font color=\"red\">[Klik <b>2x</b> untuk memilih item]</font>";
				
				($total_data_usulan>0) ? $data_input2 = " <img src=\"".$HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images')."\\icon\\table.gif\" border=\"0\" title=\"Tampilkan Data Rencana Proyek\" onclick=\"showUsulan();\" class=\"imgLink\" align=\"absmiddle\">" : $data_input2=NULL;	
				
				$data_input1="<input type=\"text\" id=\"kode_proyek\" name=\"kode_proyek\" maxlength=\"50\" onKeyUp=\"get_data_usulan($no_propinsi,this.value)\" value=\"\"> ".$data_input2;
				$delimeter   = "-";
				$option_choice = $data_input1."^/&".$data_usulan."^/&".$delimeter;	
				echo $option_choice;	
			}
}			
			
if($no_propinsi!=''){	
	$sql_data_usulan = "SELECT * FROM tbl_form_rd_01_jp_detail a LEFT JOIN tbl_form_rd_01_jp_main b 
	ON a.id_form_rd_01_jp_main=b.id_form_rd_01_jp_main 
	WHERE b.no_propinsi='".$no_propinsi."'";
	$result_data_usulan = $db->execute($sql_data_usulan);
	$total_data_usulan = $result_data_usulan->numrows();
	
	$initSet = array();
	$data_usulan = array();
	$z=0;
	
	while ($arr=$result_data_usulan->FetchRow()) {
		array_push($data_usulan, $arr);
		array_push($initSet, $z);
		$z++;
	}
	$smarty->assign ("USULAN_RENCANA", $data_usulan);	
	$smarty->assign ("TOTAL_USULAN_RENCANA", $total_data_usulan);			
		
}
			
if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
				
				$sql_data_wilayah = "SELECT nama_propinsi FROM ".$tbl_name_propinsi." WHERE no_propinsi='".$no_propinsi."'";
				$recordSet_wilayah = $db->execute($sql_data_wilayah);
				$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];
				
				$sql = "SELECT a.id_form_rfk_01_jp_main,a.id_form_rfk_01_jp_detail,a.kode_proyek,a.nama_program,a.no_ruas 
				FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_form_rfk_01_jp_main=b.id_form_rfk_01_jp_main 
				WHERE 1=1 ";
				
				if($no_propinsi!=''){
					$sql .= "AND b.no_propinsi='".$no_propinsi."'  AND YEAR(b.tanggal)='".$tahun."' ";
				}
				
				$sql .= "ORDER BY ".$ORDER." ".$SORT." ";

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

($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;


$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_RFK_1_JP);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_RFK_1_JP);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten);
$smarty->assign ("TAHUN", $tahun);
$smarty->assign ("TITLE", _TITLE_FORM_RFK_1_JP);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_FORM_RFK_1_JP);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("TB_KODE_PROYEK", _KODE_PROYEK);
$smarty->assign ("TB_NAMA_PROYEK", _NAMA_PROYEK);
$smarty->assign ("TB_NO_RUAS", _NO_RUAS);
$smarty->assign ("TB_NAMA_RUAS", _NAMA_RUAS);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_FORM_RFK_1_JP);
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