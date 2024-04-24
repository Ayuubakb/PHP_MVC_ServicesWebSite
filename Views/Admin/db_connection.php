<?php
// Database configuration
$host = 'localhost'; // Change this to your host if necessary
$dbname = 'db'; // Change this to your database name
$username = 'root'; // Change this to your database username
$password = ''; // Change this to your database password

// Attempt to connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Display error message if connection fails
    die("Connection failed: " . $e->getMessage());
}
?>
