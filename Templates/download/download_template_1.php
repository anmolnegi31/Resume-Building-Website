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


use Dompdf\Dompdf;


$dompdf = new Dompdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            font-size: 13px;
        }
        .container {
            max-width: 600px;
            margin: 0;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 0px;
        }
        h1, h2, h3 {
            color: #333;
        }
        p {
            color: #666;
            line-height: 1.6;
        }
        .section-title {
            border-bottom: 2px solid #ccc;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }
        .contact-info {
            margin-bottom: 10px;
        }
        .contact-info p {
            margin: 2px 0;
        }
        .education, .experience {
            margin-bottom: 15px;
        }
        .job-title {
            font-weight: bold;
            margin-top: 5px;
        }
        .skills {
            margin-bottom: 15px;
        }
        .skills ul {
            list-style-type: none;
            padding: 0;
        }
        .skills li {
            margin-bottom: 2.5px;
        }
        .additional-details {
            margin-bottom: 15px;
        }
        .user-photo {
            max-width: 150px;
            height: auto;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="http://localhost/talentcrafters/uploads/'.$id.'.jpg" alt="User Photo" class="user-photo">
        <section class="contact-info">
            <h2 class="section-title">Contact Information</h2>
            <p>Name:'. $row['first_name'] . ' ' . $row['last_name'] . '</p>
            <p>Location: ' . $row['city'] . ', ' . $row['country'] . ', ' . $row['pincode'] . '</p>
            <p>Phone: ' . $row['phone'] . '</p>
            <p>Email: ' . $row['email'] . '</p>
        </section>
        <section class="education">
            <h2 class="section-title">Education</h2>
            <p><strong>' . $row['degree'] . ' in ' . $row['field_of_study'] . '</strong></p>
            <p>' . $row['college_name'] . ', ' . $row['college_location'] .'</p>
            <p>Graduation Year: ' . $row['graduation_year'] . '</p>
        </section>
        <section class="experience">
            <h2 class="section-title">Experience</h2>
            <div>
                <p class="job-title">' . $row['job_title'] . '</p>
                <p><strong>' . $row['company_name'] . ', ' . $row['company_city'] . '</strong></p>
                <p>' . $row['Year_of_experience'] . ' years of experience</p>
            </div>
        </section>
        <section class="skills">
            <h2 class="section-title">Skills</h2>
            <ul>
                <li>Proficient in ' . $row['Proficient_in'] . '</li>
                <li>Excellent communication and interpersonal skills</li>
                <li>Strong problem-solving abilities</li>
            </ul>
        </section>
        <section class="additional-details">
            <h2 class="section-title">Additional Details</h2>
            <p>' . $row['additional_details'] . '</p>
        </section>
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

