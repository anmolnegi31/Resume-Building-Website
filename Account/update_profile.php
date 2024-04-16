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


$first_name = $last_name = $city = $country = $pincode = $phone = $email = "";
$job_title = $college_name = $college_location = $degree = $field_of_study = $graduation_year = "";
$additional_details = $template = $photo = "";
$company_name=$company_city=$Year_of_experience=$Proficient_in="";
$errors = array();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $username =test_input($_POST['username']);
    $first_name = test_input($_POST["first-name"]);
    $last_name = test_input($_POST["last-name"]);
    $city = test_input($_POST["city"]);
    $country = test_input($_POST["country"]);
    $pincode = test_input($_POST["pincode"]);
    $phone = test_input($_POST["phone"]);
    $email = test_input($_POST["email"]);
    $job_title = test_input($_POST["job-title"]);
    $college_name = test_input($_POST["college-name"]);
    $college_location = test_input($_POST["college-location"]);
    $degree = test_input($_POST["degree"]);
    $field_of_study = test_input($_POST["field-of-study"]);
    $graduation_year = test_input($_POST["graduation-year"]);
    $additional_details = test_input($_POST["additional-details"]);
    $company_name = test_input($_POST["company_name"]);
    $company_city = test_input($_POST["company_city"]);
    $Year_of_experience = test_input($_POST["Year_of_experience"]);
    $Proficient_in = test_input($_POST["Proficient_in"]);
    $user_id=test_input($_POST["user_id"]);


    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] === UPLOAD_ERR_OK) {

        $pic = "Select resume_id, photo from user_resumes where user_id = '$user_id'";
        $result = $conn->query($pic);
        $user = $result->fetch_assoc();
        $resume_id = $user["resume_id"];
        unlink("../".$user['photo']);

        $uploadDir = "../uploads/";
        $uploadFile = $uploadDir . basename($_FILES["photo"]["name"]);

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $uploadFile)) {
            echo "File uploaded successfully.";
        } else {
            echo "Error: Unable to upload file.";
        }

        rename($uploadFile,"../uploads/$resume_id.jpg");
    } else {
        echo ("No file uploaded or upload error occurred.");
    }
   


    if (empty($errors)) {
        $sql = "UPDATE users SET
        username = '$username',
        email = '$email' 
        WHERE user_id = '$user_id'";


        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt->close();

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
        
        include "../Expire.php";
        header("Location: ../index.php");
    } else {

        $_SESSION['errors'] = $errors;
        echo $_SESSION['errors'];
        exit;
    }
}
?>
