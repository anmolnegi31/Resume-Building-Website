<?php
session_start();

// Check if user is logged in as admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.html");
    exit();
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Retrieve form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate password and confirm password match
    if ($password !== $confirm_password) {
        echo '<script>alert("Password and Confirm Password do not match.");</script>';
        exit(); // Stop script execution
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("Invalid email format.");</script>';
        exit(); // Stop script execution
    }

    // Database connection
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'talentcrafters';

    $conn = mysqli_connect($host, $user, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
     // Check if username already exists
     $check_username_query = "SELECT * FROM admins WHERE username = '$username'";
     $username_result = mysqli_query($conn, $check_username_query);
 
     if (mysqli_num_rows($username_result) > 0) {
         echo '<script>alert("Username already exists. Please choose a different username.");</script>';
         exit(); // Stop script execution
     }
 
     // Check if email already exists
     $check_email_query = "SELECT * FROM admins WHERE email = '$email'";
     $email_result = mysqli_query($conn, $check_email_query);
 
     if (mysqli_num_rows($email_result) > 0) {
         echo '<script>alert("Email already exists. Please use a different email address.");</script>';
         exit(); // Stop script execution
     }

    $sql = "SELECT admin_id FROM admins ORDER BY admin_id DESC LIMIT 1";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_admin_id = $row["admin_id"];
    } else {
        $last_admin_id = 0;
    }
    $admin_id = $last_admin_id +1;
    $password = $_POST['password'];

    // Insert new admin into database
    $query = "INSERT INTO admins (admin_id, username, email, password) VALUES ($admin_id, '$username', '$email', '".password_hash($password, PASSWORD_DEFAULT)."')";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo '<script>alert("Admin created successfully!");</script>';
    } else {
        echo '<script>alert("Error creating admin. Please try again.");</script>';
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Admin</title>
    <style>
        /* Body Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

/* Navigation Bar Styles */
.navbar {
    background-color: #007bff;
    overflow: hidden;
}

.navbar a {
    float: left;
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

.navbar a:hover {
    background-color: #0056b3;
}

.navbar a.active {
    background-color: #0056b3;
}

/* Container Styles */
.container {
    width: 80%;
    max-width: 500px;
    margin: 20px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Form Styles */
form {
    margin-top: 20px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 8px;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-sizing: border-box;
}

input[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}
.admin-name {
    float: right;
    padding: 14px 16px; 
    font-weight: bold; 
    color: #fff;
}

/* Responsive Design - Adjust Container Width */
@media (max-width: 600px) {
    .container {
        width: 90%;
    }
}

    </style>
</head>
<body>
    <!-- Include Navigation Bar -->
    <div class="navbar"> 
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="user.php">Users</a>
        <a href="messages.php">Messages</a>
        <a href="create_admin.php" class="active">Create Admin</a>
        <a href="logout.php">Logout</a>
        <span class="admin-name"><?php echo isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : ''; ?></span>
    </div>

    <!-- Main Content Area - Admin Creation Form -->
    <div class="container">
        <h1>Create Admin</h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validateForm()">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required><br><br>

            <input type="submit" name="submit" value="Create Admin">
        </form>
    </div> 
<script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var confirm_password = document.getElementById("confirm_password").value;

        if (password !== confirm_password) {
            alert("Password and Confirm Password do not match");
            return false;
        }

        // Additional client-side validation (e.g., email format) can be added here
        
        return true; // Proceed with form submission
    }
</script>
</body>
</html>
