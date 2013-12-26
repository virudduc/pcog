<?php
include("../connection.php");
include("../library/csvmapper.php");
$config = array();
$config['upload_path'] = "../csv_uploads";
$config['hooks_file']  =  "csv/hooks/tw_projects_csv_hooks.php";
//csv/hooks/tw_projects_csv_hooks.php
$config['table_name'] = "tw_projects";
$config['lines_percall'] = "200";
$config['ajax_page'] = "../csv_tw_projects_ajax.php";
$config['ajax_page_runner'] = "csv_tw_projects_ajax_runner.php";
$config['check_csv_line'] = 100;
$field_ar = array();
		//Table fields list
		$config['table_fields'] = $field_ar;
		$csv_ob = new csvmapper($config);
                // insert data, call by ajax
                $csv_ob->insert_counter_data();
?>