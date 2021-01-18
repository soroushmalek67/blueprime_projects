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

  <!-- Stylesheet --> 
  <link rel="stylesheet" href="style.css" type="text/css" />
  
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="http://www.findtheconversation.com/xmlrpc.php" />
  
<link rel='stylesheet' id='collapseomatic-css-css'  href='http://www.findtheconversation.com/wp-content/plugins/jquery-collapse-o-matic/style.css?ver=1.5.2' type='text/css' media='all' />
<link rel='stylesheet' id='fancybox-stylesheet-css'  href='http://www.findtheconversation.com/wp-content/themes/oxygen/js/fancybox/jquery.fancybox-1.3.4.css?ver=1' type='text/css' media='screen' />
<link rel='stylesheet' id='font-abel-css'  href='http://fonts.googleapis.com/css?family=Abel&#038;ver=1' type='text/css' media='screen' />
<link rel='stylesheet' id='font-oswald-css'  href='http://fonts.googleapis.com/css?family=Oswald&#038;ver=1' type='text/css' media='screen' />
<link rel='stylesheet' id='font-terminal-dosis-css'  href='http://fonts.googleapis.com/css?family=Terminal+Dosis&#038;ver=1' type='text/css' media='screen' />
<link rel='stylesheet' id='font-droid-serif-css'  href='http://fonts.googleapis.com/css?family=Droid+Serif%3A400%2C400italic&#038;ver=1' type='text/css' media='screen' />
<link rel='stylesheet' id='wp-advanced-rp-css-css'  href='http://www.findtheconversation.com/wp-content/plugins/advanced-recent-posts-widget/css/advanced-recent-posts-widget.css?ver=3.5.2' type='text/css' media='all' />
<link rel='stylesheet' id='mediaelementjs-styles-css'  href='http://www.findtheconversation.com/wp-content/plugins/media-element-html5-video-and-audio-player/mediaelement/mediaelementplayer.css?ver=3.5.2' type='text/css' media='all' />
<script type='text/javascript' src='http://www.findtheconversation.com/wp-includes/js/jquery/jquery.js?ver=1.8.3'></script>
<script type='text/javascript' src='http://www.findtheconversation.com/wp-content/plugins/jquery-collapse-o-matic/collapse.min.js?ver=1.4.9'></script>
<script type='text/javascript' src='http://www.findtheconversation.com/wp-includes/js/comment-reply.min.js?ver=3.5.2'></script>
<script type='text/javascript' src='http://www.findtheconversation.com/wp-content/plugins/media-element-html5-video-and-audio-player/mediaelement/mediaelement-and-player.min.js?ver=2.7.0'></script>

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
          <a href="list.php"><span class="glyphicon glyphicon-th"></span> Data </a>
        </li>
        <li>
           <a href="view.php"><span class="glyphicon glyphicon-globe"></span> Map </a>
        </li>
        <li>
          <?php 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<a href="concept.php"><span class="glyphicon glyphicon-dashboard"></span> Graph 1</a>';
            else 
                echo '<a href="concept10.php"><span class="glyphicon glyphicon-dashboard"></span> Graph 1</a>';
          ?>
        </li>
          <?php 
            if ($_SESSION['ProjectType'] =='1') 
            {
                echo '<li><a href="concept4.php"><span class="glyphicon glyphicon-dashboard"></span> Graph 2</a></li>';
                echo '<li class="active"><a href="concept3.php"><span class="glyphicon glyphicon-dashboard"></span> Graph 3</a></li>';
            }
          ?>
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
<br/><br/><br/>
    <div style="clear:both"></div>
  <div id="container">
    
    <div class="wrap">

        
      <div id="header">
  
          
          <div id="branding">
          </div><!-- #branding -->
          
      </div><!-- #header -->
  
        
        
      <div id="main">
  
        
<div id="graph"></div>
<div id="graph-info"></div>
<script src="d3.v3.min.js"></script>
<script src="conv3.min.js"></script>

        
        
        </div><!-- .content-wrap -->

        
    </div><!-- #main -->

    
    
    <div id="footer">

            
      <div id="footer-content">
        

</form>
        
      </div>
        
      
      
      
    </div><!-- #footer -->

        
    </div><!-- .wrap -->
      <div class="footer">
        <p>&copy; Copyright 2014 blueprime analytics Inc. All Rights Reserved</p>
      </div>

    
  </div><!-- #container -->

    
  <script type='text/javascript' src='http://www.findtheconversation.com/wp-content/themes/oxygen/js/jquery.imagesloaded.js?ver=1.0'></script>
<script type='text/javascript' src='http://www.findtheconversation.com/wp-content/themes/oxygen/js/jquery.masonry.min.js?ver=1.0'></script>
<script type='text/javascript' src='http://www.findtheconversation.com/wp-content/themes/oxygen/js/cycle/jquery.cycle.min.js?ver=1.0'></script>
<script type='text/javascript' src='http://www.findtheconversation.com/wp-content/themes/oxygen/js/fitvids/jquery.fitvids.js?ver=1.0'></script>
<script type='text/javascript' src='http://www.findtheconversation.com/wp-content/themes/oxygen/js/fancybox/jquery.fancybox-1.3.4.pack.js?ver=1.0'></script>
<script type='text/javascript'>
/* <![CDATA[ */
var slider_settings = {"timeout":"6000"};
/* ]]> */
</script>
<script type='text/javascript' src='http://www.findtheconversation.com/wp-content/themes/oxygen/js/footer-scripts.js?ver=1.0'></script>
<script type='text/javascript' src='http://www.findtheconversation.com/wp-content/themes/oxygen/library/js/drop-downs.js?ver=20110920'></script>

</body>
</html>

<!-- Performance optimized by W3 Total Cache. Learn more: http://www.w3-edge.com/wordpress-plugins/

Page Caching using disk: enhanced

 Served from: www.findtheconversation.com @ 2014-02-19 20:02:15 by W3 Total Cache -->