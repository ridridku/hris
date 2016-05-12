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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_jl_02';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_jl_02';

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

$tbl_name_main = "tbl_form_jl_02_main";
$tbl_name_detail = "tbl_form_jl_02_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
$tbl_name_k_01_main = "tbl_form_k_01_main";
$tbl_name_k_01_detail = "tbl_form_k_01_detail";

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
else $ORDER="a.id_fjl_02_detail";

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

/**
if ($_GET['jns_jln2']) $jns_jln2 = $_GET['jns_jln2'];
else if ($_POST['jns_jln2']) $jns_jln2 = $_POST['jns_jln2'];
else $jns_jln2="";
**/

if ($_GET['txt_hidden_jns_jln']) $txt_hidden_jns_jln = $_GET['txt_hidden_jns_jln'];
else if ($_POST['txt_hidden_jns_jln']) $txt_hidden_jns_jln = $_POST['txt_hidden_jns_jln'];
else $txt_hidden_jns_jln="";

/***
if ($_GET['txt_hidden_jns_jln2']) $txt_hidden_jns_jln2 = $_GET['txt_hidden_jns_jln2'];
else if ($_POST['txt_hidden_jns_jln2']) $txt_hidden_jns_jln2 = $_POST['txt_hidden_jns_jln2'];
else $txt_hidden_jns_jln2="";
***/

if($jns_jln!="" && strlen($jns_jln)!=0 ){
	$fields_find_jns_jln_ = $jns_jln;
} /** else if($jns_jln2!=""){
	$fields_find_jns_jln_ = $jns_jln2;
} **/ else if ( $txt_hidden_jns_jln!="" && strlen($txt_hidden_jns_jln)!=0 ){
	$fields_find_jns_jln_ = $txt_hidden_jns_jln;
}

$Search_Year = $_GET[Search_Year];

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year."&jns_jln=".$jns_jln;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year."&jns_jln=".$fields_find_jns_jln_."&txt_hidden_jns_jln=".$fields_find_jns_jln_;

$SES_THN		= $_SESSION['SESSION_TAHUN'];
$SES_JNS_JLN	= $_SESSION['SESSION_JNS_JLN'];
$SES_NO_PROP	= $_SESSION['SESSION_NO_PROPINSI'];
$SES_NO_KAB		= $_SESSION['SESSION_NO_KABUPATEN'];

//----------EDIT DATA FORM K-01-----------------------------------

$opt = $_GET[opt];
$id_form_jl_02_main = $_GET[id_fjl_02_main];
$id_form_jl_02_detail = $_GET[id_fjl_02_detail];
$ed = 0;

if ($opt=="1" AND $id_form_jl_02_main<>'' AND $id_form_jl_02_detail<>'') {

/*** Tambahan 17-06-2010 ***/
$id_jns_jln = $fields_find_jns_jln_;
/*** End 0f Tambahan 17-06-2010 ***/

$sql = "SELECT * 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_02_main=b.id_fjl_02_main 
		WHERE 1=1 AND b.id_fjl_02_main='".$id_form_jl_02_main."' AND b.id_jns_jln='".$id_jns_jln."' AND a.id_fjl_02_detail='".$id_form_jl_02_detail."' ";
$recordSet_Edit = $db->execute($sql);

/***
$smarty->assign ("STRING_QRY",$sql);
***/

$edit = 1;	
$tgl = explode("-",$recordSet_Edit->fields[tanggal],strlen($recordSet_Edit->fields[tanggal])); // YYYY-mm-dd
$format_tgl = $tgl[2]."-".$tgl[1]."-".$tgl[0];

$smarty->assign ("OPT", $opt);					
$smarty->assign ("ID_JL_02_MAIN", $recordSet_Edit->fields[id_fjl_02_main]);
$smarty->assign ("ID_FORM_JL_02_DETAIL", $recordSet_Edit->fields[id_fjl_02_detail]);
$smarty->assign ("TANGGAL", $format_tgl);
$smarty->assign ("NO_RUAS", $recordSet_Edit->fields[no_ruas]);
$smarty->assign ("NAMA_RUAS", $recordSet_Edit->fields[nama_ruas]);
$smarty->assign ("PANJANG_KM", $recordSet_Edit->fields[panjang_km]);
$smarty->assign ("PANJANG_M", $recordSet_Edit->fields[panjang_m]);
$smarty->assign ("KONDISI_BAIK", $recordSet_Edit->fields[kondisi_baik]);
$smarty->assign ("KONDISI_SEDANG", $recordSet_Edit->fields[kondisi_sedang]);
$smarty->assign ("KONDISI_RUSAK", $recordSet_Edit->fields[kondisi_rusak]);
$smarty->assign ("KONDISI_RUSAK_BERAT", $recordSet_Edit->fields[kondisi_rusak_berat]);
$smarty->assign ("LHR_RATA_RATA", $recordSet_Edit->fields[lhr_rata_rata]);
$smarty->assign ("AKSES_JALAN", $recordSet_Edit->fields[akses_jalan]);
$smarty->assign ("JUMLAH_PENDUDUK", $recordSet_Edit->fields[jumlah_penduduk]);
$smarty->assign ("KETERANGAN", $recordSet_Edit->fields[keterangan]);

/*** Tambahan 17-06-2010 ***/
$smarty->assign("ID_HIDDEN_JSN_JLN",$recordSet_Edit->fields[id_jns_jln]);
$jenis_jalan	= $recordSet_Edit->fields[id_jns_jln]==1? "Provinsi":"Kabupaten/ Kota";
$smarty->assign ("PID_JENIS_JLN2", $jenis_jalan);
/*** End 0f 17-06-2010 ***/
}

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

if ($_GET[get_propinsi] == 1)
{
	$no_propinsi = $_GET[no_propinsi];
			if($no_propinsi!=''){	
					$sql_kab_combo 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$no_propinsi' ORDER BY nama_kabupaten ASC ";
					$result_kab_combo  = $db->Execute($sql_kab_combo);
					$input_kab="<select name=no_kabupaten onChange=\"resetData(frmCreate); cari_kecamatan(".$no_propinsi.",this.value);\">";
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

if ($_GET[get_kabupaten] == 1)
{

		if($no_propinsi!='' AND $no_kabupaten!=''){	
				/**** Tambahan utk filter no_provinsi, no_kabupaten
				*****/
				$f_no_prov	= $_SESSION['SESSION_NO_PROPINSI']!='0'?" AND a.no_propinsi='".$_SESSION['SESSION_NO_PROPINSI']."' ":"";
				$f_no_kabta	= $_SESSION['SESSION_NO_KABUPATEN']!='0'?" AND a.no_kabupaten='".$_SESSION['SESSION_NO_KABUPATEN']."' ":"";
				
				/*** remark 27-07-2010 					
				$sql_data_ruas_jalan = "SELECT b.no_ruas,b.nama_pangkal_ruas,b.nama_ujung_ruas FROM tbl_form_k_01_main a LEFT JOIN tbl_form_k_01_detail b ON 					
				a.id_k_01_main=b.id_form_k_01_main WHERE a.no_propinsi='".$no_propinsi."' and a.no_kabupaten='".$no_kabupaten."'";
				***/
				$sql_data_ruas_jalan = "SELECT b.no_ruas,b.nama_pangkal_ruas,b.nama_ujung_ruas FROM tbl_form_k_01_main a LEFT JOIN tbl_form_k_01_detail b ON 					
				a.id_k_01_main=b.id_form_k_01_main WHERE (a.no_propinsi='".$no_propinsi."' $f_no_prov) AND (a.no_kabupaten='".$no_kabupaten."' $f_no_kabta)";
				
				$result_data_ruas_jalan = $db->execute($sql_data_ruas_jalan);
				$total_ruas = $result_data_ruas_jalan->numrows();
				
				$data_ruas_jalan = "<select id=\"no_ruas_results\" multiple size=\"10\" onclick=\"frmCreate.no_ruas.value=this.value; get_data_ruas($no_propinsi,$no_kabupaten,frmCreate.no_ruas.value);showRuas();\">";
				
				while(!$result_data_ruas_jalan ->EOF):
					$data_ruas_jalan .= "<option value=".$result_data_ruas_jalan->fields['no_ruas'].">".$result_data_ruas_jalan->fields['nama_pangkal_ruas']." - ".$result_data_ruas_jalan->fields['nama_ujung_ruas']."</option>";
					$result_data_ruas_jalan->MoveNext();
				endwhile; 	
				
				$data_ruas_jalan .="</select>&nbsp;&nbsp;<font color=\"red\">[Opsional -> Klik <b>2x</b> untuk memilih item]</font>";					
				
				($total_ruas>0) ? $data_input2 = " <img src=\"".$HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images')."\\icon\\table.gif\" border=\"0\" title=\"Tampilkan Data Ruas Jalan\" onclick=\"showRuas();\" class=\"imgLink\" align=\"absmiddle\">" : $data_input2=NULL;	
				$data_input1 = "<input type=\"text\" id=\"no_ruas\" name=\"no_ruas\" maxlength=\"25\" onKeyUp=\"get_data_ruas($no_propinsi,$no_kabupaten,this.value)\" value=\"\"> ".$data_input2;		
				$delimeter   = "-";
				$option_choice = $data_input1."^/&".$data_ruas_jalan."^/&".$total_ruas."^/&".$delimeter;	
				echo $option_choice;
		}
}
//----------Menampilkan Data Kecamatan---------------------------

if ($_GET[get_ruas] == 1)
{

			if($no_propinsi!='' AND $no_kabupaten!=''){						
					$tmp_data="<input type=\"text\" name=\"no_ruas\" maxlength=\"25\" onBlur=\"get_data_ruas($no_propinsi,$no_kabupaten,this.value)\" value=\"\">";		
					$delimeter   = "-";
					$option_choice = $tmp_data."^/&".$delimeter;	
					echo $option_choice;
			}
}

//----------- GET DATA RUAS JALAN -------------------------------

if ($_GET[get_data_ruas]==1) {
	/**** Tambahan utk filter no_provinsi, no_kabupaten
	*****/
	$f_no_prov	= $_SESSION['SESSION_NO_PROPINSI']!='0'?" AND b.no_propinsi='".$_SESSION['SESSION_NO_PROPINSI']."' ":"";
	$f_no_kabta	= $_SESSION['SESSION_NO_KABUPATEN']!='0'?" AND b.no_kabupaten='".$_SESSION['SESSION_NO_KABUPATEN']."' ":"";
			
	$no_propinsi 	= $_GET[no_propinsi];
	$no_kabupaten 	= $_GET[no_kabupaten];
	$no_ruas 		= $_GET[no_ruas];
	$txt_hidden_jns_jln = $_GET[txt_hidden_jns_jln];
	$jns_jln 		= $_GET[jns_jln];
	
	if($no_propinsi!='' AND $no_kabupaten!='' AND $no_ruas!=''){	
	/*** remark 26-07-2010
	$sql_ruas = "SELECT a.nama_pangkal_ruas,a.nama_ujung_ruas,a.titik_pengenal_pangkal,a.panjang_ruas,a.lhr_roda_4,a.jumlah_penduduk,a.panjang_ruas*1000 as panjang_m,
				a.kode_status_administrasi, b.id_jns_jln    
				FROM ".$tbl_name_k_01_detail." a LEFT JOIN ".$tbl_name_k_01_main." b ON a.id_form_k_01_main=b.id_k_01_main 
				WHERE b.no_propinsi='$no_propinsi' and b.no_kabupaten='$no_kabupaten' and a.no_ruas='$no_ruas'";
	***/
	$sql_ruas = "SELECT a.nama_pangkal_ruas,a.nama_ujung_ruas,a.titik_pengenal_pangkal,a.panjang_ruas,a.lhr_roda_4,a.jumlah_penduduk,a.panjang_ruas*1000 as panjang_m,
				a.kode_status_administrasi, b.id_jns_jln    
				FROM ".$tbl_name_k_01_detail." a LEFT JOIN ".$tbl_name_k_01_main." b ON a.id_form_k_01_main=b.id_k_01_main 
				WHERE (b.no_propinsi='".$no_propinsi."' $f_no_prov) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabta) AND a.no_ruas='$no_ruas' ";
	//print $sql_ruas;
	
	$result_ruas = $db->execute($sql_ruas);

	$tmp_nama_ruas = "<input name=\"nama_ruas\" type=\"text\" value=\"".$result_ruas->fields[nama_pangkal_ruas]." - ".$result_ruas->fields[nama_ujung_ruas]."\" size=\"35\" maxlength=\"200\" readonly>";
	//Tambahan 17-06-2010 -->
	$jenis_jalan	= $result_ruas->fields[id_jns_jln]==1? "Provinsi":"Kabupaten/ Kota";
	$tmp_hidden_jsn_jln = "<input name=\"txt_hidden_jns_jln\" type=\"hidden\" value=\"".$result_ruas->fields[id_jns_jln]."\" >";
	$tmp_jsn_jln = "<input name=\"txt_jns_jln\" type=\"text\" value=\"".$jenis_jalan."\" size=\"35\" maxlength=\"200\" readonly>";
	//End 0f Tambahan 17-06-2010 -->	
	$tmp_panjang_ruas = "<input type=\"text\" id=\"panjang_km\" name=\"panjang_km\" value=\"".$result_ruas->fields[panjang_ruas]."\"  OnChange=\"CountPanjangM(this.value)\"  OnKeyUp=\"validateNum(this)\">";	
	$tmp_panjang_ruas2 = "<input type=\"text\" id=\"panjang_m\" name=\"panjang_m\" value=\"".round($result_ruas->fields[panjang_m])."\"  OnKeyUp=\"validateNum(this)\">";
	$tmp_lhr = "<input type=\"text\" name=\"lhr_rata_rata\" value=\"".$result_ruas->fields[lhr_roda_4]."\" OnKeyUp=\"validateNum(this)\">";
	$tmp_jumlah_penduduk = "<input type=\"text\" name=\"jumlah_penduduk\" value=\"".$result_ruas->fields[jumlah_penduduk]."\" OnKeyUp=\"validateNum(this)\">";
	($result_ruas->fields[kode_status_administrasi]=="N") ? $checked1=" checked=\"checked\"" : $checked1 = NULL;
	($result_ruas->fields[kode_status_administrasi]=="P") ? $checked2=" checked=\"checked\"" : $checked2 = NULL;
	($result_ruas->fields[kode_status_administrasi]=="K") ? $checked3=" checked=\"checked\"" : $checked3 = NULL;
	$tmp_akses_jalan = "<input type=\"radio\" name=\"akses_jalan\" ".$checked1." value=\"N\" class=\"radio\" />Nasional<br>";
	$tmp_akses_jalan .= "<input type=\"radio\" name=\"akses_jalan\" ".$checked2."value=\"P\" class=\"radio\" />Provinsi<br>";
	$tmp_akses_jalan .= "<input type=\"radio\" name=\"akses_jalan\" ".$checked3."value=\"K\" class=\"radio\" />Kabupaten/Kota";
	$delimeter   = "-";
	$option_choice = $tmp_nama_ruas."^/&".$tmp_jsn_jln."^/&".$tmp_panjang_ruas."^/&".$tmp_lhr."^/&".$tmp_jumlah_penduduk."^/&".$tmp_panjang_ruas2."^/&".$tmp_akses_jalan."^/&".$tmp_hidden_jsn_jln."^/&".$delimeter;	
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
		
if($no_propinsi!='' AND $no_kabupaten!=''){	
	/**** Tambahan utk filter no_provinsi, no_kabupaten
	*****/
	$f_no_prov	= $_SESSION['SESSION_NO_PROPINSI']!='0'?" AND a.no_propinsi='".$_SESSION['SESSION_NO_PROPINSI']."' ":"";
	$f_no_kabta	= $_SESSION['SESSION_NO_KABUPATEN']!='0'?" AND a.no_kabupaten='".$_SESSION['SESSION_NO_KABUPATEN']."' ":"";

	/*** 07-08-2010 ***/
	$f_id_jns_jln	= $_SESSION['SESSION_JNS_JLN']!='0'?" AND a.id_jns_jln='".$_SESSION['SESSION_JNS_JLN']."' ":"";
		
	/*** remark 27-07-2010
	$sql_data_ruas_jalan = "SELECT b.no_ruas,b.nama_pangkal_ruas,b.nama_ujung_ruas FROM tbl_form_k_01_main a LEFT JOIN tbl_form_k_01_detail b ON 					
	a.id_k_01_main=b.id_form_k_01_main WHERE a.no_propinsi='".$no_propinsi."' AND a.no_kabupaten='".$no_kabupaten."' ";
	***/
	$sql_data_ruas_jalan = "SELECT b.no_ruas,b.nama_pangkal_ruas,b.nama_ujung_ruas FROM tbl_form_k_01_main a LEFT JOIN tbl_form_k_01_detail b ON 					
	a.id_k_01_main=b.id_form_k_01_main WHERE (a.no_propinsi='".$no_propinsi."'$f_no_prov) AND (a.no_kabupaten='".$no_kabupaten."' $f_no_kabta) $f_id_jns_jln ";
	
	$result_data_ruas_jalan = $db->execute($sql_data_ruas_jalan);
	$total_ruas = $result_data_ruas_jalan->numrows();
	
	$initSet = array();
	$data_ruas_jalan = array();
	$z=0;
	
	while ($arr=$result_data_ruas_jalan->FetchRow()) {
		array_push($data_ruas_jalan, $arr);
		array_push($initSet, $z);
		$z++;
	}
	$smarty->assign ("DATA_RUAS_JALAN", $data_ruas_jalan);	
	$smarty->assign ("TOTAL_RUAS_JALAN", $total_ruas);				
		
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
				$tahun			= ($Search_Year=="" || $Search_Year==0)?" AND YEAR(b.tanggal)='".$SES_THN."' ":" AND YEAR(b.tanggal)='".$Search_Year."' ";
								
				$sql_data_wilayah = "SELECT get_nama_propinsi(no_propinsi) as nama_propinsi,get_nama_kabupaten(no_propinsi,no_kabupaten) as nama_kabupaten FROM ".$tbl_name_kabupaten." WHERE no_propinsi='".$no_propinsi."' AND no_kabupaten='".$no_kabupaten."' ";
				$recordSet_wilayah = $db->execute($sql_data_wilayah);
				$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];
				$nama_kabupaten = $recordSet_wilayah->fields[nama_kabupaten];
				
				$sql = "SELECT b.id_fjl_02_main,b.id_jns_jln,a.id_fjl_02_detail,a.no_ruas,a.nama_ruas,a.panjang_km,a.panjang_m 
				FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_02_main=b.id_fjl_02_main 
				WHERE 1=1 ";
				
				/***
				if($no_propinsi!='' AND $no_kabupaten!='' AND $Search_Year!='' AND $jns_jln!=''){
					$sql .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' AND YEAR(b.tanggal)='".$Search_Year."' AND b.id_jns_jln='".$jns_jln."' ";
				}
				***/
				
				if($no_propinsi!='' AND $no_kabupaten!='' AND $jns_jln==''){
					$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) $tahun $f_id_jns_jln ";
				} else if ($no_propinsi!='' AND $no_kabupaten!='' AND $Search_Year!=''  AND $jns_jln!=''){
					$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) AND (b.id_jns_jln='".$jns_jln."' $f_id_jns_jln) $tahun ";
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
				$data_panjang_km = array();
				$data_panjang_m = array();				
				$row_class = array();
				$z=0;

				while ($arr=$recordSet->FetchRow()) {
					$panjang_km = number_format($arr[panjang_km],2,',','.');
					$panjang_m =  number_format($arr[panjang_m],2,',','.');
									
					array_push($data_tb, $arr);
					array_push($data_panjang_km, $panjang_km);
					array_push($data_panjang_m, $panjang_m);
										
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

$smarty->assign('AKSES_JALANARR', array(
			'N' => 'Nasional',
			'P' => 'Provinsi',
			'K' => 'Kabupaten/Kota'));
			
$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_FORM_JL_02);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_FORM_JL_02);
$smarty->assign ("FORM_NAME", _FORM);

// TAMBAHAN
$smarty->assign ("FORM_NAME2", _FORM_NAME_IMPORT);

$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("SEARCH_YEAR", $Search_Year);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NO_KABUPATEN", $no_kabupaten);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten);
$smarty->assign ("SEARCH_YEAR", $Search_Year);
$smarty->assign ("TITLE", _TITLE_FORM_JL_02_MAIN);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_FORM_JL_02_MAIN);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("TB_NO_RUAS", _NO_RUAS);
$smarty->assign ("TB_NAMA_RUAS", _NAMA_RUAS);
$smarty->assign ("TB_PANJANG", _PANJANG_RUAS);
$smarty->assign ("TB_PANJANG_KM", _PANJANG_KM);
$smarty->assign ("TB_PANJANG_M", _PANJANG_M);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_FORM_JL_02_MAIN);
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
/*** Tambahan 17-06-2010 ***/
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
$smarty->assign ("DATA_PANJANG_KM",$data_panjang_km);
$smarty->assign ("DATA_PANJANG_M",$data_panjang_m);

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