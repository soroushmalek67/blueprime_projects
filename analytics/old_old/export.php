<?php
  session_start();
  if (!isset($_SESSION['ProjectID']))
    header("Location: projects.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Export Your Data</title>
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
            <li>
              <?php 
                if ($_SESSION['ProjectType'] =='1') 
                    echo '<a href="analytics2.php"><span class="glyphicon glyphicon-stats"></span> Analytics</a>';
                else 
                    echo '<a href="analytics.php"><span class="glyphicon glyphicon-stats"></span> Analytics</a>';
              ?>
            </li>
            <li class="active"><a href="export.php"><span class="glyphicon glyphicon-export"></span> Export </a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php 
              if ($_SESSION['ViewerCount'] >0) 
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
            $result = mysqli_query($con,"SELECT Name,(SELECT COUNT(*) FROM ProjectCompanies WHERE ProjectID=". $_SESSION['ProjectID'] .") CompanyCount FROM UserProjects Where ID=". $_SESSION['ProjectID']);
            $row = mysqli_fetch_array($result);
            $_SESSION['CompanyCount']  = $row[CompanyCount];
        ?>
       <br/>
         <ul class="nav nav-stacked nav-pills" >
          <li class="active">
            <a style="background-color:#D17D08">
              <span class="badge pull-right"><h5><?php echo $row[CompanyCount]; ?> Companies</h5></span>
              <h4><?php echo $row[Name]; ?></h4>
            </a>
          </li>
        </ul>       
      </div>
      <br/>
      <div style="clear:both"></div>   
        <div class="jumbotron1" style="font-family:Verdana;font-size:30px">
          You can save and print any of the visual views by clicking on Export tab. This function, however, is not available to test users and only available via subscription.
      </div>
      <div style="clear:both"></div>
      <br/><br/><br/><br/><br/><br/><br/>

    <?php include 'footer.php'; ?>

    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets3/js/jquery.js"></script>
    <script src="../assets3/js/bootstrap-transition.js"></script>
    <script src="../assets3/js/bootstrap-alert.js"></script>
    <script src="../assets3/js/bootstrap-modal.js"></script>
    <script src="../assets3/js/bootstrap-dropdown.js"></script>
    <script src="../assets3/js/bootstrap-scrollspy.js"></script>
    <script src="../assets3/js/bootstrap-tab.js"></script>
    <script src="../assets3/js/bootstrap-tooltip.js"></script>
    <script src="../assets3/js/bootstrap-popover.js"></script>
    <script src="../assets3/js/bootstrap-button.js"></script>
    <script src="../assets3/js/bootstrap-collapse.js"></script>
    <script src="../assets3/js/bootstrap-carousel.js"></script>
    <script src="../assets3/js/bootstrap-typeahead.js"></script>
   

  </body>
</html>