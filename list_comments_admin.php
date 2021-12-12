
<?php

$page_title = 'List of Comments';
require('db.php');
include('inc_header_session.php');

echo "<main><div><h1>Comment Submissions</h1>"; //"<h1>User Management</h1>";

//$query = "SELECT * FROM COMMENTS ORDER BY comment_id DESC";
$query = "SELECT comment_id, DATE_FORMAT(entry_date, '%b %d %Y') AS comment_date, commenter_name, commenter_email, commenter_comment FROM `COMMENTS` ORDER BY comment_id DESC";

// Open db connection and run a query
$result = mysqli_query($dbc, $query);

/*
    <th>User ID</th>
    <th>First Name</th>
    <th>Last Name </th>
    <th>Email</th>
*/
$total_entries = mysqli_num_rows($result);

if($total_entries == 0)
{
    // There are no comments
    echo "<h2>Sad, we have no comments to display.</h2>";
}
else
{
    echo "<table class='center'>
    <tr>
        <th>Delete</th>
        <th>Date</th>
        <th>Commenter Name</th>
        <th>Email</th>
        <th>Comment</th>
    </tr>";
    
    while ($row = mysqli_fetch_assoc($result)) 
    {
        printf(" <tr>
        <td><a href='delete_comments.php?id=%d'>Delete</a></td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        <td>%s</td>
        </tr>"
        , $row['comment_id'],$row['comment_date'], $row['commenter_name'], $row['commenter_email'], $row['commenter_comment']);
    
    }
    
    echo "</table>";
}

echo "</div></main>";

?>
<?php
    include('inc_footer.php');
?>
</div>

</body>
</html>