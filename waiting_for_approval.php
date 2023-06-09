<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Your database connection code
include('connection.php');


$patientId = $_SESSION['id'];
$patientEmail = $_SESSION['email'];

// Fetch test requests for the logged-in user
$query = "SELECT * FROM test_requests WHERE status = 'pending' AND patient_email = '$patientEmail'";
$result = mysqli_query($conn, $query);

// Check if the query was executed successfully
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Waiting for Approval</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<?php include('navbar.php'); ?>

<div class="container mt-5">
    <h3>Waiting for Approval</h3>
    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Request ID</th>
                <th>Patient Name</th>
                <th>Test Name</th>
                <th>Patient Email</th>
                <th>Patient Contact No.</th>
                <th>Date Requested</th>
                <th>Cost</th>
                <th>Reporting Time</th>
                <th>Category Name</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['request_id']; ?></td>
                    <td><?php echo $row['patient_name']; ?></td>
                    <td><?php echo $row['test_name']; ?></td>
                    <td><?php echo $row['patient_email']; ?></td>
                    <td><?php echo $row['patient_contactno']; ?></td>
                    <td><?php echo $row['date_requested']; ?></td>
                    <td><?php echo $row['cost']; ?></td>
                    <td><?php echo $row['reporting_time']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
