<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nazir
Name:			Kevin Astilla
Name:			Nathan Morris
Description:  	Header File For Homes For Gnomes
Date:         	28 September 2018
*/

require "header.php";

$listings = $_SESSION['listingList'];
$conn = db_connect();
echo '<div class="container"><div class="row" style="margin-top:75px">';
for ($listingCount=0; $listingCount < count($listings); $listingCount++) {
    $sql = "SELECT * FROM listings WHERE listing_id = $listings[$listingCount]";
    $result = pg_query($conn, $sql);
    for($index = 0; $index < pg_num_rows($result); $index++)
    {
        // if($index != 0 && ($index % PREVIEW_LINE_LIMIT == 0))
        // {
        //     echo '<div class="row"style="margin-top:50px">';
        // }
        echo '<div class="col-4"style="margin-top:1em"><div class="card"><div class="card-body">';
         $arrayRow = pg_fetch_array($result,$index);
        echo (build_listing_card($arrayRow));
        echo '</div></div></div>';
        // if($index != 0 && ($index % PREVIEW_LINE_LIMIT == 0))
        // {
        //     echo '</div>';
        // }
    }
}

?>
  <!-- start of main page content -->

    </div>
    </div>
    <br/>
    <div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1">Previous</a>
            </li>
            <li class="page-item active" id="pagination"><a class="page-link" href="#">1</a></li>
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
