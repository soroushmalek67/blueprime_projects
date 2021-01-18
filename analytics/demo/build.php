<?php
    session_start();
    if (!isset($_SESSION['ProjectID']))
      header("Location: projects.php");
  if ($_SESSION['ProjectType'] =='1') 
    header("Location: import.php");
  else if ($_SESSION['ProjectType'] =='3') 
    header("Location: importNew.php");
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Company Directory</title>
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
      .navbar .navbar-inner {
        background-color: #b91773;
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
.nav.nav-tabs > li.dropdown.active.open > a, 
.nav.nav-tabs > li.dropdown.active.open > ul.dropdown-menu a:hover,
.nav.nav-tabs > li.dropdown.open > a, 
.nav.nav-tabs > li.dropdown.open > ul.dropdown-menu a:hover
{
  color: #fff;
  background-color: #b91773;
  border-color: #fff;
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
    xmlhttp.open("GET","getStates.php?q="+str,true);
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
    xmlhttp1.open("GET","getSubIndustries.php?q="+str.replace("&","@@@"),true);
    xmlhttp1.send();
    }
 //   showState("<?php echo $_SESSION['SelBuildCountry'] ?>");
   // showSubIndustry("<?php echo $_SESSION['SelBuildIndustry'] ?>");
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
          <a class="navbar-brand" href="projects.php"><span class="glyphicon glyphicon-list"></span> Projects</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
          <ul class="nav navbar-nav">
            <li class="active">
              <?php 
               if ($_SESSION["ReadOnly"]=="NO") 
                if ($_SESSION['ProjectType'] =='1') 
                    echo '<a href="import.php"><span class="glyphicon glyphicon-import"></span> Build</a>';
                else 
                    echo '<a href="build.php"><span class="glyphicon glyphicon-check"></span> Build</a>';
              ?>
            </li>
        <li>
          <a href="list.php"><span class="glyphicon glyphicon-th"></span> Data</a>
        </li>
        <li>
           <a href="view.php"><span class="glyphicon glyphicon-globe"></span> Map</a>
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
            $result = mysqli_query($con,"SELECT Name,(SELECT COUNT(*) FROM ProjectCompanies WHERE ProjectID=". $_SESSION['ProjectID'] .") CompanyCount FROM UserProjects Where ID=". $_SESSION['ProjectID']);
            $row = mysqli_fetch_array($result);
        ?>
        <br/>
        <ul class="nav nav-stacked nav-pills" >
          <li class="active">
            <a style="background-color:#D17D08">
              <span class="badge pull-right"><h5><?php echo $row[CompanyCount]; ?> Companies</h5></span>
              <h4><?php echo $row[Name]; ?></h4>
            </a>
          </li>
        </ul>       
      <div style="clear:both"></div>
      <br/>
      <div class="jumbotron1">
        <div class="bs-docs-example">
            <form class="form-horizontal" role="form" action="buildActions.php" method="post">
              <div class="panel panel-warning">
                <div class="panel-heading">
                <?php
                // Create connection
                $ProjectID = $_SESSION['ProjectID'];
                include 'dbConn.php';
                // Check connection
                if (mysqli_connect_errno($con))
                {
                  echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                else
                {
		      echo "<div class='form-group'> \n";
		      echo "<div class='col-lg-2 control-label'>Country: </div>\n";
		      echo "<div class='col-lg-4'>\n";
		      echo "<select class='form-control' name='SelBuildCountry' onchange='showState(this.value)'>\n";
                  $result = mysqli_query($con,"SELECT Country FROM InsideviewStates GROUP BY Country ORDER BY Country");
                  echo "<option value=''><-- All Countries --></option>\n";
                  while($row = mysqli_fetch_array($result))
                  {
			   if ($_SESSION['SelBuildCountry']==$row['Country'])
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
  		      echo "<select class='form-control' name='SelBuildIndustry' onchange='showSubIndustry(this.value)'>\n";
                  $result = mysqli_query($con,"SELECT DISTINCT Industry FROM InsideviewIndustries ORDER BY Industry");
                  echo "<option value=''><-- All Industries --></option>\n";
                  while($row = mysqli_fetch_array($result))
                  {
			   if ($_SESSION['SelBuildIndustry']==$row['Industry'])
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
                  echo "<input name='Keyword' type='text' class='form-control' placeholder='Keyword' value='" . $_SESSION['BuildKeyword']. "'>";
                  echo "</div>\n";
                  echo "</div>\n";
			echo "<div class='form-group'> \n";
                  echo "<div class='col-lg-offset-2 col-lg-8'>\n";
                  echo "<button name='btnSearch' class='btn btn-block btn-primary' type='submit'>Search</button>\n";
                  echo "</div>\n";
                  echo "</div>\n";
                ?>
                </div>
                <div class="panel-body">
                <?php
                  if (isset($_SESSION['SelBuildCountry']))
                    $SelBuildCountry = $_SESSION['SelBuildCountry'];
                  else
                    $SelBuildCountry = "";
                  if (isset($_SESSION['SelBuildState']))
                    $SelBuildState = $_SESSION['SelBuildState'];
                  else
                    $SelBuildState = "";
                  if (isset($_SESSION['SelBuildIndustry']))
                    $SelBuildIndustry = $_SESSION['SelBuildIndustry'];
                  else
                    $SelBuildIndustry = "";
                  if (isset($_SESSION['SelBuildSubIndustry']))
                    $SelBuildSubIndustry = $_SESSION['SelBuildSubIndustry'];
                  else
                    $SelBuildSubIndustry = "";
                  $Keyword = $_SESSION['BuildKeyword'];
                  $result = mysqli_query($con,"SELECT COUNT(*) cnt FROM Insideview Where (CompanyCountry='". $SelBuildCountry . "' OR '". $SelBuildCountry . "' = '') AND (CompanyState='". $SelBuildState . "' OR '". $SelBuildState . "' = '') AND (Industry='". $SelBuildIndustry . "' OR '". $SelBuildIndustry . "' = '') AND (SubIndustry='". $SelBuildSubIndustry . "' OR '". $SelBuildSubIndustry . "' = '') AND (CompanyName like '%". $Keyword . "%' OR '". $Keyword . "' = '')");
                  $row = mysqli_fetch_array($result);
                  $pageCount = 50;
                  $total = $row["cnt"];
                  if ($_GET["page"])
                    $page=$_GET["page"];
                  else
                    $page=1;
                  $pageP1 = $page+1;
                  $pageN1 = $page-1;
                  $start = ($page-1)*$pageCount+1;
                  $end = $page*$pageCount;
                  if ($end>$total)
                    $end = $total;
                  echo "<ul class='pager  pagination-right'>";
                  if ($page>1) 
                    echo "<li class='previous'><a href='build.php?page=$pageN1'>Previous $pageCount</a></li>";
                  else
                    echo "<li class='previous disabled'><a href='#'>Previous $pageCount</a></li>";
                  echo "<li>Page $page ($start - $end of $total)</li>";
                  if ($page*$pageCount<$total)
                    echo "<li class='next'><a href='build.php?page=$pageP1'>Next $pageCount</a></li>";
                  else
                    echo "<li class='next disabled'><a href='#'>Next $pageCount</a></li>";
                  echo "</ul>";            
                  mysqli_close($con);
                }
              ?>
            <input type="hidden" name="pageno" value=<?php echo $page ?>>
            <div class="row">
              <div class="col-xs-12 col-md-8">
                &nbsp;&nbsp;&nbsp;&nbsp;<span class="label label-default">Select:</span>
                <button type="button" class="btn btn-link" onclick="selectAll();">All</button>
                <button type="button" class="btn btn-link" onclick="selectNone();">None</button>
                <button type="button" class="btn btn-link" onclick="toggleAll();">Toggle</button>
                <button type="submit" class="btn btn-primary" name="btnAddSelected">Add Selected</button>
              </div>
              <div class="col-xs-6 col-md-4">
                <button type="submit" class="btn btn-primary" name="btnAddThese">Add <?php if ($total-$pageCount*($page-1)==1) echo "This"; else echo "These"; ?> <?php if ($total<$pageCount*$page) echo $total-$pageCount*($page-1); else echo $pageCount; ?></button>
                <?php if ($total<10000 && $total>$pageCount) { ?>
                  <button type="submit" class="btn btn-primary" name="btnAddAll">Add All <?php echo $total ?></button>
                <?php }?>
              </div>
            </div>         
            </br>     
            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr style="background:#373;color:white">
                  <th></th>
                  <th>Industry</th>
                  <th>Name</th>
                  <th>City</th>
                  <th>State</th>
                  <th>Country</th>
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
                  echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
                else
                {
                  $start = ($page-1)*$pageCount;
                  //echo "SELECT Insideview.*, (SELECT COUNT(*) FROM ProjectCompanies WHERE ProjectID=". $_SESSION['ProjectID'] . " AND InsideviewID = Insideview.ID) Added FROM Insideview Where (CompanyCountry='". $SelBuildCountry . "' OR '". $SelBuildCountry . "' = '') AND (CompanyState='". $SelBuildState . "' OR '". $SelBuildState . "' = '') AND (Industry='". $SelBuildIndustry . "' OR '". $SelBuildIndustry . "' = '') AND (SubIndustry='". $SelBuildSubIndustry . "' OR '". $SelBuildSubIndustry . "' = '') AND (CompanyName like '%". $Keyword . "%' OR '". $Keyword . "' = '') LIMIT $start,$pageCount";
                  $result = mysqli_query($con,"SELECT Insideview.*, (SELECT COUNT(*) FROM ProjectCompanies WHERE ProjectID=". $_SESSION['ProjectID'] . " AND InsideviewID = Insideview.ID) Added FROM Insideview Where (CompanyCountry='". $SelBuildCountry . "' OR '". $SelBuildCountry . "' = '') AND (CompanyState='". $SelBuildState . "' OR '". $SelBuildState . "' = '') AND (Industry='". $SelBuildIndustry . "' OR '". $SelBuildIndustry . "' = '') AND (SubIndustry='". $SelBuildSubIndustry . "' OR '". $SelBuildSubIndustry . "' = '') AND (CompanyName like '%". $Keyword . "%' OR '". $Keyword . "' = '') LIMIT $start,$pageCount");
                  $i = 0;
                  while($row = mysqli_fetch_array($result))
                  {
                    $i = $i + 1;
                    echo "<tr>";
                    if ($row['Added']<>"0")
                      echo "<td><span class='label label-success'>Added</span></td>";
                    else {
                      echo "<td><input type='Checkbox' id='cbCompany" . $i . "' name='cbCompany[]' value='" . $row['ID'] . "'></td>";
                      echo "<input type='hidden' name='hdCompany[]' value='" . $row['ID'] . "'>";
                      }
                    echo "<td>" . $row['ID'] . " - " . $row['Industry'] . " - " . $row['SubIndustry'] . "</td>";
                    echo "<td><a href='#myModal' data-insideurl='" . $row['CompanyPath'] . "' data-website='http://" . $row['CompanyWebsite'] . "' data-name='" . $row['CompanyName'] . "' data-industry='" . $row['SubIndustry'] . "' data-sic='" . $row['CompanySIC'] . " (" . $row['CompanySICNo'] . ")' data-naics='" . $row['CompanyNAICS'] . " (" . $row['CompanyNAICSNo'] . ")' data-phone='" . $row['CompanyPhone'] . "' data-description='" . $row['CompanyDescription'] . "' data-address='" . $row['CompanyStreet'] . ", " . $row['CompanyCity'] . ", " . $row['CompanyState'] . ", " . $row['CompanyZip'] . ", " . $row['CompanyCountry'] . "' role='button' data-toggle='modal' class='open-MyModal'>" . $row['CompanyName'] . "</a></td>";
                    echo "<td>" . $row['CompanyCity'] . "</td>";
                    echo "<td>" . $row['CompanyState'] . "</td>";
                    echo "<td>" . $row['CompanyCountry'] . "</td>";
                    echo "<td><a target='_blank' href='linkedin.php?keywords=". $row['Name'] ."' role='button'>LinkedIn</a></td>";
//                    if ($row['InsideviewID']!="")
//                      echo "<td><a href='#myModalInside' data-insideurl='" . $row['CompanyPath'] . "' data-website='http://" . $row['CompanyWebsite'] . "' data-name='" . $row['CompanyName'] . "' data-industry='" . $row['SubIndustry'] . "' data-sic='" . $row['CompanySIC'] . " (" . $row['CompanySICNo'] . ")' data-naics='" . $row['CompanyNAICS'] . " (" . $row['CompanyNAICSNo'] . ")' data-phone='" . $row['CompanyPhone'] . "' data-description='" . $row['CompanyDescription'] . "' data-address='" . $row['CompanyStreet'] . ", " . $row['CompanyCity'] . ", " . $row['CompanyState'] . ", " . $row['CompanyZip'] . ", " . $row['CompanyCountry'] . "' role='button' data-toggle='modal' class='open-MyModal'>InsideView</a></td>";
//                    else
//                      echo "<td></td>";
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
  <script type="text/javascript">
    showState("<?php echo $_SESSION['SelBuildCountry'] ?>");
    showSubIndustry("<?php echo $_SESSION['SelBuildIndustry'] ?>");
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
       // As pointed out in comments,
       // it is superfluous to have to manually call the modal.
       // $('#addBookDialog').modal('show');
});
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
