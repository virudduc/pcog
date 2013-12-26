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
		function process_is_enabled ( $field_value ) {
			$field_query = "select * from user_status where user_status ='" . trim( $field_value ) ."'";
			$field_rs = mysql_query( $field_query ) or die ( "CSV Update" . mysql_error() );
			if( mysql_num_rows( $field_rs ) > 0 )
			{
				// Return id if found
				$field_row = mysql_fetch_array( $field_rs );
				return $field_row[ 'status_value' ];
			}
			else
			{
				// Insert if not exist
				$field_insert_query = "insert into user_status (user_status) values( '$field_value' )";
				mysql_query( $field_insert_query ) or die ( "CSV Insert" . mysql_error() );
				return mysql_insert_id();
			}
		}
		function process_gender ( $field_value ) {
			$field_query = "select * from user_gender where gender ='" . trim( $field_value ) ."'";
			$field_rs = mysql_query( $field_query ) or die ( "CSV Update" . mysql_error() );
			if( mysql_num_rows( $field_rs ) > 0 )
			{
				// Return id if found
				$field_row = mysql_fetch_array( $field_rs );
				return $field_row[ 'gender' ];
			}
			else
			{
				// Insert if not exist
				$field_insert_query = "insert into user_gender (gender) values( '$field_value' )";
				mysql_query( $field_insert_query ) or die ( "CSV Insert" . mysql_error() );
				return mysql_insert_id();
			}
		}
	}
?>