<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'talentcrafters';
    $conn = mysqli_connect($host, $user, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = $_POST["email"];
    $password = $_POST["password"];


    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            $_SESSION["user_id"] = $user["user_id"];
            $_SESSION["username"] = $user["username"];
            header("Location: ../index.php");
            exit();
        } else {
            $_SESSION["login_error"] = "Incorrect password. Please try again.";
            header("Location: login.html?error=1");
            exit();
        }
    } else {
        $_SESSION["login_error"] = "User not found. Please register or try again.";
        header("Location: login.html?error=2");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: login.html?error=3");
    exit();
}
?>
