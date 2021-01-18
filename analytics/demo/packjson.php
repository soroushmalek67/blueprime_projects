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
      echo '{"name": ""';
      echo ',"children": [';
      $result = mysqli_query($con,"SELECT n.Code,n.Name,COUNT(*) cnt FROM ProjectCompanies pc INNER JOIN NAICS n on SUBSTRING(pc.NAICSCode,1,2) = n.Code WHERE ProjectID=". $ProjectID . " GROUP BY n.Code,n.Name");
      $row = mysqli_fetch_array($result);
      $j=1;
      while($row = mysqli_fetch_array($result))
      {
        $j=$j+1;
        echo '{"name": " '. $row['Name'] .' "' ;
//        echo ',"size": '. $row['cnt'];
        echo ',"children": [';
          $result2 = mysqli_query($con,"SELECT n.Code,n.Name,COUNT(*) cnt FROM ProjectCompanies pc INNER JOIN NAICS n on SUBSTRING(pc.NAICSCode,1,3) = n.Code WHERE ProjectID=". $ProjectID . " AND SUBSTRING(pc.NAICSCode,1,2) = " . $row['Code'] . " GROUP BY n.Code,n.Name");
          $row = mysqli_fetch_array($result2);
          $k=1;
          while($row2 = mysqli_fetch_array($result2))
          {
            $k=$k+1;
            echo '{"name": " '. $row2['Name'] .' (' . $row2['cnt'] . ') "' ;
            echo ',"size": '. $row2['cnt'];
            if ($k<mysqli_num_rows($result2))
               echo "},";
            else
               echo "}";
          }
          echo "]";
//          echo "}";
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