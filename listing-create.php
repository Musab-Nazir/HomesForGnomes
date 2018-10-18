<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nizar
Name:			      Kevin Astilla
Name:			      Nathan Morris
Description:  	Create Listing File For Homes For Gnomes
Date:         	28 September 2018
*/
  $title = "WEBD2201 - Web Development - Fundamentals";
  $date = "12 April 2018";
  $file = "template.php";
  $banner = "Lab 9: Database/PHP Lab - User Login";
  $description = "This page will be a log in page for the website and a new functions.php file will contain some shared functions for use throughout the website.";

require "header.php";
?>
  <!-- start of main page content -->
<div class="container" style="height:100vh">
    <div class="row" style="margin-top:75px">
        <div class="col"></div>
        <div class="col-6">
            <form method="post" action="<?php sticky();?>" >
                <div class="form-group">
                    <label>Headline</label>
                    <input type="text" class="form-control" name="headline" value=""
                    placeholder="Insert Listing Headline">
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="password" class="form-control" name="price" value=""
                    placeholder="$Price">
                </div>
                <div class="bd-example">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">Bathrooms</button>

                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </div>

                <br />
                <div class="form-group">
                    <button type="submit" class="btn btn-outline-success" style="width:33%; margin-right: 33%;">Login</button>
                    <button type="reset" class="btn btn-outline-success" style="width:33%;">Clear</button>
                </div>
            </form>
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
