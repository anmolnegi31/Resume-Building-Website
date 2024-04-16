<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provide Basic Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .signup-link {
            margin-top: 20px;
            text-align: center;
        }
        .signup-link a {
            color: #007bff;
            text-decoration: none;
        }
        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_GET['details'])){
        $details = $_GET['details'];
        if (!($details==1 || $details==2)){
            header("Location: ../index.php");
        }
    }
    else{ 
        header("Location: ../index.php");
    }
    ?>
    <div class="container">
        <h2>Provide Basic Details</h2>
        <form action="process_basic_details.php?details=<?php echo $details; ?>" method="POST">
            <label for="job_title">Job Title:</label>
            <input type="text" id="job_title" name="job_title" required>

            <label for="degree">Degree:</label>
            <input type="text" id="degree" name="degree" required>

            <label for="field_of_study">Field of Study:</label>
            <input type="text" id="field_of_study" name="field_of_study" required>

            <label for="company_name">Company Name:</label>
            <input type="text" id="company_name" name="company_name" required>

            <label for="graduation_year">Graduation Year:</label>
            <input type="text" id="graduation_year" name="graduation_year" placeholder="Optional" value="">

            <label for="proficient_in">Proficient In:</label>
            <input type="text" id="proficient_in" name="proficient_in" placeholder="Optional" value="">

            <input type="submit" value="Submit">
        </form>

        <div class="signup-link">
            <p>Already have an account? <a href="../Account/login.html">Log in</a></p>
        </div>
    </div>
</body>
</html>
