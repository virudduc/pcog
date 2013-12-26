<?php
	include_once 'header_config.php';
include("authentication.php"); 
$prompt = '';
if(isset($_REQUEST['action']) && $_REQUEST['action']=='rem')
{
	$upd_sql = 'update pcog_question_images set status="0" where id="'.(int)escape($_REQUEST['imgid']).'"';
	$a = $con->query($upd_sql);
	$prompt = 'Image removed from database.';
}
$search_sql = 'select * from pcog_question_images where status="1" order by name';
$search_rec = $con->query($search_sql);

$search_arr = $search_rec->fetchAll();
//print_r($search_arr);

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
		<title>Dashboard - Ace Admin</title>
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
							<li class="active">Images list</li>
						</ul><!--.breadcrumb-->

					
					</div><!--#breadcrumbs-->



					<div id="page-content" class="clearfix">
						
						<div class="page-header position-relative">
							<h1>Images list <small><i class="icon-double-angle-right"></i> Active images</small></h1>
						</div><!--/page-header-->
						
						
						<div class="prompt">
						<?php echo (($prompt!='')?$prompt:'');?>
						</div>
						<div class="info">
						<form action="" method="post" name="subject_add">
							<table cellspacing="0" cellpadding="0" border="0" width="100%" class="table table-hover">
							<th>S.No.</th>
							<th>Name</th>
							<th>Image</th>		
							<th>Action</th>
							<?php foreach($search_arr as $key=>$text) { ?>
							<tr>
							<td width="5%" align="center"><?php echo ($key+1); ?></td>
							<td width="30%"><?php echo $text['name']; ?></td>
							<td><img height="80px" src="<?php echo IMAGE_PATH.$text['filename']; ?>" alt="loading"/></td>
							<td><a href="#">Edit</a>/<a href="?action=rem&imgid=<?php echo $text['id']; ?>" onclick="return confirmAction();">Delete</a></td>
							</tr>
							<?php } ?>	
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