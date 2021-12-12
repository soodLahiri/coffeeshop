<?php

$page_title = 'Coupons List';
include('inc_header_session.php');
echo "<main><div>";//added by rs 12/3/2021
require_once('db.php');
echo "<h1>List of Coupons</h1>";

$q = "SELECT id, code, description, discount FROM COUPON";  
$r = @mysqli_query($dbc, $q);

if(@mysqli_num_rows($r) != 0)
{
    // build out a table
    echo "<center><table>
    <tr>
    <th align='left'>Edit</th>
    <th align='left'>Discount Code</th>
    <th align='left'>Discount</th>
    <th align='left'>Description</th>
    </tr>";

    while($row = mysqli_fetch_assoc($r))
    {   
        $tempID = $row['id'];
        $tempCode = $row['code'];
        $tempDescription = $row['description'];
        $tempDiscount = $row['discount'];

        printf(" <tr>
        <td align='left'><a href=\"edit_coupon.php?id=%d\">Edit</a></td>
        <td align='left'>%s</td>
        <td align='left'>%d %%</td>
        <td align='left'>%s</td>
        </tr>"
        , $tempID, $tempCode, $tempDiscount, $tempDescription);
    }
    echo "</table></center>";    
}
else
{
    echo "<p>There are currently 0 registered coupons.</p>";
}
/*    echo <<<HERE
        <form action="add_coupon.php"><br><br>
        <label>Add a new coupon</label><br>
        <input type="submit" value="Create coupon">
        </form>
        HERE;*/ 
    echo '<center><form action="add_coupon.php"><br><br>
        <label>Add a new coupon</label><br>
        <input type="submit" value="Create coupon">
        </form></center>'; //Line 44-49; Line 50-53 revised by rs 12/3/2021
?>
<?php
echo "</main></div>";//added by rs 12/3/2021
?>