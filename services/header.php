<?php
	session_start();
	include_once '../includes/table_names.php';
	include_once '../includes/constants.php';
	$con = new PDO("sqlite:../db/pcog.sqlite");
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	include_once '../includes/functions.php';
?>