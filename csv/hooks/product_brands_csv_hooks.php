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
	}
?>