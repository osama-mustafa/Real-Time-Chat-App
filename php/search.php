<?php 

session_start();

include_once "config.php";
include_once "helper.php";

$outgoing_id = $_SESSION['unique_id'];


if (isset($_POST['searchTerm'])) {
    $search_term = mysqli_real_escape_string($conn, $_POST['searchTerm']);
}

$find_query = "SELECT * FROM users WHERE (NOT unique_id = {$outgoing_id})
                AND (first_name LIKE '%{$search_term}%'
                OR last_name LIKE '%{$search_term}%')";
$output     = "";
$result     = mysqli_query($conn, $find_query);

if (mysqli_num_rows($result) > 0) {
    include "data.php";
} else {
    $output .= "No user found related to your search term"; 
}

echo $output;
