var Map;

(function($) {
	var zoom = 8;
	Map = {
		map: null,
		markers: [],
		init: function(config) {
			if(((isNaN(config.coord_lat) == true)|| config.coord_lat =="") || (config.coord_long=="" ||(isNaN(config.coord_long) == true)))
			{				
				config.coord_lat = parseFloat(config.defaultlat);
				config.coord_long =  parseFloat(config.defaultlongtt);
			}
			var settings = {
				lat_selector: '#lat',
				long_selector: '#long',
				onComplete: false,
				starting_query: null,
				coord_lat : config.coord_lat ,
				coord_long : config.coord_long,
				zoomlevel:  config.zoomlevelfield
				
			};
			
			if (window.parent.$.coordinate_picker && window.parent.$.coordinate_picker.settings)
			{
				$.extend(settings, window.parent.$.coordinate_picker.settings);
			}
			
			zoom = parseInt(settings.zoomlevel);
			// Center of US Coords
			var coord_lat = settings.coord_lat, coord_long = settings.coord_long;
			
			Map.address(coord_lat,coord_long,zoom);
			

			$('#search_map').focus();

			$('#search_address_button').click(function() {
				$(this).parents('form').submit();
			});
			
			$("#search_map").keypress(function(e){			
				if (e.keyCode == 13) {	
				
					$("#search_address_submit").trigger("click");
				}
			});

			$('#search_map_form').submit(function(e) {				
				e.preventDefault();
				Map.getLatLong($('#search_map').val());
			});

			$('#select_coords_button').click(function(e) {
				var coords = {'lat': $('#lat').val(), 'long': $('#long').val()};
				if ($.isFunction(settings.onComplete))
				{
					settings.onComplete(coords);
				}
				else
				{
					if ($(settings.long_selector, window.parent.document).length)
					{
						$(settings.long_selector, window.parent.document).val(coords.long);
					}

					if ($(settings.lat_selector, window.parent.document).length)
					{
						$(settings.lat_selector, window.parent.document).val(coords.lat);
					}
				}

				// If using smodal box, close it. 
				if (window.parent.$.smodal)
				{
					window.parent.$.smodal.close();	
				}
				// try closing this window
				else
				{
					window.self.close();
				}
			});
			
			$("#save_map_btn").click(function(){
				$(longfield, window.parent.document).val( $("#long").val());
				$(lattfield, window.parent.document).val($("#lat").val());				
				$(zoomlevelfield, window.parent.document).val(Map.map.getZoom());				
				window.parent.$("#btnclose_mappicker").trigger("click");
		
			})
			

			if (settings.starting_query)
			{
				$('#search_map').val(settings.starting_query);
				$('#search_map_form').submit();
			}
			
			
		},
		address : function($lat,$lang,zoom)
		{
						// Define the latitude and longitude positions
			var latitude = parseFloat($lat); // Latitude get from above variable
			var longitude = parseFloat($lang); // Longitude from same
			var myLagLat= new google.maps.LatLng(latitude,longitude);
			  var mapOptions = {
				zoom: parseInt(zoom),
				center: myLagLat,
				mapTypeId: google.maps.MapTypeId.ROADMAP  };

			  Map.map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

			  var marker = new google.maps.Marker({
				position: Map.map.getCenter(),
				map: Map.map,
				draggable:true,				
				title: 'Click to zoom'
			  });
			  
			  Map.markers.push(marker);
			  Map.updatecordinates(); 
			 
			  google.maps.event.addListener(Map.map, 'center_changed', function() {
				// 3 seconds after the center of the map has changed, pan back to the
				// marker.

				window.setTimeout(function() {
				  Map.map.panTo(marker.getPosition());
				}, 3000);
			  });

			   google.maps.event.addListener(marker, "dragend", function(event) {					
					Map.updatecordinates();
				});
				
			  google.maps.event.addListener(marker, 'click', function() {
				Map.map.setZoom(8);
				Map.map.setCenter(marker.getPosition());				 	
			  });
		},			
		updatecordinates : function()
		{
			var marker = Map.markers[0];
			var markerLatLng = marker.getPosition();			
			var lat = markerLatLng.lat(), lng = markerLatLng.lng();
			$('#long').val(lng);
			$('#lat').val(lat);
			$('#on_long').text(lng.toFixed(3));
			$('#on_lat').text(lat.toFixed(3));
			$('#zoom_level').val(Map.map.getZoom());
		},		
		getLatLong : function(loc_address){
		  var geo = new google.maps.Geocoder;		 
		  geo.geocode({'address':loc_address},function(results, status){
				  if (status == google.maps.GeocoderStatus.OK) {
				
				   var latitude = parseFloat(results[0].geometry.location.lat());

				   var longitude = parseFloat(results[0].geometry.location.lng());
				    
				 
					Map.address(latitude,longitude,zoom);		
					$('#long').val(longitude);
					$('#lat').val(latitude);
					$('#on_long').text(longitude.toFixed(3));
					$('#on_lat').text(latitude.toFixed(3));
					$('#zoom_level').val(Map.map.getZoom());
				  } else {
					alert("Geocode was not successful for the following reason: " + status);
				  }
		   });
		  }	
	};


})(jQuery);


