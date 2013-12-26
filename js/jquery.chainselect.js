/* Validation  Plugin 
  Created on : 22 August 2013
  Programmer : Shishir raven
  
  Description : Plugin for Chain Select. 
 */
jQuery.fn.chainselect = function(options){

	var settings = jQuery.extend({
			backend_php	:"services/chain_categories.php",			
			ele_num : 0,
			create_id_byelement_id: ""
		},options);
	
	this.each(function(){

		var element =$(this);
		
		element.hide();
		var element_id=$(element).attr('id');
		$("#"+element_id+"_parent").remove();
		var control_value = element.val();
		$('<div id="'+ element_id +'_parent" />').insertAfter('#'+element_id);

		var container = $('#'+ element_id +'_parent');

		// If the Control is blank. 
		if( control_value == "")
		{
			control_value = 0;
		}
		// Generation of previous Element Starts here. 
		if( control_value != 0)
		{
			generate_select ( container , 0 , parseInt(control_value), settings.backend_php, element_id , settings.ele_num);
		
		}

		settings.create_id_byelement_id = element_id;
		generate_select( container , parseInt(control_value) , 0, settings.backend_php, element_id , settings.ele_num);
	})
	
		// On change create the elements.
		$("#"+settings.create_id_byelement_id+'_parent').unbind();
		$("#"+settings.create_id_byelement_id+'_parent').on('change','.dropdownch',function(){
			element = $(this);
			$(element).nextAll().remove();	
			element_parent = $(this).parent();
			//Add new element		
			element_value = $(this).val();
			if(element_value!="" && !isNaN(element_value))
			{
				getSubdr(element_parent , settings.backend_php ,settings.create_id_byelement_id,element_value);
			}
			$("#"+settings.create_id_byelement_id).val($(element).last().val());	
			
		})

		alertsettings = function(){
			  alert(settings.backend_php);

		}


};

$.fn.chainselect.alertsettings = function( txt ) {
	return "<strong>" + txt + "</strong>";
};

jQuery.fn.chainselect.alertsettings= function() {
   
 };


function generate_select( element, pid, cid , options_url , element_id , ele_num)
{
	
	// Populating the selected text values values. 
	$.ajax({
	  type: "POST",
	  url: options_url,
	  data: { pid: pid, cid:cid},
	  dataType: "json"
	}).done(function( selectoption ) {
		
	  	if(typeof(selectoption.jsons) != "undefined")
		{	
			ele_id= element_id+ele_num;	
				
			list = $('<select class="dropdownch" id="'+ele_id+'" ><option value=""> Select a Value </option></select>');
			
			$.each(selectoption.jsons, function(item,value) { 				
				 	list.append($('<option></option>').val(value.id).html(value.category_name));
			});

			if(cid==0)
			{
				element.append(list);
			}
			else
			{
				list.val(cid);
				element.prepend(list);
				if(parseInt(selectoption.elem_pid)!=0)
				{	
					//alert(parseInt(selectoption.elem_pid));
					generate_select( element , 0 , selectoption.elem_pid, options_url, list , ele_num);
				}
			}
		}
	});
}


// Add Child element
function getSubdr(element,options_url, firstelement_id, pid)
{	
	ele_num = parseInt(element.attr("rel"))+1;		
	generate_select( element , pid , 0 , options_url, firstelement_id , ele_num);
}
