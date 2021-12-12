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
        <style>
                        /* Navbar container */
            .navbar {
            overflow: hidden;
            background-color: #333;
            font-family: Arial;
            }

            /* Links inside the navbar */
            .navbar a {
            float: left;
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            }

            /* The dropdown container */
            .dropdown {
            float: left;
            overflow: hidden;
            }

            /* Dropdown button */
            .dropdown .dropbtn {
            font-size: 16px;
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit; /* Important for vertical align on mobile phones */
            margin: 0; /* Important for vertical align on mobile phones */
            }

            /* Add a deepskyblue background color to navbar links on hover */
            .navbar a:hover, .dropdown:hover .dropbtn {
            background-color: deepskyblue;
            }

            /* Dropdown content (hidden by default) */
            .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            }

            /* Links inside the dropdown */
            .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
            }

            /* Add a grey background color to dropdown links on hover */
            .dropdown-content a:hover {
            background-color: #ddd;
            }

            /* Show the dropdown menu on hover */
            .dropdown:hover .dropdown-content {
            display: block;
            }

        </style>
    </head>
    <body>
    <?php
        // check that session exists or kick them out
        session_start();
         // debugging to dump session variables on page - print_r($_SESSION);
         
        if (isset($_SESSION['user_id'])) {

        // show navigation menu
            echo '<div class="navbar" class="topnav" id="Topnav">
                    <a href="admin.php">ADMIN</a>
                    <a href="list_coupon_admin.php">LIST COUPON</a>
                    <a href="list_comments_admin.php">LIST COMMENTS</a>
                    <div class="dropdown">
                        <button class="dropbtn">CUSTOMER
                        <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                        <a href="list_customers_admin.php">LIST CUSTOMERS</a>
                        <a href="list_customer_coupon.php">LIST CUSTOMER COUPON</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn">CATEGORY
                        <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                        <a href="add_category.php">ADD CATEGORY</a>
                        <a href="list_category_admin.php">LIST/EDIT CATEGORY</a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="dropbtn">PRODUCT
                        <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-content">
                        <a href="add_product.php">ADD PRODUCT</a>
                        <a href="list_product_admin.php">LIST/EDIT PRODUCT</a>
                        </div>
                    </div>
                    <a href="logout.php">LOGOUT</a>
    <!--            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                        <i class="fa fa-bars"></i>
                    </a>-->
                </div>';
        }
        else {
            // no session - kick them out
            echo "<p>Sorry, you do not have permission to access this page.</p>";
            header("Location:login.php");
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
    