<?php 
include("../connection.php") ;

/* 
For new product entry call check_category() function
and for edit a product call find_product_cat(36462,166) function

*/

class product_junction
{
//FOR FINDING A PARENT ID OF A CATEGORY
public static function junction($category_id,$userID)
{
	$fetch_pid_sql	=	"select pid from cms_product_categories where id=".$category_id." and pid<>0 ";
	$fetch_pid_rs	=	mysql_query($fetch_pid_sql);
	$fetch_pid		=	mysql_fetch_array($fetch_pid_rs);
	$category_id	=	$fetch_pid['pid'];
	
	 if(mysql_num_rows($fetch_pid_rs)>0)
	   {	
			self::check_category($category_id,$userID);
			//junction($category_id);
	   }
}

public static function check_category($cat_id,$userID)
{	
	
	//CHECK FOR UPDATE AND INSERT
	$check_category_sql	="select * from retailer_product_category_junction where category_id=".$cat_id." and retailer_id=".$userID.""; 
	$check_category_rs	=	mysql_query($check_category_sql);
	$count_category		=	mysql_num_rows($check_category_rs);
	if($count_category)
	{
		//UPDATE THE EXISTING CATEGORY AND INCRIMENT THE COUNT COLUMN
		//$check_category		=	mysql_fetch_array($check_category_rs);
		$cat_update_sql		=	"update retailer_product_category_junction set product_count=product_count+1 where retailer_id=".$userID." and category_id=".$cat_id."";
		mysql_query($cat_update_sql);
	}
	else
	{	
		$count			=	1;
		$cat_insert_sql	="insert into retailer_product_category_junction (retailer_id,category_id,product_count) values(".$userID.",".$cat_id.",".$count.")";
		mysql_query($cat_insert_sql);
	
	}
	
	self::junction($cat_id,$userID);
}

//FETCH PRODUCT CATEGORY ID
public static function find_product_cat($productID,$cat_id,$userID)
{	
	$product_catid_sql	=	"select product_category_id from cms_products where id=".$productID." and user_id=".$userID."";
	$product_catid_rs	=	mysql_query($product_catid_sql) or die(mysql_error()); 
	$product_catid		=	mysql_fetch_array($product_catid_rs);
	$product_catID		=	$product_catid['product_category_id'];
	if($cat_id!=$product_catID)
	{
		self::update_old_cat_junction($product_catID,$userID);
		self::check_category($cat_id,$userID);
	}
	
	return true;
}

public static function update_old_cat_junction($product_catID,$userID)
{
	$check_category_sql	="select product_count from retailer_product_category_junction where category_id=".$product_catID." and retailer_id=".$userID."";
	$check_category_rs	=	mysql_query($check_category_sql);
	$product_count_cat	=	mysql_fetch_array($check_category_rs);
	$product_count		=	$product_count_cat['product_count'];
	if($product_count>1)
	{
		$cat_update_sql		=	"update retailer_product_category_junction set product_count=product_count-1 where retailer_id=".$userID." and category_id=".$product_catID."";
		mysql_query($cat_update_sql);
	}
	else
	{
		$cat_update_sql		=	"delete from retailer_product_category_junction where retailer_id=".$userID." and category_id=".$product_catID."";
		mysql_query($cat_update_sql);
	}
	self::product_category($product_catID,$userID);
}

public static function product_category($category_id,$userID)
{
	$fetch_pid_sql	=	"select pid from cms_product_categories where id=".$category_id." and pid<>0 ";
	$fetch_pid_rs	=	mysql_query($fetch_pid_sql);
	$fetch_pid		=	mysql_fetch_array($fetch_pid_rs);
	$category_id	=	$fetch_pid['pid'];
	
	 if(mysql_num_rows($fetch_pid_rs)>0)
		{	
			self::update_old_cat_junction($category_id,$userID);
		}
}


//FUNCTION TO REBUILD THE JUNCTION TABLE
public static function rebuid()
{

	//EMPTY JUNCTION TABLE
	mysql_query("delete from retailer_product_category_junction");
	$products_sql	=	"select * from cms_products";
	$products_rs	=	mysql_query($products_sql);
	
	while($products		=	mysql_fetch_array($products_rs))
	{
		
		//INSERT ROWS INTO THE JUNCTION TABLE
		$cat_id	=	$products['product_category_id'];
		$userID	=	$products['user_id'];
		self::check_category($cat_id,$userID);
	
	}

}

}



?>