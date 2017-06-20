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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/master/libur';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/master');
$FILE_JS  = $JS_MODUL.'/libur';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "t_libur";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;
global $tbl_name;
global $field_name;

$sql  ="DELETE ";
$sql .="FROM $tbl_name ";
$sql .="WHERE  r_libur__id= '$_GET[id]' ";

$sqlresult = $db->Execute($sql);



}

function edit_()
{
    global $mod_id;
    global $db;
    global $tbl_name;
    global $field_name;

    $user_id = base64_decode($_SESSION['UID']);
    $id_peg = $_SESSION['SESSION_ID_PEG'];
    $tgl_now = date("Y-m-d h:i:s");

    $r_libur=$_POST[r_libur__id];
    $r_libur__shift = $_POST[nama_shift];
    $r_libur__tgl = $_POST[tgl_libur];
    $r_libur__ket = $_POST[keterangan];
    $r_libur__jenis=$_POST[jenis_libur];
    $sql_cek_id="SELECT t_libur.r_libur__id,t_libur.r_libur__shift,t_libur.r_libur__tgl 
        FROM t_libur WHERE r_libur__tgl = '$r_libur__tgl' AND r_libur__shift = '$r_libur__shift'";
    $rs_val = $db->Execute($sql_cek_id);
    $ceklibur__shift =$rs_val->fields['r_libur__shift'];
    $ceklibur__tgl =$rs_val->fields['r_libur__tgl'];


  if (($r_libur__shift==''))  
        {
            Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
        else
            {
                    $sql_edit  =" UPDATE $tbl_name SET ";
                    $sql_edit .=" r_libur__shift='$r_libur__shift',";
                    $sql_edit .=" r_libur__tgl='$r_libur__tgl',";
                    $sql_edit .=" r_libur__ket='$r_libur__ket',";
                    $sql_edit .=" r_libur__jenis='$r_libur__jenis',";
                    $sql_edit .=" r_libur__date_updated=now(),";
                    $sql_edit .=" r_libur__user_updated='$id_peg'";
                    $sql_edit .="  WHERE r_libur__id='$_POST[r_libur__id]' ";
                //   var_dump($sql_edit)or die();
                    $sqlresult = $db->Execute($sql_edit);
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&id_libur_cari=".$_POST[r_libur__id]);

                }
}

function create_()
{

global $mod_id;
global $db;
global $tbl_name;
global $field_name;

$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];
$tgl_now = date("Y-m-d h:i:s");
$r_libur__shift = $_POST[nama_shift];
$r_libur__tgl = $_POST[tgl_libur];
$r_libur__ket = $_POST[keterangan];
$r_libur__jenis=$_POST[jenis_libur];
$sql_cek_id="SELECT t_libur.r_libur__id,t_libur.r_libur__shift,t_libur.r_libur__tgl 
    FROM t_libur WHERE r_libur__tgl = '$r_libur__tgl' AND r_libur__shift = '$r_libur__shift'";
$rs_val = $db->Execute($sql_cek_id);
$ceklibur__shift =$rs_val->fields['r_libur__shift'];
$ceklibur__tgl =$rs_val->fields['r_libur__tgl'];


 if (($r_libur__shift=='') OR ($ceklibur__shift!='' AND $ceklibur__tgl!='' )) {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else
                {
                        $sql= "INSERT INTO $tbl_name ("
                                . "r_libur__shift,"
                                . "r_libur__tgl, "
                                . "r_libur__ket,"
                                . "r_libur__jenis,"
                                . "r_libur__date_created,"
                                . "r_libur__date_updated,"
                                . "r_libur__user_created,"
                                . "r_libur__user_updated)";

                        $sql	.= " VALUES ("
                                . "'$r_libur__shift',"
                                . "'$r_libur__tgl',"
                                . "'$r_libur__ket',"
                                . "'$r_libur__jenis',"
                                . " 'now()',"
                                . " 'now()',"
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
