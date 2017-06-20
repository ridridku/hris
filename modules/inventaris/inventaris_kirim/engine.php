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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/inventaris/inventaris_kirim';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/inventaris');
$FILE_JS  = $JS_MODUL.'/inventaris_kirim';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "r_inventaris";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

$sql  ="DELETE ";
$sql .="FROM $tbl_name ";
$sql .="WHERE  r_inventaris__id= '$_GET[id]' ";
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

$r_inventaris__id = $_POST[inv_id]; 
$r_inventaris__mutasi = $_POST[mutasi];
$r_inventaris__tgl_pinjam = $_POST[tgl];
$r_inventaris__tgl_kembali = $_POST[tgl_kembali];
$r_inventaris__jenis = $_POST[jenis_alat];
$r_inventaris__alat = $_POST[nama_alat];
$r_inventaris__kode = $_POST[kode_alat];
$r_inventaris__qty = $_POST[qty_alat];
$r_inventaris__kepemilikan = $_POST[pemilik_alat];
$r_inventaris__gambar = $_POST[file_gambar];
$r_inventaris__lokasi = $_POST[lokasi_alat];
$r_inventaris__keterangan = $_POST[keterangan_alat];
$r_inventaris__status = $_POST[status];
$r_inventaris__kondisi= $_POST[kondisi_alat];

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

        

    
 if ($r_inventaris__id=='' ) {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else{
              

                  
                    $sql_edit  ="  UPDATE $tbl_name SET ";
                    $sql_edit .=" r_inventaris__mutasi='$r_inventaris__mutasi',";
                    $sql_edit .=" r_inventaris__tgl_pinjam='$r_inventaris__tgl_pinjam',";
                    $sql_edit .=" r_inventaris__tgl_kembali='$r_inventaris__tgl_kembali',";
                    $sql_edit .=" r_inventaris__jenis ='$r_inventaris__jenis',";
                    $sql_edit .=" r_inventaris__alat='$r_inventaris__alat',";
                    $sql_edit .=" r_inventaris__kode='$r_inventaris__kode',";
                    $sql_edit .=" r_inventaris__qty = '$r_inventaris__qty',";
                    $sql_edit .=" r_inventaris__kepemilikan = '$r_inventaris__kepemilikan',";
                    $sql_edit .=" r_inventaris__gambar = '$image_name',";
                    $sql_edit .=" r_inventaris__lokasi = '$r_inventaris__lokasi',";
                    $sql_edit .=" r_inventaris__keterangan = '$r_inventaris__keterangan',"; 
                    $sql_edit .=" r_inventaris__status = '$r_inventaris__status',";
                    $sql_edit .=" r_inventaris__date_updated = now(),";
                    $sql_edit .=" r_inventaris__user_updated = '$id_peg'";
                    $sql_edit .="  WHERE r_inventaris__id='$r_inventaris__id' ";
                  //  var_dump($sql_edit) or die();
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

$r_inventaris__id =$_POST[inv_id]; 
$r_inventaris__mutasi = $_POST[mutasi];
$r_inventaris__tgl_pinjam = $_POST[tgl];
$r_inventaris__tgl_kembali = $_POST[tgl_kembali];
$r_inventaris__jenis = $_POST[jenis_alat];
$r_inventaris__alat = $_POST[nama_alat];
$r_inventaris__kode = $_POST[kode_alat];
$r_inventaris__qty = $_POST[qty_alat];
$r_inventaris__kepemilikan = $_POST[pemilik_alat];
$r_inventaris__gambar = $_POST[file_gambar];
$r_inventaris__lokasi = $_POST[lokasi_alat];
$r_inventaris__keterangan = $_POST[keterangan_alat];
$r_inventaris__status = $_POST[status];
$r_inventaris__kondisi= $_POST[kondisi_alat];

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

   $sql_cek_no="SELECT
                 r_inventaris__id,
                r_inventaris__mutasi,
                r_inventaris__tgl_pinjam,
                r_inventaris__tgl_kembali,
                r_inventaris__jenis,
                r_inventaris__alat,
                r_inventaris__kode,
                r_inventaris__status
              FROM r_inventaris where r_inventaris__kode='$r_inventaris__kode' AND r_inventaris__status=2 ";
   
                $rs_val = $db->Execute($sql_cek_no);
                $inventaris_status =$rs_val->fields['r_inventaris__status'];
                $inventaris_kode=$rs_val->fields['r_inventaris__kode'];
             
              $sql_cek_id="SELECT
                    r_inventaris__id,
                    r_inventaris__mutasi,
                    r_inventaris__tgl_pinjam,
                    r_inventaris__tgl_kembali,
                    r_inventaris__jenis,
                    r_inventaris__alat,
                    r_inventaris__kode,
                    r_inventaris__status
                    FROM r_inventaris where r_inventaris__id='$r_inventaris__id'";
   
        
                $rs_val = $db->Execute($sql_cek_id);
                $cek_id =$rs_val->fields['r_inventaris__id'];
                
             
            if (($inventaris_kode==$r_inventaris__kode AND $inventaris_status==2)) {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}
                else
                {
                                $sql= "INSERT INTO $tbl_name ("
                                            . "r_inventaris__id,"
                                            . "r_inventaris__mutasi,"
                                            . "r_inventaris__tgl_pinjam,"
                                            . "r_inventaris__tgl_kembali,"
                                            . "r_inventaris__jenis,"
                                            . "r_inventaris__alat,"
                                            . "r_inventaris__kode,"
                                            . "r_inventaris__qty,"
                                            . "r_inventaris__kondisi,"
                                            . "r_inventaris__kepemilikan,"
                                            . "r_inventaris__gambar,"
                                            . "r_inventaris__lokasi,"
                                            . "r_inventaris__keterangan,"
                                            . "r_inventaris__status,"
                                            . "r_inventaris__date_created,"
                                            . "r_inventaris__date_updated,"
                                            . "r_inventaris__user_created,"
                                            . "r_inventaris__user_updated)";
                                            
                                    $sql	.= " VALUES ("
                                            . "'$r_inventaris__id',"
                                            . "'$r_inventaris__mutasi',"
                                            . "'$r_inventaris__tgl_pinjam',"
                                            . "'$r_inventaris__tgl_kembali',"
                                            . "'$r_inventaris__jenis',"
                                            . "'$r_inventaris__alat',"
                                            . "'$r_inventaris__kode',"
                                            . "'$r_inventaris__qty',"
                                            . "'$r_inventaris__kondisi',"
                                            . "'$r_inventaris__kepemilikan',"
                                            . "'$nama_asli',"
                                            . "'$r_inventaris__lokasi',"
                                            . "'$r_inventaris__keterangan',"
                                            . "'$r_inventaris__status',"
                                            . "now(),"
                                            . "now(),"
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
