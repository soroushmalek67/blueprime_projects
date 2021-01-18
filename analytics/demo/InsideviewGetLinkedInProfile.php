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
    'appKey'       => '752j344b8d8jbf', //'vjd8fobwao87',
    'appSecret'    => '0jBZBWqDwPkGmXyK', // 'Bm1iG4ZsAUDyox86',
    'callbackUrl'  => NULL 
  );
  define('CONNECTION_COUNT', 20);
  define('DEFAULT_COMPANY_SEARCH', 'Microsoft');
  define('PORT_HTTP', '80');
  define('PORT_HTTP_SSL', '443');
  define('UPDATE_COUNT', 13);

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
    <?php
          $_SESSION['oauth']['linkedin']['authorized'] = (isset($_SESSION['oauth']['linkedin']['authorized'])) ? $_SESSION['oauth']['linkedin']['authorized'] : FALSE;
          if($_SESSION['oauth']['linkedin']['authorized'] === TRUE) {
                // Create connection
                include 'dbConn.php';
                // Check connection
                if (mysqli_connect_errno($con))
                {
                  echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                else
                {
                  include 'dbConn2.php';
                  $result = mysqli_query($con,"select distinct LinkedInID from InsideviewLinkedIns Where LinkedInID>0 and LinkedInID not in (select LinkedInID FROM LinkedIn) limit 100");
                  while($row = mysqli_fetch_array($result))
                  {
                    echo $row['LinkedInID']."<br/>";
                    $OBJ_linkedin = new LinkedIn($API_CONFIG);
                    $OBJ_linkedin->setTokenAccess($_SESSION['oauth']['linkedin']['access']);
                    $OBJ_linkedin->setResponseFormat(LINKEDIN::_RESPONSE_XML);
                    $response = $OBJ_linkedin->company($row['LinkedInID'].":(id,name,universal-name,email-domains,company-type,type,status,stock-exchange,ticker,description,industries,specialties,logo-url,website-url,twitter-id,founded-year,end-year,num-followers,employee-count-range,locations:(address,is-headquarters))");
                    if($response['success'] === TRUE) {
                      $company = new SimpleXMLElement($response['linkedin']);
                      //echo $response['linkedin'];
                      $Name = $company->name;
                      $Name = str_replace("'", "''", $Name);
                      $Ticker = $company->ticker;
                      $LogoURL = $company->{'logo-url'};
                      $Street1 = "";
                      $Street2 = "";
                      $City = "";
                      $State = "";
                      $Zip = "";
                      $Region = "";
                      $Country = "";
                      foreach($company->locations->location as $location) {
                          if($location->{'is-headquarters'} == 'true') {
                            $address = $location->address;
                            $Street1 = $address->street1;
                            $Street1 = str_replace("'", "''", $Street1);
                            $Street2 = $address->street2;
                            $City = $address->city;
                            $City = str_replace("'", "''", $City);
                            $State = $address->state;
                            $Zip = $address->{'postal-code'};
                            $Region = $address->{'region-code'};
                            $Country = $address->{'country'};
                          }
                        }
                      $ContactInfo = $company->{'contact-info'};
                      $Phone1 = $contactInfo->phone1;
                      $Phone2 = $contactInfo->phone2;
                      $Fax = $contactInfo->fax;
                      $StockExchange = $company->{'stock-exchange'}->name;
                      $FoundedYear = $company->{'founded-year'};
                      $EndYear = $company->{'end-year'};
                      $NumFollowers = $company->{'num-followers'};
                      $Industries = "";
                      foreach($company->industries->industry as $industry) {
                        $Industries = $Industries . $industry->name . ",";
                      }
                      $Industries = str_replace("'", "''", $Industries);
                      $Specialties = "";
                      foreach($company->specialties->specialty as $specialty) {
                        $Specialties = $Specialties . $specialty . ",";
                      }
                      $Specialties = str_replace("'", "''", $Specialties);
                      $CompanyType = $company->{'company-type'}->name;
                      $TwitterID = $company->{'twitter-id'};
                      $EmployeeCountRange = $company->{'employee-count-range'}->code;
                      $Website = $company->{'website-url'};
                      $UniversalName = $company->{'universal-name'};
                      $UniversalName = str_replace("'", "''", $UniversalName);
                      $EmailDomains = $company->{'email-domains'}->{'email-domain'};
                      $Description = str_replace("'", "''", $company->description);
                      $Status = $company->status->name;

                      $sql = "INSERT INTO LinkedIn (LinkedInID,Name,Ticker,LogoURL,Street1,Street2,City,State,Zip,Region,Country,ContactInfo,Phone1,Phone2,Fax,StockExchange,FoundedYear,EndYear,NumFollowers,Industries,Specialties,CompanyType,TwitterID,EmployeeCountRange,Website,UniversalName,EmailDomains,Description,Status,CreatedDate) VALUES (".$row['LinkedInID'].",'".$Name."','".$Ticker."','".$LogoURL."','".$Street1."','".$Street2."','".$City."','".$State."','".$Zip."','".$Region."','".$Country."','".$ContactInfo."','".$Phone1."','".$Phone2."','".$Fax."','".$StockExchange."','".$FoundedYear."','".$EndYear."','".$NumFollowers."','".$Industries."','".$Specialties."','".$CompanyType."','".$TwitterID."','".$EmployeeCountRange."','".$Website."','".$UniversalName."','".$EmailDomains."','".$Description."','".$Status."',CURDATE())";
                      $ret = mysql_query($sql) or die(mysql_error());
                      //echo $sql;
                    } else {
                      // request failed
                      $sql = "INSERT INTO LinkedIn (LinkedInID,CreatedDate) VALUES (".$row['LinkedInID'].",CURDATE())";
                      $ret = mysql_query($sql) or die(mysql_error());
                      echo "Error retrieving company search results:<br /><br />RESPONSE:<br /><br /><pre>" . print_r($response) . "</pre>";                
                    }
                  }
                  mysqli_close($con);
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
      <?php
      break;
  }
} catch(LinkedInException $e) {
  // exception raised by library call
  echo $e->getMessage();
}

?>
