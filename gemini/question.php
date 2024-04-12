<?php
if (isset($_COOKIE['profile'])) {
    $profile = $_COOKIE['profile'];
} 
else {
    $profile=response(" My name is ". $row['first_name'] . " ". $row['last_name'].". I am a student of ".$row['degree']." ".$row['field_of_study'].". Write a introduction for a resume for ".$row['job_title']." job title in 100 words.");
}

if (isset($_COOKIE['job_title'])) {
    $job_title = $_COOKIE['job_title'];
} 
else {
    $job_title=response("For a resume of ".$row['job_title']." write a paragraph of 30 words explaning about ".$row['job_title']);
}

if (isset($_COOKIE['Proficient_in'])) {
    $Proficient_in = $_COOKIE['Proficient_in'];
} 
else {
    $Proficient_in=response("I am creating an resume in which i want to add a paragraph about my skills. I am proficient in ".$row['Proficient_in']." write a paragraph for about 40 to 50 words.");
}

if (isset($_COOKIE['additional_details'])) {
    $additional_details=$_COOKIE['additional_details'];
} 
else {
    $additional_details=response("I am creating an resume, in which in additional details section i have added ".$row['additional_details']." Write a paragraph using it in 40 to 50 words");
}
if (isset($_COOKIE['college'])) {
    $college=$_COOKIE['college'];
} 
else {
    $college=response("Write a short paragraph of about 20 to 30 words which i can write in my resume. It should be about my college and ". $row['field_of_study']);
}
?>