<?php
if (!isset($_SESSION)){
    session_start();
}

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'talentcrafters'; 

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if(isset($_SESSION['user_id'])) {
    $sql = "SELECT username FROM users where user_id = ".$_SESSION["user_id"];
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $username = $user['username'];
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
.navbar-links {
    display: flex;
    align-items: center;
}

.navbar-links a {
    color: #007bff; 
    text-decoration: none;
    margin-right: 20px;
    padding: 10px;
    transition: color 0.3s ease; 
}

.navbar-links a:hover {
    color: #0056b3; 
}

.dropdown {
    position: relative;
}


.dropbtn {
    background-color: transparent;
    border: none;
    color: #007bff; 
    font-size: 16px;
    cursor: pointer;
    padding: 10px;
    transition: color 0.3s ease; 
}


.dropdown-content {
    display: none;
    position: absolute;
    background-color: #ffffff; 
    min-width: 160px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
}

.dropdown-content a {
    color: #333; 
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    transition: background-color 0.3s ease; 
}

.dropdown-content a:hover {
    background-color: #f0f0f0;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    color: #0056b3; 
}

    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="../index.php">TalentCrafters</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../template.php">Template</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../ChatBot/bot.php">Chat Bot</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Job Suggest
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            
            <?php
            if(isset($_SESSION['user_id'])) {
                echo '<div class="username">';
                echo '<div class="navbar-links">
                        <div class="dropdown">
                            <button class="dropbtn">'. $username. '</button>
                            <div class="dropdown-content">
                                <a href="../Account/view_profile.php?user_id='.$_SESSION["user_id"].'">View Profile</a>
                                <a href="../Account/edit_profile.php?user_id='.$_SESSION["user_id"].'">Edit Profile</a>
                                <a href="../Account/logout.php">Logout</a>
                                <a href="../Account/delete.php?user_id='.$_SESSION["user_id"].'">Delete Account</a>
                            </div>
                        </div>
                    </div>
            ';
                echo '</div>';
                echo '<a href="../Account/logout.php" class="btn btn-danger">Logout</a>';
            } else {
                echo '<div class="signup-btn">';
                echo '<a href="../Account/signup.html" class="signup-btn">Signup</a>';
                echo '<a href="../Account/login.html" class="signup-btn">Login</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</nav>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdownButton = document.querySelector('.dropbtn');
    const dropdownContent = document.querySelector('.dropdown-content');

    dropdownButton.addEventListener('click', function() {
        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
    });

    document.addEventListener('click', function(event) {
        if (!dropdownButton.contains(event.target) && !dropdownContent.contains(event.target)) {
            dropdownContent.style.display = 'none';
        }
    });
});
</script>