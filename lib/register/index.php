<?php
require_once "../db/index.php";

ob_start();

if (isset($_POST["register"])) {
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $uname = filter_input(INPUT_POST, "uname", FILTER_SANITIZE_STRING);
    $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

    $stmt = $db->prepare(
        "SELECT uname, email FROM users WHERE uname=:uname OR email=:email"
    );
    $stmt->execute([
        ":uname" => $uname,
        ":email" => $email,
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($user)) {
        $sql =
            "INSERT INTO users (uname, email, pass, name) VALUES (:uname, :email, :pass, :name)";
        $stmt = $db->prepare($sql);

        $saved = $stmt->execute([
            ":name" => $name,
            ":uname" => $uname,
            ":pass" => $pass,
            ":email" => $email,
        ]);
        if ($saved) {
            header("Location: ../../pages/login/");
        }
    } else {
        session_start();
        $_SESSION["error"] = "Username/Email telah digunakan.";

        header("Location: ../../pages/register/");
    }
}
