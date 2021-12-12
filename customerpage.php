<?php
//    require('inc_header_cust_session.php');
include('inc_header_cust_session.php');
    
    require('db.php'); // Connect to the db.
 

    // get the session values
    $tempCustID = $_SESSION['customer_id'];
    $tempLoginType = $_SESSION['login_type'];

    echo "<p>Session customer id: $tempCustID<p>";
    echo "<p>Session Login type: $tempLoginType<p>";

//     $q = "SELECT first_name FROM CUSTOMER WHERE customer_id=2;";
    
    $q = "SELECT first_name FROM CUSTOMER WHERE customer_id='$tempCustID';";
    $r = @mysqli_query($dbc, $q);
    $num = mysqli_num_rows($r);

    if($num != 0)
    {
        // print out name
        $row = mysqli_fetch_assoc($r);
        $tempFName = $row['first_name'];
    }
    else
    {
        echo "<p>Error in DB retreival</p>";
    }
    echo "<h1>Welcome to $tempFName's details page!</h1>";
    echo "Your customer id: $tempCustID<br> Login type: $tempLoginType<br>";

    $q = "SELECT CUSTOMER.first_name, COUPON.discount, COUPON_CUSTOMER.status 
    FROM COUPON, COUPON_CUSTOMER, CUSTOMER
    WHERE COUPON.id = COUPON_CUSTOMER.coupon_id
    AND CUSTOMER.customer_id = COUPON_CUSTOMER.customer_id    
    AND CUSTOMER.customer_id = $tempCustID;"; 
    
    $r = @mysqli_query($dbc, $q);
    
    if(@mysqli_num_rows($r) == 0)
    {
        echo "<p>You have no coupons on file.</p>";
    }
    else
    {
        echo "<h3>Your active coupons</h3>";
        echo "<table>
        <tr>
        <th>Customer</th>
        <th>Discount</th>
        <th>Coupon status</th>
        </tr>";
        while($row = mysqli_fetch_row($r))
        {
            $tempCustomer = $row[0];
            $tempDiscount = $row[1];
    
            if ($row[2] == 0)
                $tempStatus = 'Inactive';
            if ($row[2] == 1)
                $tempStatus = 'Active';
    
            printf(" <tr>
            <td>%s</td>
            <td>%d %%</td>
            <td>%s</td>
            </tr>"
            , $tempCustomer, $tempDiscount, $tempStatus);
        }
        echo "</table>";
    }

     
?>