<?php
	include_once 'header_config.php';
include("authentication.php"); 
if(isset($_POST['submit']) && isset($_POST['new_password1']))
{
	if($_POST['old_password'] == '' || $_POST['new_password1'] == '' || $_POST['new_password2'] == '')
	{
		$prompt = 'All fields are mandatory!';
	}
	else if($_POST['new_password1'] != $_POST['new_password2'])
	{
		$prompt = 'New password do not match!';
	}
	else if($_POST['captchaStr'] != $_SESSION['captcha'])
	{
		$prompt = 'Captcha do not match! Please re-submit the values...';
	}
	else
	{
		$changePswdSql = 'update pcog_admin set password="'.md5(escape($_POST['new_password1'])).'"';
		$a = $con->query($changePswdSql);
		$prompt = 'Password updated successfully.';
	}
}
$captchaStr = substr(md5(rand(0,999)),10,5);
$width = 100;
$height = 30;
$image = ImageCreate($width,$height);
$black = ImageColorAllocate($image, 255,255,255);
$black = ImageColorAllocate($image, 0, 0, 0);
$grey = ImageColorAllocate($image, 200, 200, 200);
ImageFill($image, 0, 0, $grey);
ImageString($image, 5, 30, 3, $captchaStr, $white);
$_SESSION['captcha']=$captchaStr;
ImageRectangle($image,0,0,$width-1,$height-1,$black);
ImageJpeg($image,"images/captcha.jpeg");
ImageDestroy($image);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<style>
	.infobox-small {
    //height: 50px !important;
    padding-bottom: 5px;
    text-align: left;
    width: 135px !important;
	}
	.infobox-small > .infobox-data {
    display: inline-block;
    max-width: 122px !important;
    min-width: 0;
    text-align: left;
    vertical-align: middle;
}
	</style>
		<meta charset="utf-8" />
		<title>Dashboard - PCog Admin</title>
		<meta name="description" content="overview & stats" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->
		<link href="assets/css/bootstrap.css" rel="stylesheet" />
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.css" rel="stylesheet" />

		<link rel="stylesheet" href="assets/css/font-awesome.css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->


		<!-- page specific plugin styles -->
		

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.css" />
		<link rel="stylesheet" href="assets/css/pcog.css" />
		<!--[if lt IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

	</head>

	<body>
		<?php include("header.php"); ?>
		<div class="container-fluid" id="main-container">
			
		<?php include("sidebar.php"); ?>
		
			<div id="main-content" class="clearfix">
					
					<div id="breadcrumbs">
						<ul class="breadcrumb">
							<li><i class="icon-home"></i> <a href="dashboard.php">Home</a><span class="divider"><i class="icon-angle-right"></i></span></li>
							<li class="active">Change Profile</li>
						</ul><!--.breadcrumb-->

					
					</div><!--#breadcrumbs-->



					<div id="page-content" class="clearfix">
						
						<div class="page-header position-relative">
							<h1>Change Profile <small><i class="icon-double-angle-right"></i> Edit your profile from here.</small></h1>
						</div><!--/page-header-->
						
						
						<div class="prompt">
						<?php echo (($prompt!='')?$prompt:'');?>
						</div>
						<div class="info">
						<form action="" method="post" name="subject_add">
							<table>
							<tr>
							<td>Old password :</td>
							<td><input type="password" name="old_password" required/></td>
							</tr>
							<tr>
							<td>New password :</td>
							<td><input type="password" name="new_password1" required/></td>
							</tr>
							<tr>
							<td>Confirm new password :</td>
							<td><input type="password" name="new_password2" required/></td>
							</tr>
							<tr>
							<td>Captcha :</td>
							<td><img src="images/captcha.jpeg" alt="error"></td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							<td><input type="text" name="captchaStr" required/></td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							<td><input type="submit" class="btn btn-primary" name="submit" value="Update password"></td>
							</tr>
							</table>		
						</form>
						</div>
						
						

					</div><!--/#page-content-->

			
			</div><!-- #main-content -->


		</div><!--/.fluid-container#main-container-->




		<a href="#" id="btn-scroll-up" class="btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only"></i>
		</a>


		<!-- basic scripts -->
		<script src="assets/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript">
		window.jQuery || document.write("<script src='assets/js/jquery-1.9.1.min.js'>\x3C/script>");
		</script>
		
		<script src="assets/js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->
		
		<!--[if lt IE 9]>
		<script type="text/javascript" src="assets/js/excanvas.min.js"></script>
		<![endif]-->

		

	


		<!-- ace scripts -->
		<script src="assets/js/ace-elements.js"></script>
		<script src="assets/js/ace.js"></script>


		<!-- inline scripts related to this page -->
		


	</body>
</html>