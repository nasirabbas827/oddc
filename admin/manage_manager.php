<?php
include('config.php');
session_start();
if (!isset($_SESSION['adminlogin']) || !$_SESSION['adminlogin']) {
    header('location: adminlogin.php');
    exit();
}

// Check if a manager ID is specified for editing or deleting
if (isset($_GET['id'])) {
    $managerId = $_GET['id'] - 1; // Subtract 1 to get the correct array index
}

// Edit Manager Details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_manager'])) {
    // Get the form data
    $managerId = $_POST['manager_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $status = $_POST['status'];

    // Update manager details in the database
    $sql = "UPDATE managers SET name='$name', email='$email', status='$status' WHERE id='$managerId'";

    if ($conn->query($sql) === TRUE) {
        $message = "Manager details updated successfully.";
    } else {
        $error = "Error updating manager details: " . $conn->error;
    }
}

// Delete Manager
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $managerId = $_GET['id'];

    // Delete manager from the database
    $sql = "DELETE FROM managers WHERE id='$managerId'";

    if ($conn->query($sql) === TRUE) {
        $message = "Manager deleted successfully.";
    } else {
        $error = "Error deleting manager: " . $conn->error;
    }
}

// Add Manager
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_manager'])) {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
    $status = $_POST['status'];

    // Insert manager details into the database
    $sql = "INSERT INTO managers (name, email, password, status) VALUES ('$name', '$email', '$hashedPassword', '$status')";

    if ($conn->query($sql) === TRUE) {
        $message = "Manager added successfully.";
    } else {
        $error = "Error adding manager: " . $conn->error;
    }
}

// Retrieve Manager Details
$sql = "SELECT * FROM managers";
$result = $conn->query($sql);

$managers = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $managers[] = $row;
    }
} else {
    $message = "No managers found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Managers</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php include('admin_navbar.php'); ?>

    <div class="container mt-4">
        <h2>Manage Managers</h2>
        <?php
        if (isset($message)) {
            echo '<p style="color: green;">' . $message . '</p>';
        }
        if (isset($error)) {
            echo '<p style="color: red;">' . $error . '</p>';
        }
        ?>
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($managers as $index => $manager) : ?>
                    <tr>
                        <td><?php echo $manager['id']; ?></td>
                        <td><?php echo $manager['name']; ?></td>
                        <td><?php echo $manager['email']; ?></td>
                        <td><?php echo $manager['status']; ?></td>
                        <td>
                            <a href="manage_manager.php?action=edit&id=<?php echo $index + 1; ?>" class="btn btn-primary">Edit</a>
                            <a href="manage_manager.php?action=delete&id=<?php echo $index + 1; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this manager?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if (isset($managerId) && !isset($message)) : ?>
            <h3>Edit Manager</h3>
            <form action="manage_manager.php" method="POST">
                <input type="hidden" name="manager_id" value="<?php echo $managers[$managerId]['id']; ?>">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $managers[$managerId]['name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $managers[$managerId]['email']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="status">Status:</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="pending" <?php if ($managers[$managerId]['status'] === 'pending') echo 'selected'; ?>>Pending</option>
                        <option value="approved" <?php if ($managers[$managerId]['status'] === 'approved') echo 'selected'; ?>>Approved</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="edit_manager">Update</button>
            </form>
        <?php endif; ?>

        <h3>Add Manager</h3>
        <form action="manage_manager.php" method="POST">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="add_manager">Add</button>
        </form>
    </div>
</body>
</html>
