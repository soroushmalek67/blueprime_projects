<?php session_start();
  if ($_SESSION['Username'] !== "admin@blueprime.com")
    header("Location: index.html");
?>
<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title>Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets3/css/bootstrap.css" rel="stylesheet">
     <style type="text/css">
 
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #fff;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 150px auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
      </style>
      <link href="../assets3/css/bootstrap-responsive.css" rel="stylesheet">
      <link href="../assets3/css/carousel.css" rel="stylesheet">
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


</head>

  <body data-spy="scroll" data-target=".bs-docs-sidebar"> 


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
                      <a class="navbar-brand" href="admin.php">Home</a>
            </li>
          </ul>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
         <ul class="nav navbar-nav navbar-right">
          <li>
            <a href="signout.php">Sign Out</a>
          </li>
        </ul>
       </nav>
      </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div style="clear:both"></div>
    <div class="container">
      <br/>
      <div class="masthead">
        <h3>Welcome <?php echo $_SESSION['Username']; ?></h3>

      <!-- Jumbotron -->
      <ul class="nav nav-tabs">
        <li class="active"><a href="#List" data-toggle="tab">User List</a></li>
        <li><a href="#Activity" data-toggle="tab">Recent Activities</a></li>
      </ul>
      <div class="tab-content">
        <br/>
        <div class="tab-pane active" id="List">
          <form action="adminActions.php" method="post">
          <div style="float:right">
            <p>
              <!--<a href="#newUser" role="button" class="btn btn-primary" data-toggle="modal">New User</a>-->
              <button type="submit" class="btn btn-success" name="Activate">Activate</button>
              <button type="submit" class="btn btn-danger" name="Deactivate">Deactivate</button>
            </p>
          </div>
          <div style="clear:both"></div>
          <div class="jumbotron1">
            <div class="bs-docs-example">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr style="background:#373;color:white">
                      <th></th>
                      <th>Username</th>
                      <th>Organization</th>
                      <th>Created Date</th>
                      <th>Status</th>
                      <th>No Projects</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Create connection
                    include 'dbConn.php';

                    // Check connection
                    if (mysqli_connect_errno($con))
                    {
                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    else
                    {
                      $result = mysqli_query($con,"SELECT Users.*, (SELECT COUNT(*) FROM UserProjects WHERE UserProjects.UserID=Users.ID) NoProjects FROM Users WHERE Username<>'admin@blueprime.com'");

                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        if ($_SESSION['SelUserID']==$row['ID'])
                          echo "<td><input type='radio' id='UserID' name='UserID' value='" . $row['ID'] . "' checked></td>";                        
                        else
                          echo "<td><input type='radio' id='UserID' name='UserID' value='" . $row['ID'] . "'></td>";                        
                        echo "<td>" . $row['Username'] . "</td>";
                        echo "<td>" . $row['Organization'] . "</td>";
                        echo "<td>" . $row['CreatedDate'] . "</td>";
                        echo "<td>" . ($row['Status'] == 1 ? "Active" : "Inactive") . "</td>";
                        echo "<td>" . $row['NoProjects'] . "</td>";
                        echo "</tr>";
                      }
                      mysqli_close($con);
                    }
                    ?>
                  </tbody>
                </table>
              </div>
          </div>
          </form>
        </div> <!-- profile -->

        <div class="tab-pane" id="Activity">
          <div class="jumbotron1">
            <div class="bs-docs-example">
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr style="background:#373;color:white">
                      <th>Username</th>
                      <th>Organization</th>
                      <th>Action Date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // Create connection
                    include 'dbConn.php';

                    // Check connection
                    if (mysqli_connect_errno($con))
                    {
                      echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    }
                    else
                    {
                      $result = mysqli_query($con,"SELECT * FROM Users INNER JOIN UserActions ON Users.ID = UserActions.UserID WHERE Username<>'admin@blueprime.com' ORDER BY ActionDate DESC");

                      while($row = mysqli_fetch_array($result))
                      {
                        echo "<tr>";
                        echo "<td>" . $row['Username'] . "</td>";
                        echo "<td>" . $row['Organization'] . "</td>";
                        echo "<td>" . $row['ActionDate'] . "</td>";
                        echo "<td>" . $row['Action'] . "</td>";
                        echo "</tr>";
                      }
                      mysqli_close($con);
                    }
                    ?>
                  </tbody>
                </table>
              </div>
          </div>
        </div> <!-- profile -->
       </div> <!-- myTabContent -->
      <div style="clear:both"></div>
      <br/><br/><br/><br/><br/><br/><br/>

      <div class="footer">
        <p>&copy; Copyright 2013 blueprime analytics Inc. All Rights Reserved</p>
      </div>

    </div> <!-- /container -->

    <div id="errorModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel" aria-hidden="true">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="errorModalLabel">Error</h3>
      </div>
      <div class="alert alert-error" id="alErrorMsg">
        <strong>Error: </strong> Please select an item first.
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
      </div>
    </div>    

    <div class="modal fade" id="newUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <form action="adminActions.php" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">New User</h3>
      </div>
      <div class="alert alert-danger alert-dismissable" id="alEmail">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Error!</strong> Please enter an email address.
      </div>
       <div class="alert alert-danger  alert-dismissable" id="alPassword">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Error!</strong> Please enter a password.
      </div>
       <div class="alert alert-danger  alert-dismissable" id="alOrganization">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
          <strong>Error!</strong> Please enter an Organization.
      </div>
        <div class="modal-body">
        <div class="bs-docs-example">
          <table width="80%">
            <tr>
              <td>Email:</td>
              <td><input type="text" id="Email" name="Email"></td>
            </tr>
            <tr>
              <td>Password:</td>
              <td><input type="password" id="Password" name="Password"></td>
            </tr>
            <tr>
              <td>Organization:</td>
              <td><input type="text" id="Organization" name="Organization"></td>
            </tr>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <input class="btn btn-primary" type="submit" value="Create User" name="CreateUser" onclick='return newUser();'>
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
    <script src="../assets3/js/holder.js"></script>

    <script type="text/javascript">
    $("#alEmail").hide();
    $("#alPassword").hide();
    $("#alOrganization").hide();
    function newUser()
    {
      if (document.getElementById("Email").value=="")
        $("#alEmail").show();
      else
        $("#alEmail").hide();
      if (document.getElementById("Password").value=="")
        $("#alPassword").show();
      else
        $("#alPassword").hide();
      if (document.getElementById("Organization").value=="")
        $("#alOrganization").show();
      else
        $("#alOrganization").hide();
      return (document.getElementById("Email").value!="") && (document.getElementById("Password").value!="") && (document.getElementById("Organization").value!="");
    }  
    </script>

  </body>
</html>
