<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Your database connection code
$conn = mysqli_connect("localhost", "root", "", "oddc");

$patientId = $_SESSION['id'];
$patientEmail = $_SESSION['email'];

$query = "SELECT tr.request_id, tr.patient_name, tr.patient_email, tr.patient_contactno, tr.date_requested, td.test_name, tr.category_name, tr.cost, tr.reporting_time
          FROM test_requests tr
          JOIN test_details td ON tr.test_id = td.test_id
          WHERE tr.status = 'Approved' AND tr.patient_email = '$patientEmail'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Approved Tests</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<?php include('navbar.php'); ?>

<div class="container mt-5">
    <h3>Approved Tests</h3>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="invoice">
            <div class="row">
                <div class="col-md-3">Request ID:</div>
                <div class="col-md-9"><?php echo $row['request_id']; ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">Patient Name:</div>
                <div class="col-md-9"><?php echo $row['patient_name']; ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">Test Name:</div>
                <div class="col-md-9"><?php echo $row['test_name']; ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">Patient Email:</div>
                <div class="col-md-9"><?php echo $row['patient_email']; ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">Patient Contact No.:</div>
                <div class="col-md-9"><?php echo $row['patient_contactno']; ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">Category Name:</div>
                <div class="col-md-9"><?php echo $row['category_name']; ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">Cost:</div>
                <div class="col-md-9"><?php echo $row['cost']; ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">Reporting Time:</div>
                <div class="col-md-9"><?php echo $row['reporting_time']; ?></div>
            </div>
            <div class="row">
                <div class="col-md-3">Date Requested:</div>
                <div class="col-md-9"><?php echo $row['date_requested']; ?></div>
            </div>
            <hr>
        </div>
    <?php } ?>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
