<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter User Information</title>
    <link rel="stylesheet" href="enter_user_info.css"> 
</head>
<body>
    <?php
    session_start();
    
    if (isset($_GET['user_id'])){
        $user_id=$_GET['user_id'];
    }
    else{
        $user_id=NULL;
    }
    if (isset($_SESSION['email'])){
        $email=$_SESSION['email'];
    }
    else{
        $email=" ";
    }
    ?>
    <div class="container">
        <h2>Enter User Information</h2>
<form action="save_user_info.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id;?>">
    <input type="hidden" id="email" name="email" value="<?php echo $email;?>">

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
        <span id="pincodeError" class="error-message"></span>
    </div>

    <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" required>
        <span id="phoneError" class="error-message"></span>
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
        <textarea id="additional-details" name="additional-details" rows="4"></textarea>
    </div>

    <div class="form-group">
        <label for="photo">Upload Photo</label>
        <input type="file" id="photo-preview" name="photo" accept="image/*" required>
    </div>

    <button type="submit">Save Information</button>

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
