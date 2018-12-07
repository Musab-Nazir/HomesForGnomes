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
  $file = "password-request.php";
  $banner = "Request Password Page";
  $description = "This page will generate a new password and email it to the user if user exists.";

require("header.php");

//empty out error and result regardless of method that got you here
$error = "";
$output = "";
$conn = "";
$login = "";
// $userMessage = "";

if(isPost()){
  unset($_SESSION['RedirectError'];

  $login = trim($_POST["user_id"]);

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

  if($error == ""){  //if error is an empty string, meaning there are no errors with the input
      $conn = db_connect();
      //Check if user exists in database
      if (userExists($login)){
          $_SESSION['userID'] = $login;

          $emailAddress = pg_fetch_assoc(userEmail($userId));
          $tempPassword = RandomString(); //Generates new password

        //  $userMessage = $emailAddress . "\n" . $tempPassword;
      }
  }
  else {
      $error .= "<br/>User NOT found";
      $_SESSION['RedirectError'] = "User does NOT exist.<br/>";
  }
    // $to = $email;
    // $subject = 'Password Request';
    // $message = "Hello ".$_SESSION['userID']." your new temporary password is: ".echo $randstring.".\nPlease make sure to change your password to something you can remember.";
    // $headers = 'From: help@homesforgnomes.com' . "\r\n" . phpversion();
    //
    // mail($to, $subject, $message, $headers); //send email

    //update database with new password so user can log in
    // $sql = "UPDATE users SET password = ". echo $randstring ." WHERE user_id = '".$_SESSION['userID']."'";

   //Display message that password was changed successfully

   //Provide link to login
    //redirect user to login page
    //header( "Location:login.php" );
    //ob_flush();
// }
// else //user does NOT exist
// {
//  $_SESSION['RedirectError'] = "User does NOT exist.<br/>";
  // header("Location:login.php");
// }
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
            // if(isset($userMessage)
            // {
            //     echo $userMessage;
            // }
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
                    <label>Enter User ID</label>
                    <input type="text" class="form-control" name="user_id" value="<?php echo $userID; ?>"
                    placeholder="User ID">
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <button type="submit" class="btn btn-outline-success" style="width:80px;">Reset</button>
                    </div>
                    <div>
                        <button type="reset" class="btn btn-outline-success" style="width:80px;">Clear</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col"></div>
    </div>
</div>
<!-- End of Form -->
<!-- Footer Start -->
<?php
  include 'footer.php'
?>
<!-- Footer End -->
