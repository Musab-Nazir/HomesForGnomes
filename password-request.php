<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nazir
Name:			      Kevin Astilla
Name:		       	Nathan Morris
Description:  	Request Password For Homes For Gnomes
Date:         	07 December 2018
*/
  $title = "WEBD3201 - Web Development - Intermediate";
  $date = "07 December 2018";
  $file = "request-password.php";
  $banner = "Request Password Page";
  $description = "This page will generate a new password and email it to the user if user exists.";

require("header.php");

if (pg_num_rows(login($login,$pass)) > 0)  // match found (user exists in table)
{

}
else //user does NOT exist
{
  $_SESSION['RedirectError'] = "User does NOT exist.<br/>";
  header("Location:login.php");
}

?>
<!-- Footer Start -->
<?php
  include 'footer.php'
?>
<!-- Footer End -->
