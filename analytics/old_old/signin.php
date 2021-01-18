<?php 
  session_start();             
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>FIRMOGRAM - Sign In</title>
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
                    <li><a href="signup.php">Sign up</a></li>
                </ul>
            </div>
        </div>
    </div>


    <div style="clear:both"></div>

    <div class="navbar-wrapper">
      <div class="container">
      <div>
      <form class="form-signin" action="signinActions.php" method="post">
        <h1>Sign In</h1>
        <hr>
       <input type="text" class="input-block-level" placeholder="Email address" name="username" >
        <input type="password" class="input-block-level" placeholder="password" name="password" >
        <div class="help-inline" style="visibility:hidden;color:red" id="signInError">Incorrect Username or Password</div>
        <br/>
        <button class="btn btn-large btn-primary" type="submit" >Sign In</button>
        <hr>
        <a href="#"><img src="img/linkedinS.png" /></a>
        <br/><br/>
        <a href="#"><img src="img/facebookS.png" /></a>
        <br/><br/>
        <a href="#"><img src="img/twitterS.png" /></a>
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

<?php 
  $error = $_SESSION['SignInError'];
  if ($error!="")
    echo "<script type='text/javascript'>document.getElementById('signInError').style.visibility='visible';</script>";
  $_SESSION['SignInError']="";
?>
  </body>
</html>
