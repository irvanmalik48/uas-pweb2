<?php
require_once "../db/index.php";

function setImage($dir, $input, $fallback)
{
    if (isset($input["name"])) {
        $file = $dir . basename($input["name"]);

        $filetype = strtolower(pathinfo($file, PATHINFO_EXTENSION));

        $checktype =
            $filetype == "jpg" ||
            $filetype == "png" ||
            $filetype == "jpeg" ||
            $filetype == "webp" ||
            $filetype == "gif";

        $checksize = $input["size"] > 1500000;

        $checkfile = file_exists($file);

        if ($file == $dir || !$checktype || $checksize || $checkfile) {
            return isset($fallback) ? $fallback : "/assets/img/default.jpg";
        }

        move_uploaded_file($input["tmp_name"], $file);

        return $file;
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
            description = :description
            WHERE
            uname = :uname";
    $stmt = $db->prepare($sql);

    $params = [
        ":uname" => $_POST["uname"],
        ":name" => $_POST["name"],
        ":nim" => $_POST["nim"],
        ":faculty" => $_POST["faculty"],
        ":major" => $_POST["major"],
        ":description" => $_POST["description"],
    ];

    $saved = $stmt->execute($params);

    $sql = "SELECT * FROM users WHERE uname=:uname";
    $stmt = $db->prepare($sql);

    $params = [
        ":uname" => $_POST["uname"],
    ];

    $idk = $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($saved) {
        session_start();
        $_SESSION["user"] = $user;
        header("Location: /");
    }
} elseif (isset($_POST["editImage"])) {
    $sql = "UPDATE users
            SET
            image = :image
            WHERE
            uname = :uname";
    $stmt = $db->prepare($sql);

    $params = [
        ":uname" => $_POST["uname"],
        ":image" => setImage(
            "../../assets/img/",
            $_FILES["image"],
            $_POST["fallbackimg"]
        ),
    ];

    $saved = $stmt->execute($params);

    $sql = "SELECT * FROM users WHERE uname=:uname";
    $stmt = $db->prepare($sql);

    $params = [
        ":uname" => $_POST["uname"],
    ];

    $idk = $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($saved) {
        session_start();
        $_SESSION["user"] = $user;
        header("Location: /");
    }
}
