<?Php
    session_start();
set_time_limit ( 60 ) ;
include 'dbConn.php';
$result = mysqli_query($con,"select 5+ROUND((select count(*) from ProjectCompanies where ProjectID=". $_SESSION['ProjectID'] ." and FacebookURL IS NOT NULL)*95/(select count(*) from ProjectCompanies where ProjectID=". $_SESSION['ProjectID'] ."),0) AS Progress");
if ($result)
{
  $row2 = mysqli_fetch_array($result);
  $Progress = $row2['Progress'];
}
else
  $Progress=0;
echo $Progress;
?>