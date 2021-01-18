<?php
session_start();
$array = array();

include 'dbConn.php';
// Check connection
if (mysqli_connect_errno($con))
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
else
{
  $ProjectID = $_SESSION['ProjectID'];
  include 'dbConn2.php';
  $result = mysqli_query($con,"select IFNULL(c.Region,c.City) City,MAX(c.lat) lat,MAX(c.lon) lon,COUNT(*) cnt from ProjectCompanies pc inner join Cities c On c.City = pc.City and c.State=trim(pc.State) Where ProjectID=$ProjectID group by IFNULL(c.Region,c.City) ");
  while($row = mysqli_fetch_array($result))
  {
    $array[] = array(
        "city_name" => $row['City'],
        "lat" => $row['lat'],
        "long" => (string)-$row['lon'],
        "noCompanies" => (int)$row['cnt'],
    );
  }
}

echo json_encode($array);
?>