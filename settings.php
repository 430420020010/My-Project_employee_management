<?php include 'templates/header.php'; ?>
<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: index.php");
    exit();
}


include 'db.php'; ?>

<h1>Settings</h1>
<h2>Update Personal Information</h2>

<!-- Update Personal Information Form -->
<form method="post" class="settings-form">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <button type="submit">Update Information</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Assume we are updating information for a specific employee ID
    // For simplicity, using a fixed employee ID, this should be dynamically retrieved in a real application
    $employee_id = 1; // This should be dynamically set based on the logged-in user

    // Update query
    $sql = "UPDATE employees SET name='$name', email='$email' WHERE id=$employee_id";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Information updated successfully</p>";
    } else {
        echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}
?>

<?php include 'templates/footer.php'; ?>
