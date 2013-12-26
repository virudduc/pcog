<?php 
/*

Preamble      		: To make form from category. 
Creation Date 		: 2013/08/15
Authors 			: Shishir Raven & Vishnu Sharma. 
Last Modified date  : 

*/

// Class Defination starts here. 
 include('../connection.php'); 


class user_entry{
		
	var $user_id = "";
	var $product_id = "";
	var $attribute_values = array();
	
	// Error Array. 
	var $error_array = array();
		
		
	// INITIALIZER
	function initialize( $params = array() )
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
	}

	// CONSTRUCTOR
	function user_entry( $params = array() )
	{
		if (count($params) > 0)
		{
			$this->initialize($params);
		
		}
	}
	
	
	//FUNCTION TO ENTER THE ROW IN RELATED TABLES
	function entry()
	{	
		$userID	=	$this->user_id;
		$check_sql		=	"select count(*) as count from retailers_profile where user_id=".$userID." ";
		$check_rs		=	mysql_query($check_sql);
		$check_arr		=	mysql_fetch_array($check_rs);
		$count			=	$check_arr['count'];
		
		//CHECK WHETHER STORE TABLE HAS A ENTRY CORRESPONDING USER ID. IF NOT ENTER A ROW. 
		if(!$count)
		{
			$user_store_sql	=	"insert into retailers_profile(user_id) values(".$userID.")";
			if(mysql_query($user_store_sql))
			{
				$return_text	=	"User id inserted.";
				return $return_text;
			}
		}
		else
		{
			$return_text	=	"Already have this user id.";
			return $return_text;
		}
	}
	
	

}


	
$config = array();
$config['user_id'] 	= "200";

$entry = new user_entry($config);
echo $entry->entry(); 


?>