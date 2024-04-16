<?php
session_start();

if (isset($_GET['details'])){
    $details = $_GET['details'];
}
else{
    header("Location: basic_details.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_title = sanitizeInput($_POST["job_title"]);
    $degree = sanitizeInput($_POST["degree"]);
    $field_of_study = sanitizeInput($_POST["field_of_study"]);
    $graduation_year = sanitizeInput($_POST["graduation_year"]);
    $company_name = sanitizeInput($_POST["company_name"]);
    $proficient_in = sanitizeInput($_POST["proficient_in"]);

    $_SESSION['basic_details'] = [
        'job_title' => $job_title,
        'degree' => $degree,
        'field_of_study' => $field_of_study,
        'graduation_year' => $graduation_year,
        'company_name' => $company_name,
        'proficient_in' => $proficient_in
    ];

    if ($details == 1){
        header("Location: career_roadmap_2.php");
    }
    else if ($details == 2 ){
        header("Location: jobs_2.php");
    }
    else{
        header("Location: basic_details.php");
    }
    exit(); 
}

function sanitizeInput($input) {
    return htmlspecialchars(trim($input));
}
?>
