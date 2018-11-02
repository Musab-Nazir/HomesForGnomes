<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nizar
Name:			      Kevin Astilla
Name:			      Nathan Morris
Description:  	Dashboard File For Homes For Gnomes
Date:         	28 September 2018
*/
  $title = "WEBD2201 - Web Development - Fundamentals";
  $date = "12 April 2018";
  $file = "template.php";
  $banner = "Dashboard";
  $description = "This page will be a log in page for the website and a new functions.php file will contain some shared functions for use throughout the website.";

require "header.php";
// If the session was never set with a user id
if($_SESSION['userType'] != a)
{
    $_SESSION['RedirectError'] = "You were not logged in as an Agent<br/>";
    header("Location:login.php");
}
?>
  <!-- start of main page content -->

  <div class="container">
      <div class="row">
            <div class="col"></div>
            <div class="col-6">
                <br/>
                <h2>Dashboard</h2>
                <p>Welcome back <?php echo $_SESSION['userID']; ?> you last logged in on <?php echo $_SESSION['last_access']; ?></p>
            </div>
            <div class="col"></div>
        </div>
  </div>

  <!-- end of main page content -->

<!-- Footer Start -->
<?php
  include 'footer.php'
?>
<!-- Footer End -->
