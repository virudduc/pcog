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
			$ques_domains = get_all_question_domains();
			/* $_REQUEST['answers'] = Array(
									'1' => Array (
									  'Orientation' => '5,4',
									  'remember' => '4,3',
									  'recognize' => '5,4',
									  ),
									'2' => Array(
									  'register' => '4,2',
									  'name_figures' => '3,1',
									  'repeat' => '1,1',
									  'command' => '1,0'
									  ),
									'3' => Array(
									  'Luria' => '1,1'
									  ),
									'4' => Array(
									  'logic' => '2,2'
									  ),
									'5' => Array(
									  'Serial' => '2,1'
									  ),
									'6' => Array(
									  'MoveFigures' => '2,2'
									  )
); */
			foreach($ques_domains as $domain)
			{
				if(is_array($_REQUEST['answers'][$domain['id']]))
				{
					foreach($_REQUEST['answers'][$domain['id']] as $subdomain=>$resp)
					{
						$ans = explode(',',escape($resp));
						echo$ans_sql = 'insert into '.PCOG_PATIENT_RESPONSE.'(patient_id, sub_domain, total_questions, date_created, date_modified, test_id, domain_id, status, correct_answers) values ("'.$patient_id.'","'.escape($subdomain).'","'.$ans[0].'","'.date('Y-m-d H:i:s').'","'.date('Y-m-d H:i:s').'","'.$test_id.'","'.$domain['id'].'","1","'.$ans[1].'")';
						$con->query($ans_sql);
					}
				}
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