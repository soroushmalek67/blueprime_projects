<?php
  session_start();
  include 'dbConn2.php';
  $result = mysql_query("SELECT * FROM ProjectCompanies WHERE MantaURL IS NOT NULL LIMIT 1");
  while($row = mysql_fetch_array($result))
  {
      $opts = array('http' =>
          array(
              'method'  => 'POST',
              'header'  => 'Content-type: application/x-www-form-urlencoded',
              'user_agent'    => 'spider',    // who am i
//              'user_agent'=>    $_SERVER['HTTP_USER_AGENT'] ,
          )
      );
      $context = stream_context_create($opts);
      $res = file_get_contents($row['MantaURL'], false, $context);
//      $res = strstr($res, 'og:title');
//      $res = strstr($res, 'content="');
//      $Name = strstr($res, '">',true);
//      $Name = str_replace('content="','',$Name);
      echo $res. "</br>";
      /*
      $res = strstr($res, 'og:description');
      $res = strstr($res, 'content="');
      $Desc = strstr($res, '">',true);
      $Desc = str_replace('content="','',$Desc);
      $res = strstr($res, 'streetAddress">');
      $Street = strstr($res, '</span>',true);
      $Street = str_replace('streetAddress">','',$Street);
//      $res = strstr($res, 'addressLocality">');
 //     $City = strstr($res, '</span>',true);
 //     $City = str_replace('addressLocality">','',$City);
 */
//      echo $res. "</br>";
   }
?>