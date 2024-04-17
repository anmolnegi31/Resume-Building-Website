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

$sql = "SELECT message_id FROM contactus ORDER BY message_id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $last_message_id = $row["message_id"];
} else {
    $last_message_id = 0;
}

$message_id=$last_message_id+1;

$sql = "INSERT INTO contactus (message_id, user_id, username, email, message) VALUES ('$message_id', '$user_id', '$username', '$email', '$message')";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
