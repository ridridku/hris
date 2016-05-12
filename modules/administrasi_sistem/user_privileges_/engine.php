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

# including Header file for Content Expiring
require_once($DIR_INC.'/header.exp.inc');
# including Header file for Database Configuration
require_once($DIR_INC.'/db.conf.php');
require_once($DIR_ADODB.'/adodb.inc.php');
require_once($DIR_INC.'/class.locker.php');

$db = &ADONewConnection($DB_TYPE);
//$db->debug = true;
$db->Connect($DB_HOST, $DB_USER, $DB_PWD, $DB_NAME);
//------------------------------------LOCAL CONFIG--------------------------------------//

#IMAGES
$DIR_IMAGES = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/images');

#SETTING FOR TEMPLATE 
$TPL_PATH = base64_decode($_SESSION['THEME']).'/modules/administrasi_sistem/user_privileges';


#SETTING FILE JS INCLUDE
$JS_MODUL = $DIR_THEME.'/'.(base64_decode($_SESSION['THEME']).'/javascripts/modules/administrasi_sistem');
$FILE_JS  = $JS_MODUL.'/user_privileges';


#Initiate TABLE
$tbl_name	= "tbl_sys_master_privileges";
$field_name	= "priv";


//-----------------------------------END OF LOCAL CONFIG-------------------------------//
$menu_ortu = $_POST['menu_ortu'];
$pegawai_nip = $_POST['user_id'];
$menu_id_cek = $_POST['menu_id_cek'];
$jumlah_cek = $_POST['jum_child'] + 1;

$super_parent = $_POST['super_parent'];


if ($super_parent == '3')
{
					$sql = "DELETE FROM ".$tbl_name." WHERE priv_user_id = '$pegawai_nip' AND priv_menu_id in ($menu_id_cek)  ";
					$db->Execute($sql);

					//$sql = "INSERT INTO ".$tbl_name." (priv_user_id, priv_menu_id, priv_view) VALUES ('$pegawai_nip', '$menu_ortu', '1') ";
					//$db->Execute($sql);
							


					for ($i=0; $i<$jumlah_cek; $i++)
					{
							$post_view = "ck_childview_".$i;
							$cek_view = $_POST[$post_view];

							$post_insert = "ck_childinsert_".$i;
							$cek_insert = $_POST[$post_insert];
							
							$post_edit = "ck_childedit_".$i;
							$cek_edit = $_POST[$post_edit];

							$post_delete = "ck_childdelete_".$i;
							$cek_delete = $_POST[$post_delete];

							$post_search = "ck_childsearch_".$i;
							$cek_search = $_POST[$post_search];

							$post_report = "ck_childreport_".$i;
							$cek_report = $_POST[$post_report];

							$post_print = "ck_childprint_".$i;
							$cek_print = $_POST[$post_print];

							if ($cek_view != '')
							{
								$nilai_view = '1';
								$menu_user = $cek_view;
							}
							else
							{
								$nilai_view = '0';
							}


							if ($cek_insert != '')
							{
								$nilai_insert = '1';
								$menu_user = $cek_insert;
							}
							else
							{
								$nilai_insert = '0';
							}

							if ($cek_edit != '')
							{
								$nilai_edit = '1';
								$menu_user = $cek_edit;
							}
							else
							{
								$nilai_edit = '0';
							}


							if ($cek_delete != '')
							{
								$nilai_delete = '1';
								$menu_user = $cek_delete;
							}
							else
							{
								$nilai_delete = '0';
							}

							if ($cek_search != '')
							{
								$nilai_search = '1';
								$menu_user = $cek_search;
							}
							else
							{
								$nilai_search = '0';
							}

							if ($cek_report != '')
							{
								$nilai_report = '1';
								$menu_user = $cek_report;
							}
							else
							{
								$nilai_report = '0';
							}

							if ($cek_print != '')
							{
								$nilai_print = '1';
								$menu_user = $cek_print;
							}
							else
							{
								$nilai_print = '0';
							}
								
											
									$sql = "INSERT INTO ".$tbl_name." (priv_user_id, priv_menu_id, priv_view, priv_insert, priv_edit, priv_delete, priv_search, priv_report, priv_print) VALUES ('$pegawai_nip','$menu_ortu','$nilai_view_ortu','$nilai_insert','$nilai_edit','$nilai_delete','$nilai_search','$nilai_report','$nilai_print') ";
									//$db->Execute($sql);							
								
											
								//sql menu insert 
								$sql = "INSERT INTO ".$tbl_name." (priv_user_id, priv_menu_id, priv_view, priv_insert, priv_edit, priv_delete, priv_search, priv_report, priv_print) VALUES ('$pegawai_nip','$menu_user','$nilai_view','$nilai_insert','$nilai_edit','$nilai_delete','$nilai_search','$nilai_report','$nilai_print') ";
								$db->Execute($sql);


							

						
					} //end for

					Header("Location:index.php");
	
} //end if

if ($super_parent == '1') 
{
	$jumlah_parent_menu = $_POST['jum_super_parent'];
	$implode_daftar_menu_id = $_POST['implode_daftar_menu_id'];

	$sql = "DELETE FROM ".$tbl_name." WHERE priv_user_id = '$pegawai_nip' AND priv_menu_id in ($implode_daftar_menu_id)  ";
	$db->Execute($sql);

	//echo $sql."-atas<br>";

	for ($i=0; $i<$jumlah_parent_menu; $i++)
	{
		$post_view = "ck_parent_".$i;
		$cek_view = $_POST[$post_view];


		if ($cek_view != '')
		{
			$nilai_view = '1';
			$menu_user = $cek_view;
		}
		else
		{
			$nilai_view = '0';
		}


		//sql menu insert 
		$sql = "INSERT INTO ".$tbl_name." (priv_user_id, priv_menu_id, priv_view) VALUES ('$pegawai_nip','$menu_user','$nilai_view') ";
		$db->Execute($sql);

		//echo $sql."-bawah<br>";

	
	} //end for
		
	Header("Location:form.parent.php?user_id=$pegawai_nip");

} //end if

else if ($super_parent == '2') 
{
	$jumlah_parent_menu = $_POST['jum_super_parent'];
	$implode_daftar_menu_id = $_POST['implode_daftar_menu_id'];

	$sql = "DELETE FROM ".$tbl_name." WHERE priv_user_id = '$pegawai_nip' AND priv_menu_id in ($implode_daftar_menu_id)  ";
	$db->Execute($sql);

	//echo $sql."-atas<br>";

	for ($i=0; $i<$jumlah_parent_menu; $i++)
	{
		$post_view = "ck_sub_parent_".$i;
		$cek_view = $_POST[$post_view];


		if ($cek_view != '')
		{
			$nilai_view = '1';
			$menu_user = $cek_view;
		}
		else
		{
			$nilai_view = '0';
		}


		//sql menu insert 
		$sql = "INSERT INTO ".$tbl_name." (priv_user_id, priv_menu_id, priv_view) VALUES ('$pegawai_nip','$menu_user','$nilai_view') ";
		$db->Execute($sql);

		//echo $sql."-bawah<br>";

	
	} //end for

	//echo $menu_ortu."<br>".$pegawai_nip."<br>";
		
	Header("Location:index.php");

} //end if








}
?>
