<?php
$servername = "localhost";
$username = "root";  // Default username for XAMPP
$password = "Abc@10081991";      // Default password for XAMPP (empty string)
$dbname = "employee_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

