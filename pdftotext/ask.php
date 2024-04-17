<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
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
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
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
    <h2>Do you want to create an account?</h2>
    <button onclick="showAccountForm()">Yes</button>
    <button onclick="redirectToTemplate()">No</button>

    <div id="accountForm">
        <h3>Create Account</h3>
<form action="update_profile.php?id=<?php echo $resume_id; ?>" id="createAccountForm" method="post">
    <input type="text" id="username" name="username" placeholder="Username" required><br>
    <span id="usernameError" class="error-message"></span>

    <input type="password" id="password" name="password" placeholder="Password" required><br>
    <input type="password" id="confirmPassword" placeholder="Confirm Password" required><br>
    <span id="passwordError" class="error-message"></span>

    <button type="submit">Create Account</button>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#createAccountForm').submit(function(event) {
            event.preventDefault(); // Prevent default form submission

            const username = $('#username').val().trim();
            const password = $('#password').val();
            const confirmPassword = $('#confirmPassword').val();

            // Reset error messages
            $('#usernameError').text('');
            $('#passwordError').text('');

            // Validate Username (check if username exists)
            $.ajax({
                url: '../check_username.php',
                method: 'POST',
                data: { username: username },
                dataType: 'json',
                success: function(response) {
                    console.log('AJAX Response:', response);

                    if (response.exists) {
                        $('#usernameError').text(response.message);
                    } else {
                        // Proceed with password validation
                        if (password !== confirmPassword) {
                            $('#passwordError').text('Passwords do not match');
                        } else {
                            console.log('All validations passed. Submitting form...');
                            // Submit the form (direct DOM submission)
                            $('#createAccountForm')[0].submit();
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    $('#usernameError').text('Error checking username. Please try again.');
                }
            });
        });
    });
</script>

</div>

    <script>
        function showAccountForm() {
            document.getElementById('accountForm').style.display = 'block';
        }

        function redirectToTemplate() {
            window.location.href = '../template.php?id=<?php echo $resume_id; ?>';
        }
    </script>
</body>
</html>
