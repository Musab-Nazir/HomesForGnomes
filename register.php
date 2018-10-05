<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nazir
Name:			      Kevin Astilla
Name:			      Nathan Morris
Description:  	Register File For Homes For Gnomes
Date:         	28 September 2018
*/
  $title = "WEBD2201 - Web Development - Fundamentals";
  $date = "12 April 2018";
  $file = "template.php";
  $banner = "Registration Page";
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
		// if ($firstname == "") $error .= "<br/>You did not enter your first name";
        // elseif (is_numeric($firstname))
        // {
        //     $error .= "<br/>First name cannot be a number";
        //     $firstname = "";
        // }
        // else
        // {
        //     $error .= LengthValidation("fname",$firstname);
		// 	// if length was not validated, reset variable
		// 	if(LengthValidation("fname",$firstname) <> "") $firstname = "";
        // }
        // if ($lastname == "") $error .= "<br/>You did not enter your last name";
        // elseif (is_numeric($lastname))
        // {
        //     $error .= "<br/>Last name cannot be a number";
        //     $lastname = "";
        // }
        // else {
        //     $error .= LengthValidation("lname",$lastname);
		// 	if(LengthValidation("lname",$lastname) <> "") $lastname = "";
        // }
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
                <label>Password</label>
                <input type="password" class="form-control" name="pass" placeholder="Enter Password">
                <label>Confirm Password</label>
                <input type="password" class="form-control" name="cpass" placeholder="Confirm Password">
            </div>
            <div class="form-group">
                <!-- <label>First Name</label>
                <input type="text" class="form-control" name="first_name" value="<?php echo $firstname; ?>"
                placeholder="Enter First Name">

                <label>Last Name</label>
                <input type="text" class="form-control" name="last_name" value="<?php echo $lastname; ?>"
                placeholder="Enter Last Name"> -->

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
