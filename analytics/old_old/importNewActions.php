<?php
session_start();
echo "***** $_POST[filename] <br/>";
echo "***** $_SESSION[ProjectID] <br/>";
$ProjectID = $_SESSION['ProjectID'];
$row = 0;
if (($handle = fopen($_POST[filename] , "r")) !== FALSE) {
  include 'dbConn2.php';
    while (($data = fgetcsv($handle, 10000, ",")) !== FALSE) {
        $num = count($data);
        if ($row==0) {
          $sql = "DELETE FROM ProjectCapabilities WHERE ProjectID=".$_SESSION['ProjectID'];
          echo $sql."<br/>";
          $ret = mysql_query($sql) or die(mysql_error());
          $sql = "DELETE FROM CompanyCapabilities WHERE CompanyID IN (SELECT ID FROM ProjectCompanies WHERE ProjectID=".$_SESSION['ProjectID']. ")";
          echo $sql."<br/>";
          $ret = mysql_query($sql) or die(mysql_error());
          $sql = "DELETE FROM ProjectCompanies WHERE ProjectID=".$_SESSION['ProjectID'];
          echo $sql."<br/>";
          $ret = mysql_query($sql) or die(mysql_error());
          for ($c=0; $c < $num; $c++) {
            $Title="";
            $cap[$c]  = 0;
            if  ($_POST[$c]=='Capability') {
              $Title=str_replace("'","''",$data[$c]);
              $sql = "INSERT INTO ProjectCapabilities (ProjectID,Title) VALUES ($ProjectID,'$Title')";
              $ret = mysql_query($sql) or die(mysql_error());
              $cap[$c] = mysql_insert_id();
              echo "****## ". $c. " -- ". $cap[$c] . "<br/>";
            }
          }
        }
        else {
	  $Name="";
	  $Description="";
	  $Address="";
	  $City="";
	  $Province="";
	  $PostalCode="";
	  $Country="";
	  $Phone="";
	  $Fax="";
	  $Email="";
	  $Website="";
	  $NoEmployees="";
	  $Revenue="";
	  $Sector="";
        $LinkedInURL="";
        $FacebookURL="";
        $TwitterURL="";
        $NewsReleaseURL="";
        $OtherURL="";
        $ContactName="";
        $ContactTitle="";
        $ContactEmail="";
        $NAICS="";
          for ($c=0; $c < $num; $c++) {
          	if ($_POST[$c]=='Company Name')
          	  $Name=str_replace("'","''",$data[$c]);
          	if ($_POST[$c]=='Description')
          	  $Description=str_replace("'","''",$data[$c]);
          	if ($_POST[$c]=='Address')
          	  $Address=str_replace("'","''",$data[$c]);
          	if ($_POST[$c]=='City')
          	  $City=str_replace("'","''",$data[$c]);
            if ($_POST[$c]=='Province')
              $Province=str_replace("'","''",$data[$c]);
            if ($_POST[$c]=='Postal Code')
              $PostalCode=str_replace("'","''",$data[$c]);
            if ($_POST[$c]=='City,State')
            {
              $array = explode(',', $data[$c]);
              $City=str_replace("'","''",$array[0]);
              $Province=str_replace("'","''",$array[1]);
            }
            if ($_POST[$c]=='City,State,Zip')
            {
              $array = explode(',', $data[$c]);
              $City=str_replace("'","''",$array[0]);
              $Province=str_replace("'","''",$array[1]);
              $PostalCode=str_replace("'","''",$array[2]);
            }
          	if ($_POST[$c]=='Country')
          	  $Country=str_replace("'","''",$data[$c]);
          	if ($_POST[$c]=='Phone')
          	  $Phone=str_replace("'","''",$data[$c]);
          	if ($_POST[$c]=='Fax')
          	  $Fax=str_replace("'","''",$data[$c]);
          	if ($_POST[$c]=='Email')
          	  $Email=str_replace("'","''",$data[$c]);
          	if ($_POST[$c]=='Website')
          	  $Website=str_replace("'","''",str_replace("http://","",$data[$c]));
          	if ($_POST[$c]=='No Employees')
          	  $NoEmployees=str_replace("'","''",$data[$c]);
          	if ($_POST[$c]=='Revenue')
          	  $Revenue=str_replace("'","''",$data[$c]);
          	if ($_POST[$c]=='Sector')
          	  $Sector=str_replace("'","''",$data[$c]);
            if ($_POST[$c]=='LinkedIn URL')
              $LinkedInURL=str_replace("'","''",$data[$c]);
            if ($_POST[$c]=='Facebook URL')
              $FacebookURL=str_replace("'","''",$data[$c]);
            if ($_POST[$c]=='Twitter URL')
              $TwitterURL=str_replace("'","''",$data[$c]);
            if ($_POST[$c]=='News Release URL')
              $NewsReleaseURL=str_replace("'","''",$data[$c]);
            if ($_POST[$c]=='Other URL')
              $OtherURL=str_replace("'","''",$data[$c]);
            if ($_POST[$c]=='Contact Name')
              $ContactName=str_replace("'","''",$data[$c]);
            if ($_POST[$c]=='Contact Title')
              $ContactTitle=str_replace("'","''",$data[$c]);
            if ($_POST[$c]=='Contact Email')
              $ContactEmail=str_replace("'","''",$data[$c]);
            if ($_POST[$c]=='Capability')
              $Capability[$c]=str_replace("'","''",$data[$c]);
            if ($_POST[$c]=='NAICS')
              $NAICS=str_replace("'","''",$data[$c]);
           }
//           echo $Name. " ***** ". $Phone. " *** ". $Description."<br/>";
            $sql = "INSERT INTO ProjectCompanies (ProjectID,Name,Description,Address,City,State,PostalCode,Country,Phone,Fax,Email,Website,NoEmployees,Revenue,Industry,LinkedInURL,FacebookURL,TwitterURL,NewsReleaseURL,OtherURL,ContactName,ContactTitle,ContactEmail,NAICSCode) VALUES ($ProjectID,'$Name','$Description','$Address','$City','$Province','$PostalCode','$Country','$Phone','$Fax','$Email','$Website','$NoEmployees','$Revenue','$Sector','$LinkedInURL','$FacebookURL','$TwitterURL','$NewsReleaseURL','$OtherURL','$ContactName','$ContactTitle','$ContactEmail','$NAICS')";
//            echo $sql. "<br/><br/>";
            $ret = mysql_query($sql) or die(mysql_error());
            $CompanyID= mysql_insert_id();
            for ($c=0; $c < $num; $c++) {
              if ($cap[$c] >0) {
                $capID = $cap[$c];
                if ($Capability[$c] !=="") {
                  $capDetail = $Capability[$c];
                  $sql = "INSERT INTO CompanyCapabilities (CompanyID,CapabilityID,Details) VALUES ($CompanyID,$capID,'$capDetail')";
                  $ret = mysql_query($sql) or die(mysql_error());
                }
              }
            }
        }
        $row++;
    }
    fclose($handle);
}
else {
	echo "<br/>can't open the file.";
}
header("Location: view.php");
?>