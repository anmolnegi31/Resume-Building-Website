<?php
session_start();

// Redirect to login page if admin is not authenticated
if (!isset($_SESSION['admin_id'])){
    header("Location: index.html");
    exit();
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

// Pagination variables
$messagesPerPage = 3;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $messagesPerPage;

// Query to fetch messages with pagination
$queryMessages = "SELECT message_id, user_id, username, email, message, created_at FROM contactus ORDER BY created_at DESC LIMIT $start, $messagesPerPage";
$resultMessages = mysqli_query($conn, $queryMessages);

$messages = array();
if ($resultMessages && mysqli_num_rows($resultMessages) > 0) {
    while ($row = mysqli_fetch_assoc($resultMessages)) {
        $messages[] = $row;
    }
}

// Calculate total number of messages
$totalMessagesQuery = "SELECT COUNT(*) AS total FROM contactus";
$totalMessagesResult = mysqli_query($conn, $totalMessagesQuery);
$totalMessages = mysqli_fetch_assoc($totalMessagesResult)['total'];
$totalPages = ceil($totalMessages / $messagesPerPage);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
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
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Message Styles */
.message {
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 20px;
    background-color: #fff;
}

.message p {
    margin: 5px 0;
}

/* Pagination Styles */
.pagination {
    margin-top: 20px;
    text-align: center;
}

.pagination a {
    display: inline-block;
    padding: 8px 16px;
    margin-right: 5px;
    text-decoration: none;
    color: #007bff;
    border: 1px solid #007bff;
    border-radius: 5px;
}

.pagination a.active,
.pagination a:hover {
    background-color: #007bff;
    color: #fff;
}

.pagination .prev,
.pagination .next {
    background-color: #f5f5f5;
    color: #007bff;
}

.pagination .prev:hover,
.pagination .next:hover {
    background-color: #ddd;
}
p > a{
    color: red;
    text-decoration: none; 
    display: block;
}
.admin-name {
    float: right;
    padding: 14px 16px; 
    font-weight: bold; 
    color: #fff;
}
    </style>
</head>
<body>
    <!-- Include Navigation Bar -->
    <div class="navbar">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="user.php">Users</a>
        <a href="messages.php"  class="active">Messages</a>
        <a href="create_admin.php">Create Admin</a>
        <a href="logout.php">Logout</a>
        <span class="admin-name"><?php echo isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : ''; ?></span>
    </div>

    <!-- Main Content Area -->
    <div class="container">
        <h1>Messages</h1>

        <?php
        // Display messages
        foreach ($messages as $message) {
            if ( $message['user_id'] ==0 ){
                $message['user_id'] = "NULL";
            }
            echo '<div class="message">';
            echo '<p><strong>User ID:</strong> ' . $message['user_id'] . '</p>';
            echo '<p><strong>Username:</strong> ' . $message['username'] . '</p>';
            echo '<p><strong>Email:</strong> ' . $message['email'] . '</p>';
            echo '<p><strong>Message:</strong> ' . $message['message'] . '</p>';
            echo '<p><strong>Arrived At:</strong> ' . $message['created_at'] . '</p>';
            echo "<p><a href='delete_message.php?message_id={$message['message_id']}&link=1&page={$page}'>Delete</a></p>";
            echo '</div>';
        }

        // Pagination links
        echo '<div class="pagination">';
        if ($page > 1) {
            echo '<a href="messages.php?page=' . ($page - 1) . '" class="prev">&laquo; Previous</a>';
        }
        if ($page < $totalPages) {
            echo '<a href="messages.php?page=' . ($page + 1) . '" class="next">Next &raquo;</a>';
        }
        echo '</div>';
        ?>
    </div> <!-- .container -->

</body>
</html>
