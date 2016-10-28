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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/kpi/kpi_verifikasi';


$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/kpi');
$FILE_JS  = $JS_MODUL.'/kpi_verifikasi';
if($_POST['mod_id'])
{
		$mod_id = $_POST['mod_id'];
}else
{
		$mod_id = $_GET['mod_id'];
}
$user_id = base64_decode($_SESSION['UID']);

       

#Initiate TABLE
$tbl_name	= "r_kpi";




//-----------------------------------END OF LOCAL CONFIG-------------------------------//

function delete_(){
global $mod_id;
global $db;

$sql  ="DELETE ";
$sql .="FROM r_kpi ";
$sql .="WHERE  r_kpi__id= '$_GET[id]' ";
//var_dump($sql) or die();
$sqlresult = $db->Execute($sql);


}

function edit_(){
global $mod_id;
global $db;
global $tbl_name;
global $field_name;
$user_id = base64_decode($_SESSION['UID']);
$id_peg = $_SESSION['SESSION_ID_PEG'];   


    $kode_cabang = addslashes($_POST[kode_cabang]);
    $nama = addslashes($_POST[nama]);
    $finger = addslashes($_POST[finger]);
    $bulan = addslashes($_POST[bulan]);
    $tahun = addslashes($_POST[tahun]);
    $nilai  = addslashes($_POST[nilai]);
    $keterangan  = addslashes($_POST[keterangan]);
    $kpi_id= $_POST[kpi_id];
    
     $sql_cek="SELECT r_kpi__id ,
                r_kpi__finger,
                r_kpi__bulan,
                r_kpi__tahun,
                r_kpi__nilai,
                r_kpi__keterangan,
                r_kpi__approval FROM r_kpi A where A.r_kpi__finger='$finger' AND A.r_kpi__bulan='$bulan' AND A.r_kpi__tahun='$tahun'";
     
        $rs_val = $db->Execute($sql_cek);
        $r_kpi__finger= $rs_val->fields['r_kpi__finger'];
        $r_kpi__bulan = $rs_val->fields['r_kpi__bulan'];
        $r_kpi__tahun= $rs_val->fields['r_kpi__tahun'];      
        
        $today = date("Y-m-d");
        $today = explode('-', $today);
        $today_tahun  = $today[0];
        $today_bulan= $today[1];
        $today_tgl=$today[2];
    
    
    
    
    
    if(($finger=="" AND $bulan==""  AND $tahun=="" )OR ($today_bulan!=$bulan or   $today_tahun!=$tahun))
		
        {
                Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&finger=".$_POST[finger]."&tahun=".$_POST[tahun]."&bulan=".$_POST[bulan]);

        } 
            else
        { 
                $sql_edit  =" UPDATE $tbl_name set ";
                $sql_edit .=" r_kpi__finger = '$finger', ";
                $sql_edit .=" r_kpi__bulan = '$bulan', ";
                $sql_edit .=" r_kpi__tahun = '$tahun', ";
                $sql_edit .=" r_kpi__nilai = '$nilai', ";
                $sql_edit .=" r_kpi__keterangan = '$keterangan', ";
                $sql_edit .=" r_kpi__date_created =  now(),";
                $sql_edit .=" r_kpi__user_created = '$id_peg'";
                $sql_edit .="  WHERE r_kpi__id='$kpi_id' ";
                $sqlresult4 = $db->Execute($sql_edit);
                Header("Location:index.php?mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&idfinger_cari=".$t_abs__fingerprint."&bulan=".$abs_bulan."&tahun=".$abs_tahun);
        }
}

function create_(){
    
        global $mod_id;	
        global $db;
        global $tbl_name;
        global $field_name;
        $user_id = base64_decode($_SESSION['UID']);
        $id_peg = $_SESSION['SESSION_ID_PEG'];       

        $now= date("Y-m-d");
        $kode_cabang = addslashes($_POST[kode_cabang]);
        $nama = addslashes($_POST[nama]);
        $finger = addslashes($_POST[finger]);
        $bulan = addslashes($_POST[bulan]);
        $tahun = addslashes($_POST[tahun]);
        $nilai  = addslashes($_POST[nilai]);
                
        $sql_cek="SELECT r_kpi__id ,
                r_kpi__finger,
                r_kpi__bulan,
                r_kpi__tahun,
                r_kpi__nilai,
                r_kpi__keterangan,
                r_kpi__approval FROM r_kpi A where A.r_kpi__finger='$finger' AND A.r_kpi__bulan='$bulan' AND A.r_kpi__tahun='$tahun'";
     
        $rs_val = $db->Execute($sql_cek);
        $r_kpi__finger= $rs_val->fields['r_kpi__finger'];
        $r_kpi__bulan = $rs_val->fields['r_kpi__bulan'];
        $r_kpi__tahun= $rs_val->fields['r_kpi__tahun'];      
        
        $today = date("Y-m-d");
        $today = explode('-', $today);
        $today_tahun  = $today[0];
        $today_bulan= $today[1];
        $today_tgl=$today[2];
       
                
            if($finger=="" AND $bulan==""  AND $tahun=="" )
                {
                
                  Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&finger=".$_POST[finger]."&tahun=".$_POST[tahun]."&bulan=".$_POST[bulan]);
                } 
            elseif(($r_kpi__finger==$finger AND $r_kpi__bulan==$bulan AND $r_kpi__tahun==$tahun)or($bulan>$today_bulan) or($bulan<$today_bulan))
            {
             
              Header("Location:index_cek.php?ERR=5&kode_peminjaman=".$kode_peminjaman."&mod_id=$mod_id&limit=".$_POST[limit]."&SORT=".$_POST['SORT']."&page=".$_POST[page]."&finger=".$_POST[finger]."&tahun=".$_POST[tahun]."&bulan=".$_POST[bulan]);
            }
             else
            { 
                $sql="INSERT INTO r_kpi(r_kpi__finger, r_kpi__bulan, r_kpi__tahun, r_kpi__nilai, r_kpi__keterangan,r_kpi__date_created,r_kpi__user_created) VALUES "
                                 . "('$finger',"
                                 . "'$bulan',"
                                 . "'$tahun',"
                                 . "'$nilai',"
                                 . "'$keterangan',"
                                 . "'$today',"
                                 . "'$id_peg')";
			 $sqlresult = $db->Execute($sql);
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
