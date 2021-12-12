<?php
    $page_title = 'Delete coupon';
    include('inc_header_session.php');
    echo "<main><div>";
    
    if((isset($_GET['id'])) && (is_numeric($_GET['id'])))
    {
        $id = $_GET['id'];
    }
    elseif((isset($_POST['id'])) && (is_numeric($_POST['id'])))
    {
        $id = $_POST['id'];
    }
    else
    {
        echo '<p class="error">This page has been accessed in error.</p>';
        exit();    
    }

    require('db.php');

    // if request method is post, then delete from DB
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //  echo "<p>We got called by post method to DELETE!</p>";
        if($_POST['sure'] == 'Yes')
        {
            echo "<p>You selected Yes, on deletion!</p>";
            $q = "DELETE FROM COUPON WHERE id = $id LIMIT 1;";  
            $r = @mysqli_query($dbc, $q);
            if(mysqli_affected_rows($dbc) == 1)
            {
                echo "<p>The coupon has been deleted.</p>";
            }
            else
            {
                echo '<p class="error">The user could not be deleted due to error</p>';
                echo '<p>' . mysqli_error($dbc) . '<br>Query: ' . $q . '</p>';
            }
        }
        else
        {
            echo "<p>You chose not to delete the coupon.</p>";
        }
    }
    else
    {
        //  echo "<p>We are not in POST</p>";
        $q = "SELECT code, description FROM COUPON WHERE id = $id";  
        $r = @mysqli_query($dbc, $q);
        $rowcount = mysqli_num_rows($r);
        
        if($rowcount != 1)
        {
            echo "<p>Problem encountered in DB!</p>";
        }
        else
        {
            $row = mysqli_fetch_assoc($r);
            printf("Coupon code: %s<br>Description: %s<br>
            Are you sure you want to delete this coupon?<br><br>", $row['code'], $row['description']);

            echo <<<_END
            <form action="delete_coupon.php" method="post">
            <label for="yes">Yes</label>
            <input type="radio" id="yes" name="sure" value="Yes">
            <label for="no">No</label>
            <input type='radio' id="no" name='sure' value='No'>                                 
            <input type='hidden' name='id' value='$id'><br><br>
            <input type='submit' value='DELETE RECORD'></form>
        _END;
        }

    }
    
    echo "</div></main>";
?>