
<div class="container">

	<header class="title">
	    <div class="row">
	        <div class="col-sm-10">
	            <h4>{{$project_name}}</h4>
	        </div>
	    </div>
	</header>

	<ul class="nav nav-tabs">
		<li class="active"><a href="#NAICS" data-toggle="tab">Companies by Sector</a></li>
		<li><a href="#byState" data-toggle="tab">Companies by Province</a></li>
		<li><a href="#byCapability" data-toggle="tab">Companies by Capability</a></li>
		<li><a href="#byTownCenter" data-toggle="tab">Companies by Local Area</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="NAICS">
			<div id="chart_div12"></div>
			<div id="chart_div8" ></div>
		</div>
		<div class="tab-pane" id="byState">
			<div id="chart_div6" ></div>
			<div id="chart_div7"></div>
			<div id="chart_div9"></div>
			<div id="chart_div10"></div>
		</div>
		<div class="tab-pane" id="byCapability">
			<div id="chart_div11"></div>
			<div id="chart_div4"></div>
		</div>
		<div class="tab-pane" id="byTownCenter">
			<div id="chart_div14"></div>
			<div id="chart_div13"></div>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script src="{{url('assets/js/analytics.js')}}" id="helper" project-id="{{$id}}"></script>