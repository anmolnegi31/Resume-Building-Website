<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'talentcrafters'; 

session_start();

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = $_POST['message'];
$username = $_POST['name'];
$email = $_POST['email'];
$user_id = $_POST['user_id'];

$sql = "INSERT INTO contactus (user_id, username, email, message) VALUES ('$user_id', '$username', '$email', '$message')";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
