<?php
  session_start();
    if (!isset($_SESSION['UserID']))
      header("Location: index.html");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Firmogram - Viewers</title>
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
      </ul>
        <?php } ?>
      <ul class="nav navbar-nav navbar-right">
          <?php 
            if ($_SESSION['ViewerCount'] !== "") 
                echo '<li class="active"><a href="viewers.php"><span class="glyphicon glyphicon-user"></span> Viewers</a></li>';
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
        <br/><br/>
        <div style="float:right">
        <p>
          <?php if ($_SESSION["ReadOnly"]=="NO") { ?>
          <a href="#myModal" role="button" class="btn btn-primary" data-toggle="modal">New Viewer</a>
          <?php } ?>
          <!--<button name="btnDupFleet" class="btn btn-info" type="submit" onclick="return dupFleet();">Duplicate Fleet</button>-->
        </p>
      </div>
     <div style="clear:both"></div>
      <br/>
      <ul class="nav nav-tabs">
        <li class="active"><a href="#Viewers" data-toggle="tab">Viewers</a></li>
        <li><a href="#Activities" data-toggle="tab">Activities</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="Viewers">
          <br/>
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr style="background:#373;color:white">
              <th>Name</th>
              <th>Username</th>
              <th>Organization</th>
              <th>Signup Date</th>
            </tr>
          </thead>
          <tbody>
          <?php
            include 'dbConn.php';
            if (mysqli_connect_errno())
            {
              echo "<script>window.location = 'index.html'</script>";
              exit();
            }
            $result = mysqli_query($con,"SELECT * FROM Users Where ParentUserID=". $_SESSION['MainUserID'] . " and Status=1");
            if (!$result)
            {
              echo "<script>window.location = 'index.html'</script>";
              exit();
            }
            while($row = mysqli_fetch_array($result))
            {
              echo "<tr>";
              echo "<td>" . $row['Name'] . "</td>";
              echo "<td>" . $row['Username'] . "</td>";
              echo "<td>" . $row['Organization'] . "</td>";
              echo "<td>" . $row['CreatedDate'] . "</td>";
              echo "</tr>";
            }
        ?>
          </tbody>
        </table>
        </div> <!-- profile -->

        <div class="tab-pane" id="Activities">
          <br/>
        <table class="table table-striped table-bordered table-hover">
          <thead>
            <tr style="background:#373;color:white">
              <th>Name</th>
              <th>Username</th>
              <th>Organization</th>
              <th>Action</th>
              <th>Action Date</th>
            </tr>
          </thead>
          <tbody>
          <?php
            $result = mysqli_query($con,"SELECT * FROM Users INNER JOIN UserActions ON UserID=Users.ID Where ParentUserID=". $_SESSION['MainUserID'] . " and Users.Status=1 Order By ActionDate Desc");
            if (!$result)
            {
              echo "<script>window.location = 'index.html'</script>";
              exit();
            }
            while($row = mysqli_fetch_array($result))
            {
              echo "<tr>";
              echo "<td>" . $row['Name'] . "</td>";
              echo "<td>" . $row['Username'] . "</td>";
              echo "<td>" . $row['Organization'] . "</td>";
              echo "<td>" . $row['Action'] . "</td>";
              echo "<td>" . $row['ActionDate'] . "</td>";
              echo "</tr>";
            }
            mysqli_close($con);
        ?>
          </tbody>
        </table>
        </div> <!-- profile -->

       </div> <!-- myTabContent -->
       <br/><br/><br/>

    <?php include 'footer.php'; ?>

    </div> <!-- /container -->

  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <form action="addViewer.php" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">New Viewer</h3>
      </div>
      <div class="modal-body">
        <table>
          <tr>
            <td>Name: </td>
            <td>
              <div>
                  <input id="name" name="name" class="form-control" maxlength="320">
              </div>
            </td>
          </tr>
          <tr>
            <td>Email: </td>
            <td>
              <div>
                  <input id="email" name="email" class="form-control" maxlength="320" pattern="^[a-z0-9!#$%\x26'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%\x26'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$" required>
              </div>
            </td>
          </tr>
          <tr>
            <td>Password: </td>
            <td>
                  <input id="password" name="password" class="form-control" maxlength="50" pattern="^.+$">
            </td>
          </tr>
          </table>
        </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <input class="btn btn-primary" type="submit" value="Create Viewer" onclick='return newViewer();'>
      </div>
      </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

   <script type="text/javascript">
    function newViewer()
    {
      return (document.getElementById("email").value!="") && (document.getElementById("password").value!="");
    }
    </script>
  </body>
</html>
