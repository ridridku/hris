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
$db->debug = true;
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_master/perwakilan/bhi';

#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_master');
$FILE_JS  = $JS_MODUL.'/perwakilan/bhi';

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
$tbl_name	= "tbl_bhi";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//


if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER=" nama_perusahaan asc ";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";
 
if ($_GET['kode_bhi']) $kode_bhi_cari = $_GET['kode_bhi'];
else if ($_POST['kode_bhi']) $kode_bhi_cari = $_POST['kode_bhi'];
else $kode_bhi="";

if ($_GET['nama_perusahaan_cari']) $nama_perusahaan_cari = $_GET['nama_perusahaan_cari'];
else if ($_POST['nama_perusahaan_cari']) $nama_perusahaan_cari = $_POST['nama_perusahaan_cari'];
else $nama_perusahaan_cari="";

if ($_GET['jenis_badan_hukum_cari']) $jenis_badan_hukum_cari = $_GET['jenis_badan_hukum_cari'];
else if ($_POST['jenis_badan_hukum_cari']) $jenis_badan_hukum_cari = $_POST['jenis_badan_hukum_cari'];
else $jenis_badan_hukum_cari="";

 
$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_bhi_cari=".$kode_bhi_cari."&nama_perusahaan_cari=".$nama_perusahaan_cari."&jenis_badan_hukum_cari=".$jenis_badan_hukum_cari;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;


//echo "<br><br><br><br><br><br><br><br><br><br>kode_perwakilan_cari".$kode_perwakilan_cari;
//SHOW DATA PROVINSI
//-------------------------------------
$sql_propinsi = "SELECT id_propinsi,no_propinsi,nama_propinsi FROM tbl_mast_wil_propinsi ";
$result_propinsi = $db->Execute($sql_propinsi);
$initSet = array();
$data_propinsi = array();
$z=0;
while ($arr=$result_propinsi->FetchRow()) {
	array_push($data_propinsi, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PROPINSI", $data_propinsi);

 



if ($_GET[get_prop] == 1)
{
	$no_propinsi = $_GET[no_prop];
			if($no_propinsi!=''){	
					$sql_kabupaten = "SELECT id_kabupaten,no_kabupaten,nama_kabupaten FROM tbl_mast_wil_kabupaten WHERE no_propinsi='".$no_propinsi."' ORDER BY id_kabupaten ASC";
					$recordSet_kabupaten = $db->Execute($sql_kabupaten);
					//print $sql_kabupaten;
					$input_kab="<select name=id_kab  >";
					$input_kab.="<option value=[Pilih Kabupaten]> ";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF): 
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields['id_kabupaten'].">".$recordSet_kabupaten->fields['nama_kabupaten'];   
						$input_kab.="</option>";
					$recordSet_kabupaten->MoveNext();
					endwhile; 
					$input_kab.="</select> ";
					//
					$delimeter   = "-";
					$option_choice = $input_kab."^/&".$delimeter;	
					echo $option_choice;
			}
}

if ($_GET[get_kec] == 1)
{
	$no_propinsi = $_GET[no_prop];
	$no_kabupaten = $_GET[no_kab];
	//$kecamatan_id = $_GET[kecamatan_id];
	//print $no_kabupaten;

			if($no_propinsi!=''){	
					$sql_kecamatan = "SELECT id_kecamatan,no_kecamatan,nama_kecamatan FROM tbl_mast_wil_kecamatan WHERE no_kabupaten='".$no_kabupaten."' AND no_propinsi='".$no_propinsi."' ORDER BY id_kecamatan ASC";
					$recordSet_kecamatan = $db->Execute($sql_kecamatan); 
					//print $sql_kecamatan;
					$input_kec="<select name=no_kecamatan onchange=\"cari_kec2($no_propinsi,$no_kabupaten,this.value)\">";
					$input_kec.="<option value=[Pilih Kecamatan]> ";
					$input_kec.="</option> ";
					while(!$recordSet_kecamatan->EOF): 
						$input_kec.="<option value=";
						$input_kec.= $recordSet_kecamatan->fields['no_kecamatan'].">".$recordSet_kecamatan->fields['nama_kecamatan'];   
						$input_kec.="</option>";
					$recordSet_kecamatan->MoveNext();
					endwhile; 
					$input_kec.="</select> ";
					//
					$delimeter   = "-";
					$option_choice = $input_kec."^/&".$delimeter;	
					echo $option_choice;
			}
}

 
				
				
$opt = $_GET[opt];

$ed = 0;
if($opt=="1"){

	$sql_ = "select *  from tbl_bhi
	where  kode_bhi ='".$_GET['kode_bhi']."'  ";
 
	//print $sql_;
	$resultSet = $db->Execute($sql_);
	$edit_kode_bhi = $resultSet->fields[kode_bhi];
	$edit_nama_perusahaan= $resultSet->fields[nama_perusahaan];
	$edit_alamat_bhi= $resultSet->fields[alamat_bhi];
	$edit_pemilik= $resultSet->fields[pemilik];
	$edit_telpn= $resultSet->fields[telpn];
	$edit_tahun_berdiri = $resultSet->fields[tahun_berdiri];
	$edit_jum_karjaya = $resultSet->fields[jum_karjaya];
    $edit_jenis_badan_hukum = $resultSet->fields[jenis_badan_hukum];
	 
	$edit = 1;
 
	
}	 
//print $sql_.$edit_prov_id;

$smarty->assign ("OPT", $opt);

$smarty->assign ("EDIT_KODE_BHI", $edit_kode_bhi);
$smarty->assign ("EDIT_NAMA_PERUSAHAAN", $edit_nama_perusahaan);
$smarty->assign ("EDIT_ALAMAT_BHI", $edit_alamat_bhi);
$smarty->assign ("EDIT_PEMILIK", $edit_pemilik);
$smarty->assign ("EDIT_TELPN", $edit_telpn);
$smarty->assign ("EDIT_TAHUN_BERDIRI", $edit_tahun_berdiri);
 $smarty->assign ("EDIT_JUM_KARJAYA", $edit_jum_karjaya);
 $smarty->assign ("EDIT_JENIS_BADAN_HUKUM", $edit_jenis_badan_hukum);
 
 $smarty->assign ("EDIT_VAL", $edit);


//$tahun = now();
if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
 
				$sql  = "select * from tbl_bhi where 1=1  ";
  
			    if($kode_bhi_cari!=''){
					$sql .= "AND kode_bhi  like '%".$kode_bhi_cari."%' ";
				}

				 if($nama_perusahaan_cari!=''){
					$sql .= "AND nama_perusahaan = '".$nama_perusahaan_cari."' ";
				}

				if($jenis_badan_hukum_cari!=''){
					$sql .= "AND jenis_badan_hukum LIKE '%".$jenis_badan_hukum_cari."%' ";
				} 
 
				 $sql .= " ORDER BY  kode_bhi ";

			    if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
				$numresults=$db->Execute($sql);
				$count = $numresults->RecordCount();

				$pages = $p->findPages($count,$LIMIT); 
				$sql  .= "LIMIT ".$start.", ".$LIMIT;
				$recordSet = $db->Execute($sql);
				//print $sql;
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

				$sql  = "select * from tbl_bhi where 1=1  ";
  
			    if($kode_bhi_cari!=''){
					$sql .= "AND kode_bhi  like '%".$kode_bhi_cari."%' ";
				}

				 if($nama_perusahaan_cari!=''){
					$sql .= "AND nama_perusahaan = '".$nama_perusahaan_cari."' ";
				}

				if($jenis_badan_hukum_cari!=''){
					$sql .= "AND jenis_badan_hukum LIKE '%".$jenis_badan_hukum_cari."%' ";
				} 
 
				 $sql .= " ORDER BY  kode_bhi ";
 
				if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
				$numresults=$db->Execute($sql);
				$count = $numresults->RecordCount();

				$pages = $p->findPages($count,$LIMIT); 
				$sql  .= "LIMIT ".$start.", ".$LIMIT;
				//print $sql;
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

$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_KELURAHAN);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_KELURAHAN);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("TITLE", _TITLE_KEL);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_KEL);
$smarty->assign ("TB_CODE", _ID_KELURAHAN);
$smarty->assign ("TB_CODE_2", _ID_KELURAHAN);
$smarty->assign ("TB_NAMA_PROPINSI",_NAMA_PROPINSI);
$smarty->assign ("TB_NAMA_KABUPATEN",_NAMA_KABUPATEN);
$smarty->assign ("TB_NAMA_KECAMATAN",_NAMA_KECAMATAN);
$smarty->assign ("TB_NAMA_KELURAHAN",_NAMA_KELURAHAN);
$smarty->assign ("TB_NO_KELURAHAN",_NO_KELURAHAN);
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