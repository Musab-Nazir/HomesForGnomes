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


//$listingID = array('10001', '10002', '10003', '10004', '10005', '10006', '10007', '10008');
//$lisintgIDString = '(' . implode(',', $lisintgID) .')';

$conn = db_connect();

$sql = "SELECT * FROM listings WHERE listing_id IN ('10001', '10002', '10003', '10004', '10005', '10006', '10007', '10008')";

$result = pg_query($conn, $sql);

$LISTINGPERPAGE = 10;

$output =  pg_num_rows($result);

?>
  <!-- start of main page content -->
<div class="container">
  <div class="row" style="margin-top:75px">
    
                <?php
                echo $output;

                    for($index = 0; $index < pg_num_rows($result); $index++)
                    {
                        echo '<div class="col-4"><div class="card"><div class="card-body">';
                         $arrayRow = pg_fetch_array($result,$index);

                        //print_r($arrayRow);
                        echo (build_listing_card($arrayRow));
                        echo '</div></div></div>';
                        
                    }
                ?>
            
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
