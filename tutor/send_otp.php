<?php
require 'phpmailer-master/src/PHPMailer.php';
require 'phpmailer-master/src/SMTP.php';
require 'phpmailer-master/src/Exception.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'];
    
    // Generate a random OTP
    $otp = rand(100000, 999999);
    
    // Store the OTP in the session
    $_SESSION['otp'] = $otp;

    // Create a new PHPMailer instance
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    
    try {
        // Set SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'vasanthvenkat0000@gmail.com';
        $mail->Password = 'eimv dmtx wndy yqxq';  // Use App Password if 2FA is enabled
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        // Set sender and recipient
        $mail->setFrom('your-email@gmail.com', 'NSKC Academy');
        $mail->addAddress($email);
        
        // Set email content
        $mail->Subject = 'Your OTP Code';
        $mail->Body = "Your OTP code is: $otp";
        
        // Send email
        if ($mail->send()) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => $mail->ErrorInfo]);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Method Not Allowed']);
}
?>
