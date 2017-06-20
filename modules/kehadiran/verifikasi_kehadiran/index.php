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

#FOR IMAGES CLASS PAGER
$HREF_IMAGES = $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images');

# including Header file for Content Expiring
require_once($DIR_INC.'/header.exp.inc');
# including Header file for Database Configuration
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');

require_once($DIR_INC.'/func.inc.php');

$p = new Pager;
$db = &ADONewConnection($DB_TYPE);
 //$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

# including the proper language file
require_once($DIR_LANG.'/'.base64_decode($_SESSION['LANG']).'.lang.php');
# including the proper theme template file and also generate output
//require_once($DIR_INC.'/copyright.tpl');

//=================================== BEGIN PARSING TEMPLATE BLOCK====================================

# including Header file for Smarty Parser Configurator
require_once($DIR_INC."/libs.inc.php");
# setting Smarty Class Debugger
//$smarty->debugging = true;

# Start Parsing the Template

$jenis_user  = $_SESSION['SESSION_JNS_USER'];
$kode_pw_ses  = $_SESSION['SESSION_KODE_CABANG'];
$smarty->assign ("JENIS_USER_SES", $jenis_user);
$smarty->assign ("KODE_PW_SES", $kode_pw_ses);

$periode_awal= $_SESSION['SESSION_AWAL_AKTIF'];
$periode_akhir= $_SESSION['SESSION_AKHIR_AKTIF'];
$smarty->assign ("PERIODE_AWAL", $periode_awal);
$smarty->assign ("PERIODE_AKHIR", $periode_akhir);


#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);

$smarty->assign ("HREF_HOME_PATH_AJAX", $HREF_HOME.'/modules/kehadiran/verifikasi_kehadiran');
$smarty->assign ("HREF_IMG_PATH", $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images'));
$smarty->assign ("HREF_CSS_PATH", $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/css'));
$smarty->assign ("HREF_JS_PATH", $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts'));


#DIR
$smarty->assign ("DIR_HOME_PATH", $DIR_HOME);
$smarty->assign ("DIR_IMG_PATH", $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images'));
$smarty->assign ("DIR_CSS_PATH", $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/css'));
$smarty->assign ("DIR_JS_PATH", $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts'));
$smarty->assign ("SELF", $_SERVER['PHP_SELF']);

//------------------------------------LOCAL CONFIG--------------------------------------//
#SETTING FOR TEMPLATE
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kehadiran/verifikasi_kehadiran/';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kehadiran');
$FILE_JS  = $JS_MODUL.'/verifikasi_kehadiran';

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}

$user_id = base64_decode($_SESSION['UID']);

$smarty->assign ("MOD_ID", $mod_id);

#Initiate TABLE
$tbl_name	= "t_absensi";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//


if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;
//
//IF ($LIMIT==50)
//{
//    $LIMIT = 30;
//    
//}  else {
//    if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
//else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
//else $LIMIT=$nLimit;
//}
if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="  tanggal desc ";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['kode_perwakilan_cari']) $kode_perwakilan_cari = $_GET['kode_perwakilan_cari'];
else if ($_POST['kode_perwakilan_cari']) $kode_perwakilan_cari = $_POST['kode_perwakilan_cari'];
else $kode_perwakilan_cari="";


if ($_GET['nama_karyawan_cari']) $nama_karyawan_cari = $_GET['nama_karyawan_cari'];
else if ($_POST['nama_karyawan_cari']) $nama_karyawan_cari = $_POST['nama_karyawan_cari'];
else $nama_karyawan_cari="";
 
if ($_GET['idfinger_cari']) $idfinger_cari= $_GET['idfinger_cari'];
else if ($_POST['idfinger_cari']) $idfinger_cari = $_POST['idfinger_cari'];
else $idfinger_cari="";


if ($_GET['status_cari']) $status_cari= $_GET['status_cari'];
else if ($_POST['status_cari']) $status_cari = $_POST['status_cari'];
else $status_cari="";

if ($status_cari==505)
{
    $status_cari='0';
}

$smarty->assign ("KODE_PERWAKILAN_CARI", $kode_perwakilan_cari);
$smarty->assign ("NAMA_KARYAWAN_CARI", $nama_karyawan_cari);
$smarty->assign ("ID_FINGER_CARI", $idfinger_cari);
 
$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_perwakilan_cari=".$kode_perwakilan_cari."&nama_karyawan_cari=".$nama_karyawan_cari."&idfinger_cari=".$idfinger_cari."&bulan=".$bulan."&tahun=".$tahun;
//$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;
$str_completer_ = "mod_id=".$mod_id."&limit=".$LIMIT."&page=".$page."&SORT=".$SORT."&kode_perwakilan_cari=".$kode_perwakilan_cari."&nama_karyawan_cari=".$nama_karyawan_cari."&idfinger_cari=".$idfinger_cari."&bulan=".$bulan."&tahun=".$tahun;


//-------------DATA CABANG--------------------------------------//
$sql_pwk = "SELECT * FROM r_cabang order by r_cabang__id  ";
$result_pwk = $db->Execute($sql_pwk);

$initSet = array();
$data_pwk = array();
$z=0;
while ($arr=$result_pwk->FetchRow()) {
	array_push($data_pwk, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_CABANG", $data_pwk);
//-------------CLOSE DATA CABANG--------------------------------------//

//-----------------------VIEW EDIT ---------------------------------------//
$opt = $_GET[opt];
$ed = 0;
if($opt=="1")
{ 
        $sql_= "SELECT A.*,B.r_cabang__id,B.r_cabang__nama,C.r_subcab__id,C.r_subcab__nama,D.r_pnpt__finger_print,E.r_pegawai__nama,F.r_shift__id,F.r_shift__ket
            FROM t_absensi A,r_cabang B,r_subcabang C,r_penempatan D,
            r_pegawai E,r_shift F
                 where 
                A.t_abs__fingerprint = D.r_pnpt__finger_print and D.r_pnpt__id_pegawai=E.r_pegawai__id
                and C.r_subcab__cabang=B.r_cabang__id and D.r_pnpt__subcab=C.r_subcab__id  AND D.r_pnpt__shift=F.r_shift__id and A.t_abs__id='".$_GET['id']."'";
     
       
    $resultSet = $db->Execute($sql_);                    
    $edit_t_abs__id = $resultSet->fields[t_abs__id];
    $edit_r_pegawai__nama = $resultSet->fields[r_pegawai__nama];
    $edit_r_cabang__id = $resultSet->fields[r_cabang__id];
    $edit_t_abs__fingerprint = $resultSet->fields[t_abs__fingerprint];
    $edit_t_abs__tgl = $resultSet->fields[t_abs__tgl];
    $edit_t_abs__id_shift = $resultSet->fields[t_abs__id_shift];
    $edit_t_abs__jam_masuk = $resultSet->fields[t_abs__jam_masuk];
    $edit_t_abs__jam_keluar = $resultSet->fields[t_abs__jam_keluar];
    $edit_t_abs__early = $resultSet->fields[t_abs__early];
    $edit_t_abs__lately = $resultSet->fields[t_abs__lately];
    $edit_t_abs__approval = $resultSet->fields[t_abs__approval];
    $edit_t_abs__lesstime = $resultSet->fields[t_abs__lesstime];
    $edit_t_abs__overtime = $resultSet->fields[t_abs__overtime];
    $edit_t_abs__worktime = $resultSet->fields[t_abs__worktime];
    $edit_t_abs__status = $resultSet->fields[t_abs__status];
    $edit_t_abs__catatan = $resultSet->fields[t_abs__catatan];
    $edit_t_abs__date_created = $resultSet->fields[t_abs__date_created];
    $edit_t_abs__date_updated = $resultSet->fields[t_abs__date_updated];
    $edit_t_abs__user_created = $resultSet->fields[t_abs__user_created];
    $edit_t_abs__user_updated = $resultSet->fields[t_abs__user_updated];
    $edit_shift_ket = $resultSet->fields[r_shift__ket];
    
     
    
  //  var_dump($str_completer_) or die();


    $smarty->assign ("OPT", $opt); //component_edit
    $smarty->assign ("EDIT_ID", $edit_id);//component_edit 
    
    $smarty->assign("EDIT_T_ABS__ID",$edit_t_abs__id);
    $smarty->assign("EDIT_T_ABS__NAMA", $edit_r_pegawai__nama);
    $smarty->assign("EDIT_KODE_CABANG",$edit_r_cabang__id);
    
    $smarty->assign("EDIT_T_ABS__FINGERPRINT",$edit_t_abs__fingerprint);	
    $smarty->assign("EDIT_T_ABS__TGL",$edit_t_abs__tgl);	
    $smarty->assign("EDIT_T_ABS__ID_SHIFT",$edit_t_abs__id_shift);	
     $smarty->assign("EDIT_SHIFT_KET",$edit_shift_ket);
    $smarty->assign("EDIT_T_ABS__JAM_MASUK",$edit_t_abs__jam_masuk);	
    $smarty->assign("EDIT_T_ABS__JAM_KELUAR",$edit_t_abs__jam_keluar);	
    $smarty->assign("EDIT_T_ABS__EARLY",$edit_t_abs__early);	
    $smarty->assign("EDIT_T_ABS__LATELY",$edit_t_abs__lately);	
    $smarty->assign("EDIT_T_ABS__APPROVAL",$edit_t_abs__approval);	
    $smarty->assign("EDIT_T_ABS__LESSTIME",$edit_t_abs__lesstime);	
    $smarty->assign("EDIT_T_ABS__OVERTIME",$edit_t_abs__overtime);	
    $smarty->assign("EDIT_T_ABS__WORKTIME",$edit_t_abs__worktime);	
    $smarty->assign("EDIT_T_ABS__STATUS",$edit_t_abs__status);	
    $smarty->assign("EDIT_T_ABS__CATATAN",$edit_t_abs__catatan);	
    $smarty->assign("EDIT_T_ABS__DATE_CREATED",$edit_t_abs__date_created);	
    $smarty->assign("EDIT_T_ABS__DATE_UPDATED",$edit_t_abs__date_updated);	
    $smarty->assign("EDIT_T_ABS__USER_CREATED",$edit_t_abs__user_created);	
    $smarty->assign("EDIT_T_ABS__USER_UPDATED",$edit_t_abs__user_updated);
    
    $edit=1;
    $smarty->assign ("EDIT_VAL", $edit);
    
    
         $sql_print="SELECT 
                    r_penempatan.r_pnpt__id_pegawai,
                    r_penempatan.r_pnpt__finger_print
                    FROM t_absensi
                    INNER JOIN r_penempatan On r_penempatan.r_pnpt__finger_print=t_absensi.t_abs__fingerprint
                    WHERE t_absensi.t_abs__id='$edit_t_abs__id' GROUP BY r_penempatan.r_pnpt__id_pegawai";

        $rs_val = $db->Execute($sql_print);
        $finger_cuti= $rs_val->fields['r_pnpt__finger_print'];
        $idpeg_cuti = $rs_val->fields['r_pnpt__id_pegawai'];

         $sql_cek="SELECT
                    peg.r_pnpt__id_pegawai,
                    peg.r_pnpt__finger_print,
                    peg.r_pegawai__nama,
                    t_cuti.t_cuti__no,t_cuti.t_cuti__jenis_cuti
                    FROM v_pegawai peg INNER JOIN t_cuti On t_cuti.t_cuti__nip=peg.r_pnpt__id_pegawai and t_cuti.t_cuti__awal='$edit_t_abs__tgl'
                    WHERE peg.r_pnpt__aktif = 1 AND t_cuti.t_cuti__nip='$idpeg_cuti' GROUP BY peg.r_pegawai__id";
       
                    $rs_val = $db->Execute($sql_cek);
                    $t_cuti__jenis_cuti= $rs_val->fields['t_cuti__jenis_cuti'];
                    $idpeg_cek = $rs_val->fields['r_pnpt__id_pegawai'];
                    $cuti_cek = $rs_val->fields['t_cuti__no'];
                    
                    $smarty->assign("EDIT_JENIS_CUTI",$t_cuti__jenis_cuti);
                    
                  
}                    


//---------------------------------CLOSE VIEW EDIT ----------------------------------------------------------------//
 

//CEK PERIODE AKTIF
$sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_awal,r_periode__payroll_akhir,r_periode__payroll_status
FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";                 
$rs_val = $db->Execute($sql_cek_periode);
$start= $rs_val->fields['r_periode__payroll_awal'];
$end= $rs_val->fields['r_periode__payroll_akhir']; 

//---------------------------------VIEW INDEX----------------$opt = $_GET[opt];-----------------------------------------------------//
if ($_GET['search'] == '1')
    {
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
 
		  if($jenis_user=='2'){
                                                  $sql  = "SELECT
                                                        A.r_dept__ket,A.r_pnpt__id_pegawai,A.r_pnpt__no_mutasi,A.r_pnpt__aktif,
                                                        A.r_pnpt__nip,A.r_pnpt__finger_print,A.r_subcab__id,A.r_subcab__nama,A.r_cabang__id,A.r_cabang__nama,
                                                        A.id_pegawai,A.r_pegawai__nama,A.t_abs__id,A.t_abs__tgl,A.t_abs__jam_masuk,A.t_abs__jam_keluar,
                                                        A.t_abs__early,A.t_abs__lately,A.t_abs__approval,A.t_abs__lesstime,
                                                        A.t_abs__overtime,A.t_abs__worktime,A.t_abs__status,A.ketentuan_jam_masuk,A.ketentuan_jam_keluar
                                                      FROM
                                                        (SELECT
                                                          r_departement.r_dept__ket AS r_dept__ket,
                                                          r_penempatan.r_pnpt__id_pegawai AS r_pnpt__id_pegawai,
                                                          r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                                            r_penempatan.r_pnpt__aktif AS  r_pnpt__aktif,
                                                          r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                                          r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
                                                          r_subcabang.r_subcab__id AS r_subcab__id,
                                                          r_subcabang.r_subcab__nama AS r_subcab__nama,
                                                          r_cabang.r_cabang__id AS r_cabang__id,
                                                          r_cabang.r_cabang__nama AS r_cabang__nama,
                                                          r_pegawai.r_pegawai__id AS id_pegawai,
                                                          r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                                                          r_shift.r_shift__jam_masuk AS ketentuan_jam_masuk,
                                                          r_shift.r_shift__jam_pulang AS ketentuan_jam_keluar,
                                                          t_absensi.t_abs__id AS t_abs__id,
                                                          t_absensi.t_abs__tgl AS t_abs__tgl,
                                                          t_absensi.t_abs__jam_masuk AS t_abs__jam_masuk,
                                                          t_absensi.t_abs__jam_keluar AS t_abs__jam_keluar,
                                                          t_absensi.t_abs__early AS t_abs__early,
                                                          t_absensi.t_abs__lately AS t_abs__lately,
                                                          t_absensi.t_abs__approval AS t_abs__approval,
                                                          t_absensi.t_abs__lesstime AS t_abs__lesstime,
                                                          t_absensi.t_abs__overtime AS t_abs__overtime,
                                                          t_absensi.t_abs__worktime AS t_abs__worktime,
                                                          t_absensi.t_abs__status AS t_abs__status
                                                        FROM
                                                          r_penempatan
                                                          INNER JOIN r_pegawai
                                                            ON r_pegawai.r_pegawai__id = r_penempatan.r_pnpt__id_pegawai
                                                          INNER JOIN r_shift
                                                            ON r_shift.r_shift__id = r_penempatan.r_pnpt__shift
                                                          INNER JOIN t_absensi
                                                            ON r_penempatan.r_pnpt__finger_print = t_absensi.t_abs__fingerprint
                                                          INNER JOIN r_subcabang
                                                            ON r_subcabang.r_subcab__id = r_penempatan.r_pnpt__subcab
                                                          INNER JOIN r_cabang
                                                            ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                                          INNER JOIN r_subdepartement
                                                            ON r_subdepartement.r_subdept__id = r_pnpt__subdept
                                                          INNER JOIN r_departement
                                                            ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept) A WHERE  A.r_pnpt__aktif=1 AND A.t_abs__tgl >='$start' AND A.t_abs__tgl<='$end' AND A.r_cabang__id = '".$kode_pw_ses."'";
                      

			} else {
						$sql  = "SELECT
                                                        A.r_dept__ket,A.r_pnpt__id_pegawai,A.r_pnpt__no_mutasi,A.r_pnpt__aktif,
                                                        A.r_pnpt__nip,A.r_pnpt__finger_print,A.r_subcab__id,A.r_subcab__nama,A.r_cabang__id,A.r_cabang__nama,
                                                        A.id_pegawai,A.r_pegawai__nama,A.t_abs__id,A.t_abs__tgl,A.t_abs__jam_masuk,A.t_abs__jam_keluar,
                                                        A.t_abs__early,A.t_abs__lately,A.t_abs__approval,A.t_abs__lesstime,
                                                        A.t_abs__overtime,A.t_abs__worktime,A.t_abs__status,A.ketentuan_jam_masuk,A.ketentuan_jam_keluar
                                                      FROM
                                                        (SELECT
                                                          r_departement.r_dept__ket AS r_dept__ket,
                                                          r_penempatan.r_pnpt__id_pegawai AS r_pnpt__id_pegawai,
                                                          r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                                            r_penempatan.r_pnpt__aktif AS  r_pnpt__aktif,
                                                          r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                                          r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
                                                          r_subcabang.r_subcab__id AS r_subcab__id,
                                                          r_subcabang.r_subcab__nama AS r_subcab__nama,
                                                          r_cabang.r_cabang__id AS r_cabang__id,
                                                          r_cabang.r_cabang__nama AS r_cabang__nama,
                                                          r_pegawai.r_pegawai__id AS id_pegawai,
                                                          r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                                                          r_shift.r_shift__jam_masuk AS ketentuan_jam_masuk,
                                                          r_shift.r_shift__jam_pulang AS ketentuan_jam_keluar,
                                                          t_absensi.t_abs__id AS t_abs__id,
                                                          t_absensi.t_abs__tgl AS t_abs__tgl,
                                                          t_absensi.t_abs__jam_masuk AS t_abs__jam_masuk,
                                                          t_absensi.t_abs__jam_keluar AS t_abs__jam_keluar,
                                                          t_absensi.t_abs__early AS t_abs__early,
                                                          t_absensi.t_abs__lately AS t_abs__lately,
                                                          t_absensi.t_abs__approval AS t_abs__approval,
                                                          t_absensi.t_abs__lesstime AS t_abs__lesstime,
                                                          t_absensi.t_abs__overtime AS t_abs__overtime,
                                                          t_absensi.t_abs__worktime AS t_abs__worktime,
                                                          t_absensi.t_abs__status AS t_abs__status
                                                        FROM
                                                          r_penempatan
                                                          INNER JOIN r_pegawai
                                                            ON r_pegawai.r_pegawai__id = r_penempatan.r_pnpt__id_pegawai
                                                          INNER JOIN r_shift
                                                            ON r_shift.r_shift__id = r_penempatan.r_pnpt__shift
                                                          INNER JOIN t_absensi
                                                            ON r_penempatan.r_pnpt__finger_print = t_absensi.t_abs__fingerprint
                                                          INNER JOIN r_subcabang
                                                            ON r_subcabang.r_subcab__id = r_penempatan.r_pnpt__subcab
                                                          INNER JOIN r_cabang
                                                            ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                                          INNER JOIN r_subdepartement
                                                            ON r_subdepartement.r_subdept__id = r_pnpt__subdept
                                                          INNER JOIN r_departement
                                                            ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept) A WHERE  A.r_pnpt__aktif=1
                                                            AND  A.t_abs__tgl >='$start' AND A.t_abs__tgl<='$end'" ;	

			}
 
				//echo "<br><br><br><br><br><br><br><br><br><br>dddddddddkode_perwakilan_cari ===".$kode_perwakilan_cari;
			 
				if($kode_perwakilan_cari !=''){
					$sql .= "AND  A.r_cabang__id= '".$kode_perwakilan_cari."'  ";
				}
				if($nama_karyawan_cari !=''){
					$sql .= "AND A.r_pegawai__nama LIKE '%".$nama_karyawan_cari."%' "; 
				}
                                if($idfinger_cari !=''){
					$sql .= "AND A.r_pnpt__finger_print = '".$idfinger_cari."' "; 
                                        
				} 
                                if($status_cari !=""){
					$sql .= "AND A.t_abs__status = '".$status_cari."' ";   
				} 
                                
                             
			 	 $sql .= " order by A.t_abs__tgl asc ";

                                 if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);

                                 
				$numresults=$db->Execute($sql);
				$count = $numresults->RecordCount();
				//$pages = $p->findPages($count,$LIMIT); 
				//$sql  .= "LIMIT ".$start.", ".$LIMIT;
                              
				$recordSet = $db->Execute($sql);
				
				$end = $recordSet->RecordCount();
				$initSet = array();
				$data_tb = array();
				$row_class = array();
				$z=0;
				while ($arr=$recordSet->FetchRow()) {
					array_push($data_tb, $arr);
                                        
                                        
					if ($z%2==0){ 
						$ROW_CLASSNAME="#CCCCCC"; }
					else {
						$ROW_CLASSNAME="#EEEEEE";
					   }
					array_push($row_class, $ROW_CLASSNAME);
					array_push($initSet, $z);
					$z++;
				}

				$count_view = $start+1;
				//$count_all  = $start+$end;
				//$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 
}

}
else
    
{
				
			if($jenis_user=='2'){
          
                                                $sql = "SELECT
                                                        A.r_dept__ket,A.r_pnpt__id_pegawai,A.r_pnpt__no_mutasi,A.r_pnpt__aktif,
                                                        A.r_pnpt__nip,A.r_pnpt__finger_print,A.r_subcab__id,A.r_subcab__nama,A.r_cabang__id,A.r_cabang__nama,
                                                        A.id_pegawai,A.r_pegawai__nama,A.t_abs__id,A.t_abs__tgl,A.t_abs__jam_masuk,A.t_abs__jam_keluar,
                                                        A.t_abs__early,A.t_abs__lately,A.t_abs__approval,A.t_abs__lesstime,
                                                        A.t_abs__overtime,A.t_abs__worktime,A.t_abs__status,A.ketentuan_jam_masuk,A.ketentuan_jam_keluar
                                                      FROM
                                                        (SELECT
                                                          r_departement.r_dept__ket AS r_dept__ket,
                                                          r_penempatan.r_pnpt__id_pegawai AS r_pnpt__id_pegawai,
                                                          r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                                          r_penempatan.r_pnpt__aktif AS  r_pnpt__aktif,
                                                          r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                                          r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
                                                          r_subcabang.r_subcab__id AS r_subcab__id,
                                                          r_subcabang.r_subcab__nama AS r_subcab__nama,
                                                          r_cabang.r_cabang__id AS r_cabang__id,
                                                          r_cabang.r_cabang__nama AS r_cabang__nama,
                                                          r_pegawai.r_pegawai__id AS id_pegawai,
                                                          r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                                                          r_shift.r_shift__jam_masuk AS ketentuan_jam_masuk,
                                                          r_shift.r_shift__jam_pulang AS ketentuan_jam_keluar,
                                                          t_absensi.t_abs__id AS t_abs__id,
                                                          t_absensi.t_abs__tgl AS t_abs__tgl,
                                                          t_absensi.t_abs__jam_masuk AS t_abs__jam_masuk,
                                                          t_absensi.t_abs__jam_keluar AS t_abs__jam_keluar,
                                                          t_absensi.t_abs__early AS t_abs__early,
                                                          t_absensi.t_abs__lately AS t_abs__lately,
                                                          t_absensi.t_abs__approval AS t_abs__approval,
                                                          t_absensi.t_abs__lesstime AS t_abs__lesstime,
                                                          t_absensi.t_abs__overtime AS t_abs__overtime,
                                                          t_absensi.t_abs__worktime AS t_abs__worktime,
                                                          t_absensi.t_abs__status AS t_abs__status
                                                        FROM
                                                          r_penempatan
                                                          INNER JOIN r_pegawai
                                                            ON r_pegawai.r_pegawai__id = r_penempatan.r_pnpt__id_pegawai
                                                          INNER JOIN r_shift
                                                            ON r_shift.r_shift__id = r_penempatan.r_pnpt__shift
                                                          INNER JOIN t_absensi
                                                            ON r_penempatan.r_pnpt__finger_print = t_absensi.t_abs__fingerprint
                                                          INNER JOIN r_subcabang
                                                            ON r_subcabang.r_subcab__id = r_penempatan.r_pnpt__subcab
                                                          INNER JOIN r_cabang
                                                            ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                                          INNER JOIN r_subdepartement
                                                            ON r_subdepartement.r_subdept__id = r_pnpt__subdept
                                                          INNER JOIN r_departement
                                                            ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept) A WHERE  A.r_pnpt__aktif=1 AND  A.t_abs__tgl >='$start' AND A.t_abs__tgl<='$end' AND A.r_cabang__id= '".$kode_pw_ses."'  ";
                                            

			} else {
						$sql  = "SELECT
                                                        A.r_dept__ket,A.r_pnpt__id_pegawai,A.r_pnpt__no_mutasi,A.r_pnpt__aktif,
                                                        A.r_pnpt__nip,A.r_pnpt__finger_print,A.r_subcab__id,A.r_subcab__nama,A.r_cabang__id,A.r_cabang__nama,
                                                        A.id_pegawai,A.r_pegawai__nama,A.t_abs__id,A.t_abs__tgl,A.t_abs__jam_masuk,A.t_abs__jam_keluar,
                                                        A.t_abs__early,A.t_abs__lately,A.t_abs__approval,A.t_abs__lesstime,
                                                        A.t_abs__overtime,A.t_abs__worktime,A.t_abs__status,A.ketentuan_jam_masuk,A.ketentuan_jam_keluar
                                                      FROM
                                                        (SELECT
                                                          r_departement.r_dept__ket AS r_dept__ket,
                                                          r_penempatan.r_pnpt__id_pegawai AS r_pnpt__id_pegawai,
                                                          r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                                            r_penempatan.r_pnpt__aktif AS  r_pnpt__aktif,
                                                          r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                                          r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
                                                          r_subcabang.r_subcab__id AS r_subcab__id,
                                                          r_subcabang.r_subcab__nama AS r_subcab__nama,
                                                          r_cabang.r_cabang__id AS r_cabang__id,
                                                          r_cabang.r_cabang__nama AS r_cabang__nama,
                                                          r_pegawai.r_pegawai__id AS id_pegawai,
                                                          r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                                                          r_shift.r_shift__jam_masuk AS ketentuan_jam_masuk,
                                                          r_shift.r_shift__jam_pulang AS ketentuan_jam_keluar,
                                                          t_absensi.t_abs__id AS t_abs__id,
                                                          t_absensi.t_abs__tgl AS t_abs__tgl,
                                                          t_absensi.t_abs__jam_masuk AS t_abs__jam_masuk,
                                                          t_absensi.t_abs__jam_keluar AS t_abs__jam_keluar,
                                                          t_absensi.t_abs__early AS t_abs__early,
                                                          t_absensi.t_abs__lately AS t_abs__lately,
                                                          t_absensi.t_abs__approval AS t_abs__approval,
                                                          t_absensi.t_abs__lesstime AS t_abs__lesstime,
                                                          t_absensi.t_abs__overtime AS t_abs__overtime,
                                                          t_absensi.t_abs__worktime AS t_abs__worktime,
                                                          t_absensi.t_abs__status AS t_abs__status
                                                        FROM
                                                          r_penempatan
                                                          INNER JOIN r_pegawai
                                                            ON r_pegawai.r_pegawai__id = r_penempatan.r_pnpt__id_pegawai
                                                          INNER JOIN r_shift
                                                            ON r_shift.r_shift__id = r_penempatan.r_pnpt__shift
                                                          INNER JOIN t_absensi
                                                            ON r_penempatan.r_pnpt__finger_print = t_absensi.t_abs__fingerprint
                                                          INNER JOIN r_subcabang
                                                            ON r_subcabang.r_subcab__id = r_penempatan.r_pnpt__subcab
                                                          INNER JOIN r_cabang
                                                            ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                                          INNER JOIN r_subdepartement
                                                            ON r_subdepartement.r_subdept__id = r_pnpt__subdept
                                                          INNER JOIN r_departement
                                                            ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept) A  WHERE A.r_pnpt__aktif=1 AND A.t_abs__tgl >='$start' AND A.t_abs__tgl<='$end' AND A.r_cabang__id= '1'  ";

			}
                                
                                if($kode_perwakilan_cari !=''){
					$sql .= "AND  A.r_cabang__id= '".$kode_perwakilan_cari."'  ";
				}
				if($nama_karyawan_cari !=''){
					$sql .= "AND A.r_pegawai__nama LIKE '%".$nama_karyawan_cari."%' "; 
				}
                                if($idfinger_cari !=''){
					$sql .= "AND A.r_pnpt__finger_print = '".$idfinger_cari."' "; 
                                        
				} 
                                  if($status_cari !=''){
					$sql .= "AND A.t_abs__status = '".$status_cari."' "; 
                                        
				} 
                               
			 	 $sql .= " GROUP BY A.t_abs__tgl,A.id_pegawai order by A.t_abs__tgl asc ";
 
				if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
                //var_dump($sql) or die();
                                $numresults=$db->Execute($sql);
                                $count = $numresults->RecordCount();
				//$pages = $p->findPages($count,$LIMIT); 
				//$sql  .= "LIMIT ".$start.", ".$LIMIT;
				
				$recordSet = $db->Execute($sql);
				$end = $recordSet->RecordCount();
				$initSet = array();
				$data_tb = array();
                           
				$row_class = array();
				$z=0;
				while ($arr=$recordSet->FetchRow()) {
                                    
					array_push($data_tb, $arr);
					if ($z%2==0){ 
						$ROW_CLASSNAME="#CCCCCC"; }
					else {
						$ROW_CLASSNAME="#EEEEEE";
					   }
					array_push($row_class, $ROW_CLASSNAME);
					array_push($initSet, $z);
					$z++;
				}
                                  
                                    
                                 
                                    
                                 
				$count_view = $start+1;
			//	$count_all  = $start+$end;
			//	$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer); 
}
//---------------------------------CLOSE VIEW INDEX---------------------------------------------------------------------//
 
//----------- COMBO CUTI ------------------//
if ($_GET[get_subpenempatan] == 1)
{  
    	$subdep = $_GET[no_subpenempatan];
           
		if($subdep==6)
                    {
                         
                         $input_kec=":<select name='jenis_cuti'>";
                         $input_kec.="<option value='' >Pilih Jenis Cuti</option> ";
                         $input_kec.="<option value='1'>Cuti Tahunan</option> ";
                         $input_kec.="<option value='2'>Cuti Khusus</option> ";
                         $input_kec.="</select> Atasan :<input type='text' name='atasan' value='' size='30'>";
                         $delimeter   = "-";
                         $option_choice = $input_kec."^/&".$delimeter;
                         echo $option_choice;
			}  
                        elseif ($subdep==3){
                         $input_kec=":<select name='jenis_cuti'>";
                         $input_kec.="<option value='1'>Cuti Tahunan</option> ";
                         $input_kec.="</select> Atasan :<input type='text' name='atasan' value='' size='30'>";
                         $delimeter   = "-";
                         $option_choice = $input_kec."^/&".$delimeter;
                         echo $option_choice;
			}
                        else {
                         $input_kec=":<select name='jenis_cuti' >";
                         $input_kec.="<option value='100'>Bukan Cuti</option> ";
                         $input_kec.="</select> ";
                         $delimeter   = "-";
                         $option_choice = $input_kec."^/&".$delimeter;
                         echo $option_choice;   
                        }
}



$smarty->assign ("DATA_TB", $data_tb);
//---------------     LOOPING       -----------------------------------------///
$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_KELURAHAN);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_KELURAHAN);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("TITLE", _TITLE_KEL);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_KEL);

$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _LIST_ME);
$smarty->assign ("RECORD_PER_PAGE", _RECORD_PER_PAGE);
$smarty->assign ("ACTION", _ACTION);
$smarty->assign ("EDIT", _EDIT);
$smarty->assign ("DELETE", _DELETE);
$smarty->assign ("SORT_IN", _SORT_IN);
$smarty->assign ("SORT_ORDER", _SORT_ORDER);
$smarty->assign ("SHOWING", _SHOWING);
$smarty->assign ("OF", _OF);
$smarty->assign ("RECORDS", _RECORDS);
$smarty->assign ("LIST", _LIST_KEL);
$smarty->assign ("BTN_NEW", _BTN_NEW);

$smarty->assign ("INITSET", $initSet);
$smarty->assign ("PATH", $PATH);
$smarty->assign ("LIMIT", $LIMIT);
$smarty->assign ("SORT", $SORT);
$smarty->assign ("ORDER", $ORDER);
$smarty->assign ("page", $page);
$smarty->assign ("LISTVAL", $arrayName);
$smarty->assign ("SELECTED", $selected);
$smarty->assign ("ROW_CLASSNAME", $row_class);
$smarty->assign ("STR_COMPLETER", $str_completer);
$smarty->assign ("STR_COMPLETER_", $str_completer_);
$smarty->assign ("COUNT_VIEW", $count_view);
$smarty->assign ("COUNT_ALL", $count_all);
$smarty->assign ("COUNT", $count);
$smarty->assign ("NEXT_PREV", $next_prev);
// $smarty->assign ("DATA_TB",$data_tb);

$config['date'] = '%I:%M %p';
$config['time'] = '%H:%M:%S';
$smarty->assign('config', $config);
$smarty->assign ("DATA_TB_TGL_MASUK", $tgl_masuk);

# Finally Grab All Parsed variables, parse it into the template, and generate ouput
# Clear Cache First
$smarty->clear_cache ($TPL_PATH.'/'.$DOC_SELF_NAME_ONLY.'.tpl');
# Parsing the proper theme template & Generate Output
$smarty->display ($TPL_PATH.'/'.$DOC_SELF_NAME_ONLY.'.tpl');
//require_once($DIR_THEME.'/'.base64_decode($_SESSION['THEME']).$DOC_SELF_PATH.$DOC_SELF_NAME_ONLY.'.tpl');
//=================================== END PARSING TEMPLATE BLOCK====================================
# Store all the JavaScript  for this pages into /javascripts/file_name  and include it here (bottom page)
require_once($FILE_JS.'/'.$DOC_SELF_NAME_ONLY.'.js');

# AdoDb closed here
$db->Close();
}
?>
