<?php
/*
Name:           Ramandeep Rathor
Name:           Musab Nazir
Name:           Kevin Astilla
Name:           Nathan Morris
Description:    Create Listing File For Homes For Gnomes
Date:           28 September 2018
*/

require "header.php";
$error = "";
$output = "";
    //declare all variables
	if(isset($_GET["listingID"]))
	{
		$listing_id = $_GET["listingID"]; 		//listing_id
	}

	// else{
	// 	$_SESSION['RedirectError'] = "No listing was selected<br/>";
	// 	header("Location:listing-match.php");
	// 	ob_flush();
	// }

	if(isset($_GET["favorite"]))
	{
	    $listing_id = $_GET["favorite"]; 		//listing_id
	    $sql = "INSERT INTO favourites(user_id, listing_id)
	    VALUES ('".$_SESSION['userID']."','".$listing_id."')";
	    $result = pg_query(db_connect(), $sql);
	    $output .= "Listing added to favorites";
	}

    //end of the function
    $listingInformation = pg_fetch_assoc(get_listing_information_only($listing_id));

    $listingStatus =  $listingInformation['status'];
    $price = $listingInformation['price'];
    $headline = $listingInformation['headline'];
    $description = $listingInformation['description'];
    $postalCode = $listingInformation['postal_code'];
    $images = $listingInformation['images'];
    $city = $listingInformation['city'];
    $propertyOptions = $listingInformation['property_type'];
    $bedroom = $listingInformation['bedrooms'];
    $bathroom = $listingInformation['bathrooms'];
    $propertyType = $listingInformation['property_type'];
    $flooring = $listingInformation['flooring'];
    $parking = $listingInformation['parking'];
    $buildingType = $listingInformation['building_type'];
    $basementType = $listingInformation['basement_type'];
    $interiorType = $listingInformation['interior_type'];

    //$images = $listingInformation['images'];
?>

  <div class="container">
  <div class="row" style="margin-top:75px">
    <div class="col"></div>
    <div class="col-8">
        <br/>
        <?php echo $error; ?>
		<?php echo $output; ?>
        <div class="card">
            <div class="card-body">
                <form method="post" action="<?php sticky();?>" >
                    <div class="form-group">
                        <h3 style="text-decoration:underline;"><?php echo $headline ?></h3>
                        <br/>
                        <h6>Description</h6>
                        <p><?php echo $description ?></p>

						<table style="width:100%;">
							<tr>
								<td><h6>Postal Code</h6></td>
								<td><p><?php echo $postalCode ?></p></td>
							</tr>
							<tr>
								<td><h6>City</h6></td>
								<td><p><?php echo GetProperty($city,"city");?></p></td>
							</tr>
							<tr>
								<td><h6>Bedroom Count</h6></td>
								<td><p><?php echo $bedroom ?></p></td>
							</tr>
							<tr>
								<td><h6>Bathroom Count</h6></td>
								<td><p><?php echo $bathroom ?></p></td>
							</tr>
							<tr>
								<td><h6>Property Options</h6></td>
								<td><p><?php echo GetProperty($propertyOptions,"property_options");?></p></td>
							</tr>
							<tr>
								<td><h6>Property Type</h6></td>
								<td><p><?php echo GetProperty($propertyType,"property_type");?></p></td>
							</tr>
                            <tr>
                                <td><h6>Property Parking</h6></td>
								<td><p><?php echo GetProperty($parking,"property_parking");?></p></td>
                            </tr>
                            <tr>
                                <td><h6>Property Building Type</h6></td>
								<td><p><?php echo GetProperty($buildingType,"property_building_type");?></p></td>
                            </tr>
                            <tr>
                                <td><h6>Property Basement Type</h6></td>
								<td><p><?php echo GetProperty($basementType,"property_basement_type");?></p></td>
                            </tr>
							<tr>
                                <td><h6>Property Flooring</h6></td>
                                <td><?php echo (build_multiselect_dropdown("property_flooring","$flooring"));?></td>
                            </tr>
                            <tr>
                                <td><h6>Property Interior Type</h6></td>
                                <td><?php echo (build_multiselect_dropdown("property_interior_type","$interiorType"));?></td>
                            </tr>
							<tr>
								<td colspan="2"><hr/></td>
							</tr>
							<tr>
								<td><h5 style="color:green;">Price</h5></td>
								<td><h6><?php echo "$".$price ?></h6></td>
							</tr>
							<tr>
								<td colspan="2"><hr/></td>
							</tr>
						</table>
                        <h6>Images<h6/>
                        <br/>
                        <?php //echo (build_radio("listing_status","$listingStatus"));?>
                    </div>
					<div class="d-flex justify-content-between">
	                    <div>
							<?php if( isset($_SESSION['userType'])){
								echo "<a href=\"listing-display.php?favorite=$listing_id\" class=\"btn btn-outline-success\">Favourite</a>";
							}?>

	                    </div>
	                    <div>
							<?php if( isset($_SESSION['userType'])){
								echo "<button type=\"submit\" name=\"rm-favorites\" class=\"btn btn-outline-success\" style=\"width:200px;\">Remove from Favorites</button>";
							}?>
	                    </div>
	                </div>
                </form>
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
