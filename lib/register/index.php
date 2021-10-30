<?php

include "db.php";

function setImage($dir) {
    if (isset($_POST['image']) && $_POST['image'] == "success-image") {
        // check if $_FILES is set
        if (isset($_FILES['file']['name'])) {
            // get file name, if only $dir gets assigned then file isn't provided
            $file = $dir . basename($_FILES['file']['name']);

            // get file type
            $filetype = strtolower(
                pathinfo($file, PATHINFO_EXTENSION)
            );

            // some image rules e.g. type, size and file duplication checking
            $checktype = (
                $filetype == "jpg" ||
                $filetype == "png" ||
                $filetype == "jpeg" ||
                $filetype == "webp" ||
                $filetype == "gif"
            );

            $checksize = (
                $_FILES['file']['size'] > 1500000
            );

            $checkfile = (
                file_exists($file)
            );

            // fallback to old image if all checks are false and display an alert box
            if ($file == $dir || !$checktype || $checksize || $checkfile) {
                return (isset($_POST['fallbackimg']))? $_POST['fallbackimg'] : "/assets/img/default.jpg";
            }
                
            // avoid moving non-image files
            move_uploaded_file($_FILES['file']['tmp_name'], $file);

            // return if successful
            return $file;
        } else {
            return "/assets/img/default.jpg";
        }
    } else {
        return "/assets/img/default.jpg";
    }
}

if (isset($_POST["register"])) {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $uname = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $nim = filter_input(INPUT_POST, "nim", FILTER_SANITIZE_STRING);
    $faculty = filter_input(INPUT_POST, "faculty", FILTER_SANITIZE_STRING);
    $major = filter_input(INPUT_POST, "major", FILTER_SANITIZE_STRING);
    $description = filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING);
    $image = setImage("/assets/img/");
    $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);


}