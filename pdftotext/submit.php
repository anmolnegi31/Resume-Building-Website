<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["pdfFile"])) {
    
    $uploadDir = ".";
    $uploadFile = $uploadDir . basename($_FILES["pdfFile"]["name"]);
    $fileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));

    if ($fileType != "pdf") {
        echo "Only PDF files are allowed.";
        exit;
    }

    if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $uploadFile)) {
        $pdfFilePath = $uploadFile; 

        include 'vendor/autoload.php';

        $parser = new Smalot\PdfParser\Parser(); 
        
        $file = $pdfFilePath; 
        
        $pdf = $parser->parseFile($file); 
        
        $textContent = $pdf->getText();

        unlink($pdfFilePath);
        
        session_start();
        $_SESSION['pdf_details']=$textContent;
        header("Location: check_profile.php");
    } else {
        echo "Error uploading file.";
    }

} else {
    echo "Invalid request.";
}
?>