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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_k_02';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_k_02';

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}

$user_id = base64_decode($_SESSION['UID']);

$smarty->assign ("MOD_ID", $mod_id);

$smarty->assign ("ID_PROPINSI",$MAIN_PROP);

#Initiate TABLE

$tbl_name_main = "tbl_form_k_02_main";
$tbl_name_detail = "tbl_form_k_02_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
$tbl_name_kondisi_jalan = "tbl_mast_ruas_kondisi_jalan";

/*** Tambahan 05-06-2010 ***/
$tbl_name_jenis_jln = "tbl_mast_jln";
/*** End 0f Tambahan ***/

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="a.no_ruas";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['no_propinsi']) $no_propinsi = $_GET['no_propinsi'];
else if ($_POST['no_propinsi']) $no_propinsi = $_POST['no_propinsi'];
else $no_propinsi="";

if ($_GET['no_kabupaten']) $no_kabupaten = $_GET['no_kabupaten'];
else if ($_POST['no_kabupaten']) $no_kabupaten = $_POST['no_kabupaten'];
else $no_kabupaten="";

if ($_GET['jns_jln']) $jns_jln = $_GET['jns_jln'];
else if ($_POST['jns_jln']) $jns_jln = $_POST['jns_jln'];
else $jns_jln="";

if ($_GET['txt_hidden_jns_jln']) $txt_hidden_jns_jln = $_GET['txt_hidden_jns_jln'];
else if ($_POST['txt_hidden_jns_jln']) $txt_hidden_jns_jln = $_POST['txt_hidden_jns_jln'];
else $txt_hidden_jns_jln="";

$fields_find_jns_jln_ = $jns_jln!=""?$jns_jln:$txt_hidden_jns_jln;


if ($_GET['status_error']) $status_error = $_GET['status_error'];
else if ($_POST['status_error']) $status_error = $_POST['status_error'];
else $status_error="";


$Search_Year = $_GET[Search_Year];

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year."&jns_jln=".$fields_find_jns_jln_."&txt_hidden_jns_jln=".$fields_find_jns_jln_;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year."&jns_jln=".$fields_find_jns_jln_."&txt_hidden_jns_jln=".$fields_find_jns_jln_;

$SES_THN		= $_SESSION['SESSION_TAHUN'];
$SES_JNS_JLN	= $_SESSION['SESSION_JNS_JLN'];
$SES_NO_PROP	= $_SESSION['SESSION_NO_PROPINSI'];
$SES_NO_KAB		= $_SESSION['SESSION_NO_KABUPATEN'];

//----------EDIT DATA FORM K-01-----------------------------------
/*
$opt = $_GET[opt];
$no_propinsi = $_GET[no_propinsi];
$no_kabupaten = $_GET[no_kabupaten];
$tahun = $_GET[tahun];
$ed = 0;

if ($opt=="1" AND $no_propinsi<>'' AND $no_kabupaten<>'' AND $tahun<>'') {


$sql = "SELECT * 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_usulan_main=b.id_usulan 
		WHERE 1=1 AND b.id_usulan='".$id_usulan_main."' AND a.id_usulan_detail='".$id_usulan_detail."' ";
$recordSet_Edit = $db->execute($sql);


$sql = "SELECT  * 
FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_usulan_main=b.id_usulan 
LEFT JOIN ".$tbl_name_kondisi_jalan." c ON a.kondisi=c.kode_kondisi_jalan
WHERE 1=1 ";

if($no_propinsi!='' AND $no_kabupaten!=''){
	$sql .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' AND YEAR(b.tanggal_usulan)='".$tahun."' ";
}

$sql .= "ORDER BY a.kelompok_prioritas ASC,".$ORDER." ".$SORT." ";

$recordSet_Edit = $db->execute($sql);
				
$edit = 1;	

$initSet = array();
$data_tb = array();
$z=0;

while ($arr=$recordSet_Edit->FetchRow()) {
	$nama_penggisi = $arr[nama_penggisi_usulan];
	array_push($data_tb, $arr);
	array_push($initSet, $z);
	$z++;
}

$smarty->assign ("OPT", $opt);		
$smarty->assign ("ID_USULAN_MAIN", $recordSet_Edit->fields[id_usulan_main]);
$smarty->assign ("ID_USULAN_DETAIL", $recordSet_Edit->fields[id_usulan_detail]);			
$smarty->assign ("TANGGAL_USULAN", $recordSet_Edit->fields[tanggal_usulan]);
$smarty->assign ("NAMA_PENGGISI_USULAN", $recordSet_Edit->fields[nama_penggisi_usulan]);
$smarty->assign ("NO_PROPINSI", $recordSet_Edit->fields[no_propinsi]);
$smarty->assign ("NO_KABUPATEN", $recordSet_Edit->fields[no_kabupaten]);
$smarty->assign ("KELOMPOK_PRIORITAS", $recordSet_Edit->fields[kelompok_prioritas]);
$smarty->assign ("NO_RUAS", $recordSet_Edit->fields[no_ruas]);
$smarty->assign ("NAMA_RUAS", $recordSet_Edit->fields[nama_ruas]);
$smarty->assign ("PANJANG", $recordSet_Edit->fields[panjang]);
$smarty->assign ("KONDISI_PERMUKAAN", $recordSet_Edit->fields[kondisi]);
$smarty->assign ("LEBAR", $recordSet_Edit->fields[lebar]);
$smarty->assign ("LHR_RODA_4", $recordSet_Edit->fields[lhr_roda_4]);
$smarty->assign ("KOTA_AKTIVITAS_DILAYANI", $recordSet_Edit->fields[kota_aktivitas_dilayani]);
}
*/
//-------------MASTER WILAYAH PROPINSI---------------------------

if($_GET[getAllData]==1) {

		/**** Tambahan utk filter no_provinsi, no_kabupaten
		*****/
		$f_no_prov	= $_SESSION['SESSION_NO_PROPINSI']!='0'?" AND a.no_propinsi='".$_SESSION['SESSION_NO_PROPINSI']."' ":"";
		$f_no_kabta	= $_SESSION['SESSION_NO_KABUPATEN']!='0'?" AND a.no_kabupaten='".$_SESSION['SESSION_NO_KABUPATEN']."' ":"";
	
		/*** 07-08-2010 ***/
		$f_id_jns_jln	= $_SESSION['SESSION_JNS_JLN']!='0'?" AND b.id_jns_jln='".$_SESSION['SESSION_JNS_JLN']."' ":"";
			
		/***
		http.open('get', 'index.php?getAllData=1&no_propinsi='+no_propinsi+'&no_kabupaten='+no_kabupaten+'&tahun='+tahun+'&jns='+jns);
		***/
		$no_prop = $_GET[no_propinsi];
		$no_kab = $_GET[no_kabupaten];
		$tahun = $_GET[tahun];
		$jns = $_GET[jns];
		
/***
		$txt_hidden_jns_jln = $_GET[txt_hidden_jns_jln];
		$jns_jln = $_GET[jns_jln];
			
		$sql = "SELECT * 
		FROM tbl_form_k_02_main a 
		LEFT JOIN tbl_form_k_02_detail b ON a.id_usulan=b.id_usulan_main 
		WHERE 1=1 ";
		
		if($no_prop!='' AND $no_kab!='' AND $tahun!='' AND $jns_jln!=''){
			$sql .= "AND a.no_propinsi='".$no_prop."' AND a.no_kabupaten='".$no_kab."' 
					AND a.id_jns_jln='".$jns_jln."' AND YEAR(a.tanggal_usulan)='".$tahun."' ";
		}
***/			
		$sql = "SELECT * 
		FROM tbl_form_k_02_main a 
		LEFT JOIN tbl_form_k_02_detail b ON a.id_usulan=b.id_usulan_main 
		WHERE 1=1 ";
		
		if($no_prop!='' AND $no_kab!='' AND $tahun!='' AND $jns!=''){
			$sql .= "AND (a.no_propinsi='".$no_prop."' $f_no_prov) AND (a.no_kabupaten='".$no_kab."' $f_no_kabta) AND (b.id_jns_jln='".$jns."' $f_id_jns_jln) AND YEAR(a.tanggal_usulan)='".$tahun."' ";
		}
		
		$sql .= "ORDER BY b.no_ruas ".$SORT." ";
		$recordSetData = $db->Execute($sql);
		//$jml_data = $recordSetData->numrows();
		
		$data_input 	= "<table id=\"tblItem1\" width=\"900\" align=\"left\">";
		$data_input2 	= "<table id=\"tblItem2\" width=\"900\" align=\"left\">";

		$z=0;
		$a=0;
		$b=0;
		
		while(!$recordSetData ->EOF): 		
			$no = $z+1;
			$id_usulan_main = $recordSetData->fields[id_usulan_main];
			/*** Disabled on 08-09-2010
			$tanggal_usulan = $recordSetData->fields[tanggal_usulan];
			***/
			$tgl = explode("-",$recordSetData->fields[tanggal_usulan],strlen($recordSetData->fields[tanggal_usulan])); // YYYY-mm-dd
			$tanggal_usulan = $tgl[2]."-".$tgl[1]."-".$tgl[0];
			
			$nama_penggisi_usulan = $recordSetData->fields[nama_penggisi_usulan];
			
			if(trim($recordSetData->fields[kelompok_prioritas])=="A") {
			
				$data_input .= "<tr>";
				$data_input .= "<td bgcolor=\"#FFFFFF\" class=\"tdatacontent-first-col\" style=\"font:11px/24px;text-align:right;width:16px;margin-right:4px;\">".$a.".</td>";
				$data_input .= "<td bgcolor=\"#FFFFFF\"><div id=\"ajax_data_ruas_tblItem1_".$a."\" onclick=\"get_data_ruas(frmCreate.no_propinsi.value,frmCreate.no_kabupaten.value);showData(this.id);\">
				<input type=\"text\" name=\"no_ruas_tblItem1_".$a."\" id=\"no_ruas_tblItem1_".$a."\" size=\"8\" value=\"".$recordSetData->fields[no_ruas]."\">
				<img name=\"img_ruas_\" src=\"../../../../themes/defaults/images/icon/table.gif\" border=\"0\" title=\"Tampilkan Data Ruas Jalan\" class=\"imgLink\" align=\"absmiddle\"></div>
				<div id=\"ajax_data_ruas_tblItem1_".$a."_select\" style=\"display:none;\"></div></td>
				<input type=\"hidden\" name=\"kelompok_tblItem1_".$a."\" value=\"A\">";
				
				$data_input .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_nama_ruas_tblItem1_".$a."\"><input type=\"text\" ID=\"nama_ruas_tblItem1_".$a."\"  name=\"nama_ruas_tblItem1_".$a."\" size=\"35\" value=\"".$recordSetData->fields[nama_ruas]."\"></DIV></td>";
				
				/*** Tambahan 08-06-2010 ***/
				$jenis_jalan2	= $recordSetData->fields[id_jns_jln]=='1'? "Provinsi":"Kabupaten/ Kota";
				$data_input .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_hidden_jns_jln_tblItem1_".$a."\"><input type=\"hidden\" ID=\"txt_hidden_jns_jln_tblItem1_".$a."\"  name=\"txt_hidden_jns_jln_tblItem1_".$a."\" value=\"".$recordSetData->fields[id_jns_jln]."\"></DIV></td>";
							
				$data_input .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_jns_jln_tblItem1_".$a."\"><input type=\"text\" ID=\"txt_jns_jln_tblItem1_".$a."\"  name=\"txt_jns_jln_tblItem1_".$a."\" size=\"15\" value=\"".$jenis_jalan2."\"></DIV></td>";			
				/*** End 0f Tambahan ***/
				
				$data_input .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_panjang_tblItem1_".$a."\"><input type=\"text\" ID=\"panjang_tblItem1_".$a."\"  name=\"panjang_tblItem1_".$a."\" size=\"9\" value=\"".$recordSetData->fields[panjang]."\"></DIV></td>";
				
				$data_input .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_kondisi_tblItem1_".$a."\" onclick=\"showData(this.id);\"><input type=\"text\" ID=\"kondisi_tblItem1_".$a."\"  name=\"kondisi_tblItem1_".$a."\" size=\"10\" value=\"".$recordSetData->fields[kondisi]."\"><img src=\"../../../../themes/defaults/images/icon/table.gif\" border=\"0\" title=\"Tampilkan Data Kondisi\" class=\"imgLink\" align=\"absmiddle\"></DIV>
				<div id=\"ajax_kondisi_tblItem1_".$a."_select\" style=\"display:none;\">
				<table width=\"175\" bgcolor=\"#FFFFFF\" cellpadding=\"1\" cellspacing=\"1\" style=\"font:11px;border:#CCC solid 2px;\">
				<tr><td width=\"10\"><input type=\"checkbox\" class=\"checkbox\" name=\"kondisi_tblItem1_".$a."_0\" id=\"kondisi_tblItem1_".$a."_0\" value=\"B\"/></td><td>Baik</td></tr>
				<tr><td><input type=\"checkbox\" class=\"checkbox\" name=\"kondisi_tblItem1_".$a."_1\" id=\"kondisi_tblItem1_".$a."_1\" value=\"S\"/></td><td>Sedang</td></tr>
				<tr><td><input type=\"checkbox\" class=\"checkbox\" name=\"kondisi_tblItem1_".$a."_2\" id=\"kondisi_tblItem1_".$a."_2\" value=\"SR\"/></td><td>Sedang Rusak</td></tr>
				<tr><td><input type=\"checkbox\" class=\"checkbox\" name=\"kondisi_tblItem1_".$a."_3\" id=\"kondisi_tblItem1_".$a."_3\" value=\"R\"/></td><td>Rusak</td></tr>
				<tr><td><input type=\"checkbox\" class=\"checkbox\" name=\"kondisi_tblItem1_".$a."_4\" id=\"kondisi_tblItem1_".$a."_4\" value=\"RB\"/></td><td>Rusak Berat</td></tr>
				<tr><td></td><td><a class=\"button\" href=\"#\" onclick=\"this.blur();OKKondisi('tblItem1_".$a."');\"><span><img src=\"../../../../themes/defaults/images/icon/blank.gif\" align=\"absmiddle\">OK</span></a>
				<a class=\"button\" href=\"#\" onclick=\"CancelKondisi('tblItem1_".$a."');\"><span><img src=\"../../../../themes/defaults/images/icon/blank.gif\" align=\"absmiddle\">Cancel</span></a></td></tr>
				</table></div></td>";
				
				$data_input .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_lebar_tblItem1_".$a."\"> <input type=\"text\" ID=\"lebar_tblItem1_".$a."\"  name=\"lebar_tblItem1_".$a."\" size=\"10\" value=\"".$recordSetData->fields[lebar]."\"> </DIV></td>";
				$data_input .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_lhr_tblItem1_".$a."\"> <input type=\"text\" ID=\"lhr_tblItem1_".$a."\"  name=\"lhr_tblItem1_".$a."\" size=\"10\" value=\"".$recordSetData->fields[lhr_roda_4]."\"> </DIV></td>";
				$data_input .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_kota_tblItem1_".$a."\"> <input type=\"text\" ID=\"kota_tblItem1_".$a."\"  name=\"kota_tblItem1_".$a."\" size=\"33\" value=\"".$recordSetData->fields[kota_aktivitas_dilayani]."\"><!--<img src=\"../../../../themes/defaults/images/icon/table.gif\" border=\"0\" title=\"Tampilkan Data Kota\" onclick=\"showData('ajax_data_kota');\" class=\"imgLink\" align=\"absmiddle\">--></DIV></td>";
				
				$data_input .= "</tr>";
				$a = $a+1;
			}
		
			if(trim($recordSetData->fields[kelompok_prioritas])=="B") {
			
				$data_input2 .= "<tr>";
				$data_input2 .= "<td bgcolor=\"#FFFFFF\" class=\"tdatacontent-first-col\" style=\"width:16px;height:16px;vertical-align:center\">".$b.".</td>";
				$data_input2 .= "<td bgcolor=\"#FFFFFF\"><div id=\"ajax_data_ruas_tblItem2_".$b."\" onclick=\"get_data_ruas(frmCreate.no_propinsi.value,frmCreate.no_kabupaten.value);showData(this.id);\">
				<input type=\"text\" name=\"no_ruas_tblItem2_".$b."\" id=\"no_ruas_tblItem2_".$b."\" size=\"8\" value=\"".$recordSetData->fields[no_ruas]."\">
				<img name=\"img_ruas_\" src=\"../../../../themes/defaults/images/icon/table.gif\" border=\"0\" title=\"Tampilkan Data Ruas Jalan\" class=\"imgLink\" align=\"absmiddle\"></div>
				<div id=\"ajax_data_ruas_tblItem2_".$b."_select\" style=\"display:none;\"></div></td>
				<input type=\"hidden\" name=\"kelompok_tblItem2_".$b."\" value=\"B\">";
				
				$data_input2 .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_nama_ruas_tblItem2_".$b."\"><input type=\"text\" ID=\"nama_ruas_tblItem2_".$b."\"  name=\"nama_ruas_tblItem2_".$b."\" size=\"35\" value=\"".$recordSetData->fields[nama_ruas]."\"></DIV></td>";
	
				/*** Tambahan 08-06-2010 ***/
				$jenis_jalan1	= $recordSetData->fields[id_jns_jln]=='1'? "Provinsi":"Kabupaten/ Kota";
				$data_input2 .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_hidden_jns_jln_tblItem2_".$a."\"><input type=\"hidden\" ID=\"txt_hidden_jns_jln_tblItem2_".$a."\"  name=\"txt_hidden_jns_jln_tblItem2_".$a."\" value=\"".$recordSetData->fields[id_jns_jln]."\"></DIV></td>";
							
				$data_input2 .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_jns_jln_tblItem2_".$a."\"><input type=\"text\" ID=\"txt_jns_jln_tblItem2_".$a."\"  name=\"txt_jns_jln_tblItem2_".$a."\" size=\"15\" value=\"".$jenis_jalan1."\"></DIV></td>";			
				/*** End 0f Tambahan ***/
							
				$data_input2 .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_panjang_tblItem2_".$b."\"><input type=\"text\" ID=\"panjang_tblItem2_".$b."\"  name=\"panjang_tblItem2_".$b."\" size=\"9\" value=\"".$recordSetData->fields[panjang]."\"></DIV></td>";
				
				$data_input2 .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_kondisi_tblItem2_".$b."\" onclick=\"showData(this.id);\"><input type=\"text\" ID=\"kondisi_tblItem2_".$b."\"  name=\"kondisi_tblItem2_".$b."\" size=\"10\" value=\"".$recordSetData->fields[kondisi]."\"><img src=\"../../../../themes/defaults/images/icon/table.gif\" border=\"0\" title=\"Tampilkan Data Kondisi\" class=\"imgLink\" align=\"absmiddle\"></DIV>
				<div id=\"ajax_kondisi_tblItem2_".$b."_select\" style=\"display:none;\">
				<table width=\"175\" bgcolor=\"#FFFFFF\" cellpadding=\"1\" cellspacing=\"1\" style=\"font:11px;border:#CCC solid 2px;\">
				<tr><td width=\"10\"><input type=\"checkbox\" class=\"checkbox\" name=\"kondisi_tblItem2_".$b."_0\" id=\"kondisi_tblItem2_".$b."_0\" value=\"B\"/></td><td>Baik</td></tr>
				<tr><td><input type=\"checkbox\" class=\"checkbox\" name=\"kondisi_tblItem2_".$b."_1\" id=\"kondisi_tblItem2_".$b."_1\" value=\"S\"/></td><td>Sedang</td></tr>
				<tr><td><input type=\"checkbox\" class=\"checkbox\" name=\"kondisi_tblItem2_".$b."_2\" id=\"kondisi_tblItem2_".$b."_2\" value=\"SR\"/></td><td>Sedang Rusak</td></tr>
				<tr><td><input type=\"checkbox\" class=\"checkbox\" name=\"kondisi_tblItem2_".$b."_3\" id=\"kondisi_tblItem2_".$b."_3\" value=\"R\"/></td><td>Rusak</td></tr>
				<tr><td><input type=\"checkbox\" class=\"checkbox\" name=\"kondisi_tblItem2_".$b."_4\" id=\"kondisi_tblItem2_".$b."_4\" value=\"RB\"/></td><td>Rusak Berat</td></tr>
				<tr><td></td><td><a class=\"button\" href=\"#\" onclick=\"this.blur();OKKondisi('tblItem2_".$b."');\"><span><img src=\"../../../../themes/defaults/images/icon/blank.gif\" align=\"absmiddle\">OK</span></a>
				<a class=\"button\" href=\"#\" onclick=\"CancelKondisi('tblItem2_".$b."');\"><span><img src=\"../../../../themes/defaults/images/icon/blank.gif\" align=\"absmiddle\">Cancel</span></a></td></tr>
				</table></div></td>";
				
				$data_input2 .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_lebar_tblItem2_".$b."\"> <input type=\"text\" ID=\"lebar_tblItem2_".$b."\"  name=\"lebar_tblItem2_".$b."\" size=\"10\" value=\"".$recordSetData->fields[lebar]."\"> </DIV></td>";
				$data_input2 .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_lhr_tblItem2_".$b."\"> <input type=\"text\" ID=\"lhr_tblItem2_".$b."\"  name=\"lhr_tblItem2_".$b."\" size=\"10\" value=\"".$recordSetData->fields[lhr_roda_4]."\"> </DIV></td>";
				$data_input2 .= "<td bgcolor=\"#FFFFFF\"><DIV ID=\"ajax_kota_tblItem2_".$b."\"> <input type=\"text\" ID=\"kota_tblItem2_".$b."\"  name=\"kota_tblItem2_".$b."\" size=\"33\" value=\"".$recordSetData->fields[kota_aktivitas_dilayani]."\"><!--<img src=\"../../../../themes/defaults/images/icon/table.gif\" border=\"0\" title=\"Tampilkan Data Kota\" onclick=\"showData('ajax_data_kota');\" class=\"imgLink\" align=\"absmiddle\">--></DIV></td>";
				
				$data_input2 .= "</tr>";
				$b = $b+1;
			}
			//$data_input .= "<td><div id=\"ajax_paket_".$z."\" onclick=\"showpaket(this.id);\" style=\"width:215px;\">
			//<textarea name=\"nama_paket_".$z."\" cols=\"39\" rows=\"2\" wrap=\"virtual\" id=\"nama_paket_".$z."\" readonly  class=\"imgLink\">".$recordSetData  ->fields['nama_paket']."</textarea>
			//<input type=\"hidden\" name=\"no_paket_select_".$z."\" value=\"".$recordSetData  ->fields['no_paket']."\">
			//</div> 			
			//<div id=\"ajax_paket_".$z."_select\" style=\"display:'none';\"> hdjhf </div></td>";
			//$data_input .= "<td><DIV ID=\"ajax_masalah_".$z."\" style=\"width:200px;\"><textarea name=\"masalah_".$z."\" cols=\"38\" rows=\"2\" wrap=\"virtual\" id=\"masalah_".$z."\">".$recordSetData  ->fields['masalah']."</textarea></DIV></td>";
			//$data_input .= "<td><DIV ID=\"ajax_penyelesaian_".$z."\" onclick=\"showpaket(this.id);document.getElementById('penyelesaian_".$z."_1').focus();\" style=\"width:200px;\"><textarea name=\"penyelesaian_".$z."\" cols=\"38\" rows=\"2\" wrap=\"virtual\" id=\"penyelesaian_".$z."\" readonly  class=\"imgLink\">".$recordSetData  ->fields['pemecahan']."</textarea></DIV>
	//<DIV ID=\"ajax_penyelesaian_".$z."_select\" style=\"display:'none';\"><table width=\"250\" bgcolor=\"#FFFFFF\" cellpadding=\"1\" cellspacing=\"1\" style=\"font:11px;border:#CCC solid 2px;\">
	//<tr><td width=\"10\"><input type=\"checkbox\" class=\"checkbox\" name=\"penyelesaian_".$z."_0\" id=\"penyelesaian_".$z."_0\" value=\"Selesai\"/></td><td width=\"240\">Selesai <font color=\"red\">[klik sini jika telah selesai!]</font></td></tr>
	//<tr><td colspan=\"2\"><textarea name=\"penyelesaian_".$z."_1\" cols=\"45\" rows=\"5\" wrap=\"virtual\" id=\"penyelesaian_".$z."_1\"></textarea></td></tr>
//<tr><td></td><td><a class=\"button\" href=\"#\" onclick=\"this.blur();OKManfaat(".$z.")\"><span><img src=\"".$HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images')."/icon/blank.gif\" align=\"absmiddle\">OK</span></a>
//	<a class=\"button\" href=\"#\" onclick=\"CancelManfaat(".$z.")\"><span><img src=\"".$HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images')."/icon/blank.gif\" align=\"absmiddle\">Cancel</span></a></td></tr>
//	</table></div></td>";
			//$data_input .= "<td><DIV ID=\"ajax_instansi_".$z."\" style=\"width:150px;\"><textarea name=\"instansi_".$z."\" cols=\"28\" rows=\"2\" wrap=\"virtual\" id=\"instansi_".$z."\">".$recordSetData  ->fields['instansi']."</textarea></DIV></td>";
		//	$data_input .= "<td><DIV ID=\"ajax_status_perkembangan_".$z."\" style=\"width:150px;\"><textarea name=\"status_perkembangan_".$z."\" cols=\"26\" rows=\"2\" wrap=\"virtual\" id=\"status_perkembangan_".$z."\">".$recordSetData  ->fields['status_perkembangan']."</textarea></DIV></td>";
		//	$data_input .= "</tr>";
			
			$z++;
		$recordSetData->MoveNext();
		endwhile; 
		
		$data_input 	.= "</table>";
		$data_input2 	.= "</table>";
		//print $data_input2;
		
					$delimeter   = "-";
					$option_choice = $id_usulan_main."^/&".$data_input."^/&".$data_input2."^/&".$a."^/&".$b."^/&".$delimeter;	
					echo $option_choice;
}


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

//-----KONDISI JALAN ------------------------------------------

$sql_kondisi_jalan = "SELECT * FROM ".$tbl_name_kondisi_jalan." ORDER BY kode_kondisi_jalan ASC";
$recordSet_kondisi_jalan = $db->Execute($sql_kondisi_jalan);
$initSet = array();
$data_kondisi_jalan = array();
$z=0;
while ($arr=$recordSet_kondisi_jalan->FetchRow()) {
	array_push($data_kondisi_jalan, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_KONDISI_JALAN", $data_kondisi_jalan);

//----------Menampilkan Data Kabupaten---------------------------

if ($_GET[get_propinsi] == 1)
{
	$no_propinsi = $_GET[no_propinsi];
			if($no_propinsi!=''){	
					$sql_kab_combo 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$no_propinsi' ORDER BY nama_kabupaten ASC";
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

/*** Tambahan MASTER JENIS JALAN ***/
$sql_jln = "SELECT id, nm, ket FROM ".$tbl_name_jenis_jln." ORDER BY id ASC LIMIT 5 ";
$recordSet_jln = $db->Execute($sql_jln);
$initSet = array();
$data_jln = array();
$z=0;
while ($arr=$recordSet_jln->FetchRow()) {
	array_push($data_jln, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_JENIS_JLN", $data_jln);
/*** End 0f MASTER JENIS JALAN ***/

if($no_propinsi!=''){	
	$sql_kabupaten 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$no_propinsi' ORDER BY nama_kabupaten ASC";
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
} else {
	$sql_kabupaten 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$MAIN_PROP' ORDER BY nama_kabupaten ASC";
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

if($_GET[get_data_ruas]==1) {
	/**** Tambahan utk filter no_provinsi, no_kabupaten
	*****/
	$f_no_prov	= $_SESSION['SESSION_NO_PROPINSI']!='0'?" AND a.no_propinsi='".$_SESSION['SESSION_NO_PROPINSI']."' ":"";
	$f_no_kabta	= $_SESSION['SESSION_NO_KABUPATEN']!='0'?" AND a.no_kabupaten='".$_SESSION['SESSION_NO_KABUPATEN']."' ":"";

	/*** 07-08-2010 ***/
	$f_id_jns_jln	= $_SESSION['SESSION_JNS_JLN']!='0'?" AND a.id_jns_jln='".$_SESSION['SESSION_JNS_JLN']."' ":"";
				
	$no_propinsi = $_GET['no_propinsi'];
	$no_kabupaten = $_GET['no_kabupaten'];
	$no_row = $_GET['no_row'];
	$item = $_GET[item];
	
	/*** Debug---

	no_row ????????????
	
	print "no.propinsi:".$no_propinsi.
		","."no.kabupaten:".$no_kabupaten.
		","."no.row:".$no_row.
		","."item:".$item;
	***/
	
	/*** remark 27-07-2010
	$sql_paket = "SELECT b.no_ruas,b.nama_pangkal_ruas,b.nama_ujung_ruas,b.panjang_ruas,b.lebar,a.id_jns_jln,ifnull(b.lhr_roda_4,'0') as lhr_roda_4,ifnull(b.kondisi_permukaan,'') as kondisi_permukaan,ifnull(b.kecamatan_yg_dilalui,'') as kecamatan_yg_dilalui FROM tbl_form_k_01_main a 
					LEFT JOIN tbl_form_k_01_detail b ON a.id_k_01_main=b.id_form_k_01_main 
					WHERE a.no_propinsi='".$no_propinsi."' and a.no_kabupaten='".$no_kabupaten."'";
	***/
	$sql_paket = "SELECT b.no_ruas,b.nama_pangkal_ruas,b.nama_ujung_ruas,b.panjang_ruas,b.lebar,a.id_jns_jln,ifnull(b.lhr_roda_4,'0') as lhr_roda_4,ifnull(b.kondisi_permukaan,'') as kondisi_permukaan,ifnull(b.kecamatan_yg_dilalui,'') as kecamatan_yg_dilalui FROM tbl_form_k_01_main a 
					LEFT JOIN tbl_form_k_01_detail b ON a.id_k_01_main=b.id_form_k_01_main 
					WHERE (a.no_propinsi='".$no_propinsi."' $f_no_prov) AND (a.no_kabupaten='".$no_kabupaten."' $f_no_kabta) $f_id_jns_jln ";
	
	$result_paket = $db->Execute($sql_paket);
	$input_paket="<select name='".$item."_".$no_row."' id='".$item."_".$no_row."' size=10 onchange=\"hideData(this.name);\">";
	$input_paket.="<option>[Pilih Data Ruas Jalan]</option> ";
	while(!$result_paket ->EOF):
		$hidden_typ	= $result_paket ->fields['id_jns_jln']=='1'?"Provinsi":"Kabupaten/ Kota";
		$input_paket.="<option value='";
		$input_paket.= $result_paket  ->fields['no_ruas']."||".trim($result_paket ->fields['nama_pangkal_ruas'])." - ".trim($result_paket ->fields['nama_ujung_ruas'])."||".$result_paket ->fields['id_jns_jln']."||".$hidden_typ."||".trim($result_paket ->fields['panjang_ruas'])."||".trim($result_paket ->fields['lebar'])."||".trim($result_paket ->fields['lhr_roda_4'])."||".trim($result_paket ->fields['kondisi_permukaan'])."||".trim($result_paket ->fields['kecamatan_yg_dilalui'])."'>"."(".$result_paket  ->fields['no_ruas'].")"." -> ".$result_paket ->fields['nama_pangkal_ruas']." - ".trim($result_paket ->fields['nama_ujung_ruas']);   
		$input_paket.="</option>";
	$result_paket->MoveNext();
	endwhile; 
	$input_paket.="</select>";
	
	$delimeter   = "-";
	$option_choice = $input_paket."^/&".$delimeter;	
	echo $option_choice;

}
			
if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{

				/***
				Kondisi jika id<>0
				1 = Provinsi
				2 = Kabupaten/ Kota
				***/
				$f_id_jns_jln	= $SES_JNS_JLN!='0'?" AND a.id_jns_jln='".$SES_JNS_JLN."' ":"";
				$f_no_propinsi	= $SES_NO_PROP!='0'?" AND b.no_propinsi='".$SES_NO_PROP."' ":"";
				$f_no_kabupaten	= $SES_NO_KAB!='0'?" AND b.no_kabupaten='".$SES_NO_KAB."' ":"";
				$tahun			= ($Search_Year=="" || $Search_Year==0)?" AND YEAR(b.tanggal_usulan)='".$SES_THN."' ":" AND YEAR(b.tanggal_usulan)='".$Search_Year."' ";
				
				$sql_data_wilayah = " SELECT get_nama_propinsi(no_propinsi) as nama_propinsi,get_nama_kabupaten(no_propinsi,no_kabupaten) as nama_kabupaten FROM ".$tbl_name_kabupaten." WHERE no_propinsi='".$no_propinsi."' AND no_kabupaten='".$no_kabupaten."' ";
				$recordSet_wilayah = $db->execute($sql_data_wilayah);
				$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];
				$nama_kabupaten = $recordSet_wilayah->fields[nama_kabupaten];
				$id_jns_jln = $_POST["jns_jln"]?$_POST["jns_jln"]:$_GET["jns_jln"];
				
				$sql = " SELECT  a.kondisi,b.tanggal_usulan,b.nama_penggisi_usulan,a.id_usulan_detail,a.id_usulan_main,a.kelompok_prioritas,a.no_ruas,a.nama_ruas,a.panjang,a.lebar,a.id_jns_jln,c.nama_kondisi_jalan 
				FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_usulan_main=b.id_usulan 
				LEFT JOIN ".$tbl_name_kondisi_jalan." c ON a.kondisi=c.kode_kondisi_jalan
				WHERE 1=1 ";
				
				/*** Disabled 17-07-2010
				if($no_propinsi!='' AND $no_kabupaten!='' && $Search_Year!='' && $jns_jln!='' ){
					$sql .= " AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' AND YEAR(b.tanggal_usulan)='".$Search_Year."' AND a.id_jns_jln='".$jns_jln."' ";
				}
				***/
				
				if($no_propinsi!='' AND $no_kabupaten!='' AND $jns_jln==''){
					$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) $tahun $f_id_jns_jln ";
				} else if ($no_propinsi!='' AND $no_kabupaten!='' AND $jns_jln!=''){
					$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) AND (a.id_jns_jln='".$jns_jln."'  ) $tahun ";
				} else {
					$sql .= "AND b.no_propinsi='".$SES_NO_PROP."' AND b.no_kabupaten='".$SES_NO_KAB."' $f_id_jns_jln ";
				}				
				
				$sql .= " ORDER BY a.kelompok_prioritas ASC,".$ORDER." ".$SORT." ";

				/*** Test aja.... ***/
				//$smarty->assign("TEST", $sql);
				//print $sql;
										
				if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
				
				$numresults=$db->Execute($sql);
				$count = $numresults->RecordCount();

				$pages = $p->findPages($count,$LIMIT); 
				$sql  .= "LIMIT ".$start.", ".$LIMIT;
				$recordSet = $db->Execute($sql);
				$end = $recordSet->RecordCount();
				$initSet = array();
				$data_tb = array();
				$data_panjang = array();
				$row_class = array();
				$z=0;

				while ($arr=$recordSet->FetchRow()) {
					$panjang = number_format($arr[panjang],2,',','.');
					$nama_penggisi = $arr[nama_penggisi_usulan];
					/*** Disabled on 08-09-2010
					$tanggal_usulan = $arr[tanggal_usulan];
					***/
					$tgl = explode("-",$arr[tanggal_usulan],strlen($arr[tanggal_usulan])); // YYYY-mm-dd
					$tanggal_usulan = $tgl[2]."-".$tgl[1]."-".$tgl[0];
					
					array_push($data_tb, $arr);
					array_push($data_panjang,$panjang);
					
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


$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_FORM_K_02);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_FORM_K_02);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NO_KABUPATEN", $no_kabupaten);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten);
$smarty->assign ("NO_JENIS_JALAN", $id_jns_jln);
$smarty->assign ("SEARCH_YEAR", $Search_Year);
$smarty->assign ("NAMA_PENGGISI", $nama_penggisi);
$smarty->assign ("TANGGAL_USULAN", $tanggal_usulan);
$smarty->assign ("TITLE", _TITLE_FORM_K_02_MAIN);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_FORM_K_02_MAIN);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);
$smarty->assign ("TB_NO", _NO_RUAS);
$smarty->assign ("TB_RUAS", _NAMA_RUAS);
$smarty->assign ("TB_PANJANG", _PANJANG_RUAS);
$smarty->assign ("TB_KONDISI", _KONDISI_RUAS);
$smarty->assign ("TB_LEBAR", _LEBAR_RUAS);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_FORM_K_02_MAIN);
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

/*** Tambahan 08-06-2010 ***/
$smarty->assign ("TB_JENIS_JALAN", _NAMA_JENIS_JALAN);

// kolom pada form pencarian
$smarty->assign ("PID_JENIS_JLN", $fields_find_jns_jln_);
/*** End 0f 08-06-2010 ***/

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
$smarty->assign ("DATA_PANJANG", $data_panjang);
 $smarty->assign ("STATUS_ERROR", $status_error);
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