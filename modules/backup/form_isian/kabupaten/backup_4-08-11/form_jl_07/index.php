<?php
/*** Modify 13-07-2010
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
} else {

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_jl_07';

#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_jl_07';

$mod_id	= $_POST['mod_id']?$_POST['mod_id']:$_GET['mod_id'];
$user_id = base64_decode($_SESSION['UID']);

$smarty->assign ("MOD_ID", $mod_id);
$smarty->assign ("ID_PROPINSI",$MAIN_PROP);

#Initiate TABLE

$tbl_name_main = "tbl_form_jl_07_main";
$tbl_name_detail = "tbl_form_jl_07_detail";
$tbl_name_propinsi = "tbl_mast_wil_propinsi";
$tbl_name_kabupaten = "tbl_mast_wil_kabupaten";
/*** Tambahan 27-06-2010 ***/
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
else $ORDER="a.no_paket";

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

if ($_GET['txt_hidden_jns_jln']) $txt_hidden_jns_jln = $_GET['txt_hidden_jns_jln'];
else if ($_POST['txt_hidden_jns_jln']) $txt_hidden_jns_jln = $_POST['txt_hidden_jns_jln'];
else $txt_hidden_jns_jln="";

if($jns_jln!="" && strlen($jns_jln)!=0 ){
	$fields_find_jns_jln_ = $jns_jln;
} else if ( $txt_hidden_jns_jln!="" && strlen($txt_hidden_jns_jln)!=0 ){
	$fields_find_jns_jln_ = $txt_hidden_jns_jln;
} else {
	$fields_find_jns_jln_ = $_GET[jns_jln];
}


if ($_GET['status_error']) $status_error = $_GET['status_error'];
else if ($_POST['status_error']) $status_error = $_POST['status_error'];
else $status_error="";
 
if ($_GET['Search_Year']) $tahun = $_GET['Search_Year'];
else if ($_POST['Search_Year']) $tahun = $_POST['Search_Year'];
else $tahun="";

if ($_GET['triwulan_search']) $triwulan_search = $_GET['triwulan_search'];
else if ($_POST['triwulan_search']) $triwulan_search = $_POST['triwulan_search'];
else $triwulan_search="";

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&tahun=".$tahun."&triwulan_search=".$triwulan_search."&jns_jln=".$jns_jln;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&no_propinsi=".$no_propinsi."&no_kabupaten=".$no_kabupaten."&search=1&tahun=".$tahun."&triwulan_search=".$triwulan_search."&jns_jln=".$fields_find_jns_jln_."&txt_hidden_jns_jln=".$fields_find_jns_jln_;

$SES_THN		= $_SESSION['SESSION_TAHUN'];
$SES_JNS_JLN	= $_SESSION['SESSION_JNS_JLN'];
$SES_NO_PROP	= $_SESSION['SESSION_NO_PROPINSI'];
$SES_NO_KAB		= $_SESSION['SESSION_NO_KABUPATEN'];

function NamaPaket($no_paket){
	global $_POST,$_GET;
	global $db;

	/**** Tambahan utk filter no_provinsi, no_kabupaten
	*****/
	$f_no_prov	= $_SESSION['SESSION_NO_PROPINSI']!='0'?" AND a.no_propinsi='".$_SESSION['SESSION_NO_PROPINSI']."' ":"";
	$f_no_kabta	= $_SESSION['SESSION_NO_KABUPATEN']!='0'?" AND a.no_kabupaten='".$_SESSION['SESSION_NO_KABUPATEN']."' ":"";

	/*** 07-08-2010 ***/
	$f_id_jns_jln	= $_SESSION['SESSION_JNS_JLN']!='0'?" AND a.id_jns_jln='".$_SESSION['SESSION_JNS_JLN']."' ":"";
			
	$no_propinsi = $_GET['no_propinsi'];
	$no_kabupaten = $_GET['no_kabupaten'];
	//$jns_jln = $_GET['jns_jln'];
	
	/*** DEBUG 24-06-2010 
	print "no. propinsi:".$no_propinsi.",no. kabupaten:".$no_kabupaten." jns jln:".$jns_jln;
	***/
	
	$sql_paket = " SELECT b.id_fjl_06_detail,b.nama_paket,a.id_jns_jln,b.masalah FROM tbl_form_jl_06_main a
					LEFT JOIN tbl_form_jl_06_detail b ON a.id_fjl_06_main=b.id_fjl_06_main 
					WHERE (a.no_propinsi='".$no_propinsi."' $f_no_prov) AND (a.no_kabupaten='".$no_kabupaten."' $f_no_kabta) $f_id_jns_jln
					ORDER BY b.id_fjl_06_detail ASC ";

	$result_paket = $db->Execute($sql_paket);
	$input_paket="<select name=no_paket_".$no_paket." id=".$no_paket." size=10 onchange=\"hidePaket('".$no_paket."')\">";
	$input_paket.="<option>[Pilih Nama Paket]</option>";
	while(!$result_paket ->EOF):
		$nm_jns_jln	= $result_paket->fields['id_jns_jln']==1?"Provinsi":"Kabupaten/ Kota";
		$input_paket.="<option value='";
		$input_paket.= $result_paket->fields['id_fjl_06_detail']."||".trim($result_paket->fields['nama_paket'])."||".$result_paket->fields['id_jns_jln']."'>".$result_paket ->fields['nama_paket'];
		$input_paket.="</option>";
	$result_paket->MoveNext();
	endwhile;
	$input_paket.="</select>";
	return $input_paket;
}

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

//-------------MASTER NAMA PAKET---------------------------

if($_GET[get_data_paket]==1) {
	
	$no_paket = $_GET[no_paket];
	
	//
	$delimeter   = "-";
	$option_choice = "<textarea name=\"nama_paket_".$no_paket."\" cols=\"39\" rows=\"2\" wrap=\"virtual\" id=\"nama_paket_".$no_paket."\" readonly  class=\"imgLink\">Pilih Nama Paket !!</textarea>"."^/&".NamaPaket($no_paket)."^/&".$delimeter;	
	echo $option_choice;

}

//----------Menampilkan Data Kabupaten---------------------------

if ($_GET[get_propinsi] == 1)
{
	$no_propinsi = $_GET[no_propinsi];
			if($no_propinsi!=''){	
					$sql_kab_combo 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$no_propinsi' ORDER BY nama_kabupaten ASC ";
					$result_kab_combo  = $db->Execute($sql_kab_combo);
					$input_kab="<select name=no_kabupaten onchange=\"removeRowAllFromTable()\">";
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


if($_GET[getAllData]==1) {
		/**** Tambahan utk filter no_provinsi, no_kabupaten
		*****/
		$f_no_prov	= $_SESSION['SESSION_NO_PROPINSI']!='0'?" AND b.no_propinsi='".$_SESSION['SESSION_NO_PROPINSI']."' ":"";
		$f_no_kabta	= $_SESSION['SESSION_NO_KABUPATEN']!='0'?" AND b.no_kabupaten='".$_SESSION['SESSION_NO_KABUPATEN']."' ":"";

		/*** 07-08-2010 ***/
		$f_id_jns_jln	= $_SESSION['SESSION_JNS_JLN']!='0'?" AND a.id_jns_jln='".$_SESSION['SESSION_JNS_JLN']."' ":"";
				
		$no_propinsi=$_GET[no_propinsi];
		$no_kabupaten=$_GET[no_kabupaten];
		$tahun=$_GET[tahun];
		$triwulan=$_GET[triwulan];
		$jns_jln=$_GET[jns_jln];
		$jns = $_GET[jns]?$_GET[jns]:$_GET[jns_jln];
		
		$sql = "SELECT b.id_fjl_07_main,a.id_jns_jln,a.id_fjl_07_detail,a.no_paket,c.nama_paket as nama_paket,c.masalah as m,a.pemecahan,a.instansi,a.status_perkembangan  
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_07_main=b.id_fjl_07_main 
		LEFT JOIN tbl_form_jl_06_detail c ON c.id_fjl_06_detail=a.no_paket
		WHERE 1=1 ";
		
		/*** remark 27-07-2010
		if($no_propinsi!='' AND $no_kabupaten!='' AND $tahun!='' AND $triwulan!='' AND $jns!=''){
			$sql .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' 
					AND b.tahun='".$tahun."' AND b.triwulan='".$triwulan."' AND a.id_jns_jln='".$jns."' ";
		}		
		***/
		if($no_propinsi!='' AND $no_kabupaten!='' AND $tahun!='' AND $triwulan!='' AND $jns!=''){
			$sql .= "AND ( b.no_propinsi='".$no_propinsi."' $f_no_prov ) AND ( b.no_kabupaten='".$no_kabupaten."' $f_no_kabta ) 
					AND b.tahun='".$tahun."' AND b.triwulan='".$triwulan."' AND (a.id_jns_jln='".$jns."' $f_id_jns_jln ) ";
		}
				
		$sql .= "ORDER BY ".$ORDER." ".$SORT." ";
		
		//print $sql;
		
		$recordSetData = $db->Execute($sql);
		$jml_data = $recordSetData->numrows();
		
		$data_input = "<table id=\"tblItem\">";
		$z=0;
		while(!$recordSetData ->EOF): 		
			$no = $z+1;
			$data_input .= "<tr>";
			$data_input .= "<td class=\"tdatacontent-first-col\" style=\"width:25px;height:36px;vertical-align:center\">".$no.".</td>";
			$data_input .= "<td><div id=\"ajax_paket_".$z."\" onclick=\"showpaket(this.id);\" style=\"width:215px;\">
			<textarea name=\"nama_paket_".$z."\" cols=\"39\" rows=\"2\" wrap=\"virtual\" id=\"nama_paket_".$z."\" readonly  class=\"imgLink\">".$recordSetData  ->fields['nama_paket']."</textarea>
			<input type=\"hidden\" name=\"no_paket_select_".$z."\" value=\"".$recordSetData  ->fields['no_paket']."\">
			</div> 			
			<div id=\"ajax_paket_".$z."_select\" style=\"display:none;\">".NamaPaket($z)."</div></td>";
			$data_input .= "<td><DIV ID=\"ajax_masalah_".$z."\" style=\"width:200px;\"><textarea name=\"masalah_".$z."\" cols=\"38\" rows=\"2\" wrap=\"virtual\" id=\"masalah_".$z."\">".$recordSetData->fields['m']."</textarea></DIV></td>";
			$data_input .= "<td><DIV ID=\"ajax_penyelesaian_".$z."\" onclick=\"showpaket(this.id);document.getElementById('penyelesaian_".$z."_1').focus();\" style=\"width:200px;\"><textarea name=\"penyelesaian_".$z."\" cols=\"38\" rows=\"2\" wrap=\"virtual\" id=\"penyelesaian_".$z."\" readonly  class=\"imgLink\">".$recordSetData  ->fields['pemecahan']."</textarea></DIV>
	<DIV ID=\"ajax_penyelesaian_".$z."_select\" style=\"display:none;\"><table width=\"250\" bgcolor=\"#FFFFFF\" cellpadding=\"1\" cellspacing=\"1\" style=\"font:11px;border:#CCC solid 2px;\">
	<tr><td width=\"10\"><input type=\"checkbox\" class=\"checkbox\" name=\"penyelesaian_".$z."_0\" id=\"penyelesaian_".$z."_0\" value=\"Selesai\"/></td><td width=\"240\">Selesai <font color=\"red\">[klik sini jika telah selesai!]</font></td></tr>
	<tr><td colspan=\"2\"><textarea name=\"penyelesaian_".$z."_1\" cols=\"45\" rows=\"5\" wrap=\"virtual\" id=\"penyelesaian_".$z."_1\"></textarea></td></tr>
	<tr><td></td><td><a class=\"button\" href=\"#\" onclick=\"this.blur();OKManfaat(".$z.")\"><span><img src=\"".$HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images')."/icon/blank.gif\" align=\"absmiddle\">OK</span></a>
	<a class=\"button\" href=\"#\" onclick=\"CancelManfaat(".$z.")\"><span><img src=\"".$HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images')."/icon/blank.gif\" align=\"absmiddle\">Cancel</span></a></td></tr>
	</table></div></td>";
			$data_input .= "<td><DIV ID=\"ajax_instansi_".$z."\" style=\"width:150px;\"><textarea name=\"instansi_".$z."\" cols=\"28\" rows=\"2\" wrap=\"virtual\" id=\"instansi_".$z."\">".$recordSetData  ->fields['instansi']."</textarea></DIV></td>";
			$data_input .= "<td><DIV ID=\"ajax_status_perkembangan_".$z."\" style=\"width:150px;\"><textarea name=\"status_perkembangan_".$z."\" cols=\"26\" rows=\"2\" wrap=\"virtual\" id=\"status_perkembangan_".$z."\">".$recordSetData  ->fields['status_perkembangan']."</textarea></DIV></td>";
			$data_input .= "</tr>";
	
			$z++;
		$recordSetData->MoveNext();
		endwhile; 
		
		$data_input .= "</table>";
					$delimeter   = "-";
					$option_choice = $data_input."^/&".$delimeter;	
					echo $option_choice;
}
//---------------------------------------------------------------

if($no_propinsi!=''){	
	$sql_kabupaten 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$no_propinsi' ORDER BY nama_kabupaten ASC ";
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
	$sql_kabupaten 	  = "SELECT * FROM ".$tbl_name_kabupaten." WHERE no_propinsi='$MAIN_PROP' ORDER BY nama_kabupaten ASC ";
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
		
			
if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
		/***
		Kondisi jika id<>0
		1 = Provinsi
		2 = Kabupaten/ Kota
		***/
		$f_id_jns_jln	= $SES_JNS_JLN!='0'?" AND a.id_jns_jln='".$SES_JNS_JLN."' ":"";
		$f_no_propinsi	= $SES_NO_PROP!='0'?" AND b.no_propinsi='".$SES_NO_PROP."' ":"";
		$f_no_kabupaten	= $SES_NO_KAB!='0'?" AND b.no_kabupaten='".$SES_NO_KAB."' ":"";
		$tahun2			= ($tahun=="" || $tahun==0)?" AND b.tahun='".$SES_THN."' ":" AND b.tahun='".$tahun."' ";

		$sql_s_progres = "SELECT b.status_progres 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_07_main=b.id_fjl_07_main 
		WHERE 1=1 AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) $tahun2 AND b.triwulan='".$triwulan_search."' $f_id_jns_jln ";
		$recordSet_s_progres	= $db->execute($sql_s_progres);
		/***
		$tgl_status_progres	= explode("-",$recordSet_s_progres->fields[status_progres],strlen($recordSet_s_progres->fields[status_progres]));
		$status_progres	= strlen($tgl_status_progres[0])!=""?$tgl_status_progres[2]."-".$tgl_status_progres[1]."-".$tgl_status_progres[0]:"";
		****/
		$status_progres = $recordSet_s_progres->fields[status_progres];
		
		$sql_data_wilayah = "SELECT get_nama_propinsi(no_propinsi) as nama_propinsi,get_nama_kabupaten(no_propinsi,no_kabupaten) as nama_kabupaten FROM ".$tbl_name_kabupaten." WHERE no_propinsi='".$no_propinsi."' AND no_kabupaten='".$no_kabupaten."' ";
		$recordSet_wilayah = $db->execute($sql_data_wilayah);
		$nama_propinsi = $recordSet_wilayah->fields[nama_propinsi];
		$nama_kabupaten = $recordSet_wilayah->fields[nama_kabupaten];
		$id_jns_jln = $_POST["jns_jln"]?$_POST["jns_jln"]:$_GET["jns_jln"];
		
		/*** DEBUG 27-06-2010
		$smarty->assign("JENIS_JALAN_COBA",$id_jns_jln."-".$jns_jln);
		***/
		
		$sql = "SELECT b.id_fjl_07_main,a.id_jns_jln,a.id_fjl_07_detail,c.nama_paket as nama_paket,c.masalah,a.pemecahan,a.instansi 
		FROM ".$tbl_name_detail." a LEFT JOIN ".$tbl_name_main." b ON a.id_fjl_07_main=b.id_fjl_07_main 
		LEFT JOIN tbl_form_jl_06_detail c ON a.no_paket=c.id_fjl_06_detail
		WHERE 1=1 ";
		
		/***
		if($no_propinsi!='' AND $no_kabupaten!='' AND $tahun!='' AND $triwulan_search!='' AND $jns_jln!=''){
			$sql .= "AND b.no_propinsi='".$no_propinsi."' AND b.no_kabupaten='".$no_kabupaten."' 
					AND b.tahun='".$tahun."' AND b.triwulan='".$triwulan_search."' AND a.id_jns_jln='".$jns_jln."' ";
		}
		***/
		
		if($no_propinsi!='' AND $no_kabupaten!='' AND $triwulan_search!='' AND $jns_jln==''){
			$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) $tahun2 AND b.triwulan='".$triwulan_search."' $f_id_jns_jln ";
		} else if ($no_propinsi!='' AND $no_kabupaten!='' AND $triwulan_search!=''  AND $jns_jln!=''){
			$sql .= "AND (b.no_propinsi='".$no_propinsi."' $f_no_propinsi) AND (b.no_kabupaten='".$no_kabupaten."' $f_no_kabupaten) AND (a.id_jns_jln='".$jns_jln."' $f_id_jns_jln) $tahun2 AND b.triwulan='".$triwulan_search."' ";
		} else {
			$sql .= "AND b.no_propinsi='".$SES_NO_PROP."' AND b.no_kabupaten='".$SES_NO_KAB."' $f_id_jns_jln ";
		}		
		
		$sql .= "ORDER BY ".$ORDER." ".$SORT." ";
				
		if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);

		$numresults=$db->Execute($sql);
		$count = $numresults->RecordCount();

		$pages = $p->findPages($count,$LIMIT); 
		$sql  .= "LIMIT ".$start.", ".$LIMIT;
		$recordSet = $db->Execute($sql);
		$end = $recordSet->RecordCount();
		$smarty->assign ("ID_JL_07_MAIN", $recordSet->fields[id_fjl_07_main]);
		$smarty->assign ("JUM", $count);
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

($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;

$smarty->assign('TRIWULANARR', array(
			1 => 'Triwulan I',
			2 => 'Triwulan II',
			3 => 'Triwulan III',
			4 => 'Triwulan IV'));
			
$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_FORM_JL_07);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_FORM_JL_07);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_PROPINSI", $no_propinsi);
$smarty->assign ("NO_KABUPATEN", $no_kabupaten);
$smarty->assign ("NO_JENIS_JALAN", $id_jns_jln);
$smarty->assign ("NAMA_PROPINSI", $nama_propinsi);
$smarty->assign ("NAMA_KABUPATEN", $nama_kabupaten);
$smarty->assign ("DATA_STATUS_PROGRES", $status_progres);
$smarty->assign ("TAHUN", $tahun);
$smarty->assign ("TRIWULAN_SEARCH", $triwulan_search);
$smarty->assign ("TITLE", _TITLE_FORM_JL_07_MAIN);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_FORM_JL_07_MAIN);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("TB_NAMA_PAKET", _NAMA_PAKET);
$smarty->assign ("TB_INSTANSI", _NAMA_INSTANSI);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_FORM_JL_07_MAIN);
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
$smarty->assign ("PID_JENIS_JLN", $fields_find_jns_jln_);
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
$smarty->assign ("DAFTAR_STATUS_PROGRES",$daftar_status_progres);
$smarty->assign ("STATUS_ERROR", $status_error);

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