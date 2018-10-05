<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nizar
Name:			      Kevin Astilla
Name:			      Nathan Morris
Description:  	Change Password File For Homes For Gnomes
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
      $email = "";
      $current_password = "";
      $new_password = "";
      $confirm_new_password = "";
      $error = "";
      $output = "";

      if(isPost())
      {
          //trim the user input
  		$login = trim($_POST["login"]);
  		$password = trim($_POST["pass"]);
          $confirmPass = trim($_POST["cpass"]);
          // $firstname = trim($_POST["first_name"]);
          // $lastname = trim($_POST["last_name"]);
          $email = trim($_POST["email_address"]);

          //check if everything was entered
  		if ($login == "") $error .= "<br/>No user ID entered";
  		//if an existing record has the same id
          elseif (userExists($login))
  		{
              $error .= "<br/>A user with that ID already exists";
              $login = "";
          }
          else
          {
              $error .= LengthValidation("id",$login);
  			if(LengthValidation("id",$login) <> "") $login = "";
          }
  		if ($password == "") $error .= "<br/>No user password entered";
          else
  		{
  			$error .= LengthValidation("pass",$password);
  		}
  		if (strcmp($confirmPass, $password) <> 0) $error .= "<br/>Your two password entries do not match";
          if ($email == "") $error .= "<br/>You did not enter your email address";
          else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
          {
              $error .= "<br/>Email address is not valid";
              $email = "";
          }
          else
  		{
  			$error .= LengthValidation("email",$email);
  			if(LengthValidation("email",$email) <> "") $email = "";
  		}

          //if no errors
          if($error === "")
          {
              $password = md5($password);
              $today = date("Y-m-d",time());
              $conn = db_connect();
              if(isset($_POST["IsAgent"]) == true)
              {
                  $userType = "a";
              }
              else
              {
                  $userType = "c";
              }
              $sql = "INSERT INTO users(user_id, password, user_type, email_address, enrol_date, last_access)
              VALUES ('".$login."','".$password."','".$userType."','".$email."', '".$today."', '".$today."')";
              $result = pg_query($conn, $sql);
              $output .= "Registration complete";
              header("Location:login.php");
              ob_flush();
          }
      }
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
                  <label>Email</label>
                  <input type="text" class="form-control" name="email" value="<?php echo $email ?>" placeholder="Enter Email Address">
              </div>
              <div class="form-group">
                  <label>Password</label>
                  <input type="password" class="form-control" name="pass" placeholder="Enter Current Password">
              </div>
              <div class="form-group">
                  <label>Current Password</label>
                  <input type="password" class="form-control" name="cpass" placeholder="Confirm Password">
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-outline-success" style="width:33%; margin-right: 33%;">Submit</button>
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
