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
$usr_name=$_SESSION['SESSION_NAMA'];
$usr_id=$_SESSION['SESSION_ID_PEG'];   
$jenis_user   =  $_SESSION['SESSION_JNS_USER'];
$kode_pw_ses  = $_SESSION['SESSION_KODE_CABANG'];
$group_session = $_SESSION['SESSION_GROUP'];


$tahun_ses_aktif=$_SESSION['SESSION_TAHUN_AKTIF'];
$bulan_ses_aktif=$_SESSION['SESSION_BULAN_AKTIF'];
$smarty->assign ("TAHUN_SES", $tahun_ses_aktif);
$smarty->assign ("BULAN_SES", $bulan_ses_aktif);


$smarty->assign ("JENIS_USER_SES", $jenis_user);
$smarty->assign ("KODE_PW_SES", $kode_pw_ses);
$smarty->assign ("NAMA_USER", $usr_name);
$smarty->assign ("GROUP_USER", $group_session);
$smarty->assign ("ID_USER", $usr_id);

//echo "JENIS USER".$_SESSION['SESSION_JNS_USER'];
//echo "<br>KODE PERWAKILAN".$_SESSION['SESSION_KODE_PERWAKILAN'];

#HREF
$smarty->assign ("HREF_HOME_PATH", $HREF_HOME);
$smarty->assign ("HREF_FOTO", $HREF_HOME.'/modules/ticketing/support_mdrp/uploads');
$smarty->assign ("HREF_HOME_PATH_AJAX", $HREF_HOME.'/modules/support_mdrp/ticketing');
$smarty->assign ("HREF_IMG_PATH", $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images'));
$smarty->assign ("HREF_CSS_PATH", $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/css'));
$smarty->assign ("HREF_JS_PATH", $HREF_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts'));

#DIR
$smarty->assign ("DIR_HOME_PATH", $DIR_HOME);
$smarty->assign ("DIR_IMG_PATH", $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images'));
$smarty->assign ("DIR_CSS_PATH", $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/css'));
$smarty->assign ("DIR_JS_PATH", $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts'));
$smarty->assign ("SELF", $_SERVER['PHP_SELF']);

//------------------------------------LOCAL CONFIG-----------------------------------------------//
#SETTING FOR TEMPLATE
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/ticketing/support_mdrp';
#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/ticketing');
$FILE_JS  = $JS_MODUL.'/support_mdrp';

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
$tbl_name	= "t_ticketing";

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

if ($_GET['status_cari']) $status_cari = $_GET['status_cari'];
else if ($_POST['status_cari']) $status_cari = $_POST['status_cari'];
else $status_cari="";

if ($_GET['ticket_cari']) $ticket_cari= $_GET['ticket_cari'];
else if ($_POST['ticket_cari']) $ticket_cari = $_POST['ticket_cari'];
else $ticket_cari="";


$smarty->assign ("BIDANG_CARI", $bidang_cari);
$smarty->assign ("NAMA_CARI", nama_cari);
$smarty->assign ("KODE_SUBCAB_CARI", $kode_subcab_cari);

$str_completer = "mod_id=".$mod_id."&limit=".$LIMIT."&SORT=".$SORT."&kode_perwakilan_cari=".$kode_subcab_cari."&kode_subcab_cari=".$kode_subcab_cari;
$str_completer_ = "limit=".$LIMIT."&SORT=".$SORT."&page=".$page;

//echo "<br><br><br><br><br><br><br><br><br><br>kode_perwakilan_cari".$kode_perwakilan_cari;
//-----------CLOSE DATA STATUS KARYAWAN--//
$current_month=date("m");
$current_year=date("Y");
$sub_current_month= substr($current_month, -2);
$sub_current_year = substr($current_year, -2);

//echo $current_year; die;

$array1=explode("-",$current_year);
$tahun_masuk    =   $array1[0];
$bulan_masuk    =   $array1[1];
$tgl_masuk      =   $array1[2];

$tahun_pinjam= substr($tahun_masuk,2,4);

$sql_cek_no="SELECT SUBSTR(MAX(A.ticketing__id),5,5) as no_pel FROM $tbl_name A";
//var_dump($sql_cek_no)or die();
$rs_val = $db->Execute($sql_cek_no);
$no_pel= $rs_val->fields[no_pel];
$idMax = $no_pel+1;
$newID =sprintf("%05s", $idMax);
//var_dump($newID) or die();
$smarty->assign ("ID_JAMINAN_NEW",$sub_current_year.''.$sub_current_month.''.$newID);
//-----------SHOW DATA CABANG----------------------//
$sql_cabang = "SELECT
B.priv_menu_id,
A.menu_id,
A.menu_label,
A.menu_link,
A.menu_level,
A.menu_parent,
A.menu_sort,
A.menu_active
FROM tbl_sys_master_menu A
INNER JOIN tbl_sys_master_privileges B ON A.menu_id=B.priv_menu_id
where B.priv_user_id='$usr_name' AND A.menu_level=0";


$result_cabang = $db->Execute($sql_cabang);
$initSet = array();
$data_cabang = array();
$z=0;
while ($arr=$result_cabang->FetchRow()) {
	array_push($data_cabang, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_PARENT", $data_cabang);
//---------------CLOSE DATA CABANG-------------------------//







if ($_GET[get_subcab2] == 1)
{

	$subcabang = $_GET[no_subcab];
			if($subcabang!=''){
					$sql_kabupaten = "SELECT
                                            B.priv_menu_id,
                                            A.menu_id,
                                            A.menu_label,
                                            A.menu_link,
                                            A.menu_level,
                                            A.menu_parent,
                                            A.menu_sort,
                                            A.menu_active
                                            FROM tbl_sys_master_menu A
                                            INNER JOIN tbl_sys_master_privileges B ON A.menu_id=B.priv_menu_id
                                            where B.priv_user_id='admin'  AND A.menu_active=1 AND A.menu_parent='$subcabang'";

                                        $recordSet_kabupaten = $db->Execute($sql_kabupaten);
					$input_kab="<select name=modul_child>";
					$input_kab.="<option value=''> ";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF):
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields[menu_id].">".$recordSet_kabupaten->fields['menu_label'];
						$input_kab.="</option>";
					$recordSet_kabupaten->MoveNext();
					endwhile;
					$input_kab.="</select> ";

					$delimeter   = "-";

					$option_choice = $input_kab."^/&".$delimeter;
					echo $option_choice;


			}
}
//---closer ajax subcabang2-----//


//-----------SHOW DATA DEPARTEMEN-----------------------//
$sql_departemen = "SELECT A.r_dept__id,A.r_dept__ket FROM r_departement A";
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
//-----------CLOSE DATA DEPARTEMEN-----------------------//

//-----------SHOW DATA SUBDEPARTEMEN-----------------------//
$sql_subdepartement = "SELECT A.r_subdept__id,A.r_subdept__dept,A.r_subdept__ket  FROM r_subdepartement A";
$result_subdepartement= $db->Execute($sql_subdepartement);
$initSet = array();
$data_subdepartement = array();
$z=0;
while ($arr=$result_subdepartement->FetchRow()) {
	array_push($data_subdepartement, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_SUBDEP", $data_subdepartement);
//-----------CLOSE DATA SUBDEPARTEMEN----------------------//




//----------- AJAX SUBDEP ------------------//
if ($_GET[get_subdep] == 1)
{
    	$subdep = $_GET[no_subdep];
            //var_dump($subdep) or die();
			if($subdep!=''){
					$sql_kabupaten = " SELECT dep.r_dept__id,dep.r_dept__akronim,dep.r_dept__ket,subdep.r_subdept__ket,subdep.r_subdept__id FROM r_departement dep LEFT JOIN r_subdepartement subdep ON subdep.r_subdept__dept=dep.r_dept__id  "
                                                . "where dep.r_dept__id=".$subdep." ORDER BY dep.r_dept__ket ASC";
                                        //var_dump($sql_kabupaten)or die();
                                        $recordSet_kabupaten = $db->Execute($sql_kabupaten);

					$input_kab="<select name=kode_subdep >";
					$input_kab.="<option value=''> ";
					$input_kab.="</option> ";
					while(!$recordSet_kabupaten->EOF):
						$input_kab.="<option value=";
						$input_kab.= $recordSet_kabupaten->fields[r_subdept__id].">".$recordSet_kabupaten->fields['r_subdept__ket'];
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
//------------closer AJAX SUBDEP----------------------------------------//








//---------------------Data_jabatan---------------------------

$sql_jabatan= "SELECT A.r_jabatan__id,A.r_jabatan__ket FROM r_jabatan A ";
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
$sql_bank = "SELECT * FROM r_bank order by r_bank__kode  ";
$result_bank = $db->Execute($sql_bank);
$initSet = array();
$data_bank = array();
$z=0;
while ($arr=$result_bank->FetchRow()) {
	array_push($data_bank, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_BANK", $data_bank);

//----------------------DATA LEVEL------------------------------
$sql_level = "SELECT * FROM r_level order by r_level__ket  ";
$result_level= $db->Execute($sql_level);

$initSet = array();
$data_level= array();
$z=0;
        while ($arr=$result_level->FetchRow()) {
	array_push($data_level, $arr);
	array_push($initSet, $z);
	$z++;
}
$smarty->assign ("DATA_LEVEL", $data_level);

//-----------------------VIEW EDIT ---------------------------------------//
$opt = $_GET[opt];

$ed = 0;
if($opt=="1"){

$sql_ = "SELECT
            r_penempatan.r_pnpt__nip AS r_pnpt__nip,
            r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
            r_penempatan.r_pnpt__jabatan AS r_pnpt__jabatan,
            r_penempatan.r_pnpt__id_pegawai AS r_pnpt__id_pegawai,
            r_penempatan.r_pnpt__status AS r_pnpt__status,
            r_penempatan.r_pnpt__tipe_salary AS r_pnpt__tipe_salary,
            r_penempatan.r_pnpt__subdept AS r_pnpt__subdept,
            r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
            r_penempatan.r_pnpt__gapok AS r_pnpt__gapok,
            r_penempatan.r_pnpt__subcab AS r_pnpt__subcab,
            r_penempatan.r_pnpt__shift AS r_pnpt__shift,
            r_penempatan.r_pnpt__kon_awal AS r_pnpt__kon_awal,
            r_penempatan.r_pnpt__kon_akhir AS r_pnpt__kon_akhir,
            r_penempatan.r_pnpt__aktif AS r_pnpt__aktif,
            r_penempatan.r_pnpt__pdrm AS r_pnpt__pdrm,
            r_jabatan.r_jabatan__id AS r_jabatan__id,
            r_jabatan.r_jabatan__ket AS r_jabatan__ket,
            r_subdepartement.r_subdept__id AS r_subdept__id,
            r_subdepartement.r_subdept__ket AS r_subdept__ket,
            r_departement.r_dept__akronim AS r_dept__akronim,
            r_departement.r_dept__id AS r_dept__id,
            r_departement.r_dept__ket AS r_dept__ket,
            r_subcabang.r_subcab__nama AS r_subcab__nama,
            r_cabang.r_cabang__nama AS r_cabang__nama,
            r_cabang.r_cabang__id AS r_cabang__id,
            r_subcabang.r_subcab__id AS r_subcab__id,
            r_subcabang.r_subcab__cabang AS r_subcab__cabang,
            r_pegawai.r_pegawai__id AS r_pegawai__id,
            r_pegawai.r_pegawai__nama AS r_pegawai__nama,
            r_pegawai.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
            r_pegawai.r_pegawai__ktp AS r_pegawai__ktp,
            t_ticketing.ticketing__id,
            t_ticketing.ticketing__module_parent,
            t_ticketing.ticketing__module_child,
            t_ticketing.ticketing__level_prioritas,
            t_ticketing.ticketing__deskripsi,
            t_ticketing.ticketing__estimasi,
            t_ticketing.ticketing__user,
            t_ticketing.ticketing__email,
            t_ticketing.ticketing__status,
            t_ticketing.ticketing__capture,
            t_ticketing.ticketing__helpdesk,
            t_ticketing.ticketing__date_created,
            t_ticketing.ticketing__date_updated,
            t_ticketing.ticketing__user_created,
            t_ticketing.ticketing__user_updated,
            tbl_sys_master_menu.menu_label AS LABEL_CHILD,
            tbl_sys_master_menu.menu_parent,
    (SELECT A.menu_label FROM tbl_sys_master_menu A WHERE
            A.menu_id=t_ticketing.ticketing__module_parent
    ) AS LABEL_PARENT


    FROM
            r_pegawai
    INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
    INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
    INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
    INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
    INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
    INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
    INNER JOIN t_ticketing ON t_ticketing.ticketing__user =r_penempatan.r_pnpt__id_pegawai
    INNER JOIN tbl_sys_master_menu ON tbl_sys_master_menu.menu_id=t_ticketing.ticketing__module_child
    WHERE ticketing__id ='".$_GET['id']."' ";

$resultSet = $db->Execute($sql_);
$edit_ticketing__id=$resultSet->fields[ticketing__id];
$edit_ticketing__nama=$resultSet->fields[r_pegawai__nama];
$edit_ticketing__user=$resultSet->fields[ticketing__user];
$edit_ticketing__module_parent=$resultSet->fields[ticketing__module_parent];
$edit_ticketing__module_child=$resultSet->fields[ticketing__module_child];
$edit_ticketing__level_prioritas=$resultSet->fields[ticketing__level_prioritas];
$edit_ticketing__deskripsi=$resultSet->fields[ticketing__deskripsi];
$edit_ticketing__estimasi=$resultSet->fields[ticketing__estimasi];
$edit_ticketing__email=$resultSet->fields[ticketing__email];
$edit_ticketing__status=$resultSet->fields[ticketing__status];
$edit_ticketing__capture=$resultSet->fields[ticketing__capture];
$edit_ticketing__helpdesk=$resultSet->fields[ticketing__helpdesk];
$edit_ticketing__date_created=$resultSet->fields[ticketing__date_created];
$edit_ticketing__date_updated=$resultSet->fields[ticketing__date_updated];
$edit_ticketing__user_created=$resultSet->fields[ticketing__user_created];
$edit_ticketing__user_updated=$resultSet->fields[ticketing__user_updated];

$edit = 1;


//-----------------DATA SUBMODUL-------------------------//and cab.r_cabang__id='$kode_pw_ses'
$sql_submodul = "SELECT
A.menu_id,
A.menu_label,
A.menu_link,
A.menu_level,
A.menu_parent,
A.menu_sort,
A.menu_active
FROM tbl_sys_master_menu A
WHERE A.menu_parent=$edit_ticketing__module_parent";

        $result_submodul = $db->Execute($sql_submodul);
        $initSet = array();
        $data_submodul = array();
        $z=0;
        while ($arr=$result_submodul->FetchRow()) {
                array_push($data_submodul, $arr);
                array_push($initSet, $z);
                $z++;
                        }
$smarty->assign ("DATA_SUBMODUL", $data_submodul);
//-----------------CLOSE DATA SUBCABANG------------//

}

//----------------CLOSE EDIT---------------------//
$smarty->assign ("OPT", $opt);
$smarty->assign ("EDIT_ID",$edit_ticketing__id);
$smarty->assign ("EDIT_ID_PENGIRIM",$edit_ticketing__user);
$smarty->assign ("EDIT_PARENT",$edit_ticketing__module_parent);
$smarty->assign ("EDIT_CHILD",$edit_ticketing__module_child);
$smarty->assign ("EDIT_PRIORITAS",$edit_ticketing__level_prioritas);
$smarty->assign ("EDIT_KET",$edit_ticketing__deskripsi);
$smarty->assign ("EDIT_ESTIMASI",$edit_ticketing__estimasi);
$smarty->assign ("EDIT_EMAIL",$edit_ticketing__email);
$smarty->assign ("EDIT_STATUS",$edit_ticketing__status);
$smarty->assign ("EDIT_GAMBAR",$edit_ticketing__capture);
$smarty->assign ("EDIT_SUPPORT",$edit_ticketing__helpdesk);
$smarty->assign ("EDIT_NAMA_PENGIRIM",$edit_ticketing__nama);


$smarty->assign ("EDIT_VAL", $edit);


//-----------------------CLOSE VIEW EDIT----------------------------------------------------------------------------------//
//$tahun = now();
//-----------------------------------------VIEW INDEX---------------------------------------------------------------------//
if ($_GET['search'] == '1')
    {
	if (Privi($mod_id, $user_id, 'search') != 'no')
	{

		  if($jenis_user=='2'){

                                        $sql  = "SELECT
                                                r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                                r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                                r_penempatan.r_pnpt__jabatan AS r_pnpt__jabatan,
                                                r_penempatan.r_pnpt__id_pegawai AS r_pnpt__id_pegawai,
                                                r_penempatan.r_pnpt__status AS r_pnpt__status,
                                                r_penempatan.r_pnpt__tipe_salary AS r_pnpt__tipe_salary,
                                                r_penempatan.r_pnpt__subdept AS r_pnpt__subdept,
                                                r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
                                                r_penempatan.r_pnpt__gapok AS r_pnpt__gapok,
                                                r_penempatan.r_pnpt__subcab AS r_pnpt__subcab,
                                                r_penempatan.r_pnpt__shift AS r_pnpt__shift,
                                                r_penempatan.r_pnpt__kon_awal AS r_pnpt__kon_awal,
                                                r_penempatan.r_pnpt__kon_akhir AS r_pnpt__kon_akhir,
                                                r_penempatan.r_pnpt__aktif AS r_pnpt__aktif,
                                                r_penempatan.r_pnpt__pdrm AS r_pnpt__pdrm,
                                                r_jabatan.r_jabatan__id AS r_jabatan__id,
                                                r_jabatan.r_jabatan__ket AS r_jabatan__ket,
                                                r_subdepartement.r_subdept__id AS r_subdept__id,
                                                r_subdepartement.r_subdept__ket AS r_subdept__ket,
                                                r_departement.r_dept__akronim AS r_dept__akronim,
                                                r_departement.r_dept__id AS r_dept__id,
                                                r_departement.r_dept__ket AS r_dept__ket,
                                                r_subcabang.r_subcab__nama AS r_subcab__nama,
                                                r_cabang.r_cabang__nama AS r_cabang__nama,
                                                r_cabang.r_cabang__id AS r_cabang__id,
                                                r_subcabang.r_subcab__id AS r_subcab__id,
                                                r_subcabang.r_subcab__cabang AS r_subcab__cabang,
                                                r_pegawai.r_pegawai__id AS r_pegawai__id,
                                                r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                                                r_pegawai.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
                                                r_pegawai.r_pegawai__ktp AS r_pegawai__ktp,
                                                t_ticketing.ticketing__id,
                                                t_ticketing.ticketing__module_parent,
                                                t_ticketing.ticketing__module_child,
                                                t_ticketing.ticketing__level_prioritas,
                                                t_ticketing.ticketing__deskripsi,
                                                t_ticketing.ticketing__estimasi,
                                                t_ticketing.ticketing__user,
                                                t_ticketing.ticketing__email,
                                                t_ticketing.ticketing__status,
                                                t_ticketing.ticketing__capture,
                                                t_ticketing.ticketing__date_created,
                                                t_ticketing.ticketing__date_updated,
                                                t_ticketing.ticketing__user_created,
                                                t_ticketing.ticketing__user_updated,
                                                tbl_sys_master_menu.menu_label AS LABEL_CHILD,
                                                tbl_sys_master_menu.menu_parent,
                                        (SELECT A.menu_label FROM tbl_sys_master_menu A WHERE
                                                A.menu_id=t_ticketing.ticketing__module_parent
                                        ) AS LABEL_PARENT


                                        FROM
                                                r_pegawai
                                        INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                        INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                        INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                        INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                        INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                        INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                        INNER JOIN t_ticketing ON t_ticketing.ticketing__user =r_penempatan.r_pnpt__id_pegawai
                                        INNER JOIN tbl_sys_master_menu ON tbl_sys_master_menu.menu_id=t_ticketing.ticketing__module_child
                                        WHERE r_cabang__id = '".$kode_pw_ses."' ";



            } else {
                                                   $sql  = "SELECT
                                                r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                                r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                                r_penempatan.r_pnpt__jabatan AS r_pnpt__jabatan,
                                                r_penempatan.r_pnpt__id_pegawai AS r_pnpt__id_pegawai,
                                                r_penempatan.r_pnpt__status AS r_pnpt__status,
                                                r_penempatan.r_pnpt__tipe_salary AS r_pnpt__tipe_salary,
                                                r_penempatan.r_pnpt__subdept AS r_pnpt__subdept,
                                                r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
                                                r_penempatan.r_pnpt__gapok AS r_pnpt__gapok,
                                                r_penempatan.r_pnpt__subcab AS r_pnpt__subcab,
                                                r_penempatan.r_pnpt__shift AS r_pnpt__shift,
                                                r_penempatan.r_pnpt__kon_awal AS r_pnpt__kon_awal,
                                                r_penempatan.r_pnpt__kon_akhir AS r_pnpt__kon_akhir,
                                                r_penempatan.r_pnpt__aktif AS r_pnpt__aktif,
                                                r_penempatan.r_pnpt__pdrm AS r_pnpt__pdrm,
                                                r_jabatan.r_jabatan__id AS r_jabatan__id,
                                                r_jabatan.r_jabatan__ket AS r_jabatan__ket,
                                                r_subdepartement.r_subdept__id AS r_subdept__id,
                                                r_subdepartement.r_subdept__ket AS r_subdept__ket,
                                                r_departement.r_dept__akronim AS r_dept__akronim,
                                                r_departement.r_dept__id AS r_dept__id,
                                                r_departement.r_dept__ket AS r_dept__ket,
                                                r_subcabang.r_subcab__nama AS r_subcab__nama,
                                                r_cabang.r_cabang__nama AS r_cabang__nama,
                                                r_cabang.r_cabang__id AS r_cabang__id,
                                                r_subcabang.r_subcab__id AS r_subcab__id,
                                                r_subcabang.r_subcab__cabang AS r_subcab__cabang,
                                                r_pegawai.r_pegawai__id AS r_pegawai__id,
                                                r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                                                r_pegawai.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
                                                r_pegawai.r_pegawai__ktp AS r_pegawai__ktp,
                                                t_ticketing.ticketing__id,
                                                t_ticketing.ticketing__module_parent,
                                                t_ticketing.ticketing__module_child,
                                                t_ticketing.ticketing__level_prioritas,
                                                t_ticketing.ticketing__deskripsi,
                                                t_ticketing.ticketing__estimasi,
                                                t_ticketing.ticketing__user,
                                                t_ticketing.ticketing__email,
                                                t_ticketing.ticketing__status,
                                                t_ticketing.ticketing__capture,
                                                t_ticketing.ticketing__date_created,
                                                t_ticketing.ticketing__date_updated,
                                                t_ticketing.ticketing__user_created,
                                                t_ticketing.ticketing__user_updated,
                                                tbl_sys_master_menu.menu_label AS LABEL_CHILD,
                                                tbl_sys_master_menu.menu_parent,
                                        (SELECT A.menu_label FROM tbl_sys_master_menu A WHERE
                                                A.menu_id=t_ticketing.ticketing__module_parent
                                        ) AS LABEL_PARENT


                                        FROM
                                                r_pegawai
                                        INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                        INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                        INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                        INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                        INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                        INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                        INNER JOIN t_ticketing ON t_ticketing.ticketing__user =r_penempatan.r_pnpt__id_pegawai
                                        INNER JOIN tbl_sys_master_menu ON tbl_sys_master_menu.menu_id=t_ticketing.ticketing__module_child
                                        WHERE 1=1 ";

            }

				//echo "<br><br><br><br><br><br><br><br><br><br>dddddddddkode_perwakilan_cari ===".$kode_perwakilan_cari;



				if($status_cari !=''){
					$sql .= " AND ticketing__status = '".$status_cari."' ";
				}
				
                               
                                if($ticket_cari!=''){

                                        $sql .= " AND ticketing__id ='".addslashes($ticket_cari)."'";
				}



			 	$sql .= " ORDER BY  trim(ticketing__id) Desc ";

                                if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);

                                $numresults=$db->Execute($sql);
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

}
else

{


			if($jenis_user=='2'){

                                     $sql  = "SELECT
                                                r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                                r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                                r_penempatan.r_pnpt__jabatan AS r_pnpt__jabatan,
                                                r_penempatan.r_pnpt__id_pegawai AS r_pnpt__id_pegawai,
                                                r_penempatan.r_pnpt__status AS r_pnpt__status,
                                                r_penempatan.r_pnpt__tipe_salary AS r_pnpt__tipe_salary,
                                                r_penempatan.r_pnpt__subdept AS r_pnpt__subdept,
                                                r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
                                                r_penempatan.r_pnpt__gapok AS r_pnpt__gapok,
                                                r_penempatan.r_pnpt__subcab AS r_pnpt__subcab,
                                                r_penempatan.r_pnpt__shift AS r_pnpt__shift,
                                                r_penempatan.r_pnpt__kon_awal AS r_pnpt__kon_awal,
                                                r_penempatan.r_pnpt__kon_akhir AS r_pnpt__kon_akhir,
                                                r_penempatan.r_pnpt__aktif AS r_pnpt__aktif,
                                                r_penempatan.r_pnpt__pdrm AS r_pnpt__pdrm,
                                                r_jabatan.r_jabatan__id AS r_jabatan__id,
                                                r_jabatan.r_jabatan__ket AS r_jabatan__ket,
                                                r_subdepartement.r_subdept__id AS r_subdept__id,
                                                r_subdepartement.r_subdept__ket AS r_subdept__ket,
                                                r_departement.r_dept__akronim AS r_dept__akronim,
                                                r_departement.r_dept__id AS r_dept__id,
                                                r_departement.r_dept__ket AS r_dept__ket,
                                                r_subcabang.r_subcab__nama AS r_subcab__nama,
                                                r_cabang.r_cabang__nama AS r_cabang__nama,
                                                r_cabang.r_cabang__id AS r_cabang__id,
                                                r_subcabang.r_subcab__id AS r_subcab__id,
                                                r_subcabang.r_subcab__cabang AS r_subcab__cabang,
                                                r_pegawai.r_pegawai__id AS r_pegawai__id,
                                                r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                                                r_pegawai.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
                                                r_pegawai.r_pegawai__ktp AS r_pegawai__ktp,
                                                t_ticketing.ticketing__id,
                                                t_ticketing.ticketing__module_parent,
                                                t_ticketing.ticketing__module_child,
                                                t_ticketing.ticketing__level_prioritas,
                                                t_ticketing.ticketing__deskripsi,
                                                t_ticketing.ticketing__estimasi,
                                                t_ticketing.ticketing__user,
                                                t_ticketing.ticketing__email,
                                                t_ticketing.ticketing__status,
                                                t_ticketing.ticketing__capture,
                                                t_ticketing.ticketing__date_created,
                                                t_ticketing.ticketing__date_updated,
                                                t_ticketing.ticketing__user_created,
                                                t_ticketing.ticketing__user_updated,
                                                tbl_sys_master_menu.menu_label AS LABEL_CHILD,
                                                tbl_sys_master_menu.menu_parent,
                                        (SELECT A.menu_label FROM tbl_sys_master_menu A WHERE
                                                A.menu_id=t_ticketing.ticketing__module_parent
                                        ) AS LABEL_PARENT


                                        FROM
                                                r_pegawai
                                        INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                        INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                        INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                        INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                        INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                        INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                        INNER JOIN t_ticketing ON t_ticketing.ticketing__user =r_penempatan.r_pnpt__id_pegawai
                                        INNER JOIN tbl_sys_master_menu ON tbl_sys_master_menu.menu_id=t_ticketing.ticketing__module_child
                                        WHERE r_cabang__id = '".$kode_pw_ses."' ";


			} else {
                                                $sql  = "SELECT
                                                r_penempatan.r_pnpt__nip AS r_pnpt__nip,
                                                r_penempatan.r_pnpt__no_mutasi AS r_pnpt__no_mutasi,
                                                r_penempatan.r_pnpt__jabatan AS r_pnpt__jabatan,
                                                r_penempatan.r_pnpt__id_pegawai AS r_pnpt__id_pegawai,
                                                r_penempatan.r_pnpt__status AS r_pnpt__status,
                                                r_penempatan.r_pnpt__tipe_salary AS r_pnpt__tipe_salary,
                                                r_penempatan.r_pnpt__subdept AS r_pnpt__subdept,
                                                r_penempatan.r_pnpt__finger_print AS r_pnpt__finger_print,
                                                r_penempatan.r_pnpt__gapok AS r_pnpt__gapok,
                                                r_penempatan.r_pnpt__subcab AS r_pnpt__subcab,
                                                r_penempatan.r_pnpt__shift AS r_pnpt__shift,
                                                r_penempatan.r_pnpt__kon_awal AS r_pnpt__kon_awal,
                                                r_penempatan.r_pnpt__kon_akhir AS r_pnpt__kon_akhir,
                                                r_penempatan.r_pnpt__aktif AS r_pnpt__aktif,
                                                r_penempatan.r_pnpt__pdrm AS r_pnpt__pdrm,
                                                r_jabatan.r_jabatan__id AS r_jabatan__id,
                                                r_jabatan.r_jabatan__ket AS r_jabatan__ket,
                                                r_subdepartement.r_subdept__id AS r_subdept__id,
                                                r_subdepartement.r_subdept__ket AS r_subdept__ket,
                                                r_departement.r_dept__akronim AS r_dept__akronim,
                                                r_departement.r_dept__id AS r_dept__id,
                                                r_departement.r_dept__ket AS r_dept__ket,
                                                r_subcabang.r_subcab__nama AS r_subcab__nama,
                                                r_cabang.r_cabang__nama AS r_cabang__nama,
                                                r_cabang.r_cabang__id AS r_cabang__id,
                                                r_subcabang.r_subcab__id AS r_subcab__id,
                                                r_subcabang.r_subcab__cabang AS r_subcab__cabang,
                                                r_pegawai.r_pegawai__id AS r_pegawai__id,
                                                r_pegawai.r_pegawai__nama AS r_pegawai__nama,
                                                r_pegawai.r_pegawai__tgl_masuk AS r_pegawai__tgl_masuk,
                                                r_pegawai.r_pegawai__ktp AS r_pegawai__ktp,
                                                t_ticketing.ticketing__id,
                                                t_ticketing.ticketing__module_parent,
                                                t_ticketing.ticketing__module_child,
                                                t_ticketing.ticketing__level_prioritas,
                                                t_ticketing.ticketing__deskripsi,
                                                t_ticketing.ticketing__estimasi,
                                                t_ticketing.ticketing__user,
                                                t_ticketing.ticketing__email,
                                                t_ticketing.ticketing__status,
                                                t_ticketing.ticketing__capture,
                                                t_ticketing.ticketing__helpdesk,
                                                t_ticketing.ticketing__date_created,
                                                t_ticketing.ticketing__date_updated,
                                                t_ticketing.ticketing__user_created,
                                                t_ticketing.ticketing__user_updated,
                                                tbl_sys_master_menu.menu_label AS LABEL_CHILD,
                                                tbl_sys_master_menu.menu_parent,
                                        (SELECT A.menu_label FROM tbl_sys_master_menu A WHERE
                                                A.menu_id=t_ticketing.ticketing__module_parent
                                        ) AS LABEL_PARENT


                                        FROM
                                                r_pegawai
                                        INNER JOIN r_penempatan ON r_penempatan.r_pnpt__id_pegawai = r_pegawai.r_pegawai__id
                                        INNER JOIN r_jabatan ON r_penempatan.r_pnpt__jabatan = r_jabatan.r_jabatan__id
                                        INNER JOIN r_subdepartement ON r_penempatan.r_pnpt__subdept = r_subdepartement.r_subdept__id
                                        INNER JOIN r_subcabang ON r_penempatan.r_pnpt__subcab = r_subcabang.r_subcab__id
                                        INNER JOIN r_departement ON r_departement.r_dept__id = r_subdepartement.r_subdept__dept
                                        INNER JOIN r_cabang ON r_cabang.r_cabang__id = r_subcabang.r_subcab__cabang
                                        INNER JOIN t_ticketing ON t_ticketing.ticketing__user =r_penempatan.r_pnpt__id_pegawai
                                        INNER JOIN tbl_sys_master_menu ON tbl_sys_master_menu.menu_id=t_ticketing.ticketing__module_child
                                        WHERE 1=1 ";

			}

				if($status_cari !=''){
					$sql .= " AND ticketing__status = '".$status_cari."' ";
				}
				

                                if($ticketing_cari!=''){

                                        $sql .= " AND ticketing__id ='".addslashes($ticketing_cari)."'";
				}
				$sql .= " ORDER BY  trim(ticketing__id) Desc ";

				if ($_GET['page']) $start = $p->findStartGet($LIMIT); else $start = $p->findStartPost($LIMIT);
                                $numresults=$db->Execute($sql);
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
//---------------------------------CLOSE VIEW INDEX---------------------------------------------------------------------//

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
