<?php


# Including Main Configuration
# including file for Main Configurations
require_once('../../../includes/config.conf.php');	 	


# Create a session to store global config path
session_save_path($DIR_SESS);
$expiry = 172800;
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
# require_once($DIR_INC.'/copyright.tpl');

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
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/administrasi_sistem/user_privileges';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/administrasi_sistem');
$FILE_JS  = $JS_MODUL.'/user_privileges';


#Initiate TABLE
$tbl_name	= "tbl_sys_master_privileges";
$field_name	= "priv";

//-----------------------------------END OF LOCAL CONFIG-------------------------------//

$menu_parent_get = $_GET['menu_parent'];

$global_parent_menu = $menu_parent_get;
$smarty->assign ("GLOBAL_PARENT_MENU", $global_parent_menu);

$user_id = $_GET['user_id'];

$sql = "SELECT a.*,DATE_FORMAT(a.user_date_join,'%D %M %Y %r') as user_date_join, CONCAT(a.user_first_name, ' ', a.user_last_name) as user_full_name FROM tbl_sys_master_user as a WHERE a.user_id = '$user_id' ";
$result = $db->Execute($sql);

$smarty->assign ("USER_ID", $result->fields['user_id']);
$smarty->assign ("USER_FULL_NAME", $result->fields['user_full_name']);
$smarty->assign ("USER_DATE_JOIN", $result->fields['user_date_join']);
$smarty->assign ("USER_ADDRESS", $result->fields['user_address']);
$smarty->assign ("USER_GENDER", $result->fields['user_gender']);
$smarty->assign ("USER_EMAIL", $result->fields['user_email']);
$smarty->assign ("USER_TELP", $result->fields['user_telp']);




$sql = "SELECT DISTINCT a.menu_id as menu_parent_id, b.menu_label, b.menu_id as menu_child_id, b.menu_parent FROM tbl_sys_master_menu as a INNER JOIN tbl_sys_master_menu as b ON a.menu_id = b.menu_parent INNER JOIN  tbl_sys_master_menu as c ON b.menu_id = c.menu_parent WHERE a.menu_id = '$menu_parent_get' ORDER BY a.menu_id ASC ";
$result_check = $db->Execute($sql);



$check_list_menu = $result_check->RecordCount();

$smarty->assign ("CHECK_LIST_MENU", $check_list_menu);

//echo $check_list_menu."-iie<br>";

//echo $_GET['child']."-child<br>";


if ($check_list_menu == 0 && $_GET['child'] != 2 )
{
		//echo "cantik<br>";
			//=======================================detail dokumen=======================================//
			$sql = "SELECT a.* FROM tbl_sys_master_menu as a WHERE a.menu_level = '0' AND a.menu_active = '1' AND a.menu_id = '$menu_parent_get' ";
			$result_menu_parent = $db->Execute($sql);
			$smarty->assign ("MENU_PARENT_ID", $result_menu_parent->fields['menu_id']);
			$menu_parent = array();
			$initSet = array();
			$row_class = array();

			$z=0;
			while($arr = $result_menu_parent->FetchRow()){
			array_push ($menu_parent, $arr);
			if ($z%2==0){ 
					$ROW_CLASSNAME="#8080FF"; }
				else {
					$ROW_CLASSNAME="#8080FF";
				   }
				array_push($row_class, $ROW_CLASSNAME);
				array_push($initSet, $z);
				
				$menu_id_parent[] = $arr[menu_id];

				$z++;
			}
			$smarty->assign ("MENU_PARENT", $menu_parent);
			$smarty->assign ("ROW_CLASSNAME", $row_class);


			$sql = "SELECT a.* FROM tbl_sys_master_menu as a WHERE a.menu_level = '1' AND a.menu_active = '1' AND a.menu_parent = '$menu_parent_get' ORDER BY a.menu_label ASC ";
			$result_menu_child = $db->Execute($sql);
			$menu_child = array();
			$initSet_child = array();
			$row_class_child = array();
			$n=0;
			while($arr = $result_menu_child->FetchRow()){
			array_push ($menu_child, $arr);
			if ($n%2==0){ 
					$ROW_CLASSNAME_CHILD="#FFCCFF"; }
				else {
					$ROW_CLASSNAME_CHILD="#CCCCFF";
				   }
				array_push($row_class_child, $ROW_CLASSNAME_CHILD);
				array_push($initSet_child, $n);

				
				$daftar_anak_id[] = $arr['menu_id'];
				$menu_parent_get_temp[] = $menu_parent_get;

				$n++;
			}
			
					//TINGGAL HAPUS MENU GRAND ORANG TUA....[06-mARET-2007]	
			
			$menu_parent_get_temp = array_unique($menu_parent_get_temp);

			/*
			for ($e=0; $e<=count($menu_parent_get_temp); $e++)
			{
				echo $e."-i<br>";
				echo $menu_parent_get_temp[$e]."-aaray iie<br>";
			}
			*/
			
					
			$gabung_menu_id = array_merge($menu_id_parent, $daftar_anak_id);

			//$gabung_menu_id = array_merge($gabung_menu_id, $menu_parent_get_temp);

			$implode_daftar_anak_id = @implode(",",$gabung_menu_id);


			//echo $implode_daftar_anak_id."-uue<br>";

			$smarty->assign ("MENU_CHILD", $menu_child);
			$smarty->assign ("ROW_CLASSNAME_CHILD", $row_class_child);
			$smarty->assign ("DAFTAR_MENU_ID", $implode_daftar_anak_id);

			//echo $implode_daftar_anak_id."-daftar menu id atas<br>";


			$sql ="SELECT a.menu_label, count(b.menu_id) as jumlah FROM tbl_sys_master_menu as a LEFT JOIN tbl_sys_master_menu as b ON a.menu_id = b.menu_parent WHERE a.menu_level = '0' AND b.menu_active = '1'  AND b.menu_parent = '$menu_parent_get' GROUP BY a.menu_id ";
			$rs = $db->execute($sql);
			$list_jum_parent = array();
			while($arr=$rs->FetchRow()){
				array_push($list_jum_parent, $arr); 	
			}
			$smarty->assign ("LIST_JUM_PARENT", $list_jum_parent);


			$sql ="SELECT count(b.menu_id) as jumlah FROM tbl_sys_master_menu as a LEFT JOIN tbl_sys_master_menu as b  ON a.menu_id = b.menu_parent WHERE a.menu_level = '0' AND b.menu_active = '1' AND b.menu_parent = '$menu_parent_get'  ";
			$rs_jumlah_child = $db->execute($sql);
			$smarty->assign ("COUNT_CHILD", $rs_jumlah_child->fields['jumlah']);


			//----------------------------------cek list
			$sql ="SELECT a.*, b.* FROM tbl_sys_master_privileges as a INNER JOIN tbl_sys_master_menu as b ON a.priv_menu_id = b.menu_id WHERE b.menu_level = '1' AND b.menu_active = '1' AND priv_user_id = '$user_id' ORDER BY b.menu_label ASC ";
			$rs_priv_anak = $db->execute($sql);
			$cek_lis_priv_anak = array();
			while($arr=$rs_priv_anak->FetchRow()){
				array_push($cek_lis_priv_anak, $arr); 	
			}
			$smarty->assign ("CEK_LIST_PRIV_ANAK", $cek_lis_priv_anak);



			$sql ="SELECT a.*, b.* FROM tbl_sys_master_privileges as a INNER JOIN tbl_sys_master_menu as b ON a.priv_menu_id = b.menu_id WHERE b.menu_level = '0' AND b.menu_active = '1' AND priv_user_id = '$user_id'   ";
			$rs_cek_list_parent = $db->execute($sql);

			$smarty->assign ("MENU_ID_PRIV_PARENT", $rs_cek_list_parent->fields['priv_menu_id']);
			$smarty->assign ("INSERT_PRIV_PARENT", $rs_cek_list_parent->fields['priv_insert']);
			$smarty->assign ("EDIT_PRIV_PARENT", $rs_cek_list_parent->fields['priv_edit']);
			$smarty->assign ("DELETE_PRIV_PARENT", $rs_cek_list_parent->fields['priv_delete']);
			$smarty->assign ("SEARCH_PRIV_PARENT", $rs_cek_list_parent->fields['priv_search']);
			$smarty->assign ("REPORT_PRIV_PARENT", $rs_cek_list_parent->fields['priv_report']);
			$smarty->assign ("PRINT_PRIV_PARENT", $rs_cek_list_parent->fields['priv_print']);

			$cek_lis_priv_ortu = array();
			while($arr=$rs_cek_list_parent->FetchRow()){
				array_push($cek_lis_priv_ortu, $arr); 	
			}
			$smarty->assign ("CEK_LIST_PRIV_ORTU", $cek_lis_priv_ortu);

			$smarty->assign ("MENU_INSERT", $_GET['menu_parent']);




			$sql ="SELECT COUNT(a.priv_menu_id) as jml  FROM tbl_sys_master_privileges as a INNER JOIN tbl_sys_master_menu as b ON a.priv_menu_id = b.menu_id WHERE b.menu_level = '1' AND b.menu_active = '1' AND priv_user_id = '$user_id'  ORDER BY b.menu_label ASC   ";
			$rs_set_disabled = $db->execute($sql);
			$smarty->assign ("SET_DISABLED_ANAK", $rs_set_disabled->fields['jml']);

			//=====================================end detail dokumen =================================//

}
else if($_GET['child'] != 2)
{
			$global_parent_menu = $_GET['menu_parent'];

	//echo "kasep<br>";
			$sql = "SELECT a.* FROM tbl_sys_master_menu as a WHERE a.menu_level = '1' AND a.menu_active = '1' AND a.menu_parent = '$menu_parent_get' ";
			$result_menu_parent = $db->Execute($sql);
			$jumlah_menu_cek_sub_parent = $result_menu_parent->RecordCount();
			$menu_parent = array();

			$initSet = array();
			$row_class = array();

			$z=0;
			while($arr = $result_menu_parent->FetchRow()){
			array_push ($menu_parent, $arr);
			if ($z%2==0){ 
					$ROW_CLASSNAME="#CCCCCC"; }
				else {
					$ROW_CLASSNAME="#EEEEEE";
				   }
				array_push($row_class, $ROW_CLASSNAME);
				array_push($initSet, $z);
				$z++;
			}
			$smarty->assign ("MENU_PARENT", $menu_parent);
			$smarty->assign ("ROW_CLASSNAME", $row_class);


			$sql = "SELECT a.* FROM tbl_sys_master_menu as a WHERE a.menu_level = '0' AND a.menu_active = '1' AND a.menu_id = '$menu_parent_get' ";
			$result_menu_label = $db->Execute($sql);

			$smarty->assign ("MENU_LABEL", $result_menu_label->fields['menu_label']);
			$smarty->assign ("MENU_ORTU", $result_menu_label->fields['menu_id']);

			$smarty->assign ("MENU_INSERT", $_GET['menu_parent']);
			$smarty->assign ("GLOBAL_PARENT_MENU", $global_parent_menu);

			//for cek list sub parent
			$sql ="SELECT a.*, b.* FROM tbl_sys_master_privileges as a INNER JOIN tbl_sys_master_menu as b ON a.priv_menu_id = b.menu_id WHERE b.menu_level = '1' AND b.menu_parent = '$global_parent_menu' AND b.menu_active = '1' AND priv_user_id = '$user_id'   ";
			$rs_cek_list_sub_parent = $db->execute($sql);
			
			$arr_cek_list_sub_parent = array();
			while($arr = $rs_cek_list_sub_parent->FetchRow()){
				array_push ($arr_cek_list_sub_parent, $arr);

				$daftar_sub_parent_menu[] = $arr['menu_id'];

			}

			$implode_daftar_sub_parent_id = @implode(",",$daftar_sub_parent_menu);
			
			//echo $implode_daftar_sub_parent_id."-popo<br>";

			$smarty->assign ("IMPLODE_DAFTAR_SUB_PARENT_ID", $implode_daftar_sub_parent_id);
			$smarty->assign ("ARR_CEK_LIST_SUB_PARENT", $arr_cek_list_sub_parent);
			$smarty->assign ("JUM_SUPER_SUB_PARENT", $jumlah_menu_cek_sub_parent);
			$smarty->assign ("USER_ID", $user_id);


}//end if check list menu



if ($_GET['child'] == '2')
{

			//echo " get sama dengan 2<br>";
			//=======================================detail dokumen=======================================//
			$sql = "SELECT a.* FROM tbl_sys_master_menu as a WHERE a.menu_level = '1' AND a.menu_active = '1' AND a.menu_id = '$menu_parent_get' ";
			$result_menu_parent = $db->Execute($sql);
			$smarty->assign ("MENU_PARENT_ID", $result_menu_parent->fields['menu_id']);
			$menu_parent = array();
			$initSet = array();
			$row_class = array();

			$z=0;
			while($arr = $result_menu_parent->FetchRow()){
			array_push ($menu_parent, $arr);
			if ($z%2==0){ 
					$ROW_CLASSNAME="#8080FF"; }
				else {
					$ROW_CLASSNAME="#8080FF";
				   }
				array_push($row_class, $ROW_CLASSNAME);
				array_push($initSet, $z);
				
				$menu_id_parent[] = $arr[menu_id];

				$z++;
			}
			$smarty->assign ("MENU_PARENT", $menu_parent);
			$smarty->assign ("ROW_CLASSNAME", $row_class);


			$sql = "SELECT a.* FROM tbl_sys_master_menu as a WHERE a.menu_level = '2' AND a.menu_active = '1' AND a.menu_parent = '$menu_parent_get' ORDER BY a.menu_label ASC ";
			$result_menu_child = $db->Execute($sql);
			$menu_child = array();
			$initSet_child = array();
			$row_class_child = array();
			$n=0;
			while($arr = $result_menu_child->FetchRow()){
			array_push ($menu_child, $arr);
			if ($n%2==0){ 
					$ROW_CLASSNAME_CHILD="#FFCCFF"; }
				else {
					$ROW_CLASSNAME_CHILD="#CCCCFF";
				   }
				array_push($row_class_child, $ROW_CLASSNAME_CHILD);
				array_push($initSet_child, $n);

				
				$daftar_anak_id[] = $arr['menu_id'];
				$menu_parent_get_temp[] = $_GET['menu_ortu'];


				$n++;
			}
			
			$menu_parent_get_temp = array_unique($menu_parent_get_temp);

			$gabung_menu_id = array_merge($menu_id_parent, $daftar_anak_id);
			//$gabung_menu_id = array_merge($gabung_menu_id, $menu_parent_get_temp);

			$implode_daftar_anak_id = @implode(",",$gabung_menu_id);

			$smarty->assign ("MENU_CHILD", $menu_child);
			$smarty->assign ("ROW_CLASSNAME_CHILD", $row_class_child);
			$smarty->assign ("DAFTAR_MENU_ID", $implode_daftar_anak_id);


			$sql ="SELECT a.menu_label, count(b.menu_id) as jumlah FROM tbl_sys_master_menu as a LEFT JOIN tbl_sys_master_menu as b ON a.menu_id = b.menu_parent WHERE a.menu_level = '1' AND b.menu_active = '1'  AND b.menu_parent = '$menu_parent_get' GROUP BY a.menu_id ";
			$rs = $db->execute($sql);
			$list_jum_parent = array();
			while($arr=$rs->FetchRow()){
				array_push($list_jum_parent, $arr); 	
			}
			$smarty->assign ("LIST_JUM_PARENT", $list_jum_parent);


			$sql ="SELECT count(b.menu_id) as jumlah FROM tbl_sys_master_menu as a LEFT JOIN tbl_sys_master_menu as b  ON a.menu_id = b.menu_parent WHERE a.menu_level = '1' AND b.menu_active = '1' AND b.menu_parent = '$menu_parent_get'  ";
			$rs_jumlah_child = $db->execute($sql);
			$smarty->assign ("COUNT_CHILD", $rs_jumlah_child->fields['jumlah']);


			//----------------------------------cek list
			$sql ="SELECT a.*, b.* FROM tbl_sys_master_privileges as a INNER JOIN tbl_sys_master_menu as b ON a.priv_menu_id = b.menu_id WHERE b.menu_level = '2' AND b.menu_active = '1' AND priv_user_id = '$user_id' ORDER BY b.menu_label ASC ";
			$rs_priv_anak = $db->execute($sql);
			$cek_lis_priv_anak = array();
			while($arr=$rs_priv_anak->FetchRow()){
				array_push($cek_lis_priv_anak, $arr); 	
			}
			$smarty->assign ("CEK_LIST_PRIV_ANAK", $cek_lis_priv_anak);



			$sql ="SELECT a.*, b.* FROM tbl_sys_master_privileges as a INNER JOIN tbl_sys_master_menu as b ON a.priv_menu_id = b.menu_id WHERE b.menu_level = '1' AND b.menu_active = '1' AND priv_user_id = '$user_id'   ";
			$rs_cek_list_parent = $db->execute($sql);

			$smarty->assign ("MENU_ID_PRIV_PARENT", $rs_cek_list_parent->fields['priv_menu_id']);
			$smarty->assign ("INSERT_PRIV_PARENT", $rs_cek_list_parent->fields['priv_insert']);
			$smarty->assign ("EDIT_PRIV_PARENT", $rs_cek_list_parent->fields['priv_edit']);
			$smarty->assign ("DELETE_PRIV_PARENT", $rs_cek_list_parent->fields['priv_delete']);
			$smarty->assign ("SEARCH_PRIV_PARENT", $rs_cek_list_parent->fields['priv_search']);
			$smarty->assign ("REPORT_PRIV_PARENT", $rs_cek_list_parent->fields['priv_report']);
			$smarty->assign ("PRINT_PRIV_PARENT", $rs_cek_list_parent->fields['priv_print']);

			$cek_lis_priv_ortu = array();
			while($arr=$rs_cek_list_parent->FetchRow()){
				array_push($cek_lis_priv_ortu, $arr); 	
			}
			$smarty->assign ("CEK_LIST_PRIV_ORTU", $cek_lis_priv_ortu);
			
			$menu_ortu = $_GET['menu_ortu'];
			$sql = "SELECT a.* FROM tbl_sys_master_menu as a WHERE a.menu_level = '0' AND a.menu_active = '1' AND a.menu_id = '$menu_ortu' ";
			$result_menu_label_sub = $db->Execute($sql);

			$smarty->assign ("MENU_LABEL_SUB", $result_menu_label_sub->fields['menu_label']);


			$sql = "SELECT a.* FROM tbl_sys_master_menu as a WHERE a.menu_level = '1' AND a.menu_active = '1' AND a.menu_id = '$menu_parent_get' ";
			$result_menu_label = $db->Execute($sql);

			$smarty->assign ("MENU_LABEL", $result_menu_label->fields['menu_label']);


			$sql ="SELECT COUNT(a.priv_menu_id) as jml  FROM tbl_sys_master_privileges as a INNER JOIN tbl_sys_master_menu as b ON a.priv_menu_id = b.menu_id WHERE b.menu_level = '2' AND b.menu_active = '1' AND priv_user_id = '$user_id'  ORDER BY b.menu_label ASC   ";
			$rs_set_disabled = $db->execute($sql);
			$smarty->assign ("SET_DISABLED_ANAK", $rs_set_disabled->fields['jml']);

			//=====================================end detail dokumen =================================//


			$smarty->assign ("CHILD", $_GET['child']);
			$smarty->assign ("MENU_INSERT", $_GET['menu_ortu']);

			//echo $_GET['menu_ortu']." menu_parent<br>";

}

//echo $menu_parent_get."iie<br>";

$smarty->assign ("TABLE_CAPTION", _CAPTION_TABLE_USER_PRIV);
$smarty->assign ("TABLE_NAME", _NAMA_TABLE_USER_PRIV);
$smarty->assign ("FORM_NAME", _FORM);
$smarty->assign ("TITLE", _TITLE_PEGAWAI_PRIV);
$smarty->assign ("HEAD_TITLE", _HEAD_TITLE_PEGAWAI_PRIV);
$smarty->assign ("SUBMIT", _SUBMIT);
$smarty->assign ("RESET", _RESET);



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