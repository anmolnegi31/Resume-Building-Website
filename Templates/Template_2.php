<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "talentcrafters";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id=$_GET['id'];

$sql = "SELECT * FROM user_resumes WHERE id = $id"; 
$result = $conn->query($sql);


include "../Navigation.php";
include "../gemini/response.php";




if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    include "../gemini/question.php"; 
    setcookie('profile', $profile, time() + 3600, '/');
    setcookie('job_title', $job_title, time() + 3600, '/');
    setcookie('Proficient_in', $Proficient_in, time() + 3600, '/');
    setcookie('additional_details', $additional_details, time() + 3600, '/');

    $resumeHTML = '
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <style>
    * {
        box-sizing: border-box;
        transition: 0.35s ease;
      }
      .rela-block {
        display: block;
        position: relative;
        margin: auto;
      }
      .rela-inline {
        display: inline-block;
        position: relative;
        margin: auto;
      }
      .floated {
        display: inline-block;
        position: relative;
        margin: false;
      }
      .abs-center {
        display: false;
        position: absolute;
        margin: false;
        top: 50%;
        left: 50%;
        right: false;
        bottom: false;
        transform: translate(-50%, -50%);
        text-align: center;
        width: 88%;
      }
      body {
        font-family: Open Sans;
        font-size: 18px;
        letter-spacing: 0px;
        font-weight: 400;
        line-height: 28px;
        background-size: cover;
      }
      body:before {
        content: "";
        display: false;
        position: fixed;
        margin: 0;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(255,255,255,0.92);
      }
      .caps {
        text-transform: uppercase;
      }
      .justified {
        text-align: justify;
      }
      p.light {
        color: #777;
      }
      h2 {
        font-family: Open Sans;
        font-size: 30px;
        letter-spacing: 5px;
        font-weight: 600;
        line-height: 40px;
        color: #000;
      }
      h3 {
        font-family: Open Sans;
        font-size: 21px;
        letter-spacing: 1px;
        font-weight: 600;
        line-height: 28px;
        color: #000;
      }
      .page {
        width: 90%;
        max-width: 1200px;
        margin: 80px auto;
        background-color: #fff;
        box-shadow: 6px 10px 28px 0px rgba(0,0,0,0.4);
      }
      .top-bar {
        height: 220px;
        background-color: #848484;
        color: #fff;
      }
      .name {
        display: false;
        position: absolute;
        margin: false;
        top: false;
        left: calc(350px + 5%);
        right: 0;
        bottom: 0;
        height: 120px;
        text-align: center;
        font-family: Raleway;
        font-size: 58px;
        letter-spacing: 8px;
        font-weight: 100;
        line-height: 60px;
      }
      .name div {
        width: 94%;
      }
      .side-bar {
        display: false;
        position: absolute;
        margin: false;
        top: 60px;
        left: 5%;
        right: false;
        bottom: 0;
        width: 350px;
        background-color: #f7e0c1;
        padding: 320px 30px 50px;
      }
      .mugshot {
        display: false;
        position: absolute;
        margin: false;
        top: 50px;
        left: 70px;
        right: false;
        bottom: false;
        height: 210px;
        width: 210px;
      }
      .mugshot .logo {
        margin: -23px;
      }
      .logo {
        display: false;
        position: absolute;
        margin: false;
        top: 0;
        left: 0;
        right: false;
        bottom: false;
        z-index: 100;
        margin: 0;
        color: #000;
        height: 250px;
        width: 250px;
      }
      .logo .logo-svg {
        height: 100%;
        width: 100%;
        stroke: #000;
        cursor: pointer;
      }
      .logo .logo-text {
        display: false;
        position: absolute;
        margin: false;
        top: 58%;
        right: 16%;
        cursor: pointer;
        font-family: "Montserrat";
        font-size: 55px;
        letter-spacing: 0px;
        font-weight: 400;
        line-height: 58.333333333333336px;
      }
      .social {
        padding-left: 60px;
        margin-bottom: 20px;
        cursor: pointer;
      }
      .social:before {
        content: "";
        display: false;
        position: absolute;
        margin: false;
        top: -4px;
        left: 10px;
        right: false;
        bottom: false;
        height: 35px;
        width: 35px;
        background-size: cover !important;
      }
      .side-header {
        font-family: Open Sans;
        font-size: 18px;
        letter-spacing: 4px;
        font-weight: 600;
        line-height: 28px;
        margin: 60px auto 10px;
        padding-bottom: 5px;
        border-bottom: 1px solid #888;
      }
      .list-thing {
        padding-left: 25px;
        margin-bottom: 10px;
      }
      .content-container {
        margin-right: 0;
        width: calc(95% - 350px);
        padding: 25px 40px 50px;
      }
      .content-container > * {
        margin: 0 auto 25px;
      }
      .content-container > h3 {
        margin: 0 auto 5px;
      }
      .content-container > p.long-margin {
        margin: 0 auto 50px;
      }
      .title {
        width: 80%;
        text-align: center;
      }
      .separator {
        width: 240px;
        height: 2px;
        background-color: #999;
      }
      .greyed {
        background-color: #ddd;
        width: 100%;
        max-width: 580px;
        text-align: center;
        font-family: Open Sans;
        font-size: 18px;
        letter-spacing: 6px;
        font-weight: 600;
        line-height: 28px;
      }
      @media screen and (max-width: 1150px) {
        .name {
          color: #fff;
          font-family: Raleway;
          font-size: 38px;
          letter-spacing: 6px;
          font-weight: 100;
          line-height: 48px;
        }
      }
      .download-button {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        position: absolute;
        top: 20px;
        right: 20px;
    }
    .download-button:hover {
        background-color: green;
    }
      
    </style>
</head>
<body>
<div class="rela-block page">
<div class="rela-block top-bar">
    <a href="./download/download_template_2.php?id='.$id.'" class="download-button">Download</a>
    <div class="caps name"><div class="abs-center">'. $row['first_name'] . ' ' . $row['last_name'] . '</div></div>
</div>
<div class="side-bar">
    <div class="mugshot">
        <div class="logo">
            <img width="250" src="../' . $row['photo'] . '" alt="User Photo" class="user-photo">
        </div>
    </div>
    <p>My Place Drive</p>
    <p>' . $row['city'] . ', ' . $row['country'] . ', ' . $row['pincode'] . '</p>
    <p>' . $row['phone'] . '</p>
    <p>' . $row['email'] . '</p>
    <p class="rela-block caps side-header">Experience</p>
    <p class="rela-block list-thing">' . $row['job_title'] . '</p>
    <p class="rela-block list-thing">' . $row['company_name'] . ', ' . $row['company_city'] . '</p>
    <p class="rela-block list-thing">' . $row['Year_of_experience'] . ' years of experience</p>
    <p class="rela-block caps side-header">Education</p>
    <p class="rela-block list-thing">' . $row['degree'] . ' in ' . $row['field_of_study'] . '</p>
    <p class="rela-block list-thing">' . $row['college_name'] . ', ' . $row['college_location'] .'</p>
    <p class="rela-block list-thing">Graduated in '. $row['graduation_year'] . '</p>
    <p class="rela-block caps side-header">Expertise</p>
    <p class="rela-block list-thing">' . $row['Proficient_in'] . '</p>
    <p class="rela-block list-thing">Excellent communication and interpersonal skills</p>
    <p class="rela-block list-thing">Strong problem-solving abilities</p>
</div>
<div class="rela-block content-container">
    <h2 class="rela-block caps title">'. $row['job_title'] .'</h2>
    <div class="rela-block separator"></div>
    <div class="rela-block caps greyed">Profile</div>
    <p class="long-margin"> '.$profile.'</p>
    <div class="rela-block caps greyed">Description</div>

    <h3>' . $row['job_title'] . '</h3>
    <p class="justified">'.$job_title.' </p>
    
    <h3>' . $row['Proficient_in'] . '</h3>
    <p class="justified">'.$Proficient_in.'</p>
    
    <h3>Additional Details</h3>
    <p class="justified">' . $additional_details . '</p>
</div>
</div>
</body>
</html>

    ';

    echo $resumeHTML;

} else {
    echo "No user data found!";
}

$conn->close();
?>
