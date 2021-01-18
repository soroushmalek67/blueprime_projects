<?php
    session_start();
    $ProjectID = $_SESSION['ProjectID'];
    include 'dbConn.php';
    // Check connection
    if (mysqli_connect_errno($con))
    {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    else
    {
      echo '{"name": "All"';
      echo ',"children": [';
      $result = mysqli_query($con,"SELECT n.Code,n.Name,COUNT(*) cnt FROM (SELECT * FROM ProjectCompanies WHERE ProjectID=". $ProjectID . ") pc INNER JOIN NAICS n on SUBSTRING(pc.NAICSCode,1,3) = n.Code GROUP BY n.Code,n.Name");
//      $row = mysqli_fetch_array($result);
      $j=0;
      while($row = mysqli_fetch_array($result))
      {
        $j=$j+1;
        echo '{"name": " '. $row['Name'] .' (' . $row['cnt'] . ') "' ;
        echo ',"children": [';
        $result2 = mysqli_query($con,"SELECT n.Code,n.Name,COUNT(*) cnt FROM (SELECT * FROM ProjectCompanies WHERE ProjectID=". $ProjectID . ") pc INNER JOIN NAICS n on SUBSTRING(pc.NAICSCode,1,4) = n.Code AND SUBSTRING(pc.NAICSCode,1,3) = " . $row['Code'] . " GROUP BY n.Code,n.Name");
        $k=0;
        while($row2 = mysqli_fetch_array($result2))
        {
          $k=$k+1;
          echo '{"name": " '. $row2['Name'] .' (' . $row2['cnt'] . ') "' ;
//            echo ',"size": '. $row2['cnt'];
//            echo ',"value": '. $row2['cnt'];
          echo ',"children": [';
          $result3 = mysqli_query($con,"SELECT Name,TwitterURL url FROM ProjectCompanies WHERE ProjectID=". $ProjectID . " AND SUBSTRING(NAICSCode,1,4) = " . $row2['Code'] . " ");
          $l=0;
          while($row3 = mysqli_fetch_array($result3))
          {
            $l=$l+1;
            $url = str_replace(' ','-',$row3['Name']);
            $url = str_replace('(','-',$url);
            $url = str_replace(')','-',$url);
            $url = strtolower($url);
            echo '{"name": " '. $row3['Name'] .'"' ;
            echo ',"value": 1';
            echo ',"size": 1';
            echo ',"url": "concept24.php#'. $url . '"';
            if ($l<mysqli_num_rows($result3))
               echo "},";
            else
               echo "}";
          }
          echo "]";
          if ($k<mysqli_num_rows($result2))
             echo "},";
          else
             echo "}";
        }
        echo "]";
        if ($j<mysqli_num_rows($result))
    	     echo "},";
        else
    	     echo "}";
      }
      echo "]";
      echo "}";
      mysqli_close($con);
    }
?>