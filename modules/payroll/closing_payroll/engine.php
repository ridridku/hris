<?PHP
/*egine upload*/

# Including Main Configuration
# including file for Main Configurations
require_once('../../../includes/config.conf.php');
require_once('../../../includes/func.inc.php');

//var_dump($bb) or die();
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/payroll/closing_payroll';


$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/payroll');
$FILE_JS  = $JS_MODUL.'/closing_payroll';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "t_rekap_absensi";




//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM t_absensi ";
$sql .="WHERE  id= '$_GET[id]' ";

$sqlresult = $db->Execute($sql);



}

function edit_(){
global $mod_id;
global $db;
$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];


$periode_awal	= $_SESSION['SESSION_AWAL_AKTIF'];
$periode_akhir	= $_SESSION['SESSION_AKHIR_AKTIF']; 

        $t_abs__id= addslashes($_POST[t_abs__id]);	
        $r_pegawai__nama= addslashes($_POST[r_pegawai__nama]);	
        $r_cabang__id= addslashes($_POST[r_cabang__id]);	

        $t_abs__fingerprint= addslashes($_POST[r_pnpt__finger_print]);
        $t_abs__tgl= addslashes($_POST[t_abs__tgl]);	
        $t_abs__id_shift= addslashes($_POST[r_pnpt__shift]);	
        $t_abs__jam_masuk= addslashes($_POST[t_abs__jam_masuk]);	
        $t_abs__jam_keluar= addslashes($_POST[t_abs__jam_keluar]);	
        $t_abs__early = addslashes($_POST[t_abs__early]);
        $t_abs__lately = addslashes($_POST[t_abs__jam_lately]);	
        $t_abs__approval= addslashes($_POST[t_abs__approval]);	
        $t_abs__lesstime= addslashes($_POST[t_abs__lesstime]);	
        $t_abs__overtime= addslashes($_POST[t_abs__overtime]);	
        $t_abs__worktime= addslashes($_POST[t_abs__worktime]);	
        $t_abs__status= addslashes($_POST[t_abs__status]);	
        $t_abs__catatan= addslashes($_POST[t_abs__catatan]);	
        $t_abs__date_created= addslashes($_POST[t_abs__date_created]);	
        $t_abs__date_updated= date("Y-m-d h:i:s");
        $t_abs__user_created= addslashes($_POST[t_abs__user_created]);	
        $t_abs__user_updated= $id_peg;	

        $sql_cek_edit="SELECT * FROM t_absensi A where A.t_abs__fingerprint='$t_abs__fingerprint' AND A.t_abs__tgl='$t_abs__tgl'";
        
        $rs_val = $db->Execute($sql_cek_edit);
        $fingerprint = $rs_val->fields['t_abs__fingerprint'];
        $tgl_masuk = $rs_val->fields['t_abs__tgl'];
        $absen_id = $rs_val->fields['t_abs__id'];
      


        if ($t_abs__fingerprint!=$fingerprint AND $t_abs__tgl !=$tgl_masuk) {

                        Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);

        } else { 

                    
			$sql_edit  ="  UPDATE t_absensi set ";
                        $sql_edit .=" t_abs__fingerprint = '$_POST[r_pnpt__finger_print]', ";
                        $sql_edit .=" t_abs__tgl = '$_POST[t_abs__tgl]', ";
                        $sql_edit .=" t_abs__id_shift = '$_POST[r_pnpt__shift]', ";
                        $sql_edit .=" t_abs__jam_masuk = '$_POST[t_abs__jam_masuk]', ";
                        $sql_edit .=" t_abs__jam_keluar = '$_POST[t_abs__jam_keluar]', ";
                        $sql_edit .=" t_abs__early = '$_POST[t_abs__early]', ";
                        $sql_edit .=" t_abs__lately = '$_POST[t_abs__jam_lately]', ";
                        $sql_edit .=" t_abs__approval = '$_POST[t_abs__approval]', ";
                        $sql_edit .=" t_abs__lesstime = '$_POST[t_abs__lesstime]', ";
                        $sql_edit .=" t_abs__overtime = '$_POST[t_abs__overtime]', ";
                        $sql_edit .=" t_abs__worktime = '$_POST[t_abs__worktime]', ";
                        $sql_edit .=" t_abs__status = '$_POST[t_abs__status]', ";
                        $sql_edit .=" t_abs__catatan = '$_POST[t_abs__catatan]', ";
                        $sql_edit .=" t_abs__date_updated = now(),";
                        $sql_edit .=" t_abs__user_updated = '$id_peg'";
                        $sql_edit .="  WHERE t_abs__id='$_POST[t_abs__id]' ";
                       // var_dump($sql_edit)or die();
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
        global $tbl_name;
        global $field_name;
        

        $today = date("Y-m-d");
        $id_peg = $_SESSION['SESSION_ID_PEG'];
        $kode_cabang = addslashes($_POST[kode_cabang]);
        $periode_awal_next	= $_POST[periode_awal];
        $periode_akhir_next	= $_POST[periode_akhir]; 
       
        $sql_edit  =" UPDATE r_periode_payroll set ";
        $sql_edit .=" r_periode__payroll_status = '0', ";     
        $sql_edit .=" r_periode__payroll_user_updated = '$id_peg', ";
        $sql_edit .=" r_periode__payroll_user_updated = '$id_peg', ";
        $sql_edit .=" r_periode__payroll_created = now(), ";
        $sql_edit .=" r_periode__payroll_updated = now() ";
        $sql_edit .="  WHERE r_periode__payroll_status='1' ";

        $sqlresult4 = $db->Execute($sql_edit);

        $sql_cek_periode="SELECT
        r_periode__payroll_id,
    	r_periode__payroll_awal,
	r_periode__payroll_akhir,
        r_periode__payroll_status 
        FROM r_periode_payroll WHERE r_periode__payroll_awal='$periode_awal_next' and r_periode__payroll_akhir='$periode_akhir_next'  ";
        
        $rs_val = $db->Execute($sql_cek_periode);
        $cek_awal= $rs_val->fields['r_periode__payroll_awal'];
        $cek_akhir= $rs_val->fields['r_periode__payroll_akhir'];
        
       

        
        
     if(empty($cek_awal)&&empty($cek_akhir))
     {
          $sql= "INSERT INTO r_periode_payroll ("
                . "r_periode__payroll_awal, "
                . "r_periode__payroll_akhir,"
                . "r_periode__payroll_status,"
                . "r_periode__payroll_created,"
                . "r_periode__payroll_updated,"  
                . "r_periode__payroll_user_created,"
                . "r_periode__payroll_user_updated)";
             $sql    .= " VALUES ("
                . "'$periode_awal_next',"
                . "'$periode_akhir_next',"
                . "'1',"
                . "now(),"
                . "now(),"
                . "'$id_peg',"
                . "'$id_peg')";
         $sqlresult = $db->Execute($sql);
     }  else {
         
            $sql_edit  =" UPDATE r_periode_payroll set ";
            $sql_edit .=" r_periode__payroll_status = '1', ";   
            $sql_edit .=" r_periode__payroll_awal = '$periode_awal_next', "; 
            $sql_edit .=" r_periode__payroll_akhir = '$periode_akhir_next', "; 
            $sql_edit .=" r_periode__payroll_user_updated = '$id_peg', ";
            $sql_edit .=" r_periode__payroll_user_updated = '$id_peg', ";
            $sql_edit .=" r_periode__payroll_created = now(), ";
            $sql_edit .=" r_periode__payroll_updated = now() ";
            $sql_edit .="  WHERE r_periode__payroll_awal = '$periode_awal_next' and r_periode__payroll_akhir = '$periode_akhir_next' ";
            $sqlresult4 = $db->Execute($sql_edit);

         
     }

                
        //--------------PERIODE AFTER CLOSING----------------------------------//
 $sql_after_closing_="SELECT r_periode__payroll_id,
    	DATE_SUB(r_periode__payroll_awal, INTERVAL 1 MONTH) as awal,
	DATE_SUB(r_periode__payroll_akhir, INTERVAL 1 MONTH) as akhir,
        r_periode__payroll_status 
        FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";

        $rs_val = $db->Execute($sql_after_closing_);
        $pre_active= $rs_val->fields['awal'];
        $end_active= $rs_val->fields['akhir'];       
 //--------------PERIODE AFTER CLOSING----------------------------------//   
        
        
        
       $sql_cek_edit="SELECT
                    A.t_rkp__approval AS cek_approval,
                    A.t_rkp__no_mutasi AS cek_mutasi
                    FROM
                    t_rekap_absensi A
                    INNER JOIN r_penempatan B ON A.t_rkp__no_mutasi=B.r_pnpt__no_mutasi
                    INNER JOIN r_subcabang ON B.r_pnpt__subcab=r_subcab__id
                    INNER JOIN r_cabang ON r_cabang__id=r_subcab__cabang 
                    WHERE
                    A.t_rkp__awal >= '$pre_active' AND A.t_rkp__akhir <= '$end_active'";//AND r_cabang__id='$kode_cabang'
      // var_dump($sql_cek_edit)or die();
                    $rs_val = $db->Execute($sql_cek_edit);
                    $cek_approval = $rs_val->fields['cek_approval'];
                    $cek_mutasi = $rs_val->fields['cek_mutasi'];
       
         if ($cek_approval>=4)
                {
       
                  Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);           
                }        else{     
                   $sql="UPDATE t_rekap_absensi AS t1
                        SET t1.t_rkp__approval = '4',
                        t_rkp__date_updated = now(),
                        t_rkp__user_updated = '$id_peg'
                        WHERE	t1.t_rkp__awal >= '$pre_active' AND t1.t_rkp__akhir <= '$end_active' AND t1.t_rkp__approval = '3' ";
                        $sqlresult = $db->Execute($sql);
              
//           $sql_cek_rekap="SELECT
//                        A.t_rkp__approval AS approval,
//                        A.t_rkp__no_mutasi AS mutasi,
//                        B.r_pnpt__finger_print AS finger
//                    FROM
//                            t_rekap_absensi A
//                    INNER JOIN r_penempatan B ON A.t_rkp__no_mutasi=B.r_pnpt__no_mutasi
//                    INNER JOIN r_subcabang ON B.r_pnpt__subcab=r_subcab__id
//                    INNER JOIN r_cabang ON r_cabang__id=r_subcab__cabang 
//                    WHERE
//                    A.t_rkp__awal >= '$pre_active' AND A.t_rkp__akhir <= '$end_active'  AND A.t_rkp__approval='3' ";//AND r_cabang__id='$kode_cabang'
//           //var_dump($sql_cek_rekap)or die();
//           
//             $sqlres = $db->Execute($sql_cek_rekap);
//             $tmp = array();
//             $z=0;
//             while ($data=$sqlres->FetchRow())
//                     {
//
//                         $approval=$data[0];
//                         $mutasi=$data[1];
//                         $finger=$data[2];
//                         array_push($tmp, $mutasi);
//
//                         
//                         $sql=" UPDATE t_rekap_absensi AS t1 
//                            INNER JOIN v_pegawai AS t2 
//                            SET t1.t_rkp__approval='4',
//                            t_rkp__date_updated=now(),
//                            t_rkp__user_updated='$id_peg'   
//                            WHERE t1.t_rkp__awal>='$pre_active'  AND t1.t_rkp__akhir<='$end_active' 
//                             AND t2.r_pnpt__no_mutasi=t1.t_rkp__no_mutasi "
//                            . " AND t1.t_rkp__approval='3' AND t1.t_rkp__no_mutasi='$mutasi' ";//AND t2.r_cabang__id='$kode_cabang'
//                // var_dump($sql)or die();
//                          $sqlresult = $db->Execute($sql);
//                         
//                     }
        
                
          
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
