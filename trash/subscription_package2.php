<?php
include("define.php");
include('connection.php'); 
//funciton to get the default dashboard of the user
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Subscription_package - <?php echo SITENAME; ?></title>
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
							<li class="active">Subscription Packages</li>
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
				<input type="checkbox" class="columncontrol" checked="checked" value="package_name"><span class="lbl"> Package name </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="package_description"><span class="lbl"> Package description </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="package_price"><span class="lbl"> Package Price </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="package_role"><span class="lbl"> Package Role </span></label>  <label class="checkbox">
				<input type="checkbox" class="columncontrol" checked="checked" value="product_credits"><span class="lbl"> Product Credits </span></label>
          </li>
        </ul>
      </span>
	  <button data-target="#myModal" data-toggle="modal" id="addnewrec"  class="pull-right btn btn-small btn-primary">Add</button>
							<h1>Subscription Packages<small><i class="icon-double-angle-right"></i> Management</small></h1>
						</div><!--/page-header-->
						<div class="row-fluid" >
<!-- PAGE CONTENT BEGINS HERE -->
<div style="100%" id="section_subscription_package">
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
					<input type="text"  id="pag_search_sub_subscription_package--id" class="pag_filter input-medium search-query " placeholder="Search Id">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Package name</label>
				<div class="controls ">
					<input type="text"  id="pag_search_sub_subscription_package--package_name" class="pag_filter input-medium search-query " placeholder="Search Package name">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Package description</label>
				<div class="controls ">
					<input type="text"  id="pag_search_sub_subscription_package--package_description" class="pag_filter input-medium search-query " placeholder="Search Package description">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Package Price</label>
				<div class="controls ">
					<input type="text"  id="pag_search_sub_subscription_package--package_price" class="pag_filter input-medium search-query " placeholder="Search Package Price">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Package Role</label>
				<div class="controls ">
					<input type="text"  id="pag_search_sub_subscription_package--package_role" class="pag_filter input-medium search-query " placeholder="Search Package Role">
				</div>
		</div>
		<div class="control-group">
				<label class="control-label " > Product Credits</label>
				<div class="controls ">
					<input type="text"  id="pag_search_sub_subscription_package--product_credits" class="pag_filter input-medium search-query " placeholder="Search Product Credits">
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
							<th data-bind="click:sortby.bind($data, 'sub_subscription_package.id')" style="cursor: pointer; display: none;" class="col_id"><i class="sort_icon" id="sorticon_id"></i>Id</th> 
							<th data-bind="click:sortby.bind($data, 'sub_subscription_package.package_name')" style="cursor: pointer; display: none;" class="col_package_name"><i class="sort_icon" id="sorticon_package_name"></i>Package name</th> 
							<th data-bind="click:sortby.bind($data, 'sub_subscription_package.package_description')" style="cursor: pointer; display: none;" class="col_package_description"><i class="sort_icon" id="sorticon_package_description"></i>Package description</th> 
							<th data-bind="click:sortby.bind($data, 'sub_subscription_package.package_price')" style="cursor: pointer; display: none;" class="col_package_price"><i class="sort_icon" id="sorticon_package_price"></i>Package Price</th> 
							<th data-bind="click:sortby.bind($data, 'sub_subscription_package.package_role')" style="cursor: pointer; display: none;" class="col_package_role"><i class="sort_icon" id="sorticon_package_role"></i>Package Role</th> 
							<th data-bind="click:sortby.bind($data, 'sub_subscription_package.product_credits')" style="cursor: pointer; display: none;" class="col_product_credits"><i class="sort_icon" id="sorticon_product_credits"></i>Product Credits</th> 
							<th>Action</th>				
						</tr>
					</thead>
					<tbody data-bind="foreach:subscription_package">
						<tr>
							<td class="center sorting_1">
								<label><input type="checkbox" class="title idcheck" name="id[]"  data-bind="attr:{value: id}" id="id[]" value="" /><span class="lbl"></span></label>
							</td>
										<td data-bind="text: id" class="col_id" style="display: none;"></td> 
										<td data-bind="text: package_name" class="col_package_name" style="display: none;"></td> 
										<td data-bind="html: package_description" class="col_package_description" style="display: none;"></td> 
										<td data-bind="text: package_price" class="col_package_price" style="display: none;"></td> 
										<td data-bind="text: package_role" class="col_package_role" style="display: none;"></td> 
										<td data-bind="text: product_credits" class="col_product_credits" style="display: none;"></td> 
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
            <label class="control-label" > Package name</label>
            <div class="controls">
              <input  class="span4"  value="" type="text"  id="pag_search_package_name" name="package_name" placeholder="Package name" required>
			  </div>
          </div>
	<div class="control-group">
            <label class="control-label" > Package description</label>
            <div class="controls">
       <textarea  id="editor_package_description" name="package_description" placeholder="Package description" ></textarea>
	   </div>
          </div>
<div class="control-group">
            <label class="control-label" > Package Price</label>
            <div class="controls">
              <input  class="span4"  value="" type="text"  id="pag_search_package_price" name="package_price" placeholder="Package Price" required>
			  </div>
          </div>
<div class="control-group">
            <label class="control-label" >Package Role</label>
            <div class="controls">
          <select  id="pag_search_package_role" name="package_role" placeholder="Package Role" >
			<?php
				$acl_user_role_query ="select * from acl_user_role";
				$acl_user_role_rs = mysql_query($acl_user_role_query) or die(mysql_error()."</br> Failed Query".$project_query );
				//Loop Placed here. 
				while($acl_user_role_row = mysql_fetch_array($acl_user_role_rs))
				{
				?> 
				<option value="<?php echo $acl_user_role_row['id'] ;?>"><?php echo $acl_user_role_row['role_name'] ;?></option>
				<?php 
				}
			?>
         </select>
		 </div>
          </div>
<div class="control-group">
            <label class="control-label" > Product Credits</label>
            <div class="controls">
              <input  class="span4"  value="" type="text"  id="pag_search_product_credits" name="product_credits" placeholder="Product Credits" required>
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
						myeditor_package_description = CKEDITOR.replace( 'package_description' );
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
	function AppViewModelsubscription_package(subscription_package) {
	var self = this;
		self.subscription_package = subscription_package;
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
   self.addsubscription_package = function() {
		var fname="";
        self.subscription_package.push({ id: ko.observable(),checklist_name: ko.observable() });
		self.savesubscription_package();
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
			url: "services/subscription_package_delete.php",
			data: $('#maintableform').serialize() 
		}).done(function( msg ) {
			self.loaddata();
		});
	}
	// Save New Form Data
	self.savenew = function(){
						$('#editor_package_description').val(myeditor_package_description.getData());
		$.ajax({
		  type: "POST",
		   url: "services/subscription_package_new.php",
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
					url: "services/subscription_package_fetch.php",
					data : pag_filters,
					dataType: 'json'
					}).done(
					function( data ) 
					{
						var viewModel = ko.mapping.fromJS(data.data);	
						ko.mapping.fromJS(viewModel, self.subscription_package);
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
	self.savesubscription_package = function() {
		$('#message').show();
		//alert(ko.toJSON(self.subscription_package));
		mydataa = ko.toJSON(self.subscription_package);
		$.ajax({
		  type: "POST",
		  url: "services/subscription_package_update.php",
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
					myeditor_package_description.setData($('#editor_package_description').html());
		}
		else
		{
					myeditor_package_description.setData($('#editor_package_description').text());
		}
	   $('#myModal').modal('show');
	   $('#myModalLabel').html("Edit Record");
	}
	// REMOVING AN ITEM FROM THE MODEL
	self.removeItem = function() {
        self.subscription_package.remove(this);
		element_data = ko.toJS(this);
		$.ajax({
		  type: "POST",
		  url: "services/subscription_package_delete.php",
		  data: { id: element_data.id }
			}).done(function( msg ) {
		});
	}
	} // MODEL ENDS
</script>
<!-- Document Ready Part Starts here -->
<script language="javascript">
$(document).ready(function(){
	var subscription_package = new AppViewModelsubscription_package(ko.mapping.fromJS([]));
	ko.applyBindings((subscription_package),$("#section_subscription_package")[0]);
	subscription_package.loaddata();
	subscription_package.update_pagination();
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
