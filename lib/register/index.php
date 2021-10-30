<?php
require_once "../db/index.php";

if(isset($_POST['register'])){
    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    $uname = filter_input(INPUT_POST, "uname", FILTER_SANITIZE_STRING);
    $pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

    $stmt = $link->prepare("SELECT uname, email FROM users WHERE uname=:uname AND email=:email");
    $stmt->execute([
        ":uname" => $uname,
        ":email" => $email
    ]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $exist;

    if (isset($user) && !empty($user)) {
        $exist = true;
    } else {
        $exist = false;
    }

    if ($exist) {
        $sql = "INSERT INTO users (name, uname, email, pass) VALUES (:name, :username, :email, :pass)";
        $stmt = $db->prepare($sql);
    
        $params = array(
            ":name" => $name,
            ":uname" => $uname,
            ":pass" => $pass,
            ":email" => $email
        );
    
        $saved = $stmt->execute($params);
        if ($saved)
            header("Location: /pages/login/");
    } else {
        exit("Error: Username telah digunakan.");
    }
}