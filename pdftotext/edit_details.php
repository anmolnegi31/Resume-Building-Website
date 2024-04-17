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


if (isset($_GET['id'])){
    $resume_id = $_GET['id'];
}
else{
    header("Location: ../index.php");;
}

if (isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
}
else{
    die("User log out!!!");
}

$sql = "SELECT * from user_resumes WHERE resume_id=$resume_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $first_name = $row["first_name"];
    $last_name = $row["last_name"];
    $city = $row["city"];
    $country = $row["country"];
    $pincode = $row["pincode"];
    $phone = $row["phone"];
    $email = $row["email"];
    $job_title = $row["job_title"];
    $college_name = $row["college_name"];
    $college_location = $row["college_location"];
    $degree = $row["degree"];
    $field_of_study = $row["field_of_study"];
    $graduation_year = $row["graduation_year"];
    $additional_details = $row["additional_details"];
    $company_name = $row["company_name"];
    $company_city = $row["company_city"];
    $Year_of_experience = $row["Year_of_experience"];
    $Proficient_in = $row["Proficient_in"];
    $newphoto = $row["photo"];
} else {
    die("User not found");
}

$sql = "DELETE from user_resumes WHERE resume_id=$resume_id";
$result = $conn->query($sql);


$sql = "SELECT photo from user_resumes WHERE user_id=$user_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $oldphoto = $row["photo"];
}
else{
    die("User not found!!!");
}

unlink("../".$oldphoto);
rename("../".$newphoto,"../".$oldphoto);

$sql = "UPDATE user_resumes SET 
 first_name = '$first_name',
 last_name = '$last_name',
 city = '$city',
 country = '$country',
 pincode = '$pincode',
 phone = '$phone',
 email = '$email',
 job_title = '$job_title',
 college_name = '$college_name',
 college_location = '$college_location',
 degree = '$degree',
 field_of_study = '$field_of_study',
 graduation_year = '$graduation_year',
 additional_details = '$additional_details',
 company_name = '$company_name',
 company_city = '$company_city',
 Year_of_experience = '$Year_of_experience',
 Proficient_in = '$Proficient_in'
WHERE user_id = '$user_id'";


$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->close();

$sql = "UPDATE users SET
email = '$email' 
WHERE user_id = '$user_id'";


$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->close();
header("Location: ../index.php");