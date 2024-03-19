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
$errors = array();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $sql = "SELECT id FROM user_resumes ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $last_user_id = $row["id"];
    } else {
        $last_user_id = 0;
}

    $user_id=$last_user_id+1;

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
    $template = test_input($_POST["template"]);

    // Upload photo
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $errors[] = "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check file size
    if ($_FILES["photo"]["size"] > 500000) {
        $errors[] = "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $errors[] = "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $photo = $target_file;
            rename($photo, "uploads/$user_id.png");
            $photo="uploads/$user_id.png";
        } else {
            $errors[] = "Sorry, there was an error uploading your file.";
        }
    }

    // If no validation errors, insert data into database
    if (empty($errors)) {
        $sql = "INSERT INTO user_resumes (id, first_name, last_name, city, country, pincode, phone, email, job_title, college_name, college_location, degree, field_of_study, graduation_year, additional_details, template, photo) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssssssssssss", $user_id, $first_name, $last_name, $city, $country, $pincode, $phone, $email, $job_title, $college_name, $college_location, $degree, $field_of_study, $graduation_year, $additional_details, $template, $photo);
        $stmt->execute();
        $stmt->close();

        // Redirect to success page or any other page
        header("Location: index.php");
        exit;
    } else {
        // Redirect back to the form with errors
        $_SESSION['errors'] = $errors;
        header("Location: details.php");
        exit;
    }
}
?>
