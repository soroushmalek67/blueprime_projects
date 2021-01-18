<?php 
  session_start();             
?>
<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9 ie8" lang="en"> <![endif]-->
<!--[if IE 9]> <html class="ie9" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
  <head>
    <meta charset="utf-8">
    <title>FIRMOGRAM</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
    <meta name="description" content="Cassius is a stylish, modern, and flat design sold on the Themeforest Marketplace. It was created by David Parrelli. Enjoy!">
    <meta name="author" content="">

    
    <!-- LESS styles -->
    <!-- <link rel="stylesheet/less" type="text/css" href="css/less/custom.less" />  -->

    <!-- Main styles -->
    <link rel="stylesheet" href="ex/css/bootstrap.css">
    <link rel="stylesheet" href="ex/css/custom.css" >

    <!-- Custom styles -->
    <link rel="stylesheet" href="ex/css/fonts.css">
    <link rel="stylesheet" href="ex/css/magnific-popup.css">
    <link rel="stylesheet" href="ex/css/animations.css">

    <!-- Web fonts -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>
    <link href="http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.jpg">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.jpg">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.jpg">
                    <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.jpg">
                                   <link rel="shortcut icon" href="ico/favicon.jpg">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/bootstrap/respond.min.js"></script>
    <![endif]-->

  </head>

  <body class="inner signup">

    <div id="wrapper">

      <header>
        <div class="side-nav">
          <ul id="gn-menu" class="gn-menu-main">
            <li class="gn-trigger">
              <a class="gn-icon gn-icon-menu"><span>Menu</span></a>
              <nav class="gn-menu-wrapper">
                <div class="gn-scroller">
                  <ul class="gn-menu">
                    <li><a href="index.html#intro"><i class="gn-icon icon-home"></i>Home</a></li>
                    <li><a href="index.html#about"><i class="gn-icon linecon-bulb"></i>About</a></li>
                    <li><a href="index.html#about-1"><i class="gn-icon linecon-star"></i>Features</a></li>
<!--                    <li><a href="#pricing"><i class="gn-icon linecon-banknote"></i>Pricing</a></li> -->
                  </ul>
                </div><!-- /gn-scroller -->
              </nav>
            </li>

            <!-- logo -->
            <li class="logo-wrapper"><a class="logo home1" href="http://firmogram.com">FIRMOGRAM</a></li>

            <!-- top right: call to action -->
            <li class="cta hidden-xxsm"><a href="signupNew.php">Sign up</a></li>
            <li class="cta"><a href="login.php">Login</a></li>
          </ul>
        </div>
      </header>

      <!-- Contact -->
      <section id="contact" class="section">
        <div class="container">
          <div class="row">

            <div id="chat" class="col-lg-12">
              <div class="lead-form">
                <h2>Login</h2>
                
                <form class="user-form" action="loginActions.php" method="post">
                  <div class="controls">
                    <input type="email" name="email" class="email" placeholder="Enter your email" maxlength="320" pattern="^[a-z0-9!#$%\x26'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%\x26'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$" required>
                    <input type="password" name="password" class="password" maxlength="50" pattern="^.+$" required placeholder="Enter your password">
                    <div class="help-inline" style="visibility:hidden;color:red" id="signInError">Incorrect Username or Password</div>
                    <input type="submit" class="submit btn cta" value="Submit">
                  </div>

                </form>
              </div>
            </div>

          </div>

        </div>
      </section> <!-- end Contact Section -->

      <!-- Footer -->
      <footer>
        <div class="row">

          <div class="col-lg-4 copyright">
            <p>© 2014 FIRMOGRAM Analytics Inc. All rights reserved.</p>
          </div>
          <div class="col-lg-8 social pull-right text-right">
            <a target="_blank" href="https://www.facebook.com/pages/Firmogram/546327658829249"><span aria-hidden="true" class="icon-facebook"></span></a>    
            <a target="_blank" href="https://twitter.com/firmogram"><span aria-hidden="true" class="icon-twitter"></span></a>    
            <a target="_blank" href="http://www.linkedin.com/company/firmogram-ecosystem-visualization"><span aria-hidden="true" class="icon-linkedin"></span></a>
          </div>            
        </div>
      </footer> <!-- end Footer -->

    </div> <!-- end #wrapper -->

    <!-- Placed at the end of the document so the pages load faster -->
    <script src="ex/js/modernizr.custom.js"></script>
    
    <!--[if lt IE 9]>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <![endif]-->
    <!--[if (gte IE 9) | (!IE)]><!-->
    <script src="ex/js/jquery-1.10.1.min.js"></script>
    <!--<![endif]-->

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script src="ex/js/bootstrap/bootstrap.min.js"></script>

    <script src="ex/js/jquery.easing.1.3.js"></script>
    <script src="ex/js/jquery.scrollTo-min.js"></script>
    <script src="ex/js/jquery.nav.js"></script>
    <script src="ex/js/jquery.magnific-popup.min.js"></script>
    <script src="ex/js/jquery.waypoints.min.js"></script>
    <script src="ex/js/jquery.caroufredsel.js"></script>
    <script src="ex/js/classie.js"></script>
    <script src="ex/js/jquery.gnmenu.js"></script>
    
    <script src="ex/js/custom.js"></script>
    <?php 
      $error = $_SESSION['SignInError'];
      if ($error!="")
        echo "<script type='text/javascript'>document.getElementById('signInError').style.visibility='visible';</script>";
      $_SESSION['SignInError']="";
    ?>

    <!-- LESS SCRIPT (RECOMMENDED IF YOU KNOW LESS CSS) -->
    <!-- <script src="js/less-1.3.3.min.js"></script> -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52968593-1', 'auto');
  ga('send', 'pageview');

</script>

  </body>
</html>