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
if($_SESSION['userType'] != 's')
{
    $_SESSION['RedirectError'] = "You were not logged in as an Admin<br/>";
    header("Location:login.php");
}
?>
<!-- Start of Main Page Content -->
<div class="container" style="margin-top: 2em;">
    <div class="row">
        <h2>Disabled Users</h2>
    </div>
    <?php
        echo '<table style="width:100%"><tr><th>User ID</th><th colspan="2">Email</th><th colspan="2">Date Registered</th></tr>';
        $sql = "SELECT user_id FROM users WHERE user_type ='d' ";
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

<!-- end of main page content -->

<!-- Footer Start -->
<?php
  include 'footer.php'
?>
<!-- Footer End -->
