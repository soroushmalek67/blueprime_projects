<link rel="stylesheet" type="text/css" href="{{ url('assets/css/map.css') }}">
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD42fpTNY8sUcJk0gr8-WSMZS7hRvFZWxU&libraries=places&sensor=true"></script>
<script type="text/javascript" src="{{url('assets/js/vendor/infobubble-compiled.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/vendor/markerclusterer_packed.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/vendor/d3.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/map.js')}}" id="helper" project-id="{{$id}}"></script>

<!--<style>
	.container{
		width: 100% !important;
	}
</style>-->

<header class="title">
    <div class="row">
        <div class="col-sm-10">
            <h4 class="title headingh1">{{$project_name}}</h4>
        </div>
    </div>
</header>

<section class="row maps-show">

	<div class="loading">
		<img src="{{url('assets/img/loader.gif')}}" alt="Loading" />
	</div>

	<div id="map" class="col-md-9">
		<div id="map-canvas"></div>
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

	<div class="col-md-3">
		<div id="twitter-stats">
			<table>
				<caption>
					Twitter Stats
				</caption>
				<thead>
					<tr>
						<th>Followers</th>
						<th>Following</th>
						<th>Tweets</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td id="followers">0</td>
						<td id="following">0</td>
						<td id="tweets">0</td>
					</tr>
				</tbody>
			</table>
		</div>

		<section id="d3">
		</section> 

	</div>

</section>