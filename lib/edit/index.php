<?php
require_once "../db/index.php";

ob_start();

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
            return isset($fallback) ? $fallback : "assets/img/default.jpg";
        }

        move_uploaded_file($input["tmp_name"], $file);

        return substr($file, 6);
    } else {
        return "assets/img/default.jpg";
    }
}

function edit($db, $arr) {
    $sql = "UPDATE users
            SET
            uname = :uname,
            email = :email,
            name = :name,
            nim = :nim,
            faculty = :faculty,
            major = :major,
            description = :description
            WHERE
            id = :id";
    $stmt = $db->prepare($sql);

    $params = [
        ":id" => $arr["id"],
        ":uname" => $arr["uname"],
        ":email" => $arr["email"],
        ":name" => $arr["name"],
        ":nim" => $arr["nim"],
        ":faculty" => $arr["faculty"],
        ":major" => $arr["major"],
        ":description" => $arr["description"],
    ];

    $saved = $stmt->execute($params);

    $sql = "SELECT * FROM users WHERE id=:id";
    $stmt = $db->prepare($sql);

    $params = [
        ":id" => $arr["id"],
    ];

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($saved) {
        session_start();
        $_SESSION["user"] = $user;
        if (empty($_SESSION["token"])) {
            if (function_exists('random_bytes')) {
                $_SESSION['token'] = bin2hex(random_bytes(32));
            } else {
                $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
            }
        }
    }
}

if (isset($_POST["edit"]) && hash_equals($_SESSION["token"], $_POST["token"])) {
    $old_uname = $_SESSION["user"]["uname"];
    $old_email = $_SESSION["user"]["email"];

    $arr = array(
        "id" => $_POST["id"],
        "uname" => filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING),
        "email" => filter_input(INPUT_POST, "email", FILTER_SANITIZE_STRING),
        "name" => filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING),
        "nim" => filter_input(INPUT_POST, "nim", FILTER_SANITIZE_STRING),
        "faculty" => filter_input(INPUT_POST, "faculty", FILTER_SANITIZE_STRING),
        "major" => filter_input(INPUT_POST, "major", FILTER_SANITIZE_STRING),
        "description" => filter_input(INPUT_POST, "description", FILTER_SANITIZE_STRING),
    );

    $same = ($old_email == $arr["email"] && $old_uname == $arr["uname"]);

    if ($old_email != $arr["email"] && $old_uname == $arr["uname"]) {
        $sql = "SELECT * FROM users WHERE email=:email";
        $stmt = $db->prepare($sql);

        $params = [
            ":email" => $arr["email"],
        ];

        $stmt->execute($params);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($user)) {
            edit($db, $arr);
            header("Location: ../../");
        } else {
            $_SESSION["unameError"] = "Username/Email telah digunakan.";
            header("Location: ../../pages/edit/");
        }
    } elseif ($old_uname != $arr["uname"] && $old_email == $arr["email"]) {
        $sql = "SELECT * FROM users WHERE uname=:uname";
        $stmt = $db->prepare($sql);

        $params = [
            ":uname" => $arr["uname"],
        ];

        $stmt->execute($params);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($user)) {
            edit($db, $arr);
            header("Location: ../../");
        } else {
            $_SESSION["unameError"] = "Username/Email telah digunakan.";
            header("Location: ../../pages/edit/");
        }
    } elseif (!$same) {
        $sql = "SELECT * FROM users WHERE uname=:uname OR email=:email";
        $stmt = $db->prepare($sql);

        $params = [
            ":uname" => $arr["uname"],
            ":email" => $arr["email"],
        ];

        $stmt->execute($params);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($user)) {
            edit($db, $arr);
            header("Location: ../../");
        } else {
            $_SESSION["unameError"] = "Username/Email telah digunakan.";
            header("Location: ../../pages/edit/");
        }
    } elseif ($same) {
        edit($db, $arr);
        header("Location: ../../");
    }
} elseif (isset($_POST["editImage"]) && hash_equals($_SESSION["token"], $_POST["token"])) {
    $sql = "UPDATE users
            SET
            image = :image
            WHERE
            uname = :uname";
    $stmt = $db->prepare($sql);

    $params = [
        ":uname" => filter_input(INPUT_POST, "uname", FILTER_SANITIZE_STRING),
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
        if (empty($_SESSION["token"])) {
            if (function_exists('random_bytes')) {
                $_SESSION['token'] = bin2hex(random_bytes(32));
            } else {
                $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
            }
        }
        header("Location: ../../");
    }
} elseif (isset($_POST["editPassword"]) && hash_equals($_SESSION["token"], $_POST["token"]) && $_POST["pass"] == $_POST["confPass"]) {
    $sql = "UPDATE users
            SET
            pass = :pass
            WHERE
            uname = :uname";
    $stmt = $db->prepare($sql);

    $params = [
        ":uname" => filter_input(INPUT_POST, "uname", FILTER_SANITIZE_STRING),
        ":pass" => password_hash($_POST["pass"], PASSWORD_DEFAULT),
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
        if (empty($_SESSION["token"])) {
            if (function_exists('random_bytes')) {
                $_SESSION['token'] = bin2hex(random_bytes(32));
            } else {
                $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
            }
        }
        header("Location: ../../");
    }
} else {
    if ($_POST["pass"] != $_POST["confPass"]) {
        $_SESSION["error"] = "Password konfirmasi tidak sama dengan password.";
        header("Location: ../../pages/edit/");
    }
}
