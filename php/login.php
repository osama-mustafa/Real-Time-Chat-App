<?php 

session_start();
include_once "config.php";

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
}

if (isset($_POST['password'])) {
    $password = mysqli_real_escape_string($conn, $_POST['password']);
}

if (!empty($email) && !empty($password)) {
    $find_user_query = "SELECT * FROM users WHERE email = '{$email}'";
    $result = mysqli_query($conn, $find_user_query);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        if (password_verify($password, $hashed_password)) {
            $status = "Active now";
            $update_status_query = "UPDATE users SET status = '{$status}' WHERE unique_id = {$row['unique_id']}";
            $update_status_result = mysqli_query($conn, $update_status_query);
            if ($update_status_result) {
                $_SESSION['unique_id'] = $row['unique_id'];
                echo "success";
            }
        } else {
            die("Email or password is incorrect!");
        }

    } else {
        die("Email or password is incorrect!");
    }
} else {
    die("All input fields are required!");
}
