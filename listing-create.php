<?php
/*
Name:           Ramandeep Rathor
Name:           Musab Nizar
Name:                 Kevin Astilla
Name:                 Nathan Morris
Description:    Create Listing File For Homes For Gnomes
Date:           28 September 2018
*/
  $title = "WEBD2201 - Web Development - Fundamentals";
  $date = "12 April 2018";
  $file = "template.php";
  $banner = "Lab 9: Database/PHP Lab - User Login";
  $description = "This page will be a log in page for the website and a new functions.php file will contain some shared functions for use throughout the website.";

require "header.php";
//if(!isset($_SESSION['userType']) or $_SESSION['userType'] != a)
  //  {header("Location:login.php");}
    //declare all variables

    $login = ""; //$_SESSION["userID"]
    $headline = "";
    $description = "";
    $postalCode = "";
    $price = "";
    $bedroom = "";
    $bathroom = "";
    $userType = ""; 
    $city = "";
    $province = "";
    $listingStatus =  "";

    $error = "";
    $output = "";


    if(isPost())
    {
        $headline = trim($_POST["headline"]);
        $description = trim($_POST["description"]);
        $postalCode = trim($_POST["postal_code"]);
        $price = trim($_POST["price"]);
        $bedroom = trim($_POST["bedroom"]);
        $bathroom = trim($_POST["bathroom"]); 
        $city = trim($_POST["city"]);
        $province = trim($_POST["provinces"]);
        $listingStatus = trim($_POST["listing_status"]);
        $error = "";
        $output = "";
        //trim the user input

        //check if everything was entered
        if ($headline == "") $error .= "<br/>No headline was entered";
        elseif (is_numeric($headline))
        {
            $error .= "<br/>headline cannot be a number";
            $firstname = "";
        }
        //if an existing record has the same id
        else
        {
            $error .= LengthValidation("id",$login);
            if(LengthValidation("id",$login) <> "") $login = "";
        }
        if ($description == "") $error .= "<br/>No description was entered";
        else
        {
            //$error .= LengthValidation("pass",$password);
        }

        if ($postalCode == "") $error .= "<br/>You did not enter a postal code";
        elseif (is_numeric($firstname))
        {
            $error .= "<br/>First name cannot be a number";
            $firstname = "";
        }
        if ($price == "") $error .= "<br/>No price was entered";
        else
        {
            //$error .= LengthValidation("pass",$password);
        }
        

        //if no errors
        if($error === "")
        {

            $conn = db_connect();

            $sql = "INSERT INTO listings(user_id, status, status, price, headline, description, postal_code, images, city, property_options, bedrooms, bathrooms)
            VALUES ('".$login."', '".$listingStatus."','".$price."','".$headline."', '".$description."','".$postalCode."','".$images."', '".$city."','".$propertyOptions."','".$bedrooms."', '".$bathrooms."')";
            $result = pg_query($conn, $sql);

            $output .= "Registration for listing complete complete";
            header("Location:listing-display.php");
            ob_flush();
        }
    }
?>

  <div class="container">
  <div class="row" style="margin-top:75px">
    <div class="col"></div>
    <div class="col-6">
        <br/>
        <?php echo $error; ?>

        <form method="post" action="<?php sticky();?>" >
            <div class="form-group">
                <label>Headline</label>
                <input type="text" class="form-control" name="login" value="<?php echo $headline ?>">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" maxlength="1000" rows="5" id="description"></textarea>
            </div>
            <label>City</label>
            <?php echo (build_dropdown("city","$city"));?>
            <div class="form-group">
                <label>Postal Code</label>
                <input type="text" id="halfBoxR" class="form-control" name="login" value="<?php echo $postalCode ?>" placeholder="A1A1A1">
            </div>
            <div class="form-group">
                <label>Bedroom</label>
                <input type="text" id="halfBoxR" class="form-control" name="login" value="<?php echo $bedroom ?>" placeholder="">
            </div>
            
            <div class="form-group">
                <label>Price</label>
                <input type="text" id="halfBoxR" class="form-control" name="login" value="<?php echo $price ?>" placeholder="">
            </div>
            <!--personal information section-->
            <?php echo (build_radio("listing_status","$listingStatus"));?>
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

<!-- Footer Start -->
<?php
  include 'footer.php'
?>
<!-- Footer End -->
