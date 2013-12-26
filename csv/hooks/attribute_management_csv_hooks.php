<?php
	/*
	PURPOSE : Processing function for the row before it is inserted into the Database. 
	HOW TO :	add a function with - 'process_' + <field_name>
	*/
	class csv_hook
	{
		function process_row( $row_to_process )
		{
			$processed_row= array();
			foreach($row_to_process  as $key => $field)
			{
				$processed_row[$key] =$field;
				if(method_exists(get_class(), 'process_'.$key))
				{
					$function_name = 'process_'.$key;
					$processed_row[$key] = csv_hook::$function_name( $processed_row[$key] );
				}
			}
			return $processed_row;
		}
		function process_category_id ( $field_value ) {
			$field_query = "select * from cms_product_categories where category_name ='" . trim( $field_value ) ."'";
			$field_rs = mysql_query( $field_query ) or die ( "CSV Update" . mysql_error() );
			if( mysql_num_rows( $field_rs ) > 0 )
			{
				// Return id if found
				$field_row = mysql_fetch_array( $field_rs );
				return $field_row[ 'id' ];
			}
			else
			{
				// Insert if not exist
				$field_insert_query = "insert into cms_product_categories (category_name) values( '$field_value' )";
				mysql_query( $field_insert_query ) or die ( "CSV Insert" . mysql_error() );
				return mysql_insert_id();
			}
		}
		function process_attribute_type ( $field_value ) {
			$field_query = "select * from attribute_type where attribute_type ='" . trim( $field_value ) ."'";
			$field_rs = mysql_query( $field_query ) or die ( "CSV Update" . mysql_error() );
			if( mysql_num_rows( $field_rs ) > 0 )
			{
				// Return id if found
				$field_row = mysql_fetch_array( $field_rs );
				return $field_row[ 'id' ];
			}
			else
			{
				// Insert if not exist
				$field_insert_query = "insert into attribute_type (attribute_type) values( '$field_value' )";
				mysql_query( $field_insert_query ) or die ( "CSV Insert" . mysql_error() );
				return mysql_insert_id();
			}
		}
	}
?>