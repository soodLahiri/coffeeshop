<?php
// program to save the customers comments

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    require('db.php');

    // check the contact form inputs
	// Check for a name:
    if (empty($_POST['commenter_name'])) {
        $errors[] = 'You forgot to enter your name.';
    } else {
        $fullname = mysqli_real_escape_string($dbc, trim($_POST['commenter_name']));
    }    

	// Check for an email address:
    if (empty($_POST['commenter_email'])) {
        $errors[] = 'You forgot to enter your email address.';
    } else {
        $email = mysqli_real_escape_string($dbc, trim($_POST['commenter_email']));			
    }
        
	// Check for a comment:
    if (empty($_POST['commenter_comment'])) {
        $errors[] = 'You forgot to enter a comment.';
    } else {
        $message = mysqli_real_escape_string($dbc, trim($_POST['commenter_comment']));
    }
    
    if(empty($errors))
    {
        // upload to database
        $q = "INSERT INTO COMMENTS (commenter_name, commenter_email, commenter_comment) 
                VALUES (    '$fullname', 
                            '$email', 
                            '$message');";
        $r = @mysqli_query($dbc, $q);

        // provide success message if uploaded successfully
        // provide failure message if it could not be uploaded
        if ($r) 
        { // If it ran OK.
            // Print a message:
            echo '<h1>Thank you for your message!</h1>
            <p>We take your comments very seriously.</p>';

            // Clear the form
            $_POST = [];
        } 
        else 
        { // If it did not run OK.
            // Public message:
            echo '<h1>System Error</h1>
            <p class="error">Your comments could not be sent.</p>';

            // Debugging message:
            echo '<p>' . mysqli_error($dbc) . '<br><br>Query: ' . $q . '</p>';

        } // End of if ($r) IF.        
    } // end of if statement, no errors found
    else
    {
        // report the errors
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br>';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br>\n";
		}
		echo '</p><p>Please try again.</p><p><br></p>';        
    }
}
?>
