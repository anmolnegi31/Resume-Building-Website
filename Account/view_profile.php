<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    max-width: 800px;
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin: 50px auto; 
}

.profile-container {
    display: grid;
    grid-template-columns: auto 1fr; 
    gap: 20px; 
}

.profile-image img {
    width: 200px;
    height: 200px;
    border-radius: 50%;
    object-fit: cover;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.profile-details {
    padding-top: 20px; 
}

.profile-details h1 {
    font-size: 28px;
    color: #333;
    margin-bottom: 20px;
    border-bottom: 2px solid #ddd;
    padding-bottom: 10px;
}

.profile-details ul {
    padding-left: 20px; 
}

.profile-details ul li {
    font-size: 18px;
    color: #666;
    margin-bottom: 12px;
}

.edit-button {
    display: inline-block;
    padding: 12px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 4px;
}

.edit-button:hover {
    background-color: #0056b3;
    color: white;
}

</style>
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
    }
    include "navigation.php";
    if ($_GET['user_id']){
        $user_id=$_GET['user_id'];
    }
    else{
        header("Location: ../index.php");
    }

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'talentcrafters'; 
    
    $conn = mysqli_connect($host, $user, $password, $database);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM users where user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $username = $user['username'];
    }

    $sql = "SELECT * FROM user_resumes where user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    }
    ?>
    <div class="container">
        <div class="profile-container">
            <div class="profile-image">
                <img src=<?php echo "../".$user["photo"];?> alt="Profile Photo">
            </div>
            <div class="profile-details">
                <h1>Profile Details</h1>
                <p><strong>Username:</strong> <?php echo $username;?></p>
                <p><strong>Name:</strong> <?php echo $user['first_name']." ".$user["last_name"];?></p>
                <p><strong>Email:</strong> <?php echo $user['email'];?></p>
                <p><strong>City:</strong> <?php echo $user["city"];?></p>
                <p><strong>Country:</strong> <?php echo $user["country"];?></p>
                <p><strong>Phone:</strong> <?php echo $user["phone"];?></p>
                <p><strong>Job Title:</strong> <?php echo $user["job_title"];?></p>
                <p><strong>College:</strong> <?php echo $user["college_name"]." ".$user["college_location"];?></p>
                <p><strong>Degree:</strong> <?php echo $user["degree"]." ".$user["field_of_study"];?></p>
                <p><strong>Graduation Year:</strong> <?php echo $user["graduation_year"];?></p>
                <p><strong>Company:</strong> <?php echo $user["company_name"]." ".$user["company_city"];?></p>
                <p><strong>Years of Experience:</strong> <?php echo $user["Year_of_experience"];?></p>
                <p><strong>Proficient in:</strong> <?php echo $user["Proficient_in"];?></p>
                <p><strong>Additional Details:</strong> <?php echo $user["additional_details"];?></p>
            </div>
        </div>
        <a href="edit_profile.php?user_id=<?php echo $user_id; ?>" class="edit-button">Edit Profile</a>
    </div>
</body>
</html>
