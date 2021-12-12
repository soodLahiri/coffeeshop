<?php
require("inc_header_public.php");
require('db.php'); // Your db connection file -RS 11/13/2021
// this page will process the login information from the login.php password_get_info
// we are hard coding in an admin password for the purpose of this example

$errors = "none";

// Check to see if we have email and password values from our form, if not display an error message
if (!empty($_POST['email'])) {
    $email = mysqli_real_escape_string($dbc, trim($_POST['email']));
    echo "<p>email from textbox</p>";
}
else {
    echo "<p>Error - no email provided.</p>";
    $errors = "yes";
}

if (!empty($_POST['pword'])) {
    $pword = mysqli_real_escape_string($dbc, trim($_POST['pword']));
    echo "<p>password from textbox</p>";
}
else {
    echo "<p>Error - no password provided.</p>";
    $errors = "yes";
}

// if no errors, proceed with validating the email and password

if ($errors == "none") {
    // pull user info from database and check
    // set session if ok and go to welcome page
    // if not ok, then go back to the login page
    $q = "SELECT customer_id, user_email, user_pass 
        FROM CUSTOMER WHERE 
        user_email = '$email';";
    $r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br>MySQL Error: " . mysqli_error($dbc));
    if (@mysqli_num_rows($r) == 1) {
        // a match was made!
        echo "Found a match for $email";
        list($cust_id, $cust_email, $cust_pass) = mysqli_fetch_array($r, MYSQLI_NUM);
        mysqli_free_result($r);
        
        if (password_verify($pword, $cust_pass)) {
            // allow them in
            echo "You guessed it! Password matched.";
//            header("Location: http://localhost/lessons/project_wk1/project/customerpage.php");
            session_start();
            $_SESSION['customer_id'] = $cust_id;
            $_SESSION['login_type'] = "Customer";
            echo "<p>set the sessions variables.</p>";
//            header("Location: http://localhost/lessons/project_wk1/project/customerpage.php");            
            header("Location:customerpage.php");
//            echo "<p>Go to <a href='admin.php'>ADMIN dashboard</a></p>";
        }
        else {
            // kick them out for wrong password
            echo "Sorry, wrong password. Go back and try again.";
        } 
    }
    else {
        // kick them out for wrong email address
        echo "No match found in the DB for $email";
    }
}
