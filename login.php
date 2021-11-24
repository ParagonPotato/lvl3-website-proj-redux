<?php
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordhashed = password_hash($password,PASSWORD_DEFAULT);

    //connect to database
    $conn = mysqli_connect("localhost","root","","digital");

    //querying
    $result = mysqli_query($conn,"select * from users where username = '$username'")
                or die("Something hucked up ".mysql_error());
    $row = mysqli_fetch_array($result);
    if ($row['username'] == $username && password_verify($password,$row[2]) ){
        echo "Login successful! Welcome ".$row['name'];
        $_SESSION['id']=$row['user_id'];
        $_SESSION['admin']=$row['admin'];
        header('Location: dashboard.php');
    } else {
        echo password_verify($password,$row[2]);
        header('Location: index.php?loginerror=t');
    }
?>