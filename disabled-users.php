<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nazir
Name:			Kevin Astilla
Name:			Nathan Morris
Description:  	Login File For Homes For Gnomes
Date:         	28 September 2018
*/

require("header.php");
?>
<!-- Start of Main Page Content -->
<div class="container" style="margin-top: 2em;">
    <div class="row">
        <h2>Disabled Users</h2>
    </div>
    <?php
        echo '<div class="row">';
        $sql = "SELECT user_id FROM users WHERE user_type ='d' ";
        $result = pg_query(db_connect(), $sql);
        $total = pg_fetch_all($result);
        for($index = 0; $index < pg_num_rows($result); $index++)
        {
            $sql = "SELECT * FROM users WHERE user_id = '".$total[$index]['user_id']."'";
            $user_result = pg_query(db_connect(), $sql);
            $arrayRow = pg_fetch_assoc($user_result);
            echo $arrayRow['user_id'];
            echo "<br/>";
        }
    ?>
        </div>
        <br/>
        <div class="row justify-content-md-center">
        <?php /*
        $total_pages = ceil(count($listings) / IMAGE_LIMIT);
        $pagLink = "<div class='pagination'>";
        for ($i=1; $i<=$total_pages; $i++) {
                     if($i == $page)
                     {
                        $pagLink .= "<a class='active' href='dashboard.php?page=".$i."'>".$i."</a>";
                     }
                     else {
                         $pagLink .= "<a href='dashboard.php?page=".$i."'>".$i."</a>";
                     }
        };
        echo $pagLink . "</div>";
         */?>
     </div>
     <br/>
</div>

<!-- end of main page content -->

<!-- Footer Start -->
<?php
  include 'footer.php'
?>
<!-- Footer End -->
