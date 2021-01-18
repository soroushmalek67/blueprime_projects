<?php
  session_start();
  if (!isset($_SESSION['ProjectID']))
    header("Location: projects.php");
  if ($_SESSION['ProjectType'] =='1') 
    header("Location: import.php");
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
            else if ($_SESSION['ProjectType'] =='3') 
                echo '<li><a href="concept24.php"><span class="glyphicon glyphicon-dashboard"></span> Eco-system </a></li>';
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
         <form action="importNew.php" method="post" enctype="multipart/form-data">
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
$ProjectID = $_SESSION['ProjectID'];
$fileTmpLoc = $_FILES["file"]["tmp_name"];
include 'dbConn2.php';

if ($fileTmpLoc !==NULL)
{
//  $fileTmpLoc2= $_FILES["file"]["tmp_name"] . "9";
//  move_uploaded_file($fileTmpLoc,$fileTmpLoc2);
  $row = 0;
  $iName = -1;
  if (($handle = fopen($fileTmpLoc, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) 
    {
        $num = count($data);
        if ($row==0) 
        {
          $sql = "DELETE FROM ProjectCapabilities WHERE ProjectID=".$ProjectID;
//          echo $sql."<br/>";
          $ret = mysql_query($sql) or die(mysql_error());
          $sql = "DELETE FROM CompanyCapabilities WHERE CompanyID IN (SELECT ID FROM ProjectCompanies WHERE ProjectID=". $ProjectID . ")";
//          echo $sql."<br/>";
          $ret = mysql_query($sql) or die(mysql_error());
          $sql = "DELETE FROM ProjectCompanies WHERE ProjectID=". $ProjectID;
//          echo $sql."<br/>";
          $ret = mysql_query($sql) or die(mysql_error());
          for ($c=0; $c < $num; $c++) {
 //           echo $data[$c]."<br/>";
              if (($data[$c]=="Name") || ($data[$c]=="Company Name") || ($data[$c]=="Business Name"))
                  $iName = $c;
              if (($data[$c]=="NAICS") || ($data[$c]=="NAIC"))
                  $iNAICS = $c;
              if (($data[$c]=="Province") || ($data[$c]=="State"))
                  $iState = $c;
              if (($data[$c]=="City"))
                  $iCity = $c;
              if (($data[$c]=="Country"))
                  $iCountry = $c;
              if (($data[$c]=="Phone"))
                  $iPhone = $c;
              if (($data[$c]=="Employees"))
                  $iEmployees = $c;
              if (($data[$c]=="Products or Services") || ($data[$c]=="Company Profile"))
                  $iTitle = $c;
              if (($data[$c]=="Twitter"))
                  $iTwitter = $c;
          }
        }
        else
        {
//           echo "iName: ".$iName. ":: " . $data[$iName] . "<br/>";
          if ($iName>=0)
          {
            $Name = str_replace("'","''",$data[$iName]);
            $NAICS = "";
            $State = "";
            $City = "";
            $Country = "";
            $Phone = "";
            $Employees = "";
            $Title = "";
            $Twitter = "";

            if ($iNAICS>=0)
              $NAICS = str_replace("'","''",$data[$iNAICS]);
            if ($iState>=0)
              $State = str_replace("'","''",$data[$iState]);
            if ($iCity>=0)
              $City = str_replace("'","''",$data[$iCity]);
            if ($iCountry>=0)
              $Country = str_replace("'","''",$data[$iCountry]);
            if ($iPhone>=0)
              $Phone = str_replace("'","''",$data[$iPhone]);
            if ($iEmployees>=0)
              $Employees = str_replace("'","''",$data[$iEmployees]);
            if ($iTitle>=0)
              $Title = str_replace("'","''",$data[$iTitle]);
            if ($iTwitter>=0)
              $Twitter = str_replace("'","''",$data[$iTwitter]);
            /*
            $opts = array('http' =>
                array(
                    'method'  => 'GET',
                    'header'  => 'Content-type: application/x-www-form-urlencoded',
                )
            );
            $context = stream_context_create($opts);
            $result = file_get_contents("https://www.google.com/search?q=linkedin%3A".str_replace(" ","+",str_replace("&","%26",$Name)), false, $context);
            $result = strstr($result, 'www.linkedin.com/company');
            $LinkedIn = strstr($result, '&',true);
            if (($LinkedIn == "www.linkedin.com/") || ($LinkedIn == ""))
              $LinkedIn = "";
            else
              $LinkedIn = "http://" . str_replace("'","''",$LinkedIn);
            $result = file_get_contents("https://www.bing.com/search?q=facebook%3A".str_replace(" ","+",str_replace("&","%26",$Name)), false, $context);
            $result = strstr($result, 'www.facebook.com');
            $Facebook = strstr($result, '"',true);
//            echo $Facebook."<br/>";
            if (($Facebook == "www.facebook.com/") || ($Facebook == ""))
              $Facebook = "";
            else
              $Facebook = "http://" . str_replace("'","''",$Facebook);
            $sql = "INSERT INTO ProjectCompanies (ProjectID,Name,LinkedInURL,FacebookURL) VALUES ($ProjectID,'$Name','$LinkedIn','$Facebook')";
              */
            $sql = "INSERT INTO ProjectCompanies (ProjectID,Name,NAICSCode,State,City,Country,Phone,NoEmployees,Description,TwitterURL) VALUES ($ProjectID,'$Name','$NAICS','$State','$City','$Country','$Phone','$Employees','$Title','$Twitter')";
//          echo $sql."<br/>";
            $ret = mysql_query($sql) or die(mysql_error());
          }
        }
        $row++;
      }
      fclose($handle);
      $params = array(
              'ID'  => $ProjectID,
      );
      if ($_SERVER['SERVER_NAME']=="localhost")
        curl_request_async("http://localhost/ces/updatesocial.php",$params);
      else
        curl_request_async("http://firmogram.com/updatesocial.php",$params);
      echo "File was successfully imported.";
      echo "<script> window.location.replace('list.php') </script>";
    }
  } 

  function curl_request_async($url, $params)
  {
      foreach ($params as $key => &$val) {
        if (is_array($val)) $val = implode(',', $val);
        $post_params[] = $key.'='.urlencode($val);
      }
      $post_string = implode('&', $post_params);
      $parts=parse_url($url);
      $fp = fsockopen($parts['host'],
          isset($parts['port'])?$parts['port']:80,
          $errno, $errstr, 30);
      $parts['path'] .= '?'.$post_string;
      $out = "GET ".$parts['path']." HTTP/1.1\r\n";
      $out.= "Host: ".$parts['host']."\r\n";
      $out.= "Content-Type: application/x-www-form-urlencoded\r\n";
//      $out.= "Content-Length: ".strlen($post_string)."\r\n";
      $out.= "Connection: Close\r\n\r\n";
      //$out.= $post_string;
//      echo $out ."<br/>";
      fwrite($fp, $out);
      fclose($fp);
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