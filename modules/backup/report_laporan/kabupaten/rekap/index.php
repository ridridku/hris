<?php

/*** Modify 29-06-2010 
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
require_once($DIR_INC.'/funct.php');
require_once($DIR_HOME.'/laporan_excell/inc.rekap.php');

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/report_laporan/kabupaten/rekap';

#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/report_laporan');
$FILE_JS  = $JS_MODUL.'/kabupaten/rekap';

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

$tbl_name_main = "tbl_form_k_01_main";
$tbl_name_detail = "tbl_form_k_01_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
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
else $ORDER="a.id_form_k_01_detail";

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

if ($_GET['jns_jln2']) $jns_jln2 = $_GET['jns_jln2'];
else if ($_POST['jns_jln2']) $jns_jln2 = $_POST['jns_jln2'];
else $jns_jln2="";

if ($_GET['id_pulau']) $id_pulau = $_GET['id_pulau'];
else if ($_POST['id_pulau']) $id_pulau = $_POST['id_pulau'];
else $id_pulau="";

$fields_find_jns_jln_	= $jns_jln!=""?$jns_jln:$jns_jln2;

$Search_Year = $_GET[Search_Year];

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year."&jns_jln=".$jns_jln;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year."&jns_jln2=".$jns_jln2."&id_pulau=".$id_pulau;

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

$sql_propinsi = "SELECT id_pulau,nama_pulau FROM tbl_mast_wil_pulau ORDER BY nama_pulau ASC";
$recordSet_propinsi = $db->Execute($sql_propinsi);
$initSet = array();
$data_propinsi = array();
$z=0;
while ($arr=$recordSet_propinsi->FetchRow()) {
	array_push($data_propinsi, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PULAU", $data_propinsi);


//----------Menampilkan Data Kabupaten---------------------------

if ($_GET[get_propinsi] == 1)
{
	$id_pulau = $_GET[id_pulau];
			if($id_pulau!=''){	
					$sql_kab_combo 	  = "SELECT * FROM tbl_mast_wil_propinsi WHERE id_pulau='$id_pulau' ORDER BY nama_propinsi ASC ";
					$result_kab_combo  = $db->Execute($sql_kab_combo);
					$input_kab="<select name=no_propinsi>";
					$input_kab.="<option>[Pilih Propinsi]";
					$input_kab.="</option> ";
					while(!$result_kab_combo ->EOF): 						
						($result_kab_combo  ->fields['no_propinsi']==$no_propinsi) ? $selected=" selected":$selected=NULL;
						$input_kab.="<option value=";
						$input_kab.= $result_kab_combo  ->fields['no_propinsi']."".$selected.">".$result_kab_combo ->fields['nama_propinsi'];   
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

if($id_pulau!=''){	
	$sql_kabupaten 	  = "SELECT * FROM tbl_mast_wil_propinsi WHERE id_pulau='$id_pulau' ORDER BY nama_propinsi ASC";
	$recordSet_kabupaten = $db->Execute($sql_kabupaten);
	$initSet = array();
	$data_kabupaten = array();
	$z=0;
	while ($arr=$recordSet_kabupaten->FetchRow()) {
		array_push($data_kabupaten, $arr);
		array_push($initSet, $z);
		$z++;
	}
	$smarty->assign ("DATA_PROPINSI", $data_kabupaten);
} 
/*if($no_propinsi==''){	
	$sql_kabupaten 	  = "SELECT * FROM tbl_mast_wil_propinsi WHERE no_propinsi='$no_propinsi' ORDER BY nama_propinsi ASC";
	$recordSet_kabupaten = $db->Execute($sql_kabupaten);
	$initSet = array();
	$data_kabupaten = array();
	$z=0;
	while ($arr=$recordSet_kabupaten->FetchRow()) {
		array_push($data_kabupaten, $arr);
		array_push($initSet, $z);
		$z++;
	}
	$smarty->assign ("DATA_PROPINSI", $data_kabupaten);
} */
		
			
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
				
				if ($jns_jln!='Semua' && $id_pulau!='Semua')
				{
				$sql_data_wilayah = "SELECT nama_propinsi,nama_pulau FROM tbl_mast_wil_propinsi a join tbl_mast_wil_pulau b on a.id_pulau=b.id_pulau WHERE no_propinsi='".$no_propinsi."' and b.id_pulau='".$id_pulau."'";
				}
				
			
			
				$recordSet_wilayah = $db->Execute($sql_data_wilayah);
				$nama_pulau = $recordSet_wilayah->fields[nama_pulau];
				if ($nama_pulau=='')
				{
				$sql_data_wilayah2 = "SELECT nama_pulau FROM tbl_mast_wil_pulau WHERE id_pulau='".$id_pulau."'";
				$recordSet_wilayah2 = $db->Execute($sql_data_wilayah2);
				$nama_pulau = $recordSet_wilayah2->fields[nama_pulau];
				} 
				$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];
				$jenis_jalan	= $jns_jln==1?"Provinsi":"Kabupaten/ Kota";
				
				//$sql = "SELECT * FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_form_k_01_main=b.id_k_01_mainWHERE 1=1 ";
				

				if($no_propinsi!='' AND $id_pulau=='' AND $Search_Year!='' AND $jns_jln!='')
				{
		
				$sql="select e.nama_pulau as kecamatan_yg_dilalui, b.id_jns_jln,sum(a.panjang_km) as panjang_ruas,sum(a.kondisi_baik) as baik,sum(a.kondisi_sedang) as sedang,sum(a.kondisi_rusak) as rusak_ringan,sum(a.kondisi_rusak_berat) as rusak_berat
from tbl_form_jl_02_detail  a join tbl_form_jl_02_main b 
on a.id_fjl_02_main = b.id_fjl_02_main join tbl_mast_wil_kabupaten c on c.no_kabupaten=b.no_kabupaten and c.no_propinsi=b.no_propinsi join tbl_mast_wil_propinsi d on d.no_propinsi=c.no_propinsi join tbl_mast_wil_pulau e  on e.id_pulau=d.id_pulau 
where year(tanggal)='".$Search_Year."' and  b.id_jns_jln ='".$jns_jln."' $f_no_propinsi $f_no_kabupaten  group by e.id_pulau";				
				
				}
				
				 
				else if ($no_propinsi =='[Pilih Propinsi]' and $id_pulau !=''  AND $jns_jln!='' AND $Search_Year!=''  )
				{
$no_propinsi==""; 
$sql="select e.nama_pulau ,b.no_propinsi,d.nama_propinsi as kecamatan_yg_dilalui,b.id_jns_jln,sum(a.panjang_km) as panjang_ruas,sum(a.kondisi_baik) as baik,sum(a.kondisi_sedang) as sedang,sum(a.kondisi_rusak) as rusak_ringan,sum(a.kondisi_rusak_berat) as rusak_berat
from tbl_form_jl_02_detail  a join tbl_form_jl_02_main b 
on a.id_fjl_02_main = b.id_fjl_02_main join tbl_mast_wil_kabupaten c on c.no_kabupaten=b.no_kabupaten and c.no_propinsi=b.no_propinsi join tbl_mast_wil_propinsi d on d.no_propinsi=c.no_propinsi join tbl_mast_wil_pulau e  on e.id_pulau=d.id_pulau 
where e.id_pulau='".$id_pulau."' and year(tanggal)='".$Search_Year."' and  b.id_jns_jln ='".$jns_jln."' $f_no_propinsi $f_no_kabupaten  group by no_propinsi
";

}
				
				else if ($no_propinsi !='' AND $id_pulau !='' AND $jns_jln!='' AND $Search_Year!='' )	{
				$sql="select b.no_kabupaten ,c.nama_kabupaten as kecamatan_yg_dilalui,b.no_propinsi,b.id_jns_jln,sum(a.panjang_km) as panjang_ruas,sum(a.kondisi_baik) as baik,sum(a.kondisi_sedang) as sedang,sum(a.kondisi_rusak) as rusak_ringan,sum(a.kondisi_rusak_berat) as rusak_berat
from tbl_form_jl_02_detail  a join tbl_form_jl_02_main b 
on a.id_fjl_02_main = b.id_fjl_02_main join tbl_mast_wil_kabupaten c on c.no_kabupaten =b.no_kabupaten and c.no_propinsi=b.no_propinsi
where b.no_propinsi='".$no_propinsi."' and year(tanggal)='".$Search_Year."' and  b.id_jns_jln ='".$jns_jln."' $f_no_propinsi $f_no_kabupaten group by b.no_kabupaten ";
					
				}else
				{
					
				}
								
				//$sql .= "ORDER BY ".$ORDER." ".$SORT." ";
				
				
				//print $sql;
						
				if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);

				$numresults=$db->Execute($sql);
			
				$count = $numresults->RecordCount();

				$pages = $p->findPages($count,$LIMIT); 

				$recordSet = $db->Execute($sql);
				$end = $recordSet->RecordCount();
				$initSet = array();
				$data_tb = array();
				$row_class = array();
			
				$data_panjang_ruas = array();
				
				$z=0;
		
				//tambahan tuti
				$tot_panjang_ruas =0;
				$tot_baik =0;
				$tot_sedang =0;
				$tot_ringan =0;
				$tot_berat =0;
				$counter=0;
				//end tambahan tuti
				while ($arr=$recordSet->FetchRow()) {
			
					$panjang_ruas = $arr[panjang_ruas];
					//tambahan tuti
					$tot_panjang_ruas = $arr[panjang_ruas]+$tot_panjang_ruas ;
					//end tambahan tuti
				
					$baik=$arr[baik];
					$baikpersen=number_format(($baik/$arr[panjang_ruas])*100,0);
					//tambahan tuti
					$tot_baik = $baik+$tot_baik ;
					$totbaikpersen=number_format(($tot_baik/$tot_panjang_ruas)*100,0);
					//end tambahan tuti
					
					$sedang=$arr[sedang];
					$sedangpersen=number_format(($sedang/$arr[panjang_ruas])*100,0);
					//tambahan tuti
					$tot_sedang = $sedang+$tot_sedang ;
					$totsedangpersen=number_format(($tot_sedang/$tot_panjang_ruas)*100,0);
					//end tambahan tuti
					
					$rusak_ringan=$arr[rusak_ringan];
					$rrpersen=number_format(($rusak_ringan/$arr[panjang_ruas])*100,0);
					//tambahan tuti
					$tot_ringan = $rusak_ringan+$tot_ringan ;
					$totringanpersen=number_format(($tot_ringan/$tot_panjang_ruas)*100,0);
					//end tambahan tuti
					
					$rusak_berat=$arr[rusak_berat];
					$rbpersen=number_format(($rusak_berat/$arr[panjang_ruas])*100,0);
					//tambahan tuti
					$tot_berat = $rusak_berat+$tot_berat ;
					$totberatpersen=number_format(($tot_berat/$tot_panjang_ruas)*100,0);
					$counter=$counter+1;
					//end tambahan tuti
					//echo $arr[kecamatan_yg_dilalui];
					
					
					$content_data .= print_content($arr[kecamatan_yg_dilalui],$arr[panjang_ruas],
					$baik."(".$baikpersen."%)",
					$sedang."(".$sedangpersen."%)",
					$rusak_ringan."(".$rrpersen."%)",
					$rusak_berat."(".$rbpersen."%)",$counter);

					
					array_push($data_tb, $arr);
					array_push($data_panjang_ruas,$panjang_ruas);
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
					if ($id_pulau=='')
					{
					$file= $DIR_HOME."/files/rekap_semua_pulau_".$jns_jln."_".$Search_Year.".xls";
					}
					else if ($no_propinsi =='[Pilih Propinsi]' and $id_pulau !='' )
					{
					$file= $DIR_HOME."/files/rekap_".$nama_pulau."_".$jns_jln."_".$Search_Year.".xls";
					}
					else if ($no_propinsi !='[Pilih Propinsi]')
					{
					$file= $DIR_HOME."/files/rekap_".$nama_pulau."_".$nama_propinsi."_".$jns_jln."_".$Search_Year.".xls";
					}
					
					
				
				$fp=@fopen($file,"w");
				if(!is_resource($fp))
				return false;
				//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
				stream_set_write_buffer($fp, 0);
				
				
				$akhir = print_akhir($tot_panjang_ruas,
				$tot_baik."(".$totbaikpersen."%)",$tot_sedang."(".$totsedangpersen."%)",$tot_ringan."(".$totringanpersen."%)",$tot_berat."(".$totberatpersen."%)");
				

				
				$content = print_header($id_pulau,$no_propinsi,$nama_pulau,$nama_propinsi,$Search_Year,$jenis_jalan);
				$content .= $content_data;
				$content .= $akhir;
				$content .= print_footer();
				
				
				
				fwrite($fp,$content);
				fclose($fp);
				
			if ($id_pulau=='')
					{
					$file_2= $HREF_HOME."/files/rekap_semua_pulau_".$jns_jln."_".$Search_Year.".xls";
					}
					else if ($no_propinsi =='[Pilih Propinsi]' and $id_pulau !='' )
					{
					$file_2= $HREF_HOME."/files/rekap_".$nama_pulau."_".$jns_jln."_".$Search_Year.".xls";
					}
					else if ($no_propinsi !='[Pilih Propinsi]' )
					{
					$file_2= $HREF_HOME."/files/rekap_".$nama_pulau."_".$nama_propinsi."_".$jns_jln."_".$Search_Year.".xls";
					}
			
			
}

}

($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;


$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NO_PULAU", $id_pulau);
$smarty->assign ("NO_JENIS_JALAN", $jns_jln);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("NAMA_PULAU", $nama_pulau);

$smarty->assign ("SEARCH_YEAR", $Search_Year);
$smarty->assign ("FILES", $file_2);
$smarty->assign ("STATUS_PROGRES", $status_progres);
$smarty->assign ("TITLE", _PRINT_TITLE_K_01_MAIN);
$smarty->assign ("HEAD_TITLE", _PRINT_HEAD_TITLE_K_01_MAIN);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);

$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("TB_NO_KABUPATEN", _NO_KABUPATEN);
$smarty->assign ("TB_NO_RUAS", _NO_RUAS);
$smarty->assign ("TB_NAMA_RUAS", _NAMA_RUAS);
$smarty->assign ("TB_TITIK_PENGENAL_PANGKAL", _TITIK_PENGENAL_PANGKAL);
$smarty->assign ("TB_TITIK_PENGENAL_UJUNG", _TITIK_PENGENAL_UJUNG);
$smarty->assign ("TB_NAMA_KECAMATAN", _NAMA_KECAMATAN);
$smarty->assign ("TB_PANJANG_RUAS", _PANJANG_RUAS);
$smarty->assign ("TB_LEBAR_RATA_RATA", _LEBAR_RATA_RATA);
$smarty->assign ("TB_PANJANG_PERMUKAAN", _PANJANG_PERMUKAAN);
$smarty->assign ("TB_ASPAL", _ASPAL);
$smarty->assign ("TB_PM", _PENETRASI_MACADAM);
$smarty->assign ("TB_TELFORD", _TELFORD);
$smarty->assign ("TB_TANAH", _TANAH);
$smarty->assign ("TB_BLM_TEMBUS", _BELUM_TEMBUS);
$smarty->assign ("TB_KETERANGAN", _KETERANGAN);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _PRINT_LIST_K_01_MAIN);
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
$smarty->assign ("DATA_TOT_PANJANG_RUAS", $tot_panjang_ruas);
$smarty->assign ("DATA_TOT_BAIK", $tot_baik);
$smarty->assign ("DATA_TOT_SEDANG", $tot_sedang);
$smarty->assign ("DATA_TOT_RINGAN", $tot_ringan);
$smarty->assign ("DATA_TOT_BERAT", $tot_berat);


$smarty->assign ("JUMLAH",$count);
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