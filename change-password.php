<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nizar
Name:			      Kevin Astilla
Name:			      Nathan Morris
Description:  	Change Password File For Homes For Gnomes
Date:         	28 September 2018
*/
  $title = "Homes for Gnomes - Change Password";
  $date = "2nd Nov 2018";
  $file = "change-password.php";
  $banner = "Change Password";

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
    $login = $_SESSION['userID'];
    $confirm_new_password = $_POST['cNewPass'];
    $new_password = $_POST['newPass'];
    $current_password = $_POST['pass'];
    //if password has no input in field
    if(!isset($current_password) || $current_password == ""){
		//means the user did not enter anything
		$error .= "<br/>You must enter the current password."; //set error
	}
    if(!isset($new_password) || $new_password == ""){
		//means the user did not enter anything
		$error .= "<br/>You must enter a new password."; //set error
	}
    if(!isset($confirm_new_password) || $confirm_new_password == ""){
		//means the user did not enter anything
		$error .= "<br/>You must enter an confirmed new password."; //set error
	}
    //else if password is too short
    else if(strlen($confirm_new_password) < MINIMUM_PASSWORD_LENGTH){
        $error .= "<br/>The password you entered must be at least 6 characters."; //set error
    }
    //else if password is too long
    else if(strlen($confirm_new_password) > MAXIMUM_PASSWORD_LENGTH){
        $error .= "<br/>The password you entered must be less than or equal to 15."; //set error
    }
    elseif (if (strcmp($confirmPass, $password) <> 0){
        $error .= "<br/>New passwords don't match";
    }

    if (pg_num_rows(login($_SESSION['userID'],$current_password)) > 0)       // match found
    {
        if($error == "")
        {
            $new_password = hash("md5",$new_password);
            //update password field
            $sql = "UPDATE users SET password = '".$new_password."' WHERE user_id = '".$login."'";
            $update = pg_query(db_connect(), $sql);
            $output .= "Password Updated<br/>";
        }
    }
    elseif($current_password != "") {
        $error .= "Current password provided is invalid<br/>";
    }
}

if(!isset($_SESSION['userType'])){header("Location:login.php");}
?>
<div class="container" style="height:100vh">
    <div class="row" style="margin-top:75px">
        <div class="col"></div>
        <div class="col-6">
            <?php echo $error; echo $output;?>
            <form method="post" action="<?php sticky();?>" >
                <div class="form-group">
                    <label>Current Password</label>
                    <input type="password" class="form-control" name="pass" placeholder="Enter Current Password">
                </div>
                <div class="form-group">
                    <label> New Password</label>
                    <input type="password" class="form-control" name="newPass" placeholder="Enter New Password">
                </div>
                <div class="form-group">
                    <label> Confirm New Password</label>
                    <input type="password" class="form-control" name="cNewPass" placeholder="Confirm New Password">
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
