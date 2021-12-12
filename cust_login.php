<?php
    require("inc_header_public.php");
//    require('db.php'); // Your db connection file -RS 11/13/2021
?>
        <h1 class="form-center-title">Sign in or create an account<img src="mlogo.svg" alt="cup flair image" width=50px 
id=mlogo></h1>
        <!-- form starts -->
        <div>
        <form name="login" method="post" action="process_login.php" id="regform" class="form-center">
            <input type="text" class="form-center" name="email" placeholder="Enter your email address" required><br>
            <input type="password" class="form-center" name="pword" placeholder="Enter your password" required><br>
            <p style="text-align:center;">New user? <b><a href="user_reg.php">Create an Account</a></b></p><br>

            <input type="submit" value="Sign in" class="form-center">
        </form>
</div>
        <!-- form ends -->
    </body>
</html>