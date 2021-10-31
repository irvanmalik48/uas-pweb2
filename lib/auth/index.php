<?php
require_once "../db/index.php";

ob_start();

if (isset($_POST["login"])) {
    $uname = filter_input(INPUT_POST, "uname", FILTER_SANITIZE_STRING);
    $pass = $_POST["pass"];

    $sql = "SELECT * FROM users WHERE uname=:uname OR email=:email";
    $stmt = $db->prepare($sql);

    $params = [
        ":uname" => $uname,
        ":email" => $uname,
    ];

    $stmt->execute($params);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($pass, $user["pass"])) {
            session_start();
            $_SESSION["user"] = $user;
            header("Location: ../../");
        } else {
            header("Location: ../../pages/login/");
        }
    }
}
