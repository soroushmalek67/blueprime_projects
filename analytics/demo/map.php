<?php
  session_start();
    if (!isset($_SESSION['ProjectID']))
      header("Location: projects.php");
    $ProjectID = $_SESSION['ProjectID'];
 //   $ServerName = $_SERVER["SERVER_NAME"] ."/ces";
   $ServerName = $_SERVER["SERVER_NAME"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Company Directory</title>
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
          state_url: 'http://simplemaps.com',
          all_states_inactive: 'no',
          
          //Location defaults
          location_description:  'Location description',
          location_color: '#FF0067',
          location_opacity: .8,
          location_url: 'http://simplemaps.com',
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
            url: 'default'
          },
            
        BC: {
            name: 'British Columbia',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=BC"); ?>',
            color: 'default',
            hover_color: 'default',
            url: 'default'
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
            url: 'default'
            },    
            
        ON: {
            name: 'Ontario',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=ON"); ?>',
            color: 'default',
            hover_color: 'default',
            url: 'default'
            },    
            
        QC: {
            name: 'Quebec',
            description: '<?php echo file_get_contents("http://$ServerName/MapStateInfo.php?ProjectID=$ProjectID&State=QC"); ?>',
            color: 'default',
            hover_color: 'default',
            url: 'default'
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
        <li>
           <a href="view.php"><span class="glyphicon glyphicon-th"></span> View Project</a>
        </li>
        <li class="active">
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
      <div style="clear:both"></div>
      <div id="map"></div>

      <div class="footer">
        <p>&copy; Copyright 2013 blueprime analytics Inc. All Rights Reserved</p>
      </div>

    </div> <!-- /container -->
  </body>
</html>
