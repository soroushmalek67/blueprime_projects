<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Camese Company Directory</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets3/css/bootstrap.css" rel="stylesheet">
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
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <ul class="nav" >
              <li><a style="color:white" href="index.php">Home</a></li>
            </ul>
          </div>
    </div>

    <div style="clear:both"></div>
    <div class="container">
      <br/>
      <div class="masthead">
      <!-- Jumbotron -->
      <div>
        <h2>Camese Company Directory</h2>
      </div>
      <div style="clear:both"></div>
      <div class="jumbotron1">
        <div class="bs-docs-example">

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
                  echo "<form class='form-horizontal' role='form' action='mainActions.php' method='post'>\n";
		      echo "<div class='form-group'> \n";
		      echo "<div class='col-lg-2 control-label'>Province: </div>\n";
		      echo "<div class='col-lg-4'>\n";
		      echo "<select class='form-control' name='SelProvince'>\n";
                  $result = mysqli_query($con,"SELECT DISTINCT Province FROM Companies WHERE Province<>'' and Country=  'Canada' ORDER BY Province ");
                  echo "<option><-- All Provinces --></option>\n";
                  while($row = mysqli_fetch_array($result))
                  {
			   if ($_SESSION['SelProvince']==$row['Province'])
				echo "<option selected>" . $row['Province'] . "</option>\n";
			   else
				echo "<option>" . $row['Province'] . "</option>\n";
                  }
			echo "</select>\n";
                  echo "</div>\n";
                  echo "</div>\n";
  		      echo "<div class='form-group'> \n";
  		      echo "<div class='col-lg-2 control-label'>Sector: </div>\n";
  		      echo "<div class='col-lg-4'>\n";
  		      echo "<select class='form-control' name='SelSector'>\n";
                  $result = mysqli_query($con,"SELECT ID Sector,Concat(ID,' - ',Type,'/',Name) Sector1 FROM Sectors Order By Sector");
                  echo "<option><-- All Sectors --></option>\n";
                  while($row = mysqli_fetch_array($result))
                  {
			   if ($_SESSION['SelSector']==$row['Sector'])
                        echo "<option selected>" . $row['Sector'] . "</option>\n";
			   else
                        echo "<option>" . $row['Sector'] . "</option>\n";
                  }
			echo "</select>\n";
                  echo "</div>\n";
                  echo "</div>\n";
                  echo "<div class='form-group'> \n";
                  echo "<div class='col-lg-2 control-label'></div>\n";
                  echo "<div class='col-lg-4'>\n";
                  echo "<input name='Keyword' type='text' class='form-control' placeholder='Keyword' value='" . $_SESSION['Keyword']. "'>";
                  echo "</div>\n";
                  echo "</div>\n";
			echo "<div class='form-group'> \n";
                  echo "<div class='col-lg-offset-2 col-lg-4'>\n";
                  echo "<button name='btnSearch' class='btn btn-block btn-primary' type='submit'>Search</button>\n";
                  echo "</div>\n";
                  echo "</div>\n";
                  echo "</form>\n";

                  mysqli_close($con);
                }
                ?>

            <table class="table table-striped table-bordered table-hover">
              <thead>
                <tr style="background:#373;color:white">
                  <th>Industry</th>
                  <th>Name</th>
                  <th>City</th>
                  <th>Province</th>
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
                  if (isset($_SESSION['SelProvince']))
  	                $SelProvince = $_SESSION['SelProvince'];
                  else
  	                $SelProvince = "";
                  if (isset($_SESSION['SelSector']))
  	                $SelSector = $_SESSION['SelSector'];
                  else
  	                $SelSector = "";
                  $Keyword = $_SESSION['Keyword'];
                  $result = mysqli_query($con,"SELECT DISTINCT c.*,iv.* FROM Companies c INNER JOIN CompanySectors cs ON cs.CompanyID = c.ID LEFT JOIN Insideview iv ON iv.ID = c.InsideviewID Where (Province='". $SelProvince . "' OR '". $SelProvince . "' = '') AND (Sector='". $SelSector . "' OR '". $SelSector . "' = '') AND (Name like '%". $Keyword . "%' OR '". $Keyword . "' = '') LIMIT 50");

                  while($row = mysqli_fetch_array($result))
                  {
                    echo "<tr>";
                    echo "<td>" . $row['SectorName'] . "</td>";
                    echo "<td><a href='#myModal' data-insideurl='http://www.camese.org/" . $row['URL'] . "' data-website='http://" . $row['Website'] . "' data-name='" . $row['Name'] . "' data-industry='" . $row['SectorName'] . "' data-sic='" . $row['SectorName'] . " (" . $row['SectorName'] . ")' data-naics='" . $row['SectorName'] . " (" . $row['SectorName'] . ")' data-phone='" . $row['Phone'] . "' data-description='" . $row['Details'] . "' data-address='" . $row['Address'] . ", " . $row['City'] . ", " . $row['Province'] . ", " . $row['PostalCode'] . ", " . $row['Country'] . "' role='button' data-toggle='modal' class='open-MyModal'>" . $row['Name'] . "</a></td>";
                    echo "<td>" . $row['City'] . "</td>";
                    echo "<td>" . $row['Province'] . "</td>";
                    echo "<td>" . $row['Country'] . "</td>";
                    echo "<td><a target='_blank' href='linkedin.php?keywords=". $row['Name'] ."' role='button'>LinkedIn</a></td>";
                    if ($row['InsideviewID']!="")
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
      <div style="clear:both"></div>
      <br/><br/><br/><br/><br/><br/><br/>

      <div class="footer">
        <p>&copy; Copyright 2013 blueprime analytics Inc. All Rights Reserved</p>
      </div>

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
    <script src="../assets3/js/bootstrap-transition.js"></script>
    <script src="../assets3/js/bootstrap-alert.js"></script>
    <script src="../assets3/js/bootstrap-modal.js"></script>
    <script src="../assets3/js/bootstrap-dropdown.js"></script>
    <script src="../assets3/js/bootstrap-scrollspy.js"></script>
    <script src="../assets3/js/bootstrap-tab.js"></script>
    <script src="../assets3/js/bootstrap-tooltip.js"></script>
    <script src="../assets3/js/bootstrap-popover.js"></script>
    <script src="../assets3/js/bootstrap-button.js"></script>
    <script src="../assets3/js/bootstrap-collapse.js"></script>
    <script src="../assets3/js/bootstrap-carousel.js"></script>
    <script src="../assets3/js/bootstrap-typeahead.js"></script>

  </body>
</html>
