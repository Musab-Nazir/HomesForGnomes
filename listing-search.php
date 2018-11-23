<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nazir
Name:			Kevin Astilla
Name:			Nathan Morris
Description:  	Search Listings File For Homes For Gnomes
Date:         	28 September 2018
*/


require "header.php";

$city = "";
$minPrice = "";
$maxPrice = "";
$bedroomCount = "";
$bathroomCount = "";
$row = "";
$listings = array();


$error = "";
$output = "";

if(isset($_GET["city"]))
{
    $city = $_GET["city"];
    setcookie('city',$city,COOKIE_LIFESPAN);
    $_SESSION['city'] = $city;
}

else if (isset($_COOKIE['city']))
{
    $city = $_COOKIE['city'];
    $_SESSION['city'] = $city;
}



//if(!isset($city))
else
{
    $_SESSION['RedirectError'] = "Please select a city<br/>";
    header("Location:listing-city-select.php");
}


//validation
if(isPost())
    {
        $minPrice = trim($_POST["minPrice"]);
        $output .=$_POST["minPrice"];
        $maxPrice = trim($_POST["maxPrice"]);
        $output .=$_POST["maxPrice"];
        $bedroomCount = trim($_POST["bedroom"]);
        $output .=$_POST["bedroom"];
        $bathroomCount = trim($_POST["bathroom"]);
        $output .=$_POST["bathroom"];

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

            $sql = "SELECT * FROM listings WHERE bedrooms = '".$bedroomCount."' AND bathrooms = '".$bathroomCount."' AND city = '".$city."' AND status = 'o'
            AND price BETWEEN '".$minPrice."' AND '".$maxPrice."' ORDER BY listing_id DESC LIMIT 200";

            $result = pg_query($conn, $sql);

            if(pg_num_rows($result) == '0')
                $output .= "listing not found";
            else
            while($row = pg_fetch_assoc($result)){
                array_push($listings,$row['listing_id']);
            }
            $_SESSION['listingList'] = $listings;
            header("Location:listing-display.php");
            ob_flush();
        }
    }




?>
  <!-- start of main page content -->
  <div class="container">
  <div class="row" style="margin-top:75px">
      <?php echo $error; ?>
      <?php echo $output;?>
    <div class="col"></div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Please fill out more details about listings in <?php echo GetProperty($city, 'city') ?></h5>
                <br/>
                <form method="post" action="<?php sticky();?>" >
                    <div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <label>Min Price</label>
                                <input type="text" class="form-control" name="minPrice" value="<?php echo $minPrice ?>" placeholder="MIN Price">
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4">
                                <label>Max Price</label>
                                <input type="text" class="form-control" name="maxPrice" value="<?php echo $maxPrice ?>" placeholder="MAX Price">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <label>Bedroom</label>
                                <input type="text" class="form-control" name="bedroom" value="<?php echo $bedroomCount ?>" >
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4">
                                <label>Bathroom</label>
                                <input type="text" class="form-control" name="bathroom" value="<?php echo $bathroomCount ?>">
                            </div>
                        </div>
                        <br/>

                        <button type="submit" class="btn btn-outline-success" style="width:33%; margin-right: 33%;">Search</button>
                        <button type="reset" class="btn btn-outline-success" style="width:33%;">Clear</button>
                    </div>
                </form>
            </div>
        </div>
    <div class="col"></div>
  </div>
  <br/>
</div>


  <!-- end of main page content -->

<!-- Footer Start -->
<?php
  include 'footer.php'
?>
<!-- Footer End -->
