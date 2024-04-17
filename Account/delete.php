<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 500px;
            margin: 100px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
</head>
<?php
session_start();

if (isset($_GET['user_id'])){
    $user_id=$_GET['user_id'];
}
else{
    header("Location: ../index.php");
}

if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
    $_SESSION['last_visited_url'] = $_SERVER['HTTP_REFERER'];
} else {
    $_SESSION['last_visited_url'] = '../index.php';
}
?>

<body>
    <div class="container">
        <h2 class="text-center mb-4">Delete Account</h2>
        <p>Are you sure you want to delete your account? This action cannot be undone.</p>
        <form action="process_delete.php" method="POST">
        <input type="hidden" id="user_id" name="user_id" value="<?php echo $user_id;?>">
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary" name="delete">Delete Account</button>
                <a href="<?php echo $_SESSION['last_visited_url'];?>" class="btn btn-secondary ml-2">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
