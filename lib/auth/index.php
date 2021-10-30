<?php
include "db.php";

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno())
    exit("Failed to connect to MySQL: " . mysqli_connect_error());

if (!isset($_POST["uname"], $_POST["pass"]))
    exit("Please fill both the username and password fields!");

if ($stmt = $con->prepare("SELECT * FROM users WHERE uname = ?")) {
    $stmt->bind_param("s", $_POST["uname"]);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $pass, $nim, $faculty, $major, $description, $image);
        $stmt->fetch();

        if (password_verify($_POST["pass"], $pass)) {
            session_regenerate_id();
            $_SESSION["loggedin"] = TRUE;
            $_SESSION["uname"] = $_POST["uname"];
            $_SESSION["id"] = $id;
            $_SESSION["nim"] = $nim;
            $_SESSION["faculty"] = $faculty;
            $_SESSION["major"] = $major;
            $_SESSION["description"] = $description;
            $_SESSION["image"] = $image;

            header("Location: /");
        } else {
            echo "Incorrect username and/or password!";
        }
    } else {
        echo "Incorrect username and/or password!";
    }

    $stmt->close();
}