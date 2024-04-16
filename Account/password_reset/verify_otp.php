<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            width: 400px;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-top: -500px;
        }

        h2 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 16px;
            margin-bottom: 8px;
            color: #555555;
        }

        input[type="text"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #dddddd;
            border-radius: 4px;
            font-size: 16px;
        }

        button[type="submit"] {
            padding: 12px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #ffffff;
            font-size: 16px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        .error-message {
            text-align: center;
            color: #ff0000;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php
    session_start();
    ?>
    <div class="container">
        <h2>Verify OTP</h2>
        <?php
        if (isset($_GET['error']) && $_GET['error'] === 'invalid_otp') {
            echo '<div class="error-message">Invalid OTP. Please try again.</div>';
        }
        ?>
        <form action="validate_otp.php" method="POST">
            <label for="otp">Enter the OTP sent to your email:</label>
            <input type="hidden" id="actual-otp" name="actual-otp" value="<?php echo $_SESSION['reset_otp'];?>" required>
            <input type="text" id="otp" name="otp" required>
            <button type="submit">Verify OTP</button>
        </form>
    </div>
</body>
<?php if (isset($_GET['send']) && $_GET['send'] === 'yes') {?>
<script>
    window.onload = function() {
        window.open("../gmail_clone/gmail.php?id=<?php echo $_GET['id'];?>", "_blank");
    };
</script>
<?php }?>
</html>
