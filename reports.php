<?php include 'templates/header.php'; ?>
<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if the user is not logged in
    header("Location: index.php");
    exit();
}



include 'db.php'; ?>

<h1>Reports</h1>

<h2>Attendance Report</h2>
<form method="get" class="report-form">
    <div class="form-group">
        <label for="from_date">From Date:</label>
        <input type="date" id="from_date" name="from_date" required>
    </div>
    <div class="form-group">
        <label for="to_date">To Date:</label>
        <input type="date" id="to_date" name="to_date" required>
    </div>
    <button type="submit">Generate Report</button>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['from_date']) && isset($_GET['to_date'])) {
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];

    $sql = "SELECT employee_id, COUNT(status) as total_days, SUM(status = 'Present') as present_days FROM attendance WHERE date BETWEEN '$from_date' AND '$to_date' GROUP BY employee_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h3>Attendance Report from $from_date to $to_date</h3>";
        echo "<table>";
        echo "<thead>";
        echo "<tr><th>Employee ID</th><th>Total Days</th><th>Present Days</th><th>Absent Days</th></tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['employee_id'] . "</td>";
            echo "<td>" . $row['total_days'] . "</td>";
            echo "<td>" . $row['present_days'] . "</td>";
            echo "<td>" . ($row['total_days'] - $row['present_days']) . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No records found for the selected period.</p>";
    }
}
?>

<?php include 'templates/footer.php'; ?>
