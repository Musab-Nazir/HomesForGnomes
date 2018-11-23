<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nizar
Name:			      Kevin Astilla
Name:			      Nathan Morris
Description:  	Search Listings File For Homes For Gnomes
Date:         	28 September 2018
*/
  $title = "WEBD2201 - Web Development - Fundamentals";
  $date = "12 April 2018";
  $file = "template.php";
  $banner = "Lab 9: Database/PHP Lab - User Login";
  $description = "This page will be a log in page for the website and a new functions.php file will contain some shared functions for use throughout the website.";

require "header.php";
/*if(!isset($_SESSION['userType']))
{
    $_SESSION['RedirectError'] = "You were not logged in<br/>";
    header("Location:login.php");
}
if(!isset($_SESSION['citySelected']))
{
    $_SESSION['RedirectError'] = "Please select a city<br/>";
    header("Location:listing-city-select.php");
}*/


//variable declaration
$city = "";//$_SESSION['citySelected'];
$minPrice = "";
$maxPrice = "";
$bedroomCount = "";
$bathroomCount = "";


$error = "";
$output = "";


//validation
if(isPost())
    {
        $city = trim($_POST["city"]);
        $minPrice = trim($_POST["minPrice"]);
        $maxPrice = trim($_POST["maxPrice"]);
        $bedroomCount = trim($_POST["bedroom"]);
        $bathroomCount = trim($_POST["bathroom"]);

        $error = "";
        $output = "";

        if($city == '0') $error .= "<br/>No City was selected";

        if($minPrice == "") $error .= "<br/>Minimum price was not specified";
        elseif (preg_match(PRICE_FILTER, $minPrice) == '0') {
            $error .= "<br/>Minimum price needs to be a number";
            $minPrice = "";
        }
        if($maxPrice == "") $error .= "<br/>Maximum price was not specified";
        elseif (preg_match(PRICE_FILTER, $maxPrice) == '0') {
            $error .= "<br/>Maximum price needs to be a number";
            $minPrice = "";
        }
        if($maxPrice < $minPrice) $error .= "<br/>Minimum price must be smaller than maximum price";

        if(!isset($bedroomCount) || $bedroomCount == ""){
        //means the user did not enter
        $error .= "<br/>You did not enter bedroom count."; 
        }
        else if($bedroomCount == '0') $error .= "<br\>Please specify number of bedrooms";


        if(!isset($bathroomCount) || $bathroomCount == ""){
        //means the user did not enter
        $error .= "<br/>You did not enter bathroom count."; 
        }
        else if($bathroomCount== '0') $error .= "<br/>Please specify number of bedrooms";

        //if no errors
        if($error === "")
        {

            $conn = db_connect();

            $sql = "SELECT * FROM listings WHERE bedrooms = '".$bedroomCount."' AND bathrooms = '".$bathroomCount."' AND city = '".$city."'AND status = 'o' AND price BETWEEN '".$minPrice."' AND '".$maxPrice."' ORDER BY listing_id DESC LIMIT 200";

            $result = pg_query($conn, $sql);

            if(pg_num_rows($result) == '0')
                $output .= "listing not found";
            else
                $output .= pg_num_rows($result);
            //header("Location:Dashboard.php");
            //ob_flush();
        }
    }




?>
  <!-- start of main page content -->
  <div class="container">
  <div class="row" style="margin-top:75px">
    <div class="col"></div>
        <?php echo $error; ?>
        <?php echo $output;?>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Please fill out the details about the Listing</h5>
                <form method="post" action="<?php sticky();?>" >
                    <div class="form-group">
                        
                        <table style="width:100%">
                            <tr>
                                <td><label>City</label>
                                    <?php echo (build_dropdown("city","$city"));?></td>
                                <td><label>Min Price</label>
                        <input type="text" id="halfBoxR" class="form-control" name="minPrice" value="<?php echo $minPrice ?>" placeholder="MIN Price">
                                </td>
                                <td><label>Max Price</label>
                        <input type="text" id="halfBoxR" class="form-control" name="maxPrice" value="<?php echo $maxPrice ?>" placeholder="MAX Price">
                                </td>
                                <td><label>Bedroom</label>
                        <input type="text" id="halfBoxL" class="form-control" name="bedroom" value="<?php echo $bedroomCount ?>" >
                                </td>
                                <td><label>Bathroom</label>
                        <input type="text" id="halfBoxR" class="form-control" name="bathroom" value="<?php echo $bathroomCount ?>">
                                </td>
                            </tr>
                        </table>
                        <br/>

                        <button type="submit" class="btn btn-outline-success" style="width:33%; margin-right: 33%;">Search</button>
                        <button type="reset" class="btn btn-outline-success" style="width:33%;">Clear</button>
                    </div>
                </form>
            </div>
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
