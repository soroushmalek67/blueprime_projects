<?php
  session_start();
    if (!isset($_SESSION['ProjectID']))
      header("Location: projects.php");
    $ProjectID = $_SESSION['ProjectID'];
    if ($_SERVER["SERVER_NAME"] =="localhost")
      $ServerName = $_SERVER["SERVER_NAME"] ."/ces";
    else
      $ServerName = $_SERVER["SERVER_NAME"];
   //echo $ServerName;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Firmogram - Firmographics</title>
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
    <script src="canadamap.js"></script>

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

        var options4 = {
          title: '# Companies By Province',
          is3D: true,
          width:550,
          height:320,
        };
        var chart4 = new google.visualization.PieChart(document.getElementById('chart_div4'));
        chart4.draw(data4, options4);
    }

 </script>

    <script type="text/javascript">
      var simplemaps_canadamap_mapdata = {

        main_settings:{
          //General settings
          width: 700,
          background_color: '#FFFFFF',  
          background_transparent: 'no',
          label_color: '#d5ddec',   
          border_color: '#FFFFFF',
          zoom: 'yes',
          pop_ups: 'detect', //on_click, on_hover, or detect
        
          //Country defaults
          state_description:   'Province description',
          state_color: '#88A4BC',
          state_hover_color: '#3B729F',
          state_url: '#',
          all_states_inactive: 'no',
          
          //Location defaults
          location_description:  'Location description',
          location_color: '#FF0067',
          location_opacity: .8,
          location_url: '#',
          location_size: 25,
          location_type: 'circle', //or circle
          all_locations_inactive: 'no',
          
          //Advanced settings - safe to ignore these
          url_new_tab: 'no',  
          initial_zoom: -1,  //-1 is zoomed out, 0 is for the first continent etc 
          initial_zoom_solo: 'yes',
          auto_load: 'yes',
          label_size: 22,
          hide_labels: 'no'  //Note:  You must omit the comma after the last property in an object to prevent errors in internet explorer.
        },

      state_specific:{    
        AB: {
            name: 'Alberta',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=AB"); ?>',
            color: 'default',
            hover_color: 'default',
            url: 'list2.php?P=Alberta'
//            url: 'concept.php#alberta'
          },
            
        BC: {
            name: 'British Columbia',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=BC"); ?>',
            color: 'default',
            hover_color: 'default',
            url: 'list2.php?P=British Columbia'
//            url: 'concept.php#british-columbia'
            },    

        SK: {
            name: 'Saskatchewan',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=SK"); ?>',
            color: 'default',
            hover_color: 'default',
            url: 'default'
            },
            
        MB: {
            name: 'Manitoba',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=MB"); ?>',
            color: 'default',
            hover_color: 'default',
            url: 'list2.php?P=Manitoba'
//            url: 'concept.php#manitoba'
            },    
            
        ON: {
            name: 'Ontario',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=ON"); ?>',
            color: 'default',
            hover_color: 'default',
            url: 'list2.php?P=Ontario'
            },    
            
        QC: {
            name: 'Quebec',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=QC"); ?>',
            color: 'default',
            hover_color: 'default',
//            url: 'concept.php#quebec'
            url: 'list2.php?P=Quebec'
            },      

        NB: {
            name: 'New Brunswick',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=NB"); ?>',
            color: 'default',
            hover_color: 'default',
            url: 'default'
            },        

        PE: {
            name: 'Prince Edwards Island',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=PE"); ?>',
            color: 'default',
            hover_color: 'default',
            url: 'default'
            },        

        NS: {
            name: 'Nova Scotia',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=NS"); ?>',
            color: 'default',
            hover_color: 'default',
            url: 'default'
            },    
            
        NF: {
            name: 'Newfoundland',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=NF"); ?>',
            color: 'default',
            hover_color: 'default',
            url: 'default'
            },      
            
        NU: {
            name: 'Nunavut',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=NU"); ?>',
            color: 'default',
            hover_color: 'default',
            url: 'default'
            },      
            
        NT: {
            name: 'Northwest Territories',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=NT"); ?>',
            color: 'default',
            hover_color: 'default',
            url: 'default'
            },      

        YT: {
            name: 'Yukon',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=YT"); ?>',
            color: 'default',
            hover_color: 'default',
            url: 'default'
            }
      },

      // You must number locations sequentially

      <?php echo file_get_contents("http://$ServerName/MapCitiesInfo.php?ProjectID=$ProjectID"); ?>



      } //end of simplemaps_worldmap_mapdata    
    </script>
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
        <li class="active">
           <a href="view.php"><span class="glyphicon glyphicon-globe"></span> Map </a>
        </li>
          <?php 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<li><a href="concept4.php"><span class="glyphicon glyphicon-dashboard"></span> Eco-system </a></li>';
            else 
                echo '<li><a href="concept10.php"><span class="glyphicon glyphicon-dashboard"></span> Eco-system </a></li>';
          ?>
        <li>
          <?php 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<a href="analytics2.php"><span class="glyphicon glyphicon-stats"></span> Analytics </a>';
            else 
                echo '<a href="analytics.php"><span class="glyphicon glyphicon-stats"></span> Analytics </a>';
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
            if (mysqli_connect_errno($con))
            {
              echo "<script>window.location = 'index.html'</script>";
              exit();
            }
            else
            {
              $result = mysqli_query($con,"SELECT Name,(SELECT COUNT(*) FROM ProjectCompanies WHERE ProjectID=". $_SESSION['ProjectID'] .") CompanyCount FROM UserProjects Where ID=". $_SESSION['ProjectID']);
              if (!$result)
              {
                echo "<script>window.location = 'index.html'</script>";
                exit();
              }
               $row = mysqli_fetch_array($result);
            }
        ?>
        <br/>
        <ul class="nav nav-stacked nav-pills" >
          <li class="active">
            <a style="background-color:#08A17D">
              <span class="badge pull-right"><h5><?php echo $row[CompanyCount]; ?> Companies</h5></span>
              <h4><?php echo $row[Name]; ?></h4>
            </a>
          </li>
        </ul>      
        <br/> 
      <div style="clear:both"></div>
      <div class="jumbotron1">
      </div>
      <div id="chart_div4" style="margin-left:530px;z-index:100;border:0px solid;position:relative"></div>
      <div id="map" style="margin-top:-330px"></div>
       <?php
         mysqli_free_result($result);
         mysqli_close($con);
        ?>

    <?php include 'footer.php'; ?>
    </div><!-- /.container -->

  </body>
</html>
