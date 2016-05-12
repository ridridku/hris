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
//require_once($DIR_HOME.'/laporan_excell/inc.jl_01.php');

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/report_laporan/laporan';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/report_laporan');
$FILE_JS  = $JS_MODUL.'/laporan';

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
else $ORDER="a.id_fjl_01_detail";

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

$Search_Year = $_GET[tahun_anggaran];

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

//--------------------------------------
//SHOW DATA INSTANSI
//---------------------------------------

$sql_instansi = "SELECT *  FROM tbl_mast_instansi ";
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





if ($SES_JENIS_USER=='2') {
	
	 
		$sql_proyek = "SELECT * FROM tbl_proyek where tahun_proyek='$SES_TAHUN' and kode_instansi='$SES_INSTANSI'";
		$result_proyek = $db->Execute($sql_proyek);
		$initSet = array();
		$data_proyek = array();
		$z=0;
		while ($arr=$result_proyek->FetchRow()) {
			array_push($data_proyek, $arr);
			array_push($initSet, $z);
			$z++;
		}
		$smarty->assign ("DATA_PROYEK", $data_proyek);

}



if ($_GET[get_tahun] == 1)
{
	$tahun = $_GET[tahun];
	$kode_instansi = $_GET[kode_instansi];

			if($tahun!=''){	
 
				$sql_data_usulan = " SELECT * FROM  tbl_proyek WHERE tahun_proyek ='$tahun' and kode_instansi='$kode_instansi' ";
				$result_data_usulan = $db->execute($sql_data_usulan);
				$total_data_usulan = $result_data_usulan->numrows();
				//echo $sql_data_usulan;
				$data_usulan = "<select id=\"kode_proyek\"  name=\"kode_proyek\" onChange=\"cari_ruas(this.value);\"   style=\"width:200px\" >";
				$data_usulan .= "<option value=\"\"> [Pilih  Proyek] </option >";

				while(!$result_data_usulan ->EOF):
					$data_usulan .= "<option value=".$result_data_usulan->fields['kode_proyek'].">".$result_data_usulan->fields['nama_proyek']."</option>";
					$result_data_usulan->MoveNext();
				endwhile; 	
				 $data_usulan .="</select>";
				$delimeter   = "-";
		 
				 $option_choice = $data_usulan."^/&".$delimeter;	
				echo $option_choice;	
			}
}


if ($_GET[get_info_tahun] == 1)
{
	$tahun = $_GET[tahun];
	$kode_instansi = $_GET[kode_instansi];

			if($tahun!=''){	
 
				$sql_data_usulan = " SELECT * FROM  tbl_proyek WHERE tahun_proyek ='$tahun' and kode_instansi='$kode_instansi' ";
				$result_data_usulan = $db->execute($sql_data_usulan);
				$total_data_usulan = $result_data_usulan->numrows();
				//echo $sql_data_usulan;
				$data_usulan = "<select id=\"kode_proyek\"  name=\"kode_proyek\" onChange=\"cari_ruas(this.value);\"  style=\"width:200px\">";
				$data_usulan .= "<option value=\"\"> [Pilih  Proyek] </option >";

				while(!$result_data_usulan ->EOF):
					$data_usulan .= "<option value=".$result_data_usulan->fields['kode_proyek'].">".$result_data_usulan->fields['nama_proyek']."</option>";
					$result_data_usulan->MoveNext();
				endwhile; 	
				 $data_usulan .="</select>";



				//$sql_data_usulan2="select tbl_mast_wil_propinsi.no_propinsi, tbl_mast_wil_kabupaten.id_kabupaten,nama_kabupaten , kode_instansi from tbl_mast_instansi


				//inner join  tbl_mast_wil_propinsi on tbl_mast_instansi.id_propinsi =  tbl_mast_wil_propinsi.id_propinsi
				//inner join tbl_mast_wil_kabupaten  on  tbl_mast_wil_kabupaten.no_propinsi = tbl_mast_wil_propinsi.no_propinsi where tbl_mast_instansi.kode_instansi='$kode_instansi'";
				//$result_data_usulan2 = $db->execute($sql_data_usulan2);
				 
				//echo $sql_data_usulan;

				//$data_usulan2 = "<select id=\"id_kabupaten\"  name=\"id_kabupaten\"  >";
				//$data_usulan2 .= "<option value=\"\"> [Pilih  Lokasi] </option >";

				//while(!$result_data_usulan2 ->EOF):
				//	$data_usulan2 .= "<option value=".$result_data_usulan2->fields['id_kabupaten'].">".$result_data_usulan2->fields['nama_kabupaten']."</option>";
				//	$result_data_usulan2->MoveNext();
				//endwhile; 	
				 //$data_usulan2 .="</select>";


				$delimeter   = "-";
		 
				 //$option_choice = $data_usulan."^/&".$delimeter;	

				  $option_choice = $data_usulan."^/&".$data_usulan2."^/&".$delimeter;

				echo $option_choice;	
			}
}



//----------Menampilkan Data Ruas---------------------------

if ($_GET[get_proyek] == 1)
{
	$kode_proyek = $_GET[kode_proyek];
			if($kode_proyek!=''){	
					$sql_ruas_combo 	  = " SELECT * FROM tbl_proyek_detail_ruas   WHERE kode_proyek ='$kode_proyek' ORDER BY nama_paket ";
					$result_data_usulan = $db->execute($sql_ruas_combo);
			 
					//echo $sql_data_usulan;
					$data_usulan = "<select id=\"kode_paket\"  name=\"kode_paket\" style=\"width:200px\" >";
					$data_usulan .= "<option value=\"\"> [Pilih  Paket] </option>";

					while(!$result_data_usulan ->EOF):
						$data_usulan .= "<option value=".$result_data_usulan->fields['kode_paket'].">".$result_data_usulan->fields['nama_paket']."</option>";
						$result_data_usulan->MoveNext();
					endwhile; 	
					 $data_usulan .="</select>";
					$delimeter   = "-";
			 
					 $option_choice = $data_usulan."^/&".$delimeter;	
					echo $option_choice;	
			}
}

  			
if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{

				$sql_cari_jadwal="SELECT * FROM tbl_jadwal left join tbl_proyek_detail_ruas on tbl_proyek_detail_ruas.kode_paket = tbl_jadwal.kode_paket
				left JOIN tbl_proyek ON tbl_proyek.kode_proyek = tbl_proyek_detail_ruas.kode_proyek 
				left JOIN tbl_mast_instansi b ON b.kode_instansi = tbl_jadwal.kode_instansi left join tbl_mast_wil_kabupaten on tbl_proyek_detail_ruas.id_kabupaten = tbl_mast_wil_kabupaten.id_kabupaten left join tbl_mast_wil_propinsi on tbl_mast_wil_propinsi.id_propinsi = tbl_mast_wil_kabupaten.id_propinsi
				where tbl_jadwal.kode_paket='$_GET[kode_paket]'";
				$rs_cari=$db->Execute($sql_cari_jadwal);

				 $kode_jadwal = $rs_cari->fields['kode_jadwal']; 
				 $kode_instansi = $rs_cari->fields['kode_instansi']; 
 				 $nama_proyek = $rs_cari->fields['nama_proyek']; 
 				 $nama_paket = $rs_cari->fields['nama_paket']; 
 				 $nama_instansi = $rs_cari->fields['nama_instansi']; 
				 $nama_kabupaten = $rs_cari->fields['nama_kabupaten']; 
				 
				 $smarty->assign ("KODE_JADWAL", $kode_jadwal);
				$smarty->assign ("KODE_INSTANSI", $kode_instansi);
				$smarty->assign ("NAMA_PROYEK", $nama_proyek);
				$smarty->assign ("NAMA_PAKET", $nama_paket);
				$smarty->assign ("NAMA_INSTANSI", $nama_instansi);
				$smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten);

				// echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>".$sql_cari_jadwal;

				$sql = "SELECT * 
				,

				IFNULL((select count(*) from tbl_jadwal_detail_alat where  tbl_jadwal_detail_alat.kode_detail_jadwal =  tbl_jadwal_detail.kode_detail_jadwal ),0)  as jml_jadwal,

				IFNULL((select   sum(jml_pinjam)   from tbl_peminjaman_alat_detail
				inner join tbl_peminjaman_alat 
				on tbl_peminjaman_alat.kode_peminjaman = tbl_peminjaman_alat_detail.kode_peminjaman    where tbl_peminjaman_alat_detail.kode_alat_berat = tbl_jadwal_detail.kode_alat_berat 
				and       tbl_peminjaman_alat.kode_jadwal=tbl_jadwal_detail.kode_jadwal
				),0)  as jml_pinjam ,



				IFNULL((select sum(jumlah)   from

				tbl_sewa_detail
				inner join  tbl_sewa 
				on tbl_sewa.kode_sewa = tbl_sewa_detail.kode_sewa where               

				tbl_sewa_detail.kode_alat_berat = tbl_jadwal_detail.kode_alat_berat 
				and  
				tbl_sewa.kode_jadwal
				=tbl_jadwal_detail.kode_jadwal

				),0) as jml_sewa,


				IFNULL((select   sum(jml_pinjam)   from tbl_peminjaman_alat_detail
				inner join tbl_peminjaman_alat 
				on tbl_peminjaman_alat.kode_peminjaman = tbl_peminjaman_alat_detail.kode_peminjaman where tbl_peminjaman_alat_detail.kode_alat_berat = tbl_jadwal_detail.kode_alat_berat 
				and       tbl_peminjaman_alat.kode_jadwal=tbl_jadwal_detail.kode_jadwal 
				),0) 
				+ 
				IFNULL((select sum(jumlah)   from

				tbl_sewa_detail
				inner join  tbl_sewa 
				on tbl_sewa.kode_sewa = tbl_sewa_detail.kode_sewa where               

				tbl_sewa_detail.kode_alat_berat = tbl_jadwal_detail.kode_alat_berat 
				and  
				tbl_sewa.kode_jadwal
				=tbl_jadwal_detail.kode_jadwal

				) ,0)
				+
				IFNULL((select count(*) from   tbl_jadwal_detail_alat where  tbl_jadwal_detail_alat.kode_detail_jadwal =  tbl_jadwal_detail.kode_detail_jadwal ),0)  
				as total,


				jumlah_kebutuhan
				-
				(IFNULL((select   sum(jml_pinjam)   from tbl_peminjaman_alat_detail
				inner join tbl_peminjaman_alat 
				on tbl_peminjaman_alat.kode_peminjaman = tbl_peminjaman_alat_detail.kode_peminjaman    where tbl_peminjaman_alat_detail.kode_alat_berat = tbl_jadwal_detail.kode_alat_berat 
				and       tbl_peminjaman_alat.kode_jadwal=tbl_jadwal_detail.kode_jadwal
				),0) 
				+ 
				IFNULL((select sum(jumlah)   from

				tbl_sewa_detail
				inner join  tbl_sewa 
				on tbl_sewa.kode_sewa = tbl_sewa_detail.kode_sewa where               

				tbl_sewa_detail.kode_alat_berat = tbl_jadwal_detail.kode_alat_berat 
				and  
				tbl_sewa.kode_jadwal
				=tbl_jadwal_detail.kode_jadwal

				) ,0)
				+
				IFNULL((select count(*) from   tbl_jadwal_detail_alat where  tbl_jadwal_detail_alat.kode_detail_jadwal =  tbl_jadwal_detail.kode_detail_jadwal ),0))
				as status


				,


				
			 
				(IFNULL((select   sum(jml_pinjam)   from tbl_peminjaman_alat_detail
				inner join tbl_peminjaman_alat 
				on tbl_peminjaman_alat.kode_peminjaman = tbl_peminjaman_alat_detail.kode_peminjaman    where tbl_peminjaman_alat_detail.kode_alat_berat = tbl_jadwal_detail.kode_alat_berat 
				and       tbl_peminjaman_alat.kode_jadwal=tbl_jadwal_detail.kode_jadwal
				),0) 
				+ 
				IFNULL((select sum(jumlah)   from

				tbl_sewa_detail
				inner join  tbl_sewa 
				on tbl_sewa.kode_sewa = tbl_sewa_detail.kode_sewa where               

				tbl_sewa_detail.kode_alat_berat = tbl_jadwal_detail.kode_alat_berat 
				and  
				tbl_sewa.kode_jadwal
				=tbl_jadwal_detail.kode_jadwal

				) ,0)
				+
				IFNULL((select count(*) from   tbl_jadwal_detail_alat where  tbl_jadwal_detail_alat.kode_detail_jadwal =  tbl_jadwal_detail.kode_detail_jadwal ),0))
				-
				jumlah_kebutuhan
				as status_




				FROM  tbl_jadwal_detail inner join tbl_mast_alat_berat on tbl_mast_alat_berat.kode_alat_berat =  tbl_jadwal_detail.kode_alat_berat where  kode_jadwal='$kode_jadwal'";
								 
				 
				 
				$numresults=$db->Execute($sql);
				$count = $numresults->RecordCount();
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
 
			

			//echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>".$sql; 

				$sql_detail = "select * from tbl_jadwal_detail_alat inner join tbl_mast_alat_berat_detail on tbl_mast_alat_berat_detail.kode_alat_berat_detail = tbl_jadwal_detail_alat.kode_alat_berat_detail";
				$numresults2=$db->Execute($sql_detail);
				$count2 = $numresults2->RecordCount();
 				$recordSet2 = $db->Execute($sql_detail);
				$end2 = $recordSet2->RecordCount();
				$initSet2 = array();
				$data_tb2 = array();
				$row_class2 = array();
				$z=0;
				while ($arr2=$recordSet2->FetchRow()) {
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


			   $sql_alat_pinjam="select  tbl_peminjaman_alat.* , tbl_peminjaman_alat_detail.kode_alat_berat , tbl_peminjaman_alat_detail_alat.kode_alat_berat_detail , nama_instansi as instansi_dipinjam , nama_alat_detail from tbl_peminjaman_alat_detail_alat inner join tbl_peminjaman_alat_detail 
				on tbl_peminjaman_alat_detail_alat.kode_detail_peminjaman = tbl_peminjaman_alat_detail.kode_detail_peminjaman inner join tbl_peminjaman_alat 
				on tbl_peminjaman_alat.kode_peminjaman = tbl_peminjaman_alat_detail.kode_peminjaman 
				inner join  tbl_mast_instansi on tbl_mast_instansi.kode_instansi = kode_instansi_yng_dipinjam
				inner join tbl_mast_alat_berat_detail on tbl_mast_alat_berat_detail.kode_alat_berat_detail  =  tbl_peminjaman_alat_detail_alat.kode_alat_berat_detail
				and tbl_mast_alat_berat_detail.kode_instansi = tbl_peminjaman_alat.kode_instansi_yng_dipinjam 
				where status_app=1 and kode_jadwal='$kode_jadwal' ";

				$numresults3=$db->Execute($sql_alat_pinjam);
				$count3 = $numresults3->RecordCount();
 				$recordSet3 = $db->Execute($sql_alat_pinjam);
				$end3 = $recordSet3->RecordCount();
				$initSet3 = array();
				$data_tb3 = array();
				$row_class3 = array();
				$z=0;
				while ($arr3=$recordSet3->FetchRow()) {
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

			
			$sql_minta="select tbl_penerimaan_permintaan.* , tbl_penerimaan_permintaan_detail.kode_alat_berat_detail , nama_alat_detail ,kode_alat_berat ,tbl_permintaan.kode_instansi ,kode_paket    from tbl_penerimaan_permintaan inner join tbl_penerimaan_permintaan_detail on tbl_penerimaan_permintaan_detail.kode_penerimaan = tbl_penerimaan_permintaan.kode_penerimaan inner join tbl_permintaan on tbl_permintaan.kode_permintaan = tbl_penerimaan_permintaan.kode_permintaan inner join tbl_mast_alat_berat_detail on tbl_mast_alat_berat_detail.kode_alat_berat_detail = tbl_penerimaan_permintaan_detail.kode_alat_berat_detail and tbl_permintaan.kode_instansi   = tbl_mast_alat_berat_detail.kode_instansi  where kode_paket ='$_GET[kode_paket]'"; 

				$numresults4=$db->Execute($sql_minta);
				$count4 = $numresults4->RecordCount();
 				$recordSet4 = $db->Execute($sql_minta);
				$end4 = $recordSet4->RecordCount();
				$initSet4 = array();
				$data_tb4 = array();
				$row_class4 = array();
				$z=0;
				while ($arr4=$recordSet4->FetchRow()) {
					array_push($data_tb4, $arr4);
					if ($z%2==0){ 
						$ROW_CLASSNAME4="#CCCCCC"; }
					else {
						$ROW_CLASSNAME4="#EEEEEE";
					   }
			   array_push($row_class4, $ROW_CLASSNAME4);
				 array_push($initSet4, $z);
					$z++;
				}

			  $smarty->assign ("DATA_TB4", $data_tb4);



				$sql_sewa="  select * from tbl_sewa inner join tbl_sewa_detail on  tbl_sewa.kode_sewa = tbl_sewa_detail.kode_sewa inner join tbl_mast_tempat_sewa on
				tbl_mast_tempat_sewa.kode_tempat_sewa = tbl_sewa.kode_tempat_sewa where kode_jadwal ='$kode_jadwal'"; 

				$numresults5=$db->Execute($sql_sewa);
				$count5 = $numresults5->RecordCount();
 				$recordSet5 = $db->Execute($sql_sewa);
				$end5 = $recordSet5->RecordCount();
				$initSet5 = array();
				$data_tb5 = array();
				$row_class5 = array();
				$z=0;
				while ($arr5=$recordSet5->FetchRow()) {
					array_push($data_tb5, $arr5);
					if ($z%2==0){ 
						$ROW_CLASSNAME5="#CCCCCC"; }
					else {
						$ROW_CLASSNAME5="#EEEEEE";
					   }
			   array_push($row_class5, $ROW_CLASSNAME5);
				 array_push($initSet5, $z);
					$z++;
				}

			  $smarty->assign ("DATA_TB5", $data_tb5);


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