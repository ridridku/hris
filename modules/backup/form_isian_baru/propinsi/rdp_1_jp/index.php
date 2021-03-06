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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/propinsi/rdp_1_jp';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/propinsi/rdp_1_jp';

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

$tbl_name_main = "tbl_form_rd_01_jp_main";
$tbl_name_detail = "tbl_form_rd_01_jp_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
$tbl_name_sasaran = "tbl_mast_prop_sasaran_fungsi";
$tbl_name_jenis_penanganan = "tbl_mast_prop_jenis_penanganan";
$tbl_name_pkrsn_jalan = "tbl_mast_prop_tipe_pkrsn";
$tbl_name_loan_phln = "tbl_mast_prop_loan_phln";
$tbl_name_sumber_dana_lain = "tbl_mast_prop_sumber_dana_lain";
$tbl_name_kelayakan_konsistensi = "tbl_mast_prop_kelayakan_konsistensi";
$tbl_name_catatan_konsistensi = "tbl_mast_prop_catatan_konsistensi";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//


if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="a.kode_proyek";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['no_propinsi']) $no_propinsi = $_GET['no_propinsi'];
else if ($_POST['no_propinsi']) $no_propinsi = $_POST['no_propinsi'];
else $no_propinsi="";

if ($_GET['Date_Year']) $tahun = $_GET['Date_Year'];
else if ($_POST['Date_Year']) $tahun = $_POST['Date_Year'];
else $tahun="";

if ($_GET['no_kabupaten']) $no_kabupaten = $_GET['no_kabupaten'];
else if ($_POST['no_kabupaten']) $no_kabupaten = $_POST['no_kabupaten'];
else $no_kabupaten="";

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&search=1&Date_Year=".$tahun;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&search=1&Date_Year=".$tahun;


//----------EDIT DATA FORM RDP 01 JP-----------------------------------

$opt = $_GET[opt];
$id_form_rd_01_jp_main = $_GET[id_form_rd_01_jp_main];
$id_form_rd_01_jp_detail = $_GET[id_form_rd_01_jp_detail];
$ed = 0;

if ($opt=="1" AND $id_form_rd_01_jp_main<>'' AND $id_form_rd_01_jp_detail<>'') {

$sql = "SELECT * 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_form_rd_01_jp_main=b.id_form_rd_01_jp_main  
		WHERE 1=1 AND a.id_form_rd_01_jp_main='".$id_form_rd_01_jp_main."' AND a.id_form_rd_01_jp_detail='".$id_form_rd_01_jp_detail."' ";
$recordSet_Edit = $db->execute($sql);
$arr_kabupaten = explode(";",$recordSet_Edit->fields[kabupaten]);
$edit = 1;	

$smarty->assign ("OPT", $opt);					
$smarty->assign ("ID_FORM_RD_01_JP_MAIN", $recordSet_Edit->fields[id_form_rd_01_jp_main]);
$smarty->assign ("ID_FORM_RD_01_JP_DETAIL", $recordSet_Edit->fields[id_form_rd_01_jp_detail]);
$smarty->assign ("TANGGAL", $recordSet_Edit->fields[tanggal]);

$smarty->assign ("KODE_PROYEK", $recordSet_Edit->fields[kode_proyek]);
$smarty->assign ("NAMA_PROYEK", $recordSet_Edit->fields[nama_proyek]);
$smarty->assign ("NO_RUAS", $recordSet_Edit->fields[no_ruas]);
$smarty->assign ("NAMA_RUAS", $recordSet_Edit->fields[nama_ruas]);
$smarty->assign ("PANJANG_JALAN", $recordSet_Edit->fields[panjang_jalan]);
$smarty->assign ("SASARAN", $recordSet_Edit->fields[sasaran]);
$smarty->assign ("KABUPATEN_KEGIATAN", $arr_kabupaten);
$smarty->assign ("PANJANG_PROYEK", $recordSet_Edit->fields[panjang_proyek]);
$smarty->assign ("STATUS_AWAL_JALAN", $recordSet_Edit->fields[status_awal_jalan]);
$smarty->assign ("STATUS_AKHIR_JALAN", $recordSet_Edit->fields[status_akhir_jalan]);
$smarty->assign ("JENIS_PENANGANAN", $recordSet_Edit->fields[jenis_penanganan]);
$smarty->assign ("TIPE_PKRSN", $recordSet_Edit->fields[tipe_pkrsn]);
$smarty->assign ("LEBAR_PKRSN", $recordSet_Edit->fields[lebar_pkrsn]);
$smarty->assign ("BIAYA_JALAN", $recordSet_Edit->fields[biaya_jalan]);
$smarty->assign ("JUMLAH_JEMBATAN", $recordSet_Edit->fields[jumlah_jembatan]);
$smarty->assign ("PANJANG_JEMBATAN", $recordSet_Edit->fields[panjang_jembatan]);
$smarty->assign ("BIAYA_JEMBATAN", $recordSet_Edit->fields[biaya_jembatan]);
$smarty->assign ("TOTAL_BIAYA", $recordSet_Edit->fields[total_biaya]);
$smarty->assign ("PAD1", $recordSet_Edit->fields[pad1]);
$smarty->assign ("DU_PROP", $recordSet_Edit->fields[du_prop]);
$smarty->assign ("PJP_PROP", $recordSet_Edit->fields[pjp_prop]);
$smarty->assign ("JENIS_LOAN_PHLN", $recordSet_Edit->fields[jenis_loan_phln]);
$smarty->assign ("JUMLAH_LOAN_PHLN", $recordSet_Edit->fields[jumlah_loan_phln]);
$smarty->assign ("JENIS_SUMBER_DANA_LAIN", $recordSet_Edit->fields[jenis_sumber_dana_lain]);
$smarty->assign ("JUMLAH_SUMBER_DANA_LAIN", $recordSet_Edit->fields[jumlah_sumber_dana_lain]);
$smarty->assign ("UR_01_JP_KONSISTENSI", $recordSet_Edit->fields[ur_01_jp_konsistensi]);
$smarty->assign ("BIAYA_PER_KM_KONSISTENSI", $recordSet_Edit->fields[biaya_per_km_konsistensi]);
$smarty->assign ("KELAYAKAN_KONSISTENSI", $recordSet_Edit->fields[kelayakan_konsistensi]);
$smarty->assign ("CATATAN_KONSISTENSI", $recordSet_Edit->fields[catatan_konsistensi]);
$smarty->assign ("KETERANGAN", $recordSet_Edit->fields[keterangan]);
}

//-------------MASTER WILAYAH PROPINSI---------------------------

$sql_propinsi = "SELECT no_propinsi,nama_propinsi FROM ".$tbl_name_propinsi." ORDER BY no_propinsi ASC";
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
		

//----------Menampilkan Data Kabupaten---------------------------

if ($_GET[get_propinsi] == 1)
{
	$no_propinsi = $_GET[no_propinsi];
			if($no_propinsi!=''){	
				$sql_data_usulan = "SELECT * FROM tbl_form_ur_01_jp_detail a LEFT JOIN tbl_form_ur_01_jp_main b 
				ON a.id_form_ur_01_jp_main=b.id_form_ur_01_jp_main 
				WHERE b.no_propinsi='".$no_propinsi."'";
				$result_data_usulan = $db->execute($sql_data_usulan);
				$total_data_usulan = $result_data_usulan->numrows();
				
				$data_usulan = "<select id=\"no_usulan_results\" multiple size=\"10\" onclick=\"get_data_usulan($no_propinsi,this.value);showUsulan();\">";
				
				while(!$result_data_usulan ->EOF):
					$data_usulan .= "<option value=".$result_data_usulan->fields['kode_proyek'].">".$result_data_usulan->fields['kode_proyek']." - ".$result_data_usulan->fields['nama_proyek']."</option>";
					$result_data_usulan->MoveNext();
				endwhile; 	
				
				$data_usulan .="</select>&nbsp;&nbsp;<font color=\"red\">[Klik <b>2x</b> untuk memilih item]</font>";
				
				($total_data_usulan>0) ? $data_input2 = " <img src=\"".$HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images')."\\icon\\table.gif\" border=\"0\" title=\"Tampilkan Data Usulan Rencana\" onclick=\"showUsulan();\" class=\"imgLink\" align=\"absmiddle\">" : $data_input2=NULL;	
				
				$sql_kabupaten_combo 	  = "SELECT * FROM ".$tbl_name_kabupaten." where no_propinsi='$no_propinsi'";				
				$result_kabupaten_combo  = $db->Execute($sql_kabupaten_combo);
				
				$table_kabupaten="<table cellspacing=\"0\" cellpadding=\"0\" width=\"400\">\n";
				$z=0;
				while(!$result_kabupaten_combo ->EOF): 						
					$sisa = $z%2;				
					if ($sisa==0) {	$table_kabupaten.="<tr>"; } 
					$table_kabupaten.="<td width=\"15\"><input type=\"checkbox\" class=\"checkbox\" name=\"akabupaten".$z."\" value=\"".$result_kabupaten_combo  ->fields['no_kabupaten']."\"/></td>
<td class=\"text-regular\">".$result_kabupaten_combo  ->fields['nama_kabupaten']."</td>";
					if ($sisa==1) { $table_kabupaten.="</tr>\n"; }
				$result_kabupaten_combo->MoveNext();
				$z++;
				endwhile; 					
				$table_kabupaten.="</table>\n";
			
				$table_kabupaten.="<input type=\"hidden\" name=\"jml_kabupaten\" value=\"".$z++."\">";	
				$data_input1="<input type=\"text\" id=\"kode_proyek\" name=\"kode_proyek\" maxlength=\"25\" onKeyUp=\"get_data_usulan($no_propinsi,this.value)\" value=\"\"> ".$data_input2;
				$delimeter   = "-";
				$option_choice = $table_kabupaten."^/&".$data_input1."^/&".$data_usulan."^/&".$delimeter;	
				echo $option_choice;	
			}
}

if ($_GET[get_data_usulan]==1) {
	
	$kode_proyek = $_GET['kode_proyek'];
	
	if($no_propinsi!='' AND $kode_proyek!=''){	
	
	$sql_data_usulan = "SELECT * FROM tbl_form_ur_01_jp_detail a LEFT JOIN tbl_form_ur_01_jp_main b 
	ON a.id_form_ur_01_jp_main=b.id_form_ur_01_jp_main 	
	WHERE b.no_propinsi='".$no_propinsi."' and a.kode_proyek='".$kode_proyek."'";
	
	$result_data_usulan = $db->execute($sql_data_usulan);
	$total_data_usulan = $result_data_usulan->numrows();
	
	($total_data_usulan>0) ? $data_input2 = " <img src=\"".$HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images')."/icon/table.gif\" border=\"0\" title=\"Tampilkan Data Usulan Rencana\" onclick=\"showUsulan();\" class=\"imgLink\" align=\"absmiddle\">" : $data_input2=NULL;	
	
	$tmp_kode_proyek = "<input name=\"kode_proyek\" type=\"text\" value=\"".$result_data_usulan->fields[kode_proyek]."\" maxlength=\"50\"> ".$data_input2;
	$tmp_nama_proyek = "<input name=\"nama_proyek\" type=\"text\" value=\"".$result_data_usulan->fields[nama_proyek]."\" size=\"35\" maxlength=\"200\">";
	$tmp_no_ruas = "<input type=\"text\" name=\"no_ruas\" value=\"".$result_data_usulan->fields[no_ruas]."\">";
	$tmp_nama_ruas = "<input name=\"nama_ruas\" type=\"text\" value=\"".$result_data_usulan->fields[nama_ruas]."\" size=\"35\" maxlength=\"200\">";
	$tmp_panjang_jalan = "<input type=\"text\" name=\"panjang_jalan\" value=\"".$result_data_usulan->fields[panjang_jalan]."\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_panjang_proyek = "<input type=\"text\" name=\"panjang_proyek\" value=\"".$result_data_usulan->fields[panjang_proyek]."\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_status_awal_jalan = "<input name=\"status_awal_jalan\" type=\"text\" value=\"".$result_data_usulan->fields[status_awal_jalan]."\" size=\"35\" maxlength=\"150\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_status_akhir_jalan = "<input name=\"status_akhir_jalan\" type=\"text\" value=\"".$result_data_usulan->fields[status_akhir_jalan]."\" size=\"35\" maxlength=\"150\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_lebar_pkrsn = "<input type=\"text\" name=\"lebar_pkrsn\" value=\"".$result_data_usulan->fields[lebar_pkrsn]."\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_biaya_jalan = "<input type=\"text\" name=\"biaya_jalan\" value=\"".$result_data_usulan->fields[biaya_jalan]."\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_jumlah_jembatan = "<input type=\"text\" name=\"jumlah_jembatan\" value=\"".$result_data_usulan->fields[jumlah_jembatan]."\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_panjang_jembatan = "<input type=\"text\" name=\"panjang_jembatan\" value=\"".$result_data_usulan->fields[panjang_jembatan]."\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_biaya_jembatan = "<input type=\"text\" name=\"biaya_jembatan\" value=\"".$result_data_usulan->fields[biaya_jembatan]."\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_total_biaya = "<input type=\"text\" name=\"total_biaya\" value=\"".$result_data_usulan->fields[total_biaya]."\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_pad1 = "<input type=\"text\" name=\"pad1\" value=\"".$result_data_usulan->fields[pad1]."\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_du_prop = "<input type=\"text\" name=\"du_prop\" value=\"".$result_data_usulan->fields[du_dpp]."\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_pjp_prop = "<input type=\"text\" name=\"pjp_prop\" value=\"".$result_data_usulan->fields[pjp_dpp]."\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_jumlah_loan_phln = "<input type=\"text\" name=\"jumlah_loan_phln\" value=\"".$result_data_usulan->fields[jumlah_loan_phln]."\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_jumlah_sumber_dana_lain = "<input type=\"text\" name=\"jumlah_sumber_dana_lain\" value=\"".$result_data_usulan->fields[jumlah_sumber_dana_lain]."\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_biaya_per_km_konsistensi = "<input type=\"text\" name=\"biaya_per_km_konsistensi\" value=\"".$result_data_usulan->fields[biaya_per_km]."\"  OnKeyUp=\"validateNum(this)\">";	
	
	// Sasaran dan Fungsi //////////////////////
	////////////////////////////////////////////
	
	$sql_sasaran = "SELECT * FROM ".$tbl_name_sasaran." ORDER BY id_prop_sasaran_fungsi ASC";
	$recordSet_sasaran = $db->Execute($sql_sasaran);
	$tmp_sasaran = "<SELECT name=\"sasaran\">
					<OPTION VALUE=\"\">[Pilih Sasaran/Fungsi]</OPTION>";
	while(!$recordSet_sasaran ->EOF):
		($recordSet_sasaran->fields[id_prop_sasaran_fungsi]==$result_data_usulan->fields[sasaran]) ? $selected="selected" : $selected=NULL;
		$tmp_sasaran .= "<option value=\"".$recordSet_sasaran->fields[id_prop_sasaran_fungsi]."\" ".$selected.">".$recordSet_sasaran->fields[nama_prop_sasaran_fungsi]."</option>";
		$recordSet_sasaran->MoveNext();
	endwhile; 	
	$tmp_sasaran .= "</selected>";	
	
	// Jenis Penanganan Jalan //
	// /////////////////////////
	
	$sql_jenis_penanganan = "SELECT * FROM ".$tbl_name_jenis_penanganan." ORDER BY id_prop_jenis_penanganan ASC";
	$recordSet_jenis_penanganan = $db->Execute($sql_jenis_penanganan);
	$tmp_jenis_penanganan = "<SELECT name=\"jenis_penanganan\">
							<OPTION VALUE=\"\">[Pilih Jenis Penanganan Jalan]</OPTION>";
	while(!$recordSet_jenis_penanganan ->EOF):
		($recordSet_jenis_penanganan->fields[id_prop_jenis_penanganan]==$result_data_usulan->fields[jenis_penanganan]) ? $selected="selected" : $selected=NULL;
		$tmp_jenis_penanganan .= "<option value=\"".$recordSet_jenis_penanganan->fields[id_prop_jenis_penanganan]."\" ".$selected.">".$recordSet_jenis_penanganan->fields[nama_prop_jenis_penanganan]."</option>";
		$recordSet_jenis_penanganan->MoveNext();
	endwhile; 	
	$tmp_jenis_penanganan .= "</selected>";	
		
	// Tipe PKRSN Jalan  ///////
	// /////////////////////////
	
	$sql_tipe_pkrsn = "SELECT * FROM ".$tbl_name_pkrsn_jalan." ORDER BY id_prop_tipe_pkrsn ASC";
	$recordSet_tipe_pkrsn = $db->Execute($sql_tipe_pkrsn);
	$tmp_tipe_pkrsn = "<SELECT name=\"tipe_pkrsn\">
							<OPTION VALUE=\"\">[Pilih Tipe PKRSN Jalan]</OPTION>";
	while(!$recordSet_tipe_pkrsn ->EOF):
		($recordSet_tipe_pkrsn->fields[id_prop_tipe_pkrsn]==$result_data_usulan->fields[tipe_pkrsn]) ? $selected="selected" : $selected=NULL;
		$tmp_tipe_pkrsn .= "<option value=\"".$recordSet_tipe_pkrsn->fields[id_prop_tipe_pkrsn]."\" ".$selected.">".$recordSet_tipe_pkrsn->fields[nama_prop_tipe_pkrsn]."</option>";
		$recordSet_tipe_pkrsn->MoveNext();
	endwhile; 	
	$tmp_tipe_pkrsn .= "</selected>";	
			
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
	
	// Kode Kelayakan Konsistensi  ///////
	// ///////////////////////////////////
	
	$sql_kelayakan_konsistensi = "SELECT * FROM ".$tbl_name_kelayakan_konsistensi." ORDER BY id_prop_kelayakan_konsistensi ASC";
	$recordSet_kelayakan_konsistensi = $db->Execute($sql_kelayakan_konsistensi);
	$tmp_kelayakan_konsistensi = "<SELECT name=\"kelayakan_konsistensi\">
							<OPTION VALUE=\"\">[Pilih Kelayakan Konsistensi]</OPTION>";
	while(!$recordSet_kelayakan_konsistensi ->EOF):
		($recordSet_kelayakan_konsistensi->fields[id_prop_kelayakan_konsistensi]==$result_data_usulan->fields[kelayakan]) ? $selected="selected" : $selected=NULL;
		$tmp_kelayakan_konsistensi .= "<option value=\"".$recordSet_kelayakan_konsistensi->fields[id_prop_kelayakan_konsistensi]."\" ".$selected.">".$recordSet_kelayakan_konsistensi->fields[nama_prop_kelayakan_konsistensi]."</option>";
		$recordSet_kelayakan_konsistensi->MoveNext();
	endwhile; 	
	$tmp_kelayakan_konsistensi .= "</selected>";	

	// Data Kota/Kabupaten /////////////
	////////////////////////////////////
	
	$arr_kabupaten = explode(";",$result_data_usulan->fields[kabupaten]);
	$sql_kabupaten_combo 	  = "SELECT * FROM ".$tbl_name_kabupaten." where no_propinsi='$no_propinsi'";				
	$result_kabupaten_combo  = $db->Execute($sql_kabupaten_combo);
	
	$table_kabupaten="<table cellspacing=\"0\" cellpadding=\"0\" width=\"400\">\n";
	$z=0;
	while(!$result_kabupaten_combo ->EOF): 						
		$sisa = $z%2;				
		if ($sisa==0) {	$table_kabupaten.="<tr>"; } 
		for($y=0;$y<count($arr_kabupaten);$y++) {
			(trim(strtolower($result_kabupaten_combo  ->fields['nama_kabupaten']))==trim(strtolower($arr_kabupaten[$y]))) ? $checked="checked":NULL;			
		}
		$table_kabupaten.="<td width=\"15\"><input type=\"checkbox\" class=\"checkbox\" name=\"kabupaten".$z."\" value=\"".$result_kabupaten_combo  ->fields['nama_kabupaten']."\" ".$checked."/></td>
		<td class=\"text-regular\">".$result_kabupaten_combo  ->fields['nama_kabupaten']."</td>";
		$checked=NULL;	
		if ($sisa==1) { $table_kabupaten.="</tr>\n"; }
	$result_kabupaten_combo->MoveNext();
	$z++;
	endwhile; 					
	$table_kabupaten.="</table>\n";

	$table_kabupaten.="<input type=\"hidden\" name=\"jml_kabupaten\" value=\"".$z++."\">";		
					
	$delimeter   = "-";
	$option_choice = $tmp_nama_proyek."^/&".$tmp_no_ruas."^/&".$tmp_nama_ruas."^/&".$tmp_panjang_jalan."^/&".$tmp_panjang_proyek."^/&".$tmp_status_awal_jalan."^/&".$tmp_status_akhir_jalan."^/&".$tmp_lebar_pkrsn."^/&";
	$option_choice .= $tmp_biaya_jalan."^/&".$tmp_jumlah_jembatan."^/&".$tmp_panjang_jembatan."^/&".$tmp_biaya_jembatan."^/&".$tmp_total_biaya."^/&".$tmp_pad1."^/&".$tmp_du_prop."^/&".$tmp_pjp_prop."^/&".$tmp_jumlah_loan_phln."^/&";
	$option_choice .= $tmp_jumlah_sumber_dana_lain."^/&".$tmp_biaya_per_km_konsistensi."^/&".$tmp_sasaran."^/&";
	$option_choice .= $tmp_jenis_penanganan."^/&";
	$option_choice .= $tmp_tipe_pkrsn."^/&";
	$option_choice .= $tmp_jenis_loan_phln."^/&";
	$option_choice .= $tmp_jenis_sumber_dana_lain."^/&";
	$option_choice .= $tmp_kelayakan_konsistensi."^/&";
	$option_choice .= $table_kabupaten."^/&";
	$option_choice .= $tmp_kode_proyek."^/&";
	$option_choice .= $delimeter;	
	echo $option_choice;
	}
}

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
	$smarty->assign ("JML_KABUPATEN", $z);

	$sql_data_usulan = "SELECT * FROM tbl_form_ur_01_jp_detail a LEFT JOIN tbl_form_ur_01_jp_main b 
	ON a.id_form_ur_01_jp_main=b.id_form_ur_01_jp_main 
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

//-------------MASTER SASARAN FUNGSI---------------------------


$sql_sasaran = "SELECT * FROM ".$tbl_name_sasaran." ORDER BY id_prop_sasaran_fungsi ASC";

$recordSet_sasaran = $db->Execute($sql_sasaran);
$initSet = array();
$data_sasaran = array();
$z=0;
while ($arr=$recordSet_sasaran->FetchRow()) {
	array_push($data_sasaran, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_SASARAN", $data_sasaran);


//-------------MASTER JENIS PENANGANAN JALAN---------------------------


$sql_jenis_penanganan = "SELECT * FROM ".$tbl_name_jenis_penanganan." ORDER BY id_prop_jenis_penanganan ASC";
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
			

//-------------MASTER TIPE PKRSN JALAN---------------------------


$sql_pkrsn_jalan = "SELECT * FROM ".$tbl_name_pkrsn_jalan." ORDER BY id_prop_tipe_pkrsn ASC";
$recordSet_pkrsn_jalan = $db->Execute($sql_pkrsn_jalan);
$initSet = array();
$data_pkrsn_jalan = array();
$z=0;
while ($arr=$recordSet_pkrsn_jalan->FetchRow()) {
	array_push($data_pkrsn_jalan, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PKRSN_JALAN", $data_pkrsn_jalan);



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
			
	

//-------------MASTER KELAYAKAN KONSISTENSI---------------------------


$sql_kelayakan_konsistensi = "SELECT * FROM ".$tbl_name_kelayakan_konsistensi." ORDER BY id_prop_kelayakan_konsistensi ASC";
$recordSet_kelayakan_konsistensi = $db->Execute($sql_kelayakan_konsistensi);
$initSet = array();
$data_kelayakan_konsistensi = array();
$z=0;
while ($arr=$recordSet_kelayakan_konsistensi->FetchRow()) {
	array_push($data_kelayakan_konsistensi, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_KELAYAKAN_KONSISTENSI", $data_kelayakan_konsistensi);


//-------------MASTER CATATAN KONSISTENSI---------------------------



$sql_catatan_konsistensi = "SELECT * FROM ".$tbl_name_catatan_konsistensi." ORDER BY id_prop_catatan_konsistensi ASC";
$recordSet_catatan_konsistensi = $db->Execute($sql_catatan_konsistensi);
$initSet = array();
$data_catatan_konsistensi = array();
$z=0;
while ($arr=$recordSet_catatan_konsistensi->FetchRow()) {
	array_push($data_catatan_konsistensi, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_CATATAN_KONSISTENSI", $data_catatan_konsistensi);

			
if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
				
				$sql_data_wilayah = "SELECT nama_propinsi FROM ".$tbl_name_propinsi." WHERE no_propinsi='".$no_propinsi."'";
				$recordSet_wilayah = $db->execute($sql_data_wilayah);
				$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];
				
				$sql = "SELECT a.id_form_rd_01_jp_main,a.id_form_rd_01_jp_detail,a.kode_proyek,a.nama_proyek,a.no_ruas,a.nama_ruas 
				FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_form_rd_01_jp_main=b.id_form_rd_01_jp_main 
				WHERE 1=1 ";
				
				if($no_propinsi!=''){
					$sql .= "AND b.no_propinsi='".$no_propinsi."' AND YEAR(b.tanggal)='".$tahun."' ";
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


$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_RDP_1_JP);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_RDP_1_JP);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten);
$smarty->assign ("TAHUN", $tahun);
$smarty->assign ("TITLE", _TITLE_FORM_RDP_1_JP);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_FORM_RDP_1_JP);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("TB_KODE_PROYEK", _KODE_PROYEK);
$smarty->assign ("TB_NAMA_PROYEK", _NAMA_PROYEK);
$smarty->assign ("TB_NO_RUAS", _NO_RUAS);
$smarty->assign ("TB_NAMA_RUAS", _NAMA_RUAS);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_FORM_RDP_1_JP);
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