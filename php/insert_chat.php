<?php 
session_start();

if (isset($_SESSION["unique_id"])) {
    
    include_once "config.php";

    if (isset($_POST['outgoing_id'])) {
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    }
    if (isset($_POST['incoming_id'])) {
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    }

    if (isset($_POST['message'])) {
        $message = mysqli_real_escape_string($conn, $_POST['message']);
    }

    if (!empty($message)) {
        $insert_query = "INSERT INTO messages (outgoing_msg_id, incoming_msg_id, message)
                         VALUES ({$outgoing_id}, {$incoming_id}, '{$message}')";
        $result = mysqli_query($conn, $insert_query);
    }

} else {
    header('Location: ../login.php');
}


?>