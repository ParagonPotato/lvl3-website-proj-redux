<?php session_start(); ?>
<html>
<header>
  <style>
    body {
      margin:0;
    }
    html {
      background-color: white;
      color:black;
      text-align:center;
      font-family: 'Urbanist', sans-serif;
      font-size:34px;
    }
    h1 {
      text-align:center;
      font-family: 'Urbanist', sans-serif;
      font-weight: lighter;
      font-size:34px;
      letter-spacing:15px;
      text-align: center;
      line-height:100px;
      white-space:pre;
      margin-bottom:0px;
    }

    h2 {
      margin-top:0px;
      font-size:16px;
      font-family: 'Urbanist', sans-serif;
      font-weight: lighter;
      margin-bottom:30px;
    }

    h3 {
      font-size:12px;
      color:red;
    }

    h4 {
      font-size:16px;
      color:black;
    }

    input {
      width:10%;
      height:10%;
    }
    select {
      width:10.5%;
    }

    div {
      line-height:20px;
    }

    ul {
      list-style-type:none;
      margin:0;
      padding:0;
      overflow:hidden;
      background-color:black;
      position:relative;
      top:0;
      font-size:24px;
      line-height:40px;
    }
    ul:hover {
      background-color:black;
    }

    li.navbar {
      float:right;
      width:fit-content;
      transition-property: background-color, color, width;
      transition-timing-function: ease;
      transition-duration: 0.2s,0.2s,0.4s;
    }

    li.navbar:hover {
      background-color: white;
    }

    li a {
      font-weight: 700;
      font-size: 46px;
      text-transform:uppercase;
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      letter-spacing: -6px;
      transition-property: font-style,color;
      transition-timing-function: ease;
      transition-duration: 0.4s;
    }

    li.navbar a:hover {
      font-style:italic;
      color:black;
    }

    input {
      height:25px;
    }
    table {
      margin-top:5%;
      width: 100%;
    }

    form{
      width:100%;
    }

    input {
      width:60%;
    }

  </style>
  <title>Lost / Found / Dropoff</title>
</header>
</html>

<?php
    if (!isset($_SESSION['id'])) {
        header('Location: index.php');
        exit();
    }

    $id = $_SESSION['id'];

    $conn = mysqli_connect('localhost','root','','digital');
    $result=mysqli_query($conn,"SELECT * FROM `users` WHERE user_id='$id'");
    $row=mysqli_fetch_array($result);
    $username=$row[1];
?>

<!DOCTYPE html>

<ul>
  <li class="navbar" style="float:left;"><a href="dashboard.php" >lost  /  found</a></li>
  <li class="navbar" style="float:left;"><a href="logout.php" style="font-size:12px;letter-spacing:1px;">logout: <?=$username?></a></li>
  <li class="navbar" style="text-decoration:underline;"><a href="dropoff.php" >dropoff</a></li>
  <li class="navbar" style="text-decoration:underline;"><a href="pickup.php">pickup</a></li>
  <li class="navbar" style="text-decoration:underline;"><a href="modify.php">modify</a></li>
</ul>


<h1>lost  /  found</h1>
<h2>login or register to search or upload lost items</h2>

<div>
    <h4>Log an item</h4>
    <form action="upload.php" method="post">
    <input name="name" placeholder="Name" type="text" required><br>
    <input name ="date" value="<?php  date_default_timezone_set("pacific/auckland"); echo date("Y-m-d"); ?>" type="date" required><br>
    <input name="location" placeholder="Location" type="text" required><br>
    <input name="category" placeholder="Category" type="text" required><br>
    <input name="value" placeholder="Value" type="text" required><br>
    <button id="submit" style="margin-top:16px;">LOG</button>
    </form>
</div>