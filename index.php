<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nazir
Name:			Kevin Astilla
Name:			Nathan Morris
Description:  	Homepage For Homes For Gnomes
Date:         	28 September 2018
*/
include("header.php"); ?>
<!--The sliding banner images  -->
<header>
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <!-- Slide One - Set the background image for this slide in the line below -->
      <div class="carousel-item active" style="background-image: url('./images/bannerHouse1.jpg')">
        <!-- <div class="carousel-caption d-none d-md-block">
          <h3>House Number 1</h3>
          <p>The guy in the window is creepy</p>
        </div> -->
      </div>
      <!-- Slide Two - Set the background image for this slide in the line below -->
      <div class="carousel-item" style="background-image: url('./images/welcome.jpg')">
        <!-- <div class="carousel-caption d-none d-md-block">
          <h3>House Number 2</h3>
          <p>Too plain</p>
        </div> -->
      </div>
      <!-- Slide Three - Set the background image for this slide in the line below -->
      <div class="carousel-item" style="background-image: url('./images/bannerHouse3.jpg')">
        <!-- <div class="carousel-caption d-none d-md-block">
          <h3>House number 3</h3>
          <p>I like this one a lot</p>
        </div> -->
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</header>

<!-- Page Content -->
<div class="container" style="margin-bottom: 25px;">

  <h1 class="my-4">Welcome to Homes for Gnomes</h1>

  <!-- Marketing Icons Section -->
  <div class="row">
    <div class="col-lg-8">
      <div class="card h-100">
        <h4 class="card-header">Connect Closer to Nature</h4>
        <div class="card-body">
          <p class="card-text">Gnomes are wonderful creatures attach to nature. Free spirited, joyful, detached to stressful realities in life.
              embrace the Gnome in you and experience a stress free environment by clicking the button bellow.
              Because remember, <b>every Gnome needs a home</b>.
          </p>
        </div>
        <div class="card-footer">
          <a href="register.php" class="btn btn-outline-success">Register Now</a>
        </div>
      </div>
    </div>
    <!-- <div class="col-lg-4 mb-4">
      <div class="card h-100">
        <h4 class="card-header">Card Title</h4>
        <div class="card-body">
          <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis ipsam eos, nam perspiciatis natus commodi similique totam consectetur praesentium molestiae atque exercitationem ut consequuntur, sed eveniet, magni nostrum sint fuga.</p>
        </div>
        <div class="card-footer">
          <a href="#" class="btn btn-primary">Learn More</a>
        </div>
      </div>
    </div> -->
    <div class="col-lg-4">
      <div class="card h-100">
        <h4 class="card-header">Already a Fellow Gnome?</h4>
        <div class="card-body">
          <p class="card-text">If you already signed up, then you can login her. Lets get you that home!</p>
        </div>
        <div class="card-footer">
          <a href="login.php" class="btn btn-outline-success">Log In</a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php include("footer.php"); ?>
