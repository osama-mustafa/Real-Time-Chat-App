<?php 

while ($row = mysqli_fetch_assoc($result)) {
    $select_last_message = "SELECT * FROM messages WHERE 
                        (incoming_msg_id = {$row['unique_id']} OR outgoing_msg_id = {$row['unique_id']})
                        AND 
                        (outgoing_msg_id = {$outgoing_id})
                        ORDER BY id
                        DESC
                        LIMIT 1";
                        
    $message_query = mysqli_query($conn, $select_last_message);
    $data = mysqli_fetch_assoc($message_query);

    if (mysqli_num_rows($message_query) > 0) {
        $message = $data['message'];
    } else {
        $message = "No message sent!";
    }

    strlen($message) > 5 ? substr($message, 0, 28) . "..." : $message;
    $you_prefix = "";
    if (isset($data['outgoing_msg_id'])) {
        $you_prefix = "You: ";
    }

    ($row['status'] == "Offline now") ? $offline = "offline" : $offline = "";
    $output .= '<a href="chat.php?user_id=' . $row['unique_id'] .'">
                    <div class="content">
                        <img src="php/images/' . $row['image'] . '" alt="">
                        <div class="details">
                            <span>' . $row["first_name"] . " " . $row['last_name'] .'</span>
                            <p>' . $you_prefix . $message . '</p>
                        </div>
                    </div>
                    <div class="status-dot ' . $offline . '">
                        <i class="fas fa-circle"></i>
                    </div>
                </a>';
}


?>