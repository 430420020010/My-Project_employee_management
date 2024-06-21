<?php include 'templates/header.php'; ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: index.php");
    exit();
}

include 'db.php'; ?>

<h1>Add Employee</h1>
<form method="post" class="employee-form">
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>
    </div>
    <div class="form-group">
        <label for="department">Department:</label>
        <input type="text" id="department" name="department" required>
    </div>
    <div class="form-group">
        <label for="position">Position:</label>
        <input type="text" id="position" name="position" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required>
    </div>
    <button type="submit">Add Employee</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $age = isset($_POST['age']) ? $_POST['age'] : '';
    $department = isset($_POST['department']) ? $_POST['department'] : '';
    $position = isset($_POST['position']) ? $_POST['position'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';

    if ($name && $age && $department && $position && $email && $phone) {
        $sql = "INSERT INTO employees (name, age, department, position, email, phone) VALUES ('$name', $age, '$department', '$position', '$email', '$phone')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<p class='success'>New employee added successfully</p>";
        } else {
            echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } else {
        echo "<p class='error'>Please fill in all fields.</p>";
    }
}
?>

<?php include 'templates/footer.php'; ?>
