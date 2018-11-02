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

    $property_type = "";
    $flooring = "";
    $parking = "";
    $building_type = "";
    $basement_type = "";
    $interior_type = "";


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

        $property_type = trim($_POST["property_type"]);
        $flooring = trim($_POST["property_flooring"]);
        $parking = trim($_POST["property_parking"]);
        $building_type = trim($_POST["property_building_type"]);
        $basement_type = trim($_POST["property_basement_type"]);
        $interior_type = trim($_POST["property_interior_type"]);

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
        if (preg_match(PRICE_FILTER, $price) == '0') $error .= "<br/>No price was entered";


        //if no errors
        if($error === "")
        {

            $conn = db_connect();

            $sql = "INSERT INTO listings(user_id, status, status, price, headline, description, postal_code, images, city, property_options, bedrooms, bathrooms, property_type, flooring, parking, building_type, basement_type, interior_type)
            VALUES ('".$login."', '".$listingStatus."','".$price."','".$headline."', '".$description."','".$postalCode."','".$images."', '".$city."','".$propertyOptions."','".$bedrooms."', '".$bathrooms."', '".$property_type."', '".$flooring."', '".$parking."', '".$building_type."', '".$basement_type."', '".$interior_type."')";

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
                <input type="text" class="form-control" name="headline" value="<?php echo $headline ?>">
                <br/>
                <label>Description</label>
                <textarea class="form-control" name="description" maxlength="1000" rows="5" id="description"></textarea>
                <br/>
                <label>City</label>
                <?php echo (build_dropdown("city","$city"));?>
                <label>Provinces</label>
                <?php echo (build_simple_dropdown("provinces","$provinces")); ?>
                <br/>
                <label>Postal Code</label>
                <input type="text" id="halfBoxR" class="form-control" name="postal_code" value="<?php echo $postalCode ?>">
                <br/>
                <label>Bedroom count</label>
                <input type="text" id="halfBoxR" class="form-control" name="bedroom" value="<?php echo $bedroom ?>">
                <label>Bathroom count</label>
                <input type="text" id="halfBoxR" class="form-control" name="bathroom" value="<?php echo $bedroom ?>">
                <br/>
                <label>Property Type</label>
                <?php echo (build_dropdown("property_type","$city"));?>
                <br/>
                <label>Property Flooring</label>
                <?php echo (build_dropdown("property_flooring","$flooring"));?>
                <br/>
                <label>Property Parking</label>
                <?php echo (build_dropdown("property_parking","$parking"));?>
                <br/>
                <label>Property Building Type</label>
                <?php echo (build_dropdown("property_building_type","$building_type"));?>
                <br/>
                <label>Property Basement Type</label>
                <?php echo (build_dropdown("property_basement_type","$"));?>
                <br/>
                <label>Property Interior Type</label>
                <?php echo (build_dropdown("property_interior_type","$city"));?>
                <br/>     
                <label>Price
                <input type="text" id="halfBoxR" class="form-control" name="price" value="<?php echo $price ?>" placeholder=""></label>
                <br/>
                <?php echo (build_radio("listing_status","$listingStatus"));?>
                <br/>

            </div>
            <!--personal information section-->
            
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
