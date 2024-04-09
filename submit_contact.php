<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'talentcrafters'; 

// Create connection
$conn = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$message = $_POST['message'];

// Check if the user is logged in
if(isset($_SESSION['user_id'])) {
    // User is logged in, retrieve user ID from session
    $user_id = $_SESSION['user_id'];
} else {
    // User is not logged in, set user_id to NULL
    $user_id = NULL;
}

// Insert into message table
$sql = "INSERT INTO message (user_id, message, created_at) VALUES ('$user_id', '$message', NOW())";

if (mysqli_query($conn, $sql)) {
    echo "Thank you for your message!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
