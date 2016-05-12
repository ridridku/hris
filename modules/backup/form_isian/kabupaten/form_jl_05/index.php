<?php
/*** Last Modify 17-07-2010
***/

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_jl_05';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_jl_05';

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

$tbl_name_main = "tbl_form_jl_05_main";
$tbl_name_detail = "tbl_form_jl_05_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
$tbl_name_kecamatan = "tbl_mast_wil_kecamatan";
/*** Tambahan ***/
$tbl_mast_prop_sumber_dana_lain = "tbl_mast_prop_sumber_dana_lain";
$tbl_mast_prop_jenis_penanganan = "tbl_mast_prop_jenis_penanganan";
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
else $ORDER="a.nama_ruas";

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

if($jns_jln!="" && strlen($jns_jln)!=0 ){
	$fields_find_jns_jln_ = $jns_jln;
} else if ( $txt_hidden_jns_jln!="" && strlen($txt_hidden_jns_jln)!=0 ){
	$fields_find_jns_jln_ = $txt_hidden_jns_jln;
}

if ($_GET['Date_Year']) $Date_Year = $_GET['Date_Year'];
else if ($_POST['Date_Year']) $Date_Year = $_POST['Date_Year'];
else $Date_Year="";

if ($_GET['status_error']) $status_error = $_GET['status_error'];
else if ($_POST['status_error']) $status_error = $_POST['status_error'];
else $status_error="";

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Date_Year=".$Date_Year."&jns_jln=".$jns_jln;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Date_Year=".$Date_Year."&jns_jln=".$jns_jln;

$SES_THN		= $_SESSION['SESSION_TAHUN'];
$SES_JNS_JLN	= $_SESSION['SESSION_JNS_JLN'];
$SES_NO_PROP	= $_SESSION['SESSION_NO_PROPINSI'];
$SES_NO_KAB		= $_SESSION['SESSION_NO_KABUPATEN'];

//----------EDIT DATA FORM K-01-----------------------------------

$opt = $_GET[opt];
$id_form_jl_05_main = $_GET[id_fjl_05_main];
$id_form_jl_05_detail = $_GET[id_fjl_05_detail];
$ed = 0;

if ($opt=="1" AND $id_form_jl_05_main<>'' AND $id_form_jl_05_detail<>'') {

/*** Tambahan 21-06-2010 ***/
$id_jns_jln = $fields_find_jns_jln_;
/*** End 0f Tambahan 05-06-2010 ***/

$sql = "SELECT * 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_05_main=b.id_fjl_05_main 
		WHERE 1=1 AND b.id_fjl_05_main='".$id_form_jl_05_main."' AND b.id_jns_jln='".$id_jns_jln."' AND a.id_fjl_05_detail='".$id_form_jl_05_detail."' ";
$recordSet_Edit = $db->execute($sql);
$arr_kecamatan = explode(";",$recordSet_Edit->fields[kecamatan_yg_dilalui]);
$edit = 1;	

	$sql_data_paket_jalan = "SELECT b.id_fjl_03_detail,b.nama_ruas,b.kecamatan_yg_dilalui FROM tbl_form_jl_03_main a LEFT JOIN tbl_form_jl_03_detail b ON 					
	a.id_fjl_03_main=b.id_fjl_03_main WHERE a.no_propinsi='".$no_propinsi."' and a.no_kabupaten='".$no_kabupaten."' AND a.tahun='".$Date_Year."'";
	
	$result_data_paket_jalan = $db->execute($sql_data_paket_jalan);
	$total_paket = $result_data_paket_jalan->numrows();

$tgl = explode("-",$recordSet_Edit->fields[tanggal],strlen($recordSet_Edit->fields[tanggal])); // YYYY-mm-dd
$tanggal = !empty($tgl[2])?$tgl[2]."-".$tgl[1]."-".$tgl[0]:"";
$tgl2 = explode("-",$recordSet_Edit->fields[tanggal_spmk],strlen($recordSet_Edit->fields[tanggal_spmk])); // YYYY-mm-dd
//$tanggal_spmk = !empty($tgl2[2])?$tgl2[2]."-".$tgl2[1]."-".$tgl2[0]:"";
$tgl3 = explode("-",$recordSet_Edit->fields[rencana_pho],strlen($recordSet_Edit->fields[rencana_pho])); // YYYY-mm-dd
//$rencana_pho = !empty($tgl3[2])?$tgl3[2]."-".$tgl3[1]."-".$tgl3[0]:"";
					
$smarty->assign ("OPT", $opt);					
$smarty->assign ("ID_JL_05_MAIN", $recordSet_Edit->fields[id_fjl_05_main]);
$smarty->assign ("ID_FORM_JL_05_DETAIL", $recordSet_Edit->fields[id_fjl_05_detail]);
$smarty->assign ("TANGGAL", $tanggal);
$smarty->assign ("NAMA_PAKET", $recordSet_Edit->fields[nama_ruas]);
// Tambahan on 07-09-2010
$smarty->assign ("ID_JENIS_PENANGANAN",$recordSet_Edit->fields[nama_jenis_penanganan]);
$smarty->assign ("KECAMATAN_YG_DILALUI", $arr_kecamatan);
$smarty->assign ("TARGET_M", $recordSet_Edit->fields[target_m]);
/*** Disabled on 22-09-2010
$smarty->assign ("TARGET_UNIT", $recordSet_Edit->fields[target_unit]);
***/
/*** Disabled on 07-09-2010
$smarty->assign ("BIAYA_DAK", $recordSet_Edit->fields[biaya_dak]);
$smarty->assign ("BIAYA_PENDAMPING", $recordSet_Edit->fields[biaya_pendamping]);
***/
$smarty->assign ("ID_PROP_SUMBER_DANA_LAIN", $recordSet_Edit->fields[sumber_pendanaan]);
$smarty->assign ("BIAYA_TOTAL", $recordSet_Edit->fields[biaya_total]);
$smarty->assign ("METODA_PELAKSANAAN", $recordSet_Edit->fields[metoda_pelaksanaan]);
$smarty->assign ("BULAN_SPMK",$tgl2[1]);
$smarty->assign ("TANGGAL_SPMK",$tgl2[2]);
$smarty->assign ("TAHUN_SPMK",$tgl2[0]);
$smarty->assign ("BULAN_PHO",$tgl[1]);
$smarty->assign ("TANGGAL_PHO",$tgl[2]);
$smarty->assign ("TAHUN_PHO",$tgl[0]);
//$smarty->assign ("TANGGAL_SPMK", $tanggal_spmk);
//$smarty->assign ("RENCANA_PHO", $rencana_pho);
$smarty->assign ("WAKTU_PELAKSANAAN", $recordSet_Edit->fields[waktu_pelaksanaan]);
$smarty->assign ("PIMPRO", $recordSet_Edit->fields[pimpro]);
$smarty->assign ("KONTRAKTOR", $recordSet_Edit->fields[kontraktor]);
$smarty->assign ("PENGAWAS", $recordSet_Edit->fields[pengawas]);
$smarty->assign ("KETERANGAN", $recordSet_Edit->fields[keterangan]);

/*** Tambahan 21-06-2010 ***/
$smarty->assign("ID_HIDDEN_JSN_JLN",$recordSet_Edit->fields[id_jns_jln]);
$jenis_jalan	= $recordSet_Edit->fields[id_jns_jln]==1? "Provinsi":"Kabupaten/ Kota";
$smarty->assign ("PID_JENIS_JLN2", $jenis_jalan);
/*** End 0f 21-06-2010 ***/

}

/*** Tambahan MASTER PENANGANAN ***/
$sql_jns_penanganan = "SELECT * FROM ".$tbl_mast_prop_jenis_penanganan." ORDER BY nama_prop_jenis_penanganan ASC LIMIT 25 ";
$recordSet_jns_penanganan = $db->Execute($sql_jns_penanganan);
$initSet = array();
$data_jns_penanganan = array();
$z=0;
while ($arr=$recordSet_jns_penanganan->FetchRow()) {
	array_push($data_jns_penanganan, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_JENIS_PENANGANAN", $data_jns_penanganan);
/*** End 0f MASTER PENANGANAN ***/

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


/*** Tambahan MASTER PENDANAAN ***/
$sql_sumber_dana = "SELECT id_prop_sumber_dana_lain, nama_prop_sumber_dana_lain FROM ".$tbl_mast_prop_sumber_dana_lain." ORDER BY nama_prop_sumber_dana_lain ASC LIMIT 30 ";
$recordSet_sumber_dana = $db->Execute($sql_sumber_dana);
$initSet = array();
$data_sumber_dana = array();
$z=0;
while ($arr=$recordSet_sumber_dana->FetchRow()) {
	array_push($data_sumber_dana, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("SUMBER_PENDANAAN", $data_sumber_dana);
/*** End 0f PENDANAAN ***/

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

/*
$sql_paket = "SELECT b.id_fjl_03_detail,b.nama_ruas FROM tbl_form_jl_03_main a LEFT JOIN tbl_form_jl_03_detail b ON a.id_fjl_03_main=b.id_fjl_03_main WHERE a.no_propinsi='$no_propinsi' AND a.no_kabupaten='$no_kabupaten' AND a.tahun='$tahun'";
$recordSet_paket = $db->Execute($sql_paket);
$initSet = array();
$data_paket = array();
$z=0;
while ($arr=$recordSet_paket->FetchRow()) {
	array_push($data_paket, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PAKET", $data_paket);
*/

//----------Menampilkan Data Kabupaten---------------------------

if ($_GET[get_propinsi] == 1)
{
	$no_propinsi = $_GET[no_propinsi];

			if($no_propinsi!=''){	
					$sql_kab_combo 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$no_propinsi' ORDER BY nama_kabupaten ASC ";
					$result_kab_combo  = $db->Execute($sql_kab_combo);
					$input_kab="<select name=no_kabupaten  onChange=\"cari_kecamatan(".$no_propinsi.",this.value,frmCreate.tahun.value)\">";
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

//----------Menampilkan Data Kecamatan---------------------------

if ($_GET[get_kabupaten]==1)
{
			$no_propinsi	= $_GET[no_propinsi];
			$no_kabupaten	= $_GET[no_kabupaten];
			$tahun = $_GET[Date_Year];
			
			if($no_propinsi!='' AND $no_kabupaten!=''){	
						
					$sql_kecamatan_combo 	  = "SELECT * FROM ".$tbl_name_kecamatan." where no_propinsi='$no_propinsi' AND no_kabupaten='$no_kabupaten'";

					$result_kecamatan_combo  = $db->Execute($sql_kecamatan_combo);
					$table_kecamatan="<table cellspacing=\"0\" cellpadding=\"0\" width=\"400\">\n";
					$z=0;
					while(!$result_kecamatan_combo->EOF): 						
						$sisa = $z%2;				
						if ($sisa==0) {	$table_kecamatan.="<tr>"; } 
						$table_kecamatan.="<td width=\"15\"><input type=\"checkbox\" class=\"checkbox\" name=\"akecamatan".$z."\" value=\"".$result_kecamatan_combo->fields['nama_kecamatan']."\"/></td>
<td class=\"text-regular\">".$result_kecamatan_combo->fields['nama_kecamatan']."</td>";
						if ($sisa==1) { $table_kecamatan.="</tr>\n"; }
					$result_kecamatan_combo->MoveNext();
					$z++;
					endwhile; 					
					$table_kecamatan.="</table>\n";
					$table_kecamatan.="<input type=\"hidden\" name=\"jml_kecamatan\" value=\"".$z++."\">";	
					
					$sql_data_paket_jalan = "SELECT b.id_fjl_03_detail,b.nama_ruas,b.kecamatan_yg_dilalui FROM tbl_form_jl_03_main a LEFT JOIN tbl_form_jl_03_detail b ON 					
					a.id_fjl_03_main=b.id_fjl_03_main WHERE a.no_propinsi='".$no_propinsi."' and a.no_kabupaten='".$no_kabupaten."' AND a.tahun='".$Date_Year."'";
					
					$result_data_paket_jalan = $db->execute($sql_data_paket_jalan);
					$total_paket = $result_data_paket_jalan->numrows();
					
					$data_paket = "<select id=\"nama_paket_result\" multiple size=\"10\" onchange=\"get_data_paket(".$no_propinsi.",".$no_kabupaten.",this.value);showPaket();\">";
					
					while(!$result_data_paket_jalan ->EOF): 	
						$data_paket .= "<option value=\"".$result_data_paket_jalan->fields[id_fjl_03_detail]."\">".$result_data_paket_jalan->fields[nama_ruas]."</option>";
						$result_data_paket_jalan->MoveNext();
					endwhile;

					$data_paket .= "</select>";				
					($total_paket>0) ? $show_paket="<img src=\"../../../../themes/defaults/images/icon/table.gif\" border=\"0\" title=\"Tampilkan Data Paket Jalan\" onclick=\"showPaket();\" class=\"imgLink\" align=\"absmiddle\">": $show_paket=NULL;
					$input_paket = "<input name=\"nama_paket\" id=\"nama_paket\" type=\"text\" value=\"\" size=\"65\" maxlength=\"200\"> ".$show_paket;
					
					$delimeter   = "-";
					$option_choice = $table_kecamatan."^/&".$input_paket."^/&".$data_paket."^/&".$delimeter;	
					echo $option_choice;
			}
}

if ($_GET[get_data_paket]==1) {
	
	$no_paket = $_GET[no_paket];
	$no_propinsi = $_GET[no_propinsi];
	$no_kabupaten = $_GET[no_kabupaten];
	$txt_hidden_jns_jln = $_GET[txt_hidden_jns_jln];
	$jns_jln = $_GET[jns_jln];
		
	if($no_propinsi!='' AND $no_kabupaten!='' AND $no_paket!=''){	
	
					$sql_data_paket_jalan = "SELECT a.id_jns_jln,b.id_fjl_03_detail,b.nama_ruas,b.kecamatan_yg_dilalui FROM tbl_form_jl_03_main a LEFT JOIN tbl_form_jl_03_detail b ON 					
					a.id_fjl_03_main=b.id_fjl_03_main WHERE a.no_propinsi='".$no_propinsi."' and a.no_kabupaten='".$no_kabupaten."' AND b.id_fjl_03_detail='".$no_paket."'";
					
					$result_data_paket_jalan = $db->execute($sql_data_paket_jalan);
					$arr_kecamatan = explode(";",$result_data_paket_jalan->fields[kecamatan_yg_dilalui]);
					
					$nama_paket = $result_data_paket_jalan->fields[nama_ruas];

					//Tambahan 21-06-2010 -->
					$jenis_jalan	= $result_data_paket_jalan->fields[id_jns_jln]==1? "Provinsi":"Kabupaten/ Kota";
					
					$tmp_hidden_jsn_jln = "<input name=\"txt_hidden_jns_jln\" type=\"hidden\" value=\"".$result_data_paket_jalan->fields[id_jns_jln]."\" >";
					
					$tmp_jsn_jln = "<input name=\"txt_jns_jln\" type=\"text\" value=\"".$jenis_jalan."\" size=\"26\" maxlength=\"200\" readonly>";
					//End 0f Tambahan 21-06-2010 -->
						
					$sql_kecamatan_combo 	  = "SELECT * FROM ".$tbl_name_kecamatan." where no_propinsi='$no_propinsi' AND no_kabupaten='$no_kabupaten'";

					$result_kecamatan_combo  = $db->Execute($sql_kecamatan_combo);
					$table_kecamatan="<table cellspacing=\"0\" cellpadding=\"0\" width=\"400\">\n";
					$z=0;
					while(!$result_kecamatan_combo ->EOF): 						
						$sisa = $z%2;								
						if ($sisa==0) {	$table_kecamatan.="<tr>"; } 
						$table_kecamatan.="<td width=\"15\"><input type=\"checkbox\" class=\"checkbox\" name=\"kecamatan_".$z."\" value=\"".$result_kecamatan_combo  ->fields['nama_kecamatan']."\" ";
						for($i=0;$i<count($arr_kecamatan);$i++) {
							(trim(strtolower($result_kecamatan_combo  ->fields['nama_kecamatan']))==trim(strtolower($arr_kecamatan[$i]))) ? $table_kecamatan.="checked" : $table_kecamatan.=NULL;
						}
						$table_kecamatan.="/></td><td class=\"text-regular\">".$result_kecamatan_combo  ->fields['nama_kecamatan']."</td>";
						if ($sisa==1) { $table_kecamatan.="</tr>\n"; }
					$result_kecamatan_combo->MoveNext();
					$z++;
					endwhile; 					
					$table_kecamatan.="</table>\n";
					$table_kecamatan.="<input type=\"hidden\" name=\"jml_kecamatan\" value=\"".$z++."\">";	

	$delimeter   = "-";
	$option_choice = $nama_paket."^/&".$tmp_jsn_jln."^/&".$table_kecamatan."^/&".$tmp_hidden_jsn_jln."^/&".$delimeter;	
	echo $option_choice;
	}
}

//---------------------------------------------------------------

if($no_propinsi!=''){	
	$sql_kabupaten 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$no_propinsi' ORDER BY nama_kabupaten ASC ";
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
	$sql_kabupaten 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$MAIN_PROP' ORDER BY nama_kabupaten ASC ";
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
		
$prop	= $_POST[no_propinsi]?$_POST[no_propinsi]:$_GET[no_propinsi];
$kab	= $_POST[no_kabupaten]?$_POST[no_kabupaten]:$_GET[no_kabupaten];

if($prop!='' AND $kab!=''){	
	/**** Tambahan utk filter no_provinsi, no_kabupaten
	*****/
	$f_no_prov	= $_SESSION['SESSION_NO_PROPINSI']!='0'?" AND a.no_propinsi='".$_SESSION['SESSION_NO_PROPINSI']."' ":"";
	$f_no_kabta	= $_SESSION['SESSION_NO_KABUPATEN']!='0'?" AND a.no_kabupaten='".$_SESSION['SESSION_NO_KABUPATEN']."' ":"";

	/*** 07-08-2010 ***/
	$f_id_jns_jln	= $_SESSION['SESSION_JNS_JLN']!='0'?" AND a.id_jns_jln='".$_SESSION['SESSION_JNS_JLN']."' ":"";
		
	$sql_kecamatan 	  = " SELECT * FROM ".$tbl_name_kecamatan." where no_propinsi='$no_propinsi' AND no_kabupaten='$no_kabupaten' ";
	$recordSet_kecamatan = $db->Execute($sql_kecamatan);
	$initSet = array();
	$data_kecamatan = array();
	$cacah=0;
	while ($arr=$recordSet_kecamatan->FetchRow()) {
		array_push($data_kecamatan, $arr);
		array_push($initSet, $cacah);
		$cacah++;
	}
	/*** Debug 24-06-2010 
	$smarty->assign ("PROP_KABUPATEN",$no_propinsi."-".$no_kabupaten."qry(".$cacah.")".$sql_kecamatan);
	***/
	
	$smarty->assign ("DATA_KECAMATAN", $data_kecamatan);
	$smarty->assign ("JML_KECAMATAN", $cacah);
	
	$sql_data_paket_jalan = "SELECT 
	b.id_fjl_03_detail,
	b.nama_ruas,
	b.kecamatan_yg_dilalui 
	FROM tbl_form_jl_03_main a 
	LEFT JOIN tbl_form_jl_03_detail b 
	ON 					
	a.id_fjl_03_main=b.id_fjl_03_main 
	WHERE ( a.no_propinsi='".$no_propinsi."' $f_no_prov ) 
	AND ( a.no_kabupaten='".$no_kabupaten."' $f_no_kabta ) 
	AND YEAR(a.tanggal)='".$Date_Year."' $f_id_jns_jln ";
	
	$result_data_paket_jalan = $db->execute($sql_data_paket_jalan);
	$total_paket = $result_data_paket_jalan->numrows();
	
	$initSet = array();
	$data_paket_jalan = array();
	$z=0;
	
	while ($arr=$result_data_paket_jalan->FetchRow()) {
		array_push($data_paket_jalan, $arr);
		array_push($initSet, $z);
		$z++;
	}
	$smarty->assign ("DATA_PAKET_JALAN", $data_paket_jalan);			
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
				$f_id_jns_jln	= $SES_JNS_JLN!='0'?" AND b.id_jns_jln='".$SES_JNS_JLN."' ":"";
				$f_no_propinsi	= $SES_NO_PROP!='0'?" AND b.no_propinsi='".$SES_NO_PROP."' ":"";
				$f_no_kabupaten	= $SES_NO_KAB!='0'?" AND b.no_kabupaten='".$SES_NO_KAB."' ":"";
				$tahun			= ($Date_Year=="" || $Date_Year==0)?" AND YEAR(b.tanggal)='".$SES_THN."' ":" AND YEAR(b.tanggal)='".$Date_Year."' ";
				
				$sql_data_wilayah = "SELECT nama_propinsi,nama_kabupaten FROM ".$tbl_name_kabupaten." a join tbl_mast_wil_propinsi b on a.no_propinsi=b.no_propinsi WHERE a.no_propinsi='".$no_propinsi."' AND no_kabupaten='".$no_kabupaten."' ";
				$recordSet_wilayah = $db->execute($sql_data_wilayah);
				$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];
				$nama_kabupaten = $recordSet_wilayah->fields[nama_kabupaten];
				/*** Disabled on 22-09-2010
				$sql = "SELECT b.id_fjl_05_main,a.id_fjl_05_detail,a.nama_ruas,a.kecamatan_yg_dilalui,a.target_m,a.target_unit,c.nama_prop_jenis_penanganan 
				FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_05_main=b.id_fjl_05_main LEFT JOIN ".$tbl_mast_prop_jenis_penanganan." c ON c.id_prop_jenis_penanganan=a.nama_jenis_penanganan
				WHERE 1=1 ";
				 ***/ 
				$sql = "SELECT b.id_fjl_05_main,a.id_fjl_05_detail,a.nama_ruas,a.kecamatan_yg_dilalui,a.target_m,c.nama_prop_jenis_penanganan 
				FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_05_main=b.id_fjl_05_main LEFT JOIN ".$tbl_mast_prop_jenis_penanganan." c ON c.id_prop_jenis_penanganan=a.nama_jenis_penanganan
				WHERE 1=1 ";				 
				/***
				if($no_propinsi!='' AND $no_kabupaten!='' AND $tahun!=''){
					$sql .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' AND YEAR(b.tanggal)='".$tahun."' ";
				}
				***/

				if($no_propinsi!='' AND $no_kabupaten!='' AND $jns_jln==''){
					$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) $tahun $f_id_jns_jln ";
				} else if ($no_propinsi!='' AND $no_kabupaten!='' AND $jns_jln!=''){
					$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) AND (b.id_jns_jln='".$jns_jln."' ) $tahun ";
				} else {
					$sql .= "AND b.no_propinsi='".$SES_NO_PROP."' AND b.no_kabupaten='".$SES_NO_KAB."' $f_id_jns_jln ";
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
				$data_target_m = array();
				$row_class = array();
				$z=0;

				while ($arr=$recordSet->FetchRow()) {
					$target_m = number_format($arr[target_m],2,',','.');;
					
					array_push($data_target_m, $target_m);
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

$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_FORM_JL_05);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_FORM_JL_05);
$smarty->assign ("FORM_NAME", _FORM);

// TAMBAHAN
$smarty->assign ("FORM_NAME2", _FORM_NAME_IMPORT);

$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NO_KABUPATEN", $no_kabupaten);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten);
$smarty->assign ("TAHUN", $Date_Year);
$smarty->assign ("TOTAL_PAKET_JALAN", $total_paket);	
$smarty->assign ("TITLE", _TITLE_FORM_JL_05_MAIN);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_FORM_JL_05_MAIN);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("TB_NAMA_RUAS", _NAMA_RUAS);
$smarty->assign ("TB_NAMA_PAKET", _NAMA_PAKET);
$smarty->assign ("TB_KECAMATAN", _KECAMATAN_YG_DILALUI);
$smarty->assign ("TB_TARGET", _TARGET);
$smarty->assign ("TB_TARGET_M", _TARGET_M);
/*** Disabled on 22-09-2010
$smarty->assign ("TB_TARGET_UNIT", _TARGET_UNIT);
***/
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_FORM_JL_05_MAIN);
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
/*** Tambahan 12-06-2010 ***/
$smarty->assign ("TB_JENIS_JALAN", _NAMA_JENIS_JALAN);
// kolom pada form pencarian
$smarty->assign ("PID_JENIS_JLN", $fields_find_jns_jln_);
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
$smarty->assign ("DAFTAR_BULAN",$daftar_bulan);
$smarty->assign ("DAFTAR_TANGGAL",$daftar_tanggal);
$smarty->assign ("DATA_TARGET_M",$data_target_m);
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