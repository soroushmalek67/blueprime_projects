<style type="text/css">
	div.bar {
		margin-right: 2px;
		display: inline-block;
		width: 20px;
		height: 75px;
		background-color: teal;
	}
	.pumpkin {
	    fill: yellow;
	    stroke: orange;
	    stroke-width: 5;
	 }
	 .black{
	 	stroke: black;
	 }

</style>

<svg width="500" height="500">
	<rect x="0" y="0" width="500" height="50" class="pumpkin"/>
	<circle cx="250" cy="100" r="25" class="pumpkin"/>
	<ellipse cx="250" cy="200" rx="100" ry="25" class="pumpkin"/>
	<line x1="0" y1="0" x2="500" y2="250" class="pumpkin black" />
	<line x1="500" y1="0" x2="0" y2="250" class="pumpkin black" />

	<rect x="0" y="300" width="30" height="30" fill="purple"/>
	<rect x="20" y="305" width="30" height="30" fill="blue"/>
	<rect x="40" y="310" width="30" height="30" fill="green"/>
	<rect x="60" y="315" width="30" height="30" fill="yellow"/>
	<rect x="80" y="320" width="30" height="30" fill="red"/>

	<circle cx="25" cy="400" r="20" fill="rgba(128, 0, 128, 1.0)"/>
	<circle cx="50" cy="400" r="20" fill="rgba(0, 0, 255, 0.75)"/>
	<circle cx="75" cy="400" r="20" fill="rgba(0, 255, 0, 0.5)"/>
	<circle cx="100" cy="400" r="20" fill="rgba(255, 255, 0, 0.25)"/>
	<circle cx="125" cy="400" r="20" fill="rgba(255, 0, 0, 0.1)"/>
</svg>
<section id="d3">
</section> 
<script type="text/javascript" src="{{url('assets/js/vendor/d3.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/d3.js')}}"></script>