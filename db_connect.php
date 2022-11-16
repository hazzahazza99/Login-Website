<?php 

$conn = mysqli_connect("localhost","harry","Test1234","loginsystem");
if (!$conn){
    echo "Connection Error" . mysqli_connect_error();
}

?>