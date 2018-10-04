<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nazir
Name:			      Kevin Astilla
Name:			      Nathan Morris
Description:  	Login File For Homes For Gnomes
Date:         	28 September 2018
*/
$title = "WEBD2201 - Web Development - Intermediate";
$date = "02 October 2018";
$file = "logout.php";
$banner = "";
$description = "This page will be a logout page for the website and will redirect the user to the homepage.";

require "header.php";
?>
<!-- Start of Main Page Content -->
<?php

if (isset($_SESSION)){
  session_destroy();
}
?>
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-6">
            <br />
            <p>
              You have successfully logged out. Please click <a href="index.php">here</a>.
            </p>
        </div>
        <div class="col"></div>
    </div>
</div>
<?php
header( "Location:index.php" );
ob_flush();
?>

<!-- End of main page content -->

<!-- Footer Start -->
<?php
  include 'footer.php'
?>
<!-- Footer End -->
