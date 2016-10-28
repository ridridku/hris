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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/manfaat/pengajuan_pinjaman';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/manfaat');
$FILE_JS  = $JS_MODUL.'/pengajuan_pinjaman';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "t_pinjaman";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

$sql  ="DELETE ";
$sql .="FROM $tbl_name ";
$sql .="WHERE  t_pjm__no_pinjaman= '$_GET[id]' ";

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


    $t_pjm__no_pinjaman    = $_POST[t_pjm__no_pinjaman];
    $t_pjm__jenis          = $_POST[t_pjm__jenis];
    $t_pjm__mutasi          = $_POST[mutasi];
    $t_pjm__tgl_disetujui     = $_POST[t_pjm__tgl_disetujui];
    $t_pjm__approval  = $_POST[t_pjm__approval];
    $t_pjm__keterangan   = $_POST[t_pjm__keterangan];

    $t_sp__user_created = $id_peg;


    
    
    
   $sql_cek_no="SELECT A.t_pjm__no_pinjaman,A.t_pjm__jenis,A.t_pjm__mutasi,A.t_pjm__tgl_disetujui,A.t_pjm__approval,A.t_pjm__keterangan 
                FROM t_pinjaman A where A.t_pjm__approval='1' AND A.t_pjm__no_pinjaman='$t_pjm__no_pinjaman' ";

   $rs_val = $db->Execute($sql_cek_no);
   $id_pjm =$rs_val->fields['t_pjm__no_pinjaman'];
   $no_pinjaman=$rs_val->fields['t_pjm__no_pinjaman'];
    
 if ($t_pjm__no_pinjaman=='' ) {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else{
                    $sql_edit  ="  UPDATE $tbl_name SET ";
                 
                    $sql_edit .=" t_pjm__jenis='$t_pjm__jenis',";
                    $sql_edit .=" t_pjm__mutasi='$t_pjm__mutasi',";
                    $sql_edit .=" t_pjm__tgl_disetujui='$t_pjm__tgl_disetujui',";
                    $sql_edit .=" t_pjm__approval='$t_pjm__approval',";
                    $sql_edit .=" t_pjm__keterangan='$t_pjm__keterangan',";
                    $sql_edit .=" t_pjm__date_updated = now(), ";
                    $sql_edit .=" t_pjm__user_updated = '$id_peg'";
                    $sql_edit .="  WHERE t_pjm__no_pinjaman='$t_pjm__no_pinjaman' ";
                   
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


$t_pjm__no_pinjaman = $_POST[t_pjm__no_pinjaman];
$t_pjm__jenis       = $_POST[t_pjm__jenis];
$t_pjm__mutasi      = $_POST[mutasi];
$t_pjm__tgl_disetujui= $_POST[t_pjm__tgl_disetujui];
$t_pjm__approval = $_POST[t_pjm__approval];
$t_pjm__keterangan      = $_POST[t_pjm__keterangan];

$t_pjm__user_created = $id_peg;

    $sql_cek_no="SELECT A.t_pjm__mutasi,"
            . "A.t_pjm__no_pinjaman,"
            . "A.t_pjm__jenis,"
            . "A.t_pjm__approval,"
            . "A.t_pjm__keterangan FROM t_pinjaman A where A.t_pjm__mutasi='$t_pjm__mutasi'  AND A.t_pjm__approval=1";
    
   $rs_val = $db->Execute($sql_cek_no);
   
   $cek_no=  count($rs_val->fields['t_pjm__mutasi']);

 if ($t_pjm__no_pinjaman=='' or $cek_no==1 ) {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else
                {
                                    $sql= "INSERT INTO $tbl_name ("
                                            . "t_pjm__no_pinjaman,"
                                            . "t_pjm__jenis, "
                                            . "t_pjm__mutasi,"
                                            . "t_pjm__tgl_disetujui,"
                                            . "t_pjm__approval, "
                                            . "t_pjm__keterangan,"
                                            . "t_pjm__date_created, "
                                            . "t_pjm__user_created)";
 
                                    $sql	.= " VALUES ("
                                            . "'$t_pjm__no_pinjaman',"
                                            . "'$t_pjm__jenis',"
                                            . "'$t_pjm__mutasi',"
                                            . "'$t_pjm__tgl_disetujui',"
                                            . "'$t_pjm__approval',"
                                            . "'$t_pjm__keterangan',"
                                            . "now(),"
                                            . "'$id_peg')";
                                   

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
