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
require_once($DIR_INC.'/func.inc.php');
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
$tbl_name	= "r_angsuran";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

$sql  ="DELETE ";
$sql .="FROM $tbl_name ";
$sql .="WHERE  r_ang__id= '$_GET[id]' ";

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
    $r_ang__id = $_POST[r_ang__id];
    $r_ang__jenis = $_POST[r_ang__jenis];
    $r_ang__platfond = remove_non_numerics($_POST[r_ang__platfond]);
    $r_ang__ket  = $_POST[r_ang__ket];
    $r_ang__total = remove_non_numerics($_POST[r_ang__total]);
    $r_ang__tenor_bulan = $_POST[r_ang__tenor_bulan];
    $r_ang__cicilan    = remove_non_numerics($_POST[r_ang__cicilan]);
    $r_ang__user_updated= $id_peg;

 

                    $sql_edit  ="  UPDATE $tbl_name SET ";
                 
                    $sql_edit .=" r_ang__jenis='$r_ang__jenis',";
                    $sql_edit .=" r_ang__platfond='$r_ang__platfond',";
                    $sql_edit .=" r_ang__ket='$r_ang__ket',";
                    $sql_edit .=" r_ang__total='$r_ang__total',";
                    $sql_edit .=" r_ang__tenor_bulan='$r_ang__tenor_bulan',";
                    $sql_edit .=" r_ang__cicilan='$r_ang__cicilan',";
                    $sql_edit .=" r_ang__date_updated = now(), ";
                    $sql_edit .=" r_ang__user_updated = '$id_peg'";
                    $sql_edit .="  WHERE r_ang__id='$r_ang__id' ";
                   
                    $sqlresult = $db->Execute($sql_edit);
                     
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		
             
}

function create_(){
    
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;


$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];

$r_ang__jenis    = $_POST[r_ang__jenis];
$r_ang__platfond = remove_non_numerics($_POST[r_ang__platfond]);
$r_ang__ket      = $_POST[r_ang__ket];
$r_ang__total    = remove_non_numerics($_POST[r_ang__total]);
$r_ang__tenor_bulan  = $_POST[r_ang__tenor_bulan];
$r_ang__cicilan   = remove_non_numerics($_POST[r_ang__cicilan]);
$t_sp__user_created = $id_peg;

  


 if ($r_ang__jenis=='') {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else
                {
                                    $sql= "INSERT INTO $tbl_name ("
                                            . "r_ang__jenis,"
                                            . "r_ang__platfond, "
                                            . "r_ang__ket,"
                                            . "r_ang__total,"
                                            . "r_ang__tenor_bulan, "
                                            . "r_ang__cicilan,"
                                            . "r_ang__date_created,"
                                            . "r_ang__user_created)";
 
                                    $sql	.= " VALUES ("
                                            . "'$r_ang__jenis',"
                                            . "'$r_ang__platfond',"
                                            . "'$r_ang__ket',"
                                            . "'$r_ang__total',"
                                            . "'$r_ang__tenor_bulan',"
                                            . "'$r_ang__cicilan',"
                                            . "now(),"
                                            . "'$id_peg')";
                                    var_dump($sql)or die();

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
