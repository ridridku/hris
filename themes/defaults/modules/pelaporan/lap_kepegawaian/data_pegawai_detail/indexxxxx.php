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
require_once($DIR_HOME.'/laporan/inc.kasus_wni.php');  

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/pelaporan/kasus';
 
#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/pelaporan');
$FILE_JS  = $JS_MODUL.'/kasus';

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

if ($_GET['kode_kat_kasus']) $kode_kat_kasus = $_GET['kode_kat_kasus'];
else if ($_POST['kode_kat_kasus']) $kode_kat_kasus = $_POST['kode_kat_kasus'];
else $kode_kat_kasus="";


if ($_GET['nama']) $nama = $_GET['nama'];
else if ($_POST['nama']) $nama = $_POST['nama'];
else $nama="";


if ($_GET['search']) $search = $_GET['search'];
else if ($_POST['search']) $search = $_POST['search'];
else $search="";
$tahun_ses		=	$_SESSION['SESSION_TAHUN'];

$smarty->assign ("TAHUN_SES", $tahun_ses);

$fields_find_jns_jln_	= $jns_jln!=""?$jns_jln:$jns_jln2;

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

$sql_instansi = "SELECT *  FROM tbl_mast_perwakilan order by nm_perwakilan ";
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
				$sql__="select * , upper(nm_perwakilan) as nm_perwakilan from tbl_mast_perwakilan where kode_perwakilan='$kode_perwakilan' ";
				$rs__=$db->Execute($sql__);

			  
				 $nm_perwakilan = $rs__->fields['nm_perwakilan']; 
				 
				 $smarty->assign ("NM_PERWAKILAN", $nm_perwakilan);
				 

						$sql = " select kronologis_permasalahan, bantuan , kode_kat_kasus,tbl_kasus_pengaduan.kode_wni , tbl_wni.nama , tbl_wni.alamat , no_paspor ,   kode_form_pengaduan  , nm_perwakilan , nama_kabupaten ,  nama_kasus, nama_pengaduan,
						 nm_perwakilan,
						 SUBSTRING(tgl_pengaduan,6,2)  as bulan_tl ,
						 LEFT(tgl_pengaduan,4) as tahun_tl , 
						 RIGHT(tgl_pengaduan,2) as tanggal_tl , nm_perwakilan
						 from  tbl_kasus_pengaduan
						 inner join  tbl_wni on tbl_wni.kode_wni = tbl_kasus_pengaduan.kode_wni
						 left  join tbl_mast_pengaduan on tbl_mast_pengaduan.kode_pengaduan = tbl_kasus_pengaduan.kode_pengaduan
						 left join tbl_mast_kasus on tbl_mast_kasus.kode_kasus = tbl_kasus_pengaduan.kode_kasus
						 left join tbl_kerja_tki on tbl_kerja_tki.kode_kerja_tki = tbl_kasus_pengaduan.kode_kerja_tki 
						 inner join tbl_mast_perwakilan on tbl_mast_perwakilan.kode_perwakilan = tbl_kasus_pengaduan.kode_perwakilan
						 left  join tbl_mast_wil_kabupaten on tbl_mast_wil_kabupaten.id_kabupaten = tbl_wni.id_kabupaten
						 where 1=1 ";
						
						 if ($kode_kat_kasus =='') {
						 	$sql.=" and ( kode_kat_kasus=1 or  kode_kat_kasus=2 ) ";
						 }

						 if ($kode_kat_kasus !='') {
						 	$sql.=" and ( kode_kat_kasus='$kode_kat_kasus' ) ";
						 }


						if ($bulan !=''  ) {
						 	$sql.=" and SUBSTRING(tgl_pengaduan,6,2)='$bulan' ";
						 } 

						if ( $tahun !=''   ) {
						 	$sql.=" and LEFT(tgl_pengaduan,4)='$tahun' ";
						 } 

						 if ($kode_perwakilan !='') {
						 	$sql.=" and tbl_kasus_pengaduan.kode_perwakilan='$kode_perwakilan' ";
						 }

						  if ($nama !='') {
						 	$sql.=" and tbl_wni.nama LIKE '%".$nama."%' "; 
						 }

 
						    $sql.=" order by tgl_pengaduan asc ";

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
								
						
							$label="Nama :". $arr[nama]. "<p> No KTP :".$arr[no_paspor]." <p> No Pasport :".$arr[kode_wni]." <p> Alamat : ".$arr[alamat]." <p>
											Daerah Asal : ".$arr[nama_kabupaten]." <p>"; 					
						
												if ($arr[bulan_tl]=='1') { $nama_bulan='Januari';  }
												if ($arr[bulan_tl]=='2') { $nama_bulan='Februari';  }
												if ($arr[bulan_tl]=='3') { $nama_bulan='Maret';  }
												if ($arr[bulan_tl]=='4') { $nama_bulan='April';  }
												if ($arr[bulan_tl]=='5') { $nama_bulan='Mei';  }
												if ($arr[bulan_tl]=='6') { $nama_bulan='Juni';  }
												if ($arr[bulan_tl]=='7') { $nama_bulan='Juli';  }
												if ($arr[bulan_tl]=='8') { $nama_bulan='Agustus';  }
												if ($arr[bulan_tl]=='9') { $nama_bulan='September';  }
												if ($arr[bulan_tl]=='10') { $nama_bulan='Oktober';  }
												if ($arr[bulan_tl]=='11') { $nama_bulan='November';  }
												if ($arr[bulan_tl]=='12') { $nama_bulan='Desember';  }
								
						
						
				$labeltgl=$arr[tanggal_tl]." ".$nama_bulan." ".$arr[tahun_tl];
					
					
				$sql_detail = "select tindak_lanjut,tbl_tindak_lanjut.kode_form_pengaduan  from tbl_tindak_lanjut inner join tbl_kasus_pengaduan on tbl_kasus_pengaduan.kode_form_pengaduan = tbl_tindak_lanjut.kode_form_pengaduan where kode_jenis_penindak=1 ";

				 if ($bulan !=''    ) {
						 $sql_detail.="  and SUBSTRING(tgl_pengaduan,6,2)='$bulan' ";
				  } 

				  if (   $tahun !=''   ) {
						 $sql_detail.=" and LEFT(tgl_pengaduan,4)='$tahun' ";
				  } 



				 if ($kode_perwakilan !='') {
						 	$sql_detail.=" and tbl_kasus_pengaduan.kode_perwakilan='$kode_perwakilan' ";
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
				
					array_push($data_tb2, $arr2);
					if ($z%2==0){ 
						$ROW_CLASSNAME="#CCCCCC"; }
					else {
						$ROW_CLASSNAME="#EEEEEE";
					   }
					array_push($row_class2, $ROW_CLASSNAME2);
					array_push($initSet2, $z);
					$z++;
					
					
				$tindak='';
				if ($arr[kode_form_pengaduan]=$arr2[kode_form_pengaduan]) {
						 	$tindak.=$tindak.$arr2[tindak_lanjut]; }	
				
				}
			   $smarty->assign ("DATA_TB2", $data_tb2);
			   
			   $content_data .= print_content($label,$arr[nm_perwakilan],$arr[sumber_informasi],$labeltgl,$arr[kronologis_permasalahan],$arr[bantuan],$tindak,"","");	
								
								if ($z%2==0){ 
									$ROW_CLASSNAME="#CCCCCC"; }
								else {
									$ROW_CLASSNAME="#EEEEEE";
								   }
								array_push($row_class, $ROW_CLASSNAME);
								array_push($initSet, $z);
								$z++;	} 

			    $smarty->assign ("DATA_TB", $data_tb);



				


			   $sql_alat_pinjam="select  tindak_lanjut,tbl_tindak_lanjut.kode_form_pengaduan  from tbl_tindak_lanjut  inner join tbl_kasus_pengaduan on tbl_kasus_pengaduan.kode_form_pengaduan = tbl_tindak_lanjut.kode_form_pengaduan where kode_jenis_penindak=2 ";

						if ($bulan !='' ) {
						 	$sql_alat_pinjam.=" and SUBSTRING(tgl_pengaduan,6,2)='$bulan' ";
						 } 


			   
						if ($tahun !='' ) {
						 	$sql_alat_pinjam.=" and LEFT(tgl_pengaduan,4)='$tahun'   ";
						 } 

						 if ($kode_perwakilan !='') {
						 	$sql_alat_pinjam.=" and tbl_kasus_pengaduan.kode_perwakilan='$kode_perwakilan' ";
						 }


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



					    $sql_detail2="select tbl_hak_tki.kode_form_pengaduan, jenis_hak, ekuivalent_rp  from tbl_hak_tki  inner join tbl_kasus_pengaduan on tbl_kasus_pengaduan.kode_form_pengaduan = tbl_hak_tki.kode_form_pengaduan where 1=1 ";

						if ($bulan !='' ) {
						 	$sql_detail2.="  and SUBSTRING(tgl_pengaduan,6,2)='$bulan' ";
						 } 

				 		 if ( $tahun !='' ) {
						 	$sql_detail2.=" and LEFT(tgl_pengaduan,4)='$tahun' ";
						 } 

						 if ($kode_perwakilan !='') {
						 	$sql_detail2.=" and tbl_kasus_pengaduan.kode_perwakilan='$kode_perwakilan' ";
						 }
  
					 $recordSet4 = $db->Execute($sql_detail2);
					 
					$initSet4 = array();
					$data_tb4 = array();
					$row_class4 = array();
					$yy=0;
					while ($arr4=$recordSet4->FetchRow()) {
						 $count_row = $recordSet4->RecordCount();
						array_push($data_tb4, $arr4);
						if ($yy%2==0){ 
							$ROW_CLASSNAME4="#CCCCCC"; }
						else {
							$ROW_CLASSNAME4="#EEEEEE";
						   }
						array_push($row_class4, $ROW_CLASSNAME4);
						array_push($initSet4, $zz);
						$yy++;
					}

				   $smarty->assign ("DATA_TB4", $data_tb4);


				// asuransi TKI
				
					    $sql_detail5="select  tbl_asuransi_tki.kode_form_pengaduan, jenis_asuransi, ekuivalent_rp    from tbl_asuransi_tki inner join tbl_kasus_pengaduan on tbl_kasus_pengaduan.kode_form_pengaduan = tbl_asuransi_tki.kode_form_pengaduan where 1=1 ";

						 if ($bulan !='' ) {
						 	$sql_detail5.=" and SUBSTRING(tgl_pengaduan,6,2)='$bulan' ";
						 } 


				 		 if ( $tahun !='' ) {
						 	$sql_detail5.=" and LEFT(tgl_pengaduan,4)='$tahun'  ";
						 } 

						 if ($kode_perwakilan !='') {
						 	$sql_detail5.=" and tbl_kasus_pengaduan.kode_perwakilan='$kode_perwakilan' ";
						 }
  
					 $recordSet5 = $db->Execute($sql_detail5);
					 
					$initSet5 = array();
					$data_tb5 = array();
					$row_class5 = array();
					$yy=0;
					while ($arr5=$recordSet5->FetchRow()) {
						 $count_row = $recordSet5->RecordCount();
						array_push($data_tb5, $arr5);
						if ($yy%2==0){ 
							$ROW_CLASSNAME4="#CCCCCC"; }
						else {
							$ROW_CLASSNAME4="#EEEEEE";
						   }
						array_push($row_class5, $ROW_CLASSNAME5);
						array_push($initSet5, $zz);
						$yy++;
					}

				   $smarty->assign ("DATA_TB5", $data_tb5);


				   // PEMULANGAN TKI
				
					    $sql_detail6="select tbl_pemulangan.kode_form_pengaduan ,  nama_pilihan_pemulangan, 
						 SUBSTRING(tgl_pemulangan,6,2)  as bulan_a ,
						 LEFT(tgl_pemulangan,4) as tahun_a , 
						 RIGHT(tgl_pemulangan,2) as tanggal_a   from tbl_pemulangan
						   inner join tbl_kasus_pengaduan on tbl_kasus_pengaduan.kode_form_pengaduan = tbl_pemulangan.kode_form_pengaduan
						left join tbl_pilihan_pemulangan on tbl_pilihan_pemulangan.kode_pilihan = tbl_pemulangan.kode_pilihan where 1=1 ";

				 		 if ($bulan !='' ) {
						 	$sql_detail6.="  and  SUBSTRING(tgl_pengaduan,6,2)='$bulan' ";
						 } 


						 if ( $tahun !='' ) {
						 	$sql_detail6.=" and LEFT(tgl_pengaduan,4)='$tahun'  ";
						 } 



						 if ($kode_perwakilan !='') {
						 	$sql_detail6.=" and tbl_kasus_pengaduan.kode_perwakilan='$kode_perwakilan' ";
						 }
  
					 $recordSet6 = $db->Execute($sql_detail6);
					 
					$initSet6 = array();
					$data_tb6 = array();
					$row_class6 = array();
					$yy=0;
					while ($arr6=$recordSet6->FetchRow()) {
						 $count_row = $recordSet6->RecordCount();
						array_push($data_tb6, $arr6);
						if ($yy%2==0){ 
							$ROW_CLASSNAME6="#CCCCCC"; }
						else {
							$ROW_CLASSNAME6="#EEEEEE";
						   }
						array_push($row_class6, $ROW_CLASSNAME6);
						array_push($initSet6, $zz);
						$yy++;
					}

				   $smarty->assign ("DATA_TB6", $data_tb6);


				     // PENANGANAN JENAZAH TKI
				
					    $sql_detail7="select tbl_jenazah.kode_form_pengaduan ,  nama_pilihan_penguburan   from
					tbl_jenazah
					 inner join tbl_kasus_pengaduan on tbl_kasus_pengaduan.kode_form_pengaduan = tbl_jenazah.kode_form_pengaduan
											left join tbl_pilihan_penguburan on tbl_pilihan_penguburan.kode_pilihan_meninggal = tbl_jenazah.kode_pilihan_meninggal where 1=1  ";
						
				 		 if ($bulan !='' ) {
						 	$sql_detail7.="  and SUBSTRING(tgl_pengaduan,6,2)='$bulan' ";
						 } 

						 if ( $tahun !='' ) {
						 	$sql_detail7.=" and LEFT(tgl_pengaduan,4)='$tahun' ";
						 } 



						 if ($kode_perwakilan !='') {
						 	$sql_detail7.=" and tbl_kasus_pengaduan.kode_perwakilan='$kode_perwakilan' ";
						 }
  
					$recordSet7 = $db->Execute($sql_detail7);
					 
					$initSet7 = array();
					$data_tb7 = array();
					$row_class7 = array();
					$yy=0;
					while ($arr7=$recordSet7->FetchRow()) {
						 $count_row = $recordSet7->RecordCount();
						array_push($data_tb7, $arr7);
						if ($yy%2==0){ 
							$ROW_CLASSNAME7="#CCCCCC"; }
						else {
							$ROW_CLASSNAME7="#EEEEEE";
						   }
						array_push($row_class7, $ROW_CLASSNAME7);
						array_push($initSet7, $zz);
						$yy++;
					}

					   $smarty->assign ("DATA_TB7", $data_tb7);


					 $sql_detail8="select * from
					tbl_sidang_hasil
					 inner join tbl_kasus_pengaduan on tbl_kasus_pengaduan.kode_form_pengaduan = tbl_sidang_hasil.kode_form_pengaduan where 1=1
					 ";
						 

						 if ($bulan !=''   ) {
						 	$sql_detail8.=" and  SUBSTRING(tgl_pengaduan,6,2)='$bulan' ";
						 } 

						  if ( $tahun !=''   ) {
						 	$sql_detail8.=" and LEFT(tgl_pengaduan,4)='$tahun' ";
						 } 


						 if ($kode_perwakilan !='') {
						 	$sql_detail8.=" and tbl_kasus_pengaduan.kode_perwakilan='$kode_perwakilan' ";
						 } 

					$recordSet8 = $db->Execute($sql_detail8);
					 
					$initSet8 = array();
					$data_tb8 = array();
					$row_class8 = array();
					$yy=0;
					while ($arr8=$recordSet8->FetchRow()) {
						 $count_row = $recordSet8->RecordCount();
						array_push($data_tb8, $arr8);
						if ($yy%2==0){ 
							$ROW_CLASSNAME8="#CCCCCC"; }
						else {
							$ROW_CLASSNAME8="#EEEEEE";
						   }
						array_push($row_class8, $ROW_CLASSNAME8);
						array_push($initSet8, $zz);
						$yy++;
					}

					   $smarty->assign ("DATA_TB8", $data_tb8);


 						if ($kode_kat_kasus =='') {
						 	$kode_kas="WNI NON TKI";
						 }

						 if ($kode_kat_kasus !='') {
						 	$kode_kas="TKI";
						 }

				$file= $DIR_HOME."/files/laporan_kasus_wni_".$nm_perwakilan."_".$tahun.".xls";

				$fp=@fopen($file,"w");
				if(!is_resource($fp))
				return false;
				//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
				stream_set_write_buffer($fp, 0);
				
				$content = print_header($nm_perwakilan,$tahun,$kode_kas);
				$content .= $content_data;
				
				$content .= print_footer();
				
				fwrite($fp,$content);
				fclose($fp);
				$file_2= $HREF_HOME."/files/laporan_kasus_wni_".$nm_perwakilan."_".$tahun.".xls";	

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