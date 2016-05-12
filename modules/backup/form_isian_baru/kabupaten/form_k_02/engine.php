<?php

# Including Main Configuration
# including file for Main Configurations
require_once('../../../../includes/config.conf.php');
require_once('../../../../includes/funct.php');

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

# including Header file for Content Expiring
require_once($DIR_INC.'/header.exp.inc');
# including Header file for Database Configuration
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.locker.php');

$db = &ADONewConnection($DB_TYPE);
//$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
//------------------------------------LOCAL CONFIG--------------------------------------//
#SETTING FOR TEMPLATE 
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/form_isian/kabupaten/form_k_02';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/form_isian');
$FILE_JS  = $JS_MODUL.'/kabupaten/form_k_02';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name_main	= "tbl_form_k_02_main";
$tbl_name_detail	= "tbl_form_k_02_detail";
$tmp_tbl_name_main	= "tmp_tbl_form_k_02_main";
$tmp_tbl_name_detail	= "tmp_tbl_form_k_02_detail";

$jenis = array();
$jens_jln	= array();

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_($id){
global $mod_id;
global $db;
global $_POST, $_GET;
global $tbl_name_main;
global $tbl_name_detail;

$sql  ="DELETE ";
$sql .="FROM ".$tbl_name_main." ";
$sql .="WHERE id_usulan = $id";

$sqlresult = $db->Execute($sql);
//print $sql;
}

function edit_(){
global $mod_id;
global $db;
global $_POST, $_GET;
global $tbl_name_main;
global $tbl_name_detail;

$tgl = explode("-",$_POST["tanggal_usulan"],strlen($_POST["tanggal_usulan"])); // dd-mm-YYYY
$format_tgl = $tgl[2]."-".$tgl[1]."-".$tgl[0]; // YYYY-mm-dd

$sql = " UPDATE `".$tbl_name_main."` SET `tanggal_usulan`=" .sqlvalue($format_tgl, true) .", 
		`nama_penggisi_usulan`=" .sqlvalue(@$_POST["nama_penggisi_usulan"], true) .", 
		`no_propinsi`=" .sqlvalue(@$_POST["no_propinsi"], false) .", 
		`no_kabupaten`=" .sqlvalue(@$_POST["no_kabupaten"], false) ." 
		WHERE " ."(`id_usulan`=" .sqlvalue(@$_POST["xid_usulan_main"], false) .")";

//print "----- DEBUG 1:".$sql."<br>";
$sqlresult = $db->Execute($sql);

//print $_POST['txt_hidden_jns_jln']." - ".$_POST['jns_jln'];

for($i=0;$i<$_POST[jum_rows1];$i++) {	
	$jens_jln[$i]	= $_POST["txt_jns_jln_tblItem1_".$i]=="Provinsi"? "1":"2";
	//print $jens_jln[$i]."|";
	//if($i>$jens_jln[$i]) print "<br>";
	$sql2  ="DELETE ";
	$sql2 .="FROM tbl_form_k_02_detail ";
	$sql2 .="WHERE id_usulan_main = " .sqlvalue(@$_POST["xid_usulan_main"], false) ." AND id_jns_jln='".$jens_jln[$i]."' ";
	
	$sqlresult = $db->Execute($sql2);
	//print "----- DEBUG 2:".$sql2."<br>";	
}


$sql3 = " INSERT INTO `".$tbl_name_detail."` (`id_usulan_main`, `kelompok_prioritas`, `no_ruas`, `nama_ruas`, `panjang`, 
		`kondisi`, `lebar`, `lhr_roda_4`, `kota_aktivitas_dilayani`,`id_jns_jln`) 
		VALUES ";

$data_query = "";
		
for($i=0;$i<$_POST[jum_rows1];$i++) {	
	$jens_jln[$i]	= $_POST["txt_jns_jln_tblItem1_".$i]=="Provinsi"? "1":"2";
	
	$data_query .="(" .sqlvalue(@$_POST["xid_usulan_main"], false) .", " .sqlvalue(@$_POST["kelompok_tblItem1_".$i], true) .", 
		" .sqlvalue(@$_POST["no_ruas_tblItem1_".$i], true) .", " .sqlvalue(@$_POST["nama_ruas_tblItem1_".$i], true) .", 
		" .sqlvalue(@$_POST["panjang_tblItem1_".$i], false) .", " .sqlvalue(@$_POST["kondisi_tblItem1_".$i], true) .", 
		" .sqlvalue(@$_POST["lebar_tblItem1_".$i], false) .", " .sqlvalue(@$_POST["lhr_tblItem1_".$i], false) .", 
		" .sqlvalue(@$_POST["kota_tblItem1_".$i], true) .", ".$jens_jln[$i]. "),";
}
for($y=0;$y<$_POST[jum_rows2];$y++) {
	$jens_jln2[$i]	= $_POST["txt_jns_jln_tblItem2_".$i]=="Provinsi"? "1":"2";
		
	$data_query .="(" .sqlvalue(@$_POST["xid_usulan_main"], false) .", " .sqlvalue(@$_POST["kelompok_tblItem2_".$y], true) .", 
		" .sqlvalue(@$_POST["no_ruas_tblItem2_".$y], true) .", " .sqlvalue(@$_POST["nama_ruas_tblItem2_".$y], true) .", 
		" .sqlvalue(@$_POST["panjang_tblItem2_".$y], false) .", " .sqlvalue(@$_POST["kondisi_tblItem2_".$y], true) .", 
		" .sqlvalue(@$_POST["lebar_tblItem2_".$y], false) .", " .sqlvalue(@$_POST["lhr_tblItem2_".$y], false) .", 
		" .sqlvalue(@$_POST["kota_tblItem2_".$y], true) .", ".$jens_jln2[$i]."),";
}	

//print "----- DEBUG 3:".$sql3.substr($data_query,0,-1)." ";
$sqlresult = $db->Execute($sql3.substr($data_query,0,-1));  
}

function create_(){
global $mod_id;
global $db;
global $_POST, $_GET;
global $tbl_name_main;
global $tbl_name_detail;	

$tgl = explode("-",$_POST["tanggal_usulan"],strlen($_POST["tanggal_usulan"])); // dd-mm-YYYY
$format_tgl = $tgl[2]."-".$tgl[1]."-".$tgl[0]; // YYYY-mm-dd

$sql = "INSERT INTO `".$tbl_name_main."` (`tanggal_usulan`, `nama_penggisi_usulan`, `no_propinsi`, `no_kabupaten`)
		VALUES (" .sqlvalue($format_tgl, true) .", " .sqlvalue(@$_POST["nama_penggisi_usulan"], true) .", 
		" .sqlvalue(@$_POST["no_propinsi"], false) .", " .sqlvalue(@$_POST["no_kabupaten"], false) .")";

$sqlresult = $db->Execute($sql);
$_main_id = $db->Insert_ID();
//print $sql."<br>";

$sql2 = " INSERT INTO `".$tbl_name_detail."` (`id_usulan_main`, `kelompok_prioritas`, `no_ruas`, `nama_ruas`, `panjang`, 
		`kondisi`, `lebar`, `lhr_roda_4`, `kota_aktivitas_dilayani`, `id_jns_jln`) 
		VALUES ";

$data_query = "";
		
for($i=0;$i<$_POST[jum_rows1];$i++) {	
	$jens_jln[$i]	= $_POST["txt_jns_jln_tblItem1_".$i]=="Provinsi"? "1":"2";
	$data_query .="(".$_main_id.", " .sqlvalue(@$_POST["kelompok_tblItem1_".$i], true) .", 
		" .sqlvalue(@$_POST["no_ruas_tblItem1_".$i], true) .", " .sqlvalue(@$_POST["nama_ruas_tblItem1_".$i], true) .", 
		" .sqlvalue(@$_POST["panjang_tblItem1_".$i], false) .", " .sqlvalue(@$_POST["kondisi_tblItem1_".$i], true) .", 
		" .sqlvalue(@$_POST["lebar_tblItem1_".$i], false) .", " .sqlvalue(@$_POST["lhr_tblItem1_".$i], false) .", 
		" .sqlvalue(@$_POST["kota_tblItem1_".$i], true) .", " .$jens_jln[$i]."),";
		//print $jens_jln;
}
for($i=0;$i<$_POST[jum_rows2];$i++) {	
	$jens_jln2[$i]	= $_POST["txt_jns_jln_tblItem2_".$i]=="Provinsi"? "1":"2";
	$data_query .="(".$_main_id.", " .sqlvalue(@$_POST["kelompok_tblItem2_".$i], true) .", 
		" .sqlvalue(@$_POST["no_ruas_tblItem2_".$i], true) .", " .sqlvalue(@$_POST["nama_ruas_tblItem2_".$i], true) .", 
		" .sqlvalue(@$_POST["panjang_tblItem2_".$i], false) .", " .sqlvalue(@$_POST["kondisi_tblItem2_".$i], true) .", 
		" .sqlvalue(@$_POST["lebar_tblItem2_".$i], false) .", " .sqlvalue(@$_POST["lhr_tblItem2_".$i], false) .", 
		" .sqlvalue(@$_POST["kota_tblItem2_".$i], true) .", ".$jens_jln2[$i]."),";
		//print $jens_jln2;
}	
$sqlresult = $db->Execute($sql2.substr($data_query,0,-1));  

//$sqlresult = $sql2.substr($data_query,0,-1);  
//print "</br>".$sqlresult;
}

/*** 20-08-2010 ***/
function import_() {
	global $mod_id;
	global $db;	
	global $DB_TYPE;
	global $DB_NAME;
	global $_POST, $_GET;
	global $tbl_name_main;
	global $tbl_name_detail;	
	global $tmp_tbl_name_main;
	global $tmp_tbl_name_detail;
	$tb_import = &ADONewConnection($DB_TYPE);
	
	//$db->debug = true;
	$tb_import->Connect($_POST['hostname1'], $_POST['username1'], $_POST['password1'], $DB_NAME);
	//------------------------------------LOCAL CONFIG--------------------------------------//
	$conn=mysql_connect($_POST['hostname1'],$_POST['username1'],$_POST['password1']);
	if(!$conn)
    {

        echo("<BR><BR>Koneksi Gagal<BR><BR>");

    }

    else
	{
	$get_sql		= " SELECT * FROM `".$tmp_tbl_name_main."`";
	//print $get_sql;
	$get_recordSet 	= $tb_import->Execute($get_sql);
	@$count = $get_recordSet->RecordCount();
	if (@$count!='') {//if1
	$z=1;
	while ($arr=$get_recordSet->FetchRow()) {
		$sql_insert = " INSERT INTO `".$tbl_name_main."` (`tanggal_usulan`, `nama_pengisi_usulan`, `no_propinsi`, `no_kabupaten`) 
				VALUES (".sqlvalue(@$arr["tanggal_usulan"], true).", ".sqlvalue(@$arr["nama_pengisi_usulan"], true).",
				" .sqlvalue(@$arr["no_propinsi"], false) .", " .sqlvalue(@$arr["no_kabupaten"], false) .")";
		$sql_exec = $tb_import->Execute($sql_insert);
		
		$sql_detail	=  " SELECT * FROM `".$tmp_tbl_name_detail."` WHERE id_usulan_main='$arr[id_usulan_main]' ";
		$get_recordSet2	= $tb_import->Execute($sql_detail);
		if($get_recordSet2->RecordCount()>0) {
			while ($arr2=$get_recordSet2->FetchRow()) {
				$sql_insert2 = " INSERT INTO `".$tbl_name_detail."` (`id_usulan_main`,`kelompok_prioritas`,`no_ruas`,`nama_ruas`,`panjang`,`kondisi`,`lebar`,`lhr_roda_4`,`kota_aktivitas_dilayani`,`id_jns_jln`) VALUES (
					(SELECT MAX(id_usulan) FROM ".$tbl_name_main."), 
					" .sqlvalue(@$arr2["kelompok_prioritas"], true) .", 
					" .sqlvalue(@$arr2["no_ruas"], true) .", 
					" .sqlvalue(@$arr2["nama_ruas"], false) .", 
					" .sqlvalue(@$arr2["panjang"], false) .", 
					" .sqlvalue(@$arr2["kondisi"], false) .", 
					" .sqlvalue(@$arr2["lebar"], false) .", 
					" .sqlvalue(@$arr2["lhr_roda_4"], false) .", 
					" .sqlvalue(@$arr2["kota_aktivitas_dilayani"], false) .", 
					" .sqlvalue(@$arr2["id_jns_jln"], true) .") ";
					
				$sql_exec2 = $tb_import->Execute($sql_insert2);
				
			}
			$sql_del = "DELETE FROM `".$tmp_tbl_name_detail."`WHERE id_usulan='$arr[id_usulan]' ";
			$sql_exec3 = $tb_import->Execute($sql_del);
			$sql_del2 = "DELETE FROM `".$tmp_tbl_name_main."` WHERE id_usulan='$arr[id_usulan]' ";
			$sql_exec4 = $tb_import->Execute($sql_del2);
		//}
		$z++;
	Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_POST[jns_jln]);
		} else {
			
			echo "Tidak ada data yang akan di eksport";
	
		}//end if 2
		
		}//end while1
		}//end if1
	}	//end else
}//end func
/*** End 0f Date ***/

if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];

for($i=0;$i<$_POST[jum_rows1];$i++) {
	$j1[$i]= $_POST["txt_jns_jln_tblItem1_".$i]=="Provinsi"? "1":"2";
}

for($i=0;$i<$_POST[jum_rows1];$i++) {
	$j2[$i]= $_POST["txt_jns_jln_tblItem2_".$i]=="Provinsi"? "1":"2";
}
$jenis	= $j1[0]!=""?$j1:$j2;

switch ($op){

case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
		//lockTables($tbl_name_main);
		//lockTables($tbl_name_detail);
		
		create_();		
		
		/***
		print "----- DEBUG :".$jenis[0];
		***/
		
		//unlockTables($tbl_name_main);	
		//unlockTables($tbl_name_detail);	
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$jenis[0]."&txt_hidden_jns_jln=".$_POST[txt_hidden_jns_jln]);
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_();
		/***
		print "----- DEBUG:".$jenis[0].$_GET['jns_jln'];
		***/
		//unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_POST[no_propinsi]."&no_kabupaten=".$_POST[no_kabupaten]."&Search_Year=".$_POST[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$jenis[0]."&txt_hidden_jns_jln=".$_GET[txt_hidden_jns_jln]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		lockTables($tbl_name_main);
		
		delete_($_GET['id_usulan_main']);
		
		/***
		print "------- DEBUG :".$_GET['id_usulan_main']." --- DEBUG:".$_GET['jns_jln_'];
		***/
		
		unlockTables($tbl_name_main);		
		Header("Location:index.php?mod_id=$mod_id&no_propinsi=".$_GET[no_propinsi]."&no_kabupaten=".$_GET[no_kabupaten]."&Search_Year=".$_GET[Search_Year]."&search=1&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jns_jln=".$_GET['jns_jln_']."&txt_hidden_jns_jln=".$_GET[txt_hidden_jns_jln]);
	}
break;
}
}
?>