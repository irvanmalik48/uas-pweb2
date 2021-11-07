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
            if (empty($_SESSION["token"])) {
                if (function_exists("random_bytes")) {
                    $_SESSION["token"] = bin2hex(random_bytes(32));
                } else {
                    $_SESSION["token"] = bin2hex(
                        openssl_random_pseudo_bytes(32)
                    );
                }
            }
            header("Location: ../../");
        } else {
            session_start();
            $_SESSION["error"] = "Username atau password salah.";

            header("Location: ../../pages/login/");
        }
    } else {
        session_start();
        $_SESSION["error"] = "Username atau password salah.";

        header("Location: ../../pages/login/");
    }
}
