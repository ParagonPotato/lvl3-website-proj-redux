<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}

$id = $_SESSION['id'];

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "digital";

$name = $_POST['name'];
$date = $_POST['date'];
$location = $_POST['location'];
$category = $_POST['category'];
$value = $_POST['value'];
$poster = $_POST[$id];

if(preg_match("/[a-z]/i", $value)){
	header('Location: dropoff.php?valueerror=t');
	exit();
}

$conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
} else {
	$stmt = $conn->prepare("INSERT INTO `lostitems` (`name`, `date`,`location`, `category`, `value`, `poster`) VALUES (?,?,?,?,?,?);");
	$stmt->bind_param("ssssfi",$name, $date, $location, $category, $value, $id);
	$stmt->execute();
	$stmt->close();
	$conn->close();
    header('Location: dashboard.php?regsuccess=t');
}
?>