<?php
function escape($string)
{
	return sqlite_escape_string($string);
}
function validate_token($doc_id, $tok)
{
	global $con;
	$sql = 'select id as test_id from '.PCOG_TEST.' where doctor_id="'.$doc_id.'" and token="'.$tok.'" and status="1"';
	$test_rec = $con->query($sql);
	$test_arr = $test_rec->fetch(PDO::FETCH_ASSOC);
	if(empty($test_arr))
	{
		return 0;
	}
	return $test_arr['test_id'];
}
function create_patient_account($pat_data)
{
	global $con;
	$reg_pat_sql = 'insert into '.PCOG_PATIENT_ACCOUNT.'(fname, sname, dob, education_years, exam_state, date_created, doctor_name) values("'.$pat_data['fname'].'","'.$pat_data['sname'].'","'.$pat_data['$dob'].'","'.$pat_data['education_yrs'].'","'.$pat_data['exam_state'].'","'.date('Y-m-d H:i:s').'","'.$pat_data['doctor_name'].'")';
	$con->query($reg_pat_sql);
	$patient_id_sql = 'select last_insert_rowid() as pat_id';
	$patient_id_rec = $con->query($patient_id_sql);
	$patient_id_arr = $patient_id_rec->fetch(PDO::FETCH_ASSOC);
	return $patient_id_arr['pat_id'];
}
function bind_patient_with_test($doc_id, $token, $patient_id)
{
	global $con;
	$bind_pat_sql = 'update '.PCOG_TEST.' set patient_id="'.$patient_id.'" where doctor_id="'.$doc_id.'" and token="'.$token.'"';
	$con->query($bind_pat_sql);
}
function get_all_question_domains()
{
	global $con;
	$domain_fetch_sql = 'select id, domain_name from '.PCOG_QUESTIONS_DOMAIN.' where status="1"';
	$domain_fetch_rec = $con->query($domain_fetch_sql);
	return $domain_fetch_rec->fetchAll(PDO::FETCH_ASSOC);
}
function get_current_patient_id($tid)
{
	global $con;
	$sql = 'select patient_id from '.PCOG_TEST.' where id="'.$tid.'"';
	$fetch_rec = $con->query($sql);
	$fetch_arr = $fetch_rec->fetch(PDO::FETCH_ASSOC);
	return $fetch_arr['patient_id'];
}
function create_token($length)
{
	if($length>0) 
	{ 
		$rand_id="";
		for($i=1; $i<=$length; $i++)
		{
			mt_srand((double)microtime() * 1000000);
			$num = mt_rand(1,36);
			$rand_id .= assign_rand_value($num);
		}
	}
	return $rand_id;
}
function assign_rand_value($num)
{
	// accepts 1 - 36
	switch($num)
	{
		case "1":
			$rand_value = "A";
		break;
		case "2":
			$rand_value = "B";
		break;
		case "3":
			$rand_value = "C";
		break;
		case "4":
			$rand_value = "D";
		break;
		case "5":
			$rand_value = "E";
		break;
		case "6":
			$rand_value = "F";
		break;
		case "7":
			$rand_value = "G";
		break;
		case "8":
			$rand_value = "H";
		break;
		case "9":
			$rand_value = "I";
		break;
		case "10":
			$rand_value = "J";
		break;
		case "11":
			$rand_value = "K";
		break;
		case "12":
			$rand_value = "L";
		break;
		case "13":
			$rand_value = "M";
		break;
		case "14":
			$rand_value = "N";
		break;
		case "15":
			$rand_value = "O";
		break;
		case "16":
			$rand_value = "P";
		break;
		case "17":
			$rand_value = "Q";
		break;
		case "18":
			$rand_value = "R";
		break;
		case "19":
			$rand_value = "S";
		break;
		case "20":
			$rand_value = "T";
		break;
		case "21":
			$rand_value = "U";
		break;
		case "22":
			$rand_value = "V";
		break;
		case "23":
			$rand_value = "W";
		break;
		case "24":
			$rand_value = "X";
		break;
		case "25":
			$rand_value = "Y";
		break;
		case "26":
			$rand_value = "Z";
		break;
		case "27":
			$rand_value = "0";
		break;
		case "28":
			$rand_value = "1";
		break;
		case "29":
			$rand_value = "2";
		break;
		case "30":
			$rand_value = "3";
		break;
		case "31":
			$rand_value = "4";
		break;
		case "32":
			$rand_value = "5";
		break;
		case "33":
			$rand_value = "6";
		break;
		case "34":
			$rand_value = "7";
		break;
		case "35":
			$rand_value = "8";
		break;
		case "36":
			$rand_value = "9";
		break;
	}
	return $rand_value;
}
?>