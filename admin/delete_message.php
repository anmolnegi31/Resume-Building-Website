<?php
session_start();

if (!isset($_SESSION['admin_id'])){
    header("Location: index.html");
}

if (!isset($_GET['message_id'])){
    header("Location: admin_dashboard.php");
}

$message_id = $_GET['message_id'];

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'talentcrafters'; 

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$queryUsers = "DELETE FROM contactus WHERE message_id = $message_id";
$resultUsers = mysqli_query($conn, $queryUsers);

if (isset($_GET['link'])){
    if (isset($_GET['page'])){
        $page = $_GET['page'];
        header("Location: messages.php?page=$page");
        die();
    }
    header("Location: messages.php");
    die();
}

header("Location: admin_dashboard.php");
?>