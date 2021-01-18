<link rel="stylesheet" href="{{ url('assets/css/treemap.css') }}">

<div class="container">
	<header class="title">
	    <div class="row">
	        <div class="col-sm-10">
	            <h4 class="title headingh1">{{$project_name}}</h4>
	        </div>
	    </div>
	</header>
	<p id="chart"></p>
</div> 

<script src="{{url('assets/js/vendor/d3.v3.min.js')}}"></script>
<script src="{{url('assets/js/treemap.js')}}" id="helper" project-id="{{$id}}"></script>