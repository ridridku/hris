<?php
ini_set("session.gc_maxlifetime",432000);
$MAIN_PROP	= 71 ;
$DIR_HOME	=$_SERVER['DOCUMENT_ROOT']."/hris";
$DIR_INC	=$DIR_HOME."/includes";
$DIR_MOD	=$DIR_HOME."/modules";
$DIR_LANG	=$DIR_HOME."/languages";
$DIR_SESS	=$DIR_HOME."/session";
$DIR_JS		=$DIR_HOME."/javascripts";
$DIR_THEME	=$DIR_HOME."/themes";
$DIR_ADODB	=$DIR_HOME."/adodb";
$DIR_GAMBAR	=$DIR_HOME."/gambar";
$DIR_BACKUP	=$DIR_HOME."/backup_db";
$DIR_JPGRAPH    =$DIR_HOME."/jpgraph";
$DIR_UPLOAD	=$DIR_HOME."/uploads";

//$PATH_MYSQL = "C:\\_ApacheServer\\mysql\\bin\\";

//$DIR_ADODB = $_SERVER[DOCUMENT_ROOT]."/../adodb";

# Special Configuration for ADODB Cache
$ADODB_CACHE_DIR	=$DIR_HOME."/adodb_cache";

# Main Configuration for Smarty Template Engine
define ("SMARTY_DIR", $DIR_HOME."/libs/");
define ("COMPILE_DIR", $DIR_HOME."/compile/");
define ("TEMPLATE_DIR", $DIR_HOME."/themes/");
define ("CACHE_DIR", $DIR_HOME."/cache/");

# Main Configuration for address referring

$HREF_HOME	="http://".$_SERVER['HTTP_HOST']."/hris";
$HREF_INC	=$HREF_HOME."/includes";
$HREF_MOD	=$HREF_HOME."/modules";
$HREF_LANG	=$HREF_HOME."/languages";
$HREF_SESS	=$HREF_HOME."/session";
$HREF_JS	=$HREF_HOME."/javascripts";
$HREF_THEME	=$HREF_HOME."/themes";
$HREF_ADODB	=$HREF_HOME."/adodb";
$HREF_JPGRAPH	=$HREF_HOME."/jpgraph";
$HREF_UPLOADS	=$HREF_HOME."/uploads";

$DOC_SELF_NAME	=$_SERVER['PHP_SELF'];
$DOC_PARSE_URL = parse_url($DOC_SELF_NAME);
$DOC_SELF_ONLY = basename($DOC_PARSE_URL[path]); 

# Get name length from index.php = "index"
$DOC_SELF_NAME_ONLY	=substr(basename($DOC_SELF_NAME), 0,-4); 
$DOC_SELF_PATH = substr($DOC_SELF_NAME, 0,-strlen(basename($DOC_SELF_NAME))); 

require_once("class.priv.php");

/*-- Start of Paging --------------*/
$arrayName = array("1", "5", "10", "20", "50", "100","1000");
$nLimit = "50";
/*-- End of Paging --------------*/

/*** Disabled on 14-09-2010
$_CONF['PR']=11;  // <11
$_CONF['PM']=23;  // 11-23
$_CONF['PK']=23;  // >23
***/
$_CONF['PR']=11; 
$_CONF['PM']=16; 
$_CONF['PK']=16; 

$_DATA[no_propinsi] = 64;

define("_SUBMIT2","LOGIN");

/*** Array ***/
$stat_system = array(
	"primer"=>"Primer (Antar kota)",
	"sekunder"=>"Sekunder (Perkotaan)"
	);
	
$stat_fungsi = array(
	"A"=>"Arteri",
	"K"=>"Kolektor",
	"L"=>"Lokal"
	);

$stat_cabang = array(
	    "1"=>"Pusat",
            "2"=>"Bandung",
            "3"=>"Cirebon",
            "4"=>"Subang",
            "5"=>"Sukabumi",
            "6"=>"Tasik",
            "7"=>"Magelang",
            "8"=>"Pati",
            "9"=>"Purwokerto",
            "10"=>"Semarang",
            "11"=>"Solo",
            "12"=>"Tegal",
            "1"=>"Yogya"
    );




$daftar_bulan	= array(
    "00"=>"[Pilih Bulan]",
	"01"=>"Januari",
	"02"=>"Februari",
	"03"=>"Maret",
	"04"=>"April",
	"05"=>"Mei",
	"06"=>"Juni",
	"07"=>"Juli",
	"08"=>"Agustus",
	"09"=>"September",
	"10"=>"Oktober",
	"11"=>"Nopember",
	"12"=>"Desember"
	);
	
$daftar_status_progres = array(
	"1"=>"Proses lelang",	
	"2"=>"Proses Pelaksanaan Fisik",
	"3"=>"Selesai Dalam Masa Pemeliharaan",
	"4"=>"Selesai sampai FHO");
	//samapi
$daftar_tanggal = array(
	"00"=>"[Pilih Tanggal]",	
	"01"=>"1",
	"02"=>"2",
	"03"=>"3",
	"04"=>"4",
	"05"=>"5",
	"06"=>"6",
	"07"=>"7",
	"08"=>"8",
	"09"=>"9",
	"10"=>"10",
	"11"=>"11",
	"12"=>"12",
	"13"=>"13",
	"14"=>"14",
	"15"=>"15",
	"16"=>"16",
	"17"=>"17",
	"18"=>"18",
	"19"=>"19",
	"20"=>"20",
	"21"=>"21",
	"22"=>"22",
	"23"=>"23",
	"24"=>"24",
	"25"=>"25",
	"26"=>"26",
	"27"=>"27",
	"28"=>"28",
	"29"=>"29",
	"30"=>"30",
	"31"=>"31" );

        function TanggalIndo($date){
	$BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
 
	$tahun = substr($date, 0, 4);
	$bulan = substr($date, 5, 2);
	$tgl   = substr($date, 8, 2);
 
	$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
	return($result);
}

//function Dibaca($x) {
//                $angkaBaca = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
//                switch ($x) {
//                    case ($x < 12):
//                        echo " (" . $angkaBaca[$x].")";
//                        break;
//                    case ($x < 20):
//                        echo $result = Dibaca($x - 10) . " belas";
//                        break;
//                    case ($x < 100):
//                        echo Dibaca($x / 10);
//                        echo " puluh ";
//                        echo Dibaca($x % 10);
//                        break;
//                    case ($x < 200):
//                        echo " seratus ";
//                        echo Dibaca($x - 100);
//                        break;
//                    case ($x < 1000):
//                        echo Dibaca($x / 100);
//                        echo " ratus";
//                        echo Dibaca($x % 100);
//                        break;
//                    case ($x < 2000):
//                        echo " seribu ";
//                        echo Dibaca($x - 1000);
//                        break;
//                    case ($x < 1000000):
//                        echo Dibaca($x / 1000);
//                        echo " ribu ";
//                        echo Dibaca($x % 1000);
//                        break;
//                    case ($x < 1000000000):
//                        echo Dibaca($x / 1000000);
//                        echo " juta ";
//                        echo Dibaca($x % 1000000);
//                        break;
//                }
//            }
function tampil_bulan ($x) {
    if ($x == 1 ) {
        $bulan = "Januari"; }
    if ($x == 2 ) {
        $bulan = "Februari"; }
    if ($x == 3 ) {
        $bulan = "Maret"; }
    if ($x == 4 ) {
        $bulan = "April"; }
    if ($x == 5 ) {
        $bulan = "Mei"; }
    if ($x == 6 ) {
        $bulan = "Juni"; }
    if ($x == 7 ) {
        $bulan = "Juli"; }
    if ($x == 8 ) {
        $bulan = "Agustus"; }
    if ($x == 9 ) {
        $bulan = "September"; }
    if ($x == 10) {
        $bulan = "Oktober"; }
    if ($x == 11) {
        $bulan = "November"; }
    if ($x == 12) {
        $bulan = "Desember"; }
    return $bulan;
}
/*** End 0f Array***/



function encrypt_url($string) {
  $key = "MAL_979805"; //key to encrypt and decrypts.
  $result = '';
  $test = "";
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)+ord($keychar));

     $test[$char]= ord($char)+ord($keychar);
     $result.=$char;
   }

   return urlencode(base64_encode($result));
}

function decrypt_url($string) {
    $key = "MAL_979805"; //key to encrypt and decrypts.
    $result = '';
    $string = base64_decode(urldecode($string));
   for($i=0; $i<strlen($string); $i++) {
     $char = substr($string, $i, 1);
     $keychar = substr($key, ($i % strlen($key))-1, 1);
     $char = chr(ord($char)-ord($keychar));
     $result.=$char;
   }
   }
   
function encrypt($pure_string) {
    $dirty = array("+", "/", "=");
    $clean = array("_PLUS_", "_SLASH_", "_EQUALS_");
    $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
    $_SESSION['iv'] = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $_SESSION['encryption-key'], utf8_encode($pure_string), MCRYPT_MODE_ECB, $_SESSION['iv']);
    $encrypted_string = base64_encode($encrypted_string);
    return str_replace($dirty, $clean, $encrypted_string);
}

function decrypt($encrypted_string) { 
    $dirty = array("+", "/", "=");
    $clean = array("_PLUS_", "_SLASH_", "_EQUALS_");

    $string = base64_decode(str_replace($clean, $dirty, $encrypted_string));

    $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $_SESSION['encryption-key'],$string, MCRYPT_MODE_ECB, $_SESSION['iv']);
    return $decrypted_string;
}



function encryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decryptIt( $q ) {
    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}
    
   
function namahari($tanggal){
    
  
    $tgl=substr($tanggal,8,2);
    $bln=substr($tanggal,5,2);
    $thn=substr($tanggal,0,4);

    $info=date('w', mktime(0,0,0,$bln,$tgl,$thn));
    
    switch($info){
        case '0': return "Minggu"; break;
        case '1': return "Senin"; break;
        case '2': return "Selasa"; break;
        case '3': return "Rabu"; break;
        case '4': return "Kamis"; break;
        case '5': return "Jumat"; break;
        case '6': return "Sabtu"; break;
    };
    
}


 function convertrupiah($angka)
    {
            $jadi = "Rp " . number_format($angka,2,',','.');
            return $jadi;
    }


function datediff( $date1, $date2 )
    {
        $diff = abs( strtotime( $date1 ) - strtotime( $date2 ) );

        return sprintf
        (
           "%d:%d:%d",
         //   intval( $diff / 86400 ),
            intval( ( $diff % 86400 ) / 3600),
            intval( ( $diff / 60 ) % 60 ),
            intval( $diff % 60 )
        );
    }

?>