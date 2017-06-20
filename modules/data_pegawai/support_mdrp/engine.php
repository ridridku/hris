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
$tbl_name	= "t_mdrp";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

$sql_cek_mdrp="SELECT mdrp__status FROM t_mdrp  where mdrp__id='$_GET[id]' ";
      $rs_val_cek_mdrp = $db->Execute($sql_cek_mdrp);
      $mdrp_status_cek= $rs_val_cek_mdrp->fields['mdrp__status'];

if($mdrp_status_cek==1)
{
   
    Header("Location:index_cek.php?ERR=1&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
}  else {
     
            $sql  ="DELETE ";
            $sql .="FROM $tbl_name ";
            $sql .="WHERE  mdrp__id= '$_GET[id]' ";
           
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


$mdrp__id  =$_POST[mdrp_id]; 
$mdrp__formulir  =$_POST[no_mdrp];// $_POST[no_mdrp];
$mdrp__idpegawai = $_POST[id_pegawai];
$mdrp__cab_lama = $_POST[kode_cabang];
$mdrp__jab_lama = $_POST[jabatan_lama];
$mdrp__lokasibaru = $_POST[cabang_baru];
$mdrp__subcab_baru = $_POST[subcabang_baru];
$mdrp__depbaru = $_POST[dep_baru];
$mdrp__subdepbaru = $_POST[subdep_baru];
$mdrp__jabatanbaru= $_POST[jabatan_baru];
$mdrp__tipe = $_POST[tipe_mdrp];
$mdrp__efektif= $_POST[tgl_efektif];
$mdrp__status = $_POST[status];
$mdrp__dep_lama= $_POST[dep_lama];
$mdrp__sudep_lama= $_POST[subdep_lama];
    



    $sql_cek="SELECT
            r_pnpt__no_mutasi,
            r_pnpt__id_pegawai,
            r_pnpt__nip,
            r_pnpt__status,
            r_pnpt__tipe_salary,
            r_pnpt__subdept,
            r_pnpt__jabatan,
            r_pnpt__finger_print,
            r_pnpt__gapok,
            r_pnpt__subcab,
            r_pnpt__shift,
            r_pnpt__kon_awal,
            r_pnpt__kon_akhir,
            r_pnpt__pdrm,
            r_pnpt__aktif,
            r_pnpt__areakerja,
            r_pnpt__tgl_efektif
              FROM r_penempatan  where r_pnpt__id_pegawai='$mdrp__idpegawai' AND r_pnpt__aktif=1";
   
   $rs_val = $db->Execute($sql_cek);
   
    $r_pnpt__no_mutasi= $rs_val->fields['r_pnpt__no_mutasi'];
    $r_pnpt__id_pegawai= $rs_val->fields['r_pnpt__id_pegawai'];
    $r_pnpt__nip= $rs_val->fields['r_pnpt__nip'];
    $r_pnpt__status= $rs_val->fields['r_pnpt__status'];
    $r_pnpt__tipe_salary= $rs_val->fields['r_pnpt__tipe_salary'];
    $r_pnpt__subdept= $rs_val->fields['r_pnpt__subdept'];
    $r_pnpt__jabatan= $rs_val->fields['r_pnpt__jabatan'];
    $r_pnpt__finger_print= $rs_val->fields['r_pnpt__finger_print'];
    $r_pnpt__gapok= $rs_val->fields['r_pnpt__gapok'];
    $r_pnpt__subcab= $rs_val->fields['r_pnpt__subcab'];
    $r_pnpt__shift= $rs_val->fields['r_pnpt__shift'];
    $r_pnpt__kon_awal= $rs_val->fields['r_pnpt__kon_awal'];
    $r_pnpt__kon_akhir= $rs_val->fields['r_pnpt__kon_akhir'];
    $r_pnpt__pdrm= $rs_val->fields['r_pnpt__pdrm'];
    $r_pnpt__aktif= $rs_val->fields['r_pnpt__aktif'];
    $r_pnpt__areakerja= $rs_val->fields['r_pnpt__areakerja'];
    $r_pnpt__tgl_efektif= $rs_val->fields['r_pnpt__tgl_efektif'];
    $timestamp = strtotime($mdrp__efektif);
     
     
      $sql_cek_mdrp="SELECT mdrp__status FROM t_mdrp  where mdrp__id='$mdrp__id'";
      $rs_val_cek_mdrp = $db->Execute($sql_cek_mdrp);
      $mdrp_status_cek= $rs_val_cek_mdrp->fields['mdrp__status'];
     
  // var_dump(!empty($timestamp))or die();
      
    
      
      
if (($rs_val==false) or($mdrp_status_cek==1)or($rs_val_cek_mdrp==false)) 
{ 
       	Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
}else{
if($mdrp__formulir!='' && $mdrp__idpegawai!=''&& $mdrp__cab_lama!='' && $mdrp__jab_lama!='' 
    && $mdrp__dep_lama!='' && $mdrp__sudep_lama!='' && $mdrp__lokasibaru!='' && $mdrp__subcab_baru!='' &&$mdrp__depbaru!=''
    && $mdrp__subdepbaru!='' && $mdrp__jabatanbaru!='' && $mdrp__jabatanbaru!='' && $mdrp__efektif!=''&& $mdrp__tipe!='' && $mdrp__status!=0 &&!empty($timestamp))
        {
         
                      
                        $sql_edit  ="UPDATE $tbl_name set ";
                        $sql_edit .="mdrp__formulir='$mdrp__formulir', ";
                        $sql_edit .="mdrp__idpegawai='$mdrp__idpegawai',";
                        $sql_edit .="mdrp__cab_lama= '$mdrp__cab_lama', ";
                        $sql_edit .="mdrp__jab_lama= '$mdrp__jab_lama', ";
                        $sql_edit .="mdrp__dep_lama= '$mdrp__dep_lama', ";
                        $sql_edit .="mdrp__sudep_lama= '$mdrp__sudep_lama', ";
                        $sql_edit .="mdrp__lokasibaru= '$mdrp__lokasibaru', ";
                        $sql_edit .="mdrp__subcab_baru= '$mdrp__subcab_baru', ";
                        $sql_edit .="mdrp__depbaru= '$mdrp__depbaru', ";
                        $sql_edit .="mdrp__subdepbaru= '$mdrp__subdepbaru', ";
                        $sql_edit .="mdrp__jabatanbaru= '$mdrp__jabatanbaru', ";
                        $sql_edit .="mdrp__efektif= '$mdrp__efektif', ";
                        $sql_edit .="mdrp__tipe= '$mdrp__tipe', ";
                        $sql_edit .="mdrp__status= '$mdrp__status', ";
                        $sql_edit .="mdrp__date_updated= now(), ";
                        $sql_edit .="mdrp__user_updated= $id_peg ";
                        $sql_edit .=" WHERE mdrp__id='$mdrp__id'";
			$sqlresult1 =  $db->Execute($sql_edit);
                           
                        
                        
                        $sql_edit_penempatan  ="UPDATE r_penempatan set ";
                        $sql_edit_penempatan .="r_pnpt__aktif='0', ";
                        $sql_edit_penempatan .="r_pnpt__date_updated='now()',";
                        $sql_edit_penempatan .="r_pnpt__user_updated='$id_peg'";                       
                        $sql_edit_penempatan .=" WHERE r_pnpt__no_mutasi='$r_pnpt__no_mutasi'";
                      
			$sqlresult2 =  $db->Execute($sql_edit_penempatan);
                        
                        
                        $sql	 = "INSERT INTO r_penempatan ("
                                         . "r_pnpt__id_pegawai, "
                                         . "r_pnpt__nip, "
                                         . "r_pnpt__status, "
                                         . "r_pnpt__tipe_salary, "
                                         . "r_pnpt__subdept, "
                                         . "r_pnpt__jabatan, "
                                         . "r_pnpt__finger_print, "
                                         . "r_pnpt__gapok, "
                                         . "r_pnpt__subcab, "
                                         . "r_pnpt__aktif, "
                                         . "r_pnpt__areakerja, "
                                         . "r_pnpt__tgl_efektif, "
                                         . "r_pnpt__kon_awal, "
                                         . "r_pnpt__kon_akhir, "
                                         . "r_pnpt__date_created, "
                                         . "r_pnpt__user_created, "
                                         . "r_pnpt__date_updated, "
                                         . "r_pnpt__user_updated, "
                                         . "r_pnpt__shift,"
                                         . "r_pnpt__pdrm)";
                                        $sql	.= " VALUES ("
                                        . "'".strip_tags($r_pnpt__id_pegawai)."',"
                                        . "'$r_pnpt__nip',"
                                        . "'".strip_tags($r_pnpt__status)."',"
                                        . "'".strip_tags($r_pnpt__tipe_salary)."',"
                                        . "'".strip_tags($mdrp__subdepbaru)."',"
                                        . "'".strip_tags($mdrp__jabatanbaru)."',"
                                        . "'$r_pnpt__finger_print',"
                                        . "'".strip_tags($r_pnpt__gapok)."',"
                                        . "'".strip_tags($mdrp__subcab_baru)."',"
                                        . "'$mdrp__status',"
                                        . "'".strip_tags($r_pnpt__areakerja)."',"
                                        . "'".strip_tags($mdrp__efektif)."',"
                                        . "'".strip_tags($r_pnpt__kon_awal)."',"
                                        . "'".strip_tags($r_pnpt__kon_akhir)."',"
                                        . "now(),"
                                        . "'".strip_tags($id_peg)."',"
                                        . "now(),"
                                        . "'$id_peg',"
                                        . "'".strip_tags($r_pnpt__shift)."',"
                                        . "'$mdrp__tipe')";
                              
                                        $sqlresult = $db->Execute($sql);

      
            
            
        }  
        
        elseif($mdrp_status_cek==0 and $mdrp__status==0)
            {
  
           
            $sql_edit  ="UPDATE $tbl_name set ";
                        $sql_edit .="mdrp__formulir='$mdrp__formulir', ";
                        $sql_edit .="mdrp__idpegawai='$mdrp__idpegawai',";
                        $sql_edit .="mdrp__cab_lama= '$mdrp__cab_lama', ";
                        $sql_edit .="mdrp__jab_lama= '$mdrp__jab_lama', ";
                        $sql_edit .="mdrp__dep_lama= '$mdrp__dep_lama', ";
                        $sql_edit .="mdrp__sudep_lama= '$mdrp__sudep_lama', ";
                        $sql_edit .="mdrp__lokasibaru= '$mdrp__lokasibaru', ";
                        $sql_edit .="mdrp__subcab_baru= '$mdrp__subcab_baru', ";
                        $sql_edit .="mdrp__depbaru= '$mdrp__depbaru', ";
                        $sql_edit .="mdrp__subdepbaru= '$mdrp__subdepbaru', ";
                        $sql_edit .="mdrp__jabatanbaru= '$mdrp__jabatanbaru', ";
                        $sql_edit .="mdrp__efektif= '$mdrp__efektif', ";
                        $sql_edit .="mdrp__tipe= '$mdrp__tipe', ";
                        $sql_edit .="mdrp__status= '$mdrp__status', ";
                        $sql_edit .="mdrp__date_updated= now(), ";
                        $sql_edit .="mdrp__user_updated= $id_peg ";
                        $sql_edit .=" WHERE mdrp__id='$mdrp__id'";
			$sqlresult1 =  $db->Execute($sql_edit);
                       
                        Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&no_cari=".$mdrp__id);

            }
                         
                       
                     
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&no_cari=".$mdrp__id);
		
                }
}

function create_(){
    
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];
$tgl_now = date("Y-m-d");


$mdrp__formulir  =$_POST[no_mdrp];// $_POST[no_mdrp];
$mdrp__idpegawai = $_POST[id_pegawai];
$mdrp__cab_lama = $_POST[kode_cabang];
$mdrp__jab_lama = $_POST[jabatan_lama];
$mdrp__lokasibaru = $_POST[cabang_baru];
$mdrp__subcab_baru = $_POST[subcabang_baru];
$mdrp__depbaru = $_POST[dep_baru];
$mdrp__subdepbaru = $_POST[subdep_baru];
$mdrp__jabatanbaru= $_POST[jabatan_baru];
$mdrp__tipe = $_POST[tipe_mdrp];
$mdrp__efektif= $_POST[tgl_efektif];
$mdrp__status = $_POST[status];
$mdrp__dep_lama= $_POST[dep_lama];
$mdrp__sudep_lama= $_POST[subdep_lama];



   
$sql1="SELECT  *
                 FROM r_penempatan A where A.r_pnpt__id_pegawai='$mdrp__idpegawaia' AND r_pnpt__aktif=1 ";
   $rs_val = $db->Execute($sql1);
   $no_mutasi   = $rs_val->fields['no_mutasi'];
   $nip         =$rs_val->fields['r_pnpt__nip'];
   

 if ($mdrp__formulir=='') {
			Header("Location:index_cek.php?ERR=5&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else
                {
                   
               $sql1="SELECT  *  FROM r_penempatan A where A.r_pnpt__id_pegawai='$mdrp__idpegawaiss' AND r_pnpt__aktif='1'";
               $rs_val = $db->Execute($sql1);
                $r_pnpt__no_mutasi   = $rs_val->fields['no_mutasi'];
                $r_pnpt__nip        =$rs_val->fields['r_pnpt__nip']; 
              
    
     $sql2= "INSERT INTO $tbl_name ("   . "mdrp__formulir, "
                                        . "mdrp__idpegawai, "
                                        . "mdrp__cab_lama, "
                                        . "mdrp__jab_lama, "
                                        . "mdrp__dep_lama,"
                                        . "mdrp__sudep_lama,"
                                        . "mdrp__lokasibaru, "
                                        . "mdrp__subcab_baru, "
                                        . "mdrp__depbaru, "
                                        . "mdrp__subdepbaru, "
                                        . "mdrp__jabatanbaru, "
                                        . "mdrp__efektif, "
                                        . "mdrp__tipe, "
                                        . "mdrp__status, "
                                        . "mdrp__date_created, "
                                        . "mdrp__date_updated, "
                                        . "mdrp__user_created, "
                                        . "mdrp__user_updated)";
 
                                    $sql2	.= " VALUES ("
                                           
                                            . "'$mdrp__formulir',"
                                            . "'$mdrp__idpegawai',"
                                            . "'$mdrp__cab_lama',"
                                            . "'$mdrp__dep_lama',"
                                            . "'$mdrp__sudep_lama',"
                                            . "'$mdrp__jab_lama',"
                                            . "'$mdrp__lokasibaru',"
                                            . "'$mdrp__subcab_baru',"
                                            . "'$mdrp__depbaru',"
                                            . "'$mdrp__subdepbaru',"
                                            . "'$mdrp__jabatanbaru',"
                                            ."'$mdrp__efektif',"
                                            . "'$mdrp__tipe',"
                                            . "'0',"
                                            . "now(),"
                                            . "now(),"
                                            . "'$id_peg',"
                                            . "'$id_peg')";
                                 
                                   $sqlres = $db->Execute($sql2); 
                                   
   

}
                              
                        Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&no_cari=".$r_resign__mutasi);
               

    
    
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
