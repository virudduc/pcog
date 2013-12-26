<?php
if(!isset($_SESSION['userinfo']) && empty($_SESSION['userinfo'])){
		header('Location:index.php');
	} 
?>