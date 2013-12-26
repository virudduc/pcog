<?php
session_start();
if(isset($_SESSION))
{  
$_SESSION=array();
session_unset();
session_destroy();
 
}
session_start();
 $message=array('title'=>'Logout','text'=>'You Have Been Successfully Logout','type'=>'success');
 $_SESSION['message']=array();
 $_SESSION['message'][]=$message;

 
header("location:index.php");
?>