@if($exceededThreshold)
	<div class="alert alert-danger">Sorry, We can't display Eco system for the current Project due to the large amount of data</div>
@else
	<link rel="stylesheet" href="{{ url('assets/css/eco.css') }}">

	<div id="main" class="ecoSystemCont">
            <div id="graph"></div>
            <!--<div id="graph-info"></div>-->
	</div>

<!-- 	<script src="{{url('assets/js/vendor/d3.min.js')}}"></script> -->
	<script src="{{url('assets/js/vendor/conv4.min.js')}}" id="helper" project-id="{{$id}}"></script>
@endif