<?php
session_start();

if (isset($_POST['otp'])) {
    $enteredOtp = $_POST['otp'];

    // Check if the entered OTP matches the one stored in session
    if ($_SESSION['otp'] == $enteredOtp) {
        echo json_encode(['status' => 'valid']);
    } else {
        echo json_encode(['status' => 'invalid']);
    }
}
?>
