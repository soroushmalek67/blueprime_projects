<?php
session_start();
$ProjectID = $_GET['ProjectID'];
$State = $_GET['State'];
include 'dbConn.php';
if (mysqli_connect_errno($con))
{
echo "<script>window.location = 'index.html'</script>";
exit();
}
else
{
  $result = mysqli_query($con,"select s.Name,s.lat,s.lon,COUNT(*) cnt,SUM(pc.Revenue) RevTotal,concat('$',ROUND(SUM(pc.Revenue),1),'M') revenueTotal, concat('$',ROUND(AVG(pc.Revenue),1),'M') revenueAvg,SUM(pc.NoEmployees) sizeTotal,ROUND(AVG(pc.NoEmployees),1) sizeAvg,(select concat('<b><i>Companies:</i></b><br/>',GROUP_CONCAT(pc1.Name separator '<br/>')) from ProjectCompanies pc1 where ProjectID=$ProjectID AND pc1.State=pc.State) CompanyList from ProjectCompanies pc inner join States s On (s.Name = trim(pc.State) OR s.Code = trim(pc.State)) Where ProjectID=$ProjectID AND s.Code='$State' group by s.Name");
  if (!$result) 
  {
    echo "<script>window.location = 'index.html'</script>";
    exit();
  }
  $row = mysqli_fetch_array($result);
}
?>
<table class="table table-bordered" cellpadding="5px"><tr><td class="danger"><h5><?php echo $row["cnt"]? $row["cnt"] : "No"; ?> <?php echo $row["cnt"]==1? "company" : "companies"; ?></h5></td><td class="success"><b>Total</b></td><td class="success"><b>Average</b></td></tr><tr><td class="success"><b>Revenue</b></td><td><?php echo $row["RevTotal"]>0?$row["revenueTotal"]:"N/A" ?></td><td><?php echo $row["RevTotal"]>0?$row["revenueAvg"] :"N/A" ?></td></tr><tr><td class="success"><b>Employees</b></td><td><?php echo $row["sizeTotal"]>0?$row["sizeTotal"] :"N/A" ?></td><td><?php echo $row["sizeAvg"]>0?$row["sizeAvg"] :"N/A" ?></td></tr></table><?php
  mysqli_free_result($result);
  mysqli_close($con);
?>