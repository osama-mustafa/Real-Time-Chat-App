<?php 

$hostname   = "127.0.0.1";
$username   = "root";
$password   = "";
$database   = "chat";

$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
    die("Connection Failed!" . mysqli_connect_error());
}

?>