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
$_SESSION['LANG']       = $LANG;

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_pegawai/pegawai_keluar';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_pegawai');
$FILE_JS  = $JS_MODUL.'/pegawai_keluar';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "r_resign";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

$sql  ="DELETE ";
$sql .="FROM $tbl_name ";
$sql .="WHERE  r_resign__no= '$_GET[id]' ";

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


  
    $r_resign__no      = $_POST[rsg__no];
    $r_resign__tgl     = $_POST[rsg__tgl];
    $r_resign__mutasi  = $_POST[rsg__mutasi];
    $r_resign__approval= $_POST[rsg__approval];
    $r_resign__ket     = $_POST[rsg__ket]; 
    $r_resign__nip     = $_POST[rsg__nip];
    $r_resign__regretted=$_POST[keluhan];
    $t_sp__date_created = $tgl_now;
    $t_sp__user_created = $id_peg;


 
    $sql_cek_no="SELECT
                r_resign.r_resign__no,
                r_resign.r_resign__tgl,
                r_resign.r_resign__mutasi,
                r_resign.r_resign__approval,
                r_resign.r_resign__ket
                FROM
                r_resign WHERE   r_resign.r_resign__mutasi='$r_resign__mutasi' ";

   $rs_val = $db->Execute($sql_cek_no);
   $cek_mutasi= $rs_val->fields['r_resign__mutasi'];
  
    

   
   
 
 if ($r_resign__no=='' or $rs_val==false ) {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else{
                    
                    IF($r_resign__approval==0)
                    {
                        $aktif=1;
                    } else
                    {
                        
                        $aktif=0;
                    }
                    
                        $sql_edit7  =" UPDATE r_penempatan set ";
                        $sql_edit7 .=" r_pnpt__aktif = '$aktif' ,";
                        $sql_edit7 .=" r_pnpt__date_updated = now(), ";
                        $sql_edit7 .=" r_pnpt__user_updated = '$aktif' ";
                        $sql_edit7 .=" WHERE r_pnpt__no_mutasi='$cek_mutasi'";
			$sqlresult7 =  $db->Execute($sql_edit7);
 

                           
                        $sql_edit  =" UPDATE $tbl_name set ";
                        $sql_edit .=" r_resign__tgl='$r_resign__tgl',";
                        $sql_edit .=" r_resign__mutasi='$r_resign__mutasi',";
                        $sql_edit .=" r_resign__approval='$r_resign__approval',";
                        $sql_edit .=" r_resign__ket='$r_resign__ket',";
                        $sql_edit .=" r_resign__regretted='$r_resign__regretted',";
                        $sql_edit .=" r_resign__date_updated = now(), ";
                        $sql_edit .=" r_resign__user_updated = '$id_peg'";
                        $sql_edit .=" WHERE r_resign__no='$r_resign__no' ";
                        
                      
                        $sqlresult = $db->Execute($sql_edit);
                     
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&no_cari=".$r_resign__mutasi);
		
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

$kode_cabang        = $_POST[kode_cabang];
$r_resign__no       = $_POST[rsg__no];
$r_resign__nip      = $_POST[rsg__nip];
$r_resign__tgl      = $_POST[rsg__tgl];
$r_resign__approval = $_POST[rsg__approval];
$r_resign__mutasi   = $_POST[rsg__mutasi];
$r_resign__ket      = $_POST[rsg__ket];
 $r_resign__regretted=$_POST[keluhan];



   $sql_cek_no="SELECT  A.r_pnpt__no_mutasi AS no_mutasi,A.r_pnpt__nip AS r_pnpt__nip, A.r_pnpt__aktif AS r_pnpt__aktif
                 FROM r_penempatan A where A.r_pnpt__nip='$r_resign__nip' AND r_pnpt__aktif=1 ";
   $rs_val = $db->Execute($sql_cek_no);
   $no_mutasi   = $rs_val->fields['no_mutasi'];
   $nip         =$rs_val->fields['r_pnpt__nip'];
 

 if ($r_resign__nip=='' or $rs_val==false) {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else
                {
                  
                    if(!empty($r_resign__tgl)&&!empty($r_resign__mutasi)&&!empty($r_resign__ket)&&!empty($r_resign__regretted))
                    {
                                    $sql= "INSERT INTO $tbl_name ("
                                          
                                            . "r_resign__tgl, "
                                            . "r_resign__mutasi,"
                                            . "r_resign__approval,"
                                            . "r_resign__ket,"
                                            . "r_resign__regretted,"
                                            . "r_resign__date_created,"
                                            . "r_resign__date_updated,"
                                            . "r_resign__user_created,"
                                            . "r_resign__user_updated)";
 
                                    $sql	.= " VALUES ("
                                           
                                            . "'$r_resign__tgl',"
                                            . "'$r_resign__mutasi',"
                                            . "'$r_resign__approval',"
                                            . "'$r_resign__ket',"
                                            . "'$r_resign__regretted',"
                                            . "now(),"
                                            . "now(),"
                                            . "'$id_peg',"
                                            . "'$id_peg')";
                             

                        $sqlres = $db->Execute($sql); 
                    }
                    else
                    {
                      Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
                    }
                                       
                   if($sqlres==true)
                   {
                        $sql_edit7  ="UPDATE r_penempatan set ";
                        $sql_edit7 .="r_pnpt__aktif = '0' ";
                        $sql_edit7 .="  WHERE r_pnpt__nip='$nip' and r_pnpt__aktif='1'";    
			$sqlresult7 = $db->Execute($sql_edit7); 
                   }else{ 
                       
                        Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
                   }
                                            
                    
                        Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&no_cari=".$r_resign__mutasi);
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
