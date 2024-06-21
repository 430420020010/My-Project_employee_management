<?php include 'templates/header.php'; ?>
<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: index.php");
    exit();
}

include 'db.php'; ?>

<h1>Edit Employee</h1>

<?php
$id = $_GET['id'];
$sql = "SELECT * FROM employees WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<form method="post">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $row['name']; ?>" required>
    <label for="age">Age:</label>
    <input type="number" id="age" name="age" value="<?php echo $row['age']; ?>" required>
    <label for="department">Department:</label>
    <input type="text" id="department" name="department" value="<?php echo $row['department']; ?>" required>
    <label for="position">Position:</label>
    <input type="text" id="position" name="position" value="<?php echo $row['position']; ?>" required>
    <button type="submit">Update Employee</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $department = $_POST['department'];
    $position = $_POST['position'];

    $sql = "UPDATE employees SET name='$name', age=$age, department='$department', position='$position' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Employee updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<?php include 'templates/footer.php'; ?>
