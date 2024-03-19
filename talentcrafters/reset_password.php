<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'talentcrafters';

// Establishing connection to the database
$conn = mysqli_connect($host, $user, $password, $database);

// Checking the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];

    // Validate the email address (you may want to add more validation)
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    // Hash the new password
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Update the user's record in the database with the hashed password
    $update_query = "UPDATE users SET password='$hashed_password' WHERE email='$email'";
    if (mysqli_query($conn, $update_query)) {
        echo "Password updated successfully";
        echo '<meta http-equiv="refresh" content="2;url=index.php">';
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Close the database connection
mysqli_close($conn);
?>
