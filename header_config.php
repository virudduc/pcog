<?php
	session_start();
	//error_reporting(0);
	include_once 'includes/table_names.php';
	include_once 'includes/constants.php';
		
	function escape($string)
	{
		return sqlite_escape_string($string);
	}
	$con = new PDO("sqlite:db/pcog.sqlite");

	$con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	$pagesize = 10;
	$start = 0;
?>