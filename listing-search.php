<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nizar
Name:			      Kevin Astilla
Name:			      Nathan Morris
Description:  	Search Listings File For Homes For Gnomes
Date:         	28 September 2018
*/
  $title = "WEBD2201 - Web Development - Fundamentals";
  $date = "12 April 2018";
  $file = "template.php";
  $banner = "Lab 9: Database/PHP Lab - User Login";
  $description = "This page will be a log in page for the website and a new functions.php file will contain some shared functions for use throughout the website.";

require "header.php";
//declare all variables
$login = "";
$password = "";
$confirmPass = "";
// $firstname = "";
// $lastname = "";
$userType = "";
$email = "";
$error = "";
$output = "";
?>
<!-- start of main page content -->
<div class="container" style="height:100vh">
<div class="row" style="margin-top:75px">
  <div class="col"></div>
  <div class="col-6">
      <br/>
      <?php echo $error; ?>

      <form method="post" action="<?php sticky();?>" >
          <div class="form-group">
              <label>User ID</label>
              <input type="text" class="form-control" name="login" value="<?php echo $login ?>" placeholder="Enter User ID">
          </div>
          <div class="form-group">
              <label>Password</label>
              <input type="password" class="form-control" name="pass" placeholder="Enter Password">
              <label>Confirm Password</label>
              <input type="password" class="form-control" name="cpass" placeholder="Confirm Password">
          </div>
          <div class="form-group">
              <label>Email address</label>
              <input type="text" class="form-control" name="email_address" value="<?php echo $email; ?>"
              placeholder="Enter Email Address">
          </div>
          <div class="form-check">
              <input type="checkbox" class="form-check-input" name="IsAgent">
              <label class="form-check-label">Make an Agent account?</label>
              <hr/>
          </div>
          <div class="form-group">
              <button type="submit" class="btn btn-outline-success" style="width:33%; margin-right: 33%;">Register</button>
              <button type="reset" class="btn btn-outline-success" style="width:33%;">Clear</button>
          </div>
      </form>
      <hr/>
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
