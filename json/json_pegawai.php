<?PHP
header("Content-Type: application/json;charset=utf-8");
if($_SERVER['REQUEST_METHOD'] == "POST")
{
require_once('../includes/config.conf.php');

# Create a session to store global config path
session_save_path($DIR_SESS);
session_set_cookie_params($expiry);
session_start();
require_once('../includes/db.conf.php');
require_once('../adodb/adodb.inc.php');
require_once('../includes/config.conf.php');

$db = &ADONewConnection($DB_TYPE);
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);

$periode2= $_POST['periode'];
$kunci2= $_POST['kunci'];

  

if($kunci2=='tmw2016')
{

   $sql="SELECT * from r_pegawai where r_pegawai__date_updated >= '".$periode2."'";
   $rs_paging	= $db->execute($sql);


$rs2	= $db->execute($sql);
$list_arr_satuan = array();
$arrTmp = array();
$hasil=array();
		
$i=0;$z=1;
while($arr=$rs2->FetchRow()){
	array_push($list_arr_satuan, $arr); 
	
            $arrTmp["r_pegawai__id"]=$arr["r_pegawai__id"];
            $arrTmp["r_pegawai__nama"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__nama"]));
            $arrTmp["r_pegawai__tgl_lahir"]=$arr["r_pegawai__tgl_lahir"];
            $arrTmp["r_pegawai__tmpt_lahir"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__tmpt_lahir"]));
            $arrTmp["r_pegawai__jk"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__jk"]));
            $arrTmp["r_pegawai__ktp"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ktp"]));
            $arrTmp["r_pegawai__sim"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__sim"]));
            $arrTmp["r_pegawai__nama_jalan"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__nama_jalan"]));
            $arrTmp["r_pegawai__ktp_prov"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ktp_prov"]));
            $arrTmp["r_pegawai__ktp_kab"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ktp_kab"]));
            $arrTmp["r_pegawai__ktp_kec"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ktp_kec"]));
            $arrTmp["r_pegawai__ktp_desa"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ktp_desa"]));
            $arrTmp["r_pegawai__ktp_rt"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ktp_rt"]));
            $arrTmp["r_pegawai__ktp_rw"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ktp_rw"]));
            $arrTmp["r_pegawai__ktp_kodepos"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ktp_kodepos"]));
            $arrTmp["r_pegawai__alm_prov"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__alm_prov"]));
            $arrTmp["r_pegawai__alm_kab"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__alm_kab"]));
            $arrTmp["r_pegawai__alm_kec"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__alm_kec"]));
            $arrTmp["r_pegawai__alm_desa"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__alm_desa"]));
            $arrTmp["r_pegawai__alm_rt"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__alm_rt"]));
            $arrTmp["r_pegawai__alm_rw"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__alm_rw"]));
            $arrTmp["r_pegawai__alm_kodepos"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__alm_kodepos"]));
            $arrTmp["r_pegawai__tlp_rumah"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__tlp_rumah"]));
            $arrTmp["r_pegawai__tlp_pribadi"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__tlp_pribadi"]));
            $arrTmp["r_pegawai__tlp_kantor"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__tlp_kantor"]));
            $arrTmp["r_pegawai__gol_darah"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__gol_darah"]));
            $arrTmp["r_pegawai__agama"]=$arr["r_pegawai__agama"];
            $arrTmp["r_pegawai__tinggi"]=$arr["r_pegawai__tinggi"];
            $arrTmp["r_pegawai__berat"]=$arr["r_pegawai__berat"];
            $arrTmp["r_pegawai__ayah"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ayah"]));
            $arrTmp["r_pegawai__ibu"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ibu"]));
            $arrTmp["r_pegawai__ortu_prov"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ortu_prov"]));
            $arrTmp["r_pegawai__ortu_kab"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ortu_kab"]));
            $arrTmp["r_pegawai__ortu_kec"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ortu_kec"]));
            $arrTmp["r_pegawai__ortu_desa"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ortu_desa"]));
            $arrTmp["r_pegawai__ortu_rt"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ortu_rt"]));
            $arrTmp["r_pegawai__ortu_rw"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ortu_rw"]));
            $arrTmp["r_pegawai__ortu_kodepos"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__ortu_kodepos"]));
            $arrTmp["r_pegawai__npwp"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__npwp"]));
            $arrTmp["r_pegawai__no_bpjs"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__no_bpjs"]));
            $arrTmp["r_pegawai__no_askes"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__no_askes"]));
            $arrTmp["r_pegawai__bank1"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__bank1"]));
            $arrTmp["r_pegawai__bank1_rek"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__bank1_rek"]));
            $arrTmp["r_pegawai__bank1_norek"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__bank1_norek"]));
            $arrTmp["r_pegawai__bank1_alm"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__bank1_alm"]));
            $arrTmp["r_pegawai__bank2"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__bank2"]));
            $arrTmp["r_pegawai__bank2_rek"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__bank2_rek"]));
            $arrTmp["r_pegawai__bank2_norek"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__bank2_norek"]));
            $arrTmp["r_pegawai__bank2_alm"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__bank2_alm"]));
            $arrTmp["r_pegawai__pasangan"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pasangan"]));

            $arrTmp["r_pegawai__pas_tgllahir"]=$arr["r_pegawai__pas_tgllahir"];
            $arrTmp["r_pegawai__pas_tmptlahir"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pas_tmptlahir"]));
            $arrTmp["r_pegawai__pas_prov"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pas_prov"]));
            $arrTmp["r_pegawai__pas_kab"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pas_kab"]));
            $arrTmp["r_pegawai__pas_kec"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pas_kec"]));
            $arrTmp["r_pegawai__pas_desa"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pas_desa"]));
            $arrTmp["r_pegawai__pas_rt"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pas_rt"]));
            $arrTmp["r_pegawai__pas_rw"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pas_rw"]));
            $arrTmp["r_pegawai__pas_kodepos"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pas_kodepos"]));
            $arrTmp["r_pegawai__pas_tlp"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pas_tlp"]));
            $arrTmp["r_pegawai__pas_jml_anak"]=$arr["r_pegawai__pas_jml_anak"];
            $arrTmp["r_pegawai__pas_anak1"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pas_anak1"]));
            $arrTmp["r_pegawai__pas_anak2"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pas_anak2"]));
            $arrTmp["r_pegawai__pas_anak3"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pas_anak3"]));
            $arrTmp["r_pegawai__photo"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__photo"]));
            $arrTmp["r_pegawai__status_kawin"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__status_kawin"]));
            $arrTmp["r_pegawai__tgl_masuk"]=$arr["r_pegawai__tgl_masuk"];
            $arrTmp["r_pegawai__id_subcab"]=$arr["r_pegawai__id_subcab"];
            $arrTmp["r_pegawai__subdept"]=$arr["r_pegawai__subdept"];
            $arrTmp["r_pegawai__jabatan"]=$arr["r_pegawai__jabatan"];
            $arrTmp["r_pegawai__st_pegawai"]=$arr["r_pegawai__st_pegawai"];
            $arrTmp["r_pegawai__pend_tgl_lulus"]=$arr["r_pegawai__pend_tgl_lulus"];
            $arrTmp["r_pegawai__pend_akhir"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pend_akhir"]));
            $arrTmp["r_pegawai__pend_sekolah"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pend_sekolah"]));
            $arrTmp["r_pegawai__pend_jurusan"]=preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__pend_jurusan"]));
            $arrTmp["r_pegawai__date_created"]=$arr["r_pegawai__date_created"];
            $arrTmp["r_pegawai__date_updated"]=$arr["r_pegawai__date_updated"];
            $arrTmp["r_pegawai__user_created"]==preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__user_created"]));
            $arrTmp["r_pegawai__user_updated"]==preg_replace('/[\x00-\x1F\x80-\xFF]/', '',utf8_encode($arr["r_pegawai__user_updated"]));
            $hasil[$i]=$arrTmp;	
            $i++;
}
echo json_encode($hasil);


}
}
?>

