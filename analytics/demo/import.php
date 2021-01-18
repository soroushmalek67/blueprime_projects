<?php
  session_start();
  if (!isset($_SESSION['ProjectID']))
    header("Location: projects.php");
  if ($_SESSION['ProjectType'] =='3') 
    header("Location: importNew.php");
  else if ($_SESSION['ProjectType'] =='2') 
    header("Location: build.php");
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Import Your Data</title>
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
          <a class="navbar-brand" href="projects.php"><span class="glyphicon glyphicon-list"></span> Projects</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
          <ul class="nav navbar-nav">
            <li class="active">
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
         <form action="import.php" method="post" enctype="multipart/form-data">
          <table>
            <tr>
              <td><input type="file" name="file" id="file" class='btn btn-success' ></td>
              <td><input type="submit" class='btn btn-success'  name="submit" value="Submit File"></td>
            </tr>
          </table>
        </form>     
        <div class="jumbotron1">
        <div class="bs-docs-example">
 
<?php
//$fileName = $_FILES["file"]["tmp_name"];
//$fileName = $_FILES["file"]["name"]; 
$fileTmpLoc = $_FILES["file"]["tmp_name"];
if ($fileTmpLoc !==NULL)
{
//  echo "***" . $fileTmpLoc . "***";
  $fileTmpLoc2= $_FILES["file"]["tmp_name"] . "9";
  //$pathAndName = "D:\\Hosting\\11457314\\html\\ces\\uploads\\".$fileName;
  //echo $fileTmpLoc2;
  //move_uploaded_file($fileTmpLoc,$pathAndName);
  move_uploaded_file($fileTmpLoc,$fileTmpLoc2);
  $row = 0;
  if (($handle = fopen($fileTmpLoc2, "r")) !== FALSE) {
      if (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
          $num = count($data);
          echo "<br/>";
          echo "<form action='importActions.php' method='post'>\n";
          echo "<input name='filename' type='hidden' value='$fileTmpLoc2'>";
          echo "<input id='count' name='count' type='hidden' value='$num'>";
          echo "<p> Map CSV fields to Target fields<br /></p>\n";
          echo "<table class='table table-striped table-bordered table-hover' style='width:500px'>\n";
          echo "<thead>\n";
          echo "<tr style='background:#373;color:white'>\n";
          echo "<th>CSV Field</th>\n";
          echo "<th>Target Field</th>\n";
          echo "</tr>\n";
          echo "</thead>\n";
          echo "<tbody>\n";
          $row++;
          for ($c=0; $c < $num; $c++) {
                      echo "<tr>\n";
                      echo "<td>$data[$c] </td>\n";
                      echo "<td>";
                      echo "<select class='form-control' id='opt$c' name='$c'>";
                      echo "<option>Select One</option>";
                      if (($data[$c]=="Name") || ($data[$c]=="Company Name"))
                        echo "<option selected>Company Name</option>";
                      else
                        echo "<option>Company Name</option>";
                      if (($data[$c]=="Description") || ($data[$c]=="Company Profile"))
                        echo "<option selected>Description</option>";
                      else
                        echo "<option>Description</option>";
                      if (($data[$c]=="Address") || ($data[$c]=="Street"))
                        echo "<option selected>Address</option>";
                      else
                        echo "<option>Address</option>";
                      if ($data[$c]=="City")
                        echo "<option selected>City</option>";
                      else
                        echo "<option>City</option>";
                      if (($data[$c]=="City, State ") || ($data[$c]=="City, Province "))
                        echo "<option selected>City,State</option>";
                      else
                        echo "<option>City,State</option>";
                      if (($data[$c]=="City, State, Zip ") || ($data[$c]=="City, Province, Postal Code "))
                        echo "<option selected>City,State,Zip</option>";
                      else
                        echo "<option>City,State,Zip</option>";
                      if (($data[$c]=="Province") || ($data[$c]=="Zip") || ($data[$c]=="ZipCode"))
                        echo "<option selected>Province</option>";
                      else
                        echo "<option>Province</option>";
                      if ($data[$c]=="Postal Code")
                        echo "<option selected>Postal Code</option>";
                      else
                        echo "<option>Postal Code</option>";
                      if ($data[$c]=="Country")
                        echo "<option selected>Country</option>";
                      else
                        echo "<option>Country</option>";
                      if (($data[$c]=="Phone") || ($data[$c]=="Telephone Number"))
                        echo "<option selected>Phone</option>";
                      else
                        echo "<option>Phone</option>";
                      if ($data[$c]=="Fax")
                        echo "<option selected>Fax</option>";
                      else
                        echo "<option>Fax</option>";
                      if ($data[$c]=="Email")
                        echo "<option selected>Email</option>";
                      else
                        echo "<option>Email</option>";
                      if (($data[$c]=="Website") || ($data[$c]=="Company Website Url"))
                        echo "<option selected>Website</option>";
                      else
                        echo "<option>Website</option>";
                      if ($data[$c]=="Contact Name")
                        echo "<option selected>Contact Name</option>";
                      else
                        echo "<option>Contact Name</option>";
                      if (($data[$c]=="Contact Title") || ($data[$c]=="Title"))
                        echo "<option selected>Contact Title</option>";
                      else
                        echo "<option>Contact Title</option>";
                      if ($data[$c]=="Contact Email")
                        echo "<option selected>Contact Email</option>";
                      else
                        echo "<option>Contact Email</option>";
                      if (($data[$c]=="No Employees") || ($data[$c]=="Size (Employee count)"))
                        echo "<option selected>No Employees</option>";
                      else
                        echo "<option>No Employees</option>";
                      if (($data[$c]=="Revenue") || ($data[$c]=="Sales/Revenue $USD (millions) "))
                        echo "<option selected>Revenue</option>";
                      else
                        echo "<option>Revenue</option>";
                      if (($data[$c]=="Sector") || ($data[$c]=="SectorName") || ($data[$c]=="Industry"))
                        echo "<option selected>Sector</option>";
                      else
                        echo "<option>Sector</option>";
                      if (($data[$c]=="LinkedIn") || ($data[$c]=="Linkedin"))
                        echo "<option selected>LinkedIn URL</option>";
                      else
                        echo "<option>LinkedIn URL</option>";
                      if ($data[$c]=="Facebook")
                        echo "<option selected>Facebook URL</option>";
                      else
                        echo "<option>Facebook URL</option>";
                      if ($data[$c]=="Twitter")
                        echo "<option selected>Twitter URL</option>";
                      else
                        echo "<option>Twitter URL</option>";
                      if (($data[$c]=="NewsRelease") || ($data[$c]=="Companies news release"))
                        echo "<option selected>News Release URL</option>";
                      else
                        echo "<option>News Release URL</option>";
                      if (($data[$c]=="URL") || ($data[$c]=="IC database (URL)"))
                        echo "<option selected>Other URL</option>";
                      else
                        echo "<option>Other URL</option>";
                      if ($data[$c]=="Rapid prototyping")
                        echo "<option selected>Capability</option>";
                      elseif ($data[$c]=="Prototypes (machining)")
                        echo "<option selected>Capability</option>";
                      elseif ($data[$c]=="Analysis & characterization")
                        echo "<option selected>Capability</option>";
                      elseif (($data[$c]=="Technology development concept") || ($data[$c]=="Technology development"))
                        echo "<option selected>Capability</option>";
                      elseif (($data[$c]=="Evaluation, expertise & independent third opinion") || ($data[$c]=="3rd party evaluation"))
                        echo "<option selected>Capability</option>";
                      elseif ($data[$c]=="Testing facilities")
                        echo "<option selected>Capability</option>";
                      elseif ($data[$c]=="Machine supply")
                        echo "<option selected>Capability</option>";
                      elseif ($data[$c]=="Tool Supply")
                        echo "<option selected>Capability</option>";
                      elseif ($data[$c]=="Standards office")
                        echo "<option selected>Capability</option>";
                      else
                        echo "<option>Capability</option>";
                      if (($data[$c]=="NAICS") || ($data[$c]=="NAICS (primary)"))
                        echo "<option selected>NAICS</option>";
                      else
                        echo "<option>NAICS</option>";
                      echo "</select>";
                      echo "</td>\n";
                      echo "</tr>\n";
          }
          if ($_SESSION['CompanyCount'] == 0)
            echo "<tr><td></td><td><div style='float:right'><button type='submit' class='btn btn-success' name='ImportData'  onclick='return importData(0);'>Import Data</button></div></td></tr>\n";
          else
            echo "<tr><td></td><td><div style='float:right'><button type='submit' class='btn btn-success' name='ImportData'  onclick='return importData(1);'>Import Data</button></div></td></tr>\n";
          echo "</tbody>\n";
          echo "</table>\n";
          echo "</form>\n";
      }
      fclose($handle);
  }  
}
?>

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

    <script type="text/javascript">
    function importData(conf)
    {
//      var selOpts = new Array();
      var cntOpts = new Array();
      for (var i=0;i<15;i++)
      {
        cntOpts[i] = 0;
      }
     var cnt = document.getElementById('count').value;
     for (var i=0;i<cnt;i++)
      {
        sel = document.getElementById('opt'+i);
 //       selOpts[i] = sel.selectedIndex;
        cntOpts[sel.selectedIndex] = cntOpts[sel.selectedIndex]+1;
        if ((cntOpts[sel.selectedIndex] >1) && (sel.selectedIndex>0)) {
          alert("'" + sel.options[sel.selectedIndex].text + "' has been selected multiple times. Each target filed can be selected only once.");
          return false;
        }
      }
      if (cntOpts[1] == 0 ) {
          alert("'Name' is mandatory and has to be mapped to a CSV field.");
          return false;
      }
      if ((cntOpts[4] == 0 )  && (cntOpts[5] == 0 ) && (cntOpts[6] == 0 )){
          alert("'City' is mandatory and has to be mapped to a CSV field.");
          return false;
      }
      if (cntOpts[9] == 0 ) {
          alert("'Country' is mandatory and has to be mapped to a CSV field.");
          return false;
      }
/*
      if (cntOpts[18] == 0 ) {
          alert("'Sector' is mandatory and has to be mapped to a CSV field.");
          return false;
      }
      */
      if (conf == 1)
        return confirm('By importing your file, you are loosing your current data. Do you still want to import anyway?');
      else
        return true;
    }
    </script>
   

  </body>
</html>