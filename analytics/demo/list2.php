<?php
	session_start();
    if (!isset($_SESSION['ProjectID']))
      header("Location: projects.php");
    if ($_SESSION['ProjectType'] =='3') 
      header("Location: list3.php");
    else if ($_SESSION['ProjectType'] =='2') 
      header("Location: list.php");
  if ($_GET['P'])
  {
    $_SESSION['SelProjectCountry']  = "Canada";
    $_SESSION['SelProjectState']  = $_GET['P'];
  }
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
      alert(str);
      document.getElementById("ifTweets").src = "http://www.blueprime.ca/getTweets.php?name="+str;
    }
  <script>
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
  </script>
</head>

  <body>

  <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <?php 
           if ($_SESSION["ReadOnly"]=="NO")  {
            ?>
          <a class="navbar-brand" href="projects.php"><span class="glyphicon glyphicon-list"></span> Projects</a>
          <?php 
           }
            ?>
        </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav">
        <li>
          <?php 
           if ($_SESSION["ReadOnly"]=="NO") 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<a href="import.php"><span class="glyphicon glyphicon-import"></span> Build</a>';
            else 
                echo '<a href="build.php"><span class="glyphicon glyphicon-check"></span> Build</a>';
          ?>
        </li>
        <li class="active">
          <a href="list2.php"><span class="glyphicon glyphicon-th"></span> Data </a>
        </li>
        <li>
           <a href="view.php"><span class="glyphicon glyphicon-globe"></span> Map </a>
        </li>
          <?php 
            if ($_SESSION['ProjectType'] =='1') 
                echo '<li><a href="concept4.php"><span class="glyphicon glyphicon-dashboard"></span> Eco-system </a></li>';
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
          if ($_SESSION['ViewerCount'] >0) 
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
        <?php if (( strcmp( $_SESSION['UserID'], '17' ) !== 0 )) {  ?>
        <br/>
        <br/>
        <div style="float:left">
          <a href="instruction.php" role="button" class="btn btn-primary btn-lg" style="height:80px;width:970px;padding-top:25px;font-size:25px;">Tool Instruction</a>
        </div>
      <div style="clear:both"></div>

        <?php } ?>
        <?php
        //echo $_SESSION['ProjectID'];
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
        ?>
        <br/>
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
            <form class="form-horizontal" role="form" action="list2Actions.php" method="post">
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
                  echo "<div class='col-lg-2 control-label'>Capability: </div>\n";
                  echo "<div class='col-lg-4'>\n";
                  echo "<select class='form-control' name='SelProjectCapability' >\n";
                  $result = mysqli_query($con,"SELECT DISTINCT Title Capability FROM ProjectCapabilities WHERE ProjectID=$ProjectID ORDER BY ID");
                  if (!$result)
                      echo "<script>window.location = 'index.html'</script>";
                  echo "<option value=''><-- All Capabilities --></option>\n";
                  while($row = mysqli_fetch_array($result))
                  {
                     if ($_SESSION['SelProjectCapability']==$row['Capability'])
                        echo "<option selected value='" . $row['Capability'] . "'>" . $row['Capability'] . "</option>\n";
                     else
                        echo "<option value='" . $row['Capability'] . "'>" . $row['Capability'] . "</option>\n";
                  }
                  echo "</select>\n";
                  echo "</div>\n";
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
                  if (isset($_SESSION['SelProjectCapability']))
                    $SelProjectCapability = $_SESSION['SelProjectCapability'];
                  else
                    $SelProjectCapability = "";
                  $Keyword = $_SESSION['ProjectKeyword'];
//                  $result = mysqli_query($con,"SELECT COUNT(distinct pc.ID) cnt FROM ProjectCompanies pc INNER JOIN ProjectCapabilities pcc ON pcc.ProjectID = pc.ProjectID INNER JOIN CompanyCapabilities cc ON cc.CompanyID = pc.ID AND cc.CapabilityID = pcc.ID Where pc.ProjectID=$ProjectID and (Country='". $SelProjectCountry . "' OR '". $SelProjectCountry . "' = '') AND (State='". $SelProjectState . "' OR '". $SelProjectState . "' = '') AND (Title='". $SelProjectCapability. "' OR '". $SelProjectCapability . "' = '') AND (Name like '%". $Keyword . "%' OR '". $Keyword . "' = '')");
                  $result = mysqli_query($con,"SELECT COUNT(distinct pc.ID) cnt FROM ProjectCompanies pc Where pc.ProjectID=$ProjectID and (Country='". $SelProjectCountry . "' OR '". $SelProjectCountry . "' = '') AND (State='". $SelProjectState . "' OR '". $SelProjectState . "' = '') AND (EXISTS (SELECT 1 FROM ProjectCapabilities pcc INNER JOIN CompanyCapabilities cc ON cc.CapabilityID = pcc.ID WHERE pcc.ProjectID = pc.ProjectID AND cc.CompanyID = pc.ID AND Title='". $SelProjectCapability. "') OR '". $SelProjectCapability . "' = '') AND (Description like '%". $Keyword . "%' OR Name like '%". $Keyword . "%' OR '". $Keyword . "' = '')");
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
                    echo "<li class='previous'><a href='list2.php?page=$pageN1'>Previous $pageCount</a></li>";
                  else
                    echo "<li class='previous disabled'><a href='#'>Previous $pageCount</a></li>";
                  echo "<li>Page $page ($start - $end of $total)</li>";
                  if ($page*$pageCount<$total)
                    echo "<li class='next'><a href='list2.php?page=$pageP1'>Next $pageCount</a></li>";
                  else
                    echo "<li class='next disabled'><a href='#'>Next $pageCount</a></li>";
                  echo "</ul>";            
                  mysqli_close($con);
                }
              ?>
            <input type="hidden" name="pageno" value=<?php echo $page ?>>
          <?php if ($_SESSION["ReadOnly"]=="NO") { ?>
            <div class="row">
              <div class="col-xs-12 col-md-10">
                &nbsp;&nbsp;&nbsp;&nbsp;<span class="label label-default">Select:</span>
                <button type="button" class="btn btn-link" onclick="selectAll();">All</button>
                <button type="button" class="btn btn-link" onclick="selectNone();">None</button>
                <button type="button" class="btn btn-link" onclick="toggleAll();">Toggle</button>
                <?php if ($total>0) { ?>
                  <button type="submit" class="btn btn-primary" name="btnDelSelected">Delete Selected</button>
                  <button type="submit" class="btn btn-primary" name="btnDelThese">Delete <?php if ($total-$pageCount*($page-1)==1) echo "This"; else echo "These"; ?> <?php if ($total<$pageCount*$page) echo $total-$pageCount*($page-1); else echo $pageCount; ?></button>
                <?php }?>
              </div>
              <div class="col-xs-6 col-md-2">
                <?php if ($total>0) { ?>
                  <button type="submit" class="btn btn-primary" name="btnDelAll">Empty Project</button>
                <?php }?>
              </div>
            </div>         
          <?php } ?>
            </br>     
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr style="background:#373;color:white">
                  <th></th>
                  <th>NAICS</th>
                  <th>Name</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Zip</th>
                  <th>Country</th>
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
                  $result = mysqli_query($con,"SELECT pc.*,IF(length(pc.Name)>25,concat(SUBSTRING(pc.Name,1,25),'...'),pc.Name) ShortName ,Concat(IFNULL((SELECT Name FROM NAICS WHERE Code=pc.NAICSCode),''),' (',NAICSCode,')') NAICSName ,(select concat('<b><i>Capabilities:</i></b><br/>',GROUP_CONCAT(concat('<b>',pc1.Title,':</b> ',cc.Details) separator '<br/>')) from CompanyCapabilities cc INNER JOIN ProjectCapabilities pc1 ON pc1.ID = cc.CapabilityID where CompanyID=pc.ID) CompanyCapabilities FROM ProjectCompanies pc Where pc.ProjectID=$ProjectID and (pc.Country='". $SelProjectCountry . "' OR '". $SelProjectCountry . "' = '') AND (pc.State='". $SelProjectState . "' OR '". $SelProjectState . "' = '') AND (EXISTS (SELECT 1 FROM ProjectCapabilities pcc INNER JOIN CompanyCapabilities cc ON cc.CapabilityID = pcc.ID WHERE pcc.ProjectID = pc.ProjectID AND cc.CompanyID = pc.ID AND Title='". $SelProjectCapability. "') OR '". $SelProjectCapability . "' = '') AND (pc.Description like '%". $Keyword . "%' OR pc.Name like '%". $Keyword . "%' OR '". $Keyword . "' = '')  LIMIT $start,$pageCount");
                  if (!$result)
                      echo "<script>window.location = 'index.html'</script>";
                  while($row = mysqli_fetch_array($result))
                  {
                    echo "<tr>";
                    if ($_SESSION["ReadOnly"]=="NO") 
                      echo "<td><input type='Checkbox' id='cbCompany" . $i . "' name='cbCompany[]' value='" . $row['ID'] . "'></td>";
                    else
                      echo "<td></td>";
                    echo "<input type='hidden' name='hdCompany[]' value='" . $row['ID'] . "'>";
                    echo "<td>" . $row['NAICSName'] . "</td>";
                    echo "<td><a href='#myModal' data-id='" . $row['ID'] . "' data-shortname='" . $row['ShortName'] . "' data-capabilities='" . $row['CompanyCapabilities'] . "' data-contactname='" . $row['ContactName'] . "' data-contacttitle='" . $row['ContactTitle'] . "' data-contactemail='" . $row['ContactEmail'] . "' data-facebook='" . $row['FacebookURL'] . "' data-twitter='" . $row['TwitterURL'] . "' data-linkedin='" . $row['LinkedInURL'] . "' data-ic='" . $row['OtherURL'] . "' data-website='http://" . $row['Website'] . "' data-name='" . $row['Name'] . "' data-industry='" . $row['Sector'] . "' data-phone='" . $row['Phone'] . "' data-description='" . str_replace(">", "&gt", $row['Description']) . "' data-address='" . $row['Address'] . ", " . $row['City'] . ", " . $row['State'] . ", " . $row['PostalCode'] . ", " . $row['Country'] . "' role='button' data-toggle='modal' class='open-MyModal'>" . $row['Name'] . "</a></td>";
                    echo "<td>" . $row['City'] . "</td>";
                    echo "<td>" . $row['State'] . "</td>";
                    echo "<td>" . $row['PostalCode'] . "</td>";
                    echo "<td>" . $row['Country'] . "</td>";
                    echo "<td width='100px'>";
                    if (($row['FacebookURL']!="") && (strtoupper($row['FacebookURL'])!="NO"))
                      echo "<a target='_blank' href='" . $row['FacebookURL'] . "'><img width='20px' src='img/facebook32.png' /></a>";
                    if (($row['TwitterURL']!="") && (strtoupper($row['TwitterURL'])!="NO"))
                      echo "<a target='_blank' href='" . $row['TwitterURL'] . "'><img width='20px' src='img/twitter32.png' /></a>";
                    if (($row['LinkedInURL']!="") && (strtoupper($row['LinkedInURL'])!="NO"))
                      echo "<a target='_blank' href='" . $row['LinkedInURL'] . "'><img width='20px' src='img/linkedin32.png' /></a>";
                    if (($row['OtherURL']!="") && (strtoupper($row['OtherURL'])!="NO"))
                      echo "<a target='_blank' href='" . $row['OtherURL'] . "'><img width='20px' src='img/ic32.png' /></a>";
                    echo "</td>";
                    /*
                    if ($row['LinkedInID']!="")
                      echo "<td><a href='#myModalLinkedIn' data-linkedinurl='http://www.linkedin.com/company/" . $row['LinkedInID'] . "' data-website='http://" . $row['LWebsite'] . "' data-name='" . $row['LName'] . "' data-specialties='" . $row['LSpecialties'] . "' data-industries='" . $row['LIndustries'] . "' data-type='" . $row['LCompanyType'] . "' data-foundedyear='" . $row['LFoundedYear'] . "' data-description='" . $row['LDescription'] . "' data-address='" . $row['LAddress'] . ", " . $row['LCity'] . ", " . $row['LZip'] . "' role='button' data-toggle='modal' class='open-MyModal'>LinkedIn</a></td>";
                    else
                      echo "<td></td>";
                      */
 //                   echo "<td><a target='_blank' href='linkedin.php?keywords=". $row['Name'] ."' role='button'>LinkedIn</a></td>";
//                    if ($row['InsideviewID']!="")
  //                    echo "<td><a href='#myModalInside' data-insideurl='" . $row['CompanyPath'] . "' data-website='http://" . $row['CompanyWebsite'] . "' data-name='" . $row['CompanyName'] . "' data-industry='" . $row['SubIndustry'] . "' data-sic='" . $row['CompanySIC'] . " (" . $row['CompanySICNo'] . ")' data-naics='" . $row['CompanyNAICS'] . " (" . $row['CompanyNAICSNo'] . ")' data-phone='" . $row['CompanyPhone'] . "' data-description='" . $row['CompanyDescription'] . "' data-address='" . $row['CompanyStreet'] . ", " . $row['CompanyCity'] . ", " . $row['CompanyState'] . ", " . $row['CompanyZip'] . ", " . $row['CompanyCountry'] . "' role='button' data-toggle='modal' class='open-MyModal'>InsideView</a></td>";
  //                  else
 //                     echo "<td></td>";
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
          <br/>
          <div style="float:right">
              <a target="_blank" name="Facebook" id="Facebook"><img src="img/facebook32.png" /></a>
              <a target="_blank" name="Twitter" id="Twitter"><img src="img/twitter32.png" /></a>
              <a target="_blank" name="LinkedIn" id="LinkedIn"><img src="img/linkedin32.png" /></a>
              <a target="_blank" name="IC" id="IC"><img src="img/ic32.png" /></a>
              &nbsp;&nbsp;&nbsp;
              <a name="comp" id="comp"><img src="img/graph1.png" /></a>
              <a name="view" id="view"><img src="img/graph2.png" /></a>
          </div>
          <br/>
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
              <BR/>
              <label name="CompanyDescription" id="CompanyDescription" style="font-weight:normal"></label>
              <BR/>
              <label name="CompanyCapabilities" id="CompanyCapabilities" style="font-weight:normal"></label>
            </div> <!-- profile -->
            <div class="tab-pane" id="Tweets">
              <br/>
              <div id='divTweets'></div>
              <iframe id='ifTweets' width="100%" height="390px" frameborder="0"></iframe>
            </div> <!-- profile -->
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
        <div class="modal-body">
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
       if  ((facebook.toUpperCase()  != "NO") && (facebook != ""))
       {
         $(".modal-header #Facebook").attr("href", facebook );
         $(".modal-header #Facebook").css("display", "inline-block");
        }
       else
         $(".modal-header #Facebook").css("display", "none");
       var twitter = $(this).data('twitter');
       if  ((twitter.toUpperCase()  != "NO") && (twitter != ""))
       {
         $(".modal-header #Twitter").attr("href", twitter );
         $(".modal-header #Twitter").css("display", "inline-block");
        }
       else
         $(".modal-header #Twitter").css("display", "none");
       var linkedin = $(this).data('linkedin');
       if  ((linkedin.toUpperCase()  != "NO") && (linkedin != ""))
       {
         $(".modal-header #LinkedIn").attr("href", linkedin );
         $(".modal-header #LinkedIn").css("display", "inline-block");
        }
       else
         $(".modal-header #LinkedIn").css("display", "none");
       var ic = $(this).data('ic');
       if  ((ic.toUpperCase()  != "NO") && (ic != ""))
       {
         $(".modal-header #IC").attr("href", ic );
         $(".modal-header #IC").css("display", "inline-block");
        }
       else
         $(".modal-header #IC").css("display", "none");
       var id = $(this).data('id');
       $(".modal-header #comp").attr("href", "comp.php?ID=" + id );
       $(".modal-header #comp").css("display", "inline-block");
       var shortname = $(this).data('shortname');
       $(".modal-header #view").attr("href", "concept4.php#" + shortname.replace(/\(/g,"-").replace(/\)/g,"-").replace(/\./g,"-").replace(/\ /g,"-").toLowerCase());
       $(".modal-header #view").css("display", "inline-block");
       var contactname = $(this).data('contactname');
       $(".modal-body #ContactName").text(contactname );
       var contacttitle = $(this).data('contacttitle');
       $(".modal-body #ContactTitle").text(contacttitle );
       var contactemail = $(this).data('contactemail');
       $(".modal-body #ContactEmail").text(contactemail );
       var capabilities = $(this).data('capabilities');
       $(".modal-body #CompanyCapabilities").html( capabilities );
       document.getElementById("ifTweets").src = "http://www.blueprime.ca/getTweets.php?name="+twitter.substring(twitter.lastIndexOf("/")+1);
//       showTweets(twitter.substring(twitter.lastIndexOf("/")+1));

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
