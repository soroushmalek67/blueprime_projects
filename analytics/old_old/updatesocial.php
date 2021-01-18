<?php
  session_start();
  $ProjectID = $_GET['ID'];
  $site = "http://www.google.com";
//  $site = "https://search.yahoo.com";
  if ($ProjectID=="")
    $ProjectID = $_SESSION['ProjectID'];
  //echo $ProjectID;
  include 'dbConn2.php';
  $result = mysql_query("SELECT * FROM ProjectCompanies WHERE ProjectID=". $ProjectID . " LIMIT 5");
//  $result = mysql_query("SELECT * FROM ProjectCompanies WHERE ProjectID=". $ProjectID . " AND FacebookURL IS NULL LIMIT 1");
//  echo "SELECT * FROM ProjectCompanies WHERE ProjectID=". $ProjectID . " AND FacebookURL IS NULL LIMIT 1";
  $i=0;
  $LinkedIn = "";
  $Facebook = "";
  $Twitter = "";
  $Manta = "";
  $InsideviewID = 0;
  while($row = mysql_fetch_array($result))
  {
    $i=$i+1;
      $Name = str_replace("'","''",$row['Name']);
      $opts = array('http' =>
          array(
              'method'  => 'GET',
              'header'  => 'Content-type: application/x-www-form-urlencoded',
          )
      );
      $context = stream_context_create($opts);
      $res = file_get_contents($site . "/search?q=linkedin%3A".str_replace(" ","+",str_replace("&","%26",$Name)), false, $context);
      $res = strstr($res, ' results');
      $res = strstr($res, '/url?q=');
      $LinkedIn = strstr($res, '&',true);
      $LinkedIn = str_replace('/url?q=','',$LinkedIn);
      $LinkedIn = str_replace("'","''",$LinkedIn);
      if (strstr($LinkedIn, 'linkedin.com/company')=="")
        $LinkedIn = "";
      $res = file_get_contents($site . "/search?q=facebook%3A".str_replace(" ","+",str_replace("&","%26",$Name)), false, $context);
      $res = strstr($res, ' results');
      $res = strstr($res, '/url?q=');
      $Facebook = strstr($res, '&',true);
      $Facebook = str_replace('/url?q=','',$Facebook);
      $Facebook = str_replace("'","''",$Facebook);
      if (strstr($Facebook, 'facebook.com')=="")
        $Facebook = "";
      $res = file_get_contents($site . "/search?q=twitter%3A".str_replace(" ","+",str_replace("&","%26",$Name)), false, $context);
      $res = strstr($res, ' results');
      $res = strstr($res, '/url?q=');
      $Twitter = strstr($res, '&',true);
      $Twitter = str_replace('/url?q=','',$Twitter);
      $Twitter = str_replace("'","''",$Twitter);
      if (strstr($Twitter, 'twitter.com')=="")
        $Twitter = "";
      $res = file_get_contents($site . "/search?q=manta%3A".str_replace(" ","+",str_replace("&","%26",$Name)), false, $context);
      $res = strstr($res, ' results');
      $res = strstr($res, '/url?q=');
      $Manta = strstr($res, '&',true);
      $Manta = str_replace('/url?q=','',$Manta);
      $Manta = str_replace("'","''",$Manta);
      if (strstr($Manta, 'manta.com')=="")
        $Manta = "";
      $res = file_get_contents($site . "/search?q=insideview%3A".str_replace(" ","+",str_replace("&","%26",$Name)), false, $context);
      $res = strstr($res, ' results');
      $res = strstr($res, '/url?q=');
      $Insideview = strstr($res, '&',true);
      $Insideview = str_replace('/url?q=','',$Insideview);
      $Insideview = str_replace("'","''",$Insideview);
      if (strstr($Insideview,'insideview') == "")
        $InsideviewID = 0;
      else
      {
        $result2 = mysql_query("SELECT * FROM Insideview WHERE CompanyPath='". $Insideview ."'");
        if ($row2 = mysql_fetch_array($result2))
          $InsideviewID=$row2['ID'];
        else
        { 
          $res = file_get_contents($Insideview, false, $context);
          $res = strstr($res, 'views-field-company-name');
          $res = strstr($res, 'field-content">');
          $Name = strstr($res, '</span>',true);
          $Name = str_replace('field-content">','',$Name);
          $res = strstr($res, 'views-field-street');
          $res = strstr($res, 'field-content">');
          $Street = strstr($res, '</span>',true);
          $Street = str_replace('field-content">','',$Street);
          $res = strstr($res, 'views-field-city');
          $res = strstr($res, 'field-content">');
          $City = strstr($res, '</span>',true);
          $City = str_replace('field-content">','',$City);
          $res = strstr($res, 'views-field-state');
          $res = strstr($res, 'field-content">');
          $State = strstr($res, '</span>',true);
          $State = str_replace('field-content">','',$State);
          $res = strstr($res, 'views-field-zip');
          $res = strstr($res, 'field-content">');
          $Zip = strstr($res, '</span>',true);
          $Zip = str_replace('field-content">','',$Zip);
          $res = strstr($res, 'views-field-country');
          $res = strstr($res, 'field-content">');
          $Country = strstr($res, '</span>',true);
          $Country = str_replace('field-content">','',$Country);
          $res = strstr($res, 'views-field-website');
          $res = strstr($res, 'http://');
          $Website = strstr($res, '"',true);
          $res = strstr($res, 'views-field-phone');
          $res = strstr($res, 'field-content">');
          $Phone = strstr($res, '</span>',true);
          $Phone = str_replace('field-content"><span id="phone">Phone:','',$Phone);
          $res = strstr($res, 'views-field-revenue');
          $res = strstr($res, 'field-content">');
          $Revenue = strstr($res, '</span>',true);
          $Revenue = str_replace('field-content">','',$Revenue);
          $Revenue = str_replace('$','',$Revenue);
          $Revenue = str_replace('M','',$Revenue);
          $res = strstr($res, 'views-field-primary-industry');
          $res = strstr($res, '/companies">');
          $Industry = strstr($res, '</a>',true);
          $Industry = str_replace('/companies">','',$Industry);
          $Industry = str_replace('&amp;','&',$Industry);
          $res = strstr($res, 'views-field-no-of-emp');
          $res = strstr($res, 'field-content">');
          $Emp = strstr($res, '</span>',true);
          $Emp = str_replace('field-content">','',$Emp);
          $res = strstr($res, 'views-field-sic');
          $res = strstr($res, 'field-content"><span>');
          $SIC = strstr($res, '</span>',true);
          $SIC = str_replace('field-content"><span>','',$SIC);
          $SIC = str_replace('&amp;','&',$SIC);
          $res = strstr($res, '<span>(');
          $SICNo = strstr($res, ')</span>',true);
          $SICNo = str_replace('<span>(','',$SICNo);
          $res = strstr($res, 'views-field-naics');
          $res = strstr($res, 'field-content"><span>');
          $NAICS = strstr($res, '</span>',true);
          $NAICS = str_replace('field-content"><span>','',$NAICS);
          $NAICS = str_replace('&amp;','&',$NAICS);
          $res = strstr($res, '<span>(');
          $NAICSNo = strstr($res, ')</span>',true);
          $NAICSNo = str_replace('<span>(','',$NAICSNo);
          $res = strstr($res, 'views-field-creationDate');
          $res = strstr($res, 'field-content">');
          $CreationDate = strstr($res, '</span>',true);
          $CreationDate = str_replace('field-content">','',$CreationDate);
          $sql = "INSERT INTO Insideview (CompanyPath,CompanyName,CompanyStreet,CompanyCity,CompanyState,CompanyZip,CompanyCountry,CompanyWebsite,CompanyPhone,CompanyRevenue,CompanyPrimaryIndustry,CompanyNoEmployees,CompanySIC,CompanySICNo,CompanyNAICS,CompanyNAICSNo,CompanyCreationDate) VALUES ('". $Insideview."','". $Name."','". $Street."','". $City."','". $State."','". $Zip."','". $Country."','". $Website."','". $Phone."','". $Revenue."','". $Industry."','". $Emp."','". $SIC."','". $SICNo."','". $NAICS."','". $NAICSNo."','". $CreationDate."')";
          $ret = mysql_query($sql) or die(mysql_error());
          if ($ret==1)
            $InsideviewID = mysql_insert_id();
          else
            $InsideviewID = 0;
        }
      }
    $sql = "UPDATE ProjectCompanies SET LinkedInURL='". $LinkedIn ."',FacebookURL='". $Facebook ."',TwitterURL='". $Twitter ."',MantaURL='". $Manta ."', InsideviewID=". $InsideviewID." WHERE ID=".$row['ID'];
    $ret = mysql_query($sql) or die(mysql_error());
  }
  
  if ($i== 5)
  {
      $params = array(
              'ID'  => $ProjectID,
      );
      if ($_SERVER['SERVER_NAME']=="localhost")
        curl_request_async("http://localhost/ces/updatesocial.php",$params);
      else
        curl_request_async("http://firmogram.com/updatesocial.php",$params);
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