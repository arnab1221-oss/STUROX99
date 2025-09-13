
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'yourgmail@gmail.com'; // your Gmail
        $mail->Password = 'your-app-password'; // your App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('yourgmail@gmail.com', 'STUROX Orders');
        $mail->addAddress('yourgmail@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'New STUROX Order';
        $mail->Body    = 'A new order has been placed with details and attachments.';

        // Attach uploaded screenshot if exists
        if (!empty($_FILES['payment_screenshot']['tmp_name'])) {
            $mail->addAttachment($_FILES['payment_screenshot']['tmp_name'], $_FILES['payment_screenshot']['name']);
        }

        $mail->send();
        echo "Order submitted successfully!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
