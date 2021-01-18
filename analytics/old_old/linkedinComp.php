<?php
function oauth_session_exists() {
  if((is_array($_SESSION)) && (array_key_exists('oauth', $_SESSION))) {
    return TRUE;
  } else {
    return FALSE;
  }
}

try {
  // include the LinkedIn class
  require_once('linkedin_3.2.0.class.php');
  
  // start the session
  if(!session_start()) {
    throw new LinkedInException('This script requires session support, which appears to be disabled according to session_start().');
  }
  
  // display constants
  $API_CONFIG = array(
    'appKey'       => '752j344b8d8jbf',
    'appSecret'    => '0jBZBWqDwPkGmXyK',
    'callbackUrl'  => NULL 
  );
  define('CONNECTION_COUNT', 20);
  define('DEFAULT_COMPANY_SEARCH', 'Microsoft');
  define('PORT_HTTP', '80');
  define('PORT_HTTP_SSL', '443');
  define('UPDATE_COUNT', 10);

  // set index
  $_REQUEST[LINKEDIN::_GET_TYPE] = (isset($_REQUEST[LINKEDIN::_GET_TYPE])) ? $_REQUEST[LINKEDIN::_GET_TYPE] : '';
  switch($_REQUEST[LINKEDIN::_GET_TYPE]) {
    case 'initiate':
      /**
       * Handle user initiated LinkedIn connection, create the LinkedIn object.
       */
        
      // check for the correct http protocol (i.e. is this script being served via http or https)
      if($_SERVER['HTTPS'] == 'on') {
        $protocol = 'https';
      } else {
        $protocol = 'http';
      }
      
      // set the callback url
      $API_CONFIG['callbackUrl'] = $protocol . '://' . $_SERVER['SERVER_NAME'] . ((($_SERVER['SERVER_PORT'] != PORT_HTTP) || ($_SERVER['SERVER_PORT'] != PORT_HTTP_SSL)) ? ':' . $_SERVER['SERVER_PORT'] : '') . $_SERVER['PHP_SELF'] . '?' . LINKEDIN::_GET_TYPE . '=initiate&' . LINKEDIN::_GET_RESPONSE . '=1';
      $OBJ_linkedin = new LinkedIn($API_CONFIG);
      
      // check for response from LinkedIn
      $_GET[LINKEDIN::_GET_RESPONSE] = (isset($_GET[LINKEDIN::_GET_RESPONSE])) ? $_GET[LINKEDIN::_GET_RESPONSE] : '';
      if(!$_GET[LINKEDIN::_GET_RESPONSE]) {
        // LinkedIn hasn't sent us a response, the user is initiating the connection
        
        // send a request for a LinkedIn access token
        $response = $OBJ_linkedin->retrieveTokenRequest();
        if($response['success'] === TRUE) {
          // store the request token
          $_SESSION['oauth']['linkedin']['request'] = $response['linkedin'];
          
          // redirect the user to the LinkedIn authentication/authorisation page to initiate validation.
          header('Location: ' . LINKEDIN::_URL_AUTH . $response['linkedin']['oauth_token']);
        } else {
          // bad token request
          echo "Request token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
        }
      } else {
        // LinkedIn has sent a response, user has granted permission, take the temp access token, the user's secret and the verifier to request the user's real secret key
        $response = $OBJ_linkedin->retrieveTokenAccess($_SESSION['oauth']['linkedin']['request']['oauth_token'], $_SESSION['oauth']['linkedin']['request']['oauth_token_secret'], $_GET['oauth_verifier']);
        if($response['success'] === TRUE) {
          // the request went through without an error, gather user's 'access' tokens
          $_SESSION['oauth']['linkedin']['access'] = $response['linkedin'];
          
          // set the user as authorized for future quick reference
          $_SESSION['oauth']['linkedin']['authorized'] = TRUE;
            
          // redirect the user back to the demo page
          header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
          // bad token access
          echo "Access token retrieval failed:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
        }
      }
      break;
      
    case 'revoke':
      /**
       * Handle authorization revocation.
       */
                    
      // check the session
      if(!oauth_session_exists()) {
        throw new LinkedInException('This script requires session support, which doesn\'t appear to be working correctly.');
      }
      
      $OBJ_linkedin = new LinkedIn($API_CONFIG);
      $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
      $response = $OBJ_linkedin->revoke();
      if($response['success'] === TRUE) {
        // revocation successful, clear session
        session_unset();
        $_SESSION = array();
        if(session_destroy()) {
          // session destroyed
          header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
          // session not destroyed
          echo "Error clearing user's session";
        }
      } else {
        // revocation failed
        echo "Error revoking user's token:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
      }
      break; 
       
    case 'followCompany':
      /**
       * Handle company 'follows'.
       */
                    
      // check the session
      if(!oauth_session_exists()) {
        throw new LinkedInException('This script requires session support, which doesn\'t appear to be working correctly.');
      }
      
      $OBJ_linkedin = new LinkedIn($API_CONFIG);
      $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
      if(!empty($_GET['nCompanyId'])) {
        $response = $OBJ_linkedin->followCompany($_GET['nCompanyId']);
        if($response['success'] === TRUE) {
          // company 'followed'
          header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
          // problem with 'follow'
          echo "Error 'following' company:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
        }
      } else {
        echo "You must supply a company ID to 'follow' a company.";
      }
      break;

    case 'unfollowCompany':
      /**
       * Handle company 'unfollows'.
       */
                    
      // check the session
      if(!oauth_session_exists()) {
        throw new LinkedInException('This script requires session support, which doesn\'t appear to be working correctly.');
      }
      
      $OBJ_linkedin = new LinkedIn($API_CONFIG);
      $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
      if(!empty($_GET['nCompanyId'])) {
        $response = $OBJ_linkedin->unfollowCompany($_GET['nCompanyId']);
        if($response['success'] === TRUE) {
          // company 'unfollowed'
          header('Location: ' . $_SERVER['PHP_SELF']);
        } else {
          // problem with 'unfollow'
          echo "Error 'unfollowing' company:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response, TRUE) . "</pre><br /><br />LINKEDIN OBJ:<br /><br /><pre>" . print_r($OBJ_linkedin, TRUE) . "</pre>";
        }
      } else {
        echo "You must supply a company ID to 'unfollow' a company.";
      }
      break;
      
    default:
      // nothing being passed back, display demo page
      
      // check PHP version
      if(version_compare(PHP_VERSION, '5.0.0', '<')) {
        throw new LinkedInException('You must be running version 5.x or greater of PHP to use this library.'); 
      } 
      
      // check for cURL
      if(extension_loaded('curl')) {
        $curl_version = curl_version();
        $curl_version = $curl_version['version'];
      } else {
        throw new LinkedInException('You must load the cURL extension to use this library.'); 
      }
      ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>InsideView Directory</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets3/css/bootstrap.css" rel="stylesheet">
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

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner" style="background:#000;height:5px;border:0px">
        <div class="container">
          <div class="nav-collapse collapse">
            <ul class="nav" >
              <li><a style="color:white" href="index.php">Home</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div style="clear:both"></div>
    <div class="container">
      <br/>
      <div class="masthead">
      <!-- Jumbotron -->
      <div>
        <h2>LinkedIn Company Info</h2>
      </div>
      <div style="clear:both"></div>
      <div class="jumbotron1">
        <div class="bs-docs-example">
             

    <?php
          $_SESSION['oauth']['linkedin']['authorized'] = (isset($_SESSION['oauth']['linkedin']['authorized'])) ? $_SESSION['oauth']['linkedin']['authorized'] : FALSE;
          if($_SESSION['oauth']['linkedin']['authorized'] === TRUE) {
            // user is already connected
            $OBJ_linkedin = new LinkedIn($API_CONFIG);
            $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
            $OBJ_linkedin->setResponseFormat(LINKEDIN::_RESPONSE_XML);
            $response = $OBJ_linkedin->company($_GET['id'].":(id,name,universal-name,email-domains,company-type,type,status,stock-exchange,ticker,description,industries,specialties,logo-url,website-url,twitter-id,founded-year,end-year,num-followers,employee-count-range,locations:(address,is-headquarters))");
            if($response['success'] === TRUE) {
              $company = new SimpleXMLElement($response['linkedin']);
              ?>
              <div style=""><span style="font-weight: bold;"><?php echo $company->name;?> (<?php echo $company->ticker;?>)</span>&nbsp;<img src="<?php echo $company->{'logo-url'};?>" alt="<?php echo $company->name;?>" title="<?php echo $company->name;?>" style="vertical-align: middle;" /></div>
              <div style="margin: 0.5em 0 1em 2em;">
                <?php
                foreach($company->locations->location as $location) {
                  if($location->{'is-headquarters'} == 'true') {
                    $address = $location->address;
                    ?>
                    <label>Headquarters:</label> <?php echo $address->street1;?>, <?php echo $address->city;?>, <?php echo $address->{'country-code'};?><br/>
                    <?php
                  }
                  else{
                    $address = $location->address;
                    ?>
                    <label>Branch:</label> <?php echo $address->street1;?>, <?php echo $address->city;?>, <?php echo $address->{'country-code'};?>
                    <?php
                  }
                }
                ?>
              </div>
              <div style="margin: 0.5em 0 1em 2em;">
                <label>Industries:</label>
                <?php
                $industries = "";
                foreach($company->industries->industry as $industry) {
                  $industries = $industries . $industry->name . ",";
                    ?>
                     <?php echo $industry->name;?>, 
                    <?php
                }
                ?>
                <br/>
              </div>
              <div style="margin: 0.5em 0 1em 2em;">
                <label>Specialties:</label>
                <?php
                $specialties = "";
                foreach($company->specialties->specialty as $specialty) {
                        $specialties = $specialties . $specialty . ",";
              ?>
                     <?php echo $specialty;?>,  
                    <?php
                }
                ?>
                <br/>
              </div>
              <div style="margin: 0.5em 0 1em 2em;">
                <label>Type:</label> <?php echo $specialties;?>
              </div>
               <div style="margin: 0.5em 0 1em 2em;">
                <label>Company-Type:</label> <?php echo $company->{'type'};?>
              </div>
             <div style="margin: 0.5em 0 1em 2em;">
                <label>Twitter ID:</label> <?php echo $company->{'twitter-id'};?>
              </div>
              <div style="margin: 0.5em 0 1em 2em;">
                <label>employee-count-range:</label> <?php echo $company->{'employee-count-range'};?>
              </div>
              <div style="margin: 0.5em 0 1em 2em;">
                <label>founded-year:</label> <?php echo $company->{'founded-year'};?>
              </div>
              <div style="margin: 0.5em 0 1em 2em;">
                <label>num-followers:</label> <?php echo $company->{'num-followers'};?>
              </div>
              <div style="margin: 0.5em 0 1em 2em;">
                <label>website-url:</label> <a href="<?php echo $company->{'website-url'};?>"><?php echo $company->{'website-url'};?></a>
              </div>
              <div style="margin: 0.5em 0 1em 2em;">
                <label>Description: </label> <?php echo $company->description;?>
              </div>
              <?php
              $response = $OBJ_linkedin->companyProducts($_GET['id'], ':(id,name,type,recommendations:(recommender,id))');
              if($response['success'] === TRUE) {
                $response['linkedin'] = new SimpleXMLElement($response['linkedin']);
                ?>
                <div style="margin: 0.5em 0 1em 2em;">
                  Products: <pre><?php print_r($response['linkedin']);?></pre>
                </div>
              <?php
              } else {
                // request failed
                echo "Error retrieving company products:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response) . "</pre>";
              }
             } else {
              // request failed
              echo "Error retrieving company search results:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response) . "</pre>";                
            }
          } else {
            // user isn't connected
            ?>
            <form id="linkedin_connect_form" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
              <input type="hidden" name="<?php echo LINKEDIN::_GET_TYPE;?>" id="<?php echo LINKEDIN::_GET_TYPE;?>" value="initiate" />
              <input type="submit" value="Connect to LinkedIn" />
            </form>
            <?php
          }
          ?>
          </div>
      </div>
      <div style="clear:both"></div>
      <br/><br/><br/><br/><br/><br/><br/>

      <div class="footer">
        <p>&copy; Copyright 2013 blueprime analytics Inc. All Rights Reserved</p>
      </div>

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
      <?php
      break;
  }
} catch(LinkedInException $e) {
  // exception raised by library call
  echo $e->getMessage();
}

?>
