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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/jaminan/jaminan';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/jaminan');
$FILE_JS  = $JS_MODUL.'/jaminan';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "t_jaminan";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

$id_jaminan=$_GET[id];
$sql_cek_id="SELECT B.t_jaminan__id AS t_jaminan__id, B.t_jaminan__pegawai AS t_jaminan__pegawai, r_penempatan.r_pnpt__aktif AS r_pnpt__aktif FROM r_pegawai INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id INNER JOIN t_jaminan B ON B.t_jaminan__pegawai = r_penempatan.r_pnpt__id_pegawai WHERE t_jaminan__id='$id_jaminan'" ;
$rs_val = $db->Execute($sql_cek_id);
$aktif =$rs_val->fields['r_pnpt__aktif'];

if($aktif!='')
{
    Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
}else
{
$sql  ="DELETE ";
$sql .="FROM $tbl_name ";
$sql .="WHERE  t_jaminan__id= '$_GET[id]' ";
$sqlresult = $db->Execute($sql);
}



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

$t_jaminan__id =$_POST[jaminan_id]; 
$t_jaminan__pegawai = $_POST[id_peg];
$t_jaminan__tgl_penyerahan = $_POST[tgl];
$t_jaminan__tgl_dikembalikan = $_POST[tgl_kembali];
$t_jaminan__tipe = $_POST[jenis_jaminan];
$t_jaminan__kode = $_POST[no_jaminan];
$t_jaminan__gambar = $_POST[file_gambar];
$t_jaminan__keterangan = $_POST[keterangan];
$t_jaminan__status = $_POST[status];

$foto=$_FILES['file_gambar']['name'] ;
$foto2=$_POST[foto2];
$cek_foto=$_POST[checkboxname];


IF($cek_foto==1)
{
    $image_name=$_FILES['file_gambar']['name'];
    error_reporting(E_ALL ^ E_NOTICE);
    error_reporting(0);
    ini_set("display_errors",1);
    ini_set("memory_limit","1024M");
    $foto=$_FILES['file_gambar']['name'] ;
    IF ($_FILES['file_gambar']['name'] !="")
        { //JIKA ADA YANG DIUPLOAD

                if ($_FILES['file_gambar']['type'] == "image/jpeg" || $_FILES['file_gambar']['type']=="image/png" || $_FILES['file_gambar']['type']=="image/gif")
                    {
                        $target_dir ='./uploads/';                             
                        $temp = explode(".",$_FILES["file_gambar"]["name"]);
                        $newfilename = substr(microtime(), 2, 7) . '.' .end($temp);
                        $ori_src="uploads/".$_FILES['file_gambar']['name'];
                        if(move_uploaded_file($_FILES["file_gambar"]["tmp_name"],$target_dir.$newfilename))        
                                         {
                                                 chmod("$ori_src",0777);
                                         }else{
                                                 echo "Gagal melakukan proses upload file.";
                                                 exit;
                                         }
                     }		 

                $image_name = $newfilename;        
                ini_set("memory_limit","1024M");

          }
    

}
else
{
     $image_name=$_POST[foto2];
     
    
}

        
$sql_cek_id="SELECT A.r_pnpt__id_pegawai,A.r_pnpt__no_mutasi,A.r_pnpt__aktif FROM r_penempatan A where A.r_pnpt__id_pegawai='$t_jaminan__pegawai' AND A.r_pnpt__aktif='1'";
$rs_val = $db->Execute($sql_cek_id);
$aktif =$rs_val->fields['r_pnpt__aktif'];
    
 if (($t_jaminan__id=='')OR($aktif!='' AND $t_jaminan__status==2)) {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else{
              

                  
                    $sql_edit  ="  UPDATE $tbl_name SET ";
                    $sql_edit .="t_jaminan__pegawai='$t_jaminan__pegawai',";
                    $sql_edit .="t_jaminan__tgl_penyerahan='$t_jaminan__tgl_penyerahan',";
                    $sql_edit .="t_jaminan__tgl_dikembalikan ='$t_jaminan__tgl_dikembalikan',";
                    $sql_edit .="t_jaminan__tipe='$t_jaminan__tipe',";
                    $sql_edit .="t_jaminan__kode='$t_jaminan__kode',";
                    $sql_edit .="t_jaminan__gambar = '$image_name',";
                    $sql_edit .="t_jaminan__keterangan = '$t_jaminan__keterangan',";
                    $sql_edit .="t_jaminan__status = '$t_jaminan__status',";
                    $sql_edit .=" t_jaminan__date_updated = now(),";
                    $sql_edit .=" t_jaminan__user_updated = '$id_peg'";
                    $sql_edit .="  WHERE t_jaminan__id='$t_jaminan__id' ";
                   
                    $sqlresult = $db->Execute($sql_edit);
                    
                    
                     
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jaminan_cari=".$_POST[jaminan_id]);
		
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
$t_jaminan__id =$_POST[jaminan_id]; 
$t_jaminan__pegawai = $_POST[id_peg];
$t_jaminan__tgl_penyerahan = $_POST[tgl];
$t_jaminan__tgl_dikembalikan = $_POST[tgl_kembali];
$t_jaminan__tipe = $_POST[jenis_jaminan];
$t_jaminan__kode = $_POST[no_jaminan];
$t_jaminan__gambar = $_POST[file_gambar];
$t_jaminan__keterangan = $_POST[keterangan];
$t_jaminan__status = $_POST[status];


error_reporting(E_ALL ^ E_NOTICE);
error_reporting(0);
ini_set("display_errors",1);
ini_set("memory_limit","1024M");
$foto=$_FILES['file_gambar']['name'] ;
IF ($_FILES['file_gambar']['name'] !=""){ //JIKA ADA YANG DIUPLOAD
																
    if ($_FILES['file_gambar']['type'] == "image/jpeg" || $_FILES['file_gambar']['type']=="image/png" || $_FILES['file_gambar']['type']=="image/gif"){
           
            $target_dir ='./uploads/';                             
            $temp = explode(".",$_FILES["file_gambar"]["name"]);
            $newfilename = substr(microtime(), 2, 7) . '.' .end($temp);
            $ori_src="uploads/".$_FILES['file_gambar']['name'];
            
     
           if(move_uploaded_file($_FILES["file_gambar"]["tmp_name"],$target_dir.$newfilename))        
                            {
                                    chmod("$ori_src",0777);
                            }else{
                                    echo "Gagal melakukan proses upload file.";
                                    exit;
                            }
                    }		 

            $nama_asli = $newfilename;        
            ini_set("memory_limit","1024M");

}

   

                
             
            if ($t_jaminan__id=='') {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}
                else
                {

                                $sql= "INSERT INTO $tbl_name ("
                                            . "t_jaminan__id,"
                                            . "t_jaminan__pegawai,"
                                            . "t_jaminan__tgl_penyerahan,"
                                            . "t_jaminan__tgl_dikembalikan,"
                                            . "t_jaminan__tipe,"
                                            . "t_jaminan__kode,"
                                            . "t_jaminan__gambar,"
                                            . "t_jaminan__keterangan,"
                                            . "t_jaminan__status,"
                                            . "t_jaminan__date_created,"
                                            . "t_jaminan__date_updated,"
                                            . "t_jaminan__user_created,"
                                            . "t_jaminan__user_updated)";
                                            
                                    $sql	.= " VALUES ("
                                             . "'$t_jaminan__id',"
                                            . "'$t_jaminan__pegawai',"
                                            . "'$t_jaminan__tgl_penyerahan',"
                                            . "'$t_jaminan__tgl_dikembalikan',"
                                            . "'$t_jaminan__tipe',"
                                            . "'$t_jaminan__kode',"
                                            . "'$nama_asli',"
                                            . "'$t_jaminan__keterangan',"
                                            . "'$t_jaminan__status',"
                                            . "now(),"
                                            . "now(),"
                                            . "'$id_peg',"
                                            . "'$id_peg')";
                                      
            $sqlresult = $db->Execute($sql);
                Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&jaminan_cari=".$_POST[jaminan_id]);
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
