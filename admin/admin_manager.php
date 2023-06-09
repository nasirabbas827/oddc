<?php
include('config.php');
session_start();
if (!isset($_SESSION['adminlogin']) || !$_SESSION['adminlogin']) {
    header('location: adminlogin.php');
    exit();
}

// Approve or disapprove a manager request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $managerId = $_POST['manager_id'];
    $status = $_POST['status'];

    $sql = "UPDATE managers SET status='$status' WHERE id='$managerId'";
    if ($conn->query($sql) === TRUE) {
        echo "Manager request updated successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Get pending manager requests
$sql = "SELECT * FROM managers WHERE status='pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manager Requests - Admin Panel</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<?php
include('admin_navbar.php');
?>

<div class="container mt-5">
    <h2>Manager Requests - Admin Panel</h2>
    <?php if ($result->num_rows > 0) { ?>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['status']; ?></td>
                        <td>
                            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                <input type="hidden" name="manager_id" value="<?php echo $row['id']; ?>">
                                <select class="form-control" name="status">
                                    <option value="approved">Approve</option>
                                    <option value="disapproved">Disapprove</option>
                                </select>
                                <input class="btn btn-primary" type="submit" value="Update">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No pending manager requests.</p>
    <?php } ?>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
