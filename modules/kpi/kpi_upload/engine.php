<?PHP
/*egine upload*/

# Including Main Configuration
# including file for Main Configurations
require_once('../../../includes/config.conf.php');
require_once('../../../includes/func.inc.php');

//require_once('../../../lib/excel_reader.php');
# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
		require_once('../../../includes/                                ');
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
require_once($DIR_INC.'/excel_reader2.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.locker.php');

$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

//------------------------------------LOCAL CONFIG--------------------------------------//
#SETTING FOR TEMPLATE 
$TPL_PATH = base64_decode($_SESSION['UPLOAD']).'/uploads';
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kpi/upoload_kpi';

$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kpi');
$FILE_JS  = $JS_MODUL.'/upload_kpi';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$cabang_id=$_SESSION['SESSION_KODE_CABANG'];
$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];
$today = date("Y-m-d h:i:s");
#Initiate TABLE
$tbl_name	= "r_kpi";
//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM t_absensi ";
$sql .="WHERE  id= '$_GET[id]' ";

$sqlresult = $db->Execute($sql);

$user_id = base64_decode($_SESSION['UID']);
 $ip_now = $_SERVER['REMOTE_ADDR'];
 $sql2="INSERT INTO tbl_log (url, waktu, module, user_id ) VALUES ('$ip_now',now(),'Hapus data >> master WNI Non TKI','$user_id') ";
 $db->Execute($sql2);

}

function edit_(){
global $mod_id;
global $db;


$nama = addslashes($_POST[nama]);

$sql_cek="select * from t_absensi where trim(id)='id' and id !='$_POST[id]' ";
$rs_val = $db->Execute($sql_cek);
$id = $rs_val->fields['id'];

		if ($id!='') {
		 
				Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);

		} else { 

   
			$sql_edit  ="  UPDATE tbl_file_kehadiran  ";
			$sql_edit .="  SET id='$_POST[id]', ";
                      
			$sqlresult4 = $db->Execute($sql_edit);
                 
                        
    $ip_now = $_SERVER['REMOTE_ADDR'];
    $user_id = base64_decode($_SESSION['UID']);
    $sql2="INSERT INTO tbl_log (url, waktu, module, user_id )  VALUES ('$ip_now',now(),'Ubah data >> master WNI  ($nama)','$user_id') ";
    $db->Execute($sql2);

			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}
}

function create_(){
    
global $mod_id;	
global $db;
global $tbl_name;//nama_sektor
global $field_name;
$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];


$today= date("Y-m-d");
$today = explode('-', $today);
$tahun_today = $today[0];
$bulan_today  = $today[1];
$hari_today  = $today[2];


$departemen= addslashes($_POST[kode_departemen]);



error_reporting(E_ALL ^ E_NOTICE);
error_reporting(0);
//  ini_set("display_errors",1);
ini_set("memory_limit","1024M");
//init_set("allow_url_fopen is on");

if($_FILES['file_xls']['name'] !="")
    { 
            $data = new Spreadsheet_Excel_Reader($_FILES['file_xls']['tmp_name']);
            $hasildata = $data->rowcount($sheet_index=0);
            $sukses = 0;
            $gagal = 0;
            
      
for ($i=2; $i<=$hasildata; $i++)
{
    $r_kpi__finger = $data->val($i,1);
    $r_kpi__bulan = $data->val($i, 3);
    $r_kpi__tahun = $data->val($i, 4);
    $r_kpi__nilai = $data->val($i, 5);

    $subtgl=$r_kpi__tahun.''.sprintf('%02s',$r_kpi__bulan);

     $tgl_kpi= substr($subtgl, 0, 4).'-'.substr($subtgl,4,2).'-10';
   
 
    $sql_cek="SELECT  
                r_kpi__finger AS mutasi,
                r_kpi__bulan AS bulan,
                r_kpi__tahun AS tahun,
                r_kpi__nilai AS r_kpi__nilai,
                r_kpi__keterangan AS r_kpi__keterangan,
                r_kpi__approval  AS r_kpi__approval
    FROM r_kpi A where A.r_kpi__finger='$r_kpi__finger' AND A.r_kpi__bulan='$r_kpi__bulan' AND A.r_kpi__tahun='$r_kpi__tahun'";
      
    $rs_val = $db->Execute($sql_cek);
    $update_mutasi= $rs_val->fields['mutasi'];
    $update_tahun = $rs_val->fields['tahun'];
    $update_bulan = $rs_val->fields['bulan'];             
                
 // var_dump($r_kpi__finger==$update_mutasi AND $r_kpi__bulan==$update_bulan AND $r_kpi__tahun==$update_tahun)or die();                      
    if($r_kpi__finger=='' AND $r_kpi__bulan=='' AND $r_kpi__tahun=='' ) 
    {
        Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
    }
        elseif($r_kpi__finger!=$update_mutasi AND $r_kpi__bulan!=$update_bulan AND $r_kpi__tahun!=$update_tahun)
    {
        $sql = "INSERT INTO r_kpi"
                . "(r_kpi__finger,"
                . "r_kpi__bulan,"
                . "r_kpi__tahun,"
                . "r_kpi__tgl,"
                . "r_kpi__nilai," 
                . "r_kpi__date_created,"
                . "r_kpi__date_updated,"
                . "r_kpi__user_created,"
                . "r_kpi__user_updated)"
                . "VALUES "
                . "('$r_kpi__finger',"
                . "'$r_kpi__bulan',"
                . "'$r_kpi__tahun',"
                 . "'$tgl_kpi',"
                . "'$r_kpi__nilai',"
                . "now(),"
                . "now(),"
                . "$id_peg,"
                . "'$id_peg')";
        
                        
                            
                    $target_dir ='./uploads/';
                    $target_file = $target_dir.basename($_FILES["file_xls"]["name"],$target_dir);  
                    chmod("$target_file",0777);
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
                                  //  chmod("$target_file",0775);
                                    $uploadMessageError = "The file ". basename($_FILES["file_xls"]["name"]). " has been uploaded.";
                                    $uploadOk=1;
                                    $nama_asli = $_FILES['file_xls']['name'];
                                    $id_peg=     $_SESSION['SESSION_ID_PEG'];
                                    $id_cabang=$_SESSION['SESSION_KODE_CABANG'];
                                    
                                    
                                    $sql_upload="INSERT INTO r_upload_kpi "
                                            . "(r_uploadkpi__dep,"
                                            . "r_uploadkpi__user,"
                                            . "r_uploadkpi__filename,"
                                            . "r_uploadkpi__date_created,"
                                            . "r_uploadkpi__user_created)"
                                            . "  VALUES ('$departemen',"
                                            . "'$id_peg',"
                                            . "'$nama_asli',"
                                            . "now(),"
                                            . "'$id_peg') ";
                                   // var_dump($departemen) or die();
                                    $db->Execute($sql_upload);

                                     
                      } else {
                                    $uploadMessageError = "Sorry, there was an error uploading your file.";
                                    $uploadOk=0;
                            }
				$sqlresult = $db->Execute($sql);
                             
                              
                     }
                     
                   
              
                  elseif($r_kpi__finger==$update_mutasi AND $r_kpi__bulan==$update_bulan AND $update_tahun==$r_kpi__tahun) 
                     { 
                                 $sql_edit  ="UPDATE r_kpi set";
                             
                                 $sql_edit .= " r_kpi__bulan ='$r_kpi__bulan',";
                                 $sql_edit .= " r_kpi__tahun = '$r_kpi__tahun',";
                                  $sql_edit .= " r_kpi__tgl = '$tgl_kpi',";
                                 $sql_edit .= " r_kpi__nilai = '$r_kpi__nilai',";
                                 $sql_edit .= " r_kpi__date_updated = now(),";
                                 $sql_edit .= " r_kpi__user_updated = '$id_peg'";
                                 $sql_edit .="  WHERE  r_kpi__finger='$r_kpi__finger' AND r_kpi__bulan ='$r_kpi__bulan' AND r_kpi__tahun='$r_kpi__tahun'";
                                
                                 $target_dir ='./uploads/';
                    $target_file = $target_dir.basename($_FILES["file_xls"]["name"],$target_dir);  
                    chmod("$target_file",0777);
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
                                  //  chmod("$target_file",0775);
                                    $uploadMessageError = "The file ". basename($_FILES["file_xls"]["name"]). " has been uploaded.";
                                    $uploadOk=1;
                                    $nama_asli = $_FILES['file_xls']['name'];
                                    $id_peg=     $_SESSION['SESSION_ID_PEG'];
                                    $id_cabang=$_SESSION['SESSION_KODE_CABANG'];
                                    
                                    
                                    $sql_upload="INSERT INTO r_upload_kpi "
                                            . "(r_uploadkpi__dep,"
                                            . "r_uploadkpi__user,"
                                            . "r_uploadkpi__filename,"
                                            . "r_uploadkpi__date_created,"
                                            . "r_uploadkpi__user_created)"
                                            . "  VALUES ('$departemen',"
                                            . "'$id_peg',"
                                            . "'$nama_asli',"
                                            . "now(),"
                                            . "'$id_peg') ";
                                 
                                    $db->Execute($sql_upload);

                                     
                      } else {
                                    $uploadMessageError = "Sorry, there was an error uploading your file.";
                                    $uploadOk=0;
                            }
                                 
                                 
                                 $sqlresult5 = $db->Execute($sql_edit);
                                
                              
                                     
                               

                    } 
              
                
               
                     
      //closeperiode
             
             }          
         
            
       

    Header("Location:index_cek.php?ERR=5&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
                            
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
            //unlockTables($tbl_name);		
		Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
	}
break;
}


}
?>

