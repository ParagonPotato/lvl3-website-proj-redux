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

    li a, li h5 {
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
      margin:0px;
    }

    li.navbar a:hover {
      font-style:italic;
      color:black;
    }

    li.nohover:hover {
      background:black;
      cursor:default;
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
  <title>Lost / Found</title>
</header>
</html>

<!DOCTYPE html>

<ul>
  <li class="navbar" style="float:left;"><a href="index.php">lost  /  found</a></li>
  <?php
  
    $conn = @mysqli_connect("localhost","root","","digital");
    $database_status = "Online";
    $database_status_color="#11ca4c";
    if(!$conn) {
      $database_status = "Offline";
      $database_status_color = "#c00";
    }
  ?>
  <li class="navbar nohover" style="float:left;"><h5 style="font-size:12px;letter-spacing:1px;"><span style="background: <?php echo $database_status_color ?>;border-radius:50%;display:inline-block;height:6px;vertical-algin: middle;width:6px;margin-right:8px;"></span>Database Status: <?=$database_status ?></h5></li>
</ul>


<h1>lost  /  found</h1>
<h2>login or register to search or upload lost items</h2>
<div>
<?php if(isset($_GET['loginerror'])) : ?>
  <h3>There was an error logging in, this is probably human error. Give it another whirl logging in.</h3>
<?php endif; ?>
<?php if(isset($_GET['regusernameempty'])) : ?>
  <h3>Username is required!</h3>
<?php endif; ?>
<?php if(isset($_GET['regusernameduplicate'])) : ?>
  <h3>Sorry, that username is already taken.</h3>
<?php endif; ?>
<?php if(isset($_GET['regpasswordempty'])) : ?>
  <h3>Password field is required!</h3>
<?php endif; ?>
<?php if(isset($_GET['databaseconnerr'])) : ?>
  <h3>! Connection to database was lost. Hopefully it will be back online soon, come back then. !</h3>
<?php endif; ?>
</div>

<table>
	<tr>
    <th><div style="margin-left:50%;">
          <h4>Register</h4>
          <form action="register.php" method="post">
            <input id="namebox" name="username" placeholder="Register: Username" type="username"><br>
            <input id="agebox" name="password" placeholder="Register: Password" type="password"><br>
            <button id="submit" style="margin-top:16px;">REGISTER</button>
          </form>
      </div>
    <th><div style="margin-right:50%;">
          <h4>Login</h4>
          <form action="login.php" method="post">
            <input id="namebox" name="username" placeholder="Login: Username" type="username"><br>
            <input id="agebox" name="password" placeholder="Login: Password" type="password"><br>
            <button id="submit" style="margin-top:16px;">LOGIN</button>
          </form>
</div>
  </tr>
</table>