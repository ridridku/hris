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

# including Header file for Content Expiring
require_once($DIR_INC.'/header.exp.inc');
# including Header file for Database Configuration
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.locker.php');

$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
//------------------------------------LOCAL CONFIG--------------------------------------//
#SETTING FOR TEMPLATE 
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kehadiran/surat_cuti';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kehadiran');
$FILE_JS  = $JS_MODUL.'/surat_cuti';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "t_surat_peringatan";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

$sql  ="DELETE ";
$sql .="FROM $tbl_name ";
$sql .="WHERE  t_sp__no= '$_GET[id]' ";

$sqlresult = $db->Execute($sql);



}

function edit_(){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;
       //$r_pegawai__no_askes = addslashes($_POST[r_pegawai__no_askes]);
       
    $user_id = base64_decode($_SESSION['UID']);
    $id_peg = $_SESSION['SESSION_ID_PEG'];
    $tgl_now = date("Y-m-d h:i:s");


    $kode_cabang    = $_POST[kode_cabang];
    $t_sp__no       = $_POST[t_sp__no];
    $t_sp__nip      = $_POST[sp_nip];
    $t_sp__nama     = $_POST[sp_nama];
    $t_sp__jabatan  = $_POST[sp_jabatan];
    $t_sp__cabang   = $_POST[sp_cabang];
    $t_sp__tgl      = $_POST[sp_tgl];
    $t_sp__jenis    = $_POST[sp_jenis];
    $t_sp__alasan   = $_POST[sp_alasan];
    $t_sp__date_created = $tgl_now;
    $t_sp__user_created = $id_peg;

 
       $sql_cek_no="SELECT  A.t_sp__no,  A.t_sp__nip,  A.t_sp__tgl,  A.t_sp__jabatan,  A.t_sp__cabang,  A.t_sp__jenis,  A.t_sp__alasan
                       FROM t_surat_peringatan A where A.t_sp__nip='$t_sp__nip' ";

   $rs_val = $db->Execute($sql_cek_no);
   
   $cek_no__sp= $rs_val->fields['t_sp__no'];
  
   
   
   
    $sql_jml_sp="SELECT  count(A.t_sp__no) AS jml_sp FROM t_surat_peringatan A where A.t_sp__nip='$t_sp__nip' ";

   $rs_val = $db->Execute($sql_jml_sp);
   
   $jml_sp= $rs_val->fields['jml_sp'];
 
 if ($t_sp__no=='') {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else{
                    $sql_edit  ="  UPDATE $tbl_name SET ";
                 
                    $sql_edit .=" t_sp__no='$t_sp__no',";
                    $sql_edit .=" t_sp__nip='$t_sp__nip',";
                    $sql_edit .=" t_sp__tgl='$t_sp__tgl',";
                    $sql_edit .=" t_sp__jabatan='$t_sp__jabatan',";
                    $sql_edit .=" t_sp__cabang='$t_sp__cabang',";
                    $sql_edit .=" t_sp__jenis='$t_sp__jenis',";
                    $sql_edit .="t_sp__alasan='$t_sp__alasan',";
                    
                    $sql_edit .=" t_sp__date_updated = now(), ";
                    $sql_edit .=" t_sp__user_updated = '$id_peg'";
                    $sql_edit .="  WHERE t_sp__no='$t_sp__no' ";
                   
                    $sqlresult = $db->Execute($sql_edit);
                     
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		
                }
}

function create_(){
    
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;


$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];
$tgl_now = date("Y-m-d h:i:s");


$kode_cabang    = $_POST[kode_cabang];
$t_sp__no       = $_POST[t_sp__no];
$t_sp__nip      = $_POST[sp_nip];
$t_sp__nama     = $_POST[sp_nama];
$t_sp__jabatan  = $_POST[sp_jabatan];
$t_sp__cabang   = $_POST[sp_cabang];
$t_sp__tgl      = $_POST[sp_tgl];
$t_sp__jenis    = $_POST[sp_jenis];
$t_sp__alasan   = $_POST[sp_alasan];
$t_sp__date_created = $tgl_now;
$t_sp__user_created = $id_peg;








    $sql_cek_no="SELECT  A.t_sp__no,  A.t_sp__nip,  A.t_sp__tgl,  A.t_sp__jabatan,  A.t_sp__cabang,  A.t_sp__jenis,  A.t_sp__alasan
                       FROM t_surat_peringatan A where A.t_sp__nip='$t_sp__nip' ";

   $rs_val = $db->Execute($sql_cek_no);
   
   $cek_no__sp= $rs_val->fields['t_sp__no'];
  
   
   
   
    $sql_jml_sp="SELECT  count(A.t_sp__no) AS jml_sp FROM t_surat_peringatan A where A.t_sp__nip='$t_sp__nip' ";

   $rs_val = $db->Execute($sql_jml_sp);
   
   $jml_sp= $rs_val->fields['jml_sp'];
   

 if ($cek_no__sp==$t_sp__no AND  $jml_sp>3) {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else
                {
                                    $sql= "INSERT INTO $tbl_name ("
                                            . "t_sp__no,"
                                            . "t_sp__nip, "
                                            . "t_sp__tgl,"
                                            . "t_sp__jabatan,"
                                            . "t_sp__cabang, "
                                            . "t_sp__jenis,"
                                            . "t_sp__alasan, "
                                            . "t_sp__date_created,"
                                            . "t_sp__user_created)";
 
                                    $sql	.= " VALUES ("
                                            . "'$t_sp__no',"
                                            . "'$t_sp__nip',"
                                            . "'$t_sp__tgl',"
                                            . "'$t_sp__jabatan',"
                                            . "'$t_sp__cabang',"
                                            . "'$t_sp__jenis',"
                                            . "'$t_sp__alasan',"
                                            . "'".strip_tags($t_sp__date_created)."',"
                                            . "'$id_peg')";
                                    //var_dump($sql)or die();

$sqlresult = $db->Execute($sql);
Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
                }

    
    
}

 
// TUTUP CREATE
 

if($_POST[op]) $op = $_POST[op]; else $op = $_GET[op];


switch ($op){

case 0:
	if (Privi($mod_id, $user_id, 'insert') != 'no')
	{
	//	lockTables($tbl_name);
		// create_($no_propinsi,$no_kab,$no_kec,$no_kel,$nama_kelurahan)
		create_();
		//unlockTables($tbl_name);		
		
	}
break;
case 1:
	if (Privi($mod_id, $user_id, 'edit') != 'no')
	{
		//lockTables($tbl_name);
		edit_();
		//unlockTables($tbl_name);		
		//Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
case 2:
	if (Privi($mod_id, $user_id, 'delete') != 'no')
	{
		//lockTables($tbl_name);
		delete_();
	//	unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
}


}
?>
