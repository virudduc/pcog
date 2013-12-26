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
			$patient_id = get_current_patient_id($test_id);

			$fetch_answer_sql = 'select * from '.PCOG_PATIENT_RESPONSE.' as res left join '.PCOG_QUESTIONS_DOMAIN.' as dom on res.domain_id=dom.id where res.patient_id="'.$patient_id.'" and res.test_id="'.$test_id.'"';
			$fetch_answer_rec = $con->query($fetch_answer_sql);
			$fetch_answer_arr = $fetch_answer_rec->fetchAll(PDO::FETCH_ASSOC);
			
			$patient_resp = array();
			foreach($fetch_answer_arr as $resp)
			{
				$patient_resp[$resp['domain_name']][] = array($resp['sub_domain'],$resp['total_questions'],$resp['correct_answers']);
			}
			$response['patient_response'] = $patient_resp;
			$response['error'] = '';
		}
	}
	else
	{
		$response['error'] = 'Parameters are empty.';
	}
	echo json_encode($response);
?>