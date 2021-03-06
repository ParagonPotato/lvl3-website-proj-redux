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
    
    button {
      height: 27px;
    }

    tr:nth-child(even) {
      background-color:gray;
    }

    a.link {
        color:black;
    }

    td {
        text-align:center;
        font-size:18px;
    }

    label {
        font-size:16px;
    }
  </style>
  <title>Lost / Found / Modify</title>
</header>
</html>

<?php
    if (!isset($_SESSION['id'])) {
        header('Location: index.php');
        exit();
    }

    $id = $_SESSION['id'];

    $conn = mysqli_connect('localhost','root','','digital');
    if(!$conn) {
      header("Location: index.php?databaseconnerr=t");
      exit();
    }
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


<h1>modify</h1>
<h2>modify your items (click on the item's name to modify it)</h2>

<form action="modify.php?modify=t" method="post">
  <input name="search" placeholder="Search for keywords (search with nothing to see all entries)" text="text">
  <button type="submit">Search</button>
</form>

<?php if(isset($_GET['itemid'])) : ?>
  <?php
    $itemid=$_GET['itemid'];
    $result=mysqli_query($conn,"SELECT * FROM `lostitems` WHERE `lost_id`='$itemid'");
    $row=mysqli_fetch_array($result);
  ?>
    <form action="editing.php?itemid=<?php echo $itemid; ?>" method="post">
        <h2>Editing: <?php echo $row['name']; ?></h2>
        <input name="name" placeholder="Name" type="text" value="<?php echo $row['name']?>" required><br>
        <input name ="date" value="<?php  echo $row['date']; ?>" type="date" required><br>
        <input name="location" placeholder="Location" type="text" value="<?php echo $row['location']?>" required><br>
        <input name="category" placeholder="Category" type="text" value="<?php echo $row['category']?>" required><br>
        <input name="value" placeholder="Value" type="text" value="<?php echo $row['value']?>" required><br>
        <input name="status" value="0" type=radio style="width:2%;" checked="checked"><label>Still Lost</label>
        <input name="status" value="1" type=radio style="width:2%"><label>Found</label><br>
        <button id="submit" style="margin-top:16px;">Update</button>
    </form>
<?php endif; ?>

<?php if(isset($_GET['valueerror'])) : ?>
  <h3>Value entered was not a digit. Give it another whirl.</h3>
<?php endif; ?>


<table>
  <tr>
    <th style='width:40%;'>Name</th>
    <th style='width:14%' >Date Lost</th>
    <th style='width:14%' >Location Found</th>
    <th style='width:14%' >Category</th>
    <th style='width:14%' >Value</th>
    <th style='width:4%;'>Status</th>
  </tr>
  <tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
  </tr>
  <?php
    if (isset($_POST['search'])) {
      require "search.php";
      if (count($results) > 0) {
        foreach ($results as $row) {
          echo "<tr><td style='width:40%;'><a class='link' href='modify.php?itemid=".$row["lost_id"]."' >" . $row["name"] . "</a></td><td>" . $row["date"] . "</td><td>" . $row["location"] . "</td><td>" . $row["category"] . "</td><td>~$" . $row["value"] . "</td><td style='width:3%;'>" . $row["status"] . "</td></tr>";
        }
      } else { echo "<div>No entries found</div>";}
    }
  ?>
</table>