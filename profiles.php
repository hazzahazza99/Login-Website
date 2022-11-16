<?php

include("db_connect.php");

if (isset($_GET['id'])){

    $id = mysqli_real_escape_string ($conn, $_GET['id']);
    $sql = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn,$sql);
    $user = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
}

$title = "Profiles - $user[username]"

?>

<!DOCTYPE html>
<html>
    <?php include("header.php"); ?>

    <div class="container center">
        <?php if ($user): ?>
            <h4><?php echo htmlspecialchars($user["username"]);?></h4>
            <p>User ID: <?php echo htmlspecialchars($user["id"]); ?></p>
            <p>User Since: <?php echo date($user["createdAt"])?></p>

        <?php else: ?>

        <?php endif; ?>
    </div>

    <?php include("footer.php"); ?>
</html>