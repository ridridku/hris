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

#FOR IMAGES CLASS PAGERr
$HREF_IMAGES = $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images');

# including Header file for Content Expiring
require_once($DIR_INC.'/header.exp.inc');
# including Header file for Database Configuration
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');
 require_once($DIR_HOME.'/laporan/inc.rekap_kasus.php'); 

$p = new Pager; 
$db = &ADONewConnection($DB_TYPE);
 //  $db->debug = true;
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/pelaporan/rekap_kasus';
 
#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/pelaporan');
$FILE_JS  = $JS_MODUL.'/rekap_kasus';

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

if ($_GET['kode_perwakilan']) $kode_perwakilan = $_GET['kode_perwakilan'];
else if ($_POST['kode_perwakilan']) $kode_perwakilan = $_POST['kode_perwakilan'];
else $kode_perwakilan="";

if ($_GET['bulan']) $bulan = $_GET['bulan'];
else if ($_POST['bulan']) $bulan = $_POST['bulan'];
else $bulan="";

if ($_GET['tahun']) $tahun = $_GET['tahun'];
else if ($_POST['tahun']) $tahun = $_POST['tahun'];
else $tahun="";

if ($_GET['kode_kasus']) $kode_kasus = $_GET['kode_kasus'];
else if ($_POST['kode_kasus']) $kode_kasus = $_POST['kode_kasus'];
else $kode_kasus="";
 

if ($_GET['kode_kawasan']) $kode_kawasan = $_GET['kode_kawasan'];
else if ($_POST['kode_kawasan']) $kode_kawasan = $_POST['kode_kawasan'];
else $kode_kawasan="";


if ($_GET['kode_negara']) $kode_negara = $_GET['kode_negara'];
else if ($_POST['kode_negara']) $kode_negara = $_POST['kode_negara'];
else $kode_negara="";

 if ($_GET['kode_tampil']) $kode_tampil = $_GET['kode_tampil'];
else if ($_POST['kode_tampil']) $kode_tampil = $_POST['kode_tampil'];
else $kode_tampil="";

if ($_GET['usia']) $usia = $_GET['usia'];
else if ($_POST['usia']) $usia = $_POST['usia'];
else $usia="";

if ($_GET['jk']) $jk = $_GET['jk'];
else if ($_POST['jk']) $jk = $_POST['jk'];
else $jk="";


if ($_GET['search']) $search = $_GET['search'];
else if ($_POST['search']) $search = $_POST['search'];
else $search="";
 

 if ($_GET['kode_klasifikasi_wni']) $kode_klasifikasi_wni = $_GET['kode_klasifikasi_wni'];
else if ($_POST['kode_klasifikasi_wni']) $kode_klasifikasi_wni = $_POST['kode_klasifikasi_wni'];
else $kode_klasifikasi_wni="";
 

if ($_GET['kode_sektor']) $kode_sektor = $_GET['kode_sektor'];
else if ($_POST['kode_sektor']) $kode_sektor = $_POST['kode_sektor'];
else $kode_sektor="";
 

 if ($_GET['kode_jenis']) $kode_jenis = $_GET['kode_jenis'];
else if ($_POST['kode_jenis']) $kode_jenis = $_POST['kode_jenis'];
else $kode_jenis="";
 



 
$var_cari="kode_kawasan=".$kode_kawasan."&bulan=".$bulan."&tahun=".$tahun."&kode_kasus=".$kode_kasus;
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

$sql_instansi = "SELECT *  FROM tbl_mast_kasus  order by nama_kasus asc  ";
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
 


$sql_instansi2 = "SELECT *  FROM tbl_mast_kawasan order by nama_kawasan ";
$result_instansi2 = $db->Execute($sql_instansi2);
$initSet = array();
$data_instansi2 = array();
$z=0;
while ($arr=$result_instansi2->FetchRow()) {
	array_push($data_instansi2, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_INSTANSI2", $data_instansi2);



$sql_instansi3 = "SELECT *  FROM tbl_mast_negara order by nama_negara ";
$result_instansi3 = $db->Execute($sql_instansi3);
$initSet = array();
$data_instansi3 = array();
$z=0;
while ($arr=$result_instansi3->FetchRow()) {
	array_push($data_instansi3, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_INSTANSI3", $data_instansi3);




if ($_GET[get_prop] == 1)
{
	$no_propinsi = $_GET[no_prop];
			if($no_propinsi=='1'){	
				 
					$input_kab="<select name=\"kode_kawasan\" style=\"width:200px\" disabled>";
					$input_kab.="<option value=>[Pilih Kawasan] ";
					$input_kab.="</option> ";					 
					$input_kab.="</select> ";

					$input_kab2="<select name=\"kode_negara\" style=\"width:200px\" disabled>";
					$input_kab2.="<option value=>[Pilih Negara] ";
					$input_kab2.="</option> ";					 
					$input_kab2.="</select> ";
  
					$delimeter   = "-";
					$option_choice = $input_kab."^/&".$input_kab2."^/&".$delimeter;	
					echo $option_choice;
			}

		 if($no_propinsi=='2'){	
				 
					$sql_kabupaten = "SELECT * from tbl_mast_kawasan    ORDER BY nama_kawasan ASC";
					$recordSet_kabupaten = $db->Execute($sql_kabupaten);
					//print $sql_kabupaten;
					$input_kab="<select name=\"kode_kawasan\" style=\"width:200px\"  >";
					$input_kab.="<option value=>[Pilih Kawasan] ";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF): 
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields['kode_kawasan'].">".$recordSet_kabupaten->fields['nama_kawasan'];   
						$input_kab.="</option>";
					$recordSet_kabupaten->MoveNext();
					endwhile; 
					$input_kab.="</select> ";

					$input_kab2="<select name=\"kode_negara\" style=\"width:200px\" disabled>";
					$input_kab2.="<option value=>[Pilih Negara] ";
					$input_kab2.="</option> ";					 
					$input_kab2.="</select> ";
  
					$delimeter   = "-";
					$option_choice = $input_kab."^/&".$input_kab2."^/&".$delimeter;	
					echo $option_choice;
			}

			if($no_propinsi=='3'){	
				 
					$sql_kabupaten = "SELECT * from tbl_mast_kawasan    ORDER BY nama_kawasan ASC";
					$recordSet_kabupaten = $db->Execute($sql_kabupaten);
					//print $sql_kabupaten;
					$input_kab="<select name=\"kode_kawasan\" style=\"width:200px\"   onchange=\"cari_negara(this.value);\" >";
					$input_kab.="<option value=>[Pilih Kawasan] ";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF): 
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields['kode_kawasan'].">".$recordSet_kabupaten->fields['nama_kawasan'];   
						$input_kab.="</option>";
					$recordSet_kabupaten->MoveNext();
					endwhile; 
					$input_kab.="</select> ";
					
					$sql_kabupaten2 = "SELECT * from tbl_mast_negara ORDER BY nama_negara ASC";
					$recordSet_kabupaten2 = $db->Execute($sql_kabupaten2);

					$input_kab2="<select name=\"kode_negara\" style=\"width:200px\"  >";
					$input_kab2.="<option value=>[Pilih Negara] ";
					$input_kab2.="</option> ";	
					
					while(!$recordSet_kabupaten2->EOF): 
						$input_kab2.="<option value=";
						$input_kab2.= $recordSet_kabupaten2->fields['kode_negara'].">".$recordSet_kabupaten2->fields['nama_negara'];   
						$input_kab2.="</option>";
					$recordSet_kabupaten2->MoveNext();
					endwhile; 


					$input_kab2.="</select> ";
  
					$delimeter   = "-";
					$option_choice = $input_kab."^/&".$input_kab2."^/&".$delimeter;	
					echo $option_choice;
			}




}




if ($_GET[get_negara] == 1)
{
	$no_propinsi = $_GET[no_prop];
			 
 

			if($no_propinsi!=''){	
				  
					
					$sql_kabupaten2 = "SELECT * from tbl_mast_negara where kode_kawasan='$no_propinsi' ORDER BY nama_negara ASC";
					$recordSet_kabupaten2 = $db->Execute($sql_kabupaten2);

					$input_kab2="<select name=\"kode_negara\" style=\"width:200px\"   >";
					$input_kab2.="<option value=>[Pilih Negara] ";
					$input_kab2.="</option> ";	
					
					while(!$recordSet_kabupaten2->EOF): 
						$input_kab2.="<option value=";
						$input_kab2.= $recordSet_kabupaten2->fields['kode_negara'].">".$recordSet_kabupaten2->fields['nama_negara'];   
						$input_kab2.="</option>";
					$recordSet_kabupaten2->MoveNext();
					endwhile; 


					$input_kab2.="</select> ";
  
					$delimeter   = "-";
					$option_choice = $input_kab2."^/&". $delimeter;	
					echo $option_choice;
			}




}


 if ($_GET[get_jenis] == 1)
{
			$kode_sumber = $_GET[no_prop];

			if($kode_sumber=='1'){ // NON TKI
				 
				 
				 
					$input_kab="<select name=kode_sektor disabled>";
					$input_kab.="<option value=>[Pilih Sektor Pekerjaan] ";
					$input_kab.="</option> ";					 
					$input_kab.="</select> ";
					 

					$sql_kecamatan = "SELECT * from tbl_mast_jenis_wni ORDER BY nama_jenis_wni ASC";
					$recordSet_kecamatan = $db->Execute($sql_kecamatan); 
					//print $sql_kecamatan;
					$input_kec="<select name=kode_jenis >";
					$input_kec.="<option value=>[Pilih Jenis WNI Non TKI] ";
					$input_kec.="</option> ";
					while(!$recordSet_kecamatan->EOF): 
						$input_kec.="<option value=";
						$input_kec.= $recordSet_kecamatan->fields['kode_jenis_wni'].">".$recordSet_kecamatan->fields['nama_jenis_wni'];   
						$input_kec.="</option>";
					$recordSet_kecamatan->MoveNext();
					endwhile; 
					$input_kec.="</select> ";



					$delimeter   = "-";
					$option_choice = $input_kab."^/&".$input_kec."^/&".$delimeter;	
					echo $option_choice;


			}


			if($kode_sumber=='4'){ //INFORMAL
				 
				 
				 
					$input_kab="<select name=kode_sektor disabled>";
					$input_kab.="<option value=>[Pilih Sektor Pekerjaan] ";
					$input_kab.="</option> ";					 
					$input_kab.="</select> ";
					 

					 $sql_kecamatan = "SELECT * from tbl_mast_jenis_informal ORDER BY nama_informal  ASC";
					$recordSet_kecamatan = $db->Execute($sql_kecamatan); 
					//print $sql_kecamatan;
					$input_kec="<select name=kode_jenis >";
					$input_kec.="<option value=>[Pilih Jenis TKI Informal] ";
					$input_kec.="</option> ";
					while(!$recordSet_kecamatan->EOF): 
						$input_kec.="<option value=";
						$input_kec.= $recordSet_kecamatan->fields['kode_jenis_informal'].">".$recordSet_kecamatan->fields['nama_informal'];   
						$input_kec.="</option>";
					$recordSet_kecamatan->MoveNext();
					endwhile; 
					$input_kec.="</select> ";



					$delimeter   = "-";
					$option_choice = $input_kab."^/&".$input_kec."^/&".$delimeter;	
					echo $option_choice;


			}


			if($kode_sumber=='6'){ //ABK
				 
				 
				 
					$input_kab="<select name=kode_sektor disabled>";
					$input_kab.="<option value=>[Pilih Sektor Pekerjaan] ";
					$input_kab.="</option> ";					 
					$input_kab.="</select> ";
					 

					 $sql_kecamatan = "SELECT * from tbl_mast_jenis_abk ORDER BY nama_abk  ASC";
					$recordSet_kecamatan = $db->Execute($sql_kecamatan); 
					//print $sql_kecamatan;
					$input_kec="<select name=kode_jenis >";
					$input_kec.="<option value=>[Pilih Jenis TKI ABK] ";
					$input_kec.="</option> ";
					while(!$recordSet_kecamatan->EOF): 
						$input_kec.="<option value=";
						$input_kec.= $recordSet_kecamatan->fields['kode_jenis_abk'].">".$recordSet_kecamatan->fields['nama_abk'];   
						$input_kec.="</option>";
					$recordSet_kecamatan->MoveNext();
					endwhile; 
					$input_kec.="</select> ";



					$delimeter   = "-";
					$option_choice = $input_kab."^/&".$input_kec."^/&".$delimeter;	
					echo $option_choice;


			}



			if($kode_sumber=='3'){ //TKI FORMAL
				 
			 

					$sql_kecamatan2 = "SELECT * from tbl_mast_sektor ORDER BY nama_sektor ASC";
					$recordSet_kecamatan2 = $db->Execute($sql_kecamatan2); 
					//print $sql_kecamatan;
					$input_kab="<select name=kode_sektor onchange=\"cari_jenis2(this.value);\"  >";
					$input_kab.="<option value=>[Pilih Sektor Pekerjaan] ";
					$input_kab.="</option> ";
					while(!$recordSet_kecamatan2->EOF): 
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kecamatan2->fields['kode_sektor'].">".$recordSet_kecamatan2->fields['nama_sektor'];   
						$input_kab.="</option>";
					$recordSet_kecamatan2->MoveNext();
					endwhile; 
					$input_kab.="</select> ";




					$sql_kecamatan = "SELECT * from tbl_mast_jenis_formal ORDER BY nama_formal  ASC";
					$recordSet_kecamatan = $db->Execute($sql_kecamatan); 
					//print $sql_kecamatan;
					$input_kec="<select name=kode_jenis>";
					$input_kec.="<option value=>[Pilih Jenis TKI Formal] ";
					$input_kec.="</option> ";
					while(!$recordSet_kecamatan->EOF): 
						$input_kec.="<option value=";
						$input_kec.= $recordSet_kecamatan->fields['kode_jenis_formal'].">".$recordSet_kecamatan->fields['nama_formal'];   
						$input_kec.="</option>";
					$recordSet_kecamatan->MoveNext();
					endwhile; 
					$input_kec.="</select> ";



					$delimeter   = "-";
					$option_choice = $input_kab."^/&".$input_kec."^/&".$delimeter;	
					echo $option_choice;


			}
  
}

if ($_GET[get_jenis_sektor] == 1)
{
			$no_propinsi = $_GET[no_prop];
			if($no_propinsi!=''){	
					$sql_kabupaten = "SELECT * from tbl_mast_jenis_formal  WHERE kode_sektor='".$no_propinsi."' ORDER BY nama_formal ASC";
					$recordSet_kabupaten = $db->Execute($sql_kabupaten);
					//print $sql_kabupaten;
					$input_kab="<select name=kode_jenis >";
					$input_kab.="<option value=>[Pilih Jenis TKI Formal] ";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF): 
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields['kode_jenis_formal'].">".$recordSet_kabupaten->fields['nama_formal'];   
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


  			
if ($_GET['tahun'] != '')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
		 

				$sql__="select * , upper(nama_kawasan) as nama_kawasan from tbl_mast_kawasan where kode_kawasan='$_GET[kode_kawasan]' ";
				$rs__=$db->Execute($sql__);			  
				 $nm_kawasan = $rs__->fields['nama_kawasan']; 				 
				 $smarty->assign ("NM_KAWASAN", $nm_kawasan); 


				$sql__="select * , upper(nama_kasus) as nama_kasus from tbl_mast_kasus where kode_kasus='$kode_kasus' ";
				$rs__=$db->Execute($sql__);			  
				 $nama_kasus = $rs__->fields['nama_kasus']; 				 
				 $smarty->assign ("NAMA_KASUS", $nama_kasus); 
				 $smarty->assign ("KODE_KASUS", $kode_kasus); 

if ($kode_kasus =='') { 
				if ($bulan =='') {	

					
						$sql_detail = " select kode_perwakilan, nm_perwakilan, (select count(*) from tbl_kasus_pengaduan
						inner join tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
						left join tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara

						inner join  tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan 
						inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus 
 
						where tbl_kasus_pengaduan.kode_perwakilan =a.kode_perwakilan   and year(tgl_pengaduan)='$tahun'   
						) as orang , 
						 IFNULL((select sum(status_selesai) 
						from  v_kasus_rekap where v_kasus_rekap.kode_perwakilan = a.kode_perwakilan
						and   v_kasus_rekap.thn_pengaduan = '$tahun'  
						 ),0) jml_status_selesai , IFNULL(
						( (select count(*) from tbl_kasus_pengaduan
						inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
						left join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara 
 inner join  tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan 
 	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus 


						where tbl_kasus_pengaduan.kode_perwakilan =a.kode_perwakilan   and year(tgl_pengaduan)='$tahun'     
						)   	-   	(select sum(status_selesai) 
						from  v_kasus_rekap where v_kasus_rekap.kode_perwakilan = a.kode_perwakilan
						and   v_kasus_rekap.thn_pengaduan = '$tahun'  
						 )),0) as jml_selisih



						from tbl_mast_perwakilan as a   LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = a.kode_negara  where 1=1 ";

						if ($kode_kawasan !='') {
							$sql_detail.= "  and tbl_mast_negara.kode_kawasan='$kode_kawasan'  "; 
						}
						$sql_detail.= " order by nm_perwakilan ";


				} else 	if ($bulan !='') {	

					$sql_detail = " select kode_perwakilan, nm_perwakilan,  (select count(*) from tbl_kasus_pengaduan
							inner join tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
							left join tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara

						 inner join  tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan 
						 	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus 
	 
							where tbl_kasus_pengaduan.kode_perwakilan =a.kode_perwakilan   and year(tgl_pengaduan)='$tahun'  and month(tgl_pengaduan)='$bulan'  
							) as orang , 
	  IFNULL((select sum(status_selesai) 
							from  v_kasus_rekap where v_kasus_rekap.kode_perwakilan = a.kode_perwakilan
							and   v_kasus_rekap.thn_pengaduan = '$tahun' and v_kasus_rekap.bln_pengaduan = '$bulan'  
							 ),0) jml_status_selesai ,  						 IFNULL(
							( (select count(*) from tbl_kasus_pengaduan
							inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
							left join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara 
	 inner join  tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan 
	 	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus 


							where tbl_kasus_pengaduan.kode_perwakilan =a.kode_perwakilan   and month(tgl_pengaduan)='$bulan'    and year(tgl_pengaduan)='$tahun'   
							)   	-   	(select sum(status_selesai) 
							from  v_kasus_rekap where v_kasus_rekap.kode_perwakilan = a.kode_perwakilan
							and   v_kasus_rekap.thn_pengaduan = '$tahun' 	and   v_kasus_rekap.bln_pengaduan = '$bulan'  
							 )),0) as jml_selisih



							from tbl_mast_perwakilan as a   LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = a.kode_negara  where 1=1 ";

						if ($kode_kawasan !='') {
							$sql_detail.= " and  tbl_mast_negara.kode_kawasan='$kode_kawasan'  "; 
						}
							$sql_detail.= " order by nm_perwakilan ";

						

										 
				}

} else {
		// ADA PILIHAN JENIS KASUSNYA

		if ($bulan =='') {	

					  
						$sql_detail = " select kode_perwakilan, nm_perwakilan,  (select count(*) from tbl_kasus_pengaduan
						inner join tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
						left join tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara

					 inner join  tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan 
					  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus 
 
						where tbl_kasus_pengaduan.kode_perwakilan =a.kode_perwakilan   and year(tgl_pengaduan)='$tahun'  and tbl_kasus_pengaduan_detail.kode_kasus='$kode_kasus'
						) as orang , 
  IFNULL((select sum(status_selesai) 
						from  v_kasus_rekap where v_kasus_rekap.kode_perwakilan = a.kode_perwakilan
						and   v_kasus_rekap.thn_pengaduan = '$tahun' and v_kasus_rekap.kode_kasus='$kode_kasus'
						 ),0) jml_status_selesai ,  						 IFNULL(
						( (select count(*) from tbl_kasus_pengaduan
						inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
						left join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara 
 inner join  tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan 
  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus 


						where tbl_kasus_pengaduan.kode_perwakilan =a.kode_perwakilan   and year(tgl_pengaduan)='$tahun'    and tbl_kasus_pengaduan_detail.kode_kasus='$kode_kasus'
						)   	-   	(select sum(status_selesai) 
						from  v_kasus_rekap where v_kasus_rekap.kode_perwakilan = a.kode_perwakilan
						and   v_kasus_rekap.thn_pengaduan = '$tahun' and  v_kasus_rekap.kode_kasus='$kode_kasus'
						 )),0) as jml_selisih



						from tbl_mast_perwakilan as a   LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = a.kode_negara  where 1=1 ";

						if ($kode_kawasan !='') {
							$sql_detail.= " and  tbl_mast_negara.kode_kawasan='$kode_kawasan'  "; 
						}
						$sql_detail.= " order by nm_perwakilan ";



				} else 	if ($bulan !='') {	
  
							$sql_detail = " select kode_perwakilan, nm_perwakilan,  (select count(*) from tbl_kasus_pengaduan
							inner join tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
							left join tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara

						 inner join  tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan 
						  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus 
	 
							where tbl_kasus_pengaduan.kode_perwakilan =a.kode_perwakilan   and year(tgl_pengaduan)='$tahun'  and month(tgl_pengaduan)='$bulan' and tbl_kasus_pengaduan_detail.kode_kasus='$kode_kasus'
							) as orang , 
	  IFNULL((select sum(status_selesai) 
							from  v_kasus_rekap where v_kasus_rekap.kode_perwakilan = a.kode_perwakilan
							and   v_kasus_rekap.thn_pengaduan = '$tahun' and v_kasus_rekap.bln_pengaduan = '$bulan'  and v_kasus_rekap.kode_kasus='$kode_kasus'
							 ),0) jml_status_selesai ,  						 IFNULL(
							( (select count(*) from tbl_kasus_pengaduan
							inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
							left join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara 
	 inner join  tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan 
	  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus 


							where tbl_kasus_pengaduan.kode_perwakilan =a.kode_perwakilan   and month(tgl_pengaduan)='$bulan'    and year(tgl_pengaduan)='$tahun'    and tbl_kasus_pengaduan_detail.kode_kasus='$kode_kasus'
							)   	-   	(select sum(status_selesai) 
							from  v_kasus_rekap where v_kasus_rekap.kode_perwakilan = a.kode_perwakilan
							and   v_kasus_rekap.thn_pengaduan = '$tahun' 	and   v_kasus_rekap.bln_pengaduan = '$bulan'  and  v_kasus_rekap.kode_kasus='$kode_kasus'
							 )),0) as jml_selisih



							from tbl_mast_perwakilan as a   LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = a.kode_negara  where 1=1 ";

						if ($kode_kawasan !='') {
							$sql_detail.= "  and tbl_mast_negara.kode_kawasan='$kode_kawasan'  "; 
						}
							$sql_detail.= " order by nm_perwakilan ";






				}



			


}
												if ($bulan=='1') { $nama_bulan='Januari';  }
												if ($bulan=='2') { $nama_bulan='Februari';  }
												if ($bulan=='3') { $nama_bulan='Maret';  }
												if ($bulan=='4') { $nama_bulan='April';  }
												if ($bulan=='5') { $nama_bulan='Mei';  }
												if ($bulan=='6') { $nama_bulan='Juni';  }
												if ($bulan=='7') { $nama_bulan='Juli';  }
												if ($bulan=='8') { $nama_bulan='Agustus';  }
												if ($bulan=='9') { $nama_bulan='September';  }
												if ($bulan=='10') { $nama_bulan='Oktober';  }
												if ($bulan=='11') { $nama_bulan='November';  }
												if ($bulan=='12') { $nama_bulan='Desember';  }
								
								$label="BULAN ".$nama_bulan;


//echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>".$sql_detail;
				$numresults2=$db->Execute($sql_detail);
				$count2 = $numresults2->RecordCount();
 				$recordSet2 = $db->Execute($sql_detail);
				$end2 = $recordSet2->RecordCount();
				
				 $jml = $recordSet2->fields['orang']; 
				$initSet2 = array();
				$data_tb2 = array();
				$row_class2 = array();
				$z=0;
				while ($arr2=$recordSet2->FetchRow()) {
					
					$content_data .= print_content($z+1,$arr2[nm_perwakilan],$arr2[orang],$arr2[jml_status_selesai],$arr2[jml_selisih]);
					
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




 if ($kode_kasus=='') { 
					if ($bulan =='') {	
						
						$sql3="select count(*) as tot_jm_kasus from tbl_kasus_pengaduan  inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan inner join tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus 
						
						 inner join tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan
						 left  JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara
						 
						 where year(tgl_pengaduan)='$tahun' ";

						if ($kode_kawasan !='') {
							$sql3.= "  and tbl_mast_negara.kode_kawasan='$kode_kawasan'  "; 
						}


						$rs_3 = $db->Execute($sql3);
						$tot_jm_kasus = $rs_3->fields[tot_jm_kasus];
						
	 					$lbl1="<b>TOTAL :</b>".$tot_jm_kasus;
	 

						$sql4="select sum(status_selesai)as jml_status_selesai  from  v_kasus_rekap   inner join tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = v_kasus_rekap.kode_perwakilan
						  left  JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara where  
						  v_kasus_rekap.thn_pengaduan = '$tahun' ";
						   if ($kode_kawasan !='') {
							$sql4.= "  and tbl_mast_negara.kode_kawasan='$kode_kawasan'  "; 
						}

						$rs_4 = $db->Execute($sql4);

						$jml_status_selesai = $rs_4->fields[jml_status_selesai];
		 
						$jml_kasus_proses=$tot_jm_kasus - $jml_status_selesai ;
						
						 $lbl2="<b>TOTAL :</b>".$jml_status_selesai;
						
						$lbl3="<b>TOTAL :</b>".$jml_kasus_proses;
							  $content_data .= print_content("","",$lbl1,$lbl2,$lbl3);
					 
				} else 	if ($bulan !='') {	
						
						$sql3="select count(*) as tot_jm_kasus from tbl_kasus_pengaduan  inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus   inner join tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan
						 left  JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara   where    year(tgl_pengaduan)='$tahun'  and month(tgl_pengaduan)='$bulan' ";

						 if ($kode_kawasan !='') {
							$sql3.= "  and tbl_mast_negara.kode_kawasan='$kode_kawasan'  "; 
						}

						$rs_3 = $db->Execute($sql3);
						$tot_jm_kasus = $rs_3->fields[tot_jm_kasus];
			
						$lbl1="<b>TOTAL :</b>".$tot_jm_kasus;
	

						$sql4= "select sum(status_selesai)as jml_status_selesai from  v_kasus_rekap   inner join tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = v_kasus_rekap.kode_perwakilan
						  left  JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara where v_kasus_rekap.thn_pengaduan = '$tahun'  and  v_kasus_rekap.bln_pengaduan ='$bulan' ";
						   if ($kode_kawasan !='') {
							$sql4.= "  and tbl_mast_negara.kode_kawasan='$kode_kawasan'  "; 
						}

						$rs_4 = $db->Execute($sql4);
						$jml_status_selesai = $rs_4->fields[jml_status_selesai];
		 
						$jml_kasus_proses=$tot_jm_kasus - $jml_status_selesai ;
						
						
						$lbl2="<b>TOTAL :</b>".$jml_status_selesai;
						
						$lbl3="<b>TOTAL :</b>".$jml_kasus_proses;
						  $content_data .= print_content("","",$lbl1,$lbl2,$lbl3);

				}

 } else {

if ($bulan =='') {	
						
						$sql3="select count(*) as tot_jm_kasus from tbl_kasus_pengaduan  inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus   inner join tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan
						 left  JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara where    year(tgl_pengaduan)='$tahun'  and tbl_kasus_pengaduan_detail.kode_kasus='$kode_kasus' ";

						 if ($kode_kawasan !='') {
							$sql3.= "  and tbl_mast_negara.kode_kawasan='$kode_kawasan'  "; 
						}

						$rs_3 = $db->Execute($sql3);
						$tot_jm_kasus = $rs_3->fields[tot_jm_kasus];
						
	 					$lbl1="<b>TOTAL :</b>".$tot_jm_kasus;
	 

						$sql4="select sum(status_selesai)as jml_status_selesai  from  v_kasus_rekap  		
						  inner join tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = v_kasus_rekap.kode_perwakilan
						  left  JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara  where  
						  v_kasus_rekap.thn_pengaduan = '$tahun'  and v_kasus_rekap.kode_kasus='$kode_kasus'  ";
						  if ($kode_kawasan !='') {
							$sql4.= "  and tbl_mast_negara.kode_kawasan='$kode_kawasan'  "; 
						}


						$rs_4 = $db->Execute($sql4);

						$jml_status_selesai = $rs_4->fields[jml_status_selesai];
		 
						$jml_kasus_proses=$tot_jm_kasus - $jml_status_selesai ;
						
						 $lbl2="<b>TOTAL :</b>".$jml_status_selesai;
						
						$lbl3="<b>TOTAL :</b>".$jml_kasus_proses;
							  $content_data .= print_content("","",$lbl1,$lbl2,$lbl3);
					 
				} else 	if ($bulan !='') {	
						
						$sql3="select count(*) as tot_jm_kasus from tbl_kasus_pengaduan  inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus   inner join tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan
						 left  JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara where    year(tgl_pengaduan)='$tahun'  and month(tgl_pengaduan)='$bulan'  and tbl_kasus_pengaduan_detail.kode_kasus='$kode_kasus' ";

						 if ($kode_kawasan !='') {
							$sql3.= "  and tbl_mast_negara.kode_kawasan='$kode_kawasan'  "; 
						}

						$rs_3 = $db->Execute($sql3);
						$tot_jm_kasus = $rs_3->fields[tot_jm_kasus];
			
					$lbl1="<b>TOTAL :</b>".$tot_jm_kasus;
	 
						$sql4="select sum(status_selesai)as jml_status_selesai  from  v_kasus_rekap   inner join tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = v_kasus_rekap.kode_perwakilan
						  left  JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara where  
						  v_kasus_rekap.thn_pengaduan = '$tahun'  and v_kasus_rekap.kode_kasus='$kode_kasus'  and v_kasus_rekap.bln_pengaduan = '$bulan'  ";
						   if ($kode_kawasan !='') {
							$sql4.= "  and tbl_mast_negara.kode_kawasan='$kode_kawasan'  "; 
						}

						$rs_4 = $db->Execute($sql4);


						$rs_4 = $db->Execute($sql4);
						$jml_status_selesai = $rs_4->fields[jml_status_selesai];
		 
						$jml_kasus_proses=$tot_jm_kasus - $jml_status_selesai ;
						
						
						$lbl2="<b>TOTAL :</b>".$jml_status_selesai;
						
						$lbl3="<b>TOTAL :</b>".$jml_kasus_proses;
						  $content_data .= print_content("","",$lbl1,$lbl2,$lbl3);

				}

 }
						$smarty->assign ("TOT_JM_KASUS", $tot_jm_kasus);
						$smarty->assign ("JML_STATUS_SELESAI", $jml_status_selesai);
						$smarty->assign ("JML_KASUS_PROSES", $jml_kasus_proses);

 

if ($kode_kasus !='') { 

			if ($bulan !='') {	
			 

					 $sql_kawasan= "select kode_kawasan, nama_kawasan , (select count(*) from tbl_kasus_pengaduan
					inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
					left  join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara 
					inner  JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan
					inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan 	
					 	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus 
					where tbl_mast_kawasan.kode_kawasan  =a.kode_kawasan   and year(tgl_pengaduan)='$tahun' and month(tgl_pengaduan)='$bulan'  and  tbl_kasus_pengaduan_detail.kode_kasus='$kode_kasus'
					) as  orang from tbl_mast_kawasan as a  where 1=1 " ;

					 
						if ($kode_kawasan !='') {
							$sql_kawasan.= " and   a.kode_kawasan='$kode_kawasan'  "; 
						}

			 
					$sql7="select count(*) as tot_jm_kawasan  from tbl_kasus_pengaduan
					inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
					left join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara 
					inner  JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan
					inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan
					 	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus 
						where    year(tgl_pengaduan)='$tahun' and month(tgl_pengaduan)='$bulan'  and  tbl_kasus_pengaduan_detail.kode_kasus='$kode_kasus'  ";

						if ($kode_kawasan !='') {
							$sql7.= " and    tbl_mast_kawasan.kode_kawasan='$kode_kawasan'  "; 
						}



					$rs_7 = $db->Execute($sql7);
					$tot_jm_kawasan = $rs_7->fields[tot_jm_kawasan];
					
				
				}

			if ($bulan =='') {
			 
					 $sql_kawasan= "select kode_kawasan, nama_kawasan , (select count(*) from tbl_kasus_pengaduan
					inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
					left  join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara 
					inner  JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan 	inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus  where tbl_mast_kawasan.kode_kawasan  = a.kode_kawasan    and year(tgl_pengaduan)='$tahun'   and  tbl_kasus_pengaduan_detail.kode_kasus='$kode_kasus'  
					) as  orang from tbl_mast_kawasan as a  where 1=1  " ;
					if ($kode_kawasan !='') {
							$sql_kawasan.= " and   a.kode_kawasan='$kode_kawasan'  "; 
						}


					 $sql7="select count(*) as tot_jm_kawasan  from tbl_kasus_pengaduan
					inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
					left  join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara 
					inner  JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan 	inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus  where year(tgl_pengaduan)='$tahun'  and  tbl_kasus_pengaduan_detail.kode_kasus='$kode_kasus'     ";
					
					if ($kode_kawasan !='') {
							$sql7.= " and    tbl_mast_kawasan.kode_kawasan='$kode_kawasan'  "; 
						}
					$rs_7 = $db->Execute($sql7);
					$tot_jm_kawasan = $rs_7->fields[tot_jm_kawasan];
				
				
			 }

} else {
				

				if ($bulan !='') {			 

					 $sql_kawasan= "select kode_kawasan, nama_kawasan , (select count(*) from tbl_kasus_pengaduan
					inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
					left  join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara 
					inner  JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan  inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus  where tbl_mast_kawasan.kode_kawasan  =a.kode_kawasan   and year(tgl_pengaduan)='$tahun' and month(tgl_pengaduan)='$bulan'  
					) as  orang from tbl_mast_kawasan as a where 1=1  " ;
					if ($kode_kawasan !='') {
							$sql_kawasan.= " and   a.kode_kawasan='$kode_kawasan'  "; 
						}
			 
					$sql7="select count(*) as tot_jm_kawasan  from tbl_kasus_pengaduan
					inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
					left join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara 
					inner  JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus  where year(tgl_pengaduan)='$tahun' and month(tgl_pengaduan)='$bulan'   ";
					if ($kode_kawasan !='') {
							$sql7.= " and tbl_mast_kawasan.kode_kawasan='$kode_kawasan'  "; 
						}

					$rs_7 = $db->Execute($sql7);
					$tot_jm_kawasan = $rs_7->fields[tot_jm_kawasan];				
				
				}

			if ($bulan =='') {
			 
					 $sql_kawasan= "select kode_kawasan, nama_kawasan , (select count(*) from tbl_kasus_pengaduan
					inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
					left  join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara  inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan 
					inner  JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus  where tbl_mast_kawasan.kode_kawasan  = a.kode_kawasan    and year(tgl_pengaduan)='$tahun' 
					) as  orang from tbl_mast_kawasan as a where 1=1  " ; 
					if ($kode_kawasan !='') {
							$sql_kawasan.= " and   a.kode_kawasan='$kode_kawasan'  "; 
						}


					 $sql7="select count(*) as tot_jm_kawasan  from tbl_kasus_pengaduan
					inner join   tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan 
					left  join   tbl_mast_negara  on tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara  inner join tbl_kasus_pengaduan_detail on tbl_kasus_pengaduan_detail.kode_form_pengaduan = tbl_kasus_pengaduan.kode_form_pengaduan 
					inner  JOIN tbl_mast_kawasan ON tbl_mast_negara.kode_kawasan=tbl_mast_kawasan.kode_kawasan  	inner join  tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan_detail.kode_kasus  where year(tgl_pengaduan)='$tahun'    ";
					if ($kode_kawasan !='') {
							$sql7.= " and    tbl_mast_kawasan.kode_kawasan='$kode_kawasan'  "; 
						}
					$rs_7 = $db->Execute($sql7);
					$tot_jm_kawasan = $rs_7->fields[tot_jm_kawasan];
				
				
			 }



}
				$numresults3=$db->Execute($sql_kawasan);
				$count3 = $numresults3->RecordCount();
 				$recordSet3 = $db->Execute($sql_kawasan);
				$end3 = $recordSet3->RecordCount();
				$initSet3 = array();
				$data_tb3 = array();
				$row_class3 = array();
				$z=0;
				while ($arr3=$recordSet3->FetchRow()) {
					
					$content_data2 .= print_content2($z+1,$arr3[nama_kawasan],$arr3[orang]);
					
					
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

  
					$content_data2 .= print_content2("","<b>TOTAL :</b>",$tot_jm_kawasan); 
					
			$smarty->assign ("TOT_JM_KAWASAN", $tot_jm_kawasan);
			
			
			$file= $DIR_HOME."/files/rekap_kasus_".$nama_bulan."_".$tahun.".xls";

				$fp=@fopen($file,"w");
				if(!is_resource($fp))
				return false;
				//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
				stream_set_write_buffer($fp, 0);
				
				$content = print_header($nama_bulan,$tahun);
				$content .= $content_data;
				$content .= print_header2();
				$content .= $content_data2;
				$content .= print_footer();
				
				fwrite($fp,$content);
				fclose($fp);
				$file_2= $HREF_HOME."/files/rekap_kasus_".$nama_bulan."_".$tahun.".xls";		

 
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