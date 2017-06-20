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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/master/jabatan';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/master');
$FILE_JS  = $JS_MODUL.'/jabatan';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "r_jabatan";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;
global $tbl_name;
global $field_name;

$sql  ="DELETE ";
$sql .="FROM $tbl_name ";
$sql .="WHERE  r_jabatan__id= '$_GET[id]' ";

$sqlresult = $db->Execute($sql);



}

function edit_(){
global $mod_id;
global $db;
global $tbl_name;
global $field_name;


$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];
$tgl_now = date("Y-m-d h:i:s");

$r_jabatan__id=$_POST[r_jabatan__id];
$r_jabatan__level = $_POST[nama_level];
$r_jabatan__ket = $_POST[nama_jabatan];

$sql_cek_id="SELECT
                r_jabatan__id as r_jabatan__id,
                r_jabatan__ket as r_jabatan__ket,
                r_jabatan__level AS r_jabatan__level,
                r_level.r_level__ket AS r_level__ket,
                r_level.r_level__jabatan AS r_level__jabatan,
                 r_level.r_level__id AS r_level__id
                FROM
                  r_jabatan 
                  INNER JOIN r_level ON r_jabatan.r_jabatan__level=r_level.r_level__id 
                  WHERE r_jabatan__level='$r_jabatan__level' AND r_jabatan__ket='$r_jabatan__ket'";

$rs_val = $db->Execute($sql_cek_id);
$cekjabatan =$rs_val->fields['r_jabatan__ket'];
$ceklevel=$rs_val->fields['r_jabatan__level'];




  if (($r_jabatan__id==''))  
        {
            Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
        else
            {
            
           
                    $sql_edit  ="  UPDATE $tbl_name SET ";
                    $sql_edit .=" r_jabatan__ket='$r_jabatan__ket',";
                    $sql_edit .=" r_jabatan__level='$r_jabatan__level',";
          
                    $sql_edit .=" r_jabatan__date_updated=now(),";
                    $sql_edit .=" r_jabatan__user_updated='$id_peg'";
                    $sql_edit .="  WHERE r_jabatan__id='$r_jabatan__id' ";
                
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


$r_jabatan__level = $_POST[nama_level];
$r_jabatan__ket = $_POST[nama_jabatan];

$sql_cek_id="SELECT
                r_jabatan__id as r_jabatan__id,
                r_jabatan__ket as r_jabatan__ket,
                r_jabatan__level AS r_jabatan__level,
                r_level.r_level__ket AS r_level__ket,
                r_level.r_level__jabatan AS r_level__jabatan,
                 r_level.r_level__id AS r_level__id
                FROM
                  r_jabatan 
                  INNER JOIN r_level ON r_jabatan.r_jabatan__level=r_level.r_level__id 
                  WHERE r_jabatan__level='$r_jabatan__level' AND r_jabatan__ket='$r_jabatan__ket'";

$rs_val = $db->Execute($sql_cek_id);
$cekjabatan =$rs_val->fields['r_jabatan__ket'];
$ceklevel=$rs_val->fields['r_jabatan__level'];


 if (($r_jabatan__level=='' AND $r_jabatan__ket=='' ) OR ($cekjabatan==$r_jabatan__ket AND $ceklevel==$r_jabatan__level )) {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else
                {
                                    $sql= "INSERT INTO $tbl_name ("
                                            . "r_jabatan__ket,"
                                            . "r_jabatan__level, "
                                            . "r_jabatan__date_created,"
                                            . "r_jabatan__date_updated,"
                                            . "r_jabatan__user_created,"
                                            . "r_jabatan__user_updated)";
        

                                    $sql     .= " VALUES ("
                                            . "'$r_jabatan__ket',"
                                            . "'$r_jabatan__level',"
                                            . " now(),"
                                            . " now(),"
                                            . "'$id_peg',"
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
