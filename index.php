<html>
<body>

<?php
  include('inc_header_public.php');
  include('sendcomments.php');

?> 

<!-- Header with image -->
  
<header class="bgimg" id="home">
  <div class="companyName">
    <div class="displayMessage">
    <span class="tag" style="font-family: 'Life Savers', cursive; font-size: 25px;">Open daily except on certain Holidays</span>
  </div>
    <span class="responsive" style="font-size:50px"><h1 style="font-size:9vw;"><center>javaScript<br>Cafe</center></h1></span>
    <h2 style="background-color: #000;color: #edead0;width: 15%;margin: auto;font-family: 'Life Savers', cursive;"><center>This Week's Special</center></h2>
  </div>  
</header>

<!-- Menu -->
  
<section id="menu-section" class="menu-section">
  <h1 id="menu">Menu</h1>

<div class="menu-card">
<div class="menu-img">
    <img src="uploads/coffeebeans1.jpg" alt="coffee">
    <button class="menu-link"><a href="coffee_products.php">Coffee</a></button>
</div>

<div>
<img src="uploads/teabags1.jpg" alt="tea">
  <button class="menu-link"><a href="tea_products.php">Tea</a></button>
</div>

<div>
<img src="uploads/foodpic1.jpg" alt="food">
  <button class="menu-link"><a href="food_products.php">Food</a></button>
</div>

<div>
<img src="uploads/brewathome1.jpg" alt="brew">
  <button class="menu-link"><a href="brew_products.php">Brew At Home</a></button> <!--href edit by rs 12/7/2021-->
</div>

<div>
<img src="uploads/merchandise1.jpg" alt="merch">
  <button class="menu-link"><a href="merch_products.php">Merch</a></button>
</div>
</div>

</section>

<hr>

<!-- Contact Form-->

<section id="contact-section" class="contact-section">

<div id="formbox">
	<h1 id="contact" class="form-center-title">Contact Us! <img src="mlogo.svg" alt="cup flair image" width=50px 
id="mlogo"></h1>
	<div>
		<center><form enctype="multipart/form-data" action="sendcomments.php" method="post" id="regform" class="form-center">
            <p><input type="text" placeholder="your name" name="commenter_name" size="30" maxlength="60" required value="<?php if(isset($_POST['commenter_name'])) echo $_POST['first_name']?>"></p>
	        <p><input type="email" placeholder="your email" name="commenter_email" size="30" maxlength="60" required value="<?php if(isset($_POST['commenter_email'])) echo $_POST['commenter_email']?>"></p>
	        <p><textarea placeholder="questions or concerns?" name="commenter_comment" rows="5" cols="30" value="<?php if(isset($_POST['commenter_comment'])) echo $_POST['commenter_comment']?>"></textarea></p>
	        <p style="color:#000;font-weight:bold;">Email is a great way to receive special offers. <br/><br/>
			<input type="checkbox" name="email_subscriber" value="yes" checked="checked"> Yes, I'd like to receive emails from JavaScript Cafe
		    </p>
		    <p><input type="submit" value="Submit" style="font-weight:bold"><img id=cuppa src="cuppa1.svg" alt="cup flair image" ></p>
		</form></center>
	</div>
</div>
</section>

<hr>

<!-- Hours of Operation -->

<div class="container-fluid">
  <div class="row">

    <div class="col-sm-6"><h2 id="hours"><center>Stop by<br>and<br>come in!</center></h2>
    </div>

    <div class="col-sm-3" style="border-right:none;"><h3><b>Cafe Hours</b></h3><br>
        <p>Monday 6am - 1pm</p>
        <p>Tuesday 6am - 1pm</p>
        <p>Wednesday 6am - 1pm</p>
        <p>Thursday 6am - 1pm</p>
        <p>Friday 6am - 1pm</p>
        <p>Saturday 6am - 4pm</p>
        <p>Sunday 6am - 4pm</p>
    </div>

    <div class="col-sm-3" style="border-left:none;"><h3><b>Holiday Hours</b></h3><br>
        <p>Monday Closed</p>
        <p>Tuesday - Saturday 8am - 12pm</p>
        <p>Sunday Closed</p>
    </div>

  </div>
</div>

</body>
</html>

<?php
    include('inc_footer.php');
?>