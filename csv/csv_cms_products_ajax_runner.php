<?php
include("../connection.php");
include("../library/csvmapper.php");
$config = array();
$config['upload_path'] = "../csv_uploads";
$config['hooks_file']  =  "csv/hooks/cms_products_csv_hooks.php";
//csv/hooks/cms_products_csv_hooks.php
$config['table_name'] = "cms_products";
$config['lines_percall'] = "200";
$config['ajax_page'] = "../csv_cms_products_ajax.php";
$config['ajax_page_runner'] = "csv_cms_products_ajax_runner.php";
$config['check_csv_line'] = 100;
$field_ar = array();
		$field_ar[]="user_id"; 
		$field_ar[]="product_name"; 
		$field_ar[]="product_short_desc"; 
		$field_ar[]="description"; 
		$field_ar[]="product_price"; 
		$field_ar[]="discount"; 
		$field_ar[]="product_title_image"; 
		$field_ar[]="product_category_id"; 
		$field_ar[]="status"; 
		//Table fields list
		$config['table_fields'] = $field_ar;
		$csv_ob = new csvmapper($config);
                // insert data, call by ajax
                $csv_ob->insert_counter_data();
?>