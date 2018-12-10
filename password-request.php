<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nazir
Name:		       	Kevin Astilla
Name:		        Nathan Morris
Description:  	Request Password For Homes For Gnomes
Date:         	07 December 2018
*/
require("header.php");

//empty out error and result regardless of method that got you here
$error = "";
$output = "";
$conn = "";
$userID = "";
// $userMessage = "";

if(isPost()){
  $_SESSION['RedirectError'] = "";

  $userID = trim($_POST["user_id"]);

  //if user didn't enter anything in field
  if(!isset($userID) || $userID == ""){
  //means the user did not enter anything
  $error .= "<br/>You did not enter a User ID."; //set error
  $userID = "";
  }
  //else if login is too short
  else if (strlen($userID) < MINIMUM_ID_LENGTH) {
      $error .= "<br/>The username must be at least 5 characters, ".$userID." is not long enough."; //set error
      $userID = "";
  }
  //else if login is too long
  else if (strlen($login) >= MAXIMUM_ID_LENGTH) {
      $error .= "<br/>The username must be less than 20 characters, ".$userID." is too long."; //set error
      $userID = "";
  }
  if (!(userExists($userID))){  //Check if user does not exist in database
    $error .= "<br/>The username entered does NOT exist."; //set error
    $userID = "";
  }

  if($error == ""){  //if error is an empty string, meaning there are no errors with the input
    //   $conn = db_connect();

    $temp_password = generateRandomString(); //Generates new password
    $new_password = hash("md5",$temp_password); //Hashes the new password
    $sql = "UPDATE users SET password = '".$new_password."' WHERE user_id = '".$userID."'";
    $update = pg_query(db_connect(), $sql);
    $output .= "A temporary password has been emailed to you. <br /> Please check your email and sign in once you are ready.<br/>";

    //$output .= "<br />MADE IT TO OUTPUT<br />";
    $output .= "<br /> TESTING PURPOSES: ".$temp_password."<br />";
    $output .= "<br /> (HASHED) TESTING PURPOSES: ".$new_password."<br />";

  }
  else {
      $error .= "<br/>User NOT found";
      $_SESSION['RedirectError'] = "User does NOT exist.<br/>";
  }
    $to = $email;
    $subject = 'Password Request';
    $message = "Hello ".$_SESSION['userID']." your new temporary password is: ".echo $randstring.".\nPlease make sure to change your password to something you can remember.";
    $headers = 'From: help@homesforgnomes.com' . "\r\n" . phpversion();

    mail($to, $subject, $message, $headers); //send email
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
            echo $output;
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
