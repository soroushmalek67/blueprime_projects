<?php
  session_start();
  $ProjectID = $_GET['ID'];
//  echo $ProjectID;
  include 'dbConn2.php';
  $result = mysql_query("SELECT * FROM ProjectCompanies WHERE ProjectID=". $ProjectID);
//  echo "SELECT * FROM ProjectCompanies WHERE ProjectID=". $ProjectID;
  while($row = mysql_fetch_array($result))
  {
      $Name = str_replace("'","''",$row['Name']);
      $opts = array('http' =>
          array(
              'method'  => 'GET',
              'header'  => 'Content-type: application/x-www-form-urlencoded',
          )
      );
      $context = stream_context_create($opts);
      $res = file_get_contents("https://www.google.com/search?q=linkedin%3A".str_replace(" ","+",str_replace("&","%26",$Name)), false, $context);
      $res = strstr($res, 'www.linkedin.com/company');
      $LinkedIn = strstr($res, '&',true);
      if (($LinkedIn == "www.linkedin.com/") || ($LinkedIn == ""))
        $LinkedIn = "";
      else
      {
        $LinkedIn = "http://" . str_replace("'","''",$LinkedIn);
        $sql = "UPDATE ProjectCompanies SET LinkedInURL='". $LinkedIn ."' WHERE ID=".$row['ID'];
        $ret = mysql_query($sql) or die(mysql_error());
      }
      $res = file_get_contents("https://www.bing.com/search?q=facebook%3A".str_replace(" ","+",str_replace("&","%26",$Name)), false, $context);
      $res = strstr($res, 'www.facebook.com');
      $Facebook = strstr($res, '"',true);
      if (($Facebook == "www.facebook.com/") || ($Facebook == ""))
        $Facebook = "";
      else
      {
        $Facebook = "http://" . str_replace("'","''",$Facebook);
        $sql = "UPDATE ProjectCompanies SET FacebookURL='". $Facebook ."' WHERE ID=".$row['ID'];
        $ret = mysql_query($sql) or die(mysql_error());
      }
      $res = file_get_contents("https://www.google.com/search?q=twitter%3A".str_replace(" ","+",str_replace("&","%26",$Name)), false, $context);
      $res = strstr($res, 'twitter.com');
      $Twitter = strstr($res, '"',true);
      $Twitter = strstr($Twitter, '&',true);
      if (($Twitter == "twitter.com/") || ($Twitter == ""))
        $Twitter = "";
      else
      {
        $Twitter = "http://" . str_replace("'","''",$Twitter);
        $sql = "UPDATE ProjectCompanies SET TwitterURL='". $Twitter ."' WHERE ID=".$row['ID'];
        $ret = mysql_query($sql) or die(mysql_error());
      }
      $res = file_get_contents("https://www.google.com/search?q=manta%3A".str_replace(" ","+",str_replace("&","%26",$Name)), false, $context);
      $res = strstr($res, 'manta.com');
      $Manta = strstr($res, '"',true);
      $Manta = strstr($Manta, '&',true);
      if (($Manta == "manta.com/") || ($Manta == ""))
        $Manta = "";
      else
      {
        $Manta = "http://" . str_replace("'","''",$Manta);
        $sql = "UPDATE ProjectCompanies SET MantaURL='". $Manta ."' WHERE ID=".$row['ID'];
        $ret = mysql_query($sql) or die(mysql_error());
      }
/*
      $res = file_get_contents("https://www.bing.com/search?q=website%3A".str_replace(" ","+",str_replace("&","%26",$Name)), false, $context);
      $res = strstr($res, ' results');
      $res = strstr($res, 'www.');
      $Website = strstr($res, '"',true);
      if (($Website == "www.bing.com/") || ($Website == ""))
        $Website = "";
      else
      {
        $Website = str_replace("'","''",$Website);
        $sql = "UPDATE ProjectCompanies SET Website='". $Website ."' WHERE ID=".$row['ID'];
        $ret = mysql_query($sql) or die(mysql_error());
      }
      */
      $res = file_get_contents("https://www.google.com/search?q=insideview%3A".str_replace(" ","+",str_replace("&","%26",$Name)), false, $context);
      $res = strstr($res, 'results');
      $res = strstr($res, '/url?q=');
      $Insideview = strstr($res, '&',true);
      $Insideview = str_replace("/url?q=","",$Insideview);
      
      if (strstr($Insideview,'insideview') == "")
        $Insideview = $Insideview;
      else
      {
        $result2 = mysql_query("SELECT * FROM Insideview WHERE CompanyPath='". $Insideview ."'");
        if ($row2 = mysql_fetch_array($result2))
        {
          $sql = "UPDATE ProjectCompanies SET InsideviewID='". $row2['ID']."' WHERE ID=".$row['ID'];
          $ret = mysql_query($sql) or die(mysql_error());
        }
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
          {
            $sql = "UPDATE ProjectCompanies SET InsideviewID='". mysql_insert_id() ."' WHERE ID=".$row['ID'];
            $ret = mysql_query($sql) or die(mysql_error());
          }
        }
      }
  }
?>