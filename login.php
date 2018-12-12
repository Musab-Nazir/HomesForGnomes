<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nazir
Name:			      Kevin Astilla
Name:		       	Nathan Morris
Description:  	Login File For Homes For Gnomes
Date:         	28 September 2018
*/

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
                $personalInfo = pg_fetch_assoc(personalInformation($login));
                $userInfo = array_merge($accountInfo,$personalInfo);

                //updateLastAccess($conn);
                $sql = "UPDATE users SET last_access = '". date("Y-m-d", time()) . "' WHERE user_id = '".$login."'";

				        $update = pg_query($conn, $sql);
                //load the session
                LoadSession($userInfo);

                // if user selected to remember credentials then create cookies
                if(isset($_POST["remember"]) == true)
                {
                    setcookie('username',$login,COOKIE_LIFESPAN);
                    setcookie('password',$pass,COOKIE_LIFESPAN);
                }
                //redirect to appropriate page
                if($_SESSION['userType'] == 'd'){header("Location:aup.php");}
                else if($_SESSION['userType'] == 'p'){
                    header("Location:login.php"); $_SESSION['RedirectError'] = 'Your account has to be approved by an Admin';
                }
                else if($_SESSION['userType'] == 's'){header("Location:admin.php");}
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

<div class="container" style="height:100vh">
    <div class="row" style="margin-top:75px">
        <div class="col"></div>
        <div class="col-6">
            <?php echo $error;
            if(isset($_SESSION['RedirectError']))
            {
                echo $_SESSION['RedirectError'];
            }
            if(isset($_COOKIE['username']) && isset($_COOKIE['password']))
            {
                $userID = $_COOKIE['username'];
                $password = $_COOKIE['password'];
            }
            else {
                $userID ="";
                $password="";
            }?>
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
                    <table width="100%">
                      <tr>
                        <td>
                          <input type="checkbox" class="form-check-input" name="remember">
                    <label class="form-check-label">Remember Me</label>
                  </td>
                  <td align="right">
                    <a href="password-request.php">Forgot Password<a/>
                  </td>
                </tr>
              </table>
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-outline-success" style="width:80px;">Login</button>
                    </div>
                    <div>
                        <button type="reset" class="btn btn-outline-success" style="width:80px;">Clear</button>
                    </div>
                    <!-- <div> -->
                        <!-- <button type="button" class="btn btn-outline-success" style="width:160px;"></button> -->
                    <!-- </div> -->
                </div>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>
<!-- End of Form -->

<!-- end of main page content -->

<!-- Footer Start -->
<?php
  include 'footer.php'
?>
<!-- Footer End -->
