<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Current Job Listings</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1500px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 30px;
            color: #11A9C6;
        }

        .job-list {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .job-card {
            width: calc(33.33% - 20px);
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .job-card:hover {
            transform: translateY(-5px);
        }

        h2 {
            font-size: 24px;
            color: #4ED8D4; 
            margin-bottom: 10px;
        }

        p {
            font-size: 16px;
            color: #666;
            line-height: 1.5;
        }
        .read-more {
            color: #4ED8D4;
            text-decoration: none;
            font-weight: bold;
            margin-top: 10px;
            display: inline-block;
        }

        .read-more:hover {
            text-decoration: underline;
            color: #11A9C6;
        }
    </style>
</head>
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

include "../gemini/response.php";

if (isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT job_title, degree, field_of_study, graduation_year, country, Year_of_experience, Proficient_in FROM user_resumes WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $job_title = $row["job_title"];
    $degree = $row["degree"];
    $field_of_study = $row["field_of_study"];
    $graduation_year = $row["graduation_year"];
    $year_of_experience = $row["Year_of_experience"];
    $proficient_in = $row["Proficient_in"];
    $country = $row["country"];
    $stmt->close();
    $conn->close();
}
else{
    header("Location: basic_details.php?details=2");
}


if (isset($_COOKIE['job_available'])) {
    $inputString = $_COOKIE['job_available'];
} 
else {
    $question = "What are the companies for $degree, $field_of_study graduates for $job_title in $country? i want 10 to 12 companies. Just give me company name and description. Try to insert $country's companies. Description should be about 40 words. Also use the word 'company name' and 'description' in output";
    $inputString = response($question);
    setcookie('job_available', $inputString, time() + 3600, '/');
}

function parseJobDescriptions($inputString) {
    $pattern = '/\*\*Company Name:\*\*\s*(.*?)\s*\n\*\*Description:\*\*\s*(.*?)\s*\n\n/';
    preg_match_all($pattern, $inputString, $matches, PREG_SET_ORDER);

    $jobDescriptions = [];

    foreach ($matches as $match) {
        $jobTitle = trim($match[1]); 
        $jobDescription = trim($match[2]); 
        $jobDescriptions[$jobTitle] = $jobDescription;
    }

    return $jobDescriptions;
}

$jobs = parseJobDescriptions($inputString);

?>
<body>

    <div class="container">
        <h1>Jobs Available for <?php echo $job_title;?></h1>

        <div class="job-list">
            <?php
                foreach ($jobs as $title => $description) {
                    echo '<div class="job-card">';
                    echo '<h2>' . htmlspecialchars($title) . '</h2>';
                    echo '<p>' . htmlspecialchars(substr($description, 0, 150)) . '... <a href="job_description.php?title='.$title.'&description='.$description.'&job_title='.$job_title.'&country='.$country.'" class="read-more">Read More</a></p>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>

</body>
</html>
