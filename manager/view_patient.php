<?php
session_start(); // Start session

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

$email = $_SESSION['email']; // Get the user's email from the session

// Include database connection and retrieve statistics
include('connection.php');

// Check if the patient ID is provided
if (isset($_GET['patient_id'])) {
    $patientId = $_GET['patient_id'];

    // Retrieve patient record
    $sql = "SELECT * FROM members WHERE id='$patientId'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $username = $row['Username'];
        $email = $row['Email'];
        $contactno = $row['contactno'];
        $password = $row['Password'];
    } else {
        echo "Patient not found.";
        exit;
    }
} else {
    echo "Patient ID not provided.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Patient</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            width: 100%;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <?php include('manager_navbar.php'); ?>

    <div class="container mt-5">
        <h2>View Patient</h2>

        <table class="table">
            <tr>
                <th>Username:</th>
                <td><?php echo $username; ?></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <th>Contact No:</th>
                <td><?php echo $contactno; ?></td>
            </tr>
            <tr>
                <th>Password:</th>
                <td><?php echo $password; ?></td>
            </tr>
        </table>

        <a href="manager_patient.php" class="btn btn-primary mt-3">Back</a>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
