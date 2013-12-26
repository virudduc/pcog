<?php
//include('connection.php'); 
require_once 'header_config.php';
include("library/user_acl.php");
//include("authentication.php");

//funciton to get the default dashboard of the user

	 
	if(isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password']))
	{
			//echo md5($_POST['password'])."<br/>";
			//echo $_POST['password']."<br/>";
			//print_r($_POST);die;
	 		$adminSql = 'select * from pcog_admin where username="'.escape($_POST['email']).'" and password="'.md5(escape($_POST['password'])).'"';
			
			$a = $con->query($adminSql);
			
			
		  //echo $qry;
			
			//$result = mysql_query($qry);
			$adminDetails = $a->fetchAll();
						
			if(count($adminDetails)==1)
			{		
				$row = $adminDetails[0];	
				//print_r($row);
				/* //FETCH USER ROLE FROM JUNCTION TABLE
				$role_array	=	array();
				$user_role_sql	=	"select * from acl_junction_user_role where user_id=".$row['id']."";
				$user_role_rs	=	mysql_query($user_role_sql);
				while($user_role		=	mysql_fetch_array($user_role_rs))
				{
					$role_array[]	= $user_role['role_id'];
					
				}
				
				$row['role_id']	=	implode(",", $role_array); */
				
				if($row['status']=='1'){
					$_SESSION['userinfo']['username']=$adminDetails[0]['username'];
					$_SESSION['userinfo']['user_id']=$adminDetails[0]['id'];
					$token = rand(); 				
				
			/* 	if (isset($_POST['remember'])) {
           
            setcookie('username2', $_POST['email'], time()+60*60*24*365, '/account', 'www.example.com');
            setcookie('password2', $_POST['password'], time()+60*60*24*365, '/account', 'www.example.com');
        
			}  */
				 
				$message=array('title'=>'Login','text'=>'You are successfully logged in','type'=>'success');
 
					$_SESSION['message'][]=$message;
					//$dashboard_id = getDashboard($_SESSION['userinfo']['user_id']);  
				
					header("location:dashboard.php");
					//echo "<script type = 'text/javascript'> location.replace('dashboard.php?id=1&uid='".$row['id']."); </script>";
					exit;
					 }
				else if($row['status']=='0')
				{
					$message=array('title'=>'Login','text'=>'Your account is deactivated.','type'=>'error');
					$_SESSION['message'][]=$message;
				}
				else
				{
					$message=array('title'=>'Login','text'=>'Your account is deleted.','type'=>'error');
					$_SESSION['message'][]=$message;
				}
				 
			}
			else
			{			
					$message=array('title'=>'Login','text'=>'Username and password do not match','type'=>'error');
					$_SESSION['message'][]=$message;
					
			}
		}
		
		
		
		
		/* if(isset($_POST['forget']) && isset($_POST['email']))
		{
			$qry =	"select * from vt_users where email = '".mysql_real_escape_string($_POST['email'])."' ";
			$result = mysql_query($qry);
			 			
			if(mysql_num_rows($result) > 0)
			{		
			 
			 	$row = mysql_fetch_array($result);	
				
			 	$nomber = rand();
				$link = $site_base_path."/update_password.php?rand=$nomber&name=".$row["username"];
					
			 	$up_query = "UPDATE `vt_users` SET `code` = '$nomber' WHERE `email` = '".$_POST['email']."'";
				mysql_query($up_query);
				$email = $_POST['email'];
				$subject="Coolaura Forget Password link";
				$message="Hello,".$row["username"].'<br>';
				$message.="Please    <a href='$link'>click Here</a> for reset your password<br>"; 
				$message.="Thanks,<br>Coolaura.com"; 
				
				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
				$headers .= 'From:info@coolaura.com' . "\r\n";
				
				 
					mail($email, $subject, $message, $headers);
				  
					//echo "<script> location.replace('login.php'); </script>";
					$message=array('title'=>'Forget Password','text'=>'Please check your mail','type'=>'success');
 
					$_SESSION['message'][]=$message;			
				 
			}
			else
			{			
					$message=array('title'=>'Forget Password','text'=>'Invalid Email Address','type'=>'error');
					$_SESSION['message'][]=$message;
			}
		} */
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<title>Login Page - <?php echo "$application_title ";?></title>
		<meta name="description" content="User login page" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- basic styles -->
		<link href="assets/css/bootstrap.css" rel="stylesheet" />
		<link href="assets/css/bootstrap-responsive.css" rel="stylesheet" />

		<link rel="stylesheet" href="assets/css/font-awesome.css" />
		<!--[if IE 7]>
		  <link rel="stylesheet" href="assets/css/font-awesome-ie7.min.css" />
		<![endif]-->


		<!-- page specific plugin styles -->
		

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.css" />
		<link rel="stylesheet" href="assets/css/ace-responsive.css" />
		<!--[if lt IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

	</head>

	<body class="login-layout">
	
		<div class="container-fluid" id="main-container">
			<div id="main-content">
				<div class="row-fluid">
					<div class="span12">
						
<div class="login-container">

<div class="row-fluid">
	<div class="center">
		<h1><i class="icon-leaf green"></i> <span class="red"><?php echo $application_title; ?></span> <span class="white">P-Cog Admin Panel</span></h1>
		<!--h4 class="blue">&copy; e2focus.com</h4-->
	</div>
</div>

<div class="space-6"></div>

<div class="row-fluid">

<div class="position-relative">


	<div id="login-box" class="visible widget-box no-border">

		<div class="widget-body">
		 <div class="widget-main">
			<h4 class="header lighter bigger"><i class="icon-coffee green"></i> Please Enter Your Information</h4>
			<?php include("message_top.php"); ?>
			
			<div class="space-6"></div>
			
			<form name="login"  action="#" method="post" accept-charset="utf-8">
				 <fieldset>
					<label>
						<span class="block input-icon input-icon-right">
							<input type="text" name="email" class="span12" placeholder="Username" />
							<i class="icon-user"></i>
						</span>
					</label>
					<label>
						<span class="block input-icon input-icon-right">
							<input type="password" class="span12"  name="password" placeholder="Password" />
							<i class="icon-lock"></i>
						</span>
					</label>
					<div class="space"></div>
					<div class="row-fluid">
						<!--label class="span8">
							<input  value="remember-me" name="remember" type="checkbox"><span class="lbl"> Remember Me</span>
						</label-->
						<button type="submit" name="login" class="span4 btn btn-small btn-primary"><i class="icon-key"></i> Login</button>
					</div>
					
				  </fieldset>
			</form>
		 </div><!--/widget-main-->
		
		
		 <!--div class="toolbar clearfix">
			<div>
				<a href="#" onclick="show_box('forgot-box'); return false;" class="forgot-password-link"><i class="icon-arrow-left"></i> I forgot my password</a>
			</div>
			
		 </div-->
		</div><!--/widget-body-->

	</div><!--/login-box-->
	
	
	
	
	
	
	<!--div id="forgot-box" class="widget-box no-border">

		<div class="widget-body">
		 <div class="widget-main">
			<h4 class="header red lighter bigger"><i class="icon-key"></i> Retrieve Password</h4>
			
			<div class="space-6"></div>
			
			<p>
				Enter your email and to receive instructions
			</p>
			<form action="" method="post">
				 <fieldset>
					<label>
						<span class="block input-icon input-icon-right">
							<input type="email" name="email" class="span12" placeholder="Email" />
							<i class="icon-envelope"></i>
						</span>
					</label>
	
					<div class="row-fluid">
						<button type="submit" name="forget" class="span5 offset7 btn btn-small btn-danger"><i class="icon-lightbulb"></i> Send Me!</button>
					</div>
					
				  </fieldset>
			</form>
		 </div><!--/widget-main-->
		

		 <!--div class="toolbar center">
			<a href="#" onclick="show_box('login-box'); return false;" class="back-to-login-link">Back to login <i class="icon-arrow-right"></i></a>
		 </div>
		</div--><!--/widget-body-->

	</div--><!--/forgot-box-->
	
	

	
</div><!--/position-relative-->
	
</div>


</div>


					</div><!--/span-->
				</div><!--/row-->
			</div>
		</div><!--/.fluid-container-->


		<!-- basic scripts -->
		<script src="assets/js/jquery-1.9.1.min.js"></script>
		<script type="text/javascript">
		window.jQuery || document.write("<script src='assets/js/jquery-1.9.1.min.js'>\x3C/script>");
		</script>


		<!-- page specific plugin scripts -->
		

		<!-- inline scripts related to this page -->
		
		<script type="text/javascript">
		
function show_box(id) {
 $('.widget-box.visible').removeClass('visible');
 $('#'+id).addClass('visible');
}

		</script>

	</body>
</html>
