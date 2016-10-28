<?php

if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
	require_once('../includes/header.redirect.inc');
}

?>