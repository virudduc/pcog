<?php 
// Display the message in the session if it is available. 
if(isset($_SESSION['message']) && count($_SESSION['message'])){
	?>
	<div id="" class="span10 text-error" style="margin:auto;float:none;">
	<?php
	foreach($_SESSION['message'] as $message_ar)
	{
		//echo $message_ar['type'];
		echo "<strong>".$message_ar['title']."</strong><br/>";
		echo $message_ar['text'];
	}
	$_SESSION['message'][]=array();
	unset($_SESSION['message']);
	?>
	</div>
	<?php
}
?>
<div style="clear:both;"></div>

