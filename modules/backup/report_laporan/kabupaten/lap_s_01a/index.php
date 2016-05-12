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
require_once($DIR_HOME.'/laporan_excell/inc.s_01a.php');

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/report_laporan/kabupaten/lap_s_01a';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/report_laporan');
$FILE_JS  = $JS_MODUL.'/kabupaten/lap_s_01a';

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

$tbl_name_main = "tbl_form_s_01_main";
$tbl_name_detail = "tbl_form_s_01_detail";
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
else $ORDER="a.no_ruas";

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

if ($_GET['no_ruas']) $no_ruas = $_GET['no_ruas'];
else if ($_POST['no_ruas']) $no_ruas = $_POST['no_ruas'];
else $no_ruas="";

if ($_GET['tanggal']) $tanggal = $_GET['tanggal'];
else if ($_POST['tanggal']) $no_kabupaten = $_POST['tanggal'];
else $tanggal="";

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&tanggal=".$tanggal."&jns_jln=".$jns_jln;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&tanggal=".$tanggal."&jns_jln=".$jns_jln;

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
		
if ($_GET[get_tanggal] == 1)
{
	$no_propinsi = $_GET[no_propinsi];
	$no_kabupaten = $_GET[no_kabupaten];
	$jns_jln = $_GET[jns_jln];
	
			if($no_propinsi!=''){	
					$sql_tgl_combo 	  = "SELECT tanggal FROM tbl_form_s_01_main WHERE no_propinsi='$no_propinsi' AND no_kabupaten='$no_kabupaten' AND id_jns_jln='$jns_jln' ORDER BY tanggal DESC";
					$result_tgl_combo  = $db->Execute($sql_tgl_combo);

					$input_tgl="<select name=tanggal onChange=\"get_no_ruas(document.frmList1.no_propinsi.value,document.frmList1.no_kabupaten.value,this.value,$jns_jln)\">";
					$input_tgl.="<option>[Pilih Tanggal]";
					$input_tgl.="</option> ";
					while(!$result_tgl_combo ->EOF): 						
						($result_tgl_combo  ->fields['tanggal']==$tanggal) ? $selected=" selected":$selected=NULL;
						$tgl_combo = explode("-",$result_tgl_combo->fields[tanggal],strlen($result_tgl_combo->fields[tanggal])); // YYYY-mm-dd
						$tanggal_combo = $tgl_combo[2]."-".$tgl_combo[1]."-".$tgl_combo[0];						
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
	$jns_jln = $_GET[jns_jln];
	
			if($no_propinsi!=''){	
					$sql_ruas_combo 	  = "SELECT no_ruas FROM tbl_form_s_01_main WHERE no_propinsi='$no_propinsi' AND no_kabupaten='$no_kabupaten' AND tanggal='$tanggal' AND id_jns_jln='$jns_jln' ORDER BY no_ruas ASC";
					$result_ruas_combo  = $db->Execute($sql_ruas_combo);
					$input_ruas="<select name=no_ruas>";
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
				$f_id_jns_jln2	= $SES_JNS_JLN!='0'?" AND id_jns_jln='".$SES_JNS_JLN."' ":"";
				$f_no_propinsi2	= $SES_NO_PROP!='0'?" AND no_propinsi='".$SES_NO_PROP."' ":"";
				$f_no_kabupaten2= $SES_NO_KAB!='0'?" AND no_kabupaten='".$SES_NO_KAB."' ":"";
												
				$sql_data_wilayah = "SELECT get_nama_propinsi(no_propinsi) as nama_propinsi,get_nama_kabupaten(no_propinsi,no_kabupaten) as nama_kabupaten,DATE_FORMAT(tanggal,'%d/%m/%Y') as tanggal,no_ruas,nama_ruas_pangkal,nama_ruas_ujung,id_fs_01_main,
				( SELECT a.pal_km_awal FROM tbl_form_k_01_detail a LEFT JOIN tbl_form_k_01_main b ON a.id_form_k_01_main=b.id_k_01_main WHERE (b.no_propinsi='$no_propinsi' $f_no_propinsi) AND (b.no_kabupaten='$no_kabupaten' $f_no_kabupaten) AND a.no_ruas='$no_ruas' AND (b.id_jns_jln='$jns_jln' $f_id_jns_jln) ) as awal_ruas,
				(SELECT a.pal_km_akhir FROM tbl_form_k_01_detail a LEFT JOIN tbl_form_k_01_main b ON a.id_form_k_01_main=b.id_k_01_main WHERE (b.no_propinsi='$no_propinsi' $f_no_propinsi) AND (b.no_kabupaten='$no_kabupaten' $f_no_kabupaten) AND a.no_ruas='$no_ruas' AND (b.id_jns_jln='$jns_jln' $f_id_jns_jln) ) as akhir_ruas
				 FROM ".$tbl_name_main." WHERE (no_propinsi='".$no_propinsi."' $f_no_propinsi2) AND (no_kabupaten='".$no_kabupaten."' $f_no_kabupaten2) AND no_ruas='".$no_ruas."' AND tanggal='".$tanggal."' AND (id_jns_jln='".$jns_jln."' $f_id_jns_jln2) ";
				
				$recordSet_wilayah = $db->execute($sql_data_wilayah);
				
				$smarty->assign ("DATA_TOTAL", $recordSet_wilayah->numrows);
				
				if ($recordSet_wilayah->numrows()>0) {
					
				$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];
				$nama_kabupaten = $recordSet_wilayah->fields[nama_kabupaten];
				$tanggal = $recordSet_wilayah->fields[tanggal];
				$no_ruas = $recordSet_wilayah->fields[no_ruas];
				$nama_ruas_pangkal = $recordSet_wilayah->fields[nama_ruas_pangkal];
				$nama_ruas_ujung = $recordSet_wilayah->fields[nama_ruas_ujung];
				$awal_ruas = $recordSet_wilayah->fields[awal_ruas];
				$akhir_ruas = $recordSet_wilayah->fields[akhir_ruas];
				$id_fs_01_main = $recordSet_wilayah->fields[id_fs_01_main];
				$jenis_jalan	= $jns_jln==1?"Provinsi":"Kabupaten/ Kota";
				
				$header = print_header($nama_propinsi,$nama_kabupaten,$tanggal,$no_ruas,$nama_ruas_pangkal." - ".$nama_ruas_ujung,$awal_ruas,$akhir_ruas,$jenis_jalan);
				
				$sql_detail	 = "SELECT penilaian,if(penilaian<".$_CONF['PR'].",penilaian,'-') as pr,if(penilaian>=".$_CONF['PR']." AND penilaian <=".$_CONF['PM'].",penilaian,'-') as pm,if(penilaian>".$_CONF['PK'].",penilaian,'-') as pk,
				if(penilaian<".$_CONF['PR'].",'PR',if(penilaian>=".$_CONF['PR']." AND penilaian<=".$_CONF['PM'].",'PM', if(penilaian>".$_CONF['PK'].",'PK','-'))) as keterangan FROM ".$tbl_name_detail." WHERE id_fs_01_main='".$id_fs_01_main."' ORDER BY id_fs_01_detail ASC";
				
				$result_detail = $db->Execute($sql_detail);
				$jum_detail=$result_detail->RecordCount();
				$data_detail= array();
				$z=0;
				while ($arr=$result_detail->FetchRow()) {
					$z++;
					$content_data .= print_content($z,$z,$arr[penilaian],$arr[pr],$arr[pm],$arr[pk],$arr[keterangan]);
					array_push($data_detail, $arr);
				}
				$smarty->assign ("DATA_DETAIL", $data_detail);
				
				$sql_summary = "SELECT sum(if(penilaian<".$_CONF['PR'].",penilaian,0)) as pr,
				sum(if(penilaian>=".$_CONF['PR']." AND penilaian<=".$_CONF['PM'].",penilaian,0)) as pm,
				sum(if(penilaian>".$_CONF['PK'].",penilaian,0)) as pk,
				(SELECT count(penilaian) FROM ".$tbl_name_detail." WHERE id_fs_01_main='".$id_fs_01_main."' AND penilaian < ".$_CONF['PR'].") as cpr,
				(SELECT count(penilaian) FROM ".$tbl_name_detail." WHERE id_fs_01_main='".$id_fs_01_main."' AND (penilaian >= ".$_CONF['PR']." AND penilaian <= ".$_CONF['PM'].")) as cpm,
				(SELECT count(penilaian) FROM ".$tbl_name_detail." WHERE id_fs_01_main='".$id_fs_01_main."' AND penilaian > ".$_CONF['PK'].") as cpk 
				FROM ".$tbl_name_detail." WHERE id_fs_01_main='".$id_fs_01_main."'";
				
				$recordSet_Summary = $db->execute($sql_summary);
				
				$jnk_pr = number_format($recordSet_Summary->fields[pr],2,",",".");
				$jnk_pm = number_format($recordSet_Summary->fields[pm],2,",",".");
				$jnk_pk = number_format($recordSet_Summary->fields[pk],2,",",".");
				$js_pr = $recordSet_Summary->fields[cpr];
				$js_pm = $recordSet_Summary->fields[cpm];
				$js_pk = $recordSet_Summary->fields[cpk];
				$ps_pr = @number_format($recordSet_Summary->fields[cpr]*100,0,",",".");
				$ps_pm = @number_format($recordSet_Summary->fields[cpm]*100,0,",",".");
				$ps_pk = @number_format($recordSet_Summary->fields[cpk]*100,0,",",".");
				$rrnks_pr = @number_format($recordSet_Summary->fields[pr]/$recordSet_Summary->fields[cpr],2,",",".");
				$rrnks_pm = @number_format($recordSet_Summary->fields[pm]/$recordSet_Summary->fields[cpm],2,",",".");
				$rrnks_pk = @number_format($recordSet_Summary->fields[pk]/$recordSet_Summary->fields[cpk],2,",",".");
				
				if (($js_pr>$js_pm) and ($js_pr>$js_pk)) { 
					$var1 = "PR"; 
					$var2 = $rrnks_pr." %  dari jumlah panjang segmen yang ditangani";
					$var3	= $rrnks_pr." % x ".$ps_pr." m";
					$var4 =	$jnk_pr." m";
				}	elseif (($js_pm>$js_pr) and ($js_pm>$js_pk)) { 
					$var1 = "PM"; 
					$var2 = $rrnks_pm." %  dari jumlah panjang segmen yang ditangani";
					$var3	= $rrnks_pm." % x ".$ps_pm." m";
					$var4 =	$jnk_pm." m";
				}	elseif (($js_pk>$js_pr) and ($js_pk>$js_pm)) { 
					$var1 = "PK"; 
					$var2 = $rrnks_pk." %  dari jumlah panjang segmen yang ditangani";
					$var3	= $rrnks_pk." % x ".$ps_pk." m";
					$var4 =	$jnk_pk." m";
				}
		
				$file= $DIR_HOME."/files/s_01a_".$no_propinsi."_".$no_kabupaten."_".$jns_jln."_".str_replace('/','_',$tanggal).".xls";

				$fp=@fopen($file,"w");
				if(!is_resource($fp))
				return false;
				//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
				stream_set_write_buffer($fp, 0);
				
				$content = $header;
				$content .= $content_data;
				$content .= print_footer($jnk_pr,$jnk_pm,$jnk_pk,$js_pr,$js_pm,$js_pk,$ps_pr,$ps_pm,$ps_pk,$rrnks_pr,$rrnks_pm,$rrnks_pk,$var1,$var2,$var3,$var4);
				
				fwrite($fp,$content);
				fclose($fp);
				$file_2= $HREF_HOME."/files/s_01a_".$no_propinsi."_".$no_kabupaten."_".$jns_jln."_".str_replace('/','_',$tanggal).".xls";			
				}
			
}
}

//print_header($nama_propinsi,$nama_kabupaten,$tanggal,$no_ruas,$nama_ruas,$awal_ruas,$akhir_ruas)

($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;


$smarty->assign ("JNK_PR", $jnk_pr);
$smarty->assign ("JNK_PM", $jnk_pm);
$smarty->assign ("JNK_PK", $jnk_pk);
$smarty->assign ("JS_PR", $js_pr);
$smarty->assign ("JS_PM", $js_pm);
$smarty->assign ("JS_PK", $js_pk);
$smarty->assign ("PS_PR", $ps_pr);
$smarty->assign ("PS_PM", $ps_pm);
$smarty->assign ("PS_PK", $ps_pk);
$smarty->assign ("RRNKS_PR", $rrnks_pr);
$smarty->assign ("RRNKS_PM", $rrnks_pm);
$smarty->assign ("RRNKS_PK", $rrnks_pk);

$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NO_KABUPATEN", $no_kabupaten);
$smarty->assign ("NO_JENIS_JALAN", $jns_jln);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten);
$smarty->assign ("TANGGAL", $tanggal);
$smarty->assign ("NO_RUAS", $no_ruas);
$smarty->assign ("AWAL_KM_RUAS", $awal_ruas);
$smarty->assign ("AKHIR_KM_RUAS", $akhir_ruas);
$smarty->assign ("FILES", $file_2);
$smarty->assign ("NAMA_RUAS_PANGKAL", $nama_ruas_pangkal);
$smarty->assign ("NAMA_RUAS_UJUNG", $nama_ruas_ujung);
$smarty->assign ("ID_FS_01_MAIN", $id_fs_01_main);

$smarty->assign ("TITLE", _PRINT_TITLE_S_01A_MAIN);
$smarty->assign ("HEAD_TITLE", _PRINT_HEAD_TITLE_S_01A_MAIN);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);

$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _PRINT_TITLE_S_01A_MAIN);
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