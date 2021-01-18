$(function(){
	var project_id = document.getElementById("helper").getAttribute("project-id");

	var map,
		infoWindow,
		markers = [],
		markerCluster,
		data,
		capabilities = [],
		locations = [],
		active_locations = [],
		filters = [],
		filters_keys = [],
		twitter_followers = 0,
		twitter_following = 0,
		twitter_tweets = 0,
		max_hight = 0,
		max_hight = 0;

	var map_styles = [
					  {
					    "featureType": "landscape",
					    "stylers": [
					      { "visibility": "off" }
					    ]
					  },{
					    "featureType": "road",
					    "stylers": [
					      { "visibility": "simplified" }
					    ]
					  },{
					    "featureType": "transit",
					    "stylers": [
					      { "visibility": "off" }
					    ]
					  },{
					    "featureType": "administrative.land_parcel",
					    "stylers": [
					      { "visibility": "off" }
					    ]
					  },{
					    "featureType": "administrative.neighborhood",
					    "stylers": [
					      { "visibility": "off" }
					    ]
					  },{
					    "featureType": "poi",
					    "stylers": [
					      { "visibility": "off" }
					    ]
					  },{
					    "featureType": "road.local",
					    "stylers": [
					      { "visibility": "on" }
					    ]
					  },{
					    "featureType": "road.arterial",
					    "stylers": [
					      { "visibility": "on" }
					    ]
					  },{
					  }
					];

	function startmap() {
		var mapOptions = {
			center: new google.maps.LatLng(49,-96),
			zoom: 4,
			//minZoom: 1,
			maxZoom: 16,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.TL
			},
			mapTypeControl: false,
			scaleControl: false,
			streetViewControl: false,
			panControl: false
		};

		map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
		map.set('styles', map_styles);

		// infoWindow = new google.maps.InfoWindow();
		infoWindow = new InfoBubble({
			backgroundColor: 'rgba(0,0,0, 0.7)',
          	padding: 0,
          	borderWidth: 0,
          	//hideCloseButton: true,
          	//disableAutoPan: true,
			backgroundClassName : 'marker-detail'
		});

		google.maps.event.addListener(map, 'zoom_changed', function(event) {
			infoWindow.close();
		});

		loadViewViaAjax("/api/projects/"+project_id, initMapAndFilters);
	};


    function loadViewViaAjax(url, callback) {
    	$(".loading").fadeIn();
		$.getJSON(url, function(result) {
			data = result;
			callback.call();
		});//getJSON

	};


	var initMapAndFilters = function() {
		capabilities = data.capabilities;
		locations = data.companies;
		filters = data.filters;

		//uniqueLocations();
		active_locations = locations;
		drawMarkers();
		drawFilters();

		$(".loading").fadeOut(1000);
	};


	function drawMarkers(){
		//clear map
		infoWindow.close();
		for(i=0; i<markers.length; i++) 
			markers[i].setMap(null);
		if(markers.length>0)
			markerCluster.clearMarkers();
		markers = [];
		twitter_followers=0;
		twitter_following=0;
		twitter_tweets =0;
		var latlng_bounds = new google.maps.LatLngBounds();

		//draw matkers
		for (i = 0; i < active_locations.length; i++) 
		{
			var position = new google.maps.LatLng(active_locations[i].lat,active_locations[i].lng);
			var mark = new google.maps.Marker({
			    position: position,
			    lat: active_locations[i].lat,
			    lng: active_locations[i].lng,
			    name: active_locations[i].name,
			    employees: active_locations[i].employees,
			    capability: active_locations[i].capability,
				map: map,
			});
			latlng_bounds.extend(position);
			markers.push(mark);
			mark.setTitle(i.toString());
			google.maps.event.addListener(mark, 'click', function() {
				var index = this.getTitle();
			   	infoWindow.close();
				var latLng = this.getPosition(); // returns LatLng object
				//map.setCenter(latLng);
				//map.setZoom(10);
				infoWindow.setContent('	<div class="marker-detail">'+
											'<div class="caption">'+
												'<table>'+
													'<tr>'+
														'<td>name</td> <td>&nbsp;: '+active_locations[index].name+'</td>'+
													'</tr>'+
													'<tr>'+
														'<td>naics</td> <td>&nbsp;: '+active_locations[index].naics+'</td>'+
													'</tr>'+
													'<tr>'+
														'<td>phone</td> <td>&nbsp;: '+active_locations[index].phone+'</td>'+
													'</tr>'+
													'<tr>'+
														'<td>employees</td> <td>&nbsp;: '+Number(active_locations[index].employees).toFixed(0).replace(/(\d)(?=(\d{3})+$)/g, "$1,")+'</td>'+
													'</tr>'+
													'<tr>'+
														'<td>twitter followers</td> <td>&nbsp;: '+Number(active_locations[index].twitter_followers).toFixed(0).replace(/(\d)(?=(\d{3})+$)/g, "$1,")+'</td>'+
													'</tr>'+
													'<tr>'+
														'<td>twitter following</td> <td>&nbsp;: '+Number(active_locations[index].twitter_following).toFixed(0).replace(/(\d)(?=(\d{3})+$)/g, "$1,")+'</td>'+
													'</tr>'+
													'<tr>'+
														'<td>tweets</td> <td>&nbsp;: '+Number(active_locations[index].twitter_tweets).toFixed(0).replace(/(\d)(?=(\d{3})+$)/g, "$1,")+'</td>'+
													'</tr>'+
												'</table>'+
											'</div>'+
										'</div>');
				infoWindow.open(map, this);
				setTimeout(function(){$(".marker-detail").parent().css("overflow","hidden !important");},100);
			});

			twitter_followers += Number(active_locations[i].twitter_followers);
			twitter_following += Number(active_locations[i].twitter_following);
			twitter_tweets += Number(active_locations[i].twitter_tweets);
		}
		
		map.fitBounds(latlng_bounds);


		if (typeof MarkerClusterer == 'function') { 

			var mcClusterIconFolder = "/assets/img/cluster";
			var mcOptions = {
				maxZoom: 11,
				styles: [
				{
					height: 53,
					url: mcClusterIconFolder + "/m1.png",
					width: 53
				},
				{
					height: 56,
					url: mcClusterIconFolder + "/m2.png",
					width: 56
				},
				{
					height: 66,
					url: mcClusterIconFolder + "/m3.png",
					width: 66
				},
				{
					height: 78,
					url: mcClusterIconFolder + "/m4.png",
					width: 78
				},
				{
					height: 90,
					url: mcClusterIconFolder + "/m5.png",
					width: 90
				}
				]
			};

			markerCluster = new MarkerClusterer(map, markers, mcOptions);
		}

		//markerCluster = new MarkerClusterer(map, markers, {zoomOnClick: false});

		$("#twitter-stats #followers").text(twitter_followers.toFixed(0).replace(/(\d)(?=(\d{3})+$)/g, "$1,"));
		$("#twitter-stats #following").text(twitter_following.toFixed(0).replace(/(\d)(?=(\d{3})+$)/g, "$1,"));
		$("#twitter-stats #tweets").text(twitter_tweets.toFixed(0).replace(/(\d)(?=(\d{3})+$)/g, "$1,"));

		if(active_locations.length == locations.length)
		{
			max_hight = $("#map").height()-100;
			max_stat = Math.max(twitter_followers, twitter_following, twitter_tweets);
			$("#d3").css("height", max_hight);
		}
		
		var dataset = [ twitter_followers*max_hight/max_stat, twitter_following*max_hight/max_stat, twitter_tweets*max_hight/max_stat ];
		$("#d3 .bar").remove();
		d3.select("#d3").selectAll("div")
			.data(dataset)
			.enter()
			.append("div")
			.attr("class", "bar")
			.style("height", function(d) {
			    return d + "px";
			});


        google.maps.event.addListener(markerCluster, "click", function (c) {
        	infoWindow.close();

        	if(capabilities.length>0)
        	{
	        	//initilize capabilities
	        	for(var i=0; i<capabilities.length; i++)
	        		capabilities[i].count = 0;

	        	var cMarkers = c.getMarkers();
	        	for(var i=0; i<cMarkers.length; i++)
	        	{
	        		for(var j=0; j<cMarkers[i].capability.length; j++)
	        		{
	        			var cap = _.find(capabilities, function(r){
	        				return r.title == cMarkers[i].capability[j];
	        			});
	        			if(cap)
	        				cap.count++;
	        		}
	        	}

	        	capabilities = capabilities.sort(sortByCount);

	        	var topCapabilities = "<table>"+
	        						  	"<caption>"+
	        						  		"Top Capabilities"+
	        						  	"</caption>"+
	        						  	"<thead>"+
	        						  		"<tr>"+
	        						  			"<th>Capability</th>"+
	        						  			"<th>Companies</th>"+
	        						  		"</tr>"+
	        						  	"</thead>"+
	        						  	"<tbody>";

	        	for(var i=0; i<5 && i<capabilities.length; i++) {
	        		if(capabilities[i].count>0) {
	        			topCapabilities = topCapabilities + '<tr><td>'+capabilities[i].title+'</td><td>&nbsp;: '+capabilities[i].count+'</td></tr>';
	        		}
	        	}

				topCapabilities = topCapabilities + "</tbody></table>";
        	}
        	else
        	{
	        	var cMarkers = c.getMarkers().sort(sortByEmployees);

	        	var topCapabilities = "<table>"+
	        						  	"<caption>"+
	        						  		"Top Companies by Employees"+
	        						  	"</caption>"+
	        						  	"<thead>"+
	        						  		"<tr>"+
	        						  			"<th>Company</th>"+
	        						  			"<th>Employees</th>"+
	        						  		"</tr>"+
	        						  	"</thead>"+
	        						  	"<tbody>";

	        	for(var i=0; i<5 && i<cMarkers.length; i++)
	        		topCapabilities = topCapabilities + '<tr><td>'+cMarkers[i].name+'</td><td>&nbsp;: '+cMarkers[i].employees+'</td></tr>';
				
				topCapabilities = topCapabilities + "</tbody></table>";

        	}



			infoWindow.setContent('	<div class="marker-detail">'+
										'<div class="caption">'+
											topCapabilities+
										'</div>'+
									'</div>');
			var mark = new google.maps.Marker({
			    position: c.getCenter()
			});
			infoWindow.open(map, mark);
			setTimeout(function(){$(".marker-detail").parent().css("overflow","hidden !important");},100);
	
        });
	};


	function drawFilters(){
		$.each(filters, function (key, data) {
			if(key == "naics") label = "sector";
			else if(key == "town_center") label = "local area";
			else label = key;
			$("#filters-content #filters-container").append('<div class="filter-container">'+
														 	'<label>By '+label+'</label>'+
														 	'<select multiple id="'+key+'-filter">'+
														 	'</select>'+
														  '</div>');
			filters_keys.push(key);
			$("#filters-select").append('<option value="'+key+'">'+label+'</option>');
			for(var x in data){
				var description = "";
				if(key == "naics")
					description = data[x].naics_description;
				
				$("#"+key+"-filter").append('<option value="'+data[x][key]+'">'+data[x][key]+'   '+description+'</option>');
			}			
		});

		$("select").select2();
	};



	//to fix if two bussniss share same lat and lng
	function uniqueLocations(){
		var newlocations = [];
		for(var i=0; i<locations.length; i++){
			var exist = false;
			for(var j=0; j<newlocations.length; j++){
				if(locations[i].lat==newlocations[j].lat && locations[i].lng==newlocations[j].lng ){
					exist = true;
					break;
				}
			}

			if(!exist)
				newlocations.push(locations[i]);
		}
		locations = newlocations;
	};


	function sortByCount(a, b){
		var aCount = Number(a.count);
		var bCount = Number(b.count);
		return ((aCount < bCount) ? 1 : ((aCount > bCount) ? -1 : 0));		
	}

	function sortByEmployees(a, b){
		var aEmployees = Number(a.employees);
		var bEmployees = Number(b.employees);
		return ((aEmployees < bEmployees) ? 1 : ((aEmployees > bEmployees) ? -1 : 0));
	};


	$(window).load(function(){
		filter_list = '.filter-list';

		var map_height = $(window).height()-$(".navbar").height()-20;
		var map_filter_height = $(window).height()-$(".navbar").height()-20;

		$('#map-canvas').css({'height':(map_height)+'px'});
		$('#map-filters').css({'height':(map_height)+'px'});
		$('#map-places').css({'height':(map_height)+'px'});
		$('#map-filters .filters').css({'height':(map_filter_height)+'px'});

		startmap();
	});

	$("#filters .filters-header").click(function(){
		if($("#filters #filters-content").is(":hidden")){
			$("#filters #filters-content").slideDown();
			$("#filters .filters-header span").removeClass("glyphicon-plus");
			$("#filters .filters-header span").addClass("glyphicon-minus");
		}
		else{
			$("#filters #filters-content").slideUp();
			$("#filters .filters-header span").removeClass("glyphicon-minus");
			$("#filters .filters-header span").addClass("glyphicon-plus");
		}
	});


	$("#filters-select").change(function(){
		var filters_selected = $("#filters-select").val();
		if(!filters_selected)
			filters_selected = [];

		for(var x in filters_keys){
			var target =  "#"+filters_keys[x]+"-filter";
			if( filters_selected.indexOf(filters_keys[x]) > -1 )
				$(target).parent().show();
			else if($(target).parent().is(":visible")){
				$(target).parent().hide();
				if($(target).val() != null){
					$(target).select2('data', null);
					apply_filters();
				}
			}
		}
	});


	$("#apply-filters").click(apply_filters = function(){
		$(".loading").fadeIn();

		active_locations = [];
		for(var x in locations) {
			var filter_out = false;
			$.each(filters, function (key, data) {
				var filter = $("#"+key+"-filter").val();
				if(filter && filter.indexOf(locations[x][key]) == -1 && _.intersection(filter, locations[x][key]).length < 1){
					filter_out = true;
					return false;
				}
			});
			if(!filter_out)
				active_locations.push(locations[x]);
		}

		drawMarkers();

		$(".loading").fadeOut(1000);

	});

});

