<?php
session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'talentcrafters'; 

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['user_id'])){
    $user_id=$_GET["user_id"];
}

else{
    header("Location: user.php");
    die();
}

$pic = "Select status from users where user_id = '$user_id'";
$result = $conn->query($pic);
$user = $result->fetch_assoc();
$status = $user["status"];

if ($status){
    $status = 0;
}
else{
    $status = 1;
}

$sql = "UPDATE users SET status = $status WHERE user_id = '$user_id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->close();

if (isset($_GET['page'])){
    $page=$_GET['page'];
    header("Location: user.php?page=$page");
    die();
}

header("Location: user.php");
?>
