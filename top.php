<?php

// Load environment variables from .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Get database credentials from environment variables
$servername = $_ENV['DB_SERVERNAME'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];

try {
    // Start the session with a secure session name and a random session ID
    session_name('mySecureSession');
    session_id(bin2hex(random_bytes(16)));
    session_start();

    // Establish a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    // Log the error and display a friendly error message
    error_log($e->getMessage());
    die("An error occurred: " . $e->getMessage());
}

?>