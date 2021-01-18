<?php
	session_start();
    if (!isset($_SESSION['ProjectID']))
      header("Location: projects.php");
    if ($_SESSION['ProjectType'] =='2') 
      header("Location: analytics.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Firmogram - Analytics</title>
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

       <?php
            include 'dbConn.php';
            if (mysqli_connect_errno($con))
            {
              echo "<script>window.location = 'index.html'</script>";
              exit();
            }
        ?>

      var data4 = google.visualization.arrayToDataTable([
       <?php
              $ProjectID = $_SESSION['ProjectID'];
              $result = mysqli_query($con,"select pcc.Title ,COUNT(*) cnt from ProjectCompanies pc inner join CompanyCapabilities cc ON cc.CompanyID = pc.ID inner join ProjectCapabilities pcc ON pcc.ProjectID=pc.ProjectID AND cc.CapabilityID = pcc.ID Where pc.ProjectID=$ProjectID group by pcc.Title");
              if (!$result)
              {
                echo "<script>window.location = 'index.html'</script>";
                exit();
              }
              $line = "['Capability' ,'# Companies']";
              while($row = mysqli_fetch_array($result))
              {
                $line = $line . ",['" . $row['Title'] . "'," .$row['cnt'] . "]";
              }
              echo $line;
           ?> 
        ]);

        var options4 = {
          title: 'Companies By Capability',
          is3D: true,
          width:900,
          height:450,
        };
        var chart4 = new google.visualization.PieChart(document.getElementById('chart_div4'));
        chart4.draw(data4, options4);
 
      var data6 = google.visualization.arrayToDataTable([
       <?php
              $ProjectID = $_SESSION['ProjectID'];
              $result = mysqli_query($con,"select s.Name State,s.lat,s.lon,COUNT(*) cnt from ProjectCompanies pc inner join States s On s.Name = trim(pc.State) Where ProjectID=$ProjectID group by s.Name");
              if (!$result)
              {
                echo "<script>window.location = 'index.html'</script>";
                exit();
              }
              $line = "['Province' ,'# Companies']";
              while($row = mysqli_fetch_array($result))
              {
                $line = $line . ",['" . $row['State'] . "'," .$row['cnt'] . "]";
              }
              echo $line;
           ?> 
        ]);

        var options6 = {
          title: '# Companies By Province',
          is3D: true,
          width:900,
          height:900,
        };
        var chart6 = new google.visualization.PieChart(document.getElementById('chart_div6'));
        chart6.draw(data6, options6);

      var data7 = google.visualization.arrayToDataTable([
       <?php
              $ProjectID = $_SESSION['ProjectID'];
              $result = mysqli_query($con,"select s.Name State,s.lat,s.lon,COUNT(*) cnt from ProjectCompanies pc inner join States s On s.Name = trim(pc.State) Where ProjectID=$ProjectID group by s.Name");
                if (!$result)
              {
                echo "<script>window.location = 'index.html'</script>";
                exit();
              }
              $line = "['Province' ,'# Companies',{ role: 'style' }]";
              while($row = mysqli_fetch_array($result))
              {
                $line = $line . ",['" . $row['State'] . "'," .$row['cnt'] . ",'#" . strtoupper(dechex(rand(0,10000000))) . "']";
              }
              echo $line;
           ?> 
        ]);
      var view7 = new google.visualization.DataView(data7);
      view7.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

        var options7 = {
          title: '# Companies By Province',
          width:1000,
          height:300,
          legend:{position: 'none'},
        };
        var chart7 = new google.visualization.ColumnChart(document.getElementById('chart_div7'));
        chart7.draw(view7, options7);

      var data9 = google.visualization.arrayToDataTable([
       <?php
              $ProjectID = $_SESSION['ProjectID'];
              $result = mysqli_query($con,"select s.Name State,s.lat,s.lon,SUM(ROUND(pc.Revenue,2)) TotalRev from ProjectCompanies pc inner join States s On s.Name = trim(pc.State) Where ProjectID=$ProjectID group by s.Name");
              if (!$result)
              {
                echo "<script>window.location = 'index.html'</script>";
                exit();
              }
              $line = "['Province' ,'Total Revenue',{ role: 'style' }]";
              while($row = mysqli_fetch_array($result))
              {
                $line = $line . ",['" . $row['State'] . "'," .$row['TotalRev'] . ",'#" . strtoupper(dechex(rand(0,10000000))) . "']";
              }
              echo $line;
           ?> 
        ]);

        var options9 = {
          title: 'Total Revenue By Province',
          width:1000,
          height:300,
          legend:{position: 'none'},
        };
        var chart9 = new google.visualization.ColumnChart(document.getElementById('chart_div9'));
        chart9.draw(data9, options9);        

      var data8 = google.visualization.arrayToDataTable([
       <?php
              $ProjectID = $_SESSION['ProjectID'];
              $result = mysqli_query($con,"select n.Name,count(*) cnt from ProjectCompanies pc inner join NAICS n on n.Code = SUBSTRING(NAICSCode,1,3) where ProjectID=$ProjectID group by n.Name");
              if (!$result)
              {
                echo "<script>window.location = 'index.html'</script>";
                exit();
              }
              $line = "['NAICS' ,'# Companies']";
              while($row = mysqli_fetch_array($result))
              {
                $line = $line . ",['" . $row['Name'] . "'," .$row['cnt'] . "]";
              }
              echo $line;
           ?> 
        ]);

        var options8 = {
          title: '# Companies By NAICS',
          is3D: true,
          width:900,
          height:900,
        };
        var chart8 = new google.visualization.PieChart(document.getElementById('chart_div8'));
        chart8.draw(data8, options8);

      var data10 = google.visualization.arrayToDataTable([
       <?php
             $ProjectID = $_SESSION['ProjectID'];
              $result = mysqli_query($con,"select n.Name,count(*) cnt from ProjectCompanies pc inner join NAICS n on n.Code = SUBSTRING(NAICSCode,1,3) where ProjectID=$ProjectID group by n.Name");
              if (!$result)
              {
                echo "<script>window.location = 'index.html'</script>";
                exit();
              }
              $line = "['NAICS' ,'# Companies',{ role: 'style' }]";
              while($row = mysqli_fetch_array($result))
              {
                $line = $line . ",['" . $row['Name'] . "'," .$row['cnt'] . ",'#" . strtoupper(dechex(rand(0,10000000))) . "']";
              }
              echo $line;
          ?> 
        ]);
      var view10 = new google.visualization.DataView(data10);
      view10.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

        var options10 = {
          title: '# Companies By NAICS',
          width:1000,
          height:300,
          chartArea: {height:"30%"},
          legend:{position: 'none'},
        };
        var chart10 = new google.visualization.ColumnChart(document.getElementById('chart_div10'));
        chart10.draw(view10, options10);

      var data11 = google.visualization.arrayToDataTable([
       <?php
             $ProjectID = $_SESSION['ProjectID'];
              $result = mysqli_query($con,"select pcc.Title ,COUNT(*) cnt from ProjectCompanies pc inner join CompanyCapabilities cc ON cc.CompanyID = pc.ID inner join ProjectCapabilities pcc ON pcc.ProjectID=pc.ProjectID AND cc.CapabilityID = pcc.ID Where pc.ProjectID=$ProjectID group by pcc.Title");
              if (!$result)
              {
                echo "<script>window.location = 'index.html'</script>";
                exit();
              }
              $line = "['Capability' ,'# Companies',{ role: 'style' }]";
              while($row = mysqli_fetch_array($result))
              {
                $line = $line . ",['" . $row['Title'] . "'," .$row['cnt'] . ",'#" . strtoupper(dechex(rand(0,10000000))) . "']";
              }
              echo $line;
          ?> 
        ]);
      var view11 = new google.visualization.DataView(data11);
      view11.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

        var options11 = {
          title: '# Companies By Capability',
          width:1000,
          height:300,
          hAxis: {slantedText:true, slantedTextAngle:45 ,textStyle: { fontSize: '12', paddingRight: '0', marginRight: '0', marginTop: '0'} },
          chartArea: {height:"30%"},
          legend:{position: 'none'},
        };
        var chart11 = new google.visualization.ColumnChart(document.getElementById('chart_div11'));
        chart11.draw(view11, options11);
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
          <?php 
           if ($_SESSION["ReadOnly"]=="NO")  {
            ?>
          <a class="navbar-brand" href="projects.php"><span class="glyphicon glyphicon-list"></span> Projects</a>
          <?php 
           }
            ?>
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
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php 
          if ($_SESSION['ViewerCount'] !=="") 
            echo '<li><a href="viewers.php"><span class="glyphicon glyphicon-user"></span> Viewers</a></li>';
        ?>
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
            if (mysqli_connect_errno())
            {
              echo "<script>window.location = 'index.html'</script>";
              exit();
            }
            $result = mysqli_query($con,"SELECT Name,(SELECT COUNT(*) FROM ProjectCompanies WHERE ProjectID=". $_SESSION['ProjectID'] .") CompanyCount FROM UserProjects Where ID=". $_SESSION['ProjectID']);
            if (!$result)
            {
              echo "<script>window.location = 'index.html'</script>";
              exit();
            }
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
        <li class="active"><a href="#NAICS" data-toggle="tab">Companies by NAICS Code</a></li>
        <li><a href="#byState" data-toggle="tab">Companies by Province</a></li>
        <li><a href="#byCapability" data-toggle="tab">Companies by Capability</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="NAICS">
          <div id="chart_div10" ></div>
          <div id="chart_div8" ></div>
        </div> <!-- profile -->

        <div class="tab-pane" id="byState">
          <div id="chart_div6" ></div>
          <div id="chart_div7"></div>
          <div id="chart_div9"></div>
        </div> <!-- profile -->

        <div class="tab-pane" id="byCapability">
          <div id="chart_div11"></div>
          <div id="chart_div4"></div>
        </div> <!-- profile -->

       </div> <!-- myTabContent -->
       <br/><br/><br/>

    <?php include 'footer.php'; ?>

    </div> <!-- /container -->
  </body>
</html>
