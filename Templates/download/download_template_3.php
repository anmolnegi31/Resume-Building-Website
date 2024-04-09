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

function calculateStartDate($yearsOfExperience) {
    $currentDate = new DateTime();

    $startDate = clone $currentDate;
    $startDate->sub(new DateInterval('P' . $yearsOfExperience . 'Y'));

    return $startDate->format('Y-m-d');
}

$startDate = calculateStartDate($row['Year_of_experience']);

require_once '../../dompdf/autoload.inc.php';
include "../../gemini/response.php";
include "../../gemini/question.php"; 

use Dompdf\Dompdf;


$dompdf = new Dompdf();

$html = '<!DOCTYPE html>
<html>
<head>
<title>Resume</title>

<meta name="viewport" content="width=device-width"/>
<meta name="description" content="The Curriculum Vitae of Joe Bloggs."/>
<meta charset="UTF-8"> 
<style>
    html,body,div,span,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,abbr,address,cite,code,del,dfn,em,img,ins,kbd,q,samp,small,strong,sub,sup,var,b,i,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,figcaption,figure,footer,header,hgroup,menu,nav,section,summary,time,mark,audio,video {
border:0;
font:inherit;
font-size:100%;
margin:0;
padding:0;
vertical-align:baseline;
}

article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section {
display:block;
}

html, body { font-family: Lato, helvetica, arial, sans-serif; font-size: 14px; color: #222;}

.clear {clear: both;}

p {
    font-size: 1em;
    line-height: 1.4em;
    margin-bottom: 20px;
    color: #444;
}

#cv {
    width: 90%;
    max-width: 800px;
    background: #f3f3f3;
    margin: 30px auto;
}

.mainDetails {
    padding: 25px 35px;
    border-bottom: 2px solid #cf8a05;
    background: #ededed;
}

#name h1 {
    font-size: 2.5em;
    font-weight: 700;
    font-family: Rokkitt, Helvetica, Arial, sans-serif;
    margin-bottom: -6px;
}

#name h2 {
    font-size: 2em;
    margin-left: 2px;
    font-family: Rokkitt, Helvetica, Arial, sans-serif;
}

#mainArea {
    padding: 0 40px;
}

#headshot {
    width: 12.5%;
    float: left;
    margin-right: 30px;
}

#headshot img {
    width: 100%;
    height: auto;
    -webkit-border-radius: 50px;
    border-radius: 50px;
}

#name {
    float: left;
}

#contactDetails {
    float: right;
}

#contactDetails ul {
    list-style-type: none;
    font-size: 0.9em;
    margin-top: 2px;
}

#contactDetails ul li {
    margin-bottom: 3px;
    color: #444;
}

#contactDetails ul li a, a[href^=tel] {
    color: #444; 
    text-decoration: none;
    -webkit-transition: all .3s ease-in;
    -moz-transition: all .3s ease-in;
    -o-transition: all .3s ease-in;
    -ms-transition: all .3s ease-in;
    transition: all .3s ease-in;
}

#contactDetails ul li a:hover { 
    color: #cf8a05;
}


section {
    border-top: 1px solid #dedede;
    padding: 20px 0 0;
}

section:first-child {
    border-top: 0;
}

section:last-child {
    padding: 20px 0 10px;
}

.sectionTitle {
    float: left;
    width: 25%;
}

.sectionContent {
    float: right;
    width: 72.5%;
}

.sectionTitle h1 {
    font-family: Rokkitt, Helvetica, Arial, sans-serif;
    font-style: italic;
    font-size: 1.5em;
    color: #cf8a05;
}

.sectionContent h2 {
    font-family: Rokkitt, Helvetica, Arial, sans-serif;
    font-size: 1.5em;
    margin-bottom: -2px;
}

.subDetails {
    font-size: 0.8em;
    font-style: italic;
    margin-bottom: 3px;
}

.keySkills {
    list-style-type: none;
    -moz-column-count:3;
    -webkit-column-count:3;
    column-count:3;
    margin-bottom: 20px;
    font-size: 1em;
    color: #444;
}

.keySkills ul li {
    margin-bottom: 3px;
}
</style>


</head>
<body id="top">
<div id="cv" class="instaFade">
    <div class="mainDetails">
        <div id="headshot" class="quickFade">
            <img src="http://localhost/talentcrafters/uploads/'.$id.'.jpg" alt="Alan Smith" />
        </div>
        
        <div id="name">
            <h1 class="quickFade delayTwo">'. $row['first_name'] . ' ' . $row['last_name'] . '</h1>
            <h2 class="quickFade delayThree">' . $row['job_title'] . '</h2>
        </div>
        
        <div id="contactDetails" class="quickFade delayFour">
            <ul>
                <li>e: ' . $row['email'] . '</li>
                <li>m: ' . $row['phone'] . '</li>
                <li>l: ' . $row['city'] . ', ' . $row['country'] . ', ' . $row['pincode'] . '</li>
            </ul>
        </div>
        <div class="clear"></div>
    </div>
    
    <div id="mainArea" class="quickFade delayFive">
        <section>
            <article>
                <div class="sectionTitle">
                    <h1>Personal Profile</h1>
                </div>
                
                <div class="sectionContent">
                    <p>'.$profile.'</p>
                </div>
            </article>
            <div class="clear"></div>
        </section>
        
        
        <section>
            <div class="sectionTitle">
                <h1>Description</h1>
            </div>
            
            <div class="sectionContent">
                <article>
                    <h2>' . $row['job_title'] . '</h2>
                    <p class="subDetails">'.$startDate.' - Present</p>
                    <p>'.$job_title.'</p>
                </article>
                
                <article>
                    <h2>' . $row['Proficient_in'] . '</h2>
                    <p>'.$Proficient_in.'</p>
                </article>
                
                <article>
                    <h2>Additional details</h2>
                    <p>' .$additional_details. '</p>
                </article>
            </div>
            <div class="clear"></div>
        </section>
        
        
        <section>
            <div class="sectionTitle">
                <h1>Key Skills</h1>
            </div>
            
            <div class="sectionContent">
                <ul class="keySkills">
                <li>Proficient in ' . $row['Proficient_in'] . '</li>
                <li>Excellent communication and interpersonal skills</li>
                <li>Strong problem-solving abilities</li>
                </ul>
            </div>
            <div class="clear"></div>
        </section>
        
        
        <section>
            <div class="sectionTitle">
                <h1>Education</h1>
            </div>
            
            <div class="sectionContent">
                <article>
                    <h2>' . $row['college_name'] . ', ' . $row['college_location'] .'</h2>
                    <p class="subDetails">' . $row['degree'] . ' in ' . $row['field_of_study'] . '</p>
                    <p>'.$college.'</p>
                </article>
            </div>
            <div class="clear"></div>
        </section>
        
    </div>
</div>
</body>
</html>
'; 


$dompdf->set_option('isRemoteEnabled',true);
$dompdf->loadHtml($html);


$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream($row['first_name'].' '.$row['last_name'].' Resume.pdf',array('Attachment'=>0)); 

exit();
?>

