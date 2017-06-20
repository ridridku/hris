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
require_once($DIR_HOME.'../laporan/inc.rekap_absen_hglm.php');  

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/pelaporan/lap_absen/rekap_absen_hglm';
 
#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/pelaporan/lap_absen');
$FILE_JS  = $JS_MODUL.'/rekap_absen_hglm';

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


$smarty->assign ("KODE_CABANG_CARI", $kode_cabang_cari);

$arr = array($tahun1,$bulan1,$tgl1);                                 
$date_awal= implode("-",$arr); 

$arr = array($tahun2,$bulan2,$tgl2);                                 
$date_akhir= implode("-",$arr); 
$Search_Year='2016';

$smarty->assign ("TAHUN1", $tahun1);
$smarty->assign ("TAHUN2", $tahun2);

//var_dump($Search_Year)or die();

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&search=1&Search_Year=".$Search_Year."&kode_cabang_cari=".$kode_cabang_cari."&nama_karyawan_cari=".$nama_karyawan_cari."&kode_subcab_cari=".$kode_subcab_cari;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page."&search=1&Search_Year=".$Search_Year;

//$SES_TAHUN		= $_SESSION['TAHUN'];
$SES_INSTANSI		= $_SESSION['KODE_INSTANSI'];
$SES_JENIS_USER		= $_SESSION['JENIS_USER'];
//var_dump($str_completer)or die();

$jenis_user     = $_SESSION['SESSION_JNS_USER'];$smarty->assign ("JENIS_USER_SES", $jenis_user);
$kode_pw_ses    = $_SESSION['SESSION_KODE_CABANG'];$smarty->assign ("KODE_PW_SES", $kode_pw_ses);
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


//--------------------------------------
//SHOW DATA INSTANSI
//---------------------------------------
$smarty->assign ("SES_INSTANSI", $SES_INSTANSI);
$smarty->assign ("SES_JENIS_USER", $SES_JENIS_USER);

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


//---------DATA SUBCABANG-------------------------//     

    
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
                      
                                                $sql  = "SELECT peg.r_pegawai__nama,peg.r_pnpt__finger_print,
                                                            peg.r_cabang__nama,
                                                            peg.r_cabang__id,
                                                            peg.r_subcab__id,
                                                            peg.r_subcab__nama,
                                                            peg.r_dept__id,
                                                            peg.r_dept__ket,
                                                            ra.t_rkp__no_mutasi,
                                                            ra.t_rkp__awal,
                                                            ra.t_rkp__akhir,
                                                            ra.t_rkp__approval,
                                                            ra.t_rkp__hadir,
                                                            ra.t_rkp__sakit,
                                                            ra.t_rkp__izin,
                                                            ra.t_rkp__cuti,
                                                            ra.t_rkp__dinas,
                                                            ra.t_rkp__alpa,
                                                            ra. t_rkp__keterangan
                                                            FROM
                                                            t_rekap_absensi ra 
                                                            LEFT JOIN v_pegawai peg ON ra.t_rkp__no_mutasi=peg.r_pnpt__no_mutasi 
                                                            where r_cabang__id = '".$kode_pw_ses."' ";
                                                
                      

			} else {
						$sql  = "SELECT peg.r_pegawai__nama,peg.r_pnpt__finger_print,
                                                            peg.r_cabang__nama,
                                                            peg.r_cabang__id,
                                                            peg.r_subcab__id,
                                                            peg.r_subcab__nama,
                                                            peg.r_dept__id,
                                                            peg.r_dept__ket,
                                                            ra.t_rkp__no_mutasi,
                                                            ra.t_rkp__awal,
                                                            ra.t_rkp__akhir,
                                                            ra.t_rkp__approval,
                                                            ra.t_rkp__hadir,
                                                            ra.t_rkp__sakit,
                                                            ra.t_rkp__izin,
                                                            ra.t_rkp__cuti,
                                                            ra.t_rkp__dinas,
                                                            ra.t_rkp__alpa,
                                                            ra. t_rkp__keterangan
                                                            FROM
                                                            t_rekap_absensi ra 
                                                            LEFT JOIN v_pegawai peg ON ra.t_rkp__no_mutasi=peg.r_pnpt__no_mutasi 
                                                            where 1=1 ";	

			}
 
				//echo "<br><br><br><br><br><br><br><br><br><br>dddddddddkode_perwakilan_cari ===".$kode_perwakilan_cari;

                                             if ($kode_cabang_cari !='') {
						 	$sql.=" and  r_cabang__id =".$kode_cabang_cari."  ";
						 }

						 if ($kode_subcab_cari !='') {
						 	$sql.=" and  r_subcab__id ='$kode_subcab_cari' ";
						 }

						if ($departemen_cari !=''  ) {
						 	$sql.="  and r_dept__id='$departemen_cari' ";
						 } 

						if ($tahun1 !='' AND $tahun2 !='' ) {
						 	$sql.="  AND t_rkp__awal>='$date_awal' AND t_rkp__akhir<='$date_akhir'  ";
						 } 
                                                 
                                                  if ($nama_karyawan_cari !='') {
						 	$sql.="and r_pegawai__nama LIKE '%".$nama_karyawan_cari."%'  ";
						 }

		

			 	 $sql.=" GROUP BY r_pnpt__finger_print ORDER BY r_pnpt__id_pegawai ";

                            //    if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
                      //   var_dump($sql)or die();
				$numresults=$db->Execute($sql);
				$count = $numresults->RecordCount();
			//	$pages = $p->findPages($count,$LIMIT); 
			//	$sql  .= "LIMIT ".$start.", ".$LIMIT;
				$recordSet = $db->Execute($sql);
				//print $sql;
				$end = $recordSet->RecordCount();
				$initSet = array();
				$data_tb = array();
				$row_class = array();
				$z=0;
				 $count_no = 1;
				while ($arr=$recordSet->FetchRow()) {
					array_push($data_tb, $arr);
                                        
                                 $label="Nama :". $arr[r_pegawai__nama]; 
                                 
                                 
                                   $status=$arr[t_rkp__approval];
                               if($status==3)
                               {
                                   $label_status='Disetujui HGLM';
                               } elseif($status==4)
                               {
                                   $label_status='Closing';
                               }
                               elseif($status==2)
                               {
                                   $label_status='Disetujui BOM';
                               } 
                               elseif($status==1)
                               {
                                   $label_status='Disetujui HRD';
                               }   
				elseif($status==0)
                               {
                                   $label_status='Tidak Disetujui';
                               }   
				
					
			   
			    $content_data .= print_content(
                                    $count_no,
                                    $arr[r_pnpt__finger_print],
                                    $arr[r_pegawai__nama],
                                    $arr[r_cabang__nama],
                                    $arr[r_subcab__nama],
                                    $arr[r_dept__ket],
                                    $label_status,
                                    $arr[t_rkp__hadir],
                                    $arr[t_rkp__sakit],
                                    $arr[t_rkp__izin],
                                    $arr[t_rkp__cuti],
                                    $arr[t_rkp__dinas],
                                    $arr[t_rkp__alpa],
                                    $arr[t_rkp__keterangan]
                                   );	
     
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
				$count_all  = $start+$end;
			//	$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer);                              
                                  $smarty->assign ("DATA_TB", $data_tb);
                        
                          //total karyawan
                          $sql_total="SELECT COUNT(*) as total_orang FROM t_rekap_absensi ra 
                                            LEFT JOIN v_pegawai peg ON ra.t_rkp__no_mutasi=peg.r_pnpt__no_mutasi 
                                            where t_rkp__awal>='$periode_awal' AND t_rkp__akhir<='$periode_akhir' ";
                             if ($kode_cabang_cari !='') {
                                       $sql_total.=" and  r_cabang__id =".$kode_cabang_cari."  ";
                                }

                                if ($kode_subcab_cari !='') {
                                       $sql_total.=" and  r_subcab__id ='$kode_subcab_cari' ";
                                }

                               if ($departemen_cari !=''  ) {
                                       $sql_total.="  and r_dept__id='$departemen_cari' ";
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

					$label="JML KARYAWAN : ".$arr4[total_orang];
					$content_data .= print_content("","","","","","","","","","","","","",$label);
				}

                                $smarty->assign ("DATA_TB4", $data_tb4);          
                               //TUTUP karyawan
                                
                                
				$file= $DIR_HOME."/files/rekap_absensi_".$nm_perwakilan."_".$periode_akhir.".xls";
				$fp=@fopen($file,"w");
				if(!is_resource($fp))
				return false;
				//$content = str_replace("@@@@BREAKPAGE@@@@@",$content_break,$content);
				stream_set_write_buffer($fp, 0);
                             
				$content = print_header($nm_perwakilan,$periode_awal,$periode_akhir);
				$content .= $content_data;
				
				$content .= print_footer();
				fwrite($fp,$content);
				fclose($fp);
				$file_2= $HREF_HOME."/files/rekap_absensi_".$nm_perwakilan."_".$periode_akhir.".xls";
                             
                                
                              
                                
}

}


($_GET['search'] == '1') ? $tampilkan_search_box = 0: $tampilkan_search_box = 1;
$smarty->assign ("SEARCH_BOX", $tampilkan_search_box);
$smarty->assign ("NO_URUT", $count_no); 
$smarty->assign ("SEARCH_YEAR", $Search_Year);
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