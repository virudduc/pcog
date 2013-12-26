<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>Google Map Coordinates Selector</title>
	<script src="../js/jquery-1.10.2.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
	<script src="map.js" type="text/javascript" charset="utf-8"></script>
	<script src="jquery.geocomplete.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
		img { border: 0; }
		#wrapper {	font-family: helvetica;	width: 97%; height: 472px;	padding: 14px;	background-color: #E5E5E7;}
		#map_canvas {	width: 100%;	height: 431px;}
		#search_map_form {	display: block;	position: relative;	}
		form#search_map_form {margin:0px;}
	</style>
</head>

<body>

	<div id="wrapper">
		<form id="search_map_form" class="clearfix">		
			<div class="span8" style="margin-left:0px;">
				<input type="text" name="search_map" class="input-xxlarge" value="" placeholder="Search Address, City, State, or Zipcode" id="search_map" />
				<input style="display: none;" type="submit" name="search_address_submit" value="Search" id="search_address_submit" />
			</div>
			<div id="on_coords" class="span4 pull-right"><div class="span2"><span id="on_lat"></span>, <span id="on_long"></span></div> <button type="button" class="btn btn-primary" id="save_map_btn"> Set Coordinates </button></div>
			
			<input type="hidden" name="long" value="" id="long" />		
			<input type="hidden" name="lat" value="" id="lat" />	
			<input type="hidden" name="zoom_level" value="" id="zoom_level" />				
			<input type="hidden" name="defaultlongt" value="" id="defaultlongt" />				
			<input type="hidden" name="defaultlatt" value="" id="defaultlatt" />				
		</form>	
		<div id="map_canvas"></div>		
	</div>
	<script type="text/javascript">
		
		$(document).ready(function(){
		
			longfield = "<?php echo $_GET['longtfield']; ?>";			
			lattfield = "<?php echo $_GET['lattfield']; ?>";
			zoomlevelfield = "<?php echo $_GET['zoomlevelfield']; ?>";
			defaultlongt = "<?php echo $_GET['defaultlongt']; ?>";
			defaultlatt = "<?php echo $_GET['defaultlatt']; ?>";
		
			$("#long").val($(longfield, window.parent.document).val());
			$("#lat").val($(lattfield, window.parent.document).val());		
			$("#zoom_level").val($(zoomlevelfield, window.parent.document).val());
			$("#defaultlongt").val(defaultlongt);
			$("#defaultlatt").val(defaultlatt);
			
				
			$("#search_map").geocomplete();
			
			if($("#zoom_level").val()=="")
			{
				$("#zoom_level").val(4);
			}
			
		});
		
		jQuery(function($) {
			Map.init({coord_long:$("#long").val(),coord_lat:$("#lat").val(),zoomlevelfield:$("#zoom_level").val(),defaultlongtt:$("#defaultlongt").val(),defaultlat:$("#defaultlatt").val()});
		});
		
		
		
	</script>
</body>
</html>
