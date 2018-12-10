<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nazir
Name:			      Kevin Astilla
Name:			      Nathan Morris
Description:  	Header File For Homes For Gnomes webd3201
Date:         	28 September 2018
*/
session_start();
require("./includes/functions.php");
require("./includes/constants.php");
require("./includes/db.php");
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<!--The nav bar and the layout of the site is based on a premade bootstrap template -->
<!--https://startbootstrap.com/template-overviews/modern-business/-->
  <head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <!-- favicon -->
  <link rel="icon" href="./images/favicon.png" />
    <title>Homes for Gnomes</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font  -->
    <link href='https://fonts.googleapis.com/css?family=Dancing+Script' rel='stylesheet' />
    <!-- Custom styles for this template -->
    <link href="css/webd3201.css" rel="stylesheet" />

    <!--  JQuery import-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </head>

  <body>
    <!-- Navigation -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top" style="background-color:#982a4f;">
      <div class="container">
          <img src="./images/HomesForGnomes.png" alt="logo" style="width:50px;"/>
        <a class="navbar-brand" href="index.php" style="font-family: 'Dancing Script'; font-size: xx-large;">Homes for Gnomes</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <?php if(!isset($_SESSION['userType']))
                {
                    echo "<a class=\"nav-link\" href=\"register.php\">Register</a>";
                } ?>
                <!-- <a class="nav-link" href="register.php">Register</a> -->
            </li>
            <li class="nav-item">
                <?php if(!isset($_SESSION['userType']))
                {
                    echo "<a class=\"nav-link\" href=\"login.php\">Login</a>";
                } ?>
            </li>

              <?php if(isset($_SESSION['userType']) && $_SESSION['userType'] == CLIENT)
              {
                  echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"welcome.php\">Welcome</a></li>";
              }
              else if (isset($_SESSION['userType']) && $_SESSION['userType'] == AGENT)
              {
                  echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"dashboard.php\">Dashboard</a></li>";
              }
              else if(isset($_SESSION['userType']) && $_SESSION['userType'] == ADMIN)
              {
                  echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"admin.php\">Admin</a></li>";
              }
              if( isset($_SESSION['userType']))
              {
                  echo "<li class=\"nav-item dropdown\">
                    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdownPortfolio\"
                    data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                      Profile
                    </a>
                    <div class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"navbarDropdownPortfolio\">
                      <a class=\"dropdown-item\" href=\"change-password.php\">Change Password</a>
                      <a class=\"dropdown-item\" href=\"update.php\">Update</a>
                    </div>";
              }?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Listings
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
				<?php if(isset($_SESSION['listingList']))
				{
					echo "<a class=\"dropdown-item\" href=\"listing-match.php\">Display Listings</a>";
                }?>
                <a class="dropdown-item" href="listing-search.php">Search Listings</a>
                <?php
                if( isset($_SESSION['userType']))
                {
                    if ($_SESSION['userType'] == ADMIN || $_SESSION['userType'] == AGENT)
                    {
                        echo "<a class=\"dropdown-item\" href=\"listing-create.php\">Create Listings</a>";
                    }
                }?>
              </div>
            </li>
            <?php if( isset($_SESSION['userType']))
            {
                echo "<li class=\"nav-item\"><a class=\"nav-link\" href=\"logout.php\">Logout</a></li>";;
            }?>
          </ul>
        </div>
      </div>
    </nav>
