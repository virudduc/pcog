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
			$question_fetch_sql = 'select ques.id as qid, ques.question_text, ques.question_type, subques.id as subqid, subques.sub_question_text, subques.check_supplement from '.PCOG_TEST_QUESTIONS.' as ques left join '.PCOG_SUB_QUESTIONS.' as subques on ques.id=subques.question_id where ques.status="1" order by ques.show_order';
			$question_fetch_rec = $con->query($question_fetch_sql);
			$question_fetch_arr = $question_fetch_rec->fetchAll(PDO::FETCH_ASSOC);
			$question_arr = array();
			foreach($question_fetch_arr as $ques)
			{
				$question_arr[$ques['qid']]['question_type'] = $ques['question_type'];
				if($ques['question_type'] == '3' || $ques['question_type'] == '4')
				{
					$img_sql = 'select filename from '.PCOG_TEST_IMAGES.' where id in ('.$ques['sub_question_text'].') order by id';
					$img_fetch_rec = $con->query($img_sql);
					$img_fetch_arr = $img_fetch_rec->fetchAll(PDO::FETCH_ASSOC);
					foreach($img_fetch_arr as $img)
					{
						$question_arr[$ques['qid']]['subques'][$ques['subqid']][] = $img['filename'];
					}
				}
				else
				{
					if($ques['check_supplement'] != '0')
					{
						$sentence_sql = 'select supplement_text from '.PCOG_QUESTION_SUPPLEMENTS.' where sub_ques_id="'.$ques['subqid'].'"';
						$sentence_fetch_rec = $con->query($sentence_sql);
						$sentence_fetch_arr = $sentence_fetch_rec->fetchAll(PDO::FETCH_ASSOC);
						shuffle($sentence_fetch_arr);
						$question_arr[$ques['qid']]['subques'][$ques['subqid']] = $sentence_fetch_arr[array_rand($sentence_fetch_arr,1)]['supplement_text'];
					}
					else
					{
						$question_arr[$ques['qid']]['subques'][$ques['subqid']] = $ques['sub_question_text'];
					}
				}
			}
			$response['questions'] = $question_arr;
			$response['question_domains'] = get_all_question_domains();
			$response['error'] = '';
		}
	}
	else
	{
		$response['error'] = 'Parameters are empty.';
	}
	echo json_encode($response);
?>