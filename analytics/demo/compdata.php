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
  echo '{"episodes":[';
  $result = mysqli_query($con,"select * from (select REPLACE(REPLACE(SUBSTRING(Description,1,400),'\n','<br/>'),'\"','') Title,IF(length(pc.Name)>25,concat(SUBSTRING(pc.Name,1,25),'...'),pc.Name) Name20,pc.* from ProjectCompanies pc Where ProjectID=$ProjectID  and State<>'' ORDER BY convert(NoEmployees,unsigned) DESC limit 110) t ORDER BY Name");
  $i = 0;
  while ($row = mysqli_fetch_array($result))
  {
  	$i = $i + 1;
      $social = '<a target=_blank href=http://' . $row["Website"] . '>' . $row["Name"] . '</a><br/>';
       if (($row['FacebookURL']!="") && (strtoupper($row['FacebookURL'])!="NO"))
        $social = $social . '<a target=_blank href=' . $row["FacebookURL"] . '><img width=40px src=img/facebook32.png /></a>';
      if (($row['TwitterURL']!="") && (strtoupper($row['TwitterURL'])!="NO"))
        $social = $social . '<a target=_blank href=' . $row["TwitterURL"] . '><img width=40px src=img/twitter32.png /></a>';
      if (($row['LinkedInURL']!="") && (strtoupper($row['LinkedInURL'])!="NO"))
        $social = $social . '<a target=_blank href=' . $row["LinkedInURL"] . '><img width=40px src=img/linkedin32.png /></a>';
      if (($row['OtherURL']!="") && (strtoupper($row['OtherURL'])!="NO"))
        $social = $social . '<a target=_blank href=' . $row["OtherURL"] . '><img width=40px src=img/ic64.png /></a>';
  	echo '{"type":"episode","name":"' . $row["Name20"] . '","description":"' . $social . '<br/> ' . $row["Title"] . '","episode":' . $i .',"date":"2012-05-05 23:50:11","slug":"comp.php?ID=' . $row["ID"] . '"';
  	echo ',"links":["' . $row["State"] . '"';
	  $result1 = mysqli_query($con,"select Title from CompanyCapabilities cc inner join ProjectCapabilities pc on pc.ID = cc.CapabilityID Where ProjectID=$ProjectID AND CompanyID=". $row["ID"]);
	  $j = 0;
	  while ($row1 = mysqli_fetch_array($result1))
	  {
	            if ($j == 0)
	          	  echo ",";
	  	$j = $j + 1;
	  	echo '"' . $row1["Title"] . '"';
	            if ($j<mysqli_num_rows($result1))
	          	  echo ",";
	  }
	echo ']';
            if ($i<mysqli_num_rows($result))
          	  echo "},";
            else
          	  echo "}";
  }
  echo '],"themes":[';
  $result = mysqli_query($con,"select * from ProjectCapabilities pc Where ProjectID=$ProjectID");
  $i = 0;
  while ($row = mysqli_fetch_array($result))
  {
  	$i = $i + 1;
  	echo '{"type":"theme","name":"' . $row["Title"] . '","description":"' . $row["Title"] . '","slug":""';
            if ($i<mysqli_num_rows($result))
          	  echo "},";
            else
          	  echo "}";
  }
  echo '],"perspectives":[';
  $result = mysqli_query($con,"select distinct State from ProjectCompanies pc Where ProjectID=$ProjectID and State<>'' LIMIT 20");
  $i = 0;
  while ($row = mysqli_fetch_array($result))
  {
  	$i = $i + 1;
  	echo '{"type":"perspective","name":"' . $row["State"] . '","description":"' . $row["State"] . '","slug":"","count":"10","group":"1"';
            if ($i<mysqli_num_rows($result))
          	  echo "},";
            else
          	  echo "}";
  }
  echo ']}';
}

?>
