<?php
    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordhashed = password_hash($password,PASSWORD_DEFAULT);

    //connect to database
    $conn = mysqli_connect("localhost","root","","digital");

    //querying
    $result = mysqli_query($conn,"select * from users where username = '$username' and password = '$passwordhashed'")
                or die("Something hucked up ".mysql_error());
    $row = mysqli_fetch_array($result);
    if ($row['username'] == $username && password_verify($password,$row['password']) == 1 ){
        echo "Login successful! Welcome ".$row['name'];
        $_SESSION['id']=$row['user_id'];
        header('Location: dashboard.php');
    } else {
        header('Location: index.php?loginerror=t');
    }
?>