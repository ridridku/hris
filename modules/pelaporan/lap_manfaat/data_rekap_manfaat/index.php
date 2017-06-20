<?php

# Including Main Configuration
# including file for Main Configurations
require_once('../../../../includes/config.conf.php');

# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
	require_once('../../../../includes/header.redirect.inc');
}else{

//yang harus dibuat session
$THEME = base64_encode("defaults");
$LANG = base64_encode("indonesia");
$_SESSION['THEME']	= $THEME;
$_SESSION['LANG']   = $LANG;

#FOR IMAGES CLASS PAGER
$HREF_IMAGES = $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images');

# including Header file for Content Expiring
require_once($DIR_INC.'/header.exp.inc');
# including Header file for Database Configuration
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');
//require_once($DIR_HOME.'../../../../laporan/inc.kasus_wni.php'); 
require_once($DIR_HOME.'../laporan/inc.rekap_pinjaman.php');  

$p = new Pager; 
$db = &ADONewConnection($DB_TYPE);
// $db->debug = true;
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

#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/pelaporan/lap_manfaat/data_rekap_manfaat';
 
#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/pelaporan/lap_manfaat');
$FILE_JS  = $JS_MODUL.'/data_rekap_manfaat';

if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}

$user_id = base64_decode($_SESSION['UID']);

$smarty->assign ("MOD_ID", $mod_id);

$smarty->assign ("ID_PROPINSI",$MAIN_PROP);

#Initiate TABLE
 
//-----------------------------------END OF LOCAL CONFIG-------------------------------//

if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

if ($_POST['SORT']) { $SORT = $_POST['SORT']; }
else if ($_GET['SORT']) { $SORT = $_GET['SORT']; }
else $SORT="ASC";

if ($_GET['ORDER']) { $ORDER = $_GET['ORDER']; }
else if ($_POST['ORDER']) { $ORDER = $_POST['ORDER']; }
else $ORDER="a.id_fjl_01_detail";

if ($_GET['page']) $page = $_GET['page'];
else if ($_POST['page']) $page = $_POST['page'];
else $page="1";

if ($_GET['kode_cabang_cari']) $kode_cabang_cari = $_GET['kode_cabang_cari'];
else if ($_POST['kode_cabang_cari']) $kode_cabang_cari = $_POST['kode_cabang_cari'];
else $kode_cabang_cari="";


if ($_GET['kode_subcab_cari']) $kode_subcab_cari = $_GET['kode_subcab_cari'];
else if ($_POST['kode_subcab_cari']) $kode_subcab_cari = $_POST['kode_subcab_cari'];
else $kode_subcab_cari="";



if ($_GET['departemen_cari']) $departemen_cari = $_GET['departemen_cari'];
else if ($_POST['departemen_cari']) $departemen_cari = $_POST['departemen_cari'];
else $departemen_cari="";
$smarty->assign ("DEPARTEMEN_CARI", $departemen_cari);


if ($_GET['bulan1']) $bulan1 = $_GET['bulan1'];
else if ($_POST['bulan1']) $bulan1 = $_POST['bulan1'];
else $bulan1="";

if ($_GET['bulan2']) $bulan2 = $_GET['bulan2'];
else if ($_POST['bulan2']) $bulan2 = $_POST['bulan2'];
else $bulan2="";

if ($_GET['tahun1']) $tahun1 = $_GET['tahun1'];
else if ($_POST['tahun1']) $tahun1 = $_POST['tahun1'];
else $tahun1="";

if ($_GET['tahun2']) $tahun2 = $_GET['tahun2'];
else if ($_POST['tahun2']) $tahun2 = $_POST['tahun1'];
else $tahun2="";

if ($_GET['tgl1']) $tgl1 = $_GET['tgl1'];
else if ($_POST['tgl1']) $tgl1 = $_POST['tgl1'];
else $tgl1="";

if ($_GET['tgl2']) $tgl2= $_GET['tgl2'];
else if ($_POST['tgl2']) $tgl2 = $_POST['tgl2'];
else $tgl2="";



if ($_GET['nama_karyawan_cari']) $nama_karyawan_cari = $_GET['nama_karyawan_cari'];
else if ($_POST['nama_karyawan_cari']) $nama_karyawan_cari = $_POST['nama_karyawan_cari'];
else $nama_karyawan_cari="";


if ($_GET['search']) $search = $_GET['search'];
else if ($_POST['search']) $search = $_POST['search'];
else $search="";


if ($_GET['sts_pjm']) $sts_pjm_cari= $_GET['sts_pjm'];
else if ($_POST['sts_pjm']) $sts_pjm_cari = $_POST['sts_pjm'];
else $sts_pjm_cari="";


$arr = array($tahun1,$bulan1,$tgl1);                                 
$date_awal= implode("-",$arr); 

$arr = array($tahun2,$bulan2,$tgl2);                                 
$date_akhir= implode("-",$arr); 



$periode_awal	= $_SESSION['SESSION_AWAL_AKTIF'];$smarty->assign ("PERIODE_AWAL", $periode_awal);
$periode_akhir	= $_SESSION['SESSION_AKHIR_AKTIF'];$smarty->assign ("PERIODE_AKHIR", $periode_akhir);


$orderdate1 = explode('-',$periode_awal);
$year1  = $orderdate1[0];$smarty->assign ("YEAR1", $year1);
$month1 = $orderdate1[1];$smarty->assign ("MONTH1", $month1);
$day1   = $orderdate1[2];$smarty->assign ("DAY1", $day1);


$orderdate2 = explode('-',$periode_akhir);
$year2  = $orderdate2[0];$smarty->assign ("YEAR2", $year2);
$month2 = $orderdate2[1];$smarty->assign ("MONTH2", $month2);
$day2   = $orderdate2[2];$smarty->assign ("DAY2", $day2);


$smarty->assign ("KODE_CABANG_CARI", $kode_cabang_cari);
$tahun_ses		=	$_SESSION['SESSION_TAHUN'];
$smarty->assign ("TAHUN_SES", $tahun_ses);

//$fields_find_jns_jln_	= $jns_jln!=""?$jns_jln:$jns_jln2;

$Search_Year = $_GET[tahun];
$smarty->assign ("SEARCH", $search);

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&search=1&Search_Year=".$Search_Year."&kode_cabang_cari=".$kode_cabang_cari."&nama_karyawan_cari=".$nama_karyawan_cari."&kode_subcab_cari=".$kode_subcab_cari;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&search=1&Search_Year=".$Search_Year;

$SES_TAHUN		= $_SESSION['TAHUN'];
$SES_INSTANSI		= $_SESSION['KODE_INSTANSI'];
$SES_JENIS_USER		= $_SESSION['JENIS_USER'];
//var_dump($str_completer)or die();

$jenis_user     = $_SESSION['SESSION_JNS_USER'];
$kode_pw_ses    = $_SESSION['SESSION_KODE_CABANG'];
$tahun_session	= $_SESSION['SESSION_TAHUN'];
$bulan_session	= $_SESSION['SESSION_BULAN'];  

$smarty->assign ("JENIS_USER_SES", $jenis_user);
$smarty->assign ("KODE_PW_SES", $kode_pw_ses);

$smarty->assign ("TAHUN_SES", $tahun_session);
$smarty->assign ("BULAN_SES", $bulan_session);

//-----------DATA STATUS PEGAWAI-----------------------//
$sql_sts = "SELECT * FROM r_status_pegawai";
$result_sts = $db->Execute($sql_sts);
$initSet = array();
$data_sts = array();
$z=0;
while ($arr=$result_sts->FetchRow()) {
	array_push($data_sts, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_STS", $data_sts);
//-----------DATA STATUS PEGAWAI-----------------------//



//--------------------------------------
//SHOW DATA INSTANSI
//---------------------------------------

$smarty->assign ("SES_TAHUN", $SES_TAHUN);
$smarty->assign ("SES_INSTANSI", $SES_INSTANSI);
$smarty->assign ("SES_JENIS_USER", $SES_JENIS_USER);

$smarty->assign ("BULAN", $bulan);
$smarty->assign ("TAHUN", $tahun);
$smarty->assign ("KODE_KAT_KASUS", $kode_kat_kasus);
 //--------------------------------------
 


//-----------------DATA SUBCABANG--------------------------------------------------------//

    $sql_subcab = "SELECT cab.r_cabang__id,cab.r_cabang__nama,subcab.r_subcab__nama,subcab.r_subcab__id FROM r_cabang cab,r_subcabang subcab
        where cab.r_cabang__id=subcab.r_subcab__cabang and cab.r_cabang__id='$kode_pw_ses'  order by subcab.r_subcab__id " ;
    //var_dump($sql_subcab) or die();
    $result_subcab = $db->Execute($sql_subcab);
        $initSet = array();
        $data_subcab = array();
        $z=0;
        while ($arr=$result_subcab->FetchRow()) {
                array_push($data_subcab, $arr);
                array_push($initSet, $z);
                $z++;
                        }
    
    
$smarty->assign ("DATA_SUBCABANG", $data_subcab);
//-----------------CLOSE DATA SUBCABANG-------------------------------------------------------//

//-----------------------DATA AJAX SUBCAB-----------------------------------------------------//

if ($_GET[get_subcab] == 1)
{  
    
	$subcabang = $_GET[no_subcab];   
       
       

			if($subcabang!=''){
					$sql_kabupaten = "SELECT cab.r_cabang__id ,cab.r_cabang__nama,subcab.r_subcab__nama,subcab.r_subcab__id as subcab FROM r_cabang cab,r_subcabang subcab
                                                          where cab.r_cabang__id=subcab.r_subcab__cabang AND cab.r_cabang__id='$subcabang' ORDER BY cab.r_cabang__nama ASC";
                                        //var_dump($sql_kabupaten)or die();
                                        $recordSet_kabupaten = $db->Execute($sql_kabupaten);
					
					$input_kab="<select name=kode_subcab_cari >";
					$input_kab.="<option value=''> ";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF):
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields[subcab].">".$recordSet_kabupaten->fields['r_subcab__nama'];
						$input_kab.="</option>";
					$recordSet_kabupaten->MoveNext();
					endwhile;
					$input_kab.="</select> ";
					//
					$delimeter   = "-";
                                      
					$option_choice = $input_kab."^/&".$delimeter;
					echo $option_choice;
                                        
                                        
			}
}
//-------------------------------------------closer ajax subcabang id-------------------------------------------------------------//


//-----------SHOW DATA CABANG--------------------------//

$sql_cabang = "SELECT * FROM r_cabang";
$result_cabang = $db->Execute($sql_cabang);
$initSet = array();
$data_cabang = array();
$z=0;
while ($arr=$result_cabang->FetchRow()) {
	array_push($data_cabang, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_CABANG", $data_cabang);
//---------------CLOSE DATA CABANG-------------------------//

//-----------SHOW DATA DEPARTEMEN-----//
$sql_departemen = "SELECT * FROM r_departement";
$result_departemen = $db->Execute($sql_departemen);
$initSet = array();
$data_departemen = array();
$z=0;
while ($arr=$result_departemen->FetchRow()) {
	array_push($data_departemen, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_DEPARTEMEN", $data_departemen);
//-----------CLOSE DATA DEPARTEMEN----//



//-----------------BLN PERIODE AKTIF--------------------------------------------------------//
$sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_bulan,r_periode__payroll_tahun,r_periode__payroll_status
                                  FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
                  
        $rs_val = $db->Execute($sql_cek_periode);
        $periode_bulan= $rs_val->fields['r_periode__payroll_bulan'];
        $periode_tahun= $rs_val->fields['r_periode__payroll_tahun'];

        $smarty->assign ("PERIODE_BULAN",  $periode_bulan);
        $smarty->assign ("PERIODE_TAHUN",  $periode_tahun);


    
//-----------------DATA SUBCABANG--------------------------------------------------------//
    
    $sql_subcab = "SELECT cab.r_cabang__id,cab.r_cabang__nama,subcab.r_subcab__nama,subcab.r_subcab__id FROM r_cabang cab,r_subcabang subcab
        where cab.r_cabang__id=subcab.r_subcab__cabang and cab.r_cabang__id='$kode_pw_ses'  order by subcab.r_subcab__id " ;
    
    $result_subcab = $db->Execute($sql_subcab);
        $initSet = array();
        $data_subcab = array();
        $z=0;
        while ($arr=$result_subcab->FetchRow()) {
                array_push($data_subcab, $arr);
                array_push($initSet, $z);
                $z++;
                        }
$smarty->assign ("DATA_SUBCABANG", $data_subcab);
//-----------------CLOSE DATA SUBCABANG-------------------------//       


if ($_GET['search'] == '1')
{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{
	$sql__="SELECT *,UPPER(r_cabang__nama) AS nm_perwakilan FROM r_cabang WHERE  r_cabang.r_cabang__id='$kode_cabang_cari' ";
     
        $rs__=$db->Execute($sql__);
        $nm_perwakilan = $rs__->fields['nm_perwakilan'];
        $smarty->assign ("NM_PERWAKILAN", $nm_perwakilan);	
  
              if($jenis_user=='2'){
				           $sql  = "SELECT * FROM (SELECT t_angsuran_pinjaman.*, 
                                                    C.* FROM (SELECT IF((SELECT COUNT(t_ang__idkaryawan) as jml FROM t_angsuran_pinjaman
                                                    where B.t_pjm__no_pinjaman=t_angsuran_pinjaman.t_ang__nopjm 
                                                    AND  B.t_pjm__idpeg=t_angsuran_pinjaman.t_ang__idkaryawan
                                                    GROUP BY t_angsuran_pinjaman.t_ang__idkaryawan)IS NULL,'0',(SELECT COUNT(t_ang__idkaryawan) as jml FROM t_angsuran_pinjaman
                                                    where B.t_pjm__no_pinjaman=t_angsuran_pinjaman.t_ang__nopjm 
                                                    AND  B.t_pjm__idpeg=t_angsuran_pinjaman.t_ang__idkaryawan
                                                    GROUP BY t_angsuran_pinjaman.t_ang__idkaryawan)) AS jml_tenor_bayar,IF((B.t_pjm__total_pinjam-B.angsuran_pjm)=0,'1',(2)) AS sisa_status,IF((SELECT SUM(t_ang__nilai_angsuran) as jml FROM t_angsuran_pinjaman where B.t_pjm__no_pinjaman=t_angsuran_pinjaman.t_ang__nopjm AND  B.t_pjm__idpeg=t_angsuran_pinjaman.t_ang__idkaryawan
                                                    GROUP BY t_angsuran_pinjaman.t_ang__idkaryawan)IS NULL,'0',(SELECT SUM(t_ang__nilai_angsuran) as jml FROM t_angsuran_pinjaman where B.t_pjm__no_pinjaman=t_angsuran_pinjaman.t_ang__nopjm 
                                                    AND  B.t_pjm__idpeg=t_angsuran_pinjaman.t_ang__idkaryawan GROUP BY t_angsuran_pinjaman.t_ang__idkaryawan)) AS jml_sudah_bayar,B.t_pjm__total_pinjam-B.angsuran_pjm as sisa_pembayaran,B.* FROM (SELECT A.*,IF ((SELECT t_ang__nilai_angsuran FROM t_angsuran_pinjaman where t_angsuran_pinjaman.t_ang__idkaryawan=A.t_pjm__idpeg
                                                    and A.t_pjm__no_pinjaman=t_ang__nopjm GROUP BY t_ang__nopjm) is null,'0',(SELECT sum(t_ang__nilai_angsuran)FROM t_angsuran_pinjaman WHERE t_angsuran_pinjaman.t_ang__idkaryawan = A.t_pjm__idpeg AND A.t_pjm__no_pinjaman = t_ang__nopjm GROUP BY t_ang__nopjm)) AS angsuran_pjm 
                                                    FROM (SELECT peg.*,t_pinjaman.* FROM v_pegawai peg INNER JOIN t_pinjaman  ON peg.r_pnpt__no_mutasi = t_pinjaman.t_pjm__mutasi)A)B)C
                                                    INNER JOIN t_angsuran_pinjaman ON  t_angsuran_pinjaman.t_ang__nopjm=C.t_pjm__no_pinjaman GROUP BY t_angsuran_pinjaman.t_ang__nopjm
                                                    )D  WHERE D.r_cabang__id= '".$kode_pw_ses."' ";
			} else {
					   $sql  = "SELECT * FROM (SELECT t_angsuran_pinjaman.*, 
                                                    C.* FROM (SELECT IF((SELECT COUNT(t_ang__idkaryawan) as jml FROM t_angsuran_pinjaman
                                                    where B.t_pjm__no_pinjaman=t_angsuran_pinjaman.t_ang__nopjm 
                                                    AND  B.t_pjm__idpeg=t_angsuran_pinjaman.t_ang__idkaryawan
                                                    GROUP BY t_angsuran_pinjaman.t_ang__idkaryawan)IS NULL,'0',(SELECT COUNT(t_ang__idkaryawan) as jml FROM t_angsuran_pinjaman
                                                    where B.t_pjm__no_pinjaman=t_angsuran_pinjaman.t_ang__nopjm 
                                                    AND  B.t_pjm__idpeg=t_angsuran_pinjaman.t_ang__idkaryawan
                                                    GROUP BY t_angsuran_pinjaman.t_ang__idkaryawan)) AS jml_tenor_bayar,IF((B.t_pjm__total_pinjam-B.angsuran_pjm)=0,'1',(2)) AS sisa_status,IF((SELECT SUM(t_ang__nilai_angsuran) as jml FROM t_angsuran_pinjaman where B.t_pjm__no_pinjaman=t_angsuran_pinjaman.t_ang__nopjm AND  B.t_pjm__idpeg=t_angsuran_pinjaman.t_ang__idkaryawan
                                                    GROUP BY t_angsuran_pinjaman.t_ang__idkaryawan)IS NULL,'0',(SELECT SUM(t_ang__nilai_angsuran) as jml FROM t_angsuran_pinjaman where B.t_pjm__no_pinjaman=t_angsuran_pinjaman.t_ang__nopjm 
                                                    AND  B.t_pjm__idpeg=t_angsuran_pinjaman.t_ang__idkaryawan GROUP BY t_angsuran_pinjaman.t_ang__idkaryawan)) AS jml_sudah_bayar,B.t_pjm__total_pinjam-B.angsuran_pjm as sisa_pembayaran,B.* FROM (SELECT A.*,IF ((SELECT t_ang__nilai_angsuran FROM t_angsuran_pinjaman where t_angsuran_pinjaman.t_ang__idkaryawan=A.t_pjm__idpeg
                                                    and A.t_pjm__no_pinjaman=t_ang__nopjm GROUP BY t_ang__nopjm) is null,'0',(SELECT sum(t_ang__nilai_angsuran)FROM t_angsuran_pinjaman WHERE t_angsuran_pinjaman.t_ang__idkaryawan = A.t_pjm__idpeg AND A.t_pjm__no_pinjaman = t_ang__nopjm GROUP BY t_ang__nopjm)) AS angsuran_pjm 
                                                    FROM (SELECT peg.*,t_pinjaman.* FROM v_pegawai peg INNER JOIN t_pinjaman  ON peg.r_pnpt__no_mutasi = t_pinjaman.t_pjm__mutasi)A)B)C
                                                    INNER JOIN t_angsuran_pinjaman ON  t_angsuran_pinjaman.t_ang__nopjm=C.t_pjm__no_pinjaman GROUP BY t_angsuran_pinjaman.t_ang__nopjm
                                                    )D  WHERE 1=1 ";	

			}
                        
                                                IF ($kode_cabang_cari !='') {
                                                             $sql.=" and  D.r_cabang__id =".$kode_cabang_cari."  ";
                                                      }

						 IF ($kode_subcab_cari !='') {
						 	$sql.=" and  D.r_subcab__id ='$kode_subcab_cari' ";
						 }

						IF ($departemen_cari !=''  ) {
						 	$sql.="  and D.r_dept__id='$departemen_cari' ";
						 } 
                                                
						if ($tahun1 !='' AND $tahun2 !='' ) {
						 	$sql.="  AND  D.t_ang__awal>='$date_awal' AND D.t_ang__akhir<='$date_akhir'  ";
						 }
                                                 
                                                
						IF ($nama_karyawan_cari !='') {
						 	$sql.="and D.r_pegawai__nama LIKE '%".$nama_karyawan_cari."%'  ";
						 }
                                                 
                                                IF ($sts_pjm_cari !='') {
						 	$sql.="and D.sisa_status = ".$sts_pjm_cari."  ";
						 }
						    $sql.=" GROUP BY D.t_pjm__no_pinjaman order by D.r_pegawai__nama asc ";
                                                  
							$numresults=$db->Execute($sql);
							$count = $numresults->RecordCount();
							$recordSet = $db->Execute($sql);
							$end = $recordSet->RecordCount();
							$initSet = array();
							$data_tb = array();
							$row_class = array();
							$z=0;
                                                         $count_no = 1;
							while ($arr=$recordSet->FetchRow()) {
								array_push($data_tb, $arr);
								
						
                                                        $label="Nama :". $arr[r_pegawai__nama]; 					
                                                        $status_pjm= $arr[sisa_status];
                                                        IF($status_pjm=='1')
                                                        {
                                                         $label_sts='Lunas';   
                                                        }  else {
                                                         $label_sts='Belum Lunas';   
                                                        }
                                                        
                                                        
                                                        $jenis_pjm= $arr[t_pjm__jenis];
                                                        IF($jenis_pjm=='1')
                                                        {
                                                         $label_jenis_pjm='COP';   
                                                        }  else {
                                                         $label_jenis_pjm='PRIBADI';   
                                                        }
                                                        
                                                   


                                                               $labeltgl=$arr[tanggal_tl]." ".$nama_bulan." ".$arr[tahun_tl];

                                                $content_data .= print_content(
                                                        $count_no,
                                                        $arr[t_pjm__no_pinjaman],
                                                        $arr[r_pnpt__nip],
                                                        $arr[r_pegawai__nama],
                                                        $arr[r_cabang__nama],
                                                        $arr[r_dept__ket],
                                                        $arr[r_jabatan__ket],
                                                        $label_jenis_pjm,
                                                        number_format($arr[t_pjm__total_pinjam],2,',','.'),//total pinjam
                                                       $arr[jml_sudah_bayar],//pembayaran
                                                        $arr[t_pjm__tenor],//tenor
                                                        number_format($arr[t_pjm__cicilan_perbulan],2,',','.'),//total bayar
                                                        $arr[sisa_pembayaran], //sisa bayar
                                                        $arr[jml_tenor_bayar],
                                                        $label_sts);	

                                                        if ($z%2==0){ 
                                                        $ROW_CLASSNAME="#CCCCCC"; }
                                                        else {
                                                        $ROW_CLASSNAME="#EEEEEE";
                                                        }
                                                            array_push($row_class, $ROW_CLASSNAME);
                                                            array_push($initSet, $z);
                                                            $z++;	
                                                            $count_no=$count_no+1;  
                                                        } 
                                                                   
                                                        $count_view = $start+1;
                                                              
                                                $smarty->assign ("DATA_TB", $data_tb);
                            
                            
                            
                            
                            //total karyawan
                                                 $sql_total="SELECT 
                                                        count(D.t_pjm__no_pinjaman) as total_no_pjm,
                                                        sum(D.t_pjm__total_pinjam) as total_pjm,
                                                        sum(D.jml_sudah_bayar)  as total_pembayaran,
                                                        sum(D.sisa_pembayaran)  as total_sisa,
                                                        D.* FROM (SELECT t_angsuran_pinjaman.*, 
                                                        C.* FROM (SELECT IF((SELECT COUNT(t_ang__idkaryawan) as jml FROM t_angsuran_pinjaman
                                                        where B.t_pjm__no_pinjaman=t_angsuran_pinjaman.t_ang__nopjm 
                                                        AND  B.t_pjm__idpeg=t_angsuran_pinjaman.t_ang__idkaryawan
                                                        GROUP BY t_angsuran_pinjaman.t_ang__idkaryawan)IS NULL,'0',(SELECT COUNT(t_ang__idkaryawan) as jml FROM t_angsuran_pinjaman
                                                        where B.t_pjm__no_pinjaman=t_angsuran_pinjaman.t_ang__nopjm 
                                                        AND  B.t_pjm__idpeg=t_angsuran_pinjaman.t_ang__idkaryawan
                                                        GROUP BY t_angsuran_pinjaman.t_ang__idkaryawan)) AS jml_tenor_bayar,IF((B.t_pjm__total_pinjam-B.angsuran_pjm)=0,'1',(2)) AS sisa_status,IF((SELECT SUM(t_ang__nilai_angsuran) as jml FROM t_angsuran_pinjaman where B.t_pjm__no_pinjaman=t_angsuran_pinjaman.t_ang__nopjm AND  B.t_pjm__idpeg=t_angsuran_pinjaman.t_ang__idkaryawan
                                                        GROUP BY t_angsuran_pinjaman.t_ang__idkaryawan)IS NULL,'0',(SELECT SUM(t_ang__nilai_angsuran) as jml FROM t_angsuran_pinjaman where B.t_pjm__no_pinjaman=t_angsuran_pinjaman.t_ang__nopjm 
                                                        AND  B.t_pjm__idpeg=t_angsuran_pinjaman.t_ang__idkaryawan GROUP BY t_angsuran_pinjaman.t_ang__idkaryawan)) AS jml_sudah_bayar,B.t_pjm__total_pinjam-B.angsuran_pjm as sisa_pembayaran,B.* FROM (SELECT A.*,IF ((SELECT t_ang__nilai_angsuran FROM t_angsuran_pinjaman where t_angsuran_pinjaman.t_ang__idkaryawan=A.t_pjm__idpeg
                                                        and A.t_pjm__no_pinjaman=t_ang__nopjm GROUP BY t_ang__nopjm) is null,'0',(SELECT sum(t_ang__nilai_angsuran)FROM t_angsuran_pinjaman WHERE t_angsuran_pinjaman.t_ang__idkaryawan = A.t_pjm__idpeg AND A.t_pjm__no_pinjaman = t_ang__nopjm GROUP BY t_ang__nopjm)) AS angsuran_pjm 
                                                        FROM (SELECT peg.*,t_pinjaman.* FROM v_pegawai peg INNER JOIN t_pinjaman  ON peg.r_pnpt__no_mutasi = t_pinjaman.t_pjm__mutasi)A)B)C
                                                        INNER JOIN t_angsuran_pinjaman ON  t_angsuran_pinjaman.t_ang__nopjm=C.t_pjm__no_pinjaman GROUP BY t_angsuran_pinjaman.t_ang__nopjm
                                                        )D
                                                        WHERE D.r_pnpt__aktif=1 ";
                            
                                                if ($kode_cabang_cari !='') {
                                                            $sql_total.=" and  D.r_cabang__id =".$kode_cabang_cari."  ";
                                                    }

                                                if ($kode_subcab_cari !='') {
                                                           $sql_total.=" and  D.r_subcab__id ='$kode_subcab_cari' ";
                                                    }
                                                    
                                                    if ($tahun1 !='' AND $tahun2 !='' ) {
						 	$sql_total.="  AND  D.t_ang__awal>='$date_awal' AND D.t_ang__akhir<='$date_akhir'  ";
						 }

                                                if ($departemen_cari !=''  ) {
                                                           $sql_total.="  and D.r_dept__id='$departemen_cari' ";
                                                    }
                                                if ($nama_karyawan_cari !='') {
                                                            $sql_total.="and D.r_pegawai__nama LIKE '%".$nama_karyawan_cari."%'  ";
						 }
                                                  if ($sts_pjm_cari !='') {
                                                            $sql_total.="and D.sisa_status = '".$sts_pjm_cari."'  ";
						 }
                              
                                                 
                                                 
        
                                $numresults4=$db->Execute($sql_total);
				$count4 = $numresults4->RecordCount();
 				$recordSet4 = $db->Execute($sql_total);
				$end4 = $recordSet4->RecordCount();
				$initSet4 = array();
				$data_tb4 = array();
				$row_class4 = array();
				$z=0;
				while ($arr4=$recordSet4->FetchRow()) {
					array_push($data_tb4, $arr4);
					if ($z%2==0){
						$ROW_CLASSNAME="#CCCCCC"; }
					else {
						$ROW_CLASSNAME="#EEEEEE";
					   }
                                array_push($row_class4, $ROW_CLASSNAME2);
				array_push($initSet4, $z);
					$z++;

					$total_sisa=$arr4[total_sisa];
                                        $total_pinjam=$arr4[total_pjm];
                                        $total_pembayaran=$arr4[total_pembayaran];
                                        
					$content_data .= print_content("","","","","","","","","$total_pinjam","$total_pembayaran","","",$total_sisa,"","");
				}

                                $smarty->assign ("DATA_TB4", $data_tb4);          
                               //TUTUP TOTAL 
				$file= $DIR_HOME."/files/rekappjm_".$nm_perwakilan."_".$tahun.".xls";
				$fp=@fopen($file,"w");
				if(!is_resource($fp))
				return false;
				//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
				stream_set_write_buffer($fp, 0);
				
				$content = print_header($nm_perwakilan,$tahun);
				$content .= $content_data;
				$content .= print_footer();
				fwrite($fp,$content);
				fclose($fp);
				$file_2= $HREF_HOME."/files/rekappjm_".$nm_perwakilan."_".$tahun.".xls";	

               

        }
}
//else 
//{
//    
//    $sql__="SELECT *,UPPER(r_cabang__nama) AS nm_perwakilan FROM r_cabang WHERE  r_cabang.r_cabang__id='$kode_cabang_cari' ";
//     
//        $rs__=$db->Execute($sql__);
//        $nm_perwakilan = $rs__->fields['nm_perwakilan'];
//        $smarty->assign ("NM_PERWAKILAN", $nm_perwakilan);
//	
//        if($jenis_user=='2')    {
//					$sql = "SELECT * from v_pegawai peg WHERE 1 = 1  AND peg.r_cabang__id='$kode_pw_ses'";
//                		}
//                
//                else
//                {
//                    
//                    $sql  =  "SELECT * FROM v_pegawai peg where 1=1 ";
//                }
//                
//                
//						 if ($kode_cabang_cari !='') {
//						 	$sql.="and  peg.r_cabang__id =".$kode_cabang_cari."  ";
//						 }
//
//						 if ($kode_subcab_cari !='') {
//						 	$sql.=" and  peg.r_subcab__id ='$kode_subcab_cari' ";
//						 }
//
//						if ($departemen_cari !=''  ) {
//						 	$sql.="  and peg.r_dept__id='$departemen_cari' ";
//						 } 
//
//						  if ($nama_karyawan_cari !='') {
//						 	$sql.="and peg.r_pegawai__nama LIKE '%".$nama_karyawan_cari."%'  ";
//						 }
//
// 
//						    $sql.=" order by peg.r_pegawai__nama asc ";
//                                                 
//							$numresults=$db->Execute($sql);
//							$count = $numresults->RecordCount();
//							$recordSet = $db->Execute($sql);
//							$end = $recordSet->RecordCount();
//							$initSet = array();
//							$data_tb = array();
//							$row_class = array();
//							$z=0;
//                                                         $count_no = 1;
//							while ($arr=$recordSet->FetchRow()) {
//								array_push($data_tb, $arr);
//								
//						
//                    $label="Nama :". $arr[r_pegawai__nama];
//                    $labeltgl=$arr[tanggal_tl]." ".$nama_bulan." ".$arr[tahun_tl];
//					
//			   $content_data .= print_content(
//                                   $count_no,
//                                   $arr[r_pnpt__nip],
//                                   $arr[r_pnpt__finger_print],
//                                   $arr[r_pegawai__nama],
//                                   $arr[r_cabang__nama],
//                                   $arr[r_subcab__nama],
//                                   $arr[r_dept__ket],
//                                   $arr[r_jabatan__ket],
//                                   $arr[r_level__ket],
//                                   $arr[r_stp__nama],
//                                   $arr[r_pnpt__kon_awal],
//                                   $arr[r_pnpt__kon_akhir]);	
//							
//								if ($z%2==0){ 
//									$ROW_CLASSNAME="#CCCCCC"; }
//								else {
//									$ROW_CLASSNAME="#EEEEEE";
//								   }
//								array_push($row_class, $ROW_CLASSNAME);
//								array_push($initSet, $z);
//								$z++;	
//                                                               $count_no=$count_no+1;  
//                                                                } 
//                                                                   
//                                                                    $count_view = $start+1;
//                                                              
//			    $smarty->assign ("DATA_TB", $data_tb);
//                            
//                            
//                            
//                            
//                            //total karyawan
//                          $sql_total="SELECT COUNT(*) as total_orang FROM v_pegawai where 1=1 ";
//                             if ($kode_cabang_cari !='') {
//                                       $sql_total.=" and  r_cabang__id =".$kode_cabang_cari."  ";
//                                }
//
//                                if ($kode_subcab_cari !='') {
//                                       $sql_total.=" and  r_subcab__id ='$kode_subcab_cari' ";
//                                }
//
//                               if ($departemen_cari !=''  ) {
//                                       $sql_total.="  and r_dept__id='$departemen_cari' ";
//                                } 
//                               if ($nama_karyawan_cari !='') {
//                                        $sql_total.="and r_pegawai__nama LIKE '%".$nama_karyawan_cari."%'  ";
//						 }
//
//
//                                //      var_dump($sql_total)or die();
//                                $numresults4=$db->Execute($sql_total);
//				$count4 = $numresults4->RecordCount();
// 				$recordSet4 = $db->Execute($sql_total);
//				$end4 = $recordSet4->RecordCount();
//				$initSet4 = array();
//				$data_tb4 = array();
//				$row_class4 = array();
//				$z=0;
//				while ($arr4=$recordSet4->FetchRow()) {
//					array_push($data_tb4, $arr4);
//					if ($z%2==0){
//						$ROW_CLASSNAME="#CCCCCC"; }
//					else {
//						$ROW_CLASSNAME="#EEEEEE";
//					   }
//                                array_push($row_class4, $ROW_CLASSNAME2);
//				array_push($initSet4, $z);
//					$z++;
//
//					$label="JML KARYAWAN : ".$arr4[total_orang];
//					$content_data .= print_content("","","","","","","","","","","",$label);
//				}
//
//                                $smarty->assign ("DATA_TB4", $data_tb4);          
//                               //TUTUP TOTAL 
//				$file= $DIR_HOME."/files/laporan_pegawai_".$nm_perwakilan."_".$tahun.".xls";
//				$fp=@fopen($file,"w");
//				if(!is_resource($fp))
//				return false;
//				//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
//				stream_set_write_buffer($fp, 0);
//				
//				$content = print_header($nm_perwakilan,$tahun);
//				$content .= $content_data;
//				$content .= print_footer();
//				fwrite($fp,$content);
//				fclose($fp);
//				$file_2= $HREF_HOME."/files/laporan_pegawai_".$nm_perwakilan."_".$tahun.".xls";	
//
//               
//
//        }

        
        
        
        
        
        
                                        



($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;
$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("SEARCH_YEAR", $Search_Year);
$smarty->assign ("NO_URUT", $count_no); 
$smarty->assign ("FILES", $file_2);
$smarty->assign ("TITLE", _PRINT_TITLE_JL_01_MAIN);
$smarty->assign ("HEAD_TITLE", _PRINT_HEAD_TITLE_JL_01_MAIN);
$smarty->assign ("TB_PROPINSI", _NAMA_PROP);
$smarty->assign ("TB_KABUPATEN", _NAMA_KABUPATEN);
$smarty->assign ("TB_NO", _NO_URUT);
$smarty->assign ("TB_NO_KABUPATEN", _NO_KABUPATEN);
$smarty->assign ("TB_NO_RUAS", _NO_RUAS);
$smarty->assign ("TB_NAMA_RUAS", _NAMA_RUAS);
$smarty->assign ("TB_TITIK_PENGENAL_PANGKAL", _TITIK_PENGENAL_PANGKAL);
$smarty->assign ("TB_TITIK_PENGENAL_UJUNG", _TITIK_PENGENAL_UJUNG);
$smarty->assign ("TB_NAMA_KECAMATAN", _NAMA_KECAMATAN);
$smarty->assign ("TB_PANJANG_RUAS", _PANJANG_RUAS);
$smarty->assign ("TB_LEBAR_RATA_RATA", _LEBAR_RATA_RATA);
$smarty->assign ("TB_PANJANG_PERMUKAAN", _PANJANG_PERMUKAAN);
/*** remark 17-08-2010 
$smarty->assign ("TB_ASPAL", _ASPAL);
$smarty->assign ("TB_PM", _PENETRASI_MACADAM);
$smarty->assign ("TB_TELFORD", _TELFORD);
$smarty->assign ("TB_TANAH", _TANAH);
$smarty->assign ("TB_BLM_TEMBUS", _BELUM_TEMBUS);
***/
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);
$smarty->assign ("LIST_ME", _PRINT_LIST_JL_01_MAIN);
$smarty->assign ("RECORD_PER_PAGE", _RECORD_PER_PAGE);
$smarty->assign ("ACTION", _ACTION);
$smarty->assign ("EDIT", _EDIT);
$smarty->assign ("DELETE", _DELETE);
$smarty->assign ("SORT_IN", _SORT_IN);
$smarty->assign ("SORT_ORDER", _SORT_ORDER);
$smarty->assign ("SHOWING", _SHOWING);
$smarty->assign ("OF", _OF);
$smarty->assign ("RECORDS", _RECORDS);
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
$smarty->assign ("DATA_TB", $data_tb);


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