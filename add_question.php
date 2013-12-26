<?php
	include_once 'header_config.php';
include("authentication.php"); 
$prompt = '';
if(isset($_POST['ques_add']))
{
	$qtext = escape($_POST['ques_text']);
	$qtype = escape($_POST['qtype']);
	$date = date('Y-m-d H:i:s');
	$qsts = 1;
	$insert_ques_sql = 'insert into pcog_test_questions(question_text, question_type, date_created, status, show_order) values("'.$qtext.'","'.$qtype.'","'.$date.'","'.$qsts.'",ifnull((select max(id)+1 from pcog_test_questions as s),1))';
	$a = $con->query($insert_ques_sql);
	
	$lastid_sql = 'SELECT last_insert_rowid() as last_id';
	$a = $con->query($lastid_sql);
	$lastid_arr = $a->fetch();
	$ques_id = $lastid_arr['last_id'];
	//print_r($_POST);
	//print_r(json_decode($_POST['selected_images']));
	
	//die;
	if($qtype == '1' || $qtype == '2')
	{
		for($i=0,$j=0; $i<count($_POST['sub_ques']); $i++)
		{
			if($_POST['sub_ques'][$i] != '')
			{
				$insert_sques_sql = 'insert into pcog_sub_questions(question_id, sub_question_text, status) values ("'.$ques_id.'","'.escape($_POST['sub_ques'][$i]).'","1")';
				$a = $con->query($insert_sques_sql);
				$j++;
			}
			$prompt = $j.' questions added successfully.';
		}
	}
	else if($qtype == '3' || $qtype == '4')
	{
		$insert_sques_sql = 'insert into pcog_sub_questions(question_id, sub_question_text, status) values ("'.$ques_id.'","'.implode(',',json_decode($_POST['selected_images'])).'","1")';
		$a = $con->query($insert_sques_sql);
		$prompt = 'Question added successfully.';
	}
	else
	{
		$prompt = 'Type is not valid.';
	}
}

$type_sql = 'select id, type_title from pcog_question_type order by id';
$type_rec = $con->query($type_sql);

$type_arr = $type_rec->fetchAll();
$type_str = '<option value="">Select a type</option>';
foreach($type_arr as $type)
{
	$type_str .= '<option value="'.$type['id'].'">'.$type['type_title'].' question</option>';
}

$image_table_data = '';
$img_sql = 'select * from pcog_question_images where status="1"';
$img_rec = $con->query($img_sql);

$img_arr = $img_rec->fetchAll();
//print_r($img_arr);
for($i=0; $i<count($img_arr); $i+=3)
{
	$image_table_data .= '<tr>';
	$image_table_data .= '<td id="td_drag_img-'.$img_arr[$i]['id'].'"><img class="drag_img" id="drag_img-'.$img_arr[$i]['id'].'" height="150px" width="150px" src="'.IMAGE_PATH.$img_arr[$i]['filename'].'" alt="loading"/></td>';
	if($img_arr[$i+1]['name']!='')
	{
		$image_table_data .= '<td id="td_drag_img-'.$img_arr[$i+1]['id'].'"><img class="drag_img" id="drag_img-'.$img_arr[$i+1]['id'].'" height="150px" width="150px" src="'.IMAGE_PATH.$img_arr[$i+1]['filename'].'" alt="loading"/></td>';
	}
	if($img_arr[$i+2]['name']!='')
	{
		$image_table_data .= '<td id="td_drag_img-'.$img_arr[$i+2]['id'].'"><img class="drag_img" id="drag_img-'.$img_arr[$i+2]['id'].'" height="150px" width="150px" src="'.IMAGE_PATH.$img_arr[$i+2]['filename'].'" alt="loading"/></td>';
	}
	$image_table_data .= '</tr>';
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
							<li class="active">Add a question</li>
						</ul><!--.breadcrumb-->

					
					</div><!--#breadcrumbs-->



					<div id="page-content" class="clearfix">
						
						<div class="page-header position-relative">
							<h1>Add a question<small><i class="icon-double-angle-right"></i> Fill the details</small></h1>
						</div><!--/page-header-->
						
						
						
						<div class="prompt">
						<?php echo (($prompt!='')?$prompt:'');?>
						</div>
						<div class="info">
						<form action="" method="post" name="subject_add" onsubmit="return confirmAction()">
							<table width="100%">
							<tr>
							<td valign="top">
							<table cellspacing="8" cellpadding="0" border="0" width="100%">
							<tr>
							<td>Select question type</td>
							<td>
							<select name="qtype" onchange="checkType(this.value)" required>
								<?php echo $type_str; ?>
							</select>
							</td>
							</tr>
							
							<tr>
							<td valign="top">Enter question text</td>
							<td><textarea name="ques_text" rows="5" cols="30" required></textarea></td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							<td valign="top" id="sub_heading_text">Enter sub-question text</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							<td valign="top">
								<table class="sub-question-table" id="sub-question-table" border="0" cellspacing="0" cellpadding="4">
								<tr id="tr1">
									<td>Q1</td>
									<td><input type="text" name="sub_ques[]" style="width:230px" required/></td>
									<td><input type="button" value="remove row" onclick="removeRow(1);"/></td>
								</tr>
								</table>
							</td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							<td><input class="sub-question-table" type="button" value="Add more" onclick="addMoreSubQuesText();"/></td>
							</tr>
							<tr>
							<td>&nbsp;</td>
							<td>
								<table cellspacing="0" cellpadding="0" border="0" width="100%" class="">
								<tr>
								<td>

								<div class="droppable_div" id="droppable_div_id">
								
								<span id="insert_drop_image"></span>
								<div class="clr"></div>
								</div>
								<input type="hidden" value="" name="selected_images" id="selected_images"/>
								</td>
								</tr>
								</table>
							</td>
							
							</tr>
							<tr>
							<td><input type="submit" name="ques_add" value="Add Question"/></td>
							<td>&nbsp;</td>
							</tr>
							</table>
							</td>
							<td valign="bottom">
							<table cellspacing="0" cellpadding="0" border="1" width="100%" class="ques_image_table">	
							<?php echo $image_table_data; ?>
							</table>
							</td>
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
		function removeRow(id)
		{
			var question = document.getElementsByName('sub_ques[]');
			if(question.length==1)
			{
				alert("Sorry, minimum 1 question required!");
			}
			else if(question.length == id)
			{
				$(("#tr"+id)).remove();
			}
			else
			{
				alert('Please remove from bottom.');
			}
		}
		function addMoreSubQuesText()
		{
			var table = document.getElementById("sub-question-table");
			var rowCount = table.rows.length;
			var row = table.insertRow(rowCount);
			rowCount = rowCount+1;	
			
			row.id="tr"+(rowCount);
			
			var cell1 = row.insertCell(0);
			cell1.innerHTML = 'Q'+rowCount;
			
			var cell2 = row.insertCell(1);
			cell2.innerHTML = '<input type="text" name="sub_ques[]" style="width:230px" required/>';
			
			var cell3 = row.insertCell(2);
			cell3.innerHTML = '<input type="button" value="remove row" onclick="removeRow('+rowCount+');"/>';
		}
		function checkType(type)
		{
			if(type=='3' || type=='4')
			{
				$('table.ques_image_table').css('visibility','visible');
				$('.sub-question-table input[type="text"]').attr('disabled',true);
				$('.sub-question-table').hide();
				$('#droppable_div_id').show();
				$('#sub_heading_text').html('Drag and drop the images to add');
			}
			else if(type=='1' || type=='2')
			{
				$('table.ques_image_table').css('visibility','hidden');
				$('.sub-question-table input[type="text"]').removeAttr('disabled');
				$('.sub-question-table').show();
				$('#droppable_div_id').hide();
				$('#sub_heading_text').html('Enter sub-question text');
			}
		}
		</script>
		<script type="text/javascript" src="js/drag_drop/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="js/drag_drop/jquery-ui.min.js"></script>
		<script type="text/javascript" src="js/drag_drop/jquery.ui.mouse.js"></script>
		<script type="text/javascript" src="js/drag_drop/jquery.ui.touch-punch.min.js"></script>
		<script type="text/javascript" src="js/drag_drop/jquery.ui.ipad.altfix.js"></script>
		<script type="text/javascript">
		var ids = new Array();
		var i = 0;
		$(".droppable_div").droppable({
			drop: function(ev, ui) { 
				var dragid = ui.draggable.attr("id");
				$(this).find('#insert_drop_image').append('<span class="remove_div" ><span rel="'+i+'" class="remove_anchor" id="remove_'+dragid+'">Remove</span><img class="dropped_img" src="'+$('#'+dragid).attr('src')+'" height="150px" width="150px"/></span>');
				imgid = dragid.split('-')[1];
				ids[i] =imgid
				i++;
				$('#selected_images').val(JSON.stringify(ids));
			}
		});
		$('.remove_anchor').live('click',function(){
			var index = $(this).attr('rel');
			ids.splice(index,1);
			$(this).parent().remove();
		});

		$(".drag_img").draggable({
			helper: 'clone', /* Drag a copy of the element */
			ghosting: true, /* Display the element in semi transparent fashion when dragging */
			opacity: 0.35, /* The transparency level of the dragged element */
			cursorAt: { top: 75, left: 75 }, /* Position the mouse cursor in the dragged element when starting to drag */
			cursor: 'move', /* Change the cursor shape when dragging */
			revert: 'invalid', /* Put back the dragged element if it could not be dropped */
			containment: 'body' /* Limit the area of dragging */
		  });
		  
		</script>
	</body>
</html>