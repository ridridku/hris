<?php

# Including Main Configuration
# including file for Main Configurations
require_once('../../../includes/config.conf.php');

# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
	require_once('../../../includes/header.redirect.inc');
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
require_once($DIR_HOME.'/laporan/inc.rekap_penyerahan_hak.php'); 

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/pelaporan/rekap_penyerahan_hak';
 
#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/pelaporan');
$FILE_JS  = $JS_MODUL.'/rekap_penyerahan_hak';

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

if ($_GET['kode_kawasan']) $kode_kawasan = $_GET['kode_kawasan'];
else if ($_POST['kode_kawasan']) $kode_kawasan = $_POST['kode_kawasan'];
else $kode_kawasan="";

if ($_GET['bulan']) $bulan = $_GET['bulan'];
else if ($_POST['bulan']) $bulan = $_POST['bulan'];
else $bulan="";

if ($_GET['tahun']) $tahun = $_GET['tahun'];
else if ($_POST['tahun']) $tahun = $_POST['tahun'];
else $tahun="";

if ($_GET['kode_kat_kasus']) $kode_kat_kasus = $_GET['kode_kat_kasus'];
else if ($_POST['kode_kat_kasus']) $kode_kat_kasus = $_POST['kode_kat_kasus'];
else $kode_kat_kasus="";
 

if ($_GET['search']) $search = $_GET['search'];
else if ($_POST['search']) $search = $_POST['search'];
else $search="";
 


$var_cari="kode_kawasan=".$kode_kawasan."&bulan=".$bulan."&tahun=".$tahun;
$smarty->assign ("VAR_CARI", $var_cari);


$Search_Year = $_GET[tahun];
$smarty->assign ("SEARCH", $search);
$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year."&jns_jln=".$jns_jln;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&Search_Year=".$Search_Year."&jns_jln=".$jns_jln;

$SES_TAHUN		    = $_SESSION['TAHUN'];
$SES_INSTANSI		= $_SESSION['KODE_INSTANSI'];
$SES_JENIS_USER		= $_SESSION['JENIS_USER'];
//--------------------------------------
//SHOW DATA INSTANSI
//---------------------------------------

$smarty->assign ("SES_TAHUN", $SES_TAHUN);
$smarty->assign ("SES_INSTANSI", $SES_INSTANSI);
$smarty->assign ("SES_JENIS_USER", $SES_JENIS_USER);


$smarty->assign ("BULAN", $bulan);
$smarty->assign ("TAHUN", $tahun);
$smarty->assign ("KODE_KAT_KASUS", $kode_kat_kasus);
 //--------------------------------------
//SHOW DATA INSTANSI
//---------------------------------------

$sql_instansi = "SELECT *  FROM tbl_mast_kawasan order by nama_kawasan ";
$result_instansi = $db->Execute($sql_instansi);
$initSet = array();
$data_instansi = array();
$z=0;
while ($arr=$result_instansi->FetchRow()) {
	array_push($data_instansi, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_INSTANSI", $data_instansi);
 


//----------Menampilkan Data Ruas---------------------------

  			
 if ($_GET['tahun'] != '')
 {
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
				$sql__="select * , upper(nama_kawasan) as nama_kawasan from tbl_mast_kawasan where kode_kawasan='$_GET[kode_kawasan]' ";
				$rs__=$db->Execute($sql__);			  
				 $nm_kawasan = $rs__->fields['nama_kawasan']; 				 
				 $smarty->assign ("NM_KAWASAN", $nm_kawasan); 
				  
 
				
					$sql = "SELECT a.nm_perwakilan,
						(select count(kode_wni) from tbl_kasus_pengaduan
						INNER JOIN tbl_hak_tki ON tbl_hak_tki.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan
						LEFT JOIN  tbl_mast_perwakilan on  tbl_mast_perwakilan.kode_perwakilan =  tbl_kasus_pengaduan.kode_perwakilan
						LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara
						LEFT JOIN tbl_mast_kawasan ON tbl_mast_kawasan.kode_kawasan = tbl_mast_negara.kode_kawasan
						where tbl_kasus_pengaduan.kode_perwakilan = a.kode_perwakilan  ";

						if ($tahun !='') {	
 						 $sql .= "and YEAR(tgl_penyerahan)='$tahun'  "; 
					     }


						if ($bulan !='') {	
 						 $sql .= "and MONTH(tgl_penyerahan)='$bulan' "; 
					     }

						 if ($kode_kawasan !=''){
						 $sql .= "and   tbl_mast_kawasan.kode_kawasan ='$kode_kawasan' "; 	
						 }

						
						$sql .= " ) as jumlah,
						IFNULL((select sum(ekuivalent_rp) from tbl_hak_tki
						LEFT JOIN tbl_kasus_pengaduan ON tbl_kasus_pengaduan.kode_form_pengaduan = tbl_hak_tki.kode_form_pengaduan
						LEFT JOIN  tbl_mast_perwakilan on  tbl_mast_perwakilan.kode_perwakilan =  tbl_kasus_pengaduan.kode_perwakilan
						LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara
						LEFT JOIN tbl_mast_kawasan ON tbl_mast_kawasan.kode_kawasan = tbl_mast_negara.kode_kawasan
						where tbl_kasus_pengaduan.kode_perwakilan = a.kode_perwakilan ";
						
						if ($tahun !='') {	
 						 $sql .= "and YEAR(tgl_penyerahan)='$tahun'  "; 
					     }


						if ($bulan !='') {	
 						 $sql .= "and MONTH(tgl_penyerahan)='$bulan' "; 
					     }

						 if ($kode_kawasan !=''){
						 $sql .= "and   tbl_mast_kawasan.kode_kawasan ='$kode_kawasan' "; 	
						 }

						
					 $sql .= "	),0) as jumlah_ekuivalent

						 FROM tbl_mast_perwakilan a LEFT JOIN tbl_mast_negara as x ON x.kode_negara = a.kode_negara
						LEFT JOIN tbl_mast_kawasan as n ON n.kode_kawasan = x.kode_kawasan  where 1=1  ";
					 	 
					
					if ($kode_kawasan !='') {
					$sql .=  " and  x.kode_kawasan='$kode_kawasan'  ";
					}

					$sql .= " order by nm_perwakilan ";
					
					
					
				//	echo "<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>".$sql;
						$numresults=$db->Execute($sql);
						$count = $numresults->RecordCount();
						$recordSet = $db->Execute($sql);
						$end = $recordSet->RecordCount();
						$initSet = array();
						$data_tb = array();
						$row_class = array();
						$z=0;
						while ($arr=$recordSet->FetchRow()) {
				
				$content_data .= print_content($z+1,$arr[nm_perwakilan],$arr[jumlah],$arr[jumlah_ekuivalent]);
				
				
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
 
				if ($kode_kawasan ==''){
					$sql_detail = "SELECT a.nama_kawasan,
						(select count(kode_wni) from tbl_kasus_pengaduan 
						INNER JOIN tbl_hak_tki ON tbl_hak_tki.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan
						LEFT JOIN  tbl_mast_perwakilan on  tbl_mast_perwakilan.kode_perwakilan =  tbl_kasus_pengaduan.kode_perwakilan
						LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara
						LEFT JOIN tbl_mast_kawasan ON tbl_mast_kawasan.kode_kawasan = tbl_mast_negara.kode_kawasan
						where  tbl_mast_negara.kode_kawasan = a.kode_kawasan and YEAR(tgl_penyerahan)='$tahun' ";
						
						if ($bulan !='') {	
 						 $sql_detail .= "and MONTH(tgl_penyerahan)='$bulan' "; 
									}

					
						$sql_detail .= "
						) as jumlah,
						IFNULL((select sum(ekuivalent_rp) from tbl_hak_tki
						LEFT JOIN tbl_kasus_pengaduan ON tbl_kasus_pengaduan.kode_form_pengaduan = tbl_hak_tki.kode_form_pengaduan
						LEFT JOIN  tbl_mast_perwakilan on  tbl_mast_perwakilan.kode_perwakilan =  tbl_kasus_pengaduan.kode_perwakilan
						LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara
						LEFT JOIN tbl_mast_kawasan ON tbl_mast_kawasan.kode_kawasan = tbl_mast_negara.kode_kawasan
						where tbl_mast_negara.kode_kawasan = a.kode_kawasan and YEAR(tgl_penyerahan)='$tahun'";
						
						if ($bulan !='') {	
 						 $sql_detail .= "and MONTH(tgl_penyerahan)='$bulan' "; 
									}

					
						$sql_detail .= "
						
						),0) as jumlah_ekuivalent

						 FROM tbl_mast_kawasan a ";
						 
						 
				}
				if ($kode_kawasan !=''){
					$sql_detail = "SELECT a.nama_kawasan,
						(select count(kode_wni) from tbl_kasus_pengaduan 
						INNER JOIN tbl_hak_tki ON tbl_hak_tki.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan
						LEFT JOIN  tbl_mast_perwakilan on  tbl_mast_perwakilan.kode_perwakilan =  tbl_kasus_pengaduan.kode_perwakilan
						LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara
						LEFT JOIN tbl_mast_kawasan ON tbl_mast_kawasan.kode_kawasan = tbl_mast_negara.kode_kawasan
						where  tbl_mast_negara.kode_kawasan = a.kode_kawasan and YEAR(tgl_penyerahan)='$tahun' ";
						if ($bulan !='') {	
 						 $sql_detail .= "and MONTH(tgl_penyerahan)='$bulan' "; 
									}

					
						$sql_detail .= "
						
						) as jumlah,
						IFNULL((select sum(ekuivalent_rp) from tbl_hak_tki
						LEFT JOIN tbl_kasus_pengaduan ON tbl_kasus_pengaduan.kode_form_pengaduan = tbl_hak_tki.kode_form_pengaduan
						LEFT JOIN  tbl_mast_perwakilan on  tbl_mast_perwakilan.kode_perwakilan =  tbl_kasus_pengaduan.kode_perwakilan
						LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara
						LEFT JOIN tbl_mast_kawasan ON tbl_mast_kawasan.kode_kawasan = tbl_mast_negara.kode_kawasan
						where tbl_mast_negara.kode_kawasan = a.kode_kawasan and YEAR(tgl_penyerahan)='$tahun'";
						
						if ($bulan !='') {	
 						 $sql_detail .= "and MONTH(tgl_penyerahan)='$bulan' "; 
									}

					
						$sql_detail .= "
						
						),0)  as jumlah_ekuivalent

						 FROM tbl_mast_kawasan a where kode_kawasan='$_GET[kode_kawasan]' order by nama_kawasan  ";
				}
				
				$numresults2=$db->Execute($sql_detail);
				$count2 = $numresults2->RecordCount();
 				$recordSet2 = $db->Execute($sql_detail);
				$end2 = $recordSet2->RecordCount();
				$initSet2 = array();
				$data_tb2 = array();
				$row_class2 = array();
				$z=0;
				while ($arr2=$recordSet2->FetchRow()) {
					
					$content_data2 .= print_content2($z+1,$arr2[nama_kawasan],$arr2[jumlah],$arr2[jumlah_ekuivalent]);
					
					array_push($data_tb2, $arr2);
					if ($z%2==0){ 
						$ROW_CLASSNAME="#CCCCCC"; }
					else {
						$ROW_CLASSNAME="#EEEEEE";
					   }
					array_push($row_class2, $ROW_CLASSNAME2);
					array_push($initSet2, $z);
					$z++;
				}
			   $smarty->assign ("DATA_TB2", $data_tb2);
				
				if ($kode_kawasan !=''){
				$sql_total="select distinct (select count(kode_wni)  as total_orang from tbl_kasus_pengaduan
						INNER JOIN tbl_hak_tki ON tbl_hak_tki.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan
						LEFT JOIN  tbl_mast_perwakilan on  tbl_mast_perwakilan.kode_perwakilan =  tbl_kasus_pengaduan.kode_perwakilan
						LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara
						LEFT JOIN tbl_mast_kawasan ON tbl_mast_kawasan.kode_kawasan = tbl_mast_negara.kode_kawasan
						where tbl_mast_kawasan.kode_kawasan ='$_GET[kode_kawasan]' and YEAR(tgl_penyerahan)='$tahun'";
						
						if ($bulan !='') {	
 						 $sql_total .= "and MONTH(tgl_penyerahan)='$bulan' "; 
									}

					
						$sql_total .= "
						
						) as tot_wni,
						IFNULL((select sum(ekuivalent_rp) from tbl_hak_tki
						LEFT JOIN tbl_kasus_pengaduan ON tbl_kasus_pengaduan.kode_form_pengaduan = tbl_hak_tki.kode_form_pengaduan
						LEFT JOIN  tbl_mast_perwakilan on  tbl_mast_perwakilan.kode_perwakilan =  tbl_kasus_pengaduan.kode_perwakilan
						LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara
						LEFT JOIN tbl_mast_kawasan ON tbl_mast_kawasan.kode_kawasan = tbl_mast_negara.kode_kawasan
						where tbl_mast_kawasan.kode_kawasan ='$_GET[kode_kawasan]' and YEAR(tgl_penyerahan)='$tahun' ";
						
						if ($bulan !='') {	
 						 $sql_total .= "and MONTH(tgl_penyerahan)='$bulan' "; 
									}

					
						$sql_total .= "
						),0)  as tot_ekuivalent from tbl_kasus_pengaduan";
				}
				
				if ($kode_kawasan ==''){
				$sql_total="select distinct (select count(kode_wni)  as total_orang from tbl_kasus_pengaduan
						INNER JOIN tbl_hak_tki ON tbl_hak_tki.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan
						LEFT JOIN  tbl_mast_perwakilan on  tbl_mast_perwakilan.kode_perwakilan =  tbl_kasus_pengaduan.kode_perwakilan
						LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara
						LEFT JOIN tbl_mast_kawasan ON tbl_mast_kawasan.kode_kawasan = tbl_mast_negara.kode_kawasan where  YEAR(tgl_penyerahan)='$tahun' ";
						
						if ($bulan !='') {	
 						 $sql_total .= "and MONTH(tgl_penyerahan)='$bulan' "; 
									}

					
						$sql_total .= "
						
						) as tot_wni,
						IFNULL((select sum(ekuivalent_rp) from tbl_hak_tki
						LEFT JOIN tbl_kasus_pengaduan ON tbl_kasus_pengaduan.kode_form_pengaduan = tbl_hak_tki.kode_form_pengaduan
						LEFT JOIN  tbl_mast_perwakilan on  tbl_mast_perwakilan.kode_perwakilan =  tbl_kasus_pengaduan.kode_perwakilan
						LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara
						LEFT JOIN tbl_mast_kawasan ON tbl_mast_kawasan.kode_kawasan = tbl_mast_negara.kode_kawasan where YEAR(tgl_penyerahan)='$tahun'";
						
						if ($bulan !='') {	
 						 $sql_total .= "and MONTH(tgl_penyerahan)='$bulan' "; 
									}

					
						$sql_total .= "
						
						
						),0) as tot_ekuivalent from tbl_kasus_pengaduan";
				}

				$numresults3=$db->Execute($sql_total);
				$count3 = $numresults3->RecordCount();
 				$recordSet3 = $db->Execute($sql_total);
				$end3 = $recordSet3->RecordCount();
				$initSet3 = array();
				$data_tb3 = array();
				$row_class3 = array();
				$z=0;
				while ($arr3=$recordSet3->FetchRow()) {
					
					 $tot1="<b>TOTAL : </b>".$arr3[tot_wni];
					  $tot2="<b>TOTAL : </b>".$arr3[tot_ekuivalent];
					 $content_data .= print_content("","",$tot1,$tot2);
				 	 $content_data2 .= print_content("","",$tot1,$tot2);

					
					array_push($data_tb3, $arr3);
					if ($z%2==0){ 
						$ROW_CLASSNAME="#CCCCCC"; }
					else {
						$ROW_CLASSNAME="#EEEEEE";
					   }
			   array_push($row_class3, $ROW_CLASSNAME2);
				 array_push($initSet3, $z);
					$z++;
				}

			  $smarty->assign ("DATA_TB3", $data_tb3);
 
			
			$file= $DIR_HOME."/files/rekap_penyerahan_hak_tki_".$nm_kawasan.".xls";

				$fp=@fopen($file,"w");
				if(!is_resource($fp))
				return false;
				//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
				stream_set_write_buffer($fp, 0);
				
				$content = print_header($nm_kawasan);
				$content .= $content_data;
				$content .= print_header2();
				$content .= $content_data2;
				$content .= print_footer();
				
				fwrite($fp,$content);
				fclose($fp);
				$file_2= $HREF_HOME."/files/rekap_penyerahan_hak_tki_".$nm_kawasan.".xls";		
}

 }


($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;

$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);

$smarty->assign ("SEARCH_YEAR", $Search_Year);
$smarty->assign ("FILES", $file_2);
$smarty->assign ("TITLE", _PRINT_TITLE_JL_01_MAIN);
$smarty->assign ("HEAD_TITLE", _PRINT_HEAD_TITLE_JL_01_MAIN);
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
/*** remark 17-08-2010 
$smarty->assign ("TB_ASPAL", _ASPAL);
$smarty->assign ("TB_PM", _PENETRASI_MACADAM);
$smarty->assign ("TB_TELFORD", _TELFORD);
$smarty->assign ("TB_TANAH", _TANAH);
$smarty->assign ("TB_BLM_TEMBUS", _BELUM_TEMBUS);
***/
$smarty->assign ("TB_TANAH", _TANAH);
$smarty->assign ("TB_KERIKIL", _KERIKIL);
$smarty->assign ("TB_PENETRASI_MACADAM", _PENETRASI_MACADAM);
//$smarty->assign ("TB_HRS", _HRS);
$smarty->assign ("TB_HOT_MIX", _HOT_MIX);
$smarty->assign ("TB_BETON_SEMEN", _BETON_SEMEN);
$smarty->assign ("TB_LAIN_LAIN", _LAIN_LAIN);
$smarty->assign ("TB_KETERANGAN", _KETERANGAN);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _PRINT_LIST_JL_01_MAIN);
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
$smarty->assign ("DATA_PANJANG", $data_panjang);
$smarty->assign ("DATA_LEBAR", $data_lebar);
$smarty->assign ("DATA_TANAH", $data_tanah);
$smarty->assign ("DATA_KERIKIL", $data_kerikil);
$smarty->assign ("DATA_PENETRASI_MACADAM", $data_penetrasi_macadam);
$smarty->assign ("DATA_HOT_MIX", $data_hot_mix);
$smarty->assign ("DATA_BETON_SEMEN", $data_beton_semen);
$smarty->assign ("DATA_LAIN_LAIN", $data_lain_lain);

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