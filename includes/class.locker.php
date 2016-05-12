<?php

function lockTables($tbl_name){
	global $db;
	$sql	= "LOCK TABLES ".$tbl_name." READ";
	$sqlresult = $db->Execute($sql);
	$sql	= "LOCK TABLES ".$tbl_name." WRITE";
	$sqlresult = $db->Execute($sql);
}

function unlockTables($tbl_name){
	global $db;
	$sql	= "UNLOCK TABLES";
	$sqlresult = $db->Execute($sql);
}

?>