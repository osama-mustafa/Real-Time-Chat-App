<?php

function handleUploadImage($request, $directory = "images/")
{
    $request            = $_FILES['image'];
    $image_name         = $request['name'];
    $image_temp_name    = $request['tmp_name'];
    $image_size         = $request['size'];
    $image_extension    = pathinfo($image_name, PATHINFO_EXTENSION);
    $image_directory    = $directory;
    $extensions         = ['png', 'jpg', 'jpeg'];
    $directory          = "images/";

    if (!is_dir($directory) && !mkdir($directory)) {
        die('Failed to create image sirectory');
    } else {
        if (in_array($image_extension, $extensions)) {

            // Validate image size to be less than 2 MB
            if ($image_size < 2097152) {
                $time = time();
                $new_image_name = $time . $image_name;
                $file_name_with_directory = $image_directory . basename($new_image_name);
                if (move_uploaded_file($image_temp_name, $file_name_with_directory)) {
                    return $new_image_name;
                } else {
                    die("Upload image failed!");
                }
            } else {
                die("File is too large! please select image less than 2 MB");
            }
        } else {
            die("Please select an image file: jpg, jpeg, or png");
        }
    }
}
