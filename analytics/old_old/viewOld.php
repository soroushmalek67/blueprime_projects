<?php
	session_start();
    if (!isset($_SESSION['ProjectID']))
      header("Location: projects.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Company Directory - View Project</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets3/css/bootstrap.css" rel="stylesheet">
    <link href="../assets3/css/bootstrap-glyphicons.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 60px;
      }

      /* Custom container */
      .container {
        margin: 0 auto;
        max-width: 1000px;
      }
      .container > hr {
        margin: 60px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 80px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 100px;
        line-height: 1;
      }
      .jumbotron .lead {
        font-size: 24px;
        line-height: 1.25;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }


      /* Customize the navbar links to be fill the entire space of the .navbar */
      .navbar2 .navbar-inner {
        padding: 0;
      }
      .navbar2 .nav {
        margin: 0;
        display: table;
        width: 100%;
      }
      .navbar2 .nav li {
        display: table-cell;
        width: 1%;
        float: none;
      }
      .navbar2 .nav li a {
        font-weight: bold;
        text-align: center;
        border-left: 1px solid rgba(255,255,255,.75);
        border-right: 1px solid rgba(0,0,0,.1);
      }
      .navbar2 .nav li:first-child a {
        border-left: 0;
        border-radius: 3px 0 0 3px;
      }
      .navbar2 .nav li:last-child a {
        border-right: 0;
      }    
    </style>
    <link href="../assets3/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets3/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets3/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets3/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets3/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets3/ico/favicon.png">

     <script src="../assets3/js/jquery.js"></script>
	<script src="../assets3/js/bootstrap.min.js"/>
      <script type="text/javascript">
          $('.alert .close').live("click", function(e) {
              $(this).parent().hide();
          });
      </script>
        <link rel="stylesheet" type="text/css" href="css/jquery.qtip.css">
        <script src="js/jquery-1.10.2.min.js"></script>
        <script src="js/raphael.min.js"></script>
        <script src="js/kartograph.js"></script>
        <script src="js/jquery.qtip.min.js"></script>
        <script src="js/raphael.pan-zoom.js"></script>
<script type="text/javascript">
function number_format(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
$(function() {
        $.fn.qtip.defaults.style.classes = 'ui-tooltip-bootstrap ui-tooltip-light ui-tooltip-shadow';
        $.fn.qtip.defaults.style.def = false;

        var map = $K.map('#map');

        map.loadMap('world.svg', function() {
            map.addLayer('countries', {
                styles: {
                    stroke: '#aaa',
                    fill: '#f6f4f2'
                }
            });
//var panZoom = map.paper.panzoom();//{ initialZoom: 7, initialPosition: { x: 20, y: 100} });
var panZoom = map.paper.panzoom({initialZoom: 7.5, initialPosition: { x: 40, y: 40} });
//panZoom.enable();
            $.ajax({
                url: 'jsonMapState.php',
                dataType: 'json',
                success: function(states) {

                    var scale = $K.scale.sqrt(states.concat([{ noCompanies: 0 }]), 'noCompanies').range([0, 100]);

                    map.addSymbols({
                        type: $K.Bubble,
                        data: states,
                        location: function(state) {
                            return [state.long, state.lat];
                        },
                        radius: function(state) {
//                            return scale(state.noCompanies/10);
                            return scale(2);
                        },
                        tooltip: function(state) {
                            return '<table border="1px" cellpadding="5px" style="margin:5px;background:#bfa"><tr><td><b>Region:</b></td><td colspan="2">'+state.state_name+'</td></tr><tr><td><b>Number of firms:</b></td><td colspan="2">'+state.noCompanies+'</td></tr><tr><td colspan=3></td></tr><tr><td></td><td><b>Total</b></td><td><b>Average</b></td></tr><tr><td><b>Revenue</b></td><td>$'+number_format(state.revenueTotal)+' M</td><td>$'+number_format(state.revenueAvg)+' M</td></tr><tr><td><b>Employees</b></td><td>'+number_format(state.sizeTotal)+'</td><td>'+number_format(state.sizeAvg)+'</td></tr></table>';
                        },
                        sortBy: 'radius desc',
                        style: 'fill:#800; stroke: #fff; fill-opacity: 0.4;',
                    });
                }
            });

            $.ajax({
                url: 'jsonMapCity.php',
                dataType: 'json',
                success: function(cities) {

                    var scale = $K.scale.sqrt(cities.concat([{ noCompanies: 0 }]), 'noCompanies').range([0, 100]);

                    map.addSymbols({
                        type: $K.Bubble,
                        data: cities,
                        location: function(city) {
                            return [city.long, city.lat];
                        },
                        radius: function(city) {
 //                           return scale(.005);
                           return scale(city.noCompanies/500);
                        },
                        tooltip: function(city) {
//                            return '<h3>'+city.city_name+'</h3>'+city.noCompanies+' companies';
                            return '<table border="1px" width="500px" cellpadding="5px" style="margin:5px;background:#bfa"><tr><td><b>City:</b></td><td colspan="2">'+city.city_name+'</td></tr><tr><td><b>Number of firms:</b></td><td colspan="2">'+city.noCompanies+'</td></tr><tr><td colspan=3></td></tr><tr><td> <b>Company Name</b> </td><td> <b>Revenue</b> </td><td> <b>No Employees</b> </td></tr>'+ city.CompanyList +'</table>';
                        },
                        sortBy: 'radius desc',
                        style: 'fill:#080; stroke: none; fill-opacity: 0.5;',
                    });
                }
            });

        }, { padding: -5 });
});
 </script>
 </head>

  <body>

  <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="projects.php"><span class="glyphicon glyphicon-list"></span> Projects</a>
        </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li>
          <?php 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<a href="import.php"><span class="glyphicon glyphicon-import"></span> Build Project</a>';
            else 
                echo '<a href="build.php"><span class="glyphicon glyphicon-check"></span> Build Project</a>';
          ?>
        </li>
        <li class="active">
           <a href="view.php"><span class="glyphicon glyphicon-globe"></span> View Project</a>
        </li>
        <li>
          <a href="list.php"><span class="glyphicon glyphicon-th"></span> View Data</a>
        </li>
        <li>
          <a href="analytics.php"><span class="glyphicon glyphicon-stats"></span> Analytics</a>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li>
          <a href="signout.php"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a>
        </li>
      </ul>
    </nav>
    </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div style="clear:both"></div>
    <div class="container">
      <br/>
      <div class="masthead">
      <!-- Jumbotron -->
        <?php
            include 'dbConn.php';
            $result = mysqli_query($con,"SELECT Name,(SELECT COUNT(*) FROM ProjectCompanies WHERE ProjectID=". $_SESSION['ProjectID'] .") CompanyCount FROM UserProjects Where ID=". $_SESSION['ProjectID']);
            $row = mysqli_fetch_array($result);
        ?>
        <br/>
        <ul class="nav nav-stacked nav-pills" >
          <li class="active">
            <a style="background-color:#800D68">
              <span class="badge pull-right"><h5><?php echo $row[CompanyCount]; ?> Companies</h5></span>
              <h4><?php echo $row[Name]; ?></h4>
            </a>
          </li>
        </ul>       
      <div style="clear:both"></div>
      <br/>
    	<div class="map-container">
    	    <div id="map-overlay"></div>
    	    <div id="map"></div>
    	</div>
       <br/><br/><br/>

      <div class="footer">
        <p>&copy; Copyright 2013 blueprime analytics Inc. All Rights Reserved</p>
      </div>

    </div> <!-- /container -->

  </body>
</html>
