<?php

$page_title = 'Customer List';
include('inc_header_session.php');
echo "<main><div>";//added by rs 12/3/2021
echo "<h1>List of Customers</h1>";//echo "<p>List of Customers</p>"; revised by rs 12/3/2021
require_once('db.php');


$q = "SELECT CONCAT (first_name, ' ', last_name) AS fullName, user_email, email_subscriber FROM CUSTOMER ORDER BY first_name DESC;";  
$r = @mysqli_query($dbc, $q);
$rowcount = mysqli_num_rows($r);

if($rowcount > 0)
{
//    echo "<p>Returned results: $rowcount</p>";

    printf("<center><table>
    <tr>
    <th align='left'>Name</th>
    <th align='left'>Email Address</th>
    <th align='left'>Email Subscriber</th>
    </tr>"); 

    while($row = mysqli_fetch_assoc($r))
    {   
        $tempName = $row['fullName'];
        $tempEmail = $row['user_email'];
        $tempSubscriber = $row['email_subscriber'];

        printf(" <tr>
        <td align='left'>%s</td>
        <td align='left'>%s</td>
        <td align='left'>%d</td>
        </tr>"
        , $tempName, $tempEmail, $tempSubscriber);
    }
    echo "</table></center>";   
}
else
{
    echo "<p>Something went wrong, bad row counts.</p>";
}
echo "</div></main>";//added by rs 12/3/2021
?>