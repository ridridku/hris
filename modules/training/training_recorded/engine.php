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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/training/training_recorded';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/training');
$FILE_JS  = $JS_MODUL.'/training_recorded';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "r_pelatihan";

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


$r_pel__id              = $_POST[id_pel];
$r_pel__mutasi          = $_POST[mutasi];
$r_pel__master_pel      = $_POST[id];
$r_pel__tema            = $_POST[tema];
$r_pel__no_sertifikat   =$_POST[sertifikat];
$r_pel__nilai           =$_POST[nilai];
$r_pel__document       = $_POST[file__xls];
$foto=$_FILES['file_xls']['name'] ;
$foto2=$_POST[foto2];
$cek_foto=$_POST[checkboxname];


IF($cek_foto==1)
{
    $image_name=$_POST[foto2];
}
else
{
     $image_name=$_POST[foto2];
    
}

    
    
   $sql_cek_no="SELECT
                r_pel__id,
                r_pel__mutasi,
                r_pel__master_pel,
                r_pel__tema,
                r_pel__no_sertifikat,
                r_pel__nilai,
                r_pel__document
              FROM r_pelatihan where r_pel__master_pel='$r_pel__master_pel' ";
  
   $rs_val = $db->Execute($sql_cek_no);
   $master_id =$rs_val->fields['r_pel__master_pel'];
   $master_mutasi=$rs_val->fields['r_pel__mutasi'];
    
 if ($r_pel__id=='' OR  $master_id==$r_pel__master_pel AND $master_mutasi==$r_pel__mutasi ) {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else{
                    
 if($foto!="")
 {
         $target_dir ='./uploads/';
                    $target_file = $target_dir.basename($_FILES["file_xls"]["name"],$target_dir);  
                 //   chmod("$target_file",0777);
                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                    // Check if image file is a actual image or fake image
                    $check = getimagesize($_FILES["file_xls"]["tmp_name"]); 
                    if($check !== false) {
                                        $uploadMessageError = "File is an image - " . $check["mime"] . ".";
                                        $uploadOk = 1;
                                } else {
                                        $uploadMessageError = "File is not an image.";
                                        $uploadOk = 0;
                                }        
			// Check file size
			if ($_FILES["file_xls"]["size"] > 2000000) {
				$uploadMessageError = "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "GIF") {
				$uploadMessageError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
                         
                        
                            if (move_uploaded_file($_FILES["file_xls"]["tmp_name"], $target_file)) {
                                  chmod("$target_file",0775);
                                    $uploadMessageError = "The file ". basename($_FILES["file_xls"]["name"]). " has been uploaded.";
                                    $uploadOk=1;
                                  $image_name=$r_pel__id.'-'.$_FILES['file_xls']['name'];
                                 
                                     
                      } else {
                                    $uploadMessageError = "Sorry, there was an error uploading your file.";
                                    $uploadOk=0;
                            }
                          
                                   
                         
 }

                     
                    $sql_edit  ="  UPDATE $tbl_name SET ";
                    $sql_edit .=" r_pel__id='$r_pel__id',";
                    $sql_edit .=" r_pel__mutasi='$r_pel__mutasi',";
                    $sql_edit .=" r_pel__master_pel='$r_pel__master_pel',";
                    $sql_edit .=" r_pel__tema ='$r_pel__tema',";
                    $sql_edit .=" r_pel__no_sertifikat='$r_pel__no_sertifikat',";
                    $sql_edit .=" r_pel__nilai='$r_pel__nilai',";
                    $sql_edit .=" r_pel__document = '$image_name',";
                    $sql_edit .=" r_pel__date_updated = now(),";
                     $sql_edit .=" r_pel__user_updated = '$id_peg'";
                    $sql_edit .="  WHERE r_pel__id='$r_pel__id' ";
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

$r_pel__id              = $_POST[id_pel];
$r_pel__mutasi          = $_POST[mutasi];
$r_pel__master_pel      = $_POST[id];
$r_pel__tema            = $_POST[tema];
$r_pel__no_sertifikat   =$_POST[sertifikat];
$r_pel__nilai           =$_POST[nilai];
$r_pel__document       = $_POST[file__xls];
$foto=$_FILES['file_xls']['name'] ;

error_reporting(E_ALL ^ E_NOTICE);
error_reporting(0);
//  ini_set("display_errors",1);
ini_set("memory_limit","1024M");

 if($foto!="")
 {
         $target_dir ='./uploads/';
                    $target_file = $target_dir.basename($_FILES["file_xls"]["name"],$target_dir);  
                 //   chmod("$target_file",0777);
                    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
                    // Check if image file is a actual image or fake image
                    $check = getimagesize($_FILES["file_xls"]["tmp_name"]); 
                    if($check !== false) {
                                        $uploadMessageError = "File is an image - " . $check["mime"] . ".";
                                        $uploadOk = 1;
                                } else {
                                        $uploadMessageError = "File is not an image.";
                                        $uploadOk = 0;
                                }        
			// Check file size
			if ($_FILES["file_xls"]["size"] > 2000000) {
				$uploadMessageError = "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "GIF") {
				$uploadMessageError = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
                         
                        
                            if (move_uploaded_file($_FILES["file_xls"]["tmp_name"], $target_file)) {
                                  chmod("$target_file",0775);
                                    $uploadMessageError = "The file ". basename($_FILES["file_xls"]["name"]). " has been uploaded.";
                                    $uploadOk=1;
                                  $image_name=$r_pel__id.'-'. $_FILES['file_xls']['name'];
                                  //   $nama_asli = $_FILES['file_xls']['name'].'-'.$id_peg;  
                                     
                      } else {
                                    $uploadMessageError = "Sorry, there was an error uploading your file.";
                                    $uploadOk=0;
                            }
                            //   var_dump($image_name)or die();
                                   
                         
 }

    
   $sql_cek_no="SELECT
                r_pel__id,
                r_pel__mutasi,
                r_pel__master_pel,
                r_pel__tema,
                r_pel__no_sertifikat,
                r_pel__nilai,
                r_pel__document
              FROM r_pelatihan where r_pel__master_pel='$r_pel__master_pel' ";
   

   $rs_val = $db->Execute($sql_cek_no);
   $master_id =$rs_val->fields['r_pel__master_pel'];
   $master_mutasi=$rs_val->fields['r_pel__mutasi'];
   
 
 if ($r_pel__id=='' OR $master_id==$r_pel__master_pel AND $master_mutasi== $r_pel__mutasi) {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else
                {
                    
                                    $sql= "INSERT INTO $tbl_name ("
                                            . "r_pel__id,"
                                            . "r_pel__mutasi, "
                                            . "r_pel__master_pel,"
                                            . "r_pel__tema,"
                                            . "r_pel__no_sertifikat, "
                                            . "r_pel__nilai, "
                                            . "r_pel__document,"
                                            . "r_pel__date_created,"
                                            . "r_pel__user_created)";
 
                                    $sql	.= " VALUES ("
                                            . "'$r_pel__id',"
                                            . "'$r_pel__mutasi',"
                                            . "'$r_pel__master_pel',"
                                            . "'$r_pel__tema',"
                                            . "'$r_pel__no_sertifikat',"
                                            . "'$r_pel__nilai',"
                                            . "'$image_name',"
                                            . "now(),"
                                            . "'$id_peg')";   
                                    
                                    //   var_dump($sql)or die();
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
