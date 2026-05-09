<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Correct absolute path load
// require_once __DIR__ . "/phpmailer/src/Exception.php";
// require_once __DIR__ . "/phpmailer/src/PHPMailer.php";
// require_once __DIR__ . "/phpmailer/src/SMTP.php";

function sendMail($to, $subject, $message){

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host       = "smtp.hostinger.com";
        $mail->SMTPAuth   = true;
        $mail->Username   = "info@koshiinstitute.org";
        $mail->Password   = "Admin@123";  // Replace with real email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom("info@koshiinstitute.org", "Koshi Institute");
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}
?>