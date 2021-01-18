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
  $result = mysqli_query($con,"select s.Name State,s.lat,s.lon,COUNT(*) cnt,ROUND(SUM(pc.Revenue),1) revenueTotal,ROUND(AVG(pc.Revenue),1) revenueAvg,SUM(pc.NoEmployees) sizeTotal,ROUND(AVG(pc.NoEmployees),1) sizeAvg,(select concat('<b><i>Companies:</i></b><br/>',GROUP_CONCAT(pc1.Name separator '<br/>')) from ProjectCompanies pc1 where ProjectID=$ProjectID AND pc1.State=pc.State) CompanyList from ProjectCompanies pc inner join States s On s.Name = trim(pc.State) Where ProjectID=$ProjectID group by s.Name");
  while($row = mysqli_fetch_array($result))
  {
    $array[] = array(
        "state_name" => $row['State'],
        "lat" => $row['lat'],
        "long" => (string)-$row['lon'],
        "noCompanies" => (int)$row['cnt'],
        "CompanyList" => $row['CompanyList'],
        "revenueTotal" => $row['revenueTotal'],
        "revenueAvg" => $row['revenueAvg'],
        "sizeTotal" => $row['sizeTotal'],
        "sizeAvg" => $row['sizeAvg'],
    );
  }
}

echo json_encode($array);
?>