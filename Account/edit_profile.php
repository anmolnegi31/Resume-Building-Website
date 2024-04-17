<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
body, html {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.container {
    max-width: 900px;
    margin: 50px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #007bff;
    margin-bottom: 30px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
    color: #555;
}

input[type="text"],
input[type="email"],
textarea,
button,
input[type="file"] {
    width: 100%;
    padding: 12px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus,
input[type="email"]:focus,
textarea:focus {
    outline: none;
    border-color: #007bff;
}

textarea {
    resize: vertical; 
}

button {
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
    padding: 15px;
    font-size: 16px;
    border-radius: 5px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}
.error-message {
    color: red;
    font-size: 14px;
    margin-top: 5px;
}
    </style>
</head>
<body>
    <?php
    session_start();

    if (isset($_GET['user_id'])){
        $user_id=$_GET['user_id'];
    }
    else{
        header("Location: ../index.php");
    }

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'talentcrafters'; 
    
    $conn = mysqli_connect($host, $user, $password, $database);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM users where user_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $username = $user['username'];
    }

    $sql = "SELECT * FROM user_resumes where user_id = $user_id";
    $result = $conn->query($sql);

    $first_name = $last_name = $city = $country = $pincode = $phone = $email = "";
    $job_title = $college_name = $college_location = $degree = $field_of_study = $graduation_year = "";
    $additional_details = $photo = "";
    $company_name=$company_city=$Year_of_experience=$Proficient_in="";

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $first_name = $user["first_name"];
        $last_name = $user["last_name"];
        $city = $user["city"];
        $country = $user["country"];
        $pincode = $user["pincode"];
        $phone = $user["phone"];
        $email = $user["email"];
        $job_title = $user["job_title"];
        $college_name = $user["college_name"];
        $college_location = $user["college_location"];
        $degree = $user["degree"];
        $field_of_study = $user["field_of_study"];
        $graduation_year = $user["graduation_year"];
        $additional_details = $user["additional_details"];
        $company_name = $user["company_name"];
        $company_city = $user["company_city"];
        $Year_of_experience = $user["Year_of_experience"];
        $Proficient_in = $user["Proficient_in"];
        $photo = $user["photo"];
    }
    ?>
    
    <div class="container">
        <h2>Edit Profile</h2>
<form action="update_profile.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id;?>">
    <input type="hidden" id="email" name="email" value="<?php echo $email;?>">

    <div class="form-group">
        <label for="username">User Name</label>
        <input type="text" id="username" name="username" value="<?php echo $username;?>" required>
    </div>

    <div class="form-group">
        <label for="first-name">First Name</label>
        <input type="text" id="first-name" name="first-name" value="<?php echo $first_name;?>" required>
    </div>

    <div class="form-group">
        <label for="last-name">Last Name</label>
        <input type="text" id="last-name" name="last-name" value="<?php echo $last_name;?>" required>
    </div>

    <div class="form-group">
        <label for="city">City</label>
        <input type="text" id="city" name="city" value="<?php echo $city;?>" required>
    </div>

    <div class="form-group">
        <label for="country">Country</label>
        <input type="text" id="country" name="country" value="<?php echo $country;?>" required>
    </div>

    <div class="form-group">
        <label for="pincode">Pincode</label>
        <input type="text" id="pincode" name="pincode" value="<?php echo $pincode;?>" required>
        <span id="pincodeError" class="error-message"></span>
    </div>

    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" value="<?php echo $phone;?>" required>
        <span id="phoneError" class="error-message"></span>
    </div>

    <div class="form-group">
        <label for="job-title">Job Title</label>
        <input type="text" id="job-title" name="job-title" value="<?php echo $job_title;?>" required>
    </div>

    <div class="form-group">
        <label for="college-name">College Name</label>
        <input type="text" id="college-name" name="college-name" value="<?php echo $college_name;?>" required>
    </div>

    <div class="form-group">
        <label for="college-location">College Location</label>
        <input type="text" id="college-location" name="college-location" value="<?php echo $college_location;?>" required>
    </div>

    <div class="form-group">
        <label for="degree">Degree</label>
        <input type="text" id="degree" name="degree" value="<?php echo $degree;?>" required>
    </div>

    <div class="form-group">
        <label for="field-of-study">Field of Study</label>
        <input type="text" id="field-of-study" name="field-of-study" value="<?php echo $field_of_study;?>" required>
    </div>

    <div class="form-group">
        <label for="graduation-year">Graduation Year</label>
        <input type="text" id="graduation-year" name="graduation-year" value="<?php echo $graduation_year;?>" required>
        <span id="gradYearError" class="error-message"></span>
    </div>

    <div class="form-group">
        <label for="company_name">Company Name</label>
        <input type="text" id="company_name" name="company_name" value="<?php echo $company_name;?>" required>
    </div>

    <div class="form-group">
        <label for="company_city">City of Company</label>
        <input type="text" id="company_city" name="company_city" value="<?php echo $company_city;?>" required>
    </div>

    <div class="form-group">
        <label for="Year_of_experience">Year of Experience</label>
        <input type="text" id="Year_of_experience" name="Year_of_experience" value="<?php echo $Year_of_experience;?>" required>
        <span id="expError" class="error-message"></span>
    </div>

    <div class="form-group">
        <label for="Proficient_in">Proficient in</label>
        <input type="text" id="Proficient_in" name="Proficient_in" value="<?php echo $Proficient_in;?>" required>
    </div>

    <div class="form-group">
        <label for="additional-details">Additional Details</label>
        <input type="text" id="additional-details" rows=4 name="additional-details" value="<?php echo $additional_details;?>">
    </div>

    <div class="form-group">
        <label for="photo">Upload Photo</label>
        <input type="file" id="photo-preview" name="photo" accept="image/*">
    </div>

    <button type="submit">Save Changes</button>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function validateForm() {
            const pincode = $('#pincode').val().trim();
            const phone = $('#phone').val().trim();
            const graduationYear = $('#graduation-year').val().trim();
            const experience = $('#Year_of_experience').val().trim();

            // Reset error messages
            $('#pincodeError').text('');
            $('#phoneError').text('');
            $('#gradYearError').text('');
            $('#expError').text('');

            // Validate Pincode (6 digits)
            if (!/^\d{6}$/.test(pincode)) {
                $('#pincodeError').text('Please enter a valid 6-digit Pincode');
                return false;
            }

            // Validate Phone Number (10 digits)
            if (!/^\d{10}$/.test(phone)) {
                $('#phoneError').text('Please enter a valid 10-digit Phone Number');
                return false;
            }

            // Validate Graduation Year (4 digits)
            if (!/^\d{4}$/.test(graduationYear)) {
                $('#gradYearError').text('Please enter a valid 4-digit Graduation Year');
                return false;
            }

            // Validate Year of Experience (positive number of 1 or 2 digits)
            if (!/^\d{1,2}$/.test(experience) || experience < 0) {
                $('#expError').text('Please enter a valid positive number for Year of Experience (1-2 digits)');
                return false;
            }

            return true; // Form submission allowed if all validations pass
        }
    </script>
</form>
    </div>
</body>
</html>
