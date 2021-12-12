<?php # Script 9.5 - register.php #2
// 	Name: Ronald Seam
//	Term: Fall 2021 Semester

// 	Updated 11/20/2021 Sood Lahiri
// 	page creates a new customer
// 	This script performs an INSERT query to add a record to the CUSTOMER table.


$page_title = 'Customer Register';
include('inc_header_public.php');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require('db.php'); // Connect to the db.

	$errors = []; // Initialize an error array.
	/* 	
		----------------------------------------
		Check the inputs from the form
		First name, last name, email, password
		the check box is optional.
		----------------------------------------	
	*/

	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fname = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}

	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your Last name.';
	} else {
		$lname = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}

	// Check for an email address:
	if (empty($_POST['user_email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$email = mysqli_real_escape_string($dbc, trim($_POST['user_email']));			
	}
	
	// Check for a password and match against the confirmed password:
	if (empty($_POST['user_pass'])) {
		$errors[] = 'You forgot to enter a password.';
	} else {
		$password = mysqli_real_escape_string($dbc, trim($_POST['user_pass']));	
		$p = password_hash($password, PASSWORD_DEFAULT);
	}

	// get the checkbox value
	if(!empty($_POST['email_subscriber']))
	{	
		if($_POST['email_subscriber'] == "yes")
			$subscribe = 1;
		else 
			$subscribe = 0;
	}
	else
	{
		$subscribe = 0;
	}



	if (empty($errors)) { // If everything's OK.
		//Check if email already exists
		$q = "SELECT customer_id FROM CUSTOMER WHERE user_email='$email';";
		$r = @mysqli_query($dbc, $q);
		$num = mysqli_num_rows($r);
//		echo "Querying the email. Result: $num results.";

		if($num == 0)
		{
			// Make the query:
			$q = "INSERT INTO CUSTOMER (first_name, last_name, user_email, user_pass, email_subscriber) 
				VALUES ('$fname', '$lname', '$email', '$p', $subscribe)";
			$r = @mysqli_query($dbc, $q); // Run the query.
			if ($r) { // If it ran OK.

				// Print a message:
				echo '<h3>Thank you!</h3>
				<p>You are now registered as an User.</p>';
				
				// Adding code to send mail once someone has been registered.
				
				$subject = "Do you like coffee?";
				$body = "Hello $fname,\nThank you for signing up for the javascipt coffee newsletter.\nSign in today and get special discounts.\n\nYou can login from this link:\nhttps://javascript.webdevstudent.me/cust_login.php\n";
				$from = "javascript_admin@javascript.webdevstudent.me";
				$headers = "From: $from";

				mail($email, $subject, $body, $headers);
				
				// Clear the form
				$_POST = [];
			} else { // If it did not run OK.

				// Public message:
				echo '<h3>System Error</h3>
				<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';

				// Debugging message:
				echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';

			} // End of if ($r) IF.

			// Include the footer and quit the script:
			include('inc_footer.php');
			exit();
		}
		else
		{
			echo '<h3>This email already exists, please try again.</h3>';
		}
		mysqli_close($dbc); // Close the database connection.

	} else { // Report the errors.

		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br>\n";
		}
		echo '</p><p>Please try again.</p><p><br></p>';

	} // End of if (empty($errors)) IF.
} // End of the main Submit conditional.
?>
<div id="formbox">
	<h1 class="form-center-title">Create an account <img src="mlogo.svg" alt="cup flair image" width=50px 
id="mlogo"></h1>
	<div>
		<form enctype="multipart/form-data" action="user_reg.php" method="post" id="regform" class="form-center">
		<p><input type="text" class="form-center" name="first_name" placeholder="First name" required size="20" value="<?php if(isset($_POST['first_name'])) echo $_POST['first_name']?>"></p>
		<p><input type="text" class="form-center" name="last_name" placeholder="Last name" required size="20" value="<?php if(isset($_POST['last_name'])) echo $_POST['last_name']?>"></p>
		<p><input type="email" class="form-center" name="user_email" placeholder="Email address" required size="20" value="<?php if(isset($_POST['user_email'])) echo $_POST['user_email'] ?>"></p>
		<p><input type="password" class="form-center" name="user_pass" placeholder="Password" required size="20"></p>
		<p style="color:#000;font-weight:bold;">Email is a great way to receive special offers. <br/><br/>
			<input type="checkbox" name="email_subscriber" value="yes" checked="checked"> Yes, I'd like to receive emails from JavaScript Cafe
		</p>
		<p><input type="submit" value="Create Account" style="font-weight:bold"><img id=cuppa src="cuppa1.svg" alt="cup flair image" ></p>
		</form>
	</div>
</div>
<?php
    include('inc_footer.php');
?>