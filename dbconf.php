<?php
// dbconf.php - Database connection file

$host = '127.0.0.1'; // Your database host (e.g., 'localhost')
$username = 'root';  // Your database username
$password = 'mariadb';      // Your database password
$dbname = 'bookhevan'; // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set character set to utf8
$conn->set_charset("utf8");
?>