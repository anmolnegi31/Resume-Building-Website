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

$pic = "Select resume_id, photo from user_resumes where user_id = '$user_id'";
$result = $conn->query($pic);
$user = $result->fetch_assoc();
$resume_id = $user["resume_id"];
unlink("../".$user['photo']);

$sql = "DELETE from users WHERE user_id = '$user_id'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->close();

$sql = "DELETE from user_resumes WHERE user_id = '$user_id'";
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
