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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kehadiran/surat_cuti';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kehadiran');
$FILE_JS  = $JS_MODUL.'/surat_cuti';
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

//$all_pjm= implode(",",$_POST['test']);
     $all_pjm= $_POST['bayar'];
 

$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];

$r_ang__jenis    = $_POST[r_ang__jenis];
$r_ang__platfond = remove_non_numerics($_POST[r_ang__platfond]);
$r_ang__ket      = $_POST[r_ang__ket];
$r_ang__total    = remove_non_numerics($_POST[r_ang__total]);
$r_ang__tenor_bulan  = $_POST[r_ang__tenor_bulan];
$r_ang__cicilan   = remove_non_numerics($_POST[r_ang__cicilan]);
$t_sp__user_created = $id_peg;

  
 $tgl_now = date("Y-m-d h:i:s");

 if ($all_pjm=='') {
			Header("Location:index_cek.php?ERR=5&cek_no__sp=".$t_sp__no."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else
                {
                      $all_pjm= $_POST['bayar'];
                    for ($i=0; $i < sizeof($all_pjm); $i++)
               {
                      
                      $sql_count="SELECT
                                       COUNT(t_ang__nopjm) as no_pjm
                                        
                                      FROM
                                        t_angsuran_pinjaman where t_ang__nopjm='$all_pjm[$i]' ";
                     
                    $rs_val = $db->Execute($sql_count);
                    $ags_ke= $rs_val->fields['no_pjm']+1;  
                        
                        // var_dump($no_pjm)or die();
                        
                    $sql_cek_rekap=" SELECT
                                        B.r_ang__id AS r_ang__id,
                                        B.r_ang__jenis AS r_ang__jenis,
                                        B.r_ang__platfond AS r_ang__platfond,
                                        B.r_ang__ket AS r_ang__ket,
                                        B.r_ang__total AS r_ang__total,
                                        B.r_ang__tenor_bulan AS r_ang__tenor_bulan,
                                        B.r_ang__cicilan AS r_ang__cicilan,
                                        C.t_pjm__no_pinjaman AS t_pjm__no_pinjaman,
                                        C.t_pjm__jenis AS t_pjm__jenis,
                                        C.t_pjm__mutasi AS t_pjm__mutasi,
                                        C.t_pjm__tgl_disetujui AS t_pjm__tgl_disetujui,
                                        C.t_pjm__approval AS t_pjm__approval,
                                        C.t_pjm__keterangan AS t_pjm__keterangan,
                                        peg.r_pegawai__nama AS r_pegawai__nama,
                                        peg.r_pnpt__no_mutasi  AS r_pnpt__no_mutasi,
                                        peg.r_cabang__nama  AS r_cabang__nama,
                                        peg.r_pnpt__finger_print  AS r_pnpt__finger_print
                                      FROM r_angsuran B
                                        INNER JOIN t_pinjaman C ON B.r_ang__id=C.t_pjm__jenis
                                        INNER JOIN v_pegawai peg ON peg.r_pnpt__no_mutasi=C.t_pjm__mutasi
                                        where t_pjm__no_pinjaman='$all_pjm[$i]' AND t_pjm__approval=1";
             
                   
                    $sqlres = $db->Execute($sql_cek_rekap);
                    $tmp = array();
                    $z=0;
                    
               while ($data=$sqlres->FetchRow())
                            {
                                
                                $jenis_pjm=$data[0];
                                $no_mutasi=$data[9];
                                $no_pjm=$data[7];
                                $nilai_angsuran=$data[6];
                             
                                array_push($tmp, $jenis_pjm,$no_mutasi,$nilai_angsuran);
                                
			  $sql= "INSERT INTO $tbl_name ("
                                            . "t_ang__jenis,"
                                            . "t_ang__nopjm,"
                                            . "t_ang__mutasi, "
                                            . "t_ang__tanggal,"
                                            . "t_ang__nilai_angsuran,"
                                            . "t_ang__angsuran_ke,"
                                            . "t_ang__date_created,"
                                            . "t_ang__user_created)";
 
                                    $sql	.= " VALUES ("
                                            . "'$jenis_pjm',"
                                            . "'$no_pjm',"
                                            . "'$no_mutasi',"
                                            . "now(),"
                                            . "'$nilai_angsuran',"
                                            . "'$ags_ke',"
                                            . "now(),"
                                            . "'$id_peg')";
                                 //     var_dump($sql) or die();
                            $sqlresult = $db->Execute($sql);	 
         //(t_ang__jenis, t_ang__mutasi, t_ang__tanggal, t_ang__nilai_angsuran, t_ang__angsuran_ke, t_ang__date_created, t_ang__date_updated, t_ang__user_created, t_ang__user_updated)
                            }
        
                }
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
