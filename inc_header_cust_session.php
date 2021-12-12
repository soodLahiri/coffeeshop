<!DOCTYPE html>
<html>
    <head>
        <title>javaScript Cafe</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles_admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Life+Savers:wght@400;700;800&display=swap" rel="stylesheet">
    </head>
    <body>
    <?php
        // check that session exists or kick them out
        session_start();
         // debugging to dump session variables on page - print_r($_SESSION);
         
        if ((isset($_SESSION['customer_id']))&&($_SESSION['login_type'] == 'Customer')) 
        {

        // show navigation menu
            echo '<div class="topnav" id="Topnav">
            <a href="customerpage.php">Customer</a>
            <a href="logout.php">LOGOUT</a>
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
            </div>';
        }
        else {
            // no session - kick them out
            echo "<p>Sorry, you do not have permission to access this page.</p>";
            header("Location:index.php");
            exit();
        }
    ?>

    <script>
        function myFunction() {
        var x = document.getElementById("Topnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
        }
    </script>