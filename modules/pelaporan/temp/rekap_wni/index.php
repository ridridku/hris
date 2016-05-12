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
require_once($DIR_HOME.'/laporan/inc.laporan_rekap_wni.php'); 

$p = new Pager; 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/pelaporan/rekap_wni';
 
#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/pelaporan');
$FILE_JS  = $JS_MODUL.'/rekap_wni';

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
 

if ($_GET['no_propinsi']) $no_propinsi = $_GET['no_propinsi'];
else if ($_POST['no_propinsi']) $no_propinsi = $_POST['no_propinsi'];
else $no_propinsi="";
 
if ($_GET['id_kab']) $id_kab = $_GET['id_kab'];
else if ($_POST['id_kab']) $id_kab = $_POST['id_kab'];
else $id_kab="";

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
 


$var_cari="no_propinsi=".$no_propinsi."&id_kab=".$id_kab."&usia=".$usia."&jk=".$jk."&kode_klasifikasi_wni=".$kode_klasifikasi_wni."&kode_sektor=".$kode_sektor."&kode_jenis=".$kode_jenis."&kode_kawasan=".$kode_kawasan."&bulan=".$bulan."&tahun=".$tahun;
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
					$input_kab.="<option value=>[Pilih Kabupaten] ";
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


	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
				$sql__="select * , upper(nama_kawasan) as nama_kawasan from tbl_mast_kawasan where kode_kawasan='$_GET[kode_kawasan]' ";
				$rs__=$db->Execute($sql__);			  
				 $nm_kawasan = $rs__->fields['nama_kawasan']; 				 
				 $smarty->assign ("NM_KAWASAN", $nm_kawasan); 

				
				 if ($no_propinsi !='') { 

				 $sql__="select upper(nama_propinsi) as nama_propinsi from tbl_mast_wil_propinsi where no_propinsi='$no_propinsi' ";
				$rs__=$db->Execute($sql__);			  
				 $nama_propinsi = $rs__->fields['nama_propinsi']; 				 
				 $smarty->assign ("NAMA_PROPINSI", $nama_propinsi); 
				 }
 
				  if ($id_kab !='') { 
				  $sql__="select upper(nama_kabupaten) as nama_kabupaten   from tbl_mast_wil_kabupaten where id_kabupaten='$id_kab' ";
				$rs__=$db->Execute($sql__);			  
				 $nama_kabupaten = $rs__->fields['nama_kabupaten']; 				 
				 $smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten); 

				  }

				  if ($jk!='') { 

					  if ($jk==1) {
						$nama_jk="PEREMPUAN";	
					  }
					    if ($jk==2) {
						$nama_jk="LAKI - LAKI ";	
					  }

					 $smarty->assign ("NAMA_JK", $nama_jk); 	 
				 }


				  if ($usia!='') { 

					  if ($usia==1) {
						$nama_usia=" 0 - 20 ";	
					  }
					    if ($usia==2) {
						$nama_usia="  21 - 40 ";	
					  }

					  if ($usia==3) {
						$nama_usia="  41 - 60 ";	
					  }

					  if ($usia==4) {
						$nama_usia="  60 Keatas ";	
					  }
  
					 $smarty->assign ("NAMA_USIA", $nama_usia); 	 
				 }
 
					


			    if ($kode_klasifikasi_wni!='') { 

					  if ($kode_klasifikasi_wni==1) {
						$nama_kw="WNI NON TKI";	
							if ($kode_jenis !='') {
							 $sql_jenis="select upper( nama_jenis_wni) as nama_jenis_wni  from tbl_mast_jenis_wni where  kode_jenis_wni='$kode_jenis' ";
							 $rs_jenis=$db->Execute($sql_jenis);			  
							 $nama_jenis = $rs_jenis->fields['nama_jenis_wni']; 

							}
					  }
					  if ($kode_klasifikasi_wni==3) {
						$nama_kw="  TKI FORMAL ";
						if ($kode_jenis !='') {
							 $sql_jenis="select  upper (nama_formal) as nama_formal  from tbl_mast_jenis_formal  where  kode_jenis_formal='$kode_jenis' ";
							  $rs_jenis=$db->Execute($sql_jenis);			  
							 $nama_jenis = $rs_jenis->fields['nama_formal']; 
							}
					  }

					   if ($kode_klasifikasi_wni==4) {
						$nama_kw="  TKI INFORMAL ";	
						if ($kode_jenis !='') {
							 $sql_jenis="select  upper(nama_informal) as nama_informal  from tbl_mast_jenis_informal  where  kode_jenis_informal='$kode_jenis' ";
							   $rs_jenis=$db->Execute($sql_jenis);			  
							 $nama_jenis = $rs_jenis->fields['nama_informal']; 
							}
					  }

					   if ($kode_klasifikasi_wni==6) {
						$nama_kw="  TKI ABK ";
						if ($kode_jenis !='') {
							 $sql_jenis="select  upper(nama_abk) as nama_abk  from tbl_mast_jenis_abk  where  kode_jenis_abk='$kode_jenis' ";
							  $rs_jenis=$db->Execute($sql_jenis);			  
							 $nama_jenis = $rs_jenis->fields['nama_abk']; 
							}
					  }
 
					 $smarty->assign ("NAMA_KLASIFIKASI", $nama_kw); 	 
					 $smarty->assign ("NAMA_JENIS", $nama_jenis); 
				 }

  
						 $sql="select nm_perwakilan ,
						 (select count(*) from tbl_wni  left join tbl_mast_wil_kabupaten on tbl_mast_wil_kabupaten.id_kabupaten=tbl_wni.id_kabupaten
						 left join tbl_mast_wil_propinsi on tbl_mast_wil_propinsi.no_propinsi=tbl_mast_wil_kabupaten.no_propinsi ";	 
						   $sql.=" where 1=1  and tbl_wni.kode_perwakilan = a.kode_perwakilan ";
 
							if ($kode_klasifikasi_wni !='') { 
									  $sql.= " AND kode_sumber='$kode_klasifikasi_wni' ";
  							 }
							 if ($kode_jenis !='') { 
									 $sql.= " and tbl_wni.kode_jenis='$kode_jenis' ";
							 }
 
							 if ($no_propinsi !='') { 
								  $sql.= "  AND tbl_mast_wil_kabupaten.no_propinsi='$no_propinsi' ";
							 }

							 if ($id_kab !='') { 
								  $sql.= "  AND tbl_wni.id_kabupaten='$id_kab' ";
							 }

							  if ($jk!='') { 
								  $sql.= "  AND jk='$jk' ";
							 }

							
							if ($usia!='') { 
								  if ($usia=='1') { 
									  $sql.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 0 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 20  ";
								 }

								 if ($usia=='2') { 
									  $sql.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 21 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 40  ";
								 }

								  if ($usia=='3') { 
									  $sql.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 41 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 60  ";
								 }


								   if ($usia=='4') { 
									  $sql.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >=60 ";
								 }
 
							}
   

						  $sql.=" ) as jml_wni "; 
 
						  $sql.=" FROM tbl_mast_perwakilan a LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = a.kode_negara   ";
				  

						if ($kode_kawasan !='') {
							$sql.=" where  tbl_mast_negara.kode_kawasan = '$kode_kawasan' ";
						}	

						$sql.= " order by nm_perwakilan asc ";
  
  
 						$numresults=$db->Execute($sql);
						$count = $numresults->RecordCount();
						$recordSet = $db->Execute($sql);
						$end = $recordSet->RecordCount();
						$initSet = array();
						$data_tb = array();
						$row_class = array();
						$z=0;
						while ($arr=$recordSet->FetchRow()) {
							$content_data .= print_content($z+1,$arr[nm_perwakilan],$arr[jml_wni],$arr[jml_tki_formal],$arr[jml_tki_informal],$arr[jml_abk]);
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
  
 
			
			$file= $DIR_HOME."/files/laporan_rekap_wni_".$nm_kawasan.".xls";

				$fp=@fopen($file,"w");
				if(!is_resource($fp))
				return false;
				//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
				stream_set_write_buffer($fp, 0);
				
				$content = print_header($nm_kawasan);
				$content .= $content_data;
				
				$content .= print_footer();
				
				fwrite($fp,$content);
				fclose($fp);
				$file_2= $HREF_HOME."/files/laporan_rekap_wni_".$nm_kawasan.".xls";







 $sql1="select count(*) as total_wni from tbl_wni left join tbl_mast_wil_kabupaten on tbl_mast_wil_kabupaten.id_kabupaten=tbl_wni.id_kabupaten
 left join tbl_mast_wil_propinsi on tbl_mast_wil_propinsi.no_propinsi=tbl_mast_wil_kabupaten.no_propinsi inner join  tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_wni.kode_perwakilan  LEFT JOIN tbl_mast_negara ON tbl_mast_negara.kode_negara = tbl_mast_perwakilan.kode_negara  where 1=1  ";

 

if ($kode_klasifikasi_wni !='') { 
	 $sql1.= " AND kode_sumber='$kode_klasifikasi_wni' ";
 }
 if ($kode_jenis !='') { 
	$sql1.= " and tbl_wni.kode_jenis='$kode_jenis' ";
 }

  if ($no_propinsi !='') { 
	$sql1.= "  AND tbl_mast_wil_kabupaten.no_propinsi='$no_propinsi' ";
 }

 if ($id_kab !='') { 
	$sql1.= "  AND tbl_wni.id_kabupaten='$id_kab' ";
 }

 if ($jk!='') { 
	$sql1.= "  AND jk='$jk' ";
 }

if ($usia!='') { 

		 if ($usia=='1') { 
			 $sql1.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 0 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 20  ";
		 }

		 if ($usia=='2') { 
			 $sql1.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 21 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 40  ";
		 }

		 if ($usia=='3') { 
			 $sql1.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >= 41 AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) <= 60  ";
		 }


		 if ($usia=='4') { 
			 $sql1.= "  AND ( CASE  WHEN  year(tgl_lahir)='' then 0  WHEN  year(tgl_lahir)='1' then 0 WHEN  year(tgl_lahir) IS NULL then 0 else   YEAR(CURDATE())  -  YEAR(tgl_lahir) end ) >=60 ";
		  }
}


if ($kode_kawasan !=''){
	$sql1.=" and   tbl_mast_negara.kode_kawasan = '$kode_kawasan' ";
 }	


 $resultSet1 = $db->Execute($sql1);
 $total_wni = $resultSet1->fields[total_wni];
 $smarty->assign ("TOTAL_WNI", $total_wni); 



 



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