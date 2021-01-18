<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/css/jquery.qtip.css">
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/raphael.min.js"></script>
        <script src="js/kartograph.js"></script>
        <script src="js/jquery.qtip.min.js"></script>
        <script src="js/raphael.pan-zoom.js"></script>
<script type="text/javascript">
$(function() {
        $.fn.qtip.defaults.style.classes = 'ui-tooltip-bootstrap';
        $.fn.qtip.defaults.style.def = false;

        var map = $K.map('#map');

        map.loadMap('world.svg', function() {
            map.addLayer('countries', {
                styles: {
                    stroke: '#aaa',
                    fill: '#f6f4f2'
                }
            });
var panZoom = map.paper.panzoom();//{ initialZoom: 7, initialPosition: { x: 20, y: 100} });
panZoom.enable();
            $.ajax({
                url: 'jsonMap.php',
                dataType: 'json',
                success: function(cities) {

                    var scale = $K.scale.sqrt(cities.concat([{ noCompanies: 0 }]), 'noCompanies').range([0, 60]);

                    map.addSymbols({
                        type: $K.Bubble,
                        data: cities,
                        location: function(city) {
                            return [city.long, city.lat];
                        },
                        radius: function(city) {
                            return scale(city.noCompanies/10);
                        },
                        tooltip: function(city) {
                            return '<h3>'+city.city_name+'</h3>'+city.noCompanies+' companies';
                        },
                        sortBy: 'radius desc',
                        style: 'fill:#800; stroke: #fff; fill-opacity: 0.5;',
                    });
                }
            });
/*
*/

        }, { padding: -5 });
});
 </script>
     </head>
    <body>
    	MAP: <br/>
	<div class="map-container">
	    <div id="map-overlay"></div>
	    <div id="map"></div>
	</div>
    </body>
</html>