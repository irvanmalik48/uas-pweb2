<?php
require_once "../db/index.php";

function setImage($dir) {
    if (isset($_POST['edit']) || isset($_POST['editImage'])) {
        if (isset($_FILES['file']['name'])) {
            $file = $dir . basename($_FILES['file']['name']);

            $filetype = strtolower(
                pathinfo($file, PATHINFO_EXTENSION)
            );

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

            if ($file == $dir || !$checktype || $checksize || $checkfile) {
                return (isset($_POST['fallbackimg']))? $_POST['fallbackimg'] : "/assets/img/default.jpg";
            }

            move_uploaded_file($_FILES['file']['tmp_name'], $file);

            return $file;
        } else {
            return "/assets/img/default.jpg";
        }
    } else {
        return "/assets/img/default.jpg";
    }
}

if (isset($_POST["edit"])) {
    $sql = "UPDATE users
            SET
            name = :name,
            nim = :nim,
            faculty = :faculty,
            major = :major,
            description = :description,
            image = :image
            WHERE
            uname = :uname";
    $stmt = $db->prepare($sql);

    $params = array(
        ":uname" => $_POST["uname"],
        ":name" => $_POST["name"],
        ":nim" => $_POST["nim"],
        ":faculty" => $_POST["faculty"],
        ":major" => $_POST["major"],
        ":description" => $_POST["description"],
        ":image" => $_POST["img"]
    );

    $saved = $stmt->execute($params);
    if ($saved)
        header("Location: /");
}