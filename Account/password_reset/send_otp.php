<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'talentcrafters'; 

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    $sql = "SELECT email,user_id FROM users where email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $otp = rand(100000, 999999); 
        
        session_start();
        $_SESSION['reset_otp'] = $otp;
        $_SESSION['reset_email'] = $email;
        header('Location: verify_otp.php?send=yes&id='.$row['user_id']);
        
    }
    else{
        header("Location: ../login.html?error=2");
        exit;
    }
}
?>

