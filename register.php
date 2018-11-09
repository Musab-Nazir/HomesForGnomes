<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nazir
Name:			Kevin Astilla
Name:			Nathan Morris
Description:  	Register File For Homes For Gnomes
Date:         	09 November 2018
*/
  $title = "WEBD3201 - Web Development - Intermediate";
  $date = "09 November 2018";
  $file = "Register.php";
  $banner = "Registration Page";
  $description = "This page will be a log in page for the website and a new functions.php file will contain some shared functions for use throughout the website.";

require "header.php";

if(isset($_SESSION['userType']))
{
    $_SESSION['RedirectError'] = "You are currently logged in. Cannot create new user<br/><br/>";
    header("Location:update.php");
}
$login = "";
$password = "";
$confirmPass = "";
$salutation = "";
$firstname = "";
$lastname = "";
$userType = "";
$email = "";
$streetAddress1 = "";
$streetAddress2 = "";
$city = "";
$postalCode = "";
$province = "";
$primaryPhone = "";
$secondaryPhone = "";
$faxNumber = "";
$contactMethod = "";
$error = "";
$output = "";

    if(isPost())
    {
        //trim the user input
		$login = trim($_POST["login"]);
		$password = trim($_POST["pass"]);
        $confirmPass = trim($_POST["cpass"]);
        $salutation = trim($_POST["salutations"]);
        $firstname = trim($_POST["first_name"]);
        $lastname = trim($_POST["last_name"]);
        $email = trim($_POST["email_address"]);
        $streetAddress1 = trim($_POST["street_address1"]);
        $streetAddress2 = trim($_POST["street_address2"]);
        $city = trim($_POST["city"]);
        $province = trim($_POST["provinces"]);
        $postalCode = trim($_POST["postal_code"]);
        $primaryPhone = CleanPhoneNumber(trim($_POST["primary_phone"]));
        $secondaryPhone = CleanPhoneNumber(trim($_POST["secondary_phone"]));
        $faxNumber = CleanPhoneNumber(trim($_POST["fax_number"]));
        $contactMethod = trim($_POST["preferred_contact_method"]);
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

		if ($firstname == "") $error .= "<br/>You did not enter your first name";
        elseif (is_numeric($firstname))
        {
            $error .= "<br/>First name cannot be a number";
            $firstname = "";
        }
        else
        {
            $error .= LengthValidation("fname",$firstname);
			// if length was not validated, reset variable
			if(LengthValidation("fname",$firstname) <> "") $firstname = "";
        }
        if ($lastname == "") $error .= "<br/>You did not enter your last name";
        elseif (is_numeric($lastname))
        {
            $error .= "<br/>Last name cannot be a number";
            $lastname = "";
        }
        else {
            $error .= LengthValidation("lname",$lastname);
			if(LengthValidation("lname",$lastname) <> "") $lastname = "";
        }
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
        if(isset($postalCode) && !isValidPostalCode($postalCode))
        {
            $error .= "<br/>Invalid Postal Code";
        }
        if  ($primaryPhone == "") $error .= "<br/>You did not enter your primary phone number";
        else if(!isValidPhoneNumber($primaryPhone))
        {
            $error .= "<br/>Phone number is in invalid format. Please retry";
            $error .= $primaryPhone;
        }
        // else {
        //     $error .= LengthValidation("phone",$primaryPhone);
        //     if(LengthValidation("phone",$primaryPhone) <> "") $primaryPhone = "";
        // }

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
            //create thwe username and password
            $sql = "INSERT INTO users(user_id, password, user_type, email_address, enrol_date, last_access)
            VALUES ('".$login."','".$password."','".$userType."','".$email."', '".$today."', '".$today."')";
            $result = pg_query($conn, $sql);

            $personsSql = "INSERT INTO persons(user_id, salutation, first_name, last_name , street_address1, street_address2, city, province, postal_code, primary_phone_number, secondary_phone_number, fax_number, preferred_contact_method)
            VALUES ('".$login."','".$salutation."','".$firstname."','".$lastname."','".$streetAddress1."','".$streetAddress2."','".$city."','".$province."','".$postalCode."','".$primaryPhone."','".$secondaryPhone."','".$faxNumber."','".$contactMethod."')";
            $personsResult = pg_query($conn,$personsSql);

            $output .= "Registration complete";
            header("Location:login.php");
            ob_flush();
        }
    }
?>
  <!-- start of main page content -->
<div class="container">
  <div class="row" style="margin-top:75px">
    <div class="col"></div>
    <div class="col-8">
        <br/>
        <?php echo $error; ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Login Information</h5>
                <hr/>
                <form method="post" action="<?php sticky();?>" >

                    <div class="form-group">
                        <input type="text" class="form-control" name="login" value="<?php echo $login ?>" placeholder="Enter User ID">
                        <br/>
                        <input type="password" class="form-control" name="pass" placeholder="Enter Password" id="halfBoxL">
                        <input type="password" class="form-control" name="cpass" placeholder="Confirm Password" id="halfBoxR">
                        <br/>
                        <input type="text" class="form-control" name="email_address" value="<?php echo $email; ?>" placeholder="Enter Email Address">
                    </div>
                    <!--personal information section-->
                    <h5 class="card-title">Personal Information</h5>
                    <hr/>
                    <div class="form-group">

                        <!--Insert Salutation -->
                        <label>Salutation:</label>
                        <?php echo (build_simple_dropdown("salutations","$salutation"));?>
                        <br/><br/>
                        <!-- <label>First Name</label> -->
                        <input type="text" class="form-control" name="first_name" value="<?php echo $firstname; ?>" placeholder="Enter First Name" id="halfBoxL">

                        <!-- <label>Last Name</label> -->
                        <input type="text" class="form-control" name="last_name" value="<?php echo $lastname; ?>" placeholder="Enter Last Name" id="halfBoxR">
                        <br/>
                        <!--Ins Address -->
                        <label>Address Information</label>
                        <input type="text" class="form-control" name="street_address1" value="<?php echo $streetAddress1; ?>" placeholder="Street Address #1">
                        <br/>
                        <input type="text" class="form-control" name="street_address2" value="<?php echo $streetAddress2; ?>" placeholder="Street Address #2">
                        <br/>
                        <label>City</label>
                        <?php echo (build_dropdown("city","$city"));?>
                        <div style="width:200px; display:inline-block;"></div>
                        <label>Province</label>
                        <?php echo (build_simple_dropdown("provinces","$province"));?>
                        <br/>
                        <input type="text" class="form-control" name="postal_code" value="<?php echo $postalCode; ?>" placeholder="Postal Code">
                        <!--Contact Information-->
                        <br/>
                        <input type="text" class="form-control" name="primary_phone" value="<?php echo $primaryPhone; ?>" placeholder="Primary phone number" id="halfBoxL">
                        <input type="text" class="form-control" name="secondary_phone" value="<?php echo $secondaryPhone; ?>" placeholder="Secondary phone number" id="halfBoxR">
                        <input type="text" class="form-control" name="fax_number" value="<?php echo $faxNumber; ?>" placeholder="Fax Number">
                        <br/>
                        <?php echo(build_radio("preferred_contact_method","$contactMethod")); ?>
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
            </div>
        </div>

        <br/>
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
