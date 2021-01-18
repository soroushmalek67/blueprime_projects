<?php
	session_start();
    if (!isset($_SESSION['ProjectID']))
      header("Location: projects.php");
    if ($_SESSION['ProjectType'] !=='2') 
      header("Location: analytics2.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Company Directory - Analytics</title>
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
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
    
      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});
      
      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);


      // Callback that creates and populates a data table, 
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

      var data = google.visualization.arrayToDataTable([
       <?php
            // Create connection
            include 'dbConn.php';

            // Check connection

            if (mysqli_connect_errno($con))
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
//              $header = "['# Companies'";
//              $line = $header;
              $ProjectID = $_SESSION['ProjectID'];
              $result = mysqli_query($con,"select c.City,c.lat,c.lon,COUNT(*) cnt from ProjectCompanies pc inner join Cities c On c.City = pc.City Where ProjectID=$ProjectID group by c.City");
              $line = "['City' ,'# Companies']";
              while($row = mysqli_fetch_array($result))
              {
//                $header = $header . ",  '" .$row['City'] . "'";
//                $line = $line . ",  " .$row['cnt'];
                $line = $line . ",['" . $row['City'] . "'," .$row['cnt'] . "]";
              }
  //            $header = $header . "],\n";
 //             $line = $line . "]";
  //           echo $header;
              echo $line;
            }
           ?> 
        ]);

        var options = {
          title: '# Companies Per City',
          is3D: true,
          width:900,
          height:900,
        };
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);

      var data2 = google.visualization.arrayToDataTable([
       <?php
            // Create connection
            include 'dbConn.php';

            // Check connection

            if (mysqli_connect_errno($con))
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
//              $header = "['# Companies'";
//              $line = $header;
              $ProjectID = $_SESSION['ProjectID'];
              $result = mysqli_query($con,"select c.City,c.lat,c.lon,COUNT(*) cnt from ProjectCompanies pc inner join Cities c On c.City = pc.City Where ProjectID=$ProjectID group by c.City");
              $line = "['City' ,'# Companies',{ role: 'style' }]";
              while($row = mysqli_fetch_array($result))
              {
//                $header = $header . ",  '" .$row['City'] . "'";
//                $line = $line . ",  " .$row['cnt'];
                $line = $line . ",['" . $row['City'] . "'," .$row['cnt'] . ",'#" . strtoupper(dechex(rand(0,10000000))) . "']";
              }
  //            $header = $header . "],\n";
 //             $line = $line . "]";
  //           echo $header;
              echo $line;
            }
           ?> 
        ]);

        var options2 = {
          title: '# Companies Per City',
          width:1000,
          height:300,
          legend:{position: 'none'},
        };
        var chart2 = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
        chart2.draw(data2, options2);

      var data3 = google.visualization.arrayToDataTable([
       <?php
            include 'dbConn.php';
            if (mysqli_connect_errno($con))
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
              $ProjectID = $_SESSION['ProjectID'];
              $result = mysqli_query($con,"select concat(Industry,' - ',SubIndustry) Industry,Round(Avg(Revenue),1) AvgRev from ProjectCompanies Where ProjectID=$ProjectID and Revenue<>'' group by concat(Industry,' - ',SubIndustry)");
              $line = "['City' ,'Avg Revenue (in millions)',{ role: 'style' }]";
              while($row = mysqli_fetch_array($result))
              {
                $line = $line . ",['" . $row['Industry'] . "'," .$row['AvgRev'] . ",'#" . strtoupper(dechex(rand(0,10000000))) . "']";
              }
              echo $line;
            }
           ?> 
        ]);

        var options3 = {
          title: 'Avg Revenue Per Industry (in millions)',
          width:1000,
          height:500,
          hAxis: {slantedText: 'True',textStyle: {fontSize:10}},
          legend:{position: 'none'},
        };
        var chart3 = new google.visualization.ColumnChart(document.getElementById('chart_div3'));
        chart3.draw(data3, options3);

      var data4 = google.visualization.arrayToDataTable([
       <?php
            include 'dbConn.php';
            if (mysqli_connect_errno($con))
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
              $ProjectID = $_SESSION['ProjectID'];
              $result = mysqli_query($con,"select concat(IFNULL(Industry,''),' - ',IFNULL(SubIndustry,''))Industry,COUNT(*) cnt from ProjectCompanies Where ProjectID=$ProjectID group by concat(IFNULL(Industry,''),' - ',IFNULL(SubIndustry,''))");
              $line = "['City' ,'# Companies']";
              while($row = mysqli_fetch_array($result))
              {
                $line = $line . ",['" . $row['Industry'] . "'," .$row['cnt'] . "]";
              }
              echo $line;
            }
           ?> 
        ]);

        var options4 = {
          title: '# Companies Per Industry',
          is3D: true,
          width:900,
          height:450,
        };
        var chart4 = new google.visualization.PieChart(document.getElementById('chart_div4'));
        chart4.draw(data4, options4);

      var data5 = google.visualization.arrayToDataTable([
       <?php
            include 'dbConn.php';
            if (mysqli_connect_errno($con))
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
              $ProjectID = $_SESSION['ProjectID'];
              $result = mysqli_query($con,"select concat(IFNULL(Industry,''),' - ',IFNULL(SubIndustry,'')) Industry,Round(Avg(NoEmployees),0) NoEmployees from ProjectCompanies Where ProjectID=$ProjectID and NoEmployees<>'' group by concat(IFNULL(Industry,''),' - ',IFNULL(SubIndustry,''))");
              $line = "['City' ,'Avg # Employees',{ role: 'style' }]";
              while($row = mysqli_fetch_array($result))
              {
                $line = $line . ",['" . $row['Industry'] . "'," .$row['NoEmployees'] . ",'#" . strtoupper(dechex(rand(0,10000000))) . "']";
              }
              echo $line;
            }
           ?> 
        ]);

        var options5 = {
          title: 'Avg # Employees Per Industry',
          width:1000,
          height:500,
          hAxis: {slantedText: 'True',textStyle: {fontSize:10}},
          legend:{position: 'none'},
        };
        var chart5 = new google.visualization.ColumnChart(document.getElementById('chart_div5'));
        chart5.draw(data5, options5);
 
      var data6 = google.visualization.arrayToDataTable([
       <?php
            include 'dbConn.php';

            if (mysqli_connect_errno($con))
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
              $ProjectID = $_SESSION['ProjectID'];
              $result = mysqli_query($con,"select s.Name State,s.lat,s.lon,COUNT(*) cnt from ProjectCompanies pc inner join States s On s.Name = trim(pc.State) Where ProjectID=$ProjectID group by s.Name");
              $line = "['State' ,'# Companies']";
              while($row = mysqli_fetch_array($result))
              {
                $line = $line . ",['" . $row['State'] . "'," .$row['cnt'] . "]";
              }
              echo $line;
            }
           ?> 
        ]);

        var options6 = {
          title: '# Companies Per State',
          is3D: true,
          width:900,
          height:900,
        };
        var chart6 = new google.visualization.PieChart(document.getElementById('chart_div6'));
        chart6.draw(data6, options6);

      var data7 = google.visualization.arrayToDataTable([
       <?php
            // Create connection
            include 'dbConn.php';

            // Check connection

            if (mysqli_connect_errno($con))
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
              $ProjectID = $_SESSION['ProjectID'];
              $result = mysqli_query($con,"select s.Name State,s.lat,s.lon,COUNT(*) cnt from ProjectCompanies pc inner join States s On s.Name = trim(pc.State) Where ProjectID=$ProjectID group by s.Name");
              $line = "['State' ,'# Companies',{ role: 'style' }]";
              while($row = mysqli_fetch_array($result))
              {
                $line = $line . ",['" . $row['State'] . "'," .$row['cnt'] . ",'#" . strtoupper(dechex(rand(0,10000000))) . "']";
              }
              echo $line;
            }
           ?> 
        ]);

        var options7 = {
          title: '# Companies Per State',
          width:1000,
          height:300,
          legend:{position: 'none'},
        };
        var chart7 = new google.visualization.ColumnChart(document.getElementById('chart_div7'));
        chart7.draw(data7, options7);

      var data8 = google.visualization.arrayToDataTable([
       <?php
            include 'dbConn.php';

            if (mysqli_connect_errno($con))
            {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }
            else
            {
              $ProjectID = $_SESSION['ProjectID'];
              $result = mysqli_query($con,"select n.Name,count(*) cnt from ProjectCompanies pc inner join NAICS n on n.Code = SUBSTRING(NAICSCode,1,3) where ProjectID=$ProjectID group by n.Name");
              $line = "['Name' ,'# Companies']";
              while($row = mysqli_fetch_array($result))
              {
                $line = $line . ",['" . $row['Name'] . "'," .$row['cnt'] . "]";
              }
              echo $line;
            }
           ?> 
        ]);

        var options8 = {
          title: '# Companies Per NAICS',
          is3D: true,
          width:900,
          height:900,
        };
        var chart8 = new google.visualization.PieChart(document.getElementById('chart_div8'));
        chart8.draw(data8, options8);

    }

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
           if ($_SESSION["ReadOnly"]=="NO") 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<a href="import.php"><span class="glyphicon glyphicon-import"></span> Build</a>';
            else 
                echo '<a href="build.php"><span class="glyphicon glyphicon-check"></span> Build</a>';
          ?>
        </li>
        <li>
          <a href="list.php"><span class="glyphicon glyphicon-th"></span> Data </a>
        </li>
        <li>
           <a href="view.php"><span class="glyphicon glyphicon-globe"></span> Map </a>
        </li>
          <?php 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<li><a href="concept4.php"><span class="glyphicon glyphicon-dashboard"></span> Eco-system </a></li>';
            else 
                echo '<li><a href="concept10.php"><span class="glyphicon glyphicon-dashboard"></span> Eco-system </a></li>';
          ?>
        <li class="active">
          <?php 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<a href="analytics2.php"><span class="glyphicon glyphicon-stats"></span> Analytics</a>';
            else 
                echo '<a href="analytics.php"><span class="glyphicon glyphicon-stats"></span> Analytics</a>';
          ?>
        </li>
        <li><a href="export.php"><span class="glyphicon glyphicon-export"></span> Export </a></li>
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
      <ul class="nav nav-tabs">
        <li class="active"><a href="#NAICS" data-toggle="tab">NAICS</a></li>
        <li><a href="#byCity" data-toggle="tab">City</a></li>
        <li><a href="#byState" data-toggle="tab">State</a></li>
        <li><a href="#byIndustry" data-toggle="tab">Industry</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="NAICS">
          <div id="chart_div8" ></div>
        </div> <!-- profile -->

        <div class="tab-pane" id="byCity">
        	<div id="chart_div" ></div>
        	<div id="chart_div2"></div>
        </div> <!-- profile -->

        <div class="tab-pane" id="byState">
          <div id="chart_div6" ></div>
          <div id="chart_div7"></div>
        </div> <!-- profile -->

        <div class="tab-pane" id="byIndustry">
        	<div id="chart_div4"></div>
        	<div id="chart_div3"></div>
        	<div id="chart_div5"></div>
        </div> <!-- profile -->

       </div> <!-- myTabContent -->
       <br/><br/><br/>

    <?php include 'footer.php'; ?>

    </div> <!-- /container -->
  </body>
</html>
