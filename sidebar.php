<?php 
//include_once("library/user_acl.php");
//$a = new ACL();
//$a->user_id = $_SESSION['userinfo']['user_id'];


function curPageName() {
 return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
?>


<a href="#" id="menu-toggler"><span></span></a><!-- menu toggler -->

			<div id="sidebar">
				<?php if($_SESSION['userinfo']['user_id']=='1') {?>
				<div id="sidebar-shortcuts">
					<div id="sidebar-shortcuts-large">
						<button class="btn btn-small btn-success"><i class="icon-signal"></i></button>
						<button class="btn btn-small btn-info"><i class="icon-pencil"></i></button>
						<button class="btn btn-small btn-warning"><i class="icon-group"></i></button>
						<button class="btn btn-small btn-danger"><i class="icon-cogs"></i></button>
					</div>
					<div id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>
						<span class="btn btn-info"></span>
						<span class="btn btn-warning"></span>
						<span class="btn btn-danger"></span>
					</div>
				</div><!-- #sidebar-shortcuts -->
				<?php }?>
				<ul class="nav nav-list">
					
					<li class="<?php echo (curPageName()=="dashboard.php")? 'active':'';?>">
					  <a href="dashboard.php">
						<i class="icon-dashboard"></i>
						<span>Dashboard</span>
					  </a>
					</li>
			
			
					
					
					
					<li class="<?php echo (curPageName()=="list_question.php" || curPageName()=="add_question.php")? 'active':'';?>">
					  <a href="#" class="dropdown-toggle" >
						<i class="icon-user"></i>
						<span>Manage Questions</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
			
						<li class="<?php echo (curPageName()=="list_question.php")? 'active':'';?>"><a href="list_question.php"><i class="icon-double-angle-right"></i> 
						Question list
						</a></li>
						<li class="<?php echo (curPageName()=="add_question.php")? 'active':'';?>"><a href="add_question.php"><i class="icon-double-angle-right"></i> 
						Add a question
						</a></li>
						
					  </ul>
					</li>
					<li class="<?php echo (curPageName()=="list_images.php" || curPageName()=="upload_ques_images.php")? 'active':'';?>">
					  <a href="#" class="dropdown-toggle" >
						<i class="icon-user"></i>
						<span>Manage Images</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
						<li class="<?php echo (curPageName()=="list_images.php")? 'active':'';?>"><a href="list_images.php"><i class="icon-double-angle-right"></i> 
						Image list
						</a></li>
						<li class="<?php echo (curPageName()=="upload_ques_images.php")? 'active':'';?>"><a href="upload_ques_images.php"><i class="icon-double-angle-right"></i> 
						Upload image
						</a></li>						
					  </ul>
					</li>
					<li class="">
					  <a href="#" class="dropdown-toggle" >
						<i class="icon-user"></i>
						<span>Profile</span>
						<b class="arrow icon-angle-down"></b>
					  </a>
					  <ul class="submenu">
			
						<li class=""><a href="change_profile.php"><i class="icon-double-angle-right"></i> 
						Edit password
						</a></li>
						<li class=""><a href="logout.php"><i class="icon-double-angle-right"></i> 
						Logout
						</a></li>
						
					  </ul>
					</li>
				
					
				
					

					
				</ul><!--/.nav-list-->

				<div id="sidebar-collapse"><i class="icon-double-angle-left"></i></div>


			</div><!--/#sidebar-->