<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nazir
Name:			Kevin Astilla
Name:			Nathan Morris
Description:  	Login File For Homes For Gnomes
Date:         	28 September 2018
*/
  $title = "WEBD2201 - Web Development - Intermediate";
  $date = "02 October 2018";
  $file = "login.php";
  $banner = "Login Page";
  $description = "This page will be a log in page for the website.";

require("header.php");

//empty out error and result regardless of method that got you here
$error = "";
$output = "";
$conn = "";
$login = "";
$pass = "";



if(isPost()){
//the page got here from submitting the forms
    $login = trim($_POST["user_id"]);
    $pass = trim($_POST["passwd"]);

    //if user didn't enter anything in field
    if(!isset($login) || $login == ""){
    //means the user did not enter anything
    $error .= "<br/>You did not enter a User ID."; //set error
    $login = "";
    }
    //else if login is too short
    else if (strlen($login) < MINIMUM_ID_LENGTH) {
        $error .= "<br/>The username must be at least 5 characters, ".$login." is not long enough."; //set error
        $login = "";
    }
    //else if login is too long
    else if (strlen($login) >= MAXIMUM_ID_LENGTH) {
        $error .= "<br/>The username must be less than 20 characters, ".$login." is too long."; //set error
        $login = "";
    }

    //if password has no input in field
    if(!isset($pass) || $pass == ""){
		//means the user did not enter anything
		$error .= "<br/>You must enter an password."; //set error
	}
    //else if password is too short
    else if(strlen($pass) < MINIMUM_PASSWORD_LENGTH){
        $error .= "<br/>The password you entered must be at least 6 characters."; //set error
    }
    //else if password is too long
    else if(strlen($pass) > MAXIMUM_PASSWORD_LENGTH){
        $error .= "<br/>The password you entered must be less than or equal to 15."; //set error
    }

    if($error == ""){  //if error is an empty string, meaning there are no errors with the input
        $conn = db_connect();
        //Check if user exists in database
        if (userExists($login)){
            $_SESSION['userID'] = $login;
            //if user confirmed to exist, check if password is correct
            if (pg_num_rows(login($login,$pass)) > 0)       // match found
            {
                $accountInfo = pg_fetch_assoc(login($login,$pass));
                //$personalInfo = pg_fetch_assoc(personalInformation($login));
                //$userInfo = array_merge($accountInfo,$personalInfo);

                updateLastAccess($conn);
                //$sql = "UPDATE users SET last_access = '". date("Y-m-d", time()) . "' WHERE user_id = '".$login."'";

				$update = pg_query($conn, $sql);
                $_SESSION['userType'] = $accountInfo["user_type"];
                $_SESSION['emailAddress'] = $accountInfo["email_address"];
                $_SESSION['last_access'] = $accountInfo["last_access"];
                /*$_SESSION['salutation'] = $userInfo["salutation"];
                $_SESSION['firstName'] = $userInfo["first_name"];
                $_SESSION['lastName'] = $userInfo["last_name"];
                $_SESSION['streetAddress1'] = $userInfo["street_address1"];
                $_SESSION['streetAddress2'] = $userInfo["street_address2"];
                $_SESSION['city'] = $userInfo["city"];
                $_SESSION['province'] = $userInfo["province"];
                $_SESSION['postalCode'] = $userInfo["postal_code"];
                $_SESSION['primaryPhoneNumber'] = $userInfo["primary_phone_number"];
                $_SESSION['secondaryPhoneNumber'] = $userInfo["secondary_phone_number"];
                $_SESSION['faxNumber'] = $userInfo["fax_number"];
                $_SESSION['preferredContactMethod'] = $userInfo["preferred_contact_method"];*/

                // if user selected to remember credentials then create cookies
                if(isset($_POST["remember"]) == true)
                {
                    setcookie('username',$login,COOKIE_LIFESPAN);
                    setcookie('password',$pass,COOKIE_LIFESPAN);
                }
                //redirect to appropriate page
                if($_SESSION['userType'] == 's'){header("Location:admin.php");}
                else if($_SESSION['userType'] == 'a'){header("Location:dashboard.php");}
                else if($_SESSION['userType'] == 'c'){header("Location:welcome.php");}
                ob_flush();
            }
            else {
                $error .= "<br/>Password does not match any records";
            }
        }
        else {
            $error .= "<br/>User not found";
        }
    }

    if ($error != ""){ //else... if there was an error
        $error .= "<br/>Please Try Again"; //there were problems, concatentate the TRY AGAIN message
        $output .= $error; //make output equal to error
    }
}
?>
<!-- Start of Main Page Content -->

<div class="container">
    <div class="row" style="margin-top:75px">
        <div class="col"></div>
        <div class="col-8">
            <?php echo $error;
            if(isset($_COOKIE['username']) && isset($_COOKIE['password']))
            {
                $userID = $_COOKIE['username'];
                $password = $_COOKIE['password'];
            }
            else {
                $userID ="";
                $password="";
            }?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Login Information</h5>
                    <hr/>
                    <form method="post" action="<?php sticky();?>" >
                        <div class="form-group">
                            <label>User ID</label>
                            <input type="text" class="form-control" name="user_id" value="<?php echo $userID; ?>"
                            placeholder="User ID">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="passwd" value="<?php echo $password; ?>"
                            placeholder="Password">
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="remember">
                            <label class="form-check-label">Remember Me</label>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-success" style="width:33%; margin-right: 33%;">Login</button>
                            <button type="reset" class="btn btn-outline-success" style="width:33%;">Clear</button>
                        </div>
                        <!-- End of Form -->
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
