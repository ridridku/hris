<?php
/*** Last Modify 17-07-2010, malming... ;))
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/monitoring/kabupaten/pelaporan';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/monitoring');
$FILE_JS  = $JS_MODUL.'/kabupaten/pelaporan';

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

$tbl_name_main = "tbl_form_jl_01_main";
$tbl_name_detail = "tbl_form_jl_01_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
$tbl_name_kecamatan = "tbl_mast_wil_kecamatan";
$tbl_name_k_01_main = "tbl_form_k_01_main";
$tbl_name_k_01_detail = "tbl_form_k_01_detail";

$tbl_name_jenis_jln = "tbl_mast_jln";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//


if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="a.id_fjl_01_detail";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['no_propinsi']) $no_propinsi = $_GET['no_propinsi'];
else if ($_POST['no_propinsi']) $no_propinsi = $_POST['no_propinsi'];
else $no_propinsi="";

if ($_GET['jns_jln']) $jns_jln = $_GET['jns_jln'];
else if ($_POST['jns_jln']) $jns_jln = $_POST['jns_jln'];
else $jns_jln="";

if ($_GET['Date_Year']) $tahun = $_GET['Date_Year'];
else if ($_POST['Date_Year']) $tahun = $_POST['Date_Year'];
else $tahun="";

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&search=1"."&jns_jln=".$jns_jln;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&search=1"."&jns_jln=".$jns_jln;

$SES_THN		= $_SESSION['SESSION_TAHUN'];
$SES_JNS_JLN	= $_SESSION['SESSION_JNS_JLN'];
$SES_NO_PROP	= $_SESSION['SESSION_NO_PROPINSI'];

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

//----------Menampilkan Data Kabupaten---------------------------

if($_GET[get_kategori] == 1){
	$kategori = $_GET[jns_kategori];
	
	$delimeter   = "-";
	$option_choice = $kategori."^/&".$delimeter;	
	echo $option_choice;
}

if ($_GET[get_propinsi]==1)
{
	$no_propinsi = $_GET[no_propinsi];
	
			if($no_propinsi!=''){	
					$sql_kab_combo 	  = "SELECT * FROM ".$tbl_name_kabupaten." where no_propinsi='$no_propinsi'";
					$result_kab_combo  = $db->Execute($sql_kab_combo);
					
					$jml_kab = $result_kab_combo ->numrows();
					
					$input_data = "<table width=\"980\">";
					$z=1;
					while(!$result_kab_combo ->EOF): 
						$input_data .= "<tr>";
						$input_data .= "<td class=\"tdatacontent-first-col\" width=\"25\">".$z.".</td>";
						$input_data .= "<td class=\"tdatacontent\" width=\"300\">".$result_kab_combo ->fields['nama_kabupaten']."
						<input type=\"hidden\" name=\"no_kab_".$z."\" value=\"".$result_kab_combo ->fields['no_kabupaten']."\"></td>";
						$input_data .= "<td class=\"tdatacontent\" style=\"background:#FFFAF2;\"><input value=\"1\" type=\"checkbox\" name=\"kol_1_".$z."\" class=\"checkbox\">1</td>";
						$input_data .= "<td class=\"tdatacontent\"><input value=\"1\" type=\"checkbox\" name=\"kol_2_".$z."\" class=\"checkbox\">1</td>";
						$input_data .= "<td class=\"tdatacontent\" style=\"background:#FFFAF2;\"><input value=\"1\" type=\"checkbox\" name=\"kol_3_".$z."\" class=\"checkbox\">1</td>";
						$input_data .= "<td class=\"tdatacontent\"><input value=\"1\" type=\"checkbox\" name=\"kol_4_".$z."\" class=\"checkbox\">1</td>";
						$input_data .= "<td class=\"tdatacontent\" style=\"background:#FFFAF2;\"><input value=\"1\" type=\"checkbox\" name=\"kol_5a_".$z."\" class=\"checkbox\">1
						<input value=\"1\" type=\"checkbox\" name=\"kol_5b_".$z."\" class=\"checkbox\">2
						<input value=\"1\" type=\"checkbox\" name=\"kol_5c_".$z."\" class=\"checkbox\">3
						<input value=\"1\" type=\"checkbox\" name=\"kol_5d_".$z."\" class=\"checkbox\">4</td>";
						$input_data .= "<td class=\"tdatacontent\"><input value=\"1\" type=\"checkbox\" name=\"kol_6a_".$z."\" class=\"checkbox\">1
						<input value=\"1\" type=\"checkbox\" name=\"kol_6b_".$z."\" class=\"checkbox\">2
						<input value=\"1\" type=\"checkbox\" name=\"kol_6c_".$z."\" class=\"checkbox\">3
						<input value=\"1\" type=\"checkbox\" name=\"kol_6d_".$z."\" class=\"checkbox\">4</td>";
						$input_data .= "<td class=\"tdatacontent\" style=\"background:#FFFAF2;\"><input value=\"1\" type=\"checkbox\" name=\"kol_7a_".$z."\" class=\"checkbox\">1
						<input value=\"1\" type=\"checkbox\" name=\"kol_7b_".$z."\" class=\"checkbox\">2
						<input value=\"1\" type=\"checkbox\" name=\"kol_7c_".$z."\" class=\"checkbox\">3
						<input value=\"1\" type=\"checkbox\" name=\"kol_7d_".$z."\" class=\"checkbox\">4</td>";
						$input_data .= "<td class=\"tdatacontent\"><input value=\"1\" type=\"checkbox\" name=\"kol_8_".$z."\" class=\"checkbox\">4</td>";
						$input_data .= "<td class=\"tdatacontent\" style=\"background:#FFFAF2;\"><input value=\"1\" type=\"checkbox\" name=\"kol_9_".$z."\" class=\"checkbox\">4</td>";
						$input_data .= "<td class=\"tdatacontent\"><input value=\"1\" type=\"checkbox\" name=\"kol_10_".$z."\" class=\"checkbox\">4</td>";
						$input_data .= "</tr>";
						$z++;
					$result_kab_combo->MoveNext();
					endwhile; 
					
					$input_data .= "</table>";
					
					//
					$delimeter   = "-";
					$option_choice = $input_data."^/&".$delimeter;	
					echo $option_choice;
			}
}

if($no_propinsi!=''){	
	$sql_kabupaten 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$no_propinsi'";
	$recordSet_kabupaten = $db->Execute($sql_kabupaten);
	$jml_kab = $recordSet_kabupaten->numrows();
	
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
	$sql_kabupaten 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$MAIN_PROP'";
	$recordSet_kabupaten = $db->Execute($sql_kabupaten);
	$jml_kab = $recordSet_kabupaten->numrows();
	
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

if($_GET[getAllData]==1) {
	
	$no_propinsi = $_GET[no_propinsi];	
	$tahun = $_GET[tahun];
	$jns = $_GET[jns_jln];
	
	$sql_monitoring = "SELECT a.no_kabupaten as no_kab,a.nama_kabupaten,b.id_jns_jln,c.*   
			FROM tbl_mast_wil_kabupaten a LEFT JOIN tbl_monitor_jl_main b ON a.no_propinsi=b.no_propinsi 
			LEFT JOIN tbl_monitoring_jl_detail c ON b.id_main=c.id_main AND a.no_kabupaten=c.no_kabupaten  
			WHERE  a.no_propinsi='".$no_propinsi."' AND b.tahun='".$tahun."' AND b.id_jns_jln='".$jns."' ";

		$recordSet_monitoring = $db->Execute($sql_monitoring);	
		
		$jml_kab = $recordSet_monitoring ->numrows();
					
		$input_data = "<table width=\"980\">";
		$z=0;
		while(!$recordSet_monitoring ->EOF): 
			$no = $z+1;
			$input_data .= "<tr>";
			$input_data .= "<td class=\"tdatacontent-first-col\" width=\"25\">".$no.".</td>";
			$input_data .= "<td class=\"tdatacontent\" width=\"300\">".$recordSet_monitoring ->fields['nama_kabupaten']."
			<input type=\"hidden\" name=\"no_kab_".$z."\" value=\"".$recordSet_monitoring ->fields['no_kab']."\"></td>";
			($recordSet_monitoring->fields[jl_01]==1) ? $checked_col_1 = "checked": $checked_col_1 = NULL ;
			$input_data .= "<td class=\"tdatacontent\" style=\"background:#FFFAF2;\"><input value=\"1\" type=\"checkbox\" name=\"kol_1_".$z."\" class=\"checkbox\" ".$checked_col_1.">1</td>";
			($recordSet_monitoring->fields[jl_02]==1) ? $checked_col_2 = "checked": $checked_col_2 = NULL ;
			$input_data .= "<td class=\"tdatacontent\"><input value=\"1\" type=\"checkbox\" name=\"kol_2_".$z."\" class=\"checkbox\" ".$checked_col_2.">1</td>";
			($recordSet_monitoring->fields[jl_03]==1) ? $checked_col_3 = "checked": $checked_col_3 = NULL ;
			$input_data .= "<td class=\"tdatacontent\" style=\"background:#FFFAF2;\"><input value=\"1\" type=\"checkbox\" name=\"kol_3_".$z."\" class=\"checkbox\" ".$checked_col_3.">1</td>";
			($recordSet_monitoring->fields[jl_04]==1) ? $checked_col_4 = "checked": $checked_col_4 = NULL ;
			$input_data .= "<td class=\"tdatacontent\"><input value=\"1\" type=\"checkbox\" name=\"kol_4_".$z."\" class=\"checkbox\" ".$checked_col_4.">1</td>";
			($recordSet_monitoring->fields[jl_05a]==1) ? $checked_col_5a = "checked": $checked_col_5a = NULL ;
			$input_data .= "<td class=\"tdatacontent\" style=\"background:#FFFAF2;\"><input value=\"1\" type=\"checkbox\" name=\"kol_5a_".$z."\" class=\"checkbox\" ".$checked_col_5a.">1";
			($recordSet_monitoring->fields[jl_05b]==1) ? $checked_col_5b = "checked": $checked_col_5b = NULL ;
			$input_data .= "<input value=\"1\" type=\"checkbox\" name=\"kol_5b_".$z."\" class=\"checkbox\" ".$checked_col_5b.">2";
			($recordSet_monitoring->fields[jl_05c]==1) ? $checked_col_5c = "checked": $checked_col_5c = NULL ;
			$input_data .= "<input value=\"1\" type=\"checkbox\" name=\"kol_5c_".$z."\" class=\"checkbox\" ".$checked_col_5c.">3";
			($recordSet_monitoring->fields[jl_05d]==1) ? $checked_col_5d = "checked": $checked_col_5d = NULL ;
			$input_data .= "<input value=\"1\" type=\"checkbox\" name=\"kol_5d_".$z."\" class=\"checkbox\" ".$checked_col_5d.">4</td>";
			($recordSet_monitoring->fields[jl_06a]==1) ? $checked_col_6a = "checked": $checked_col_6a = NULL ;
			$input_data .= "<td class=\"tdatacontent\"><input value=\"1\" type=\"checkbox\" name=\"kol_6a_".$z."\" class=\"checkbox\" ".$checked_col_6a.">1";
			($recordSet_monitoring->fields[jl_06b]==1) ? $checked_col_6b = "checked": $checked_col_6b = NULL ;
			$input_data .= "<input value=\"1\" type=\"checkbox\" name=\"kol_6b_".$z."\" class=\"checkbox\" ".$checked_col_6b.">2";
			($recordSet_monitoring->fields[jl_06c]==1) ? $checked_col_6c = "checked": $checked_col_6c = NULL ;
			$input_data .= "<input value=\"1\" type=\"checkbox\" name=\"kol_6c_".$z."\" class=\"checkbox\" ".$checked_col_6c.">3";
			($recordSet_monitoring->fields[jl_06d]==1) ? $checked_col_6d = "checked": $checked_col_6d = NULL ;
			$input_data .= "<input value=\"1\" type=\"checkbox\" name=\"kol_6d_".$z."\" class=\"checkbox\" ".$checked_col_6d.">4</td>";
			($recordSet_monitoring->fields[jl_07a]==1) ? $checked_col_7a = "checked": $checked_col_7a = NULL ;
			$input_data .= "<td class=\"tdatacontent\" style=\"background:#FFFAF2;\"><input value=\"1\" type=\"checkbox\" name=\"kol_7a_".$z."\" class=\"checkbox\" ".$checked_col_7a.">1";
			($recordSet_monitoring->fields[jl_07b]==1) ? $checked_col_7b = "checked": $checked_col_7b = NULL ;
			$input_data .= "<input value=\"1\" type=\"checkbox\" name=\"kol_7b_".$z."\" class=\"checkbox\" ".$checked_col_7b.">2";
			($recordSet_monitoring->fields[jl_07c]==1) ? $checked_col_7c = "checked": $checked_col_7c = NULL ;
			$input_data .= "<input value=\"1\" type=\"checkbox\" name=\"kol_7c_".$z."\" class=\"checkbox\" ".$checked_col_7c.">3";
			($recordSet_monitoring->fields[jl_07d]==1) ? $checked_col_7d = "checked": $checked_col_7d = NULL ;
			$input_data .= "<input value=\"1\" type=\"checkbox\" name=\"kol_7d_".$z."\" class=\"checkbox\" ".$checked_col_7d.">4</td>";
			($recordSet_monitoring->fields[jl_08]==1) ? $checked_col_8 = "checked": $checked_col_8 = NULL ;
			$input_data .= "<td class=\"tdatacontent\"><input value=\"1\" type=\"checkbox\" name=\"kol_8_".$z."\" class=\"checkbox\" ".$checked_col_8.">4</td>";
			($recordSet_monitoring->fields[jl_09]==1) ? $checked_col_9 = "checked": $checked_col_9 = NULL ;
			$input_data .= "<td class=\"tdatacontent\" style=\"background:#FFFAF2;\"><input value=\"1\" type=\"checkbox\" name=\"kol_9_".$z."\" class=\"checkbox\" ".$checked_col_9.">4</td>";
			($recordSet_monitoring->fields[jl_10]==1) ? $checked_col_10 = "checked": $checked_col_10 = NULL ;
			$input_data .= "<td class=\"tdatacontent\"><input value=\"1\" type=\"checkbox\" name=\"kol_10_".$z."\" class=\"checkbox\" ".$checked_col_10.">4</td>";
			$input_data .= "</tr>";
			$z++;
		$recordSet_monitoring->MoveNext();
		endwhile; 
		
		$input_data .= "</table>";
		
		$delimeter   = "-";
		$option_choice = $input_data."^/&".$delimeter;	
		echo $option_choice;
		
		$smarty->assign ("PID_JENIS_JLN", $jns);
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
				$f_no_propinsi	= $SES_NO_PROP!='0'?" AND a.no_propinsi='".$SES_NO_PROP."' ":"";
								
				$sql_data_wilayah = "SELECT get_nama_propinsi(no_propinsi) as nama_propinsi,ifnull((SELECT monitoring FROM tbl_monitor_jl_main WHERE no_propinsi='".$no_propinsi."' AND tahun='".$tahun."'),'-') as monitoring,ifnull((SELECT id_main FROM tbl_monitor_jl_main WHERE no_propinsi='".$no_propinsi."' AND tahun='".$tahun."'),'-') as id_main FROM ".$tbl_name_propinsi." WHERE no_propinsi='".$no_propinsi."'";
				$recordSet_wilayah = $db->execute($sql_data_wilayah);
				$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];
				$nama_monitoring = $recordSet_wilayah->fields[monitoring];
				$id_main = $recordSet_wilayah->fields[id_main];
				$id_jns_jln = $_POST["jns_jln"]?$_POST["jns_jln"]:$_GET["jns_jln"];
				
	$sql_monitoring = "SELECT a.no_kabupaten,a.nama_kabupaten,b.id_jns_jln,c.*   
			FROM tbl_mast_wil_kabupaten a LEFT JOIN tbl_monitor_jl_main b ON a.no_propinsi=b.no_propinsi 
			LEFT JOIN tbl_monitoring_jl_detail c ON b.id_main=c.id_main AND a.no_kabupaten=c.no_kabupaten ";

			if($no_propinsi!='' AND $tahun!='' AND $jns_jln==''){
				$sql_monitoring .= " WHERE (a.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND b.tahun='".$tahun."' $f_id_jns_jln ";
			} else if ($no_propinsi!='' AND $tahun!=''  AND $jns_jln!=''){
				$sql_monitoring .= " WHERE (a.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.id_jns_jln='".$jns_jln."' $f_id_jns_jln) AND b.tahun='".$tahun."' ";
			} else {
				$sql_monitoring .= " WHERE a.no_propinsi='".$SES_NO_PROP."' $f_id_jns_jln ";
			}
					
	/***
	$smarty->assign("AMBIL_ID_JNS_JLN",$sql_monitoring);
	***/
	
	$recordSet_monitoring = $db->Execute($sql_monitoring);	
	$smarty->assign ("XID_MAIN", $id_main);
	$smarty->assign ("JML_KAB", $recordSet_monitoring->numrows());
	$initSet = array();
	$data_monitoring = array();
	$z=0;
	while ($arr=$recordSet_monitoring->FetchRow()) {
		array_push($data_monitoring, $arr);
		array_push($initSet, $z);
		$z++;
	}

	$smarty->assign ("DATA_MONITORING", $data_monitoring);
}

}

($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;

$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_MONITORING_JL01_10);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_MONITORING_JL01_10);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NO_JENIS_JALAN", $id_jns_jln);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("NAMA_MONITORING", $nama_monitoring);
$smarty->assign ("TAHUN", $tahun);
$smarty->assign ("JML_KAB", $jml_kab);
$smarty->assign ("TITLE", _TITLE_MONITORING_JL01_10);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_MONITORING_JL01_10);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_FORM_MONITORING_JL01_10);
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
/*** Tambahan 28-06-2010 ***/
$smarty->assign ("TB_JENIS_JALAN", _NAMA_JENIS_JALAN);

// kolom pada form pencarian
$smarty->assign ("PID_JENIS_JLN", $id_jns_jln);
/*** End 0f 28-06-2010 ***/
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