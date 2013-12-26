<?php 

require_once("EasyPeasyICS.php");

//Create a new calendar
$ICS = new EasyPeasyICS("My calendar name");

//Then add one or more events
//int $starttime Unix timestamp
//int $endtime Unix timestamp
//string $summary The text you see at first glimpse
//string $description Further information you want to add (optional)
//string $url Any url you want to connect with (optional)

$starttime = time() ;
//$endtime = time() + (2 * 24 * 60 * 60);
$endtime = time() + (2 * 60 * 60);
$summary ="Lots of Meetings";
$description ="Very short Description Big descritpion";
$url = "shishirraven.com";

$ICS->addEvent($starttime, $endtime, $summary, $description, $url);

//Output the calendar!
$ICS->render();

?>