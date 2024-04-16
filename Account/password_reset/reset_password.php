<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'talentcrafters';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    header("Location: ../login.html?error=3");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['new-password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../login.html?password=2");
    }

    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    $update_query = "UPDATE users SET password='$hashed_password' WHERE email='$email'";
    if (mysqli_query($conn, $update_query)) {
        echo "Password updated successfully";
        header("Location: ../login.html?password=1");
    } else {
        header("Location: ../login.html?error=3");
    }
}

mysqli_close($conn);
?>
