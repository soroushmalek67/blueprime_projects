<?php
  //session_start();
  //include 'dbConn2.php';
  //$result = mysql_query("SELECT * FROM Insideview WHERE WebsiteTitle IS NULL AND CompanyWebsite<>'' LIMIT 10");
  echo "SELECT * FROM Insideview WHERE WebsiteTitle IS NULL AND CompanyWebsite<>'' LIMIT 10";
  /*
  while($row = mysql_fetch_array($result))
  {
      $opts = array('http' =>
          array(
              'method'  => 'GET',
              'header'  => 'Content-type: application/x-www-form-urlencoded',
          )
      );
      $context = stream_context_create($opts);
      $res = file_get_contents("http://".$row['CompanyWebsite'], false, $context);
      $res = strstr($res, '<title>');
      $Title = strstr($res, '</title>',true);
      $Title = str_replace("<title>","",$Title);
      $Title = str_replace("'","''",$Title);
      $sql = "UPDATE Insideview SET WebsiteTitle='". $Title ."' WHERE ID=".$row['ID'];
//      echo $sql;
      $ret = mysql_query($sql) or die(mysql_error());
   }
   */
?>