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


$row = $result->fetch_assoc();

require_once '../../dompdf/autoload.inc.php';


use Dompdf\Dompdf;


$dompdf = new Dompdf();

$html = '<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resume</title>
  <style>
    * {
        border:0;
        font:inherit;
        font-size:100%;
        margin:0;
        padding:0;
        vertical-align:baseline;
        display:flex;
}
html {
	font-size: 10px;
}
body {
	font-family: Inter, sans-serif;
	background-color: #f3f3f3;
	color: white;
    display: flex;
}

img {
    width: 70%;
    height: auto;
    -webkit-border-radius: 50px;
    border-radius: 50px;
}
a {
	text-decoration: none;
	color: white;
}
.description {
	margin-top: 1rem;
	font-size: 1.5rem;
	font-weight: 400;
	color: #727171;
}
.title {
	color: orange;
	font-weight: 700;
	font-size: 2rem;
	text-transform: uppercase;
}
.item_preTitle {
	font-size: 1.4rem;
	color: #727171;
	font-weight: 300;
}
.item_title {
	font-size: 1.6rem;
	color: white;
	font-weight: 500;
	margin: 0.8rem 0;
}
.item_subtitle {
	font-size: 1.4rem;
	color: #727171;
	font-weight: 400;
}

.container {
	max-width: 1000px;
	width: 90%;
	margin: 0 auto;
	display: grid;
	padding: 5rem;
	background: #070707;
	grid-template-columns: 1fr 1fr;
	gap: 4rem;
}
.profile {
	grid-column: 1 / -1;
	margin-bottom: 2rem;
}
.group-1,
.group-2 {
	display: flex;
	flex-direction: column;
	gap: 5rem;
}
.group-3 {
	max-width: 700px;
	width: 100%;
	margin: 0 auto;
	grid-column: 1/-1;
	display: flex;
	flex-direction: row;
	gap: 5rem;
}
.group-3 > span {
	flex: 1;
}

.profile_container {
	display: flex;
	gap: 2rem;
}
.profile_profileImg {
	max-width: 250px;
}
.profile_name_firstName {
	color: white;
	font-weight: 200;
	font-size: 50px;
	text-transform: uppercase;
	display: block;
	margin-bottom: -0.8rem;
    top: 10px;
    margin-left: 200px;
}
.profile_name_lastName {
	color: #ff7613;
	font-weight: 700;
	font-size: 50px;
	text-transform: uppercase;
	display: block;
    top: 10px;
    margin-left: 200px;
}
.profile_title {
	font-size: 1.5rem;
	font-weight: 400;
	text-transform: uppercase;
    top: 10px;
    margin-left: 200px;
}
.skills_list {
	margin-top: 1rem;
	margin-left: 2rem;
	line-height: 2;
}

.ref_item {
	margin-top: 2rem;
}
.ref_name {
	font-size: 1.6rem;
	font-weight: 700;
}


.edu_item {
	margin-top: 2rem;
}


.certification_item {
	margin-top: 2rem;
}

.exp_item {
	margin-top: 2rem;
}

.awards_item {
	margin-top: 2rem;
}
hr {
	grid-column: 1/-1;
	width: 80%;
	margin: 0 auto;
	margin-top: 5rem;
	margin-bottom: 1rem;
	border: none;
	border-top: 2px solid rgba(128, 128, 128, 0.229);
}

  </style>
</head>

<body>
  <span class="container">
    <span class="profile">
      <span class="profile_container">
        <span class="profile_profileImg">
          <img src="http://localhost/talentcrafters/uploads/'.$id.'.jpg" alt="shaif arfan">
          <h1 class="profile_name">
            <span class="profile_name_firstName">'. $row['first_name'] . '</span>
            <span class="profile_name_lastName">' . $row['last_name'] . '</span>
          </h1>
          <p class="profile_title">' . $row['job_title'] . '</p>
        </span>
      </span>
    </span>
    <span class="group-1">
      <span class="skills">
        <h3 class="title">Expertise</h3>
        <ul class="skills_list description">
            <li>Proficient in ' . $row['Proficient_in'] . '</li>
            <li>Excellent communication and interpersonal skills</li>
            <li>Strong problem-solving abilities</li>
        </ul>
      </span>
      <span class="ref">
        <h3 class="title">Contact</h3>
        <span class="ref_item">
          <p class="description">' . $row['email'] . '</p>
          <p class="description"> ' . $row['phone'] . '</p>
        </span>
        <span class="ref_item">
          <h4 class="ref_name">Location</h4>
          <p class="description"> ' . $row['city'] . ', ' . $row['country'] . ', ' . $row['pincode'] . '</p>
        </span>
      </span>

      <span class="edu">
        <h3 class="title">Education</h3>
        <span class="edu_item">
          <h4 class="item_title">' . $row['degree'] . ' in ' . $row['field_of_study'] . '</h4>
          <p class="item_subtitle">
          ' . $row['college_name'] . ', ' . $row['college_location'] .'
          </p>
        </span>
      </span>

      <span class="certification">
        <h3 class="title">Additional details</h3>
        <span class="certification_item">
          <p class="description">
          ' . $row['additional_details'] . '
          </p>
        </span>
      </span>
    </span>
    <span class="group-2">
      <span class="exp">
        <h3 class="title">Experience</h3>
        <span class="exp_item">
          <p class="item_preTitle">' . $row['Year_of_experience'] . ' years of experience</p>
          <h4 class="item_title">' . $row['company_name'] . ', ' . $row['company_city'] . '</h4>
          <p class=" description">
          During my time at ' . $row['company_name'] . ', I acquired valuable hands-on experience within the industry. Working on spanerse projects and collaborating with colleagues, I developed and refined essential skills in problem-solving, teamwork, project management. This experience has equipped me with a deep understanding of industry, preparing me to contribute effectively to new challenges and opportunities in the future.
          </p>
        </span>
      </span>
      <span class="awards">
        <h3 class="title">Description</h3>
        <span class="awards_item">
          <h4 class="item_title">' . $row['job_title'] . '</h4>
          <p class=" description">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies massa et erat luctus hendrerit. Curabitur non consequat enim. Vestibulum bibendum mattis dignissim. Proin id sapien quis libero interdum porttitor.
          </p>
        </span>
        <span class="awards_item">
          <h4 class="item_title">' . $row['Proficient_in'] . '</h4>
          <p class="description">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec ultricies massa et erat luctus hendrerit. Curabitur non consequat enim. Vestibulum bibendum mattis dignissim. Proin id sapien quis libero interdum porttitor
          </p>
        </span>
      </span>
    </span>
</span>
</body>
</html>'; 


$dompdf->set_option('isRemoteEnabled',true);
$dompdf->loadHtml($html);


$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream($row['first_name'].' '.$row['last_name'].' Resume.pdf',array('Attachment'=>0)); 

exit();
?>

