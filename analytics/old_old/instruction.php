<?php
    session_start();
    if (!isset($_SESSION['UserID']))
      header("Location: index.html");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Tool Instruction</title>
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
        <?php if (( strcmp( $_SESSION['ProjectID'], '' ) !== 0 )) {  ?>
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
            <li><a href="export.php"><span class="glyphicon glyphicon-export"></span> Export </a></li>
          </ul>
        <?php } ?>
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
      <br/>
      <br/>
      <iframe src="//player.vimeo.com/video/100476174" width="1000" height="550" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> <p><a href="http://vimeo.com/100476174">FIRMOGRAM Instruction</a> from <a href="http://vimeo.com/user29964807">blueprime</a> on <a href="https://vimeo.com">Vimeo</a>.</p>
      <br/>
      <div style="clear:both"></div>   
 
    <div id="features">
        <div class="container">
            <div class="section_header">
                <h3></h3>
            </div> 
            <div class="row feature">
                <div class="col-sm-2">
                    <img src="icons/Social-Media-Sharing.png" class="img-responsive" />
                </div>
                <div class="col-sm-10 info">
                    <h3>
                        Instruction
                    </h3>
                    <p>
                        Depending on your subscription type, you are able to login as “admin” or as “viewer” only.  An admin user is able to create new projects, change content of the existing projects, and manage the viewers’ access and permissions. Viewers can see the project content and complete firmographics and analytics features. Skip steps 1 and 2, if you are a viewer.
                        <br/>
                    </p>
                </div>
            </div>
            <br/><br/>
            <div class="row feature">
                <div class="col-sm-2">
                    <img src="icons/Upload-Information.png" class="img-responsive" />
                </div>
                <div class="col-sm-10 info">
                    <h3>
                        Step 1
                    </h3>
                    <p>
                        Begin creating your project by clicking on New Project. You can either upload your own data in csv or .txt format or use our company database. Your company data should be on a single spreadsheet table with the titles of each column in the first row (company name, address, province, country, web site, revenue, number of employees, capability, NAICS code).
                        <br/>
                        An examples is provided for:
                        <ul>
                          <li>A database of the supply chain for the Canadian Fuel Cell industry. </li>
                        </ul>
                    </p>
                </div>
            </div>
            <br/><br/>
            <div class="row feature">
                <div class="col-sm-2">
                    <img src="icons/Generate-tables.png" class="img-responsive" />
                </div>
                <div class="col-sm-10 info">
                    <h3>
                        Step 2
                    </h3>
                    <p>
                         If you are uploading your own data, select your project, then click Next to upload your input file (in .txt or .csv format created from any excel file). The software will walk you through the easy process of mapping your input data to FIRMOGRAM's field of attributes. After mapping, click Next. You can now start visualizing and viewing your company data.
                    </p>
                </div>
            </div>
            <br/><br/>
            <div class="row feature">
                <div class="col-sm-2">
                    <img src="icons/Database-Table.png" class="img-responsive" />
                </div>
                <div class="col-sm-10 info">
                    <h3>
                        Step 3
                    </h3>
                    <p>
                         With your project information loaded (or by clicking on one of the example projects), you can view the enhanced database under the Data Table tab. By clicking on the name of each company, you can view Company Info Card which includes a description of company, its firmographic data, location, activities, and capabilities. You can click on any icons on the top right of the Company Info Card to directly view social media feeds and other firmographics and visualizations related to this company.
                    </p>
                </div>
            </div>
            <br/><br/>
            <div class="row feature">
                <div class="col-sm-2">
                    <img src="icons/app-map.png" class="img-responsive" />
                </div>
                <div class="col-sm-10 info">
                    <h3>
                        Step 4
                    </h3>
                    <p>
                      Next, view on a map the geographic distribution and firmographic data of the companies in each jurisdiction by clicking on Geographic Map.
                    </p>
                </div>
            </div>
            <br/><br/>
            <div class="row feature">
                <div class="col-sm-2">
                    <img src="icons/target-market.png" class="img-responsive" />
                </div>
                <div class="col-sm-10 info">
                    <h3>
                        Step 5
                    </h3>
                    <p>
                         By clicking on the Eco-system tab (also available directly from company report card in Data Table tab), you can view different ecosystem visualizations - allowing you to clearly identify company relationships, synergies, and potential threats. By hovering the mouse on each capability, you can display the companies that exist within each business activity.                       
                    </p>
                </div>
            </div>
            <br/><br/>
            <div class="row feature">
                <div class="col-sm-2">
                    <img src="icons/Google-Analytics.png" class="img-responsive" />
                </div>
                <div class="col-sm-10 info">
                    <h3>
                        Step 6
                    </h3>
                    <p>
                         Clicking on either a capability or a company icon will take you to a network view. Zoom in to the details of each capability or each company by clicking on different network nodes. If you click on an individual company, you can also view the companies’ relationships in a tree-like graphic view.
                    </p>
                </div>
            </div>
            <br/><br/>
            <div class="row feature">
                <div class="col-sm-2">
                    <img src="icons/Analytics.png" class="img-responsive" />
                </div>
                <div class="col-sm-10 info">
                    <h3>
                        Step 7
                    </h3>
                    <p>
                      Clicking on the Analytics tab will open a high-level analysis of firmographics data for the ecosystem.
                    </p>
                </div>
            </div>
            <br/><br/>
            <div class="row feature">
                <div class="col-sm-2">
                    <img src="icons/Save.png" class="img-responsive" />
                </div>
                <div class="col-sm-10 info">
                    <h3>
                        Step 8
                    </h3>
                    <p>
                      Save and print any of the visual views by clicking on Export tab. This function, however, is not available to test users and only available via subscription.
                    </p>
                </div>
            </div>
        </div>
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