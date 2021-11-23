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

if(empty($name)) { header('Location: dropoff.php?lognameempty=t');exit(); }
if(empty($date)) { header('Location: dropoff.php?logdateempty=t');exit(); }
if(empty($location)) { header('Location: dropoff.php?loglocationempty=t');exit(); }
if(empty($category)) { header('Location: dropoff.php?logcategoryempty=t');exit(); }
if(empty($value)) { header('Location: dropoff.php?logvalueempty=t');exit(); }

$conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
} else {
	$stmt = $conn->prepare("INSERT INTO `lostitems` (`name`, `date`,`location`, `category`, `value`, `poster`) VALUES (?,?,?,?,?,?);");
	$stmt->bind_param("ssssii",$name, $date, $location, $category, $value, $id);
	$stmt->execute();
	$stmt->close();
	$conn->close();
    header('Location: dashboard.php?regsuccess=t');
}
?>