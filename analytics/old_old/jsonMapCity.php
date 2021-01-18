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
  $result = mysqli_query($con,"SET SESSION group_concat_max_len = 1500;");
  $result = mysqli_query($con,"select IFNULL(c.Region,c.City) City,MAX(c.lat) lat,MAX(c.lon) lon,COUNT(*) cnt,(select concat('<tr>',GROUP_CONCAT(concat('<td>',pc1.Name,'</td><td>$',format(pc1.Revenue,1),' M</td><td>',format(pc1.NoEmployees,0),'</td>') ORDER BY CAST(pc1.NoEmployees AS UNSIGNED) DESC separator '</tr><tr>'),'</tr>') from ProjectCompanies pc1 inner join Cities c1 ON c1.City = trim(pc1.City) where ProjectID=$ProjectID and IFNULL(c1.Region,c1.City)=IFNULL(c.Region,c.City)) CompanyList from ProjectCompanies pc inner join Cities c On c.City = trim(pc.City) and c.State=trim(pc.State) Where ProjectID=$ProjectID group by IFNULL(c.Region,c.City) ");
  while($row = mysqli_fetch_array($result))
  {
    $array[] = array(
        "city_name" => $row['City'],
        "lat" => $row['lat'],
        "long" => (string)-$row['lon'],
        "noCompanies" => (int)$row['cnt'],
        "CompanyList" => $row['CompanyList'],
    );
  }
}

echo json_encode($array);
?>