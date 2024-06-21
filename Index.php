<?php include 'templates/header.php'; ?>

<h1>Dashboard</h1>
<p>Welcome to the Employee Management System Dashboard. Here you can see a quick overview of the system.</p>



<div class="dashboard">
    <!-- Statistics Section -->
    <div class="stats">
        <h2>Statistics</h2>
        <div class="stat">
            <h3>Total Employees</h3>
            <p>50</p> <!-- Replace with dynamic count from the database -->
        </div>
        <div class="stat">
            <h3>Departments</h3>
            <p>5</p> <!-- Replace with dynamic count from the database -->
        </div>
        <div class="stat">
            <h3>Recent Hires</h3>
            <p>3</p> <!-- Replace with dynamic count from the database -->
        </div>
    </div>

    <!-- Recent Activities Section -->
    <div class="activities">
        <h2>Recent Activities</h2>
        <ul>
            <li>John Doe was added to the Sales department.</li> <!-- Replace with dynamic data from the database -->
            <li>Jane Smith was promoted to Manager.</li> <!-- Replace with dynamic data from the database -->
            <li>New department "Marketing" was created.</li> <!-- Replace with dynamic data from the database -->
        </ul>
    </div>

    <!-- Quick Links Section -->
    <div class="quick-links">
        <h2>Quick Links</h2>
        <a href="add_employee.php" class="button">Add New Employee</a>
        <a href="employee_list.php" class="button">View Employee List</a>
        <a href="departments.php" class="button">Manage Departments</a>
    </div>
</div>


<?php
session_start();
include 'db.php'; // Include your database connection file

// Handle user registration
if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert the user into the database
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";
    
    if ($conn->query($sql) === TRUE) {
        echo "New user registered successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Handle user login
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch the user from the database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables and redirect to a logged-in page
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            echo "Login successful";
            // Redirect to a protected page or dashboard
            header("Location: index.php"); // Redirect to index page or another protected page
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with that email";
    }
}

// Handle user logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Employee Management System</title>
    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <?php if (isset($_SESSION['user_id'])): ?>
        <h2>Welcome, <?php echo $_SESSION['user_name']; ?></h2>
        <form method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
    <?php else: ?>
        <h2>User Login</h2>
        <form method="post">
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login">Login</button>
        </form>

        <h2>User Registration</h2>
        <form method="post">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="register">Register</button>
        </form>
    <?php endif; ?>
</body>
</html>

<?php include 'templates/footer.php'; ?>
