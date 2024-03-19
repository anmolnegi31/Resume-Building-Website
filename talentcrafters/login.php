<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'talentcrafters';
    $conn = mysqli_connect($host, $user, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the email and password from the login form
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and sanitize input (not implemented in this example)

    // Prepare and execute the SQL query to check if the user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        // User exists, verify the password
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            // Password is correct, set session variables and redirect to home page
            $_SESSION["user_id"] = $user["id"];
            $_SESSION["username"] = $user["username"];
            header("Location: index.php");
            exit();
        } else {
            // Password is incorrect, set an error message and redirect back to login page
            $_SESSION["login_error"] = "Incorrect password. Please try again.";
            header("Location: login.html");
            exit();
        }
    } else {
        // User does not exist, set an error message and redirect back to login page
        $_SESSION["login_error"] = "User not found. Please register or try again.";
        header("Location: login.html");
        exit();
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the form is not submitted, redirect back to the login page
    header("Location: login.html");
    exit();
}
?>
