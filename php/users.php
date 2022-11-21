<?php

session_start();
include_once "config.php";
include_once "helper.php";

$outgoing_id    = $_SESSION['unique_id'];
$select_query   = "SELECT * FROM users WHERE NOT unique_id = {$outgoing_id}";
$result         = mysqli_query($conn, $select_query);
$output         = '';

if (mysqli_num_rows($result) == 0) {
    $output .= "No users are available to chat!";
} elseif (mysqli_num_rows($result) > 0) {
    include "data.php";
    echo $output;
}
