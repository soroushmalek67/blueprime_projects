<?php
session_start();
$ProjectID = $_SESSION['ProjectID'];
$Max = 15;
include 'dbConn.php';
// Check connection
if (mysqli_connect_errno($con))
{
  echo "<script>window.location = 'index.html'</script>";
  exit();
}
else
{
  echo '{"episodes":[';
  $result = mysqli_query($con,"select case when (select count(distinct SUBSTRING(NAICSCode,1,6)) from ProjectCompanies Where ProjectID=$ProjectID)<=$Max then 6 when (select count(distinct SUBSTRING(NAICSCode,1,5)) from ProjectCompanies Where ProjectID=$ProjectID)<=$Max then 5 when (select count(distinct SUBSTRING(NAICSCode,1,4)) from ProjectCompanies Where ProjectID=$ProjectID)<=$Max then 4 when (select count(distinct SUBSTRING(NAICSCode,1,3)) from ProjectCompanies Where ProjectID=$ProjectID)<=$Max then 3 when (select count(distinct SUBSTRING(NAICSCode,1,2)) from ProjectCompanies Where ProjectID=$ProjectID)<=$Max then 2 else 0 end As Level");
  $row = mysqli_fetch_array($result);
  $level = $row['Level'];
  $result = mysqli_query($con,"select distinct NAICS,SUBSTRING(NAICSCode,1,$level) NAICSCode from (select pc.*,IFNULL(n.Name,'') NAICS from ProjectCompanies pc left outer join NAICS n on n.Code = SUBSTRING(NAICSCode,1,$level) Where ProjectID=$ProjectID  and State<>'' ORDER BY Revenue DESC limit 50) t");
  if (!$result)
  {
    echo "<script>window.location = 'index.html'</script>";
    exit();
  }
  $i = 0;
  while ($row = mysqli_fetch_array($result))
  {
    $i = $i + 1;
    echo '{"type":"episode","name":"' . $row["NAICS"] . '","description":"' . $row["NAICS"] . '","episode":' . $i .',"date":"2012-05-05 23:50:11","slug":""';
    echo ',"links":[';
    $result1 = mysqli_query($con,"select IF(length(pc.Name)>25,concat(SUBSTRING(pc.Name,1,25),'...'),pc.Name) Name from ProjectCompanies pc Where ProjectID=$ProjectID AND SUBSTRING(NAICSCode,1,$level) =". $row["NAICSCode"]);
    if (!$result1)
    {
      echo "<script>window.location = 'index.html'</script>";
      exit();
    }
    $j = 0;
    while ($row1 = mysqli_fetch_array($result1))
    {
              $j = $j + 1;
              echo '"' . $row1["Name"] . '"';
              if ($j<mysqli_num_rows($result1))
                echo ",";
    }
    mysqli_free_result($result1);
    echo ']';
    if ($i<mysqli_num_rows($result))
      echo "},";
    else
      echo "}";
  }
  mysqli_free_result($result);
  echo '],"themes":[';
//  $result = mysqli_query($con,"select pc.ID,pc.Name,concat(REPLACE(SUBSTRING(Description,1,100),'\n',', '),'...') Title from ProjectCompanies pc Where ProjectID=$ProjectID order by Name");
  $result = mysqli_query($con,"select pc.ID,IF(length(pc.Name)>25,concat(SUBSTRING(pc.Name,1,25),'...'),pc.Name) Name20, pc.Name,pc.Website,pc.FacebookURL,pc.TwitterURL,pc.LinkedInURL,OtherURL,REPLACE(REPLACE(SUBSTRING(Description,1,400),'\n','<br/>'),'\"','') Title from ProjectCompanies pc Where ProjectID=$ProjectID order by Name");
  if (!$result)
  {
    echo "<script>window.location = 'index.html'</script>";
    exit();
  }
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
    if ($i==54)
      echo '],"perspectives":[';
    if ($i<54)
 //     echo '{"type":"theme","name":"' . $row["Name"] . '","description":"<a href=index.htm>Facebook </a> ' . $row["Title"] . '","slug":"comp.php?ID=' . $row["ID"] . '"';
      echo '{"type":"theme","name":"' . $row["Name20"] . '","description":"' . $social . '<br/> ' . $row["Title"] . '","slug":"comp.php?ID=' . $row["ID"] . '"';
    else
      echo '{"type":"perspective","name":"' . $row["Name20"] . '","description":"' . $social . '<br/> ' . $row["Title"] . '","slug":"comp.php?ID=' . $row["ID"] . '","count":"10","group":"1"';
//      echo '{"type":"perspective","name":"' . $row["Name"] . '","description":"<a target="_blank" href="' . $row["FacebookURL"] . '"><img width="40px" src="img/facebook32.png" /></a> ' . $row["Title"] . '","slug":"comp.php?ID=' . $row["ID"] . '","count":"10","group":"1"';
    if ($i<mysqli_num_rows($result) && $i != 53)
      echo "},";
    else
      echo "}";
  }
  mysqli_free_result($result);
  if ($i<54)
        echo '],"perspectives":[';
  echo ']}';
  mysqli_close($con);
}

?>
