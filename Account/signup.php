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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $check_query = "SELECT * FROM users WHERE username='$username' OR email='$email'";
    $check_result = mysqli_query($conn, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        echo '<div class="error-message">Username or email already exists</div>';
        echo '<meta http-equiv="refresh" content="1;url=signup.html">';
    } else {
        
        $sql = "SELECT user_id FROM users ORDER BY user_id DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $last_user_id = $row["user_id"];
        } else {
            $last_user_id = 0;
        }

        $user_id=$last_user_id+1;
        $sql = "INSERT INTO users (user_id, username, email, password) VALUES ('$user_id', '$username', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['user_id']=$user_id;
            header("Location: enter_user_info.php?user_id=$user_id");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>
