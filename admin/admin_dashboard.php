<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
<style>
/* Reset default margin and padding */
body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

/* Navigation Bar Styles */
.navbar {
    background-color: #007bff;
    overflow: hidden;
}

.navbar a {
    float: left;
    display: block;
    color: #fff;
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
/* Admin Name Styles */
.admin-name {
    float: right;
    padding: 14px 16px; 
    font-weight: bold; 
    color: #fff;
}

/* Main Content Container */
.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #f5f5f5;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Section Styles */
.section {
    margin-top: 20px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.section h2 {
    color: #007bff;
    border-bottom: 2px solid #007bff;
    padding-bottom: 10px;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

table, th, td{
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

td > a{
    color: red;
    text-decoration: none; 
    display: block;
    text-align: center;
}

/* List Styles */
ul {
    list-style-type: none;
    padding: 0;
}

ul li {
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

ul li:last-child {
    border-bottom: none;
}


</style>
</head>
<body>
    <?php
    session_start();

    if (!isset($_SESSION['admin_id'])){
        header("Location: index.html");
    }

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'talentcrafters'; 

    $conn = mysqli_connect($host, $user, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $queryUsers = "SELECT user_id, username, created_at FROM users ORDER BY created_at DESC LIMIT 5";
    $resultUsers = mysqli_query($conn, $queryUsers);

    $users = array();
    if ($resultUsers && mysqli_num_rows($resultUsers) > 0) {
        while ($row = mysqli_fetch_assoc($resultUsers)) {
            $users[] = $row;
        }
    }

    $queryMessages = "SELECT * FROM contactus ORDER BY created_at DESC LIMIT 5";
    $resultMessages = mysqli_query($conn, $queryMessages);

    $messages = array();

    if ($resultMessages && mysqli_num_rows($resultMessages) > 0) {
        while ($row = mysqli_fetch_assoc($resultMessages)) {
            $messages[] = $row;
        }
    }
    ?>
    
    <div class="navbar">
    <a href="admin_dashboard.php" class="active">Dashboard</a>
    <a href="user.php">Users</a>
    <a href="messages.php">Messages</a>
    <a href="create_admin.php">Create Admin</a>
    <a href="logout.php">Logout</a>
    <span class="admin-name"><?php echo isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : ''; ?></span>
   </div>
    <div class="container">
        <h1>Welcome to the TalentCrafters Admin Dashboard</h1>
        <div class="section">
            <h2>Newly Created Users</h2>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through each user and populate the table rows dynamically
                    foreach ($users as $user) {
                        echo "<tr>";
                        echo "<td>{$user['user_id']}</td>";
                        echo "<td>{$user['username']}</td>";
                        echo "<td>{$user['created_at']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="section">
            <h2>Current Messages</h2>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Message</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Loop through each message and populate the table rows dynamically
                    foreach ($messages as $message) {
                        if ($message['user_id']==0){
                            $message['user_id'] = "NULL";
                        }
                        echo "<tr>";
                        echo "<td>{$message['user_id']}</td>";
                        echo "<td>{$message['username']}</td>";
                        echo "<td>{$message['message']}</td>";
                        echo "<td><a href='delete_message.php?message_id={$message['message_id']}'>Delete</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
