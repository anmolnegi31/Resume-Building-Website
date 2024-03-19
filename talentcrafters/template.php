<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
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
    </style>
</head>

<body>
   
<?php
include "Navigation.php";
?>

<div class="container">
        <h1>Resume Template Selection</h1>
        <div class="template-gallery">
                <div class="template" id="template">
                    <a href="./details.php?template=template1"> 
                    <img src="./Templates/img/Template 1.png" alt="Template 1">
                    <button type="submit">Select</button> </a>
                </div>
                <div class="template" id="template">
                    <a href="./details.php?template=template2">
                    <img src="./Templates/img/Template 2.png" alt="Template 2">
                    <button type="submit">Select</button> </a>
                </div>
                <div class="template" id="template">
                    <a href="./details.php?template=template3">
                    <img src="./Templates/img/Template 3.png" alt="Template 3">
                    <button type="submit">Select</button> </a>
                </div>
                <div class="template" id="template">
                    <a href="./details.php?template=template4"> 
                    <img src="./Templates/img/Template 4.png" alt="Template 4">
                    <button type="submit">Select</button> </a>
                </div>
                <div class="template" id="template">
                    <a href="./details.php?template=template5"> 
                    <img src="./Templates/img/Template 5.png" alt="Template 5">
                    <button type="submit">Select</button> </a>
                </div>
                <div class="template" id="template">
                    <a href="./details.php?template=template6"> 
                    <img src="./Templates/img/Template 6.png" alt="Template 6">
                    <button type="submit">Select</button> </a>
                </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
