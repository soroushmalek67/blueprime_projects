<?php 
  session_start();             
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>FIRMOGRAM - Sign Up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/bootstrap-overrides.css" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/theme.css" />

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css' />

    <link rel="stylesheet" href="css/index.css" type="text/css" media="screen" />    
    <link rel="stylesheet" type="text/css" href="css/animate.css" media="screen, projection" />    
     <style type="text/css">
 
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
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets/ico/favicon.png">


</head>

  <body class="pull_top">

     <div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background: url('img/indigo5.png')">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.html" class="navbar-brand"><strong>FIRMOGRAM</strong></a>
            </div>

            <div class="collapse navbar-collapse navbar-ex1-collapse" role="navigation">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="about.html">ABOUT</a></li>
                    <li><a href="features.html">FEATURES</a></li>
                    <li><a href="pricing.html">PRICING</a></li>
                    <li><a href="signin.php">Sign in</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="navbar-wrapper">
      <div class="container">

      <div style="margin-top:100px">
      <form class="form-signin" action="signupActions.php" method="post">
       <h1>Sign Up</h1>
       <hr>
           <table width="100%">
            <tr>
              <td><input type="text" id="Email" name="Email"  placeholder="Email address"></td>
            </tr>
            <tr>
              <td><input type="password" id="Password" name="Password" placeholder="Password"></td>
            </tr>
            <tr>
              <td><input type="text" id="Organization" name="Organization" placeholder="Organization"></td>
            </tr>
          </table>
        <br/>
        <button class="btn btn-large btn-primary" type="submit" onclick='return newUser();'>Sign Up</button>
      </form>
    </div>
    </div>
    </div> <!-- /container -->
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
    function newUser()
    {
      alert("Please email info@firmogram.com to request a demo.");
      return false;
    }
     function newUser1()
    {
      if (document.getElementById("Email").value=="")
        alert("Please enter an Email address.");
      else
      {
        if (document.getElementById("Password").value=="")
          alert("Please enter a password.");
        else
        {
          if (document.getElementById("Organization").value=="")
            alert("Please enter an organization.");
        }
      }
      return (document.getElementById("Email").value!="") && (document.getElementById("Password").value!="") && (document.getElementById("Organization").value!="");
    }  
    </script>

<?php 
  $error = $_SESSION['SignInError'];
  if ($error!="")
    echo "<script type='text/javascript'>document.getElementById('signInError').style.visibility='visible';</script>";
  $_SESSION['SignInError']="";
?>
  </body>
</html>
