<?php
    $page_title = 'Customers and coupons';
    require('inc_header_session.php');
    echo "<main><div>";
    require('db.php'); // Connect to the db.

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {   
        echo "<h1>You submitted something!!</h1>";

        $tempCustomerID = $_POST['customer'];
        $tempCouponID   = $_POST['coupon'];

        echo "<p>customer id: $tempCustomerID<br>";
        echo "coupon id: $tempCouponID</p>";

        // we read the number of results of current customer + coupon combo
        $q = "SELECT COUNT(*) AS temptotal
        FROM COUPON_CUSTOMER 
        WHERE customer_id = $tempCustomerID AND coupon_id = $tempCouponID;";

        $r = @mysqli_query($dbc, $q);
        $row = mysqli_fetch_assoc($r);
        $num = $row['temptotal'];

        echo "Results found in DB: $num";

        if($num == 0)
        {
            $q = "INSERT INTO COUPON_CUSTOMER(customer_id, coupon_id, status) 
            VALUES ($tempCustomerID, $tempCouponID, 1)";
            $r = @mysqli_query($dbc, $q);

            if (mysqli_affected_rows($dbc) == 1)
            {
                echo "<p>You have successfully added a coupon to the customer!</p>";
                $_POST = [];
            }
            else
            {
                // Public message:
                echo '<h1>System Error</h1>
                <p class="error">Could not register coupon due to a system error. We apologize for any inconvenience.</p>';

                // Debugging message:
                echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';
            }
        }
        else
        {
            echo "<p>That customer already has that coupon. Try again.</p>";
        }

    }
    else
    {
        $q = "SELECT CONCAT(CUSTOMER.first_name, ' ', CUSTOMER.last_name) AS full_name, COUPON.code AS coup_code, COUPON.discount AS coup_discount, COUPON_CUSTOMER.status AS coup_status 
        FROM COUPON, COUPON_CUSTOMER, CUSTOMER
        WHERE COUPON.id = COUPON_CUSTOMER.coupon_id
        AND CUSTOMER.customer_id = COUPON_CUSTOMER.customer_id
        ORDER BY full_name ASC;";  

        $r = @mysqli_query($dbc, $q);
            
        if(@mysqli_num_rows($r) == 0)
        {
            echo "<p>There are no coupons on file.</p>";
        }
        else
        {
            echo "<h3 style='color:white;'><center>Customers and Coupon List</center></h3>";
            echo "<center><table style='color:white;'>
            <tr>
            <th>Customer Name</th>
            <th>Discount Code</th>
            <th>Percent Discount</th>
            <th>Status</th>
            </tr>";
            while($row = mysqli_fetch_assoc($r))
            {
                $tempCustomer = $row['full_name'];
                $tempDiscountCode = $row['coup_code'];
                $tempCoupDiscount = $row['coup_discount'];

                if ($row['coup_status'] == 0)
                    $tempStatus = 'Inactive';
                if ($row['coup_status'] == 1)
                    $tempStatus = 'Active';

                printf(" <tr>
                <td>%s</td>
                <td align='center'>%s</td>
                <td align='center'>%d%%</td>
                <td align='left'>%s<td>
                </tr>",
                $tempCustomer, $tempDiscountCode, $tempCoupDiscount, $tempStatus);
            }
            echo "</table></center>";
        }        
    }



    // get the list of customers
    $q = "SELECT CONCAT (first_name, ' ', last_name) AS full_name, customer_id AS cust_id FROM CUSTOMER ORDER BY first_name ASC;";  
    $r = @mysqli_query($dbc, $q);
    
?>    
                <h3 style='color:white;'><center>Assign a Coupon</center></h3>
                <center><form action="list_customer_coupon.php" method="post">         
                    <label for="customer" style='color:white;'>Select a Customer:</label>
                    <select id="customer" name="customer">
<?php
                    while($row = mysqli_fetch_assoc($r))
                    {
                        printf("<option value='%d'>%s</option>", $row['cust_id'], $row['full_name']);
                    }
?>                                                
                    </select><br>
                    <label for="coupon" style='color:white;'>Select a Coupon:</label>
                    <select id="coupon" name="coupon">
<?php
                    $q = "SELECT id, code FROM COUPON";  
                    $r = @mysqli_query($dbc, $q);
                    
                    while($row = mysqli_fetch_assoc($r))
                    {
                        printf('<option value="%d">%s</option>', $row['id'], $row['code']);
                    }
?>                                            
                    </select><br>
                <input type="submit">
                </form></center>
</main></div>                


    

                
