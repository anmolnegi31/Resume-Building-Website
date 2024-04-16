<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
textarea {
    width: calc(100% - 22px); 
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    resize: vertical;
}

input[type="file"] {
    width: 100%;
    margin-top: 5px;
}

button[type="submit"] {
    display: block;
    width: 100%;
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #0056b3;
}


    </style>
</head>
<body>

<?php

$reload_flag = isset($_COOKIE['reload_flag']) ? $_COOKIE['reload_flag'] : '';

if (!$reload_flag) {
    echo '<script>location.reload();</script>';
    setcookie('reload_flag', '1', time() + 3600, '/');
}

include "Expire.php";

if (isset($_GET['temp_no'])){
    $temp_no=$_GET['temp_no'];
}
else{
    $temp_no=0;
}
?>
    <div class="container">
        <h1>Build Your Resume</h1>
        <form action="details_save.php?temp_no=<?php echo $temp_no;?>" id="details-form" enctype="multipart/form-data" method="post">
            <div class="form-group">
                <label for="first-name">First Name</label>
                <input type="text" id="first-name" name="first-name" required>
            </div>
            <div class="form-group">
                <label for="last-name">Last Name</label>
                <input type="text" id="last-name" name="last-name" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" id="country" name="country" required>
            </div>
            <div class="form-group">
                <label for="pincode">Pincode</label>
                <input type="text" id="pincode" name="pincode" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone">
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="job-title">Job Title</label>
                <input type="text" id="job-title" name="job-title" required>
            </div>
            <div class="form-group">
                <label for="college-name">College Name</label>
                <input type="text" id="college-name" name="college-name" required>
            </div>
            <div class="form-group">
                <label for="college-location">College Location</label>
                <input type="text" id="college-location" name="college-location" required>
            </div>
            <div class="form-group">
                <label for="degree">Degree</label>
                <input type="text" id="degree" name="degree" required>
            </div>
            <div class="form-group">
                <label for="field-of-study">Field of Study</label>
                <input type="text" id="field-of-study" name="field-of-study" required>
            </div>
            <div class="form-group">
                <label for="graduation-year">Graduation Year</label>
                <input type="text" id="graduation-year" name="graduation-year" required>
            </div>
            <div class="form-group">
                <label for="company_name">Company Name</label>
                <input type="text" id="company_name" name="company_name" required>
            </div>
            <div class="form-group">
                <label for="company_city">City of Company</label>
                <input type="text" id="company_city" name="company_city" required>
            </div>
            <div class="form-group">
                <label for="Year_of_experience">Year of Experience</label>
                <input type="text" id="Year_of_experience" name="Year_of_experience" required>
            </div>
            <div class="form-group">
                <label for="Proficient_in">Proficient in</label>
                <input type="text" id="Proficient_in" name="Proficient_in" required>
            </div>
            <div class="form-group">
                <label for="additional-details">Additional Details</label>
                <textarea id="additional-details" name="additional-details" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Upload Photo</label>
                <input type="file" id="photo" name="photo" accept="image/*" required>
            </div>
            <button type="submit">Create Resume</button>
        </form>
    </div>
</body>
</html>
