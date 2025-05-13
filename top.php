<?php
if (session_status() === PHP_SESSION_NONE) {
    ob_start("ob_gzhandler");
    session_start();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "super_app";

$conn = new mysqli($servername, $username, $password, $dbname);

// بررسی اتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}