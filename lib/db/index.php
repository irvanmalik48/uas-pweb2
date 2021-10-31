<?php
session_start();

$db_host = "localhost";
$db_user = "irvanmalik48";
$db_pass = "@irvann48_";
$db_name = "pweb2";

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
} catch (PDOException $exception) {
    die("Error: " . $exception->getMessage());
}
