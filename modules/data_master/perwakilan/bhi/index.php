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
$tahun = date(Y);
$smarty->assign ("TAHUN", $tahun);
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
else $ORDER=" kode_bhi asc ";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";
 
if ($_GET['kode_bhi']) $kode_bhi_cari = $_GET['kode_bhi'];
else if ($_POST['kode_bhi']) $kode_bhi_cari = $_POST['kode_bhi'];
else $kode_bhi="";


if ($_GET['jenis_bh']) $jenis_bh_cari = $_GET['jenis_bh'];
else if ($_POST['jenis_bh']) $jenis_bh_cari = $_POST['jenis_bh'];
else $jenis_bh_cari="";

if ($_GET['kode_perwakilan_cari']) $kode_perwakilan_cari = $_GET['kode_perwakilan_cari'];
else if ($_POST['kode_perwakilan_cari']) $kode_perwakilan_cari = $_POST['kode_perwakilan_cari'];
else $kode_perwakilan_cari="";

if ($_GET['kode_kat_usaha']) $kode_kat_usaha = $_GET['kode_kat_usaha'];
else if ($_POST['kode_kat_usaha']) $kode_kat_usaha = $_POST['kode_kat_usaha'];
else $kode_kat_usaha="";

$smarty->assign ("KODE_PERWAKILAN_CARI", $kode_perwakilan_cari);
$smarty->assign ("KODE_BHI_CARI", $kode_bhi_cari);
 
$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_bhi=".$kode_bhi_cari."&pemilik=".$pemilik_cari."&jenis_bh=".$jenis_bh_cari."&kode_kat_usaha=".$kode_kat_usaha;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;


//echo "<br><br><br><br><br><br><br><br><br><br>kode_perwakilan_cari".$kode_perwakilan_cari;
// SHOW DATA NEGARA ========================
$sql_perwakilan_show = "SELECT  *  FROM tbl_mast_perwakilan ";
$result_perwakilan_show = $db->Execute($sql_perwakilan_show);
$initSet = array();
$data_perwakilan_show = array();
$z=0;
while ($arr=$result_perwakilan_show->FetchRow()) {
	array_push($data_perwakilan_show, $arr);
	array_push($initSet, $z);
	$z++;
}

$smarty->assign ("DATA_PERWAKILAN_SHOW", $data_perwakilan_show);


// SHOW DATA KATEGORI USAHA ========================
$sql_kat_usaha = "SELECT  *  FROM tbl_mast_kat_usaha";
$result_kat_usaha = $db->Execute($sql_kat_usaha);
$initSet = array();
$data_kat_usaha = array();
$z=0;
while ($arr=$result_kat_usaha->FetchRow()) {
	array_push($data_kat_usaha, $arr);
	array_push($initSet, $z);
	$z++;
}

$smarty->assign ("DATA_KAT_USAHA", $data_kat_usaha);

//=================================================
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
	$edit_kode_perwakilan= $resultSet->fields[kode_perwakilan];
	$edit_bhi= $resultSet->fields[bhi];
	$edit_tgl_input= $resultSet->fields[tgl_input];
	$edit_alamat_ln= $resultSet->fields[alamat_ln];
	$edit_pemilik = $resultSet->fields[pemilik];
	$edit_no_tlp = $resultSet->fields[no_tlp];
    $edit_thn_pendirian = $resultSet->fields[thn_pendirian];
    $edit_jml_karjaya = $resultSet->fields[jml_karjaya];
    $edit_jenis_bh = $resultSet->fields[jenis_bh];
	$edit_kode_kat_usaha = $resultSet->fields[kode_kat_usaha];
   
    
	 
	$edit = 1;
 
	
}	 
//print $sql_.$edit_prov_id;

$smarty->assign ("OPT", $opt);

$smarty->assign ("EDIT_KODE_BHI", $edit_kode_bhi);
$smarty->assign ("EDIT_KODE_PERWAKILAN", $edit_kode_perwakilan);
$smarty->assign ("EDIT_BHI", $edit_bhi);
$smarty->assign ("EDIT_TGL_INPUT", $edit_tgl_input);
$smarty->assign ("EDIT_ALAMAT_LN", $edit_alamat_ln);
$smarty->assign ("EDIT_PEMILIK", $edit_pemilik);
$smarty->assign ("EDIT_NO_TLP", $edit_no_tlp);
$smarty->assign ("EDIT_THN_PENDIRIAN", $edit_thn_pendirian);
$smarty->assign ("EDIT_JML_KARJAYA", $edit_jml_karjaya); 
$smarty->assign ("EDIT_JENIS_BH", $edit_jenis_bh);
$smarty->assign ("EDIT_KODE_KAT_USAHA", $edit_kode_kat_usaha);
 
$smarty->assign ("EDIT_VAL", $edit);


//$tahun = now();
if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
 
				$sql  = "select * from tbl_bhi inner join tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_bhi.kode_perwakilan where 1=1  ";
  
			    if($kode_bhi_cari!=''){
					$sql .= "AND kode_bhi  like '%".$kode_bhi_cari."%' ";
				}
 				if($kode_perwakilan_cari !=''){
						$sql .= "AND tbl_bhi.kode_perwakilan = '".$kode_perwakilan_cari."' ";
					}
				 if($pemilik_cari!=''){
					$sql .= "AND pemilik = '".$pemilik_cari."' ";
				}

				if($jenis_bh_cari!=''){
					$sql .= "AND jenis_bh LIKE '%".$jenis_bh_cari."%' ";
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

				$sql  = "select * from tbl_bhi inner join tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_bhi.kode_perwakilan where 1=1  ";
  
			    if($kode_bhi_cari!=''){
					$sql .= "AND kode_bhi  like '%".$kode_bhi_cari."%' ";
				}
				if($kode_perwakilan_cari !=''){
						$sql .= "AND tbl_bhi.kode_perwakilan = '".$kode_perwakilan_cari."' ";
				}
				 if($pemilik_cari!=''){
					$sql .= "AND pemilik = '".$pemilik_cari."' ";
				}

				if($jenis_bh_cari!=''){
					$sql .= "AND jenis_bh LIKE '%".$jenis_bh_cari."%' ";
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