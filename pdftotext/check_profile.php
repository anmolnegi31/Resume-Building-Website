<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Profile</title>
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

    if (isset($_SESSION['pdf_details'])){
        $resume=$_SESSION['pdf_details'];
    }
    else{
        header("Location: ../index.php");
    }

    function extractDetails($content) {
        $details = array();
    
        // Regular expression pattern to extract details
        $pattern = '/First name:\s*(.*?)\s+Last name:\s*(.*?)\s+Email:\s*(.*?)\s+City:\s*(.*?)\s+Country:\s*(.*?)\s+Phone:\s*(.*?)\s+Job title:\s*(.*?)\s+College name:\s*(.*?)\s+College location:\s*(.*?)\s+Degree:\s*(.*?)\s+Field of study:\s*(.*?)\s+Graduation year:\s*(\d{4})/';
    
        // Perform regular expression match
        if (preg_match($pattern, $content, $matches)) {
            // Extracted details
            $details['first_name'] = $matches[1];
            $details['last_name'] = $matches[2];
            $details['email'] = $matches[3];
            $details['city'] = $matches[4];
            $details['country'] = $matches[5];
            $details['phone'] = $matches[6];
            $details['job_title'] = $matches[7];
            $details['college_name'] = $matches[8];
            $details['college_location'] = $matches[9];
            $details['degree'] = $matches[10];
            $details['field_of_study'] = $matches[11];
            $details['graduation_year'] = $matches[12];
        }
    
        return $details;
    }

    include "../gemini/response.php";
    
    $question = "From the given resume give me First name, Last name, Email, city, country, Phone, job title, college name, college location, degree, field of study, graduation year of the user. Resume is $resume. In phone just give 10 numbers. Output should be like this example 'First name: Isha Last name: Negi Email: ishanegi811@gmail.com City: Haryana Country: India Phone: 9910740658 Job title: Not given College name: Manav Rachna International Institute of Research and Studies College location: Not given Degree: Graduation Field of study: Not given Graduation year: 2024'";

    $response = response($question);

    if (!isset($response)){
        header("Location: upload.html");
    }
    
    $details = extractDetails($response);
    foreach ($details as $key => $value) {
        if ($value === "Not given"){
            $details[$key]="";
        }
    }
    ?>
    
    <div class="container">
        <h2>Check your Details</h2>
<form action="save_details.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
    <div class="form-group">
        <label for="first-name">First Name</label>
        <input type="text" id="first-name" name="first-name" value="<?php echo $details['first_name'];?>" required>
    </div>

    <div class="form-group">
        <label for="last-name">Last Name</label>
        <input type="text" id="last-name" name="last-name" value="<?php echo $details['last_name'];?>" required>
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" value="<?php echo $details['email'];?>" required>
        <span id="emailError" class="error-message"></span>
    </div>

    <div class="form-group">
        <label for="city">City</label>
        <input type="text" id="city" name="city" value="<?php echo $details['city'];?>" required>
    </div>

    <div class="form-group">
        <label for="country">Country</label>
        <input type="text" id="country" name="country" value="<?php echo $details['country'];?>" required>
    </div>

    <div class="form-group">
        <label for="pincode">Pincode</label>
        <input type="text" id="pincode" name="pincode" required>
        <span id="pincodeError" class="error-message"></span>
    </div>

    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" value="<?php echo $details['phone'];?>" required>
        <span id="phoneError" class="error-message"></span>
    </div>

    <div class="form-group">
        <label for="job-title">Job Title</label>
        <input type="text" id="job-title" name="job-title" value="<?php echo $details['job_title'];?>" required>
    </div>

    <div class="form-group">
        <label for="college-name">College Name</label>
        <input type="text" id="college-name" name="college-name" value="<?php echo $details['college_name'];?>" required>
    </div>

    <div class="form-group">
        <label for="college-location">College Location</label>
        <input type="text" id="college-location" name="college-location" value="<?php echo $details['college_location'];?>" required>
    </div>

    <div class="form-group">
        <label for="degree">Degree</label>
        <input type="text" id="degree" name="degree" value="<?php echo $details['degree'];?>" required>
    </div>

    <div class="form-group">
        <label for="field-of-study">Field of Study</label>
        <input type="text" id="field-of-study" name="field-of-study" value="<?php echo $details['field_of_study'];?>" required>
    </div>

    <div class="form-group">
        <label for="graduation-year">Graduation Year</label>
        <input type="text" id="graduation-year" name="graduation-year" value="<?php echo $details['graduation_year'];?>" required>
        <span id="gradYearError" class="error-message"></span>
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
        <span id="expError" class="error-message"></span>
    </div>

    <div class="form-group">
        <label for="Proficient_in">Proficient in</label>
        <input type="text" id="Proficient_in" name="Proficient_in" required>
    </div>

    <div class="form-group">
        <label for="additional-details">Additional Details</label>
        <input type="text" id="additional-details" rows="4" name="additional-details">
    </div>

    <div class="form-group">
        <label for="photo">Upload Photo</label>
        <input type="file" id="photo-preview" name="photo" accept="image/*" required>
    </div>

    <button type="submit">Proceed</button>
</form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function validateForm() {
        const pincode = $('#pincode').val().trim();
        const phone = $('#phone').val().trim();
        const graduationYear = $('#graduation-year').val().trim();
        const experience = $('#Year_of_experience').val().trim();
        const email = $('#email').val().trim();

        // Reset error messages
        $('#pincodeError').text('');
        $('#phoneError').text('');
        $('#gradYearError').text('');
        $('#expError').text('');
        $('#emailError').text(''); // Added email error message reset

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

        // Validate Email using AJAX
        return checkEmailExists(email);
    }

    function checkEmailExists(email) {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: '../check_email.php',
                method: 'POST',
                data: { email: email },
                dataType: 'json',
                success: function(response) {
                    console.log('Email Check Response:', response);
                    if (response && response.exists) {
                        $('#emailError').text('This email already exists');
                        resolve(false); // Email exists, form submission blocked
                    } else {
                        resolve(true); // Email does not exist, allow form submission
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Email Check Error:', error);
                    $('#emailError').text('Error checking email. Please try again.');
                    resolve(false); // Error occurred, block form submission
                }
            });
        });
    }

    // Attach form submission event listener
    $(document).ready(function() {
        $('#createAccountForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            // Validate form and proceed if validation passes
            validateForm().then(function(valid) {
                if (valid) {
                    // If all validations pass, submit the form
                    $('#createAccountForm')[0].submit(); // Submit the form
                }
            }).catch(function(error) {
                console.error('Form Validation Error:', error);
            });
        });
    });
</script>

</body>
</html>