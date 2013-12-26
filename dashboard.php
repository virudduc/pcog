<?php 
require_once 'header_config.php';
include("authentication.php"); 
//include("library/advance_search.php");
//include("library/user_acl.php");
//$a = new ACL();
//$a->user_id = $_SESSION['userinfo']['user_id'];


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
							<li><i class="icon-home"></i> <a href="#">Home</a><span class="divider"><i class="icon-angle-right"></i></span></li>
							<li class="active">Dashboard</li>
						</ul><!--.breadcrumb-->

					
					</div><!--#breadcrumbs-->



					<div id="page-content" class="clearfix">
						
						<div class="page-header position-relative">
							<h1>Dashboard <small><i class="icon-double-angle-right"></i> overview & stats</small></h1>
						</div><!--/page-header-->
						<div>
						<h2>Welcome, <?php echo $_SESSION['userinfo']['username']; ?></h2>
						</div>
					</div><!--/#page-content-->
					<!--div id="ace-settings-container">
						<div class="btn btn-app btn-mini btn-warning" id="ace-settings-btn">
							<i class="icon-cog"></i>
						</div>
						<div id="ace-settings-box">
							<div>
								<div class="pull-left">
									<select id="skin-colorpicker" class="hidden">
										<option data-class="default" value="#438EB9">#438EB9</option>
										<option data-class="skin-1" value="#222A2D">#222A2D</option>
										<option data-class="skin-2" value="#C6487E">#C6487E</option>
										<option data-class="skin-3" value="#D0D0D0">#D0D0D0</option>
									</select>
								</div>
								<span>&nbsp; Choose Skin</span>
							</div>
							<div><input type="checkbox" class="ace-checkbox-2" id="ace-settings-header" /><label class="lbl" for="ace-settings-header"> Fixed Header</label></div>
							<div><input type="checkbox" class="ace-checkbox-2" id="ace-settings-sidebar" /><label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label></div>
						</div>
					</div--><!--/#ace-settings-container-->

			
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
