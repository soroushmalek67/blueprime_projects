<link rel="stylesheet" type="text/css" href="{{ url('assets/css/map.css') }}">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD42fpTNY8sUcJk0gr8-WSMZS7hRvFZWxU&libraries=places&sensor=true"></script>
<script type="text/javascript" src="{{url('assets/js/vendor/infobubble-compiled.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/vendor/markerclusterer_packed.js')}}"></script>
<!-- <script type="text/javascript" src="{{url('assets/js/vendor/d3.min.js')}}"></script> -->
<script type="text/javascript" src="{{url('assets/js/map.js')}}" id="helper" project-id="{{$id}}"></script>

<section class="row maps-show">

	<div class="loading">
		<img src="{{url('assets/img/loader.gif')}}" alt="Loading" />
	</div>

	<div id="map" class="col-md-12">
        <div id="map-canvas" style="height: 100%"></div>
		<div id="filters">
			<div class="filters-header">Filters <span class="glyphicon glyphicon-plus"></span></div>
			<div id="filters-content">
				<label>Add Filters</label>
				<select multiple id="filters-select">
				</select>
				<hr>
				<div id="filters-container">
				</div>
				<div>
					<button id="apply-filters">Apply</button>
				</div>				
			</div>
		</div>
		<div class="clearfix"></div>
	</div>

</section>