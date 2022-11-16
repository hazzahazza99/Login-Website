<?php

$title = "Version 0.1.2";

//connecting to db
include("db_connect.php");

//SQL queries
$sql = "SELECT id, username FROM users ORDER BY createdAt";

//SQL queires result
$result = mysqli_query($conn,$sql);

//Fetch results as an array
$userlist = mysqli_fetch_all($result, MYSQLI_ASSOC);

//close connection
mysqli_free_result($result);
mysqli_close($conn);

//print_r($userlist);

?>

<!DOCTYPE html>
<html>
<?php include("header.php") ?>

<h4 class="center grey-text">User list:</h4>

<div class="container">
    <div class="row">
        <?php foreach($userlist as $users): ?>
    <div class = "col s6 md3">
        <div class="card z-depth-0">
            <div class = "card-content center">
                <h6><?php echo htmlspecialchars($users["id"]);  ?></h6>
                <div><?php echo htmlspecialchars($users["username"]);  ?></div>
            </div>
            <div class ="card-action center align">
                <a class="brand-text" href="profiles.php?id=<?php echo $users['id']?>">View Profile</a>
            </div>
        </div>
    </div>    
        <?php endforeach; ?>
    </div>
</div>


<?php include("footer.php") ?>
</html>