<?php
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    //connect to database
    $conn = mysqli_connect("localhost","root","","digital");

    //querying
    $result = mysqli_query($conn,"select * from users where username = '$username' and password = '$password'")
                or die("Something hucked up ".mysql_error());
    $row = mysqli_fetch_array($result);
    if ($row['username'] == $username && $row['password'] == $password ){
        echo "Login successful! Welcome ".$row['name'];
        $_SESSION['id']=$row['id'];
        header('Location: dashboard.php');
    } else {
        header('Location: index.php?loginerror=t');
    }
?>