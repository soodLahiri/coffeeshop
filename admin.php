<?php

require('inc_header_session.php');
require('db.php');

echo "<main><p>Hello, " . $_SESSION['username'] . "</p>";


?>
<!--<div class="bgimg">
    <div style="background-color: rgba(255,255,255,.5);">-->
            <div class='centered'>
                <h1>Admin Menu</h1>
                <ul class='list'>
                    <li><a href="list_customers_admin.php">List Customers</a></li>
                    <li><a href="list_coupon_admin.php">List Coupon</a></li>
                    <li><a href="list_customer_coupon.php">List Customer Coupon</a></li>
                    <li><a href='add_category.php'>Add Category</a></li>
                    <li><a href="list_category_admin.php">List/Edit Category</a></li>
                    <li><a href='add_product.php'>Add Product</a></li>
                    <li><a href="list_product_admin.php">List/Edit Product</a></li>
                    <li><a href='logout.php'>Logout</a></li>
                </ul>
            </div>
    </main>
<!--</div>-->