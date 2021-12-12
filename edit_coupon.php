<?php
$page_title = 'Edit coupon';
include('inc_header_session.php');
echo "<main><div>";
echo "<h1>Edit coupon</h1>";

// check $_GET, $_POST or else
if((isset($_GET['id'])) && (is_numeric($_GET['id'])))
{
    $id = $_GET['id'];
//    echo "<br>GET ID activated. id: $id<br>";
}
elseif((isset($_POST['id'])) && (is_numeric($_POST['id'])))
{
    $id = $_POST['id'];
//    echo "<br>POST ID activated. id: $id<br>";
}
else
{
	echo '<p class="error">This page has been accessed in error.</p>';
	exit();    
}

require('db.php');

// check for POST then check the textbox values
if($_SERVER['REQUEST_METHOD'] == 'POST')
{   
    $errors = [];

    if (empty($_POST['coup_code'])) {
        $errors[] = 'You forgot to enter the coupon code.';
    } 
    else {    
        $tempCode = mysqli_real_escape_string($dbc, trim($_POST['coup_code']));
    }

    if (empty($_POST['coup_description'])) {
        $errors[] = 'You forgot to enter the description.';
    } 
    else {    
        $tempDescription = mysqli_real_escape_string($dbc, trim($_POST['coup_description']));
    }      

    if (empty($_POST['discount'])) {
        $errors[] = 'You forgot to enter the discount.';
    } 
    else {
        $tempDiscount = mysqli_real_escape_string($dbc, trim($_POST['discount']));
    }

    if(empty($errors))
    {
        $q = "SELECT id FROM COUPON WHERE code = '$tempCode' AND id != $id";  
        $r = @mysqli_query($dbc, $q);
        $rowcount = mysqli_num_rows($r);
        if ($rowcount == 0)
        {
            echo "Coupon code does not already exist, updating record";

            $q = "UPDATE COUPON SET code = '$tempCode', description = '$tempDescription', discount = $tempDiscount
            WHERE id = $id LIMIT 1"; 
            $r = @mysqli_query($dbc, $q); 
            if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
                echo '<p>The coupon info has been edited.</p>';
                $_POST = [];
            }
            else
            {
                echo "<br>The coupon update command did not run properly.<br>";
                echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $q . '</p>';
            }                       
        }
        else
        {
            echo "<p>Sorry this coupon code has already been registered.</p>";
        }
    }
    else { // Report the errors.

        echo '<p class="error">The following error(s) occurred:<br>';
        foreach ($errors as $msg) { // Print each error.
            echo " - $msg<br>\n";
        }
        echo '</p><p>Please try again.</p>';

    } // End of if (empty($errors)) IF.        
    

    
}
// Display the coupon info from DB
$q = "SELECT id, code, description, discount FROM COUPON WHERE id = $id";  
$r = @mysqli_query($dbc, $q);

if(mysqli_num_rows($r) == 1)
{
    $row = mysqli_fetch_assoc($r);
    $tempID = $row['id'];
    $tempCode = $row['code'];
    $tempDescription = $row['description'];
    $tempDiscount = $row['discount'];

    printf('<form action="edit_coupon.php" method="post">
    <input type="hidden" name="id" value="%d">
    <p>Coupon code <input type="text" name="coup_code" required size="20" value="%s"></p>
    <p>Description <textarea name="coup_description" rows="5" cols="40" >%s</textarea></p>
    <p>Discount %% <input type="number" name="discount" value="%d"></p>
    <input type="hidden" name="edit" value="yes">
    <input type="hidden" name="delete" value="no">
    <p><input type="submit" value="Submit"></p></form>'
    , $tempID, $tempCode, $tempDescription, $tempDiscount);

    echo <<<_END
        <form action="delete_coupon.php" method="get">
        <input type="hidden" name="edit" value="no">
        <input type='hidden' name='delete' value='yes'>
        <input type='hidden' name='id' value='$tempID'>
        <input type='submit' value='DELETE RECORD'></form>
    _END;
}
    echo "</div></main>";
?>


