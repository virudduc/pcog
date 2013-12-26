<?php
include("define.php");
include('connection.php'); 
//funciton to get the default dashboard of the user
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Allusers_demo - <?php echo SITENAME; ?></title>
		<meta name="description" content="Static & Dynamic Tables" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<!-- basic styles -->
		<link href="assets/css/bootstrap.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.css" rel="stylesheet" />
		<link rel="stylesheet" href="assets/css/font-awesome.css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
		<!-- page specific plugin styles -->
		<link rel="stylesheet" type="text/css" media="all" href="assets/css/datepicker.css" />
		<link rel="stylesheet" type="text/css" media="all" href="assets/css/daterangepicker.css" />
		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.css" />
		<link rel="stylesheet" href="assets/css/ace-skins.css" />
		<!--[if lt IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->
	</head>
	<body>
		<div id="pageloading" style="display:none;position:fixed;z-index:200;background-color:white;padding:3px 10px 3px 10px;left: 50%;margin-left:-50px;">
			<div class=" smaller lighter "><i class="icon-spinner icon-spin orange bigger-125"></i> Loading ... </div>
		</div>
		<?php include("header.php"); ?>
		<div class="container-fluid" id="main-container">
			<?php include("sidebar.php"); ?>
			<div id="main-content" class="clearfix">
					<div id="breadcrumbs">
						<ul class="breadcrumb">
							<li><i class="icon-home"></i> <a href="#">Home</a><span class="divider"><i class="icon-angle-right"></i></span></li>
							<li class="active">Users</li>
						</ul><!--.breadcrumb-->
						<div id="nav-search">
							<form class="form-search">
									<span class="input-icon">
										<input autocomplete="off" id="nav-search-input" type="text" class="input-small search-query" placeholder="Search ..." />
										<i id="nav-search-icon" class="icon-search"></i>
									</span>
							</form>
						</div><!--#nav-search-->
					</div><!--#breadcrumbs-->
					<div id="page-content" class="clearfix">
						<div class="page-header position-relative">
							    <span class="dropdown pull-right" style="float:right;cursor:pointer">
        <div href="#" data-placement="bottom"  data-toggle="dropdown" class="allpops" style="padding:8px;" data-original-title="">
 <span class="hidden-phone"> Columns </span> <b class="caret"></b> </div>
        <ul class="dropdown-menu">
          <li id="fieldstodisplay" class="span3" style="margin:0px;padding: 3px 20px;">
            <p><strong>Display Fields</strong></p>
		  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="id"><span class="lbl"> Id </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="username"><span class="lbl"> UserName </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="password"><span class="lbl"> Password </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="token"><span class="lbl"> Token </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="is_enabled"><span class="lbl"> Enabled </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="first_name"><span class="lbl"> First Name </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="last_name"><span class="lbl"> Last Name </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="address"><span class="lbl"> Address </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="mobile"><span class="lbl"> Mobile No. </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="phone"><span class="lbl"> Phone </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="email"><span class="lbl"> Email </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="birth_date"><span class="lbl"> Birth Date </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="code"><span class="lbl"> Code </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="profile_image"><span class="lbl"> Profile Image </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="gender"><span class="lbl"> Gender </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="longitude"><span class="lbl"> Longitude </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="latitude"><span class="lbl"> Lattitude </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="zoom_level"><span class="lbl"> Zoom </span></label>
          </li>
        </ul>
      </span>
	  <button data-target="#myModal" data-toggle="modal" id="addnewrec"  class="pull-right btn btn-small btn-primary">Add</button>
							<h1>Users<small><i class="icon-double-angle-right"></i> Mangement</small></h1>
						</div><!--/page-header-->
						<div class="row-fluid" >
<!-- PAGE CONTENT BEGINS HERE -->
<div style="100%" id="section_allusers_demo">
<div class="row-fluid" >
	<!-- TABS BUTTON HEADINGS ENDS HERE  -->
	 <div class="tab-pane active" id="home" >
	<!--  ACTION BOX - Shown when a record  is slected  -->
	<div id="actionbox" class="actionbox alert alert-info" style="display:none">
	<!--  ACTION BUTTON  -->
	<div class="btn-group pull-right"> <a class="btn btn-primary" href="#">Action</a> <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"> <span class="caret"></span> </a>
		<ul class="dropdown-menu">
		  <!--li><a href="#"><i class="icon-pencil"></i> Edit</a></li-->
		  <li><a href="#" data-bind="click:deleteselecteddata"><i class="icon-trash"></i> Delete</a></li>
		</ul>
	  </div>
	  <strong> <span  class="selectcount">0</span> Records have been selected. <br/>
	  <span  class="" data-bind="text:total_records"></span> Records are available in Complete list. <a href="#">Click here to select Complete List</a> </strong>
	  <div style="clear:both;"></div>
	</div>
	<!--  ACTION BOX ENDS HERE -->
		<div role="grid" class="dataTables_wrapper" id="table_report_wrapper">
			<div class="row-fluid" style="padding:2px 0px 2px 0px;">
				<!-- search widget -->
				<div class="widget-box transparent collapsed pad10">
				<div class="widget-header" style="border-bottom:none;">
						<h4>
					<div id="table_report_length" class="dataTables_length">
						<label>
							Display
								<select aria-autocomplete="none" autocomplete="off" name="per_page" id="per_page" size="1" aria-controls="table_report" data-bind="event:{change: ChangePerPageRecords}">
								<option>1</option>
								<option>2</option>
								<option>5</option>
								<option selected="selected">10</option>
								<option>20</option>
								<option>50</option>
								<option>100</option>
							  </select>
							records
						</label>
					</div>
						</h4>
						<div class="widget-toolbar no-border">
							<a data-action="collapse" class="btn btn-primary btn-mini" href="#"> &nbsp;&nbsp;Search  <i class="icon-chevron-down icon-small"></i> &nbsp;</a>
						</div>
					</div>
					<div class="widget-body"><div class="widget-body-inner">
					 <div class="widget-main padding-5">
						 <!-- SEARCH TAB CONTENT -->
									<div class="tab-pane" id="search"  style="padding-left:20px;">
							<h4>Search Filters</h4>
							<form class="form-horizontal form-horizontal-search" name="advance_search" id="advance_search">
		<div class="control-group">
				<label class="control-label " > Id</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--id" class="pag_filter input-medium search-query " placeholder="Search Id">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > UserName</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--username" class="pag_filter input-medium search-query " placeholder="Search UserName">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Password</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--password" class="pag_filter input-medium search-query " placeholder="Search Password">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Token</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--token" class="pag_filter input-medium search-query " placeholder="Search Token">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Enabled</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--is_enabled" class="pag_filter input-medium search-query " placeholder="Search Enabled">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > First Name</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--first_name" class="pag_filter input-medium search-query " placeholder="Search First Name">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Last Name</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--last_name" class="pag_filter input-medium search-query " placeholder="Search Last Name">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Address</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--address" class="pag_filter input-medium search-query " placeholder="Search Address">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Mobile No.</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--mobile" class="pag_filter input-medium search-query " placeholder="Search Mobile No.">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Phone</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--phone" class="pag_filter input-medium search-query " placeholder="Search Phone">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Email</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--email" class="pag_filter input-medium search-query " placeholder="Search Email">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Birth Date</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--birth_date" class="pag_filter input-medium search-query " placeholder="Search Birth Date">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Code</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--code" class="pag_filter input-medium search-query " placeholder="Search Code">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Profile Image</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--profile_image" class="pag_filter input-medium search-query " placeholder="Search Profile Image">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Gender</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--gender" class="pag_filter input-medium search-query " placeholder="Search Gender">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Longitude</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--longitude" class="pag_filter input-medium search-query " placeholder="Search Longitude">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Lattitude</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--latitude" class="pag_filter input-medium search-query " placeholder="Search Lattitude">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Zoom</label>
				<div class="controls ">
					<input type="text"  id="pag_search_vt_users--zoom_level" class="pag_filter input-medium search-query " placeholder="Search Zoom">
				</div>
		</div>
								<div style="clear:both;"></div>
                                <div class="span6">
									<div class="controls align1">
										<button class="btn btn-small btn-primary" data-bind="click:$root.loadsearch" type="button">Apply Filter</button>
										<button class="btn btn-small btn-primary" id="rest_search" type="button">Reset Filters</button>
									</div>
								</div>
							</form>
						</div>
								<div style="clear:both;"></div>
						</div>
					</div></div>
				</div>			
			</div>
			<form name="maintableform" id="maintableform">
				<table id="table_report" class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th class="center sorting_disabled" role="columnheader" rowspan="1" colspan="1" style="width: 50px;" aria-label="
							">
								<label><input type="checkbox" id="selectall" class="title selectall" name="selectall" value="" /><span class="lbl"></span></label>
							</th>
							<th data-bind="click:sortby.bind($data, 'vt_users.username')" style="cursor: pointer; display: none;" class="col_username"><i class="sort_icon" id="sorticon_username"></i>UserName</th> 
							<th data-bind="click:sortby.bind($data, 'vt_users.first_name')" style="cursor: pointer; display: none;" class="col_first_name"><i class="sort_icon" id="sorticon_first_name"></i>First Name</th> 
							<th data-bind="click:sortby.bind($data, 'vt_users.last_name')" style="cursor: pointer; display: none;" class="col_last_name"><i class="sort_icon" id="sorticon_last_name"></i>Last Name</th> 
							<th data-bind="click:sortby.bind($data, 'vt_users.zoom_level')" style="cursor: pointer; display: none;" class="col_zoom_level"><i class="sort_icon" id="sorticon_zoom_level"></i>Zoom</th> 
							<th>Action</th>				
						</tr>
					</thead>
					<tbody data-bind="foreach:allusers_demo">
						<tr>
							<td class="center sorting_1">
								<label><input type="checkbox" class="title idcheck" name="id[]"  data-bind="attr:{value: id}" id="id[]" value="" /><span class="lbl"></span></label>
							</td>
										<td data-bind="text: username" class="col_username" style="display: none;"></td> 
										<td data-bind="text: first_name" class="col_first_name" style="display: none;"></td> 
										<td data-bind="text: last_name" class="col_last_name" style="display: none;"></td> 
										<td data-bind="text: zoom_level" class="col_zoom_level" style="display: none;"></td> 
							<td>
								<div class='hidden-phone visible-desktop btn-group'>
									<!--button class='btn btn-mini btn-success'><i class='icon-ok'></i></button-->
											<div class="inline position-relative">
											<button data-toggle="dropdown" class="btn btn-minier btn-primary dropdown-toggle"><i class="icon-cog icon-only"></i></button>
												<ul class="dropdown-menu dropdown-icon-only dropdown-light pull-right dropdown-caret dropdown-close">
													<li><a data-placement="left" data-bind="click:$parent.editItem" title="" data-rel="tooltip" class="tooltip-success" href="#" data-original-title="Edit"><span class="green"><i class="icon-edit"></i></span></a></li>
													<!--li><a data-placement="left"  title="" data-rel="tooltip" class="tooltip-warning" href="#" data-original-title="Flag"><span class="blue"><i class="icon-flag"></i></span> </a></li -->
													<li><a data-placement="left" data-bind="click:$parent.removeItem" title="" data-rel="tooltip" class="tooltip-error" href="#" data-original-title="Delete"><span class="red"><i class="icon-trash"></i></span> </a></li>
												</ul>
											</div>
									<!--button class='btn btn-mini btn-danger'><i class='icon-trash'></i></button>
									<button class='btn btn-mini btn-warning'><i class='icon-flag'></i></button-->
								</div>
								<div class='hidden-desktop visible-phone'>
									<div class="inline position-relative">
										<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown"><i class="icon-caret-down icon-only"></i></button>
										<ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
											<li data-bind="click:$parent.editItem"><a href="#" class="tooltip-success" data-rel="tooltip" title="Edit" data-placement="left" ><span class="green"><i class="icon-edit"></i></span></a></li>
											<!--li><a href="#" class="tooltip-warning" data-rel="tooltip" title="Flag" data-placement="left"><span class="blue"><i class="icon-flag"></i></span> </a></li>
											<li><a href="#" class="tooltip-error" data-rel="tooltip" title="Delete" data-placement="left"><span class="red"><i class="icon-trash"></i></span> </a></li-->
										</ul>
									</div>
								</div>
							</td>
						</tr>
						</tbody>
				</table>
			</form>
		</div>
		<div class="row-fluid">
			<div class="span6">
				<div class="dataTables_info" id="table_report_info">
					 Showing <span data-bind="text:recordfrom" class=""></span> to <span data-bind="text:recordto" class=""></span> of <span data-bind="text:total_records" class=""></span> entries
				</div>				 
			</div>
			<div class="span6">
				<div class="dataTables_paginate paging_bootstrap pagination">				
					<ul >
						<li class="prev"><a href="#" data-bind="click:$root.prevpage" ><i class="icon-double-angle-left"></i></a></li>
						 <!-- ko foreach: pagination-->
							<li data-bind="attr:{ 'class': cssclass }"><a data-bind="text: doctor_name,click:$parent.changepage" href="#"></a></li> 
						<!-- /ko -->
						<li class="next "><a href="#" data-bind="click:$root.nextpage"><i class="icon-double-angle-right"></i></a></li>
					</ul>					
				</div>
			</div>
		</div>		
	</div>
	   <!-- PAGINATION -->	
	 <!-- Modal -->
	<div id="myModal"  style="width: 96%; margin-left:0px;left: 2%;top:2%;" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h3 id="myModalLabel">Add New</h3>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" name="add_new_form" id="add_new_form">
		 <input type="hidden"  id="pag_search_id" name="id" placeholder="id ">
              <input type="hidden" value=""  id="pag_search_id" name="id" placeholder="Id" required>
<div class="control-group">
            <label class="control-label" > UserName</label>
            <div class="controls">
              <input  class="span4"  value="" type="text"  id="pag_search_username" name="username" placeholder="UserName" required>
			  </div>
          </div>
<div class="control-group">
            <label class="control-label" > Password</label>
            <div class="controls">
              <input type="PASSWORD"   value=""  id="pag_search_password" name="password" placeholder="Password" required>
			  </div>
          </div>
              <input type="hidden" value=""  id="pag_search_token" name="token" placeholder="Token" required>
<div class="control-group">
            <label class="control-label" >Enabled</label>
            <div class="controls">
          <select  id="pag_search_is_enabled" name="is_enabled" placeholder="Enabled" >
			<?php
				$user_status_query ="select * from user_status";
				$user_status_rs = mysql_query($user_status_query) or die(mysql_error()."</br> Failed Query".$project_query );
				//Loop Placed here. 
				while($user_status_row = mysql_fetch_array($user_status_rs))
				{
				?> 
				<option value="<?php echo $user_status_row['status_value'] ;?>"><?php echo $user_status_row['user_status'] ;?></option>
				<?php 
				}
			?>
         </select>
		 </div>
          </div>
<div class="control-group">
            <label class="control-label" > First Name</label>
            <div class="controls">
              <input  class="span4"  value="" type="text"  id="pag_search_first_name" name="first_name" placeholder="First Name" required>
			  </div>
          </div>
<div class="control-group">
            <label class="control-label" > Last Name</label>
            <div class="controls">
              <input  class="span4"  value="" type="text"  id="pag_search_last_name" name="last_name" placeholder="Last Name" required>
			  </div>
          </div>
<div class="control-group">
            <label class="control-label" > Address</label>
            <div class="controls">
              <input  class="span4"  value="" type="text"  id="pag_search_address" name="address" placeholder="Address" required>
			  </div>
          </div>
<div class="control-group">
            <label class="control-label" > Mobile No.</label>
            <div class="controls">
              <input  class="span4"  value="" type="text"  id="pag_search_mobile" name="mobile" placeholder="Mobile No." required>
			  </div>
          </div>
              <input type="hidden" value=""  id="pag_search_phone" name="phone" placeholder="Phone" required>
<div class="control-group">
            <label class="control-label" > Email</label>
            <div class="controls">
              <input  class="span4"  value="" type="text"  id="pag_search_email" name="email" placeholder="Email" required>
			  </div>
          </div>
<div class="control-group">
            <label class="control-label" >Birth Date</label>
            <div class="controls">
         <input type="text"  value=""  id="pag_search_birth_date" class="bootdatepickersingle"  name="birth_date" placeholder="Birth Date" required>
</div>
          </div>
              <input type="hidden" value=""  id="pag_search_code" name="code" placeholder="Code" required>
<div class="control-group">
            <label class="control-label" >Gender</label>
            <div class="controls">
          <select  id="pag_search_gender" name="gender" placeholder="Gender" >
			<?php
				$user_gender_query ="select * from user_gender";
				$user_gender_rs = mysql_query($user_gender_query) or die(mysql_error()."</br> Failed Query".$project_query );
				//Loop Placed here. 
				while($user_gender_row = mysql_fetch_array($user_gender_rs))
				{
				?> 
				<option value="<?php echo $user_gender_row['gender'] ;?>"><?php echo $user_gender_row['gender'] ;?></option>
				<?php 
				}
			?>
         </select>
		 </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary" data-bind="click:savenew" type="submit">Save</button>
      </div>
    </div>
</div>
</div>
<!-- PAGE CONTENT ENDS HERE -->
						 </div><!--/row-->
					</div><!--/#page-content-->
				<?php // include("skinsetting.php"); ?>
					<!--/#ace-settings-container-->
			</div><!-- #main-content -->
		</div><!--/.fluid-container#main-container-->
		</br>
		<a href="#" id="btn-scroll-up" class="btn btn-small btn-inverse">
			<i class="icon-double-angle-up icon-only"></i>
		</a>
		<!-- basic scripts -->
		<script src="assets/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript" src="js/knockout-2.1.0.js"></script>
		<script type="text/javascript" src="js/knockout.mapping.js"></script>
		<script type="text/javascript" src="js/json2.js"></script>
		<script type="text/javascript" src="js/jquery.loadJSON.js"></script>
		<script src="assets/js/bootstrap.js"></script>
		<!-- page specific plugin scripts -->
		<script type="text/javascript" src="assets/js/date.js"></script>
		<script type="text/javascript" src="assets/js/daterangepicker.js"></script>
		<script type="text/javascript" src="assets/js/bootstrap-datepicker.js"></script>
		<script src="ckeditor/ckeditor.js"></script>
		<script>
		$(document).ready(function(){
		});
		</script>
		<!-- ace scripts -->
		<script src="assets/js/ace-elements.js"></script>
		<script src="assets/js/ace.js"></script>
		<!-- inline scripts related to this page -->
 <script language="javascript">
$(function () {
		$('#myTab a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
		});
		$('.allpops').popover({delay :{ show: 1000, hide:0 }});
		$('#fieldstodisplay').click(function (e) {
			e.stopPropagation();
		});
		// Field Toggler. 
		$('.columncontrol').change(function(){
			column_name = $(this).val();
			if($(this).is(':checked'))
			{	
				$('.col_'+column_name).show();
			}
		else
			{ 
				$('.col_'+column_name).hide();
			}
		});
		// Select De Select list. 
		$('#selectall').change(function(){
			if($(this).is(':checked'))
				{	
					$('.idcheck').prop('checked', true);
				}
			else
				{ 
					$('.idcheck').prop('checked', false);
				}
		})
		$(document).on("change", ".idcheck,#selectall ", function(){
			if($('.idcheck:checked').length)
			{
					$('.selectcount').html($('.idcheck:checked').length);
					$('.actionbox').slideDown()
			}
			else
			{
					$('.actionbox').slideUp()
			}
		});
  })
</script>
<script type="text/javascript">
// CHECKLIST MODEL 
	function AppViewModelallusers_demo(allusers_demo) {
	var self = this;
		self.allusers_demo = allusers_demo;
		self.pagination = ko.observableArray([]);
		self.user_roles = ko.observableArray([]);
		self.total_page = 0;
		self.total_records = ko.observable('');
		self.current_page = 1;
		self.sort_by = 1;
		self.sort_direction = '';
		self.per_page = '10';
		self.recordfrom=ko.observable(1);;
		self.recordto=ko.observable(1);;
	// AJAX SORT 
	// Sends the current page not and fetches the data 
	self.prevpage = function()
	{
		if(parseInt(self.current_page)>1)
		{
			self.current_page = parseInt(self.current_page)-1;
			self.loaddata();
		}
	}
	self.nextpage = function()
	{
		if(parseInt(self.current_page)<self.total_page)
		{
			self.current_page = parseInt(self.current_page)+1;
			self.loaddata();
		}
	}
	self.sortby = function(fieldName,data){
		// The following will Toggle The Data.
		if(self.sort_by==fieldName)
		{
			if(self.sort_direction=="")
			{
				self.sort_direction="desc"
			}
			else
			{
				self.sort_direction=""
			}
		}
		// Updating the Icons
		field_name_ar =fieldName.split('.');
		$('.sort_icon').removeClass('icon-arrow-down');
		$('.sort_icon').removeClass('icon-arrow-up');
		if(self.sort_direction=="")
		{
			$('#sorticon_'+field_name_ar[1]).addClass('icon-arrow-down')
		}
		else
		{
			$('#sorticon_'+field_name_ar[1]).addClass('icon-arrow-up')
		}
		self.sort_by = fieldName;
		self.loaddata();
	}
	self.ChangePerPageRecords = function(PerPageValue) 
		{
			self.per_page = $('#per_page').val();
			self.current_page = 1;
			self.loaddata();
		}
	// ADD NEW ITEM
   self.addallusers_demo = function() {
		var fname="";
        self.allusers_demo.push({ id: ko.observable(),checklist_name: ko.observable() });
		self.saveallusers_demo();
    };
	self.update_pagination = function() {
		self.pagination.removeAll();
		var fname="";
		if(parseInt(self.total_page)>1)
		{
		for(i=1;i<parseInt(self.total_page)+1;i++)
			{
				cssclass = ko.observable();
				if(parseInt(self.current_page) == parseInt(i))
				{
					cssclass = ko.observable('active');
				}
				self.pagination.push({ doctor_name: ko.observable(i), cssclass: cssclass});
			}
		}
		$('.next, .prev').show();
		$('.next, .prev').removeClass('disabled');
		if(self.total_page==self.current_page)
		{
			$('.next').addClass('disabled');
		}
			if(self.current_page==1)
		{
			$('.prev').addClass('disabled');
		}
		if(self.total_page==1)
		{
			$('.next, .prev').hide();
		}
    };
	self.changepage = function (){
		self.current_page=this.doctor_name();
		self.loaddata();
	}
	self.deleteselecteddata = function(){
			$.ajax({
			type: "POST",
			url: "services/allusers_demo_delete.php",
			data: $('#maintableform').serialize() 
		}).done(function( msg ) {
			self.loaddata();
		});
	}
	// Save New Form Data
	self.savenew = function(){
		$.ajax({
		  type: "POST",
		   url: "services/allusers_demo_new.php",
		   data: $("#add_new_form").serialize()
		}).done(function( msg ) {
			$('#myModal').modal('hide');
			self.loaddata();
		});
	}
	self.pagestatustext =  function()
	{
		var pageStart 	= (parseInt(self.per_page) * ((parseInt(self.current_page)) - 1))+1;
		var pageEnd		= (((pageStart+parseInt(self.per_page)))-1)
		if(self.current_page==self.total_page)
		{
			pageEnd	 = pageEnd-((parseInt(self.per_page) * parseInt(self.total_page))-parseInt(self.total_records()));
		}
		self.recordfrom(pageStart);
		self.recordto(pageEnd);
	}
	self.loadsearch = function()
	{
		// Making the current page 1.
		self.current_page = 1;
		self.loaddata();
	}
	// LOAD DATA FUNCTION
	self.loaddata = function (){
	pag_filters ={};
	$("#pageloading").fadeIn();
	// Looping up all the filters start here. 
		$('.pag_filter').each(function(){
			param_name = $(this).attr('id');
			param_value = $(this).val();
			pag_filters[param_name] =param_value;
		})
		$('.pag_filter_date').each(function(){
			param_name = $(this).attr('id');
			param_value = $(this).val();
			pag_filters["date_"+param_name] =param_value;
		})
		pag_filters["page_no"] 			=	self.current_page;
		pag_filters["sort_by"] 			=	self.sort_by;
		pag_filters["sort_direction"] 	=	self.sort_direction;
		pag_filters["per_page"] 		=	self.per_page;
		$.ajax({
					type: "POST",
					url: "services/allusers_demo_fetch.php",
					data : pag_filters,
					dataType: 'json'
					}).done(
					function( data ) 
					{
						var viewModel = ko.mapping.fromJS(data.data);	
						ko.mapping.fromJS(viewModel, self.allusers_demo);
						self.total_page = data.total_pages;
						self.total_records(data.total_records);							
						self.user_roles(data.user_roles);
						self.update_pagination();
						$('.contactpopover').popover('destroy');
						$('.contactpopover').popover();
						$('#myTab a:last').tab('show');
						$('.columncontrol').trigger('change');
						$('#selectall').trigger('change');
						$("#pageloading").hide();
						self.pagestatustext();
					});
		}
	// SAVE THE MODEL
	self.saveallusers_demo = function() {
		$('#message').show();
		//alert(ko.toJSON(self.allusers_demo));
		mydataa = ko.toJSON(self.allusers_demo);
		$.ajax({
		  type: "POST",
		  url: "services/allusers_demo_update.php",
		  data: { mydata: mydataa }
			}).done(function( msg ) {
			//alert( "Data Saved: " + msg );
			self.loaddata();
			});
    };
	self.editItem = function() {
	   data = ko.toJS(this);
	   $('#add_new_form').loadJSON(data);
	   var browserName=navigator.appName; 
		if (browserName=="Microsoft Internet Explorer")
		{
		}
		else
		{
		}
	   $('#myModal').modal('show');
	   $('#myModalLabel').html("Edit Record");
	}
	// REMOVING AN ITEM FROM THE MODEL
	self.removeItem = function() {
        self.allusers_demo.remove(this);
		element_data = ko.toJS(this);
		$.ajax({
		  type: "POST",
		  url: "services/allusers_demo_delete.php",
		  data: { id: element_data.id }
			}).done(function( msg ) {
		});
	}
	} // MODEL ENDS
</script>
<!-- Document Ready Part Starts here -->
<script language="javascript">
$(document).ready(function(){
	var allusers_demo = new AppViewModelallusers_demo(ko.mapping.fromJS([]));
	ko.applyBindings((allusers_demo),$("#section_allusers_demo")[0]);
	allusers_demo.loaddata();
	allusers_demo.update_pagination();
});
</script>
<script type="text/javascript">
$(document).ready(function() {
	$('.bootdatepickersingle').datepicker({format: 'yyyy-mm-dd'}).on('changeDate',function(){
		$(this).datepicker('hide');
	});
	$('.bootdatepicker').daterangepicker({format: 'yyyy-MM-dd',separator: ' to '});
	// Click. 
	$('#deleteselected').click(function(){
	});
	$('#addnewrec').click(function(){
		$('#myModalLabel').html("Add Record");
			 clear_form_elements("#add_new_form");
	});
	$('#rest_search').click(function(){
			clear_form_elements("#advance_search");
	})
});
function clear_form_elements(ele) {
	$(ele).find(':input').each(function() {
        switch(this.type) {
            case 'password':
            case 'select-multiple':
            case 'select-one':
            case 'text':
			case 'hidden':
            case 'textarea':
                $(this).val('');
                break;
            case 'checkbox':
            case 'radio':
                this.checked = false;
        }
    });
}
</script>
<script language="javascript">
$(document).ready(function(){
	$('#reload_form').click(function(){
		$("#advance_search").trigger('reset');
	})
});
</script>
<style type="text/css">
.contactpopover {
	cursor:pointer;
}
.form-horizontal_search .control-group {
    float: left;
    margin-bottom: 12px;
    width: 380px;
}
</style>
	</body>
</html>
