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
require_once($DIR_INC.'/func.inc.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.locker.php');

$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
//------------------------------------LOCAL CONFIG--------------------------------------//
#SETTING FOR TEMPLATE 
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/manfaat/angsuran';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/manfaat');
$FILE_JS  = $JS_MODUL.'/angsuran';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "t_angsuran_pinjaman";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

$sql  ="DELETE ";
$sql .="FROM $tbl_name ";
$sql .="WHERE  r_ang__id= '$_GET[id]' ";

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
    $r_ang__id = $_POST[r_ang__id];
    $r_ang__jenis = $_POST[r_ang__jenis];
    $r_ang__platfond = remove_non_numerics($_POST[r_ang__platfond]);
    $r_ang__ket  = $_POST[r_ang__ket];
    $r_ang__total = remove_non_numerics($_POST[r_ang__total]);
    $r_ang__tenor_bulan = $_POST[r_ang__tenor_bulan];
    $r_ang__cicilan    = remove_non_numerics($_POST[r_ang__cicilan]);
    $r_ang__user_updated= $id_peg;

 

                    $sql_edit  ="  UPDATE $tbl_name SET ";
                    $sql_edit .=" r_ang__jenis='$r_ang__jenis',";
                    $sql_edit .=" r_ang__platfond='$r_ang__platfond',";
                    $sql_edit .=" r_ang__ket='$r_ang__ket',";
                    $sql_edit .=" r_ang__total='$r_ang__total',";
                    $sql_edit .=" r_ang__tenor_bulan='$r_ang__tenor_bulan',";
                    $sql_edit .=" r_ang__cicilan='$r_ang__cicilan',";
                    $sql_edit .=" r_ang__date_updated = now(), ";
                    $sql_edit .=" r_ang__user_updated = '$id_peg'";
                    $sql_edit .="  WHERE r_ang__id='$r_ang__id' ";
                   
                    $sqlresult = $db->Execute($sql_edit);
                     
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		
             
}

function create_(){
    
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;


$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];


    $sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_awal,r_periode__payroll_akhir,r_periode__payroll_status "
    . "FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
        $rs_val = $db->Execute($sql_cek_periode);
        $periode_awal= $rs_val->fields['r_periode__payroll_awal'];
        $periode_akhir= $rs_val->fields['r_periode__payroll_akhir'];


$all_pjm= $_POST[no_pjm];   


IF ($all_pjm=='') {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else
{
                   //   $all_pjm= $_POST[no_pjm];
                 
       
if (!empty($all_pjm))
    {
    $bad_symbols = array(",", ".");
    $all_pjm= $_POST[no_pjm];
    $mutasi_array=str_replace($bad_symbols,"",$_POST[mutasi]);
    $karyawan_array=str_replace($bad_symbols,"",$_POST[id_karyawan]);
    $jenis_array=str_replace($bad_symbols,"",$_POST[jenis]);
    $tanggal_array = $_POST[tgl_bayar];
    $angsuran_array = str_replace($bad_symbols,"",$_POST[angsuran]);
 
   // var_dump($angsuran_array)or die();
 

    for ($i = 0; $i < count($all_pjm); $i++) 
    {
        
           $sql_count="SELECT COUNT(t_ang__nopjm) as no_pjm  FROM t_angsuran_pinjaman where t_ang__nopjm='$all_pjm[$i]' ";  
   
    $rs_val = $db->Execute($sql_count);
    $ags_ke= $rs_val->fields['no_pjm']+1;  
    

        
        $t_ang__jenis= mysql_real_escape_string($jenis_array[$i]);
        $t_ang__nopjm= mysql_real_escape_string($all_pjm[$i]);
        $t_ang__idkaryawan = mysql_real_escape_string($karyawan_array[$i]);
        $t_ang__tanggal= mysql_real_escape_string($tanggal_array[$i]);
        $t_ang__nilai_angsuran=mysql_real_escape_string($angsuran_array[$i]); 
        $t_ang__angsuran_ke=$ags_ke; 
        $t_ang__awal=$periode_awal;
        $t_ang__akhir=$periode_akhir;

     // var_dump($t_ang__nilai_angsuran)or die();
                   
//--------------PERIODE AFTER CLOSING---------------------//        
        
         $cek_status="SELECT
t_angsuran_pinjaman.t_ang__jenis,
t_angsuran_pinjaman.t_ang__nopjm,
t_angsuran_pinjaman.t_ang__idkaryawan,
t_angsuran_pinjaman.t_ang__tanggal,
t_angsuran_pinjaman.t_ang__nilai_angsuran,
t_angsuran_pinjaman.t_ang__angsuran_ke,
t_angsuran_pinjaman.t_ang__awal,
t_angsuran_pinjaman.t_ang__akhir 
FROM t_angsuran_pinjaman
where t_ang__nopjm='$t_ang__nopjm' and t_ang__awal='$periode_awal' and t_ang__akhir='$periode_akhir'";
          

        $rs_val = $db->Execute($cek_status);
        $cek_pjm= $rs_val->fields['t_ang__nopjm'];
        $cek_pjm_awal= $rs_val->fields['t_ang__awal'];
        $cek_pjm_akhir= $rs_val->fields['t_ang__akhir'];
            

   
if($cek_pjm==''&& $cek_pjm_awal=='' && $cek_pjm_akhir=='')
    {
  
    $sql = "      INSERT INTO $tbl_name (t_ang__jenis,"
                                        . "t_ang__nopjm,"
                                        . "t_ang__idkaryawan,"
                                        . "t_ang__tanggal,"
                                        . " t_ang__nilai_angsuran,"
                                        . " t_ang__angsuran_ke,"
                                        . " t_ang__awal,"
                                        . " t_ang__akhir,"
                                        . " t_ang__date_created,"
                                        . " t_ang__date_updated,"
                                        . " t_ang__user_created,"
                                        . " t_ang__user_updated)";
    
 
                                    $sql	.= " VALUES ("
                                            . " '$t_ang__jenis',"
                                            . " '$t_ang__nopjm',"
                                            . " '$t_ang__idkaryawan',"
                                            . " '$t_ang__tanggal',"
                                            . " '$t_ang__nilai_angsuran',"     
                                            . " '$t_ang__angsuran_ke',"
                                            . " '$t_ang__awal',"
                                            . " '$t_ang__akhir',"
                                            . "now(),"
                                            . "now(),"
                                            . "'".strip_tags($id_peg)."',"
                                            . "'".strip_tags($id_peg)."')";

                                   
    $sqlresult = $db->Execute($sql);
    
    }
    elseif($cek_pjm!='' && $cek_pjm_awal!='' && $cek_pjm_akhir!='')
{
 
        $sql_edit  ="  UPDATE $tbl_name SET ";
        $sql_edit .=" t_ang__jenis= '$t_ang__jenis',";
        $sql_edit .=" t_ang__nopjm='$t_ang__nopjm',";
        $sql_edit .=" t_ang__idkaryawan='$t_ang__idkaryawan',";
        $sql_edit .=" t_ang__tanggal='$t_ang__tanggal',";
        $sql_edit .=" t_ang__nilai_angsuran='$t_ang__nilai_angsuran',";
         $sql_edit .="t_ang__angsuran_ke='$t_ang__angsuran_ke',";
        $sql_edit .=" t_ang__awal='$t_ang__awal',";
        $sql_edit .="t_ang__akhir='$t_ang__akhir',";
        $sql_edit .="t_ang__date_updated=now(),";
        $sql_edit .="t_ang__user_updated='$id_peg'";	
        $sql_edit .="  WHERE t_ang__nopjm='$t_ang__nopjm' AND t_ang__idkaryawan='$t_ang__idkaryawan'"
                . "   AND   t_ang__awal='$t_ang__awal' AND t_ang__akhir='$t_ang__akhir' ";
 // var_dump($sql_edit)or die();
        $sqlresult = $db->Execute($sql_edit);
        
        
        
        
        } 
    
     

    } 
  
     
   
   
}        
      
    }
Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
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
