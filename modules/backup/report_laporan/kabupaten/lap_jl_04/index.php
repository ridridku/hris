<?php

/*** Last Modify 18-07-2010
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
require_once($DIR_HOME.'/laporan_excell/inc.jl_04.php');

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/report_laporan/kabupaten/lap_jl_04';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/report_laporan');
$FILE_JS  = $JS_MODUL.'/kabupaten/lap_jl_04';

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

$tbl_name_main = "tbl_form_jl_04_main";
$tbl_name_detail = "tbl_form_jl_04_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
$tbl_program_penanganan = "tbl_mast_program_penanganan";
/*** Tambahan 06-06-2010 ***/
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
else $ORDER="a.id_fjl_04_detail";

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

if ($_GET['jns_jln2']) $jns_jln = $_GET['jns_jln2'];
else if ($_POST['jns_jln2']) $jns_jln = $_POST['jns_jln2'];
else $jns_jln2="";

$fields_find_jns_jln_	= $jns_jln!=""?$jns_jln:$jns_jln2;

$Search_Year = $_GET[Search_Year];

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=".$search."&jns_jln=".$jns_jln;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=".$search."&jns_jln=".$jns_jln;

$SES_THN		= $_SESSION['SESSION_TAHUN'];
$SES_JNS_JLN	= $_SESSION['SESSION_JNS_JLN'];
$SES_NO_PROP	= $_SESSION['SESSION_NO_PROPINSI'];
$SES_NO_KAB		= $_SESSION['SESSION_NO_KABUPATEN'];

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

//-----PROGRAM PENANGANAN---------------------------------------

$sql_program_penanganan = "SELECT * FROM ".$tbl_program_penanganan." ORDER BY sub_kategori ASC,id_program_penanganan ASC";
$recordSet_program_penanganan = $db->Execute($sql_program_penanganan);
$initSet = array();
$data_program_penanganan = array();
$row_class = array();
$z=0;
while ($arr=$recordSet_program_penanganan->FetchRow()) {
	array_push($data_program_penanganan, $arr);
	if ($z%2==0){ 
		$ROW_CLASSNAME="#EEEEEE"; }
	else {
		$ROW_CLASSNAME="#EEEEEE";
	   }
	array_push($row_class, $ROW_CLASSNAME);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PROGRAM_PENANGANAN", $data_program_penanganan);
//--------------------------------------------------------------------

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
		
/*			
if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
				
				$sql_data_wilayah = "SELECT get_nama_propinsi(no_propinsi) as nama_propinsi,get_nama_kabupaten(no_propinsi,no_kabupaten) as nama_kabupaten FROM ".$tbl_name_kabupaten." WHERE no_propinsi='".$no_propinsi."' AND no_kabupaten='".$no_kabupaten."' ";
				$recordSet_wilayah = $db->execute($sql_data_wilayah);
				$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];
				$nama_kabupaten = $recordSet_wilayah->fields[nama_kabupaten];
				
				$sql = "SELECT *
				FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_04_main=b.id_fjl_04_main LEFT JOIN ".$tbl_program_penanganan." c ON a.id_program_penanganan=c.id_program_penanganan WHERE 1=1 ";
			
				if($no_propinsi!='' AND $no_kabupaten!='' AND $Search_Year!=''){
					$sql .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' AND YEAR(b.tanggal)='".$Search_Year."' ";
				}
				
				$sql .= "ORDER BY a.id_program_penanganan ASC ";

				if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);

				//$numresults=$db->Execute($sql);
				//$count = $numresults->RecordCount();

				$pages = $p->findPages($count,$LIMIT); 
				//$sql  .= "LIMIT ".$start.", ".$LIMIT;
				$recordSet = $db->Execute($sql);
				$end = $recordSet->RecordCount();
				$initSet = array();
				$data_tb = array();
				
				$z=0;

				while ($arr=$recordSet->FetchRow()) {
					array_push($data_tb, $arr);					
					array_push($initSet, $z);
					$z++;
				}

				$count_view = $start+1;
				$count_all  = $start+$end;
				$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 
}

}

$sql_count = "SELECT 
SUM(apbd_target) as apbd_target,
SUM(apbd_biaya) as apbd_biaya,
SUM(apbd_jalan_target) as apbd_jalan_target,
SUM(apbd_jalan_biaya) as apbd_jalan_biaya,
SUM(dak_target) as dak_target,
SUM(dak_biaya) as dak_biaya,
SUM(sektor_target) as sektor_target,
SUM(sektor_biaya) as sektor_biaya,
SUM(pinjaman_target) as pinjaman_target,
SUM(pinjaman_biaya) as pinjaman_biaya,
SUM(total_target) as total_target,
SUM(total_biaya) as total_biaya 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_04_main=b.id_fjl_04_main LEFT JOIN ".$tbl_program_penanganan." c ON a.id_program_penanganan=c.id_program_penanganan 		
		WHERE 1=1 ";
			
if($no_propinsi!='' AND $no_kabupaten!=''){
	$sql_count .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' ";
}
$sql_count .= " AND c.sub_kategori=1";

$recordSet_count = $db->Execute($sql_count);
$initSet = array();
$data_count = array();
$z=0;
while ($arr=$recordSet_count->FetchRow()) {
	array_push($data_count, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_COUNT", $data_count);

$sql_count2 = "SELECT 
SUM(apbd_target) as apbd_target,
SUM(apbd_biaya) as apbd_biaya,
SUM(apbd_jalan_target) as apbd_jalan_target,
SUM(apbd_jalan_biaya) as apbd_jalan_biaya,
SUM(dak_target) as dak_target,
SUM(dak_biaya) as dak_biaya,
SUM(sektor_target) as sektor_target,
SUM(sektor_biaya) as sektor_biaya,
SUM(pinjaman_target) as pinjaman_target,
SUM(pinjaman_biaya) as pinjaman_biaya,
SUM(total_target) as total_target,
SUM(total_biaya) as total_biaya 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_04_main=b.id_fjl_04_main LEFT JOIN ".$tbl_program_penanganan." c ON a.id_program_penanganan=c.id_program_penanganan 		
		WHERE 1=1 ";
			
if($no_propinsi!='' AND $no_kabupaten!=''){
	$sql_count2 .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' ";
}
$sql_count2 .= " AND c.sub_kategori=2";

$recordSet_count2 = $db->Execute($sql_count2);
$initSet = array();
$data_count2 = array();
$z=0;
while ($arr=$recordSet_count2->FetchRow()) {
	array_push($data_count2, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_COUNT2", $data_count2);

($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;
*/

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
								
				$sql_data_wilayah = "SELECT get_nama_propinsi(no_propinsi) as nama_propinsi,get_nama_kabupaten(no_propinsi,no_kabupaten) as nama_kabupaten FROM ".$tbl_name_kabupaten." WHERE no_propinsi='".$no_propinsi."' AND no_kabupaten='".$no_kabupaten."' ";
				$recordSet_wilayah = $db->execute($sql_data_wilayah);
				$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];
				$nama_kabupaten = $recordSet_wilayah->fields[nama_kabupaten];
				$jenis_jalan	= $jns_jln==1?"Provinsi":"Kabupaten/ Kota";
				$sql = "SELECT * 
				FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_04_main=b.id_fjl_04_main LEFT JOIN ".$tbl_program_penanganan." c ON a.id_program_penanganan=c.id_program_penanganan WHERE 1=1 AND c.status='1' ";
				
				/*** Disabled 18-07-2010, minggu nie :P
				if($no_propinsi!='' AND $no_kabupaten!='' AND $Search_Year!='' AND $jns_jln!=''){
					$sql .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' AND YEAR(b.tanggal)='".$Search_Year."' AND b.id_jns_jln='".$jns_jln."' ";
				}
				***/
				if($no_propinsi!='' AND $no_kabupaten!='' AND $Search_Year!='' AND $jns_jln==''){
					$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) AND YEAR(b.tanggal)='".$Search_Year."' $f_id_jns_jln ";
				} else if ($no_propinsi!='' AND $no_kabupaten!='' AND $Search_Year!=''  AND $jns_jln!=''){
					$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) AND (b.id_jns_jln='".$jns_jln."' $f_id_jns_jln) AND YEAR(b.tanggal)='".$Search_Year."' ";
				} else {
					$sql .= "AND b.no_propinsi='".$SES_NO_PROP."' AND b.no_kabupaten='".$SES_NO_KAB."' $f_id_jns_jln ";
				}
								
				$sql .= "ORDER BY a.id_program_penanganan ASC ";
				$recordSet = $db->Execute($sql);				
				$tgl = explode("-",$recordSet->fields[tanggal],strlen($recordSet->fields[tanggal])); // YYYY-mm-dd
				$tanggal_ = !empty($tgl[2])?$tgl[2]."-".$tgl[1]."-".$tgl[0]:"";				
				$tanggal = $tanggal_;
				$apbd = $recordSet->fields[apbd];
				$thn_anggaran = $recordSet->fields[thn_anggaran];
				$end = $recordSet->RecordCount();
				$initSet = array();
				$data_tb = array();
				$data_apbd_target = array();
				$data_apbd_biaya = array();
				$data_apbd_jalan_target = array();
				$data_apbd_jalan_biaya = array();
				$data_dak_target = array();
				$data_dak_biaya = array();
				$data_sektor_target = array();
				$data_sektor_biaya = array();
				$data_pinjaman_target = array();
				$data_pinjaman_biaya = array();
				$data_total_target = array();
				$data_total_biaya = array();
				$row_class = array();
				$z=0;
				$kat1 = ""; $kat2 = ""; $kat3 = ""; $kat4 = ""; $kat5 = "";
				while ($arr=$recordSet->FetchRow()) {
					($arr[sub_kategori]==1) ? $kat1 .= print_content1B($arr[jenis_program],$arr[apbd_target],$arr[apbd_biaya],$arr[apbd_jalan_target],$arr[apbd_jalan_biaya],$arr[dak_target],$arr[dak_biaya],$arr[sektor_target],$arr[sektor_biaya],$arr[pinjaman_target],$arr[pinjaman_biaya],$arr[total_target],$arr[total_biaya]): NULL;
					/*** Disabled 19-08-2010
					($arr[sub_kategori]==2) ? $kat2 .= print_content1B($arr[jenis_program],$arr[apbd_target],$arr[apbd_biaya],$arr[apbd_jalan_target],$arr[apbd_jalan_biaya],$arr[dak_target],$arr[dak_biaya],$arr[sektor_target],$arr[sektor_biaya],$arr[pinjaman_target],$arr[pinjaman_biaya],$arr[total_target],$arr[total_biaya]): NULL;
					***/
					
					($arr[sub_kategori]==13) ? $kat3 .= print_content1C("2",$arr[jenis_program],$arr[apbd_target],$arr[apbd_biaya],$arr[apbd_jalan_target],$arr[apbd_jalan_biaya],$arr[dak_target],$arr[dak_biaya],$arr[sektor_target],$arr[sektor_biaya],$arr[pinjaman_target],$arr[pinjaman_biaya],$arr[total_target],$arr[total_biaya]): NULL;
					($arr[sub_kategori]==15) ? $kat4 .= print_content1C("3",$arr[jenis_program],$arr[apbd_target],$arr[apbd_biaya],$arr[apbd_jalan_target],$arr[apbd_jalan_biaya],$arr[dak_target],$arr[dak_biaya],$arr[sektor_target],$arr[sektor_biaya],$arr[pinjaman_target],$arr[pinjaman_biaya],$arr[total_target],$arr[total_biaya]): NULL;
					($arr[sub_kategori]==17) ? $kat5 .= print_content1C("4",$arr[jenis_program],$arr[apbd_target],$arr[apbd_biaya],$arr[apbd_jalan_target],$arr[apbd_jalan_biaya],$arr[dak_target],$arr[dak_biaya],$arr[sektor_target],$arr[sektor_biaya],$arr[pinjaman_target],$arr[pinjaman_biaya],$arr[total_target],$arr[total_biaya]): NULL;

					$apbd_target = number_format($arr[apbd_target],'2',',','.');
					$apbd_biaya = number_format($arr[apbd_biaya],'2',',','.'); 
					$apbd_jalan_target = number_format($arr[apbd_jalan_target],'2',',','.'); 
					$apbd_jalan_biaya = number_format($arr[apbd_jalan_biaya],'2',',','.'); 
					$dak_target = number_format($arr[dak_target],'2',',','.'); 
					$dak_biaya = number_format($arr[dak_biaya],'2',',','.'); 
					$sektor_target = number_format($arr[sektor_target],'2',',','.'); 
					$sektor_biaya = number_format($arr[sektor_biaya],'2',',','.'); 
					$pinjaman_target = number_format($arr[pinjaman_target],'2',',','.'); 
					$pinjaman_biaya = number_format($arr[pinjaman_biaya],'2',',','.'); 
					$total_target = number_format($arr[total_target],'2',',','.'); 
					$total_biaya = number_format($arr[total_biaya],'2',',','.'); 

					array_push($data_apbd_target,$apbd_target);
					array_push($data_apbd_biaya,$apbd_biaya);
					array_push($data_apbd_jalan_target,$apbd_jalan_target);
					array_push($data_apbd_jalan_biaya,$apbd_jalan_biaya);
					array_push($data_dak_target,$dak_target);
					array_push($data_dak_biaya,$dak_biaya);
					array_push($data_sektor_target,$sektor_target);
					array_push($data_sektor_biaya,$sektor_biaya);
					array_push($data_pinjaman_target,$pinjaman_target);
					array_push($data_pinjaman_biaya,$pinjaman_biaya);
					array_push($data_total_target,$total_target);
					array_push($data_total_biaya,$total_biaya);										
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

$sql_count = "SELECT 
SUM(apbd_target) as apbd_target,
SUM(apbd_biaya) as apbd_biaya,
SUM(apbd_jalan_target) as apbd_jalan_target,
SUM(apbd_jalan_biaya) as apbd_jalan_biaya,
SUM(dak_target) as dak_target,
SUM(dak_biaya) as dak_biaya,
SUM(sektor_target) as sektor_target,
SUM(sektor_biaya) as sektor_biaya,
SUM(pinjaman_target) as pinjaman_target,
SUM(pinjaman_biaya) as pinjaman_biaya,
SUM(total_target) as total_target,
SUM(total_biaya) as total_biaya 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_04_main=b.id_fjl_04_main LEFT JOIN ".$tbl_program_penanganan." c ON a.id_program_penanganan=c.id_program_penanganan 		
		WHERE 1=1 ";
			
if($no_propinsi!='' AND $no_kabupaten!='' AND $Search_Year!=''){
	$sql_count .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."'  AND YEAR(b.tanggal)='".$Search_Year."' ";
}
$sql_count .= " AND c.sub_kategori=1";

$recordSet_count = $db->Execute($sql_count);
$initSet = array();
$data_count = array();
$data_apbd_target2 = array();
$data_apbd_biaya2 = array();
$data_apbd_jalan_target2 = array();
$data_apbd_jalan_biaya2 = array();
$data_dak_target2 = array();
$data_dak_biaya2 = array();
$data_sektor_target2 = array();
$data_sektor_biaya2 = array();
$data_pinjaman_target2 = array();
$data_pinjaman_biaya2 = array();
$data_total_target2 = array();
$data_total_biaya2 = array();
$z=0;
while ($arr=$recordSet_count->FetchRow()) {
	$sub_total1 = print_content1B("Sub Total Jalan",$arr[apbd_target],$arr[apbd_biaya],$arr[apbd_jalan_target],$arr[apbd_jalan_biaya],$arr[dak_target],$arr[dak_biaya],$arr[sektor_target],$arr[sektor_biaya],$arr[pinjaman_target],$arr[pinjaman_biaya],$arr[total_target],$arr[total_biaya]);
	$apbd_target2 = number_format($arr[apbd_target],'2',',','.');
	$apbd_biaya2 = number_format($arr[apbd_biaya],'2',',','.');
	$apbd_jalan_target2 = number_format($arr[apbd_jalan_target],'2',',','.');
	$apbd_jalan_biaya2 = number_format($arr[apbd_jalan_biaya],'2',',','.');
	$dak_target2 = number_format($arr[dak_target],'2',',','.');
	$dak_biaya2 = number_format($arr[dak_biaya],'2',',','.');
	$sektor_target2 = number_format($arr[sektor_target],'2',',','.');
	$sektor_biaya2 = number_format($arr[sektor_biaya],'2',',','.');
	$pinjaman_target2 = number_format($arr[pinjaman_target],'2',',','.');
	$pinjaman_biaya2 = number_format($arr[pinjaman_biaya],'2',',','.');
	$total_target2 = number_format($arr[total_target],'2',',','.');
	$total_biaya2 = number_format($arr[total_biaya],'2',',','.');
		
	array_push($data_count, $arr);
	array_push($data_apbd_target2, $apbd_target2);
	array_push($data_apbd_biaya2, $apbd_biaya2);
	array_push($data_apbd_jalan_target2, $apbd_jalan_target2);
	array_push($data_apbd_jalan_biaya2, $apbd_jalan_biaya2);
	array_push($data_dak_target2, $dak_target2);
	array_push($data_dak_biaya2, $dak_biaya2);
	array_push($data_sektor_target2, $sektor_target2);
	array_push($data_sektor_biaya2, $sektor_biaya2);
	array_push($data_pinjaman_target2, $pinjaman_target2);
	array_push($data_pinjaman_biaya2, $pinjaman_biaya2);
	array_push($data_total_target2, $total_target2);
	array_push($data_total_biaya2, $total_biaya2);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_COUNT", $data_count);
$smarty->assign ("DATA_APBD_TARGET2",$data_apbd_target2);
$smarty->assign ("DATA_APBD_BIAYA2",$data_apbd_biaya2);
$smarty->assign ("DATA_APBD_JALAN_TARGET2",$data_apbd_jalan_target2);
$smarty->assign ("DATA_APBD_JALAN_BIAYA2",$data_apbd_jalan_biaya2);
$smarty->assign ("DATA_DAK_TARGET2",$data_dak_target2);
$smarty->assign ("DATA_DAK_BIAYA2",$data_dak_biaya2);
$smarty->assign ("DATA_SEKTOR_TARGET2",$data_sektor_target2);
$smarty->assign ("DATA_SEKTOR_BIAYA2",$data_sektor_biaya2);
$smarty->assign ("DATA_PINJAMAN_TARGET2",$data_pinjaman_target2);
$smarty->assign ("DATA_PINJAMAN_BIAYA2",$data_pinjaman_biaya2);
$smarty->assign ("DATA_TOTAL_TARGET2",$data_total_target2);
$smarty->assign ("DATA_TOTAL_BIAYA2",$data_total_biaya2);

$sql_count2 = "SELECT 
SUM(apbd_target) as apbd_target,
SUM(apbd_biaya) as apbd_biaya,
SUM(apbd_jalan_target) as apbd_jalan_target,
SUM(apbd_jalan_biaya) as apbd_jalan_biaya,
SUM(dak_target) as dak_target,
SUM(dak_biaya) as dak_biaya,
SUM(sektor_target) as sektor_target,
SUM(sektor_biaya) as sektor_biaya,
SUM(pinjaman_target) as pinjaman_target,
SUM(pinjaman_biaya) as pinjaman_biaya,
SUM(total_target) as total_target,
SUM(total_biaya) as total_biaya 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_04_main=b.id_fjl_04_main LEFT JOIN ".$tbl_program_penanganan." c ON a.id_program_penanganan=c.id_program_penanganan 		
		WHERE 1=1 ";
			
if($no_propinsi!='' AND $no_kabupaten!=''){
	$sql_count2 .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."'  AND YEAR(b.tanggal)='".$Search_Year."' ";
}
$sql_count2 .= " AND c.sub_kategori=2";

$recordSet_count2 = $db->Execute($sql_count2);
$initSet = array();
$data_count2 = array();
$z=0;
while ($arr=$recordSet_count2->FetchRow()) {
	$sub_total2 = print_content1B("Sub Total Jembatan",$arr[apbd_target],$arr[apbd_biaya],$arr[apbd_jalan_target],$arr[apbd_jalan_biaya],$arr[dak_target],$arr[dak_biaya],$arr[sektor_target],$arr[sektor_biaya],$arr[pinjaman_target],$arr[pinjaman_biaya],$arr[total_target],$arr[total_biaya]);
	array_push($data_count2, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_COUNT2", $data_count2);

$file= $DIR_HOME."/files/jl_04_".$no_propinsi."_".$no_kabupaten."_".$jns_jln."_".$Search_Year.".xls";

$fp=@fopen($file,"w");
if(!is_resource($fp))
return false;
//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
stream_set_write_buffer($fp, 0);

$content = print_header($nama_propinsi,$nama_kabupaten,$Search_Year,$jenis_jalan);
$sub_head1 = print_content1A("1","Jalan");

/*** Disabled 19-08-2010
$sub_head2 = print_content1A("2","Jembatan");
$content .= $sub_head1.$kat1.$sub_total1.$sub_head2.$kat2.$sub_total2.$kat3.$kat4.$kat5;
***/

$content .= $sub_head1.$kat1.$sub_total1.$kat2.$kat3.$kat4.$kat5;

$content .= print_footer();

fwrite($fp,$content);
fclose($fp);
$file_2= $HREF_HOME."/files/jl_04_".$no_propinsi."_".$no_kabupaten."_".$jns_jln."_".$Search_Year.".xls";
				

}

}

($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;


$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NO_KABUPATEN", $no_kabupaten);
$smarty->assign ("NO_JENIS_JALAN", $jns_jln);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten);
$smarty->assign ("SEARCH_YEAR", $Search_Year);
$smarty->assign ("FILES", $file_2);
$smarty->assign ("TANGGAL", $tanggal);
$smarty->assign ("APBD", $apbd);
$smarty->assign ("THN_ANGGARAN", $thn_anggaran);
$smarty->assign ("TITLE", _TITLE_FORM_JL_04_MAIN);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_FORM_JL_04_MAIN);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("TB_APBD", _APBD);
$smarty->assign ("TB_TAHUN_ANGGARAN", _TAHUN_ANGGARAN);
$smarty->assign ("TB_JENIS_PROGRAM", _JENIS_PROGRAM);
$smarty->assign ("TB_BIAYA_APBD", _APBD_BIAYA);
$smarty->assign ("TB_TARGET_APBD", _APBD_TARGET);
$smarty->assign ("TB_TARGET_JALAN_APBD", _APBD_JALAN_TARGET);
$smarty->assign ("TB_TARGET_JALAN_BIAYA", _APBD_JALAN_BIAYA);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_FORM_JL_04_MAIN);
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

/*** Tambahan 06-06-2010 ***/
$smarty->assign ("TB_JENIS_JALAN", _NAMA_JENIS_JALAN);

// kolom pada form pencarian
$smarty->assign ("PID_JENIS_JLN2", $fields_find_jns_jln_);
/*** End 0f 06-06-2010 ***/

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
$smarty->assign ("DATA_APBD_TARGET",$data_apbd_target);
$smarty->assign ("DATA_APBD_BIAYA",$data_apbd_biaya);
$smarty->assign ("DATA_APBD_JALAN_TARGET",$data_apbd_jalan_target);
$smarty->assign ("DATA_APBD_JALAN_BIAYA",$data_apbd_jalan_biaya);
$smarty->assign ("DATA_DAK_TARGET",$data_dak_target);
$smarty->assign ("DATA_DAK_BIAYA",$data_dak_biaya);
$smarty->assign ("DATA_SEKTOR_TARGET",$data_sektor_target);
$smarty->assign ("DATA_SEKTOR_BIAYA",$data_sektor_biaya);
$smarty->assign ("DATA_PINJAMAN_TARGET",$data_pinjaman_target);
$smarty->assign ("DATA_PINJAMAN_BIAYA",$data_pinjaman_biaya);
$smarty->assign ("DATA_TOTAL_TARGET",$data_total_target);
$smarty->assign ("DATA_TOTAL_BIAYA",$data_total_biaya);

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