<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Details: Amazon</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        header {
            text-align: center;
            margin-bottom: 30px;
        }

        h1 {
            font-size: 36px;
            color: #11A9C6;
        }

        .tagline {
            font-size: 18px;
            color: #666;
        }

        h2 {
            color: #4ED8D4;
            margin-bottom: 15px;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
        }

        ul {
            list-style-type: disc;
            padding-left: 20px;
        }

        </style>
</head>
<body>
<?php

if (isset($_GET['title']) && isset($_GET['description']) && isset($_GET['job_title']) && isset($_GET['country'])){
    $title = $_GET['title'];
    $description = $_GET['description'];
    $job_title = $_GET['job_title'];
    $country = $_GET['country'];
}
else{
    header("Location: jobs.php");
}

include "../gemini/response.php";
$question = "What is the tagline for company $title";
$tagline = response($question);

$question = "Write a description (About $title) for company $title. Description should start with $description. It should be about 200 words";
$about = response($question);

$question = "Write a paragraph on 'Role of $job_title in $title";
$role = response($question);
?>
<div class="container">
    <header>
        <h1><?php echo $title;?></h1>
        <p class="tagline"><?php echo $tagline;?></p>
    </header>

    <section class="overview">
        <h2>About <?php echo $title;?></h2>
        <p><?php echo $about;?></p>
    </section>
    <section class="overview">
        <h2>Role of <?php echo $job_title;?></h2>
        <p><?php echo $role;?></p>
    </section>
</div>

</body>
</html>
