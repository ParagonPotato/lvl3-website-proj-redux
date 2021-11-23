<?php
if (!isset($_SESSION['id'])) {
    header('Location: index.php');
    exit();
}

$id = $_GET['id'];

$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "digital";

$name = $_POST['name'];
$date = $_POST['date'];
$category = $_POST['category'];
$value = $_POST['value'];

if(empty$name)) { header('Location: dropoff.php?lognameempty=t');exit(); }
if(empty($date)) { header('Location: dropoff.php?logdateempty=t');exit(); }
if(empty($category)) { header('Location: dropoff.php?logcategoryempty=t');exit(); }
if(empty($value)) { header('Location: dropoff.php?logvalueempty=t');exit(); }

$conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
} else {
	$stmt = $conn->prepare("insert into lostitems(name,date,category,value) values(?,?,?,?)");
	$stmt->bind_param("ssss",$name,$date,$category,$value);
	$stmt->execute();
	$stmt->close();
	$conn->close();
    header('Location: dashboard.php?regsuccess=t');
}
?>