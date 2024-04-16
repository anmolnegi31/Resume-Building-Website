<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Templates</title>
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
        }
        .template-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            grid-gap: 20px;
        }
        .template {
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .template:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .template img {
            width: 100%;
            height: auto;
        }
        .template button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 0 0 8px 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .template button:hover {
            background-color: #0056b3;
        }
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .loader {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

    </style>
</head>

<body>
   
<?php
include "Navigation.php";
$temp_no=0;
if (isset($_GET['id'])){
    $id=$_GET['id'];
}
else if (isset($_SESSION['user_id'])){
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'talentcrafters'; 

    $conn = mysqli_connect($host, $user, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT resume_id FROM user_resumes where user_id=".$_SESSION['user_id'];
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $id=$row["resume_id"];
}
else{
    $id=0;
}

function helloWorld(){
    return '<div id="loading-overlay">
        <div class="loader"></div>
    </div>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'helloWorld') {
    $result = helloWorld();
    echo $result;
    exit; 
}
?>


<div class="container">
        <h1>Resume Template Selection</h1>
        <div class="template-gallery">
                <div class="template" id="template">
                    <?php 
                       $temp_no++;
                       if ($id!=0){
                        $next="./Templates/Template_$temp_no.php?id=$id";
                       }
                       else{
                        $next="./details.php?temp_no=$temp_no";
                       }
                    ?>
                    <a href="<?php echo $next;?>" onclick="callPHPFunction()"> 
                    <img src="./Templates/images/Template 1.png" alt="Template 1">
                    <button type="submit">Classic</button> </a>
                </div>
                <div class="template" id="template">
                    <?php 
                       $temp_no++;
                       if ($id!=0){
                        $next="./Templates/Template_$temp_no.php?id=$id";
                       }
                       else{
                        $next="./details.php?temp_no=$temp_no";
                       }
                    ?>
                    <a href="<?php echo $next;?>" onclick="callPHPFunction()"> 
                    <img src="./Templates/images/Template 2.png" alt="Template 2">
                    <button type="submit">Professional</button> </a>
                </div>
                <div class="template" id="template">
                    <?php 
                       $temp_no++;
                       if ($id!=0){
                        $next="./Templates/Template_$temp_no.php?id=$id";
                       }
                       else{
                        $next="./details.php?temp_no=$temp_no";
                       }
                    ?>
                    <a href="<?php echo $next;?>" onclick="callPHPFunction()"> 
                    <img src="./Templates/images/Template 3.png" alt="Template 3">
                    <button type="submit">Creative</button> </a>
                </div>
               
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous">

        function callPHPFunction() {
            var xhr = new XMLHttpRequest();

            xhr.open('POST', '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>', true);

            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = xhr.responseText;
                    alert(response); 
                }
            };

            var data = "action=helloWorld"; 
            xhr.send(data);
        }
    </script>
</body>

</html>
