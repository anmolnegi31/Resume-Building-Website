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

$sql = "SELECT * FROM user_resumes WHERE resume_id = $id"; 
$result = $conn->query($sql);


$row = $result->fetch_assoc();

require_once '../../dompdf/autoload.inc.php';
include "../../gemini/response.php";
include "../../gemini/question.php"; 

use Dompdf\Dompdf;


$dompdf = new Dompdf();

$html = '    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <style>
      .rela-block {
        display: block;
        position: relative;
        margin: auto;
      }
      
      
      .abs-center {
        display: block;
        position: relative;
        font-size: 25px;
        margin: 0;
        top: 50%;
        left: 0;
        right: 0;
        bottom: 0;
        text-align: left;
        width: 500%;
      }
      
      body {
        font-family: Open Sans;
        font-size: 14.04px;
        letter-spacing: 0px;
        font-weight: 400;
        line-height: 21.84px;
        margin: 0;
        padding: 0;
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
      
      .user-photo {
        max-width: 170px;
        height: auto;
        margin-bottom: 0px;
      }
      
      h2 {
        font-family: Open Sans;
        font-size: 21px;  
        letter-spacing: 3.5px;  
        font-weight: 600;
        line-height: 28px;  
        color: #000;
      }
      
      h3 {
        font-family: Open Sans;
        font-size: 14.7px;  
        letter-spacing: 0.7px;  
        font-weight: 600;
        line-height: 19.6px;  
        color: #000;
      }
      
      .page {
        width: 100%;
        max-width: 1600px;
        margin: 0px;
        background-color: #fff;
        box-shadow: 6px 10px 28px 0px rgba(0,0,0,0.4);
      }
      .top-bar {
        height: 90px;
        background-color: #848484;
        color: #fff;
      }
      
      .name {
        display: false;
        position: absolute;
        margin: false;
        top: false;
        left: 300px;
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
        width: 120%;
      }
      
      .side-bar {
        display: false;
        position: absolute;
        margin: false;
        top: 42px;  
        left: 25px;  
        right: false;
        bottom: 0;
        width: 180px;  
        background-color: #f7e0c1;
        padding: 224px 21px 32.5px;  
      }
      
      .mugshot {
        display: false;
        position: absolute;
        margin: false;
        top: 35px;  
        left: 40px;  
        right: false;
        bottom: false;
        height: 147px;  
        width: 130px;  
      }
      
      .mugshot .logo {
        margin: -16.1px;  
      }

      .side-header {
        font-family: Open Sans;
        font-size: 12.6px;  
        letter-spacing: 2.8px;  
        font-weight: 600;
        line-height: 19.6px;  
        margin: 30px auto 7px;  
        padding-bottom: 3.5px;  
        border-bottom: 1px solid #888;
      }
      
      .list-thing {
        padding-left: 10px;  
        margin-bottom: 6px;  
      }
      
      .content-container {
        margin-right: 0;
        width: 330;  
        padding: 0px;  
      }
      
      .content-container > * {
        margin: 0 auto 15px;  
      }
      
      .content-container > h3 {
        margin: 0 auto 3px;  
      }
      
      .content-container > p.long-margin {
        margin: 0 auto 30px;  
      }
      
      .title {
        width: 56%;  
        text-align: center;
      }
      
      .separator {
        width: 168px;  
        height: 0px;  
        background-color: #999;
      }
      
      .greyed {
        background-color: #ddd;
        width: 70%;  
        max-width: 406px;  
        text-align: center;
        font-family: Open Sans;
        font-size: 12.6px;  
        letter-spacing: 4.2px;  
        font-weight: 600;
        line-height: 19.6px;  
      }
      
      
    </style>
</head>
<body>
<div class="rela-block page">
<div class="rela-block top-bar">
    <div class="caps name"><div class="abs-center">'. $row['first_name'] . ' ' . $row['last_name'] . '</div></div>
</div>
<div class="side-bar">
    <div class="mugshot">
        <div class="logo">
            <img width="250" src="http://localhost/talentcrafters/uploads/'.$id.'.jpg" alt="User Photo" class="user-photo">
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
    <p class="long-margin">'.$profile.'</p>
    <div class="rela-block caps greyed">Description</div>

    <h3>' . $row['job_title'] . '</h3>
    <p class="justified">'.$job_title.'</p>
    
    <h3>' . $row['Proficient_in'] . '</h3>
    <p class="justified">'.$Proficient_in.'</p>
    
    <h3>Additional Details</h3>
    <p class="justified">' .$additional_details. '</p>
</div>
</div>
</body>
</html>'; 


$dompdf->set_option('isRemoteEnabled',true);
$dompdf->loadHtml($html);


$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream($row['first_name'].' '.$row['last_name'].' Resume.pdf',array('Attachment'=>0)); 

exit();
?>

