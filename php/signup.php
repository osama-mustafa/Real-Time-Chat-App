<?php

session_start();

include_once "config.php";
include_once "helper.php";

if (isset($_POST['first_name'])) {
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
}

if (isset($_POST['last_name'])) {
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
}

if (isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
}

if (isset($_POST['password'])) {
    $password = str_replace(' ', '', $_POST['password']);
    $password = password_hash($password, PASSWORD_DEFAULT);
}

if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password)) {

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
        if (mysqli_num_rows($sql) > 0) {
            die("{$email} - This email already exists!");
        } else {
            if (isset($_FILES['image'])) {

                $new_image_name = handleUploadImage($_FILES['image']);
                $status         = "Active now";
                $random_id      = mt_rand();
                $insert_query   = "INSERT INTO users (first_name, last_name, email, password, unique_id, status, image)
                                    VALUES ('$first_name', '$last_name', '$email', '$password', $random_id,
                                         '$status', '$new_image_name')";
                $result         = mysqli_query($conn, $insert_query);

                if ($result) {
                    $insert_data = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                    if (mysqli_num_rows($insert_data) > 0) {
                        $row = mysqli_fetch_assoc($insert_data);
                        $_SESSION['unique_id'] = $row['unique_id'];
                        echo "success";
                    }
                } else {
                    die("Error - query faild :{$insert_query}");
                }
            } else {
                die("Please select an image");
            }
        }
    } else {
        die("{$email} - is not a valid email!");
    }
} else {
    die("All field inputs are required!");
}

?>