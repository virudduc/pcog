<?php
	require_once 'header.php';
	$response = array();
	if(isset($_REQUEST['user']) && isset($_REQUEST['string']))
	{
		$uname = escape($_REQUEST['user']);
		$pswd = escape($_REQUEST['string']);
		$udid = escape($_REQUEST['udid']);
		$check_sql = 'select id as doctor_id from '.PCOG_APP_USER.' where username="'.$uname.'" and password="'.$pswd.'" and status="1"';
		$user_rec = $con->query($check_sql);
		$user_arr = $user_rec->fetch(PDO::FETCH_ASSOC);
		if(empty($user_arr))
		{
			$response['error'] = 'Authentication failure.';
		}
		else
		{
			$response['sess_data']['token'] = $token = create_token(25);
			$response['sess_data']['doctor_id'] = $user_arr['doctor_id'];
			$test_name = 'test';
			$new_test_sql = 'insert into '.PCOG_TEST.'(test_name, token, doctor_id, status, unique_device_id, date_created) values("'.$test_name.'","'.$token.'","'.$user_arr['doctor_id'].'","1","'.$udid.'","'.date('Y-m-d H:i:s').'")';
			$con->query($new_test_sql);
			
			$cog_test_sql = 'select id, question_text from '.PCOG_COG_QUESTIONS.' where status="1" order by show_order asc';
			$cog_test_rec = $con->query($cog_test_sql);
			$cog_test_arr = $cog_test_rec->fetchAll(PDO::FETCH_ASSOC);
			foreach($cog_test_arr as $reason)
			{
				$response['test_reason_ques'][$reason['id']] = $reason['question_text'];
			}
			$response['error'] = '';
		}
	}
	else
	{
		$response['error'] = 'Parameters are empty.';
	}
	echo json_encode($response);
?>