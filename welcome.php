<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nizar
Name:		    Kevin Astilla
Name:			Nathan Morris
Description:  	Welcome File For Homes For Gnomes
Date:         	10th December 2018
*/

require "header.php";
// If the session was never set with a user id
$output = '';
$conn = db_connect();
if($_SESSION['userType'] != "c")
{
    $_SESSION['RedirectError'] = "You were not logged in as a Client<br/>";
    header("Location:login.php");
}
if (isset($_GET["page"])) {
    $page  = $_GET["page"];
    $index = ($page -1) * IMAGE_LIMIT;
}
else {
    $page=1;
    $index = 0;
 }


?>
  <!-- start of main page content -->

<div class="container" style="margin-top: 2em;">
    <div class="row">
            <h2>Welcome Page</h2>

    </div>
    <div class="row">
        <p>Welcome back <?php echo $_SESSION['userID']; ?> you last logged in on <?php echo $_SESSION['last_access']; ?></p>
    </div>
    <h4>Favourites</h4>
    <?php
        echo '<div class="row">';
        $sql = "SELECT listing_id FROM favourites WHERE user_id = '".$_SESSION['userID']."'";
        $result = pg_query($conn, $sql);
        $listings = pg_fetch_all($result);
        for($index; $index < pg_num_rows($result); $index++)
        {
            $sql = "SELECT * FROM listings WHERE listing_id = '".$listings[$index]['listing_id']."'";
            $listing_result = pg_query($conn, $sql);
            echo '<div class="col-md-4"style="margin-top:1em"><div class="card"><div class="card-body">';
            $arrayRow = pg_fetch_assoc($listing_result);
            echo (build_listing_card($arrayRow));
            echo '</div></div></div>';

            if($index !=0 && ($index +1) % IMAGE_LIMIT ==0){
                break;
            }
        }
    ?>
        </div>
        <br/>
        <div class="row justify-content-md-center">
        <?php
        $total_pages = ceil(count($listings) / IMAGE_LIMIT);
        $pagLink = "<div class='pagination'>";
        for ($i=1; $i<=$total_pages; $i++) {
                     if($i == $page)
                     {
                        $pagLink .= "<a class='active' href='welcome.php?page=".$i."'>".$i."</a>";
                     }
                     else {
                         $pagLink .= "<a href='welcome.php?page=".$i."'>".$i."</a>";
                     }
        };
        echo $pagLink . "</div>";
         ?>
     </div>
     <br/>
</div>

  <!-- end of main page content -->

<!-- Footer Start -->
<?php
  include 'footer.php'
?>
<!-- Footer End -->
