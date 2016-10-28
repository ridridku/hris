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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_pegawai/surat_peringatan';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_pegawai');
$FILE_JS  = $JS_MODUL.'/surat_peringatan';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "t_surat_peringatan";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

$sql  ="DELETE ";
$sql .="FROM $tbl_name ";
$sql .="WHERE  t_sp__no= '$_GET[id]' ";

$sqlresult = $db->Execute($sql);



}

function edit_(){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;
$jenis_user   =  $_SESSION['SESSION_JNS_USER'];
      
       
    $user_id = base64_decode($_SESSION['UID']);
    $id_peg = $_SESSION['SESSION_ID_PEG'];
    $tgl_now = date("Y-m-d h:i:s");


    $kode_cabang    = $_POST[kode_cabang];
    $t_sp__no       = $_POST[t_sp__no];
    $t_sp__mutasi      = $_POST[sp_mutasi];
    $t_sp__nama     = $_POST[sp_nama];
    $t_sp__atasan    = $_POST[atasan__nama];
    $t_sp__jabatan  = $_POST[sp_jabatan];
    $t_sp__tgl      = $_POST[sp_tgl];
    $t_sp__tgl_expired = $_POST[sp_tgl_exp];

    $t_sp__jenis    = $_POST[sp_jenis];
    
if($t_sp__jenis==1)
    {
        $sp_jn=1;
    }
elseif($t_sp__jenis==2)
    {
        $sp_jn=2;
    }
elseif($t_sp__jenis==3)
    {
        $sp_jn=3;
    }
elseif($t_sp__jenis=='SP1')
    {
        $sp_jn=1;
    }
 elseif($t_sp__jenis=='SP2')
    {
        $sp_jn=2;
    }    
else
    {
        $sp_jn=3;
    }   
    
    
    
    
    $t_sp__alasan   = $_POST[sp_alasan];
    $t_sp__pelanggaran  = $_POST[sp_pelanggaran];

 
   $sql_cek_no="SELECT  t_sp__no,t_sp__mutasi,t_sp__tgl,t_sp__tgl_expired,t_sp__pelanggaran,t_sp__jenis  "
               . "FROM t_surat_peringatan A where A.t_sp__mutasi='$t_sp__mutasi' AND A.t_sp__jenis='$sp_jn' ";
    
    $rs_val = $db->Execute($sql_cek_no);
    $cek_no= $rs_val->fields['t_sp__no'];
    $jenis_sp= $rs_val->fields['t_sp__jenis'];
    
    $sql_jml_sp="SELECT  count(A.t_sp__no) AS jml_sp FROM t_surat_peringatan A where A.t_sp__mutasi='$t_sp__mutasi' ";
    $rs_val = $db->Execute($sql_jml_sp);
    $jml_sp= $rs_val->fields['jml_sp'];
    
   

 if (($t_sp__no=='') OR ($jenis_user==2 AND $jenis_sp>1)) {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else{
                    $sql_edit  =" UPDATE $tbl_name SET ";
                    $sql_edit .=" t_sp__no='$t_sp__no',";
                    $sql_edit .=" t_sp__mutasi='$t_sp__mutasi',";
                    $sql_edit .=" t_sp__atasan='$t_sp__atasan',";
                    $sql_edit .=" t_sp__tgl='$t_sp__tgl',";
                    $sql_edit .=" t_sp__tgl_expired='$t_sp__tgl_expired',";
                    $sql_edit .=" t_sp__pelanggaran='$t_sp__pelanggaran',";
                    $sql_edit .=" t_sp__jenis='$sp_jn',";
                    $sql_edit .=" t_sp__alasan='$t_sp__alasan',";
                    $sql_edit .=" t_sp__date_updated = now(), ";
                    $sql_edit .=" t_sp__user_updated = '$id_peg'";
                    $sql_edit .=" WHERE t_sp__no='$t_sp__no' ";
                 
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


$kode_cabang    = $_POST[kode_cabang];
$t_sp__no       = $_POST[t_sp__no];
$t_sp__mutasi   = $_POST[sp_mutasi];

$t_sp__hglm   = 'CECEP YOSEP';
$t_sp__hglm_mutasi   = 'HGL MANAGER';
$t_sp__atasan_nama  = $_POST[atasan__nama];
$t_sp__atasan_jabatan   = $_POST[atasan_jabatan];
$t_sp__atasan_mutasi   = $_POST[atasan__mutasi];



$t_sp__jabatan  = $_POST[sp_jabatan];
$t_sp__tgl      = $_POST[sp_tgl];
$t_sp__tgl_expired = $_POST[sp_tgl_exp];

$t_sp__jenis    = $_POST[sp_jenis];
$t_sp__alasan   = $_POST[sp_alasan];
$t_sp__pelanggaran  = $_POST[sp_pelanggaran];


$mutasi =$t_sp__mutasi;
$orderdate=$_POST[sp_tgl];
$orderdate = explode('-', $orderdate);
$tahun = $orderdate[0];
$bulan  = $orderdate[1];
$hari  = $orderdate[2];
$no=$t_sp__no;

$t1=  strtotime($t_sp__tgl);
$t2=  strtotime($t_sp__tgl_expired);

    $sql_cek_no="SELECT  t_sp__no,t_sp__mutasi,t_sp__tgl,t_sp__tgl_expired,t_sp__pelanggaran,t_sp__jenis  "
            . "FROM t_surat_peringatan A where A.t_sp__mutasi='$t_sp__mutasi' AND A.t_sp__jenis='$t_sp__jenis' ";
    
    $rs_val = $db->Execute($sql_cek_no);
    $cek_no= $rs_val->fields['t_sp__no'];
    $jenis_sp= $rs_val->fields['t_sp__jenis'];
       
   $sql_jml_sp="SELECT  count(A.t_sp__no) AS jml_sp FROM t_surat_peringatan A where A.t_sp__mutasi='$t_sp__mutasi' ";
   $rs_val = $db->Execute($sql_jml_sp);
   $jml_sp= $rs_val->fields['jml_sp'];
   

 if (($cek_no==$t_sp__no AND  $jml_sp>3) OR ($jenis_sp==$t_sp__jenis) OR ($t1>$t2) OR($jenis_user==2 AND $jenis_sp>1)) {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else
                {
                    
                                  $sql= "INSERT INTO $tbl_name ("
                                            . "t_sp__no,"
                                            . "t_sp__mutasi, "
                                            ."  t_sp__hglm,"
                                            ." t_sp__hglm_mutasi,"
                                            ." t_sp__atasan,"
                                            ." t_sp__atasan_jabatan,"
                                            . "t_sp__tgl," 
                                            . "t_sp__tgl_expired,"
                                            . "t_sp__pelanggaran, "
                                            . "t_sp__alasan,"
                                            . "t_sp__jenis, "
                                            . "t_sp__date_created,"
                                            . "t_sp__user_created)";
                                         $sql    .= " VALUES ("
                                            . "'$t_sp__no',"
                                            . "'$t_sp__mutasi',"
                                            . "'$t_sp__hglm',"
                                            . "'$t_sp__hglm_mutasi',"
                                            . "'$t_sp__atasan_nama',"
                                            . "'$t_sp__atasan_jabatan',"
                                            . "'$t_sp__tgl',"
                                            . "'$t_sp__tgl_expired',"
                                            . "'$t_sp__pelanggaran', "
                                            . "'$t_sp__alasan',"
                                            . "'$t_sp__jenis',"
                                            . "now(),"
                                            . "'$id_peg')";
                                    
                                
                                  
$sqlresult = $db->Execute($sql);
Header("Location:inc.sp.php?bulan=".$bulan."&tahun=".$tahun."nip=".$nip."&no=".$no."&mutasi=".$mutasi."&index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
//Header("Location:inc.sp.php?bulan=".$bulan."&tahun=".$tahun."&nip=".$nip."&no=".$no."&mutasi=".$mutasi);
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
