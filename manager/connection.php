<?php
$conn = mysqli_connect('localhost', 'root', '', 'oddc');
if (!$conn) {
	die("Connection failed".mysqli_connect_error());
}
?>