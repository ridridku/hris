<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");    // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
                                                    // always modified
header("Cache-Control: no-store, no-cache, must-revalidate");  // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

function Privi($mod_id, $user_id, $mod_mode){
global $db;

$sql = "SELECT a.*, b.* FROM tbl_sys_master_menu a INNER JOIN tbl_sys_master_privileges b ON a.MENU_ID = b.PRIV_MENU_ID WHERE a.MENU_ID = '$mod_id' AND b.PRIV_USER_ID = '$user_id' ";

//var_dump($sql)or die();
$sqlresult = $db->Execute($sql);

$mod_insert = $sqlresult->fields['priv_insert'];
$mod_edit = $sqlresult->fields['priv_edit'];
$mod_delete = $sqlresult->fields['priv_delete'];
$mod_search = $sqlresult->fields['priv_search'];
$mod_report = $sqlresult->fields['priv_report'];
$mod_print = $sqlresult->fields['priv_print'];

//MODE INSERT
// Privi($mod_id, $user_id, 'delete')
if ($mod_mode == 'insert')
{
	if ($mod_insert != '1')
	{
		
		$privileges = 'no';

		?>
			<SCRIPT LANGUAGE="JavaScript">
			<!--

			alert("Maaf Anda tidak berhak melakukan entry data..! ");

			parent.mainFrame.location = '<?php echo "index.php?mod_id=$mod_id"; ?>';
			//-->
			</SCRIPT>

		<?php	
	}
	else
	{
	
		$privileges = 'yes';		

	}
	
	
	return $privileges;
}

//MODE EDIT
if ($mod_mode == 'edit')
{

	if ($mod_edit != '1')
	{
		
		$privileges = 'no';

		?>
			<SCRIPT LANGUAGE="JavaScript">
			<!--


			alert("Maaf Anda tidak berhak melakukan Edit data..! ");

			parent.mainFrame.location = '<?php echo "index.php?mod_id=$mod_id"; ?>';
			//-->
			</SCRIPT>

		<?php
		
	}
	else
	{
	
		$privileges = 'yes';		

	}
	
	
	return $privileges;
}


//MODE DELETE
// Privi($mod_id, $user_id, 'delete')
if ($mod_mode == 'delete')
{

	if ($mod_delete != '1')
	{
		
		$privileges = 'no';
		?>
			<SCRIPT LANGUAGE="JavaScript">
			<!--


			alert("Maaf Anda tidak berhak melakukan hapus data..! ");

			parent.mainFrame.location = '<?php echo "index.php?mod_id=$mod_id"; ?>';
			//-->
			</SCRIPT>

		<?php
		
	}
	else
	{
	
		$privileges = 'yes';		

	}
	
	
	return $privileges;
}

//MODE SEARCH
if ($mod_mode == 'search')
{

	if ($mod_search != '1')
	{
		
		$privileges = 'no';
		?>
			<SCRIPT LANGUAGE="JavaScript">
			<!--


			alert("Maaf Anda tidak berhak melakukan Pencarian data..! ");

			parent.mainFrame.location = '<?php echo "index.php?mod_id=$mod_id"; ?>';
			//-->
			</SCRIPT>

		<?php
		
	}
	else
	{
	
		$privileges = 'yes';		

	}
	
	
	return $privileges;
}



//MODE REPORT
if ($mod_mode == 'report')
{

	if ($mod_report != '1')
	{
		
		$privileges = 'no';
		?>
			<SCRIPT LANGUAGE="JavaScript">
			<!--


			alert("Maaf Anda tidak berhak melakukan Reporting data..! ");

			parent.mainFrame.location = '<?php echo "index.php?mod_id=$mod_id"; ?>';
			//-->
			</SCRIPT>

		<?php
		
	}
	else
	{
	
		$privileges = 'yes';		

	}
	
	
	return $privileges;
}

//MODE REPORT
if ($mod_mode == 'print')
{

	if ($mod_print != '1')
	{
		
		$privileges = 'no';
		?>
			<SCRIPT LANGUAGE="JavaScript">
			<!--


			alert("Maaf Anda tidak berhak melakukan Print data..! ");

			parent.mainFrame.location = '<?php echo "index.php?mod_id=$mod_id"; ?>';
			//-->
			</SCRIPT>

		<?php
		
	}
	else
	{
	
		$privileges = 'yes';		

	}
	
	
	return $privileges;
}



}


?>