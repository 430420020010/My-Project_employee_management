<?php include 'templates/header.php'; ?>
<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: index.php");
    exit();
}



include 'db.php'; ?>

<h1>Employee List</h1>

<!-- Search Form -->
<form method="get" class="search-form">
    <input type="text" name="search" placeholder="Search by name or department">
    <button type="submit">Search</button>
</form>

<!-- Employee List Table -->
<table>
    <thead>
        <tr>
            <th><a href="?sort=id">ID</a></th>
            <th><a href="?sort=name">Name</a></th>
            <th><a href="?sort=age">Age</a></th>
            <th><a href="?sort=department">Department</a></th>
            <th><a href="?sort=position">Position</a></th>
            <th><a href="?sort=email">Email</a></th>
            <th><a href="?sort=phone">Phone</a></th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Search functionality
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $search_query = $search ? "WHERE name LIKE '%$search%' OR department LIKE '%$search%'" : '';

        // Sorting functionality
        $sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';
        $valid_columns = ['id', 'name', 'age', 'department', 'position', 'email', 'phone'];
        if (!in_array($sort, $valid_columns)) {
            $sort = 'id';
        }

        // Fetch employees
        $sql = "SELECT * FROM employees $search_query ORDER BY $sort";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['age'] . "</td>";
                echo "<td>" . $row['department'] . "</td>";
                echo "<td>" . $row['position'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['phone'] . "</td>";
                echo "<td>";
                echo "<a href='edit_employee.php?id=" . $row['id'] . "'>Edit</a> | ";
                echo "<a href='delete_employee.php?id=" . $row['id'] . "'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No employees found</td></tr>";
        }
        ?>
    </tbody>
</table>

<?php include 'templates/footer.php'; ?>
