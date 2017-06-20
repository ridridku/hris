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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/payroll/posting_payroll';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/payroll');
$FILE_JS  = $JS_MODUL.'/posting_payroll';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

#Initiate TABLE
$tbl_name	= "t_gaji";

    $sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_awal,r_periode__payroll_akhir,r_periode__payroll_status "
                 . "FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
        $rs_val = $db->Execute($sql_cek_periode);
        $periode_awal= $rs_val->fields['r_periode__payroll_awal'];
        $periode_akhir= $rs_val->fields['r_periode__payroll_akhir'];

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM t_lembur ";
$sql .="WHERE  t_lembur__no= '$_GET[id]' ";
$sqlresult = $db->Execute($sql);
}

function edit_(){
   
  
global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

function parse_number($number, $dec_point=null) {
    if (empty($dec_point)) {
        $locale = localeconv();
        $dec_point = $locale['decimal_point'];
    }
    return floatval(str_replace($dec_point, '.', preg_replace('/[^\d'.preg_quote($dec_point).']/', '', $number)));
}
$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];
$sql_cek_periode="SELECT r_periode__payroll_id,r_periode__payroll_awal,r_periode__payroll_akhir,r_periode__payroll_status "
         . "FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";
$rs_val = $db->Execute($sql_cek_periode);
$periode_awal= $rs_val->fields['r_periode__payroll_awal'];
$periode_akhir= $rs_val->fields['r_periode__payroll_akhir'];
  
 $app_count= $_POST['approval'];  
 

if (!empty($app_count)&&!empty($_POST['mutasi']))
    {
    $bad_symbols = array(",", ".");
    $approval_array=$_POST['approval'];
    $mutasi_array=$_POST['mutasi'];
    $nip_array=$_POST['nip'];
    $nama_pegawai_array=$_POST['nama_pegawai'];
    
   
    $bank_nama_array=$_POST['bank_nama']; 
    $bank_akun_peg_array=$_POST['bank_akun_peg']; //  var_dump($bank_akun_peg_array)or die();
    $bank_norek_array=$_POST['bank_norek'];
    $bank_alm_array=$_POST['bank_alm'];
    

    $jabatan_array=$_POST['jabatan'];
    $level_array=$_POST['level'];
    $cabang_id_array=$_POST['cabang__id'];
    $cabang_nama_array=$_POST['cabang__nama'];
    $subcab_id_array=$_POST['subcab__id'];
    $subcab_nama_array=$_POST['subcab__nama'];
    $lama_bln_array=$_POST['lama_bln'];
    $tgl_masuk_array=$_POST['tgl_masuk'];
    $dept_ket_array=$_POST['dept__ket'];
    $dept_cc_array=$_POST['dept__cc'];
    $dept_id_array=$_POST['dept__id'];
    
    $rekap_awal_array=$_POST['rekap_awal'];
    $rekap_akhir_array=$_POST['rekap_akhir'];
    
    $rekap_hadir_array=$_POST['rekap_hadir'];
    $rekap_sakir_array=$_POST['rekap_sakit'];
    $rekap_izin_array=$_POST['rekap_izin'];
    $rekap_cuti_array=$_POST['rekap_cuti'];
    $rekap_dinas_array=$_POST['rekap_dinas'];
    $rekap_alpa_array=$_POST['rekap_alpa'];
        
    $gaji_gapok_array=str_replace($bad_symbols,"",$_POST['gapok']);
     
    $t_jabatan_array=str_replace($bad_symbols,"",$_POST['t_jabatan']);
    $t_transport_array=str_replace($bad_symbols,"",$_POST['t_transport']);
    $t_makan_array=str_replace($bad_symbols,"",$_POST['t_makan']);
    $lain1_array=str_replace($bad_symbols,"",$_POST['lain1']);
    $lain2_array=str_replace($bad_symbols,"",$_POST['lain2']);

    $kemahalan_array=str_replace($bad_symbols,"",$_POST['kemahalan']);
    $gaji_kotor_array=str_replace($bad_symbols,"",$_POST['gaji_kotor']);
    
    $dasar_bpjs_array=str_replace($bad_symbols,"",$_POST['dasar_bpjs']);
    $bpjs_tk_tmw_array=str_replace($bad_symbols,"",$_POST['bpjs_tk_tmw']);
    $bpjs_tk_peg_array=str_replace($bad_symbols,"",$_POST['bpjs_tk_peg']);
    $bpjs_kes_tmw_array=str_replace($bad_symbols,"",$_POST['bpjs_kes_tmw']);
    $bpjs_kes_peg_array=str_replace($bad_symbols,"",$_POST['bpjs_kes_peg']);

    $angsuran_array=str_replace($bad_symbols,"",$_POST['angsuran']);
    $koreksi_array=str_replace($bad_symbols,"",$_POST['koreksi']);
    $kosan_array=str_replace($bad_symbols,"",$_POST['t_kosan']);
    

    
    $thp_array=  str_replace($bad_symbols,"",$_POST['thp']);
    
    $ket_resign_array= $_POST['ket_resign'];
    $status_resign_array=  $_POST['ket_resign'];


    for ($i = 0; $i < count($approval_array); $i++) 
    {
        $mutasi = mysql_real_escape_string($mutasi_array[$i]);
        $pegawai_id= mysql_real_escape_string($approval_array[$i]);
        $nip= mysql_real_escape_string($nip_array[$i]);
        $nama_pegawai=mysql_real_escape_string($nama_pegawai_array[$i]);
        $bank_nama=mysql_real_escape_string($bank_nama_array[$i]);
        $bank_akun_peg=mysql_real_escape_string($bank_akun_peg_array[$i]);
        $bank_norek=mysql_real_escape_string($bank_norek_array[$i]);
        $bank_alm=mysql_real_escape_string($bank_alm_array[$i]);
         
        $jabatan= mysql_real_escape_string($jabatan_array[$i]);
        $level= mysql_real_escape_string($level_array[$i]);
        $cabang_id= mysql_real_escape_string($cabang_id_array[$i]);
        $cabang_nama= mysql_real_escape_string($cabang_nama_array[$i]);
        
        $subcab_id= mysql_real_escape_string($subcab_id_array[$i]);
        $subcab_nama= mysql_real_escape_string($subcab_nama_array[$i]);
        $lama_bln= mysql_real_escape_string($lama_bln_array[$i]);
        $tgl_masuk= mysql_real_escape_string($tgl_masuk_array[$i]);
        $dept_ket= mysql_real_escape_string($dept_ket_array[$i]);
        $dept_cc= mysql_real_escape_string($dept_cc_array[$i]);
        $dept_id= mysql_real_escape_string($dept_id_array[$i]);

        $rekap_awal=mysql_real_escape_string($rekap_awal_array[$i]);
        $rekap_akhir=mysql_real_escape_string($rekap_akhir_array[$i]);
        
        $rekap_hadir=mysql_real_escape_string($rekap_hadir_array[$i]);
        $rekap_sakit=mysql_real_escape_string($rekap_sakit_array[$i]);
        $rekap_izin=mysql_real_escape_string($rekap_izin_array[$i]);
        $rekap_cuti=mysql_real_escape_string($rekap_cuti_array[$i]);
        $rekap_dinas=mysql_real_escape_string($rekap_dinas_array[$i]);
        $rekap_alpa=mysql_real_escape_string($rekap_alpa_array[$i]);
        
        
        $gapok=mysql_real_escape_string($gaji_gapok_array[$i]);
        $tunj_jabatan=mysql_real_escape_string($t_jabatan_array[$i]);
        $tunj_transport=mysql_real_escape_string($t_transport_array[$i]);
        $tunj_makan=mysql_real_escape_string($t_makan_array[$i]);
        $lain1=mysql_real_escape_string($lain1_array[$i]);
        $lain2=mysql_real_escape_string($lain2_array[$i]);
        $kemahalan=mysql_real_escape_string($kemahalan_array[$i]);
        $gaji_kotor=mysql_real_escape_string($gaji_kotor_array[$i]);
        
        
        $dasar_bpjs=mysql_real_escape_string($dasar_bpjs_array[$i]);
        $bpjs_tk_tmw=mysql_real_escape_string($bpjs_tk_tmw_array[$i]);
        $bpjs_tk_peg=mysql_real_escape_string($bpjs_tk_peg_array[$i]);
        $bpjs_kes_tmw=mysql_real_escape_string($bpjs_kes_tmw_array[$i]);
        $bpjs_kes_peg=mysql_real_escape_string($bpjs_kes_peg_array[$i]);
        
     
        $angsuran=mysql_real_escape_string($angsuran_array[$i]);
        $koreksi=mysql_real_escape_string($koreksi_array[$i]);
        $kosan=mysql_real_escape_string($kosan_array[$i]);
        
        $ket_resign=mysql_real_escape_string($ket_resign_array[$i]);
        $status_resign=mysql_real_escape_string($status_resign_array[$i]);

      //  $gaji_netto=0;
        $gaji_gross=$gapok+$tunj_jabatan+$tunj_transport+$tunj_makan+$lain1+$lain2+$kemahalan;
    
        //$potongan=$bpjs_tk_peg+$bpjs_kes_peg;
        
            $bpjs_tk_perusahaan  = $dasar_bpjs*0.0424;
            $bpjs_kes_perusahaan = $dasar_bpjs*0.040;
            $bpjs_tk_karyawan= $dasar_bpjs*0.02;
            $bpjs_kes_karyawan= $dasar_bpjs*0.010;         
        
        $potongan=  round($bpjs_tk_karyawan+$bpjs_kes_karyawan);
        $gaji_netto= round($gaji_gross-$potongan);
         
       // var_dump($gaji_netto)or die();
        if($status_resign==1)
        {
            //$gaji_netto_karyawan=round($rekap_hadir/25*$gaji_netto);
             $gaji_netto_karyawan= round($gaji_netto+0);
            $keterangan_resign='KELUAR';
        }  else {
             $gaji_netto_karyawan= round($gaji_netto+0);
              $keterangan_resign='';
        }
       
        
//--------------PERIODE AFTER CLOSING---------------------//
        $sql_after_closing_="SELECT r_periode__payroll_id,
    	DATE_SUB(r_periode__payroll_awal, INTERVAL 1 MONTH) as awal,
	DATE_SUB(r_periode__payroll_akhir, INTERVAL 1 MONTH) as akhir,
        r_periode__payroll_status 
        FROM r_periode_payroll WHERE r_periode__payroll_status=1 ";

        $rs_val = $db->Execute($sql_after_closing_);
        $pre_active= $rs_val->fields['awal'];
        $end_active= $rs_val->fields['akhir'];   
        
//--------------PERIODE AFTER CLOSING---------------------//        

    $cek_status_payroll="SELECT t_gaji.t_gaji__awal as awal ,t_gaji.t_gaji__akhir as akhir,t_gaji.t_gaji__no_mutasi AS mutasi From t_gaji"
    . " where t_gaji.t_gaji__awal='$pre_active' and t_gaji.t_gaji__akhir='$end_active' AND t_gaji.t_gaji__no_mutasi='$mutasi'";

    //var_dump($cek_status_payroll)or die();
    $rs_val = $db->Execute($cek_status_payroll);
    $status_payroll_mutasi= $rs_val->fields['mutasi'];
            
      
  
if($status_payroll_mutasi=='')
    {
  //  var_dump('a')or die();
    $sql = "INSERT INTO $tbl_name (t_gaji__awal,"
                                        . "t_gaji__akhir,"
                                        . "t_gaji__id_peg,"
                                        . "t_gaji__no_mutasi,"
                                        . "t_gaji__cabang,"
                                        . " t_gaji__cabang_id,"
                                        . " t_gaji__subcabang,"
                                        . " t_gaji__subcabang_id,"
                                        . " t_gaji__cost_center,"
                                        . " t_gaji__departemen,"
                                        . " t_gaji__departemen_id,"
                                        . " t_gaji__nip,"
                                        . " t_gaji__nama,"
                                        . " t_gaji__jabatan,"
                                        . " t_gaji__level,"
                                        . " t_gaji__tgl_masuk,"
                                        . " t_gaji__masa_kerja,"
                                        . " t_gaji__hadir,"
                                        . " t_gaji__sakit,"
                                        . " t_gaji__izin,"
                                        . " t_gaji__cuti,"
                                        . " t_gaji__dinas,"
                                        . " t_gaji__alpa,"
                                        . " t_gaji__dasarbpjs,"
                                        . " t_gaji__gapok,"
                                        . " t_gaji__tunj_jabatan,"
                                        . " t_gaji__transport,"
                                        . " t_gaji__makan,"
                                        . " t_gaji__kemahalan,"
                                        . " t_gaji__lain1,"
                                        . " t_gaji__angsuran,"
                                        . " t_gaji__koreksi1,"
                                        . " t_gaji__lain2,"
                                        . " t_gaji__gross,"
                                        . " t_gaji__netto,"
                                        . " t_gaji__bank,"
                                        . " t_gaji__norek,"
                                        . " t_gaji__approval,"
                                        . " t_gaji__status_resign,"
                                        . " t_gaji__ket_resign,"
                                        . "t_gaji__tua_pegawai,"
                                        . "t_gaji__tua_perusahaan,"
                                        . "t_gaji__sehat_pegawai,"
                                        . "t_gaji__sehat_perusahaan,"
                                        . " t_gaji__date_updated,"
                                        . " t_gaji__date_created,"
                                        . " t_gaji__user_created,"
                                        . " t_gaji__user_updated)";
                         
                                    $sql	.= " VALUES ("
                                            . " '$rekap_awal',"
                                            . " '$rekap_akhir',"
                                            . " '$pegawai_id',"
                                            . " '$mutasi',"
                                            . " '$cabang_nama',"
                                            . " '$cabang_id',"
                                            . " '$subcab_nama',"
                                            . " '$subcab_id',"
                                            . " '$dept_cc',"
                                            . " '$dept_ket',"
                                            . " '$dept_id',"
                                            . " '$nip',"
                                            . " '$nama_pegawai',"
                                            . " '$jabatan',"
                                            . " '$level',"
                                            . " '$tgl_masuk',"
                                            . " '$lama_bln',"
                                            . " '$rekap_hadir',"
                                            . " '$rekap_sakit',"
                                            . " '$rekap_izin',"
                                            . " '$rekap_cuti',"
                                            . " '$rekap_dinas',"
                                            . " '$rekap_alpa',"
                                            . " '$dasar_bpjs',"
                                            . " '$gapok',"
                                            . " '$tunj_jabatan',"
                                            . " '$tunj_transport',"
                                            . " '$tunj_makan',"
                                            . " '$kemahalan',"
                                            . " '$lain1',"
                                            . " '$angsuran',"
                                            . " '$koreksi',"
                                            . " '$lain2',"
                                            . " '$gaji_gross',"
                                            . " '$gaji_netto_karyawan',"
                                            . " '$bank_akun_peg',"
                                            . " '$bank_norek',"
                                            . "'1',"
                                            . "'$status_resign',"
                                             . "'$keterangan_resign',"
                                            . "'$bpjs_tk_karyawan',"   
                                            . "'$bpjs_tk_perusahaan',"
                                            . "'$bpjs_kes_karyawan',"
                                            . "'$bpjs_kes_perusahaan',"
                                            . "now(),"
                                            . "now(),"
                                            . "'".strip_tags($id_peg)."',"
                                            . "'".strip_tags($id_peg)."')";
                          

                                             $sqlresult = $db->Execute($sql);
                                             
                                         	
    
    }
    else
{ 
        //var_dump('b')or die();
        $sql_edit  ="UPDATE $tbl_name SET ";
        $sql_edit .="t_gaji__awal= '$rekap_awal',";
        $sql_edit .="t_gaji__akhir='$rekap_akhir',";
        $sql_edit .="t_gaji__id_peg='$pegawai_id',";
        $sql_edit .="t_gaji__no_mutasi='$mutasi',";
        $sql_edit .="t_gaji__cabang='$cabang_nama',";
        $sql_edit .="t_gaji__cabang_id='$cabang_id',";
        $sql_edit .="t_gaji__subcabang='$subcab_nama',";
        $sql_edit .="t_gaji__subcabang_id='$subcab_id',";
        $sql_edit .="t_gaji__cost_center='$dept_cc',";
        $sql_edit .="t_gaji__departemen='$dept_ket',";
        $sql_edit .="t_gaji__departemen_id='$dept_id',";
        $sql_edit .="t_gaji__nip='$nip',";
        $sql_edit .="t_gaji__nama='$nama_pegawai',";
        $sql_edit .="t_gaji__jabatan='$jabatan',";
        $sql_edit .="t_gaji__level='$level',";
        $sql_edit .="t_gaji__tgl_masuk='$tgl_masuk',";
        $sql_edit .="t_gaji__masa_kerja='$lama_bln',"	;
        $sql_edit .="t_gaji__hadir='$rekap_hadir',";
        $sql_edit .="t_gaji__sakit='$rekap_sakit',";
        $sql_edit .="t_gaji__izin='$rekap_izin',";
        $sql_edit .="t_gaji__cuti='$rekap_cuti',";
        $sql_edit .="t_gaji__dinas='$rekap_dinas',";
        $sql_edit .="t_gaji__alpa='$rekap_alpa',";
        $sql_edit .="t_gaji__dasarbpjs='$dasar_bpjs',";
        $sql_edit .="t_gaji__gapok='$gapok',";
        $sql_edit .="t_gaji__tunj_jabatan='$tunj_jabatan',";
        $sql_edit .="t_gaji__transport='$tunj_transport',";
        $sql_edit .="t_gaji__makan='$tunj_makan',"	;
        $sql_edit .="t_gaji__kemahalan='$kemahalan',";
        $sql_edit .="t_gaji__lain1='$lain2',";
        $sql_edit .="t_gaji__angsuran='$angsuran',";
        $sql_edit .="t_gaji__koreksi1='$koreksi',";
        $sql_edit .="t_gaji__kost='$kosan',";
        $sql_edit .="t_gaji__gross='$gaji_gross',";
        $sql_edit .="t_gaji__netto='$gaji_netto_karyawan',";
        $sql_edit .="t_gaji__bank='$bank_akun_peg',";
        $sql_edit .="t_gaji__norek='$bank_norek',";
        $sql_edit .="t_gaji__approval='1',";
        $sql_edit .="t_gaji__status_resign='$status_resign',";
        $sql_edit .="t_gaji__ket_resign='$keterangan_resign',";
        $sql_edit .="t_gaji__date_updated= now(),";
        $sql_edit .="t_gaji__date_created=now(),";
        $sql_edit .="t_gaji__user_created='$id_peg',"	;
        $sql_edit .="t_gaji__user_updated='$id_peg'";	
        $sql_edit .="  WHERE t_gaji__no_mutasi='$mutasi' AND t_gaji__awal='$rekap_awal' AND t_gaji__akhir='$rekap_akhir' ";
     // var_dump($sql_edit)or die();
        $sqlresult = $db->Execute($sql_edit);
        
        
        
        
        } 
    
     

    } 
    
     $sql_log="INSERT INTO t_log (log__module_name, log__date_created,log__date_updated,log__user_updated,log__user__created ) "
            . " VALUES ('POSTING PAYROLL',now(),now(),'$id_peg','$id_peg') ";
             $db->Execute($sql_log);
   
}


    Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]);
               
}

function create_(){

global $mod_id;	
global $db;
global $tbl_name;
global $field_name;

    
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
