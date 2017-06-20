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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/payroll/kemahalan';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/payroll');
$FILE_JS  = $JS_MODUL.'/kemahalan';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "r_subcabang";

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


$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];

 $app_subcab= $_POST['subcab__id'];  
 
if (!empty($app_subcab))
    {
    $bad_symbols = array(",", ".");
    $subcab_array=$_POST['subcab__id'];
    $cabang_array=$_POST['cabang__id'];
    $bpjs_array=str_replace($bad_symbols,"",$_POST['dasar_bpjs']);
    $kemahalan_array=str_replace($bad_symbols,"",$_POST['kemahalan']);
    
    for ($i = 0; $i < count($subcab_array); $i++) 
    {
        $subcab_id = mysql_real_escape_string($subcab_array[$i]);
        $cabang_id= mysql_real_escape_string($cabang_array[$i]);
        $bpjs= mysql_real_escape_string($bpjs_array[$i]);
        $kemahalan=mysql_real_escape_string($kemahalan_array[$i]);
        
     
//--------------PERIODE AFTER CLOSING---------------------//        
        
         $cek_status="SELECT
	r_cabang.r_cabang__id,r_subcabang.r_subcab__id FROM
	r_cabang INNER JOIN r_subcabang On r_subcabang.r_subcab__cabang=r_cabang.r_cabang__id
        WHERE 	r_cabang.r_cabang__id ='$cabang_id' and r_subcabang.r_subcab__id='$subcab_id'";

        $rs_val = $db->Execute($cek_status);
        $status_cab= $rs_val->fields['r_cabang__id'];
        $status_subcab= $rs_val->fields['r_subcab__id'];
            
      
  
if($status_cab=='' && $status_subcab=='' )
    {
    
      Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
    
    }
    elseif($status_cab!='' && $status_subcab!='')
{
        $sql_edit  ="  UPDATE $tbl_name SET ";
        $sql_edit .=" r_subcab__cabang= '$cabang_id',";
        $sql_edit .=" r_subcab__id='$subcab_id',";
        $sql_edit .=" r_subcab__dasarbpjs='$bpjs',";
        $sql_edit .=" r_subcab__kemahalan='$kemahalan',";
        $sql_edit .="r_subcab__date_updated= now(),";
        $sql_edit .="r_subcab__date_created=now(),";
        $sql_edit .="r_subcab__user_created='$id_peg',"	;
        $sql_edit .="r_subcab__user_updated='$id_peg'";	
        $sql_edit .="  WHERE r_subcab__id='$status_subcab' and r_subcab__cabang='$status_cab' ";
    
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
