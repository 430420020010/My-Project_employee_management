<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: index.php");
    exit();
}
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM departments WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Department deleted successfully</p>";
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}

header('Location: departments.php');
exit;
?>
