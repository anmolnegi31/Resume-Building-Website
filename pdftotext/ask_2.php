<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }
        #accountForm {
            display: none;
            margin-top: 20px;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #f9f9f9;
        }
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <?php
    if (isset($_GET['id'])){
        $resume_id = $_GET['id'];
    }
    else{
        header("Location: ../index.php");
    }
    ?>
    <h2>Do you want to replace your account details?</h2>
    <button onclick="redirectToEdit()">Yes</button>
    <button onclick="redirectToTemplate()">No</button>
    <script>
        function redirectToTemplate() {
            window.location.href = '../template.php?id=<?php echo $resume_id; ?>';
        }
        function redirectToEdit() {
            window.location.href = 'edit_details.php?id=<?php echo $resume_id; ?>';
        }
    </script>
</body>
</html>
