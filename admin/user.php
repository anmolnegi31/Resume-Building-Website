<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Information</title>
    <style>
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

/* User Profile Styles */
.user-profile {
    display: flex;
    align-items: center;
}

.profile-picture {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    margin-right: 20px;
}

.user-details {
    font-size: 16px;
}

.user-details p {
    margin: 10px 0;
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
.admin-name {
    float: right;
    padding: 14px 16px; 
    font-weight: bold; 
    color: #fff;
}
p > a.delete{
    color: red;
    text-decoration: none; 
    display: block;
}
p > a.block{
    color: blue;
    text-decoration: none; 
    display: block;
}
p > a.unblock{
    color: green;
    text-decoration: none; 
    display: block;
}

    </style>
</head>
<body>
    <?php session_start() ?>
    <!-- Include Navigation Bar -->
    <div class="navbar">
        <a href="admin_dashboard.php">Dashboard</a>
        <a href="user.php" class="active">Users</a>
        <a href="messages.php">Messages</a>
        <a href="create_admin.php">Create Admin</a>
        <a href="logout.php">Logout</a>
        <span class="admin-name"><?php echo isset($_SESSION['admin_username']) ? $_SESSION['admin_username'] : ''; ?></span>
    </div>

    <!-- Main Content Area -->
    <div class="container">
        <h1>User Information</h1>

        <?php

        if (!isset($_SESSION['admin_id'])){
            header("Location: index.html");
            exit();
        }
        
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'talentcrafters'; 
        
        $conn = mysqli_connect($host, $user, $password, $database);
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // Pagination variables
        $usersPerPage = 5;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
        $start = ($page - 1) * $usersPerPage;

        // Query to fetch users with pagination
        $queryUsers = "SELECT user_id, username, email, created_at, status FROM users ORDER BY created_at DESC LIMIT $start, $usersPerPage";
        $resultUsers = mysqli_query($conn, $queryUsers);

        // Calculate total number of users
        $totalUsersQuery = "SELECT COUNT(*) AS total FROM users";
        $totalUsersResult = mysqli_query($conn, $totalUsersQuery);

        if ($totalUsersResult) {
            $totalUsersData = mysqli_fetch_assoc($totalUsersResult);
            $totalUsers = $totalUsersData['total'];
            
            // Calculate total number of pages
            $totalPages = ceil($totalUsers / $usersPerPage);
        } else {
            // Handle error if query fails
            $totalPages = 0; // Set a default value or handle the error accordingly
        }


        if ($resultUsers && mysqli_num_rows($resultUsers) > 0) {
            while ($user = mysqli_fetch_assoc($resultUsers)) {
                if ($user['status']){
                    $block = '<p><a class="unblock" href="block.php?user_id='.$user['user_id'].'&page='.$page.'">Unblock</a></p>';
                }
                else{
                    $block = '<p><a class="block" href="block.php?user_id='.$user['user_id'].'&page='.$page.'">Block</a></p>';
                }
                echo '<div class="section">';
                // Fetch user photo from user_resumes table
                $sql = "SELECT photo FROM user_resumes WHERE user_id = {$user['user_id']}";
                $resultPhoto = mysqli_query($conn, $sql);
                $rowPhoto = mysqli_fetch_assoc($resultPhoto);
                $photo = isset($rowPhoto['photo']) ? '../' . $rowPhoto['photo'] : 'default_profile.jpg';

                echo '<div class="user-profile">';
                echo '<img src="' . $photo . '" alt="Profile Picture" class="profile-picture">';
                echo '<div class="user-details">';
                echo "<p><strong>User ID:</strong> {$user['user_id']}</p>";
                echo "<p><strong>Username:</strong> {$user['username']}</p>";
                echo "<p><strong>Email:</strong> {$user['email']}</p>";
                echo "<p><strong>Created at:</strong> {$user['created_at']}</p>";
                echo $block;
                echo '<p><a class="delete" href="delete_user.php?user_id='.$user['user_id'].'&page='.$page.'">Delete</a></p>';
                echo '</div>'; // .user-details
                echo '</div>'; // .user-profile
                echo '</div>'; // .section
            }

            // Previous and Next buttons for pagination
            echo '<div class="pagination">';
            if ($page > 1) {
                echo '<a href="user.php?page=' . ($page - 1) . '" class="prev">&laquo; Previous</a>';
            }
            if ($page < $totalPages) {
                echo '<a href="user.php?page=' . ($page + 1) . '" class="next">Next &raquo;</a>';
            }
            echo '</div>'; // .pagination
        } else {
            echo '<p>No users found.</p>';
        }
        ?>
    </div> <!-- .container -->

</body>
</html>


