var simplemaps_canadamap_mapdata = {

	main_settings:{
		//General settings
		width: 700,
		background_color: '#FFFFFF',	
		background_transparent: 'no',
		label_color: '#d5ddec',		
		border_color: '#FFFFFF',
		zoom: 'yes',
		pop_ups: 'detect', //on_click, on_hover, or detect
	
		//Country defaults
		state_description:   'Province description',
		state_color: '#88A4BC',
		state_hover_color: '#3B729F',
		state_url: 'http://simplemaps.com',
		all_states_inactive: 'no',
		
		//Location defaults
		location_description:  'Location description',
		location_color: '#FF0067',
		location_opacity: .8,
		location_url: 'http://simplemaps.com',
		location_size: 25,
		location_type: 'circle', //or circle
		all_locations_inactive: 'no',
		
		//Advanced settings - safe to ignore these
		url_new_tab: 'no',  
		initial_zoom: -1,  //-1 is zoomed out, 0 is for the first continent etc	
		initial_zoom_solo: 'yes',
		auto_load: 'yes',
		label_size: 22,
		hide_labels: 'no'  //Note:  You must omit the comma after the last property in an object to prevent errors in internet explorer.
	},

state_specific:{		
	AB: {
			name: 'Alberta',
			description: 'test',
			color: 'default',
			hover_color: 'default',
			url: 'default'
		},
			
	BC: {
			name: 'British Columbia',
			description: '<h1>test</h1>',
			color: 'default',
			hover_color: 'default',
			url: 'default'
			},		

	SK: {
			name: 'Saskatchewan',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'default'
			},
			
	MB: {
			name: 'Manitoba',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'default'
			},		
			
	ON: {
			name: 'Ontario',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'default'
			},		
			
	QC: {
			name: 'Quebec',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'default'
			},			

	NB: {
			name: 'New Brunswick',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'default'
			},				

	PE: {
			name: 'Prince Edwards Island',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'default'
			},				

	NS: {
			name: 'Nova Scotia',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'default'
			},		
			
	NF: {
			name: 'Newfoundland',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'default'
			},			
			
	NU: {
			name: 'Nunavut',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'default'
			},			
			
	NT: {
			name: 'Northwest Territories',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'default'
			},			

	YT: {
			name: 'Yukon',
			description: 'default',
			color: 'default',
			hover_color: 'default',
			url: 'default'
			}
},

// You must number locations sequentially
locations:{
	0: {
	name: 'Toronto',
	lat:  63.653226,
	lng:  -79.3831843,
	color: 'default',
	description: "<?php echo 'hello!'; ?>"
	},
	1: {
	name: 'Halifax',
	lat:  44.6488625,
	lng:   -63.5753196,
	color: 'default'
	}
}


} //end of simplemaps_worldmap_mapdata




