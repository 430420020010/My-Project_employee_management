<?php include 'templates/header.php'; ?>
<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: index.php");
    exit();
}

include 'db.php'; ?>

<h1>Departments</h1>

<!-- Add Department Form -->
<form method="post" class="department-form">
    <div class="form-group">
        <label for="department_name">Department Name:</label>
        <input type="text" id="department_name" name="department_name" required>
    </div>
    <button type="submit">Add Department</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $department_name = isset($_POST['department_name']) ? $_POST['department_name'] : '';

    if ($department_name) {
        $sql = "INSERT INTO departments (name) VALUES ('$department_name')";

        if ($conn->query($sql) === TRUE) {
            echo "<p class='success'>New department added successfully</p>";
        } else {
            echo "<p class='error'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } else {
        echo "<p class='error'>Please fill in all fields.</p>";
    }
}
?>

<!-- Departments List -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch departments
        $sql = "SELECT * FROM departments";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>";
                echo "<a href='delete_department.php?id=" . $row['id'] . "'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No departments found</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php include 'templates/footer.php'; ?>
