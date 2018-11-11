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
  $file = "listing-create.php";
  $banner = "";
  $description = "";

require "header.php";
if($_SESSION['userType'] != a)
{
    $_SESSION['RedirectError'] = "You were not logged in as an Agent<br/>";
    header("Location:login.php");
}
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
    $listingStatus =  "";
    $images = "";
    $propertyType = "";
    $flooring = "";
    $parking = "";
    $buildingType = "";
    $basementType = "";
    $interiorType = "";
    $propertyOptions = "";
    $images = "";


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

        (isset($_POST["listing_status"]))? $listingStatus = trim($_POST["listing_status"]):"";
        $propertyOptions = trim($_POST["property_options"]);

        $propertyType = trim($_POST["property_type"]);
        $flooring = trim($_POST["property_flooring"]);
        $parking = trim($_POST["property_parking"]);
        $buildingType = trim($_POST["property_building_type"]);
        $basementType = trim($_POST["property_basement_type"]);
        $interiorType = trim($_POST["property_interior_type"]);

        $images = 

        $error = "";
        $output = "";
        //trim the user input

        //validate headline
        if ($headline == "") $error .= "<br/>No headline was entered";
        elseif (is_numeric($headline))
        {
            $error .= "<br/>headline cannot be a number";
            $headline = "";
        }
        //validate description
        if ($description == "") $error .= "<br/>No description was entered";
        elseif (is_numeric($headline))
        {
            $error .= "<br/>headline cannot be a number";
            $headline = "";
        }
        //validate postal code
        if ($postalCode == "") $error .= "<br/>You did not enter a postal code";
        else if (!isValidPostalCode($postalCode)) $error .= "<br/>your postal code format is invalid";

        //in case the user adds the dollar sign or commas
        if (preg_match(PRICE_FILTER, $price) == '0') $error .= "<br/>No price was entered";

        if(!isset($bedroom) || $bedroom == ""){
        //means the user did not enter 
        $error .= "<br/>You did not enter bedroom count."; //set error
        $login = "";
        }
        else if($bedroom == '0') $error .= "<br\>Please specify number of bedrooms";


        if(!isset($bathroom) || $bathroom == ""){
        //means the user did not enter 
        $error .= "<br/>You did not enter bathroom count."; //set error
        $login = "";
        }
        else if($bathroom== '0') $error .= "<br/>Please specify number of bedrooms";

        if($city == '0') $error .= "<br/> Please select a city ";
        if($propertyType == '0') $error .= "<br/> Please select a property type";
        if($flooring == '0') $error .= "<br/> Please select the type of flooring";
        if($parking == '0') $error .= "<br/> Please select a please indicate type of parking";
        if($buildingType == '0') $error .= "<br/> Please select the type oif building";
        if($basementType == '0') $error .= "<br/> Please select the basement\'s current state";
        if($interiorType == '0') $error .= "<br/> Please select the interior design type ";


        //validating the image
        if($_FILES['uploadfile']['error'] != 0)
        {
            $error .= "<br/>Problem uploading your file";
        }
        else if($_FILES['uploadfile']['size'] > MAXIMUM_IMAGE_SIZE) //size in bytes
        {
            $error .= "<br/>File selected is too big";
        }
        else if($_FILES['uploadfile']['type'] != "image/jpeg" && $_FILES['uploadfile']['type'] != "image/pjpeg")
        {
            $error .= "<br/>Your profile pictures must be of type JPEG";
        }
        else//no problem happened
        {
            //this is where i stoped
            //$image = //make it a small int??
        }
        //if no errors
        if($error === "")
        {

            $conn = db_connect();

            $sql = "INSERT INTO listings(user_id, status, price, headline, description, postal_code, images, city, property_options, bedrooms, bathrooms, property_type, flooring, parking, building_type, basement_type, interior_type)
            VALUES ('".$login."', '".$listingStatus."','".$price."','".$headline."', '".$description."','".$postalCode."','".$images."', '".$city."','".$propertyOptions."','".$bedroom."', '".$bathroom."', '".$propertyType."', '".$flooring."',
                 '".$parking."', '".$buildingType."', '".$basementType."', '".$interiorType."')";

            $result = pg_query($conn, $sql);
            $output .= "Listing successfully created";
            //header("Location:Dashboard.php");
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
                <br/>
                <label>Postal Code</label>
                <input type="text" id="halfBoxR" class="form-control" name="postal_code" value="<?php echo $postalCode ?>">
                <br/>
                <label>Bedroom count</label>
                <input type="text" id="halfBoxR" class="form-control" name="bedroom" value="<?php echo $bedroom ?>">
                <br/>
                <label>Bathroom count</label>
                <input type="text" id="halfBoxR" class="form-control" name="bathroom" value="<?php echo $bedroom ?>">
                <br/>
                <label>Property Options</label>
                <?php echo (build_dropdown("property_options","$propertyOptions"));?>
                <br/>
                <label>Property Type</label>
                <?php echo (build_dropdown("property_type","$propertyType"));?>
                <br/>
                <label>Property Flooring</label>
                <?php echo (build_dropdown("property_flooring","$flooring"));?>
                <br/>
                <label>Property Parking</label>
                <?php echo (build_dropdown("property_parking","$parking"));?>
                <br/>
                <label>Property Building Type</label>
                <?php echo (build_dropdown("property_building_type","$buildingType"));?>
                <br/>
                <label>Property Basement Type</label>
                <?php echo (build_dropdown("property_basement_type","$basementType"));?>
                <br/>
                <label>Property Interior Type</label>
                <?php echo (build_dropdown("property_interior_type","$interiorType"));?>
                <br/>
                <label>Price
                <input type="text" id="halfBoxR" class="form-control" name="price" value="<?php echo $price ?>" placeholder=""></label>
                <br>
                <input type="file" name="myFile"><br><br>
                <br/>
                <?php echo (build_radio("listing_status","$listingStatus"));?>
                <br/>

            </div>
            <!--personal information section-->

            <div class="form-group">
                <button type="submit" class="btn btn-outline-success" style="width:33%; margin-right: 33%;">Create</button>
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
