/* 
	Validation  Plugin 
  	Created on : Thursday, June 13, 2013
  	Programmer : Shishir raven
  
  Description: adds valiation to the form specified checking the form Server Side.
	 
	How to use: 
	
	Step 1 : Include this file into the form file

	Step 2: Write the following code

   $('#button_id').server_validation({
		form_id:'myform_without#',
		validtion_script:'services/script_that_will_return_json.php'
	});*/

jQuery.fn.server_validation = function(options){
//For each matching class
var settings = jQuery.extend({
		form_id	:"myfrom",
		validtion_script:"services/somescript.php",
		before_validate_callback:function(){
		}
		},options);

		this.each(function(){
		var element =$(this);
		var element_id=$(element).attr('id');
		$(element).click(function(){
		
		if(typeof(settings.before_validate_callback) == "function")
		{
			settings.before_validate_callback();
		}
		$(element).button('loading');
		var formdata= $('#'+settings.form_id).serialize();
   		$.ajax({
    		 type: "POST",
    		 url: settings.validtion_script,
     		data: formdata,
    		 dataType:"json",
    		 success: function(error_obj)
     			{
     				  if(error_obj==false)
     				  {

     				  	$('#'+settings.form_id).submit();
     				  }

     				   $('.error-message').remove();
               $('.control-group').removeClass('has-error');
      					for(var x in error_obj)
      					{
      					 $("<span class='help-block'> "+error_obj[x].error+"</span>").insertAfter('[name="'+error_obj[x].error_field+'"]');
                 $('[name="'+error_obj[x].error_field+'"]').parent().parent().addClass('has-error');
                }
     				$(element).button('reset');
    			 }
     		})

		});
		});
	}