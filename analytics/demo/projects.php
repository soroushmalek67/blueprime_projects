<?php
    session_start();
    if (!isset($_SESSION['UserID']))
    header("Location: index.html");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Firmogram - Projects </title>
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
          <ul class="nav navbar-nav">
            <li class="active">
                      <a class="navbar-brand" href="projects.php"><span class="glyphicon glyphicon-list"></span> Projects</a>
            </li>
          </ul>
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
          </ul>
        <?php } ?>
          <ul class="nav navbar-nav navbar-right">
            <?php 
              if ($_SESSION['ViewerCount'] !== "") 
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
        <?php if (( strcmp( $_SESSION['UserID'], '17' ) !== 0 )) {  ?>
        <br/>
        <br/>
        <div style="float:left">
          <a href="instruction.php" role="button" class="btn btn-primary btn-lg" style="height:80px;width:970px;padding-top:25px;font-size:25px;">Tool Instruction</a>
        </div>
      <div style="clear:both"></div>
        <?php } ?>
        <br/>
        <ul class="nav nav-stacked nav-pills" >
          <li class="active">
            <a style="background-color:#106D18">
              <h4>Projects</h4>
            </a>
          </li>
        </ul>       
      <div style="clear:both"></div>
      <br/>
      <div class="masthead">
      <!-- Jumbotron -->
      <form action="projectActions.php" method="post">
      <div style="float:right">
        <p>
          <?php if ($_SESSION["ReadOnly"]=="NO") { ?>
          <a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">New Project</a>
          <button name="btnDelProject" class="btn btn-danger" type="submit" onclick="return delProject();">Remove Project</button>
          <button name="btnDupProject" class="btn btn-info" type="submit" onclick="return dupProject();">Duplicate Project</button>
          <?php } ?>
          <!--<button name="btnDupFleet" class="btn btn-info" type="submit" onclick="return dupFleet();">Duplicate Fleet</button>-->
        </p>
      </div>
      <div style="clear:both"></div>
      <div class="jumbotron1">
        <div class="bs-docs-example">
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr style="background:#373;color:white">
                  <th></th>
                  <th>Name</th>
                  <th>Created Date</th>
                  <th>Type</th>
                  <th>No Companies</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include 'dbConn.php';
                if (mysqli_connect_errno($con))
                {
                  echo "<script>window.location = 'index.html'</script>";
                  exit();
                }
                else
                {
                  $result = mysqli_query($con,"SELECT *,CASE WHEN Type=1 THEN 'Import File' WHEN Type=3 THEN 'Import File (Simplified)' ELSE 'Blueprime Database' END TypeDesc , (SELECT COUNT(*) FROM ProjectCompanies WHERE ProjectCompanies.ProjectID = UserProjects.ID) NoCompanies FROM UserProjects WHERE Status<>'Deleted' AND UserID=".$_SESSION['UserID']);
                  if (!$result)
                  {
                    echo "<script>window.location = 'index.html'</script>";
                    exit();
                  }
                  while($row = mysqli_fetch_array($result))
                  {
                    echo "<tr>";
                    if ($_SESSION['ProjectID']==$row['ID'])
                      echo "<td><input type='radio' name='ProjectID' name='ProjectID' value='" . $row['ID'] . "' checked></td>";
                    else
                      echo "<td><input type='radio' name='ProjectID' name='ProjectID' value='" . $row['ID'] . "' onclick='projectChanged()' ></td>";                        
                    echo "<td>" . $row['Name'] . "</td>";
                    echo "<td>" . $row['CreatedDate'] . "</td>";
                    echo "<td>" . $row['TypeDesc'] . "</td>";
                    echo "<td>" . $row['NoCompanies'] . "</td>";
                    echo "</tr>";
                  }
                  mysqli_free_result($result);
                  
                  mysqli_close($con);
                }
                ?>
              </tbody>
            </table>
          </div>
          <div style="float:right">
            <button name="btnNextStep" class="btn btn-large btn-success" type="submit" onclick="return nextStep();">Next Step</button>
          </div>
      </div>
      </form>
      <div style="clear:both"></div>
      <br/><br/><br/><br/><br/><br/><br/>

    <?php include 'footer.php'; ?>

    </div> <!-- /container -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <form action="addProject.php" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">New Project</h3>
      </div>
      <div class="alert alert-danger alert-dismissable" id="alName">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> Please enter a title for the project.
      </div>
       <div class="alert alert-danger  alert-dismissable" id="alType">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong> Please select a type for the project.
      </div>
      <div class="modal-body">
        <table>
          <tr>
            <td>Project Title: </td>
            <td>
              <div>
                <input type="text" id="ProjectName" name="ProjectName" class="form-control"> 
              </div>
            </td>
          </tr>
          <tr>
            <td>Project Type: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td>
              <input type="radio" name="ProjectType" id="ProjectType" value="1"> Import File
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <input type="radio" name="ProjectType" id="ProjectType" value="2"> Blueprime Database
            </td>
          </tr>
          <tr>
            <td></td>
            <td>
              <input type="radio" name="ProjectType" id="ProjectType" value="3"> Import File (Simplified)
            </td>
          </tr>
        </table>
        </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <input class="btn btn-primary" type="submit" value="Create Project" onclick='return newProject();'>
      </div>
      </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

      <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets3/js/jquery.js"></script>
    <script src="../assets3/js/transition.js"></script>
    <script src="../assets3/js/alert.js"></script>
    <script src="../assets3/js/modal.js"></script>
    <script src="../assets3/js/dropdown.js"></script>
    <script src="../assets3/js/scrollspy.js"></script>
    <script src="../assets3/js/tab.js"></script>
    <script src="../assets3/js/tooltip.js"></script>
    <script src="../assets3/js/popover.js"></script>
    <script src="../assets3/js/button.js"></script>
    <script src="../assets3/js/collapse.js"></script>
    <script src="../assets3/js/carousel.js"></script>

    <script type="text/javascript">
    $("#alName").hide();
    $("#alType").hide();
    function newProject()
    {
      if (document.getElementById("ProjectName").value=="")
        $("#alName").show();
      else
        $("#alName").hide();
  //    alert(getCheckedRadioValue("FleetType"));
      if (getCheckedRadioValue("ProjectType")==null)
        $("#alType").show();
      else
        $("#alType").hide();
 //     alert((document.getElementById("FleetName").value!="") && (getCheckedRadioValue("FleetType")));
      return (document.getElementById("ProjectName").value!="") && (getCheckedRadioValue("ProjectType")!=null);
    }
   function dupProject()
    {
      if (getCheckedRadioValue("ProjectID")!=null)
        return confirm("Are you sure you want to duplicate this project?");
      alert("Please select a project first.");
      return false;
    }
   function delProject()
    {
      if (getCheckedRadioValue("ProjectID")!=null)
        return confirm("Are you sure you want to delete this project?");
      alert("Please select a project first.");
      return false;
    }
    function getCheckedRadioValue(radioGroupName) {
      var rads = document.getElementsByName(radioGroupName),
       i;
      for (i=0; i < rads.length; i++)
      if (rads[i].checked)
          return rads[i].value;
      return null; // or undefined, or your preferred default for none checked
    } 
    function nextStep()
    {
      if (getCheckedRadioValue("ProjectID")!=null)
        return true;
      alert("Please select a project First.");
      return false;
    }
    </script>
  </body>
</html>
