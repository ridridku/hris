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

#FOR IMAGES CLASS PAGER
$HREF_IMAGES = $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images');

# including Header file for Content Expiring
require_once($DIR_INC.'/header.exp.inc');
# including Header file for Database Configuration
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.pager.php');

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
$kode_pw_ses  = $_SESSION['SESSION_KODE_PERWAKILAN'];
 

$smarty->assign ("JENIS_USER_SES", $jenis_user);
$smarty->assign ("KODE_PW_SES", $kode_pw_ses);

//echo "JENIS USER".$_SESSION['SESSION_JNS_USER'];
//echo "<br>KODE PERWAKILAN".$_SESSION['SESSION_KODE_PERWAKILAN'];

#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);

$smarty->assign ("HREF_HOME_PATH_AJAX", $HREF_HOME.'/modules/data_pegawai/pegawai');
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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/data_pegawai/pegawai/';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/data_pegawai');
$FILE_JS  = $JS_MODUL.'/pegawai';

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
$tbl_name	= "tbl_wni";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//


if ($_POST['limit']) { $LIMIT = $_POST['limit']; }
else if ($_GET['limit']) {$LIMIT = $_GET['limit']; }
else $LIMIT=$nLimit;

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

if ($_GET['no_paspor_cari']) $no_paspor_cari = $_GET['no_paspor_cari'];
else if ($_POST['no_paspor_cari']) $no_paspor_cari = $_POST['no_paspor_cari'];
else $no_paspor_cari="";

if ($_GET['nama_wni_cari']) $nama_wni_cari = $_GET['nama_wni_cari'];
else if ($_POST['nama_wni_cari']) $nama_wni_cari = $_POST['nama_wni_cari'];
else $nama_wni_cari="";


 if ($_GET['kode_sumber']) $kode_sumber = $_GET['kode_sumber'];
else if ($_POST['kode_sumber']) $kode_sumber = $_POST['kode_sumber'];
else $kode_sumber="";


$smarty->assign ("KODE_PERWAKILAN_CARI", $kode_perwakilan_cari);
$smarty->assign ("NO_PASPOR_CARI", $no_paspor_cari);
$smarty->assign ("NAMA_WNI_CARI", $nama_wni_cari);
$smarty->assign ("KODE_SUMBER", $kode_sumber);



$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_perwakilan_cari=".$kode_perwakilan_cari."&no_paspor_cari=".$no_paspor_cari."&nama_wni_cari=".$nama_wni_cari."&kode_sumber=".$kode_sumber;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;


//echo "<br><br><br><br><br><br><br><br><br><br>kode_perwakilan_cari".$kode_perwakilan_cari;
//SHOW DATA PROVINSI
//-------------------------------------
$sql_propinsi = "SELECT id_propinsi,no_propinsi,nama_propinsi FROM tbl_mast_wil_propinsi ";
$result_propinsi = $db->Execute($sql_propinsi);
$initSet = array();
$data_propinsi = array();
$z=0;
while ($arr=$result_propinsi->FetchRow()) {
	array_push($data_propinsi, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PROPINSI", $data_propinsi);


//-------------------------------------
$sql_agama = "SELECT  *  FROM tbl_mast_agama ";
$result_agama = $db->Execute($sql_agama);
$initSet = array();
$data_agama = array();
$z=0;
while ($arr=$result_agama->FetchRow()) {
	array_push($data_agama, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_AGAMA",$data_agama);


//-------------------data_dep------------------
$sql_dep = "SELECT A.kode_departemen,A.departemen from tbl_mast_departemen A order by kode_departemen";
$result_dep = $db->Execute($sql_dep);
//var_dump($sql_dep) or die();
$initSet = array();
$data_dep = array();
$z=0;
while ($arr=$result_dep->FetchRow()) {
	array_push($data_dep, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_DEP",$data_dep);

//-------------data_pwk------------------------
$sql_pwk = "SELECT * FROM tbl_mast_cabang order by kode_cabang  ";
$result_pwk = $db->Execute($sql_pwk);
//var_dump($sql_pwk)or die();
$initSet = array();
$data_pwk = array();
$z=0;
while ($arr=$result_pwk->FetchRow()) {
	array_push($data_pwk, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PWK", $data_pwk);
//---------------------data_jabatan---------------------------

$sql_jabatan= "SELECT * FROM tbl_mast_jabatan order by kode_jabatan ";
$result_jabatan = $db->Execute($sql_jabatan);
$initSet = array();
$data_jabatan = array();
$z=0;
while ($arr=$result_jabatan->FetchRow()) {
	array_push($data_jabatan, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_JABATAN", $data_jabatan);

//----------------------data_bank------------------------------------
$sql_bank = "SELECT * FROM tbl_mast_bank order by kode_bank  ";
$result_bank = $db->Execute($sql_bank);
//var_dump($sql_bank)or die();
$initSet = array();
$data_bank = array();
$z=0;
while ($arr=$result_bank->FetchRow()) {
	array_push($data_bank, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_BANK", $data_bank);

//----------------------------------------------------
$sql_level = "SELECT * FROM tbl_mast_level_jabatan order by kode_level  ";
$result_level= $db->Execute($sql_level);
//var_dump($sql_level)or die();
$initSet = array();
$data_level= array();
$z=0;
        while ($arr=$result_level->FetchRow()) {
	array_push($data_level, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_LEVEL", $data_level);
//-----------------------Data_Status-----------------------------
$sql_status = "SELECT * FROM tbl_mast_status_karyawan order by kode_status  ";
$result_status= $db->Execute($sql_status);
//var_dump($sql_status)or die();
$initSet = array();
$data_status= array();
$z=0;
        while ($arr=$result_status->FetchRow()) {
	array_push($data_status, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_STATUS", $data_status);
//------------------------------------------------------



if ($_GET[get_prop] == 1)
{
	$no_propinsi = $_GET[no_prop];
			if($no_propinsi!=''){
					$sql_kabupaten = "SELECT id_kabupaten,no_kabupaten,nama_kabupaten FROM tbl_mast_wil_kabupaten WHERE no_propinsi='".$no_propinsi."' ORDER BY id_kabupaten ASC";
					$recordSet_kabupaten = $db->Execute($sql_kabupaten);
					//print $sql_kabupaten;
					$input_kab="<select name=id_kab  >";
					$input_kab.="<option value=[Pilih Kabupaten]> ";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF):
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields['id_kabupaten'].">".$recordSet_kabupaten->fields['nama_kabupaten'];
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

if ($_GET[get_kec] == 1)
{
	$no_propinsi = $_GET[no_prop];
	$no_kabupaten = $_GET[no_kab];
	//$kecamatan_id = $_GET[kecamatan_id];
	//print $no_kabupaten;

			if($no_propinsi!=''){
					$sql_kecamatan = "SELECT id_kecamatan,no_kecamatan,nama_kecamatan FROM tbl_mast_wil_kecamatan WHERE no_kabupaten='".$no_kabupaten."' AND no_propinsi='".$no_propinsi."' ORDER BY id_kecamatan ASC";
					$recordSet_kecamatan = $db->Execute($sql_kecamatan);
					//print $sql_kecamatan;
					$input_kec="<select name=no_kecamatan onchange=\"cari_kec2($no_propinsi,$no_kabupaten,this.value)\">";
					$input_kec.="<option value=[Pilih Kecamatan]> ";
					$input_kec.="</option> ";
					while(!$recordSet_kecamatan->EOF):
						$input_kec.="<option value=";
						$input_kec.= $recordSet_kecamatan->fields['no_kecamatan'].">".$recordSet_kecamatan->fields['nama_kecamatan'];
						$input_kec.="</option>";
					$recordSet_kecamatan->MoveNext();
					endwhile;
					$input_kec.="</select> ";
					//
					$delimeter   = "-";
					$option_choice = $input_kec."^/&".$delimeter;
					echo $option_choice;
			}
}










$opt = $_GET[opt];

$ed = 0;
if($opt=="1"){

	$sql_ = "SELECT *
  
  from tbl_mast_pegawai A
  LEFT JOIN tbl_mast_agama B ON A.kode_agama=B.kode_agama
  LEFT JOIN tbl_mast_departemen C ON A.kode_departemen=C.kode_departemen
  LEFT JOIN tbl_mast_cabang D ON D.kode_cabang=A.kode_cabang
  LEFT JOIN tbl_mast_jabatan E ON A.kode_jabatan=E.kode_jabatan 
  LEFT JOIN tbl_mast_status_karyawan F ON A.kode_status=F.kode_status   
  LEFT JOIN tbl_mast_wil_propinsi G ON A.no_propinsi = G.no_propinsi
  where id ='".$_GET['id']."' ";


	$resultSet = $db->Execute($sql_);
        //var_dump($sql_)or die();
	$edit_id = $resultSet->fields[id];
        $edit_nik= $resultSet->fields[nik];
	$edit_kode_cabang= $resultSet->fields[kode_cabang];
        $edit_kode_departemen = $resultSet->fields[kode_departemen];
        $edit_kode_jabatan = $resultSet->fields[kode_jabatan];
        $edit_kode_level = $resultSet->fields[kode_level];
        $edit_kode_absensi = $resultSet->fields[kode_absensi];
        $edit_nama = $resultSet->fields[nama];
        $edit_pendidikan_akhir = $resultSet->fields[pendidikan_akhir];
        $edit_foto = $resultSet->fields[foto];
        $edit_tempat_lahir = $resultSet->fields[tempat_lahir];
        $edit_tgl_lahir = $resultSet->fields[tgl_lahir];
        $edit_jk = $resultSet->fields[jk];
        $edit_kode_agama = $resultSet->fields[kode_agama];
        $edit_no_ktp_sim = $resultSet->fields[no_ktp_sim];
        $edit_alamat_ktp = $resultSet->fields[alamat_ktp];
        $edit_kode_pos_ktp = $resultSet->fields[kode_pos_ktp];
        $edit_rt_rw_ktp = $resultSet->fields[rt_rw_ktp];
        $edit_no_propinsi = $resultSet->fields[no_propinsi];
        $edit_id_kab = $resultSet->fields[id_kab];
        $edit_alamat_domisil = $resultSet->fields[alamat_domisil];
        $edit_kode_pos_domisil = $resultSet->fields[kode_pos_domisil];
        $edit_rt_rw_domisil = $resultSet->fields[rt_rw_domisil ];
        $edit_kode_gol_darah = $resultSet->fields[kode_gol_darah];
        $edit_telp_rmh = $resultSet->fields[telp_rmh];
        $edit_hp = $resultSet->fields[hp];
        $edit_telp_inventaris = $resultSet->fields[telp_inventaris];
        $edit_tgl_masuk = $resultSet->fields[tgl_masuk ];
        $edit_tgl_kontrak_awal = $resultSet->fields[tgl_kontrak_awal];
        $edit_tgl_kontrak_akhir = $resultSet->fields[tgl_kontrak_akhir ];
        $edit_status_pegawai = $resultSet->fields[status_pegawai];
        $edit_kontrak_ke = $resultSet->fields[kontrak_ke];
        $edit_no_npwp = $resultSet->fields[no_npwp ];
        $edit_no_bpjs_kt = $resultSet->fields[no_bpjs_kt];
        $edit_no_bpjs_kes = $resultSet->fields[no_bpjs_kes ];
        $edit_no_inhealth = $resultSet->fields[no_inhealth];
        $edit_kode_bank = $resultSet->fields[kode_bank];
        $edit_alamat_buka_bank = $resultSet->fields[alamat_buka_bank ];
        $edit_rek_bank_baru = $resultSet->fields[rek_bank_baru ];
        $edit_nama_rek_bank = $resultSet->fields[nama_rek_bank];
        $edit_kota_bank = $resultSet->fields[kota_bank];
        
       
//-------------------------------------		
	$edit = 1;
	$sql_kabupaten = "SELECT id_kabupaten,no_kabupaten,nama_kabupaten FROM tbl_mast_wil_kabupaten where no_propinsi='".$edit_no_propinsi."' ORDER BY id_kabupaten ASC ";
	$result_kabupaten = $db->Execute($sql_kabupaten);
	$initSet = array();
	$data_kabupaten = array();
	$z=0;
	while ($arr=$result_kabupaten->FetchRow()) {
	array_push($data_kabupaten, $arr);
	array_push($initSet, $z);
	$z++;
	}
	$smarty->assign ("DATA_KABUPATEN", $data_kabupaten);

}
//var_dump($kode_jabatan) or die();

$smarty->assign ("OPT", $opt);

$smarty->assign ("EDIT_ID", $edit_id);
$smarty->assign ("EDIT_KODE_CABANG", $edit_kode_cabang);
$smarty->assign ("EDIT_KODE_DEPARTEMEN",$edit_kode_departemen);
$smarty->assign ("EDIT_KODE_JABATAN",$edit_kode_jabatan);
$smarty->assign ("EDIT_KODE_LEVEL",$edit_kode_level);
$smarty->assign ("EDIT_KODE_ABSENSI",$edit_kode_absensi);
$smarty->assign ("EDIT_NAMA",$edit_nama);
$smarty->assign ("EDIT_PENDIDIKAN_AKHIR",$edit_pendidikan_akhir);
$smarty->assign ("EDIT_FOTO",$edit_foto);
$smarty->assign ("EDIT_TEMPAT_LAHIR",$edit_tempat_lahir);
$smarty->assign ("EDIT_TGL_LAHIR",$edit_tgl_lahir);
$smarty->assign ("EDIT_JK",$edit_jk);
$smarty->assign ("EDIT_KODE_AGAMA",$edit_kode_agama);
$smarty->assign ("EDIT_NO_KTP_SIM",$edit_no_ktp_sim);
$smarty->assign ("EDIT_ALAMAT_KTP",$edit_alamat_ktp);
$smarty->assign ("EDIT_KODE_POS_KTP",$edit_kode_pos_ktp);
$smarty->assign ("EDIT_RT_RW_KTP",$edit_rt_rw_ktp);
$smarty->assign ("EDIT_NO_PROPINSI",$edit_no_propinsi);
$smarty->assign ("EDIT_ID_KAB",$edit_id_kab);
$smarty->assign ("EDIT_ALAMAT_DOMISIL",$edit_alamat_domisil);
$smarty->assign ("EDIT_KODE_POS_DOMISIL",$edit_kode_pos_domisil);
$smarty->assign ("EDIT_RT_RW_DOMISIL",$edit_rt_rw_domisil);
$smarty->assign ("EDIT_KODE_GOL_DARAH",$edit_kode_gol_darah);
$smarty->assign ("EDIT_TELP_RMH",$edit_telp_rmh);
$smarty->assign ("EDIT_HP",$edit_hp);
$smarty->assign ("EDIT_TELP_INVENTARIS",$edit_telp_inventaris);
$smarty->assign ("EDIT_TGL_MASUK",$edit_tgl_masuk);
$smarty->assign ("EDIT_TGL_KONTRAK_AWAL",$edit_tgl_kontrak_awal);
$smarty->assign ("EDIT_TGL_KONTRAK_AKHIR",$edit_tgl_kontrak_akhir);
$smarty->assign ("EDIT_STATUS_PEGAWAI",$edit_status_pegawai);
$smarty->assign ("EDIT_KONTRAK_KE",$edit_kontrak_ke);
$smarty->assign ("EDIT_NO_NPWP",$edit_no_npwp);
$smarty->assign ("EDIT_NO_BPJS_KT",$edit_no_bpjs_kt);
$smarty->assign ("EDIT_NO_BPJS_KES",$edit_no_bpjs_kes);
$smarty->assign ("EDIT_NO_INHEALTH",$edit_no_inhealth);
$smarty->assign ("EDIT_KODE_BANK",$edit_kode_bank);
$smarty->assign ("EDIT_ALAMAT_BUKA_BANK",$edit_alamat_buka_bank);
$smarty->assign ("EDIT_REK_BANK_BARU",$edit_rek_bank_baru);
$smarty->assign ("EDIT_NAMA_REK_BANK",$edit_nama_rek_bank);
$smarty->assign ("EDIT_KOTA_BANK",$edit_kota_bank);
$smarty->assign ("EDIT_VAL", $edit);

//var_dump($jenis_user) or die();
//$tahun = now();
 //var_dump($kode_perwakilan_cari)or die();
//if ($_GET['search'] == '1')
//{
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{

		  if($jenis_user=='1'){
                      
            $sql  = " SELECT *,
                    B.nama_agama,
                    C.departemen,
                    D.nama_cabang,
                    E.jabatan
                    from tbl_mast_pegawai A
                    LEFT JOIN tbl_mast_agama B ON A.kode_agama=B.kode_agama
                    LEFT JOIN tbl_mast_departemen C ON A.kode_departemen=C.kode_departemen
                    LEFT JOIN tbl_mast_cabang D ON D.kode_cabang=A.kode_cabang
                    LEFT JOIN tbl_mast_jabatan E ON A.kode_jabatan=E.kode_jabatan 
                    LEFT JOIN tbl_mast_status_karyawan F ON A.kode_status=F.kode_status  
                    LEFT JOIN tbl_mast_wil_propinsi G ON A.no_propinsi = G.no_propinsi ";

			} 
 else 
     
     if($jenis_user=='2'){
         
            $sql  = " SELECT *,
                    B.nama_agama,
                    C.departemen,
                    D.nama_cabang,
                    E.jabatan
                    from tbl_mast_pegawai A
                    LEFT JOIN tbl_mast_agama B ON A.kode_agama=B.kode_agama
                    LEFT JOIN tbl_mast_departemen C ON A.kode_departemen=C.kode_departemen
                    LEFT JOIN tbl_mast_cabang D ON D.kode_cabang=A.kode_cabang
                    LEFT JOIN tbl_mast_jabatan E ON A.kode_jabatan=E.kode_jabatan 
                    LEFT JOIN tbl_mast_status_karyawan F ON A.kode_status=F.kode_status  
                    LEFT JOIN tbl_mast_wil_propinsi G ON A.no_propinsi = G.no_propinsi where A.kode_cabang= '".$kode_pw_ses."'";
			} 

 
			if($kode_perwakilan_cari !=''){
					$sql .= "WHERE A.kode_cabang = '".$kode_perwakilan_cari."' ";
				}
                        if($nama_pegawai_cari!=''){
					$sql .= "AND A.nama LIKE '%".addslashes($nama_pegawai_cari)."%' ";
				} 
			 if($jabatan_pegawai_cari!=''){
					$sql .= "AND A.kode_jabatan = '%".(jabatan_pegawai_cari)."%' ";
				} 	
			 	$sql .= " ORDER BY  trim(nama) asc ";

			  if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
				$numresults=$db->Execute($sql);
                               // var_dump($sql)or die();
                             	$count = $numresults->RecordCount();
				$pages = $p->findPages($count,$LIMIT);
				$sql  .= "LIMIT ".$start.", ".$LIMIT;
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
				$count_all  = $start+$end;
				$next_prev = $p->nextPrevCustom($page, $pages, "ORDER=".$ORDER."&".$str_completer);
}


$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_KELURAHAN);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_KELURAHAN);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("TITLE", _TITLE_KEL);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_KEL);
$smarty->assign ("TB_CODE", _ID_KELURAHAN);
$smarty->assign ("TB_CODE_2", _ID_KELURAHAN);
$smarty->assign ("TB_NAMA_PROPINSI",_NAMA_PROPINSI);
$smarty->assign ("TB_NAMA_KABUPATEN",_NAMA_KABUPATEN);
$smarty->assign ("TB_NAMA_KECAMATAN",_NAMA_KECAMATAN);
$smarty->assign ("TB_NAMA_KELURAHAN",_NAMA_KELURAHAN);
$smarty->assign ("TB_NO_KELURAHAN",_NO_KELURAHAN);
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