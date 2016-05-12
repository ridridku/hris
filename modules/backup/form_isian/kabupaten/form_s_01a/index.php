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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_s_01a';

#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_s_01a';

if($_POST['mod_id']){
		$mod_id = $_POST['mod_id'];
}else{
		$mod_id = $_GET['mod_id'];
}

$user_id = base64_decode($_SESSION['UID']);

$smarty->assign ("MOD_ID", $mod_id);

$smarty->assign ("ID_PROPINSI",$MAIN_PROP);

#Initiate TABLE

$tbl_name_main = "tbl_form_s_01_main";
$tbl_name_detail = "tbl_form_s_01_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
$tbl_name_kecamatan = "tbl_mast_wil_kecamatan";
$tbl_name_k_01_main = "tbl_form_k_01_main";
$tbl_name_k_01_detail = "tbl_form_k_01_detail";
/*** Tambahan 17-06-2010 ***/
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
else $ORDER="b.no_ruas";

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

$arr_tgl = explode("-",$_GET[tanggal]);

(!empty($_GET[Search_Year])) ? $Search_Year = $_GET[Search_Year]: $Search_Year = $arr_tgl[0];

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year."&tanggal=".$_GET[tanggal]."&jns_jln=".$jns_jln;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year."&tanggal=".$_GET[tanggal]."&jns_jln=".$jns_jln;

$SES_THN		= $_SESSION['SESSION_TAHUN'];
$SES_JNS_JLN	= $_SESSION['SESSION_JNS_JLN'];
$SES_NO_PROP	= $_SESSION['SESSION_NO_PROPINSI'];
$SES_NO_KAB		= $_SESSION['SESSION_NO_KABUPATEN'];

//----------EDIT DATA FORM JL-01-----------------------------------

$opt = $_GET[opt];
$id_form_s_01_main = $_GET[id_fs_01_main];
$ed = 0;

if ($opt=="1" AND $id_form_s_01_main<>'') {

/*** Tambahan 17-06-2010 ***/
$id_jns_jln = $fields_find_jns_jln_;
/*** End 0f Tambahan 05-06-2010 ***/

/***
id_jns_jln='".$id_jns_jln."'

$tbl_name_main = tbl_form_s_01_main
***/

$sql = " SELECT z.*,
(SELECT a.pal_km_awal FROM tbl_form_k_01_detail a LEFT JOIN tbl_form_k_01_main b ON a.id_form_k_01_main=b.id_k_01_main WHERE b.no_propinsi=z.no_propinsi AND b.no_kabupaten=z.no_kabupaten AND a.no_ruas=z.no_ruas) as awal_ruas, 
(SELECT a.pal_km_akhir FROM tbl_form_k_01_detail a LEFT JOIN tbl_form_k_01_main b ON a.id_form_k_01_main=b.id_k_01_main WHERE b.no_propinsi=z.no_propinsi AND b.no_kabupaten=z.no_kabupaten AND a.no_ruas=z.no_ruas) as akhir_ruas 
 FROM ".$tbl_name_main." z  
		WHERE 1=1 AND z.id_fs_01_main='".$id_form_s_01_main."' AND z.id_jns_jln='".$id_jns_jln."' ";
$recordSet_Edit = $db->execute($sql);

$edit = 1;
$i = 0;
/*** Disabled on 14-09-2010
$sql_detail	 = " SELECT * FROM ".$tbl_name_detail." WHERE id_fs_01_main='".$id_form_s_01_main."' ORDER BY id_fs_01_detail ASC ";
***/
$sql_detail	 = "SELECT penilaian,if(penilaian<".$_CONF['PR'].",penilaian,'-') as pr,if(penilaian>=".$_CONF['PR']." AND penilaian <=".$_CONF['PM'].",penilaian,'-') as pm,if(penilaian>".$_CONF['PK'].",penilaian,'-') as pk,
if(penilaian<".$_CONF['PR'].",'PR',if(penilaian>=".$_CONF['PR']." AND penilaian<=".$_CONF['PM'].",'PM', if(penilaian>".$_CONF['PK'].",'PK','-'))) as keterangan FROM ".$tbl_name_detail." WHERE id_fs_01_main='".$id_form_s_01_main."' ORDER BY id_fs_01_detail ASC";
$result_detail = $db->Execute($sql_detail);
$jum_detail=$result_detail->RecordCount();
$data_detail= array();
while ($arr=$result_detail->FetchRow()) {
	array_push($data_detail, $arr);
}
$smarty->assign ("DATA_DETAIL", $data_detail);

//------------------------------------

$smarty->assign ("OPT", $opt);					
$smarty->assign ("ID_S_01_MAIN", $recordSet_Edit->fields[id_fs_01_main]);
$smarty->assign ("TANGGAL", $recordSet_Edit->fields[tanggal]);
$smarty->assign ("NO_RUAS", $recordSet_Edit->fields[no_ruas]);
$smarty->assign ("NAMA_PANGKAL_RUAS", $recordSet_Edit->fields[nama_ruas_pangkal]);
$smarty->assign ("NAMA_UJUNG_RUAS", $recordSet_Edit->fields[nama_ruas_ujung]);
$smarty->assign ("PAL_KM_AWAL", $recordSet_Edit->fields[awal_ruas]);
$smarty->assign ("PAL_KM_AKHIR", $recordSet_Edit->fields[akhir_ruas]);
$smarty->assign ("DISURVAI", $recordSet_Edit->fields[disurvai]);
$smarty->assign ("TIPE_KENDARAAN", $recordSet_Edit->fields[tipe_kendaraan]);
$smarty->assign ("FAKT_PENYESUAIAN_ODOMETER", $recordSet_Edit->fields[fakt_penyesuaian_odometer]);
$smarty->assign ("KM_ODOMETER", $recordSet_Edit->fields[km_odometer]);
$smarty->assign ("KM_YSD", $recordSet_Edit->fields[km_ysd]);

$smarty->assign ("JUM", $jum_detail);
$smarty->assign ("EDIT_VAL", $edit);
$smarty->assign ("I", $i);

/*** Tambahan 17-06-2010 ***/
$smarty->assign("ID_HIDDEN_JSN_JLN", $recordSet_Edit->fields[id_jns_jln]);

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
					$sql_kab_combo 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$no_propinsi' ORDER BY nama_kabupaten ASC";
					$result_kab_combo  = $db->Execute($sql_kab_combo);
					$input_kab="<select name=no_kabupaten onChange=\"get_tanggal(document.frmList1.no_propinsi.value,this.value,document.frmList1.jns_jln.value)\">";
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

if ($_GET[get_tanggal] == 1)
{
	$no_propinsi = $_GET[no_propinsi];
	$no_kabupaten = $_GET[no_kabupaten];
	$tanggal	= $_GET[tanggal];
	$jns_jln	= $_GET[jns_jln];
	
			if($no_propinsi!='') {
					$sql_tgl_combo 	  = " SELECT tanggal FROM tbl_form_s_01_main WHERE no_propinsi='$no_propinsi' AND no_kabupaten='$no_kabupaten' AND id_jns_jln='".$jns_jln."' ORDER BY tanggal DESC ";
					$result_tgl_combo  = $db->Execute($sql_tgl_combo);
					$tgl_combo = explode("-",$result_tgl_combo->fields[tanggal],strlen($result_tgl_combo->fields[tanggal])); // YYYY-mm-dd
					$tanggal_combo = $tgl_combo[2]."-".$tgl_combo[1]."-".$tgl_combo[0];						
					
					$input_tgl="<select name=tanggal onChange=\"get_no_ruas(document.frmList1.no_propinsi.value,document.frmList1.no_kabupaten.value,this.value, $jns_jln)\">";
					$input_tgl.="<option>[Pilih Tanggal]";
					$input_tgl.="</option> ";
					while(!$result_tgl_combo ->EOF): 						
						($result_tgl_combo  ->fields['tanggal']==$tanggal) ? $selected=" selected ":$selected=NULL;
						$input_tgl.="<option value=";
						$input_tgl.= $result_tgl_combo  ->fields['tanggal']."".$selected.">".$tanggal_combo;   
						$input_tgl.="</option>";
					$result_tgl_combo->MoveNext();
					endwhile; 
					$input_tgl.="</select> ";
					//
					$delimeter   = "-";
					$option_choice = $input_tgl."^/&".$delimeter;	
					echo $option_choice;
			}
}


if ($_GET[get_no_ruas] == 1)
{
	$no_propinsi = $_GET[no_propinsi];
	$no_kabupaten = $_GET[no_kabupaten];
	$tanggal = $_GET[tanggal];
	$jns_jln	= $_GET[jns_jln];
	
			if($no_propinsi!=''){	
					$sql_ruas_combo 	  = "SELECT no_ruas FROM tbl_form_s_01_main WHERE no_propinsi='$no_propinsi' AND no_kabupaten='$no_kabupaten' AND tanggal='$tanggal' AND id_jns_jln='$jns_jln' ORDER BY no_ruas ASC";
					$result_ruas_combo  = $db->Execute($sql_ruas_combo);
					$input_ruas="<select name=no_ruas_search>";
					$input_ruas.="<option>[Pilih No Ruas]";
					$input_ruas.="</option> ";
					while(!$result_ruas_combo ->EOF): 						
						($result_ruas_combo  ->fields['no_ruas']==$no_ruas) ? $selected=" selected":$selected=NULL;
						$input_ruas.="<option value=";
						$input_ruas.= $result_ruas_combo  ->fields['no_ruas']."".$selected.">".$result_ruas_combo ->fields['no_ruas'];   
						$input_ruas.="</option>";
					$result_ruas_combo->MoveNext();
					endwhile; 
					$input_ruas.="</select> ";
					//
					$delimeter   = "-";
					$option_choice = $input_ruas."^/&".$delimeter;	
					echo $option_choice;
			}
}


//----------- GET DATA RUAS JALAN -------------------------------

if ($_GET[get_data_ruas]==1) {
	
	$no_propinsi = $_GET[no_propinsi];
	$no_kabupaten = $_GET[no_kabupaten];
	$no_ruas = $_GET[no_ruas];
	
	if($no_propinsi!='' AND $no_kabupaten!='' AND $no_ruas!=''){	
	
	/*
	$sql_ruas = "SELECT a.nama_pangkal_ruas,a.nama_ujung_ruas,a.titik_pengenal_pangkal,a.titik_pengenal_ujung 
				FROM ".$tbl_name_k_01_detail." a LEFT JOIN ".$tbl_name_k_01_main." b ON a.id_form_k_01_main=b.id_k_01_main 
				WHERE b.no_propinsi='$no_propinsi' and b.no_kabupaten='$no_kabupaten' and a.no_ruas='$no_ruas'";
	*/
	$sql_ruas = "SELECT z.*,
	(SELECT a.pal_km_awal FROM tbl_form_k_01_detail a LEFT JOIN tbl_form_k_01_main b ON a.id_form_k_01_main=b.id_k_01_main WHERE b.no_propinsi=z.no_propinsi AND b.no_kabupaten=z.no_kabupaten AND a.no_ruas=z.no_ruas) as awal_ruas, 
	(SELECT a.pal_km_akhir FROM tbl_form_k_01_detail a LEFT JOIN tbl_form_k_01_main b ON a.id_form_k_01_main=b.id_k_01_main WHERE b.no_propinsi=z.no_propinsi AND b.no_kabupaten=z.no_kabupaten AND a.no_ruas=z.no_ruas) as akhir_ruas 
	FROM ".$tbl_name_main." z  
	WHERE 1=1 AND z.no_propinsi='$no_propinsi' and z.no_kabupaten='$no_kabupaten' and z.no_ruas='$no_ruas'";
		
	$result_ruas = $db->execute($sql_ruas);
	
	$_id_main = $result_ruas->fields[id_fs_01_main];
	
	$tmp_nama_pangkal_ruas = "<input name=\"nama_pangkal_ruas\" type=\"text\" value=\"".$result_ruas->fields[nama_ruas_pangkal]."\" size=\"35\" maxlength=\"200\" readonly>";
	
	//Tambahan 17-06-2010 -->
	$jenis_jalan	= $result_ruas->fields[id_jns_jln]==1? "Provinsi":"Kabupaten/ Kota";
	
	$tmp_hidden_jsn_jln = "<input name=\"txt_hidden_jns_jln\" type=\"hidden\" value=\"".$result_ruas->fields[id_jns_jln]."\" >";
	
	$tmp_jsn_jln = "<input name=\"txt_jns_jln\" type=\"text\" value=\"".$jenis_jalan."\" size=\"35\" maxlength=\"200\" readonly>";
	//End 0f Tambahan 17-06-2010 -->
		
	$tmp_nama_ujung_ruas = "<input name=\"nama_ujung_ruas\" type=\"text\" value=\"".$result_ruas->fields[nama_ruas_ujung]."\" size=\"35\" maxlength=\"200\" readonly>";
	$tmp_titik_pangkal = "<input name=\"awal_km\" type=\"text\" value=\"".$result_ruas->fields[awal_ruas]."\" size=\"35\" maxlength=\"200\" readonly>";
	$tmp_titik_ujung = "<input name=\"akhir_km\" type=\"text\" value=\"".$result_ruas->fields[akhir_ruas]."\" size=\"35\" maxlength=\"200\" readonly>";
	
					
	//$_sql_detail	 = "SELECT * FROM ".$tbl_name_detail." WHERE id_fs_01_main='".$_id_main."' ORDER BY id_fs_01_detail ASC";
	$_sql_detail	 = "SELECT penilaian,if(penilaian<".$_CONF['PR'].",penilaian,'-') as pr,if(penilaian>=".$_CONF['PR']." AND penilaian <=".$_CONF['PM'].",penilaian,'-') as pm,if(penilaian>".$_CONF['PK'].",penilaian,'-') as pk,
				if(penilaian<".$_CONF['PR'].",'PR',if(penilaian>=".$_CONF['PR']." AND penilaian<=".$_CONF['PM'].",'PM', if(penilaian>".$_CONF['PK'].",'PK','-'))) as keterangan FROM ".$tbl_name_detail." WHERE id_fs_01_main='".$_id_main."' ORDER BY id_fs_01_detail ASC";

	$_result_detail = $db->Execute($_sql_detail);
	$_jum_detail=$_result_detail->RecordCount();
	$z=1;
	$input_detail = "<table id=\"tblItem\" width=\"750\" cellspacing=1 cellpadding=1>";
	while(!$_result_detail ->EOF): 						
		
		$input_detail.="<tr>";
		$input_detail.="<td width=\"45\" class=\"tdatacontent\">".$z."</td>";
		$input_detail.="<td width=\"290\" class=\"tdatacontent\">".$z."</td>";
		$input_detail.="<td width=\"110\" class=\"tdatacontent\">".$_result_detail->fields[penilaian]."</td>";
		$input_detail.="<td width=\"100\" class=\"tdatacontent\"></td>";
		$input_detail.="<td width=\"100\" class=\"tdatacontent\"></td>";
		$input_detail.="<td width=\"100\" class=\"tdatacontent\"></td>";
		$input_detail.="<td width=\"200\" class=\"tdatacontent\"></td>";
		$input_detail.="</tr>";
	$_result_detail->MoveNext();
	$z++;
	endwhile; 
	$input_detail .= "</table>";
	
	$delimeter   = "-";
	/***
	$option_choice = $tmp_nama_pangkal_ruas."^/&".$tmp_nama_ujung_ruas."^/&".$tmp_titik_pangkal."^/&".$tmp_titik_ujung."^/&".$input_detail."^/&".$delimeter;	
	***/
	$option_choice = $tmp_jsn_jln."^/&".$tmp_nama_pangkal_ruas."^/&".$tmp_nama_ujung_ruas."^/&".$tmp_titik_pangkal."^/&".$tmp_titik_ujung."^/&".$input_detail."^/&".$tmp_hidden_jsn_jln."^/&".$delimeter;
	echo $option_choice;
	}
}
//---------------------------------------------------------------

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
				
				$sql = "SELECT * 
				FROM ".$tbl_name_main." b 
				WHERE 1=1 ";
				
				/***
				if($no_propinsi!='' AND $no_kabupaten!='' AND $jns_jln!='' ){
					$sql .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' AND id_jns_jln='".$jns_jln."' ";
				}
				***/

				if($no_propinsi!='' AND $no_kabupaten!='' AND $jns_jln==''){
					$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) $f_id_jns_jln $tahun ";
				} else if ($no_propinsi!='' AND $no_kabupaten!='' AND $jns_jln!=''){
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


$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_FORM_S_01A);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_FORM_S_01A);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("SEARCH_YEAR", $Search_Year);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NO_KABUPATEN", $no_kabupaten);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten);
$smarty->assign ("TITLE", _TITLE_FORM_S_01A_MAIN);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_FORM_S_01A_MAIN);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("TB_NO_RUAS", _NO_RUAS);
$smarty->assign ("TB_NAMA_RUAS", _NAMA_RUAS);
$smarty->assign ("TB_TITIK_PENGENAL_PANGKAL", _TITIK_PENGENAL_PANGKAL);
$smarty->assign ("TB_TITIK_PENGENAL_UJUNG", _TITIK_PENGENAL_UJUNG);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_FORM_S_01A_MAIN);
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

$smarty->assign ("TANGGAL", $tanggal);
/*** End 0f 17-06-2010 ***/

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