<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nizar
Name:			Kevin Astilla
Name:			Nathan Morris
Description:  	Header File For Homes For Gnomes
Date:         	28 September 2018
*/

require "header.php";
?>
  <!-- start of main page content -->
<div class="container">
  <div class="row" style="margin-top:75px">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Listing Preview Headline</h5>
                <img src="./images/Hobbiton-Matamata-SaraOrme-800x600.jpg" alt="" width="300px">
                price<br/>
                Beds<br/>
                baths<br/>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Listing Preview Headline</h5>
                <img src="./images/hobbiton.jpg" alt="" width="300px">
                <p>Stuff about the listing</p>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Listing Preview Headline</h5>
                <img src="./images/Hobbiton-Waikato-IanBrodie-800x600.jpg" alt="" width="300px">
                <p>Stuff about the listing</p>
            </div>
        </div>
    </div>
    </div>
    <br/>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</div>

  <!-- end of main page content -->

<!-- Footer Start -->
<?php
  include 'footer.php'
?>
<!-- Footer End -->
