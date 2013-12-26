<?php
	require_once 'header.php';
	$response = array();
	if(isset($_REQUEST['token']) && isset($_REQUEST['doctor_id']))
	{
		$token = escape($_REQUEST['token']);
		$doc_id = escape($_REQUEST['doctor_id']);
		$test_id = validate_token($doc_id, $token);
		if($test_id == 0 || $test_id == '0')
		{
			$response['error'] = 'Wrong parameters supplied.';
		}
		else
		{
			$response['sess_data']['token'] = $token;
			$response['sess_data']['doctor_id'] = $doc_id;
			$patient_data = array();
			$patient_data['doctor_name'] = escape($_REQUEST['doctor_name']);
			$patient_data['fname'] = escape($_REQUEST['fname']);
			$patient_data['sname'] = escape($_REQUEST['sname']);
			$patient_data['dob'] = escape($_REQUEST['dob']);
			$patient_data['exam_state'] = escape($_REQUEST['test_state']);
			$patient_data['education_yrs'] = (int)escape($_REQUEST['edu_years']);
			
			$patient_id = create_patient_account($patient_data);
			bind_patient_with_test($doc_id, $token, $patient_id);
			
			//$pat_reason_id = escape($_REQUEST['reason_for_testing']);
			$pat_resp = escape($_REQUEST['other_reason']);
			
			$values = array();
			foreach($_REQUEST['reason_for_testing'] as $pat_reason_id)
			{
				if($pat_reason_id == OTHER_REASON_ID)
				{
					$values[] = '("'.$patient_id.'","'.$test_id.'","'.$pat_reason_id.'","'.$pat_resp.'","'.date('Y-m-d H:i:s').'")';
				}
				else
				{
					$values[] = '("'.$patient_id.'","'.$test_id.'","'.$pat_reason_id.'","","'.date('Y-m-d H:i:s').'")';
				}
			}
			
			$reason_sql = 'insert into '.PCOG_PATIENT_TEST_REASON.'(patient_id, test_id, reason_id, other_response, date_created) values '.implode(',', $values);
			$con->query($reason_sql);
		}
	}
	else
	{
		$response['error'] = 'Parameters are empty.';
	}
	echo json_encode($response);
?>