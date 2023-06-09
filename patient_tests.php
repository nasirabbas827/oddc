<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

include('connection.php');

// Retrieve logged-in patient details (replace with your authentication mechanism)
$patientId = $_SESSION['id'];
$query = "SELECT Username, Email, contactno FROM members WHERE id = $patientId";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$patientName = $row['Username'];
$patientEmail = $row['Email'];
$patientContactNo = $row['contactno'];

// Fetch approved tests for the logged-in patient
$testQuery = "SELECT tr.request_id, td.test_name, td.category_name, tr.date_requested, tr.status, tr.cost, tr.reporting_time
              FROM test_requests tr
              JOIN test_details td ON tr.test_id = td.test_id
              WHERE tr.patient_name = '$patientName' AND tr.status = 'approved'";
$tests = mysqli_query($conn, $testQuery);

// Check if the query was executed successfully
if (!$tests) {
    die("Error executing the query: " . mysqli_error($conn));
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Approved Tests</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<?php include('navbar.php'); ?>

<div class="container mt-5">
    <h3>Your Approved Tests</h3>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Request ID</th>
                <th>Category Name</th>
                <th>Test Name</th>
                <th>Date Requested</th>
                <th>Status</th>
                <th>Cost</th>
                <th>Report Time</th>
                <th>Patient Name</th>
                <th>Patient Email</th>
                <th>Print Invoice</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($test = mysqli_fetch_assoc($tests)) { ?>
                <tr>
                    <td><?php echo $test['request_id']; ?></td>
                    <td><?php echo $test['category_name']; ?></td>
                    <td><?php echo $test['test_name']; ?></td>
                    <td><?php echo $test['date_requested']; ?></td>
                    <td><?php echo $test['status']; ?></td>
                    <td><?php echo $test['cost']; ?></td>
                    <td><?php echo $test['reporting_time']; ?></td>
                    <td><?php echo $patientName; ?></td>
                    <td><?php echo $patientEmail; ?></td>
                    <td>
                    <a href="print_invoice.php?request_id=<?php echo urlencode($test['request_id']); ?>&test_name=<?php echo urlencode($test['test_name']); ?>&category_name=<?php echo urlencode($test['category_name']); ?>&date_requested=<?php echo urlencode($test['date_requested']); ?>&patient_name=<?php echo urlencode($patientName); ?>&patient_email=<?php echo urlencode($patientEmail); ?>&cost=<?php echo urlencode($test['cost']); ?>&reporting_time=<?php echo urlencode($test['reporting_time']); ?>" target="_blank" class="btn btn-primary">Print Invoice</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
