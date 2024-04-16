<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $otp = $_POST['otp'];
    
    if ($_SESSION['reset_otp'] == $otp) {
        $reset_email = $_SESSION['reset_email'];
        header('Location: password_reset_form.php?email=' . urlencode($reset_email));
        exit;
    } else {
        
        header('Location: verify_otp.php?error=invalid_otp');
        exit;
    }
}
?>
