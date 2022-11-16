<?php

include("db_connect.php");

$title = "Sign Up";
$email = $username = $password= "";
$errors = array("email"=>"","username"=>"","password"=>"",);

//POST check
if(isset($_POST["submit"])){
    if(empty($_POST["email"])){
        $errors["email"] = "Missing an email address <br />";
    } else {
        $email = ($_POST["email"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $errors["email"] = 'Invalid email';
        }
    }
    if(empty($_POST["username"])){
        $errors["username"] = "Missing a username <br />";
    } else {
        $username = $_POST['username'];
        //Start with a letter, length of 3-20, only alphanumeric (a-z,0-9)
        if(!preg_match("/^[A-Za-z][A-Za-z0-9]{2,21}$/", $username)){
            $errors["username"] = 'Invalid username';
        }
    }
    if(empty($_POST["password"])){
        $errors["password"] = "Missing a password <br />";
    } else {
        $password = $_POST['password'];
        //8+ characters, at least one upper & lower case letter, one special character and one number
        if(!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)){
            $errors["password"] = 'Invalid password';
        }
    }

    if(array_filter($errors)){
        //echo "errors in form";
    } else{

        $email = mysqli_real_escape_string($conn, $_POST["email"]);
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
        $hash = password_hash($password, PASSWORD_DEFAULT);

        //create sql
        $sql = "INSERT INTO users(email,username,password) VALUES('$email','$username','$hash')";

        //save to db + check

        if (mysqli_query($conn,$sql)){
            //success
            header("Location: index.php");
        } else {
            //fails
            echo 'query error: ' . mysqli_error($conn);
        }
        $hash = password_hash($password, PASSWORD_DEFAULT);
        //if (password_verify($password, $hash)){
        //    echo $password;
        //}
    }
} 
//POST check over

?>

<!DOCTYPE html>
<html>
<?php include("header.php"); ?>
<section class = "conainer black-text">
    <h4 class = "center">Enter your details below to create account</h4>
    <form class="white" action="signup.php" method="POST">
        <label>Email:</label>
        <input type="text" name="email" value="<?php echo $email ?>">
        <div class="red-text"><?php echo $errors["email"]; ?></div>
        <label>Username:</label>
        <input type="text" name="username" value="<?php echo $username ?>">
        <div class="red-text"><?php echo $errors["username"]; ?></div> 
        <label>Password:</label>
        <input type="password" name="password" value="<?php echo $password ?>">
        <div class="red-text"><?php echo $errors["password"]; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>
<?php include("footer.php"); ?>
</html>