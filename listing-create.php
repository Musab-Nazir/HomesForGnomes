<?php
/*
Name:           Ramandeep Rathor
Name:           Musab Nazir
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

    $login = $_SESSION["userID"];
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
        (!empty($_FILES["listing_image"]))? $imageCount = "1":"0";
        $imagePath = "images/upload/";
        $tempName = "";
        $fileName = "";
        (isset($_POST["listing_status"]))? $listingStatus = trim($_POST["listing_status"]):"";
        $propertyOptions = strval(sum_check_box($_POST["property_options"]));
        $propertyType = trim($_POST["property_type"]);       
        (isset($_POST["property_flooring"]))? $flooring = sum_check_box($_POST["property_flooring"]):"";
        $parking = trim($_POST["property_parking"]);
        $buildingType = trim($_POST["property_building_type"]);
        $basementType = trim($_POST["property_basement_type"]);
        (isset($_POST["property_interior_type"]))? $interiorType = sum_check_box($_POST["property_interior_type"]):"";
        $uploadedFiles = $_SESSION['imageCount'];

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
        if($buildingType == '0') $error .= "<br/> Please select the type of building";
        if($basementType == '0') $error .= "<br/> Please select the basement\'s current state";
        if($interiorType == '0') $error .= "<br/> Please select the interior design type ";

        //image validation
        // if($_FILES["listing_image"]["error"] != 0)
        //     {
        //         $error .= $phpFileUploadErrors[$_FILES["listing_image"]["error"]];

        //     }
        //     else if($_FILES["listing_image"]["size"] > MAXIMUM_IMAGE_SIZE) //size in bytes
        //     {
        //         $error .= "<br/>File selected is too big";
        //     }
        //     else if($_FILES["listing_image"]["type"] != "image/jpeg" && $_FILES["listing_image"]["type"] != "image/bmp" && $_FILES["listing_image"]["type"] != "image/png" && $_FILES["listing_image"]["type"] != "image/jpg" )
        //     {
        //         $error .= "<br/>image type is not supported";
        //     }

        
        //if no errors
        if($error == "")
        {
            $conn = db_connect();
            $sql = "INSERT INTO listings(user_id, status, price, headline, description, postal_code, images, city, property_options, bedrooms, bathrooms, property_type, flooring, parking, building_type, basement_type, interior_type)
            VALUES ('".$login."', '".$listingStatus."','".$price."','".$headline."', '".$description."','".$postalCode."','".$uploadedFiles."','".$city."','".strval($propertyOptions)."','".$bedroom."', '".$bathroom."', '".$propertyType."', '".$flooring."',
                 '".$parking."', '".$buildingType."', '".$basementType."', '".$interiorType."')";
            $result = pg_query($conn, $sql);

            $output .= "Listing successfully created";

            //uploading image
            
            //getting the id of the newly created listing
            $listingSql = "SELECT MAX(listing_id) FROM listings WHERE user_id ='".$login."'";
            $listingResult = pg_query($conn,$listingSql);
            $listingId = pg_fetch_result($listingResult, 0);
            if(($_SESSION['imageCount'])> 0){
            For($imageNumber = 1; $imageNumber <= $uploadedFiles; $imageNumber++){               
                //$ext = ".".pathinfo($fileName, PATHINFO_EXTENSION);
                $ext = ".jpg";
                $newName = $imagePath.$listingId."_".strval($imageNumber).$ext;
                $oldName = $imagePath.$login.strval($imageNumber).$ext;
                rename($oldName, $newName);
            }
            }
             header("Location:admin.php");
             ob_flush();
        }
    }
?>

  <div class="container">
  <div class="row" style="margin-top:75px">
    <div class="col"></div>
    <div class="col-6">
        <br/>
        <?php
          $error.=$output;
        echo $error;
        ?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Please Fill Out Details About The Listing</h5>
                <form method="post" enctype="multipart/form-data" action="<?php sticky();?>" >
                    <div class="form-group">
                        <label>Headline</label>
                        <input type="text" class="form-control" name="headline" value="<?php echo $headline ?>">
                        <br/>
                        <label>Description</label>
                        <textarea class="form-control" name="description" maxlength="1000" rows="5" id="description"><?php echo $description ?></textarea>
                        <br/>
                        <div class="row">
                          <div class="col">
                            <label>City</label>
                            <?php echo (build_dropdown("city","$city"));?>
                          </div>
                          <div class="col">
                          <label>Postal Code</label>
                          <input type="text" id="halfBoxR" class="form-control" name="postal_code" placeholder="A1B2C3" value="<?php echo $postalCode ?>" style="width:8em;">
                          </div>
                        </div>
                        <br/>
                        <label>Bedroom Count</label>
                        <input type="text" id="halfBoxL" class="form-control" name="bedroom" value="<?php echo $bedroom ?>" style="width:3em;">
                        <label style="margin-left:100px;">Bathroom Count</label>
                        <input type="text" id="halfBoxR" class="form-control" name="bathroom" value="<?php echo $bathroom ?>" style="width:3em;">
                        <br/>
                        <table style="width:100%">     
                            <tr>
                                <td><label>Property Type</label></td>
                                <td><?php echo (build_dropdown("property_type","$propertyType"));?></td>
                            </tr>
                            <tr>
                                <td><label>Property Parking</label></td>
                                <td><?php echo (build_dropdown("property_parking","$parking"));?></td>
                            </tr>
                            <tr>
                                <td><label>Property Building Type</label></td>
                                <td><?php echo (build_dropdown("property_building_type","$buildingType"));?></td>
                            </tr>
                            <tr>
                                <td><label>Property Basement Type</label></td>
                                <td><?php echo (build_dropdown("property_basement_type","$basementType"));?></td>
                            </tr>
                            <tr>
                                <td><label>Property Options</label></td>
                                <td><?php echo (build_multiselect_dropdown_checkbox("property_options","$propertyOptions"));?></td>

                            </tr>
                            <tr>
                                <br/>
                            </tr>
                            <tr>
                                <td><label>Property Flooring</label></td>
                                <td><?php echo (build_multiselect_dropdown_checkbox("property_flooring","$flooring"));?></td>
                            </tr>
                            <tr>
                                <td><label>Property Interior Type</label></td>
                                <td><?php echo (build_multiselect_dropdown_checkbox("property_interior_type","$interiorType"));?></td>
                            </tr>
                        </table>

                        <label>Price
                        <input type="text" id="halfBoxR" class="form-control" name="price" value="<?php echo $price ?>" placeholder=""></label>
                        <br/>
                        <label>Status</label>
                        <div class="row">
                          <?php echo (build_radio("listing_status","$listingStatus"));?>
                        </div>
                        <br/>
                        
                    </div>
                    <br/>
                        
                    <!--personal information section-->

                    <div class="form-group">
                        <button type="submit" class="btn btn-outline-success" style="width:33%; margin-right: 33%;">Create</button>
                        <button type="reset" class="btn btn-outline-success" style="width:33%;">Clear</button>
                    </div>
                </form>
                <button onclick="openWin()">upload images</button>
            </div>
        </div>
        <br/>
    </div>
    <div class="col"></div>
  </div>
</div>

<!-- Footer Start -->
<?php
  include 'footer.php'
?>
<!-- Footer End -->
