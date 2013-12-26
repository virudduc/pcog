jQuery.fn.mappicker = function(options){	
	var settings = jQuery.extend({	
		longtfield : "",
		lattfield : "",
		zoomlevelfield : "",
		defaultlongt : -95.25148110961912 ,
		defaultlatt : 40.96174791270287 ,		
		backend : "modal.php"
	},options);
	
	this.each(function(){
		if(parseInt($("#mappicker_modal_container").length) <=0)
		{
			insert_modal(settings.backend);
		}		
		$(this).click(function(){		
			$("#mappicker_modal").modal("show");			
			$("#mapframe").attr("src","mappicker/map.php?longtfield="+escape(settings.longtfield)+"&lattfield="+escape(settings.lattfield)+"&zoomlevelfield="+escape(settings.zoomlevelfield)+"&defaultlongt="+escape(settings.defaultlongt)+"&defaultlatt="+escape(settings.defaultlatt));						
		})
	})
}

function insert_modal(modalurl)
{
	// Populating the selected text values values. 
	$.ajax({
	  type : "get",
	  url  : modalurl	
	}).done(function( html ) {		
	  	$("body").append(html)
	});
}