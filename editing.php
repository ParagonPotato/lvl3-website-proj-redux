<?php
    session_start();
    
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
    $status = $_POST['status'];

    if(!ctype_digit($value) ) {
        header('Location: dropoff.php?valueerror=t');
        exit();
    }

    $conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);

        // sql to delete a record
    $sql = "DELETE FROM `lostitems` WHERE `lost_id`=$itemid";

    if ($conn->query($sql) === TRUE) {
    echo "Recorded is now deleted";
    } else {
    echo "Record couldn't be deleted: " . $conn->error;
    }

    if (!$conn) {
        die("Connection failed: ".mysqli_connect_error());
    } else {
        $stmt = $conn->prepare("INSERT INTO `lostitems` (`lost_id`, `name`, `date`,`location`, `category`, `value`, `status`,`poster`) VALUES (?,?,?,?,?,?,?,?);");
        $stmt->bind_param("issssiii",$itemid,$name, $date, $location, $category, $value, $status, $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        header('Location: dashboard.php?regsuccess=t');
    }
?>