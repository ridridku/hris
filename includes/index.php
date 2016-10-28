<?php
if ((!isset($_SESSION['UID'])) || (empty($_SESSION['UID']))){
	require_once('header.redirect.inc');
}
?>