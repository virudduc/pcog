<?php
	include_once 'header_config.php';
include("authentication.php"); 
if(isset($_POST['image_upload']))
{
	if($_POST['image_shape_name']=='')
	{
		$prompt = 'Please enter the image name.';
	}
	else if($_FILES['image_path']['error'] == UPLOAD_ERR_NO_FILE)
	{
		$prompt = 'Please choose some image to upload.';
	}
	else
	{
		$prompt = '';
		$name = explode('.',$_FILES['image_path']['name']);
		$ext = $name[count($name)-1];
		$fullname = $_POST['image_shape_name'].'.'.$ext;
		if(move_uploaded_file($_FILES['image_path']['tmp_name'],IMAGE_PATH.$fullname))
		{
			$check_sql = 'select id from pcog_question_images where filename="'.$fullname.'" and status="1"';
			$a = $con->query($check_sql);
			$check_arr = $a->fetch();
			if(empty($check_arr))
			{
				$sql = 'INSERT INTO pcog_question_images (name, filename, status) VALUES ("'.escape($_POST['image_shape_name']).'", "'.$fullname.'", "1")';
				$a = $con->query($sql);
				$prompt = 'Action is successfull.';
			}
			else
			{	
				$prompt = 'Duplicate image.';
			}
		}
		else
		{
			$prompt = 'There was some error in uploading of image.';
		}
	}
}

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
							<li class="active">Upload image</li>
						</ul><!--.breadcrumb-->

					
					</div><!--#breadcrumbs-->



					<div id="page-content" class="clearfix">
						
						<div class="page-header position-relative">
							<h1>Upload image <small><i class="icon-double-angle-right"></i> Add a new image</small></h1>
						</div><!--/page-header-->
						
						
						<div class="prompt">
						<?php echo (($prompt!='')?$prompt:'');?>
						</div>
						<div class="info">
						<form action="" method="post" name="image_add" enctype="multipart/form-data" onsubmit="return confirmAction()">
							<table>
							<tr>
							<td>Image name</td>
							<td><input type="text" class="form-control" name="image_shape_name" required/></td>
							</tr>
							<tr>
							<td>Select image</td>
							<td><input type="file" class="" name="image_path" required/></td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							<td><input type="submit" class="btn btn-primary" name="image_upload" value="Upload"/></td>
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
		<script type="text/javascript">
		function confirmAction()
		{
			var ch = confirm("Are you sure?");
			if(ch == true)
				return true;
			return false;
		}
		</script>


	</body>
</html>