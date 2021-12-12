<?php
// check if all the textboxes have input
// check if coupon already exists
// if not, then add it to the DB

$page_title = 'Add Coupon';
include('inc_header_session.php');
echo "<main><div>";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require('db.php'); // Connect to the db.
    
    $code =  $_POST['coup_code'];

    $q = "SELECT * FROM COUPON WHERE code = '$code'";  
    $r = @mysqli_query($dbc, $q);
    $num = mysqli_num_rows($r);
    if($num > 0)
    {
        echo "<br>Code already exists, please try a new code.";
    }
    else
    {
        // Code does not exist, free to enter

//        echo "<br>Scram! no results found!</br>";
        $coupon_description = $_POST['coup_description'];
        $coupoun_discount = $_POST['coup_discount'];

        $q = "INSERT INTO COUPON(code, description, discount) 
            VALUES ('$code','$coupon_description','$coupoun_discount')";  
        $r = @mysqli_query($dbc, $q);

        if ($r) { // If it ran OK.

            // Print a message:
            echo '<h1>Thank you!</h1>
            <p>You have registered a coupon.</p>';

            // Clear the form
            $_POST = [];
        } else { // If it did not run OK.

            // Public message:
            echo '<h1>System Error</h1>
            <p class="error">Could not register coupon due to a system error. We apologize for any inconvenience.</p>';

            // Debugging message:
            echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';

        } // End of if ($r) IF.

    }
    mysqli_close($dbc);
    
}

?>
<div id="form">
	<h1>Register a new coupon</h1>
	<div class="register_form">
		<form enctype="application/x-www-form-urlencoded" action="add_coupon.php" method="post">
		<p><input type="text" name="coup_code" placeholder="Enter a coupon code" required size="20" value="<?php if(isset($_POST['coup_code'])) echo $_POST['coup_code']?>"></p>
		<p><textarea name="coup_description" rows="5" cols="40" placeholder="Enter a coupon description"><?php if(isset($_POST['coup_description'])) echo $_POST['coup_description'] ?></textarea></p>
        <p><input type="number" name="coup_discount" placeholder="Enter discount amount" required size="40" min="10" max="100" value="<?php if(isset($_POST['coup_discount'])) echo $_POST['coup_discount'] ?>"> ex: 25</p>

		<input type="submit" value="Create discount">

		</form>
	</div>
</div>
</div></main>