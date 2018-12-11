<?php
/*
Name:         	Ramandeep Rathor
Name:           Musab Nizar
Name:			Kevin Astilla
Name:			Nathan Morris
Description:  	Admin File For Homes For Gnomes
Date:         	10th December 2018
*/

require "header.php";
// If the session was never set with a user id
$output = '';
$conn = db_connect();
if($_SESSION['userType'] != 's')
{
    $_SESSION['RedirectError'] = "You were not logged in as an Admin<br/>";
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
 if(isPost())
 {
    if(isset($_POST['approve']))
    {
        $sql = "UPDATE users SET user_type='a' WHERE user_id='".$_POST['approve']."'";
        $result = pg_query($conn,$sql);
        $output .= "Account approved for Agent Status<br/>";
    }
    else if (isset($_POST['reject'])) {
        // $sql = "DELETE FROM users WHERE user_id='".$_POST[reject]."'";
        // $result = pg_query($conn,$sql);
        $output .= "Account declined for Agent Status<br/>";
    }
 }
?>
  <!-- start of main page content -->
<div class="container" style="margin-top: 2em;">
    <h2>Admin Page</h2>
    <div class="row">

        <p>Welcome back <?php echo $_SESSION['userID']; ?> you last logged in on <?php echo $_SESSION['last_access']; ?></p>
    </div>
    <div class="row">
        <h4><?php echo $output; ?></h4>
    </div>
    <ul class="nav nav-pills">
      <li style="padding-right: 2em;" class="active"><a class="btn btn-outline-success" data-toggle="pill" href="#reported">Reports</a></li>
      <li style="padding-right: 2em;"><a data-toggle="pill" class="btn btn-outline-success" href="#pending">Pending Accounts</a></li>
      <li><a class="btn btn-outline-success" href="disabled-users.php">Disabled Users</a></li>
    </ul>
    <hr/>
    <div class="tab-content">
      <div id="reported" class="tab-pane fade in active">
        <h3>Reported Listings</h3>
        <?php
            echo '<div class="row">';
            $sql = "SELECT listing_id FROM offensives";
            $result = pg_query($conn, $sql);
            $listings = pg_fetch_all($result);
            for($index = 0; $index < pg_num_rows($result); $index++)
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
                            $pagLink .= "<a class='active' href='admin.php?page=".$i."'>".$i."</a>";
                         }
                         else {
                             $pagLink .= "<a href='admin.php?page=".$i."'>".$i."</a>";
                         }
            };
            echo $pagLink . "</div>";
             ?>
         </div>
      </div>
      <div id="pending" class="tab-pane fade">
          <h3>Pending Agent</h3>
          <?php
              echo '<table style="width:100%"><tr><th>User ID</th><th colspan="2">Email</th><th colspan="2">Date Registered</th></tr>';
              $sql = "SELECT user_id FROM users WHERE user_type ='p' ";
              $result = pg_query(db_connect(), $sql);
              $total = pg_fetch_all($result);
              for($index = 0; $index < pg_num_rows($result); $index++)
              {
                  $sql = "SELECT * FROM users WHERE user_id = '".$total[$index]['user_id']."'";
                  $user_result = pg_query(db_connect(), $sql);
                  $arrayRow = pg_fetch_assoc($user_result);
                  echo "<tr>";
                  echo '<td>'.$arrayRow['user_id'].'<td/>';
                  echo '<td>'.$arrayRow['email_address'].'<td/>';
                  echo '<td>'.$arrayRow['enrol_date'].'<td/>';
                  echo '<form method= "post">';
                  echo '<button type="submit" class="btn btn-link" name=\'approve\' value='.$arrayRow['user_id'].'>Approve</button>';
                  echo '<button type="submit" class="btn btn-link" name=\'reject\' value='.$arrayRow['user_id'].'>Reject</button>';
                  echo '</form><tr/>';
              }
          ?>
      </table>
      </div>
      <br/>
    </div>
</div>

<!-- end of main page content -->

<!-- Footer Start -->
<?php
    include 'footer.php'
?>
<!-- Footer End -->
