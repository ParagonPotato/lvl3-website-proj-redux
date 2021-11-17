<?php
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "digital";

$username = $_POST['username'];
$username = str_replace(' ','',$username);
$password = $_POST['password'];
$passwordempty = str_replace(' ','',$password);

if(empty($username)) {
    header('Location: index.php?regusernameempty=t');
    exit();
}
if(empty($passwordempty)) {
    header('Location: index.php?regpasswordempty=t');
    exit();
}

$conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);

$result = mysqli_query($conn,"select * from users where username = '$username'");
$row = mysqli_fetch_array($result);
if($row['username']==$username) {
    header('Location: index.php?regusernameduplicate=t');
    exit();
}

if (!$conn) {
	die("Connection failed: ".mysqli_connect_error());
} else {
	$stmt = $conn->prepare("insert into users(username,password) values(?,?)");
	$stmt->bind_param("ss",$username,$password);
	$stmt->execute();
    $result=mysqli_query($conn,"SELECT * FROM `users` WHERE username='$username'")
    $row=mysqli_fetch_array($result);
	$stmt->close();
	$conn->close();
    header('Location: dashboard.php?id='.$row[0]);
}
?>