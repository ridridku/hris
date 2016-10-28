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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/master/periode_aktif';

$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/master');
$FILE_JS  = $JS_MODUL.'/periode_aktif';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "t_absensi";




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
$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];
$today = date("Y-m-d h:i:s");

        $r_periode__payroll_id = addslashes($_POST[r_periode__payroll_id]);	
      //  $r_periode__payroll_bulan = addslashes($_POST[bulan]);
          $r_periode__payroll_bulan =$_POST[bulan];
        $r_periode__payroll_tahun = $_POST[tahun];
        $r_periode__payroll_created = addslashes($_POST[r_periode__payroll_created]);
        $r_periode__payroll_user_created = addslashes($_POST[r_periode__payroll_updated]);
        $r_periode__payroll_updated = addslashes($_POST[r_pegawai__nama]);
        $r_periode__payroll_user_updated = addslashes($_POST[r_periode__payroll_user_updated]);
//        $r_periode__payroll_bulan = explode('-', $r_periode__payroll_bulan);
//        
//        $year  = $r_periode__payroll_bulan[0];
//        $month = $r_periode__payroll_bulan[1];
//        $day   = $r_periode__payroll_bulan[2];
        
        $sql_cek="SELECT * FROM r_periode_payroll A  WHERE A.r_periode__payroll_status=1";
        $rs_val = $db->Execute($sql_cek);
        $periode_id = $rs_val->fields['r_periode__payroll_id'];
        $periode_bulan = $rs_val->fields['r_periode__payroll_bulan'];
        $periode_tahun= $rs_val->fields['r_periode__payroll_tahun'];
        $periode_status = $rs_val->fields['r_periode__payroll_status'];
      
       

		//if ($month == $periode_bulan OR  $year ==$periode_tahun ) {
		//		Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);

		//} else //{ 
                        
                    
                    IF($periode_status==1 )
                    {
                        $sql_edit7  ="  UPDATE r_periode_payroll set ";
                        $sql_edit7 .=" r_periode__payroll_status = '0' ";
                        $sql_edit7 .="  WHERE r_periode__payroll_status=1 ";
                   //  var_dump($sql_edit7)or die();
			$sqlresult5 = $db->Execute($sql_edit7);
       } 
                        $sql_edit  ="  UPDATE r_periode_payroll set ";
                        $sql_edit .=" r_periode__payroll_bulan ='$_POST[bulan]', ";
                        $sql_edit .=" r_periode__payroll_tahun ='$_POST[tahun]', ";
                        $sql_edit .=" r_periode__payroll_status = 1, ";
                        $sql_edit .=" r_periode__payroll_updated = '$today', ";
                        $sql_edit .=" r_periode__payroll_user_updated = $id_peg ";
                        $sql_edit .="  WHERE r_periode__payroll_id='$_POST[r_periode__payroll_id]' ";
                      //  var_dump($sql_edit) or die();
			$sqlresult4 = $db->Execute($sql_edit);
                 
                     
                    
                 
                    
			
                   
                        
    $ip_now = $_SERVER['REMOTE_ADDR'];
    $user_id = base64_decode($_SESSION['UID']);
    $sql2="INSERT INTO tbl_log (url, waktu, module, user_id )  VALUES ('$ip_now',now(),'Ubah data >> master WNI  ($nama)','$user_id') ";
    $db->Execute($sql2);
			Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		//}
}

function create_(){
    
        global $mod_id;	
        global $db;
        global $tbl_name;
        global $field_name;
        
       
        $now= date("Y-m-d");
       
        $t_abs__tgl = addslashes($_POST[t_abs__tgl]);
      
        $t_abs__tgl = explode('-', $t_abs__tgl);
        
        $year = $t_abs__tgl[0];
        $month   = $t_abs__tgl[1];
  
        
      
        $r_periode__payroll_status = addslashes($_POST[r_periode__payroll_status]);
       
        
        
       
        $r_periode__payroll_created = $id_peg;
        $r_periode__payroll_updated = '';
        $r_periode__payroll_created= Date('Y-m-d H:i:s');
        $r_periode__payroll__user_updated = '';

        
    
        $sql_cek="SELECT * FROM r_periode_payroll A  WHERE A.r_periode__payroll_status=1";
        $rs_val = $db->Execute($sql_cek);
        $periode_id = $rs_val->fields['r_periode__payroll_id'];
        $periode_status = $rs_val->fields['r_periode__payroll_status'];
        
       

 
    if ($periode_status==1 ) {
        
        $hasil='true';
			Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
		}else { 
                    
                    
               $hasil='false';      
               
                        $CekFingerPrint="SELECT
                                    A.r_shift__jam_masuk,
                                    A.r_shift__jam_pulang,
                                    A.r_shift__jml_jam,
                                    A.r_shift__id,
                                    L.r_libur__tgl,
                                    L.r_libur__ket
                                  FROM
                                             r_shift A, r_penempatan B,t_libur L
                                      WHERE
                                   A.r_shift__id = B.r_pnpt__shift AND  B.r_pnpt__finger_print = '".$t_abs__fingerprint."' AND A.r_shift__id=L.r_libur__id_shift";
                       
                    $sqlresult = $db->Execute($CekFingerPrint);
                    $initSet = array();
                    $data_finger = array();
                    $z=0;
                          
                   
                    while ($arr=$sqlresult->FetchRow())
                            {
                                array_push($data_finger, $arr);
                                array_push($initSet, $z);
                                $z++;
                                $rule_jam_masuk=$data_finger[0][0];
                                $rule_jam_keluar=$data_finger[0][1];
                                $rule_jam_total=$data_finger[0][2];
                                $rule_jam_shift=$data_finger[0][3];
                                $rule_tgl_libur=$data_finger[0][4];
                                $rule_tgl_ket=$data_finger[0][5];
                                
                             
                              
                            list($jam,$menit,$detik)=explode(':',$rule_jam_masuk);
                            $r_jam_masuk=mktime($jam,$menit,$detik,1,1,1);
                             
                            list($jam,$menit,$detik)=explode(':',$rule_jam_total);
                            $r_jam_total=mktime($jam,$menit,$detik,1,1,1);
                            
                            
                            list($jam,$menit,$detik)=explode(':',$t_abs__jam_masuk);
                            $jam_masuk=mktime($jam,$menit,$detik,1,1,1);                    
                            
                            list($jam,$menit,$detik)=explode(':',$t_abs__jam_keluar);
                            $jam_keluar=mktime($jam,$menit,$detik,1,1,1);
                            
                            list($jam,$menit,$detik)=explode(':',$t_abs__worktime);
                            $work_time=mktime($jam,$menit,$detik,1,1,1);
                                                        
                            $total_jam_kerja=diffTime($t_abs__jam_masuk,$t_abs__jam_keluar);
                    
                                                        
                            
			 $sql="INSERT INTO t_absensi(t_abs__fingerprint, t_abs__tgl, t_abs__id_shift, t_abs__jam_masuk, t_abs__jam_keluar, t_abs__early, t_abs__lately, t_abs__approval, t_abs__lesstime, t_abs__overtime, t_abs__worktime, t_abs__status, t_abs__catatan, t_abs__date_created, t_abs__date_updated, t_abs__user_created, t_abs__user_updated) VALUES "
                                 . "('$t_abs__fingerprint',"
                                 . "'$t_abs__tgl',"
                                 . "'$rule_jam_shift',"
                                 . "'$t_abs__jam_masuk',"
                                 . "'$t_abs__jam_keluar',"
                                 . "'$t_abs__early',"
                                 . "'$t_abs__lately',"
                                 . "'$t_abs__approval',"
                                 . "'$t_abs__lesstime',"
                                 . "'$t_abs__overtime',"
                                 . "'$t_abs__worktime',"
                                 . "'$t_abs__status',"
                                 . "'$t_abs__catatan',"
                                 . "'$t_abs__date_created',"
                                 . "'$t_abs__date_updated',"
                                 . "'$t_abs__user_created',"
                                 . "'$t_abs__user_updated')";	
                        
			 $sqlresult = $db->Execute($sql);		 
 
                                                  
                         
                         
                        $ip_now = $_SERVER['REMOTE_ADDR'];
                        $user_id = base64_decode($_SESSION['UID']);
                        $sql2="INSERT INTO tbl_log (url, waktu, module, user_id )  VALUES ('$ip_now',now(),'Tambah Data >> master WNI ($nama) ','$user_id') ";
                        $db->Execute($sql2);	
                        Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
                            
                        
                            }
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
