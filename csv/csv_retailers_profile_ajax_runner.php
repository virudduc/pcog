<?php
include("../connection.php");
include("../library/csvmapper.php");
$config = array();
$config['upload_path'] = "../csv_uploads";
$config['hooks_file']  =  "csv/hooks/retailers_profile_csv_hooks.php";
//csv/hooks/retailers_profile_csv_hooks.php
$config['table_name'] = "retailers_profile";
$config['lines_percall'] = "200";
$config['ajax_page'] = "../csv_retailers_profile_ajax.php";
$config['ajax_page_runner'] = "csv_retailers_profile_ajax_runner.php";
$config['check_csv_line'] = 100;
$field_ar = array();
		$field_ar[]="user_id"; 
		$field_ar[]="store_name"; 
		$field_ar[]="store_address"; 
		//Table fields list
		$config['table_fields'] = $field_ar;
		$csv_ob = new csvmapper($config);
                // insert data, call by ajax
                $csv_ob->insert_counter_data();
?>