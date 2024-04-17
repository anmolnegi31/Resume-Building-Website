<?php

session_start();

$host = 'localhost';
$user = 'root';
$password = '';
$database = 'talentcrafters'; 

$conn = mysqli_connect($host, $user, $password, $database);

include "../gemini/response.php"; 

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT job_title, degree, field_of_study, graduation_year, company_name, company_city, Year_of_experience, Proficient_in FROM user_resumes WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $job_title = $row["job_title"];
    $degree = $row["degree"];
    $field_of_study = $row["field_of_study"];
    $graduation_year = $row["graduation_year"];
    $company_name = $row["company_name"];
    $company_city = $row["company_city"];
    $year_of_experience = $row["Year_of_experience"];
    $proficient_in = $row["Proficient_in"];
    $stmt->close();
    $conn->close();
}
else{
    header("Location: basic_details.php?details=1");
}

function formatCareerRoadmap($roadmapContent) {
    $htmlOutput = '<div class="roadmap">';

    $sections = explode('**', $roadmapContent);

    $totalSections = count($sections);

    foreach ($sections as $index => $section) {
        $section = trim($section);
        
        if (strpos($section, 'Phase') === 0) {
            $htmlOutput .= "<h2><strong>{$section}</strong></h2>";
        } elseif (!empty($section)) {
            $htmlOutput .= '<div class="bottom"></div>';
            $lines = explode("\n", $section);
            $htmlOutput .= '<ul>';
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line) && strpos($line, '* ') === 0) {
                    $task = trim(substr($line, 1));
                    $htmlOutput .= "<li>{$task}</li>";
                }
            }
            $htmlOutput .= '</ul>';
            if ($index < $totalSections - 1) {
                $htmlOutput .= '<div class="arrow-container">
                                    <img src="img/arrow.png" alt="Downward Arrow" class="arrow-img">
                                </div>';
            }
            
        }
    }

    $htmlOutput .= '</div>';

    return $htmlOutput;
}

if (isset($_COOKIE['job_roadmap'])) {
    $road_map = $_COOKIE['job_roadmap'];
} 
else {
    $quation = "Create a road map for $job_title, I have done $degree in $field_of_study and graduated in $graduation_year. I want job in $company_name, $company_city. I have $year_of_experience year of experience and proficient in $proficient_in. Create Phases for roadmap. Each heading should contain the word 'Phase'. Don't use the symbols like #, only use ** for heading.";
    $road_map = response($quation);
    setcookie('job_roadmap', $road_map, time() + 3600, '/');
}

$formattedRoadmap = formatCareerRoadmap($road_map);
$career = "Career Roadmap for $job_title at $company_name";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Roadmap</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            text-align: center;
            padding: 20px;
        }
        h1 {
            color: #11A9C6;
        }
        .roadmap {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            padding: 10px;
            margin-bottom: 10px;
            
        }
        .bottom{
            border-bottom: 2px solid #4ED8D4;
            margin-bottom: 10px;
        }
        .arrow-img {
            width: 30px;
            height: 30px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $career; ?></h1>
        <?php
        echo $formattedRoadmap;
        ?>
    </div>
</body>
</html>
