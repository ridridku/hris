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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/payroll/gapok_payroll';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/payroll');
$FILE_JS  = $JS_MODUL.'/gapok_payroll';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "r_gapok";

    $sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_awal,r_periode__payroll_akhir,r_periode__payroll_status "
                 . "FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
        $rs_val = $db->Execute($sql_cek_periode);
        $periode_awal= $rs_val->fields['r_periode__payroll_awal'];
        $periode_akhir= $rs_val->fields['r_periode__payroll_akhir'];

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM t_lembur ";
$sql .="WHERE  t_lembur__no= '$_GET[id]' ";
$sqlresult = $db->Execute($sql);



}

function edit_(){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;


function parse_number($number, $dec_point=null) {
    if (empty($dec_point)) {
        $locale = localeconv();
        $dec_point = $locale['decimal_point'];
    }
    return floatval(str_replace($dec_point, '.', preg_replace('/[^\d'.preg_quote($dec_point).']/', '', $number)));
}
$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];
  
        $sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_awal,r_periode__payroll_akhir,r_periode__payroll_status "
                 . "FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
        $rs_val = $db->Execute($sql_cek_periode);
        $periode_awal= $rs_val->fields['r_periode__payroll_awal'];
        $periode_akhir= $rs_val->fields['r_periode__payroll_akhir'];
  
 $app_count= $_POST['approval'];  
       
if (!empty($app_count)&&!empty($_POST['mutasi']))
    {
    $bad_symbols = array(",", ".");
    $approval_array=$_POST[approval];
    $mutasi_array=$_POST[mutasi];
    $nip_array=$_POST[nip];
    
    $cabang_id_array=$_POST[cabang__id];
    $subcab_id_array=$_POST[subcab__id];
    
    $gapok_array=str_replace($bad_symbols,"",$_POST[gapok]);
    $lain1_array=str_replace($bad_symbols,"",$_POST[lain1]);
     $lain2_array=str_replace($bad_symbols,"",$_POST[lain2]);
     
  
  
   for ($i = 0; $i < count($approval_array); $i++) 
    {
        
        $mutasi = mysql_real_escape_string($mutasi_array[$i]);
        $nip= mysql_real_escape_string($nip_array[$i]);
        $pegawai_id= mysql_real_escape_string($approval_array[$i]);
        $cabang_id= mysql_real_escape_string($cabang_id_array[$i]);       
        $subcab_id= mysql_real_escape_string($subcab_id_array[$i]);
        $gapok=mysql_real_escape_string($gapok_array[$i]);
        $lain1=mysql_real_escape_string($lain1_array[$i]);
        $lain2=mysql_real_escape_string($lain2_array[$i]);
   
    
        $cek_peg="SELECT r_gapok__idpeg FROM r_gapok where r_gapok.r_gapok__idpeg='$pegawai_id'";
        $rs_val = $db->Execute($cek_peg);
        $status_id= $rs_val->fields['r_gapok__idpeg'];

  
if($status_id=='')
    {
 //   var_dump('a')or die();
    $sql = "INSERT INTO $tbl_name (r_gapok__nip,"
                                        . "r_gapok__idpeg,"
                                        . "r_gapok__mutasi,"
                                        . "r_gapok__subcabang,"
                                        . "r_gapok__cabang,"
                                        . "r_gapok__nilai,"
                                        . "r_gapok__lain1,"
                                        . "r_gapok__lain2,"
                                        . "r_gapok__date_updated,"
                                        . "r_gapok__date_created,"
                                        . "r_gapok__user_created,"
                                        . "r_gapok__user_updated)";
                         
                                    $sql	.= " VALUES ("
                                            . " '$nip',"
                                            . " '$pegawai_id',"
                                            . " '$mutasi',"
                                            . " '$subcab_id',"
                                            . " '$cabang_id',"
                                            . " '$gapok',"
                                            . " '$lain1',"
                                            . " '$lain2',"
                                            . "now(),"
                                            . "now(),"
                                            . "'".strip_tags($id_peg)."',"
                                            . "'".strip_tags($id_peg)."')";
   
    $sqlresult = $db->Execute($sql);
    
    }


    elseif($status_id!='')
{  // var_dump('b')or die();
        $sql_edit  ="  UPDATE $tbl_name SET ";
//        $sql_edit .=" r_gapok__nip= '$nip',";
//        $sql_edit .=" r_gapok__idpeg='$pegawai_id',";
//        $sql_edit .=" r_gapok__subcabang='$subcab_id',";
//       $sql_edit .=" r_gapok__cabang='$cabang_id',";
        $sql_edit .=" r_gapok__nilai='$gapok',";
        $sql_edit .=" r_gapok__lain1='$lain1',";
        $sql_edit .="r_gapok__lain2='$lain2',";  
        $sql_edit .="r_gapok__date_updated= now(),";
        $sql_edit .="r_gapok__date_created=now(),";
        $sql_edit .="r_gapok__user_created='$id_peg',"	;
        $sql_edit .="r_gapok__user_updated='$id_peg'";	
        $sql_edit .="  WHERE r_gapok__idpeg='$pegawai_id'";
// var_dump($sql_edit)or die();
        $sqlresult = $db->Execute($sql_edit);
        
        
        
        
        } 
    
     

    } 
    
   
   
}


    Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
               
}

function create_(){

global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

    
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
