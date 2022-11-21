<?php
session_start();

if (isset($_SESSION["unique_id"])) {
    include_once "config.php";
    include_once "helper.php";

    if (isset($_POST['outgoing_id'])) {
        $outgoing_id = mysqli_real_escape_string($conn, $_POST['outgoing_id']);
    }
    if (isset($_POST['incoming_id'])) {
        $incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
    }

    $output = "";
    $get_messages_query = "SELECT * FROM messages
                            LEFT JOIN users ON users.unique_id = messages.outgoing_msg_id
                            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
                            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id})
                            ORDER BY messages.id ASC";
    $result = mysqli_query($conn, $get_messages_query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {

            // He is a message sender
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>' . $row['message'] . '</p>
                                </div>
                            </div>';

            // He is a message receiver
            } else {
                $output .= '<div class="chat incoming">
                                <img src="php/images/' . $row['image'] . '" alt="">
                                <div class="details">
                                    <p>' . $row['message'] . '</p>
                                </div>
                            </div>';
            }
        }
         echo $output;
    }
} else {
    header('Location: ../login.php');
}


?>
