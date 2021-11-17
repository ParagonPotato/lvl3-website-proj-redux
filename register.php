<?php
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "digital";

$username = $_POST['username'];
$password = $_POST['password'];

$conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);

if (!$conn) {
	die("Connection failed: " .mysqli_connect_error());
} else {
	$stmt = $conn->prepare("insert into users(username,password) values(?,?)");
	$stmt->bind_param("ss",$username,$password);
	$stmt->execute();
	echo "registered successfully";
	$stmt->close();
	$conn->close();
    header('Location: dashboard.php');
}
?>