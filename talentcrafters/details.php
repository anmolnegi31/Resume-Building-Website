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
    width: calc(100% - 22px); /* Adjust for input padding and border */
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    resize: vertical;
}

input[type="file"] {
    width: 100%;
    margin-top: 5px;
}

#photo-preview {
    max-width: 100%;
    height: auto;
    margin-top: 5px;
    display: none;
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
    $tem=$_GET["template"];
    ?>
    <div class="container">
        <h1>Build Your Resume</h1>
        <form action="details_save.php" id="details-form" enctype="multipart/form-data" method="post">
            <input type="hidden" id="template" name="template" value= "<?php $item ?>">
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
                <input type="text" id="job-title" name="job-title">
            </div>
            <div class="form-group">
                <label for="college-name">College Name</label>
                <input type="text" id="college-name" name="college-name">
            </div>
            <div class="form-group">
                <label for="college-location">College Location</label>
                <input type="text" id="college-location" name="college-location">
            </div>
            <div class="form-group">
                <label for="degree">Degree</label>
                <input type="text" id="degree" name="degree">
            </div>
            <div class="form-group">
                <label for="field-of-study">Field of Study</label>
                <input type="text" id="field-of-study" name="field-of-study">
            </div>
            <div class="form-group">
                <label for="graduation-year">Graduation Year</label>
                <input type="text" id="graduation-year" name="graduation-year">
            </div>
            <div class="form-group">
                <label for="additional-details">Additional Details</label>
                <textarea id="additional-details" name="additional-details" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="photo">Upload Photo</label>
                <input type="file" id="photo" name="photo" accept="image/*" required>
                <img id="photo-preview" src="#" alt="Preview" style="display: none;">
            </div>
            <button type="submit">Create Resume</button>
        </form>
    </div>
</body>
</html>
