<?php
    session_start();
    if (!isset($_SESSION['ProjectID']))
      header("Location: projects.php");
    if ($_SESSION['ProjectType'] =='1') 
      header("Location: list2.php");
    else if ($_SESSION['ProjectType'] =='2') 
      header("Location: list.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Firmogram - Data Table</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets3/css/bootstrap.css" rel="stylesheet">
    <link href="../assets3/css/bootstrap-glyphicons.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 20px;
        padding-bottom: 60px;
      }

      /* Custom container */
      .container {
        margin: 0 auto;
        max-width: 1000px;
      }
      .container > hr {
        margin: 60px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 80px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 100px;
        line-height: 1;
      }
      .jumbotron .lead {
        font-size: 24px;
        line-height: 1.25;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }


      /* Customize the navbar links to be fill the entire space of the .navbar */
      .navbar2 .navbar-inner {
        padding: 0;
      }
      .navbar2 .nav {
        margin: 0;
        display: table;
        width: 100%;
      }
      .navbar2 .nav li {
        display: table-cell;
        width: 1%;
        float: none;
      }
      .navbar2 .nav li a {
        font-weight: bold;
        text-align: center;
        border-left: 1px solid rgba(255,255,255,.75);
        border-right: 1px solid rgba(0,0,0,.1);
      }
      .navbar2 .nav li:first-child a {
        border-left: 0;
        border-radius: 3px 0 0 3px;
      }
      .navbar2 .nav li:last-child a {
        border-right: 0;
      }
    </style>
    <link href="../assets3/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets3/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets3/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets3/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="../assets3/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="../assets3/ico/favicon.png">

     <script src="../assets3/js/jquery.js"></script>
	<script src="../assets3/js/bootstrap.min.js"/>
      <script type="text/javascript">
          $('.alert .close').live("click", function(e) {
              $(this).parent().hide();
          });
      </script>
  <script>
    function showTweets(str)
    {
      document.getElementById("ifTweets").src = "http://www.blueprime.ca/getTweets.php?name="+str;
      /*
      document.getElementById("divTweets").innerHTML="Obtaining recent tweets...";
    if (str=="")
      {
      document.getElementById("divTweets").innerHTML="";
      return;
      } 
    if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
        document.getElementById("divTweets").innerHTML=xmlhttp.responseText;
        }
      }
    xmlhttp.open("GET","getTweets.php?name="+str,true);
    xmlhttp.send();
    */
    }

    function showState(str)
    {
    if (str=="")
      {
      document.getElementById("divState").innerHTML="";
      return;
      } 
    if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
        document.getElementById("divState").innerHTML=xmlhttp.responseText;
        }
      }
    xmlhttp.open("GET","getProjectStates.php?q="+str+"&p="+<?php echo $_SESSION['ProjectID']; ?>,true);
    xmlhttp.send();
    }
    function showSubIndustry(str)
    {
    if (str=="")
      {
      document.getElementById("divSubIndustry").innerHTML="";
      return;
      } 
    if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp1=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
      xmlhttp1=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp1.onreadystatechange=function()
      {
      if (xmlhttp1.readyState==4 && xmlhttp1.status==200)
        {
        document.getElementById("divSubIndustry").innerHTML=xmlhttp1.responseText;
        }
      }
    xmlhttp1.open("GET","getProjectSubIndustries.php?q="+str.replace("&","@@@")+"&p="+<?php echo $_SESSION['ProjectID']; ?>,true);
    xmlhttp1.send();
    }
  </script>
  <script type="text/javascript">
    function ajaxFunction()
    {
    var httpxml;
    try
      {
        httpxml=new XMLHttpRequest();
      }
    catch (e)
      {
      try
        {
        httpxml=new ActiveXObject("Msxml2.XMLHTTP");
        }
        catch (e)
        {
        try
          {
          httpxml=new ActiveXObject("Microsoft.XMLHTTP");
          }
        catch (e)
          {
          alert("Your browser does not support AJAX!");
          return false;
          }
        }
      }
      function stateChanged() 
      {
        if(httpxml.readyState==4)
          {
            var progress =httpxml.responseText;
 //           document.getElementById("pbar").value= progress;
            document.getElementById("pbar").style.width=progress.concat('%');
            document.getElementById("pbar").innerHTML= progress.concat('%');
          }
        }
        var url="progress-bar.php";
        httpxml.onreadystatechange=stateChanged;
        httpxml.open("POST", url, true)
        httpxml.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
        httpxml.send()  
      }
      function timer(){
//        alert("*");
        ajaxFunction();
        setTimeout('timer()',2000);
      }
  </script>
</head>

  <body onLoad=timer();>

  <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="projects.php"><span class="glyphicon glyphicon-list"></span> Projects</a>
        </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li>
          <?php 
           if ($_SESSION["ReadOnly"]=="NO") 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<a href="import.php"><span class="glyphicon glyphicon-import"></span> Build</a>';
            else if ($_SESSION['ProjectType'] =='3') 
                echo '<a href="importnew.php"><span class="glyphicon glyphicon-import"></span> Build</a>';
            else 
                echo '<a href="build.php"><span class="glyphicon glyphicon-check"></span> Build</a>';
          ?>
        </li>
        <li class="active">
          <a href="list3.php"><span class="glyphicon glyphicon-th"></span> Data </a>
        </li>
        <li>
           <a href="view.php"><span class="glyphicon glyphicon-globe"></span> Map </a>
        </li>
          <?php 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<li><a href="concept4.php"><span class="glyphicon glyphicon-dashboard"></span> Eco-system </a></li>';
            else if ($_SESSION['ProjectType'] =='3') 
                echo '<li><a href="concept24.php"><span class="glyphicon glyphicon-dashboard"></span> Eco-system </a></li>';
            else 
                echo '<li><a href="concept10.php"><span class="glyphicon glyphicon-dashboard"></span> Eco-system </a></li>';
          ?>
        <li>
          <?php 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<a href="analytics2.php"><span class="glyphicon glyphicon-stats"></span> Analytics</a>';
            else 
                echo '<a href="analytics.php"><span class="glyphicon glyphicon-stats"></span> Analytics</a>';
          ?>
        </li>
        <li><a href="export.php"><span class="glyphicon glyphicon-export"></span> Export </a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
            <?php 
              if ($_SESSION['ViewerCount'] !== "") 
                  echo '<li><a href="viewers.php"><span class="glyphicon glyphicon-user"></span> Viewers</a></li>';
            ?>
        <li>
          <a href="signout.php"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a>
        </li>
      </ul>
    </nav>
    </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div style="clear:both"></div>
    <div class="container">
      <br/> 
      <div class="masthead">
      <!-- Jumbotron -->
        <?php
            include 'dbConn.php';
            if (mysqli_connect_errno()) 
            {
              echo "<script>window.location = 'index.html'</script>";
              exit();
            }
            $result = mysqli_query($con,"SELECT Name,(SELECT COUNT(*) FROM ProjectCompanies WHERE ProjectID=". $_SESSION['ProjectID'] .") CompanyCount FROM UserProjects Where ID=". $_SESSION['ProjectID']);
            if (!$result)
            {
              echo "<script>window.location = 'index.html'</script>";
              exit();
            }
            $row = mysqli_fetch_array($result);
            $result = mysqli_query($con,"select 5+ROUND((select count(*) from ProjectCompanies where ProjectID=". $_SESSION['ProjectID'] ." and FacebookURL IS NOT NULL)*95/(select count(*) from ProjectCompanies where ProjectID=". $_SESSION['ProjectID'] ."),0) AS Progress");
            if ($result)
            {
              $row2 = mysqli_fetch_array($result);
              $Progress = $row2['Progress'];
            }
        ?>
        <br/><br/>
        <div class="alert alert-success alert-dismissible" role="alert" style="height:120px;" id="enrich">
          <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            Enrichment Progress: 
          <div class="progress" style="margin-right:30px;">
            <div class="progress-bar" id="pbar" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $Progress; ?>%;">
              <?php echo $Progress; ?>%
            </div>
          </div>       
          <div style="width:100px;margin-left: auto;margin-right: auto;">
            <a href="list3.php" role="button" class="btn btn-success btn-sm">Refresh List</a>     
          </div>  
       </div>        
        <?php
             if ($Progress == 100)
                echo '<script type="text/javascript">document.getElementById("enrich").style.display="none";</script>';
        ?>
         <ul class="nav nav-stacked nav-pills" >
          <li class="active">
            <a style="background-color:#08A17D">
              <span class="badge pull-right"><h5><?php echo $row[CompanyCount]; ?> Companies</h5></span>
              <h4><?php echo $row[Name]; ?></h4>
            </a>
          </li>
        </ul>      
        <br/> 
      <div style="clear:both"></div>
      <div class="jumbotron1">
        <div class="bs-docs-example">
            <form class="form-horizontal" role="form" action="list3Actions.php" method="post">
              <div class="panel panel-success">
                <div class="panel-heading">
                <?php
                // Create connection
                $ProjectID = $_SESSION['ProjectID'];
                include 'dbConn.php';
                // Check connection
                if (mysqli_connect_errno($con))
                {
                  echo "<script>window.location = 'index.html'</script>";
                }
                else
                {
                  echo "<div class='form-group'> \n";
                  echo "<div class='col-lg-2 control-label'>Country: </div>\n";
                  echo "<div class='col-lg-4'>\n";
                  echo "<select class='form-control' name='SelProjectCountry' onchange='showState(this.value)'>\n";
                  $result = mysqli_query($con,"SELECT DISTINCT Country FROM ProjectCompanies WHERE ProjectID=$ProjectID and Country<>'' ORDER BY Country ");
                  if (!$result)
                      echo "<script>window.location = 'index.html'</script>";
                  echo "<option value=''><-- All Countries --></option>\n";
                  while($row = mysqli_fetch_array($result))
                  {
                   if ($_SESSION['SelProjectCountry']==$row['Country'])
                    echo "<option selected value='" . $row['Country'] . "'>" . $row['Country'] . "</option>\n";
                   else
                    echo "<option value='" . $row['Country'] . "'>" . $row['Country'] . "</option>\n";
                  }
                  echo "</select>\n";
                  echo "</div>\n";
                  echo "<div id='divState' class='col-lg-4'></div>";
                  echo "</div>\n";
                  echo "<div class='form-group'> \n";
                  echo "<div class='col-lg-2 control-label'>Industry: </div>\n";
                  echo "<div class='col-lg-4'>\n";
                  echo "<select class='form-control' name='SelProjectIndustry' onchange='showSubIndustry(this.value)'>\n";
                  $result = mysqli_query($con,"SELECT DISTINCT Industry FROM ProjectCompanies WHERE ProjectID=$ProjectID and Industry<>'' ORDER BY Industry");
                  if (!$result)
                      echo "<script>window.location = 'index.html'</script>";
                  echo "<option value=''><-- All Industries --></option>\n";
                  while($row = mysqli_fetch_array($result))
                  {
                     if ($_SESSION['SelProjectIndustry']==$row['Industry'])
                        echo "<option selected value='" . $row['Industry'] . "'>" . $row['Industry'] . "</option>\n";
                     else
                        echo "<option value='" . $row['Industry'] . "'>" . $row['Industry'] . "</option>\n";
                  }
                  echo "</select>\n";
                  echo "</div>\n";
                  echo "<div id='divSubIndustry' class='col-lg-4'></div>";
                  echo "</div>\n";
                  echo "<div class='form-group'> \n";
                  echo "<div class='col-lg-2 control-label'></div>\n";
                  echo "<div class='col-lg-4'>\n";
                  echo "<input name='Keyword' type='text' class='form-control' placeholder='Keyword' value='" . $_SESSION['ProjectKeyword']. "'>";
                  echo "</div>\n";
                  echo "</div>\n";
			echo "<div class='form-group'> \n";
                  echo "<div class='col-lg-offset-2 col-lg-4'>\n";
                  echo "<button name='btnSearch' class='btn btn-block btn-primary' type='submit'>Search</button>\n";
                  echo "</div>\n";
                  echo "</div>\n";
                ?>
                </div>
                <div class="panel-body">
                <?php
                  if (isset($_SESSION['SelProjectCountry']))
                    $SelProjectCountry = $_SESSION['SelProjectCountry'];
                  else
                    $SelProjectCountry = "";
                  if (isset($_SESSION['SelProjectState']))
                    $SelProjectState = $_SESSION['SelProjectState'];
                  else
                    $SelProjectState = "";
                  if (isset($_SESSION['SelProjectIndustry']))
                    $SelProjectIndustry = $_SESSION['SelProjectIndustry'];
                  else
                    $SelProjectIndustry = "";
                  if (isset($_SESSION['SelProjectSubIndustry']))
                    $SelProjectSubIndustry = $_SESSION['SelProjectSubIndustry'];
                  else
                    $SelProjectSubIndustry = "";
                  $Keyword = $_SESSION['ProjectKeyword'];
                  $result = mysqli_query($con,"SELECT COUNT(*) cnt FROM ProjectCompanies Where ProjectID=$ProjectID and (Country='". $SelProjectCountry . "' OR '". $SelProjectCountry . "' = '') AND (State='". $SelProjectState . "' OR '". $SelProjectState . "' = '') AND (SubIndustry='". $SelProjectSubIndustry . "' OR '". $SelProjectSubIndustry . "' = '') AND (Industry='". $SelProjectIndustry . "' OR '". $SelProjectIndustry . "' = '') AND (Name like '%". $Keyword . "%' OR '". $Keyword . "' = '')");
                  if (!$result)
                      echo "<script>window.location = 'index.html'</script>";
                  $row = mysqli_fetch_array($result);
                  $pageCount = 50;
                  $total = $row["cnt"];
                  if ($_GET["page"])
                    $page=$_GET["page"];
                  else
                    $page=1;
                  echo "<ul class='pager  pagination-right'>";
                  $pageP1 = $page+1;
                  $pageN1 = $page-1;
                  $start = ($page-1)*$pageCount+1;
                  $end = $page*$pageCount;
                  if ($end>$total)
                    $end = $total;
                  if ($page>1) 
                    echo "<li class='previous'><a href='list3.php?page=$pageN1'>Previous $pageCount</a></li>";
                  else
                    echo "<li class='previous disabled'><a href='#'>Previous $pageCount</a></li>";
                  echo "<li>Page $page ($start - $end of $total)</li>";
                  if ($page*$pageCount<$total)
                    echo "<li class='next'><a href='list3.php?page=$pageP1'>Next $pageCount</a></li>";
                  else
                    echo "<li class='next disabled'><a href='#'>Next $pageCount</a></li>";
                  echo "</ul>";            
                  mysqli_close($con);
                }
              ?>
            <input type="hidden" name="pageno" value=<?php echo $page ?>>
            <div class="row">
              <div class="col-xs-12 col-md-10">
                &nbsp;&nbsp;&nbsp;&nbsp;<span class="label label-default">Select:</span>
                <button type="button" class="btn btn-link" onclick="selectAll();">All</button>
                <button type="button" class="btn btn-link" onclick="selectNone();">None</button>
                <button type="button" class="btn btn-link" onclick="toggleAll();">Toggle</button>
                <?php if ($total>0) { ?>
                  <button type="submit" class="btn btn-primary" name="btnDelSelected">Delete Selected</button>
                  <button type="submit" class="btn btn-primary" name="btnDelThese">Delete <?php if ($total-$pageCount*($page-1)==1) echo "This"; else echo "These"; ?> <?php if ($total<$pageCount*$page) echo $total-$pageCount*($page-1); else echo $pageCount; ?></button>
                  <button type="submit" class="btn btn-primary" name="btnDelAllSearched">Delete All <?php echo $total ?></button>
                  <button type="submit" class="btn btn-primary" name="btnDelAll">Empty Project</button>
                <?php }?>
              </div>
              <div class="col-xs-6 col-md-2">
                <?php if ($total>0) { ?>
                  <button type="submit" class="btn btn-success" name="btnExpAll">Export Data</button>
                <?php }?>
              </div>
            </div>         
            </br>     
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr style="background:#373;color:white">
                  <th></th>
                  <th>Industry</th>
                  <th>NAICS</th>
                  <th>Name</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Zip</th>
                  <th>Country</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php
                // Create connection
                include 'dbConn.php';
                // Check connection
                if (mysqli_connect_errno($con))
                {
                  echo "<script>window.location = 'index.html'</script>";
                }
                else
                {
                  $start = ($page-1)*$pageCount;
                  $result = mysqli_query($con,"SET SESSION group_concat_max_len = 1000000;");
                  $result = mysqli_query($con,"SELECT pc.*,Concat(IFNULL((SELECT Name FROM NAICS WHERE Code=pc.NAICSCode),''),' (',NAICSCode,')') NAICSName ,(select concat('<b><i>Capabilities:</i></b><br/>',GROUP_CONCAT(concat('<b>',pc1.Title,':</b> ',cc.Details) separator '<br/>')) from CompanyCapabilities cc INNER JOIN ProjectCapabilities pc1 ON pc1.ID = cc.CapabilityID where CompanyID=pc.ID) CompanyCapabilities,i.CompanyPath,i.CompanyWebsite,i.CompanyName,i.SubIndustry,i.CompanySIC,i.CompanySICNo,i.CompanyNAICS,i.CompanyNAICSNo,i.CompanyPhone,i.CompanyDescription,i.CompanyStreet,i.CompanyCity,i.CompanyState,i.CompanyZip,i.CompanyCountry,i.LinkedInID,l.Name LName,l.LogoURL LLogoURL,l.Street1 LAddress,l.City LCity,l.Zip LZip,l.FoundedYear LFoundedYear,l.Industries LIndustries, l.Specialties LSpecialties,l.CompanyType LCompanyType,l.EmployeeCountRange LEmployeeCountRange,l.website LWebsite,replace(l.Description,'''','') LDescription,l.LinkedInID LinkedInID FROM ProjectCompanies pc LEFT JOIN Insideview i ON i.ID=pc.InsideviewID LEFT JOIN LinkedIn l ON l.LinkedInID = i.LinkedInID Where ProjectID=$ProjectID and (pc.Country='". $SelProjectCountry . "' OR '". $SelProjectCountry . "' = '') AND (pc.State='". $SelProjectState . "' OR '". $SelProjectState . "' = '') AND (pc.SubIndustry='". $SelProjectSubIndustry . "' OR '". $SelProjectSubIndustry . "' = '') AND (pc.Industry='". $SelProjectIndustry . "' OR '". $SelProjectIndustry . "' = '') AND (pc.Name like '%". $Keyword . "%' OR '". $Keyword . "' = '')  LIMIT $start,$pageCount");
                  if (!$result)
                      echo "<script>window.location = 'index.html'</script>";
                  while($row = mysqli_fetch_array($result))
                  {
                    echo "<tr>";
                    echo "<td><input type='Checkbox' id='cbCompany" . $i . "' name='cbCompany[]' value='" . $row['ID'] . "'></td>";
                    echo "<input type='hidden' name='hdCompany[]' value='" . $row['ID'] . "'>";
                    echo "<td>" . $row['Industry'] . " - " . $row['SubIndustry'] . "</td>";
                    if ($_SESSION['ProjectType'] =='1') 
                      echo "<td><a href=comp.php?ID=" . $row['ID'] . ">" . $row['NAICSName'] . "</a></td>";
                    else
                      echo "<td>" . $row['NAICSName'] . "</td>";
                    echo "<td><a href='#myModal' data-capabilities='" . $row['CompanyCapabilities'] . "' data-contactname='" . $row['ContactName'] . "' data-contacttitle='" . $row['ContactTitle'] . "' data-contactemail='" . $row['ContactEmail'] . "' data-facebook='" . $row['FacebookURL'] . "' data-twitter='" . $row['TwitterURL'] . "' data-linkedin='" . str_replace("'","%27",$row['LinkedInURL']) . "' data-website='http://" . $row['Website'] . "' data-name='" . $row['Name'] . "' data-industry='" . $row['Sector'] . "' data-phone='" . $row['Phone'] . "' data-description='" . str_replace(">", "&gt", $row['Description']) . "' data-address='" . $row['Address'] . ", " . $row['City'] . ", " . $row['State'] . ", " . $row['PostalCode'] . ", " . $row['Country'] . "' role='button' data-toggle='modal' class='open-MyModal'>" . $row['Name'] . "</a></td>";
                    echo "<td>" . $row['City'] . "</td>";
                    echo "<td>" . $row['State'] . "</td>";
                    echo "<td>" . $row['PostalCode'] . "</td>";
                    echo "<td>" . $row['Country'] . "</td>";
                    echo "<td width='80px'>";
                    if (($row['FacebookURL']!="") && ($row['FacebookURL']!="No"))
                      echo "<a target='_blank' href='" . $row['FacebookURL'] . "'><img width='20px' src='img/facebook32.png' /></a>";
                    if (($row['TwitterURL']!="") && ($row['TwitterURL']!="No"))
                      echo "<a target='_blank' href='" . $row['TwitterURL'] . "'><img width='20px' src='img/twitter32.png' /></a>";
                    if (($row['LinkedInURL']!="") && ($row['LinkedInURL']!="No"))
                      echo "<a target='_blank' href='" . str_replace("'","%27",$row['LinkedInURL']) . "'><img width='20px' src='img/linkedin32.png' /></a>";
                    echo "</td>";
                    echo "<td width='80px'>";
                    if (($row['MantaURL']!="") && ($row['MantaURL']!="No"))
                      echo "<a target='_blank' href='" . $row['MantaURL'] . "'><img width='20px' src='img/manta32.png' /></a>";
                    if ($row['InsideviewID']>0)
                      echo " <a target='_blank' href='" . $row['CompanyPath'] . "'><img width='20px' src='img/inside32.png' /></a>";
                    echo "</td>";
                    if ($row['LinkedInID']!="")
                      echo "<td><a href='#myModalLinkedIn' data-linkedinurl='http://www.linkedin.com/company/" . $row['LinkedInID'] . "' data-website='http://" . $row['LWebsite'] . "' data-name='" . $row['LName'] . "' data-specialties='" . $row['LSpecialties'] . "' data-industries='" . $row['LIndustries'] . "' data-type='" . $row['LCompanyType'] . "' data-foundedyear='" . $row['LFoundedYear'] . "' data-description='" . $row['LDescription'] . "' data-address='" . $row['LAddress'] . ", " . $row['LCity'] . ", " . $row['LZip'] . "' role='button' data-toggle='modal' class='open-MyModal'>LinkedIn</a></td>";
                    else
                      echo "<td></td>";
 //                   echo "<td><a target='_blank' href='linkedin.php?keywords=". $row['Name'] ."' role='button'>LinkedIn</a></td>";
                    if ($row['InsideviewID']>0)
                      echo "<td><a href='#myModalInside' data-insideurl='" . $row['CompanyPath'] . "' data-website='http://" . $row['CompanyWebsite'] . "' data-name='" . $row['CompanyName'] . "' data-industry='" . $row['SubIndustry'] . "' data-sic='" . $row['CompanySIC'] . " (" . $row['CompanySICNo'] . ")' data-naics='" . $row['CompanyNAICS'] . " (" . $row['CompanyNAICSNo'] . ")' data-phone='" . $row['CompanyPhone'] . "' data-description='" . $row['CompanyDescription'] . "' data-address='" . $row['CompanyStreet'] . ", " . $row['CompanyCity'] . ", " . $row['CompanyState'] . ", " . $row['CompanyZip'] . ", " . $row['CompanyCountry'] . "' role='button' data-toggle='modal' class='open-MyModal'>InsideView</a></td>";
                    else
                      echo "<td></td>";
                    echo "</tr>";
                  }
                  mysqli_close($con);
                }
                ?>
              </tbody>
            </table>
            </div>
          </div>
          </form>
          </div>
      </div>
      <div style="clear:both"></div>
      <br/><br/><br/><br/><br/><br/><br/>

    <?php include 'footer.php'; ?>

    </div> <!-- /container -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><label name="CompanyName" id="CompanyName"></label></h4>
          <label name="CompanyAddress" id="CompanyAddress" style="font-weight:normal"></label>
          <span style="float:right">
              <a target="_blank" name="Facebook" id="Facebook"><img src="img/facebook32.png" /></a>
              <a target="_blank" name="Twitter" id="Twitter"><img src="img/twitter32.png" /></a>
              <a target="_blank" name="LinkedIn" id="LinkedIn"><img src="img/linkedin32.png" /></a>
          </span>
        </div>
        <div class="modal-body" style="height:500px;overflow: auto" >
          <ul class="nav nav-tabs">
            <li class="active"><a href="#Details" data-toggle="tab">Details</a></li>
            <li><a href="#Tweets" data-toggle="tab">Tweets</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="Details">
              <br/>
              <label>Phone:</label>
              <label name="CompanyPhone" id="CompanyPhone" style="font-weight:normal"></label>&nbsp;&nbsp;&nbsp;
              <label>Industry:</label>
              <label name="CompanyIndustry" id="CompanyIndustry" style="font-weight:normal"></label><br/>
              <label>Website:</label>
              <a target="_blank" name="Website" id="Website"><label name="CompanyWebsite" id="CompanyWebsite" style="font-weight:normal"></label></a><br/>
              <label>Contact:</label>
              <label name="ContactName" id="ContactName" style="font-weight:normal"></label>
              <label> (</label>
              <label name="ContactTitle" id="ContactTitle" style="font-weight:normal"></label>
              <label>)</label>&nbsp;&nbsp;
              <label name="ContactEmail" id="ContactEmail" style="font-weight:normal"></label><br/>
              <br/>
              <label name="CompanyDescription" id="CompanyDescription" style="font-weight:normal"></label>
              <br/>
              <label name="CompanyCapabilities" id="CompanyCapabilities" style="font-weight:normal"></label>
            </div> <!-- profile -->
            <div class="tab-pane" id="Tweets">
              <br/>
              <div id='divTweets'></div>
              <iframe id='ifTweets' width="100%" height="390px" frameborder="0"></iframe>
            </div> <!-- profile -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <!-- Modal -->
  <div class="modal fade" id="myModalInside" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><label name="CompanyName" id="CompanyName"></label></h4>
          <label name="CompanyAddress" id="CompanyAddress" style="font-weight:normal"></label>
        </div>
        <div class="modal-body"  style="height:500px;overflow: auto" >
          <label>Phone:</label>
          <label name="CompanyPhone" id="CompanyPhone" style="font-weight:normal"></label><br/>
          <label>Industry:</label>
          <label name="CompanyIndustry" id="CompanyIndustry" style="font-weight:normal"></label><br/>
          <label>SIC:</label>
          <label name="CompanySIC" id="CompanySIC" style="font-weight:normal"></label><br/>
          <label>NAICS:</label>
          <label name="CompanyNAICS" id="CompanyNAICS" style="font-weight:normal"></label><br/>
          <label>Website:</label>
          <a target="_blank" name="Website" id="Website"><label name="CompanyWebsite" id="CompanyWebsite" style="font-weight:normal"></label></a><br/>
          <label>InsideView:</label>
          <a target="_blank" name="InsideURL" id="InsideURL"><label name="CompanyInsideURL" id="CompanyInsideURL" style="font-weight:normal"></label></a><br/><br/>
          <label>Description:</label><br/>
          <label name="CompanyDescription" id="CompanyDescription" style="font-weight:normal"></label>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <!-- Modal -->
  <div class="modal fade" id="myModalLinkedIn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><label name="LName" id="LName"></label></h4>
          <label name="LAddress" id="LAddress" style="font-weight:normal"></label>
        </div>
        <div class="modal-body">
          <label>Industries:</label>
          <label name="LIndustries" id="LIndustries" style="font-weight:normal"></label><br/>
          <label>Specialties:</label>
          <label name="LSpecialties" id="LSpecialties" style="font-weight:normal"></label><br/>
          <label>Type:</label>
          <label name="LType" id="LType" style="font-weight:normal"></label><br/>
          <label>Founded Year:</label>
          <label name="LFoundedYear" id="LFoundedYear" style="font-weight:normal"></label><br/>
          <label>Website:</label>
          <a target="_blank" name="ALWebsite" id="ALWebsite"><label name="LWebsite" id="LWebsite" style="font-weight:normal"></label></a><br/>
          <label>LinkedIn:</label>
          <a target="_blank" name="ALLinkedInURL" id="ALLinkedInURL" ><label name="LLinkedInURL" id="LLinkedInURL" style="font-weight:normal"></label></a><br/><br/>
          <label>Description:</label><br/>
          <div style="height:200px;overflow: auto" ><label name="LDescription" id="LDescription" style="font-weight:normal"></label></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

  <script type="text/javascript">
    showState("<?php echo $_SESSION['SelProjectCountry'] ?>");
    showSubIndustry("<?php echo $_SESSION['SelProjectIndustry'] ?>");
  </script>
  <script type="text/javascript">
    function selectAll() {
      var cb = document.getElementsByName("cbCompany[]");
      //alert(ims.length);
      for(var i = 0; i < cb.length; i++) {
          cb[i].checked = true;
      }      
    }
    function selectNone() {
      var cb = document.getElementsByName("cbCompany[]");
      //alert(ims.length);
      for(var i = 0; i < cb.length; i++) {
          cb[i].checked = false;
      }      
    }
    function toggleAll() {
      var cb = document.getElementsByName("cbCompany[]");
      //alert(ims.length);
      for(var i = 0; i < cb.length; i++) {
          cb[i].checked = !cb[i].checked;
      }      
    }
  </script>
  <script type="text/javascript">
  $(document).on("click", ".open-MyModal", function () {
       var name = $(this).data('name');
       $(".modal-header #CompanyName").text( name );
       var address = $(this).data('address');
       $(".modal-header #CompanyAddress").text( address );
       var description = $(this).data('description');
       $(".modal-body #CompanyDescription").text( description );
       var phone = $(this).data('phone');
       $(".modal-body #CompanyPhone").text( phone );
       var industry = $(this).data('industry');
       $(".modal-body #CompanyIndustry").text( industry );
       var sic = $(this).data('sic');
       $(".modal-body #CompanySIC").text( sic );
       var naics = $(this).data('naics');
       $(".modal-body #CompanyNAICS").text( naics );
       var website = $(this).data('website');
       $(".modal-body #CompanyWebsite").text( website );
       $(".modal-body #Website").attr("href", website );
       var insideurl = $(this).data('insideurl');
       $(".modal-body #CompanyInsideURL").text( insideurl );
       $(".modal-body #InsideURL").attr("href", insideurl );
       var industries = $(this).data('industries');
       $(".modal-body #LIndustries").text( industries );
       var specialties = $(this).data('specialties');
       $(".modal-body #LSpecialties").text( specialties );
       $(".modal-body #LDescription").text( description );
       $(".modal-header #LAddress").text( address );
       $(".modal-header #LName").text( name );
       var linkedinurl = $(this).data('linkedinurl');
       $(".modal-body #LLinkedInURL").text( linkedinurl );
       $(".modal-body #ALLinkedInURL").attr("href", linkedinurl );
       $(".modal-body #LWebsite").text( website );
       $(".modal-body #ALWebsite").attr("href", website );
       var type = $(this).data('type');
       $(".modal-body #LType").text( type );
       var foundedyear = $(this).data('foundedyear');
       $(".modal-body #LFoundedYear").text( foundedyear );
       var facebook = $(this).data('facebook');
       if  ((facebook != "No") && (facebook != ""))
       {
         $(".modal-header #Facebook").attr("href", facebook );
         $(".modal-header #Facebook").css("display", "inline-block");
        }
       else
         $(".modal-header #Facebook").css("display", "none");
       var twitter = $(this).data('twitter');
       if  ((twitter != "No") && (twitter != ""))
       {
         $(".modal-header #Twitter").attr("href", twitter );
         $(".modal-header #Twitter").css("display", "inline-block");
         $(".modal-header #Twitter").attr("href", twitter );
        }
       else
         $(".modal-header #Twitter").css("display", "none");
       var linkedin = $(this).data('linkedin');
       if  ((linkedin != "No") && (linkedin != ""))
       {
         $(".modal-header #LinkedIn").attr("href", linkedin );
         $(".modal-header #LinkedIn").css("display", "inline-block");
        }
       else
         $(".modal-header #LinkedIn").css("display", "none");
       var contactname = $(this).data('contactname');
       $(".modal-body #ContactName").text(contactname );
       var contacttitle = $(this).data('contacttitle');
       $(".modal-body #ContactTitle").text(contacttitle );
       var contactemail = $(this).data('contactemail');
       $(".modal-body #ContactEmail").text(contactemail );
       var capabilities = $(this).data('capabilities');
       $(".modal-body #CompanyCapabilities").html( capabilities );
       showTweets(twitter.substring(twitter.lastIndexOf("/")+1));
       
//       $(".modal-body #LIndustries").text( name );
       // As pointed out in comments,
       // it is superfluous to have to manually call the modal.
       // $('#addBookDialog').modal('show');
});
//  $(document).on("click", ".open-MyModalLinkedIn", function () {
  //     var linkedinurl = $(this).data('linkedinurl');
    //   $(".modal-body #LinkedInURL").attr("href", linkedinurl );
//});
	</script>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../assets3/js/jquery.js"></script>
    <script src="../assets3/js/transition.js"></script>
    <script src="../assets3/js/alert.js"></script>
    <script src="../assets3/js/modal.js"></script>
    <script src="../assets3/js/dropdown.js"></script>
    <script src="../assets3/js/scrollspy.js"></script>
    <script src="../assets3/js/tab.js"></script>
    <script src="../assets3/js/tooltip.js"></script>
    <script src="../assets3/js/popover.js"></script>
    <script src="../assets3/js/button.js"></script>
    <script src="../assets3/js/collapse.js"></script>
    <script src="../assets3/js/carousel.js"></script>

  </body>
</html>
