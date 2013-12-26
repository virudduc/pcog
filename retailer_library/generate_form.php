<?php 
/*

Preamble      		: To make form from category. 
Creation Date 		: 2013/08/15
Authors 			: Shishir Raven & Vishnu Sharma. 
Last Modified date  : 

*/

// Class Defination starts here. 
// include('../connection.php'); 


class form_generator{
		
	var $category_id = "";
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
	function form_generator( $params = array() )
	{
		if (count($params) > 0)
		{
			$this->initialize($params);
		
		}
	}
	
	
	//FUNCTION TO CHECK ATTRIBUTE TYPE AND MAKE FIELDS
	function form()
	{
		$cat_id			=	$this->category_id; 
		if(!empty($this->product_id))
		{
			$attr_val = array();
			
			$attribute_value_sql	=	"select * from product_attribute_data where product_id=".$this->product_id." and category_id=".$cat_id." and user_id=".$_SESSION['userinfo']['user_id']."";
			$attribute_value_rs		=	mysql_query($attribute_value_sql) or die(mysql_error());
			while($attribute_value		=	mysql_fetch_array($attribute_value_rs))
			{
				$attr_val[$attribute_value['attribute_id']]	= $attribute_value['data']	;
			}
			
			$this->attribute_values=$attr_val;
		}
		
		$attr_type_sql	=	"select * from attribute_management where category_id=".$cat_id."";
		$attr_type_rs	=	mysql_query($attr_type_sql) or die(mysql_error());
		$attr_count		=	mysql_num_rows($attr_type_rs);
		if($attr_count)
		{
		while($attr_type = mysql_fetch_array($attr_type_rs))
			{
				//FOR TEXTBOX
				if($attr_type['attribute_type']==1)
					{
						$this->create_textbox($attr_type);
					}
					
				//FOR SELECT
				if($attr_type['attribute_type']==2)
					{
						$this->create_select($attr_type);
					}
					
				//FOR RADIO
				if($attr_type['attribute_type']==3)
					{
						$this->create_radio($attr_type);
					}
					
				//FOR CHECKBOX
				if($attr_type['attribute_type']==4)
					{
						$this->create_checkbox($attr_type);
						
					}
						
				//FOR TEXTAREA
				if($attr_type['attribute_type']==5)
					{
						$this->create_textarea($attr_type);
					}	
				
				//FOR FILE
				if($attr_type['attribute_type']==6)
					{
						$this->create_file_field($attr_type);
					}	
			}
			return $attr_count;
		}else
		{
			return $attr_count;
		}
	
	}
	
	//FUNCTION TO GENERATE TEXTBOX
	function create_textbox($attr_type)
	{ 
		if(!empty($this->attribute_values[$attr_type['id']]))
			{
				$value	=	$this->attribute_values[$attr_type['id']];
			}
	?>
	
		 <div class="control-group">
			<label class="control-label"><?php echo $attr_type['field_name'] ?></label>
			<div class="controls">
				<input type='text' name="attribute_<?php echo $attr_type['id'] ?>" value="<?php echo $value ?>" placeholder="<?php echo $attr_type['field_name'] ?>" class='form-control'></input>
			</div>
		</div>
		
		
	<?php } 
	 
	//FUNCTION TO GENERATE SELECT
	function create_select($attr_type)
	{ 
		if(!empty($this->attribute_values[$attr_type['id']]))
			{
				$value	=	$this->attribute_values[$attr_type['id']];
			}
		//RETRIEVE SELECT OPTION AND LABEL
		$option_sql	=	"select * from attribute_option where attribute_id=".$attr_type['id']."";
		$option_rs	=	mysql_query($option_sql) or die(mysql_error());
		  
		$option 	=	"<div class='control-group'>
						<label class='control-label'>".$attr_type['field_name']."</label>
						<div class='controls'>";
		$option 	.=	"<select name='attribute_".$attr_type['id']."' class='form-control'>";
		$option 	.=	"<option value=''>Select</option>";
		while($option_value	 =	mysql_fetch_array($option_rs)	)
			{
				$selected	=	"";
				if($option_value['option_value']==$value)
				{
					$selected	=	"selected='selected'";
				}
				$option 	.=	"<option value='".$option_value['option_value']."' ".$selected.">".$option_value['option_label']."</option>";
			}
				echo $option 	.=	"</select></div></div>";
	}
	
	//FUNCTION TO GENERATE RADIO BUTTON
	function create_radio($attr_type)
	{
		if(!empty($this->attribute_values[$attr_type['id']]))
			{
				$value	=	$this->attribute_values[$attr_type['id']];
			}
		//RETRIEVE SELECT OPTION AND LABEL
		$option_sql	=	"select * from attribute_option where attribute_id=".$attr_type['id']."";
		$option_rs	=	mysql_query($option_sql) or die(mysql_error());
		
		$option_radio		=	"<div class='control-group'>
									<label class='control-label'>". $attr_type['field_name']."</label>
								<div class='controls'>";
		while($option_value	 =	mysql_fetch_array($option_rs)	)
			{
				$checked	=	"";
				if($option_value['option_value']==$value)
				{
					$checked	=	"checked='checked'";
				}
			$option_radio 	.=	"  <label>
									<input type='radio' ".$checked." name='attribute_".$attr_type['id']."' value='".$option_value['option_value']."'>".$option_value['option_label']."
								  </label>
									";
			}
				echo $option_radio	.=	"</div></div>" ;
	}
	
	//FUNCTION TO GENERATE CHECKBOX
	function create_checkbox($attr_type)
	{ 	
		$checked 	=	"";
		if(!empty($this->attribute_values[$attr_type['id']]))
			{
				$checked	=	"checked='checked'";
			}
	?>
		<div class="control-group">
			<label class="control-label"><?php echo $attr_type['field_name'] ?></label>
			<div class="controls">
			  <label>
				<input type='checkbox' name="attribute_<?php echo $attr_type['id'] ?>" <?php echo $checked; ?> value='1' class='form-control'></input>
			  </label>
			</div>
		</div>

	<?php }
	
	//FUNCTION TO GENERATE TEXTAREA
	function create_textarea($attr_type)
	{ 
		if(!empty($this->attribute_values[$attr_type['id']]))
			{
				$value	=	$this->attribute_values[$attr_type['id']];
			}
	?>
		<div class="control-group">
			<label class="control-label"><?php echo $attr_type['field_name'] ?></label>
			<div class="controls">
				<textarea name="attribute_<?php echo $attr_type['id'] ?>" class='form-control'><?php echo $value; ?></textarea>
			</div>
		</div>
		
	<?php }
	
	//FUNCTION TO GENERATE FILE FIELD
	function create_file_field($attr_type)
	{ 
		if(!empty($this->attribute_values[$attr_type['id']]))
			{
				$value	=	$this->attribute_values[$attr_type['id']];
			}
	?>
		<div class="control-group">
			<label class="control-label"><?php echo $attr_type['field_name'] ?></label>
			<div class="controls">
				<input type='file' name="attribute_<?php echo $attr_type['id'] ?>" value="<?php echo $value; ?>"></input>
			</div>
		</div>
	<?php }
	
	
	//FUNCTION TO GENERATE FORM
	function form_generate()
	{	
		$form_count = $this->form(); 
		
		if(!$form_count)
		{
			return 1;
		}
		
	}
	
	//FUNCTION TO SHOW ATTRIBUTES VALUE
	function show()
	{
		$product_attributes_data	=	array();
		$attributes_sql	=	"select * from product_attribute_data as data left join attribute_management as attribute on data.attribute_id=attribute.id where product_id=".$this->product_id." and data.category_id=".$this->category_id."";
		$attribute_rs		=	mysql_query($attributes_sql) or die(mysql_error());
		while($attribute_value_rs	=	mysql_fetch_array($attribute_rs))
		{
			
			if(trim($attribute_value_rs['data'])!='')
			{
				$product_attributes_data[]	=	$attribute_value_rs;
			}
			
		}
		return $product_attributes_data;
	}

}
	
	

  	
/* $config = array();
$config['category_id'] 	= "1";
$config['product_id'] 	= "36415";

$generate = new form_generator($config);
$error = $generate->form_generate();  */


?>