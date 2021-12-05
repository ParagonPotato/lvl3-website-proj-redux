<?php

//Settings
define("DB_HOST", "localhost");
define("DB_NAME", "digital");
define("DB_CHARSET","utf8");
define("DB_USER", "root");
define("DB_PASSWORD","");

$conn = mysqli_connect('localhost','root','','digital');
    if(!$conn) {
      header("Location: index.php?databaseconnerr=t");
      exit();
    }

//Connection
$pdo = new PDO(
    "mysql:host=".DB_HOST.";charset=".DB_CHARSET.";dbname=".DB_NAME,
    DB_USER, DB_PASSWORD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
);

//Search
$stmt = $pdo->prepare("SELECT * FROM `lostitems` WHERE `name` LIKE ? OR `date` LIKE ? OR `location` LIKE ? OR `category` LIKE ? OR `value` LIKE ? AND `status` = 0");
$stmt->execute([
    "%".$_POST['search']."%", "%".$_POST['search']."%", "%".$_POST['search']."%", "%".$_POST['search']."%", "%".$_POST['search']."%"
]);

if($_SESSION['admin']=="0") {
    $stmt = $pdo->prepare("SELECT * FROM `lostitems` WHERE `name` LIKE ? AND `poster` = ".$_SESSION['id']);
    $stmt->execute([
        "%".$_POST['search']."%"
    ]);
}

if($_SESSION['admin']=="1") {
    $stmt = $pdo->prepare("SELECT * FROM `lostitems` WHERE `name` LIKE ?");
    $stmt->execute([
        "%".$_POST['search']."%"
    ]);
}

$results = $stmt->fetchAll();

?>