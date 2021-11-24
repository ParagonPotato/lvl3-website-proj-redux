<?php
    if (!isset($_SESSION['id'])) {
        header('Location: index.php');
        exit();
    }

    $id = $_SESSION['id'];

    if (!isset($_GET['itemid'])) {
        header('Location: index.php');
        exit();
    }

    $itemid = $_GET['itemid'];

    $conn = mysqli_connect('localhost','root','','digital');
    $result=mysqli_query($conn,"SELECT * FROM `users` WHERE user_id='$id'");
    $row=mysqli_fetch_array($result);
    $username=$row[1];

    $serverName = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "digital";

    $name = $_POST['name'];
    $date = $_POST['date'];
    $location = $_POST['location'];
    $category = $_POST['category'];
    $value = $_POST['value'];
    $status = $_POST['']

    if(!ctype_digit($value) ) {
        header('Location: dropoff.php?valueerror=t');
        exit();
    }

    $conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
    } else {
        $stmt = $conn->prepare("UPDATE `lostitems` (`name`, `date`,`location`, `category`, `value`, `status`) VALUES (?,?,?,?,?,?);");
        $stmt->bind_param("ssssii",$name, $date, $location, $category, $value, $status);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header('Location: dashboard.php?regsuccess=t');
    }
?>